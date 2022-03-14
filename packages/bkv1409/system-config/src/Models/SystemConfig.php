<?php
namespace Bkv1409\SystemConfig\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class SystemConfig extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'display_name',
        'value',
        'status',
        'type',
        'group_name'
    ];

    protected static $submitEmptyLogs = false;

    public static $EMAIL_GROUP = 'EMAIL';

    public static $SYSTEM_CONFIG_TYPES = [
        'TEXT' => 'text',
        'TEXTAREA' => 'textarea',
        'DATE_TIME' => 'datetime',
        'NUMBER' => 'number',
        'BOOLEAN' => 'boolean',
        'FILE' => 'file',
    ];

    /**
     * Lấy giá trị tham số hệ thống từ db
     * @param $key
     * @param string $groupName
     * @return \Illuminate\Database\Eloquent\HigherOrderBuilderProxy|mixed|string|null
     */
    public static function getValue($key, $groupName = '')
    {
        try {
            $configQuery = self::where('name', $key)->where('status', 1);
            if (!empty($groupName)) $configQuery->where('group_name', $groupName);
            $config = $configQuery->first();
            if ($config) {
                switch ($config->type) {
                    case self::$SYSTEM_CONFIG_TYPES['NUMBER']:
                        return intval($config->value);
                    case self::$SYSTEM_CONFIG_TYPES['BOOLEAN']:
                        return filter_var($config->value, FILTER_VALIDATE_BOOLEAN);
                    case self::$SYSTEM_CONFIG_TYPES['FILE']:
                        return Storage::url($config->value);
                    case self::$SYSTEM_CONFIG_TYPES['DATE_TIME']:
                        try {
                            return Carbon::parse($config->value);
//                        return Carbon::instance(new \DateTime($config->value));
//                        return new \DateTime($config->value);
                        } catch (\Exception $exception) {
                            Log::warning($exception->getMessage());
                            return null;
                        }
                    case self::$SYSTEM_CONFIG_TYPES['TEXT']:
                    default:
                        return $config->value;
                }
            }
        } catch (\Throwable $exception) {
            Log::error('Cannot reach db to get system config value');
            Log::error($exception);
        }
        return null;
    }

    /**
     * Lấy giá trị tham số hệ thống từ DB và File cấu hình
     *  uu tiên trong db, sau đó đến file cấu hình. Có sử dụng cache
     * @param $key
     * @param null $default
     * @param string $groupName
     * @return \Illuminate\Config\Repository|\Illuminate\Contracts\Foundation\Application|\Illuminate\Database\Eloquent\HigherOrderBuilderProxy|mixed|string
     */
    public static function getValueWithFileConfig($key, $default = null, $groupName = '')
    {
        // add cache process
        $combineKey = self::getCombineKey($key, $groupName);
        $systemConfigUseCache = config('constants.SYSTEM_CONFIG.USE_CACHE');
        if ($systemConfigUseCache && Cache::has($combineKey)) {
            $value = Cache::get($combineKey);
            Log::debug('get value from cache | '. $combineKey . ' = ' . $value);
            return $value;
        }

        $value = self::getOriginValue($key, $default, $groupName);
        if ($systemConfigUseCache) Cache::put($combineKey, $value);
        return $value;
    }

    /**
     * Lấy giá trị tham số hệ thống từ DB và File cấu hình
     * uu tiên trong db, sau đó đến file cấu hình.
     * @param $key
     * @param null $default
     * @param string $groupName
     * @return \Illuminate\Config\Repository|\Illuminate\Contracts\Foundation\Application|\Illuminate\Database\Eloquent\HigherOrderBuilderProxy|mixed|string
     */
    public static function getOriginValue($key, $default = null, $groupName = '')
    {
        $value = self::getValue($key, $groupName);
        Log::debug('getOriginValue ~ key: ' . $key . ' | group: ' . $groupName . ' | dbval: ' . $value . ' | check is null: ' . is_null($value));
        $combineKey = self::getCombineKey($key, $groupName);
        if (is_null($value)) {
            $valueFromConfig = config('constants.' . $combineKey);
            return $default ?? $valueFromConfig;
        }
        return $value;
    }

    /**
     * @param $key
     * @param $groupName
     * @return string
     */
    public static function getCombineKey($key, $groupName)
    {
        return (empty($groupName) ? '' : $groupName . '.') . $key;
    }

    /**
     * @param $key
     * @param $groupName
     * @return bool
     */
    public static function forgetCache($key, $groupName)
    {
        $combineKey = self::getCombineKey($key, $groupName);
        Log::debug('forget key '. $key . " - groupName " . $groupName . ' ~ cache key '. $combineKey . ' = ' . Cache::get($combineKey));
        $result = Cache::forget($combineKey);
        Log::debug('check after forget '. Cache::get($combineKey));
        return $result;
    }

    public function forgetMe($flush = false)
    {
        $result = self::forgetCache($this->name, $this->group_name);

        // forget 1 key cache does not affect. use flush
        if ($flush) {
            Cache::flush();
            Log::debug('----------- cache flush ----------------');
        }
        return $result;
    }

    public function isEmailGroup()
    {
        return $this->group_name == SystemConfig::$EMAIL_GROUP;
    }

    public function isEnabled()
    {
        return $this->status == 1;
    }
}

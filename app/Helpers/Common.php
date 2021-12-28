<?php

namespace App\Helpers;

use Illuminate\Support\Carbon;
use DateTime;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Str;

class Common
{
//    const CURRENCY_SYMBOL_SHORT = 'đ';
    const CURRENCY_SYMBOL_SHORT = ' VNĐ';

    /**
     * Returns an excerpt from a given string (between 0 and passed limit variable).
     *
     * @param $string
     * @param int $limit
     * @param boolean $left
     * @param string $suffix
     * @return string
     */
    public static function shorten($string, $limit = 100, $suffix = '…', $left = false)
    {
        $strLength = strlen($string);

        if ($strLength < $limit) {
            return $string;
        }

        $number = $strLength - $limit;

        for ($i = 1; $i < $number; $i++) {
            $suffix .= '*';
        }

        return $left == true
            ? substr($string, 0, $limit) . ' ' . $suffix
            : $suffix . ' ' . substr($string, (0 - $limit));
    }

    /**
     * getWeekDates
     * Lấy thông tin tuần, ngày đầu tuần, ngày cuối tuần
     *
     * @param string $startDate
     * @param string $endDate
     * @return array
     */
    public static function getWeekDates($startDate = '', $endDate = '')
    {
        $weeks = array();

        // Nếu dãi ngày hợp lệ
        if (!empty($startDate) && !empty($endDate)) {
            $startTime = strtotime($startDate);
            $endTime = strtotime($endDate);
            $date = new DateTime();
            $i = 0;
            while ($startTime <= $endTime) {
                $weeks[$i]['week'] = date('W', $startTime);
                $weeks[$i]['year'] = date('Y', $startTime);
                $date->setISODate($weeks[$i]['year'], $weeks[$i]['week']);
                $weeks[$i]['Monday'] = $date->format('Y-m-d');
                $weeks[$i]['Sunday'] = date('Y-m-d', strtotime($weeks[$i]['Monday'] . "+5 days"));
                $startTime += strtotime('+1 week', 0);
                $i++;
            }
        }
        return $weeks;
    }

    /**
     * today
     *
     * @param boolean $dateTime
     * @return string
     */
    public static function today($dateTime = true)
    {
        if ($dateTime) return Carbon::now();
        return Carbon::today()->toDateString();
    }

    /**
     * addDay
     *
     * @param  int  $day
     * @param  string  $date
     * @return string
     */
    public static function addDay($day = 1, $date = '')
    {
        if (empty($date)) {
            return Carbon::now()->addDay($day);
        }

        $date = str_replace('/', '-', $date);
        return Carbon::parse($date)->addDay($day);
    }

    /**
     * addMinutes
     * Thêm số phút
     *
     * @param  int  $minutes
     * @param  string  $date
     * @return string
     */
    public static function addMinutes($minutes = 1, $date = '')
    {
        if (empty($date)) {
            return Carbon::now()->addMinutes($minutes);
        }

        $date = str_replace('/', '-', $date);
        return Carbon::parse($date)->addMinutes($minutes);
    }

    public static function dateWithEndOfTime($date = '')
    {
        $dateObj = empty($date) ? Carbon::now() : Carbon::parse($date);
        return $dateObj->addDay()->subSecond()->toDateTimeLocalString();
    }

    /**
     * compareDate
     *
     * @param string $startDate
     * @param string $endDate
     * @return boolean
     */
    public static function compareDate($startDate = '', $endDate = '')
    {
        return strtotime($startDate) <= strtotime($endDate);
    }

    /**
     * @param  string  $endDate
     * @return bool
     */
    public static function beforeTime($endDate = '')
    {
        return strtotime(Common::today(true)) <= strtotime($endDate);
    }

    /**
     * @param  string  $starDate
     * @return bool
     */
    public static function afterTime($starDate = '')
    {
        return strtotime($starDate) <= strtotime(Common::today(true));
    }

    /**
     * formatDate
     *
     * @param string $date . Support Y-m-d, Y-d-m, Y/m/d, m/d/Y, d/m/Y
     * @param string $format
     * @return string
     */
    public static function formatDate($date = '', $format = 'd/m/Y H:i:s')
    {
        if (empty($date)) return '';
        $date = str_replace('/', '-', $date);
        return Carbon::parse($date)->format($format);
    }

    /**
     * formatCurrency
     *
     * @param $currency
     * @param bool $isFull
     * @return string
     */
    public static function formatCurrency($currency, $isFull = false)
    {
        $temp = $isFull ? self::CURRENCY_SYMBOL_SHORT : '';
        $currency = $currency < 0 ? 0 : $currency;
        return number_format(
                $currency,
                config('constants.CURRENCY_PRECISION'),
                '.',
                '.'
            ) . $temp;
    }

    /**
     * percent
     *
     * @param int $num
     * @param int $total
     * @param int $precision
     * @return false|string
     */
    public static function percent($num = 0, $total = 0, $precision = 0)
    {
        if ($total <= 0) return false;
        return round(($num / $total) * 100, $precision) . '%';
    }


    /**
     * fullPath
     *
     * @param string $url
     * @return string
     */
    public static function fullPath($url = '')
    {
        return str_replace("\\", "/", base_path()) . $url;
    }




    /**
     * @param $value
     * @return string
     */
    public static function paddingZero($value)
    {
        return str_pad($value, 2, '0', STR_PAD_LEFT);
    }

    /**
     * 02/11-31/12/2020
     * isFullText = true -> 01/10/2020 đến 05/11/2020
     * @param $start
     * @param $end
     * @param bool $isFullText
     * @return string
     */
    public static function formatDateRange($start, $end, $isFullText = false)
    {
        $startDate = Carbon::parse($start);
        $endDate = Carbon::parse($end);
        $endDateStr = $endDate->format('d/m/Y');
        $startDateStr = $startDate->format('d/m/Y');
        if ($isFullText) return $startDateStr . ' đến ' . $endDateStr;
        if ($startDate->year === $endDate->year) {
            $startDateStr = $startDate->format('d/m');
        }
        return $startDateStr . '-' . $endDateStr;
    }

    /**
     * @param $ua
     * @return false|int
     */
    public static function isMobile($ua)
    {
        return preg_match("/(android|avantgo|blackberry|bolt|boost|cricket|docomo|fone|hiptop|mini|mobi|palm|phone|pie|tablet|up\.browser|up\.link|webos|wos)/i", $ua);
    }

    /**
     * @param $giftTemplates
     * @param  int  $groupCount
     * @return array
     */
    public static function groupRowColArrayOrCollection($giftTemplates, $groupCount = 3)
    {
        $giftTemplateArr = [];
        $i = 0;
        $j = 0;
        foreach ($giftTemplates as $index => $giftTemplate) {
            $giftTemplateArr[$i] [$index] = $giftTemplate;
            if ($j > 0 && $j % $groupCount == ($groupCount - 1)) $i++;
            $j++;
        }
        return $giftTemplateArr;
    }

    /**
     * @param $query
     * @param $request
     * @param  bool  $useUpdated
     * @param  string  $inputName
     * @param  bool  $useDefaultStartDate
     * @return array
     */
    public static function addTimeRangeCond($query, $request, $useUpdated = false, $inputName = 'date', $useDefaultStartDate = true)
    {
        list('startDate' => $startDate, 'endDate' => $endDate) = Common::getTimeRange($request, $inputName, $useDefaultStartDate);

        $formattedStartDate = Common::formatDate($startDate, 'Y-m-d');
        $formattedEndDate = Common::formatDate($endDate, 'Y-m-d');
        $fieldName = $useUpdated ? 'updated_at' : 'created_at';
        if ($startDate) {
            $query->where($fieldName, '>=', $formattedStartDate . ' 00:00:00');
        }
        if ($endDate) {
            $query->where($fieldName, '<=', $formattedEndDate . ' 23:59:59');
        }
        return compact('startDate', 'endDate');
    }

    /**
     * @param $request
     * @param  string  $inputName
     * @param  bool  $useDefaultStartDate
     * @return array
     */
    public static function getTimeRange($request, $inputName = 'date', $useDefaultStartDate = true)
    {
        $startDate = $request->input('start_' . $inputName, '');
        $endDate = $request->input('end_' . $inputName, '');
        $endDate = empty($endDate) ? now()->format('d/m/Y') : $endDate;

        if ($useDefaultStartDate) {
            $startDate = empty($startDate) ? now()->subDay()->format('d/m/Y') : $startDate;
        }

        return compact('startDate', 'endDate');

    }

    /**
     * @param $query
     * @param $request
     * @param false $useUpdated
     * @param string $inputName
     * @return array
     */
    public static function addDateTimeRangeCond($query, $request, $useUpdated = false, $inputName = 'date')
    {
        $startDate = $request->input('start_' . $inputName, '');
        $endDate = $request->input('end_' . $inputName, '');
        $commonFormat = 'Y-m-d H:i:s';
        $endDate = empty($endDate) ? now()->format($commonFormat) : $endDate;
        $startDate = empty($startDate) ? now()->format('Y-m-d 00:00:00') : $startDate;
        $formattedStartDate = Common::formatDate($startDate, $commonFormat);
        $formattedEndDate = Common::formatDate($endDate, $commonFormat);
        $fieldName = $useUpdated ? 'updated_at' : 'created_at';

        if ($startDate) $query->where($fieldName, '>=', $formattedStartDate);
        if ($endDate) $query->where($fieldName, '<=', $formattedEndDate);
        return compact('startDate', 'endDate');
    }

    /**
     * @param $url
     * @param  string  $envDomainKey
     * @param  bool  $useMix
     * @return string
     * @throws \Exception
     */
    public static function concatUrlStr($url, $envDomainKey = 'APP_DOMAIN', $useMix = true)
    {
//        $useFixUrl = env('APP_USE_FIX_URL', false);
        $useFixUrl = config('appdomain.USE_FIX_URL');
//        $domain = env($envDomainKey);
        $domain = config("appdomain.$envDomainKey");
        $url = $useMix ? mix($url) : $url;
        return $useFixUrl && $domain ? self::mergeDomain($domain, $url) : asset($url);
    }

    /**
     * @param $domain
     * @param $url
     * @param bool $useJoinPath
     * @return string
     */
    public static function mergeDomain($domain, $url, $useJoinPath = true)
    {
        if ($useJoinPath) return self::joinPaths($domain, $url);

        if (strpos($url, '/') === 0 && substr($domain, -1) === '/') {
            return $domain . substr($url, 1);
        } elseif (strpos($url, '/') !== 0 && substr($domain, -1) !== '/') {
            return "$domain/$url";
        }
        return $domain . $url;
    }

    /**
     * @param $url
     * @return string
     */
    public static function removeDomain($url)
    {
        $parseUrl = parse_url($url);
        return ($parseUrl['path'] ?? '')
            . (isset($parseUrl['query']) ? ('?' . $parseUrl['query']) : '')
            . (isset($parseUrl['fragment']) ? ('#' . $parseUrl['fragment']) : '');
    }

    /**
     * @param $url
     * @return string
     */
    public static function getDomain($url)
    {
        $parseUrl = parse_url($url);
        return $parseUrl['host'] ?? '';
    }

    /**
     * @param $name
     * @param string $queryStr
     * @param string $tag
     * @return string
     */
    public static function assetFrontRoute($name, $queryStr = '', $tag = '')
    {
        $finalUrl = route($name) . $queryStr . ($tag ? "#$tag" : '');
//        $useFixUrl = env('APP_USE_FIX_URL', false);
        $useFixUrl = config('appdomain.USE_FIX_URL');
//        $domain = env('APP_DOMAIN');
        $domain = config('appdomain.APP_DOMAIN');
        if ($useFixUrl && $domain) {
            return self::mergeDomain($domain, self::removeDomain($finalUrl));
        }
        return $finalUrl;
    }

    /**
     * @param $val
     * @param int $firstCharacter
     * @return string
     */
    public static function getFirstContent($val, $firstCharacter = 20)
    {
        return strlen($val) > $firstCharacter
            ? mb_substr($val, 0, $firstCharacter) . '... see detail'
            : $val;
    }

    /**
     * @param $url
     * @return mixed
     */
    public static function storageUrl($url)
    {
        return Storage::url($url);
    }

    /**
     * join path with input array or arguments
     * @return string
     */
    public static function joinPaths()
    {
        $args = func_get_args();
        $paths = array();
        foreach ($args as $arg) {
            $paths = array_merge($paths, (array)$arg);
        }

        $paths = array_map(function ($p) { return trim($p, '/'); }, $paths);
        $paths = array_filter($paths);
        return implode('/', $paths);
    }

    public static function splitWithCommonDelimiter($val)
    {
        return preg_split( "/[;,\s*]/", $val);
    }

    public static function documentMIMETypePattern()
    {
        return 'mimetypes:application/excel,application/vnd.ms-excel, application/vnd.msexcel,' .
            'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet,' .
            'text/csv,text/x-c,text/comma-separated-values,inode/x-empty,application/csv,' .
            'application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document,' .
            'image/jpeg,image/png,image/webp,image/svg+xml,' .
            'application/pdf,application/x-pdf,application/acrobat,applications/vnd.pdf,text/pdf,text/x-pdf';
    }

    public static function excelCsvMIMETypePattern()
    {
        return 'mimetypes:application/excel,application/vnd.ms-excel, application/vnd.msexcel,'
            . 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet,'
            . 'text/csv,text/x-c,text/comma-separated-values,inode/x-empty,application/csv,'
            . 'application/text,text/plain';
    }

    public static function onlyCsvMIMETypePattern()
    {
        return 'mimetypes:application/excel,application/vnd.ms-excel, application/vnd.msexcel,'
            . 'text/csv,text/x-c,text/comma-separated-values,inode/x-empty,application/csv,'
            . 'application/text,text/plain';
    }

    /**
     * @param $data
     * @param $allowed
     * @return array
     */
    public static function arrayFilter($data, $allowed)
    {
        return array_filter($data, function ($key) use ($allowed) {
                return in_array($key, $allowed);
            }, ARRAY_FILTER_USE_KEY
        );
    }

    public static function strLimit($str, $number = 200, $replaceStr = ' (...)')
    {
        return Str::limit($str, $number, $replaceStr);
    }

    public static function getLocalStorageRealPath($path)
    {
        return storage_path('app') . '/' . $path;
    }

    /**
     * @param  array  $data
     * @return array $data with created_at, updated_at now value
     */
    public static function addDateTimeColumn(array $data)
    {
        $now = now()->toDateTimeString();
        return array_merge($data, [
           'created_at' => $now,
           'updated_at' => $now,
        ]);
    }

    public static function booleanPrint($val)
    {
        return empty($val) ? 0 : 1;
    }

    public static function printSeason($season, $isShort = false)
    {
        if ($isShort) return "$season->name (ID: $season->id ~ ".self::formatDate($season->start_time, 'm/d')." - ".self::formatDate($season->end_time, 'm/d').")";
        return "$season->name (ID: $season->id ~ from $season->start_time to $season->end_time)";
    }

    public static function printSeasonVeryShort($season)
    {
        return $season->name." ( ".Carbon::parse($season->start_time)->format('m/d')." - ".Carbon::parse($season->end_time)->format('m/d')." )";
    }

    public static function getOnlyClassName($namespace)
    {
        return substr(strrchr($namespace, "\\"), 1);
    }


    public static function compileMessage($message, $play, $max_play, $newLineSupport = true)
    {
        try {
            $message = $newLineSupport ? nl2br(trim($message)) : $message;
            return CustomBladeCompiler::render($message, compact('play', 'max_play'));
        } catch (\Throwable $exception) {
            Log::warning('Compile Blade Ex: ' . $exception->getMessage());
        }
        return false;
    }

    /**
     * parse string to Carbon object
     * Support Y-m-d, m/d/Y, m-d-Y
     * @param string $date
     * @return string
     */
    public static function parseDate($date = '')
    {
        if (empty($date)) return '';
        try {
            $date = str_replace('/', '-', $date);
            return Carbon::parse($date);
        } catch (\Throwable $exception) {
            return null;
        }

    }

    /**
     * @param $date
     * @param  string  $format
     * @return mixed|string
     */
    public static function printDate($date, $format = 'd/m/Y H:i:s')
    {
        if (empty($date)) return '';
//        Log::info(gettype($date));
//        Log::info(get_class($date));
        if ($date instanceof Carbon || $date instanceof \Carbon\Carbon) {
//            Log::info('carbon');
            return $date->format($format);
        }
//        Log::info('string');
        return $date;
    }

    /**
     * @return string
     */
    public static function appendQueryString()
    {
        $query = request()->getQueryString();
        return empty($query) ? '' : "?$query";
    }

}


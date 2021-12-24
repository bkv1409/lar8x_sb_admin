<?php
/**
 * Created by PhpStorm.
 * User: vunq
 * Date: 2019-05-17
 * Time: 5:40 PM
 */

namespace App\Helpers;


use Illuminate\Support\Facades\Log;

class LogUtils
{
    /**
     * @param  string  $fnName
     * @param  string  $extraMsg
     * @return float|string
     */
    public static function logStartTime($fnName = '', $extraMsg = '')
    {
        return self::logStartTimeComplex($fnName, false, true, $extraMsg);
    }

    /**
     * @param  string  $fnName
     * @param  false  $isDump
     * @param  bool  $showPid
     * @param  string  $extraMsg
     * @return mixed
     */
    public static function logStartTimeComplex($fnName = '', $isDump = false, $showPid = true, $extraMsg = '')
    {
        $startTime = microtime(true);
        $pid = $showPid ? 'pid '.getmypid() : '';
        $msg = "--------------- $pid fn $fnName - start time: $startTime" . (empty($extraMsg) ? '' : " - ext: $extraMsg");
        if ($isDump) dump($msg);
        Log::info($msg);
        return $startTime;
    }

    /**
     * @param $startTime
     * @param $fnName
     * @param $extraMsg
     * @return object
     */
    public static function logEndTime($startTime, $fnName, $extraMsg = '')
    {
        return self::logEndTimeComplex($startTime, $fnName, false, true, $extraMsg);
    }

    /**
     * @param $startTime
     * @param $fnName
     * @param  false  $isDump
     * @param  bool  $showPid
     * @param  string  $extraMsg
     * @return object
     */
    public static function logEndTimeComplex($startTime, $fnName, $isDump = false, $showPid = true, $extraMsg = '')
    {
        $endTime = microtime(true);
        $duration = ($endTime - $startTime);
        $pid = $showPid ? 'pid '.getmypid() : '';
        $msg = "--------------- $pid - fn $fnName - end time: $endTime"
            . (empty($extraMsg) ? '' : " - ext: $extraMsg")
            .' | duration: ' . round($duration, 3) . ' (s) ~ '
            . round($duration * 1000, 3) . ' (ms) ~ '
            . round(($duration / 60), 3) . ' (min)';
        if ($isDump) dump($msg);
        Log::info($msg);
        return (object) compact('endTime', 'duration');
    }

    /**
     * @param $msg
     * @param  bool  $isDump
     * @param  bool  $isInfo
     * @param  bool  $showPid
     */
    public static function info($msg, $isDump = false, $isInfo = false, $showPid = true)
    {
        $prefix = $showPid ? 'pid '.getmypid().': ' : '';
        $logMsg = is_string($msg) ? ($prefix.$msg) : ($prefix.print_r($msg, true));
        if ($isInfo) {
            Log::info($logMsg);
        } else {
            Log::warning($logMsg);
        }
        if ($isDump) dump($msg);
    }

    /**
     * @param $query
     */
    public static function logQuery($query)
    {
        if (config('constant.LOGGING.QUERY_LOG_DEBUG')) {
            Log::info($query->toSql());
            Log::info($query->getBindings());
        }
    }

    /**
     * @param $str
     */
    public static function logStr($str)
    {
        if (config('constant.LOGGING.QUERY_LOG_DEBUG')) {
            Log::info($str);
        }
    }

    public static function printMem($fn = '', $isDebug = true)
    {
        /* Currently used memory */
        $memUsage = self::humanShowBytes(memory_get_usage(true));
        /* Peak memory usage */
        $memPeak = self::humanShowBytes(memory_get_peak_usage(true));
        $fnStr = empty($fn) ? '' : " fn $fn -";
        $msg = "======>$fnStr Memory usage: $memUsage - Peak usage: $memPeak <========";
        if ($isDebug) Log::debug($msg);
        else Log::warning($msg);
    }

    /**
     * @param $bytes
     * @return string
     */
    public static function humanShowBytes($bytes): string
    {
        if ($bytes < 1024) return $bytes." bytes";
        if ($bytes < 1048576) return round($bytes/1024,2)." KB";
        return round($bytes/1048576,2)." MB";
    }
}

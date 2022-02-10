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


    public static function getOnlyClassName($namespace)
    {
        return substr(strrchr($namespace, "\\"), 1);
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


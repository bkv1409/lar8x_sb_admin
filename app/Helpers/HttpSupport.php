<?php


namespace App\Helpers;


class HttpSupport
{
    public static function makeData($msg, $status, $data)
    {
        return compact('status', 'msg', 'data');
    }

    public static function makeFailedData($msg, $status = 0)
    {
        return self::makeData($msg, $status, null);
    }

    public static function makeSuccessData($data, $msg = 'Thành công', $status = 1)
    {
        return self::makeData($msg, $status, $data);
    }

    public static function sendError($msg, $status = 0, $httpCode = 200)
    {
        return response()->json(HttpSupport::makeFailedData($msg, $status), $httpCode);
    }

    public static function sendSuccess($data, $msg = 'Thành công', $status = 1, $httpCode = 200)
    {
        return response()->json(HttpSupport::makeSuccessData($data, $msg, $status), $httpCode);
    }
}

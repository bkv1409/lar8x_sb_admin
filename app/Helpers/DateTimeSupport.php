<?php


namespace App\Helpers;


class DateTimeSupport
{
    /**
     * delay random 1ms to $max ms
     * @param  int  $max
     */
    public static function delayRandMs($max = 200)
    {
        $randomMs = rand(1, $max);
        $randomMultiple = rand(1, 1000);
        usleep($randomMs * $randomMultiple );
    }

    /**
     * delay random nano sec, from 1ns to $max ms
     * @param  int  $max
     */
    public static function delayRandMsWithNano($max = 200)
    {
        $randomMs = rand(1, $max);
        $randomMultiple = rand(1, 1000000);
        time_nanosleep(0, $randomMs * $randomMultiple);
    }

    /**
     * delay random 1ms to $max ms
     * @param  int  $max
     */
    public static function delayUs($max = 1000)
    {
        usleep(rand(1, $max) );
    }

    public static function delayFixMs($value)
    {
        usleep($value * 1000);
    }

    public static function timestampMs(): float
    {
        return round(microtime(true) * 1000);
    }

}

<?php

use App\Helpers\Common;
use App\Models\User;
use Illuminate\Support\Str;

/*****************************************************
 *  COMMON ZONE START
 *****************************************************
 */
if (! function_exists('show_route')) {
    function show_route($model, $resource = null)
    {
        $resource = $resource ?? plural_from_model($model);

        return route("{$resource}.show", $model);
    }
}

if (! function_exists('plural_from_model')) {
    function plural_from_model($model)
    {
        $plural = Str::plural(class_basename($model));

        return Str::kebab($plural);
    }
}


if (! function_exists('get_first_content')) {
    function get_first_content($val, $firstCharacter = 20)
    {
       return Common::getFirstContent($val, $firstCharacter);
    }
}

if (! function_exists('object_get_ext')) {
    /**
     * Get an item from an object using "dot" notation.
     *
     * @param  object  $object
     * @param  string  $key
     * @param  mixed   $default
     * @return mixed
     */
    function object_get_ext($object, $key, $default = null)
    {
        if (is_null($key) || trim($key) == '') return $object;

        foreach (explode('.', $key) as $segment)
        {
            //+++++++++++++++++
            if($object instanceof \Illuminate\Database\Eloquent\Collection)
            {
                $object = $object->find($segment);
                if(!$object)
                {
                    return value($default);
                }
                continue;
            }
            //+++++++++++++++++

            if ( ! is_object($object) || ! isset($object->{$segment}))
            {
                return value($default);
            }

            $object = $object->{$segment};
        }

        return $object;
    }
}



if (! function_exists('format_date')) {
    function format_date($date = '', $format = 'd/m/Y H:i:s')
    {
        return Common::formatDate($date, $format);
    }
}

if (! function_exists('positive_val')) {
    function positive_val($val)
    {
        return $val > 0 ? $val : 0;
    }
}


if (! function_exists('storage_url')) {
    function storage_url($url)
    {
        return Common::storageUrl($url);
    }
}

if (! function_exists('split_with_common_delimiter')) {
    function split_with_common_delimiter($val)
    {
        return Common::splitWithCommonDelimiter($val);
    }
}

if (! function_exists('print_season')) {
    function print_season($season, $isShort = false)
    {
        return Common::printSeason($season, $isShort);
    }
}


if (! function_exists('print_date')) {
    function print_date($date, $format = 'd/m')
    {
        return Common::printDate($date, $format);
    }
}

if (! function_exists('default_avatar')) {
    function default_avatar()
    {
        return User::$DEFAULT_AVATAR;
    }
}

if (! function_exists('append_query_str')) {
    function append_query_str()
    {
        return Common::appendQueryString();
    }
}

if (! function_exists('print_if_exist')) {
    function print_if_exist($value, $postFix = '', $preFix = '')
    {
        if (empty($value)) return '';
        return "{$preFix}{$value}{$postFix}";
    }
}

/*****************************************************
 *  COMMON ZONE END
 *****************************************************
 */

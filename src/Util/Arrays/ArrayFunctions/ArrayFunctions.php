<?php


namespace Dotbcrm\Dotbcrm\Util\Arrays\ArrayFunctions;

/**
 * Class ArrayFunctions
 * @package Dotbcrm\Dotbcrm\Util\Arrays\ArrayFunctions
 *
 * Utility functions for working with standard arrays and Array accessible objects such as Dotb's $_SESSION object
 * and other custom Array implementations such as TrackableArray or OrderedHash.
 */
class ArrayFunctions
{
    /**
     * Implementation of is_array that returns true for both arrays and classes that implement ArrayAccess
     *
     * @param mixed $arr
     *
     * @return bool
     */
    public static function is_array_access($arr)
    {
        return is_array($arr) || is_object($arr) && in_array('ArrayAccess', class_implements($arr));
    }

    /**
     * Implementation of in_array that works on arrays or classes that implement ArrayAccess
     * such as ArrayObject
     *
     * @param mixed             $needle
     * @param array|ArrayAccess $haystack
     * @param bool              $strict
     *
     * @return bool
     */
    public static function in_array_access($needle, $haystack, $strict = false)
    {
        if (is_array($haystack)) {
            return in_array($needle, $haystack, $strict);
        }

        foreach ($haystack as $value) {
            if (($strict && $value === $needle) || (!$strict && $value == $needle)) {
                return true;
            }
        }

        return false;
    }

    /**
     * Implementation of array_keys that works on arrays or classes that implement ArrayAccess
     * such as ArrayObject
     *
     * @param array|ArrayAccess $arr
     * @param null              $search
     * @param bool              $strict
     *
     * @return array
     */

    public static function array_access_keys($arr, $search = null, $strict = false)
    {
        if (is_array($arr)) {
            return array_keys($arr, $search, $strict);
        }

        $out = array();

        foreach ($arr as $key => $value) {
            if (!is_null($search)) {
                if (($strict && $value === $search) || (!$strict && $value == $search)) {
                    $out[] = $key;
                }
            } else {
                $out[] = $key;
            }
        }

        return $out;
    }

    /**
     * Implementation of array_keys that works on arrays or classes that implement ArrayAccess
     * such as ArrayObject
     *
     * @param array|ArrayAccess $arr
     * @param null              $search
     * @param bool              $strict
     *
     * @return array
     */
    public static function array_access_merge()
    {
        $args = func_get_args();
        foreach ($args as $i => $v) {
            if (is_object($v) && static::is_array_access($v)) {
                $args[$i] = (array)$v;
            }
        }

        return call_user_func_array('array_merge', $args);
    }
}

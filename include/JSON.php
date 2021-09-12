<?php
/**
 * This class used to perform json encode / decode functions but has now been replaced by
 * the built in php.
 *
 * Note: We no longer eval our json so there is no more need for security envelopes. The parameter
 * has been left for backwards compatibility.
 * @api
 */
class JSON
{

    /**
     * JSON encode a string
     *
     * @param string $string
     * @return string
     */
    public static function encode($string)
    {
        return json_encode($string, JSON_HEX_TAG|JSON_HEX_AMP|JSON_HEX_APOS|JSON_HEX_QUOT);
    }

    /**
     * JSON decode a string
     *
     * @param string $string
     * @param bool $examineEnvelope Default false, true to extract and verify envelope
     * @param bool $assoc
     * @return string
     */
    public static function decode($string, $examineEnvelope=false, $assoc = true)
    {
        return json_decode($string,$assoc);
    }

    /**
     * @deprecated use JSON::encode() instead
     */
    public static function encodeReal($string)
    {
        return self::encode($string);
    }

    /**
     * @deprecated use JSON::decode() instead
     */
    public static function decodeReal($string)
    {
        return self::decode($string);
    }
}

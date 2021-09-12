<?php

/**
 * Class KTEncrypt
 * author Trần Khánh Toàn
 * date 6/12/2017
 * description encode and decode a string with a key
 */
class KTEncrypt
{
    public function encode($string, $key)
    {
        return base64_encode($this->mcrypt_encode($string, md5($key)));
    }

    public function decode($string, $key)
    {
        if (preg_match('/[^a-zA-Z0-9\/\+=]/', $string) OR base64_encode(base64_decode($string)) !== $string) return FALSE;
        return $this->mcrypt_decode(base64_decode($string), md5($key));
    }

    protected function _xor_decode($string, $key)
    {
        $string = $this->_xor_merge($string, $key);
        $dec = '';
        for ($i = 0, $l = self::strlen($string); $i < $l; $i++) $dec .= ($string[$i++] ^ $string[$i]);
        return $dec;
    }

    protected function _xor_merge($string, $key)
    {
        $hash = hash('sha1', $key);
        $str = '';
        for ($i = 0, $ls = self::strlen($string), $lh = self::strlen($hash); $i < $ls; $i++) $str .= $string[$i] ^ $hash[($i % $lh)];
        return $str;
    }

    protected function mcrypt_encode($data, $key)
    {
        $init_size = mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_CBC);
        $init_vect = mcrypt_create_iv($init_size, MCRYPT_DEV_URANDOM);
        return $this->_add_cipher_noise($init_vect . mcrypt_encrypt(MCRYPT_RIJNDAEL_256, $key, $data, MCRYPT_MODE_CBC, $init_vect), $key);
    }

    protected function mcrypt_decode($data, $key)
    {
        $data = $this->_remove_cipher_noise($data, $key);
        $init_size = mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_CBC);
        if ($init_size > self::strlen($data)) return FALSE;
        $init_vect = self::substr($data, 0, $init_size);
        $data = self::substr($data, $init_size);
        return rtrim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, $key, $data, MCRYPT_MODE_CBC, $init_vect), "\0");
    }

    protected function _add_cipher_noise($data, $key)
    {
        $key = hash('sha1', $key);
        $str = '';
        for ($i = 0, $j = 0, $ld = self::strlen($data), $lk = self::strlen($key); $i < $ld; ++$i, ++$j) {
            if ($j >= $lk) $j = 0;
            $str .= chr((ord($data[$i]) + ord($key[$j])) % 256);
        }
        return $str;
    }

    protected function _remove_cipher_noise($data, $key)
    {
        $key = hash('sha1', $key);
        $str = '';
        for ($i = 0, $j = 0, $ld = self::strlen($data), $lk = self::strlen($key); $i < $ld; ++$i, ++$j) {
            if ($j >= $lk) $j = 0;
            $temp = ord($data[$i]) - ord($key[$j]);
            if ($temp < 0) $temp += 256;
            $str .= chr($temp);
        }
        return $str;
    }

    protected static function strlen($str)
    {
        return defined('MB_OVERLOAD_STRING') ? mb_strlen($str, '8bit') : strlen($str);
    }

    protected static function substr($str, $start, $length = NULL)
    {
        if (defined('MB_OVERLOAD_STRING')) {
            isset($length) OR $length = ($start >= 0 ? self::strlen($str) - $start : -$start);
            return mb_substr($str, $start, $length, '8bit');
        }
        return isset($length) ? substr($str, $start, $length) : substr($str, $start);
    }
}
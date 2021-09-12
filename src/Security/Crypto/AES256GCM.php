<?php declare(strict_types=1);


namespace Dotbcrm\Dotbcrm\Security\Crypto;

use RuntimeException;

/**
 * AES-256-GCM encryption/decryption
 */
class AES256GCM
{
    /**
     * @var string
     */
    private const ALGO = 'aes-256-gcm';

    /**
     * @var string
     */
    private $key;

    /**
     * @var string
     */
    private $ivLength;

    /**
     * @param string $key Encryption/decryption key
     */
    public function __construct(string $key)
    {
        $this->key = $key;
        $this->ivLength = openssl_cipher_iv_length(self::ALGO);
    }

    public function encrypt(string $value) : string
    {
        $iv = openssl_random_pseudo_bytes($this->ivLength);
        $cipherText = openssl_encrypt($value, self::ALGO, $this->key, OPENSSL_RAW_DATA, $iv, $tag);

        return $iv . $tag . $cipherText;
    }

    /**
     * @param string $value
     *
     * @return string
     * @throws RuntimeException
     */
    public function decrypt(string $value) : string
    {
        $iv = $this->substr($value, 0, $this->ivLength);
        $tag = $this->substr($value, $this->ivLength, 16);
        $cipherText = $this->substr($value, $this->ivLength + 16);

        $result = openssl_decrypt($cipherText, self::ALGO, $this->key, OPENSSL_RAW_DATA, $iv, $tag);

        if ($result === false) {
            $error = '';

            while (($msg = openssl_error_string())) {
                $error .= $msg;
            }

            throw new RuntimeException($error);
        }

        return $result;
    }

    private function substr(string $string, int $start, ?int $length = null) : string
    {
        return mb_substr($string, $start, $length, '8bit');
    }
}

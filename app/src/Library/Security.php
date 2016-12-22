<?php

namespace App\Library;


use Hashids\Hashids;
use phpseclib\Crypt\AES;

class Security
{
    private $cipher;

    private $hashids;

    public function __construct($settings)
    {
        $this->cipher = new AES();
        $this->cipher->setKey($settings['aesKey']);

        $this->hashids = new Hashids($settings['hashids']['salt'], $settings['hashids']['minLen'], $settings['hashids']['alphabet']);
    }

    public function encryptBase64($value)
    {
        return base64_encode($this->cipher->encrypt($value));
    }

    public function decryptBase64($value)
    {
        return $this->cipher->decrypt(base64_decode($value));
    }

    public function generateRandomHash()
    {
        return hash('sha256', openssl_random_pseudo_bytes(32));
    }

    public function doHash($content, $privateHash)
    {
        return hash_hmac('sha256', $content, $privateHash);
    }

    public function encodeHashids($value)
    {
        return $this->hashids->encode($value);
    }

    public function decodeHashids($value)
    {
        return $this->hashids->decode($value);
    }

}
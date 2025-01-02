<?php

namespace Rogerlopez13\Jwk;

class KeyHelper
{
    public static function getPrivate(string $pk, string $pass = null)
    {
        return openssl_pkey_get_private($pk, $pass);
    }

    public static function getPrivateDetails($key)
    {
        return openssl_pkey_get_details($key);
    }

    public static function safeUrlBase64Encode(string $string)
    {
        $encoded = base64_encode($string);
        $encoded = strtr($encoded, "+/", "-_");
        $encoded = rtrim($encoded, "=");
        return $encoded;
    }
}

<?php

namespace Rogerlopez13\Jwk;

class JWK
{
    /**
     * @param string $pk
     * @param string|null $pass
     * @return array
     */
    public static function fromPrivateKey(string $pk, string $pass = null)
    {
        $privateKey = new PrivateKey($pk, $pass);

        $values = [
            "n" =>  $privateKey->getN(),
            "e" =>  $privateKey->getE(),
            "d" =>  $privateKey->getD(),
            "p" =>  $privateKey->getP(),
            "q" =>  $privateKey->getQ(),
            "dp" => $privateKey->getDp(),
            "dq" => $privateKey->getDq(),
            "qi" => $privateKey->getQi()
        ];

        foreach ($values as $key => $value) {
            $values[$key] = KeyHelper::safeUrlBase64Encode($value);
        }

        $values["kty"] = "RSA";

        return $values;
    }
}

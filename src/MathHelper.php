<?php

namespace Rogerlopez13\Jwk;

use phpseclib3\Math\BigInteger;

class MathHelper
{
    public static function modulo(BigInteger $num1, BigInteger $num2)
    {
        list($quotient, $remainder) = $num1->divide($num2);
        return $remainder;
    }
}

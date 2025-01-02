<?php

namespace Rogerlopez13\Jwk;

use phpseclib3\Math\BigInteger;

class PrivateKey
{

    /**
     * @var string
     */
    private $value;

    /**
     * @var array
     */
    private $details;

    /**
     * @var string
     */
    private $n;

    /**
     * @var string
     */
    private $e;

    /**
     * @var string
     */
    private $d;

    /**
     * @var string
     */
    private $p;

    /**
     * @var string
     */
    private $q;

    /**
     * @var string
     */
    private $dp;

    /**
     * @var string
     */
    private $dq;

    /**
     * @var string
     */
    private $qi;

    public function __construct(
        string $pk,
        string $passphrase = null
    ) {
        $this->value = $pk;
        $privateKey = KeyHelper::getPrivate($this->value, $passphrase);
        $this->details = KeyHelper::getPrivateDetails($privateKey);
        $this->calculate();
    }

    public function getN()
    {
        if (!$this->n) {
            $this->n = $this->details["rsa"]["n"];
        }

        return $this->n;
    }

    public function getE()
    {
        if (!$this->e) {
            $this->e = $this->details["rsa"]["e"];
        }

        return $this->e;
    }

    public function getD()
    {
        if (!$this->d) {
            $this->d = $this->details["rsa"]["d"];
        }

        return $this->d;
    }

    public function getP()
    {
        if (!$this->p) {
            $this->p = $this->details["rsa"]["p"];
        }

        return $this->p;
    }

    public function getQ()
    {
        if (!$this->q) {
            $this->q = $this->details["rsa"]["q"];
        }

        return $this->q;
    }

    public function getDp()
    {
        return $this->dp;
    }

    public function getDq()
    {
        return $this->dq;
    }

    public function getQi()
    {
        return $this->qi;
    }

    private function calculate()
    {
        $dBigInt = new BigInteger($this->getD(), 256);
        $pBigInt = new BigInteger($this->getP(), 256);
        $qBigInt = new BigInteger($this->getQ(), 256);
        $one = new BigInteger(1);

        $this->dp = MathHelper::modulo($dBigInt, $pBigInt->subtract($one))->toBytes();
        $this->dq = MathHelper::modulo($dBigInt, $qBigInt->subtract($one))->toBytes();
        $this->qi = $qBigInt->powMod($one->negate(), $pBigInt)->toBytes();
    }
}

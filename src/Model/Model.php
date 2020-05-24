<?php

namespace PHPCAEP\Model;

/**
 * Class Model
 * @package PHPCAEP\Model
 */
class Model
{
    private string $uid;

    public function __construct()
    {
        $this->uid = $this->generateUid();
    }

    private function generateUid(): string
    {
        $microTime = microtime();
        $prefix = static::class . $microTime;
        return sha1(uniqid($prefix, true));
    }

    public function getUid(): string
    {
        return $this->uid;
    }
}

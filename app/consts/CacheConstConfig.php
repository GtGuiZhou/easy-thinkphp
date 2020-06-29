<?php


namespace app\consts;


class CacheConstConfig
{
    private $key;
    private $expire;

    public function __construct($key,$expire = null)
    {
        $this->key = $key;
        $this->expire = $expire;
    }

    public function getKey()
    {
        return $this->key;
    }

    public function getExpire()
    {
        return $this->expire;
    }
}
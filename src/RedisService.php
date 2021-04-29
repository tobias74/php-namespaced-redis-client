<?php

namespace PhpNamespacedRedisClient;

class RedisService
{
    public function __call($methodName, $args)
    {
        call_user_func_array(array($this->getRedisClient(), $methodName), $args);
    }

    public function __construct()
    {
    }

    public function setRedisClient($val)
    {
        $this->redisClient = $val;
    }

    protected function getRedisClient()
    {
        return $this->redisClient;
    }

    public function setNamespace($val)
    {
        $this->myNamespace = $val;
    }

    protected function getNamespace()
    {
        return $this->myNamespace;
    }

    protected function prefixWithNamespace($string)
    {
        return $this->getNamespace().'_'.$this->getNamespace().'_'.$string;
    }

    public function get($key)
    {
        $prefixedKey = $this->prefixWithNamespace($key);

        return $this->getRedisClient()->get($prefixedKey);
    }

    public function set($key, $value)
    {
        $prefixedKey = $this->prefixWithNamespace($key);

        return $this->getRedisClient()->set($prefixedKey, $value);
    }

    public function exists($key)
    {
        $prefixedKey = $this->prefixWithNamespace($key);

        return $this->getRedisClient()->exists($prefixedKey);
    }
}

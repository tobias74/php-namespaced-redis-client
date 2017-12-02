<?php
namespace PhpNamespacedRedisClient;

class RedisService
{
  public function __call($methodName, $args) {
    call_user_func_array(array($this->getRedisClient(), $methodName), $args);
  }
  
  public function __construct($val)
  {
    $this->myNamespace = $val;
  }
  
  public function setRedisClient($val)
  {
    $this->redisClient = $val;
  }
  
  protected function getRedisClient()
  {
    return $this->redisClient;
  }
  
  
  public function setPrefix($val)
  {
    $this->prefix = $val;  
  }
  
  protected function getPrefix()
  {
    return $this->prefix;  
  }
  
  protected function getNamespace()
  {
    return $this->myNamespace;
  }
  
  protected function prefixAndNamespace($string)
  {
    return $this->getPrefix().'_'.$this->getNamespace().'_'.$string;  
  }
  
  public function get($key)
  {
    $prefixedKey = $this->prefixAndNamespace($key);
    return $this->getRedisClient()->get($prefixedKey);
  }

  public function set($key, $value)
  {
    $prefixedKey = $this->prefixAndNamespace($key);
    return $this->getRedisClient()->set($prefixedKey, $value);
  }
  
  public function exists($key)
  {
    $prefixedKey = $this->prefixAndNamespace($key);
    return $this->getRedisClient()->exists($prefixedKey);
  }
  
  
}

<?php
/**
 * User: Nine
 * Date: 2017/9/4
 * Time: 下午9:29
 */

namespace dd;

use ReflectionClass;
use ReflectionMethod;
use Exception;

/**
 * Class Handle
 * @package dd
 */
class Dump
{
    /**
     * @var
     */
    protected static $_instance;

    /**
     * @var string
     */
    protected $_head = 'Dump';

    /**
     * @var string
     */
    protected $_namespace = "dd\\render\\";

    /**
     * @var string
     */
    protected $_abstract = "AbstractDump";

    /**
     * @var string
     */
    protected $_method = "render";

    /**
     * @param $value
     * @throws Exception
     */
    protected function parse($value)
    {
        $class = $this->_namespace . $this->_head . ucfirst(gettype($value));
        if (!class_exists($class)) {
            throw new Exception("$class is not exists");
        }
        $flectionClass = new ReflectionClass($class);
        if (!$flectionClass->isSubclassOf($this->_namespace . $this->_abstract)) {
            throw new Exception("$class must extends $this->_namespace" . $this->_abstract);
        }
        if (!$flectionClass->hasMethod($this->_method)) {
            throw new Exception("$class must has method render");
        }
//        todo 如果方法以后有不同的参数的需求，可以调用getParameters()来判断获取参数
        $flectionMethod = new ReflectionMethod($class, $this->_method);
        $flectionMethod->invokeArgs($flectionClass->newInstance($value), []);
    }

    /**
     * @param $value
     */
    static public function dump($value)
    {
        if (is_null(static::$_instance)) {
            static::$_instance = new static();
        }
        static::$_instance->parse($value);
    }
}
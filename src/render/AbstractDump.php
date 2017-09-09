<?php
/**
 * User: Nine
 * Date: 2017/9/4
 * Time: 下午9:24
 */

namespace dd\render;

use dd\decorator\DecoratorComponent;
use ReflectionClass;

/**
 * Class AbstractDump
 * @package dd\render
 */
abstract class AbstractDump
{
    /**
     * @var
     */
    public $value;

    /**
     * DumpString constructor.
     * @param $value
     */
    public function __construct($value)
    {
        $this->value = $value;
    }

    /**
     * @var array
     */
    protected $_decorator = [];

    /**
     * @param $decorator
     * @return \dd\decorator\DecoratorComponent
     */
    public function __get($decorator)
    {
        array_key_exists($decorator, $this->_decorator) ?: $this->_decorator[$decorator] = $this->withObject("dd\\decorator\\" . ucfirst($decorator), $this);
        return $this->_decorator[$decorator];
    }

    /**
     * 为方便层层包裹
     * @param $decorator
     * @param $arguments
     * @return \dd\decorator\DecoratorComponent
     */
    public function __call($decorator, $arguments)
    {
        array_key_exists($decorator, $this->_decorator) ?: $this->_decorator[$decorator] = $this->withObject("dd\\decorator\\" . ucfirst($decorator), array_pop($arguments));
        return $this->_decorator[$decorator];
    }

    /**
     * @param $class
     * @param null $arguments
     * @return mixed
     */
    protected function withObject($class, $arguments = null)
    {
        return is_null($arguments) ? new $class : new $class($arguments);
    }

    abstract public function render();
}
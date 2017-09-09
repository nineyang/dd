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
     * @param $type
     * @param array $classArr
     * @param array $params
     * @param string $value
     * @return mixed
     */
    public function returnValue($type, $classArr = [], $value = '', $params = [])
    {
        return ($this->returnDecorator($type, $classArr, $value, $params))->value;
    }

    /**
     * @param $type
     * @param array $classArr
     * @param array $params
     * @param string $value
     * @return mixed
     */
    protected function returnDecorator($type, $classArr = [], $value = '', $params = [])
    {
        $decorator = $this->{$type}($value ?: $this->value);
        if (!empty($classArr)) {
            foreach ($classArr as $class) {
                $decorator->addClass($class);
            }
        }
//        因为是单例，所以这里的value需要重新修改一下
        $decorator->value = $value;
        return $decorator->addDecorator($params);
    }

    /**
     * @param $type
     * @param array $classArr
     * @param string $value
     * @param array $params
     */
    public function display($value, $type = null, $classArr = [], $params = [])
    {
        if (is_null($type)) {
            echo $value;
            die();
        }
        if (is_array($value)) {
            $value = implode('', $value);
        }
        echo ($this->returnDecorator($type, $classArr, $value, $params))->display();
        die();
    }

    /**
     * @param $decorator
     * @return \dd\decorator\DecoratorComponent
     */
    public function __get($decorator)
    {
        array_key_exists($decorator, $this->_decorator) ?: $this->_decorator[$decorator] = $this->withObject("dd\\decorator\\" . ucfirst($decorator), $this->value);
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
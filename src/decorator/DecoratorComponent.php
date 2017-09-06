<?php
/**
 * User: Nine
 * Date: 2017/9/6
 * Time: 下午12:46
 */

namespace dd\decorator;

use dd\render\AbstractDump;

/**
 * Class DecoratorComponent
 * @package dd\decorator
 */
abstract class DecoratorComponent
{
    /**
     * @var string
     */
    protected $_head;

    /**
     * @var string
     */
    protected $_tail;

    /**
     * @var array
     */
    public $classList = [];

    /**
     * @var AbstractDump
     */
    public $dump;

    /**
     * DecoratorComponent constructor.
     * @param AbstractDump $dump
     */
    public function __construct(AbstractDump $dump)
    {
        $this->dump = $dump;
        $this->initStyle();
    }

    /**
     * 初始化css
     */
    protected function initStyle()
    {
        $config = require_once __DIR__ . '/../conf/css.php';
        $styleStr = "<style>";
        if (!empty($config)) {
            foreach ($config as $k => $v) {
                $styleStr .= $k . "{" . $v . "}";
            }
            $styleStr .= "</style>";
        }
        echo $styleStr;
    }

    /**
     * 添加样式
     * @param $className
     * @return $this
     */
    public function addClass($className)
    {
        array_push($this->classList, $className);
        return $this;
    }

    /**
     * 添加css并转发给display
     * @return mixed
     */
    public function show()
    {
//        设置tag
        $parts = explode("\\", static::class);
        $class = strtolower(array_pop($parts));
//        设置class
        $classStr = implode(' ', $this->classList);
        $this->_head = "<" . $class . " class='$classStr'>";
        $this->_tail = "</" . $class . ">";
        return static::display();
    }

    /**
     * @param $value
     * @return string
     */
    public function withQuota($value)
    {
        return '"' . $value . '"';
    }

    /**
     * @param $value
     * @return string
     */
    public function noWrap($value)
    {
        return $this->_head . $value . $this->_tail;
    }

    /**
     * @return mixed
     */
    abstract public function display();
}
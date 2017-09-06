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
     * @var AbstractDump
     */
    public $dump;

    /**
     * DecoratorComponent constructor.
     * @param AbstractDump $dump
     */
    public function __construct(AbstractDump $dump)
    {
        $parts = explode("\\", static::class);
        $class = strtolower(array_pop($parts));
        $this->_head = "<" . $class . ">";
        $this->_tail = "</" . $class . ">";
        $this->dump = $dump;
    }

    abstract public function display();
}
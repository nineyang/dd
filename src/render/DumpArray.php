<?php
/**
 * User: Nine
 * Date: 2017/9/4
 * Time: 下午9:26
 */

namespace dd\render;

/**
 * Class DumpArray
 * @package dd\render
 */
class DumpArray extends AbstractDump
{
    /**
     * @var array
     */
    public $_stack;

    /**
     * DumpArray constructor.
     * @param $value
     */
    public function __construct($value)
    {
        parent::__construct($value);
    }

    /**
     *
     */
    public function render()
    {
        $this->display($this->parseArr($this->value));
    }
}
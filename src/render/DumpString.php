<?php
/**
 * User: Nine
 * Date: 2017/9/4
 * Time: 下午9:23
 */

namespace dd\render;

use dd\decorator\Span;

/**
 * Class DumpString
 * @package dd\render
 */
class DumpString extends AbstractDump
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

    public function render()
    {
        $decorator = new Span($this);
        $decorator->display();
    }
}
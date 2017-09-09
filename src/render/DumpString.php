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
     *
     */
    public function render()
    {
        $this->p($this->span($this)->addClass('nine-span')->addDecorator())->addDecorator()->display();
    }
}
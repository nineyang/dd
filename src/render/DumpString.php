<?php
/**
 * User: Nine
 * Date: 2017/9/4
 * Time: 下午9:23
 */

namespace dd\render;

/**
 * Class DumpString
 * @package dd\render
 */
class DumpString extends AbstractDump
{
    public function render($value)
    {
        var_dump($value);
    }
}
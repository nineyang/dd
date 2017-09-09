<?php
/**
 * User: Nine
 * Date: 2017/9/4
 * Time: 下午9:27
 */

namespace dd\render;

use Closure;

/**
 * Class DumpObject
 * @package dd\render
 */
class DumpObject extends AbstractDump
{
    public function render()
    {
//        判断是函数还是对象
        if ($this->value instanceof Closure) {

        } else {

        }
    }

}
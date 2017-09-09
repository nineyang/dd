<?php
/**
 * User: Nine
 * Date: 2017/9/4
 * Time: 下午9:27
 */

namespace dd\render;

use Closure;
use ReflectionClass;
use ReflectionFunction;

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
            $this->renderClosure();
        } else {
            $this->renderObject();
        }
    }

    /**
     * render 函数
     */
    protected function renderClosure()
    {
        $reflectionFunc = new ReflectionFunction($this->value);
        $renderParams = $this->parseArr(
            $this->parseParams(
                $reflectionFunc->getParameters()
            ),
            5
        );
        $title = $this->returnValue('Closure', 'span', ['nine-span'], ['withQuota' => false]);
        $this->display(
            [
                $title,
                $this->_leftBraces . "</br>",
                $this->_spaceOne,
                $this->returnValue('params', 'span', ['nine-span'], ['withQuota' => false]),
                $this->_needle,
                implode('', $renderParams) . "</br>",
                $this->_rightBraces
            ]
        );
    }

    /**
     * render 对象
     */
    protected function renderObject()
    {

    }


}
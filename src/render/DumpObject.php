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

    protected function renderClosure()
    {
        $reflectionFunc = new ReflectionFunction($this->value);
        $renderParams = $this->parseParams($reflectionFunc->getParameters());

    }

    protected function renderObject()
    {

    }


    protected function parseParams(Array $params)
    {
        $renderParams = [];
        if (!empty($params)) {
            foreach ($params as $param) {
                if ($param->isDefaultValueAvailable()) {
                    $default = $param->getDefaultValue();
                    var_dump($default);
                } else {
                    var_dump($param, $param->getClass());
                }
            }
        }

    }

}
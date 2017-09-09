<?php
/**
 * User: Nine
 * Date: 2017/9/9
 * Time: 下午15:47
 */

namespace dd\decorator;

/**
 * Class Div
 * @package dd\decorator
 */
class Div extends DecoratorComponent
{

    /**
     * @return $this
     */
    public function wrap()
    {
        $this->value = $this->noWrap($this->value);
        return $this;
    }

    /**
     *
     */
    public function display()
    {
        echo $this->value;
    }
}
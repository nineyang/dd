<?php
/**
 * User: Nine
 * Date: 2017/9/6
 * Time: 下午12:47
 */

namespace dd\decorator;

/**
 * Class P
 * @package dd\decorator
 */
class P extends DecoratorComponent
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
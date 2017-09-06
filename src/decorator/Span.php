<?php
/**
 * User: Nine
 * Date: 2017/9/6
 * Time: 下午12:47
 */

namespace dd\decorator;

/**
 * Class Span
 * @package dd\decorator
 */
class Span extends DecoratorComponent
{

    /**
     * @return $this
     */
    public function wrap()
    {
        $this->value = $this->withQuota($this->noWrap($this->dump->value));
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
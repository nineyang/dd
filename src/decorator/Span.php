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

    public function display()
    {
        echo "<style>.test{color:red;}</style>";
        echo $this->_head . $this->dump->value . $this->_tail;
    }
}
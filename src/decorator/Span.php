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
     * @param array $params
     * @return $this
     */
    public function wrap(Array $params = [])
    {
        $params = empty($params) ? $params : array_pop($params);
        $this->value = (array_key_exists('withQuota', $params) && !$params['withQuota']) ? $this->noWrap($this->value) : $this->withQuota($this->noWrap($this->value));
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
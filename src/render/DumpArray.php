<?php
/**
 * User: Nine
 * Date: 2017/9/4
 * Time: 下午9:26
 */

namespace dd\render;


/**
 * Class DumpArray
 * @package dd\render
 */
class DumpArray extends AbstractDump
{
    /**
     * @var array
     */
    public $_stack;

    /**
     * DumpArray constructor.
     * @param $value
     */
    public function __construct($value)
    {
        parent::__construct($value);
        $this->_stack = [];
    }

    public function render()
    {
        $this->parseArr($this->value);
        $this->display($this->_stack);
    }

    protected function parseArr(array $arr, $depth = 1)
    {
//        首先导入array
        $this->_stack[] = $this->returnValue("array:" . count($arr), 'span', ['nine-span'], ['withQuota' => false]);
//        导入一个[
        $this->_stack[] = $this->_leftBracket;
//        导入一个▶
        $this->_stack[] = $this->_triangle;

        foreach ($arr as $key => $value) {
            if (is_array($value)) self::parseArr($value, ++$depth);
//            拼接key和value
            $key = $this->returnValue($key, 'span', ['nine-span'], ['withQuota' => is_int($key) ? false : true]);
            $value = $this->returnValue($value);
            $pushValue = $key . $this->_needle . $value;
//            外层包裹一个p
            array_push($this->_stack, $this->returnValue($pushValue, 'p' , ["depth-$depth"]));
        }
//        导入一个]
        $this->_stack[] = $this->_rightBracket;
    }
}
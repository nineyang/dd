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
    }

    public function render()
    {
        $this->display($this->parseArr($this->value));
    }

    protected function parseArr(array $arr, $depth = 1)
    {
//        首先导入array
        $returnArr = [];
        $returnArr[] = $this->returnValue("array:" . count($arr), 'span', ['nine-span'], ['withQuota' => false]);
//        导入一个[
        $returnArr[] = $this->_leftBracket;
//        导入一个▶
        $returnArr[] = $this->_triangle;
        $pushValue = "";
        foreach ($arr as $key => $value) {
            //            拼接key和value
            $key = $this->returnValue($key, 'span', ['nine-span'], ['withQuota' => is_int($key) ? false : true]);
            if (is_array($value)) {
                $value = $this->returnValue(self::parseArr($value, $depth + 1));
            } else {
                $value = $this->returnValue($value);
            }
            $pushValue .= $key . $this->_needle . $value . "</br>";
        }
        //            外层包裹一个p
        $returnArr[] = $this->returnValue($pushValue, 'p', ["depth-" . $depth]);
        $devideSpan = $this->returnValue("", 'span', ["depth-" . ($depth - 1)], ['withQuota' => false]);
        $returnArr[] = $devideSpan . $this->_rightBracket;
        return $returnArr;
    }
}
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
     * @var
     */
    public $_title;

    /**
     * @var
     */
    public $_leftBracket;

    /**
     * @var
     */
    public $_rightBracket;

    /**
     * DumpArray constructor.
     * @param $value
     */
    public function __construct($value)
    {
        parent::__construct($value);
        $this->_title = $this->returnValue('span' , ['nine-span'] , "array:" . count($this->value));
        $this->_leftBracket = $this->returnValue('span' , ['nine-span' , 'black-color'] , "[");
        $this->_rightBracket = $this->returnValue('span' , ['nine-span' , 'black-color'] , "]");

        $this->display($this->_leftBracket);

    }

    public function render()
    {

    }
}
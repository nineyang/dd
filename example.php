<?php
/**
 * User: Nine
 * Date: 2017/9/4
 * Time: 下午9:35
 */

namespace dd;

require 'vendor/autoload.php';

//string
//\dd\Dump::dump('hello,nine');

//array
//\dd\Dump::dump(['hello', 'world' => ['aa' , 'bb' => ['cc' , 'dd']]]);

//function
//\dd\Dump::dump(function ($name = 'nine' , Closure $closure) {
//    echo $name;
//});

//object
//\dd\Dump::dump(new stdClass());

class Student{
    public $name = 'nine';
    protected $age = 18;
    private $sex = 'male';

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }
}


function dd($value)
{
    \dd\Dump::dump($value);
}

//dd("hello,nine");

//dd(function ($a = 'nine'){
//    echo $a;
//});

dd(new Student());


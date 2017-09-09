<?php
/**
 * User: Nine
 * Date: 2017/9/4
 * Time: 下午9:35
 */

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


function dd($value)
{
    \dd\Dump::dump($value);
}

dd("hello,nine");

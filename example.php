<?php
/**
 * User: Nine
 * Date: 2017/9/4
 * Time: 下午9:35
 */

require 'vendor/autoload.php';

//string
//\dd\Dump::dump('helloworld');

//array
//\dd\Dump::dump(['hello', 'world' => ['aa' , 'bb' => ['cc' , 'dd']]]);

//function
\dd\Dump::dump(function ($name = 'nine') {
    echo $name;
});

//object
//\dd\Dump::dump(new stdClass());

## 介绍
`Laravel`有一个非常方便的`dd`函数可以帮助我们更好的展示信息，不过输出对象时，没办法显示具体的类文件，也没有展示其方法。
但是`Laravel`的`dd`函数设计的毕竟复杂，所以我就自己写了一个这样的包。

## 安装
1. composer 安装()
```
composer require nine/dd 
```

2. 直接下载
clone 下来即可。

## 使用

1. 如果我在[exapmle.php](/example.php)中所写，我们既可以直接使用:
```php
\dd\Dump::dump('hello,nine');
```
同时也可以自己封装一个`dd`函数:
```php
function dd($value)
{
    \dd\Dump::dump($value);
}

dd("hello,nine");
```

不管是哪种方式，他都会自动的识别我们的类型来予以不同的展示效果。

2. `decorator`是一个装饰器层，用来装饰我们的效果。他可以实现一层一层的包装，就像我们用`div`标签来包裹住`span`标签一样。

3. 此外，如果需要自己单独配置样式和新增装饰符号，可以在[conf](/src/conf)目录下根据所给的注释予以添加。


## 效果
1. string

![Aaron Swartz](/tmp/string.png)

2. array

![Aaron Swartz](/tmp/array.png)

3. function

![Aaron Swartz](/tmp/function.png)

4. object(todo)

![Aaron Swartz](/tmp/function.png)
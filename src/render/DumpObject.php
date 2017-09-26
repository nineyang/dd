<?php
/**
 * User: Nine
 * Date: 2017/9/4
 * Time: 下午9:27
 */

namespace dd\render;

use Closure;
use function dd\dd;
use ReflectionFunction;
use ReflectionObject;

/**
 * Class DumpObject
 * @package dd\render
 */
class DumpObject extends AbstractDump
{
    /**
     * @var array
     */
    protected $_numMap = ['Zero', 'One', 'Two', 'Three', 'Four', 'Five'];

    /**
     *
     */
    public function render()
    {
//        判断是函数还是对象
        if ($this->value instanceof Closure) {
            $this->renderClosure();
        } else {
            $this->renderObject();
        }
    }

    /**
     * render 函数
     */
    protected function renderClosure()
    {
        $this->display($this->getFunc());
    }

    /**
     * 共同的闭包组件
     * @param string $value
     * @param string $title
     * @param int $depth
     * @return array
     */
    protected function getFunc($value = '', $title = 'Closure', $depth = 0)
    {
        $reflectionFunc = new ReflectionFunction($value ?: $this->value);
        $renderParams = $this->parseArr(
            $this->parseParams(
                $reflectionFunc->getParameters()
            ),
            5
        );
        $title = $this->returnValue($title, 'span', ['nine-span'], ['withQuota' => false]);
        return [
            $title,
            $this->_leftBraces . "</br>",
            $this->_spaceOne,
            $this->{"_space" . $this->_numMap[$depth]} . $this->returnValue('params', 'span', ['nine-span'], ['withQuota' => false]),
            $this->_needle,
            implode('', $renderParams) . "</br>",
            $this->{"_space" . $this->_numMap[$depth]} . $this->_rightBraces
        ];
    }

    /**
     * render 对象
     */
    protected function renderObject()
    {
        $reflectionObject = new ReflectionObject($this->value);
        $defaultProperties = $reflectionObject->getDefaultProperties();
        $properties = $reflectionObject->getProperties();
        $renderProperties = [];
//        属性
        if (!empty($properties)) {
            foreach ($properties as $property) {
                $scope = $this->returnValue(
                    ($property->isPublic() ? "+" : ($property->isProtected() ? "#" : "-")),
                    'span',
                    ['nine-span', 'depth-1'],
                    ['withQuota' => false]
                );
                $name = $scope . $this->returnValue($property->name, 'span', ['nine-span', 'font-15'], ['withQuota' => false]);
//                先获取设置的值
                $property->setAccessible(true);
                if ($currValue = $property->getValue($this->value)) {
                    $default = $currValue;
//                再获取默认值
                } elseif (isset($defaultProperties[$property->name])) {
                    $default = $defaultProperties[$property->name];
                } else {
                    $default = '';
                }
                $default = $this->_spaceOne .
                    $this->returnValue(
                        $default,
                        'span',
                        ['nine-span', 'gray-color'],
                        ['withQuota' => false]
                    );
                $renderProperties[] = $name . $default . "</br>";
            }
        }
//        方法
        $methods = $reflectionObject->getMethods();
        $renderMethods = [];
        if (!empty($methods)) {
            foreach ($methods as $method) {
                $scope = $this->returnValue(
                    ($method->isPublic() ? "+" : ($method->isProtected() ? "#" : "-")),
                    'span',
                    ['nine-span', 'depth-1'],
                    ['withQuota' => false]
                );
//                获取一个闭包，来使用共同的getFunc组件
                $renderMethods[] = $scope . implode('', $this->getFunc($method->getClosure($this->value), $method->name, 1)) . "</br>";
            }
        }
        $this->display(
            [
                $this->returnValue($reflectionObject->name, 'span', ['nine-span'], ['withQuota' => false]),
                $this->_leftBraces . "</br>",
                implode("", array_merge($renderProperties, $renderMethods)),
                $this->_rightBraces
            ]
        );
    }


}
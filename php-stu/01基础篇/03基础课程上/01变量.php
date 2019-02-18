<?php
echo 2222;
$a = 1;
$b = 1;
$c = $a + $b;
echo "<br>";
echo $c;
echo "<br>";
unset($c);
var_dump(isset($c));
/**
 * 不用数字或特殊字符开头，用字母或下划线开头，驼峰命名法，等号两边空格尽量加
*/
/**
 * var_dump() 函数返回 变量 的数据类型和值：
 * isset();判断一个 变量 是否存在
 * unset(); 销毁 变量
 */
?>
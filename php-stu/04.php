<?php 
$x=5; // 全局变量

function myTest() 
{ 
    $y=10; // 局部变量
    global $x; //如果要在一个函数中访问一个全局变量，需要使用 global 关键字
    echo "<p>测试函数内变量:<p>"; 
    echo "变量 x 为: $x"; 
    echo "<br>"; 
    echo "变量 y 为: $y"; 
}  

myTest(); 

echo "<p>测试函数外变量:<p>"; 
echo "变量 x 为: $x"; 
echo "<br>"; 
echo "变量 y 为: $y"; 
?> 
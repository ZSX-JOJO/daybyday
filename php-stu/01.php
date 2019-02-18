<?php
$a=5;
$b=3;
function t(){
    echo $a-$b; // 输出 0
    //函数内访问全局变量需要 global 关键字或者使用 $GLOBALS[index] 数组
    //在 php 中函数是有独立的作用域，所以局部变量会覆盖全局变量，即使局部变量中没有全局变量相同的变量，也会被
}
t();
echo '<br>';
function t1(){  
    global $a,$b;
    echo $a-$b;  // 输出 2
}
t1();
echo '<br>';
function t2(){
    // echo $GLOBALS['a'] - $GLOBAlS['b'];
    echo $GLOBALS['a']-$GLOBALS['b'];  // 输出 2
}
t2();
echo '<br>';
print "<h2>PHP 很有趣!</h2>";//字符串可以包含 HTML 标签
print "Hello world!<br>";
print "我要学习 PHP!";
echo '<br>';
$name="runoob";
$a= <<<EOF
    "abc"$name
    "123"
EOF;
$b = <<<ZSX
    "ZSXZSX"
ZSX;
// 结束需要独立一行且前后不能空格
echo $a;
echo "<br>";
echo $b;
/**
 * PHP定界符
 * 1 以 <<<EOF 开始标记开始，以 EOF 结束标记结束，结束标记必须顶头写，不能有缩进和空格，且在结束标记末尾要有分号 。
 * 2 开始标记和结束标记相同，比如常用大写的 EOT、EOD、EOF 来表示，但是不只限于那几个(也可以用：JSON、HTML等)，
 *   只要保证开始标记和结束标记不在正文中出现即可
 * 3 
*/
echo "<br>";
$name2="变量会被解析";
$abc=<<<EOF
$name2<br>
<a style="color:red">html格式会被解析</a><br/>
双引号和Html格式外的其他内容都不会被解析
"双引号外所有被排列好的格式都会被保留"
"但是双引号内会保留转义符的转义效果,比如table:\t和换行：\n下一行"
EOF;
echo $abc;
echo "<br>";
// var_dump() 函数返回变量的数据类型和值：
$x1 = 5985;
var_dump($x1);
echo "<br>"; 
$x2 = -345; // 负数 
var_dump($x2);
echo "<br>"; 
$x3 = 0x8C; // 十六进制数
var_dump($x3);
echo "<br>";
$x4 = 047; // 八进制数
var_dump($x4);
echo "<br>";
$cars=array("Volvo","BMW","Toyota");
var_dump($cars);
phpinfo();
?> 
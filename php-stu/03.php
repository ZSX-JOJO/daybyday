<?php
function myTest(){
    //static 作用域
    static $x=0;
    echo $x;
    $x++;
}
 
myTest();
myTest();
myTest();
echo "<br>";
function myTest2(){
    $x=0;
    echo $x;
    $x++;
}
myTest2();
myTest2();
myTest2();
?>
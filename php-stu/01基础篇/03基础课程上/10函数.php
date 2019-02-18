<?php
    /**函数可以有返回值也可以没有返回值，如果想返回的话使用return关键字
     * 函数的调用和定义顺序没有关系，与变量不同
     * 函数可以多次调用
     */
    test('赵守鑫','男');
    function test($name,$sex){
        echo '我是:'.$name.' '.'性别:'.$sex;
    }
    echo '<br>';
    echo '<hr>';
    /**
     * 
     */
    
    function say($name = 'zsx',$age  = 27,$sex = '男'){
        echo '<td>'.'姓名:'.$name.'</td>';
        echo '<td>'.'年龄:'.$age.'</td>';
        echo '<td>'.'性别:'.$sex.'</td>';
        // return 1;//返回值默认不输出，若要输出 可以在调用函数时添加echo  
    }
    echo '<table height = "100" height = "200" border = "1" borderColor = "red">';
    say('赵守鑫');
    echo '</table>';
    
    /**
     * 
     */
    $zsx = 'zsxzsx';//全局变量
    function say2(){
        $zsx2 = 'zsxzsx2';//局部变量
        echo $zsx;//报错
        echo $zsx2;//输出zsxzsx2
    }
    say2();
    echo '<br>';
    /**
     * 【作用域】
     *      一个变量的作用的范围，或者叫做生命周期
     *      【内部变量】
     *          函数体内部声明的变量，内部变量的作用域只在函数体内生效
     *          程序执行完之后自动销毁(垃圾回收机制)
     *      【外部变量】
     *          函数体外声明的变量，不能在函数体内使用
     *          函数体外的变量名字可以和函数体内的变量名字相同（不建议此种写法）
     *      【超全局变量】
     *          $_GET $_POST $_FILES $_COOKIE $_SESSION $GLOBALS
     *      【静态变量】
     *          这个变量只会初始化一次 在运行的时候它会记录上一次的值 static变量不会销毁
     */
    function say3(){
        $_GET;
        $_POST;
    }
    say3();

    function sum(){
        $num = 1;
        $num++;
        echo $num;
    }
    sum();
    sum();
    sum();
    sum();
    echo '<br>';
    function sum2(){
        static $num = 1;//静态变量
        $num++;
        echo $num;
    }
    sum2();
    sum2();
    sum2();
    sum2();
    echo '<br>';
    /**
     * 类型约束
     */
    // function sum3($num1,$num2){
    function sum3(int $num1,int $num2){//对形参进行 类型约束
        echo getType($num1).'<br>';
        echo getType($num2).'<br>';
        return $num1 + $num2;
    }
    // var_dump(sum3('1','2'));
    var_dump(sum3('1','2'));
    echo '<br>';
    function sum4($num1,$num2):string//对返回值进行 类型约束
    {
        return $num1 + $num2;
    }
    var_dump(sum4(1,2));
    echo '<br>';

    function sum5(...$arr){//此处类比 ES6  ...$arr把数组里面的值 一一赋值给形参
        var_dump($arr);
    }
    sum5('test','a','b','123');
    echo '<br>';

    function sum6($a,$b,$c,$d){
        var_dump($a,$b,$c,$d);
    }
    $shuzu = ['123',1,2,3];
    sum6(...$shuzu);//sum6($shuzu)这种写法会报错
    echo '<br>';

    /**
     * 匿名函数
     */
    $noName = function(){
        echo '匿名函数';
    };
    $noName();
?>
<?php
    ini_set('display_errors',1);            //错误信息
    ini_set('display_startup_errors',1);    //php启动错误信息
    error_reporting(-1);                    //打印出所有的 错误信息
    // ini_set('error_log', dirname(__FILE__) . '/error_log.txt'); //将出错信息输出到一个文本文件
    define('ZSX','赵守鑫');//define用来定义一个常量[这个常量必须是标量,php7中可以是array 为啥我这里报错？？？],常量也是全局范围的。不用管作用域就可以在脚本的任何地方访问
    echo ZSX.'<br>';
    // echo 'testZSX';
    echo '<br>';
    define('qwer','true');//隐式类型转换 为什么不显示 1 ?
    echo qwer;
    echo '<br>';
    /**
     * defined用来检测常量有没有被定义,
     * 若常量存在，则返回 true，否则返回 false
     */
    if(defined(ZSX)){
        echo 'true';
    }else{
        echo 'false';
    }
    echo '<br>';
    echo __FILE__.'<br>';//获取当前文件的名字
    echo __LINE__.'<br>';//获取当前代码的行数
    echo PHP_VERSION.'<br>';//获取PHP当前版本
    echo PHP_OS.'<br>';//获取系统信息
    echo __DIR__.'<br>';//获取当前文件的路径
    function test(){
        echo __FUNCTION__;//获取函数名
    }
    test();
    echo '<br>';
    echo M_PI.'<br>';//圆周率
    
    echo __METHOD__.'<br>';//获取当前成员方法名
    echo __NAMESPACE__.'<br>';//获取当前命名空间的名字
    echo __CLASS__.'<br>';//获取当前类名
    echo __TRAIT__.'<br>';//获取当前TRAIT名字(多继承)
?>
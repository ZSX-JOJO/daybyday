<?php
    /** 
     * index.php?m=index&a=index
     * index.php?m=index&a=demo
    */
    class Psr4AutoLoad{
        function __construct(){
            spl_autoload_register([$this,'autoload']);//注册给定的函数作为 __autoload 的实现
        }
        function autoload($className){
            // echo $className;
            //根据类名找到文件全路径 并且include进来
            $filePath = str_replace('\\','/',$className).'.php';//str_replace(search,replace,subject)
            // echo $filePath;
            include $filePath;
        }  
    }
    $Psr = new Psr4AutoLoad();
    //得到控制器名字 和 方法名
    $m = $_GET['m'];
    //完整的类名就是命名空间名再拼接类名  controller\IndexController
    $className = 'controller\\'.ucfirst(strtolower($m)).'Controller';
    //根据类名创建对象
    $obj = new $className();
    //得到方法名
    $a = $_GET['a'];
    //让对象去执行对应的方法
    call_user_func([$obj,$a]);//第一个参数是被调用的回调函数，其余参数是回调函数的参数
?>
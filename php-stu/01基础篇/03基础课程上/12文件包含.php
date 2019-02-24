<?php
    /**
     * include()即使报错 后续代码可以继续执行
     * require()报错后 后续代码不会继续执行
     */
    // include('12-1.php');
    // include('12-1.php');//不能重新定义

    // include_once('12-1.php');
    // echo '执行吗？';//执行
    // include_once('12-1.php');//不会报错 因为只包含了一次 
    // echo '执行吗？';//同样执行 

    // require_once('12-1.php');//正常运行 
    // require_once('12-1.php');//不会报错 因为只包含了一次 

    // include('3.php');echo '后续代码';
    // require('12-1.php');
    // require('12-1.php');//不能重新定义
    // require('3.php');echo '后续代码';
?>
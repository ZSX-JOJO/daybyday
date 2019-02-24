<?php 
    /**
     * 超全局数组
     * 
     * $_GET
     * $_POST
     * $_REQUEST
     * $_SERVER
     *      $_SERVER['REMOTE_ADDR'] 获取ip地址
     *      $_SERVER['HTTP_REFERER']上级来源地址
     * $_SESSION
     * $_COOKIE
     */
    // var_dump($_GET);//通过 URL 参数传递给当前脚本的变量的数组
    // var_dump($_POST);//
    var_dump($_REQUEST);//默认情况下包含了 $_GET，$_POST 和 $_COOKIE 的数组。
    echo '<hr>';
    // var_dump($_SERVER);
    //简单实现用户注册
    $username = $_GET['username'];
    $password = $_GET['password'];
    $user = '赵守鑫';
    $pass = '123';
    if($username == $user && $password == $pass){
        echo '登陆成功';
    }else{
        echo '登陆失败';
    }
?>
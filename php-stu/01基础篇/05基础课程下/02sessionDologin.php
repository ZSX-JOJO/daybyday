<?php 
    /**
     * 模拟 假定数据从"数据库"获取
     */
    session_start();
    $username = $_GET['username'];
    $password = $_GET['password'];
    if($username == 'zsx' && $password == 123){
        echo '登陆成功';
        $_SESSION['username'] = $username;
    }else{
        echo '登陆失败';
    }
?>
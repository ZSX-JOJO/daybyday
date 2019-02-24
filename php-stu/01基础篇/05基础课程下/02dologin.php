<?php 
    /**
     * 
     */
    $username =  'zsx';
    $password = '123';
    var_dump($_GET);
    if($username == $_GET['username'] && $password == $_GET['password']){
        setcookie('username',$username,time()+60*60,'/');
        echo '登录成功';
    }else{
        echo '登录失败';
    }
?>

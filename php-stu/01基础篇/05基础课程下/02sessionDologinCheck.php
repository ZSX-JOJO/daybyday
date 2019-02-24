<?php 
    session_start();
    if(empty($_SESSION['username'])){
        exit('没有登陆，无法查看下面信息');
    }else{
        echo '欢迎您:'.$_SESSION['username'];
    }
?>
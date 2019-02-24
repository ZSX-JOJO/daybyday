<?php
    /**
     * 
     */
    $patternUserName = '/^[0-9A-Za-z_]{3,18}/';
    if(!preg_match($patternUserName,$_POST['username'])){
        exit('用户名不合法');
    }
    if(!preg_match('/^[0-9A-Za-z.]+@[0-9A-Za-z.]+$/',$_POST['email'])){
        exit('邮箱不合法');
    }
    if(!preg_match('/^1[0-9]{10}$/',$_POST['phone'])){
        exit('手机号不合法');
    }
    if(!preg_match('/^[0-9A-Za-z._]{6,18}$/',$_POST['password'])){
        exit('密码不合法');
    }
    if($_POST['password'] != $_POST['re-password']){
        exit('密码必须一致');
    }
    echo '注册成功';
?>
<?php
    /**
     * cookie
     * 
     *      名字
     *      值
     *      过期时间
     *      path cookie路径 针对URL
     *      domain 域名 针对哪个域名生效
     * 
     * session 会话控制
     */
    // setcookie('username','zhao',time()+30);//可以设置过期时间
    // setcookie('username','zhao',time()-30);//删除cookie
    // var_dump($_COOKIE);//取出cookie

    // session_start();//开启session才可以使用 而且要结合cookie使用
    // $_SESSION['username'] = 'zhaoshouxin';
    // var_dump($_SESSION);

    //关于05.html
    session_start();
    $_SESSION['user'] = $_POST;
    var_dump($_SESSION);
?>
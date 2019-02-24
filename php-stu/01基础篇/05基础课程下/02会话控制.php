<?php
    /**
     * 会话控制
     *      cooki 存在于客户端
     *      session 存在于服务端
     */
    //setcookie(name,value,expire,path,domain,secure)
    setcookie('name','zhaoshouxin',time()+60,'/');
    var_dump($_COOKIE);
    // setcookie('name','',time()-1,'/');
?>
<?php
    /**
     * 
     */
    session_start();//使用session之前 必须开启！！！！
    $_SESSION['username'] = 'zsx';//存值
    $_SESSION['password'] = 123;
    session_destroy();//彻底销毁 session 具体查看02session2.php
    unset($_SESSION['username']);
    /**
     * unset() 函数用于释放指定的 session 变量
     * if(isset($_SESSION['views']))
     *   {
     *      unset($_SESSION['views']);
     *   }
     */
    var_dump($_SESSION);
?>
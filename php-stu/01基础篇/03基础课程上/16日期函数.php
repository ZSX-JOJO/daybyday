<?php 
    /**
     * 日期函数
     * 
     * 时间戳
     *      1970年1月1日 00:00:00 到 此时 所走的秒数
     * 
     */
    // echo time();
    $time = time();
    echo date('Y-m-d H:i:s',$time).'<hr>';

    //date_default_timezone_set() 设定用于一个脚本中所有日期时间函数的默认时区
    // date_default_timezone_set('PRC');//PRC 设置为中国时区 如此设置 只能当前页面生效 所有文件生效的话 需要修改php.ini配置文件
    $time = time();
    echo date('Y-m-d H:i:s').'<br>';
?>
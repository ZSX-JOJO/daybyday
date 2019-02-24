<?php 
    //1 连接数据库
    $link = mysqli_connect('localhost','root','123456');
    // var_dump($link);
    //2 判断是否连接成功
    if(!$link){
        exit('连接失败');//exit() 输出一个消息并且退出当前脚本
        // echo '连接失败'.'<br>';
        
    }else{
        echo '连接成功'.'<hr>';
    }
    //3 设置字符集
    mysqli_set_charset($link,'utf8');
    //4 选择数据库
    mysqli_select_db($link,'phpstu');//针对本次数据库连接用于数据库查询的默认数据库
    //5 准备SQL语句
    $sql = 'select * from user';
    //6 发送SQL语句
    $res = mysqli_query($link,$sql);//对数据库执行一次查询
    // var_dump($res);
    //7 处理结果集
    $result = mysqli_fetch_assoc($res);// 函数从结果集中取得 一行 作为关联数组 一个一个往下读 返回一个一维的关联数组!!!!
    var_dump($result);
    //关闭数据库(释放资源)
    mysqli_close($link);
?>
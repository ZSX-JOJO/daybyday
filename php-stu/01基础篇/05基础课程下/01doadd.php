<?php
    /**
     * 执行添加
     */
    echo '添加测试';
    // var_dump($_GET);
    echo '<hr>';
    //得到要添加的数据
    $username = $_GET['username'];
    $pass = md5($_GET['pass']);
    $sex = $_GET['sex'];
    $address = $_GET['address'];
    $age = $_GET['age'];
    //连接数据库
    $link = mysqli_connect('localhost','root','123456');
    if(!$link){
        exit('数据库连接失败');
    }
    mysqli_set_charset($link,'utf8');
    mysqli_select_db($link,'phpstu');
    $sql = "insert into  user(username,pass,sex,address,age) values('$username','$pass',$sex,'$address',$age)";
    echo $sql;
    $obj = mysqli_query($link,$sql);
    var_dump($obj);
    $id = mysqli_insert_id($link);//mysqli_insert_id() 返回最后一条插入语句产生的自增 ID;函数返回上一步 INSERT 操作产生的 ID
    if($id){
        echo '<a href="01userlist.php">添加成功</>';
    }else{
        echo '<a href="01add.php">添加失败</a>';
    }
    mysqli_close($link);//关闭数据库
?>
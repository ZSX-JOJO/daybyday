<?php
    // echo '执行修改';
    $id = $_GET['id'];
    $username = $_GET['username'];
    $pass = $_GET['pass'];
    $gid = $_GET['gid'];
    $sex = $_GET['sex'];
    $address = $_GET['address'];
    $age = $_GET['age'];
    // var_dump($id);
    // var_dump($_GET);
    //修改
    //update user set username = '赵四' where id = '2';
    //连接数据库
    $link = mysqli_connect('localhost','root','123456');
    if(!$link){
        exit('数据库连接失败');
    }
    mysqli_set_charset($link,'utf8');
    mysqli_select_db($link,'phpstu');
    $sql = "update user set username='$username',pass='$pass',address='$address',age='$age' where id=$id";
    // echo $sql;
    $obj = mysqli_query($link,$sql);
    if($obj && mysqli_affected_rows($link)){//mysqli_affected_rows() 函数返回前一次 MySQL 操作所影响的记录行数;取得最近一次与 link_identifier 关联的 INSERT，UPDATE 或 DELETE 查询所影响的记录行数
        echo '<a href="01userlist.php">修改成功</>';
    }else{
        echo '<a href="01update.php">修改失败</a>';
    }
    mysqli_close($link);//关闭数据库
?>
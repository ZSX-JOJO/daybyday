<?php 
    // echo '删除';
    /**
     * 1 获取01userlist传过来的id
     */
    $id = $_GET['id'];//$_GET[] 通过 URL 参数传递给当前脚本的变量的数组
    var_dump($id).'<hr>';
    //删除之前 还是先要连接数据库
    $link = mysqli_connect('localhost','root','123456');
    if(!$link){
        exit('数据库连接失败');
    }
    mysqli_set_charset($link,'utf8');
    mysqli_select_db($link,'phpstu');
    // $sql = "select * from user";
    $sql = "delete from user where id=$id";
    $obj = mysqli_query($link,$sql);
    // var_dump($obj);
    if($obj && mysqli_affected_rows($link)){//mysqli_affected_rows()函数返回前一次 MySQL 操作所影响的记录行数; 取得最近一次与 link_identifier 关联的 INSERT，UPDATE 或 DELETE 查询所影响的记录行数
        echo '删除成功<a href="01userlist.php">返回</a>';
    }else{
        echo '删除失败<a href="01userlist.php">返回</a>';
    }
    mysqli_close($link);//关闭数据库
?>
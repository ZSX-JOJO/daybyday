<?php 
    // echo '修改';
    $id = $_GET['id'];
    var_dump($id);
    echo '<hr>';
    //修改之前 还是先要连接数据库
    $link = mysqli_connect('localhost','root','123456');
    if(!$link){
        exit('数据库连接失败');
    }
    mysqli_set_charset($link,'utf8');
    mysqli_select_db($link,'phpstu');
    $sql = "select * from user where id=$id";
    $obj = mysqli_query($link,$sql);
    // var_dump($obj);
    $rows = mysqli_fetch_assoc($obj);
    // var_dump($rows);
?>
<html>
    <!--这种写法 下一个页面获取不到id-->
    <!-- <form action="01doupdate.php?id=<?php echo $id;?>"> -->
    <form action="01doupdate.php?id=<?php echo $id;?>">
        <input type="hidden" value="<?php echo $id;?>" name="id">
        id: <input type="text" value="<?php echo $rows['id'];?>"><br>
        <!--只有设置了 name 属性的表单元素才能在提交表单时传递它们的值-->
        用户名: <input type="text" value="<?php echo $rows['username'];?>" name="username"><br>
        密码: <input type="text" value="<?php echo $rows['pass'];?>" name="pass"><br>
        gid: <input type="text" value="<?php echo $rows['gid'];?>" name="gid"><br>
        性别: <input type="text" value="<?php echo ($rows['sex']==0 ? '女':'男');?>" name="sex"><br>
        地址: <input type="text" value="<?php echo $rows['address'];?>" name="address"><br>
        年龄: <input type="text" value="<?php echo $rows['age'];?>" name="age"><br>
        <input type="submit" value="执行修改">
    </form>
</html>
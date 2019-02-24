<?php 
    $page = empty($_GET['page']) ? 1 : $_GET['page'];//empty()检查一个变量是否为空
    $link = mysqli_connect('localhost','root','123456');
    if(!$link){
        exit('数据库连接失败');
    }
    mysqli_set_charset($link,'utf8');
    mysqli_select_db($link,'phpstu');

    //--------------分页开始-----------------
    //求出总条数
    $sql = "select count(*) as count from user";
    $result = mysqli_query($link,$sql);
    $pageRes = mysqli_fetch_assoc($result);
    var_dump($pageRes);
    $count = $pageRes['count'];
    //每页显示树 每页显示5条数据
    $num = 5;
    //根据每页显示数 求出总页数
    $pageCount = ceil($count/$num);
    //根据总页数 求出偏移量
    // $page = 1;
    $offset = ($page - 1) * $num;
    //---------------分页结束------------------------
    // $sql = "select * from user";
    $sql = "select * from user limit ".$offset.','.$num;//limit后面有空格！！！！
    $obj = mysqli_query($link,$sql);
    echo '<table width="1200" border="1">';
        echo '<th>编号</th><th>用户名</th><th>性别</th><th>密码</th><th>地址</th><th>年龄</th><th>操作</th>';
        while($rows = mysqli_fetch_assoc($obj)){
            echo '<tr>';
                echo '<td>'.$rows['id'].'</td>';
                echo '<td>'.$rows['username'].'</td>';
                echo '<td>'.($rows['sex']==0 ? '女':'男').'</td>';
                echo '<td>'.$rows['pass'].'</td>';
                echo '<td>'.$rows['address'].'</td>';
                echo '<td>'.$rows['age'].'</td>';
                echo '<td><a href="01del.php?id='.$rows['id'].'">删除</a>
                        <a href="01update.php?id='.$rows['id'].'">修改</a>
                    </td>';
            echo '</tr>';
        }
    echo '</table>';
    $prev = $page - 1;
    $next = $page + 1;
    if($prev < 1){
        $prev = 1;
    }
    if($next > $pageCount){
        $next = $pageCount;
    }
    echo '<a href="01add.php">添加</a><br>';
    // mysql_close($link);
?>
<html>
    <body>
        <a href="01userlist.php?page=1">首页</a>
        <a href="01userlist.php?page=<?php echo $prev;?>">上一页</a>
        <a href="01userlist.php?page=<?php echo $next;?>">下一页</a>
        <a href="01userlist.php?page=<?php echo $pageCount;?>">尾页</a>
        <!-- <a href="01userlist.php?page=<?=$pageCount;?>">尾页</a> 也可以这种写法-->
    </body>
</html>

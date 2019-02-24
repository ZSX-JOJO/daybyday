<?php 
    /**
     * 添加
     */
?>
<html>
    <body>
        <form action="01doadd.php">
            用户名: <input type="text" value="" name="username"><br>
            <!-- 性别:<input type="text" value="" name="sex"><br> -->
            性别:<input type="radio" name="sex" value="1">男
                 <input type="radio" name="sex" value="0">女<br>
            密码:<input type="text" value="" name="pass"><br>
            地址:<input type="text" value="" name="address"><br>
            年龄:<input type="text" value="" name="age"><br>
            <input type="submit" value="确认添加">
        </form>
    </body>
</html>
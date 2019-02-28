<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <?php if(!$_SESSION['user']){ ?>
    <form action="05cookieSession.php" method="post" name="register">
        用户名: <input type="text" name="username"><br>
        密码: <input type="password" name="password"><br>
        <input type="submit" value="提交">
    </form>
    <?php }else{ ?>
        <h1><?php echo $_SESSION['user']['username'].'已经登陆'; ?></h1>
    <?php } ?>
</body>
</html>
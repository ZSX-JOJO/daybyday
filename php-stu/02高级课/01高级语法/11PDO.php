<?php
    /**
     * PDO(php data object)
     * 
     * 主要使用这三个类 PDO(PDO类) PDOStatement(PDO预处理类) PDOException(PDO异常处理类)
     * 
     * dsn(data source name)
     *      1:字符串形式(默认使用此方式)
     *          'mysql::host=localhost;dbname=bingbing;charset=utf8';
     *      2:文件形式(经下方栗子测试 必须要绝对路径)
     *          $pdo = new PDO('uri:file:///c:/123.txt','root','123456');
     *      3:php.ini(这个文件就别乱改了吧。。。)
     *          pdo.dsn.自定义名字="mysql:host=localhost;dbname=bingbing;charset=utf8"
     *          $pdo = new PDO('自定义名字','root','123456');
     * 
     * 获取和设置信息:(具体查看手册关于PDO部分)
     *      setAttribute
     *          PDO::ATTR_CASE  强制列名为指定的大小写
     *          PDO::ATTR_AUTOCOMMIT 是否自动提交每个单独的语句
     *      getAttribute
     *      
     * 错误模式:
     *      1:默认
     *      2:警告
     *          $pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_WARNING);
     *      3:异常
     *          $pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
     * PDO执行sql语句:
     *      exec 执行不要结果集的语句 例如 增删改
     *      query 执行要结果集的语句  例如 查
     *      lastInsertId  最后插入语句的id号
     * 事务处理:(多条sql语句必须全部执行成功 才叫整个操作进行执行成功;只要有一条执行失败,所有的操作都要回滚到最初始的状态)
     *      【表引擎有两种 myisam(不支持) innodb(支持)】
     *      $pdo->beginTransaction();   开启一个事务
     *      $pdo->commit();             提交事务
     *      $pdo->rollback();           回滚到初始状态
     * 
     * 预处理语句:
     *      优点:效率 安全(防止sql注入)
     *      为了提高效率 我们要使用预处理语句
     *      PDOStatement
     *      prepare     预处理sql语句
     *      execute     执行sql语句
     *      增删改
     *          增加:$stmt = $pdo->prepare(insert into ligoudan(name,age,money) values(?,?,?));
     *      查 (结果集)
     *            fetch
     *            fetchAll
     *              模式如下几种
     *                   PDO::FETCH_ASSOC  返回一个索引为结果集列名的数组 
     *                   PDO::FETCH_NUM 返回一个索引为以0开始的结果集列号的数组
     *                   PDO::FETCH_BOTH(默认) 返回一个索引为结果集列名和以0开始的列号的数组 
     *                   PDO::FETCH_OBJ 返回一个属性名对应结果集列名的匿名对象 
     *      setFetchMode    设置默认的提取模式
     *      绑定列
     *          $stmt->bindColumn('name',$name);
     *          $stmt->fetch(PDO::FETCH_NUM);
     *          
     */
/**----------------------------------------------------------------------------------------------------- */
    // PDO连接数据库
    // $dsn = 'mysql:host=localhost;dbname=phpstu;charset=utf8';
    // $username = 'root';
    // $password = '123456';
    // $pdo = new PDO($dsn,$username,$password);
    // var_dump($pdo);

    //以下为正规用法
    $dsn = 'mysql:host=localhost;dbname=phpstu;charset=utf8';//关于dsn默认使用这种方式
    // $dsn = 'uri:file:///11dsn.txt';//相对路径不行
    // $dsn = 'uri:file:///G:\php-work\php-stu\11dsn.txt';//必须绝对路径
    $username = 'root';
    $password = '123456';
    try{
        $pdo = new PDO($dsn,$username,$password);
        //设置错误模式
        // $pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_WARNING);//为了开发者使用
        $pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);//通常情况下 用它抛出异常
    }catch(PDOException $e){
        die('数据库连接失败:'.$e->getMessage());//die() 等同于exit()
    }
    // var_dump($pdo);

    // PDO执行sql语句
    //如果将错误模式设置成抛出异常 就应该使用try catch
    try{
        /**exec 执行不要结果集的语句 例如 增删改 */
        //插入数据
        // $sql = 'insert into user2(name,password,money) values("李狗蛋4","123456",2222)';// 此处可以不写id  (前提是数据表中 id设置为主键且自动递增)
        //修改数据
        // $sql = 'update user2 set money=50000 where id=1';
        //删除数据
        // $sql = 'delete from user2 where id = 6';

        /**query 执行要结果集的语句  例如 查 */
        //查询数据 未添加任何条件
        $sql = 'select * from user2';
        // $ret = $pdo->exec($sql);//exec 执行不要结果集的语句
        $ret = $pdo->query($sql);//query 执行要结果集的语句

        //关于exec 返回受修改或删除 SQL 语句影响的行数。如果没有受影响的行，则 PDO::exec() 返回 0
        // if($ret>0){
        //     echo '插入成功';
        //     // echo $pdo->lastInsertId();//返回最后插入行的ID或序列值 因为第二条sql语句 所以此行暂时注释
        // }else{
        //     echo '插入失败';
        // }
        // 关于query returns a PDOStatement object, or FALSE on failure
        if($ret){
            echo '查询成功';
            var_dump($ret);
        }else{
            echo '查询失败';
            var_dump($ret);
        }
    }catch(PDOException $e){
        echo $e->getMessage();
    }
    echo '<hr>';
/**----------------------------------------------------------------------------------------------------- */
    //以下为 事务处理
    $dsn2 = 'mysql:host=localhost;dbname=phpstu;charset=utf8';
    $username2 = 'root';
    $password2 = '123456';
    try{
        $pdo2 = new PDO($dsn2,$username2,$password2);
        //设置错误模式
        $pdo2->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    }catch(PDOException $e){
        die('数据库连接失败'.$e->getMessage());
    }

    try{
        //开启一个事务
        $pdo2->beginTransaction();
        //李狗蛋转账给李狗蛋2 10000元
        $sql2 = 'update user2 set money=money-10000 where id = 1';
        $ret2 = $pdo2->exec($sql2);
        if($ret2 > 0){
            echo '李狗蛋转出成功'.'<br>';
        }else{
            // echo '李狗蛋转出失败';
            throw new PDOException('李狗蛋转出失败');
        }
        //李狗蛋2收到李狗蛋的 10000元
        $sql3 = 'update user2 set money=money+10000 where id=2';
        $ret2 = $pdo2->exec($sql3);
        if($ret2 > 0){
            echo '李狗蛋2转入成功'.'<br>';
        }else{
            // echo '李狗蛋2转入成功失败';
            throw new PDOException('李狗蛋2转入失败');
        }
        //如果sql语句都成功 则提交事务
        $pdo2->commit();
        echo '交易成功'.'<br>';
    }catch(PDOException $e){
        //如果sql语句执行失败 则需要回滚
        $pdo2->rollback();
        echo $e->getMessage();
    }
    echo '<hr>';
/**----------------------------------------------------------------------------------------------------- */
    //以下 预处理 和 增删改
    $dsn3 = 'mysql:host=localhost;dbname=phpstu;charset=utf8';
    // $username2 = 'root';
    // $password2 = '123456';
    try{
        $pdo3 = new PDO($dsn3,'root','123456');
        //设置错误模式
        $pdo3->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    }catch(PDOException $e){
        die('数据库连接失败'.$e->getMessage());
    }

    try{
        //以 插入语句为例
        // $stmt = $pdo3->prepare('insert into user2(name,password,money) values(?,?,?)');//问号占位符的预处理语句
        // $stmt = $pdo3->prepare('insert into user2(name,password,money) values(:name,:password,:money)');//命名占位符的预处理语句 (命名占位符和字段名相同 是 为了更清楚而已 可以自定义设置为其他名称)
        //以 删除语句为例
        // $stmt = $pdo3->prepare('delete from user2 where id=?');
        //以 更新语句为例
        // $stmt = $pdo3->prepare('update user2 set money=money+444 where id=?');
        // $stmt = $pdo3->prepare('update user2 set name=:name where id=:id');
        $stmt = $pdo3->prepare('update user2 set name=? where id=?');

        //绑定参数 问号占位符时
        // $stmt->bindParam(1,$name);
        // $stmt->bindParam(2,$pwd);
        // $stmt->bindParam(3,$money);
        // $name = '孙悟空1';
        // $pwd = '123123';
        // $money = 1024;
        // $stmt->execute();
        // $name = '孙悟空2';
        // $pwd = '123123';
        // $money = 2048;
        // $stmt->execute();

        //绑定参数 命名占位符时
        // $stmt->bindParam(':name',$name);
        // $stmt->bindParam(':password',$pwd);
        // $stmt->bindParam(':money',$money);
        // $name = '孙悟空3';
        // $pwd = '123123';
        // $money = 1024;
        // $stmt->execute();
        // $name = '孙悟空4';
        // $pwd = '123123';
        // $money = 2048;
        // $stmt->execute();

        // 上述两处注释代码的升级版
        // $stmt->execute(['赵云',789456,99999]);//问号占位符时 传入索引数组
        // $stmt->execute([':name'=>'刘备',':password'=>789456,':money'=>88888]);//命名占位符时 传入关联数组
        //执行删除语句
        // $stmt->execute([5]);
        //执行更新语句
        // $stmt->execute([2]);
        // $stmt->execute([':name'=>'李狗蛋2李狗蛋',':id'=>2]);
        $stmt->execute(['赵云真牛鼻',14]);
    }catch(PDOException $e){
        echo $e->getMessage();
    }
    echo '<hr>';
/**----------------------------------------------------------------------------------------------------- */
    //以下 预处理 和查询
    $dsn4 = 'mysql:host=localhost;dbname=phpstu;charset=utf8';
    try{
        $pdo4 = new PDO($dsn4,'root','123456');
        //设置错误模式
        $pdo4->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        //设置提取模式
        $pdo4->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_ASSOC);//(设置默认的提取模式)
    }catch(PDOException $e){
        die('数据库连接失败'.$e->getMessage());
    }

    try{
        $stmt4 = $pdo4->prepare('select id,name,password,money from user2');
        $stmt4->execute();
        // $result = $stmt4->fetch(PDO::FETCH_ASSOC);
        // $result = $stmt4->fetch(PDO::FETCH_BOTH);
        // $result = $stmt4->fetch(PDO::FETCH_NUM);
        // $result = $stmt4->fetch(PDO::FETCH_OBJ);
        // $result = $stmt4->fetch();//因为已经设置了提取模式 所以方法内不用再写参数
        // $result = $stmt4->fetchAll();//fetchAll()返回一个包含结果集中所有行的数组
        // var_dump($result);
        // 绑定列
        $result = $stmt4->bindColumn('id',$id);
        $result = $stmt4->bindColumn('name',$name);
        $result = $stmt4->bindColumn('password',$password);
        $result = $stmt4->bindColumn('money',$money);
        echo '<table border="1" width="800" align="center">';
            echo '<tr>';
                echo '<th>id</th>';
                echo '<th>name</th>';
                echo '<th>password</th>';
                echo '<th>money</th>';
            echo '</tr>';
            while($stmt4->fetch()){
                echo '<tr>';
                    echo '<td>'.$id.'</td>';
                    echo '<td>'.$name.'</td>';
                    echo '<td>'.$password.'</td>';
                    echo '<td>'.$money.'</td>';
                echo '</tr>';
            }
        echo '</table>';
    }catch(PDOException $e){
        echo $e->getMessage();
    }
    echo '<hr>';
/**----------------------------------------------------------------------------------------------------- */
?>
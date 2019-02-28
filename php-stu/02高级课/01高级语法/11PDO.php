<?php
    /**
     * PDO(php data object)
     * 
     * 主要使用这三个类 PDO PDOStatement PDOException
     * 
     * dsn(data source name)
     *      1:字符串形式
     *          'mysql::host=localhost;dbname=bingbing;charset=utf8';
     *      2:文件形式
     *          $pdo = new PDO('uri:file:///c:/123.txt','root','123456');
     *      3:php.ini
     *          pdo.dsn.lala="mysql:host=localhost;dbname=bingbing;charset=utf8"
     *          $pdo = new PDO('lala','root','123456');
     * 
     * 获取和设置信息:
     *      setAttribute
     *          PDO::ATTR_CASE  强制列名为指定的大小写
     *          PDO::ATTR_AUTOCOMMIT 是否自动提交每个单独的语句
     *      getAttribute
     *      
     * 暂时略过
     */
?>
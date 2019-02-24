<?php 
    /**
     * 关系型数据库
     *      Oracle、DB2、Microsoft SQL Server、Microsoft Access、MySQL
     * 非关系型数据库
     *      NoSql、Cloudant、MongoDb、redis、HBase
     */

    /**
     * 以下命令为 dos操作
     * 
     * 登陆数据库:
     *      mysql -uroot -p
     * 登录后:
     *      \h 帮助命令 quit exit 退出数据库
     *      \c 清除命令
     *      show databases; 查看当前的库   一定要添加分号！
     * 创建/删除 数据库:
     *      create database 数据库名字; 创建数据库 分号分号！
     *      show create database 数据库名字; 查看创建数据库的语句
     *      drop database 数据库名字; 删除数据库
     * 创建/删除 表:
     *      use 数据库名称;  先选择要使用的数据库
     *      create table user(id int,username varchar(40),password varchar(32));  创建表
     *      show tables; 查看表
     *      show create table 表名; 查看创建表的语句
     *      desc 表名字; 查看表结构
     * 
     *      alter table 表名 change 修改的字段名 修改后的字段名 修改后的字段类型;       修改表的某个字段的名字
     *          栗子: alter table user change password pass varchar(45);
     * 
     *      alter table 表名 modify 字段名字 修改后的值;     修改表字段值
     * 
     *      alter table 表名 drop 删除的字段; 删除表的某个字段
     * 
     *      alter table 表名 add 添加的字段 字段类型; 添加表的字段
     *          栗子: alter table user add pass varchar(40) first; first这里 first最上方插入 after 字段名 插入到某个字段之后
     * 
     *      drop table 表名; 删除表
     *      alter table 修改的表名  rename 修改后的表名;
     *  
     * 数据类型:         所占字节:   取值范围:
     *      整型:
     *          tinyint     1       -127~127
     *          smallint    2       -32768~32768
     *          mediumint   3       -8388608~8388608
     *          int         4       -2147483684~2147483684
     *          bigint      8       +-9.22*10^18
     *      浮点类型:
     *          float(m,d)  4   单精度浮点型 m总个数 d小数位
     *          double(m,d) 8
     *          decimal(m,d)   decimal是存储为字符串的浮点数
     *      字符串类型:
     *          char        0-255   定长字符串 32位 md5加密
     *          varchar     0-655355  变长字符串
     *      时间类型:
     *          date        4
     * 
     *      [auto_increment]
     *          自动增加 只用于整型 可以设置起始值 默认为1
     *          常与后面primary key 一起使用 设置主键自增
     *          创建表时在整型字段后加上 auto_crement=起始值
     *          修改起始值(一般不使用)
     *              alter table 表名 auto_increment=起始值;
     * 
     *  索引:
     *      普通索引: alter table 表名 add index(表字段);
     *      唯一索引: alter table 表名 add unique(表字段);
     *      全文索引: alter table 表名 add fulltext(表字段);
     *      主键索引: alter table 表名 add primary key(表字段);
     * 
     *  增删改查:
     *      select database(); 查询表位于哪个数据库
     *      desc 表名; 查看表结构
     *      
     *      插入数据: 
     *          insert into 表名 values(字段1,字段2,字段3,...字段N);
     *          insert into 表名(字段1,字段2,字段3,...字段N) values(字段1的值,字段2的值,字段3的值,...字段N的值);
     *              栗子: insert into user(username,pass) values('赵守鑫3',123456); 此时id没写也可以正常插入，此种写法较为灵活 本机貌似失败。。。
     *          insert into 表名(字段1,字段2,字段3,...字段N) values(字段1的值,字段2的值,字段3的值,...字段N的值),(字段1的值,字段2的值,字段3的值,...字段N的值);插入多条数据
     *      删除数据:
     *          delete from 表名 where 字段 = '某个字段值';
     *      修改数据:
     *          update 表名 set 字段 = '某个字段的值' where 字段 = 字段值;
     *              栗子:  update user set username = '赵守鑫5' where id = 5;
     *          update 表名 set 字段 = '某个字段的值','另一个字段的值','再一个字段的值' where 字段 = 字段值;  修改多个字段的值
     *      查询数据: 
     *          select * from 表名; 未添加条件的查询
     *          select 字段1,字段2,字段N from 表名; 查询一个或者多个字段
     *          去除重复值:
     *              select distinct 字段 from 表名;
     *          select * from user where 字段 = 字段值; 查询配合where使用 = > >= < <=
     *          
     *          select * from 表名 where 字段 between 值1 and 值2; 取某个区间的数据
     *          select * from 表名 where 字段 = 值1 or 字段 = 值2; 
     *          select * from 表名 where 字段 in(字段值1,字段值2,字段值3.....); 取某个字段符合 过个字段值的数据
     *          select * from 表名 where 字段 like '%值'; 模糊查询 查询值为结尾的数据
     *          select * from 表名 order by 字段 asc; 将某个字段 升序排序 默认asc升序 可以不写
     *          select * from 表名 order by 字段 desc; 将某个字段 降序排序
     *          select * from 表名 limit 5 , 5; 从第6条开始查询 取5条 limit用于分页
     *              select * from 表名 limit 5;从第1条开始取 取5条
     *          select * from 表名 group by 字段; 分组查询 自动去重
     *          select count(*) from 表名; 查询共有多少条数据
     *          select 字段 as 别名 from 表名; 起别名 字段太长时 起别名用于查询显示友好 不是将原字段改名！
     *          
     *          select 表1.字段1,表2.字段2 from 表1名 inner join 表2名 on 表1.字段3 = 表2.字段3; on后面代表条件 内联查询 两张表有联系 都有相同的字段3
     *          select 表1的字段1 from 表1 left join 表2 on 表1.字段3 = 表2.字段3; on后面代表条件  左查询 左联查询 以左表(表1)为基准 同理 右查询 右联查询 以右表(表2)为基准
     *          select * from 表1 where 字段3 in(select 字段3 from 表2); 嵌套查询
     *              等于: select * from 表1 where 字段3 in(字段3值1,字段3值2,字段3值3...);
     *          
     */

    echo md5('zsx');
    echo '<br>';
?>
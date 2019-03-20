# MySQL笔记

### 内连接查询  inner join

```mysql
关键字： inner  join   on
说明:组合两个表中的记录，返回关联字段相符的记录，也就是返回两个表的交集部分
例如:在boy表和girl 表中查出两表 hid 字段一致的姓名（gname，bname）
SELECT boy.hid,boy.bname,girl.gname FROM boy INNER JOIN girl ON girl.hid = boy.hid;
```

### 左连接查询 left join

```mysql
关键字：left join on / left outer join on
说明： left join 是 left outer join的简写，它的全称是左外连接，是外连接中的一种。 左(外)连接，左表(a_table)的记录将会全部表示出来，而右表(b_table)只会显示符合搜索条件的记录。右表记录不足的地方均为NULL
例如:
SELECT boy.hid,boy.bname,girl.gname FROM boy LEFT JOIN girl ON girl.hid = boy.hid;
```

### 右连接 right join

```mysql
关键字： right join on / right outer join on
说明: right join是right outer join的简写，它的全称是右外连接，是外连接中的一种。与左(外)连接相反，右(外)连接，左表(a_table)只会显示符合搜索条件的记录，而右表(b_table)的记录将会全部表示出来。左表记录不足的地方均为NULL
例如:
SELECT boy.hid,boy.bname,girl.gname FROM boy RIGHT JOIN girl ON girl.hid = boy.hid;
```

### 全连接 union

```mysql
关键字： union / union all
语句: (select colum1,colum2...columN from tableA ) union (select colum1,colum2...columN from tableB )或者
(select colum1,colum2...columN from tableA ) union all (select colum1,colum2...columN from tableB )；
union会自动将完全重复的数据去除掉 只保留一个
union all会保留那些重复的数据
```



### 
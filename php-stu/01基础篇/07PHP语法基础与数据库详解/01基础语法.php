<?php 
    /**
     * echo
     * print
     * var_dump()
     * a.b 并值 就是连接两个运算符
     * foreach($array as $value){}
     * 
     * 【日期函数】:
     * 
     * date()获取当前日期
     * date('Y-m-h h:i:s')获取当前日期 格式化 w 周 0-6  0周日
     * time()获取时间戳
     * strtotime('2019-02-24 0-0-0');转换为时间戳
     * getdate();返回某个时间戳或者当前本地的日期/时间的日期/时间信息
     * microtime();返回当前Unix时间戳的微秒数
     * mktime();返回当前Unix时间戳的微秒数
     * 
     * 【数组 && 数组遍历】:
     * 
     * 数值数组 带有数字ID键的数组 
     *      $arr = array('zsx','sex','age');
     *      for($i=0;$i<count($arr);$i++){}
     * 关联数组 带有指定的键的数组 每个键关联一个值
     *      $arr = array('name'=>'zsx','sex'=>'男','age'=>'28');
     *      foreach($arr as $key=>$value){}
     * 多维数组 包含一个或者多个数组的数组
     *      $arr = array(
     *              array(1,2,3),
     *              array(1,2,3),
     *              array(1,2,3)
     *          );
     * 
     * $arr = array('zsx','sex','age');
     * $arrNew = ['zsx','sex','age'] 新的写法
     * 
     * 【字符串函数】:
     * 
     * explode()把字符串打乱为数组 [使用一个字符串分割另一个字符串]
    * implode()返回一个由数组元素合成的字符串[将一个一维数组的值转化为字符串]
     * join()别名implode() 合并成数组
     * trim() 去掉字符串两边的字符
     * md5() 计算字符串的MD5散列 32位
     * str_replace()替换字符串中的一些字符(大小写敏感)[该函数返回一个字符串或者数组]
     * 
     * 【数组函数】: 具体查看 数组-->数组函数
     * 
     * in_array()检查数组中是否存在指定的值
     * count()返回数组中元素的数目
     * array_keys()返回数组中所有的键名
     * 
     * array_shift()删除数组中 第一个 元素 并返回被删除元素的值
     * array_pop()删除数组中的最后一个元素(出栈)
     * 
     * array_unshift()在数组 开头 插入一个或多个单元
     * array_push()将一个或者多个元素插入数组末尾(入栈)
     * 
     * array_rand()从数组随机选出一个或者多个元素返回键名
     */

    // echo date('Y-m-h h:i:s');
    // echo time();//获取时间戳
    // var_dump(date('Y-m-h h-:i:s',time()));
    // var_dump(strtotime('2019-02-24 09:11:55'));
    // echo mktime(time());

    $zsx = 'zhaoshouxin-zhaoshouxin2-zhaoshouxin3-zhaoshouxin4'; 
    $zsx_temp = explode('-',$zsx);
    var_dump($zsx_temp);
    // 0 => string 'zhaoshouxin' (length=10)
    // 1 => string 'zhaoshouxin2' (length=11)
    // 2 => string 'zhaoshouxin3' (length=11)
    // 3 => string 'zhaoshouxin4' (length=11)

    $zsx2 = ['zhaoshouxin','zhaoshouxin2','zhaoshouxin3'];
    $zsx2_temp = implode($zsx2);
    var_dump($zsx2_temp);
    // 'zhaoshouxinzhaoshouxin2zhaoshouxin3'

    $zsx2_new = join(',',$zsx_temp);
    var_dump($zsx2_new);
    // 'zhaoshouxin,zhaoshouxin2,zhaoshouxin3,zhaoshouxin4'
    $zsx2_new_array = explode(',',$zsx2_new);
    var_dump($zsx2_new_array);
    // 0 => string 'zhaoshouxin' (length=10)
    // 1 => string 'zhaoshouxin2' (length=11)
    // 2 => string 'zhaoshouxin3' (length=11)
    // 3 => string 'zhaoshouxin4' (length=11)
    $str_replace = str_replace('zhaoshouxin','zsx',$zsx_temp);
    var_dump($str_replace);
?>
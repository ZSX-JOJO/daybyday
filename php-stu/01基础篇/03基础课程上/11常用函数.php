<?php
    /**
     * 常用函数
     * 
     *  数学函数:
     *      随机:
     *          rand()随机数
     *          mt_rand()产生一个更好的随机数 效率高
     *      小数:
     *          floor不大于该树的最大整数 向上取整
     *          ceil不小于该树的最小整数  向下取整
     *          round四舍五入取整
     *      其他:
     *          abs绝对值
     *          pi圆周率
     *          M_PI常量 与pi()函数的返回值相同
     *          pow指数表达式
     *          max最大值
     *          min最小值
     *  字符串函数:
     *      大小写转换:
     *          strtolower转换为小写
     *          strtoupper转换为大写
     *          lcfirst首字母小写
     *          ucfirst首字母大写
     *          ucwords没个单词首字母大写
     *      空白处理:
     *          trim去掉首尾的空白字符
     *          ltrim去掉开头的空白字符
     *          rtirm/chop去掉结尾的空白字符
     *      查找定位:
     *          strstr/strchr返回首次出现到结尾的内容 包含首次出现
     *          strrchr返回最后一次出现到结尾的内容 包含首次出现
     *          stristr strstr忽略大小写的版本
     * 
     *          strpos返回首次出现的位置
     *          stripos strpos忽略大小写的版本
     * 
     *          strrpos 返回最后一次出现的位置
     *          strripos strrpos忽略大小写的版本
     *          
     *          substr 字符提取  substr ( string $string , int $start [, int $length ] ) : string
     * 
     *          strpbrk 返回(字符列表中任意字符)首次出现到结尾的内容
     *      比较:
     *          strcmp 二进制比较字符串
     *          strcasecmp strcmp忽略大小写
     *          strnatcmp 自然顺序比较
     *          strnatcasecmp strnatcmp的忽略大小写版本
     *      顺序:
     *          str_shuffle 打乱顺序
     *          strrev 逆序字符串
     *      转换:
     *          chr 将ASCII码值转换为字符
     *  
     *  
     *  数组函数:
     *      数组中元素指针的移动:
     *              
     *          
     * 
     *  
     */

    /**
     * 查找定位
     */
    $email  = 'name@example.com';
    $domain = strstr($email, '@');
    echo $domain; // 打印 @example.com
    echo '<br>';

    $user = strstr($email, '@', true); // 从 PHP 5.3.0 起
    echo $user; // 打印 name
?>
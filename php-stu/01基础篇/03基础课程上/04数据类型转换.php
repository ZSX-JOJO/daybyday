<?php
    $str = 'zsx';
    echo getType($str);//获取数据类型
    $str2 = '18.zsxsaadads';
    $str3 = '18.213123213';
    $num = 213;
    $bool = 123;
    $null = null;
    echo '<br>';
    echo intval($str2);//intval()转换为整数 null会被转换为0
    echo '<br>';
    echo floatval($str3);//floatval()转换为浮点型 ; getType(floatval($null)) double
    echo '<br>';
    echo getType(strval($num));//strval()转换为字符型; null会被转换为空字符串
    echo '<br>';
    echo boolval($bool);//boolval()转换为布尔型
    echo '<br>';
    var_dump(strval($null));
    /**
     * 总结:
     * 
     * 【强制类型转换】
     * intval()转换为整型
     * floatval()转换为浮点型
     * strval()转换为字符串
     * boolval()转换为布尔型
     * 
     * 【判断数据类型常用函数】
     * is_array()数组
     * is_string()字符串
     * is_bool()布尔
     * is_float()浮点
     * is_object()对象
     * is_int()整型
     * is_numeric()数值
     * is_resource()资源
     * is_null()空
     * is_scalar()标量
     * getType()只获取类型
     * var_dump()输出值还有类型
     */
?>
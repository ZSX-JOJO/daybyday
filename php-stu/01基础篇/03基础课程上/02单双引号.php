<?php 
    $name = 'zsx';
    $age  = 27;
    $sex = '男';
    echo '$name';
    echo "<br>";
    echo $name;
    echo "<br>";
    echo "$name";
    echo "<br>";
    echo '\'';
    echo "<br>";
    echo "\'";
    echo "<br>";
    $name2="变量会被解析";
    $abc=<<<EOF
    $name2<br>
    <a style="color:red">html格式会被解析</a><br/>
    双引号和Html格式外的其他内容都不会被解析
    "双引号外所有被排列好的格式都会被保留"
    "但是双引号内会保留转义符的转义效果,比如table:\t和换行：\n下一行"
EOF;
    echo $abc;
    echo "<br>";
    echo '<br>';
    echo $name.'赵守鑫';//变量和字符串通过 . 拼接起来
    echo '<br>';
    echo '{$name}少壮要努力 老大无伤悲';//{$name}少壮要努力 老大无伤悲
    echo '<br>';
    echo "{$name}少壮要努力 老大无伤悲";//zsx少壮要努力 老大无伤悲 也可以使用定界符拼接
    echo '<br>';
    echo "'$name'少壮要努力 老大无伤悲";//'zsx'少壮要努力 老大无伤悲
    echo '<br>';
    echo $name.'少壮要努力 老大无伤悲';//正规用法  zsx少壮要努力 老大无伤悲
    /**
     * 单双引号区别:
     * 
     * 双引号 执行 转义字符
     * 单引号 不转义 转义字符 \n \r \t \
     * 
     * 双引号可以解析变量
     * 单引号不能解析变量
     * 
     * 单引号效率比双引号快
     * 字符串和变量一起的时候  用.来连接
     * 
     * 双引号里面插入单引号 单引号里面插入变量 变量会被解析成 '$变量值'
     * 双引号里面插入变量时 在后面加上 空格 或者 ,号 或者将变量用{}包起来
     */
    
    /**
     * PHP定界符
     * 1 以 <<<EOF 开始标记开始，以 EOF 结束标记结束，结束标记必须顶头写，不能有缩进和空格，且在结束标记末尾要有分号 。
     * 2 开始标记和结束标记相同，比如常用大写的 EOT、EOD、EOF 来表示，但是不只限于那几个(也可以用：JSON、HTML等)，
     *   只要保证开始标记和结束标记不在正文中出现即可
     * 3 
    */
?>
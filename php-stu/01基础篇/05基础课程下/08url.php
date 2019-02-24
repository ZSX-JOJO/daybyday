<?php 
    /**
     * http://www.baidu.com org cn net me
     * https://www.baidu.com
     * www.baidu.com
     * baidu.com
     * 
     * preg_match() 返回 pattern 所匹配的次数。要么是 0 次（没有匹配）或 1 次，
     * 因为 preg_match() 在第一次匹配之后将停止搜索。
     * preg_match_all() 则相反，会一直搜索到 subject 的结尾处。
     * 如果出错 preg_match() 返回 FALSE
     */
    $str = 'www.baidu.com';
    $pattern = '/(http|https)?(:\/\/)?(\w+.?)(\w+.?)(\w+.?)/';
    if(preg_match($pattern,$str,$match)){//preg_match()搜索匹配到一个后终止
        echo '匹配成功';
        var_dump($match);
    }else{
        echo '匹配失败';
    }

    /**
     * 正则使用的常见函数:
     *      
     *      
     */
    $str2 = 'aaabcde';
    $pattern2 = '/a/';
    preg_match_all($pattern2,$str2,$matchs);//preg_match_all()搜索匹配全部情况
    var_dump($matchs);

    $string = '<div>忙碌起来，啥事都不想！</div>';
    $pattern3 = '/<div>(.*)<\/div>/';
    $replace = '<p style="color:green;font-size:24px">忙碌起来，就行了！</p>';
    $newStr = preg_replace($pattern3,$replace,$string);
    var_dump($newStr);
    echo $newStr;
?>
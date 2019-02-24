<?php
    /**
     * 文件操作 查手册啊查手册
     */
    // readfile('06txt.txt');
    // var_dump(readfile('06txt.txt'));
    // var_dump(file('06txt.txt'));//把整个文件读入一个数组中
    // file_put_contents('06txt.txt','赵守鑫');//将一个字符串写入文件(覆盖写 会把原来的内容给覆盖)
    // file_put_contents('06txt2.txt','没有文件会直接创建新的文件');//
    // echo file_get_contents('06txt.txt');//将整个文件读入一个字符串(获取文件的内容,原样输出字符串)

    // var_dump(fopen('06txt2.txt','r'));//打开文件或者URL 至少两个参数 r模式代表只读;fopen() 将 filename 指定的名字资源绑定到一个流上 ;fopen()返回一个资源

    // $fp = fopen('06txt2.txt','r+');//r+ 模式是读写模式
    $fp = fopen('06txt3.txt','w');//w模式
    $str = '挤不进别人的世界就别难为别人了';
    fwrite($fp ,$str);
    fseek($fp,0);//将指针移动到最前处; fseek()在文件指针中定位
    echo fread($fp,3);//不写上一行无法读出 

    fclose($fp);//fclose()关闭一个已打开的文件指针

    //pathinfo()
    var_dump(pathinfo('06txt3.txt'));
    var_dump(basename('06txt3.txt'));
    var_dump(dirname('06txt3.txt'));

    $arr = ['username'=>'zhaoshouxin','sex'=>'男','age'=>27];
    var_dump(http_build_query($arr));//将数组变成URL参数 以字符串的格式

    $url = 'https://www.baidu.com/baidu?wd=213&tn=monline_dg&ie=utf-8';
    var_dump(parse_url($url));// parse_url()解析 URL，返回其组成部分

    $arr2 = 'username=zhaoshouxin&sex=男';
    parse_str($arr2);//将字符串解析成多个变量
    echo $username.' '.$sex;

    var_dump(file_exists('06txt3.txt'));//file_exists()判断文件或目录是否存在 返回布尔值
    echo is_file('06txt3.txt');//is_file()是否是个文件  具体查询手册 Filesystem 函数 

    // chmod();//改变权限 r w x 4 2 1 

    mkdir('dirtest');//mkdir()创建文件目录(文件夹)
    mkdir('dirtest2/a/b',0777,true);//递归创建
    rmdir('dirtest');//删除一个文件夹 只可以删除一级目录 多级目录的无法删除

    $dir = opendir('dirtest2');//opendir() 打开目录句柄
    echo readdir($dir).'<br>';//readdir()从目录句柄中读取条目  此时输出.
    echo readdir($dir).'<br>';//readdir()从目录句柄中读取条目  此时输出..
    echo readdir($dir).'<br>';//readdir()从目录句柄中读取条目  此时输出a
    closedir($dir);//关闭目录句柄

    //
    // unlink('test.txt');//删除文件
    copy('test.txt','test2.txt');//拷贝文件
    rename('test2.txt','test3.txt');//重命名一个文件或者目录
?>
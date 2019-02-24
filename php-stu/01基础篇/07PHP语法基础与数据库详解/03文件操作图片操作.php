<?php 
    /**
     * touch()设定文件的访问和修改时间 如果文件不存在，则会被创建
     * 
     */
    touch('03.txt');//创建文件
    $handle = fopen('03.txt','w');//打开文件 生成操作文件的资源句柄
    fwrite($handle,'测试内容'."\r\n");
    fwrite($handle,'测试内容2');
    fwrite($handle,'测试内容3');
    fclose($handle);


    $file = fopen('03.txt','r');//生成一个句柄
    // echo fgetc($file);//fget系列方法 具体查看手册
    while(!feof($file)){//feof — 测试文件指针是否到了文件结束的位置
        var_dump(fgets($file));
    }
    fclose($file);

    if(!is_dir('ok')){
        mkdir('ok','0777');
    }
    var_dump(is_file('03.txt'));//具体查看filesystem函数
    var_dump(is_dir('ok'));
?>
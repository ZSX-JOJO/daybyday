<?php
    /**
     * 递归删除目录
     */
    rm('dirtest2');
    function rm($path){
        //打开目录
        $dir = opendir($path);
        //跳过两个特殊的目录结构 . ..
        readdir($dir);
        readdir($dir);
        //循环删除
        while($newFile = readdir($dir)){
            //判断是否是文件或者文件夹
            // dirtest2/a/b
            $newPath = $path.'/'.$newFile;
            if(is_file($newFile)){
                unlink($newPath);
            }else{
                rm($newPath);
            }
        }
        closedir($dir);
        rmdir($path);
    }
?>
<?php 
    /**
     * 
     */
    // $arr = getimagesize('1.jpg');//取得图像大小
    // var_dump($arr);
    // list($width,$height) = $arr;
    // echo $width.' '.$height;

    //合并图片
    //dst目标图片(大图) src源图片(小图)
    $dst = imagecreatefromjpeg('1.jpg');//由文件或 URL 创建一个新图象; imagecreatefrom* 具体查询手册 *代表其他格式
    $src = imagecreatefromjpeg('3.jpg');
    // var_dump($dst);
    imagecopyresampled($dst,$src,50,50,200,200,300,300,500,500);
    header('Content-type:image/jpeg');
    imagejpeg($dst);
    imagedestroy($dst);
    imagedestroy($src);
?>
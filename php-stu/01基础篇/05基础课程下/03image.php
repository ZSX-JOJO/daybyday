<?php 
    /**
     * 1 创建画布
     * imagecreatetruecolor
     * 2 创建颜色
     * imagecolorallocate  为一幅图像分配颜色
     * 3 用GD库给函数画画
     * 4 告诉浏览器mime类型
     * header('Content-type:image/png');
     * 5 输出到浏览器或者存放到本地
     * 6 销毁资源
     */
    $image  = imagecreatetruecolor(600,600);

    $red = imagecolorallocate ($image,255,0,0);
    $green = imagecolorallocate ($image,0,255,0);
    $blue = imagecolorallocate ($image,0,0,255);

    $line = imageline($image,0,0,600,600,$red);//画一条线
    $rectangle = imagefilledrectangle($image,100,100,300,200,$green);//画个矩形
    $ellipse = imageellipse($image,300,300,100,200,$blue);//椭圆

    header('Content-type:image/png');

    imagepng($image);

    imagedestroy($image);
?>
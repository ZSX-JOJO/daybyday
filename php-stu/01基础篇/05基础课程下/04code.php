<?php 
    /**
     * 验证码函数
     * 
     * 问题分析:
     *      宽 高 字母 数字 字母数字混合 干扰线 干扰点 背景色 字体颜色
     */
    verify();//测试
    function verify($width=200,$height=200,$num=5,$type=2){// type=1  5个数字0-9; type=2  5个字母a-z; type=3  5个字母数字组合
        //1 准备画布
        $image = imagecreatetruecolor($width,$height);
        //2 生成颜色
        //3 需要的字符
        $string = '';
        switch($type){
            case 1:
                $str = '0123456789';
                // $shuffle = str_shuffle($str);// str_shuffle()随机地打乱字符串中的所有字符
                // $string = substr($shuffle,0,$num);// substr()截取字符串 php的使用和JavaScript相同
                $string = substr(str_shuffle($str),0,$num);
                break;
            case 2:
                $arr = range('a','z');//range()建立一个包含指定范围单元的数组 是随机排序的
                shuffle($arr);//shuffle()将数组打乱
                $tmp = array_slice($arr,0,$num);// array_slice()php中截取数组   类比JavaScript中的alice()
                $string = join('',$tmp);//join()将数组元素组合成字符串 PHP和JavaScript类似
                break;
            case 3:
                //0-9 a-z A-Z
                $str = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                $string = substr(str_shuffle($str),0,$num);
                break;
        }
        //因为效果不明显 需要给背景颜色填充浅色
        imagefilledrectangle($image,0,0,200,200,lightColor($image));
        //4 将字符应用到画布上
        for($i=0;$i<$num;$i++){
            $x = floor($width/$num)*$i + 10;//floor()向下取整
            $y = mt_rand($height/2 - 20,$height/2 - 20);//mt_rand( int $min , int $max ):int 生成更好的随机数
            imagechar($image,5,$x,$y,$string[$i],deepColor($image));//imagechar()水平的画一个字符
        }
        //5 干扰的圆弧线/干扰点
        for($i=0;$i<$num;$i++){
            //imagearc()画椭圆弧
            imagearc($image,mt_rand(10,$width),mt_rand(10,$height),mt_rand(10,$width),mt_rand(10,$height),mt_rand(0,10),mt_rand(10,270),deepColor($image));//
        }
        for($i=0;$i<50;$i++){
            //imagesetpixel()画一个单一像素
            imagesetpixel($image,mt_rand(0,$width),mt_rand(0,$height),deepColor($image));//
        }
        //6 指定输出类型
        header('Content-type:image/png');
        //7 准备输出图片
        imagepng($image);
        //8 销毁
        imagedestroy($image);
        return $string;
        // echo $string;//测试
    }

    //浅色
    function lightColor($image){
        return imagecolorallocate($image,mt_rand(130,255),mt_rand(130,255),mt_rand(130,255));//为一幅图像分配颜色
    }

    //深色
    function deepColor($image){
        return imagecolorallocate($image,mt_rand(0,129),mt_rand(0,129),mt_rand(0,129));
    }
?>
<?php 
    /**
     * 水印函数(其实就是将小图合并到大图上)
     */
    waterMark('1.jpg');
    function waterMark($source,$water='4.png',$position=0,$alpha=100,$type='jpg',$path='test',$isRandName=true){
        //打开图片
        $sourceRes = open($source);//打开大图
        $waterRes = open($water);//打开小图(水印图)
        //获取图片大小 算出位置
        $sourceInfo = getimagesize($source);
        // var_dump($sourceInfo);
        $waterInfo = getimagesize($water);
        // var_dump($waterInfo);
        //算位置
        switch($position){
            case 1:
                $x = 0;
                $y = 0;
                break;
            case 2:
                $x = ($sourceInfo[0]-$waterInfo[0])/2;
                $y = 0;
                break;
            case 3:
                $x = $sourceInfo[0]-$waterInfo[0];
                $y = 0;
                break;
            case 4:
                $x = 0;
                $y = ($sourceInfo[1]-$waterInfo[1])/2;
                break;
            case 5:
                $x = ($sourceInfo[0]-$waterInfo[0])/2;
                $y = ($sourceInfo[1]-$waterInfo[1])/2;
                break;
            case 6:
                $x = $sourceInfo[0]-$waterInfo[0];
                $y = ($sourceInfo[1]-$waterInfo[1])/2;
                break;
            case 7:
                $x = 0;
                $y = $sourceInfo[1]-$waterInfo[1];
                break;
            case 8:
                $x = ($sourceInfo[0]-$waterInfo[0])/2;
                $y = $sourceInfo[1]-$waterInfo[1];
                break;
            case 9:
                $x = $sourceInfo[0]-$waterInfo[0];
                $y = $sourceInfo[1]-$waterInfo[1];
                break;
            default:
                $x = mt_rand(0,$sourceInfo[0]-$waterInfo[0]);
                $y = mt_rand(0,$sourceInfo[1]-$waterInfo[1]);
                break;
        }
        //吧x y求出来 供两张图片合并时使用
        //bool imagecopymerge( resource $dst_im, resource $src_im, int $dst_x, int $dst_y, int $src_x, int $src_y, int $src_w, int $src_h, int $pct)
        imagecopymerge($sourceRes,$waterRes,$x,$y,0,0,$waterInfo[0],$waterInfo[1],$alpha);
        $func = 'image'.$type;// imagejpeg() imagepng()等等函数 用户输出图像到浏览器或文件;
        //处理path路径是否启用随机文件名
        if($isRandName){
            $name = uniqid().'.'.$type;//uniqid()生成一个唯一ID
            // var_dump($name);
        }else{
            $pathInfo = pathinfo($source);
            // var_dump($pathinfo);
            $name = $pathInfo['filename'].'.'.$type;
        }
        $path = rtrim($path,'/').'/'.$name;// rtrim()删除字符串末端的空白字符（或者其他字符）

        if($type == 'jpg'){//因为imagejpg()方法不存在 所以输出图像的方法需要再设置一下
            $func = 'imagejpeg';
        }
        $func($sourceRes,$path);
        imagedestroy($sourceRes);
        imagedestroy($waterRes);
    }

    //打开图片函数
    function open($path){
        //判断是否存在图片
        if(!file_exists($path)){//file_exists()检查文件或目录是否存在
            exit('文件不存在!');
        }
        $info = getimagesize($path);//获取图片大小
        // var_dump($info);
        switch($info['mime']){
            case 'image/jpg':
            case 'image/jpeg':
            case 'image/pjpeg':
                $res = imagecreatefromjpeg($path);//imagecreatefromjpeg()由文件或 URL 创建一个新图象
                break;
            case 'image/png':
                $res  = imagecreatefrompng($path);
                break;
            case 'image/gif':
                $res  = imagecreatefromgif($path);
                break;
            case 'image/wbmp':
            case 'image/bmp':
                $res  = imagecreatefromwbmp($path);
                break;
        }
        return $res;
    }
?>
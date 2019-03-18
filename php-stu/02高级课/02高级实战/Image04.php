<?php
    /**
     * 图像处理类:
     * 
     * 
     */

    class Image04{
        //路径
        protected $path;
        //是否启用随即名
        protected $isRandName;
        //要保存的类型
        protected $type;

        public function __construct($path='./',$isRandName = true,$type = 'png'){
            $this->path = $path;
            $this->isRandName = $isRandName;
            $this->type = $type;
        }

        // 对外公开的水印方法
        /**
         * $image 源图片
         * $water 水印图片
         * $position 水印图片位置
         * $alpha = 100 水印图片透明度
         * $prefix = 'water_' 前缀
         */
        function water($image,$water,$position,$alpha = 100,$prefix = 'water_'){
            //1 判断两个图片是否存在
            if((!file_exists($image)) || (!file_exists($water))){
                die('图片文件不存在');
            }
            //2 得到源图片的宽高度 以及水印图片宽高度
            $imageInfo = self::getImageInfo($image);
            $waterInfo = self::getImageInfo($water);
            //3判断水印图片能否贴上来
            if(!$this->checkImage($imageInfo,$waterInfo)){
                exit('水印图片太大');
            }
            //4 打开图片
            $imageRes = self::openAnyImage($image);
            $waterRes = self::openAnyImage($water);
            //5 根据水印图片位置计算水印图片的坐标
            $pos = $this->getPosition($position,$imageInfo,$waterInfo);
            //6 将水印图片贴过来
            imagecopymerge($imageRes,$waterRes,$pos['x'],$pos['y'],0,0,$waterInfo['width'],$waterInfo['height'],$alpha);
            //7 得到要保存图片的文件名
            $newName = $this->createNewName($image,$prefix);
            //8 得到保存图片的路径 也就是文件的全路径
            $newPath = rtrim($this->path,'/').'/'.$newName;
            //9 保存图片
            $this->saveImage($imageRes,$newPath);
            //10 销毁资源
            imagedestroy($imageRes);
            imagedestroy($waterRes);

            return $newPath;
        }
        
        //对外公开的缩放方法
        /**
         * $image 需要缩放的图片
         * $width 缩放后的宽度
         * $height 缩放后的高度
         * $prefix 前缀
         */
        function suofang($image,$width,$height,$prefix='sf_'){
            //1 得到图片原来的宽高度
            $info = self::getImageInfo($image);
            //2 根据图片原来的宽高和最终要缩放宽高计算得到图形不变形的宽高
            $size = $this->getNewSize($width,$height,$info);
            //3 打开图片资源
            $imageRes = self::openAnyImage($image);
            //4 进行缩放
            $newRes = $this->kidOfImage($imageRes,$size,$info);
            //5 保存图片
            $newName = $this->createNewName($image,$prefix);
            $newPath = rtrim($this->path,'/').'/'.$newName;
            $this->saveImage($newRes,$newPath);
            //6 销毁图像资源
            imagedestroy($imageRes);
            imagedestroy($newRes);
        }

        //静态方法 根据图片的路径得到图片的信息 宽高度 mime类型
        static function getImageInfo($imagePath){
            // 得到图片信息
            $info = getimagesize($imagePath);
            //保存图像宽度
            $data['width'] = $info[0];
            //保存图像高度
            $data['height'] = $info[1];
            //保存图像mime类型
            $data['mime'] = $info['mime'];
            //将图像信息返回
            return $data;
        }
        
        //判断两张图片的大小
        protected function checkImage($imageInfo,$waterInfo){
            if(($waterInfo['width'] > $imageInfo['width']) || ($waterInfo['height'] > $imageInfo['height'])){
                return false;
            }
            return true;
        }

        //打开图片的静态方法 因为图片的mime类型不同 需要使用的方法也不同
        static function openAnyImage($imagePath){
            //得到图像的mime类型
            $mime = self::getImageInfo($imagePath)['mime'];
            //根据不同的mime 使用不同的函数进行打开图像
            switch ($mime) {
                case 'image/png':
                    $image = imagecreatefrompng($imagePath);
                    break;
                case 'image/jpg':
                    $image = imagecreatefromjpeg($imagePath);
                    break;
                case 'image/jpeg':
                    $image = imagecreatefromjpeg($imagePath);
                    break;
                case 'image/gif':
                    $image = imagecreatefromgif($imagePath);
                    break;
                case 'image/wbmp':
                    $image = imagecreatefromwbmp($imagePath);
                    break;
                case 'image/bmp':
                    $image = imagecreatefromwbmp($imagePath);
                    break;
            }
            return $image;
        }

        //根据位置计算水印图片的坐标
        protected function getPosition($position,$imageInfo,$waterInfo){
            switch ($position) {
                case 1:
                    $x = 0;
                    $y = 0;
                    break;
                case 2:
                    $x = ($imageInfo['width'] - $waterInfo['width']) / 2;
                    $y = 0;
                    break;
                case 3:
                    $x = $imageInfo['width'] - $waterInfo['width'];
                    $y = 0;
                    break;
                case 4:
                    $x = 0;
                    $y = ($imageInfo['height'] - $waterInfo['height']) / 2;
                    break;
                case 5:
                    $x = ($imageInfo['width'] - $waterInfo['width']) / 2;
                    $y = ($imageInfo['height'] - $waterInfo['height']) / 2;
                    break;
                case 6:
                    $x = ($imageInfo['width'] - $waterInfo['width']);
                    $y = ($imageInfo['height'] - $waterInfo['height']) / 2;
                    break;
                case 7:
                    $x = 0;
                    $y = $imageInfo['height'] - $waterInfo['height'];
                    break;
                case 8:
                    $x = ($imageInfo['width'] - $waterInfo['width']) / 2;
                    $y = $imageInfo['height'] - $waterInfo['height'];
                    break;
                case 9:
                    $x = $imageInfo['width'] - $waterInfo['width'];
                    $y = $imageInfo['height'] - $waterInfo['height'];
                    break;
                case 0:
                    $x = mt_rand(0,$imageInfo['width'] - $waterInfo['width']);
                    $y = mt_rand(0,$imageInfo['height'] - $waterInfo['height']);
                    break;
            }
            return ['x' => $x,'y' => $y];
        }

        //得到文件名函数
        protected function createNewName($imagePath,$prefix){
            if($this->isRandName){
                $name = $prefix.uniqid().'.'.$this->type;
            }else{
                $name = $prefix.pathinfo($imagePath)['filename'].'.'.$this->type;
            }
            return $name;
        }

        //保存已经添加水印后的图片的方法 保存图像资源函数
        protected function saveImage($imageRes,$newPath){
            //imagepng imagegif imagewbmp
            $func = 'image'.$this->type;
            //通过变量函数进行保存
            $func($imageRes,$newPath);
        }

        //处理透明色函数
        protected function kidOfImage($srcImg,$size,$imgInfo){
            //传入新的尺寸 创建一个指定尺寸的图片
            $newImg = imagecreatetruecolor($size['old_w'],$size['old_h']);//imagecreatetruecolor新建一个真彩色图像
            //定义透明色
            $otsc = imagecolortransparent($srcImg);// 将某个颜色定义为透明色
            if($otsc >= 0){
                //取得透明色
                $transparentcolor = imagecolorsforindex($srcImg,$otsc);//取得某索引的颜色
                //创建透明色
                $newtransparentcolor = imagecolorallocate(
                    $newImg,
                    $transparentcolor['red'],
                    $transparentcolor['green'],
                    $transparentcolor['blue']
                );//为一幅图像分配颜色
            }else{
                // 将黑色作为透明色 因为创建图像后第一次分配颜色时背景默认为黑色
                $newtransparentcolor = imagecolorallocate($newImg,0,0,0);
            }
            //背景填充颜色
            imagefill($newImg,0,0,$newtransparentcolor);
            imagecolortransparent($newImg,$newtransparentcolor);
            imagecopyresampled($newImg,$srcImg,$size['x'],$size['y'],0,0,$size['new_w'],
                $size['new_h'],$imgInfo['width'],$imgInfo['height']);//重采样拷贝部分图像并调整大小
            return $newImg;
        }

        //计算图像最终的宽度和高度
        /**
         * $width 最终缩放的宽度
         * $height 最终缩放的高度
         * $imgInfo 原始图片的宽度和高度
         */
        protected function getNewSize($width,$height,$imgInfo){
            $size['old_w'] = $width;
            $size['old_h'] = $height;

            $scaleWidth = $width / $imgInfo['width'];
            $scaleHeight = $height / $imgInfo['height'];
            $scaleFinal = min($scaleWidth,$scaleHeight);

            $size['new_w'] = round($imgInfo['width'] * $scaleWidth);
            $size['new_h'] = round($imgInfo['height'] * $scaleHeight);
            if($scaleWidth < $scaleHeight){
                $size['x'] = 0;
                $size['y'] = round(abs($size['new_h'] - $height) / 2);
            }else{
                $size['y'] = 0;
                $size['x'] = round(abs($size['new_w'] - $width) / 2);
            }
            return $size;
        }
    }
/**-------------------------------------------------------------------------------- */
    //方法测试
    // var_dump(getimagesize('./233.jpg'));
    // var_dump(imagecreatetruecolor('./233.jpg'));

    $image = new Image04();
    // $image->water('./image.jpg','./water.png',mt_rand(0,9),100,'water_');//加水印
    // $image->suofang('./image.jpg','100','200',$prefix='sf_');//图像缩放
    $image->suofang('./image.jpg',1024,768);
?>
<?php
    /**
     * 验证码类:
     *  
     *  封装类原则:
     *      1:该类对外公开的方法只有一个，只要调用这个方法，就可以将验证码显示到浏览器，
     *        其他的为这个类服务的方法设置为protected，供子类继承和重写
     *      2:有些变量在该类里面被反复使用，我们将其保存为成员属性，将不用公开的成员属性设置为prote
     *      验证码个数:$number
     *      验证码类型:$codeType
     *      验证码图像宽度:$width
     *      验证码图像高度:$height
     *      验证码:$code
     *      图像资源:$image
     * 
     *  验证码类步骤:
     *      1生成验证码
     *      2创建画布
     *      3填充背景色
     *      4将验证码画到画布中
     *      5添加干扰元素
     *      6输出显示
     */
/**------------------------------------------------------------------------------------------- */
    //测试
    $code = new Code01(5,2,300,50);
    // echo $code->code;
    echo $code->outImage();

    class Code01{//类名和文件名要相同且遵循大驼峰原则(此处起这怪异名字 只是为了后面复盘便于查看而已)
        //以下都为成员属性
        protected $number;//验证码个数
        protected $codeType;//验证码类型
        protected $width;//验证码图像宽度
        protected $height;//验证码图像高度
        protected $code;//验证码字符串
        protected $image;//图像资源
        public function __construct($number,$codeType,$width,$height){
            //初始化自己的成员属性
            $this->number = $number;
            $this->codeType = $codeType;
            $this->width = $width;
            $this->height = $height;
            
            //生成验证码函数
            $this->code = $this->createCode();
            // echo $this->code;
        }

        //析构方法 当对象被销毁时 该方法自动调用
        public function __destruct(){
            imagedestroy($this->image);
        }

        // 创建魔术方法 方便类外调用
        public function __get($name){
            if($name == 'code'){
                return $this->code;
            }
            return false;
        }

        protected function createCode(){
            //通过验证码类型给生成不同的验证码
            switch ($this->codeType) {
                case 0://纯数字
                    $code = $this->getNumberCode();
                    break;
                case 1://纯字母
                    $code = $this->getCharCode();
                    break;
                case 2://数字和字母混合
                    $code = $this->getNumCharCode();
                    break;
                default:
                    die('不支持验证码类型');
            }
            return $code;
        }

        // 生成纯数字验证码
        protected function getNumberCode(){
            $str = join('',range(0,9));//join与implode相同  将一个一维数组的值转化为字符串; range — 建立一个包含指定范围单元的数组
            return substr(str_shuffle($str),0,$this->number);//substr返回字符串的子串即为 截取; str_shuffle随机打乱一个字符串
        }

        // 生成纯字母验证码
        protected function getCharCode(){
            $str = join('',range('a','z'));
            $str = $str.strtoupper($str);//小写a-z的字符串 拼接 转换为大写的A-Z字符串 (strtolower同理)
            return substr(str_shuffle($str),0,$this->number);
        }
        
        // 生成数字和字母混合验证码
        protected function getNumCharCode(){
            //数字
            $numStr = join('',range(0,9));
            //字母
            $letterStr = join('',range('a','z'));
            //拼接
            $str = $numStr.$letterStr.strtoupper($letterStr);
            return substr(str_shuffle($str),0,$this->number);
        }

        //创建画布方法
        protected function createImage(){
            $this->image = imagecreatetruecolor($this->width,$this->height);
        }

        //填充背景色方法
        protected function fillBack(){
            imagefill($this->image,0,0,$this->lightColor());//imagefill 区域填充
        }
        //浅色
        protected function lightColor(){
            return imagecolorallocate($this->image,mt_rand(130,255),mt_rand(130,255),mt_rand(130,255));//为一幅图像分配颜色
        }
        //深色
        protected function deepColor(){
            return imagecolorallocate($this->image,mt_rand(0,120),mt_rand(0,120),mt_rand(0,120));//为一幅图像分配颜色
        }

        //画到画布中
        protected function drawChar(){
            $width = ceil($this->width / $this->number);//验证码的单个字符 所占的宽度
            // $height = ceil($this->height / $this->number);//垂直方向只有一个字符 所以单个高度就不需要求值
            for($i = 0; $i < $this->number; $i++){
                // $x 应该需要优化 当验证码个数太多时 因为向上取整 导致$i*$width可能会超出画布宽度 暂时如此吧
                $x = mt_rand($i * $width + 5,($i + 1) * $width - 5);//理论上后面数值应该减去一个数值;但是当取最长的随机数时 会报错...;所以应该+一个数值;即使52个字符串也不会报错
                $y = mt_rand(0,$this->height - 15);
                imagechar($this->image,5,$x,$y,$this->code[$i],$this->deepColor());//imagechar()水平的画一个字符
            }
        }

        //干扰元素方法
        protected function drawDisturb(){
            //干扰点
            $x = mt_rand(0,$this->width);
            $y = mt_rand(0,$this->height);
            for($i = 0; $i < 150; $i++){
                imagesetpixel($this->image,$x,$y,$this->lightColor());//imagesetpixel画一个单一元素
            }
            //干扰线 椭圆弧
            for($i = 0; $i < 15; $i++){
                imagearc($this->image,$x,$y,$this->width,$this->height,mt_rand(0,10),mt_rand(10,270),$this->lightColor());//imagearc画椭圆弧并填充
            }
        }

        //输出并且显示
        protected function show(){
            //设置header头
            header('Content-Type:image/png');
            imagepng($this->image);
        }

        //输出验证码到画布
        public function outImage(){
            //创建画布
            $this->createImage();
            //填充背景色
            $this->fillBack();
            //将验证码字符串画到画布中
            $this->drawChar();
            //添加干扰字符
            $this->drawDisturb();
            //输出并显示
            $this->show();
        }
    }
?>
<?php
    /**
     * 文件上传类: 以上传图片为例
     * 
     * 成员属性有:
     *      需要初始化的成员:
     *          文件上传路径
     *          允许上传后缀
     *          允许上传的mime
     *          允许上传的文件size
     *          是否启用随机名
     *          加上文件前缀
     *      
     *      自定义的错误号码和错误信息
     * 
     *      要保存的文件信息
     *          文件名
     *          文件后缀
     *          文件大小
     *          文件mime
     *          文件临时路径
     *      文件新名字
     * 
     * 对外公开方法有
     *      uploadFile($key)    上传成功返回文件路径    上传失败返回false
     * 外部可以直接获取错误号码和错误信息
     * 
     */

    class FileUpload03{
        //文件上传保存路径
        protected $path = './upload/';
        //允许上传后缀
        protected $allowSuffix = ['jpg','jpeg','gif','wbmp','png'];
        //允许上传的mime
        protected $allowMime = ['image/jpeg','image/gif','image/png','image/wbmp'];
        //允许上传的文件size
        protected $maxSize = 5*1024*1024;//php.ini默认限制为2M,已修改
        //是否启用随机名
        protected $isRandName = true;
        //文件前缀
        protected $prefix = 'up_';

        //自定义 错误号码 错误信息
        protected $errorNumber;
        protected $errorInfo;

        //文件信息
        protected $oldName;//文件名
        protected $suffix;//文件后缀
        protected $size;//文件大小
        protected $mine;//文件mime
        protected $tmpName;//文件临时路径

        //文件新名字
        protected $newName;

        public function __construct($arr = []){
            foreach ($arr as $key => $value) {
                $this->setOption($key,$value);
            }
        }

        //判断$key是否是成员属性 如果是 则设置
        protected function setOption($key,$value){
            // get_class_vars — 返回由类的默认属性组成的数组
            // __CLASS__ 返回该类被定义时的名字
            // array_keys 返回 input 数组中的数字或者字符串的键名
            //得到所有的成员属性 
            $keys = array_keys(get_class_vars(__CLASS__));
            // 如果$key是我的成员属性 那么设置
            if(in_array($key,$keys)){//in_array 检查数组中是否存在某个值
                $this->$key = $value;
            }
        }
        
        // 文件上传函数
        // $key 就是 input框中的name属性值
        public function uploadFile($key){
            //判断有没有设置路径 path
            if(empty($this->path)){
                $this->setOption('errorNumber',-1);
                return false;
            }
            //判断该路径是否存在 是否可写
            if(!$this->check()){
                $this->setOption('errorNumber',-2);
                return false;
            }
            //判断$_FILES里面的error信息是否为0 如果为0 说明文件信息 在服务端可以直接获取 提取信息保存到成员属性中
            $error = $_FILES[$key]['error'];
            if($error){
                $this->setOption('errorNumber',$error);
                return false;
            }else{
                //提取文件相关信息保存到成员属性中
                $this->getFileInfo($key);
            }
            //判断文件大小 mime 后缀是否符合
            if(!$this->checkSize() || !$this->checkMime() || !$this->checkSuffix()){
                return false;
            }
            // 得到新的文件名字
            $this->newName = $this->createNewName();
            // 判断是否是上传文件 并且移动上传文件
            if(is_uploaded_file($this->tmpName)){// is_uploaded_file判断文件是否是通过 HTTP POST 上传的
                if(move_uploaded_file($this->tmpName,$this->path.$this->newName)){// move_uploaded_file将上传的文件移动到新位置
                    return $this->path.$this->newName;
                }else{
                  $this->setOption('errorNumber',-7);  
                  return false;
                }
            }else{
                $this->setOption('errorNumber',-6);
                return false;
            }
        }

        //关于检测 文件夹是否存在 若不存在则创建 以及是否可写
        protected function check(){
            //文件夹不存在 或者 不是目录 然后创建文件夹
            if(!file_exists($this->path) || !is_dir($this->path)){//file_exists 检查文件或目录是否存在
                return mkdir($this->path,0777,true);
            }
            //判断文件是否可写
            if(!is_writeable($this->path)){//别名 is_writable()
                return chmod($this->path,0777);
            }
            return true;
        }

        //得到文件信息
        protected function getFileInfo($key){
            //得到文件名字
            $this->oldName = $_FILES[$key]['name'];
            //得到文件的mime类型
            $this->mime = $_FILES[$key]['type'];
            //得到文件临时路径
            $this->tmpName = $_FILES[$key]['tmp_name'];
            //得到文件大小
            $this->size = $_FILES[$key]['size'];
            //得到文件后缀
            $this->suffix = pathinfo($this->oldName)['extension'];// pathinfo返回一个关联数组包含有 path 的信息
        }

        //判断文件大小
        protected function checkSize(){
            if($this->size > $this->maxSize){
                $this->setOption('errorNumber',-3);
                return false;
            }
            return true;
        }
        //判断文件mime类型
        protected function checkMime(){
            if(!in_array($this->mime,$this->allowMime)){
                $this->setOption('errorNumber',-4);
                return false;
            }
            return true;
        }
        //判断文件后缀
        protected function checkSuffix(){
            if(!in_array($this->suffix,$this->allowSuffix)){
                $this->setOption('errorNumber',-5);
                return false;
            }
            return true;
        }

        //得到文件的新名字
        protected function createNewName(){
            if($this->isRandName){
                $name = $this->prefix.uniqid().'.'.$this->suffix;//uniqid 生成一个唯一ID 即生成一个随机数
            }else{
                $name = $this->prefix.$this->oldName;
            }
            return $name;
        }

        //上传错误信息显示
        public function __get($name){
            if($name == 'errorNumber'){
                return $this->errorNumber;
            }else if($name == 'errorInfo'){
                return $this->getErrorInfo();
            }
        }

        //错误信息 方法
        protected function getErrorInfo(){
            switch ($this->errorNumber) {
                case -1:
                    $str = '文件路径没有设置';
                    break;
                case -2:
                    $str = '文件路径不是目录或者没有权限';
                    break;
                case -3:
                    $str = '文件大小超出限制';
                    break;
                case -4:
                    $str = '文件mime类型不符合';
                    break;
                case -5:
                    $str = '文件后缀不符合';
                    break;
                case -6:
                    $str = '不是上传文件';
                    break;
                case -7:
                    $str = '文件上传失败';
                    break;
                case 1:
                    $str = '上传的文件超过了 php.ini 中 upload_max_filesize 选项限制的值';
                    break;
                case 2:
                    $str = '上传文件的大小超过了 HTML 表单中 MAX_FILE_SIZE 选项指定的值';
                    break;
                case 3:
                    $str = '文件只有部分被上传';
                    break;
                case 4:
                    $str = '没有文件被上传';
                    break;
                case 6:
                    $str = '找不到临时文件夹';
                    break;
                case 7:
                    $str = '文件写入失败';
                    break;
            }
            return $str;
        }
    }

    $upload = new FileUpload03();
    $upload->uploadFile('fileupload');
    var_dump($upload->errorNumber);
    var_dump($upload->errorInfo);
?>
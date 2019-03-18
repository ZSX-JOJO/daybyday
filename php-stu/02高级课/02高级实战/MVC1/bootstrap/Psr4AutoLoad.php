<?php
    class Psr4AutoLoad{
        //这里存放命名空间映射
        protected $maps = [];

        function __construct(){
            spl_autoload_register([$this,'autoload']);
        }

        //自己写的自动加载函数
        function autoload($className){
            //完整的类名 由 命名空间名和类名组成
            //得到命名空间名 根据命名空间名得到其目录路径
            $pos = strrpos($className,'\\');//计算指定字符串在目标字符串中最后一次出现的位置
            $nameSpace = substr($className,0,$pos);//得到命名空间名
            $realClass = substr($className,$pos+1);//得到类名
            //找到文件并且包含进来
            $this->mapLoad($nameSpace,$realClass);
        }

        //根据命名空间名得到目录路径并且拼接真正的文件全路径
        protected function mapLoad($nameSpace,$realClass){
            //
            if(array_key_exists($nameSpace,$this->maps)){
                $nameSpace = $this->maps[$nameSpace];
            }
            //处理路径
            $nameSpace = rtrim(str_replace('\\','/',$nameSpace),'/').'/';
            //拼接文件全路径
            $filePath = $nameSpace.$realClass.'.php';
            //将该文件包含进来
            if(file_exists($filePath)){
                include $filePath;
            }else{
                die('该文件不存在');
            }
        }

        // 映射函数 将命名空间和路径保存到映射数组中
        function addMaps($nameSpace,$path){
            if(array_key_exists($nameSpace,$this->maps)){
                die('命名空间已经映射过');
            }
            //将命名空间和路径 已 键值对形式 存放到数组中
            $this->maps[$nameSpace] = $path;
        }
    }
?>
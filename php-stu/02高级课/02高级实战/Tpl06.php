<?php
    /**
     * 模版引擎原理
     * 
     *      html中穿插php代码 但是文件后缀名是PHP
     *      例如:条件语句时 {替换为:  }替换条件语句所对应的end** 
     *      <html>
     *          <?=$title;?>
     *          <?php if($a>5):?>
     *          <?php endif;?>
     *      </html>
     * 
     *      在html页面中展示数据的时候使用模版语法
     *      通过模版引擎将html中的模版语法替换为PHP语法
     *      通过正则表达式来替换模版语法
     *      然后将替换后的字符换写入到一个文件中 这个文件叫做缓存文件 缓存文件后缀也是php
     *      将缓存文件include进来即可以显示当前页面
     * 
     * 正则替换
     *      preg_replace($pattern,$replace,$str)//将正则匹配到的字符串替换为指定的字符串
     *      preg_quote()//{} [] () * . ? +  转义正则表达式字符 (定界符 元字符 元子 模式修正符)
     *      preg_replace_callback($pattern,callback,$str)// 执行一个正则表达式搜索并且使用一个回调进行替换
     * 
     * include
     *      {include xxx.html}
     *      <?php include xxx.php;?>
     * 
     * 缺点 (面向过程)
     *      每次都会生成缓存(缓存文件不需要每次都生成 可以设置时间 比如生命周期)
     *      分页时生成的都是同一个缓存文件
     */

    class Tpl06{
        //模版文件的路径
        protected $viewDir = './view/';
        //生成的缓存文件的路径
        protected $cacheDir = './cache/';
        //过期时间
        protected $lifeTime = 3600;
        //用来存放显示变量的数组
        protected $vars = [];

        //对成员变量进行初始化
        function __construct($viewDir = null,$cacheDir = null,$lifeTime = null){
            //判断是否为空 如果为空 使用默认值 如果不为空 判断并设置
            if(!empty($viewDir)){
                //判断所传递路径是否是目录
                if($this->checkDir($viewDir)){
                    $this->viewDir = $viewDir;
                }
            }

            if(!empty($cacheDir)){
                if($this->checkDir($cacheDir)){
                    $this->cacheDir = $cacheDir;
                }
            }

            if(!empty($lifeTime)){
                $this->lifeTime = $lifeTime;
            }
        }

        //判断路径是否正确
        protected function checkDir($dirPath){
            //如果目录不存在或者不是目录那么创建该目录
            if(!file_exists($dirPath) || !is_dir($dirPath)){
                return mkdir($dirPath,0755,true);
            }
            //目录是否有读写权限
            if(!is_writable($dirPath) || !is_readable($dirPath)){
                return chmod($dirPath,0755);
            }
        }
        
        
        //对外公开显示的方法
        //分配变量的方法
        //例如 $title = '赵守鑫'  $tpl->assign('title',$title);
        function assign($name,$value){
            $this->vars[$name] = $value;
        }
        //展示缓存文件方法
        //$viewName 模版文件名
        //$isInclude 模版文件是仅仅需要编译 还是先编译再包含进来
        //$uri  index.php?page=1 为了让缓存的文件名不重复 将文件名和uri拼接起来再md5一下 生成缓存的文件名
        function display($viewName,$isInclude = true,$uri = null){
            //拼接模版文件的全路径
            $viewPath = rtrim($this->viewDir,'/').'/'.$viewName;
            if(!file_exists($viewPath)){
                die('模版文件不存在');
            }
            //拼接缓存文件的全路径
            $cacheName = md5($viewName.$uri).'.php';
            $cachePath = rtrim($this->cacheDir,'/').'/'.$cacheName;
            //根据缓存文件的全路径 判断缓存文件是否存在
            if(!file_exists($cachePath)){
                //编译模版文件
                $php = $this->compile($cachePath);
                //写入文件 生成缓存文件
                file_put_contents($cachePath,$php);//file_put_contents将一个字符串写入文件
            }else{
                //如果缓存文件不存在 编译模版文件 生成缓存文件
                //如果模版文件存在 
                //1判断缓存文件是否过期 
                //2判断模版文件是否被修改过 如果模版文件被修改过 缓存文件需要重新生成
                //filectime取得文件的 inode 修改时间
                $isTimeout = (filectime($cachePath) + $this->lifeTime) > time() ? false : true;
                $isChange = filemtime($viewPath) > filemtime($cachePath) ? true : false;
                if($isTimeout || $isChange){
                    $php = $this->compile($viewPath);//重新生成模版文件
                    file_put_contents($cachePath,$php);//重新新的缓存文件
                }

            }
            //判断缓存文件是否需要包含进来
            if($isInclude){
                //将变量解析出来
                extract($this->vars);//extract从数组中将变量导入到当前的符号表
                //展示缓存文件
                include $cachePath;
            }
        }

        //compile 方法 编译HTML文件
        protected function compile($filePath){//运行不出来 就是这里的锅 正在查找
            //读取文件内容
            $html = file_get_contents($filePath);//???这里的问题
            //正则替换
            $array = [
                '{$%%}' => '<?=$\1; ?>',
                '{foreach %%}' => '<?php foreach (\1): ?>',
                '{/foreach}' => '<?php endforeach ?>',
                '{include %%}' => '',
                '{if %%}' => '<? php if (\1): ?>'
            ];
            //遍历数组 将%%全部修改为 .+  然后执行正则替换
            foreach($array as $key => $value){
                //生成正则表达式
                $pattern = '#'.str_replace('%%','(.+?)',preg_quote($key,'#')).'#';
                //实现正则替换
                if(strstr($pattern,'include')){
                    $html = preg_replace_callback($pattern,[$this,'parseInclude'],$html);
                }else{
                    //执行替换
                    $html = preg_replace($pattern,$value,$html);
                }
            }
            //返回替换后的内容
            return $html;
        }

        //处理include正则表达式 $data就是匹配到的内容
        protected function parseInclude($data){
            //将文件名两边的引号去掉
            $fileName = trim($data[1],'\'"');
            //然后不包含文件生成缓存
            $this->display($fileName,false);
            //拼接缓存文件的全路径
            $cacheName = md5($fileName).'.php';
            $cachePath = rtrim($this->cacheDir,'/').'/'.$cacheName;
            return '<?php include "'.$cachePath.'" ?>';
        }
    }
?>
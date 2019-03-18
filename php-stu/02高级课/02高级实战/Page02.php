<?php
    /**
     * 分页类:
     *      
     * $_SERVER
     * REQUEST_URI  除了协议主机端口以外的所有东西
     * SERVER_PORT  端口号 http:80 https:443 ftp:21
     * SERVER_NAME  主机名
     * REQUEST_SCHEME   协议
     * 
     * parse_url //解析 URL，返回其组成部分
     *      path:文件的路径
     *      query:请求的参数
     * 
     * parse_str() //将字符串解析成多个变量
     *      将query字符串变成关联数组 
     * 
     * http_build_query //生成 URL-encode 之后的请求字符串
     *      将关联数组转化为query字符串
     * 
     * //每页显示个数
     * protected $number 
     * //一共多少条数据
     * protected $totalCount
     * //一共多少页
     * protected $totalPage
     * //当前页
     * protected $page
     * //url
     * protected $url 
     */
    class Page02{
        protected $number;
        protected $totalCount;
        protected $totalPage;
        protected $page;
        protected $url;

        public function __construct($number,$totalCount){
            $this->number = $number;
            $this->totalCount = $totalCount;
            //得到总页数
            $this->totalPage = $this->getTotalPage();
            //得到当前页数
            $this->page = $this->getPage();
            //得到URL
            $this->url = $this->getUrl();
            // echo $this->url;
        }
        //得到总页数
        protected function getTotalPage(){
            return ceil($this->totalCount / $this->number);
        }
        //得到当前页数
        protected function getPage(){
            if(empty($_GET['page'])){
                $page = 1;
            }else if($_GET['page'] > $this->totalPage){
                $page = $this->totalPage;
            }else if($_GET['page'] < 1){
                $page = 1;
            }else{
                $page = $_GET['page'];
            }
            return $page;
        }
        //得到URL 此类最核心
        protected function getUrl(){
            //得到协议名
            $scheme = $_SERVER['REQUEST_SCHEME'];
            //得到主机名
            $host = $_SERVER['SERVER_NAME'];
            //得到端口号
            $port = $_SERVER['SERVER_PORT'];
            //得到路径和请求字符串
            $uri = $_SERVER['REQUEST_URI'];
            /**
             * 处理 将page=5这种字符串拼接URL中，如果原来URL中存在page
             * 这个参数 则需要先将原来的page参数给清空
             */
            //解析 URL，返回其组成部分
            $uriArray = parse_url($uri);
            // var_dump($uriArray);
            $path = $uriArray['path'];
            if(!empty($uriArray['query'])){
                //将请求字符串变为关联数组
                parse_str($uriArray['query'],$array);
                //清除掉关联数组中的page键值对
                unset($array['page']);// unset释放给定的变量
                //将剩下的参数拼接为请求字符串
                $query = http_build_query($array);
                //再将请求字符串拼接到路径后面
                if($query != ''){
                    $path = $path.'?'.$query;
                }
            }
            return $scheme.'//'.$host.':'.$port.$path;
        }
        //
        protected function setUrl($str){
            if(strstr($this->url,'?')){//strstr查找字符串的首次出现
                $url = $this->url.'$'.$str;//如果有?说明已经带着参数; 所以在后面需要拼接$和$str
            }else{
                $url = $this->url.'?'.$str;//如果没有?说明没有带参数; 所以直接在后面直接拼接?和$str
            }
            return $url;
        }
        public function allUrl(){
            return [
                'first' => $this->first(),
                'prev' => $this->prev(),
                'next' => $this->next(),
                'end' => $this->end()
            ];
        }
        public function first(){
            return $this->setUrl('page=1');
        }
        public function next(){
            //根据当前page得到下一页页码
            if($this->page + 1 > $this->totalPage){
                $page = $this->totalPage;
            }else{
                $page = $this->page + 1;
            }
            return $this->setUrl('page='.$page);
        }
        public function prev(){
            if($this->page - 1 < 1){
                $page = 1;
            }else{
                $page = $this->page - 1;
            }
            return $this->setUrl('page='.$page);
        }
        public function end(){
            return $this->setUrl('page='.$this->totalPage);
        }
        public function limit(){
            $offset = ($this->page - 1) * $this->number;//偏移量
            return $offset.','.$this->number;//当前页去多少条数据
        }
    }
    //测试共4页
    //测试地址
    //http://www.stu.com:8080/02高级课/02高级实战/Page02.php?username=zsx&pass=12&page=1
    $page = new Page02(6,20);
    var_dump($page->allUrl());
?>
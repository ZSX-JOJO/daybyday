<?php 
    /**
     * 
     */
/**--------------------------------------------------------------------------------- */
    //单例
    class Dog{
        private function __construct(){}
        // 静态属性保存单例对象
        static private $instance;
        //通过静态方法创建单例对象
        static public function getInstance(){
            //判断$instance是否为空 如果为空 则new一个对象 否则直接返回
            if(!self::$instance){
                self::$instance = new self();
            }
            return self::$instance;
        }
    }
    $dog1 = Dog::getInstance();
    $dog2 = Dog::getInstance();
    if($dog1 === $dog2){
        echo '同一个对象';
    }else{echo '两个不同的对象';}
    echo '<br>';
/**--------------------------------------------------------------------------------- */
    //工厂模式
    interface Skill{
        function family();
        function buy();
    }
    class Person implements Skill{
        function family(){
            echo '人要努力,不然就是咸鱼<br>';
        }
        function buy(){
            echo '买<br>';
        }
    }
    class Zsx implements Skill{
        function family(){
            echo '赵守鑫你要努力啊<br>';  
        }
        function buy(){
            echo '赵守鑫买<br>';
        }
    }
    class Factory{//工厂类用以实例化对象
        static function Select($type){
            switch ($type) {
                case 'Person':
                    return new Person();
                    break;
                
                case 'Zsx':
                    return new Zsx();
                    break;
            }
        }
    }
    $person = Factory::Select('Person');
    $Zsx = Factory::Select('Zsx');
/**--------------------------------------------------------------------------------- */
    //工厂方法模式
    interface Tell{
        function call();
        function receive();
    }
    class Xiaomi implements Tell{
        function call(){
            echo '我用小米打电话<br>';
        }
        function receive(){
            echo '我用小米接电话<br>';
        }
    }
    class Meizu implements Tell{
        function call(){
            echo '我用魅族打电话<br>';
        }
        function receive(){
            echo '我用魅族接电话<br>';
        }
    }
    //工厂类只负责接口 具体的实现交给子类
    interface Factory2{
        static function createPhone();
    }
    class Xiaomi2 implements Factory2{
        static function createPhone(){
            return new Xiaomi2();
        }
    }
    class Meizu2 implements Factory2{
        static function createPhone(){
            return new Meizu2();
        }
    }
/**--------------------------------------------------------------------------------- */
    //观察者模式
    class Man{
        //用来存放观察者
        protected $observers = [];
        //添加观察者方法
        function addObservers($observers){
            $this->observers[] = $observers;
        }
        //花钱方法
        function buy(){
            //当被观察者做出这个反应的时候 让观察者得到通知 并且做出一定的反应
            foreach($this->observers as $girl){
                $girl->dongjie();
            }
        }
        //删除观察者方法
        function delObservers($observers){
            //查找对应值在数组中的键
            $key = array_search($observers,$this->observers);//array_search(查找的值,被查找)在数组中搜索给定的值，如果成功则返回相应的键名 
            //根据键删除值 并且数组重新索引
            array_splice($this->observers,$key,1);//把数组中的一部分去掉并用其它值取代
        }
    }
    class GirlFriend{
        function dongjie(){
            echo '男朋友正在花钱 冻结其银行卡<br>';
        }
    }
    $xiaoming = new Man();
    $xiaohua = new GirlFriend();
    $xiaoli = new GirlFriend();
    //添加观察者
    $xiaoming->addObservers($xiaohua);
    $xiaoming->addObservers($xiaoli);
    //删除一个观察者
    $xiaoming->delObservers($xiaoli);
    $xiaoming->buy();
/**--------------------------------------------------------------------------------- */
    //适配器模式
    interface PerfectMan{
        function cook();
        function writePhp();
    }
    class Wife{
        function cook(){
            echo '我会做饭<br>';
        }
    }
    class Goodman implements PerfectMan{
        protected $wife;
        //在创建对象的时候保存传递进来的对象
        function __construct($wife){
            $this->wife = $wife;
        }
        function cook(){
            $this->wife->cook();
        }
        function writePhp(){
            echo '我正在学习PHP<br>';
        }
    }
    $wife = new Wife();
    $good = new Goodman($wife);
    $good->writePhp();
    $good->cook();
/**--------------------------------------------------------------------------------- */
    //策略模式
    interface Love{
        function sajiao();
    }
    //策略
    class KeAi implements Love{
        function sajiao(){
            echo '讨厌<br>';
        }
    }
    //策略
    class Tiger implements Love{
        function sajiao(){
            echo '给老娘过来!<br>';
        }
    }
    class GF{
        protected $xingge;
        function __construct($xingge){
            $this->xingge = $xingge;
        }
        function sajiao(){
            $this->xingge->sajiao();
        }
    }
    $keai = new KeAi();
    $gf = new GF($keai);
    $gf->sajiao();
/**--------------------------------------------------------------------------------- */
    //门面模式
    class Light{
        function turnOn(){
            echo '打开闪光灯<br>';
        }
        function turnOff(){
            echo '关闭闪光灯<br>';
        }
    }
    class Camera{
        function active(){
            echo '打开照相机<br>';
        }
        function deactive(){
            echo '关闭照相机<br>';
        }
    }
    class Facade{
        protected $light;
        protected $camera;
        function __construct(){
            $this->light = new Light();
            $this->camera = new camera();
        }
        function start(){
            $this->light->turnOn();
            $this->camera->active();
        }
        function stop(){
            $this->light->turnOff();
            $this->camera->deactive();
        }
    }
    $f = new Facade();
    $f->start();
    $f->stop();
/**--------------------------------------------------------------------------------- */
    //依赖注入 容器    ??有点难以理解
    class LunTai{
        function roll(){
            echo '轮胎在滚动<br>';
        }
    }
    class BMW{
        protected $luntai;
        function __construct($luntai){
            $this->luntai = $luntai;
        }
        function run(){
            $this->luntai->roll();
            echo '开着宝马<br>';
        }
    }
    $luntai = new LunTai();
    $bmw = new BMW($luntai);
    $bmw->run();
    echo '<hr>';
    //容器
    class Container{
        // 存放所绑定类
        static $register = [];//键 类名 值 创建对象的方法
        // 绑定函数
        static function bind($name,Closure $col){
            self::$register[$name] = $col;
        }
        //创建对象函数
        static function make($name){
            $col = self::$register[$name];
            return $col();
        }
    }

    Container::bind('luntai',function(){
        return new LunTai();
    });
    Container::bind('bmw',function(){
        return new BMW(Container::make('luntai'));
    });
    $bmw2 = Container::make('bmw');
    $bmw2->run();
/**--------------------------------------------------------------------------------- */
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        .title{
            font-size:22px;
            color:red;
            text-align:center;
        }
        .title img{
            margin:0 auto;
        }
    </style>
</head>
<body>
    <div class="title">
        <div>设计模式概述</div>
        <img src="./design/0.png" alt="">
    </div>
    <div class="title">
        <div>单例</div>
        <img src="./design/1.png" alt="">
    </div>
    <div class="title">
        <div>工厂</div>
        <img src="./design/2.png" alt="">
    </div>
    <div class="title">
        <div>观察者</div>
        <img src="./design/3.png" alt="">
    </div>
    <div class="title">
        <div>适配器</div>
        <img src="./design/4.png" alt="">
    </div>
    <div class="title">
        <div>策略模式</div>
        <img src="./design/5-1.png" alt="">
        <img src="./design/5-2.png" alt="">
    </div>
    <div class="title">
        <div>门面模式</div>
        <img src="./design/6.png" alt="">
    </div>
    <div class="title">
        <div>DI依赖注入</div>
        <img src="./design/7.png" alt="">
    </div>
</body>
</html>
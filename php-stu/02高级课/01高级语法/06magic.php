<?php
    /**
     * 魔术方法: 系统在特定的时机自动调用的方法 所有的魔术方法都是public
     * 
     * 常用魔术方法:
     *      __get
     *          触发时机:对象 在外部 访问 私有成员 或者 受保护属性 时调用
     *                  该方法只有一个参数: 参数就是属性名
     *      __set:
     *          触发时机:对象 在外部 设置 私有成员 或者 受保护属性 时调用
     *                  参数1:成员属性名
     *                  参数2:要设置的值
     *      
     *      在外部可以通过unset销毁对象中的public属性
     *      __unset:
     *          触发时机:对象 在外部 销毁 私有成员 或者 受保护属性 时调用
     *                  该方法只有一个参数: 参数就是私有的成员属性名
     *      __isset:
     *          触发时机:对象 在外部 判断 私有成员 或者 受保护属性 时调用
     *                  该方法只有一个参数: 参数就是私有的成员属性名
     * 
     *      __construct: 构造方法
     *          触发时机:创建 对象时自动调用
     *      __destruct: 析构方法  
     *          触发时机:对象 被销毁 时自动调用
     *      
     *      __toString: 方法用于一个类被当成字符串时应怎样回应 不需要参数
     *          触发时机: echo 一个对象时触发
     *                  该函数需要return一个字符串(这个字符串可以自定义也可以打印对象自己的信息)
     *      __debugInfo: 不写此方法时 var_dump()默认输出对象的全部信息, 使用此魔术方法 可以设置输出的信息 比如只想显示对象部分属性 栗子在Person3类
     *          触发时机: var_dump() 一个对象时触发
     *                  该函数需要return一个数组(此数组包含对象的部分属性或者全部属性)
     * 
     *      __call:
     *          触发时机:当调用一个不存在对象方法的时候触发
     *                  参数1:函数名
     *                  参数2:是一个函数 函数中的参数都被存放到这个数组中
     *      __callStatic:
     *          触发时机:当调用一个不存在静态方法的时候触发
     *                  参数1:函数名
     *                  参数2:是一个函数 函数中的参数都被存放到这个数组中
     *                          【该方法也是static方法】
     *              ps:
     *              【静态方法:从程序运行开始 就实例生成内存 ，所以可以直接调用，效率会高很多，但是静态内存是有限制的，实例太多，程序直接启动不了，静态内存会常驻】
     *              【非静态方法:实例方法开始生成内存，在调用时申请零散的内存，所以效率会慢很多 ，非静态的用完就释放了】
     *              【实例化:一般是由类创建的对象，在构造一个实例的时候需要在内存中开辟空间 $zsx = new Person()】
    *               【初始化:实例化的基础上，并且对 对象中的值进行赋一下初始值】
     *      serialize: 序列化 (产生一个可存储的值的表示)serialize() 可处理除了 resource 之外的任何类型
     *                      【serialize() 函数会检查类中是否存在一个魔术方法 __sleep()。如果存在，__sleep()该方法会先被调用】
     *      unserialize: 反序列化 (从已存储的表示中创建 PHP 的值)
     *                      【unserialize() 会检查是否存在一个 __wakeup() 方法。如果存在，则会先调用 __wakeup 方法，预先准备对象需要的资源】
     *      __sleep: 方法常用于提交未提交的数据，或类似的清理操作
     *          触发时机:在序列化一个对象的时候调用
     *          返回值:必须是一个数组 数组中写想要序列的成员属性名
     *      __wakeup:
     *          触发时机:在反序列化一个对象的时候调用
     *                  反序列成功之后 想要让对象执行一些初始化方法 可以写到这个函数中
     *      __clone:
     *          触发时机:在克隆一个对象时调用
     *                  在这里面可以对克隆出来的对象的属性做一些操作
     *      _autoload:(唯一一个写在类外的魔术方法)
     *          触发时机:new一个对象的时候 当前脚本没有这个类 就会触发这个函数
     *          参数: 该类的类名字字符串
     *              ps:
     *              【其他文件写好类 在_autoload方法里面 include引入那个类 就可以使用那类的属性和方法】
     *      
     */
    /**----------------------------------------------------------------------- */
    class Person{
        public $name = '小明';
        protected $age = 28;
        private $height = 173;
        public function __get($zsx){//所有的魔术方法都是public
            // echo $zsx;
            if($zsx == 'age'){
                // return $this->age;
                echo $zsx.':'.$this->age;
            }
            if($zsx == 'height'){
                // return $this->age;
                echo $zsx.':'.$this->height;
            }
        }

        public function __set($zsx,$value){//所有的魔术方法都是public
            var_dump($zsx,$value);
            // var_dump($zsx);
            // var_dump($value);
            if($zsx == 'age'){
                $this->age = $value;
            }
            if($zsx == 'height'){
                $this->height = $value;
            }
        }
    }
    
    //以下__get() __set()栗子 与上述代码 一一对应

    $xiaoming = new Person();
    // 关于__get()
    echo $xiaoming->name.'<br>';
    echo $xiaoming->age.'<br>';//会触发__get
    echo $xiaoming->height.'<br>';//会触发__get
    echo '<hr>';

    // 关于__set()
    $xiaohong = new Person();
    $xiaohong->name = '小红';
    $xiaohong->age = 22;
    $xiaohong->height = 165;
    echo $xiaohong->name.'<br>';
    echo $xiaohong->age.'<br>';//会触发__set
    echo $xiaohong->height.'<br>';//会触发__set
    echo '<hr>';
    /**----------------------------------------------------------------------- */
    class Person2{
        public $name;
        protected $age;
        private $height;
        public function __get($zsx){//所有的魔术方法都是public
            // echo $zsx;
            if($zsx == 'age'){
                // return $this->age;
                echo $zsx.':'.$this->age;
            }
            if($zsx == 'height'){
                // return $this->age;
                echo $zsx.':'.$this->height;
            }
        }

        public function __set($zsx,$value){//所有的魔术方法都是public
            var_dump($zsx,$value);
            // var_dump($zsx);
            // var_dump($value);
            if($zsx == 'age'){
                $this->age = $value;
            }
            if($zsx == 'height'){
                $this->height = $value;
            }
        }

        public function __unset($zsx){
            // if($zsx == 'name'){
            //     unset($this->$zsx);
            // }
            if($zsx == 'age'){
                unset($this->$zsx);
            }
            if($zsx == 'height'){
                unset($this->$zsx);
            }
            // echo $zsx;
        }

        public function __isset($zsx){
            if($zsx == 'age'){
                return isset($this->$zsx);
            }
            if($zsx == 'height'){
                return isset($this->$zsx);
            }
        }

        // public function __destruct(){//当对象被销毁时自动调用析构方法
        //     echo '销毁对象';
        // }
    }
    /**----------------------------------------------------------------------- */
    //关于__unset()
    $xiaofour = new Person2();
    unset($xiaofour->name);//不会触发__unset()
    unset($xiaofour->age);//会触发__unset()
    unset($xiaofour->height);//会触发__unset()
    var_dump($xiaofour);
    echo '<hr>';

    // 关于__iset()
    $nuli = new Person2();
    $nuli->name = '努力';
    $nuli->age = 222;
    $nuli->height = 173;
    echo $nuli->name.'<br>';
    echo $nuli->age.'<br>';
    echo $nuli->height.'<br>';
    var_dump(isset($nuli->name));//不会触发__isset()
    var_dump(isset($nuli->age));//会触发__isset() 如果不用__isset处理 得到的只有false
    var_dump(isset($nuli->height));//会触发__isset() 如果不用__isset处理 得到的只有false
    echo '<hr>';
    /**----------------------------------------------------------------------- */
    class Person3{
        public $name;
        protected $age;
        private $height;
        public function __get($zsx){//所有的魔术方法都是public
            // echo $zsx;
            if($zsx == 'age'){
                // return $this->age;
                echo $zsx.':'.$this->age;
            }
            if($zsx == 'height'){
                // return $this->age;
                echo $zsx.':'.$this->height;
            }
        }

        public function __set($zsx,$value){//所有的魔术方法都是public
            var_dump($zsx,$value);
            // var_dump($zsx);
            // var_dump($value);
            if($zsx == 'age'){
                $this->age = $value;
            }
            if($zsx == 'height'){
                $this->height = $value;
            }
        }

        public function __unset($zsx){
            // if($zsx == 'name'){
            //     unset($this->$zsx);
            // }
            if($zsx == 'age'){
                unset($this->$zsx);
            }
            if($zsx == 'height'){
                unset($this->$zsx);
            }
            // echo $zsx;
        }

        public function __isset($zsx){
            if($zsx == 'age'){
                return isset($this->$zsx);
            }
            if($zsx == 'height'){
                return isset($this->$zsx);
            }
        }

        public function __construct($name,$age,$height){
            $this->name=$name;
            $this->age=$age;
            $this->height=$height;
        }
        public function __toString(){
            return ($this->name).'<br>'.($this->age).'<br>'.($this->height);
            // return $this->name;
            // return $this->age;
            // return $this->height;
        }

        public function __debugInfo(){
            // return ['age','height'];
            return ['age' => $this->age,'height'=> $this->height];
        }

        public function test1(){
            echo '这是test1方法是个非静态方法';
        }
        public static function test2(){
            echo '这是test2方法是个静态方法';
        }

        public function __call($name,$arguments){
            // 注意: $name 的值区分大小写
            echo "Calling object method '$name' ". implode(', ', $arguments). "\n";
            var_dump($name, $arguments);
        }

        public static function __callStatic($name, $arguments){
        // 注意: $name 的值区分大小写
            // echo "Calling static method '$name' ". implode(', ', $arguments). "\n";
            var_dump($name, $arguments);
        }

        public function __sleep(){
            return ['name','age','height'];//数组内成员属性个数自己可以设置
        }

        public function __wakeup(){
            echo '我睡醒了';
            // 这里面具体写什么？？？return ['name','age','height'];？？
        }

        public function __clone(){
            $this->name='新的赵守鑫';
            $this->age=8888;
            $this->height=250;
        }

        //为啥Person2类的__destruct方法此处还会运行?
        // public function __destruct(){//当对象被销毁时自动调用析构方法
        //     echo '销毁对象';
        // }
    }

    // 关于__toString()
    $nulinuli = new Person3('努力努力',444,173);
    echo $nulinuli;

    //关于 __debugInfo()
    var_dump($nulinuli);
    echo '<hr>';

    //关于__call()
    // $nulinuli->demo('in object context');
    $nulinuli->demo(1,2,3,4,5,6);
    $nulinuli->test1();//非静态方法 必须实例化后调用
    echo '<br>';
    Person3::test2();//静态方法 可以类直接调用 并不需要实例化
    echo '<br>';
    $nulinuli->test2();//静态方法 可以实例化后 由对象调用
    // $nulinuli->test2();
    echo '<hr>';

    //关于__callStatic()
    // Person3::demo('in static context');
    // $nulinuli::demo('in static context');
    $nulinuli::demo(1,2,3,4,5,6);
    echo '<hr>';

    //关于序列化serialize 和 __sleep()
    $zhaoshouxin = new Person3('赵守鑫',28,173);
    $str = serialize($zhaoshouxin);//__sleep()被调用 必须返回一个包含 类的属性(也就是成员属性)的数组
    var_dump($str);
    // echo $str;
    file_put_contents('zhaoshouxin.txt',$str);//此方法等效于下三行效果
    // $res = fopen('zhaoshouxin2.txt','w');
    // fwrite($res,$str);
    // fclose($res);
    echo '<hr>';

    //关于unserialize 和 __wakeup()
    $str2 = file_get_contents('zhaoshouxin.txt');
    $obj = unserialize($str2);
    var_dump($obj);//为什么名字没有输出？
    echo '<hr>';

    //关于__clone
    $zhaoshouxinNew = new Person3('赵守鑫',28,173);
    $zhaoshouxinNew2 = clone $zhaoshouxinNew;//clone 就是制造一个一模一样的对象
    var_dump($zhaoshouxinNew2);//为什么名字没有输出？
    echo '<hr>';

    //关于__autoload()
    function __autoload($className){
        $file = $className.'.php';
        include $file;
        echo $className.'<br>';
    }
    $autoload = new Person06('赵守鑫',28,173);
    $autoload->wang();
    echo '<hr>';
?>
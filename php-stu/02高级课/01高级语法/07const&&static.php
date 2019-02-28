<?php   
    /**
     * 类常量:
     *      const PI =3.14 常量前面不可以加修饰符
     *      调用方法:
     *          类外部: 类名::常量名 (或者 $obj::常量名)
     *          类内部: self::常量名 (或者 $this::常量名)
     *              ps:【self 代表当前类名】
     * 
     *       类外部使用define和const定义常量
     *              ps: define("CONSTANT", "Hello world.");
     *                  echo constant("CONSTANT"); 
     *       类内部只能使用const定义常量
     * 
     * 静态属性 静态方法:
     *      static修饰属性和方法后 该属性和该方法属于整个类 不属于某个对象
     *      
     *      静态属性调用方法:
     *          类外:
     *              类名::静态属性名 (或者 $obj::静态属性名)
     *          类内:
     *              self::静态属性名 (或者 $this::静态属性名)
     *      
     *      静态方法调用方法:
     *          类外:
     *              类名::静态方法() (或者 $obj::静态方法() $obj->静态方法())
     *          类内:
     *              self::静态方法() (或者 $this::静态方法() $this->静态方法())
     * 
     *      1:静态属性和方法前面可以添加属性修饰符
     *      2:静态属性和静态方法效率高
     *      3:通过静态方法来创建单例对象(单一实例)
     *      4:静态方法中不能出现$this关键字
     *          
     */
    class Test{
        public $name;
        protected $age;
        public static $height;
        public static $sex;
        public static $eyes = '一只';

        const PI = 3.14;

        public function fun(){
            echo self::PI;
        }

        public static function sta(){
            //在静态方法中 不能出现this关键字!!!!
            // $this->wang();
            echo '这是静态方法';
        }

        public function wang(){
            echo '旺旺旺';
        }

        public function demo(){
            //为了以示区分 类内调用静态 我觉得使用self 同时在静态方法中 不能出现this关键字!!!!
            // 类内 访问静态属性 两种写法
            echo self::$eyes;//静态属性添加$就完事
            echo $this::$eyes;
            // 类内 访问静态方法 三种写法
            self::sta();
            $this::sta();
            $this->sta();
        }

        public function __get($attribute){
            if($attribute == 'name'){
                $this->name = $name;
            }
            if($attribute == 'age'){
                $this->age = $age;
            }
            if($attribute == 'height'){
                $this::$height = $height;
            }
            if($attribute == 'sex'){
                $this::$height = $sex;
            }
        }
        public function __construct($name,$age,$height){
            $this->name=$name;
            $this->age=$age;
            $this::$height=$height;//别忘了添加$符号 这与普通属性有区别
        }
    }
    $obj = new Test('赵守鑫1',28,173,'男');
    echo Test::PI.' '.'类名可以直接调用常量'.'<br>';
    echo $obj::PI.' '.'实例化后也可以调用常量'.'<br>';
    $obj->fun();//对象访问自己的成员属性时 不需要添加$  但是访问静态属性时需要添加$ 如下行所示
    var_dump($obj::$sex);//null 实例化赋值 怎么还是null ?
    var_dump($obj);
    echo '<hr>';

    $obj2 = new Test('赵守鑫',28,173,'女');
    $obj2::sta().'<br>';//或者 Tets::sta();
    Test::sta();
    var_dump($obj2);//已使用__get()方法 为何$height没有输出
    $obj->demo();
?>
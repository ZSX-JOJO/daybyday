<?php
    /**
     * construct()
     * 创建对象的时候要给对象初始化 会自动调用构造方法 她是一个魔术方法
     * 
     * 不传递参数构造方法
     *      创建对象直接调用
     * 传递参数构造方法
     *      将传递过来的参数赋值给自己的成员属性
     * 在类里面要访问自己的成员属性和成员方法
     *      $this 代表当前对象
     *      $this->属性 调用自己的属性
     *      $this->方法 调用自己的方法
     *      :: 静态方法和静态属性的引用方法
     *          栗子:
     *          class Test{
     *              public static function test(){
     *                  public static $test = 1;
     *              }
     *          }
     *          Test::test(); 调用静态方法test
     *          Test::$test;  来取得$test静态属性的值
     */
    class Person{
        public $name;
        public $age;
        public function __construct($name,$age){
            // echo '两个下划线啊！！！';
            // 类里面如何访问自己的成员属性
            // $this代表当前对象
            $this->name=$name;
            $this->age=$age;
        }
        public function test1(){
            echo '今天天气真好'.'<br>';
        }
        public function test2(){
            $this->test1();
            echo '今天天气真好2'.'<br>';
        }
    }
    // $zsx = new Person('赵守鑫','28');
    // echo $zsx->name;
    // echo $zsx->age;

    $zsx2 = new Person('赵守鑫2','29');
    $zsx2->test2();
?>
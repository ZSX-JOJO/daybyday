<?php
    /**
     * 抽象类:
     *      (定义为抽象的类不能被实例化。任何一个类，
     *      如果它里面至少有一个方法是被声明为抽象的，
     *      那么这个类就必须被声明为抽象的。
     *      被定义为抽象的方法只是声明了其调用方式（参数），
     *      不能定义其具体的功能实现)
     * 
     *      1:抽象类不能实例化对象
     *      2:抽象类存在的目的是为了让子类继承
     *      3:抽象类定义和普通类相同 只不过在前面添加了static关键字
     *      4:抽象类里面一般都要 有抽象方法 抽象方法用来让子类实现 且子类必须实现 不实现就会报错
     *      5:抽象方法只能是public或者protected
     *      6:抽象方法如果有参数 参数有默认值 实现该方法的时候参数和默认值也都要有
     *      7:抽象类可以继承抽象类 子类在实现的时候所有的抽象方法都得实现
     * 
     * 接口(抽象的抽象类[理解为:类是抽象的 类中的方法也是抽象的]):
     *      interface:接口
     *      implements:实现
     *      
     *      接口中的方法都是抽象方法 所以abstract可以省略不写
     *      接口中的方法必须是public
     *      接口中只能规定方法(只是声明了方法) 不能写属性 (接口中可以写常量)
     *      一个类可以实现多个接口 中间用逗号隔开
     *      一个类可以先继承父类 然后再实现接口
     *      接口可以继承接口 但是里面的方法都要实现
     * 
     * 
     *      PS:{面向接口开发}
     */
/**-------------------------------------------------------------------------- */
    //普通类
    class Person{
        public $name;
        public function fun(){
            echo '说出自己的名字';
        }
        public  function __construct($name){
            $this->name=$name;
        }
    }
/**-------------------------------------------------------------------------- */
    //抽象类
    abstract class Animal{
        abstract public function jump();
    }

    abstract class Person2 extends Animal{
        public $name;
        // public function jump(){//子类必须实现抽象方法
        //     echo '跳一跳';
        // }
        public function say(){
            echo '说出自己的名字';
        }

        abstract public function eat($name);//定义一个抽象方法
    }

    class Man extends Person2{
        public function jump(){//子类必须实现抽象方法 最好写在此类里
            echo '跳一跳';
        }
        public function eat($name){//参数要依照抽象方法而来
            echo $name.'今天早上没吃饭';
        }
    }
/**-------------------------------------------------------------------------- */
    //接口
    interface Life{
        public function me();
    }
    interface Study extends Life{//接口可以继承接口
        public function read();
    }

    interface Fun{
        public function play();
    }

    class Zhao{
        function name(){
            echo '赵姓';
        }
    }
    class Zhaoshouxin extends Zhao implements Study,Fun{//先继承父类 再实现接口;实现接口 接口内的方法必须实现
        public function me(){
            echo '我就是我';
        }
        function read(){
            echo '读书';
        }
        function play(){
            echo '玩耍';
        }
    }
/**-------------------------------------------------------------------------- */
    $zsx = new Person('赵守鑫');
    $zsx->fun();
    var_dump($zsx);
    echo '<hr>';

    $zhaoshouxin = new Man();
    $zhaoshouxin->jump();
    echo '<br>';
    $zhaoshouxin->say();
    echo '<br>';
    $zhaoshouxin->eat('赵守鑫');
    echo '<br>';
/**-------------------------------------------------------------------------- */

?>
<?php
    /**
     * inherit
     *      继承是子类(派生类)从父类(基类，超类)继承属性和方法
     *      子类也可以有自己的属性和方法。
     *      一个父类可以被多个子类继承。但是一个子类只能有一个父类
     *      如果想修改父类的方法，只能在子类里重写这个方法，这也是【多态】的体现
     * 继承语法:
     *      基本语法:
     *          extends:继承
     *          格式: class Person extends Dog{}
     *          子类继承了父类 那么就拥有了父类的属性和方法
     *          子类拥有父类的所有属性 还有自己独有的属性
     *      访问权限:
     *          public 公共的
     *          protected  受保护的
     *          private 私有的
     *          
     *                  外部访问    子类继承
     *      public      可以        可以
     *      protected   不可以      可以
     *      private     不可以      不可以
     * 
     * 重写(重载)方法:
     *      父类的方法不适合子类使用 此时子类可以重写父类的方法
     *      子类调用的方法是子类重写后的方法 父类还是调用父类打的方法
     */

    class Animal{
        public $name;
        public $age;
        public function eat(){
            echo '我bu吃饭';
        }
        // public function __construct($name,$age){
        //     $this->name=$name;
        //     $this->age=$age;
        // }
    }
    class Person extends Animal{
        public $age = 10;
    }

    // $zsx  = new Person('赵守鑫','29');
    $zsx  = new Person();
    echo $zsx->name;
    echo $zsx->age;
    echo '<hr>';
    // echo $zsx->eat();
?>
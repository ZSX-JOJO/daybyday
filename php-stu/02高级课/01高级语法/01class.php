<?php
    /**
     * 类是对象的抽象，抽象是类的具象。
     * 
     * 属性--->变量
     * 行为--->方法
     */
    //类名规范 遵循大驼峰原则
    class Person{
        public $age;//成员属性
        public function eat(){//成员方法
            echo '少吃馒头米饭！';
        }
    }
    // 定义对象的第一种方法 直接通过类名
    $zsx = new Person();
    // var_dump($zsx);
    // var_dump($zsx->age);

    //定义对象的第二种方法  通过类名字符串
    $name = 'Person';
    $zhaoshouxin = new $name();
    var_dump($zhaoshouxin);
    // var_dump($zhaoshouxin->age);//对象访问自己属性的时候 不需要加$符号
    // echo $zhaoshouxin->age = 28;
    $zhaoshouxin->eat();
?>
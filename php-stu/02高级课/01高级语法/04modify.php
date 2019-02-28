<?php
    /**
     * 访问修饰符  对属性和方法的修饰功能是一样的
     * 访问权限:
     *          public 公共的
     *                      类的外部可以访问公共的属性
     *                      可以 被子类继承
     *          protected  受保护的
     *                      类的外部 不可以 访问此属性
     *                      可以 被子类继承
     *          private 私有的
     *                      类的外部 不可以 访问此属性  
     *                      不可以 被子类继承
     *          
     *                  外部访问    子类继承
     *      public      可以        可以
     *      protected   不可以      可以
     *      private     不可以      不可以
     */
    class Person{
        public $name;
        protected $age;
        private $sex;
        public function __construct($name,$age,$sex){
            $this->name=$name;
            $this->age=$age;
            $this->sex=$sex;
        }
    }
    $zsx = new Person('zhaoshouxin',28,'男');
    echo $zsx->name;
    // echo $zsx->age;//外部不可以访问
    // echo $zsx->sex;//外部不可以访问

    class Galaxy{
        public $name = '星星';
        protected $age = '100亿年';
        private $size = '200光年';
    }

    class Solar extends Galaxy{
        public function shine(){//public不写的话 默认是public
            echo '我的名字:'.$this->name.'<br>';//子类 可以 继承
            echo '我的年龄:'.$this->age.'<br>';//子类 可以 继承
            echo '我的大小:'.$this->size.'<br>';//子类 不可以 继承
        }
    }

    $sun = new Solar();
    $sun->shine();
?>
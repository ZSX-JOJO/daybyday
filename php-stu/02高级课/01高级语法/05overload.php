<?php
    /**
     * 重写(重载)方法:
     *      父类的方法不适合子类使用 此时子类可以重写父类的方法
     *          完全重写
     *          在父类的基础上增加一定的功能
     *      子类调用的方法是子类重写后的方法 父类还是调用父类打的方法
     * 
     *      parent关键字(普通方法 构造方法) 在父类的基础上增加一定的功能时使用
     *          parent::work()
     *          先调用父类的方法 然后再增加自己的功能
     *      final关键字
     *          修饰class代表这个类不能被继承
     *          修饰method代表这个方法不能被重写
     *      重写中的方法权限修改:(重写时权限只能放大 不能缩小) 一般情况下不进行权限修改
     *          public ===> 只能是 public
     *          protected ===> protected 或者 public
     */

    class Father{
        public $name;
        public $age;
        public function __construct($name,$age){
            $this->name = $name;
            $this->age = $age;
        }
        public function jump(){
            echo 'i can jump'.'<br>';
        }
        public function work(){
            echo '勤勤恳恳'.'<br>';
        }
    }

    class Son extends Father{
        public $height;
        public $weight;
        public function __construct($name,$age,$height,$weight){
            parent::__construct($name,$age);
            $this->height = $height;
            $this->weight = $weight;
        }
        public function jump(){
            echo 'i can jump plus'.'<br>';
        }
        public function work(){
            parent::work();
            echo '我还每天学习准备努力到2019-08-18'.'<br>';
        }
    }

    $fa = new Father('父类',40);
    echo ($fa->name).'<br>';
    echo ($fa->age).'<br>';
    $fa->jump();//父类还是调用父类打的方法
    $fa->work();
    echo '<hr>';

    $son = new Son('子类',28,173,68);
    echo ($son->name).'<br>';
    echo ($son->age).'<br>';
    echo ($son->height).'<br>';
    echo ($son->weight).'<br>';
    $son->jump();//子类调用的方法是子类重写后的方法
    $son->work();
    echo '<hr>';
?>
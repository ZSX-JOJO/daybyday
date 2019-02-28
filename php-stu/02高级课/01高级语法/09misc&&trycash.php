<?php   
    /**
     * 杂项和 try-catch
     * 
     * 函数:
     *      call_user_func 把第一个参数作为回调函数调用 具体看下方栗子
     *      call_user_func_array 调用回调函数，并把一个数组参数作为回调函数的参数
     *      spl_autoload_register  注册给定的函数作为  __autoload 的实现
     * 
     * 常量和有关函数:
     *      __NAMESPACE__       当前命名空间
     *      __CLASS__           当前类名
     *      __METHOD__          当前方法名
     * 
     *      instanceof          判断一个对象是否属于当前类
     *      class_alias         给类起别名
     *      class_existe        判断类是否存在
     *      get_class_methods   得到类所有的方法
     *      get_class_vars      得到类所有的属性
     *      get_class           根据对象得到当前类名
     *      interface_exists    判断接口是否存在
     *      trait_exists        判断trait是否存在
     *      method_exists       判断方法是否存在
     *      property_exists     判断属性是否存在
     * 
     * 异常处理:
     *      
     */

    function test($name,$name2){
        echo '天气不行'.$name.$name2.'<br>';
    }
    call_user_func('test','因为阴天','多个参数继续往后写');
    echo '<hr>';
    call_user_func_array('test',['因为阴天','参数写到数组中']);
    echo '<hr>';

/**--------------------------------------------------------------- */
    class Dog{
        function wang(){
            echo '汪汪汪'.'<br>';
            // $this->wang2();
        }
        // function wang2(){
        //     echo '嗷嗷嗷嗷';
        // }
        function rock(){
            // 摇尾巴之前先叫几声？
            // $this->wang();//方式1
            call_user_func([$this,'wang']);//方式2 call_user_func()在类外和类内使用方法相同
            echo '摇尾巴'.'<br>';
        }
    }
    class Dog2{
        function wang($name1,$name2){
            echo '拆家砖家'.$name1.$name2;
        }
    }
    $dog = new Dog();
    call_user_func([$dog,'wang']);//有参数的话call_user_func([$dog,'wang'],'参数1','参数2','参数N')
    call_user_func([$dog,'rock']);
    $dog2 = new Dog2();
    echo '<br>';
    call_user_func_array([$dog2,'wang'],['二哈','哈士奇']);//参数多的话用此;参数少的话用call_user_func()
    echo '<hr>';
/**--------------------------------------------------------------- */
    function myAutoload($className){
        echo $className;
        //接下来通过类名找到文件名 然后导入进来 具体查看06magic.php 中关于__autoload()方法的使用
    }
    spl_autoload_register('myAutoload');
    $zsx = new Zsx();
?>
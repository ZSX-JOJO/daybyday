<?php
    /**
     * 异常处理:
     *      一个try至少对应一个catch
     *      官方默认的方法不可以被重写具体查看文档Exception
     *  
     *      Exception: (单词意思: 例外)
     *          官方的异常处理类 是所有异常类的基类
     *          getMessage:得到异常消息
     *          getCode:得到异常代码
     *      
     *      自定义异常处理类:
     *          要继承自官方的异常处理类 方法自己随便添加
     *          如果有多个catch 要将自定义的异常类写在上面 将官方的异常类写在下面
     * 
     *      嵌套:(可以参考if(){}else{}的嵌套)
     *          在try里可以继续嵌套 try{}catch(){}
     *          在catch里同理可以嵌套try{}catch(){}
     *              栗子:
     *                  try{
     *                      try{
     *                      }catch(){
     *                          try{
     *                          }catch(){
     *                          }
     *                      }
     *                  }catch(){
     *                      try{
     *                      }catch(){
     *                      }
     *                  }
     * 
     *      自定义异常处理函数:
     *          set_exception_handler();
     *          【注册一个函数 当抛出异常时 
     *            就会被这个函数自动捕获到 
     *            该函数有一个参数 参数就是异常对象】
     *          
     */
/**---------------------------------------------------- */
    try{
        // echo '这是一种固定结构'.'<br>';
        echo '起床'.'<br>';
        throw new Exception('身体不舒服',10);//抛出异常 之后的代码不再执行 然后执行catch内代码 最后再继续执行后续代码
        echo '吃饭'.'<br>';
    }catch(Exception $e){
        echo $e->getMessage();//getMessage()得到异常信息
        echo $e->getCode();//getCode()得到异常代码
    }
    echo '上班';
    echo '<hr>';
/**---------------------------------------------------- */
    class MyException extends Exception{
        function demo(){
            echo '执行第二套方案'.'<br>';
        }
    }

    try{
        echo '每天都要学习!!!!坚持到2019-08-18'.'<br>';
        throw new MyException('朋友间吃饭',666);
        echo '要有去年减肥的那种毅力!';
    }catch(MyException $e){// 这个捕获 下面的就不进行捕获了 因为自定义的MyException是Exception的子类;要将这个子类写在上面
        echo '异常消息内容:'.$e->getMessage().'<br>';
        echo '异常代码:'.$e->getCode().'<br>';
        $e->demo();
    }catch(Exception $e){
        echo '官方的异常消息内容:'.$e->getMessage().'<br>';
        echo '官方的异常代码:'.$e->getCode().'<br>';
    }
    echo '少壮要努力,老大无伤悲!';
    echo '<hr>';
/**---------------------------------------------------- */
    function test($e){
        echo $e->getMessage().'<br>';
    }

    set_exception_handler('test');

    throw new Exception('现在有异常');
?>
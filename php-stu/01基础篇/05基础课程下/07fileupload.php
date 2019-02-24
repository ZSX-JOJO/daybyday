<?php 
    /**
     * 文件上传
     */
    var_dump($_FILES);
    //is_uploaded_file 判断文件是否是通过 HTTP POST 上传的

    //判断是否有错误号
    if($_FILES['file']['error']){
        switch($_FILES['file'][error]){
            // case 0:具体查看手册 中 文件上传处理 的部分
            case 1:
                $str ='上传的文件超过了 php.ini 中 upload_max_filesize 选项限制的值';
                break;
            case 2:
                $str ='上传文件的大小超过了 HTML 表单中 MAX_FILE_SIZE 选项指定的值';
                break;
            case 3:
                $str ='文件只有部分被上传';
                break;
            case 4:
                $str ='没有文件被上传';
                break;
            case 6:
                $str ='找不到临时文件夹';
                break;
            case 7:
                $str ='文件写入失败';
                break;
        }
        echo $str;
        exit();
    }
    //判断准许的文件大小
    if($_FILES['file']['size']>(pow(1024,2)*2)){//pow()指数
        echo '文件大小超过2M的限制';
    }
    //判断准许的mime类型 文件后缀
    $allowMime = ['image/png','image/jpg','image/jpeg','image/gif','image/wbmp','image/bmp'];
    $allowSubFix = ['png','jpg','jpeg','gif','wbmp','bmp'];
    $info = pathinfo($_FILES['file']['name']);//先$_FILES['file']['name'] 然后用pathinfo获取到dirname basename extension filename 信息
    var_dump($info);
    $subFix = $info['extension'];
    if(!in_array($subFix,$allowSubFix)){// in_array()检查数组是否存在某个值
        exit('不准许的文件后缀');
    }
    if(!in_array($_FILES['file']['type'],$allowMime )){
        exit('不允许的mime类型');
    }
    //拼接上传路径
    $path = 'upload/';//开始未加 / 导致显示上传成功但是此文件夹下没有上传的图片
    if(!file_exists($path)){
        mkdir($path);
    }
    //文件名随机
    $name = uniqid().'.'.$subFix;
    //判断是否是上传文件
    if(is_uploaded_file($_FILES['file']['tmp_name'])){//is_uploaded_file()判断文件是否是通过 HTTP POST 上传的
        //判断文件是否可以移动
        if(move_uploaded_file($_FILES['file']['tmp_name'],$path.$name)){//move_uploaded_file(已选择的上传的文件的名字,上传的文件要存放的位置)将上传的文件移动到新位置
            echo '上传成功';
        }else{
            echo '文件移动失败';
        }
    }else{
        echo '不是上传文件';
    }
?>
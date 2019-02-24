<?php
    /**
     * 
     */
    // phpinfo();
    if(extension_loaded('gd')){
        echo '可以使用gd<br>';
        foreach(gd_info() as $cate=>$value){
            echo "$cate:$value<br>";
        }
    }
    else{
        echo '没有安装gd扩展';
    }
?>
<?php 
    /**
     * 
     */
    $test = 1;
    switch ($test){
        case 1:
            echo 1;
            break;
        case 2:
            echo 2;
            break;
        default:
            echo '条件都不符合，输出此';
            break;
    }
    echo '<br>';
    $suiji = mt_rand(1,6);//随机数
    echo $suiji.'<br>';
    switch($suiji){
        case 1:
        case 2:
        case 3:
            echo '小';
            break;
        case 4:
        case 5:
        case 6:
            echo '大';
            break;
    }
    echo '<br>';
    /**
     * 
     */
    $test = 4;
    if($test == 1){
        echo '1'.'<br>';
    }else if($test == 2){
        echo '2'.'<br>';
    }else if($test == 3){
        echo '3'.'<br>';
    }else{
        echo '其他'.'<br>';
    }
?>
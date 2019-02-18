<?php 
    /**
     * 
     */
    for($i = 0;$i<5;$i++){
        // if($i == 2){
        // 0 1 3 4
            // continue;//当条件满足时，终止此次循环;直到条件不满足
        // }
        echo $i.'<br>';
    }
    echo '<br>';
    /**
     * 
     */
    $ii = 5;
    while($ii<8){
        echo $ii.'<br>';
        $ii++;
    }
    echo '<br>';
    /**
     * 
     */
    $iii = 8;
    do{
        echo $iii.'<br>';
        $iii++;
    }while($iii < 10);
    echo '<br>';
    /**
     * 
     */
    for($iiii = 0;$iiii<5;$iiii++){
        if($iiii == 2){
            break;//当条件满足时，直接终止循环。
        }
        echo $iiii.'<br>';
    }
    echo '<br>';

    /**
     * 九九乘法表
     */
    echo '<table width="800" height="300" border="1">';
        for($wai=1;$wai<=9;$wai++){
            echo '<tr>';
                for($nei=1;$nei<=$wai;$nei++){
                    echo '<td>'.$nei.'*'.$wai.'='.$nei*$wai.'</td>';
                }
            echo '</tr>';
        }
    echo '</table>';

<?php 
    /**
     * 索引数组
     */
    $arr = [1,2,3,4,5];//老版本用法array(1,2,3,4,5);
    var_dump($arr);
    echo '<br>';
    $arr2 = ['3' => 'a','b','c','d'];//指定下表
    var_dump($arr2);
    echo '<br>';

    /**
     * 关联数组
     */
    $arr3 = [
        '下表0' => '名字0',
        '下表1' => '名字1',
        '下表2' => '名字2',
        '下表3' => '名字3'
    ];
    var_dump($arr3);
    echo '<br>';

    /**
     * 二维数组
     */
    $arr4 = [
        '下表0' => [
            '男0',
            '27',
            '赵守鑫0',
        ],
        '下表1' => [
            '男1',
            '27',
            '赵守鑫1',
        ],
        '其他',
        '其他',
        '其他'
    ];
    var_dump($arr4);
    echo '<br>';

    /**
     * 三维数组 以及多维数组
     */
    $arr5 = [
        '下表0' => [
            '男0',
            '27' => [
                '123',
                '123',
                '123'
            ],
            '赵守鑫0' => [
                '123',
                '123',
                '123'
            ]
        ],
        '下表1' => [
            '男1',
            '28' => [
                '456',
                '456',
                '456'
            ],
            '赵守鑫01' => [
                '456',
                '456',
                '456'
            ]
        ]

    ];
    var_dump($arr5);
    echo '<hr>';
    var_dump($arr5['下表0']['27'][0]);//string(3) "123"
    echo '<hr>';

    /**
     * 数组操作
     */
    $arr6 = [1,2,3,4,5];
    var_dump($arr6[0]);
    // 添加
    $arr6[5] = 6;
    echo '<hr>';
    echo $arr6[5];
    //删除
    unset($arr6[5]);
    echo '<hr>';
    var_dump($arr6);
    echo '<hr>';
    //修改
    $arr6[4] = 555;
    var_dump($arr6);
    echo '<hr>';

    $arr7 = [1,2,3,4,5];
    $num = count($arr7);
    echo $num.'<br>';
    $sum = 0;
    for($i=0;$i<$num;$i++){
        // echo $arr7[$i].'<br>';
        $sum += $arr7[$i];
    }
    echo $sum;
    echo '<hr>';

    /**
     * 
     */
    $arr8 = ['a' =>'aa','b' =>'bb','c' =>'cc'];
    echo $arr8['a'];
    echo '<hr>';
    foreach($arr8 as $key =>$value){
        echo $key.'----'.$value.'<br>'.'<hr>';
        // echo $arr8[$key].'<br>';
    }
    $arr9 = [1,2,3,4,5];
    foreach($arr9 as $key => $value){
    // foreach($arr9 as  $value){
        echo '下表:'.$key.'----'.'值:'.$value.'<br>'.'<hr>';
    }

    //list()把数组中的值 赋值给一组变量 仅能用于数字索引的数组，并假定数字索引从 0 开始
    $arr10 = [1,2,3,4,5];
    list($a,$b,$c,$d,$e) = $arr10;
    echo $a,$b,$c,$d,$e.'<br>'.'<hr>';
    //each()返回数组中当前的 键／值对 并将数组指针向前移动一步 
    $arr11 = ['a','b','c'];
    var_dump(each($arr11));
    var_dump(each($arr11));
    var_dump(each($arr11));
    reset($arr11);//如果内部指针越过了数组的末端，则 each() 返回 FALSE  如果要再用 each 遍历数组，必须使用 reset()。
    var_dump(each($arr11));
    echo '<hr>';
    // echo each($arr11);//数组是不能输出的

    //each() && list() 结合来遍历数组
    $arr12 = [111,222,333,444,555];
    // list($key,$val) = each($arr12);
    // echo $key.'=>'.$val.'<hr>';
    while(list($key,$val) = each($arr12)){
        echo $key.'=>'.$val.'<br>';
    }
?>
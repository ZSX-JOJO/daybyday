<?php
    /** */
    include 'Tpl06.php';
    $tpl = new Tpl06();
    $title = '你好';
    $data = ['我已经忘了你','我真的已经忘了你'];

    $tpl->assign('title',$title);
    $tpl->assign('data',$data);

    $tpl->display('Test06.html');
?>
<?php 
    /**
     * 用于02sessionDologinCheck.php使用
     */
    session_start();
    unset($_SESSION['username']);
    session_destroy();
?>
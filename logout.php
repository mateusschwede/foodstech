<?php
    session_start();
    unset($_SESSION['id']);
    unset($_SESSION['nome']);
    unset($_SESSION['msg']);
    session_destroy();
    header("location: index.php");
?>
<?php
    session_start();
    unset($_SESSION['login'], $_SESSION['msg']);
    header('Location: ./');
?>

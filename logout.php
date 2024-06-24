<?php
    session_start();

    unset($_SESSION["email"]);
    unset($_SESSION["senha"]);
    unset($_SESSION["usuario"]);

    session_destroy();
    header("location:index.php");
    exit;
?>

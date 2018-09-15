<?php 
    session_start();

    unset($_SESSION["tablero"]);
    unset($_SESSION["juego"]);
    unset($_SESSION["mostrar"]);
    unset($_SESSION["banderas"]);

    header("location:index.php");
?>
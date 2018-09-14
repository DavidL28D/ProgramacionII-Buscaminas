<?php 
    session_start();

    unset($_SESSION["tablero"]);
    unset($_SESSION["juego"]);
    unset($_SESSION["mostrar"]);
    
    header("location:index.php");
?>
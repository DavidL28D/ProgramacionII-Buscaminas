<?php 
    session_start();

    unset($_SESSION["tablero"]);
    unset($_SESSION["juego"]);
    
    header("location:index.php");
?>
<!DOCTYPE html>

<?php 

    session_start();
    include("tablero.php");
    $game = new tablero();

    if(!isset($_SESSION["tablero"]) && !isset($_SESSION["mostrar"])){

        $_SESSION["juego"] = true;
        $_SESSION["banderas"] = 10;
        $game->generar();
        
    }else{
        $game->comprobar($_GET["fila"], $_GET["columna"], $_GET["bandera"]);
    }

?>

<html lang="en">

    <head>

        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">

        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
        
        <title>Buscaminas</title>

    </head>

    <body>
    <div class="container-fluid">
    
        </br>
        <form action="" class="form-group" method="get">

            <?php
                if(isset($_GET["boton"]) && $_GET["boton"] == "Reiniciar"){
                    header("location:cerrar.php");
                }
            ?>

            <?php
            if($_SESSION["juego"] == true){
                $game->mostrar();
            } 
            ?>
            
            </br><input type="submit" class="btn btn-primary" name="boton" value="Reiniciar">

        </form>
    
    </div>
        <script type="text/javascript">
            function evento(a, b){
                document.location = "index.php?fila="+a+"&columna="+b;
            }
            function bandera(a, b, c){
                document.location = "index.php?fila="+a+"&columna="+b+"&bandera="+1;
            }
        </script> 

        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

    </body>

</html>
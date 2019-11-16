<?php
class tablero{

    public function __contruct(){}

    public function generar(){

        unset($_SESSION["tablero"]);
        unset($_SESSION["mostrar"]);
        unset($_SESSION["banderas"]);

        for($i=0; $i<8; $i++){
            for($j=0; $j<8; $j++){
                $matriz[$i][$j] = 0;
            } 
        }

        $_SESSION["mostrar"] = $matriz;

        $x = 0;
        while($x<10){
            $columna = rand(0, 7);
            $fila = rand(0, 7);

            if($matriz[$columna][$fila] == 0){
                $matriz[$columna][$fila] = 9;
                $x = $x+1;
            }

        }

        for($i=0; $i<8; $i++){
            for($j=0; $j<8; $j++){

                if($matriz[$i][$j] == 9){

                    //echo"bomba";

                    // N
                    if($matriz[$i-1][$j] < 9 && $i-1 >= 0){
                        $matriz[$i-1][$j]++;
                    }

                    // NE
                    if($matriz[$i-1][$j+1] < 9 && $i-1>=0 && $j+1<8){
                        $matriz[$i-1][$j+1]++;
                    }

                    // E
                    if($matriz[$i][$j+1] < 9 && $j+1<8){
                        $matriz[$i][$j+1]++;
                    }

                    // SE
                    if($matriz[$i+1][$j+1] < 9 && $i+1<8 && $j+1<8 ){
                        $matriz[$i+1][$j+1]++;
                    }

                    // S
                    if($matriz[$i+1][$j] < 9 && $i+1<8){
                        $matriz[$i+1][$j]++;
                    }

                    // SO
                    if($matriz[$i+1][$j-1] < 9 && $i+1<8 && $j-1>=0){
                        $matriz[$i+1][$j-1]++;
                    }

                    // O
                    if($matriz[$i][$j-1] < 9 && $j-1>=0){
                        $matriz[$i][$j-1]++;
                    }

                    // NO
                    if($matriz[$i-1][$j-1] < 9 && $i-1>=0 && $j-1>=0){
                        $matriz[$i-1][$j-1]++;
                    }

                }

            }  
        }

        $_SESSION["tablero"] = $matriz;
        $_SESSION["banderas"] = 10;

    }

    public function mostrar(){

        $matriz = $_SESSION["mostrar"];
        $banderas = $_SESSION["banderas"];

        echo"<h1>Busca minas</h1>";
        echo"<p>Click Izquierdo para abrir una casilla.<br>Girar la rueda para colocar una bandera.</p>";
        echo"<h2>Banderas disponibles: $banderas</h2>";
        echo"<table>";
        for($i=0; $i<8; $i++){
            echo "<tr>";
            for($j=0; $j<8; $j++){
                
                $dato = $matriz[$i][$j];

                echo "<td>
                <a onWheel='bandera($i, $j)', onclick='evento($i, $j)'>
                <img src = 'img/", $dato,".png'/>
                </a>
                </td>";
                        
            }
            echo "</tr>";
        }
        echo"</table>";
        
        /*
        $matriz = $_SESSION["tablero"];
        echo"</br>";  
        echo "Tablero<br/>";    
        for($i=0; $i<8; $i++){
            for($j=0; $j<8; $j++){
                echo" ",$matriz[$i][$j];
            } 
            echo"<br/>";
        }
        */
        
    }

    public function comprobar($y, $x, $b){

        $matriz = $_SESSION["tablero"];
        $aux = $_SESSION["mostrar"];
        $banderas = $_SESSION["banderas"];

        if($b == 1){

            if($aux[$y][$x] == 12){

                $aux[$y][$x] = 0;
                $_SESSION["mostrar"] = $aux;
                $banderas++;
                $_SESSION["banderas"] = $banderas;

            }else if($aux[$y][$x] == 0 && $banderas > 0){

                $aux[$y][$x] = 12;
                $_SESSION["mostrar"] = $aux;
                $banderas--;
                $_SESSION["banderas"] = $banderas;

            }

            tablero::ganador();

        }else{

            tablero::perdio($y, $x);

            if($aux[$y][$x] != 12){
                
                if($matriz[$y][$x] > 0 && $matriz[$y][$x] < 9){
        
                    $aux[$y][$x] = $matriz[$y][$x];
                    $_SESSION["mostrar"] = $aux;
        
                }else if($matriz[$y][$x] == 0){
        
                    tablero::abrir($y, $x);
        
                }

            }

        }

    }

    public function abrir($i, $j){

        $matriz = $_SESSION["tablero"];
        $aux = $_SESSION["mostrar"];
        $banderas = $_SESSION["banderas"];

        if($matriz[$i][$j] != 9){

            if($matriz[$i][$j] == 0){

                if($aux[$i][$j] == 12){
                    $banderas++;
                    $_SESSION["banderas"] = $banderas;
                }

                $aux[$i][$j] = 11;
                $matriz[$i][$j] = 11;
                $_SESSION["mostrar"] = $aux;
                $_SESSION["tablero"] = $matriz;

                // N
                if($i-1 >= 0){
                    tablero::abrir($i-1, $j);
                }

                // NE
                if($i-1 >= 0 && $j+1 < 8){
                    if($matriz[$i-1][$j+1] != 0){
                        tablero::abrir($i-1, $j+1);
                    }
                }
                
                // E
                if($j+1 < 8){
                    tablero::abrir($i, $j+1);
                }

                // SE
                if($i+1 < 8 && $j+1 < 8){
                    if($matriz[$i+1][$j+1] != 0){
                        tablero::abrir($i+1, $j+1);
                    }
                }

                // S
                if($i+1 < 8){
                    tablero::abrir($i+1, $j);
                }

                // SO
                if($i+1 < 8 && $j-1 >= 0){
                    if($matriz[$i+1][$j-1] != 0){
                        tablero::abrir($i+1, $j-1);
                    }
                }

                // O
                if($j-1 >= 0){
                    tablero::abrir($i, $j-1);
                }

                // NO
                if($i-1 >= 0 && $j-1 >= 0){
                    if($matriz[$i-1][$j-1] != 0){
                        tablero::abrir($i-1, $j-1);
                    }
                }
                
            }else if($matriz[$i][$j] > 0 && $matriz[$i][$j] < 9){

                if($aux[$i][$j] == 12){
                    $banderas++;
                    $_SESSION["banderas"] = $banderas;
                }

                $aux[$i][$j] = $matriz[$i][$j];
                
                $_SESSION["mostrar"] = $aux;
                $_SESSION["tablero"] = $matriz;

            }

        }
        
    }

    public function ganador(){

        $matriz = $_SESSION["tablero"];
        $aux = $_SESSION["mostrar"];
        $win = 0;

        for ($i=0; $i < 8; $i++) { 
            for ($j=0; $j < 8; $j++) { 
                if($matriz[$i][$j] == 9 && $aux[$i][$j] == 12){
                    $win++;
                }
            }
        }

        if($win == 10){
            $_SESSION["juego"] = false;
            echo '<script type="text/javascript">alert("Has Ganado, vuelve a jugar!!");</script>';

            echo "<div class='container-fluid'";
                    echo"<br/><br/><table>";
                    for($i=0; $i<8; $i++){
                        echo "<tr>";
                        for($j=0; $j<8; $j++){

                            if($matriz[$i][$j] == 11){
                                $dato = 0;
                            }else if($matriz[$i][$j] == 9){
                                $dato = 12;
                            }else{
                                $dato = $matriz[$i][$j];
                            }
                                
                            echo "<td>
                            <a>
                            <img src = 'img/", $dato,".png'/>
                            </a>
                            </td>";
                                    
                        }
                        echo "</tr>";
                    }
                    echo"</table>";
                    echo"</div>";
        }

    }

    public function perdio($y, $x){

        $matriz = $_SESSION["tablero"];
        $aux = $_SESSION["mostrar"];

        if($matriz[$y][$x] == 9 && $aux[$y][$x] != 12){

            $_SESSION["juego"] = false;
            echo '<script type="text/javascript">alert("Has perdido. Intentalo de nuevo!!");</script>';

            echo "<div class='container-fluid'";
            echo"<br/><br/><table>";
            for($i=0; $i<8; $i++){
                echo "<tr>";
                for($j=0; $j<8; $j++){

                    if($matriz[$i][$j] == 11){
                        $dato = 0;
                    }else{
                        $dato = $matriz[$i][$j];
                    }
  
                    echo "<td>
                    <a>
                    <img src = 'img/", $dato,".png'/>
                    </a>
                    </td>";
                            
                }
                echo "</tr>";
            }
            echo"</table>";
            echo"</div>";
            
        }

    }
    
}
?>
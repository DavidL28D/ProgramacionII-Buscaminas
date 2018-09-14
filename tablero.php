<?php
class tablero{

    public function __contruct(){}

    public function generar(){

        unset($_SESSION["tablero"]);
        unset($_SESSION["mostrar"]);

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

    }

    public function mostrar(){

        $matriz = $_SESSION["mostrar"];
        
        echo"Mostrar";
        echo"<table>";
        for($i=0; $i<8; $i++){
            echo "<tr>";
            for($j=0; $j<8; $j++){
                
                /*
                if($matriz[$i][$j] != 0){
                    $dato = 0;
                }else{
                     $dato = $matriz[$i][$j];
                }
                */
                $dato = $matriz[$i][$j];

                echo "<td>
                <a onclick='evento($i, $j)'>
                <img src = 'img/", $dato,".png'/>
                </a>
                </td>";
                        
            }
            echo "</tr>";
        }
        echo"</table>";
        
        
        $matriz = $_SESSION["tablero"];
        echo"</br>";  
        echo "Tablero<br/>";    
        for($i=0; $i<8; $i++){
            for($j=0; $j<8; $j++){
                echo" ",$matriz[$i][$j];
            } 
            echo"<br/>";
        }

    }

    public function comprobar($y, $x){

        $matriz = $_SESSION["tablero"];
        $aux = $_SESSION["mostrar"];

        if($matriz[$y][$x] == 9){

            $_SESSION["juego"] = false;
            echo '<script type="text/javascript">alert("Has perdido. Intentalo de nuevo!!");</script>';

            echo "<div class='container-fluid'";
            echo"<br/><br/><table>";
            for($i=0; $i<8; $i++){
                echo "<tr>";
                for($j=0; $j<8; $j++){
                        
                    echo "<td>
                    <a onclick='evento($i, $j)'>
                    <img src = 'img/", $matriz[$i][$j],".png'/>
                    </a>
                    </td>";
                            
                }
                echo "</tr>";
            }
            echo"</table>";
            echo"</div>";
            
        }else if($matriz[$y][$x] > 0 && $matriz[$y][$x] < 9){

            $aux[$y][$x] = $matriz[$y][$x];
            $_SESSION["mostrar"] = $aux;

        }else if($matriz[$y][$x] == 0){

            tablero::abrir($y, $x);

        }


    }

    public function abrir($i, $j){

        $matriz = $_SESSION["tablero"];
        $aux = $_SESSION["mostrar"];

        if($matriz[$i][$j] != 9){

            if($matriz[$i][$j] == 0){

                $aux[$i][$j] = 11;
                $matriz[$i][$j] = 11;

                $_SESSION["mostrar"] = $aux;
                $_SESSION["tablero"] = $matriz;

                // N
                if($i-1 >= 0){
                    tablero::abrir($i-1, $j);
                    //echo "nueva fila: $i, vieja fila: $i";
                }

                // NE
                if($i-1 >= 0 && $j+1 < 8){
                    tablero::abrir($i-1, $j+1);
                }
                
                // E
                if($j+1 < 8){
                    tablero::abrir($i, $j+1);
                }

                // SE
                if($i+1 < 8 && $j+1 < 8){
                    tablero::abrir($i+1, $j+1);
                }

                // S
                if($i+1 < 8){
                    tablero::abrir($i+1, $j);
                }

                // SO
                if($i+1 < 8 && $j-1 >= 0){
                    tablero::abrir($i+1, $j-1);
                }

                // O
                if($j-1 >= 0){
                    tablero::abrir($i, $j-1);
                }

                // NO
                if($i-1 >= 0 && $j-1 >= 0){
                    tablero::abrir($i-1, $j-1);
                }
                
            }else if($matriz[$i][$j] > 0 && $matriz[$i][$j] < 9){

                $aux[$i][$j] = $matriz[$i][$j];
                
                $_SESSION["mostrar"] = $aux;
                $_SESSION["tablero"] = $matriz;

            }

        }
        
    }
    
}
?>
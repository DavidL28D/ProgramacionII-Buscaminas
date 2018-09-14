<?php
class tablero{

    public $matriz;

    public function __contruct(){}

    public function generar(){

        unset($_SESSION["tablero"]);

        for($i=0; $i<8; $i++){
            for($j=0; $j<8; $j++){
                $matriz[$i][$j] = 0;
            } 
        }

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

        $this->matriz = $_SESSION["tablero"];
        
        echo"<table>";
        for($i=0; $i<8; $i++){
            echo "<tr>";
            for($j=0; $j<8; $j++){
                
                if($this->matriz[$i][$j] != 0){
                    $dato = 0;
                }else{
                     $dato = $this->matriz[$i][$j];
                }
                     
                echo "<td>
                <a onclick='evento($i, $j)'>
                <img src = 'img/", $dato,".png'/>
                </a>
                </td>";
                        
            }
            echo "</tr>";
        }
        echo"</table>";
        
        echo"</br>";      
        for($i=0; $i<8; $i++){
            for($j=0; $j<8; $j++){
                echo" ",$this->matriz[$i][$j];
            } 
            echo"<br/>";
        }

    }

    public function comprobar($y, $x){

        $this->matriz = $_SESSION["tablero"];

        if($this->matriz[$y][$x] == 9){

            $_SESSION["juego"] = false;
            echo '<script type="text/javascript">alert("Has perdido. Intentalo de nuevo!!");</script>';

            echo"<table>";
            for($i=0; $i<8; $i++){
                echo "<tr>";
                for($j=0; $j<8; $j++){
                        
                    echo "<td>
                    <a onclick='evento($i, $j)'>
                    <img src = 'img/", $this->matriz[$i][$j],".png'/>
                    </a>
                    </td>";
                            
                }
                echo "</tr>";
            }
            echo"</table>";
            
        }

    }

}
?>
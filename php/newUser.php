<?php
    require 'permit.php';
    $jsonDeco = json_decode($json);
    echo "<br>";
    
    if($_SERVER["REQUEST_METHOD"] == "POST") {
        echo "Nombre: ".$_POST["nombre"]."<br>";
        echo "Número: ".$_POST["numero"]."<br>";
        echo "Contraseña: ".$_POST["pass"]."<br>";
        echo "Rol: ".$_POST["rol"]."<br>";
        //OBTENIENDO LOS VALORES DE LOS CAMPOS SELECCIONADOS
        for($i = 0; $i < count($jsonDeco); $i++) {
            if(isset($_POST[$jsonDeco[$i]->nameCheck])) {
                echo $_POST[$jsonDeco[$i]->nameCheck]."<br>";
            }
        }
    }
?>
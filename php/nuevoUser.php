<?php
    if(isset(require 'permisos.php')) {

    }
    require 'permisos.php';
    echo "<br>";
    if($_SERVER["REQUEST_METHOD"] == "POST") {
        echo $_POST["nombre"]."<br>";
        echo $_POST["numero"]."<br>";
        echo $_POST["pass"]."<br>";
        echo $_POST["rol"]."<br>";
        $jsonDeco = json_decode($json);
        
        for($i = 0; $i < count($jsonDeco); $i++) {
            if(!isset($_POST[$jsonDeco[$i]->nameCheck])) {
                break;
            }
            echo $_POST[$jsonDeco[$i]->nameCheck]."<br>";
        }
    }
?>
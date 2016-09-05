<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dataB = "my_firtsdb";

    $conexion = new mysqli($servername, $username, $password, $dataB);
    if($conexion->connect_error) {
        die("Connection failed: " . $conexion->connect_error);
    } 

    if(!$conexion->set_charset("utf8")) {
        die("no selecciono el conjunto de caracteres");
    }
?>
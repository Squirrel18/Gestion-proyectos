<?php
    session_start();
    require 'conexion.php';
    if($conexion->connect_error) {
        die("Connection failed: " . $conexion->connect_error);
    }

    $sql = "SELECT * FROM carpetas ORDER BY carpeta ASC";
    $resultado = $conexion->query($sql);
    $conten = array();
    $var1 = 0;
    if($resultado->num_rows > 0) {
        while($fila = $resultado->fetch_array(MYSQLI_ASSOC)) {
            $conten[$var1] = array_map("utf8_encode", $fila);
            $var1++;
        }
    }
    $json = json_encode($conten);
    echo $json;
    $conexion->close();
?>
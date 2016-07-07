<?php
    session_start();
    require 'conexion.php';
    if($conexion->connect_error) {
        die("Connection failed: " . $conexion->connect_error);
    }

    if($stmt = $conexion->prepare("SELECT id, nombre, nameCheck FROM permisos")) {
        $stmt->execute();
        $resultado = $stmt->get_result();
        $conten = array();
        $var1 = 0;
        while($fila = $resultado->fetch_array(MYSQLI_ASSOC)) {
            $conten[$var1] = array_map("utf8_encode", $fila);
            $var1++;
        }
        $json = json_encode($conten);
        echo $json;
        $stmt->close();
    }
    $conexion->close();
?>
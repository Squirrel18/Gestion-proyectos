<?php
    session_start();
    require 'conexion.php';
    if($conexion->connect_error) {
        die("Connection failed: " . $conexion->connect_error);
    }

    if($stmt = $conexion->prepare("SELECT nombre FROM permisos")) {
            //$stmt->bind_param("ss", $usu, $passVal);
            $stmt->execute();
            $stmt->bind_result($resultado);
            //if($stmt->fetch()) {
                while ($stmt->fetch()) {
                    echo $resultado."</br>";
                }
            //} else {
              //  echo "Error";
            //}
            $stmt->close();
        }
    $conexion->close();
?>
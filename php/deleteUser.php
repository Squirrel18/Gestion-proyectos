<?php
    require 'verifData.php';
    $usuario = verifDatos($_POST["numero"]);
    
    if($_SERVER["REQUEST_METHOD"] == "POST") {
        $numero = $_POST["numero"];
        
    }
    deleteUser("1069755449");
    function deleteUser($num) {
        require 'conexion.php';
        $estado = '0';

        if($conexion->connect_error) {
            $realizado = false;
            die("Connection failed: " . $conexion->connect_error);
        } 
        
        if($stmt = $conexion->prepare("UPDATE usuarios SET estado=? WHERE numero=?")) {
            $stmt->bind_param("ss", $estado, $num);
            $stmt->execute();
            $stmt->close();
        } else {
            echo "Error al eliminar";
        }

        if($stmt = $conexion->prepare("SELECT estado FROM usuarios WHERE numero=?")) {
            $stmt->bind_param("s", $num);
            $stmt->execute();
            $stmt->bind_result($resultado);
            if($stmt->fetch()) {
                if($resultado == '0') {
                    echo "true";
                } else {
                    echo "false";
                }
            } else {
                echo "Error el eliminar";
            }
            $stmt->close();
        }
        $conexion->close();
    }
?>
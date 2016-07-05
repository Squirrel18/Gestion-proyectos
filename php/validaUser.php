<?php
    $usuario = $_POST["user"];
    $pass = $_POST["pass"];

    if(isset($usuario) || isset($pass)) {
        comprobarLogin($usuario,$pass);
    } else {
        echo "error";
    }

    function cerrar($conexi) {
        $conexi->close();
    }

    function comprobarLogin($usu, $passVal) {

        $con = conectar();
        $sql = "SELECT usuario FROM login WHERE estado='1' AND usuario='".$usu."' AND contrasena='".$passVal."'";

        if($stmt = $con->prepare("SELECT usuario FROM login WHERE estado='1' AND usuario=? AND contrasena=?")) {
            $stmt->bind_param("ss", $usu, $passVal);
            $stmt->execute();
            //$stmt->bind_result($resultado);
            if($stmt->fetch()) {
                echo "true";
            } else {
                echo "false";
            }
            $stmt->close();
        }

        /*$sql = "SELECT usuario FROM login WHERE estado='1' AND usuario='".$usu."' AND contrasena='".$passVal."'";
        $result = $con->query($sql);

        if($result->num_rows > 0) {
            echo "true";
        } else {
            echo "false";
        }
        }*/
        cerrar($con);
    }

    function conectar() {
        require 'conexion.php';
        if($conexion->connect_error) {
            die("Connection failed: " . $conexion->connect_error);
        } 
        return $conexion;
    }
?>
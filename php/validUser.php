<?php
    require 'verifData.php';
    
    if($_SERVER["REQUEST_METHOD"] == "POST") {

        $usuario = verifDatos($_POST["user"]);
        $pass = verifDatos($_POST["key"]);

        require_once '../php/session.php';
        $obj = new sesion();
        $obj->setSession($usuario);
        comprobarusuario($usuario,$pass);
    }

    function cerrar($conexi) {
        $conexi->close();
    }

    function comprobarusuario($usu, $passVal) {

        $con = conectar();

        if($stmt = $con->prepare("SELECT numero FROM usuarios WHERE estado='1' AND numero=? AND contrasena=?")) {
            $stmt->bind_param("ss", $usu, $passVal);
            $stmt->execute();
            //$stmt->bind_result($resultado);
            if($stmt->fetch()) {
                header('Location: ../pages/admin.php');
            } else {
                header('Location: ../index.php?msj=0');
            }
            $stmt->close();
        }
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
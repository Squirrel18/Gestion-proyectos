<?php
    $usuario = $_POST["usuario"];

    if(isset($usuario)) {
        comprobarUser($usuario);
    } else {
        echo "error";
    }

    function cerrar($conexi) {
        $conexi->close();
    }

    function comprobarUser($usu) {

        $con = conectar();
        $sql = "SELECT usuario FROM login WHERE estado='1' AND usuario='".$usu."'";
        $result = $con->query($sql);

        if($result->num_rows > 0) {
            echo "true";
        } else {
            echo "false";
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
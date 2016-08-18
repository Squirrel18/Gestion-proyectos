<?php
    require 'verifData.php';
    
    if($_SERVER["REQUEST_METHOD"] == "POST") {

        $usuario = verifDatos($_POST["user"]);
        $pass = verifDatos($_POST["key"]);

        require_once '../php/session.php';
        $obj = new sesion();
        $obj->setSession($usuario);
    }
    
    if(isset($usuario) || isset($pass)) {
        comprobarusuario($usuario,$pass);
    } else {
        header('Location: ../index.php?error=0');
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
                header('Location: ../index.php?error=1');
            }
            $stmt->close();
        }

        /*$sql = "SELECT usuario FROM usuario WHERE estado='1' AND usuario='".$usu."' AND contrasena='".$passVal."'";
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

    /*$servername = "localhost";
    $username = "root";
    $password = "";
    $dataB = "my_firtsdb";

    $conexion = new mysqli($servername, $username, $password, $dataB);
    if($conexion->connect_error) {
        die("Connection failed: " . $conexion->connect_error);
    }

    $estado = "1";
    $nombre = "1069755449";

    $sql = "SELECT usuario, contrasena FROM usuario WHERE usuario.estado='1'";
    $result = $conexion->query($sql);

    if ($result->num_rows > 0) {
        // output data of each row
        $row = $result->fetch_object();
        $userT = $row->usuario;
        $passT = $row->contrasena;
        /*while($row = $result->fetch_object()) {
            echo $row->usuario."</br>";
            echo $row->contrasena."</br>";
        }*/
    //}

    /*if($stmt = $conexion->prepare("SELECT usuario, contrasena FROM usuario WHERE estado=? AND usuario=?")) {
        $stmt->bind_param("ss", $estado, $nombre);
        $stmt->execute();
        $stmt->bind_result($user, $passValue);
        //if($stmt->fetch()) {

        while ($stmt->fetch()) {
            echo  $user.$passValue."</br>";
        }*/

            /*$_SESSION["favcolor"] = "green";
            $_SESSION["favanimal"] = "cat";
            if($_SERVER["REQUEST_METHOD"] == "POST") {
        
                $usuario = $_REQUEST["user"];
                $pass = $_REQUEST["key"];
                echo $usuario.$pass;

                //if(isset($pass)) {
                    if($usuario === $userT && $pass === $passT) {
                        echo "son iguales";
                    } else {
                        //header('Location: ../index.php?error=1');
                    }
                }  else {
                    //header('Location: ../index.php?error=1');
                //}
            }
        //}
        //$stmt->close();
        $conexion->close();
    //}*/

?>
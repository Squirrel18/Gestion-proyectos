<?php
    require 'permit.php';
    $jsonDeco = json_decode($json);
    echo "<br>";
    $realizado;
    
    if($_SERVER["REQUEST_METHOD"] == "POST") {
        $contenPer = array();
        $varContador = 0;
        //OBTENIENDO LOS VALORES DE LOS CAMPOS SELECCIONADOS CHECK
        for($i = 0; $i < count($jsonDeco); $i++) {
            if(isset($_POST[$jsonDeco[$i]->nameCheck])) {
                $contenPer[$varContador] = $_POST[$jsonDeco[$i]->nameCheck];
                $varContador++;
            }
        }

        $name = $_POST["nombre"];
        $numero = $_POST["numero"];
        $contra = $_POST["pass"];
        $rol = $_POST["rol"];
        $estado = '1';
        updateDatos($name, $numero, $contra, $rol, $estado);
        if($realizado) {
            header('Location: ../pages/buscarUsua.php');
        } else {
            echo "Ocurrio un error";
        }
    }

    function updateDatos($nom, $num, $pass, $rol, $esta) {
        require 'conexion.php';
        global $contenPer, $realizado;

        if($conexion->connect_error) {
            $realizado = false;
            die("Connection failed: " . $conexion->connect_error);
        } 

        if(!$conexion->set_charset("utf8")) {
            die("no selecciono el conjunto de caracteres");
        }

        if($stmt = $conexion->prepare("UPDATE usuarios SET nombre=?, contrasena=?, rol=? WHERE numero=?")) {
            $stmt->bind_param("ssss", $nom, $pass, $rol, $num);
            $stmt->execute();
            $stmt->close();
        } else {
            $realizado = false;
        }

        if($stmt = $conexion->prepare("SELECT id FROM usuarios WHERE estado='1' AND numero=?")) {
            $stmt->bind_param("s", $num);
            $stmt->execute();
            $stmt->bind_result($resultado);
            if($stmt->fetch()) {
                $updateId = $resultado;
            } else {
                echo "false";
            }
            $stmt->close();
        }

        if($conexion->query("DELETE FROM usupermisos WHERE idUsuario=".$updateId."") === TRUE) {
            echo "Record deleted successfully";
        } else {
            $realizado = false;
        }

        for($vari = 0; $vari < count($contenPer); $vari++) {
            $sql = "INSERT INTO usupermisos(idUsuario, idPermiso) VALUES(".$updateId.", ".$contenPer[$vari].")";
            if ($conexion->query($sql) === TRUE) {
                //echo "New record created successfully";
            } else {
                $realizado = false;
            }
        }
        $conexion->close();
        $realizado = true;
        return $realizado;
    }
?>
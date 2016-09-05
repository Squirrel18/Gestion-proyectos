<?php
    require 'permit.php';
    $jsonDeco = json_decode($json);
    echo "<br>";
    
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

        require_once 'verifData.php';
        $name = verifDatos($_POST["nombre"]);
        $numero = verifDatos($_POST["numero"]);
        $contra = verifDatos($_POST["pass"]);
        $rol = verifDatos($_POST["rol"]);
        $estado = '1';
        insertDatos($name, $numero, $contra, $rol, $estado);
    }

    function insertDatos($nom, $num, $pass, $rol, $esta) {
        require 'conexion.php';
        global $contenPer;

        $sql = "SELECT numero FROM usuarios WHERE numero=$num";
        $result = $conexion->query($sql);
        if($result->num_rows > 0) {
            header('Location: ../pages/nuevUsua.php?msj=0');
        } else {
            if($stmt = $conexion->prepare("INSERT INTO usuarios(nombre, numero, contrasena, rol, estado) VALUES (?, ?, ?, ?, ?)")) {
                $stmt->bind_param("sssss", $nom, $num, $pass, $rol, $esta);
                $stmt->execute();
                $ultimoId = $conexion->insert_id;
                $stmt->close();
            } else {
                header('Location: ../pages/nuevUsua.php?msj=1');
            }

            for($vari = 0; $vari < count($contenPer); $vari++) {
                $sql = "INSERT INTO usupermisos(idUsuario, idPermiso) VALUES(".$ultimoId.", ".$contenPer[$vari].")";
                if ($conexion->query($sql) === TRUE) {
                    header('Location: ../pages/nuevUsua.php?msj=3');
                } else {
                    header('Location: ../pages/nuevUsua.php?msj=2');
                }
            }
        }
        $conexion->close();
    }
?>
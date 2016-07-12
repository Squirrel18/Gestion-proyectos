<?php
    //header("Content-type: text/html; charset=utf8");
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
        insertDatos($name, $numero, $contra, $rol, $estado);
        if($realizado) {
            header('Location: ../pages/nuevUsua.php');
        } else {
            echo "Ocurrio un error";
        }
    }

    function insertDatos($nom, $num, $pass, $rol, $esta) {
        require 'conexion.php';
        global $contenPer, $realizado;

        if($conexion->connect_error) {
            $realizado = false;
            die("Connection failed: " . $conexion->connect_error);
        } 

        if(!$conexion->set_charset("utf8")) {
            die("no selecciono el conjunto de caracteres");
        }

        if($stmt = $conexion->prepare("INSERT INTO login(nombre, numero, contrasena, rol, estado) VALUES (?, ?, ?, ?, ?)")) {
            $stmt->bind_param("sssss", $nom, $num, $pass, $rol, $esta);
            $stmt->execute();
            $ultimoId = $conexion->insert_id;
            $stmt->close();
        } else {
            $realizado = false;
        }

        for($vari = 0; $vari < count($contenPer); $vari++) {
            $sql = "INSERT INTO usupermisos(idUsuario, idPermiso) VALUES(".$ultimoId.", ".$contenPer[$vari].")";
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
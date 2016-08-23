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

        for($i = 0; $i < count($contenPer); $i++) {
            echo $contenPer[$i];
            /*if($conexion->query("DELETE FROM usupermisos WHERE idUsuario=$updateId AND idPermiso!=$contenPer[$i]") === TRUE) {
                echo "Record deleted successfully";
            } else {
                echo "NO elimino";
            }*/
        }

        /*for($i = 0; $i < count($contenPer); $i++) {
            if($stmt = $conexion->prepare("INSERT INTO usupermisos(idUsuario, idPermiso) SELECT * FROM (SELECT $updateId, $contenPer[$i]) AS tmp WHERE NOT EXISTS (SELECT * FROM usupermisos WHERE idUsuario=? AND idPermiso=?) LIMIT 1")) {
                $stmt->bind_param("ii", $updateId, $contenPer[$i]);
                $stmt->execute();
            } else {
                echo "no realizo el insert";
            }
            $stmt->close();
        }*/
        $conexion->close();
        $realizado = true;
    }
?>
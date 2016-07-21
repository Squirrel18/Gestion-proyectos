<?php
    require 'folder.php';
    $jsonDeco = json_decode($json);
    echo "<br>";

    if($_SERVER["REQUEST_METHOD"] == "POST") {

        $contenPer = array();
        $nomCarpetas = array();
        $varContador = 0;
        //OBTENIENDO LOS VALORES DE LOS CAMPOS SELECCIONADOS CHECK
        for($i = 0; $i < count($jsonDeco); $i++) {
            if(isset($_POST[$jsonDeco[$i]->id])) {
                $contenPer[$varContador] = $_POST[$jsonDeco[$i]->id];
                $varContador++;
            }
        }

        require 'verifData.php';
        $nombre = verifDatos($_POST["nombre"]);
        $numero = verifDatos($_POST["numero"]);
        $descri = verifDatos($_POST["descripcion"]);
    }

    if(isset($nombre) || isset($numero) || isset($descri)) {
        if(file_exists("../proyectos/".$nombre)) {
            echo "ya esxite el directoio";
        } else {
            creaPro($nombre, $numero, $descri);
        }
        
    } else {
        header('Location: ../index.php?error=0');
    }

    function creaPro($name, $num, $des) {
        require 'conexion.php';
        global $contenPer;
        $nombres = array();

        if(!$conexion->set_charset("utf8")) {
            die("no selecciono el conjunto de caracteres");
        }

        if($conexion->connect_error) {
            die("Connection failed: " . $conexion->connect_error);
        }

        if($stmt = $conexion->prepare("INSERT INTO proyectos(nombre, numero, descripcion) VALUES (?, ?, ?)")) {
            $stmt->bind_param("sss", $name, $num, $des);
            $stmt->execute();
            $ultimoId = $conexion->insert_id;
            $stmt->close();
            mkdir("../proyectos/".$name, 0700);
            

        } else {
            echo "No realizo nada";
        }

        for($vari = 0; $vari < count($contenPer); $vari++) {
            mkdir("../proyectos/".$name."/".utf8_decode($contenPer[$vari]), 0700);
        }

        $conexion->close();
    }
?>
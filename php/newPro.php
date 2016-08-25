<?php
    require 'folder.php';
    $jsonDeco = json_decode($json);
    echo "<br>";
    $realizado;

    if($_SERVER["REQUEST_METHOD"] == "POST") {
        $contenPer = array();
        $nomCarpetas = array();
        $varContador = 0;
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
        if(isset($nombre) || isset($numero) || isset($descri)) {
            compruebaPro($numero);
        } else {
            header('Location: ../pages/nuevProye.php');
        }
    }

    function compruebaPro($num) {
        global $nombre, $numero, $descri, $realizado;
        require 'conexion.php';

        $sql = "SELECT numero FROM proyectos WHERE numero='".$num."'";
        $resultado = $conexion->query($sql);
        if ($resultado->num_rows > 0) {
            //header('Location: ../pages/nuevProye.php');
            echo "Proyecto con el mismo nombre";
        } else {
            creaPro($nombre, $numero, $descri);
        }
    }

    function creaPro($name, $num, $des) {
        require 'conexion.php';
        global $contenPer, $realizado;
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
            mkdir("../proyectos/".utf8_decode($name)."_".utf8_decode($num), 0700);
        } else {
            echo "No realizo nada";
        }

        for($vari = 0; $vari < count($contenPer); $vari++) {
            mkdir("../proyectos/".utf8_decode($name)."_".utf8_decode($num)."/".utf8_decode($contenPer[$vari]), 0700);
        }
        echo "Proyecto creado";
        $conexion->close();
    }
?>
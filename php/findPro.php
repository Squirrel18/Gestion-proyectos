<?php

    require 'verifData.php';
    $usuario = verifDatos($_POST["datoBus"]);
    $usuario = "%".$usuario."%";
    //$usuario = "%1%";

    if(isset($usuario)) {
        buscarPro($usuario);
    } else {
        echo "error";
    }

    function buscarPro($numero) {
        require 'conexion.php';
        if($conexion->connect_error) {
            die("Connection failed: " . $conexion->connect_error);
        }

        if($stmt = $conexion->prepare("SELECT id, numero, nombre FROM proyectos WHERE numero LIKE ? OR nombre LIKE ?")) {
            $stmt->bind_param("ss", $numero, $numero);
            $stmt->execute();
            $resultado = $stmt->get_result();
            $nombre;
            $numero;
            if($resultado->num_rows > 0) {
                while($fila = $resultado->fetch_array(MYSQLI_ASSOC)) {
                    $nombre = $fila['nombre'];
                    $numero = $fila['numero'];
                    $total = $nombre." ".$numero;
                    $id = $fila['id'];
                    echo "<p class='lista' onclick='cambiarDir($id)'>$total</p>";
                }
            } else {
                echo "no";
            }
            $stmt->close();
        } 
        $conexion->close();
    }

    /*function nombrwe() {
        //$dato = $_POST["datoBus"];
    $d = dir("../proyectos");
    $var;
    //echo "Handle: " . $d->handle . "<br>";
    //echo "Path: " . $d->path . "<br>";
    while (false !== ($entry = $d->read())) {
        if($entry != "." && $entry != "..") {
            if(!is_file($d->path."/".$entry)) {
                $nueva = str_replace(" ", "%", $entry);
                echo "<p class='lista' onclick='cambiarDir($nueva)'>".$entry."</p><br>";
                echo $entry;
            } else {

            }
        }
    }
    $d->close();

    /*$folder = dir($var);
    echo "<br>";
    while (false !== ($entry = $folder->read())) {
        if($entry != "." && $entry != "..") {
            if(!is_file($folder->path."/".$entry)) {
                echo $folder->path."/".utf8_encode($entry)."<br>";
            } else {

            }
        }
    }
    $folder->close();*/
    //}
    
?>
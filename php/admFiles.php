<?php
    require 'verifData.php';

    if($_SERVER["REQUEST_METHOD"] == "POST") {
        $target_dir = verifDatos($_POST["path"]);
        $target_dir = utf8_decode($target_dir);
        $target_dir = $target_dir."/";
        
        $archivos = $_FILES["archivo"]["name"];

        for($i = 0; $i < count($archivos); $i++) {
            $ruta = basename($_FILES["archivo"]["name"][$i]);
            $FileType = pathinfo($ruta,PATHINFO_EXTENSION);
            $ruta = utf8_decode($ruta);
            cargaArch($_FILES["archivo"]["tmp_name"][$i], $target_dir.$ruta, $_FILES["archivo"]["name"][$i]);
        }
    }

    function cargaArch($archivo, $path, $nombre) {
        if (move_uploaded_file($archivo, $path)) {
            //echo "The file ". basename($nombre). " has been uploaded.<br>";
            echo true;
        } else {
            //echo "Sorry, there was an error uploading your file.";
            echo false;
        }
    }
?>
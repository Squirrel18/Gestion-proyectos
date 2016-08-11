<?php

    if($_SERVER["REQUEST_METHOD"] == "POST") {
        $target_dir = "uploads/";
        
        $archivos = $_FILES["archivo"]["name"];
        //print_r($_FILES["archivo"]["name"]);
        echo count($archivos);

        for($i = 0; $i < count($archivos); $i++) {
            $ruta = $target_dir.basename($_FILES["archivo"]["name"][$i]);
            $FileType = pathinfo($ruta,PATHINFO_EXTENSION);
            cargaArch($_FILES["archivo"]["tmp_name"][$i], $ruta, $_FILES["archivo"]["name"][$i]);
        }
    }

    function cargaArch($archivo, $path, $nombre) {
        if (move_uploaded_file($archivo, $path)) {
            echo "The file ". basename($nombre). " has been uploaded.<br>";
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }
?>
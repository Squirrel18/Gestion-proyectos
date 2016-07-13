<?php
    require 'verifData.php';
    $usuario = verifDatos($_POST["num"]);

    if(isset($usuario)) {
        datos($usuario);
    } else {
        echo "error";
    }

    function datos($numero) {
        require 'conexion.php';
        if($conexion->connect_error) {
            die("Connection failed: " . $conexion->connect_error);
        } 

        if($stmt = $conexion->prepare("SELECT id, numero, nombre, contrasena, rol FROM login WHERE estado='1' AND numero=?")) {
            $stmt->bind_param("s", $numero);
            $stmt->execute();
            $resultado = $stmt->get_result();
            $conten = array();
            $var1 = 0;
            while($fila = $resultado->fetch_array(MYSQLI_ASSOC)) {
                $conten[$var1] = array_map("utf8_encode", $fila);
                $var1++;
            }
            $json = json_encode($conten);
            echo $json;
            $stmt->close();
        }
        $conexion->close();
    }
?>
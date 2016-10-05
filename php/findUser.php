<?php
    require 'verifData.php';
    $usuario = verifDatos($_POST["usuario"]);

    if($usuario == false) { #Retorna falso de verifData.php en caso de que el dato contenga datos no validos o esté vacío
        buscarUser("nodata"); #Se envía el dato true para ser validado en la función
    } else {
        $usuario = "%".$usuario."%";
        buscarUser($usuario);
    }

    function buscarUser($numero) {
        require 'conexion.php';
        if($conexion->connect_error) {
            die("Connection failed: " . $conexion->connect_error);
        }

        if($numero == "nodata") {
            $sql = "SELECT numero, nombre, rol FROM usuarios WHERE estado='1'";
            $result = $conexion->query($sql);
            $conten = array();
            $var1 = 0;
            if ($result->num_rows > 0) {
                while($fila = $result->fetch_array(MYSQLI_ASSOC)) {
                    $conten[$var1] = array_map("utf8_encode", $fila);
                    $var1++;
                }
                $json = json_encode($conten);
                echo $json;
            } else {
                echo "0 results";
            }
        } else {
            if($stmt = $conexion->prepare("SELECT numero, nombre, rol FROM usuarios WHERE estado='1' AND numero LIKE ?")) {
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
        }
        $conexion->close();
    }
    
?>
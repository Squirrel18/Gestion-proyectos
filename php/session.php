<?php
    session_start();

    #Obtiene los datos de nombre y rol para rellenar en cada página
    if($_SERVER["REQUEST_METHOD"] == "POST") {
        require_once 'verifData.php';
        $obj = new sesion();
        $peticion = verifDatos($_POST["requiredD"]);
        if($peticion == 1) {
            echo $obj->getData();
        } else {
            echo "no data";
        }
    }
    
    class sesion {
        #Método que verifique si hay una sesión iniciada.
        #Método que devuelva si id y permiso coinciden.
        #Método que retone el nivel de permiso.

        private $id;
        private $per;
        private $exist;

        public function __construct() {
            //$this->id = $_SESSION['us'];
        }

        public function getSession() {
            if($this->consultId($_SESSION['us'])) {
                return $_SESSION['us'];
            } else {
                return "usuario desconocido";
            }
        }

        public function setSession($id) {
            $_SESSION['us'] = $id;
        }

        public function setPermi($per) {
            $_SESSION['per'] = $per;
            return $_SESSION['per'];
        }

        private function consultId($id) {
            require 'conexion.php';
            if($conexion->connect_error) {
                die("Connection failed: " . $conexion->connect_error);
            }

            if($stmt = $conexion->prepare("SELECT numero FROM usuarios WHERE estado='1' AND numero=?")) {
                $stmt->bind_param("s", $id);
                $stmt->execute();
                if($stmt->fetch()) {
                    return true;
                } else {
                    return false;
                }
                $stmt->close();   
            }
            $conexion->close();
        }

        public function getData() {
            require 'conexion.php';
            if($conexion->connect_error) {
                die("Connection failed: " . $conexion->connect_error);
            }
            $numero = $this->getSession();
            if($stmt = $conexion->prepare("SELECT nombre, rol FROM usuarios WHERE estado='1' AND numero=?")) {
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
                return $json;
                $stmt->close();
            }
            $conexion->close();
        }

        public function getPermi() {
            require 'conexion.php';
            if($conexion->connect_error) {
                die("Connection failed: " . $conexion->connect_error);
            }
            $sql = "SELECT idPermiso FROM usupermisos INNER JOIN usuarios ON usupermisos.idUsuario=usuarios.Id WHERE usuarios.numero='".$this->getSession()."'";
            $result = $conexion->query($sql);
            $cont = array();
            $itera = 0;
            if($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    $cont[$itera] = $row;
                    $itera++;
                }
                return $cont;
            } else {
                echo "false";
            }
        } 
    }

?>
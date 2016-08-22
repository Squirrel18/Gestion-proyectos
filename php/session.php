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
            if(isset($_SESSION['us'])) {
                if($this->consultId($_SESSION['us'])) {
                    /*$sessions = array();
                    $sessions[0] = $_SESSION['us'];
                    $permi = $_SESSION['per'];
                    for($i = 0; $i < count($permi); $i++) {
                        $sessions[$i + 1] = $permi[$i]["idPermiso"];
                    }*/
                    return true;
                } else {
                    return false;
                }
            } else {
                return false;
            }
            
        }

        public function setSession($id) {
            $_SESSION['us'] = $id;
            $_SESSION['per'] = $this->getPermi();
        }

        public function getId() {
            return $_SESSION['us'];
        }

        public function getPer() {
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
            $numero = $this->getId();
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

        private function getPermi() {
            require 'conexion.php';
            if($conexion->connect_error) {
                die("Connection failed: " . $conexion->connect_error);
            }
            $sql = "SELECT idPermiso FROM usupermisos INNER JOIN usuarios ON usupermisos.idUsuario=usuarios.Id WHERE usuarios.numero='".$this->getId()."'";
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
            $conexion->close();
        }

        private function compruebaPer($namePag) {
            require 'verifData.php';
            require 'conexion.php';

            $namePag = verifDatos($namePag);
            $namePag = strtolower($namePag);

            $dataPermiso = $this->getPer();
            if($conexion->connect_error) {
                die("Connection failed: " . $conexion->connect_error);
            }

            $conten = array();
            $var1 = 0;

            for($i = 0; $i < count($dataPermiso); $i++) {
                if($stmt = $conexion->prepare("SELECT Pagina FROM paginas INNER JOIN relacion_pag ON relacion_pag.idPagina=paginas.id WHERE relacion_pag.idPermiso=?")) {
                    $stmt->bind_param("s", $dataPermiso[$i]["idPermiso"]);
                    $stmt->execute();
                    $resultado = $stmt->get_result();
                    while($fila = $resultado->fetch_array(MYSQLI_ASSOC)) {
                        $conten[$var1] = $fila;
                        $var1++;
                    }
                    $stmt->close();
                }
            }
            $conexion->close();
            return $conten;
        } 

        public function pagPermitida($data) {
            $permiso;
            $data = strtolower($data);
            $cont = $this->compruebaPer($data);
            for($i = 0; $i < count($cont); $i++) {
                if($cont[$i]["Pagina"] != $data) {
                    $permiso = false;
                } else {
                    $permiso = true;
                    break;
                }
            }
            if(!$permiso) {
                header('Location: ../');
            }
        }
    }

    function obtenNamePag($data) {
        $ultimoSl = strripos($data, "/");
        $nombreTotal = substr($data, $ultimoSl + 1, strlen($data));
        $punto = strripos($nombreTotal, ".");
        $nombreInte = substr($nombreTotal, 0, $punto);
        return $nombreInte;
    }
?>
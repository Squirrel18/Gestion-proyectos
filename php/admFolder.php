<?php
    require 'verifData.php';
    $folder = verifDatos($_POST["folderId"]);

    $directorio = new directorios();

    if(isset($folder)) {
        require 'conexion.php';
        $sql = "SELECT nombre, numero FROM proyectos WHERE id='".$folder."'";
        $result = $conexion->query($sql);

        if ($result->num_rows > 0) {
            while($row = $result->fetch_array(MYSQLI_ASSOC)) {
                $total = $row['nombre']." ".$row['numero'];
                $directorio->setDir($total);
            }
        } else {
            echo "0 results";
        }
        $conexion->close();
    } else {
        echo "error";
    }
    
    /**
     * 
     */
    class directorios {
        
        private static $dirPrincipal;
        public $rutaDir;
        protected $directorio;
        private $folders;

        public function __construct() {
            $this->rutaDir = null;
            $this->dirPrincipal = "../proyectos/";
        }

        public function setDir($setRuta) {
            
            if($setRuta == "" || $setRuta == null) {
                $this->directorio = dir($this->dirPrincipal);
            } else {
                $this->directorio = dir($this->dirPrincipal.$setRuta);
            }

            $direc = $this->directorio;

            while(false != ($folders = $direc->read())) {
                if($folders != "." && $folders != "..") {
                    if(is_dir($direc->path."/".$folders)) {
                        $resulUTF8 = $this->codificacion($folders);
                        echo "<p class='lista'>$resulUTF8</p>";
                    } else {
                        //echo "Son archivos";
                    }
                }
            }
        }

        private function codificacion($datos) {
            $datos = utf8_encode($datos);
            return $datos;
        }
    }
?>
<?php
    require 'verifData.php';

    $directorio = new directorios();

    if(isset($_POST["datoBus"])) {
        $usuario = verifDatos($_POST["datoBus"]);
        $directorio->getDir($usuario);
    }

    if(isset($_POST["folderId"])) {
        $folder = verifDatos($_POST["folderId"]);
        $directorio->setDir($folder);
    }

    if(isset($_POST["folderParent"])) {
        $parent = verifDatos($_POST["folderParent"]);
        
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
            $this->directorio = dir($setRuta);
            $direc = $this->directorio;
            $atras = true;
    
            while(false != ($folders = $direc->read())) {
                if($folders != "." && $folders != "..") {
                    if(is_dir($direc->path."/".$folders)) {
                        $resulUTF8 = $this->codificacion($folders);
                        $total = $direc->path."/".$resulUTF8;
                        $total = str_replace(" ", "#", $total);
                        $padre = dirname($total);
                        if($atras) {
                            echo "<input type='button' value='atras' onclick="."atras('$padre')".">";
                            $atras = false;
                        }
                        echo "<p class='lista' onclick="."cambiarDir('$total')".">$resulUTF8</p>";
                    } else {
                        //echo "Son archivos";
                    }
                }
            }
            $direc->close();
        }

        public function getDir($name) {
            $this->directorio = dir($this->dirPrincipal);
            $direc = $this->directorio;

            while(false != ($folders = $direc->read())) {
                if($folders != "." && $folders != "..") {
                    if(is_dir($direc->path."/".$folders)) {
                        $resulUTF8 = $this->codificacion($folders);
                        if(stristr($resulUTF8, $name)) {
                            $varSub = stripos($resulUTF8, "_");
                            $varLength = strlen($resulUTF8);
                            $resultado = substr($resulUTF8, $varSub + 1, $varLength);
                            $reempla = str_replace(" ", "#", $resulUTF8);
                            $total = $direc->path.$reempla;
                            echo "<p class='lista' onclick="."cambiarDir("."'$total'".")".">$resulUTF8</p>";
                        }
                    } else {
                        //echo "Son archivos";
                    }
                }
            }
            $direc->close();
        }

        private function codificacion($datos) {
            $datos = utf8_encode($datos);
            return $datos;
        }
    }
?>
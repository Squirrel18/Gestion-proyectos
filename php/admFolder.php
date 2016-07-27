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
            $contador = 0;
            while(false != ($folders = $direc->read())) {
                $contador++;
                if($folders != "." && $folders != "..") {
                    $organizar[$contador] = $folders;
                    if(is_dir($direc->path."/".$folders)) {
                        $resulUTF8 = $this->codificacion($organizar[$contador]);
                        $total = $direc->path."/".$resulUTF8;
                        $total = str_replace(" ", "#", $total);
                        $padre = dirname($total);
                        echo "<i class='material-icons md-48 fontFolder'>folder</i><p class='lista' onclick="."cambiarDir('$total')".">$resulUTF8</p>";
                    } else {
                        $resulUTF8 = $this->codificacion($organizar[$contador]);
                        echo "<i class='material-icons md-48 fontFile'>insert_drive_file</i><p class='listaFile'>$resulUTF8</p>";
                    }
                }
            }
            $direc->close();
        }

        public function getDir($name) {
            $this->directorio = dir($this->dirPrincipal);
            $direc = $this->directorio;
            $contador = 0;

            while(false != ($folders = $direc->read())) {
                $contador++;
                if($folders != "." && $folders != "..") {
                    $organizar[$contador] = $folders;
                    if(is_dir($direc->path."/".$folders)) {
                        $resulUTF8 = $this->codificacion($organizar[$contador]);
                        if(stristr($resulUTF8, $name)) {
                            $varSub = stripos($resulUTF8, "_");
                            $varLength = strlen($resulUTF8);
                            $resultado = substr($resulUTF8, $varSub + 1, $varLength);
                            $reempla = str_replace(" ", "#", $resulUTF8);
                            $total = $direc->path.$reempla;
                            echo "<i class='material-icons md-48 fontFolder'>folder</i><p class='lista' onclick="."cambiarDir("."'$total'".")".">$resulUTF8</p>";
                        }
                    } else {
                        
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
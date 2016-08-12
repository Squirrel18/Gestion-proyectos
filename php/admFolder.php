<?php
    require 'verifData.php';

    #Se instancia la clase directorios
    $directorio = new directorios();

    #Se verifica que dato es el que se envío
    if(isset($_POST["datoBus"])) {
        $buscar = verifDatos($_POST["datoBus"]);
        $directorio->getDir($buscar);
    }

    if(isset($_POST["folderId"])) {
        $folder = verifDatos($_POST["folderId"]);
        $directorio->setDir($folder);
    }
    
    /**
     *Clase directorios
     */
    class directorios {

        private static $dirPrincipal;
        //public $rutaDir;
        protected $directorio;
        private $folders;

        public function __construct() {
            //$this->rutaDir = null;
            $this->dirPrincipal = "../proyectos/";
        }

        #Configura la ruta que se envía.
        public function setDir($setRuta) {
            #$setRuta es el dato que se envía de la carpeta sobre la que se selecciono
            #Se quita la codificación de $setRuta porque esta en utf8 y el lector de directorios esta leyendo en ISO-8859-1
            #Se asigna la dirección que viene en $setRuta

            $valorSet = strlen($setRuta) + 1;
            $valorDirP = strlen($this->dirPrincipal);

            $setRuta = utf8_decode($setRuta);
            $this->directorio = dir($setRuta);
            $direc = $this->directorio;
            $atras = true;
            $contador = 0;
            $ruta = true;

            while(false != ($folders = $direc->read())) {
                $contador++;
                if($folders != "." && $folders != "..") {
                    $organizar[$contador] = $folders;
                    if(is_dir($direc->path."/".$folders)) {
                        $folders = utf8_encode($folders);
                        $path = utf8_encode($direc->path);
                        
                        //$resulUTF8 = $this->codificacion($organizar[$contador]);

                        $total = $path."/".$folders;
                        $total = str_replace(" ", "#", $total);

                        if($ruta == true) {
                            echo "<p id='ruta'>".$path."</p>";
                            $ruta = false;
                        }
                        echo "<i class='material-icons md-48 fontFolder'>folder</i><p class='lista' onclick="."cambiarDir('$total')".">$folders</p>";
                    } else {
                        if($ruta == true) {
                            $path = utf8_encode($direc->path);
                            echo "<p id='ruta'>".$path."</p>";
                            $ruta = false;
                        }
                        $folders = utf8_encode($folders);
                        echo "<i class='material-icons md-48 fontFile'>insert_drive_file</i><p class='listaFile'>$folders</p>";
                    }
                }
            }
            if($ruta == true) {
                $path = utf8_encode($direc->path);
                echo "<p id='ruta'>".$path."</p>";
                $ruta = false;
            }
            $direc->close();
        }

        #Configura la ruta principal y busca directorios según el parámetro
        public function getDir($name) {
            #$name Es el parámetro a buscar dentro de la carpeta principal
            #Asigna la dirección del directorio principal
            $this->directorio = dir($this->dirPrincipal);
            $direc = $this->directorio;
            $ruta = true;

            while(false != ($folders = $direc->read())) {
                if($folders != "." && $folders != "..") {
                    if(is_dir($direc->path."/".$folders)) {
                        #Se codifica a utf8
                        $folders = utf8_encode($folders);
                        #Buscar los directorios a partir de $name
                        if(stristr($folders, $name)) {
                            #Se reemplaza los espacios de la cadena por '#' para no tener inconvenientes al momento de concatenar
                            $reempla = str_replace(" ", "#", $folders);
                            $total = $direc->path.$reempla;

                            #Este es el dato que se envía sobre la ruta donde esta.
                            if($ruta == true) {
                                echo "<p id='ruta'>".$direc->path."</p>";
                                $ruta = false;
                            }

                            #Son las carpetas que existen
                            echo "<i class='material-icons md-48 fontFolder'>folder</i><p class='lista' onclick="."cambiarDir("."'$total'".")".">$folders</p>";
                        }
                    } else {
                        
                    }
                }
            }
            $direc->close();
        }
    }
?>
<?php
    require_once '../php/session.php';
    $obj = new sesion();

    class genPag {
        
        private $permisos;
        private $card;
        private $cardUsu;
        private $cardPro;
        private $cardLeft;
        private $cardRight;

        public function __construct($permisos) {
            $this->permisos = $permisos;
            $this->cardLeft = "<div id='cardLeft'>
                                    <i class='material-icons fontUser'>assignment_ind</i>
                                    <p id='subTitulo'>Gestión de usuarios</p>
                                    <input type='button' onclick='pagRedirec(1)' value='Nuevo usuario' id='newUser'><br>
                                    <input type='button' onclick='pagRedirec(2)' value='Editar usuario' id='editUser'>
                                </div>";
            $this->cardRight = "<div id='cardRight'>
                                    <i class='material-icons fontUser'>assignment</i>
                                    <p id='subTitulo'>Gestión de proyectos</p>
                                    <input type='button' onclick='pagRedirec(3)' value='Nuevo proyecto' id='newPro'><br>
                                    <!--<input type='button' value='Editar usuario' id='editUser'><br>-->
                                    <input type='button' onclick='pagRedirec(0)' value='Buscar usuario' id='busPro'>
                                </div>";
            $this->card = "<div id='card'>
                                <i class='material-icons md-48' id='fontAssig'>assignment</i>
                                <p id='subTitulo'>Gestión de proyectos</p>
                                <input type='button' onclick='pagRedirec(0)' value='Buscar proyecto' id='busProOnly'>
                            </div>";
        }

        public function relPagi() {
            $permiso = $this->permisos;
            if(isset($permiso)) {
                if(count($permiso) == 1) {
                    echo $permiso[0]["idPermiso"];
                    /*switch($permiso[0]["idPermiso"]) {
                        case 1: 
                        break;
                    }*/
                    return $this->card;
                }
            } 

        }
    }
?>
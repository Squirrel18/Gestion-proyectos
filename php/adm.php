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
        private $cardRightFind;
        private $cardLeftPro;

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
                                    <input type='button' onclick='pagRedirec(0)' value='Buscar proyecto' id='busPro'>
                                </div>";
            $this->card = "<div id='card'>
                                <i class='material-icons md-48' id='fontAssig'>assignment</i>
                                <p id='subTitulo'>Gestión de proyectos</p>
                                <input type='button' onclick='pagRedirec(0)' value='Buscar proyecto' id='busProOnly'>
                            </div>";
            $this->cardUsu = "<div id='card'>
                                <i class='material-icons fontUser'>assignment_ind</i>
                                <p id='subTitulo'>Gestión de usuarios</p>
                                <input type='button' onclick='pagRedirec(1)' value='Nuevo usuario' id='newUser'><br>
                                <input type='button' onclick='pagRedirec(2)' value='Editar usuario' id='editUser'>
                            </div>";
            $this->cardPro = "<div id='card'>
                                <i class='material-icons fontUser'>assignment</i>
                                <p id='subTitulo'>Gestión de proyectos</p>
                                <input type='button' onclick='pagRedirec(3)' value='Nuevo proyecto' id='newPro'><br>
                                <!--<input type='button' value='Editar usuario' id='editUser'><br>-->
                                <input type='button' onclick='pagRedirec(0)' value='Buscar proyecto' id='busPro'>
                            </div>";
            $this->cardRightFind = "<div id='cardRight'>
                                        <i class='material-icons md-48' id='fontAssig'>assignment</i>
                                        <p id='subTitulo'>Gestión de proyectos</p>
                                        <input type='button' onclick='pagRedirec(0)' value='Buscar proyecto' id='busProOnly'>
                                    </div>";
            $this->cardLeftPro = "<div id='cardLeft'>
                                    <i class='material-icons fontUser'>assignment</i>
                                    <p id='subTitulo'>Gestión de proyectos</p>
                                    <input type='button' onclick='pagRedirec(3)' value='Nuevo proyecto' id='newPro'><br>
                                    <!--<input type='button' value='Editar usuario' id='editUser'><br>-->
                                    <input type='button' onclick='pagRedirec(0)' value='Buscar proyecto' id='busPro'>
                                </div>";
        }

        public function relPagi() {
            $permiso = $this->permisos;
            $valorReturn;
            if(isset($permiso)) {
                if(count($permiso) == 1) {
                    switch($permiso[0]["idPermiso"]) {
                        case 1:
                            $valorReturn = $this->cardUsu;  
                            break;
                        case 2:
                            $valorReturn = $this->cardPro;
                            break;
                        case 3:
                            $valorReturn = $this->card;
                            break;
                        default:
                            echo "error";
                            break;
                    }
                }

                if(count($permiso) == 2) {
                    if($permiso[0]["idPermiso"] == 1 && $permiso[1]["idPermiso"] == 2) {
                        $valorReturn = $this->cardLeft.$this->cardRight;
                    }

                    if($permiso[0]["idPermiso"] == 1 && $permiso[1]["idPermiso"] == 3) {
                        $valorReturn = $this->cardLeft.$this->cardRightFind;
                    }

                    if($permiso[0]["idPermiso"] == 2 && $permiso[1]["idPermiso"] == 3) {
                        $valorReturn = $this->cardPro;
                    }
                }

                if(count($permiso) == 3) {
                    $valorReturn = $this->cardLeft.$this->cardRight;
                }

                return $valorReturn;
            } 

        }
    }
?>
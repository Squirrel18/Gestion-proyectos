<?php
    require_once 'php/session.php';
    $obj = new sesion();
    //print_r($obj->getPer());
    session_unset();
    session_destroy();
    //print_r($obj->getPer());
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <script src="js/jquery-2.2.1.min.js" type="text/javascript"></script>
        <script src="js/javaMakeError.js" type="text/javascript"></script>
        <script src="js/javaS.js" type="text/javascript"></script>
        <link rel="stylesheet" href="fonts/stylesheet.css">
        <link rel="stylesheet" href="css/general.css">
        <link rel="stylesheet" href="css/estilos.css">
    </head>
    <body>
        <p id="titulo">Gestión de proyectos</p>
        <div id="card">
            <i class="material-icons md-48" id="fontAccountForm">account_circle</i>
            <form id="signIn" action="php/validUser.php" method="POST" onsubmit="return validar()">
                <p id="pUsuario">Usuario</p>
                <input type="text" id="usuario" name="user" maxlength="25" required onfocusout="validUser(this.value)" oninput="eliminarError('card')" onfocus="eliminarError()">
                <input type="password" id="contrasena" name="key" maxlength="15" oninput="eliminarError('card')" onfocus="eliminarError('card')">
                <p id="pContrasena">Contraseña</p>
                <input type="submit" id="bIngresa" value="Ingresar">
            </form>
        </div>
    </body>
</html>
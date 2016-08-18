<?php

?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <script src="js/jquery-2.2.1.min.js" type="text/javascript"></script>
        <script src="js/javaS.js" type="text/javascript"></script>
        <link rel="stylesheet" href="fonts/stylesheet.css">
        <link rel="stylesheet" href="css/general.css">
        <link rel="stylesheet" href="css/estilos.css">
    </head>
    <body>
        <p id="titulo">Gestión de proyectos</p>
        <div id="card">
            <i class="material-icons md-48" id="fontAccountForm">account_circle</i>
            <form id="signIn" action="php/validUser.php" method="POST">
                <p id="pUsuario">Usuario</p>
                <input type="text" id="usuario" name="user" maxlength="25" required onfocusout="validUser(this.value)" oninput="eliminarError()" onfocus="eliminarError()">
                <input type="password" id="contrasena" name="key" maxlength="15" oninput="eliminarError()" onfocus="eliminarError()">
                <p id="pContrasena">Contraseña</p>
                <input type="submit" id="bIngresa" value="Ingresar">
            </form>
            <svg id="check">
                <path id="rutaCheck" d="M8 30 L20 40 L45 3" stroke-width="5" stroke="green" fill="none" stroke-dasharray="70" stroke-dashoffset="70" stroke-linecap="square" stroke-linejoin="round"/>
                Sorry, your browser does not support inline SVG.
            </svg>
            <svg id="noCheck">
                <path id="rutaCheckX" d="M5 5 L40 40" stroke-width="5" stroke="#B71C1C" fill="none" stroke-dasharray="50" stroke-dashoffset="50" stroke-linecap="square" stroke-linejoin="round"/>
                <path id="rutaCheckX2" d="M40 5 L5 40" stroke-width="5" stroke="#B71C1C" fill="none" stroke-dasharray="50" stroke-dashoffset="50" stroke-linecap="square" stroke-linejoin="round"/>
                Sorry, your browser does not support inline SVG.
            </svg>
        </div>
    </body>
</html>
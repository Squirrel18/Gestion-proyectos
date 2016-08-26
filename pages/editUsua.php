<?php
    require_once '../php/session.php';
    $obj = new sesion();

    if(!$obj->getSession()) {
        //echo "usuario desconocido";
        header('Location: ../');
    } else {
        $nombre = obtenNamePag($_SERVER['PHP_SELF']);
        $obj->pagPermitida($nombre);
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <script src="../js/jquery-2.2.1.min.js" type="text/javascript"></script>
        <script src="../js/javaData.js" type="text/javascript"></script>
        <script src="../js/javaMakeError.js" type="text/javascript"></script>
        <script src="../js/javaMakeDialog.js" type="text/javascript"></script>
        <script src="../js/javaEditU.js" type="text/javascript"></script>
        <link rel="stylesheet" href="../fonts/stylesheet.css">
        <link rel="stylesheet" href="../css/general.css">
        <link rel="stylesheet" href="../css/editUsua.css">
    </head>
    <body>
        <div id="account">
            <i class="material-icons md-48" id="fontAccount">account_circle</i>
            <p id="textUser">Nombre de usuario</p>
            <p id="textRol">Sistemas</p>
        </div>
        <div id="card">
            <i class="material-icons md-48" id="fontEdit">create</i>
            <p id="subTitulo">Editar usuario</p>
            <form id="formularioEdit" onsubmit="return validar()" method="POST" action="../php/editUser.php">
                <input type="text" name="nombre" id="nombre" maxlength="45" placeholder="Nombre" required autocomplete="off">
                <input type="text" name="pass" id="contrasena" maxlength="25" placeholder="Contraseña" required autocomplete="off">
                <input id="lista" list="Rol" name="rol" placeholder="Rol" required autocomplete="off">
                <datalist id="Rol"></datalist>
                <p id="textPermiso">Permisos</p>
                <div id="permisos"></div>
                <input id="submitNUser" type="submit" value="Listo">
            </form>
            <input type="button" id="elimUser" value="Eliminar usuario" onclick="elimUser()">
        </div>
        <img id="logo" src="../assets/logo.png">
        <p id="texto"></p>
    </body>
</html>
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
        <script src="../js/javaNewU.js" type="text/javascript"></script>
        <link rel="stylesheet" href="../fonts/stylesheet.css">
        <link rel="stylesheet" href="../css/general.css">
        <link rel="stylesheet" href="../css/nuevUsua.css">
    </head>
    <body>
        <div id="account">
            <i class="material-icons md-48" id="fontAccount">account_circle</i>
            <p id="textUser">Nombre de usuario</p>
            <p id="textRol">Sistemas</p>
        </div>
        <div id="card">
            <i class="material-icons md-48" id="fontNewFolder">person_add</i>
            <p id="subTitulo">Nuevo usuario</p>
            <form id="formNewUser" action="../php/newUser.php" onsubmit="return validForm()" method="POST" accept-charset="UTF-8">
                <input id="nombre" name="nombre" type="text" maxlength="45" placeholder="Nombre" required autocomplete="off">
                <input id="numero" name="numero" type="number" placeholder="Identificación" required>
                <input id="contrasena" name="pass" type="text" maxlength="25" placeholder="Contraseña" required autocomplete="off">
                <input id="lista" list="Rol" name="rol" placeholder="Rol" autocomplete="off">
                <datalist id="Rol"></datalist>
                <p id="textPermiso">Permisos</p>
                <div id="permisos"></div>
                <input id="submitNUser" type="submit" value="Listo">
            </form>
        </div>
        <img id="logo" src="../assets/logo.png">
        <p id="texto"></p>
    </body>
</html>
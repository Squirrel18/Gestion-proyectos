<?php
    session_start();
    /*echo $_SESSION["favcolor"]."</br>";
    echo $_SESSION["favanimal"];*/
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <script src="../js/jquery-2.2.1.min.js" type="text/javascript"></script>
        <script src="../js/javaMakeError.js" type="text/javascript"></script>
        <script src="../js/javaEditU.js" type="text/javascript"></script>
        <link rel="stylesheet" href="../fonts/stylesheet.css">
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
            <p id="textEdit">Editar usuario</p>
            <form id="formularioEdit" onsubmit="return validar()" method="POST" action="../php/editUser.php">
                <input type="text" name="nombre" id="nombre" placeholder="Nombre" required autocomplete="off">
                <input type="text" name="pass" id="contrasena" placeholder="Contraseña" required autocomplete="off">
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
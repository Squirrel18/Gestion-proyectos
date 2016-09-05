<?php
    /*require_once '../php/session.php';
    $obj = new sesion();

    if(!$obj->getSession()) {
        //echo "usuario desconocido";
        header('Location: ../');
    } else {
        $nombre = obtenNamePag($_SERVER['PHP_SELF']);
        $obj->pagPermitida($nombre);
    }*/
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <script src="../js/jquery-2.2.1.min.js" type="text/javascript"></script>
        <script src="../js/javaData.js" type="text/javascript"></script>
        <script src="../js/javaMakeError.js" type="text/javascript"></script>
        <script src="../js/javaMakeDialog.js" type="text/javascript"></script>
        <script src="../js/javaInput.js" type="text/javascript"></script>
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
        <i class="material-icons md-36" id="menu">menu</i>
        <nav id="menuNav">
            <section id="headerMenu"></section>
            <section>otra sección</section>
        </nav>
        <div id="card">
            <i class="material-icons md-48" id="fontNewFolder">person_add</i>
            <p id="subTitulo">Nuevo usuario</p>
            <form id="formNewUser" action="../php/newUser.php" onsubmit="return validForm()" method="POST">
                <section class="contInput">
                    <input type="text" name="nombre" maxlength="45" required autocomplete="off" class="fieldInput">
                    <label class="fieldTextL">Nombre<sup>*</sup></label>
                </section>
                <section class="contInput">
                    <input type="number" name="numero" maxlength="45" required class="fieldInput">
                    <label class="fieldTextL">Identificación<sup>*</sup></label>
                </section>
                <section class="contInput">
                    <input type="text" name="pass" maxlength="25" required autocomplete="off" class="fieldInput">
                    <label class="fieldTextL">Contraseña<sup>*</sup></label>
                </section>
                <section class="contInput">
                    <input id="lista" list="Rol" name="rol" required autocomplete="off" class="fieldInput dataListClass">
                    <label class="fieldTextL">Rol<sup>*</sup></label>
                </section>
                <!--<input id="nombre" name="nombre" type="text" maxlength="45" placeholder="Nombre" required autocomplete="off">
                <input id="numero" name="numero" type="number" placeholder="Identificación" required>
                <input id="contrasena" name="pass" type="text" maxlength="25" placeholder="Contraseña" required autocomplete="off">
                <input id="lista" list="Rol" name="rol" placeholder="Rol" autocomplete="off">-->
                <datalist id="Rol"></datalist>
                <p id="textPermiso">Permisos<sup>*</sup></p>
                <div id="permisos"></div>
                <input id="submitNUser" type="submit" value="Listo">
            </form>
        </div>
        <img id="logo" src="../assets/logo.png">
        <p id="texto"></p>
    </body>
</html>
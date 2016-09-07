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
        <script src="../js/menu.js" type="text/javascript"></script>
        <script src="../js/javaFindU.js" type="text/javascript"></script>
        <link rel="stylesheet" href="../fonts/stylesheet.css">
        <link rel="stylesheet" href="../css/general.css">
        <link rel="stylesheet" href="../css/buscarUsua.css">
    </head>
    <body>
        <div id="account">
            <i class="material-icons md-48" id="fontAccount">account_circle</i>
            <p id="textUser">Nombre de usuario</p>
            <p id="textRol">Sistemas</p>
        </div>
        <i class="material-icons md-48" id="menu" onclick="openMenu(this)">menu</i>
        <nav id="menuNav">
            <section id="headerMenu"></section>
            <section>
                <ul>
                    <li style="font-size: 24px;">Administrar usuarios</li>
                    <a href="nuevUsua.php">Crear usuario</a><br>
                    <a href="buscarUsua.php">Editar usuario</a>
                    <li style="font-size: 24px;">Administrar proyectos</li>
                    <a href="nuevProye.php">Nuevo proyecto</a><br>
                    <a href="buscarPro.php">Buscar proyecto</a>
                <ul>
            </section>
        </nav>
        <div id="card">
            <i class="material-icons md-48" id="fontFind">search</i>
            <p id="subTitulo">Buscar usuario</p>
            <input type="search" id="buscar" placeholder="Buscar usuario" oninput="busUsuario()">
            <div id="contenCoin"></div>
        </div>
        <img id="logo" src="../assets/logo.png">
        <p id="texto"></p>
    </body>
</html>
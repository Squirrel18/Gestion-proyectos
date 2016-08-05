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
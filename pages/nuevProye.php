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
        <script src="../js/javaNewP.js" type="text/javascript"></script>
        <link rel="stylesheet" href="../fonts/stylesheet.css">
        <link rel="stylesheet" href="../css/nuevProye.css">
    </head>
    <body>
        <i class="material-icons md-48" id="fontAccount">account_circle</i>
        <p id="textUser">Nombre de usuario</p>
        <p id="textRol">Sistemas</p>
        <div id="card">
            <i class="material-icons md-48" id="fontNewFolder">create_new_folder</i>
            <p id="textNewP">Nuevo proyecto</p>
            <form id="formularioEdit" onsubmit="return validar()" method="POST" action="../php/editUser.php">
                <input id="nomProyec" type="text" placeholder="Nombre del proyecto">
                <p id="textDescri">Descripción</p>
                <input id="numProyec" type="text" placeholder="Número solicitud">
                <textarea id="textDesc"></textarea>
            </form>
        </div>
        <img id="logo" src="../assets/logo.png">
        <p id="texto"></p>
    </body>
</html>
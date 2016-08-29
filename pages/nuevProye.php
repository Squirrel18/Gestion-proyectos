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
        <script src="../js/javaNewP.js" type="text/javascript"></script>
        <link rel="stylesheet" href="../fonts/stylesheet.css">
        <link rel="stylesheet" href="../css/general.css">
        <link rel="stylesheet" href="../css/nuevProye.css">
    </head>
    <body>
        <div id="account">
            <i class="material-icons md-48" id="fontAccount">account_circle</i>
            <p id="textUser">Nombre de usuario</p>
            <p id="textRol">Sistemas</p>
        </div>
        <div id="card">
            <i class="material-icons md-48" id="fontNewFolder">create_new_folder</i>
            <p id="subTitulo">Nuevo proyecto</p>
            <form id="formNewPro" onsubmit="return validNProy()" method="POST" action="../php/newPro.php">
                <input id="nomProyec" type="text" name="nombre" maxlength="50" placeholder="Nombre del proyecto" required autocomplete="off">
                <input id="numProyec" type="text" name="numero" maxLength="10" placeholder="Número solicitud" required autocomplete="off">
                <p id="textDescri">Descripción</p>
                <textarea id="textDesc" maxlength="200" name="descripcion" placeholder="Descripción del proyecto, máximo 200 carácteres."></textarea>
                <p id="textCarpetas">Carpetas</p>
                <div id="carpetas"></div>
                <input id="submitNProy" type="submit" value="Listo">
            </form>
        </div>
        <img id="logo" src="../assets/logo.png">
        <p id="texto"></p>
    </body>
</html>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <script src="../js/jquery-2.2.1.min.js" type="text/javascript"></script>
        <script src="../js/javaMakeError.js" type="text/javascript"></script>
        <script src="../js/javaFindP.js" type="text/javascript"></script>
        <link rel="stylesheet" href="../fonts/stylesheet.css">
        <link rel="stylesheet" href="../css/buscarPro.css">
    </head>
    <body>
        <div id="account">
            <i class="material-icons md-48" id="fontAccount">account_circle</i>
            <p id="textUser">Nombre de usuario</p>
            <p id="textRol">Sistemas</p>
        </div>
        <div id="card">
            <i class="material-icons md-48" id="fontFindP">search</i>
            <p id="textFindP">Buscar proyecto</p>
            <input type="search" id="buscar" oninput="ejecutar()" placeholder="Buscar">
            <div id="cargar"><div id="despla"></div></div>
            <div id="contenedor"></div>
        </div>
    </body>
</html>
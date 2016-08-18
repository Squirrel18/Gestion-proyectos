<?php
    require_once '../php/session.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <script src="../js/jquery-2.2.1.min.js" type="text/javascript"></script>
        <script src="../js/javaData.js" type="text/javascript"></script>
        <script src="../js/javaMakeError.js" type="text/javascript"></script>
        <script src="../js/javaFindP.js" type="text/javascript"></script>
        <link rel="stylesheet" href="../fonts/stylesheet.css">
        <link rel="stylesheet" href="../css/general.css">
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
            <section id="contRuta"></section>
            <div id="cargar"><div id="despla"></div></div>
            <div id="contenedor"></div>
            <div id="contDer">
                <div id="cargaArchivos" class="cargaArchivos" ondragleave="dragLeave(event)" ondrop="dropFile(event)" ondragover="dragOver(event)">Arrastre los archivos aquí.</div>
                <form method="POST" id="formulario" enctype="multipart/form-data">
                    <input type="file" id="fileElem" multiple name="archivo[]" onchange="selArchivos(this.files)">
                    <label for="fileElem" id="labelArch"><p>Archivos</p></label>
                    <input type="hidden" name="path" id="pathCont">
                    <input type="button" id="botonCargar" onclick="cargarArch()" value="Cargar">
                </form>
                <div id="infoArchivos"></div>
                <input id="nuevaCBut" type="button" onclick="makeDialog()" value="Nueva carpeta">
            </div>
        </div>
    </body>
</html>
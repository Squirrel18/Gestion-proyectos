<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <script src="../js/jquery-2.2.1.min.js" type="text/javascript"></script>
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
            <i class="material-icons md-48" id="atras">arrow_back</i>
            <p id="textFindP">Buscar proyecto</p>
            <input type="search" id="buscar" oninput="ejecutar()" placeholder="Buscar">
            <section id="contRuta"></section>
            <div id="cargar"><div id="despla"></div></div>
            <div id="contenedor"></div>
            <div id="contDer">
                <div id="cargaArchivos" ondragleave="dragLeave(event)" ondrop="dropFile(event)" ondragover="dragOver(event)"><p>Arrastre los archivos aquí.</p></div>
                <form method="POST" id="formulario" enctype="multipart/form-data">
                    <input type="file" id="fileElem" multiple name="archivo[]" onchange="selArchivos(this.files)">
                    <label for="fileElem"><p>Archivos</p></label>
                    <input type="button" id="botonCargar" onclick="cargarArch()" value="Cargar">
                </form>
                <div id="infoArchivos"></div>
                <input id="nuevaCBut" type="button" value="Nueva carpeta">
                <input id="elimCBut" type="button" value="Eliminar carpeta">
            </div>
        </div>
    </body>
</html>
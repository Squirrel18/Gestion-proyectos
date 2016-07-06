<?php
    session_start();
    echo $_SESSION["favcolor"]."</br>";
    echo $_SESSION["favanimal"];
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <script src="../js/jquery-2.2.1.min.js" type="text/javascript"></script>
        <link rel="stylesheet" href="../fonts/stylesheet.css">
        <link rel="stylesheet" href="../css/nuevUsua.css">
    </head>
    <body>
        <i class="material-icons md-48" id="fontAccount">account_circle</i>
        <p id="textUser">Nombre de usuario</p>
        <p id="textRol">Sistemas</p>
        <div id="card">
            <i class="material-icons md-48" id="fontNewFolder">person_add</i>
            <p id="textNewUser">Nuevo usuario</p>
            <form id="formNewUser">
                <input id="nombre" type="text" placeholder="Nombre" required>
                <input id="numero" type="number" placeholder="Identificación" required>
                <input id="contrasena" type="text" placeholder="Contraseña" required>
                <input id="lista" list="Rol" name="rol" placeholder="Rol" required>
                <datalist id="Rol">
                    <option value="Administrador">
                    <option value="Desarrollo">
                    <option value="Diseño">
                    <option value="Medico">
                </datalist>
                <p id="textPermiso">Permisos</p>
                <input class="permBox" name="uno" type="checkbox" value="1">
                <input class="permBox" name="dos" type="checkbox" value="2">
                <input class="permBox" name="tres" type="checkbox" value="3">
                <p class="textBox">Gestión de usuarios</p>
                <p class="textBox">Gestión de proyectos</p>
                <p class="textBox">Buscar proyectos</p>
                <input id="submitNUser" type="submit" value="Listo">
            </form>
        </div>
        <img id="logo" src="../assets/logo.png">
        <p id="texto"></p>
    </body>
    <script>
        $.ajax({
            method: "POST",
            url: "../php/permisos.php",
            dataType: "text", 
            success: function(datos) {
                //alert(datos);
                document.getElementById("texto").innerHTML = datos;
            }
        });
    </script>
</html>
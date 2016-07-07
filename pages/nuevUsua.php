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
                <datalist id="Rol"></datalist>
                <p id="textPermiso">Permisos</p>
                <div id="permisos"></div>
                <input id="submitNUser" type="submit" value="Listo">
            </form>
        </div>
        <img id="logo" src="../assets/logo.png">
        <p id="texto"></p>
    </body>
    <script>
        $.ajax({
            url: "../php/permisos.php",
            contentType: "application/json; charset=utf-8",
		    dataType: "json",
            success: function(datos) {
                genPermisos(datos);
            }
        });

        $.ajax({
            url: "../php/rol.php",
            contentType: "application/json; charset=utf-8",
		    dataType: "json",
            success: function(datos) {
                genRol(datos);
            }
        });

        function genPermisos(dato) {
            var contenPer = document.getElementById("permisos");
            for(var i = 0; i < dato.length; i++) {
                var input = document.createElement("input");
                var span = document.createElement("span");
                span.classList.add("textBox");
                span.innerText = dato[i].nombre;
                input.type = "checkbox";
                input.classList.add("permBox");
                input.name = dato[i].nameCheck;
                input.value = dato[i].id;
                contenPer.appendChild(input);
                contenPer.appendChild(span);
            }
        }

        function genRol(dato) {
            var contenData = document.getElementById("Rol");
            for(var i = 0; i < dato.length; i++) {
                var option = document.createElement("option");
                option.value = dato[i].rol;
                contenData.appendChild(option);
            }
        }
    </script>
</html>
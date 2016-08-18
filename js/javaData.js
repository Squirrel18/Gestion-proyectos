$(document).ready(function(){ 
    var parametro = {requiredD: 1};
    $.ajax({
        method: "POST",
        url: "../php/session.php",
        data: parametro,
        dataType: "json", 
        success: function(datos) {
            if(document.getElementById("textUser") && document.getElementById("textRol")) {
                document.getElementById("textUser").innerText = datos[0].nombre;
                document.getElementById("textRol").innerText = datos[0].rol;
            }
        }
    });
});
$(document).ready(function() {
    lectorUrl();
});

function validUser(dato) {
    var parametros = {usuario: dato};
    var patt = /[a-z]/gi;
    var patt1 = /\s/gi;

    if(dato == "") {
        coverDisabled(true);
        habilitaCam(true);
        document.getElementById("contrasena").value = "";
    } else if(patt.test(dato) || patt1.test(dato)) {
        coverDisabled(true);
        habilitaCam(true);
        crearError("Únicamente números", "error", "card");
        document.getElementById("contrasena").value = "";
    } else {
        $.ajax({
            method: "POST",
            url: "php/existUser.php",
            data: parametros,
            dataType: "text", 
            success: function(datos) {
                if(datos === "true") {
                    coverDisabled(false);
                    habilitaCam(false);
                } else {
                    document.getElementById("contrasena").value = "";
                    coverDisabled(true);
                    habilitaCam(true);
                    crearError("Usuario incorrecto", "error", "card");
                }
            }
        });
    }
}

function validar() {
    var pass = document.getElementById("contrasena");
    if(pass.value == "") {
        crearError("Campo vacío", "error1", "card");
        return false;
    } else {
        return true;
    }
}

function lectorUrl() {
    var url = document.URL;
    var index = url.indexOf("?");
    var datoUrl = url.substring(index + 1, url.length);
    var div = datoUrl.split("=");
    if(div[0] == "msj") {
        var dato = parseInt(div[1]);
        switch(dato) {
            case 0:
                crearError("Contraseña incorrecta", "error1", "card");
                break;
            default:
                window.location.assign("index.php");
                break;
        }
    } else {
        //window.location.assign("index.php?" + div[0]);
    }
    
}
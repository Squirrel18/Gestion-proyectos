$(document).ready(function() {
    setTimeout(function() {
        habilitaCam(true);
        coverDisabled(true);
    }, 50);
    lectorUrl();
});

function validUser(dato) {
    var parametros = {usuario: dato};
    var patt = /[a-z]/gi;
    var patt1 = /\s/gi;

    if(dato == "") {
        animSvg(70, 50, 50);
        coverDisabled(true);
        habilitaCam(true);
        document.getElementById("contrasena").value = "";
    } else if(patt.test(dato) || patt1.test(dato)) {
        animSvg(70, 0, 0);
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
                    animSvg(0, 50, 50);
                    coverDisabled(false);
                    habilitaCam(false);
                } else {
                    document.getElementById("contrasena").value = "";
                    animSvg(70, 0, 0);
                    coverDisabled(true);
                    habilitaCam(true);
                    crearError("Usuario incorrecto", "error", "card");
                }
            }
        });
    }
}

function habilitaCam(dato) {
    var comprueba;
    comprueba = dato;

    if(comprueba) {
        document.getElementById("contrasena").disabled = true;
        document.getElementById("bIngresa").disabled = true;
    } else {
        document.getElementById("contrasena").disabled = false;
        document.getElementById("bIngresa").disabled = false;
    }
}

function coverDisabled(dato) {
    if(!document.getElementById("divDisabled")) {
        var comprueba = dato;
        var p = document.createElement("div");
        p.id = "divDisabled";
        document.getElementById("card").appendChild(p);
    }
    
    if(dato) {
        document.getElementById("divDisabled").style.display = "block";
    } else {
        document.getElementById("divDisabled").style.display = "none";
    }
}

function animSvg(path1, path2, path3) {
    var ruta = document.getElementById("rutaCheck");
    var ruta1 = document.getElementById("rutaCheckX");
    var ruta2 = document.getElementById("rutaCheckX2");
    ruta.style.strokeDashoffset = path1;//70
    ruta1.style.strokeDashoffset = path2;//50
    ruta2.style.strokeDashoffset = path3;//50
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
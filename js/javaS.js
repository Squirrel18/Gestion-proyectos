$(document).ready(function() {
    habilitaCam(true);
    coverDisabled(true);
});

var validaUser = false;

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
        crearError("Únicamente números", "error");
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
                    validaUser = true;
                    return validaUser;
                } else {
                    document.getElementById("contrasena").value = "";
                    animSvg(70, 0, 0);
                    coverDisabled(true);
                    habilitaCam(true);
                    crearError("Usuario incorrecto", "error");
                }
            }
        });
    }
}

function validaSesion() {
    eliminarError();
    var value = document.getElementById("contrasena").value;
    if(validaUser === true) {
        if(value == "") {
            crearError("Campo vacío", "error1");
        } else {
            var valueUser = document.getElementById("usuario").value;
            var parametros = {pass: value, user: valueUser};
            $.ajax({
                method: "POST",
                url: "php/validaUser.php",
                data: parametros,
                dataType: "text", 
                success: function(datos) {
                    if(datos === "true") {
                        alert("datos verdaderos");
                    } else {
                        crearError("Contraseña incorrecta", "error1");
                    }
                }
            });
        }
    }
}

function crearError(texto, nomClase) {
     /*
    Los parametros deben ser el texto y el nombre de la clase con los valores de width, height, padding, posición y el color.
    */ 
    var p = document.createElement("p");
    p.id = "textoError";
    p.classList = nomClase;
    p.innerText = texto;
    document.getElementById("card").appendChild(p);
}

function eliminarError() {
    if(document.getElementById("textoError")) {
        document.getElementById("card").removeChild(document.getElementById("textoError"));
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
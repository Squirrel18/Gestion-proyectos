$(document).ready(function() {
    var botonSub = document.getElementById("bIngresa");
    botonSub.style.opacity = "0.26";
    botonSub.id = "temp_idButton";
});

function validUser(dato) {
    var parametros = {usuario:dato};
    var ruta = document.getElementById("rutaCheck");
    var ruta1 = document.getElementById("rutaCheckX");
    var ruta2 = document.getElementById("rutaCheckX2");
    var botonSub = document.getElementById("temp_idButton");
    var patt = /[a-z]/gi;
    var patt1 = /\s/gi;

    if(dato == "") {
        ruta.style.strokeDashoffset = "70";
        ruta1.style.strokeDashoffset = "50";
        ruta2.style.strokeDashoffset = "50";
        botonSub.style.opacity = "0.26";
        botonSub.id = "temp_idButton";
    } else if(patt.test(dato) || patt1.test(dato)) {
        //alert("El campo no puede contener letras o espacios en blanco");
        ruta1.style.strokeDashoffset = "0";
        ruta2.style.strokeDashoffset = "0";
        ruta.style.strokeDashoffset = "70";
        botonSub.style.opacity = "0.26";
        botonSub.id = "temp_idButton";
        crearError();
    } else {
        var botonSub = document.getElementById("temp_idButton");
        $.ajax({
            method: "POST",
            url: "php/existUser.php",
            data: parametros,
            dataType: "text", 
            success: function(datos) {
                if(datos === "true") {
                    //alert("el usuario es verdadero");
                    ruta.style.strokeDashoffset = "0";
                    ruta1.style.strokeDashoffset = "50";
                    ruta2.style.strokeDashoffset = "50";
                    botonSub.style.opacity = "1";
                    botonSub.id = "bIngresa";
                } else {
                    ruta1.style.strokeDashoffset = "0";
                    ruta2.style.strokeDashoffset = "0";
                    ruta.style.strokeDashoffset = "70";
                    botonSub.style.opacity = "0.26";
                    botonSub.id = "temp_idButton";
                    //alert("el usuario es falso");
                }
            }
        });
    }
}

function crearError() {
    var p = document.createElement("p");
    p.id = "textoError";
    p.innerText = "Ocurrio un error";
    document.getElementById("card").appendChild(p);
}
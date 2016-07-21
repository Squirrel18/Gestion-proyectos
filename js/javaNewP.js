$(document).ready(function() {
    $.ajax({
        url: "../php/folder.php",
        contentType: "application/json; charset=utf-8",
        dataType: "json",
        success: function(datos) {
            genCarpetas(datos);
        }
    });
});

function genCarpetas(dato) {
    for(var i = 0; i < dato.length; i++) {
        var input = document.createElement("input");
        var span = document.createElement("span");
        span.classList.add("textBox");
        span.innerText = dato[i].carpeta;
        input.type = "checkbox";
        input.onclick = function() {
            if(document.getElementById("textoError")) {
                document.getElementById('card').removeChild(document.getElementById("textoError"));
            }
        }
        input.classList.add("carpBox");
        input.name = dato[i].id;
        input.value = dato[i].carpeta;
        document.getElementById("carpetas").appendChild(input);
        document.getElementById("carpetas").appendChild(span);
    }
}

var patt = /[a-z]/i;
var patt1 = /\s/;
var patt2 = /[0-9]/;
var patt3 = /[`~!@#$%^&*()_°¬|+\-=?;:'",.<>\{\}\[\]\\\/]/gi;

function validNProy() {
    var nombre = document.getElementById("nomProyec");
    nombre.addEventListener("focus", function() {
        nombre.style.borderColor= "#09556C";
        eliminarError("card");
    });
    var numero = document.getElementById("numProyec");
    numero.addEventListener("focus", function() {
        numero.style.borderColor= "#09556C";
        eliminarError("card");
    });
    var descri = document.getElementById("textDesc");
    var contenedor = document.getElementById("carpetas").children;


    if(patt3.test(nombre.value)) {
        crearError("Sin caracteres especiales", "errorNombre", "card");
        nombre.style.borderColor = "#B71C1C";
        return false;
    }

    if(patt1.test(numero.value) || patt3.test(numero.value)) {
        crearError("Sin caracteres especiales y espacios", "errorNumero", "card");
        numero.style.borderColor = "#B71C1C";
        return false;
    }

    for(var i = 0; i < contenedor.length; i++) {
        if(i % 2 == 0) {
            if(contenedor[i].checked) {
                eliminarError("card");
                comprobCheck = true;
                break;
            } else {
                crearError("Requiere una selección", "errorCheck", "card");
                comprobCheck = false;
            }
        }
    }

    if(comprobCheck) {
        return true;
    } else {
        return false;
    }
}
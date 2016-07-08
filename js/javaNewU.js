$(document).ready(function() {
    $.ajax({
        url: "../php/permit.php",
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

function validForm() {
    var nombre = document.getElementById("nombre");
    nombre.addEventListener("focus", function() {
        nombre.style.borderColor= "#09556C";
        eliminarError("card");
    });
    var numero = document.getElementById("numero");
    var pass = document.getElementById("contrasena");
    pass.addEventListener("focus", function() {
        pass.style.borderColor= "#09556C";
        eliminarError("card");
    });
    var rol = document.getElementById("lista");
    rol.addEventListener("focus", function() {
        rol.style.borderColor= "#09556C";
        eliminarError("card");
    });
    var contenedor = document.getElementById("permisos").childNodes;
    var validaNombre = false;
    var validChecked = false;

    var patt = /[0-9]/g;
    var patt1 = /\s/gi;

    if(patt.test(nombre.value)) {
        nombre.style.borderColor= "#B71C1C";
        crearError("Únicamente letras", "errorNombre", "card");
        return false;
    }

    if(patt1.test(pass.value)) {
        pass.style.borderColor= "#B71C1C";
        crearError("Contiene espacios en blanco", "errorPass", "card");
        return false;
    }

    if(rol.value == "") {
        rol.style.borderColor= "#B71C1C";
        crearError("Campo requerido", "errorRol", "card");
        return false;
    }

    for(var i = 0; i < contenedor.length; i++) {
        if(i % 2 == 0) {
            if(contenedor[i].checked) {
                validChecked = true;
                eliminarError("card");
                break;
            } else {
                if(!document.getElementById("textoError")) {
                    crearError("Requiere una selección", "errorCheck", "card");
                }
                validChecked = false;
            }
        }
    }


    if(validChecked == true) {
        return true;
    } else {
        return false;
    }
    
}
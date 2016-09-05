var contenedorJson = new Array();/*Variable que alamcena los datos de la promesa para ser utilizada a lo largo del documento*/

/*Promesa que retorna los datos del rol para ser verificados antes de que envíe el formulario*/
function promesa() {
    return new Promise(function(exito, error) {
        $.ajax({
            url: "../php/rol.php",
            contentType: "application/json; charset=utf-8",
            dataType: "json",
            success: function(datos) {
                if(datos.length > 0) {
                    exito(datos);
                } else {
                    error("ocurrio un error");
                }
            }
        });
    });
}

/*Promesa ya realizada*/
promesa().then(function(exitoRes) {
    for(var i = 0; i < exitoRes.length; i++) {
        contenedorJson[i] = exitoRes[i].rol;
    }
}, function(errorRes) {
    alert(errorRes);
});

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
    lectorUrl();
});

function genPermisos(dato) {
    var contenPer = document.getElementById("permisos");
    for(var i = 0; i < dato.length; i++) {
        var input = document.createElement("input");
        var span = document.createElement("span");
        span.classList.add("textBox");
        span.innerText = dato[i].nombre;
        input.type = "checkbox";
        input.onclick = function() {
            if(document.getElementById("textoError")) {
                document.getElementById('card').removeChild(document.getElementById("textoError"));
            }
        }
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
    /*Se asigna a la variable fields todos los elementos input existentes*/
    var fields = elementosField();/*Está función elementosField() viene de javaInput.js*/
    var labels = elementosLabels();

    var nombre = fields[0];
    var numero = fields[1];
    var pass = fields[2];
    var rol = fields[3];
    var contenedor = document.getElementById("permisos").childNodes;

    var patt = /[0-9]/g;
    var patt1 = /\s/g;
    var patt3 = /[`~!@#$%^&*()_°¬|+\-=?;:'",.<>\{\}\[\]\\\/]/gi;

    if(patt.test(nombre.value) || patt3.test(nombre.value)) {
        noValido(fields[0], labels);
        crearError("Únicamente letras", "errorNombre", "card");
        return false;
    } else {
        if(patt1.test(pass.value)) {
            noValido(fields[2], labels);
            crearError("Contiene espacios en blanco", "errorPass", "card");
            return false;
        } else {
            if(validaRol(fields[3], labels)) {
                if(validaPermisos(contenedor)) {
                    return true;
                } else {
                    return false;
                }
            } else {
                return false;
            }
        } 
    }
}

function validaRol(campo, labels) {
    var coinciden;
    for(var i = 0; i < contenedorJson.length; i++) {
        var iteraDatos = contenedorJson[i].toString();
        var rol = campo.value;
        iteraDatos = iteraDatos.toLowerCase();
        valor = rol.toLowerCase();
        if(valor == iteraDatos) {
            coinciden = true;
            break;
        } else {
            coinciden = false;
        }
    }
    if(coinciden) {
        eliminarError("card");
        return true;
    } else {
        noValido(campo, labels);
        crearError("Dato no valido", "errorRol", "card");
        return false;
    }
}

function validaPermisos(contenedor) {
    var boxChecked;
    for(var i = 0; i < contenedor.length; i++) {
        if(i % 2 == 0) {
            if(contenedor[i].checked) {
                boxChecked = true;
                break;
            } else {
                boxChecked = false;
            }
        }
    }

    if(boxChecked) {
        eliminarError("card");
        return true;
    } else {
        crearError("Requiere una selección", "errorCheck", "card");
        return false;
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
                createDialog("Nuevo usuario", "El usuario ya existe");
                break;
            case 1:
                createDialog("Nuevo usuario", "No se creo el usuario");
                break;
            case 2:
                createDialog("Nuevo usuario", "No se crearón los permisos");
                break;
            case 3:
                createDialog("Nuevo usuario", "Usuario creado");
                break;
            default:
                window.location.assign("../pages/nuevUsua.php");
                break;
        }
    } else {
        //window.location.assign("index.php?" + div[0]);
    }
}
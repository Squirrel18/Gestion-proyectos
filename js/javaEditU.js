var contenedorJson = new Array();

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
    verificaURL();
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
        input.id = "dato" + dato[i].id;
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

var patt = /[a-z]/i;
var patt1 = /\s/;
var patt2 = /[0-9]/;
var patt3 = /[`~!@#$%^&*()_°¬|+\-=?;:'",.<>\{\}\[\]\\\/]/gi;

function verificaURL() {
    var url = document.URL;
    var index = url.indexOf("?");
    var datoUrl = url.substring(index + 1, url.length);
    var div = datoUrl.split("=");

    if(div[0] === "numero") {
        //alert("Si contiene número");
        if(div[1] == "") {
            alert("URL no valida");
            window.location.assign("../pages/buscarUsua.php");
        } else {
            if(patt.test(div[1]) || patt1.test(div[1])) {
                alert("URL no valida");
                window.location.assign("../pages/buscarUsua.php");
            } else {
                if(patt3.test(div[1])) {
                    alert("URL no valida");
                    window.location.assign("../pages/buscarUsua.php");
                } else {
                    //alert("Contiene número");
                    consulNum(div[1]);
                }
            }
        }
    } else {
        //alert("No contiene número");
    }   
}

function consulNum(dato) {
    var parametros = {usuario: dato};
    $.ajax({
        method: "POST",
        url: "../php/existUser.php",
        data: parametros,
        dataType: "text", 
        success: function(datos) {
            if(datos === "true") {
                traerDatos(dato);
            } else {
                alert("El usuario no existe");
                window.location.assign("../pages/buscarUsua.php");
            }
        }
    });
}

function traerDatos(dato) {
    var parametros = {num: dato};
    $.ajax({
        method: "POST",
        //content type el tipo de dato que se está enviando
        url: "../php/fillData.php",
        //datatype es el tipo de dato que se espera
        dataType: "json",
        data: parametros,
        success: function(datos) {
            if(datos.length > 1) {
                alert("Ocurrio un error");
                window.location.assign("../pages/buscarUsua.php");
            } else {
                traerPermisos(datos);
            }
        }
    });
}

function traerPermisos(dato) {
    var parametrosId = {id: dato[0].id};
    $.ajax({
        method: "POST",
        //content type el tipo de dato que se está enviando
        url: "../php/userPermit.php",
        //datatype es el tipo de dato que se espera
        dataType: "json",
        data: parametrosId,
        success: function(datPermisos) {
            rellenaDatos(dato, datPermisos);
        }
    });
}

function rellenaDatos(datos, permisos) {
    var nombre = document.getElementById("nombre");
    var key = document.getElementById("contrasena");
    var rol = document.getElementById("lista");
    nombre.placeholder = "Nombre: " + datos[0].nombre;
    key.placeholder = "Contraseña: " + datos[0].contrasena;
    rol.placeholder = "Rol: " + datos[0].rol;
    for(var i = 0; i < permisos.length; i++) {
        document.getElementById("dato" + permisos[i].idPermiso).checked = true;
    }
    var numero = document.createElement("input");
    numero.name = "numero";
    numero.type = "text"
    numero.id = "hiddenText";
    numero.value = datos[0].numero;
    numero.style.display = "none";
    document.getElementById("formularioEdit").appendChild(numero);
}

function validar() {

    var comprobCheck;
    var comprobRol;

    var nombre = document.getElementById("nombre");
    nombre.addEventListener("focus", function() {
        nombre.style.borderColor= "#09556C";
        eliminarError("card");
    });
    var key = document.getElementById("contrasena");
    key.addEventListener("focus", function() {
        key.style.borderColor= "#09556C";
        eliminarError("card");
    });
    var rol = document.getElementById("lista");
    rol.addEventListener("focus", function() {
        rol.style.borderColor= "#09556C";
        eliminarError("card");
    });
    var contenedor = document.getElementById("permisos").childNodes;
    console.log(contenedor);

    if(patt2.test(nombre.value) || patt3.test(nombre.value)) {
        crearError("Únicamente carácteres alfabéticos", "errorNombre", "card");
        nombre.style.borderColor = "#B71C1C";
        return false;
    }

    if(patt1.test(key.value) || patt3.test(key.value)) {
        crearError("Sin espacios y carácteres especiales", "errorPass", "card");
        key.style.borderColor = "#B71C1C";
        return false;
    }

    for(var i = 0; i < contenedorJson.length; i++) {
        if(rol.value == contenedorJson[i].toString()) {
            eliminarError("card");
            rol.style.borderColor = "#09556C";
            comprobRol = true;
            break;
        } else {
            crearError("Dato no valido", "errorRol", "card");
            rol.style.borderColor = "#B71C1C";
            comprobRol = false;
        }
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

    if(comprobRol && comprobCheck) {
        return true;
    } else {
        return false;
    }
}

function elimUser() {
    var valor = document.getElementById("hiddenText");
    var parametros = {numero: valor.value};
    $.ajax({
        method: "POST",
        url: "../php/deleteUser.php",
        data: parametros,
        dataType: "text", 
        success: function(datos) {
            if(datos === "true") {
                alert("el usuario se elimino");
            } else {
                alert("ocurrio un problema al eliminar");
            }
        }
    });
}

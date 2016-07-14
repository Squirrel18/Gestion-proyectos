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
    alert(exitoRes);
}, function(errorRes) {
    alert(errorRes);
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
                console.log(datos[0].rol);
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
}

function validar() {
    var comprobacion = false;
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

    if(patt1.test(nombre.value) || patt2.test(nombre.value) || patt3.test(nombre.value)) {
        crearError("Únicamente caracteres alfabéticos", "errorNombre", "card");
        nombre.style.borderColor = "#B71C1C";
        return false;
    }

    if(patt1.test(key.value) || patt3.test(key.value)) {
        crearError("Sin espacios y caracteres especiales", "errorPass", "card");
        key.style.borderColor = "#B71C1C";
        return false;
    }

    /*var prueba = function(callback) {
        $.ajax({
            url: "../php/rol.php",
            contentType: "application/json; charset=utf-8",
            dataType: "json",
            success: function(datos) {
                callback(datos);
            }
        });
    }
    var a;
    prueba(function(datos) {
        return a = datos;
    });
    alert(a);*/

    //console.log(verificaRol());

    /*if(verificaRol()) {
        for(var i = 0; i < contenedor.length; i++) {
            if(i % 2 == 0) {
                if(!contenedor[i].checked) {
                    eliminarError("card");
                    crearError("Requiere una selección", "errorCheck", "card");
                    validChecked = false;
                    break;
                } else {
                    validChecked = true;
                }
            }
        }
    } else {
        rol.style.borderColor = "#B71C1C";
        crearError("Valor no valido", "errorRol", "card");
        return false;
    }

    if(validChecked) {
        return true;
    } else {
        return false;
    }*/

    return false;
}

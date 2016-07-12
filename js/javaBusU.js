var patt = /[a-z]/gi;
var patt1 = /\s/gi;

function busUsuario() {
    var buscar = document.getElementById("buscar");    

    if(patt.test(buscar.value) || patt1.test(buscar.value)) {
        if(!document.getElementById("textoError")) {
            crearError("Únicamente números", "textErrorLetras", "card");
        }

    } else {
        eliminarError("card");
        if(!buscar.value == "") {
            var parametros = {usuario: buscar.value};
            $.ajax({
                method: "POST",
                //content type el tipo de dato que se está enviando
                url: "../php/findUser.php",
                //datatype es el tipo de dato que se espera
                dataType: "json",
                data: parametros,
                success: function(datos) {
                    datosCoinci(datos);
                }
            });
        } else {
            $("#contenCoin").empty();
        }
    }
}

function datosCoinci(dato) {
    var conten = document.getElementById("contenCoin");
    $("#contenCoin").empty();
    
    for(var i = 0; i < dato.length; i++) {
        if(!document.getElementById("lista" + dato[i].id)) {
            var coinci = document.createElement("p");
            coinci.id = "lista" + dato[i].id;
            coinci.classList.add("listaCoin");
            coinci.innerHTML = "<span class='nombre'>" + dato[i].nombre + ".</span> " + dato[i].rol;
            conten.appendChild(coinci);
        }
    }
}


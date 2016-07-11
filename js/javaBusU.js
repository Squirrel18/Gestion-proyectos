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
    for(var i = 0; i < dato.length; i++) {
        var coinci = document.createElement("p");
        coinci.classList.add("listaCoin");
        coinci.innerText = dato[i].nombre;
        conten.appendChild(coinci);
    }
}


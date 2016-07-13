var patt = /[a-z]/i;
var patt1 = /\s/;
var patt2 = /[0-9]/;
var comprobacion;
var caracteres;

function busUsuario() {
    var buscar = document.getElementById("buscar");   
    if(buscar.value == "") {
        eliminarError("card");
        buscar.style.borderColor = "#09556C";
        $("#contenCoin").empty();
    } else if(buscar.value != "") {
        if(patt.test(buscar.value) || patt1.test(buscar.value)) {
            eliminarError("card");
            if(!document.getElementById("textoError")) {
                buscar.style.borderColor = "#B71C1C";
                crearError("Únicamente números", "textErrorLetras", "card");
            }
            $("#contenCoin").empty();
        } else {
	        eliminarError("card");
            buscar.style.borderColor = "#09556C";
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
        }
    }
}

function datosCoinci(dato) {
    var conten = document.getElementById("contenCoin");
    $("#contenCoin").empty();
    if(dato.length == 0) {
        buscar.style.borderColor = "#B71C1C";
        crearError("El usuario no se encuentra", "textErrorLetras", "card");
    } else {
        eliminarError("card");
    }
    for(var i = 0; i < dato.length; i++) {
        if(!document.getElementById("lista" + dato[i].id)) {
            var link = document.createElement("a");
            var coinci = document.createElement("p");
            coinci.classList.add("listaCoin");
            link.classList.add("linkCoinci");
            link.setAttribute("href", "../pages/editUsua.php?numero=" + dato[i].numero);
            link.setAttribute("target", "_blank");
            conten.appendChild(link);
            coinci.innerHTML = "<span class='nombre'>" + dato[i].nombre + ".</span> " + dato[i].rol;
            link.appendChild(coinci);
        }
    }
}


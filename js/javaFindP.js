function ejecutar() {
    var buscar = document.getElementById("buscar");
    var conten = document.getElementById("contenedor");
    var parametros = {datoBus: buscar.value};
    $("#contenedor").empty(); 
    if(!buscar.value == "") {
        $.ajax({
            method: "POST",
            //content type el tipo de dato que se está enviando
            url: "../php/admFolder.php",
            //datatype es el tipo de dato que se espera
            dataType: "html",
            data: parametros,
            success: function(datos) {
                conten.innerHTML = datos;
                //document.body.innerHTML = datos;
            }
        });
    } else {

    }
}

function cambiarDir(dato) {
    $("#contenedor").empty();
    var conten = document.getElementById("contenedor");
    var datoEspacios = dato.replace(/#/g, " ");
    var parametros = {folderId: datoEspacios};
    $.ajax({
        method: "POST",
        //content type el tipo de dato que se está enviando
        url: "../php/admFolder.php",
        //datatype es el tipo de dato que se espera
        dataType: "html",
        data: parametros,
        success: function(datos) {
            conten.innerHTML = datos;
        }
    });
}

function atras(dato) {
    var datoEspacios = dato.replace(/#/g, " ");
    var parametros = {folderParent: datoEspacios};
    $.ajax({
        method: "POST",
        //content type el tipo de dato que se está enviando
        url: "../php/admFolder.php",
        //datatype es el tipo de dato que se espera
        dataType: "html",
        data: parametros,
        success: function(datos) {
            console.log(datos);
        }
    });
}
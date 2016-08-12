function ejecutar() {
    crearAtras();
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
                document.getElementById("atras").style.display = "none";
                document.getElementById("contRuta").innerHTML = datos.substring(0, datos.indexOf("</p>") + 4);
                conten.innerHTML = datos.substring(datos.indexOf("</p>") + 4, datos.length);
                //conten.innerHTML = datos;
            }
        });
    } else {

    }
}

$(document).on({
    ajaxStart: function() { 
        document.getElementById("cargar").style.display = "block";
    },
    ajaxStop: function() {
        document.getElementById("cargar").style.display = "none";
    }    
});

function cambiarDir(dato) {
    $("#contenedor").empty();
    var conten = document.getElementById("contenedor");
    var dato = dato.replace(/#/g, " ");
    var parametros = {folderId: dato};
    $.ajax({
        method: "POST",
        //content type el tipo de dato que se está enviando
        url: "../php/admFolder.php",
        //datatype es el tipo de dato que se espera
        dataType: "html",
        data: parametros,
        success: function(datos) {
            document.getElementById("atras").style.display = "block";
            document.getElementById("contRuta").innerHTML = datos.substring(0, datos.indexOf("</p>") + 4);
            conten.innerHTML = datos.substring(datos.indexOf("</p>") + 4, datos.length);
        }
    });
}

function atras() {

    var conten = document.getElementById("contenedor");
    var dato = document.getElementById("contRuta").children[0].innerText;
    var lastDir = dato.substring(0, dato.lastIndexOf("/"));
    var parametros = {folderId: lastDir};
    $.ajax({
        method: "POST",
        //content type el tipo de dato que se está enviando
        url: "../php/admFolder.php",
        //datatype es el tipo de dato que se espera
        dataType: "html",
        data: parametros,
        success: function(datos) {
            document.getElementById("contRuta").innerHTML = datos.substring(0, datos.indexOf("</p>") + 4);
            conten.innerHTML = datos.substring(datos.indexOf("</p>") + 4, datos.length);
            var dato = document.getElementById("contRuta").children[0].innerText;
            if(dato == "../proyectos") {
                ejecutar();
                document.getElementById("atras").style.display = "none";
                //$("#infoArchivos").empty();
            }
        }
    });
}

function dragOver(event) {
    event.preventDefault();
    event.target.style.background = "rgba(9,85,108,0.20)";
    if(event.target.children[0]) {
        event.target.children[0].innerText = "Soltar archivos";
    }
}

function dropFile(event) {

    event.preventDefault();
    event.target.style.background = "#0F0";
    var inputFile = document.getElementById("fileElem");
    inputFile.files = event.dataTransfer.files;

    var num = 0;
    var info = document.getElementById("infoArchivos");
    $("#infoArchivos").empty();

    if(inputFile.files.length > 0) {
        document.getElementById("botonCargar").style.display = "block";
        for(var i = 0; i < inputFile.files.length; i++) {
            var p = document.createElement("p");
            p.innerHTML = "Nombre: " + inputFile.files[i]["name"] + "<br>Tamaño: " + convertByte(inputFile.files[i]["size"]);
            info.appendChild(p);
            num = num + inputFile.files[i]["size"];
        }

        var total = convertByte(num);
        var p = document.createElement("p");
        p.innerHTML = "Tamaño total: " + total;
        p.className = "totalArch";
        info.appendChild(p);
    } else {

    }
}

function selArchivos(files) {

    var num = 0;
    var info = document.getElementById("infoArchivos");
    $("#infoArchivos").empty();

    if(files.length > 0) {
        document.getElementById("botonCargar").style.display = "block";
        for(var i = 0; i < files.length; i++) {
            var p = document.createElement("p");
            p.innerHTML = "<b>Nombre: </b>" + files[i]["name"] + "<br><b>Tamaño: </b>" + convertByte(files[i]["size"]);
            info.appendChild(p);
            num = num + files[i]["size"];
        }

        var total = convertByte(num);
        var p = document.createElement("p");
        p.innerHTML = "Tamaño total: " + total;
        p.className = "totalArch";
        info.appendChild(p);
    } else {

    }
}

function dragLeave(event) {    
    event.preventDefault();
    event.target.style.background = "#FFF";
    if(event.target.children[0]) {
        event.target.children[0].innerText = "Arrastre los archivos aquí.";
    }
}

function convertByte(bytes) {
    var sizes = ['Bytes', 'KB', 'MB', 'GB', 'TB'];
    if (bytes == 0) {
        return 'NO';
    } 
    var i = parseInt(Math.floor(Math.log(bytes) / Math.log(1024)));
    if (i == 0) {
        return bytes + ' ' + sizes[i];
    } 
    return (bytes / Math.pow(1024, i)).toFixed(1) + ' ' + sizes[i];
}

function cargarArch() {
    //var datoPath = document.getElementById("contRuta").children[0].innerText;
    //document.getElementById("pathCont").value = datoPath;
    if(document.getElementById("contRuta").children[0]) {
        alert(document.getElementById("contRuta").children[0].innerText);
    } else {
        alert("no está");
    }
    var parametros = new FormData(document.getElementById("formulario"));
    console.log(parametros);

    /*$.ajax({
        url: '../admFiles.php',
        type: 'POST',
        contentType: false,
        data: parametros,
        processData: false,
        cache: false,
        success: function(datos) {
            console.log(datos);
        }
    });*/
}

function crearAtras() {
    var card = document.getElementById("card");
    var divAtras = document.createElement("div");
    var arrow = document.createElement("i");
    divAtras.id = "atras";
    divAtras.setAttribute("onclick", "atras()");
    arrow.id = "fontAtras"
    arrow.classList.add("material-icons");
    arrow.classList.add("md-48");
    arrow.innerText = "arrow_back";
    if(!document.getElementById("atras")) {
        card.insertBefore(divAtras, card.children[1]);
        divAtras.appendChild(arrow);
    }
}

function elimAtras() {
    if(document.getElementById("atras")) {
        document.getElementById("card").removeChild(document.getElementById("atras"));
    }
}
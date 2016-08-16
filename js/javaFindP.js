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
                elimAtras();
                document.getElementById("contRuta").innerHTML = datos.substring(0, datos.indexOf("</p>") + 4);
                conten.innerHTML = datos.substring(datos.indexOf("</p>") + 4, datos.length);
                document.getElementById("nuevaCBut").style.display = "none";
                document.getElementById("elimCBut").style.display = "none";
                document.getElementById("labelArch").style.display = "none";
                document.getElementById("botonCargar").style.display = "none";
                document.getElementById("infoArchivos").style.display = "none";
                document.getElementById("cargaArchivos").style.display = "none";
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
            crearAtras();
            document.getElementById("contRuta").innerHTML = datos.substring(0, datos.indexOf("</p>") + 4);
            conten.innerHTML = datos.substring(datos.indexOf("</p>") + 4, datos.length);
            document.getElementById("nuevaCBut").style.display = "block";
            document.getElementById("elimCBut").style.display = "block";
            document.getElementById("labelArch").style.display = "block";
            document.getElementById("cargaArchivos").style.display = "block";
            if(document.getElementById("fileElem").files.length > 0) {
                document.getElementById("botonCargar").style.display = "block";
                document.getElementById("infoArchivos").style.display = "block";
            }
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
                elimAtras();
                document.getElementById("nuevaCBut").style.display = "none";
                document.getElementById("elimCBut").style.display = "none";
                document.getElementById("labelArch").style.display = "none";
                document.getElementById("infoArchivos").style.display = "none";
                document.getElementById("cargaArchivos").style.display = "none";
                //$("#infoArchivos").empty();
            }
        }
    });
}

function dragOver(event) {
    event.preventDefault();
    event.target.style.background = "rgba(9,85,108,0.20)";
    event.target.innerText = "Soltar archivos";
}

function dropFile(event) {
    event.preventDefault();
    event.target.style.background = "#FFF";
    event.target.innerText = "Arrastre los archivos aquí.";
    var inputFile = document.getElementById("fileElem");
    inputFile.files = event.dataTransfer.files;
}

function selArchivos(files) {

    var num = 0;
    var info = document.getElementById("infoArchivos");
    document.getElementById("botonCargar").style.display = "none";
    $("#infoArchivos").empty();

    if(files.length > 0) {
        document.getElementById("botonCargar").style.display = "block";
        document.getElementById("infoArchivos").style.display = "block";
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
        document.getElementById("pathCont").value = document.getElementById("contRuta").children[0].innerText;
        var parametros = new FormData(document.getElementById("formulario"));

        $.ajax({
            url: '../php/admFiles.php',
            type: 'POST',
            contentType: false,
            data: parametros,
            processData: false,
            cache: false,
            success: function(datos) {
                if(datos) {
                    alert("Archivos cargados correctamente");
                } else {
                    alert("Error");
                }
            }
        });

    } else {
        alert("no está");
    }
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
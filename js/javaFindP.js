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
        p.innerHTML = "<b>Tamaño total: </b>" + total;
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
                    crearError("Archivos cargados correctamente.", "textCorrec", "card");
                    setTimeout(function () {
                        eliminarError("card");
                    }, 2000);
                } else {
                    crearError("Ocurrio un error.", "textErrorArc", "card");
                    setTimeout(function () {
                        eliminarError("card");
                    }, 2000);
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

function makeDialog() {
    var conten = document.createElement("section");
    var cover = document.createElement("div");
    var titulo = document.createElement("p");
    var inputNom = document.createElement("input");
    var bCancel = document.createElement("input");
    var bOk = document.createElement("input");

    conten.id = "dialogName";
    cover.id = "cover";

    var elements = [conten, cover, titulo, inputNom, bCancel, bOk];
    var classNames = ['dialog', 'cover', 'tiutloDialog', 'nameCarp', 'btnCan', 'btnOk'];
    for(var i = 0; i < elements.length; i++) {
        elements[i].className = classNames[i];
        switch(i) {
            case 2:
                elements[i].innerText = "Nueva carpeta";
                break;
            case 3:
                elements[i].type = "text";
                elements[i].id = "nameFolder";
                elements[i].placeholder = "Nombre de la carpeta";
                elements[i].setAttribute("maxlength", "40");
                elements[i].setAttribute("oninput", "eliminarError('dialogName')");
                break;
            case 4:
                elements[i].type = "button";
                elements[i].value = "Cancelar";
                elements[i].setAttribute("onclick", "cancelDia()");
                break;
            case 5:
                elements[i].type = "button"; 
                elements[i].value = "Listo";
                elements[i].setAttribute("onclick", "crearCarp()");
                break;
            default:
                break; 
        }
    }

    document.body.appendChild(cover);
    document.getElementById("card").appendChild(conten);
    if(document.getElementById("dialogName")) {
        for(var i = 2; i < elements.length; i++) {
            document.getElementById("dialogName").appendChild(elements[i]);
        }
    }
}

function cancelDia() {
    eliminarError('dialogName');
    document.getElementById("cover").style.animation = "fadeOut 200ms ease-in-out";
    document.getElementById("cover").style.webkitAnimation = "fadeOut 200ms ease-in-out";
    document.getElementById("dialogName").style.animation = "fadeOut 200ms ease-in-out";
    document.getElementById("dialogName").style.webkitAnimation = "fadeOut 200ms ease-in-out";

    document.getElementById("cover").addEventListener("animationEnd", function() {
        document.body.removeChild(document.getElementById("cover"));
    });
    document.getElementById("cover").addEventListener("webkitAnimationEnd", function() {
        document.body.removeChild(document.getElementById("cover"));
    });
    document.getElementById("dialogName").addEventListener("animationEnd", function() {
        document.getElementById("card").removeChild(document.getElementById("dialogName"));
    });
    document.getElementById("dialogName").addEventListener("webkitAnimationEnd", function() {
        document.getElementById("card").removeChild(document.getElementById("dialogName"));
    });
}

function crearCarp() {
    eliminarError('dialogName');
    var patt3 = /[`~!@#$%^&*()°¬|+\=?;:'",.<>\{\}\[\]\\\/]/gi;
    var inputName = document.getElementById("nameFolder");

    if(!inputName.value == "") {
        if(!patt3.test(inputName.value)) {
            if(document.getElementById("contRuta").children[0]) {
                var dato = document.getElementById("contRuta").children[0].innerText;
                var parametros = {pathNewF: dato, nameFolder: inputName.value};
                
                $.ajax({
                    method: "POST",
                    //content type el tipo de dato que se está enviando
                    url: "../php/admFolder.php",
                    //datatype es el tipo de dato que se espera
                    dataType: "text",
                    data: parametros,
                    success: function(datos) {
                        if(datos) {
                            cancelDia();
                            crearError("Carpeta creada correctamente.", "textCorrec", "card");
                            setTimeout(function () {
                                eliminarError("card");
                            }, 3000);
                        } else {
                            crearError("Error al crear carpeta.", "textErrorArc", "card");
                            setTimeout(function () {
                                eliminarError("card");
                            }, 3000);
                        } 
                    }
                });
            }
        } else {
            crearError("Sin carácteres especiales", "textCarac", "dialogName");
        }
    } else {
        crearError("Campo vacío", "textVac", "dialogName");
    }
}
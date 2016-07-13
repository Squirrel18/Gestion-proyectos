function crearError(texto, nomClase, contenedor) {
     /*
    Los parámetros deben ser el texto, el nombre de la clase. y el último es el contenedor el error.
    */
    if(!document.getElementById("textoError")) {
        var p = document.createElement("p");
        p.id = "textoError";
        p.classList = nomClase;
        p.innerText = texto;
        document.getElementById(contenedor).appendChild(p);
    } 
}

function eliminarError(dato) {
    /*
    El parámetro es el que contiene el texto error.
    */
    if(document.getElementById("textoError")) {
        document.getElementById(dato).removeChild(document.getElementById("textoError"));
    }
}
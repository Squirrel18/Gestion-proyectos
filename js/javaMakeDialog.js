function createDialog(titulo, texto) {
    /*El texto ideal es de máximo 28 carácteres*/
    var dialog = document.createElement("section");
    var cover = document.createElement("div");
    var title = document.createElement("p");
    var text = document.createElement("p");
    var btn = document.createElement("input");
    var id = ["dialogo", "cover", "tituloDialog", "textInfo", "btnListo"];
    var elementos = [dialog, cover, title, text, btn];

    for(var i = 0; i < elementos.length; i++) {
        elementos[i].id = id[i];
        switch(i) {
            case 0:
                break;
            case 1:
                elementos[i].setAttribute("onclick", "cerrarDialog()");
                break;
            case 2:
                elementos[i].innerText = titulo;
                break;
            case 3:
                elementos[i].innerText = texto;
                break;
            case 4:
                elementos[i].type = "button";
                elementos[i].value = "Listo";
                elementos[i].setAttribute("onclick", "cerrarDialog()");
                break;
            default: 
                break;
        }
    }

    if(!document.getElementById("dialogo")) {
        document.body.appendChild(cover);
        document.body.appendChild(dialog);
        if(document.getElementById("dialogo")) {    
            document.getElementById("dialogo").appendChild(title);
            document.getElementById("dialogo").appendChild(text);
            document.getElementById("dialogo").appendChild(btn);
        }
    }
}

function cerrarDialog() {
    if(document.getElementById("dialogo")) {
        document.getElementById("cover").style.animation = "fadeOut 200ms ease-in-out";
        document.getElementById("cover").style.webkitAnimation = "fadeOut 200ms ease-in-out";
        document.getElementById("dialogo").style.animation = "fadeOut 200ms ease-in-out";
        document.getElementById("dialogo").style.webkitAnimation = "fadeOut 200ms ease-in-out";

        document.getElementById("cover").addEventListener("animationEnd", function() {
            document.body.removeChild(document.getElementById("cover"));
        });
        document.getElementById("cover").addEventListener("webkitAnimationEnd", function() {
            document.body.removeChild(document.getElementById("cover"));
        });
        document.getElementById("dialogo").addEventListener("animationEnd", function() {
            document.body.removeChild(document.getElementById("dialogo"));
        });
        document.getElementById("dialogo").addEventListener("webkitAnimationEnd", function() {
            document.body.removeChild(document.getElementById("dialogo"));
        });
    }
}
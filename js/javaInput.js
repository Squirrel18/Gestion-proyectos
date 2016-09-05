var elementosInput;
var elementosLabel;

$( document ).ready(function() {
    var inputField = document.querySelectorAll(".fieldInput");
    var labelField = document.querySelectorAll(".fieldTextL");
    elementosInput = inputField;
    elementosLabel = labelField;
    for(var i = 0; i < inputField.length; i++) {
        inputField[i].id = "fieldInput" + i;
        inputField[i].addEventListener("focus", function() {
            eliminarError("card");
            handler(this, labelField, inputField, 0);
        });
        inputField[i].addEventListener("input", function() {
            eliminarError("card");
            handler(this, labelField, inputField, 0);
        });
        inputField[i].addEventListener("focusout", function() {
            handler(this, labelField, inputField, 1); /*La comprobación de si es valido o no el dato se hace cuando el campo ya no tenga focus*/
        });
    }
    for(var i = 0; i < labelField.length; i++) {
        labelField[i].setAttribute("for", "fieldInput" + i);
        if(inputField[i].value != "") {
            animacion(inputField[i], labelField);
        }
    }
});

function elementosField() {
    return elementosInput;
}

function elementosLabels() {
    return elementosLabel;
}

function handler(selec, label, input, evento) {
    switch(evento) {
        case 0:
            animacion(selec, label);
            break;
        case 1:
            if(removeAnim(selec, label)) { /*Si existe un dato para validar devuelve true y mantiene la animación*/}
            break;
        default:
            break;
    }
}

function animacion(selec, label) {
    selec.style.borderColor = "#09556C";
    if(selec.value == "") {
        for(var i = 0; i < label.length; i++) {
            if(label[i].control === selec) {
                label[i].classList.add("labelAnimate"); /*Acción de animación*/
                label[i].style.color = "#09556C";
                break;
            }
        }
    } else {
        for(var i = 0; i < label.length; i++) {
            if(label[i].control === selec) {
                label[i].classList.add("labelAnimate"); /*Acción de animación*/
                label[i].style.color = "#09556C";
                break;
            }
        }
    }
}

function removeAnim(selec, label) {
    if(selec.value == "") {
        selec.style.borderColor = "rgba(9,85,108,0.60)";
        for(var i = 0; i < label.length; i++) {
            if(label[i].control === selec) {
                label[i].classList.remove("labelAnimate"); /*Acción de remover animación*/
                label[i].style.color = "rgba(9,85,108,0.60)";
                break;
            }
        }
        return false; /*Retorna falso al no haber datos*/
    } else {
        selec.style.borderColor = "rgba(9,85,108,0.60)";
        for(var i = 0; i < label.length; i++) {
            if(label[i].control === selec) {
                label[i].style.color = "rgba(9,85,108,0.60)";
                break;
            }
        }
        return true; /*Retorna true al haber datos para validar*/
    }
}

function noValido(selec, label) { /*Función que cambia la apariencia del input al ser no valido el dato*/
    selec.style.borderColor = "#B71C1C";
    for(var i = 0; i < label.length; i++) {
        if(label[i].control === selec) {
            label[i].style.color = "#B71C1C";
            break;
        }
    }
}
$(document).ready(function(){ 
    var parametro = {requiredD: 1};
    $.ajax({
        method: "POST",
        url: "../php/session.php",
        data: parametro,
        dataType: "json", 
        success: function(datos) {
            if(document.getElementById("textUser") && document.getElementById("textRol")) {
                document.getElementById("textUser").innerText = datos[0].nombre;
                document.getElementById("textRol").innerText = datos[0].rol;
            }
        }
    });
    document.getElementById("fontAccount").addEventListener("mouseover", function() {
        btnAccount();
    });
});

function btnAccount() {
    var cerrar = document.createElement("a");
    cerrar.id = "btnClose";
    cerrar.innerText = "Cerrar Sesión";
    cerrar.href = "../";
    if(!document.getElementById("btnClose")) {
        document.getElementById("account").appendChild(cerrar);
        document.body.addEventListener("click", function() {
            elimBtn();
        });
    }
    
}

function elimBtn() {

    if(document.getElementById("btnClose")) {
        document.getElementById("account").removeChild(document.getElementById("btnClose"));
        document.body.removeEventListener("click", function() { });
    }
}
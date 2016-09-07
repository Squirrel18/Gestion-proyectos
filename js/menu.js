var toggle = false;

function openMenu(btn) {
    var menu = document.getElementById("menuNav");
    var cover = document.createElement("section");
    cover.id = "coverMenu";
    cover.addEventListener("click", function() {
        document.body.removeChild(document.getElementById("coverMenu"));
        menu.classList.remove("menuOpen");
        btn.classList.remove("menuChange");
        btn.innerText = "menu";
        btn.style.fontSize = "48px";
        btn.style.background = "transparent";
        toggle = false;
    });
    if(!toggle) {
        document.body.appendChild(cover);
        menu.classList.add("menuOpen");
        btn.classList.add("menuChange");
        btn.innerText = "clear";
        btn.style.fontSize = "48px";
        btn.style.background = "orange";
        toggle = true;
    } else {
        document.body.removeChild(document.getElementById("coverMenu"));
        menu.classList.remove("menuOpen");
        btn.classList.remove("menuChange");
        btn.innerText = "menu";
        btn.style.fontSize = "48px";
        btn.style.background = "transparent";
        toggle = false;
    }
    
}
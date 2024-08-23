var s_Marca = document.getElementById("marca");
var Masini = document.querySelectorAll(".masini1");

s_Marca.addEventListener("change", function(){
    Masini.forEach(function(div){
        var titluMasina = div.querySelector("h1").innerText.toLowerCase();
        var marcaSelectata = s_Marca.value.toLowerCase();
        if(titluMasina.includes(marcaSelectata)){
            div.style.display = "block";
        }
        else{
            div.style.display="none";
        }
    })
})
window.onunload = function(){
    s_Marca.selectedIndex = 0;
};
// facut login si register cu php

// facut pagina "liciteaza" cu js

// modificat counter cu php

// rezolvat cand selectez o marca si se reseteaza pagina dar ramane marca selectata "bifat"
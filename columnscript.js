/* column stuff first*/
let flexibleText = document.getElementById("flexibleText");
let toggle_btn = document.getElementById("toggle");
let untoggle_btn = document.getElementById("untoggle");


function collify() {
    flexibleText.style.columnWidth ="200px";
    toggle_btn.classList.add("hidden");
    untoggle_btn.classList.remove("hidden");
}

function uncol() {
    flexibleText.style.columnWidth = "1000px"; 
    toggle_btn.classList.remove("hidden");
    untoggle_btn.classList.add("hidden");
}

/* toggle between columns and full-width text*/
toggle_btn.onclick=function(){
    collify();
}
untoggle_btn.onclick=function(){
    uncol();
}
/* table stuff follows*/
/*let myTable = document.getElementById("myTable");*/
let degrade = document.getElementById("degrade");


degrade.onclick=function(){
    degrade.style.backgroundColor="gold";
}


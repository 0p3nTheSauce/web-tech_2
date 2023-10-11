
let radio1 = document.getElementById("rating-1");
let star1 = document.getElementById("star-1");
let radio2 = document.getElementById("rating-2");
let star2 = document.getElementById("star-2");
let radio3 = document.getElementById("rating-3");
let star3 = document.getElementById("star-3");
let radio4 = document.getElementById("rating-4");
let star4 = document.getElementById("star-4");
let radio5 = document.getElementById("rating-5");
let star5 = document.getElementById("star-5");

function check(star){
    star.style.color="orange";
}
function uncheck(star){
    star.style.color="black";
}
radio1.onclick=function(){
    check(star1);
    uncheck(star2);
    uncheck(star3);
    uncheck(star4);
    uncheck(star5);
}
radio2.onclick=function(){
    check(star1);
    check(star2);
    uncheck(star3);
    uncheck(star4);
    uncheck(star5);
}
radio3.onclick=function(){
    check(star1);
    check(star2);
    check(star3);
    uncheck(star4);
    uncheck(star5);
}
radio4.onclick=function(){
    check(star1);
    check(star2);
    check(star3);
    check(star4);
    uncheck(star5);
}
radio5.onclick=function(){
    check(star1);
    check(star2);
    check(star3);
    check(star4);
    check(star5);
}


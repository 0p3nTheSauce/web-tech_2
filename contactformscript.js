//harvest fields
let name_field = document.getElementById("fname");
let phone_field = document.getElementById("pnum");
let email_field = document.getElementById("em");
let message_field = document.getElementById("msg");
let emailRequirements = document.getElementById("emailNeeds");

function reactToMouseOver(field) {
    field.addEventListener("mouseover",function(){
        oldColor = field.style.backgroundColor;
        field.style.backgroundColor="#DBF3FA";
    });
    field.addEventListener("mouseout", function() {
        field.style.backgroundColor = oldColor;
    });
}
reactToMouseOver(name_field);
reactToMouseOver(phone_field);
reactToMouseOver(email_field);
reactToMouseOver(message_field);

//show email requirements
email_field.onfocus=function(){
    emailRequirements.style.display="block";
}
email_field.onblur=function(){
    emailRequirements.style.display="none";
}
//<ul id='emailNeeds'><li id='i'>An email requires letters</li><li id='ii'>an '@'</li><li id='iii'>some letters</li><li id='iv'>a period</li><li id='v'>some more letters</li></ul></div>
let letters= /[a-z]/g;
let at= /@/g;
let someMoreLetters = /@[a-z]/g;
let period=/\./g;
let evenMoreLetters=/\.[a-z]/g;
let i=document.getElementById("i");
let ii=document.getElementById("ii");
let iii=document.getElementById("iii");
let iv=document.getElementById("iv");
let v=document.getElementById("v");
email_field.onkeyup=function(){
    if (email_field.value.match(letters)){
        i.style.color="green";
    }
    else{
        i.style.color="red";
    }
    if (email_field.value.match(at)){
        ii.style.color="green";
    }
    else{
        ii.style.color="red";
    }
    if (email_field.value.match(someMoreLetters)){
        iii.style.color="green";
    }
    else{
        iii.style.color="red";
    }
    if (email_field.value.match(period)){
        iv.style.color="green";
    }
    else{
        iv.style.color="red";
    }
    if (email_field.value.match(evenMoreLetters)){
        v.style.color="green";
    }
    else{
        v.style.color="red";
    }
    
}













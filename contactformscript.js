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

//input validation
//check all fields are filled out
let requiredField = document.getElementsByClassName("requiredField");
let reqFieldErrorMsg = document.getElementById("reqFieldErrorMsg");
let contactForm = document.getElementById("contactForm");

//report specific issues
let nameIssue = document.getElementById("nameIssue");
let phoneIssue = document.getElementById("phoneIssue");
let emailIssue = document.getElementById("emailIssue");
let isSuccess = true;
let contactDetails = document.getElementById("contactDetails");
let thankMes = document.getElementById("thanks");
let isSliding = false;

//show email requirements
email_field.onfocus=function(){
    emailRequirements.style.display="block";
}
email_field.onblur=function(){
    emailRequirements.style.display="none";
}










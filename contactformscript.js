//harvest fields
let name_field = document.getElementById("fname");
let phone_field = document.getElementById("pnum");
let email_field = document.getElementById("em");
let message_field = document.getElementById("msg");

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

function slide(){
    if (!isSliding) {
        thankMes.style.transform = "translateX(100%)"; // Slide to the right
        thankMes.style.backgroundColor ="pink";
        isSliding = true;
    } else {
        thankMes.style.transform = "translateX(0)"; // Reset to the initial position
        isSliding = false;
        thankMes.style.backgroundColor ="blue";
    }
}

thankMes.addEventListener("click",function(){
    slide();
});

contactForm.addEventListener("submit", function(event) {
    slide();
    if (!name_field.value.match(/^[a-zA-Z\s]+$/g)){
        nameIssue.style.color="orange";
        nameIssue.innerHTML ="*Invalid name -- only letters and spaces allowed";
        event.preventDefault(); // Prevent the default form submission behavior   
        isSuccess=false; 
    }
    if (phone_field.value.length!=10 || !phone_field.value.match(/[0-9]/g)){
        phoneIssue.style.color="orange";
        phoneIssue.innerHTML ="*Invalid phone number -- ten digits required and no more";
        event.preventDefault(); // Prevent the default form submission behavior   
        isSuccess=false;
    }
    if (!email_field.value.match(/^[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,}$/g)){
        emailIssue.style.color="orange";
        emailIssue.innerHTML ="*invalid email requires @ and .";
        isSuccess=false;
        event.preventDefault(); // Prevent the default form submission behavior   
    }
    for (let i=0; i<requiredField.length;i++){
        if (requiredField[i].value == null || requiredField[i].value == " "||requiredField[i].value == ""){
            reqFieldErrorMsg.innerHTML = "*name, phone, and email are required fields";
            reqFieldErrorMsg.style.color="red";
            event.preventDefault();
            isSuccess=false;
            break;
        }
    }
});









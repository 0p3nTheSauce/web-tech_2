//harvest buttons
let register_btn = document.getElementById("register_btn");
let login_btn = document.getElementById("login_btn");
let lostpw = document.getElementById("lostpassword");
//harvest fields
let name_field = document.getElementById("name_field");
let form_title = document.getElementById("form_title");
let password_confirmation_field = document.getElementById("password_confirmation_field");
//harvest inputs
let named = document.getElementById("name");
let email = document.getElementById("email");
let password1 = document.getElementById("password1");
let password2 = document.getElementById("password2");
//errors
let errorElement = document.getElementById("error");
//password requirements
let passwordRequirementsList = document.getElementById("pw");
let repeatPasswordRequirement = document.getElementById("rpw");
let repeatPasswordMessage = document.getElementById("repeatMessage");
let len = document.getElementById("len");
let lowerletter = document.getElementById("lowerletter");
let upperletter = document.getElementById("upperletter");
let number = document.getElementById("number");
let specialcharacter = document.getElementById("specialcharacter");
let validpw=false;

//show the requirements when the user clicks on the password input
password1.onfocus=function(){
    passwordRequirementsList.style.display="block";
}
password1.onblur=function(){
    passwordRequirementsList.style.display="none";
}

//show the requirements when the user clicks on the second password input 
password2.onfocus=function() {
    repeatPasswordRequirement.style.display="block";
}
password2.onblur=function() {
    repeatPasswordRequirement.style.display="none";
}

//regexes:
let lowercaseLetters= /[a-z]/g;
let uppercaseLetters=/[A-Z]/g;
let numbers =/[0-9]/g;
let specials = /[~!*@%&^]/g;
let isValidPassword =[false,false,false,false,false];
//check off the requirements as the user types
password1.onkeyup=function(){
    if (password1.value.match(lowercaseLetters)){
        lowerletter.style.color="green";
        isValidPassword[0]=true;
    }
    if(password1.value.match(uppercaseLetters)){
        upperletter.style.color="green";
        isValidPassword[1]=true;
    }
    if(password1.value.match(numbers)){
        number.style.color="green";
        isValidPassword[2]=true;
    }
    if (password1.value.match(specials)){
        specialcharacter.style.color="green";
        isValidPassword[3]=true;
    }
    if(password1.value.length>=8){
        len.style.color="green";
        isValidPassword[4]=true;
    }
}

//check if the repeated password matches
password2.onkeyup=function(){
    if (password1.value == password2.value) {
        repeatPasswordMessage.innerHTML = "Passwords match";
        repeatPasswordMessage.style.color="green";
    } else {
        repeatPasswordMessage.innerHTML = "Passwords do not match";
        repeatPasswordMessage.style.color="red";
    }
}
//input validation
function checkValidRegistration(){
    //data validation
    let errorMessages = [];
    if (named.value==""|named.value==null){
        errorMessages.push("name is required");
    }
    if(password1.value != password2.value){
        errorMessages.push("the password must be consistent");
    }
    if (!email.value.match(/^[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,}$/g)){
        errorMessages.push("invalid email --- must have @ and .");
    }
    for(let p=0;p<5;p++){
        if (isValidPassword[p]==false){
            errorMessages.push("bad password");
            break;
        }
    }
    
    if (errorMessages.length>0){
        errorElement.style.color="red";
        errorElement.innerHTML = errorMessages.join(", ");
    }
    else{
        //changing the form to reflect successful submission
        register_btn.innerHTML="registered";
        register_btn.style.backgroundColor="green";
        const all_fields = document.getElementsByClassName("input-field");
        for (let i=0; i<all_fields.length;i++){
            all_fields[i].style.maxHeight="0";
        }
    }
}

function checkValidLogin(){
    login_btn.innerHTML="logged in";
    login_btn.style.backgroundColor="green";
    const all_fields = document.getElementsByClassName("input-field");
    for (let i=0; i<all_fields.length;i++){
        all_fields[i].style.maxHeight="0";
    }
}

// //switching to login form
// login_btn.onclick=function(){
//     if (login_btn.classList.contains("submission")){
//         checkValidLogin();
//     }
//     //hide the name_field and the password confirmation field
//     name_field.style.maxHeight="0";
//     password_confirmation_field.style.maxHeight="0";
//     //lost password option
//     lostpw.style.display="inline";
//     //change the title to login
//     form_title.innerHTML ="Login";
//     //change colour of register button so it appears disabled and login button so it appears enabled
//     register_btn.classList.add("disable-btn");
//     login_btn.classList.remove("disable-btn");
//     login_btn.classList.add("submission");
//     register_btn.classList.remove("submission");
    
// }
// //switching to register form 
// register_btn.onclick=function(){
//     //check if a submission
//     if (register_btn.classList.contains("submission")){
//         checkValidRegistration();
//     }
//     else{
//     //hide the name_field
//     name_field.style.maxHeight="100px";
//     password_confirmation_field.style.maxHeight="100px";
//     lostpw.style.display="none";
//     //change the title to login
//     form_title.innerHTML ="Register";
//     //change colour of register button so it appears disabled and login button so it appears enabled
//     login_btn.classList.add("disable-btn");
//     register_btn.classList.remove("disable-btn");
//     register_btn.classList.add("submission");
//     login_btn.classList.remove("submission");
//     }
// }


let reg_lnk = getElementById("registerlnk");
reg_lnk.onclick=function() {
    document.location='signup.php';
}
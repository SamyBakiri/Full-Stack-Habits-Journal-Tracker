const signin_button =document.getElementById("signin");
const signup_button =document.getElementById("signup");

signin_button.addEventListener("click",toSignIn);
function toSignIn(){
    signin_button.classList.remove("buttonOFF");
    signup_button.classList.add("buttonOFF");
    document.getElementsByClassName("nameContainer")[0].remove();

}
signup_button.addEventListener("click",toSignUp);
function toSignUp(){
    signin_button.classList.add("buttonOFF");
    signup_button.classList.remove("buttonOFF");
    
    const nameContainer = document.createElement("div");
    nameContainer.classList.add("nameContainer")

    const fname_input =document.createElement("input");
    fname_input.type = "text";
    fname_input.placeholder = "First Name";
    
    const lname_input =document.createElement("input");
    lname_input.type = "text";
    lname_input.placeholder = "Last Name";
    nameContainer.appendChild(fname_input);
    nameContainer.appendChild(lname_input);


    const form = document.getElementsByClassName("form")[0];
    const email_input = form.firstChild;
    
    form.insertBefore(nameContainer, email_input);
}
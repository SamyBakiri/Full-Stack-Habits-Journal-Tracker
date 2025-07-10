const signin_button =document.getElementById("signin");
const signup_button =document.getElementById("signup");
const have_an_acount_btn = document.querySelectorAll(".have_account a")[0];
const form_p = document.querySelectorAll(".formCard p")[0];
const submit_btn = document.querySelectorAll(".form button")[0];
const verify_password = document.querySelectorAll(".form input[type=password]")[1].parentElement;
const form = document.getElementsByClassName("form")[0];
let current_stat = "signup";
const nameContainer = document.getElementsByClassName("nameContainer")[0]
have_an_acount_btn.addEventListener("click", toSignIn);
signin_button.addEventListener("click",toSignIn);
function toSignIn(){
    if(current_stat !== "signin"){
    signin_button.classList.remove("buttonOFF");
    signup_button.classList.add("buttonOFF");
    nameContainer.remove();
    verify_password.remove();
    const el = document.getElementsByClassName("success_msg")[0];
    if(el){
        el.remove();
    }
    form.reset();

    form_p.textContent = "Welcome Back";
    submit_btn.textContent = "Log in";
    submit_btn.name = "login";
    const forgot_password = document.createElement("a");
    forgot_password.classList.add("forgot_password");
    forgot_password.href = "#";
    forgot_password.textContent = "Forgot your password?";
    form.lastElementChild.remove();
    form.appendChild(forgot_password);
    current_stat = "signin";
}
}

signup_button.addEventListener("click",toSignUp);
function toSignUp(){
    if(current_stat !== "signup"){
    
    signin_button.classList.add("buttonOFF");
    signup_button.classList.remove("buttonOFF");

    const email_input = form.firstChild;
    
    form.insertBefore(nameContainer, email_input);
    form.insertBefore(verify_password, submit_btn);
    
    form_p.textContent = "Create an account";
    submit_btn.textContent = "Register";
    submit_btn.name = "register";
    form.lastChild.remove();
    form.reset();

    const have_account = document.createElement("p");
    have_account.classList.add("have_account");
    have_account.textContent ="Already have an account?";
    a_login = document.createElement("a");
    a_login.href = "#";
    a_login.textContent = "Login";
    
    have_account.appendChild(a_login);
    form.appendChild(have_account);
    current_stat = "signup";
}
}

function form_validation(){
    const password = document.getElementById("password").value;
    const confirm_password = document.getElementById("confirm_password").value;
    if(password !== confirm_password){
        // password error code 
        password_parent = document.getElementById("password").parentElement;
        password_parent.classList.add("input_error");
        password_parent.style.setProperty('--input_error_content','"password doesn\'t match"');

        password_parent = document.getElementById("confirm_password").parentElement;
        password_parent.classList.add("input_error");
        password_parent.style.setProperty('--input_error_content','"password doesn\'t match"');
        const error_inputs = document.querySelectorAll(".input_error").forEach(input_container =>{
    input_container.querySelector("input").addEventListener("input", input_data_changed)
});
        return false;
    }
    return true;
}

function print_input_error(returnMsg){
    if(returnMsg === 'password incorrect'){
        password_parent = document.getElementById("password").parentElement;
        password_parent.classList.add("input_error");
        password_parent.style.setProperty('--input_error_content','"password incorrect"');
    }else if(returnMsg === 'this email is used before'){
        email_parent = document.getElementById("email").parentElement;
        email_parent.classList.add("input_error");
        email_parent.style.setProperty('--input_error_content', '"this email is used before"');
    }
    else if(returnMsg === 'user not found'){
        password_parent = document.getElementById("password").parentElement;
        password_parent.classList.add("input_error");
        email_parent = document.getElementById("email").parentElement;
        email_parent.classList.add("input_error");
        email_parent.style.setProperty('--input_error_content', '"User not found"');
    }else if(returnMsg === "Account created successfuly"){
        const success_msg = document.createElement("p");
        success_msg.textContent = "Account created successfuly";
        success_msg.classList.add("success_msg");
        form.insertBefore(success_msg, submit_btn);

    }
    const error_inputs = document.querySelectorAll(".input_error").forEach(input_container =>{
    input_container.querySelector("input").addEventListener("input", input_data_changed)
});
}


function input_data_changed(){
    this.parentElement.classList.remove("input_error");
}

let all = document.querySelector(".all");

// Register
let popup = document.querySelector(".register-popup");
let button = document.querySelectorAll("#register");
let exit =  document.querySelector(".exit-register");

// Login
let popupLogin = document.querySelector(".login-popup");
let buttonLogin = document.querySelector("#login");
let exitLogin = document.querySelector(".exit-login");

// Register popup
for(const btn of button)
{
    btn.addEventListener("click", function(){
        popup.style.display="block";
        all.style.filter="blur(8px)";
        // exit other popups
        popupLogin.style.display="none";
        login_error_popup.style.display="none";
    });
}

exit.addEventListener("click",function(){
    popup.style.display="none";
    all.style.filter="none";
});



// Login popup

buttonLogin.addEventListener("click", function(){
    popupLogin.style.display="block";
    all.style.filter="blur(8px)";

    //exit other popups
    popup.style.display="none";
    login_error_popup.style.display="none";
});

exitLogin.addEventListener("click",function(){
    popupLogin.style.display="none";
    all.style.filter="none";
});


// Login error popup

let login_error_popup = document.querySelector(".login_error");
let buttonError = document.querySelector(".login_again");
let exitError =  document.querySelector(".exit-error");


buttonError.addEventListener("click", function(){
    popupLogin.style.display="block";
    all.style.filter="blur(8px)";
    login_error_popup.style.display="none";
    all.style.filter="blur(8px)";
});

exitError.addEventListener("click",function(){
    login_error_popup.style.display="none";
    all.style.filter="none";
});


// register error popup

let register_error_popup = document.querySelector(".register_error");
let register_error_button = document.querySelector(".register_login");
let register_error_exit = document.querySelector(".exit-error-register");

register_error_exit.addEventListener("click", function(){
    register_error_popup.style.display = "none";
});

register_error_button.addEventListener("click", function(){
    popupLogin.style.display="block";
    register_error_popup.style.display="none";
    all.style.filter="blur(8px)";
});





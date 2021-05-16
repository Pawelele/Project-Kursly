let all = document.querySelector(".all");

// Register
let popup = document.querySelector(".register-popup");
let button = document.querySelectorAll("#register");
let exit =  document.querySelector(".exit-register");

for(const btn of button)
{
    btn.addEventListener("click", function(){
    popup.style.display="block";
    all.style.filter="blur(8px)";
    });
}

exit.addEventListener("click",function(){
    popup.style.display="none";
    all.style.filter="none";
});



// Login
let popupLogin = document.querySelector(".login-popup");
let buttonLogin = document.querySelector("#login");
let exitLogin = document.querySelector(".exit-login");


buttonLogin.addEventListener("click", function(){
popupLogin.style.display="block";
all.style.filter="blur(8px)";
});

exitLogin.addEventListener("click",function(){
    popupLogin.style.display="none";
    all.style.filter="none";
});


// Login error popup and closing

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





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


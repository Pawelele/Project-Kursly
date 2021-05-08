let popup = document.querySelector(".register-popup");
let button = document.querySelectorAll("#register");
let exit =  document.querySelector(".exit");

for(const btn of button)
{
    btn.addEventListener("click", function(){
    popup.style.display="block";
    });
}

exit.addEventListener("click",function(){
    popup.style.display="none";
});



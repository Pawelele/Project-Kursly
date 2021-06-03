let button = document.querySelector("#user_panel_addCash");
let exit = document.querySelector('.exit-cash');
let popup = document.querySelector("#cash_popup");

button.addEventListener("click",function(){
    popup.style.display="block";
});

exit.addEventListener("click",function(){
    popup.style.display="none";
});


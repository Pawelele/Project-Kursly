// Popup for adding cash to wallet - variables

let button = document.querySelector("#user_panel_addCash");
let exit = document.querySelector('.exit-cash');
let popup = document.querySelector("#cash_popup");

// no money in wallet popup - variables

let noMoney_popup = document.querySelector("#noMoney_popup");
let noMoney_button = document.querySelector(".add_money");
let noMoney_exit = document.querySelector(".exit_noMoney");

// Popup for adding cash to wallet

button.addEventListener("click",function(){
    popup.style.display="block";
    noMoney_popup.style.display="none";
});

exit.addEventListener("click",function(){
    popup.style.display="none";
});

// no money in wallet popup

noMoney_exit.addEventListener("click", function(){
    noMoney_popup.style.display="none";
});

noMoney_button.addEventListener("click",function(){
    popup.style.display="block";
    noMoney_popup.style.display="none";
});

// Course already bought popup

let courseBought_popup = document.querySelector("#courseBought_popup");
let courseBought_exit = document.querySelector(".exit_courseBought");

courseBought_exit.addEventListener("click",function(){
    courseBought_popup.style.display="none";
});



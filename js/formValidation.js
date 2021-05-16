function error(input1,input2,message)
{
    input1.classList.add("error");
    input2.classList.add("error");

    const error = document.querySelector("small");
    error.innerText = message;
    error.style.color = "red";

    return false;
}

function success(input1, input2)
{
    input1.classList.add("success");
    input2.classList.add("success");

    const error = document.querySelector("small");
    error.innerText='';

    return true;
}

function validatePassword(input1, input2)
{
    if(input1.value==input2.value)
    {
        success(input1,input2);
        return true;
    }
    else
    {
        error(input1, input2, "Podane hasła nie są takie same");
        return false;
    }
}

const form = document.querySelector("#registry-form");

const password1 = form.elements['password1'];
const password2 = form.elements['password2'];

form.addEventListener('submit', (event) => {
    let valid = true;

    valid = validatePassword(password1, password2);

    if(!valid)
    {
        event.preventDefault();
    }
});


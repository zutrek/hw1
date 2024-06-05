function onClick(){
    const element=document.querySelector('#menu-categorie');
    const menu= document.querySelector('#menu_tendina');
    const chiusura= document.querySelector('#chiudi_menu');
    element.classList.remove('hidden');
    menu.removeEventListener("click",onClick);
    menu.addEventListener("click",nascondiMenu);
    chiusura.addEventListener("click",nascondiMenu);
};

function nascondiMenu(){
    const element=document.querySelector('#menu-categorie');
    const menu= document.querySelector('#menu_tendina');
    const chiusura= document.querySelector('#chiudi_menu');
    element.classList.add('hidden');
    chiusura.removeEventListener("click",nascondiMenu);
    menu.removeEventListener("click",nascondiMenu);
    menu.addEventListener("click",onClick);
    
};

function sostituisciTesto(){
    const element= this;
    const sostituto= document.querySelector('#menu_tendina');
    sostituto.textContent= element.textContent;
}

const spans= document.querySelectorAll('#menu-categorie span');
for (const span of spans){
    span.addEventListener("click",sostituisciTesto);
    span.addEventListener("click",nascondiMenu);
}

const element= document.querySelector('#menu_tendina');
element.addEventListener("click",onClick);

const mostra= document.getElementById("mostra_pass");

mostra.addEventListener("click", chiarisci);


function chiarisci(){
   
   const mostra= document.getElementById("mostra_pass");
   const pass=document.querySelector(".password input");

   if(pass.type === "password"){
   pass.type="text";
   mostra.textContent="OSCURA";
   }
   else {
      pass.type="password";
      mostra.textContent="MOSTRA";
   }
}



function checkNome(event) {
    const input = event.currentTarget;
    
    if (formStatus[input.nome] = input.value.length > 0) {
        input.parentNode.classList.remove('errorj');
    } else {
        input.parentNode.classList.add('errorj');
    }
}

function checkCognome(event) {
    const input = event.currentTarget;
    
    if (formStatus[input.cognome] = input.value.length > 0) {
        input.parentNode.classList.remove('errorj');
    } else {
        input.parentNode.classList.add('errorj');
    }
}



function checkEmail(event) {
    const emailInput = document.querySelector('.email input');
    if(!/^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/.test(String(emailInput.value).toLowerCase())) {
        document.querySelector('.email span').textContent = "Email non valida";
        document.querySelector('.email').classList.add('errorj');
        formStatus.email = false;

    } else {
        fetch("http://localhost/homework1/controlloemail.php?q="+encodeURIComponent(String(emailInput.value).toLowerCase())).then(onResponse).then(jCheckEmail);
    }
}

function checkPassword(event) {
    const passwordInput = document.querySelector('.password input');
    if (formStatus.password = passwordInput.value.length >= 10) {
        document.querySelector('.password').classList.remove('errorj');
    } else {
        document.querySelector('.password').classList.add('errorj');
    }

}



function jCheckEmail(json) {
    if (formStatus.email = !json.exists) {
        document.querySelector('.email').classList.remove('errorj');
    } else {
        document.querySelector('.email span').textContent = "Email già utilizzata";
        document.querySelector('.email').classList.add('errorj');
    }
}
function onResponse(response) {
    if (!response.ok) return null;
    return response.json();
}



function checkSignup(event) {
    const checkbox = document.querySelector('.allow input');
    formStatus[checkbox.name] = checkbox.checked;
    if (Object.keys(formStatus).length !== 8 || Object.values(formStatus).includes(false)) {
        event.preventDefault();
    }
}

const formStatus = {'upload': true};
document.querySelector('.nome input').addEventListener('blur', checkNome);
document.querySelector('.cognome input').addEventListener('blur', checkCognome);
document.querySelector('.email input').addEventListener('blur', checkEmail);
document.querySelector('.password input').addEventListener('blur', checkPassword);
document.querySelector('form').addEventListener('submit', checkSignup);


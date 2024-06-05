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
   const pass=document.getElementById("password");

   if(pass.type === "password"){
   pass.type="text";
   mostra.textContent="OSCURA";
   }
   else {
      pass.type="password";
      mostra.textContent="MOSTRA";
   }
}



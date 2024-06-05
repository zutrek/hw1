function addCart(){
    const element= event.target;
    const span= element.querySelector('.prezzo');
    span.classList.add('hidden');


    const carrello= element.querySelector('.carrello_btn');
    
    carrello.classList.remove("hidden");
}

function removeCart(){
    const element= event.target;
    
    const carrello= element.querySelector('.carrello_btn');
    carrello.classList.add('hidden');

    const prezzo= element.querySelector('.prezzo');
    prezzo.classList.remove('hidden');    
}








function aggiungiAlCarrello(){
    const element=event.target;
    const divPadre= element.parentNode;
    const id= divPadre.querySelector('.id_prod');
    const id_prodotto= id.textContent;
    
  
    fetch("http://localhost/homework1/aggiungiCarrello.php?id_prodotto=" + id_prodotto, {
        method: 'GET',
        headers: {
            'Content-Type': 'application/json'
        }}).then(onResponse).then(onJsonCarrello);
}

function onJsonCarrello(json){
    immagine=document.getElementById("carrello_attivo");
    if (json === "utente non loggato")
        window.location.href="accesso.php";
    else if(json=== "Aggiunto al carrello"){
            if(immagine.classList.contains("hidden"))
                immagine.classList.remove("hidden");
    }

}


function mostraModale(){
    const modale = document.getElementById('modale');
    modale.style.display = 'block';
    document.body.classList.add('no-scroll');
    fetch("http://localhost/homework1/prodottiCarrello.php").then(onResponse).then(prodottiCarrello);
}



function prodottiCarrello(json){
  
 if (Array.isArray(json)) {
    let prodottiCarrello=json;
    visualizzaProdottiCarrello(prodottiCarrello);
} else {
    console.log(json); // Mostra il messaggio di errore o informazione
    alert(json);
}
    


}


function visualizzaProdottiCarrello(prodottiC){

    const contenitoreProdotti = document.getElementById('modale-content');
    //contenitoreProdotti.innerHTML = ''; // Pulisce il contenitore
    const divs = document.querySelectorAll(".prodotto_carrello");
    for (let div of divs){
        div.remove();
    }
    // Ciclo for each su prodotti
    for (let prodotto in prodottiC) {
        
    const divProdotto = document.createElement('div');
    divProdotto.classList.add('prodotto_carrello');
    

    const imgProdotto = document.createElement('img');
    imgProdotto.src = prodotto.img;
    divProdotto.appendChild(imgProdotto);

    const divInfo = document.createElement('div');
    divInfo.classList.add("info-prodotto");

    const titoloProdotto = document.createElement('p');
    titoloProdotto.textContent = prodottiC[prodotto].marca + " " + prodottiC[prodotto].nome;
    titoloProdotto.id="titolo_p";
    divInfo.appendChild(titoloProdotto);

    const prezzoProdotto = document.createElement('p');
    prezzoProdotto.classList.add('prezzo');
    prezzoProdotto.textContent = prodottiC[prodotto].prezzo + '€';
    divInfo.appendChild(prezzoProdotto);

    
    const id= document.createElement('p');
    id.classList.add('hidden');
    id.textContent=prodottiC[prodotto].id;
    id.classList.add("id_prod");
    divInfo.appendChild(id);

    divProdotto.appendChild(divInfo);

    const elimina= document.createElement('span');
    elimina.textContent="X";
    elimina.id="rimuovi_elemento";
    elimina.addEventListener("click",rimuoviProdottoCarrello);
    divProdotto.appendChild(elimina);

    contenitoreProdotti.appendChild(divProdotto);
    
}
    const msg_err = document.createElement('span');
    msg_err.textContent='';
    msg_err.classList.add("hidden");
    msg_err.classList.add("error_msg");
    contenitoreProdotti.appendChild(msg_err);

   

}

function rimuoviProdottoCarrello(){

    const element=event.target;
    const divPadre= element.parentNode;
    const id= divPadre.querySelector('.id_prod');
    const id_prodotto= id.textContent;

    fetch("http://localhost/homework1/rimuoviProdotto.php?id="+ id_prodotto,{method:'GET'}).then(onResponse).then(rimozione);

}

function rimozione (json){
    if (json.id != ''){
        aggiornaCarrello(json.id);
    }
    else {
    const msg = document.querySelector('error_msg');
    msg.textContent = json.message;
    msg.classList.remove("hidden");

    setTimeout(function() {
        msg.classList.add("hidden"); 
    }, 4000);
    }
        
}


function aggiornaCarrello(element){
const products = document.querySelectorAll(".id_prod");
const img=document.getElementById("carrello_attivo");

if(products.length==0){
    img.classList.add("hidden");
}
for (const prodotto of products) {
    if (prodotto.textContent.includes(element)) {
        const div=prodotto.parentNode.parentNode;
        div.remove();
        break; 
    }
}


}


function onResponse(response){
    if(response.ok){
        return response.json();
    }
}




document.getElementById('close').addEventListener('click', function() {
    const modale = document.getElementById('modale');
    modale.style.display = 'none';
    document.body.classList.remove('no-scroll');
});


window.addEventListener('click', function(event) {
    const modale = document.getElementById('modale');
    if (event.target == modale) {
        modale.style.display = 'none';
        document.body.classList.remove('no-scroll');
    }
});



const carrelli = document.querySelectorAll(".carrello_btn");
for (let carrello of carrelli){
    carrello.addEventListener("click",aggiungiAlCarrello);
}

const divs =document.querySelectorAll(".prodotto");

for (let div of divs){
    div.addEventListener("mouseenter", addCart );
    div.addEventListener("mouseleave",removeCart);
}

document.getElementById('carrello').addEventListener('click', mostraModale);
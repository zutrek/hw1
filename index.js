







function subImg(){
    const divv= event.target;
    const divImg= divv.querySelector('img');

    switch(divv.id){

        case '1.3':
            divImg.classList.add("fade-out");
            
            setTimeout(function() {
                divImg.src='img/sez1.3bis.jpg';
                divImg.classList.remove("fade-out");
                
            }, 200);
            
            break;


        case '1.4': 
        divImg.classList.add("fade-out");
            
            setTimeout(function() {
                divImg.src='img/sez1.4bis.jpg';
                divImg.classList.remove("fade-out");
                
            }, 200);
            break;

        case '1.5':
            divImg.classList.add("fade-out");
            
            setTimeout(function() {
                divImg.src='img/sez1.5bis.jpg';
                divImg.classList.remove("fade-out");
                
            }, 200);

            break;
        default: break; 
    }
}

function resetImg(){
    const divv= event.target;
    const divImg= divv.querySelector('img');
    
    switch(divv.id){

        case '1.3':
            
            
        divImg.classList.add("fade-out");

            setTimeout(function() {
                divImg.src='img/sez1.3.jpg';
                divImg.classList.remove("fade-out");
                
            }, 200);


            break;

        case '1.4': 
        
        divImg.classList.add("fade-out");

            setTimeout(function() {
                divImg.src='img/sez1.4.jpg';
                divImg.classList.remove("fade-out");
                
            }, 200);

        break;
        case '1.5':
            
        divImg.classList.add("fade-out");

        
        setTimeout(function() {
            divImg.src='img/sez1.5.jpg';
            divImg.classList.remove("fade-out");
            
        }, 200);

            break;
        default: break; 
    }
}

function addCart(){
    const element= event.target;
    const span= element.querySelector('.prezzo');
    span.classList.add("hidden");
    
    const carrello= element.querySelector('.carrello_btn');
    
    carrello.classList.remove("hidden");

}


function removeCart(){
    const element= event.target;
    
    const carrello= element.querySelector('.carrello_btn');
    carrello.classList.add("hidden");
    
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

function gestioneBot(){

    const endpointApi ="https://api.openai.com/v1/chat/completions";

    const dialogo= document.querySelector('.conversation');

    const span_user= document.createElement("span");
    const finestra_input=document.getElementById("input_utente");
    const testo=finestra_input.value;
    span_user.textContent= testo;
    span_user.classList.add("messaggi");
    dialogo.appendChild(span_user);
    
    const formatRichiesta={
            
            messages: [{ role: "user", content: testo }],
            model: "gpt-3.5-turbo",
        

        };

    fetch(endpointApi, {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "Authorization": "Bearer sk-proj-jMLonnQtIHunozOdJ8qIT3BlbkFJNmdVO7mGpGsL3V8h6Ewl"
            },
        body: JSON.stringify(formatRichiesta)
        }).then(onResponse,onError).then(TextExtractor);
        
        finestra_input.value="";
}




function onResponse(response) {
    
    return response.json(); 
}

function TextExtractor(json){
    //l'api torna un json che è un'array di oggetti choices, contenenti varie risposte al prompt fornito. cosi stiamo selezionando il primo risultato
    const risp22=json.choices[0].message.content;
    const dialogo= document.querySelector('.conversation');
    const span_bot=document.createElement("span");
    span_bot.textContent= risp22;
    span_bot.classList.add("messaggi");
    dialogo.appendChild(span_bot);

}

function onError(error){
    console.error('Errore durante la richiesta API');
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
    prezzoProdotto.id="prezzo";
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
       
    
    
    
    
    
    
    document.getElementById('carrello').addEventListener('click', mostraModale);
const divContainers = document.querySelectorAll('.main-container .content')

for (const div of divContainers){
    
    div.addEventListener("mouseenter",subImg);
    div.addEventListener("mouseleave",resetImg);
    div.addEventListener("mouseenter", addCart );
    div.addEventListener("mouseleave",removeCart);

}


const buttonInvia= document.getElementById("invio");
buttonInvia.addEventListener("click",gestioneBot);




const carrello_btn= document.querySelectorAll(".carrello_btn");
for (const btn of carrello_btn){
    btn.addEventListener("click", aggiungiAlCarrello);
}











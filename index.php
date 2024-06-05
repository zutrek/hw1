

<?php

include 'gestione_registrazione.php';
$utente_loggato=false;
$conn = mysqli_connect($host, $user, $password, $nome) or die(mysqli_error($conn));
$query_prodotti1= "SELECT * FROM prodotti ORDER BY RAND() LIMIT 5";
$result_prodotti1= mysqli_query($conn,$query_prodotti1);

$query_prodotti2= "SELECT * FROM prodotti ORDER BY RAND() LIMIT 5";
$result_prodotti2= mysqli_query($conn,$query_prodotti2);



if($user_id = controllo_sessione()){
    $utente_loggato=true;
    
    $query = "SELECT * FROM utenti WHERE id = '$user_id' ";
    $result= mysqli_query($conn,$query);
    $info_utente= mysqli_fetch_assoc($result);
   
}
?>

<html>
    <head>
        <title>MrShopKing</title>
        <link rel="stylesheet" href="index.css" />
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
        <script src="index.js" defer></script>
    </head>

    <body>
        <nav>
            <div class="pre-head-sinistra">
                    <div id="cuffia"> <img src="img/cuffia.png"> 
                    </div>
                     <p>SERVIZIO CLIENTI 06 69455 903 LUN-VEN 10-13/14-17</p>
            </div>
        
         
            <div class="pre-head-destra"> 
                <span>ECCELLENTE </span>
                    <div class="stella">
                        <div> <img src="img/stella.png"></div>
                        <div> <img src="img/stella.png"></div>
                        <div> <img src="img/stella.png"></div>
                        <div> <img src="img/stella.png"></div>
                        <div> <img src="img/stella.png"></div>
                    </div>
                <span>Trustpilot</span>
             </div>


        </nav>

        <header>

            <div class="head-sez1">

                <div id="logo">
                    <img src="img/logomrshop.png">
                </div>

                <form id="searchbar" action="ricerca_prodotti.php" method="GET">
                        <label for="menu_tendina">
                        <select id="menu_tendina" name="categoria">
                            <option value="tutte">Tutte le categorie</option>
                            <option value="telefonia">Telefonia</option>
                            <option value="notebook">Notebook</option>
                            <option value="smartwatch">Smartwatch</option>
                            <option value="console">Console</option>
                                
                        </select>
                        </label>
                        
                        <div id="ricerca">
                            <input type="text" id="search-input" name="search" placeholder="Cerca in tutto il negozio">
                        </div>
                        <button type="submit" id="cerca_button">
                                CERCA
                        </button>
                </form>

                
                    

                <div class="head-sez1_destra">
                    <div id="accesso" <?php if($utente_loggato){echo 'onclick="window.location.href=\'profilo.php\'"';} 
                   else {echo 'onclick="window.location.href=\'accesso.php\'"';} ?>>
                        <div>
                            <img src="img/icona-profilo.png">
                        </div>
                        <span id="account_login">
                            Il Mio Account
                        </span>

                        
                    </div>

                    

                    <div id="carrello">
                        <div>
                            <img src="img/icona-carrello1.png">
                        </div>
                        <div><img src="img/pallino_rosso.png" id="carrello_attivo" class="hidden"></div>
                        <span>
                            Carrello
                        </span>

                    </div>


                    <div id="modale">
                        <div id="modale-content">
                            <span id="close">&times;</span>
                            <h2>Il tuo carrello</h2>
                            
                        </div>
                    </div>


                    <div id="email" <?php if($utente_loggato){echo 'onclick="window.location.href=\'logout.php\'"';} ?>>
                        <div>
                            <img src="img/icona-email.png">
                        </div>

                        <span> <?php if($utente_loggato){ echo "Logout";} else echo "Email" ?>
                        </span>

                    </div>

                </div>

            </div>
            


            <div class="head-sez2">
                <div class="categorie_button">
                    <div >
                        <img src="img/icona-menu1.png">
                    </div>

                    <span>
                        CATEGORIE
                    </span>
                </div>


                <div class="navbar">
                    <a href="http://localhost/homework1/index.php"> Home</a>
                    <a href="https://www.mistershopking.com/428-super-offerte"> Super Offerte</a>
                    <a href="http://localhost/homework1/catalogo.php"> Negozio</a>
                    <a href="https://www.mistershopking.com/contattaci"> Contattaci</a>
                    <img id="bag" src="img/icona-carrello1.png">
                    

                </div>


                <div id="offerta">
                    <span>
                        <?php if($utente_loggato){ echo "Benvenuto, " .$info_utente['nome'];} else {echo "OFFERTA SPECIALE";} ?>
                    </span>

                </div>
            </div>

            <div class="head-sez3">

                <div class="box_info">
                    <div >
                        <img src="img/icona-razzo.png">
                    </div>
                    <div>
                        <span class="titolo"> SPEDIZIONE RAPIDA <br></span>
                        <div class="descrizione">Tracciata e Assicurata con  Corriere <br> Espresso
                        in 24/72 ore in  Tutta Italia </div>
                    </div>
                </div>

                <div class="box_info">
                    <div >
                        <img src="img/icona-whatsapp.png">
                    </div>
                    <div >
                        <span class="titolo"> SERVIZIO CLIENTI <br></span>
                        <div class="descrizione">Assistenza Info Ordini Telefona allo <br>
                            06 69455 03 Lun-Ven 10-13/14-17
                        </div>
                    </div>
                </div>

                <div class="box_info">
                    <div >
                        <img src="img/icona-consegne.png">
                    </div>
                    <div>
                        <span class="titolo"> GARANZIA <br></span>
                        <div class="descrizione">Tutti i Prodotti sono Nuovi Originali <br>
                             e Garantiti 24 mesi</div>
                    </div>
                </div>

                <div class="box_info">
                    <div >
                        <img src="img/icona-pagamento.png">
                    </div>
                    <div>
                        <span class="titolo"> PAGAMENTO SICURO <br></span>
                        <div class="descrizione"> Carta di Credito, Paypal, 
                            Bonifico <br>con sconto 2%</div>
                    </div>
                </div>
            </div>
        </header>


        <main>
       
        <div class="copertina_sito">
            
            <h1>AUGURI</h1>
            <h2> BUONA PASQUA!</h2>
            <span>SHOPPING</span>
        </div>




        <div class="sezione">
            <span id="titolo_sezione"> Vetrina </span>
            <div class="wrapper">  
                <div class="main-container">
                
                <?php
            
                    while ($row = mysqli_fetch_assoc($result_prodotti1)) {
                        echo '<div class="content">';
                        echo '<img src="' . $row['img'] . '">'; 

                        $descrizione = $row['marca'] . ' ' . $row['nome'] . ' ' . $row['memoria'] . ' ' . $row['colore'];

                        echo '<span class="desc-prodotto">' . $descrizione . '</span>';
                        echo '<span class="prezzo">' . $row['prezzo'] . '$</span>';
                        echo '<span class="carrello_btn hidden" >'. '+CARRELLO' . '</span>';
                        echo '<span class="id_prod hidden">' . $row['id'] . '</span>';
                        echo '</div>';
                    }
                ?>
                </div>

                 <div class="ciao"> <img src="img/sez1.6.jpg"> </div>
            </div>
        </div>



        <div class="sezione">
            <span id="titolo-sez"> Nuovi Arrivi </span>
            <div class="wrapper">
                <div class="ciao1"> <img src="img/sez2.6.jpg"> </div>
                
                <div class="main-container">
                
                    <?php
            
                    while ($row = mysqli_fetch_assoc($result_prodotti2)) {
                        echo '<div class="content">';
                        echo '<img src="' . $row['img'] . '">'; 

                        $descrizione = $row['marca'] . ' ' . $row['nome'] . ' ' . $row['memoria'] . ' ' . $row['colore'];

                        echo '<span class="desc-prodotto">' . $descrizione . '</span>';
                        echo '<span class="prezzo">' . $row['prezzo'] . '$</span>';
                        echo '<span class="carrello_btn hidden" >'. '+CARRELLO' . '</span>';
                        echo '<span class="id_prod hidden">' . $row['id'] . '</span>';
                        echo '</div>';
                    }
                    ?>
                </div>

                 
            </div>

        
        </div>

       <div class="chatbot">
            <div class="chatlogo"><img src="img/chatlogo.png"></div>
            <div class="conversation">
                
            </div>
            <div class="input">
                <input type="text" id="input_utente" placeholder="Message ChatGPT">
                <button id="invio"> Invia</button>
            </div>
        </div>

        
        
        </div>
        
        </main>

 

        
        <footer>
            <div class="pre-footer"> 
                <div class="sez-footer"> 
                    <h1>INFORMAZIONI NEGOZIO</h1>
                    <span> Mister Shop King</span>
                    <span> Via Giuseppe Capogrossi,50</span>
                    <span>Lunedi-Venerdi 10/13-14/17</span>
                    <span>00155 Roma</span>
                    <span>Roma</span>
                    <span> Italia</span>
                    <span> 06 69455903</span>
                    <span>info@mrshopking.com</span>


                </div>
                <div class="sez-footer">
                    <h1>IL TUO ACCOUNT</h1>
                    <span> Informazioni Personali</span>
                    <span> Restituzione prodotto</span>
                    <span>Ordini</span>
                    <span>Note di Credito</span>
                    <span>Indirizzi</span>
                    <span> Buoni</span>
                    <span> I miei avvisi</span>
                    
                
                
                </div>
                <div class="sez-footer"> 
                    <h1>SERVIZIO CLIENTI</h1>
                    <span> Consegna</span>
                    <span> Tempi e Spese Spedizione</span>
                    <span>Termini e Condizioni</span>
                    <span>Resi e Recessi</span>
                    <span>Garanzie</span>
                    <span> Pagamenti</span>
                    <span>Privacy e cookie</span>
                    <span>Estensione Garanzia Long <br> Life Crash</span>
                    <span> Contattaci</span>
                    <span> Mappa del sito</span>
                    <span> Negozi </span>
                </div>

                <div class="sez-footer">
                    <h1>CATEGORIE</h1>
                    <span> Auricolari</span>
                    <span> Caricabatterie</span>
                    <span>Console</span>
                    <span>Custodie e protezione</span>
                    <span>Elettrodomestici</span>
                    <span>Ritiro Immediato</span>
                    <span>Smartphone</span>
                    <span>Smartwatch</span>   
                    <span>Super Offerte</span>
                    <span> Tablet</span> 
                
                </div>
                <div class="sez-footer"> 
                    <h1>NEWSLETTER</h1>
                    <span> Iscriviti e ricevi le nostre ultime offerte</span>
                    <div id="box-email">
                        <span>Il tuo indirizzo email</span>
                    </div>
                    <div id="iscriviti-button">
                        <span>ISCRIVITI</span>
                    </div>
                </div>
            </div>

            <div class="footer">
                <img src="img/logomrshop.png">
            </div>


            <div class="end-footer">
                <span> Copyright 2024 Simmetry s.r.l. Tutti i diritti sono riservati. P.IVA 15307481000</span>
            </div>
        </footer>
    </body>

    </html>
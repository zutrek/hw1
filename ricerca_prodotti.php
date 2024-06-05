<?php

include 'gestione_registrazione.php';

$conn = mysqli_connect($host, $user, $password, $nome) or die(mysqli_error($conn));
$utente_loggato=false;

if($user_id = controllo_sessione()){
    $utente_loggato=true;
    
    $query = "SELECT * FROM utenti WHERE id = '$user_id' ";
    $result= mysqli_query($conn,$query);
    $info_utente= mysqli_fetch_assoc($result);
   
}

$categoria = $_GET['categoria'];
$search = $_GET['search'];


$query_prodotti = "SELECT * FROM prodotti WHERE 1=1";

if ($categoria !== 'tutte') {
    $query_prodotti .= " AND categoria = '" . mysqli_real_escape_string($conn, $categoria) . "'";
}

if (!empty($search)) {
    $query_prodotti .= " AND (nome LIKE '%" . mysqli_real_escape_string($conn, $search) . "%' )";
}

$result_prodotti = mysqli_query($conn, $query_prodotti);

if (!$result_prodotti) {
    echo "Errore nella query: " . mysqli_error($conn);
    exit;
}
?>




<html>
    <head>
        <title>MrShopKing</title>
        <link rel="stylesheet" href="ricerca_prodotti.css" />
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
        <script src="ricerca_prodotti.js" defer></script>
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

                <form id="searchbar" action="#" method="GET">
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

                    <div id="modale" class="hidden">
                        <div id="modale-content">
                            <span id="close">&times;</span>
                            <h2>Il tuo carrello</h2>
                            
                        </div>
                    </div>

                    <div id="modale" class="hidden">
                        <div id="modale-content">
                            <span id="close">&times;</span>
                            <h2>Il tuo carrello</h2>
                            
                        </div>
                    </div>



                    <div id="email"  <?php if($utente_loggato){echo 'onclick="window.location.href=\'logout.php\'"';} ?>>
                        <div>
                            <img src="img/icona-email.png">
                        </div>

                        <span>
                        <?php if($utente_loggato){ echo "Logout";} else echo "Email" ?>
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
        </header>

        <main>
            <div id="contenitore-prodotti">
                <?php
                     if (mysqli_num_rows($result) > 0){

                        while ($prodotto = mysqli_fetch_assoc($result_prodotti)){
                        echo '<div class="prodotto">';
                        echo '<img src="' . $prodotto['img'] . '">';
                        echo '<p>' . $prodotto['marca'] . " " . $prodotto['nome'] . '</p>';
                        echo '<p class="prezzo">' . $prodotto['prezzo'] . '€</p>';

                        echo '<button class="carrello_btn hidden">';
                        echo '+CARRELLO';
                        echo '</button>';

                        echo '<p class="hidden id_prod">' . $prodotto['id'] . '</p>';
                        echo '</div>';
                        }
                    }
                    else echo '<div id="errore"> Nssun risultato corrispondente alla ricerca </div>' ; 



                ?>

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
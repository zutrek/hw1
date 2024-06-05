<?php
require_once "gestione_registrazione.php";

if(controllo_sessione()){
    header("Location: index.php");
        exit;
}

if (!empty($_POST["username"]) && !empty($_POST["password"]) && !empty($_POST["nome"]) && !empty($_POST["cognome"]) )
    {
        $error = array();
        $conn = mysqli_connect($host, $user, $password, $nome) or die(mysqli_error($conn));


        //controllo nome
        $name= mysqli_real_escape_string($conn, strtolower($_POST['nome']));
        $cognome= mysqli_real_escape_string($conn, strtolower($_POST['cognome']));
        $result= mysqli_query($conn, "SELECT id FROM utenti WHERE  nome='$name' AND cognome='$cognome' ");
        if(mysqli_num_rows($result)>0)
        {
            $error[]="Utente già registrato";
        }

        //controllo password
        if (strlen($_POST["password"]) < 10) 
        {
            $error[] = "Caratteri password insufficienti";
        } 

        if(!preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{10,}$/', $_POST["password"]))
        {
            $error[]="La password deve contenere almeno un numero, una lettera maiuscola e una minuscola";
        }

        //controllo email
        if (!filter_var($_POST['username'], FILTER_VALIDATE_EMAIL)) 
        {
            $error[] = "Email non valida";
        } 
        
        else    
        {
            $email = mysqli_real_escape_string($conn, strtolower($_POST['username']));
            $result = mysqli_query($conn, "SELECT email FROM utenti WHERE email = '$email'");
            if (mysqli_num_rows($result) > 0) {
                $error[] = "Email già utilizzata";
                }
        }


        if (count($error) == 0) 
        {
            
    
            $password = mysqli_real_escape_string($conn, $_POST['password']);
            $password = password_hash($password, PASSWORD_BCRYPT);
    
            $query = "INSERT INTO utenti(nome, cognome, email, password) VALUES('$name','$cognome', '$email','$password')";
            
            if (mysqli_query($conn, $query)) 
            {   $result=mysqli_query($conn,"SELECT id FROM utenti where email='$email' ");
                $id_row= mysqli_fetch_row($result);
                $id=$id_row[0];
                $query="INSERT INTO carrelli(id_utente) VALUES ('$id')";
                if(mysqli_query($conn,$query)){
                    mysqli_close($conn);
                    header("Location: accesso.php");
                    exit;
                } 
                else{$error[]="Errore: email non trovata";}
            }

            else 
            {
                $error[] = "Errore di connessione al Database";
            }
        }
    
        mysqli_close($conn);
    }
else if (isset($_POST["username"])) 
{
    $error = array("Riempi tutti i campi");
}



?>














<html>
    <head>
        <title>MrShopKing</title>
        <link rel="stylesheet" href="registrazione.css" />
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
        <script src="registrazionee.js" defer> </script>
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

                <form id="searchbar" action="http://localhost/homework1/ricerca_prodotti.php" method="GET">
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
                    <div id="accesso">
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

                        <span>
                            Carrello
                        </span>

                    </div>


                    <div id="email">
                        <div>
                            <img src="img/icona-email.png">
                        </div>

                        <span>
                            Email
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
                        OFFERTA SPECIALE !
                    </span>

                </div>
            </div>

           
        </header>

        

        <div class="login">
            <div id="titolo">Crea un account</div>
            
            <div class="login_box">
                <form name="registrazione" method="post" enctype="multipart/form-data" autocomplete="off">

                    <div class="nome">
                        <label for="nome"> Nome: </label>
                        <input type="text"  name="nome" <?php if(isset($_POST["nome"])){echo "value=".$_POST["nome"];} ?> >
                        <div><span>Inseririsci il tuo nome</span></div>
                    </div>

                    <div class="cognome">
                        <label for="cognome" > Cognome: </label>
                        <input type="text"  name="cognome" <?php if(isset($_POST["cognome"])){echo "value=".$_POST["cognome"];} ?>>
                        <div><span>Inseririsci il tuo cognome</span></div>
                    </div>

                    <div class="email">
                        <label for="username" >Email:</label>
                        <input type="text" name="username" <?php if(isset($_POST["username"])){echo "value=".$_POST["username"];} ?>>
                        <div><span>Indirizzo email non valido</span></div>
                    </div>

                
                    
                    <div class="password" >
                        <label for="password" >Password:</label>
                        <input type="password" name="password" <?php if(isset($_POST["password"])){echo "value=".$_POST["password"];} ?>>
                        <button type="button" id="mostra_pass">MOSTRA</button>
                        <div><span>Inserisci almeno 8 caratteri</span></div>
                    </div>

                    <?php if(isset($error)) {
                    foreach($error as $err) {
                        echo "<div class='errorj'><span>".$err."</span></div>";
                    }
                    } 
                    ?>
                    

                    

                    <button type="submit" id="reg_button">REGISTRATI</button>

                </form>
                <a href="accesso.php" id="registrazione">Hai gia un account? Accedi ora!<a> 
            </div>
        </div>
        
         
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
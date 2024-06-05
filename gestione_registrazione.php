<?php
 require_once "config_db.php";

 session_start();
 
 function controllo_sessione(){
    if(isset($_SESSION['id_utente'])) {
        return $_SESSION['id_utente'];
    } else 
        return 0;
 }
 
 
 
 ?>
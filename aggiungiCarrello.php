<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include 'gestione_registrazione.php';


if($user_id = controllo_sessione()){
    if(isset($_GET['id_prodotto'])){

        $conn = mysqli_connect($host, $user, $password, $nome) or die(mysqli_error($conn));    
        $id_prodotto = $_GET["id_prodotto"];
    
        $query= "SELECT id FROM carrelli WHERE id_utente= '$user_id' ";
    
        $result=mysqli_query($conn,$query);
        $id= mysqli_fetch_row($result);
        $id_carrello=$id[0];
    
        $product_exists_query = "SELECT * FROM prodotti WHERE id = '$id_prodotto'";
        $product_result = mysqli_query($conn, $product_exists_query);

        if (mysqli_num_rows($product_result) > 0) { 
            $query = "INSERT INTO prodotti_carrello (id_carrello, id_prodotto) VALUES ('$id_carrello', '$id_prodotto')";

            if (mysqli_query($conn, $query)) {
                
                $response="Aggiunto al carrello";
            }   
            else {
            $response ="Prodotto non esistente";
            }
    
        }
        else{ 
        $response="prodotto non esistente";
        }
        mysqli_close($conn);
    }
    else $response="errore nella richiesta fetch";
}
else {
   $response="utente non loggato";
    
}


echo json_encode($response);


?>
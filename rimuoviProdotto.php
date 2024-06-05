<?php

include 'gestione_registrazione.php';

header('Content-Type: application/json');

$response = array('id' => '', 'message' => '');


if($user_id = controllo_sessione()) {
    if(isset($_GET['id'])) {
        $conn = mysqli_connect($host, $user, $password, $nome) or die(mysqli_error($conn));

        $id_prodotto = mysqli_escape_string($conn, $_GET['id']);
        
        
        $query = "SELECT id FROM carrelli WHERE id_utente = '$user_id' ";
        $result = mysqli_query($conn, $query);
        $carrello = mysqli_fetch_assoc($result);
        
        if($carrello) {
            $id_carrello = $carrello['id'];
            
            $delete_query = "DELETE FROM prodotti_carrello WHERE id_carrello = '$id_carrello' AND id_prodotto = '$id_prodotto'";
            if(mysqli_query($conn, $delete_query)) {
                
                $response['message']= 'Prodotto rimosso dal carrello';
                $response['id']= $id_prodotto;
            } else {
                $response['message'] = 'Errore durante la rimozione del prodotto';
            }
        } else {
            $response['message']= 'Carrello non trovato';
        }

        mysqli_free_result($result);
        mysqli_close($conn);
    } else {
        $response['message'] = 'ID prodotto non fornito';
    }
} else {
    $response['message'] = 'Utente non loggato';
}

echo json_encode($response);
?>

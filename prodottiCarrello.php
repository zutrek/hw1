<?php

include 'gestione_registrazione.php';

header('Content-Type: application/json');

if($user_id=controllo_sessione()){
    $conn = mysqli_connect($host, $user, $password, $nome) or die(mysqli_error($conn));

    $query = "SELECT p.id,categoria,marca,nome,memoria,colore,prezzo,img FROM (carrelli JOIN prodotti_carrello ON id=id_carrello) JOIN prodotti p ON id_prodotto=p.id WHERE id_utente='$user_id' ";
    $risultato = mysqli_query($conn, $query);

    if(mysqli_num_rows($risultato)>0){

        // Crea l'array dei prodotti
        $prodottiArray = array();
            while($prodotto = mysqli_fetch_assoc($risultato)) {
                $prodottiArray[] = array('id' => $prodotto['id'],
                            'categoria' => $prodotto['categoria'], 
                            'marca' => $prodotto['marca'],
                            'nome' => $prodotto['nome'],
                            'memoria' => $prodotto['memoria'],
                            'colore' => $prodotto['colore'],
                            'prezzo' => $prodotto['prezzo'],
                            'img'=> $prodotto['img']
                          );
            }

        echo json_encode($prodottiArray);
    } 
    else{
        echo json_encode("Il tuo carrello è vuoto!");
    }
    



mysqli_free_result($risultato);
mysqli_close($conn);
}else{
    echo json_encode("effettua prima l'accesso!");
}
exit;

?>
<?php

include 'gestione_registrazione.php';

header('Content-Type: application/json');
$conn = mysqli_connect($host, $user, $password, $nome) or die(mysqli_error($conn));

    $query = "SELECT * FROM prodotti LIMIT 10 ";
    $risultato = mysqli_query($conn, $query);

    

// Crea l'array dei prodotti
$prodottiArray = array();
    while($prodotto = mysqli_fetch_assoc($risultato)) {
        $prodottiArray[] = array('id' => $prodotto['id'],
                            'categoria' => $prodotto['categoria'], 
                            'marca' => $prodotto['marca'],
                            'nome' => $prodotto['nome'],
                            'memoria' => $prodotto['memoria'],
                            'colore' => $prodotto['colore'],
                            'prezzo' => $prodotto['prezzo']
                          );
    }

    echo json_encode($prodottiArray);
    
   
 exit;


mysqli_free_result($risultato);
mysqli_close($connessione);



?>
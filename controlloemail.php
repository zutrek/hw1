<?php
    require_once 'config_db.php';

    if (!isset($_GET["q"])) {
        echo "Non dovresti essere qui";
        exit;
    }

    header('Content-Type: application/json');

    $conn = mysqli_connect($host, $user, $password, $nome);

    $email = mysqli_real_escape_string($conn, $_GET["q"]);

    $query = "SELECT email FROM utenti WHERE email = '$email'";

    $result = mysqli_query($conn, $query) or die(mysqli_error($conn));

    echo json_encode(array('exists' => mysqli_num_rows($result) > 0 ? true : false));

    mysqli_close($conn);
?>
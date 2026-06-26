<?php
require_once('../includes/check-session.php');
require_once('../db/connex.php');

// Vérifie si la page est appelée par le formulaire
if($_SERVER['REQUEST_METHOD'] != 'POST'){

    // Redirige vers la page d'accueil
    header('Location: ../index.php');

    // Arrête l'exécution du script
    exit;
}

// Récupère l'utilisateur connecté
$user_id = $_SESSION['user_id'];

// Sécurise les données reçues du formulaire
foreach($_POST as $key => $value){
    $$key = mysqli_real_escape_string($connex, $value);
}

// Requête SQL qui supprime seulement l'article de l'utilisateur connecté
$sql = "DELETE FROM forum
        WHERE id = '$id' AND user_id = '$user_id'";

// Exécute la requête SQL
if(mysqli_query($connex, $sql)){
    header('Location: ../index.php');
    exit;
}else{
    echo mysqli_error($connex);
}
?>
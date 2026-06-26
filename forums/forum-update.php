<?php
require_once('../includes/check-session.php');
require_once('../db/connex.php');

// Vérifie si la mise à jour a été soumise
if($_SERVER['REQUEST_METHOD'] != "POST"){
     header('Location: ../index.php');
     exit;
}

// Récupère le user_id de l'utilisateur connecté
$user_id = $_SESSION['user_id'];

// Sécurisation des données du formulaire
foreach($_POST as $key => $value){
    $$key = mysqli_real_escape_string($connex, $value);
}

// Requête SQL pour mettre à jour l'article avec le bon user_id
$sql = "UPDATE forum
        SET title = '$title', article = '$article'
        WHERE id = '$id' AND user_id = '$user_id'";

// Vérifie si la requête SQL a bien fonctionné
if(mysqli_query($connex, $sql)){

    // Redirige vers l'article modifié
    header('Location: forum-show.php?id='.$id);
    exit;
}else{
    echo mysqli_error($connex);
}
?>

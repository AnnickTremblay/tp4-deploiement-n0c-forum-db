<?php
require_once('../includes/check-session.php');
require_once('../db/connex.php');

// Vérifie si l'article a bien été envoyé
if($_SERVER['REQUEST_METHOD'] != 'POST'){
    header('Location: ../index.php');
    exit;
}

// Récupère le user_id connecté
$user_id = $_SESSION['user_id'];

// Sécurisation des données du formulaire
foreach($_POST as $key => $value){
    $$key = mysqli_real_escape_string($connex, $value);
}

// Requête SQL pour insérer un nouvel article dans la base de données
$sql = "INSERT INTO forum (title, article, date, user_id)
        VALUES ('$title', '$article', NOW(), '$user_id')";

// Vérifie si la requête SQL a fonctionné
if(mysqli_query($connex, $sql)){

    // Récupère l'id du nouvel article
    $id = mysqli_insert_id($connex);

    // Redirige vers l'article créé
    header('Location: forum-show.php?id=' . $id);
    exit;
}else{
    echo mysqli_error($connex);
}
?>
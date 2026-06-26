<?php
// Vérifie si le formulaire a été envoyé avec la méthode POST
if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    header('Location: ../index.php');
    exit;
}

// Connexion à la base de données
require_once('../db/connex.php');

// Récupère et sécurise les données reçues du formulaire
$name = mysqli_real_escape_string($connex, $_POST['name']);
$username = mysqli_real_escape_string($connex, $_POST['username']);
$password = mysqli_real_escape_string($connex, $_POST['password']);
$birthday = mysqli_real_escape_string($connex, $_POST['birthday']);

// Crypte le mot de passe avant de l'enregistrer dans la base de données
$password_hash = password_hash($password, PASSWORD_DEFAULT);

// Requête SQL pour insérer le nouvel utilisateur
$sql = "INSERT INTO user (name, username, password, birthday)
        VALUES ('$name', '$username', '$password_hash', '$birthday')";

// Exécute la requête
if (mysqli_query($connex, $sql)) {

    // Redirige vers la page d'accueil si l'inscription fonctionne
    header('Location: ../index.php');
    exit;
} else {
    
    // Affiche l'erreur SQL si l'insertion échoue
    echo "Erreur : " . mysqli_error($connex);
}
?>
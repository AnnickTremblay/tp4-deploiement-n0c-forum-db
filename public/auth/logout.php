<?php
session_start();

// Détruit la session
session_destroy();

// Redirige vers la page d'accueil
header('location: ../index.php');

// Arrête le script après la redirection
exit;

?>
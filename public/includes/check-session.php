<?php
session_start();

// Vérifie si l'empreinte de session existe et qu'elle correspond au même utilisateur
if(!isset($_SESSION['fingerPrint']) || $_SESSION['fingerPrint'] !== md5($_SERVER['HTTP_USER_AGENT'].$_SERVER['REMOTE_ADDR'])){

    // Redirige vers la page de connexion
    header('Location: ../auth/login.php');
    exit();
}
?>
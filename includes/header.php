<?php
// Démarre la session si il n'y en a aucune d'active
if(session_status() === PHP_SESSION_NONE){
    session_start();
}

$isAuthenticated = false;

// Si la session d'active est associé avec un user_id
if(isset($_SESSION['user_id'])){
    $isAuthenticated = true;
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <title><?= $title; ?></title>
</head>
<body>
    <header>
        <nav aria-label="Menu principal">
            <ul>

            <!-- Affiche le menu privé si l'utisateur est authentifié  -->
            <?php if($isAuthenticated){ ?>
                <li>
                    <a class="site-header__link" href="/index.php">Accueil</a>
                </li>
                <li>
                    <a class="site-header__link" href="/forums/forum-create.php">Nouvel article</a>
                </li>
                <li>
                    <a class="site-header__link" href="/auth/logout.php">Déconnexion</a>
                </li>

            <!-- Affiche le menu public si aucun utisateur n'est authentifié  -->
            <?php }else{ ?>
                <li>
                    <a class="site-header__link" href="/index.php">Accueil</a>
                </li>
                <li>
                    <a class="site-header__link" href="/users/user-create.php">Créer un compte</a>
                </li>
                <li>
                    <a class="site-header__link" href="/auth/login.php">Se connecter</a>
                </li>
            <?php } ?>
            </ul>
        </nav>
    </header>

    <main>
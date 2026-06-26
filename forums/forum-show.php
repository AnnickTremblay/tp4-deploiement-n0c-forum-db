<?php

// Connexion à la base de données
require_once('../db/connex.php');

// Vérifie si un id de l'article est reçu dans l'adresse url
if(isset($_GET['id']) && $_GET['id'] != null){

    // Sécurisation de l'id reçu
    $id = mysqli_real_escape_string($connex, $_GET['id']);

    // Requête SQL pour récupérer l'article et le nom de l'utilisateur associé
    $sql = "SELECT forum.*, user.name
            FROM forum
            INNER JOIN user ON forum.user_id = user.id
            WHERE forum.id = '$id'";

    $result = mysqli_query($connex, $sql);
    $count = mysqli_num_rows($result);

    // Vérifie si l'article récupéré existe
    if($count === 1){
        $forum = mysqli_fetch_array($result, MYSQLI_ASSOC);
    }else{
        header('Location: ../index.php');
        exit;
    }

}else{
    header('Location: ../index.php');
    exit;
}
?>

<?php

// Démarre la session si aucune n'est active
if(session_status() === PHP_SESSION_NONE){
    session_start();
}

$isAuthUser = false;

// Vérifie si l'utilisateur connecté est bien celui qui l'a écrit
if(isset($_SESSION['user_id']) && $_SESSION['user_id'] == $forum['user_id']){
    $isAuthUser = true;
}

$title = "Détail de l'article";
include_once('../includes/header.php');
?>

        <article class="forum-card forum-card--detail">
            <h1><?= $forum['title']; ?></h1>
            <div>
                <p><strong>Auteur :</strong> <?= $forum['name']; ?></p>
                <p><strong>Date :</strong> <?= $forum['date']; ?></p>
            </div>
            <p><?= $forum['article']; ?></p>
            <div>
                <a href="../index.php" class="btn">Retour</a>
                <?php if($isAuthUser){ ?>
                    <a href="forum-edit.php?id=<?= $forum['id']; ?>" class="btn">Modifier</a>
                <?php } ?>
            </div>
        </article>

<?php
include_once('../includes/footer.php');
?>

<?php
require_once('../includes/check-session.php');
require_once('../db/connex.php');

// Vérifie si un id est reçu dans l'URL
if(isset($_GET['id']) && $_GET['id'] != null){

    // Récupère l'id de l'article
    $id = mysqli_real_escape_string($connex, $_GET['id']);

    // Récupère l'utilisateur connecté
    $user_id = $_SESSION['user_id'];

    // Requête SQL qui récupère seulement l'article appartenant à l'utilisateur connecté
    $sql = "SELECT * FROM forum WHERE id = '$id' AND user_id = '$user_id'";

    // Exécute la requête SQL
    $result = mysqli_query($connex, $sql);

    // Compte le nombre d'articles trouvés
    $count = mysqli_num_rows($result);

    // Si un article est trouvé, récupère les informations reliés à celui-ci
    if($count === 1){
        $forum = mysqli_fetch_array($result, MYSQLI_ASSOC);

        // Transforme les données de l'article en variables
        foreach($forum as $key => $value){
            $$key = $value;
        }
    }else{

        // Redirige si l'article n'existe pas
        header('Location: ../index.php');
        exit;
    }

}else{

    // Redirige si aucun id n'est reçu
    header('Location: ../index.php');
    exit;
}

// Garde le titre de l'article avant de l'afficher dans la page
$forum_title = $title;
$title = "Modifier un article";

include_once('../includes/header.php');
?>

        <h1>Modifier un article</h1>

        <form class="form" action="forum-update.php" method="POST">
            <input type="hidden" name="id" value="<?= $id; ?>">

            <label for="title">Titre</label>
            <input type="text" id="title" name="title" value="<?= $forum_title; ?>" required maxlength="120">

            <label for="article">Article</label>
            <textarea id="article" name="article" required><?= $article; ?></textarea>
            <div class="forum-card__actions">
                <input class="btn" type="submit" value="Modifier">
                <button class="btn btn-danger" type="submit" form="delete-form">
                    Supprimer
                </button>
            </div>
        </form>


        <form id="delete-form" action="forum-delete.php" method="POST">
            <input type="hidden" name="id" value="<?= $id; ?>">
        </form>

<?php
include_once('../includes/footer.php');
?>

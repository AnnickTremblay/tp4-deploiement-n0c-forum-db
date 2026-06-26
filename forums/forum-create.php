<?php
require_once('../includes/check-session.php');

$title = "Nouvel article";
include_once('../includes/header.php');
?>

        <h1>Ajouter un nouvel article</h1>

        <form class="form" action="forum-store.php" method="POST">
            <label for="title">Titre</label>
            <input type="text" id="title" name="title" required maxlength="120">
            <label for="article">Article</label>
            <textarea id="article" name="article" required></textarea>

            <input class="btn" type="submit" value="Publier">
        </form>

<?php
include_once('../includes/footer.php');
?>
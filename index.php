<?php
require_once('db/connex.php');

// Requête SQL qui récupère les articles du forum et leur auteur
$sql = "SELECT forum.id, title, article, date, name
        FROM forum
        INNER JOIN user ON user_id = user.id
        ORDER BY date DESC;";

// Exécute la requête
$forums = mysqli_query($connex, $sql);

?>

<?php
$title = "Forum étudiant";
include_once('includes/header.php');
?>
        <h1>Forum étudiant</h1>
        <section class="welcome">
            <h2>Bienvenue sur le forum de discussion étudiant du Collège Maisonneuve.</h2>
            <p> Ce forum est dédié aux étudiants afin de favoriser les échanges et la collaboration. Si tu as envie de poser des questions, de partager tes connaissances ou de discuter de sujets qui te parlent, n'hésite pas à participer!</p>
        </section>
        <section class="forum-list">
            <h2>Articles récents</h2>
            <?php foreach($forums as $forum){ ?>
            <article class="forum-card">
                <h4><?= $forum['title']; ?></h4>
                <div>
                    <p><strong>Auteur :</strong> <?= $forum['name']; ?></p>
                    <p><strong>Date :</strong> <?= $forum['date']; ?></p>
                </div>
                <p><?= $forum['article']; ?></p>
                <div>
                    <a href="forums/forum-show.php?id=<?= $forum['id']; ?>" class="btn">Lire</a>
                </div>
            </article>
            <?php } ?>
        </section>
<?php
include_once('includes/footer.php');
?>
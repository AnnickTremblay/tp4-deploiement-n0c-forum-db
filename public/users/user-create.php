<?php
$title="Registre utilisateur";
include_once('../includes/header.php');
?>
        <h1>Créer un nouvel utilisateur</h1>
        <form class="form" action="user-store.php" method="POST">
            <label for="name">Nom:</label>
            <input type="text" id="name" name="name" required maxlength="45" placeholder="Prénom Nom">
            <label for="username">Nom d'utilisateur:</label>
            <input type="email" id="username" name="username" required maxlength="100" placeholder="étudiant@cmaisonneuve.qc.ca">
            <label for="password">Mot de passe:</label>
            <input type="password" id="password" name="password" required minlength="6" maxlength="20" placeholder="Minimum 6 caractères" autocomplete="new-password">
            <label for="birthday">Date de naissance:</label>
            <input class="form__field--last" type="date" id="birthday" name="birthday" required>

            <input class="btn" type="submit" value="Créer mon compte">
        </form>
<?php
include_once('../includes/footer.php');
?>
<?php
$title = "Connexion";
include_once('../includes/header.php');
$msg = '';

// Vérifie si un messge d'erreur est reçu dans l'URL
if(isset($_GET['msg'])) {
    if($_GET['msg'] == 1) {
        $msg = "Veuillez entrer un nom d'utilisateur valide.";
    } elseif($_GET['msg'] == 2) {
        $msg = "Veuillez entrer un mot de passe valide.";
    }else{
        $msg = "Erreur";
    }
}
?>
        <h1>Connexion</h1>
        <form class="form" action="auth.php" method="POST">
            <span class="text-alert"><?= $msg; ?></span>
            <label for="username">Nom d'utilisateur</label>
            <input type="email" id="username" name="username" required maxlength="100" placeholder="étudiant@cmaisonneuve.qc.ca">
            <label for="password">Mot de passe</label>
            <input class="form__input--last" type="password" id="password" name="password" required minlength="6" maxlength="20">
            <input class="btn" type="submit" value="Se connecter" >
        </form>
<?php
include_once('../includes/footer.php');
?>
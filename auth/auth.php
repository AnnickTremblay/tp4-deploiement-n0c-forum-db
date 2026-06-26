<?php
// Connexion à la base de données
require_once('../db/connex.php');

// Vérifie si le formulaire est soumis
if($_SERVER['REQUEST_METHOD'] != 'POST'){
    header('Location: login.php');
    exit;
}

// Sécurisation des données
foreach($_POST as $key => $value){
    $$key = mysqli_real_escape_string($connex, $value);
}

// Requête pour rechercher l'utilisateur avec son courriel associé
$sql = "SELECT * FROM user WHERE username = '$username'";
$result = mysqli_query($connex, $sql);

// Comptage du nombre d'utilisateurs trouvés
$count = mysqli_num_rows($result);

// Si un seul utilisateur est associé au nom d'utilisateur
if($count === 1){

    // Transformation du résultat SQL en tableau associatif
    $user = mysqli_fetch_assoc($result);

    // Vérifie si le mot de passe correspond au même mot de passe chiffré de la base de données
    if(password_verify($password, $user['password'])){

        // Si le mot de passe est celui associé à l'utilisateur
        session_start();

        // Sauvegarde de l'utilisateur dans la session
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_name'] = $user['name'];

        // Création d'une empreinte pour sécuriser la session
        $_SESSION['fingerPrint'] = md5($_SERVER['HTTP_USER_AGENT'].$_SERVER['REMOTE_ADDR']);

        // Fonction header() qui redirige l'utilisateur après avoir été authentifié
        header('Location: ../index.php');
        // Arrêt de l'exécution du script
        exit;

    }else{
        // Si le mot de passe n'est pas valide
        header('Location: login.php?msg=2');
        exit;
    }

}else{
    // Si l'utilisateur recherché n'est pas dans la base de données
    header('Location: login.php?msg=1');
    exit;
}
?>

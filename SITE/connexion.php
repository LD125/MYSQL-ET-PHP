<?php
require_once('inc/init.php');

// traitement
if ( isset($_GET['action']) && $_GET['action'] == 'deconnexion' ){
    session_destroy();
}
if ( estConnecte() ){
    header('location:profil.php'); // renvoie  un entete au client pour demander la page profil
    exit(); // puis quitte le script
} 

if ( $_POST ) // if ( !empty($_POST) )
{

    $motdepassecrypte = md5($_POST['mdp']); // je crypte le mot de passe saisi pour le comparer à la version cryptée du mot de passe enregistré en base

    // requête de selection pour vérifier que le membre existe et qu'il a saisi correctement ses identifiants
$sql = "SELECT * FROM membre WHERE pseudo = :pseudo AND mdp = :mdp";
$resul = executeRequete( $sql, array( 'pseudo' => $_POST['pseudo'], 'mdp' => $motdepassecrypte));



    if( $resul->rowCount() == 1 ){
        
        //si j'ai un résultat égal à 1 c'est que j'ai trouvé un membre qui a ce login et ce mot de passe
        $membre = $resul->fetch(PDO::FETCH_ASSOC);
        $_SESSION['membre'] = $membre;

        header('location:profil.php');
        exit();
    }
    else{
        $contenu .='<div class="bg-danger">Erreur sur les identifiants</div>';
    }
}
require_once('inc/haut.php');
echo $contenu;

?>
<!-- créer le formulaire de connexion -->
<div class="row">
    <div class="col-md-4 col-md-offset-4 text-center">
        <form method="post" action="">
            <div class="form-group">
                <label for="pseudo">pseudo</label>
                <input type="text" class="form-control" id="pseudo" name="pseudo" placeholder="Enter pseudo">

            </div>

            <br>

            <div class="form-group">
                <label for="mdp"> Mot De Passe</label>
                <input type="password" class="form-control" id="mdp" name="mdp" placeholder="Enter password">
                <br>
            </div>

            <button type="submit" name="connexion">Se connecter</button>
            </form>
<?php

require_once('inc/bas.php');
<?php

require_once('inc/init.php');


// traitement
if ( isset($_GET['action']) && $_GET['action'] == 'deconnexion'){
    session_destroy();
}

if ( estConnecte() ){
    header('location:profil.php'); // renvoie un entete au client pour demander la page profil
    exit(); // puis quitte le script
}

if ( $_POST )  // if ( !empty($_POST) )
{

    $motdepassecrypte = md5($_POST['mdp']); // je crypte le mot de passe saisi pour le comparer à la version cryptée du mot de passe enregistré en base

    // requete de selection pour vérifier que le membre existe et qu'il a saisi correctement ses identifiants
    $sql = "SELECT * FROM membre WHERE pseudo = :pseudo AND mdp = :mdp";
    $resul = executeRequete( $sql, array( 'pseudo' => $_POST['pseudo'],
                                            'mdp'  => $motdepassecrypte
                                        ));

    if ( $resul->rowCount() == 1 ){
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

<!-- exercice créer le formulaire de connexion -->
<div class="row">
    <div class="col-md-6 col-md-offset-3 text-center">
    <h3>Veuillez renseigner vos identifiants :</h3>
        <form method="post" action="">
        <div class="row identif">
            <div class="col-md-4 text-right">
                <label for="pseudo">Pseudo</label>
            </div>                
            <div class="col-md-8">
                <input type="text" id="pseudo" name="pseudo" required size="15">
            </div>
        </div>
        <div class="row identif">
            <div class="col-md-4 text-right">
                <label for="mdp">Mot de passe</label>
            </div>
            <div class="col-md-8">
                <input type="password" id="mdp" name="mdp" required size="15">
            </div>
        </div>
        <div class="row identif">
            <div class="col-md-12 text-center">
                <input type="submit" value="Se connecter" class="btn btn-primary">
            </div>
        </div>    
        </form>
    </div>
</div>        
<?php

require_once('inc/bas.php');
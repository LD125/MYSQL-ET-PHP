<?php

require_once('inc/init.php');

$inscription = false; // inscription pas faite, je m'en sers pour afficher le formulaire

if ( $_POST ){

    // je poste mon formulaire d'inscription

    // controles sur les champs
    $champs_vides = 0;
    foreach ( $_POST as $indice => $valeur )
    {
        if ( empty($valeur) )
        {
            $champs_vides++;
        }
    }

    if ($champs_vides > 0 )
    {
        $contenu .= '<div class="alert alert-danger">Il y a '.$champs_vides.' information(s) manquante(s)</div>';
    }

    // verifier qu'une chaine contient des caractères autorisés

    $verif_caractere = preg_match('#^[a-zA-Z0-9._-]+$#',$_POST['pseudo']);
    $verif_codepostal = preg_match('#^[0-9]{5}$#',$_POST['code_postal']) ;

    // expression régulière
    /*
        - je délimite l'expression par le symbole # debut et fin
        - ^ signifie "commence par tout ce qui suit"
        - $ signifie "finit par tout ce qui précède"
        - [] pour délimiter les intervalles ( ici de a à z, de A à Z, de 0 à 9, et on ajoute ".", "_" ou "-")
        - le + pour dire que les caractères sont acceptés de 0 à x fois
    */


 

    // si tout va bien
    // je controle que le pseudo n'existe pas déjà dans la table
    // sinon j'invite l'internaute à changer de pseudo

    // Si tout va bien
    // j'insère le nouveau membre dans la table membre  (avec statut = 0)
    // je mets $inscription à true

}
require_once('inc/haut.php');
echo $contenu;
if ( !$inscription ) :
?>

<!-- formulaire d'inscription -->
<!-- champs : pseudo,mdp,prenom,nom,email,civilite,ville,code_postal,adresse -->

<div class="row">
    <div class="col-md-6 col-md-offset-3 text-center">
    <h3>Veuillez renseigner le formulaire pour vous inscrire :</h3>
        <form method="post" action="">
        <div class="row identif">
            <div class="col-md-4 text-right">
                <label for="pseudo">Pseudo</label>
            </div>                
            <div class="col-md-8">
                <input type="text" id="pseudo" name="pseudo" required size="15" value="<?= $_POST['pseudo'] ?? '' ?>">
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
            <div class="col-md-4 text-right">
                <label for="prenom">Prénom</label>
            </div>
            <div class="col-md-8">
                <input type="text" id="prenom" name="prenom" size="15"  value="<?= $_POST['prenom'] ?? '' ?>">
            </div>
        </div>

        <div class="row identif">
            <div class="col-md-4 text-right">
                <label for="nom">Nom</label>
            </div>
            <div class="col-md-8">
                <input type="text" id="nom" name="nom"  size="15"  value="<?= $_POST['nom'] ?? '' ?>">
            </div>
        </div>

        <div class="row identif">
            <div class="col-md-4 text-right">
                <label for="email">Email</label>
            </div>
            <div class="col-md-8">
                <input type="text" id="email" name="email" size="25"  value="<?= $_POST['email'] ?? '' ?>">
            </div>
        </div>

        <div class="row identif">
            <div class="col-md-4 text-right">
                <label>Civilité</label>
            </div>
            <div class="col-md-8">
                <input type="radio" value="m" name="civilite" <?= ( (isset($_POST['civilite']) && $_POST['civilite'] == 'm') || !isset($_POST['civilite']) ) ? 'checked' : '' ?>> Monsieur
                <input type="radio" value="f" name="civilite" <?= (isset($_POST['civilite']) && $_POST['civilite'] == 'f') ? 'checked' : '' ?>> Madame                
            </div>
        </div>

        <div class="row identif">
            <div class="col-md-4 text-right">
                <label for="ville">Ville</label>
            </div>
            <div class="col-md-8">
                <input type="text" id="ville" name="ville" size="15"  value="<?= $_POST['ville'] ?? '' ?>">
            </div>
        </div>

        <div class="row identif">
            <div class="col-md-4 text-right">
                <label for="code_postal">Code postal</label>
            </div>
            <div class="col-md-8">
                <input type="text" id="code_postal" name="code_postal" size="5"  value="<?= $_POST['code_postal'] ?? '' ?>">
            </div>
        </div>

        <div class="row identif">
            <div class="col-md-4 text-right">
                <label for="adresse">Adresse</label>
            </div>
            <div class="col-md-8">
                <textarea name="adresse" id="adresse" cols="35" rows="4"><?= $_POST['adresse'] ?? '' ?></textarea>
            </div>
        </div>


        <div class="row identif">
            <div class="col-md-12 text-center">
                <input type="submit" value="S'inscrire" class="btn btn-primary">
            </div>
        </div>    
        </form>
    </div>
</div>  

<?php
endif;

require_once('inc/bas.php');
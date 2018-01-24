<?php

require_once('inc/init.php');

$inscription = false; // inscription pas faite, je m'en sers pour afficher le formulaire

if ( $_POST){

    // je poste mon formulaire d'inscription
    $champs_vides = 0;
    foreach ( $_POST as $indice => $valeur )
    {
        if ( empty($valeur) )
        {
            $champs_vide++;
        }
    }

    if ($champs_vides > 0)
    {
        $contenu .= '<div class="alert alert-danger">Il y a'.$champs_vides.' information(s) manquante(s)</div>';
    }

    // vérifier  qu'une chaine contient des caractères autorisés

    $verif_caractere = preg_match('#^[a-zA-Z0-9._-]+$#',$_POST['pseudo']);
    
    $verif_codepostal = preg_match('#^[0-9]{5}$#',$_POST['code_postal']);

    
    // epxression régulière
    /*
        - je délimite l'expression par le symbole # début et fin
        - ^ signifie "commence par tout ce qui suit"
        - $ signifie "finit par tout ce qui précède"
        - [] pour délimiter les intervalles ( ici de a à z, de A à Z, de 0 à 9, et on ajoute ".", "_" ou "-")
        - le + pour dire que les caractères sont acceptés de 0 à x fois 

    */

    // controles sur les champs

    // si tout va bien
    // je controle que le pseudo n'existe pas déjà dans la table
    // sinon j'invite l'internaute à changer de pseudo

    // Si tout va bien
    // J'insère le nouveau membre dans la table membre
    // je mets $inscription à true

}


require_once('inc/haut.php');
echo $contenu;

if ( !$inscription ):
?>

<!-- formulaire d'inscription -->
<!-- champs : pseudo,mdp,prenom,nom,email,civilite,ville,code_postal,adresse -->
<div class="row">
    <div class="col-md-6 col-md-offset-3 text-center">
    <h3> Veuillez vous inscrire</h3>
    <form action="" method="post">
        <div class="row identif">
            <div class="col-md-4 text-right">
                <label for="pseudo">Pseudo</label>
            </div>
        <div class="col-md-8">
            <input type="text" name="Pseudo" id="pseudo" value="<?= $_POST['pseudo'] ?? '' ?>">
            </div>
        </div>

        <div class="row identif">
            <div class="col-md-4 text-right">
                <label for="mdp">Mot de passe</label>
            </div>
        <div class="col-md-8">
            <input type="text" name="mdp" id="mdp" value="<?= $_POST['mdp'] ?? '' ?>">
            </div>
        </div>

        <div class="row identif">
            <div class="col-md-4 text-right">
                <label for="nom">nom</label>
            </div>
        <div class="col-md-8">
            <input type="text" name="nom" id="nom" value="<?= $_POST['nom'] ?? '' ?>">
            </div>
        </div>

        <div class="row identif">
            <div class="col-md-4 text-right">
                <label for="prenom">prenom</label>
            </div>
        <div class="col-md-8">
            <input type="text" name="prenom" id="prenom" value="<?= $_POST['prenom'] ?? '' ?>">
            </div>
        </div>

        <div class="row identif">
            <div class="col-md-4 text-right">
                <label for="email">Email</label>
            </div>
            <div class="col-md-8">
                <input type="text" name="email" id="email" value="<?= $_POST['email'] ?? '' ?>">
            </div>
        </div>


    </form>
    </div>
</div>











<form action="" method="post">
<pre>
<div class="form-group">
    <label for="pseudo">Pseudo</label>
    <input type="text" name="pseudo" id="pseudo">
    <label for="mdp">mdp</label>
    <input type="text" name="mdp" id="mdp">
    <label for="prenom">prenom</label>
    <input type="text" name="prenom" id="prenom">
    <label for="nom">nom</label>
    <input type="text" name="nom" id="nom">
</div>
<div class="form-group">
    <label for="email">email</label>
    <input type="email" name="email" id="email">
</div>
<div class="form-group">
    <label for="civilite">civilite</label>
    <label for="homme">Homme
    <input type="radio" name="homme" id="homme" value="femme">
    </label>
    <label for="femme">Femme
    <input type="radio" name="femme" id="femme" value="femme">
    </label>
</div>
<div class="form-group">
    <label for="ville">Ville</label>
    <input type="text" name="ville" id="ville">
</div>
<div class="form-group">
    <label for="code_postal">Code Postal</label>
    <input type="text" name="ville" id="ville">
</div>
<div class="form-group">
    <label for="adresse">adresse</label>
    <input type="text" name="adresse" id="adresse">
</div>
</pre>
</form>
<?php
endif;


require_once('inc/bas.php');
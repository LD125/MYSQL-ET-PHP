<?php

require_once('inc/init.php');
require_once('inc/haut.php');

// Génération des catégories pour alimenter le contenu gauche


// Génération du menu de catégorie

$categories = executeRequete("SELECT DISTINCT categorie FROM produit ORDER BY categorie");

$contenu_gauche .='<p class="lead">Catégories</p>
<div class="list-group">
<a href="?categorie=all" class="list-group-item">Toutes</a>';

while ( $cat = $categories->fetch(PDO::FETCH_ASSOC))
{
    $contenu_gauche .='<a href="?categorie='.$cat['categorie'].'"
    class="list-group-item">'.strtoupper($cat['categorie']).'</a>';
}

$contenu_gauche .= '</div>';




// Génération du menu des couleurs


$couleurs = executeRequete("SELECT DISTINCT couleur FROM produit ORDER BY couleur"); // filter by color

$contenu_gauche .='<p class="lead">Couleurs</p>
<div class="list-group">
<a href="?couleur=all" class="list-group-item">Toutes</a>';

while ( $color = $couleurs->fetch(PDO::FETCH_ASSOC) )
{
    $contenu_gauche .='<a href="?couleur='.$color['couleur'].'" class="list-group-item">'.ucfirst($color['couleur']).'</a>';
}

$contenu_gauche .= '</div>';






// Affichage des produits pour alimenter le contenu droit en tenant compte d'un eventuel choix de categorie

$complement_requete='';
$param=array();

if ( isset($_GET['categorie']) && $_GET['categorie'] != 'all')
{
    $complement_requete=" AND categorie=:categorie";
    $param = array('categorie' => $_GET['categorie']);
}

if ( isset($_GET['couleur']) && $_GET['couleur'] != 'all')
{
    $complement_requete=" AND couleur=:couleur";
    $param = array('couleur' => $_GET['couleur']);
}

// On a ajouté WHERE stock > 0 pour afficher uniquement les artciles disponnibles, j'adapte donc le complement requete en utilisant " AND " pour compléter la whereclause
$donnees = executeRequete("SELECT * FROM produit WHERE stock > 0".$complement_requete,$param);

//var_dump($donnees); 

while ( $produit = $donnees->fetch(PDO::FETCH_ASSOC))
{
    //var_dump($produit);
    //echo "<hr>";
    $contenu_droite .='<div class="col-sm-4 hauteur">
                            <div class="thumbnail">
                                <a href="fiche_produit.php?
                                id_produit='.$produit['id_produit'].'">
                                <img src="'.$produit['photo'].'"
                                class="img-responsive"></a>
                                <div class="caption">
                                    <h4 class"pull-right">'.$produit['prix'].'€</h4>
                                    <h4><a href="fiche_produit.php?">'.$produit['titre'].'</a></h4>
                                    <p>'.$produit['description'].'</p>
                                </div>
                            </div>
                       </div>';
}

?>
<div class="row">
    <div class="col-md-3">
        <?= $contenu_gauche ?>
    </div>
    <div class="col-md-9">
        <div class="row">
            <?= $contenu_droite ?>
        </div>
    </div>
</div>
<?php
require_once('inc/bas.php');
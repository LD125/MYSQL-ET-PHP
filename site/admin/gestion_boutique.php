<?php 

require_once('../inc/init.php');

if ( !estConnecteEtAdmin() )
{
    header('location:../connexion.php'); // si pas admin, ouste ! va voir la page connexion si j'y suis
    exit();
}
// suppression
if ( isset($_GET['action']) && $_GET['action']=='suppression' && isset($_GET['id_produit'])) /// selection de l'action
{
    $resul = executeRequete("SELECT photo FROM produit WHERE id_produit= :id_produit",array('id_produit' => $_GET['id_produit'])); // selection du fichier
    $photo_a_supprimer = $resul->fetch(PDO::FETCH_ASSOC);
    $chemin_photo = $_SERVER['DOCUMENT_ROOT'].$photo_a_supprimer['photo'];
    
    if( !empty($photo_a_supprimer['photo']) && file_exists($chemin_photo)){ // suppression 
        unlink($chemin_photo);
    }
    executeRequete("DELETE FROM produit WHERE id_produit=:id_produit",array('id_produit' => $_GET['id_produit']));
    $contenu .='<div class="alert alert-success">Le produit a été supprimé</div>';
    $_GET['action']='affichage';
}



// Onglets affichage ajout/modif
$contenu .='<ul class="nav nav-tabs">
                <li><a href="?action=affichage">Affichage des produits</a></li>
                <li><a href="?action=ajout">Ajouter un produit</a></li>
            </ul>';

//  Enregistrement du produit en BDD
if ( $_POST ){

    $photo_bdd='';
if ( isset($_POST['photo_actuelle']))
{
    $photo_bdd=$_POST['photo_actuelle'];
} 

if ( !empty($_FILES['photo']['name']))
{
    $nom_photo = $_POST['reference'].'-'.$_FILES['photo']['name'];
    $photo_bdd = RACINE_SITE.'photo/'.$nom_photo;
    $photo_dossier= $_SERVER['DOCUMENT_ROOT'].$photo_bdd;

    copy($_FILES['photo']['tmp_name'], $photo_dossier);
}

// On enregistre le produit dans la BDD
executeRequete("REPLACE INTO produit VALUES (:id_produit,:reference,:categorie,:titre,:description,:couleur,:taille,:public,:photo,:prix,:stock)",
array ( 'id_produit' => $_POST['id_produit'],
        'reference'  => $_POST['reference'],
        'categorie'  => $_POST['categorie'],
        'titre'      => $_POST['titre'],
        'description'=> $_POST['description'],
        'couleur'    => $_POST['couleur'],
        'taille'     => $_POST['taille'],
        'public'     => $_POST['public'],
        'photo'      => $photo_bdd,
        'prix'       => $_POST['prix'],
        'stock'      => $_POST['stock'],

));
$contenu .='<div class="alert alert-success">Le produit a été enregistré</div>';
$_GET['action'] = 'affichage';

}







if ((isset($_GET['action']) && $_GET['action']=='affichage') || !isset($_GET['action']))
{
    // Affichage des produits
    $resul = executeRequete("SELECT * FROM produit");
// entêtes//
$contenu .="<h3>Affichage des produits</h3>";
$contenu .="<p>Nombre de produits : ".$resul->rowCount();
$contenu .='<table class="table-striped">
                <tr>';
for( $i=0; $i<$resul->columnCount() ; $i++ )
{
    $colonne = $resul->getColumnMeta($i);
    $contenu .= '<th>'.ucfirst($colonne['name']).'</th>';
  
}
$contenu .= '<th colspan="2">Actions</th>';
$contenu .="</tr>";
// les données
while ( $ligne = $resul->fetch(PDO::FETCH_ASSOC) )
{
    $contenu .='<tr>';
    foreach($ligne as $indice => $information)
    {
        if ( ($indice=='photo') && $information != '')
        {
            $information = '<img class="img-thumbnail" src="'.$information.'" alt="'.$ligne['titre'].'">';
        }
        $contenu .='<td class="text-center">'.$information.'</td>';
    }
    $contenu .='<td><a href="?action=modifier&id_produit='.$ligne['id_produit'].$ligne['titre'].' ?\'))">Modifier</a></td>';
    $contenu .='<td><a href="?action=suppression&id_produit='.$ligne['id_produit'].'"onclick="return(confirm(\'Etes vous certain de vouloir supprimer ce produit : '.$ligne['titre'].' ?\'))">Supprimer</a></td>';
    $contenu .='</tr>';
}
    $contenu .= "</table>";

}
require_once('../inc/haut.php');
echo $contenu;


/* Affichage d'un formulaire : - vide si je faids "ajout */
/*                             - pré-rempli si je fais "modifier" sur un produit
                               - 
*/                            
if ( isset($_GET['action']) && ( $_GET['action']=='ajout' || $_GET['action']=='modifier') )
:
//if ( "j'ai une action définie" && ( elle vaut "ajout" OU elle vaut "modifier") )
    if (!empty($_GET['id_produit']))
    {
        $resul = executeRequete("SELECT * FROM produit WHERE id_produit=:id_produit",array('id_produit'=>$_GET['id_produit']));
        $produit_actuel=$resul->fetch(PDO::FETCH_ASSOC);
    }

?>
<h3> Formulaire d'ajout ou de modification d'un produit</h3>
<form method="post" action="" enctype="multipart/form-data" class="col-md-8">
    <input class="form-control" type="hidden" id="id_produit" name="id_produit" value="<?= $produit_actuel['id_produit'] ?? 0 ?>">

    <label for="reference">Reference</label>
    <input class="form-control" type="text" name="reference" id="reference" value="<?= $produit_actuel['reference'] ?? '' ?>">
    <br>

    <label for="categorie">Categorie</label>
    <input class="form-control" type="text" name="categorie" id="categorie" value="<?= $produit_actuel['categorie'] ?? '' ?>">
    <br>

    <label for="titre">Titre</label>
    <input class="form-control" type="text" name="titre" id="titre" value="<?= $produit_actuel['titre'] ?? '' ?>">
    <br>

    <label for="description">Description</label>
    <textarea name="description" id="description" cols="40" rows="3" value="<?= $produit_actuel['description'] ?? '' ?>"></textarea>
    <br>

    <label for="couleur">Couleur</label>
    <input class="form-control" type="text" name="couleur" id="couleur" value="<?= $produit_actuel['couleur'] ?? '' ?>">
    <br>

    <label for="taille">Taille</label>
    <select name="taille">
        <option <?= (isset($produit_actuel['taille']) && $produit_actuel['taille']=='S') ? 'selected' : ''?> value="S">S</option>
        <option <?= (isset($produit_actuel['taille']) && $produit_actuel['taille']=='M') ? 'selected' : ''?> value="M">M</option>
        <option <?= (isset($produit_actuel['taille']) && $produit_actuel['taille']=='L') ? 'selected' : ''?> value="L">L</option>
        <option <?= (isset($produit_actuel['taille']) && $produit_actuel['taille']=='XL') ? 'selected' : ''?> value="XL">XL</option>
    </select>
    <br>
    <!-- public : m,f mixte -->
    <label for="photo">Photo</label>
    <input type="file" name="photo" id="photo">
    <?php 
        if ( isset($produit_actuel['photo']))
        {
            echo '<p>Vous pouvez uploader une nouvelle photo </p>';
            echo '<img class="img-thumbnail" src="'.$produit_actuel['photo'].'" alt="'.$produit_actuel['titre'].'">';
            echo '<input type="hidden" name="photo_actuelle" value="'.$produit_actuel['photo'].'">';
            // cet input permet de remplir $_POST sur un indice "photo_actuelle" la valeur de l'url de la photo stockée en base. Ainsi, si on ne
            // charge pas de nouvelle photo, l'url actuelle sera remise en base
        }

    ?>

    <br>
    <label for="public">Public</label>
    <select name="public">
        <option <?= (isset($produit_actuel['taille']) && $produit_actuel['taille']=='m') ? 'selected' : ''?> value="m">m</option>
        <option <?= (isset($produit_actuel['taille']) && $produit_actuel['taille']=='f') ? 'selected' : ''?> value="f">f</option>
        <option <?= (isset($produit_actuel['taille']) && $produit_actuel['taille']=='mixte') ? 'selected' : ''?> value="mixte">mixte</option>
    </select>
    <br>

    <label for="prix">Prix</label>
    <input class="form-control" type="text" name="prix" id="prix" value="<?= $produit_actuel['prix'] ?? '' ?>">
    <br>

    <label for="stock">Stock</label>
    <input class="form-control" type="text" name="stock" id="stock" value="<?= $produit_actuel['stock'] ?? '' ?>">
    <br>


    <input type="submit" value="Valider" class="btn btn-primary">

</form>
<?php

endif;




require_once('../inc/bas.php');
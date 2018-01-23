<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PDO</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    

<?php

/////////////////////////////////////////////////// PDO : Php Data Object

echo "<h1>01 - PDO: Connexion</h1>";

$pdo = new PDO('mysql:host=localhost;dbname=entreprise',
                'root',
                '',
                array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING,
                PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'
            ));
echo "<h2>02 -PDO: Insert,Update,Delete</h2>";



 


/*
$pdo->exec("INSERT INTO employes VALUES (NULL,'test','test','M','commercial','2018-01-22',500)");
echo 'dernier id ajouté:'.$pdo->lastInsertID();
$dernier_id = $pdo->lastInsertID();

$pdo->exec("UPDATE employes SET salaire=1400 WHERE id_employes=".$dernier_id);*/







$pdo->exec("DELETE FROM employes WHERE id_employes=990");
echo $resul;  // vaut 1 au premier affichage, puis 0 si je rafraichis.
// $pdo->exec execute une requete direct (insert, update, delete)
// si je stocke l'execution dans une variable (ex : resul), il contiendra le nombre de lignes affectées par la requête.






echo "<h2>03 - PDO: Select</h2>";

$resul = $pdo->query("SELECT * FROM employes WHERE prenom='daniel'");

echo '<pre>';
var_dump($resul);
var_dump( get_class_methods($resul) );
echo '</pre>';

$employe_daniel = $resul->fetch(PDO::FETCH_ASSOC);
// var_dump($employe_daniel);
echo 'Bonjour, je suis '.$employe_daniel['prenom'].' '.$employe_daniel['nom'].' du service '.$employe_daniel['service'].'<br>';






/*
$pdo est un objet(1) issu de la classe prédéfinies PDO quand on exécute une requête de selection via la méthode query() sur l'objet PDO,
on obtient un autre objet(2) issu de la classe PDOStatement qui a ses propres propriétés et méthodes.
Si on exécute une requête de type insert, update, delete avec query() au lieu de exec(), on obtient un booleen.
*/






echo "<hr>";

////////////////////////////////////// select avec plusieurs résultats
$resul = $pdo->query("SELECT * FROM employes WHERE service='commercial'");

echo 'Nombre de commerciaux: '.$resul->rowCount().'<br>';

while( $contenu = $resul->fetch(PDO::FETCH_ASSOC) )
{
    echo $contenu['prenom'].' '.$contenu['nom'].'('.$contenu['sexe'].')
    <br>';
}

/////////////////////////////////////// select tableau multidimensionnel 

$resul = $pdo->query("SELECT * FROM employes WHERE service='commercial'");

$donnees = $resul->fetchAll(PDO::FETCH_ASSOC);
echo"<pre>";
//var_dump($donnees);
echo"</pre>";

foreach($donnees as $indice1 => $contenu1){

    echo "<div class='madiv'>";
    foreach($contenu1 as $indice2 => $contenu2){
        echo "$indice2 : $contenu2<br>";
    }
    echo "</div>";
}

///////////////////////////////////////////////////////////////////////////////////////////////////////////////

// exercice : Afficher la liste des bases de données dans une liste html
/* $liste = $pdo->query("SHOW DATABASES");

$dbliste = $liste->fetchAll(PDO::FETCH_ASSOC);
/*var_dump($dbliste); */

/*
foreach($dbliste as $indice3 => $contenu3){
    echo "<li>";
    foreach($contenu3 as $indice4 => $contenu4 ){
        echo "$contenu4.<br>";
    }
    echo "</li>";
}
*/
$resul = $pdo->query("SHOW DATABASES");

echo "<ul>";
while ( $base = $resul->fetch(PDO::FETCH_ASSOC) ){
    echo "<li>".$base['Database']."</li>";
}
echo "</ul>";

// Version Bonus 
$resul = $pdo->query("SHOW DATABASES");

echo "<ul>";
while ( $base = $resul->fetch(PDO::FETCH_ASSOC) ){

    $database = $base['Database'];
    echo "<li>".$database."<ul>";
        $pdo->exec("USE ".$database);
        $resul2 = $pdo->query("SHOW TABLES");
        while ( $table = $resul2->fetch(PDO::FETCH_ASSOC) )
        {
            // ex : Tables_in_Bibliotheque
            echo "<li>".$table['Tables_in_'.$database]."</li>";
        }
        echo "</ul></li>";
}
echo "</ul>";





////////////////////////////////////////////////////////////////////////////////////






// Parcours de table

$pdo->exec('USE bibliotheque');

$nomtable="livre";

$resul = $pdo->query("SELECT * FROM ".$nomtable);

echo "<table><tr>";
// Générer les entêtes de colonnes
$nbcolonnes = $resul->columnCount();
for ( $i=0; $i < $nbcolonnes; $i++){
    $infoscolonne = $resul->getColumnMeta($i);
    echo '<th>'.$infoscolonne['name'].'</th>';
}
echo "</tr>";

// parcours des enregistrements
while ($ligne = $resul->fetch(PDO::FETCH_ASSOC))
{
    echo "<tr>";
        foreach($ligne as $information){
            echo "<td>$information</td>";
        }
    echo "</tr>";
}

echo "</table>";




////////////////////////////////////////////////////////////////////////////////////////////////




// Parcours de table

$pdo->exec('USE entreprise');

$nomtable="employes";

$resul = $pdo->query("SELECT * FROM ".$nomtable);

echo "<table><tr>";
// Générer les entêtes de colonnes
$nbcolonnes = $resul->columnCount(); // -> renvoie le nombres de colonnes grâce à columnCount()
for ( $i=0; $i < $nbcolonnes; $i++){
    $infoscolonne = $resul->getColumnMeta($i);
    echo '<th>'.$infoscolonne['name'].'</th>'; // getColumnMeta(index) envoie les informations d'une colonne
    // comme son type, son nom, sa longueur. Dans notre exemple c'est l'index "name" qui nous intéresse
}
echo "</tr>";

// parcours des enregistrements
while ($ligne = $resul->fetch(PDO::FETCH_ASSOC))
{
    echo "<tr>";
        foreach($ligne as $information){
            echo "<td>$information</td>";
        }
    echo "</tr>";
}

echo "</table>";


///////////////////////////////////////////////////////////////////////////////////////////////////////////




echo "<h2>PDO : prepare, bindParam, bindValue, execute</h2>";

// bindValue

$pdo->exec('USE entreprise');
$nom = 'sennard';

$resul = $pdo->prepare("SELECT * FROM employes WHERE nom = :nom");
$resul->bindParam(':nom',$nom,PDO::PARAM_STR); // bindParam reçoit exclusivement une variable
$resul->execute();
$donnees = $resul->fetch(PDO::FETCH_ASSOC);
echo implode(' ',$donnees); // transformation du tableau en ligne avec un séparateur. 

// bindvalue

$nom = 'thoyer';

$resul = $pdo->prepare("SELECT * FROM employes WHERE nom = :nom");
$resul->bindValue(':nom',$nom,PDO::PARAM_STR); // bindvalue reçoit exclusivement une variable ou une chaine de caractères
$resul->execute();
$donnees = $resul->fetch(PDO::FETCH_ASSOC);

echo implode(' ',$donnees); 

?>

</body>
</html>
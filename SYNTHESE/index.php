<?php

// Synthèse
// variables affectation
$variable1 = 5;
$varuable2 = "chaine";

//constante
define('CONSTANTE','42');

// tableau
$tab = array();
$tab[] =1;
$tab[] =2;
echo $tab[0]; //1
echo $tab[1]; // 2
$tab['toto'] = 'titi';
echo $tab['toto']; // titi


// boulces

$i=0;
while ( $i < 10) { // condition d'arrêt
    echo $i;
    $i++; // incrémentation
}

for ($i=0; $i < 10 ; $i++){ // init; // condition d'arrêt ; // incrémentation
    echo $i;
}

foreach ( $tab as $index => $value )
{
    // je parcoure le tableau, j'ai le nom de l'indice et sa valeur

}

// Fonctions
// Permet de répeter une série d'instructions en appelant une fonction
function mise_au_carre($nombre){
    return $nombre*$nombre;
}

echo mise_au_carre(4); // 16

function addition($a,$b=10)
{
    return $a+$b;
}
echo addition(2,3); //5
echo addition(7); //17

// objets
// ex : PDO
// Autre exemple DateTime
$madate = new DateTime;

echo $madate->format('Y-m-d H:i:s');

$madate2 = new DateTime('2018-01-31 15:42:23');

$madate3 = new DateTime;
$madate3->setTimestamp(mktime(15,42,23,1,31,2018));
echo $madate3->format('d/m/Y');

//Inclusion de fichier
require_once('autrefichier.php');

// Connaitre le type d'une variable
echo gettype($variable1); // integer

//Concatenation

echo 'le début d\'une chaine'.$variable1.' et la fin de la chaine';
echo "une chaine avec la variable $vairable1 interpréter entre guillemets";
echo " une chaine ".$variable2." aussi concaténée";

//SQL
$options = array( PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING, PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8');

$db = new PDO('mysql:host=localhost;dbname=bibliotheque','root','',$options);

$db->exec("INSERT INTO ...");
$db->exec("UPDATE ...");
$db->exec("DELETE ...");

$resul = $db->query("SELECT ...");
// pour 1 resultat
$ligne = $resul->fetch(PDO::FETCH_ASSOC);
//pour plusieur résultats
while ( $ligne = $resul ->fetch(PDO::FETCH_ASSOC) )
{
    echo $ligne['colonne'];
}

//requete avec préparation/execution
$valeur = 'valeur';
$db->prepare("SELECT .....:param....");
$db->execute(array('param' => $valeur));

$db->query("INSERT INTO...");
$var3 = $db->lastInsertID(); // renvoie le dernier id inséré

// Super Globales

$_POST ;// Tableau qui contient les names des input/select/radio d'un formulaire associés à leur valeurs
       // si la methode d'envoie du formulaire est POST 
      // form method=post

$_GET ;// Tableau qui contient les entrées dans l'url qui suivent le "?"
      // ex: index.php?action=modifier&id_produit=5
     // on aura $_GET['action'] qui vaut "modifier"
    // et $_GET['id_produit] qui vaut 5


$_FILES; // Tableau qui contient les infos des fichiers uploaded sur un formulaire
        //  <form method="post" action="" enctype="multipart/form-data">
        
$_SESSION;
$_COOKIE; //etc...        
/// pour $_SESSION je dois avoir initialisé la session avec session_start()
// cela crée un cookie PHPSESSID pour relier un fichier de session stocké sur le serveur dans le répertoire /tmp

// $_COOKIE est un tableau stocké coté client dans ses cookies de son navigateur.


// Conditions

if( condition ){

}
else
{

}

// autre forme
if ( condition ):

else :

endif;

//switch
switch ( $chiffre )
{
    //case 1 : ...; break;
    //case 2 : ...; break;
   // default: ...; break;
}


/// Comparaisons 
empty($var) ; // renvoie vrai si $var n'est pas définie, est vide, ou vaut 0
isset($var); // renvoie vrai si $var est définie quelque soit sa valeur


// suppression d'un ficier
unlink('fichier.txt');
//suppression d'une variable 
unset($var);
//suppression d'une session
session_destroy();

// nombre aléatoire
srand(); // initialisation du générateur de nombres aléatoires
$nb = rand(1,10);

// redirection
//header(location:url);
// ne fonctionne que si je n'ai eu AUCUNE instruction echo avant
// ni balises html

// encryptage

md5($password); // encrypte en md5 (32 caractères)
sha1($password); // encrypte en SHA1 Secure Hash Algorithm 1 (40 chars)


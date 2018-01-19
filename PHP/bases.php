<!DOCTYPE html>
<html>
    <meta charset="utf-8">
    <title>Bases du PHP </title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<h2>Bases du PHP</h2>
<?php
// ceci est un commentaire  PHP sur une ligne
/*
ceci est un commentaire PHP sur plusieurs lignes
*/ 

echo '<strong>Bonjour le monde</strong><br>'; // echo est une instruction qui nous permet d'effectuer un affichage

print 'nous sommme jeudi';

echo "<hr><h2>Variable : type , déclaration,affectation </h2>";

$a=127;
echo ' a est de type ';
echo gettype($a); //gettype() est une fonction php qui renvoit le type de la variable entre les parenthèses

$b='bonjour';
echo '<br> b est de type ';
echo gettype($b);

$c= true;
echo '<br> c est de type ';
echo gettype($c);

echo '<br> a vaut $a <br>';
echo "a vaut $a <br>"; // entre guillemets les variables sont interprêtées 

echo"<br><h2>Concaténation</h2>";
echo'a est de type ' .gettype($a);
echo '<br>a vaut ' . $a .'<br>';

echo '<input type="text" name="nom">';
echo '<br>aujourd\'hui' ; // le caractère d'echappement est antislash \ 
echo "<br>aujourd'hui";
echo"<br>";

$prenom1="jean";
$prenom1="Claire";
echo $prenom1 ;
echo "<br>";
$prenom2="Nicolas";
$prenom2 .="Marie<br>";
echo $prenom2;


// Exercice , mettez votre prenom dans une varibal , puis afficher Bonjour concaténé a votre prenom 

$prenom3='Anis';
echo 'Bonjour' .$prenom3; // solution 1
echo "<br>Bonjour $prenom3 <br>
"; //solution 2


$prenom3='Bonjour';
$prenom3.='Anis';
echo $prenom3 ; // solution3

echo '<br><h2>Constantes et Constantes magiques </h2>';

define('CAPITALE','Paris');// je définis une constante CAPITALE 
echo CAPITALE.'<br>';
// define('CAPITALE', 'Lyon'); je ne peux pas modifier ou redefinir une constante.

// Exemple de constantes magiques
echo __FILE__; // Affiche le fichier courant
echo"<br>";
echo __LINE__; // Affiche le numero de la ligne
echo"<br>";

echo "<h2>Opérations arithmétiques</h2>";

$a=10;
$b=2;

echo $a + $b . '<br>';
echo $a - $b . '<br>';
echo $a * $b . '<br>';
echo $a / $b . '<br>';

// Opération + reaffection 

$a += $b; // $a= $a + $b
echo $a . '<br>';

$a -= $b ; // $a= $a - $b
echo $a . '<br>';

$a++;  // Incémentation
echo $a . '<br>';

$a += 2;  // $a = $a+2
echo $a . '<br>';

$a--; // Décrementation
echo $a . '<br>';

echo "<h2>Structure conditionnelles (if/else)  - Opérateurs de comparaison </h2>";


// isset et empty
$var1 = 0;
$var2 = '';

if (empty($var1)) echo '0 , vide ou non définie <br>';
if (isset($var2)) echo 'var2 existe et est définie par rien <br>';
if (isset($var3)) echo 'var3 est défini<br>';
if (empty($var3)) echo 'var3 vaut soit 0, soit est vide, soit n\'est pas défini<br> ';

// empty verifie si la variable testée est : -non définie , -définie à 0 , vide

// isset vérifie si la variable a été définie (indépendamment de sa valeur)

// exemple : empty nous permettra de tester  si un champ de formulaire a été laissé vide

// if , else , elseif

$a=10;$b=5;$c=2;

if ($a >$b) {
    echo "a est supérieur à b<br>";
}
else {
    echo "a est inférieur à b<br>";
}

//equivalent
if ($a>$b):
    echo "a est supérieur à b<br>";
else :
    echo "a est inférieur à b<br>";
endif;
// conditions ET &&
if($a>$b && $b>$c){
    echo "OK pour les 2 conditions<br>";
}
// condition OU ||
if($a==9 || $b>$c){
    echo "OK pour au moins une des conditions <br>";
}
// condition OU exclusif XOR 
if($a==10 XOR $b==6){
    echo "OK pour une des condition seulement <br>";
}
//IF forme contractée

echo($a==10) ? "a est égal à 10<br>" : "a n'est pas égal à 10<br>";


$var1= isset($mavar) ? $mavar : 'valeur_par_defaut<br>';
echo $var1 ;

// Ternaire courte PHP 7 

$var2 = $mavar ?? 'valeur_par_defaut<br>'; // equivalent $var2 = isset($mavar) ? $mavar:'valeur_par_defaut'
echo $var2 ;

$var3 = $mavar1 ?? $mavar2 ?? 'valeur_par_defaut<br>'; // avec cette formulation on affectera à var3 la premiere des valeurs définies (mavar1 ou mavar2) sinon ca sera la valeur par defaut
echo $var3;

//Exemple
?>

<input type="text" value ="<?=$_post['email'] ?? '' ?>" name="email"><br>

<?php
$a =1;
$b= "1";
if ($a==$b)
{
    echo "c'est la même chose en valeur";
}
if ($a===$b)
{
    echo "c'est la même chose en valeur et en type";
}

/*
= affectation ex : $a=5;
== comparaison en valeur ex : if($a==$b)
=== comparaison en valeur et en type ex : ( $a === $b )
*/

if ( !isset($var4))
{
    echo "<br>var4 n'est pas définie<br>";
}

$a=5;
$b=2;

if ($a !=$b )
{
    echo 'a est différent de b<br>';
}

// elseif 

$couleur="noir";

if ($couleur=='bleu')
{
    echo 'vous aimez le bleu <br>';
}
elseif ($couleur=='rouge')
{
    echo 'vous aimez le rouge <br>';
}
elseif ($couleur=='vert')
{
    echo 'vous aimez le vert <br>';
}
else 
{
    echo "vous n'aimez ni le bleu ni le rouge ni le vert";
}


echo '<br><h2>Condition Switch</h2>';

switch ($couleur){
    case 'bleu' : echo 'vous aimez le bleu <br>';
    break;
    case 'rouge' : echo 'vous aimez le rouge <br>';
    break;
    case 'vert' : echo 'vous aimez le vert <br>';
    break;
    default : echo "vous n'aimez ni le bleu ni le rouge ni le vert <br>";
    break;

} 

echo '<h2>Fonctions prédéfinies </h2>';

echo 'Date : '.date('d/m/Y');
echo "<br>";

//mktime(0,0,0,1,1,2018) heure,minute,seconde ,mois , jour , annee

echo date ('l', mktime(0,0,0,1,1,2018));
echo "<br>";
echo 'Maintenant : ' .date('Y-m-d H:i:s') . 'et nous sommes en semaine ' .date('W');
echo '<hr>';

//Traitement de chaines de caractères 
$email = 'prenom@site.fr';
echo strpos($email,'@'); // strpos indique la position du caractère @ dans la chaine $email
echo "<br>";
$email2='bonjour';
echo strpos($email2,'@');

var_dump(strpos($email2,'@'));
echo ' <br>';
$i = 6 ; var_dump($i);
echo '<br>';
$j='moi' ; var_dump($j);


echo '<hr>';

$phrase='ici je mets une super phrase assez longue';
echo strlen($phrase); // strlen indique le nombre des caractères de la phrase 
echo "<hr>";

$texte='Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent ac aliquet ex. Maecenas imperdiet elit in condimentum aliquet. Curabitur ut felis eu odio lobortis porta eu in purus. Ut eu rhoncus purus. Vivamus eu pellentesque tellus, sit amet rhoncus diam. Nullam dignissim dictum enim, quis semper metus mattis eu. Aenean non laoreet lacus. Aenean et neque ornare libero eleifend fringilla. Integer in metus cursus, ornare magna in, vulputate lectus. Nulla vitae consectetur tellus. Nullam gravida nisi in quam tempor pellentesque. Etiam nec pellentesque ligula. Etiam feugiat ac quam et tristique. Donec tristique lorem dictum lobortis hendrerit. Nullam bibendum aliquet tortor id rhoncus.';

echo substr($texte,0,20) . '... <a href="">Lire la suite</a>'; // substr extrait une sous chaine de la chaine $texte , en partant de la position 0 et sur une longueur de 20 caractères .

echo '<br>';
echo"<h2>Fonction utilisateur </h2>";

function vdm ($var){
    echo "<pre>";
    var_dump($var);
    echo "</pre>";
}

vdm ($texte);

function separation(){
    return '<hr>';
}
echo separation();

function bonjour($qui){
    return 'bonjour '.$qui. '!<br>';
}
$prenom = 'Chloe';
echo bonjour($prenom);
echo bonjour('Anis');
echo '<br>';


function appliqueTva($nombre){
    return $nombre*1.2;
}
function appliqueTva2($nombre,$taux){
    return $nombre * $taux;
}

echo "10 euros avec tva à 20% font".appliqueTva(10)."€ <br>";
echo "100 euros avec tva à 20% font".appliqueTva(100)."€ <br>";
echo "100 euros avec tva à 20% font".appliqueTva2(100,1.055)."€ <br>";

echo '<hr>';

function joursemaine(){
    $jour="lundi";
    return $jour;
    echo "allo"; // cette commande se situant apres le return ne sera pas executée 
}
// echo $jour ; ne fonctionne pas car la variable jour n'est connue que dans la fonction 

$recup = joursemaine();
echo $recup;

echo'<br>';

$pays='France';
function affichepays(){
    global $pays; // je globalise la variable pays dans la fonction car elle fait parti de l'envirenement global
    echo   $pays.''.CAPITALE ;//une constante est d'office globalisée
}
affichepays();

echo'<br>';

function factultatif (){
   // vdm( func_get_args()); // func_get_args() est une commande qui créé un tableau associatif avec les arguments fournis à la fonction dans laquelle je l'appelle.
    foreach (func_get_args() as $indice => $element) {
        echo $indice . '  ->' . $element . '<br>';
    }
}
factultatif();
factultatif("France","Italie");
factultatif(1,2,3);

echo "<hr><h2>Strucutures itératives : boucles </h2>";
// boucle while
$i=0; // situation de départ
while ( $i < 3) // tant que la condition est vraie, je boucle
{
    echo "$i --";
    $i++; // variation de i
}
 
echo "<br>";

// exercice : écrire une boucle while pour compter de 0 à 10 de 2 en 2
$i=0;
while ( $i <= 10 )
{
    echo $i.'x';
    $i += 2;
}
//boucle for
echo '<hr>';
for ( $j=0 ; $j <=10 ; $j++)
{
    echo $j.'#';
}

?>
<br>

<!-- Exercice : afficher une liste de slection allant de l'année 2017 à 1950 -->
<?php 
    echo '<select>';
        for ( $i=date('Y') ; $i >= 1950 ; $i--)
        {
            echo "<option>$i</option>";
        }
    echo '</select>';
?>

<!--Correction -->
<label for"annee">Annee</label><select name="annee">
<?php for ( $a=date('Y'); $a >= 1950; $a-- ) : ?>
        <option value="<?= $a ?>"><?= $a ?></option>
    <?php endfor; ?>
        </select>
<!--Exercie : boucles imbriquées, générer un tableau de 15 par 20, 15 colonnes, 20 lignes -->
<table>
    <?php
    $compteur=0;
     for($ligne=1; $ligne <= 12; $ligne++) {
        echo '<tr>';
        for ($colonne=1 ; $colonne <=30 ; $colonne++)
        {   
            $compteur++;
            echo '<td>' .$compteur .'</td>';
        }
        echo '</tr>';
    } 
    ?>
</table>

<table>
    <?php
    $compteur=0;
    for($ligne=1; $ligne<=12; $ligne++) :?>
    <tr>
    <?php
    for ($colonne=1 ; $colonne <=30; $colonne++) :
        $compteur++;
        ?>
        <td><?= $compteur ?></td>
        <?php
    endfor; ?>
    </tr>
    <?php
    endfor;
    ?>
 </table>

<?php 

echo "<h2>Inclusion de fichier</h2>";

echo "premiere fois<br>";
include('exemple.php');
echo"<br>";

mafonction();
/*
echo "deuxième fois<br>";
include_once('exemple.php'); 
echo"<br>";

echo "troisième fois<br>";
require('exemple.php');
echo '<br>';

echo "quatrième fois<br>";
require_once('exemple.php');
echo '<br>';
*/

echo '<h2>Tableaux de données: ARRAY</h2>';

$liste = array('Ruben','Hamid','Moundir','Olivier','Romain','Chloe');

vdm($liste);

$fruits = array();
$fruits[] = 'pomme';
$fruits[] = 'poire';
$fruits[] = 'orange';

vdm($fruits);

$fruits2 = array( 'pm' => 'pomme', 'pr' => 'poire', 'og' => 'orange');
vdm($fruits2);

$fruits2[] = 'cerise';
$fruits2['bn'] = 'banane';
vdm($fruits2);

$fruits2['pm'] = 'pêche';
vdm($fruits2);

$fruits2[]='kiwi';
vdm($fruits2);

$fruits2[99]='clémentine';
$fruits2[]= 'raisin';
vdm($fruits2);


// Boucle foreach
foreach( $fruits2 as $info)
{
    echo $info.'-';
}

foreach( $fruits2 as $indice => $valeur)
{
    echo "à l'indice $indice je trouve $valeur<br>";
}

// syntaxe : foreach ( nomtableauaparcourir as index => valeur)
$tsuperheros = array (
     'Superman' => array(
                    "nom" => "kent",
                    "prenom" => "clark", 
                    "univers" => "DC Comics"),
     'Spiderman' => array(
                    "nom" => "parker",
                    "prenom" => "peter", 
                    "univers" => "Marvel"),
     'Batman' => array(
                    "nom" => "wayne",
                    "prenom" => "bruce", 
                    "univers" => "DC Comics"),
    
     'Ironman' => array(
                    "nom" => "stark",
                    "prenom" => "tony", 
                    "univers" => "Marvel"),
    );
echo '<hr>';
echo sizeof($tsuperheros);
echo '<br>';    
echo count($tsuperheros);
// count() et sizeof() indiquent tous deux le nombre d'entrées dans le tableau
echo '<br>'; 
echo $tsuperheros['Batman']['prenom'];
echo '<br>'; 
echo $tsuperheros['Spiderman']['univers'];

foreach($tsuperheros as $heros => $valeur)
{
    echo '<p>'.$heros.'</p>';
    foreach($valeur as $info => $valeur2){
            echo $valeur2;        
    }
}
echo '<br>'; 

$fruits3 = array ('pomme','cerise','orange');

$nbelemnts = count($fruits3);

for ( $i=0; $i < $nbelemnts; $i++)
{
    echo $fruits3[$i].'-';
}

echo "<h2>Objets</h2>";

class Etudiant
{
    public $prenom = 'Julien';
    public $age = 25;
    public function pays(){
        return 'France';
    }
}
$objet = new Etudiant;
vdm($objet);
vdm(get_class_methods($objet));
echo $objet->age;
echo '<br>'; 
echo $objet->pays();
$objet->prenom = 'Jeanne';
vdm($objet);
$objet2 = new Etudiant;
vdm($objet2);

foreach ( $objet2 as $valeur ){
    echo $valeur;
}

?>

















<?= 'allo' ?> <!-- revient à < ? php echo -->
</body>
</html>

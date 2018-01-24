<?php
/* ce fichier sera inclus dans tous le sscripts pour initialiser les éléments suivants:
- création/ouverture de session
- connexion à la BDD site
- définition du chemin du site
- inclusion de notre fichier de fonctions utlilisateur (fonction.php)
*/
// Session
session_start();

// Connexion
$pdo = new PDO('mysql:host=localhost;dbname=site',
                'root',
                '',
                array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING,
                PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'
            ));

// Chemin du site
define('RACINE_SITE','/MYSQL-PHP/SITE/');

$contenu='';
$contenu_gauche='';
$contenu_droite='';

// Inclusion fichier de fonctions
require_once('fonction.php');
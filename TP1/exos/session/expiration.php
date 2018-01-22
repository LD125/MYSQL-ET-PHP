<?php

session_start();

echo 'Temps actuel : '. time() .'<br>';

print_r($_SESSION); // print_r permet d'afficher le contenu d'une variable de type array

if ( isset($_SESSION['temps']) ) // si l'entrée temps existe dans $_SESSION
{

    if ( time() > ( $_SESSION['limite']+ $_SESSION['temps']))
    {
        session_destroy(); // si c'est le cas, la page n'a pas été rafraichie dans les 10 secondes, on détruit la session
        echo 'expiration de la session';
    }
    else 
    {
        $_SESSION['temps'] = time();
        echo 'connexion mis à jour : 10 secondes de plus!';
        unset($_SESSION['mdp']);
    }

}
else
{
    echo "connexion";
    $_SESSION['limite'] = 10; // je fixe le temps d'inactivité (secondes)
    $_SESSION['temps'] = time();
    $_SESSION['login'] = 'Fred';
    $_SESSION['mdp'] = 'secret';
}

/* Les informations d'une session sont enregistrées coté serveur, cela crée dans le meme temps un COOKIE qui identifie la session :
        PHPSESSID
    sur le pc et navigateur du client.

    Si l'internaute supprime ses cookies, il casse le lien entre l'id de ssiosn et les infos stockés sur le serveur

    En général sur les sites qui vous proposent une connexion,il y a une session qui vous "garde" connecté à partir du moemen ou vous êtes passés
    une fois par le porte d'entrée. (vous vous être indentifiés).

    Avantages : vos infos de session sont conservés d'une page à l'autre du site (ex: on conserve son panier)

*/

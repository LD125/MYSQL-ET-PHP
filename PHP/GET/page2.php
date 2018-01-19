<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h1>Page 2</h1>
    <pre>
    <?php
    if ( $_GET && !empty($_GET['article']) )
    {
    echo 'article : '.$_GET['article'];
    }
    /*
    $_GET est une superglobal qui récupèrs les informations provenant de l'url et crée un tableau assiociatif

    ex : ?article=jeans&couleur=bleu
    $_GET['article'] vaut jeans
    $_GET['couleur'] vaut bleu 

    /!\ On ne passe de données sensible via $_GET (pas de password,...)
    
    ex: fiche_produit.php?id_produit=657
    

    */

    ?>
    </pre>
</body>
</html>
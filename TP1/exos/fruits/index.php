<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Fruits</title>

</head>

<body>
    <?php
require_once('function.php');

/*....*/
if ( $_POST){
    if (isset($_POST['fruit_choisi']) && is_numeric($_POST['poids']) )
    {
        echo calcul( $_POST['fruit_choisi'], $_POST['poids']);
    }
    else{
        echo "Veuillez choisir un fruit et entrer un poids en chiffres<br>";
    }
}

?>
    <hr>
    <h1>Formulaire</h1>
    <form action="" method="post">
        <select name="fruit_choisi" id="">
            <option value="cerises">cerises</option>
            <option value="bananes" <?= ( isset($_POST['fruit_choisi']) && $_POST['fruit_choisi']== 'bananes' ) ? 'selected' : '' ?>>bananes</option>
            <option value="peches" <?= ( isset($_POST['fruit_choisi']) && $_POST['fruit_choisi']== 'peches' ) ? 'selected' : '' ?>>peches</option>
            <option value="pommes" <?= ( isset($_POST['fruit_choisi']) && $_POST['fruit_choisi']== 'pommes' ) ? 'selected' : '' ?>>pommes</option>
        </select>
        <br>
        <label for="poids">Quantité en Kg</label>
        <input type="text" name="poids" id="poids" value="<?= $_POST['poids'] ?? '' ?>">
        <input type="submit" value="Submit form">
    </form>
</body>

</html>
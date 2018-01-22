<?php
/* Exercice : créer un formulaire pour demander le pseudo à l'internaute. Quand il valide son pseudo,
on garde l'information en session. Quand il revient sur la page, on lui indique "Votre pseudo est <pseudo>" et on n'affiche plus le formulaire. */
session_start();

if ( $_POST && !empty($_POST['pseudo'])) //* je stocke le pseudo posté en session
{
    $_SESSION['pseudo'] = $_POST["pseudo"];
}
if ( isset ($_SESSION['pseudo'])) 
{ // Si j'ai un pseudo stocké en session
    echo "Votre pseudo est".$_SESSION['pseudo']."<hr>"; //* j'affiche "votre pseudo est <pseudo>"
}
else {
// Sinon
    // J'affiche le formulaire pour lui demander son pseudo
    ?>
    <form action="" method="post">
        <label for="pseudo">Pseudo:</label>
        <input type="text" name="" id="pseudo" placeholder="entrez votre pseudo">
        <input type="submit" value="Envoyer">
    </form>
    <?php
}
?>
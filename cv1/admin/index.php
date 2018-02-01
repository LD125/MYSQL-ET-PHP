<?php

require_once('init.php');

if ( $_POST )
{
    if ( !empty($_POST['login']) && !empty($_POST['pwd']))
    {
        $resul = $base->prepare("SELECT * FROM users WHERE login=:login AND password=:password");

        $resul->execute( array('login' => $_POST['login'],'password'=> SHA1($_POST['pwd'])));

        if ($resul->rowCount() == 1 )
        {
            $_SESSION['user'] = $_POST['login'];
        }
        else
        {
            echo "Erreur sur les identifiants";
        }
    }
}



if ( isset($_SESSION['user']))
{
    // je suis connecté et j'accède à mon BO
    echo ' je suis connecté ';
    $tables_a_exclure="'users','messages' ";

    $mestables = $base->query("SHOW TABLES WHERE Tables_in_portefolio NOT IN(".$tables_a_exclure.")");
    while ( $matable = $mestables->fetch(PDO::FETCH_ASSOC))
    {
        echo '<a href="?table='.$matable['Tables_in_portefolio'].'">'.strtoupper($matable['Tables_in_portefolio']).' </a>';
    }
    echo "<hr>";
    if ( !empty($_GET['table']) )
    {
        $table_courante=$_GET['table'];

        // affichage
        $affichage='';
        $formulaire='';
        //formulaire
        $resul = $base->query("SELECT * FROM ".$table_courante);
        
        $affichage .= '<table><tr>';
        $nbcolonnes=$resul->columnCount();

    
        $formulaire='<hr>
        <form action="" method="post"><input type="hidden" name="table" value"'.$table_courante.'">';

        for ( $i=0; $i < $nbcolonnes; $i++)
        {
            
            $info_colonne=$resul->getColumnMeta($i);

            if ( $i == 0 ) {
                 $indice_table = $info_colonne['name']; }

            $affichage .='<th>'.$info_colonne['name'].'</th>';
            if ($i !=0){
            $formulaire .= '<p><label for="'.$info_colonne['name'].'">'.$info_colonne['name'].'</label> ';
            if ( $info_colonne['name'] == 'description')
            {
                $formulaire .= '<textarea name="'.$info_colonnes['name'].'" cols="40"
                rows="5"></textarea></p>';
            }
            else
            {
                $formulaire .= '<input type="text" id="'.$info_colonne['name'].'" value=""></p>';
            }
        }
        }
        $affichage .= '<th colspan="2">Actions</th>';
        $affichage .= '</tr>';
        $formulaire .='<input type="submit" name="update" value="Valider"></form>';

        // lignes
        while ( $ligne = $resul->fetch(PDO::FETCH_ASSOC))
        {
            $affichage .="<tr>";
                foreach ( $ligne as $information)
                {
                    $affichage .= "<td>".$information."</td>";
                }
            $affichage .= '<td><a href="?table='.$table_courante.'&'.$indice_table.'='.$ligne[$indice_table].'&action=modifier">Modifier</a></td>
                            <td><a href="?table='.$table_courante.'&'.$indice_table.'='.$ligne[$indice_table].'&action=supprimer" onclick="return(confirm(\'Etes vous certain de vouloir supprimer cette ligne?\'))">Supprimer</a></td>';

            $affichage .="</tr>";
        }

        $affichage .="</table>";



        echo $affichage;
        echo $formulaire;
        echo "<hr>";
    }
}
else
{
    // je ne suis pas encore connecté
    // et j'affiche le formulaire de connexion
    ?>
    <form action="" method="post">
        <label for="login"> Login</label>
        <input type="text" name="login" id="login">
        <label for="pwd">Mot de passe</label>
        <input type="password" name="pwd" id="pwd">
        <input type="submit" value="Me connecter">

</form>
<?php
}
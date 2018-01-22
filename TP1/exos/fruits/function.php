<?php 
//exercice
/*

sachant que l'on reçoit du maraicher les prix suivants :

- cerises 5,76€ /kg
- bananes 1.09€ /kg
- pommes 1.61€ /kg
-peches 3.23€ /kg

ecrire la focntion calcul()
qui renvoie la phrase :
Les <nom des fruits> coutent <resultat du calcul> € pour <poids> Kg 
*/
/*
function calcul($fruit, $poids){
    
    switch($fruit){
        case "cerises":
            $nomfruit = 'cerise';
            $fruit = 5.76;
            break;
        case "bananes":
            $nomfruit = 'bananes';
            $fruit = 1.09;
            break;
        case "peches":
            $nomfruit = 'peches';
            $fruit = 1.61;
            break;  
        case "pommes";
            $nomfruit = 'pommes';
            $fruit = 3.23;
            break;
    }
    return "Les"." ".$nomfruit." "."coutent"." ".$fruit * $poids."€ "."pour"." ".$poids." "."Kg";
} */
function calcul($fruit, $poids){
    
    switch($fruit){
        case "cerises":
            $pak = 5.76;
            break;
        case "bananes":
            $pak = 1.09;
            break;
        case "peches":
            $pak = 1.61;
            break;  
        case "pommes";
            $pak = 3.23;
            break;
    }

    $resultat = $poids * $pak;
    return "Les $fruit coûtent $resultat € pour $poids Kg<br>";
}

?>
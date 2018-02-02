<?php
/// Initialisation de la connexion à la base de donnée

require_once('admin/init.php');

?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Programme TV</title>
    <link href="https://fonts.googleapis.com/css?family=Rammetto+One" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <div class="container">
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">

        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#monmenu">
                <span class="sr-only">Naviguer</span>
                <span class="glyphicon glyphicon-menu-hamburger"></span>
            </button>
            <a class="navbar-brand" href="index.php">Programme TV</a>

        <div class="collapse navbar-collapse" id="monmenu">
            <ul class="nav navbar-nav">
               
            </ul>
        </div>
    </div>
</nav>
</div>
    <div class="container-fluid">
                    <h2>Programation</h2>
                    <div class="row">
					<?php 
					$programmes = $base->query("SELECT * FROM programmes ORDER BY date_diffusion ASC");

					while ( $programme = $programmes->fetch(PDO::FETCH_ASSOC))
					{

                     echo '<div class="col-md-3 programestyle">
                     <img class=" col-md-6 image" src="'.$programme['image'].'">
                     <table class="img-responsive col-md-6 tableprog">
                        <tr>
                            <td class="nom">'.$programme['nom'].'</td>
                        </tr>
                        <tr>
                            <td class="time1">'.$programme['date_diffusion'].'</td>
                        </tr>
						<tr>
							<td class="time2">'.$programme['heure_debut'].'
								<p>'.$programme['heure_fin'].'</p>
							</td>
                            </tr>
                            <tr>
                            <td class="public">'.$programme['public'].'</td>
						</tr>
						<tr>
							<td class="description">'.$programme['description'].'</td>
						</tr>
                    </table>
                    </div>';
					}
					?>
                    </div>
    </div>
    <script src="assets/js/jquery-3.3.1.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
</body>
</html>
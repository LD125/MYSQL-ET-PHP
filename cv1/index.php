<?php
/// Initialisation de la connexion à la base de donnée

require_once('admin/init.php');

if ($_POST)
{
	if ( !empty($_POST['email'])
		&& !empty($_POST['objet'])
		&& !empty($_POST['msg']))
		{
			$email = htmlspecialchars($_POST['email']);
			$objet = htmlspecialchars($_POST['objet'], ENT_QUOTES);
			$msg = htmlspecialchars($_POST['msg'], ENT_QUOTES);
			$req = $base->prepare("INSERT INTO messages VALUES (NULL,:email,:objet,:msg)");
			$req->execute(array('email' => $email,
								'objet' => $objet,
								'msg'=> $msg));
		}
}

?>

	<!DOCTYPE html>
	<html lang="fr">

	<head>
		<meta charset="utf-8" />
		<title>Curiculum Vitae</title>
		<meta name="description" content="ma description" />
		<meta name="keywords" content="mots clés," />
		<link rel="stylesheet" href="css/normalize.css" />
		<link rel="stylesheet" href="css/style.css" />
		<link href="https://fonts.googleapis.com/css?family=Open+Sans+Condensed:300|Oswald" rel="stylesheet">

	</head>

	<body>
		<!-- Présentation/ Réalisations / Parcours / Contact -->
		<header>
			<div class="conteneur">
				<div class="col-5">
					<h1>
						<a href="index.php">Lounis</a>
					</h1>
				</div>
				<div class="col-7">
					<nav class="ligne">
						<a href="#link1">Présentation</a>
						<a href="#link2">Réalisations</a>
						<a href="#link3">Parcours</a>
						<a href="#link4">Contact</a>
					</nav>
				</div>
			</div>
			<div class="clear"></div>
		</header>
		<section id="section1">
			<div id="link1"></div>
			<div class="conteneur ligne bgcolor1">
				<div class="col-9">
					<h2> Qui suis-je ?</h2>
					<p>
						<img class="imageronde" src="images/avatar.png" alt="avatar" />
					</p>
					<p>voici ma présentationvoici ma présentationvoici ma présentationvoici ma présentationvoici ma présentationvvoici ma présentationvoici
						ma présentationvoici ma présentationvoici ma présentationvoici ma présentationvoici ma présentationvoici ma présentationvoici
						ma présentationvoici ma présentationvoici ma présentationvoici ma présentationvoici ma présentationvoici ma présentation</p>
				</div>




<!-----------------------------------------------------------COMPETENCES -------------------------------------------------->


				<div class="col-3">
					<h2> Compétences</h2>
					<ul>
						<?php
						
						$competences = $base->query("SELECT * FROM competences");

						while ( $competence = $competences->fetch(PDO::FETCH_ASSOC))
						{
							echo '<li>
									<h3>'.$competence['titre'].'</h3>
										<div class="jauge_fond">
											<div class="jauge_color" style="background: 
											'.$competence['couleur'].'; width: '.$competence['pourcentage'].'%;">
										</div>
									</div>
								</li>
						<li>';
						}
						?>
					</ul>
				</div>


<!-----------------------------------------------------------LANGAGES -------------------------------------------------->


				<div class="col-12 ligne">
					<h2>Mes languages favoris</h2>
					<?php
					/*				<div class="col-3"><img src="images/html.jpg" alt="html"/></div>*/
				$langages = $base->query("SELECT * FROM langages");

				while ($langage = $langages->fetch(PDO::FETCH_ASSOC))
				{
					echo '	<div class="col-3 moitie">
								<img src="'.$langage['image'].'" alt="'.$langage['alternatif'].'" />
							</div>				
					';
				}
				?>
				</div>
			</div>
		</section>





<!-----------------------------------------------------------REALISATIONS -------------------------------------------------->

		<section id="section2">
			<div id="link2"></div>
			<div class="conteneur ligne bgcolor1">
				<h2> Réalisations</h2>
				<?php

				$realisations = $base->query("SELECT * FROM realisations");

				while ( $realisation = $realisations->fetch(PDO::FETCH_ASSOC))
				{
					echo '<div class="col-4">
					<figure>
						<img src="'.$realisation['image'].'" alt="'.$realisation['alternatif'].'" />
						<figcaption>
							<h3>
								<a href="">'.$realisation['legende'].'</a>
							</h3>
						</figcaption>
					</figure>
					</div>';
				}			
				?>
			</div>
			</div>
		</section>


<!-----------------------------------------------------------EXPERIENCES -------------------------------------------------->



		<section id="section3">
			<div id="link3"></div>
			<div class="conteneur ligne bgcolor1">
				<div class="col-6">
					<h2>Expériences</h2>
					<?php 
					$experiences = $base->query("SELECT * FROM experiences ORDER BY yearend DESC");

					while ( $experience = $experiences->fetch(PDO::FETCH_ASSOC))
					{
					 echo '<table>
						<tr>
							<td class="year" rowspan="2">'.$experience['yearend'].'
								<p>'.$experience['yearstart'].'</p>
							</td>
							<td class="job">'.$experience['job'].'</td>
						</tr>
						<tr>
							<td class="job_desc">'.$experience['jobdesc'].'</td>
						</tr>
					</table>';
					}
					?>
					</div>

<!-----------------------------------------------------------FORMATIONS -------------------------------------------------->


				<div class="col-6">
					<h2>Formations</h2>
					<?php
					$formations = $base->query("SELECT * FROM formations ORDER BY yearend DESC");

					while ( $formation = $formations->fetch(PDO::FETCH_ASSOC))
					{
						echo '<table>
						<tr>
							<td class="year" rowspan="2">'.$formation['yearend'].'
								<p>'.$formation['yearstart'].'</p>
							</td>
							<td class="job">'.$formation['forma'].'</td>
						</tr>
						<tr>
							<td class="job_desc">'.$formation['formadesc'].'</td>
						</tr>
					</table>';
					}
					?>
				</div>
			</div>
		</section>



<!-----------------------------------------------------------COORDONNES -------------------------------------------------->



		<section id="section4">
			<div id="link4"></div>
			<div class="conteneur ligne bgcolor1">
				<div class="col-6">
					<h2>Coordonnées</h2>
					<div class="map">
						<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d21004.94967718324!2d2.33242335!3d48.8464112!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47e671da17cbdca5%3A0xdb7a5a47381857fe!2s%C3%89glise+Saint-Sulpice!5e0!3m2!1sfr!2sfr!4v1513093599031"
						    width="420" height="200" frameborder="0" style="border:0" allowfullscreen></iframe>
					</div>
					<div class="coor">
						<span>Mon email: zkczceczc@zdez.com</span>
						<span>téléphone: 012345654</span>
					</div>
				</div>
				<div class="col-6">
					<h2>Formulaire de Contact</h2>
					<form method="post" action="">
						<label for="email">Mon adresse email</label>
						<textarea id="email" name="email" placeholder="Entrez ici votre adresse email" required></textarea>
						<label for="objet">Objet</label>
						<textarea id="objet" name="objet" placeholder="saisissez ici l'objet de votre message" required></textarea>
						<label for="msg">Message</label>
						<textarea id="msg" name="msg" placeholder="Entrez ici votre message" required></textarea>
						<input type="submit" name="submit" value="Envoyer" />
					</form>
				</div>
			</div>
		</section>
		<footer>
			<div class="conteneur">
				<h2> Bas de page</h2>
			</div>
		</footer>
	</body>

	</html>

<!-----------------------------------------------------------MAIL -------------------------------------------------->
	<?php 
/*var_dump($_POST);

if ($_POST){
	$expediteur = 'From:'.$_POST['email'];
	$destinataire = 'lounis.djadel@gmail.com';
	$objet = $_POST['objet'];
	$msg = $_POST['msg'];

	mail($destinataire,$objet,$msg,$expediteur); 
}
*/
?>
<?php
include ('./connexion.php');
$fullUrl = "https://". $_SERVER["SERVER_NAME"]. $_SERVER["REQUEST_URI"];
?>

<!DOCTYPE html>
<html lang="fr" >
<head>
  <meta charset="UTF-8">
  <title>Application Stage</title>
  <link rel="icon" type="image/png" href="img/logo.png" />
  <link rel='stylesheet' href='//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css'><link rel="stylesheet" href="libs/style1.css">

</head>
<body>
<!-- partial:index.partial.html -->
<body> 
    
  
<div class="content">
	<div class="container">
		<img class="bg-img" src="img/accueil.jpg" alt="">
			<div class="menu">
				<a href="#enregistrer" class="btn-enregistrer active"><h2>Inscription</h2></a>
				<a href="#connexion" class="btn-connexion"><h2>Connexion</h2></a>
			</div>

			<form action="./connexion.php" method="post">
				<div class="connexion">
					<div class="contact-form">
						<label>Nom D'utilisateur</label>
						<input name="pseudo" placeholder="" type="text" required="required">
						
						<label>Mot de passe</label>
						<input name="mdp" placeholder="" type="text" required="required">
						</br>
						<?php 
							if (strpos($fullUrl, "aucunresultat") == true) {
								echo "<erreur>Mauvais Identifiants !</erreur>";
							}
							elseif (strpos($fullUrl, "mdpvide") == true) {
								echo "<erreur>Mot de passe vide !</erreur>";
							}
							elseif (strpos($fullUrl, "uservide") == true) {
								echo "<erreur>Nom d'utilisateur vide !</erreur>";
							}
							elseif (strpos($fullUrl, "connected") == true) {
								echo "<erreur>Vous êtes bien connecté !</erreur>";
							}
							elseif (strpos($fullUrl, "inscription") == true) {
								echo "<erreur>Vous êtes bien inscrit !</erreur>";
							}
							elseif (strpos($fullUrl, "pseudoexistant") == true) {
								echo "<erreur>Il existe déjà un compte avec ce pseudonyme !</erreur>";
							}
							
						?>
						</br></br></br></br>
						
						
						<input class="submit" name="connexion" value="Se Connecter" type="submit">
					</div>
					
					
				</div>
			</form>
			
			<form action="inscription.php" method="post">
				<div class="enregistrer active-section">
					<div class="contact-form">
						<label>Nom D'utilisateur</label>
						<input name="pseudo" placeholder="" type="text" required="required">
						
						<label>E-mail</label>
						<input name="email" pattern="[a-zA-Z0-9._-]+@[a-zA-Z0-9._-]+.[a-zA-Z.]{2,15}" placeholder="" type="text" required="required">	
						
						<label>Mot de passe</label>
						<input name="mdp" placeholder="" type="text" required="required">
						
						<label>Confirmer le mot de passe</label>
						<input name="confirmmdp" placeholder="" type="text" required="required">
						<?php 
							if (strpos($fullUrl, "mdpdiff") == true) {
								echo "<erreur>Les mots de passe ne correspondent pas !</erreur>";
							}
						?>
					</br></br></br>
						
						<input class="submit" name="inscription" value="S'enregistrer" type="submit">	
							
					</div>
				</div>
			</form>
			
	</div>

</div>


</body>
<!-- partial -->
  <script src='//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
<script src='//cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.2/jquery-ui.min.js'></script><script  src="libs/script1.js"></script>

</body>
</html>

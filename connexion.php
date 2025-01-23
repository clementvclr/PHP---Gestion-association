<?php
/*
Page: connexion.php
*/
//à mettre tout en haut du fichier .php, cette fonction propre à PHP servira à maintenir la $_SESSION
session_start();
$connexion = new PDO('mysql:host=localhost;dbname=gestion_stage', 'root','');
//si le bouton "Connexion" est cliqué
if(isset($_POST['connexion'])){
    // on vérifie que le champ "Pseudo" n'est pas vide
    // empty vérifie à la fois si le champ est vide et si le champ existe belle et bien (is set)
    if(empty($_POST['pseudo'])){
        header("Location:./index.php?uservide");
    } else {
        // on vérifie maintenant si le champ "Mot de passe" n'est pas vide"
        if(empty($_POST['mdp'])){
            header("Location:./index.php?mdpvide");
        } else {
			
				// les champs pseudo & mdp sont bien postés et pas vides, on sécurise les données entrées par l'utilisateur
				//le htmlentities() passera les guillemets en entités HTML, ce qui empêchera en partie, les injections SQL
				$Pseudo = htmlentities($_POST['pseudo'], ENT_QUOTES, "UTF-8"); 
				$MotDePasse = htmlentities($_POST['mdp'], ENT_QUOTES, "UTF-8");
				$MDPHASH = hash('sha256', $MotDePasse);
				//on se connecte à la base de données:
				$mysqli = mysqli_connect("localhost", "root", "","gestion_stage");
				//on vérifie que la connexion s'effectue correctement:
				if(!$mysqli){
					echo "Erreur de connexion à la base de données.";
				} else {
					//on fait maintenant la requête dans la base de données pour rechercher si ces données existent et correspondent:
					$Requete = mysqli_query($mysqli,"SELECT * FROM membres WHERE pseudo = '".$Pseudo."' AND mdp = '".$MDPHASH."'");
					//si il y a un résultat, mysqli_num_rows() nous donnera alors 1
					//si mysqli_num_rows() retourne 0 c'est qu'il a trouvé aucun résultat
					if(mysqli_num_rows($Requete) == 0) {
						header("Location:./index.php?aucunresultat");
					} else {
						//on ouvre la session avec $_SESSION:
						//la session peut être appelée différemment et son contenu aussi peut être autre chose que le pseudo
						$_SESSION['pseudo'] = $Pseudo;
						
						
						$id_user = mysqli_query($mysqli,"SELECT id as id FROM membres WHERE pseudo = '".$Pseudo."'");
                        $data = mysqli_fetch_assoc($id_user);
                        $id_final = $data['id'];
						$_SESSION['id'] = $id_final;

						$id_perm = mysqli_query($mysqli,"SELECT permission as perm FROM membres WHERE id = '".$id_final."'");
                        $data = mysqli_fetch_assoc($id_user);
                        $id_final_perm = $data['perm'];
						$_SESSION['perm'] = $id_final_perm;

						header("Location:./accueil.php");
					}
				}	 
        }
    }
}
?>
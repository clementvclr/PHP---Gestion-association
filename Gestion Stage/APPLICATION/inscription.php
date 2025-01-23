<?php
session_start();
//si le bouton "Connexion" est cliqué
if(isset($_POST['inscription'])){
    // on vérifie que le champ "Pseudo" n'est pas vide
    // empty vérifie à la fois si le champ est vide et si le champ existe belle et bien (is set)
    if(empty($_POST['pseudo'])){
        header("Location:./index.php?uservide");
    } else {
        // on vérifie maintenant si le champ "Mot de passe" n'est pas vide"
        if(empty($_POST['mdp'])){
            header("Location:./index.php?mdpvide");
        } else {
                if($_POST['mdp'] == $_POST['confirmmdp']) {
                    $Pseudo = htmlentities($_POST['pseudo'], ENT_QUOTES, "UTF-8"); 
                    $MotDePasse = htmlentities($_POST['mdp'], ENT_QUOTES, "UTF-8");
                    $MDPHASH = hash('sha256', $MotDePasse);

                    $Mail = htmlentities($_POST['email'], ENT_QUOTES, "UTF-8");

                    $mysqli = mysqli_connect("localhost", "root", "", "gestion_stage");
                    $Comptage=mysqli_query($mysqli,"SELECT COUNT(id) as id FROM membres");
                    $data=mysqli_fetch_assoc($Comptage);
                    $Comptagefinal = $data['id'];
                    
                        if(!$mysqli){
                        echo "Erreur de connexion à la base de données.";   
                        }   

                        else {
                        $Requete = mysqli_query($mysqli,"INSERT INTO `membres`(`pseudo`, `mdp`, `email`) VALUES ('".$Pseudo."','".$MDPHASH."','".$Mail."')");
                        }

                        $Comptage2 = mysqli_query($mysqli,"SELECT COUNT(id) as id FROM membres");
                        $data2 = mysqli_fetch_assoc($Comptage2);
                        $Comptagefinal2 = $data2['id'];

                        
                        
                        if ($Comptagefinal == $Comptagefinal2 ) {
                            header("Location:./index.php?pseudoexistant");
                        }

                        else {
                            header("Location:./index.php?inscription");
                        }
                        
                        
                    
                }
                else {
                    header("Location:./index.php?mdpdiff");
                }
			 
        }
    }
}
?>
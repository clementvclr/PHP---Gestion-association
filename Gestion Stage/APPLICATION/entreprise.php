<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();
if (($_SESSION['pseudo'] == null)) {
  header("Location: ./index.php");
  exit;
}
session_write_close();
include "CRUD.php";
$Mesfonctions = new Mesfonctions;
if ($Mesfonctions->SearchPerm($_SESSION['id']) != 0) {
  header("Location: ./accueil.php");
  exit;
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion Stage</title>
    
    <link rel="icon" type="image/png" href="img/logo.png" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.3.1/css/all.min.css">
    <script src="./DataTablesfinal/js/jquery.dataTables.min.js" type="text/javascript"></script>  
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.2/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.2/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="./libs/style3.css">
</head>

<body>
  <!----------------------------------------------------NAVBAR---------------------------------------------------->
    <header>
    <nav class="nav">
            <div class="vamos">
                <div id="mainListDiv" class="main_list">
                    <ul class="navlinks">
                        <li><a href="./accueil.php">Accueil</a></li>
                        <li><a href="./etudiant.php">Etudiant</a></li>
                        <li><a href="./professeur.php">Professeur</a></li>
                        <li><a href="./entreprise.php">Entreprise</a></li>
                        <li><a href="./tuteur.php">Tuteur</a></li>
                        <li><a href="./classe.php">Classe</a></li>
                        <li><a href="./stage.php">Stage</a></li>
                        <li><a href="./logout.php"><img class="porte" src="img/porte.png"></a></li>
                    </ul>
                </div>
                <span class="navTrigger">
                    <i></i>
                    <i></i>
                    <i></i>
                </span>
            </div>
        </nav>
    </header>
  <!----------------------------------------------------NAVBAR---------------------------------------------------->



  <!----------------------------------------------------TABLEAU DE DONNEES---------------------------------------------------->
    <button type="button" class="Btn_add" data-toggle="modal" data-target="#ajouterModal" data-whatever="@mdo">Ajouter</button>
        <div class="container1">
            <div class="row">  
                <table id="matable" class="table table-striped" style="width:100%">
                    <thead>
                        <tr id="items">
                            <td>Nom de l'entreprise</td>
                            <td>Rue</td>
                            <td>Code postal</td>
                            <td>Ville</td>
                            <td>Représentant</td>
                            <td>Service</td>
                            <td>Numéro de téléphone</td>
                            <td>Email</td>
                            <td>Secteur d'activité</td>
                            <td>Fonction</td>
                            <td>Modifer</td>
                            <td>Supprimer</td>
                        </tr>
                    </thead>    
                    <tbody>
                        <?php 
                            $connect = mysqli_connect("localhost", "root", "", "gestion_stage");                      
                            //inclure la page de connexion
                            $query ="SELECT * FROM `entreprise`;";  
                            $result = mysqli_query($connect, $query);  
                                //si non , affichons la liste de tous les employés
                                while($row = mysqli_fetch_array($result)){
                                    ?>
                                    <tr>
                                        <td><?=$row['nomEntreprise']?></td>
                                        <td><?=$row['rueEntreprise']?></td>
                                        <td><?=$row['villeEntreprise']?></td>
                                        <td><?=$row['cpEntreprise']?></td>
                                        <td><?=$row['representantEntreprise']?></td>
                                        <td><?=$row['serviceEntreprise']?></td>
                                        <td><?=$row['telEntreprise']?></td>
                                        <td><?=$row['emailEntreprise']?></td>
                                        <td><?=$row['secteurEntreprise']?></td>
                                        <td><?=$row['fonctionEntreprise']?></td>   

                                        <!--Nous alons mettre l'id de chaque employé dans ce lien -->
                                        <form action="" method="POST">
                                        <td> <a type="button" class="modifierbtn" id="<?=$row['idEntreprise']?>" data-toggle="modal" data-target="#modifierModal"><img src="img/pen.png"></a></td>
                                        <td> <a type="button" class="suppbtn" id="<?=$row['idEntreprise']?>" data-toggle="modal" data-target="#supprimerModal"><img src="img/trash.png"></a></td>
                                        </form>
                                    </tr>
                                    <?php
                            }
                        ?>
                        </tbody> 
                </table>
            </div>
        </div>
  <!----------------------------------------------------FIN TABLEAU DE DONNEES---------------------------------------------------->



  <!----------------------------------------------------FORMULAIRE D'AJOUT---------------------------------------------------->
  <div class="modif">
  <div class="modal fade" id="ajouterModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Formulaire d'ajout</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" method="POST">
                <div class="form-group">
                    <label for="recipient-name" class="col-form-label">Nom :</label>
                    <input type="text" name="nom" class="form-control" id="recipient-name" required>
                    
                    <label for="recipient-name" class="col-form-label">Rue :</label>
                    <input type="text" name="rue" class="form-control" id="recipient-name" required>
                    
                    <label for="recipient-name" class="col-form-label">Code postal :</label>
                    <input type="text" name="cp" class="form-control" id="recipient-name" required>
                    
                    <label for="recipient-name" class="col-form-label">Ville :</label>
                    <input type="text" name="ville" class="form-control" id="recipient-name" required>

                    <label for="recipient-name" class="col-form-label">Représentant :</label>
                    <input type="text" name="repres" class="form-control" id="recipient-name" required>

                    <label for="recipient-name" class="col-form-label">Service :</label>
                    <input type="text" name="service" class="form-control" id="recipient-name" required>

                    <label for="recipient-name" class="col-form-label">Numéro de téléphone :</label>
                    <input type="text" name="tel" class="form-control" id="recipient-name" required>

                    <label for="recipient-name" class="col-form-label">Email :</label>
                    <input type="text" name="email" class="form-control" id="recipient-name" required>

                    <label for="recipient-name" class="col-form-label">Secteur d'activité :</label>
                    <input type="text" name="secteur" class="form-control" id="recipient-name" required>

                    <label for="recipient-name" class="col-form-label">Fonction :</label>
                    <input type="text" name="fonction" class="form-control" id="recipient-name" required>
                </div>
            </div>
           
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                <button type="submit" name="btnajouter" class="btn btn-primary">Ajouter</button>
            </div>
        </div>
            </form>
            <?php
            if(isset($_POST['btnajouter'])){
                extract($_POST);
                $Mesfonctions->createEntreprise($_POST['nom'], $_POST['rue'], $_POST['cp'], $_POST['ville'], $_POST['repres'], $_POST['service'], $_POST['tel'], $_POST['email'], $_POST['secteur'], $_POST['fonction']);
                echo "<meta http-equiv='refresh' content='0'>"; 
            }
            ?>
            </div>
        </div>
    </div>
   <!----------------------------------------------------FIN FORMULAIRE D'AJOUT---------------------------------------------------->



   <!----------------------------------------------------FORMULAIRE DE MODIFICATION---------------------------------------------------->
   <div class="modif">
    <div class="modal fade" id="modifierModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Formulaire de modification</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                <div class="modal-body">
                <form action="" method="POST">
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Nom :</label>
                        <input type="text" name="nom_modif" class="form-control" id="nom_modif" required>
                        <input type="hidden" id="id_modif" name="id_modif" class="form-control" id="recipient-name">
                        
                        <label for="recipient-name" class="col-form-label">Rue :</label>
                        <input type="text" name="rue_modif" class="form-control" id="rue_modif" required>
                        
                        <label for="recipient-name" class="col-form-label">Code postal :</label>
                        <input type="text" name="cp_modif" class="form-control" id="cp_modif" required>
                        
                        <label for="recipient-name" class="col-form-label">Ville :</label>
                        <input type="text" name="ville_modif" class="form-control" id="ville_modif" required>

                        <label for="recipient-name" class="col-form-label">Représentant :</label>
                        <input type="text" name="repres_modif" class="form-control" id="repres_modif" required>

                        <label for="recipient-name" class="col-form-label">Service :</label>
                        <input type="text" name="service_modif" class="form-control" id="service_modif" required>

                        <label for="recipient-name" class="col-form-label">Numéro de téléphone :</label>
                        <input type="text" name="tel_modif" class="form-control" id="tel_modif" required>

                        <label for="recipient-name" class="col-form-label">Email :</label>
                        <input type="text" name="email_modif" class="form-control" id="email_modif" required>

                        <label for="recipient-name" class="col-form-label">Secteur d'activité :</label>
                        <input type="text" name="secteur_modif" class="form-control" id="secteur_modif" required>

                        <label for="recipient-name" class="col-form-label">Fonction :</label>
                        <input type="text" name="fonction_modif" class="form-control" id="fonction_modif" required>
                    </div>   
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                <button type="submit" name="modifier" class="btn btn-primary">Modifier</button>
        </div>   
                <?php
                if(isset($_POST['modifier'])){
                extract($_POST);
                $Mesfonctions->updateEntreprise($_POST['id_modif'],$_POST['nom_modif'], $_POST['rue_modif'], $_POST['cp_modif'], $_POST['ville_modif'], $_POST['repres_modif'], $_POST['service_modif'], $_POST['tel_modif'], $_POST['email_modif'], $_POST['secteur_modif'], $_POST['fonction_modif']);
                echo "<meta http-equiv='refresh' content='0'>";
                    } ?>
                </form>
            </div>
        </div>
        </div>
    </div>
   <!----------------------------------------------------FIN FORMULAIRE DE MODIFICATION---------------------------------------------------->



   <!----------------------------------------------------FORMULAIRE DE SUPRESSION---------------------------------------------------->
   <div class="modal fade" id="supprimerModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Formulaire de suppression</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
          <form action="" method="POST">
              <div class="form-group">
              <label for="recipient-name" class="col-form-label">Voulez-vous vraiment supprimer cette entreprise ?</label>
              <input type="hidden" id="id_suppr" name="id_suppr" class="form-control" id="recipient-name">
              </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
            <button type="submit" name="supprimer" class="btn btn-danger">Supprimer</button>
            <?php
              if(isset($_POST['supprimer'])){
              extract($_POST);
              $Mesfonctions->deleteEntreprise($_POST['id_suppr']);
              echo "<meta http-equiv='refresh' content='0'>";
                } ?>
              </form>
            </div>
          </div>
        </div>
      </div>
   <!----------------------------------------------------FIN FORMULAIRE DE SUPRESSION---------------------------------------------------->

</body>
</html>
<!-- Function used to shrink nav bar removing paddings and adding black background -->
    <script>
        $(window).scroll(function() {
            if ($(document).scrollTop() > 50) {
                $('.nav').addClass('affix');
                console.log("OK");
            } else {
                $('.nav').removeClass('affix');
            }
        });
    </script>
<!-- partial -->
  <script  src="libs/script3.js"></script>
  <script>
         if ( window.history.replaceState ) {
             window.history.replaceState( null, null, window.location.href );
         }
      </script>
<script>
   $(".modifierbtn").click(function(){
    var id_row = $(this).attr("id");
    document.getElementById("id_modif").value = id_row;
   })
   $(".suppbtn").click(function(){
    var id_row = $(this).attr("id");
  document.getElementById("id_suppr").value = id_row;
  console.log(id_row);
   })
</script>
<script>
         $(".modifierbtn").click(function(){
             var id_row = $(this).attr("id");

             $.ajax({
                 type: "POST",
                 url: 'getemployebyentreprise.php',
                 data: { id_row : id_row },
                 success: function(data)
                 {                   
                     data = JSON.parse(data);
                     document.getElementById("nom_modif").value = data.nomEntreprise;                   
                     document.getElementById("rue_modif").value = data.rueEntreprise;
                     document.getElementById("cp_modif").value = data.cpEntreprise;
                     document.getElementById("ville_modif").value = data.villeEntreprise;
                     document.getElementById("repres_modif").value = data.representantEntrepr;
                     document.getElementById("service_modif").value = data.serviceEntreprise;
                     document.getElementById("tel_modif").value = data.telEntreprise;
                     document.getElementById("email_modif").value = data.emailEntreprise;
                     document.getElementById("secteur_modif").value = data.secteurEntreprise;
                     document.getElementById("fonction_modif").value = data.fonctionEntreprise;
                 }
             });
         });

</script>
<script>
$(document).ready(function() {
    $('#matable').DataTable( {
        language: {
            url: './DataTables/french_datatable.json'
        }
    } );
} );
</script>
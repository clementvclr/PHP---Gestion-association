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
                            <td>Lieu du stage</td>
                            <td>Jours effectifs</td>
                            <td>Type de stage</td>
                            <td>Sujet du stage</td>
                            <td>Durée du stage</td>
                            <td>Début du stage</td>
                            <td>Fin du stage</td>
                            <td>Présence</td>
                            <td>Nom de l'outil utilisé</td>
                            <td>Utilité de l'outil utilisé</td>
                            <td>Gratification</td>
                            <td>Classe</td>
                            <td>Tuteur</td>
                            <td>Professeur</td>
                            <td>Etudiant</td>
                        </tr>
                    </thead>    
                    <tbody>
                        <?php 
                            $connect = mysqli_connect("localhost", "root", "", "gestion_stage");                      
                            //inclure la page de connexion
                            $query ="SELECT * FROM `stage`;";  
                            $result = mysqli_query($connect, $query);  
                                //si non , affichons la liste de tous les employés
                                while($row = mysqli_fetch_array($result)){
                                    ?>
                                    <tr>
                                        <td><?=$row['lieuStage']?></td>
                                        <td><?=$row['joursEffectifs']?></td>
                                        <td><?=$row['typeStage']?></td>
                                        <td><?=$row['sujetStage']?></td>
                                        <td><?=$row['dureeStage']?></td>
                                        <td><?=$row['debutStage_']?></td>
                                        <td><?=$row['finStage']?></td>
                                        <td><?=$row['presence']?></td>
                                        <td><?=$row['nomOutil']?></td>
                                        <td><?=$row['utiliteOutil']?></td>
                                        <td><?=$row['gratification']?></td>
                                        <td><?=$row['idClasse']?></td>
                                        <td><?=$row['numTuteur']?></td>
                                        <td><?=$row['numProfesseur']?></td>
                                        <td><?=$row['numEtudiant']?></td>   

                                        <!--Nous alons mettre l'id de chaque employé dans ce lien -->
                                        <form action="" method="POST">
                                        <td> <a type="button" class="modifierbtn" id="<?=$row['numStage']?>" data-toggle="modal" data-target="#modifierModal"><img src="img/pen.png"></a></td>
                                        <td> <a type="button" class="suppbtn" id="<?=$row['numStage']?>" data-toggle="modal" data-target="#supprimerModal"><img src="img/trash.png"></a></td>
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
                    <label for="recipient-name" class="col-form-label">Lieu du stage :</label>
                    <input type="text" name="lieu" class="form-control" id="recipient-name" required>
                    
                    <label for="recipient-name" class="col-form-label">Jours effectifs :</label>
                    <input type="text" name="jours" class="form-control" id="recipient-name" required>
                    
                    <label for="recipient-name" class="col-form-label">Type de stage :</label>
                    <input type="text" name="type" class="form-control" id="recipient-name" required>
                    
                    <label for="recipient-name" class="col-form-label">Sujet du stage :</label>
                    <input type="text" name="sujet" class="form-control" id="recipient-name" required>

                    <label for="recipient-name" class="col-form-label">Durée du stage :</label>
                    <input type="text" name="duree" class="form-control" id="recipient-name" required>

                    <label for="recipient-name" class="col-form-label">Début du stage :</label>
                    <input type="text" placeholder="AAAA-MM-JJ" name="debutStage" class="form-control" id="recipient-name" required>

                    <label for="recipient-name" class="col-form-label">Fin du stage :</label>
                    <input type="text" placeholder="AAAA-MM-JJ" name="finStage" class="form-control" id="recipient-name" required>

                    <label for="recipient-name" class="col-form-label">Présence :</label>
                    <input type="text" name="presence" class="form-control" id="recipient-name" required>

                    <label for="recipient-name" class="col-form-label">Nom de l'outil utilisé :</label>
                    <input type="text" name="nomOutil" class="form-control" id="recipient-name" required>

                    <label for="recipient-name" class="col-form-label">Utilité de l'outil utilisé :</label>
                    <input type="text" name="utiliteOutil" class="form-control" id="recipient-name" required>

                    <label for="recipient-name" class="col-form-label">Gratification :</label>
                    <input type="text" name="gratification" class="form-control" id="recipient-name" required>

                    <label for="recipient-name" class="col-form-label">Classe :</label>
                    <?php
                      $connect = mysqli_connect("localhost", "root", "", "gestion_stage");                      
                      $query = "SELECT idClasse, libelleClasse, anneeClasse FROM classe";
                      $result = mysqli_query($connect, $query);
                    
                      echo '<select name="idClasse">';
                      while ($row = mysqli_fetch_assoc($result)) {
                          echo "<option value='{$row['idClasse']}'>{$row['libelleClasse']} {$row['anneeClasse']}</option>";
                      }
                      echo '</select>';
                    ?> </br>

                    <label for="recipient-name" class="col-form-label">Tuteur :</label>
                    <?php
                      $connect = mysqli_connect("localhost", "root", "", "gestion_stage");                      
                      $query = "SELECT numTuteur, nomTuteur, prenom FROM tuteur";
                      $result = mysqli_query($connect, $query);
                    
                      echo '<select name="numTuteur">';
                      while ($row = mysqli_fetch_assoc($result)) {
                          echo "<option value='{$row['numTuteur']}'>{$row['nomTuteur']} {$row['prenom']}</option>";
                      }
                      echo '</select>';
                    ?> </br>
                    

                    <label for="recipient-name" class="col-form-label">Professeur :</label>
                    <?php
                      $connect = mysqli_connect("localhost", "root", "", "gestion_stage");                      
                      $query = "SELECT numProfesseur, nomProfesseur, prenomProfesseur FROM professeur_";
                      $result = mysqli_query($connect, $query);
                    
                      echo '<select name="numProfesseur">';
                      while ($row = mysqli_fetch_assoc($result)) {
                          echo "<option value='{$row['numProfesseur']}'>{$row['nomProfesseur']} {$row['prenomProfesseur']}</option>";
                      }
                      echo '</select>';
                    ?> </br>

                    <label for="recipient-name" class="col-form-label">Etudiant :</label>
                    <?php
                      $connect = mysqli_connect("localhost", "root", "", "gestion_stage");                      
                      $query = "SELECT numEtudiant, nomEtudiant, prenomEtudiant FROM etudiant";
                      $result = mysqli_query($connect, $query);
                    
                      echo '<select name="numEtudiant">';
                      while ($row = mysqli_fetch_assoc($result)) {
                          echo "<option value='{$row['numEtudiant']}'>{$row['nomEtudiant']} {$row['prenomEtudiant']}</option>";
                      }
                      echo '</select>';
                    ?> </br>
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
                $Mesfonctions->createStage($_POST['lieu'], $_POST['jours'], $_POST['type'], $_POST['sujet'], $_POST['duree'], $_POST['debutStage'], $_POST['finStage'], $_POST['presence'], $_POST['nomOutil'], $_POST['utiliteOutil'], $_POST['gratification'], $_POST['idClasse'], $_POST['numTuteur'], $_POST['numProfesseur'], $_POST['numEtudiant']);
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
                        <label for="recipient-name" class="col-form-label">Lieu du stage :</label>
                        <input type="text" name="lieu_modif" class="form-control" id="lieu_modif" required>
                        <input type="hidden" id="id_modif" name="id_modif" class="form-control" id="recipient-name">
                        
                        <label for="recipient-name" class="col-form-label">Jours effectifs :</label>
                        <input type="text" name="jours_modif" class="form-control" id="jours_modif" required>
                        
                        <label for="recipient-name" class="col-form-label">Type de stage :</label>
                        <input type="text" name="type_modif" class="form-control" id="type_modif" required>
                        
                        <label for="recipient-name" class="col-form-label">Sujet du stage :</label>
                        <input type="text" name="sujet_modif" class="form-control" id="sujet_modif" required>

                        <label for="recipient-name" class="col-form-label">Durée du stage :</label>
                        <input type="text" name="duree_modif" class="form-control" id="duree_modif" required>

                        <label for="recipient-name" class="col-form-label">Début du stage :</label>
                        <input type="text" name="debutStage_modif" class="form-control" id="debutStage_modif" required>

                        <label for="recipient-name" class="col-form-label">Fin du stage :</label>
                        <input type="text" name="finStage_modif" class="form-control" id="finStage_modif" required>

                        <label for="recipient-name" class="col-form-label">Présence :</label>
                        <input type="text" name="presence_modif" class="form-control" id="presence_modif" required>

                        <label for="recipient-name" class="col-form-label">Nom de l'outil utilisé :</label>
                        <input type="text" name="nomOutil_modif" class="form-control" id="nomOutil_modif" required>

                        <label for="recipient-name" class="col-form-label">Utilité de l'outil utilisé :</label>
                        <input type="text" name="utiliteOutil_modif" class="form-control" id="utiliteOutil_modif" required>

                        <label for="recipient-name" class="col-form-label">Gratification :</label>
                        <input type="text" name="gratification_modif" class="form-control" id="gratification_modif" required>

                        <label for="recipient-name" class="col-form-label">Classe :</label>
                        <?php
                          $connect = mysqli_connect("localhost", "root", "", "gestion_stage");                      
                          $query = "SELECT idClasse, libelleClasse, anneeClasse FROM classe";
                          $result = mysqli_query($connect, $query);
                        
                          echo '<select name="idClasse_modif" id="classe_modif" required>';
                          while ($row = mysqli_fetch_assoc($result)) {
                              echo "<option value='{$row['idClasse']}'>{$row['libelleClasse']} {$row['anneeClasse']}</option>";
                          }
                          echo '</select>';
                        ?> </br>

                        <label for="recipient-name" class="col-form-label">Tuteur :</label>
                        <?php
                          $connect = mysqli_connect("localhost", "root", "", "gestion_stage");                      
                          $query = "SELECT numTuteur, nomTuteur, prenom FROM tuteur";
                          $result = mysqli_query($connect, $query);
                        
                          echo '<select name="numTuteur_modif" id="tuteur_modif" required>';
                          while ($row = mysqli_fetch_assoc($result)) {
                              echo "<option value='{$row['numTuteur']}'>{$row['nomTuteur']} {$row['prenom']}</option>";
                          }
                          echo '</select>';
                        ?> </br>
                        

                        <label for="recipient-name" class="col-form-label">Professeur :</label>
                        <?php
                          $connect = mysqli_connect("localhost", "root", "", "gestion_stage");                      
                          $query = "SELECT numProfesseur, nomProfesseur, prenomProfesseur FROM professeur_";
                          $result = mysqli_query($connect, $query);
                        
                          echo '<select name="numProfesseur_modif" id="professeur_modif" required>';
                          while ($row = mysqli_fetch_assoc($result)) {
                              echo "<option value='{$row['numProfesseur']}'>{$row['nomProfesseur']} {$row['prenomProfesseur']}</option>";
                          }
                          echo '</select>';
                        ?> </br>

                        <label for="recipient-name" class="col-form-label">Etudiant :</label>
                        <?php
                          $connect = mysqli_connect("localhost", "root", "", "gestion_stage");                      
                          $query = "SELECT numEtudiant, nomEtudiant, prenomEtudiant FROM etudiant";
                          $result = mysqli_query($connect, $query);
                        
                          echo '<select name="numEtudiant_modif" id="etudiant_modif" required>';
                          while ($row = mysqli_fetch_assoc($result)) {
                              echo "<option value='{$row['numEtudiant']}'>{$row['nomEtudiant']} {$row['prenomEtudiant']}</option>";
                          }
                          echo '</select>';
                        ?> </br>
                        <!-- <label for="recipient-name" class="col-form-label">Classe :</label>
                        <input type="text" name="classe_modif" class="form-control" id="classe_modif" required>

                        <label for="recipient-name" class="col-form-label">Tuteur :</label>
                        <input type="text" name="tuteur_modif" class="form-control" id="tuteur_modif" required>

                        <label for="recipient-name" class="col-form-label">Professeur :</label>
                        <input type="text" name="professeur_modif" class="form-control" id="professeur_modif" required>

                        <label for="recipient-name" class="col-form-label">Etudiant :</label>
                        <input type="text" name="etudiant_modif" class="form-control" id="etudiant_modif" required> -->
                    </div>   
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                <button type="submit" name="modifier" class="btn btn-primary">Modifier</button>
        </div>   
                <?php
                if(isset($_POST['modifier'])){
                extract($_POST);
                $Mesfonctions->updateStage($_POST['id_modif'],$_POST['lieu_modif'], $_POST['jours_modif'], $_POST['type_modif'], $_POST['sujet_modif'], $_POST['duree_modif'], $_POST['debutStage_modif'], $_POST['finStage_modif'], $_POST['presence_modif'], $_POST['nomOutil_modif'], $_POST['utiliteOutil_modif'], $_POST['gratification_modif'], $_POST['idClasse_modif'], $_POST['numTuteur_modif'], $_POST['numProfesseur_modif'], $_POST['numEtudiant_modif']);
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
              <label for="recipient-name" class="col-form-label">Voulez-vous vraiment supprimer ce stage ?</label>
              <input type="hidden" id="id_suppr" name="id_suppr" class="form-control" id="recipient-name">
              </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
            <button type="submit" name="supprimer" class="btn btn-danger">Supprimer</button>
            <?php
              if(isset($_POST['supprimer'])){
              extract($_POST);
              $Mesfonctions->deleteStage($_POST['id_suppr']);
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
                 url: 'getemployebystage.php',
                 data: { id_row : id_row },
                 success: function(data)
                 {                   
                     data = JSON.parse(data);
                     document.getElementById("lieu_modif").value = data.lieuStage;                   
                     document.getElementById("jours_modif").value = data.joursEffectifs;
                     document.getElementById("type_modif").value = data.typeStage;
                     document.getElementById("sujet_modif").value = data.sujetStage;
                     document.getElementById("duree_modif").value = data.duréeStage;
                     document.getElementById("debutStage_modif").value = data.débutStage_;
                     document.getElementById("finStage_modif").value = data.finStage;
                     document.getElementById("presence_modif").value = data.presence;
                     document.getElementById("nomOutil_modif").value = data.nomOutil;
                     document.getElementById("utiliteOutil_modif").value = data.utiliteOutil;
                     document.getElementById("gratification_modif").value = data.gratification;
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
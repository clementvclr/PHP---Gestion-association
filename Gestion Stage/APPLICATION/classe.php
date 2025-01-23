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
                </div>
            </nav>
        </header>
  <!----------------------------------------------------NAVBAR---------------------------------------------------->
  
  

  <!----------------------------------------------------TABLEAU DE DONNEES---------------------------------------------------->
    <button type="button" class="Btn_add" data-toggle="modal" data-target="#ajouterModal" data-whatever="@mdo">Ajouter</button>
        <div class="container4">
            <div class="row">  
                <table id="matable" class="table table-striped" style="width:100%">
                    <thead>
                        <tr id="items">
                            <td>Professeur principal</td>
                            <td>Année</td>
                            <td>Effectif</td>
                            <td>Nombre d'heure</td>
                            <td>Libellé</td>
                            <td>Modifer</td>
                            <td>Supprimer</td>
                        </tr>
                    </thead>    
                    <tbody>
                        <?php 
                            $connect = mysqli_connect("localhost", "root", "", "gestion_stage");                      
                            //inclure la page de connexion
                            $query ="SELECT * FROM `classe`;";  
                            $result = mysqli_query($connect, $query);  
                                //si non , affichons la liste de tous les employés
                                while($row = mysqli_fetch_array($result)){
                                    ?>
                                    <tr>
                                        <td><?=$row['profPrincipal']?></td>
                                        <td><?=$row['anneeClasse']?></td>
                                        <td><?=$row['effectifClasse']?></td>
                                        <td><?=$row['nbHeuresTotal']?></td>
                                        <td><?=$row['libelleClasse']?></td>

                                        <!--Nous alons mettre l'id de chaque employé dans ce lien -->
                                        <form action="" method="POST">
                                        <td> <a type="button" class="modifierbtn" id="<?=$row['idClasse']?>" data-toggle="modal" data-target="#modifierModal"><img src="img/pen.png"></a></td>
                                        
                                        <td> <a type="button" class="suppbtn" id="<?=$row['idClasse']?>" data-toggle="modal" data-target="#supprimerModal"><img src="img/trash.png"></a></td>
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
                    <label for="recipient-name" class="col-form-label">Nom du profeseur principal:</label>
                    <input type="text" name="nomProf" class="form-control" id="recipient-name" required>
                    
                    <label for="recipient-name" class="col-form-label">Année :</label>
                    <input type="text" name="annee" class="form-control" id="recipient-name" required>
                    
                    <label for="recipient-name" class="col-form-label">Effectif :</label>
                    <input type="text" name="effectif" class="form-control" id="recipient-name" required>
                    
                    <label for="recipient-name" class="col-form-label">Nombre d'heures :</label>
                    <input type="text" name="nbheures" class="form-control" id="recipient-name" required>

                    <label for="recipient-name" class="col-form-label">Libellé :</label>
                    <input type="text" name="libelle" class="form-control" id="recipient-name" required>
                </div>
            </div>  
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                <button type="submit" name="btnajouter" class="btn btn-primary">Ajouter</button>
            </div>
            </form>
            <?php
            if(isset($_POST['btnajouter'])){
                extract($_POST);
                $Mesfonctions->createClasse($_POST['nomProf'], $_POST['annee'], $_POST['effectif'], $_POST['nbheures'], $_POST['libelle']);
                echo "<meta http-equiv='refresh' content='0'>";
            }
            ?>
            </div>
        </div>
    </div>
   <!----------------------------------------------------FIN FORMULAIRE D'AJOUT---------------------------------------------------->



   <!----------------------------------------------------FORMULAIRE DE MODIFICATION---------------------------------------------------->
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
                    <label for="recipient-name" class="col-form-label">Nom du professeur principal:</label>
                    <input type="text" name="nom_modif" class="form-control" id="nom_modif" required>
                    <input type="hidden" id="id_modif" name="id_modif" class="form-control" id="recipient-name">
                    
                    <label for="recipient-name" class="col-form-label">Année :</label>
                    <input type="text" name="annee_modif" class="form-control" id="annee_modif" required>
                    
                    <label for="recipient-name" class="col-form-label">Effectif :</label>
                    <input type="text" name="effectif_modif" class="form-control" id="effectif_modif" required>
                    
                    <label for="recipient-name" class="col-form-label">Nombre d'heures :</label>
                    <input type="text" name="nbheures_modif" class="form-control" id="nbheures_modif" required>

                    <label for="recipient-name" class="col-form-label">Libellé :</label>
                    <input type="text" name="libelle_modif" class="form-control" id="libelle_modif" required>
                </div>            
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                <button type="submit" name="modifier" class="btn btn-primary">Modifier</button>
                <?php
                if(isset($_POST['modifier'])){
                extract($_POST);
                $Mesfonctions->updateClasse($_POST['id_modif'],$_POST['nom_modif'], $_POST['annee_modif'], $_POST['effectif_modif'], $_POST['nbheures_modif'], $_POST['libelle_modif']);
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
                <label for="recipient-name" class="col-form-label">Voulez-vous vraiment supprimer cette classe ?</label>
                <input type="hidden" id="id_suppr" name="id_suppr" class="form-control" id="recipient-name">
                </div>
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                <button type="submit" name="supprimer" class="btn btn-danger">Supprimer</button>
                <?php
                if(isset($_POST['supprimer'])){
                extract($_POST);
                $Mesfonctions->deleteClasse($_POST['id_suppr']);
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
                 url: 'getemployebyclasse.php',
                 data: { id_row : id_row },
                 success: function(data)
                 {      
                                 
                     data = JSON.parse(data);
                     console.log(data); 
                     document.getElementById("nom_modif").value = data.profPrincipal;                   
                     document.getElementById("annee_modif").value = data.anneeClasse;
                     document.getElementById("effectif_modif").value = data.effectifClasse;
                     document.getElementById("nbheures_modif").value = data.nbHeuresTotal;
                     document.getElementById("libelle_modif").value = data.libelleClasse;
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
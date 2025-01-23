<?php
session_start();
if (($_SESSION['pseudo'] == null)) {
    header("Location: ./index.php");
    exit;
}
session_write_close();        

?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Accueil</title>
  <link rel="stylesheet" href="libs/style2.css">
  <link rel="icon" type="image/png" href="img/logo.png" />
</head>
<body>
<!-- partial:index.partial.html -->
<nav class="nav">
        <div class="container">
            <div class="logo">
                <img src="img/logo_final.png" alt="logo">
            </div>
            <div id="mainListDiv" class="main_list">
                <ul class="navlinks">
                <li><a href="./accueil.php">Accueil</a></li>
                    <li><a href="./etudiant.php">Etudiant</a></li>
                    <li><a href="./professeur.php">Professeur</a></li>
                    <li><a href="./entreprise.php">Entreprise</a></li>
                    <li><a href="./tuteur.php">Tuteur</a></li>
                    <li><a href="./classe.php">classe</a></li>
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

    <section class="home">
        <test class="test"></test>
    </section>


<!-- Jquery needed -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="js/scripts.js"></script>

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
  <script  src="libs/script2.js"></script>

</body>
</html>

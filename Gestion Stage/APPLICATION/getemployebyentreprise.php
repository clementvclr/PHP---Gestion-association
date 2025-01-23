<?php
require_once "connexion.php";

    $uid = $_POST['id_row'];
    $insertion= array();
    $insertion = $connexion->query("SELECT * FROM entreprise WHERE idEntreprise = '$uid'")->fetch(PDO::FETCH_OBJ);
    echo (json_encode($insertion));
?>
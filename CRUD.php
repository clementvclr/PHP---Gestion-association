<?php 

class Mesfonctions{
    
	//<------------------------------------------------------CONNEXION------------------------------------------------------>//
    	public function getDatabaseConnexion() {
		try {
		    $user = "root";
			$pass = "";
			$pdo = new PDO('mysql:host=localhost;dbname=gestion_stage',$user,$pass,array(PDO::ATTR_PERSISTENT => true));
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			return $pdo;
			
		} catch (PDOException $e) {
		    print "Erreur !: " . $e->getMessage() . "<br/>";
		    die();
		}
	}
	//<------------------------------------------------------FIN CONNEXION------------------------------------------------------>//
	

	//<------------------------------------------------------ETUDIANT------------------------------------------------------>//
	
	//créer un étudiant
	public function createEtudiant($nomEtudiant, $prenomEtudiant, $nombreStage, $adresse,$dateNaissance,$email,$numTel,$intituleFormation) {
		try {
			$con = $this->getDatabaseConnexion();
			$sql = "INSERT INTO `etudiant`(`nomEtudiant`, `prenomEtudiant`, `nombreStage`, `adresse`, `dateNaissance`, `numTel`, `email`, `intituleFormation`) VALUES ('$nomEtudiant', '$prenomEtudiant', '$nombreStage' ,'$adresse','$dateNaissance','$email','$numTel','$intituleFormation')";
	    	$con->exec($sql);
		}
	    catch(PDOException $e) {
	    	echo $sql . "<br>" . $e->getMessage();
	    }
	}

	//modifie un étudiant
	public function updateEtudiant($id,$nomEtudiant, $prenomEtudiant, $nombreStage, $adresse,$dateNaissance,$email,$numTel,$intituleFormation) {
		try {
			$con = $this->getDatabaseConnexion();
			$requete = "UPDATE `etudiant` set 
						`nomEtudiant` = '$nomEtudiant',
						`prenomEtudiant` = '$prenomEtudiant',
						`nombreStage` = '$nombreStage',
						`adresse` = '$adresse',
						`dateNaissance` = '$dateNaissance',
						`email` = '$email',
						`numTel` = '$numTel',
						`intituleFormation` = '$intituleFormation'
						where numEtudiant = '$id'";
			$stmt = $con->query($requete);
		}	
	    catch(PDOException $e) {
	    	echo $requete . "<br>" . $e->getMessage();
	    }
	}
	
	//supprime un étudiant
	public function deleteEtudiant($id) {
		try {
			$con = $this->getDatabaseConnexion();
			$requete = "DELETE FROM `etudiant` where numEtudiant = '$id'";
			$stmt = $con->query($requete);
		}
	    catch(PDOException $e) {
	    	echo $sql . "<br>" . $e->getMessage();
	    }
	}
	//<------------------------------------------------------FIN ETUDIANT------------------------------------------------------>//


	//<------------------------------------------------------PROFESSEUR------------------------------------------------------>//
	
	//créer un professeur
	public function createProfesseur($nomProfesseur, $prenomProfesseur, $suiviStage, $sexeProfesseur) {
		try {
			$con = $this->getDatabaseConnexion();
			$sql = "INSERT INTO `professeur_`(`nomProfesseur`, `prenomProfesseur`, `suiviStage`, `sexeProfesseur`) VALUES ('$nomProfesseur', '$prenomProfesseur', '$suiviStage' ,'$sexeProfesseur')";
	    	$con->exec($sql);
		}
	    catch(PDOException $e) {
	    	echo $sql . "<br>" . $e->getMessage();
	    }
	}

	//mofidie un professeur
	public function updateProfesseur($id,$nomProfesseur, $prenomProfesseur, $suiviStage, $sexeProfesseur) {
		try {
			$con = $this->getDatabaseConnexion();
			$requete = "UPDATE `professeur_` set 
						`nomProfesseur` = '$nomProfesseur',
						`prenomProfesseur` = '$prenomProfesseur',
						`suiviStage` = '$suiviStage',
						`sexeProfesseur` = '$sexeProfesseur'
						where numProfesseur = '$id'";
			$stmt = $con->query($requete);
		}	
	    catch(PDOException $e) {
	    	echo $requete . "<br>" . $e->getMessage();
	    }
	}

	//supprime un professeur
	public function deleteProfesseur($id) {
		try {
			$con = $this->getDatabaseConnexion();
			$requete = "DELETE FROM `professeur_` where numProfesseur = '$id'";
			$stmt = $con->query($requete);
		}
	    catch(PDOException $e) {
	    	echo $sql . "<br>" . $e->getMessage();
	    }
	}
	//<------------------------------------------------------FIN PROFESSEUR------------------------------------------------------>//


	//<------------------------------------------------------TUTEUR------------------------------------------------------>//
	
	//créer un tuteur
	public function createTuteur($nomTuteur, $prenom, $telTuteur, $emailTuteur, $idEntreprise) {
		try {
			$con = $this->getDatabaseConnexion();
			$sql = "INSERT INTO `tuteur`(`nomTuteur`, `prenom`, `telTuteur`, `emailTuteur`, `idEntreprise`) VALUES ('$nomTuteur', '$prenom', '$telTuteur' ,'$emailTuteur','$idEntreprise')";
	    	$con->exec($sql);
		}
	    catch(PDOException $e) {
	    	echo $sql . "<br>" . $e->getMessage();
	    }
	}

	//modifie un tuteur
	public function updateTuteur($id,$nomTuteur, $prenomTuteur, $telTuteur, $emailTuteur, $idEntreprise) {
		try {
			$con = $this->getDatabaseConnexion();
			$requete = "UPDATE `tuteur` set 
						`nomTuteur` = '$nomTuteur',
						`prenom` = '$prenomTuteur',
						`telTuteur` = '$telTuteur',
						`emailTuteur` = '$emailTuteur',
						`idEntreprise` = '$idEntreprise'
						where numTuteur = '$id'";
			$stmt = $con->query($requete);
		}	
	    catch(PDOException $e) {
	    	echo $requete . "<br>" . $e->getMessage();
	    }
	}

	//supprime un tuteur
	public function deleteTuteur($id) {
		try {
			$con = $this->getDatabaseConnexion();
			$requete = "DELETE FROM `tuteur` where numTuteur = '$id'";
			$stmt = $con->query($requete);
		}
	    catch(PDOException $e) {
	    	echo $sql . "<br>" . $e->getMessage();
	    }
	}
	//<------------------------------------------------------FIN TUTEUR------------------------------------------------------>//


	//<------------------------------------------------------ENTREPRISE------------------------------------------------------>//
	
	//créer une entreprise
	public function createEntreprise($nomEntreprise, $rue, $cp, $ville, $representant,$service,$tel,$email,$secteur,$fonction) {
		try {
			$con = $this->getDatabaseConnexion();
			$sql = "INSERT INTO `entreprise`(`nomEntreprise`, `rueEntreprise`, `cpEntreprise`, `villeEntreprise`, `representantEntreprise`, `serviceEntreprise`, `telEntreprise`, `emailEntreprise`, `secteurEntreprise`, `fonctionEntreprise`) 
			VALUES ('$nomEntreprise', '$rue', '$cp' ,'$ville','$representant','$service','$tel','$email','$secteur','$fonction')";
			$con->exec($sql);
		}
	    catch(PDOException $e) {
	    	echo $sql . "<br>" . $e->getMessage();
	    }
	}

	//modifie une entreprise
	public function updateEntreprise($id,$nomEntreprise, $rue, $cp, $ville, $representant,$service,$tel,$email,$secteur,$fonction) {
		try {
			$con = $this->getDatabaseConnexion();
			$requete = "UPDATE `entreprise` set 
						`nomEntreprise` = '$nomEntreprise',
						`rueEntreprise` = '$rue',
						`cpEntreprise` = '$cp',
						`villeEntreprise` = '$ville',
						`representantEntreprise` = '$representant',
						`serviceEntreprise` = '$service',
						`telEntreprise` = '$tel',
						`emailEntreprise` = '$email',
						`secteurEntreprise` = '$secteur',
						`fonctionEntreprise` = '$fonction'
						where idEntreprise = '$id'";
			$stmt = $con->query($requete);
		}	
	    catch(PDOException $e) {
	    	echo $requete . "<br>" . $e->getMessage();
	    }
	}

	//supprime une entreprise
	public function deleteEntreprise($id) {
		try {
			$con = $this->getDatabaseConnexion();
			$requete = "DELETE FROM `entreprise` where idEntreprise = '$id'";
			$stmt = $con->query($requete);
		}
	    catch(PDOException $e) {
	    	echo $sql . "<br>" . $e->getMessage();
	    }
	}
	//<------------------------------------------------------FIN ENTREPRISE------------------------------------------------------>//
	
	
	//<------------------------------------------------------CLASSE------------------------------------------------------>//
	
	//créer une classe
	public function createClasse($prof, $annee, $effec, $nbheure, $libelle) {
		try {
			$con = $this->getDatabaseConnexion();
			$sql = "INSERT INTO `classe`(`profPrincipal`, `anneeClasse`, `effectifClasse`, `nbHeuresTotal`, `libelleClasse`) VALUES ('$prof', '$annee', '$effec' ,'$nbheure','$libelle')";
	    	$con->exec($sql);
		}
	    catch(PDOException $e) {
	    	echo $sql . "<br>" . $e->getMessage();
	    }
	}

	//modifie une classe
	public function updateClasse($id,$prof, $annee, $effec, $nbheure, $libelle) {
		try {
			$con = $this->getDatabaseConnexion();
			$requete = "UPDATE `classe` set 
						`profPrincipal` = '$prof',
						`anneeClasse` = '$annee',
						`effectifClasse` = '$effec',
						`nbHeuresTotal` = '$nbheure',
						`libelleClasse` = '$libelle'
						where idClasse = '$id'";
			$stmt = $con->query($requete);
		}	
	    catch(PDOException $e) {
	    	echo $requete . "<br>" . $e->getMessage();
	    }
	}

	//supprime une classe
	public function deleteClasse($id) {
		try {
			$con = $this->getDatabaseConnexion();
			$requete = "DELETE FROM `classe` where idClasse = '$id'";
			$stmt = $con->query($requete);
		}
	    catch(PDOException $e) {
	    	echo $sql . "<br>" . $e->getMessage();
	    }
	}
	//<------------------------------------------------------FIN CLASSE------------------------------------------------------>//

	//<------------------------------------------------------STAGE------------------------------------------------------>//
	
	//créer un stage
	public function createStage($lieuStage, $joursEffectifs, $typeStage, $sujetStage, $duréeStage, $débutStage_, $finStage, $presence, $nomOutil, $utiliteOutil, $gratification) {
		try {
			$con = $this->getDatabaseConnexion();
			$sql = "INSERT INTO `stage`(`lieuStage`, `joursEffectifs`, `typeStage`, `sujetStage`, `duréeStage`, `débutStage_`, `finStage`, `presence`, `nomOutil`, `utiliteOutil`, `gratification`) VALUES ('$lieuStage', '$joursEffectifs', '$typeStage', '$sujetStage', '$duréeStage', '$débutStage_', '$finStage', '$presence', '$nomOutil', '$utiliteOutil', '$gratification')";
	    	$con->exec($sql);
		}
	    catch(PDOException $e) {
	    	echo $sql . "<br>" . $e->getMessage();
	    }
	}

	//mofidie un stage
	public function updateStage($id, $lieuStage, $joursEffectifs, $typeStage, $sujetStage, $duréeStage, $débutStage_, $finStage, $presence, $nomOutil, $utiliteOutil, $gratification) {
		try {
			$con = $this->getDatabaseConnexion();
			$requete = "UPDATE `stage` set 
						`lieuStage` = '$lieuStage',
						`joursEffectifs` = '$joursEffectifs',
						`typeStage` = '$typeStage',
						`sujetStage` = '$sujetStage',
						`duréeStage` = '$duréeStage',
						`débutStage_` = '$débutStage_',
						`finStage` = '$finStage',
						`presence` = '$presence',
						`nomOutil` = '$nomOutil',
						`utiliteOutil` = '$utiliteOutil',
						`gratification` = '$gratification'
						where numStage = '$id'";
			$stmt = $con->query($requete);
		}	
	    catch(PDOException $e) {
	    	echo $requete . "<br>" . $e->getMessage();
	    }
	}

	//supprime un professeur
	public function deleteStage($id) {
		try {
			$con = $this->getDatabaseConnexion();
			$requete = "DELETE FROM `stage` where numStage = '$id'";
			$stmt = $con->query($requete);
		}
	    catch(PDOException $e) {
	    	echo $requete . "<br>" . $e->getMessage();
	    }
	}
	//<------------------------------------------------------FIN STAGE------------------------------------------------------>//


	
	//<------------------------------------------------------PERMISSIONS------------------------------------------------------>//
	
	//récupere les permissions de l'utilisateur
	public function SearchPerm($id) {
		$con = $this->getDatabaseConnexion();
		$requete = "SELECT Permission from membres where id = '$id' ";
		$stmt = $con->query($requete);
		$row = $stmt->fetchAll();
		if (!empty($row)) {
			return $row[0][0];
		}
	}
	//<------------------------------------------------------FIN PERMISSIONS------------------------------------------------------>//
}
 ?>
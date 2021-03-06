<?php
	include_once 'classe_Image.php';

	$pseudo = $_GET['pseudo'];
	$titre = $_GET['titre'];

	if($pseudo!='null') {
		// Connexion à la base de données
		try {
			$bdd = new PDO('mysql:host=localhost;dbname=faitout', 'root', '');
		}
		catch(Exception $e) {
			die('Erreur : '.$e->getMessage());
		}

		$req = $bdd->prepare('SELECT * FROM `utilisateur` WHERE `pseudo` = ?');
		$req->execute(array($pseudo));
		if(!$req->fetch()) {
			die('401 Erreur : '.$pseudo.' inconnu');
		}

		$res = '';

		$date = date('Y-m-d H:i:s');

		$url = '';

		$maxwidth = 200000;
		$maxheight = 200000;

		if(is_uploaded_file($_FILES['image']['tmp_name'])) {
			if ($_FILES['image']['error'] <= 0) {

				if ($_FILES['image']['size'] > 1048576) 
					$erreur = "Le fichier est trop gros.";

				$extensions_valides = array( 'jpg' , 'jpeg' , 'gif' , 'png' );
				$extension_upload = strtolower(  substr(  strrchr($_FILES['image']['name'], '.')  ,1)  );

				// Vérification de l'extension
				if ( in_array($extension_upload,$extensions_valides) ) {
					$image_sizes = getimagesize($_FILES['image']['tmp_name']);

					// Vérification de la taille de l'image
					if ( !($image_sizes[0] > $maxwidth OR $image_sizes[1] > $maxheight) ) {

						// Créer un dossier
			      		@mkdir('./../../../images/'.$pseudo.'/', 0777, true);
			     
			     		$date_heure = date('Y-m-d-H-i-s');

						// Enregistre le fichier image
						$url_file = "./../../../images/".$pseudo.'/'.$date_heure.'_'.$_FILES['image']['name'];
						$resultat = move_uploaded_file($_FILES['image']['tmp_name'], $url_file);

			      		// Création des attributs de l'image
			      		$date = date('Y-m-d H:i:s');

						$url = "http://mercandalli.com/faitout/images/".$pseudo.'/'.$date_heure.'_'.$_FILES['image']['name'];

						// Création d'une image
						$im = new Image(
							$url,
							$titre, 
							$pseudo,
							$date
						);

						// INSERT de l'image dans la base de données
						$req = $bdd->prepare($im->getinsert());
						$req->execute($im->getarray());

					}
					else {
						$res.='KO';
						echo $res;
					}
				}
				else {
					$res.='KO';
					echo $res;
				}
			}
		}
		$res.='Felicitations, vous avez bien envoye une image.';
	}
	else {
		$res = 'KO';
	}

	echo $res;
?>

<?php

	$pseudo = 'jon';
	$res = '';

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
		      		@mkdir('./../../images/'.$pseudo.'/', 0777, true);

					// Enregistre le fichier image
					$url_file = "./../../images/".$pseudo.'/'.$_FILES['image']['name'];
					$resultat = move_uploaded_file($_FILES['image']['tmp_name'], $url_file);

					$res.='Felicitations.';
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

	echo $res;
?>

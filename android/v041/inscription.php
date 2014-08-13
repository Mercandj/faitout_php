<?php
	include_once 'classe_Utilisateur.php';
	
	$user = new Utilisateur;

	if(isset($_GET['pseudo']))
		$user->pseudo = $_GET['pseudo'];
	if(isset($_GET['mot_de_passe']))
		$user->mot_de_passe = $_GET['mot_de_passe'];
	if(isset($_GET['sexe']))
		$user->sexe = $_GET['sexe'];

	$request_body = file_get_contents('php://input');
	$phpArray = json_decode($request_body, true);
	if($phpArray!=null) {
		foreach ($phpArray as $key => $value) {
		    if($key=="utilisateur") {
			    foreach ($value as $k => $v) {
			    	if($k=="pseudo")
			    		$user->pseudo = $v;
			    	else if($k=="mot_de_passe")
			    		$user->mot_de_passe = $v;
			    	else if($k=="sexe")
			    		$user->sexe = $v;
			    	else if($k=="langue")
			    		$user->langue = $v;
			    	else if($k=="longitude")
			    		$user->longitude = $v;
			    	else if($k=="latitude")
			    		$user->latitude = $v; 
			    }
			}
		}
	}

	if($user->pseudo!='null') {
		// Connexion à la base de données
		try {
			$bdd = new PDO('mysql:host=localhost;dbname=faitout', 'root', '');
		}
		catch(Exception $e) {
			die('Erreur : '.$e->getMessage());
		}

		$res = '';
		$fr = (strpos($user->langue,'fr') !== false);

		if($user->exist($bdd)) {
			if($fr)
				$res.='Ce pseudo est déjà utilisé.';
			else
				$res.='Login already used.';
		}
		else {
			$date = date('Y-m-d H:i:s');
		 	$user->date_de_creation = $date;
		 	$user->date_de_connexion = $date;
			$req = $bdd->prepare($user->getinsert());
			$req->execute($user->getarray());
			$res.='OK';
		}
	}
	else {
		if($fr)
			$res.='Ce pseudo est déjà utilisé.';
		else
			$res.='Login already used.';
	}	

	echo $res;
?>

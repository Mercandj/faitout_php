<?php
	include_once 'lib.php';
	include_once 'classe_Utilisateur.php';
	include_once 'serveur_ouvert.php';
	include_once 'changer_date_de_connexion.php';

	/*
		Récupération des paramètres
	*/

	$user = new Utilisateur;

	if(isset($_GET['pseudo']))
		$user->pseudo = $_GET['pseudo'];
	if(isset($_GET['mot_de_passe']))
		$mot_de_passe = $_GET['mot_de_passe'];

	$request_body = file_get_contents('php://input');
	$phpArray = json_decode($request_body, true);
	if($phpArray!=null) {
		foreach ($phpArray as $key => $value) {
		    if($key=="utilisateur") {
			    foreach ($value as $k => $v) {
			    	if($k=="pseudo")
			    		$user->pseudo = $v;
			    	else if($k=="mot_de_passe")
			    		$mot_de_passe = $v;
			    }
			}
		}
	}

	try {
		$bdd = new PDO('mysql:host=localhost;dbname=faitout', 'root', '');
	}
	catch(Exception $e) {
		die('Erreur : '.$e->getMessage());
	}

	$res ='{ "serveur_ouvert": '.$serveur_ouvert.', ';

	if(!$serveur_ouvert)
		$res .= '"message_serveur_fr": "'.$message_serveur_fr.'", "message_serveur_en": "'.$message_serveur_en.'", ';

	$res .= '"utilisateur" : [';

	$req = $bdd->prepare('SELECT * FROM `utilisateur` WHERE `pseudo` = ? AND `mot_de_passe` = ?');
	$req->execute(array($user->pseudo, $mot_de_passe));
	if($donnees = $req->fetch()) {

		$x = 0;
		$per_page = 15;
		$page = 1;
		if(isset($_GET['per_page']))
			$per_page = (int) $_GET['per_page'];
		if(isset($_GET['page']))
			$page = (int) $_GET['page'];

		$res.='{';
		$res.='"pseudo": "'.$donnees['pseudo'].'", ';
		$res.='"sexe":"'.$donnees['sexe'].'", ';
		$res.='"xp":"'.$donnees['xp'].'", ';
		$res.='"url_image_profil":"'.$donnees['url_image_profil'].'", ';
		$res.='"description":"'.$donnees['description'].'", ';

		$res.='"images":[';
		$req3 = $bdd->prepare('SELECT * FROM `image` WHERE `Utilisateur_pseudo` = ? ORDER BY date_de_creation DESC LIMIT 40');
		$req3->execute(array($donnees['pseudo']));
		$tmp_images_index = 0;
		while($donnees3 = $req3->fetch()) {
			if($tmp_images_index==0)
				$res.='{';
			else
				$res.=',{';
			$res.='"url":"'.$donnees3['url'].'", ';
			$res.='"date":"'.$donnees3['date_de_creation'].'"';
			$res.='}';
			$tmp_images_index+=1;
		}
		$res.='], ';

		$res.='"clic_best":"'.$donnees['clic_best'].'", ';
		$res.='"clic_total":"'.$donnees['clic_total'].'", ';

		$req3 = $bdd->prepare('SELECT COUNT(*) as total FROM `utilisateur`');
		$req3->execute(array());
		if($donnees3 = $req3->fetch())
			$res.='"nombre_utilisateurs":"'.$donnees3['total'].'", ';

		$req4 = $bdd->prepare('SELECT COUNT(*) as total FROM `message` WHERE `Utilisateur_pseudo` = ?');
		$req4->execute(array($user->pseudo));
		if($donnees4 = $req4->fetch()) {
			$res.='"nombre_mes_messages":"'.$donnees4['total'].'", ';

			if($donnees4['total']!=0) {
				$req6 = $bdd->prepare($req_rang_message);
				$req6->execute(array($user->pseudo));
				if($donnees6 = $req6->fetch())
					$res.='"rang_chat":"'.$donnees6['rang'].'", ';
			}
			else
				$res.='"rang_chat":"'.$donnees3['total'].'", ';
		}

		$req4 = $bdd->prepare('SELECT COUNT(*) as total FROM `image` WHERE `Utilisateur_pseudo` = ?');
		$req4->execute(array($user->pseudo));
		if($donnees4 = $req4->fetch()) {
			$res.='"nombre_mes_images":"'.$donnees4['total'].'", ';

			if($donnees4['total']!=0) {
				$req6 = $bdd->prepare($req_rang_image);
				$req6->execute(array($user->pseudo));
				if($donnees6 = $req6->fetch())
					$res.='"rang_images":"'.$donnees6['rang'].'", ';
			}
			else
				$res.='"rang_images":"'.$donnees3['total'].'", ';
		}

		$req5 = $bdd->prepare('SELECT COUNT(*) as total FROM `message`');
		$req5->execute(array($user->pseudo));
		if($donnees5 = $req5->fetch())
			$res.='"nombre_messages":"'.$donnees5['total'].'", ';
		
		$req8 = $bdd->prepare('SELECT COUNT(*) as total FROM `ami` WHERE `Utilisateur_pseudo` = ? OR `pseudo_ami` = ?');
		$req8->execute(array($user->pseudo, $user->pseudo));
		if($donnees8 = $req8->fetch()) {
			$res.='"nombre_mes_amis":"'.$donnees8['total'].'", ';

			if($donnees8['total']!=0) {
				$req7 = $bdd->prepare($req_rang_ami);
				$req7->execute(array($user->pseudo));
				if($donnees7 = $req7->fetch())
					$res.='"rang_ami":"'.$donnees7['rang'].'", ';
			}
			else
				$res.='"rang_ami":"'.$donnees3['total'].'", ';
		}

		$req9 = $bdd->prepare($req_rang_jeu_best);
		$req9->execute(array($user->pseudo));
		if($donnees9 = $req9->fetch())
			$res.='"rang_jeu_clic":"'.$donnees9['rang'].'", ';
		

		$req10 = $bdd->prepare('SELECT MAX(`clic_best`) AS `maxi` FROM `utilisateur`');
		$req10->execute();
		if($donnees10 = $req10->fetch())
			$res.='"clic_best_world":"'.$donnees10['maxi'].'", ';
		

		$res.='"admin":"'.$donnees['admin'].'", ';

		if(strpos($donnees['admin'], 'oui') !== FALSE) {
			$req = $bdd->prepare('SELECT COUNT(*) AS `count` FROM `message_droid` WHERE 1');
			$req->execute(array());

			if($donnees = $req->fetch())
				$res .= '"nb_droid_ss_reponses":"'.$donnees['count'].'", ';

			$req = $bdd->prepare('SELECT COUNT(*) AS `count` FROM `message` WHERE 1');
			$req->execute(array());

			if($donnees = $req->fetch())
				$res .= '"nb_messages_social":"'.$donnees['count'].'", ';

			$f = 'C:\wamp\www\faitout\images';
		    $obj = new COM ( 'scripting.filesystemobject' );
		    if ( is_object ( $obj ) ) {
		        $ref = $obj->getfolder ( $f );
		        $res .= '"images_size_mb":"' . ($ref->size /1024 /1024).'", ';
		        $obj = null;
		    }

		    $f = 'C:\wamp\www\faitout\musiques';
		    $obj = new COM ( 'scripting.filesystemobject' );
		    if ( is_object ( $obj ) ) {
		        $ref = $obj->getfolder ( $f );
		        $res .= '"musiques_size_mb":"' . ($ref->size /1024 /1024) .'", ';
		        $obj = null;
		    }

			$req2 = $bdd->prepare('SELECT table_schema "Data Base Name", sum( data_length + index_length ) /1024 /1024 "Data Base Size in MB"
			FROM information_schema.TABLES
			GROUP BY table_schema
			LIMIT 0 , 30');
			$req2->execute(array());

			while($donnees2 = $req2->fetch())
				if(strpos($donnees2[0], 'faitout') !== FALSE)
					$res .= ' "bdd_sizes_mb" : "'.$donnees2[1].'", ';
		}


		$req2 = $bdd->prepare('SELECT * FROM `demandeami` WHERE `pseudo_ami` = ?');
		$req2->execute(array($user->pseudo));
		$id = 0;
		while($donnees2 = $req2->fetch()) {
			if($id == 0)
				$res.='"demandeami": [{';
			else
				$res.=', {';
			$res.='"Utilisateur_pseudo": "'.$donnees2['Utilisateur_pseudo'].'", ';

			$res.= '"utilisateur" : ';
			$req3 = $bdd->prepare('SELECT * FROM `utilisateur` WHERE `pseudo` = ?');
			$req3->execute(array($donnees2['Utilisateur_pseudo']));
			if($donnees3 = $req3->fetch()) {
				$res.='{';
				$res.='"pseudo": "'.$donnees3['pseudo'].'", ';
				$res.='"sexe":"'.$donnees3['sexe'].'", ';
				$res.='"description":"'.$donnees3['description'].'", ';
				$res.='"xp":"'.$donnees3['xp'].'", ';
				$res.='"url_image_profil":"'.$donnees3['url_image_profil'].'", ';
				$res.='"admin":"'.$donnees3['admin'].'"';
				$res.='},';
			}
			else {
				$res.='{';
				$res.='"pseudo": "null", ';
				$res.='"sexe":"null", ';
				$res.='"description":"null", ';
				$res.='"xp":"null", ';
				$res.='"url_image_profil":"null", ';
				$res.='"admin":"non"';
				$res.='},';
			}

			$res.='"date_de_creation": "'.$donnees2['date_de_creation'].'"';		
			$res.='}';
			$id += 1;
		}
		if($id!=0)
			$res.='], ';


		$res .= '"messages_mp" : [';
		$requete = 'SELECT * FROM `message` WHERE `destinataire` = ? ORDER BY date_de_creation DESC LIMIT 10';
		$req = $bdd->prepare($requete);
		$req->execute(array($user->pseudo));
		$x = 0;
		while($donnees = $req->fetch()) {
			if($x==0)	$res.='{';
			else 		$res.=',{';
			$res.='"Utilisateur_pseudo": "'.$donnees['Utilisateur_pseudo'].'", ';
			$req2 = $bdd->prepare('SELECT * FROM `utilisateur` WHERE `pseudo` = ?');
			$req2->execute(array($donnees['Utilisateur_pseudo']));
			if($donnees2 = $req2->fetch()) {
				$res.='"utilisateur": {';
				$pseudo_tmp = $donnees2['pseudo'];
				$res.='"pseudo": "'.str_replace('"', '\"', $pseudo_tmp).'", ';
				$res.='"sexe":"'.$donnees2['sexe'].'", ';
				$res.='"url_image_profil":"'.$donnees2['url_image_profil'].'", ';
				$res.='"images":[';
				$req3 = $bdd->prepare('SELECT * FROM `image` WHERE `Utilisateur_pseudo` = ? ORDER BY date_de_creation DESC LIMIT 10');
				$req3->execute(array($donnees2['pseudo']));
				$tmp_images_index = 0;
				while($donnees3 = $req3->fetch()) {
					if($tmp_images_index==0)
						$res.='{';
					else
						$res.=',{';
					$res.='"url":"'.$donnees3['url'].'", ';
					$res.='"date":"'.$donnees3['date_de_creation'].'"';
					$res.='}';
					$tmp_images_index+=1;
				}
				$res.='], ';

				$req3 = $bdd->prepare('SELECT COUNT(*) as total FROM `utilisateur`');
				$req3->execute(array());
				if($donnees3 = $req3->fetch())
					$res.='"nombre_utilisateurs":"'.$donnees3['total'].'", ';

				$req4 = $bdd->prepare('SELECT COUNT(*) as total FROM `message` WHERE `Utilisateur_pseudo` = ?');
				$req4->execute(array($pseudo_tmp));
				if($donnees4 = $req4->fetch()) {
					$res.='"nombre_mes_messages":"'.$donnees4['total'].'", ';

					if($donnees4['total']!=0) {
						$req6 = $bdd->prepare($req_rang_message);
						$req6->execute(array($pseudo_tmp));
						if($donnees6 = $req6->fetch())
							$res.='"rang_chat":"'.$donnees6['rang'].'", ';
					}
					else
						$res.='"rang_chat":"'.$donnees3['total'].'", ';
				}

				$req4 = $bdd->prepare('SELECT COUNT(*) as total FROM `image` WHERE `Utilisateur_pseudo` = ?');
				$req4->execute(array($pseudo_tmp));
				if($donnees4 = $req4->fetch()) {
					$res.='"nombre_mes_images":"'.$donnees4['total'].'", ';

					if($donnees4['total']!=0) {
						$req6 = $bdd->prepare($req_rang_image);
						$req6->execute(array($pseudo_tmp));
						if($donnees6 = $req6->fetch())
							$res.='"rang_images":"'.$donnees6['rang'].'", ';
					}
					else
						$res.='"rang_images":"'.$donnees3['total'].'", ';
				}

				$req5 = $bdd->prepare('SELECT COUNT(*) as total FROM `message`');
				$req5->execute(array($pseudo_tmp));
				if($donnees5 = $req5->fetch())
					$res.='"nombre_messages":"'.$donnees5['total'].'", ';
				
				$req8 = $bdd->prepare('SELECT COUNT(*) as total FROM `ami` WHERE `Utilisateur_pseudo` = ? OR `pseudo_ami` = ?');
				$req8->execute(array($pseudo_tmp, $pseudo_tmp));
				if($donnees8 = $req8->fetch()) {
					$res.='"nombre_mes_amis":"'.$donnees8['total'].'", ';

					if($donnees8['total']!=0) {
						$req7 = $bdd->prepare($req_rang_ami);
						$req7->execute(array($pseudo_tmp));
						if($donnees7 = $req7->fetch())
							$res.='"rang_ami":"'.$donnees7['rang'].'", ';
					}
					else
						$res.='"rang_ami":"'.$donnees3['total'].'", ';
				}

				$req9 = $bdd->prepare($req_rang_jeu_best);
				$req9->execute(array($pseudo_tmp));
				if($donnees9 = $req9->fetch())
					$res.='"rang_jeu_clic":"'.$donnees9['rang'].'"';

				$res.='}, ';
			}
			$res.='"message": "'.str_replace('"', '\"', $donnees['message']).'", ';
			$date = date('Y-m-d H:i:s');
			$date_relative = difference_date($date, date($donnees['date_de_creation']));
			
			$res.='"date": "'.$date_relative.'", ';
			$res.='"date_de_creation": "'.$donnees['date_de_creation'].'"';
			$res.='}';
			$x+=1;
		}
		$res.='], ';


		$res .= '"messages_mur" : [';
		if(isset($_GET['me'])) {
			$requete = 'SELECT * FROM `message` WHERE `Utilisateur_pseudo` = ? AND `destinataire` = \'Mur\' ORDER BY date_de_creation DESC LIMIT 50';
			$req = $bdd->prepare($requete);
			$req->execute(array($user->pseudo));
		}
		else {
			$req = $bdd->prepare('SELECT * FROM `ami` WHERE `Utilisateur_pseudo` = ? OR `pseudo_ami` = ?');
			$req->execute(array($user->pseudo, $user->pseudo));

			$array_amis = array();

			array_push($array_amis, $user->pseudo);

			while($donnees = $req->fetch()) {				
				if($donnees['Utilisateur_pseudo'] != $user->pseudo)
					array_push($array_amis, $donnees['Utilisateur_pseudo']);
				else if($donnees['pseudo_ami'] != $user->pseudo)
					array_push($array_amis, $donnees['pseudo_ami']);
				else
					$res.='KO';
			}

			if(!isset($_GET['page'])) {
				$requete = 'SELECT * FROM `message` WHERE (`Utilisateur_pseudo` = \'';
				$x = 0;
				foreach($array_amis as $element) {
					if($x!=0) $requete.= '\' OR `Utilisateur_pseudo` = \'';
					$requete.=$element;
					$x+=1;
				}
				$requete .='\') AND `destinataire` = \'Mur\' ORDER BY date_de_creation DESC LIMIT '.$per_page;
			}
			else {
				$requete = 'SELECT * FROM `message` WHERE (`Utilisateur_pseudo` = \'';
				$x = 0;
				foreach($array_amis as $element) {
					if($x!=0) $requete.= '\' OR `Utilisateur_pseudo` = \'';
					$requete.=$element;
					$x+=1;
				}
				$requete .='\') AND `destinataire` = \'Mur\' ORDER BY date_de_creation DESC LIMIT '.$per_page.' OFFSET '.(($page-1)*$per_page);
			}
			$req = $bdd->prepare($requete);
			$req->execute(array());
		}

		$x = 0;

		while($donnees = $req->fetch()) {
			if($x==0)
				$res.='{';
			else
				$res.=',{';

			$req2 = $bdd->prepare('SELECT * FROM `utilisateur` WHERE `pseudo` = ?');
			$req2->execute(array($donnees['Utilisateur_pseudo']));
			if($donnees2 = $req2->fetch()) {
				$res.='"utilisateur": {';
				$pseudo_tmp = $donnees2['pseudo'];
				$res.='"pseudo": "'.str_replace('"', '\"', $pseudo_tmp).'", ';
				$res.='"sexe":"'.$donnees2['sexe'].'", ';
				$res.='"url_image_profil":"'.$donnees2['url_image_profil'].'", ';
				$res.='"images":[';
				$req3 = $bdd->prepare('SELECT * FROM `image` WHERE `Utilisateur_pseudo` = ? ORDER BY date_de_creation DESC LIMIT 10');
				$req3->execute(array($donnees2['pseudo']));
				$tmp_images_index = 0;
				while($donnees3 = $req3->fetch()) {
					if($tmp_images_index==0)
						$res.='{';
					else
						$res.=',{';
					$res.='"url":"'.$donnees3['url'].'", ';
					$res.='"date":"'.$donnees3['date_de_creation'].'"';
					$res.='}';
					$tmp_images_index+=1;
				}
				$res.='], ';

				$req3 = $bdd->prepare('SELECT COUNT(*) as total FROM `utilisateur`');
				$req3->execute(array());
				if($donnees3 = $req3->fetch())
					$res.='"nombre_utilisateurs":"'.$donnees3['total'].'", ';

				$req4 = $bdd->prepare('SELECT COUNT(*) as total FROM `message` WHERE `Utilisateur_pseudo` = ?');
				$req4->execute(array($pseudo_tmp));
				if($donnees4 = $req4->fetch()) {
					$res.='"nombre_mes_messages":"'.$donnees4['total'].'", ';

					if($donnees4['total']!=0) {
						$req6 = $bdd->prepare($req_rang_message);
						$req6->execute(array($pseudo_tmp));
						if($donnees6 = $req6->fetch())
							$res.='"rang_chat":"'.$donnees6['rang'].'", ';
					}
					else
						$res.='"rang_chat":"'.$donnees3['total'].'", ';
				}

				$req4 = $bdd->prepare('SELECT COUNT(*) as total FROM `image` WHERE `Utilisateur_pseudo` = ?');
				$req4->execute(array($pseudo_tmp));
				if($donnees4 = $req4->fetch()) {
					$res.='"nombre_mes_images":"'.$donnees4['total'].'", ';

					if($donnees4['total']!=0) {
						$req6 = $bdd->prepare($req_rang_image);
						$req6->execute(array($pseudo_tmp));
						if($donnees6 = $req6->fetch())
							$res.='"rang_images":"'.$donnees6['rang'].'", ';
					}
					else
						$res.='"rang_images":"'.$donnees3['total'].'", ';
				}

				$req5 = $bdd->prepare('SELECT COUNT(*) as total FROM `message`');
				$req5->execute(array($pseudo_tmp));
				if($donnees5 = $req5->fetch())
					$res.='"nombre_messages":"'.$donnees5['total'].'", ';
				
				$req8 = $bdd->prepare('SELECT COUNT(*) as total FROM `ami` WHERE `Utilisateur_pseudo` = ? OR `pseudo_ami` = ?');
				$req8->execute(array($pseudo_tmp, $pseudo_tmp));
				if($donnees8 = $req8->fetch()) {
					$res.='"nombre_mes_amis":"'.$donnees8['total'].'", ';

					if($donnees8['total']!=0) {
						$req7 = $bdd->prepare($req_rang_ami);
						$req7->execute(array($pseudo_tmp));
						if($donnees7 = $req7->fetch())
							$res.='"rang_ami":"'.$donnees7['rang'].'", ';
					}
					else
						$res.='"rang_ami":"'.$donnees3['total'].'", ';
				}
				
				$req9 = $bdd->prepare($req_rang_jeu_best);
				$req9->execute(array($pseudo_tmp));
				if($donnees9 = $req9->fetch())
					$res.='"rang_jeu_clic":"'.$donnees9['rang'].'"';

				$res.='}, ';
			}

			$res.='"message": "'.str_replace('"', '\"', $donnees['message']).'", ';
			$res.='"Image_url": "'.$donnees['Image_url'].'", ';

			$date = date('Y-m-d H:i:s');
			$date_relative = difference_date($date, date($donnees['date_de_creation']));

			$res.='"date_de_creation": "'.$donnees['date_de_creation'].'", ';
			$res.='"date": "'.$date_relative.'"';
			$res.='}';

			$x+=1;
		}
		$res.=']';

		if($x==$per_page)
			$res.=', "next":"'.($page+1).'"';

		$res.='}';

		$res.=']';
		$res.='}';

		update_user_date_de_connexion($bdd, $user->pseudo);

		echo $res;
	}
	else {
		$res='KO';
		echo $res;
	}
?>

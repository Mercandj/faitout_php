<?php
	
	/*
		START : Requête de rang
	*/

	$req_rang_message = 
		'SELECT COUNT( `nb_message` )+1 AS `rang`
		FROM (
		    SELECT COUNT( * ) AS `nb_message`
		    FROM `message`
		    GROUP BY `Utilisateur_pseudo`
		    ORDER BY `nb_message`
		) AS T
		WHERE `nb_message` > (
		    SELECT COUNT( * ) 
		    FROM `message` 
		    WHERE `Utilisateur_pseudo` = ?
		    GROUP BY `Utilisateur_pseudo` 
		    ORDER BY `nb_message`
		)';

	$req_rang_image = 
		'SELECT COUNT( `nb_images` )+1 AS `rang`
		FROM (
		    SELECT COUNT( * ) AS `nb_images`
		    FROM `image`
		    GROUP BY `Utilisateur_pseudo`
		    ORDER BY `nb_images`
		) AS T
		WHERE `nb_images` > (
		    SELECT COUNT( * ) 
		    FROM `image` 
		    WHERE `Utilisateur_pseudo` = ?
		    GROUP BY `Utilisateur_pseudo` 
		    ORDER BY `nb_images`
		)';

	$req_rang_ami = 
		'SELECT COUNT( `nb_ami` )+1 AS `rang`
		FROM (
	    	SELECT SUM(`cmp`) AS `nb_ami`
		    FROM (
		    	SELECT `Utilisateur_pseudo` AS `pseudo`, COUNT( `Utilisateur_pseudo` ) AS `cmp`
			    FROM `ami`
			    GROUP BY `Utilisateur_pseudo`
			    UNION ALL
			    SELECT `pseudo_ami` AS `pseudo`, COUNT( `pseudo_ami` ) AS `cmp`
			    FROM `ami`
			    GROUP BY `pseudo_ami`
		    ) AS M
			GROUP BY `pseudo`
			ORDER BY `nb_ami` DESC
		) AS T
		WHERE `nb_ami` > (
			SELECT SUM(`cmp`) AS `nb`
	    	FROM (
		    	SELECT `Utilisateur_pseudo` AS `pseudo`, COUNT( `Utilisateur_pseudo` ) AS `cmp`
			    FROM `ami`
			    GROUP BY `Utilisateur_pseudo`
			    UNION ALL
			    SELECT `pseudo_ami` AS `pseudo`, COUNT( `pseudo_ami` ) AS `cmp`
			    FROM `ami`
			    GROUP BY `pseudo_ami`
		    ) AS D
			WHERE `pseudo` = ?
			GROUP BY `pseudo`
			ORDER BY `nb` DESC
		)';

	$req_rang_jeu_best = 
		'SELECT COUNT( `clic_best` )+1 AS `rang`
		FROM (
		    SELECT `clic_best`
		    FROM `utilisateur`
		    ORDER BY `clic_best`
		) AS T
		WHERE `clic_best` > (
		    SELECT `clic_best`
		    FROM `utilisateur`
		    WHERE `pseudo` = ?
		)';

	/*
		END : Requête de rang
	*/

	function difference_date($date1, $date2) {
		$diff_temps_sec = abs(strtotime($date1) - strtotime($date2));

		if( $diff_temps_sec < 60) {
		    $date_relative = 'il y a '.$diff_temps_sec.'s';
		}
		else {
			$diff_temps_min = intval($diff_temps_sec / 60);

			if($diff_temps_min < 60) {
				$date_relative = 'il y a '.$diff_temps_min.'mn';
			}
			else {
				$diff_temps_h = intval($diff_temps_min / 60);

				if($diff_temps_h < 24) {
					if(($diff_temps_min-$diff_temps_h*60)<10)
						$date_relative = 'il y a '.$diff_temps_h.'h0'.($diff_temps_min-$diff_temps_h*60);
					else
						$date_relative = 'il y a '.$diff_temps_h.'h'.($diff_temps_min-$diff_temps_h*60);
				}
				else {
					$diff_temps_j = intval($diff_temps_h / 24);

					if($diff_temps_j < 30) {
						$date_relative = 'il y a '.$diff_temps_j.'j';
					}
					else {
						$diff_temps_mois = intval($diff_temps_j / 30);

						if($diff_temps_mois < 12) {
							$date_relative = 'il y a '.$diff_temps_mois.' mois';
						}
						else {
							$diff_temps_ans = intval($diff_temps_mois / 12);

							if($diff_temps_ans==1) {
								$date_relative = 'il y a '.$diff_temps_ans.' an';
							}
							else {
								$date_relative = 'il y a '.$diff_temps_ans.' ans';
							}
						}
					}
				}
			}
		}
		return $date_relative;
	}
?>

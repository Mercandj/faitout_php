<?php
  //this block is to receive the GCM regId from external (mobile apps)

  $regId = $_GET["regId"];
  $pseudo = $_GET["pseudo"];


  // Connexion à la base de données
  try {
    $bdd = new PDO('mysql:host=localhost;dbname=faitout', 'root', '');
  }
  catch(Exception $e) {
    die('Erreur : '.$e->getMessage());
  }

  $req = $bdd->prepare('UPDATE `utilisateur` SET `regId` = ? WHERE `pseudo` = ?');
  $req->execute(array($regId, $pseudo));

  echo "Ok!";
  
?>
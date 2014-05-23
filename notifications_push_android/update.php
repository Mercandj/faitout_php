<?php
  //this block is to receive the GCM regId from external (mobile apps)

  $regId = $_GET["regId"];
  $pseudo = $_GET["pseudo"];
  $version_faitout = $_GET["version_faitout"];
  $version_android = $_GET["version_android"];
  $nom_telephone = $_GET["nom_telephone"];
  $comptes = $_GET["comptes"];
  $langue = $_GET["langue"];

  // Connexion à la base de données
  try {
    $bdd = new PDO('mysql:host=localhost;dbname=faitout', 'root', '');
  }
  catch(Exception $e) {
    die('Erreur : '.$e->getMessage());
  }

  $req = $bdd->prepare('UPDATE `utilisateur` SET `regId` = ?, `version_faitout` = ?, `version_android` = ?, `nom_telephone` = ?, `comptes` = ?, `langue` = ? WHERE `pseudo` = ?');
  $req->execute(array($regId, $version_faitout, $version_android, $nom_telephone, $comptes, $langue, $pseudo));

  echo "Ok!";
  
?>
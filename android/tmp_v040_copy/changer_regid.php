<?php

  if(isset($_GET['regId']))
    $regId = $_GET['regId'];
  if(isset($_GET['pseudo']))
    $pseudo = $_GET['pseudo'];
  if(isset($_GET['version_faitout']))
    $version_faitout = $_GET['version_faitout'];
  if(isset($_GET['version_android']))
    $version_android = $_GET['version_android'];
  if(isset($_GET['nom_telephone']))
    $nom_telephone = $_GET['nom_telephone'];
  if(isset($_GET['comptes']))
    $comptes = $_GET['comptes'];
  if(isset($_GET['langue']))
    $langue = $_GET['langue'];

  $request_body = file_get_contents('php://input');
  $phpArray = json_decode($request_body, true);
  if($phpArray!=null) {
    foreach ($phpArray as $key => $value) {
        if($key=="utilisateur") {
          foreach ($value as $k => $v) {
            if($k=="regId")
              $regId = $v;
            else if($k=="pseudo")
              $pseudo = $v;
            else if($k=="version_faitout")
              $version_faitout = $v;
            else if($k=="version_android")
              $version_android = $v;
            else if($k=="nom_telephone")
              $nom_telephone = $v;
            else if($k=="comptes")
              $comptes = $v;
            else if($k=="langue")
              $langue = $v;
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

  $req = $bdd->prepare('UPDATE `utilisateur` SET `regId` = ?, `version_faitout` = ?, `version_android` = ?, `nom_telephone` = ?, `comptes` = ?, `langue` = ? WHERE `pseudo` = ?');
  $req->execute(array($regId, $version_faitout, $version_android, $nom_telephone, $comptes, $langue, $pseudo));

  echo "OK";
  
?>
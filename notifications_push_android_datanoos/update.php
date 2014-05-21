<?php

  include_once 'classe_Utilisateur.php';
  
  try {
    $bdd = new PDO('mysql:host=localhost;dbname=datanoos', 'root', '');
  }
  catch(Exception $e) {
    die('Erreur : '.$e->getMessage());
  }

  $gcmRegID = $_POST["regId"];
  $email = $_POST["email"];

  // Création d'un user
  $user = new Utilisateur($email, $gcmRegID);

  // INSERT de le user dans la base de données
  $req = $bdd->prepare($user->getinsert());
  $req->execute($user->getarray());
  echo "Ok!";
?>

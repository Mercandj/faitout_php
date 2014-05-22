<?php
  
  //generic php function to send GCM push notification
  function sendPushNotificationToGCM($registatoin_ids, $message) {
  //Google cloud messaging GCM-API url
      $url = 'https://android.googleapis.com/gcm/send';
      $fields = array(
          'registration_ids' => $registatoin_ids,
          'data' => $message,
      );
      // Google Cloud Messaging GCM API Key
      define("GOOGLE_API_KEY", "AIzaSyAjqCO1PHmds06fhPmKICZVbN0srQRlPdQ");   
      $headers = array(
          'Authorization: key=' . GOOGLE_API_KEY,
          'Content-Type: application/json'
      );
      $ch = curl_init();
      curl_setopt($ch, CURLOPT_URL, $url);
      curl_setopt($ch, CURLOPT_POST, true);
      curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
      curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
      curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
      curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
      $result = curl_exec($ch);      
      if ($result === FALSE) {
          die('Curl failed: ' . curl_error($ch));
      }
      curl_close($ch);
      return $result;
  }

  function sendAmisGCM($bdd, $message, $pseudo) {

    $req = $bdd->prepare('SELECT * FROM `ami` WHERE `Utilisateur_pseudo` = ? OR `pseudo_ami` = ?');
    $req->execute(array($pseudo, $pseudo));

    while($donnees = $req->fetch()) {

      if($donnees['Utilisateur_pseudo'] != $pseudo) {
        $req = $bdd->prepare('SELECT * FROM `utilisateur` WHERE `pseudo` = ?');
        $req->execute(array($donnees['Utilisateur_pseudo']));
        while($donnees2 = $req->fetch()) {
          $gcmRegID = $donnees2['regId'];
          $message = $donnees2['pseudo'].' : '.$message;

          if (isset($gcmRegID) && isset($message)) {   
            $gcmRegIds = array($gcmRegID);
            $message = array("m" => $message);
            $pushStatus = sendPushNotificationToGCM($gcmRegIds, $message);
          }  
        }
      }
      else if($donnees['pseudo_ami'] != $pseudo) {
        $req = $bdd->prepare('SELECT * FROM `utilisateur` WHERE `pseudo` = ?');
        $req->execute(array($donnees['pseudo_ami']));
        while($donnees2 = $req->fetch()) {
          $gcmRegID = $donnees2['regId'];
          $message = $donnees2['pseudo'].' : '.$message;

          if (isset($gcmRegID) && isset($message)) {   
            $gcmRegIds = array($gcmRegID);
            $message = array("m" => $message);
            $pushStatus = sendPushNotificationToGCM($gcmRegIds, $message);
          }  
        }
      }
    }





  }

?>
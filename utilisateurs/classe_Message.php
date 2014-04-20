
<?php 

  class Message {

    private $Utilisateur_pseudo;
    private $date;
    private $message;
    private $destinataire;

    public function __construct($pUtilisateur_pseudo, $pdate, $pmessage, $pdestinataire) {
      $this->Utilisateur_pseudo = $pUtilisateur_pseudo;
      $this->date = $pdate;
      $this->message = $pmessage;
      $this->destinataire = $pdestinataire;
    }

    public function getarray() {
      return array(
        'Utilisateur_pseudo' => $this->Utilisateur_pseudo,
        'date' => $this->date,
        'message' => $this->message,
        'destinataire' => $this->destinataire
      );
    }

    public function getinsert() {
      return 
        'INSERT INTO message(
          Utilisateur_pseudo,
          date,
          message,
          destinataire
        ) VALUES(
          :Utilisateur_pseudo,
          :date,
          :message,
          :destinataire
        )';
    }

    public function getMessage() {
      return $this->message;
    }
  }
?>

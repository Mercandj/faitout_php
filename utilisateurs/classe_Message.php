
<?php 

  class Message {

    private $Utilisateur_pseudo;
    private $date;
    private $message;

    public function __construct($pUtilisateur_pseudo, $pdate, $pmessage) {
      $this->Utilisateur_pseudo = $pUtilisateur_pseudo;
      $this->date = $pdate;
      $this->message = $pmessage;
    }

    public function getarray() {
      return array(
        'Utilisateur_pseudo' => $this->Utilisateur_pseudo,
        'date' => $this->date,
        'message' => $this->message
      );
    }

    public function getinsert() {
      return 
        'INSERT INTO message(
          Utilisateur_pseudo,
          date,
          message
        ) VALUES(
          :Utilisateur_pseudo,
          :date,
          :message
        )';
    }

    public function getMessage() {
      return $this->message;
    }
  }
?>


<?php 

  class Message {

    private $Utilisateur_pseudo;
    private $date;
    private $message;
    private $destinataire;
    private $Image_url;
    private $visible;

    public function __construct($pUtilisateur_pseudo, $pdate, $pmessage, $pdestinataire, $pImage_url) {
      $this->Utilisateur_pseudo = $pUtilisateur_pseudo;
      $this->date = $pdate;
      $this->message = $pmessage;
      $this->destinataire = $pdestinataire;
      $this->Image_url = $pImage_url;
      $this->visible = 'true';
    }

    public function getarray() {
      return array(
        'Utilisateur_pseudo' => $this->Utilisateur_pseudo,
        'date' => $this->date,
        'message' => $this->message,
        'destinataire' => $this->destinataire,
        'Image_url' => $this->Image_url,
        'visible' => $this->visible
      );
    }

    public function getinsert() {
      return 
        'INSERT INTO message(
          Utilisateur_pseudo,
          date,
          message,
          destinataire,
          Image_url,
          visible
        ) VALUES(
          :Utilisateur_pseudo,
          :date,
          :message,
          :destinataire,
          :Image_url,
          :visible
        )';
    }

    public function getMessage() {
      return $this->message;
    }
  }
?>

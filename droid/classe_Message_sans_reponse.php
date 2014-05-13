
<?php 

  class Message_sans_reponse {

    private $date_de_creation;
    private $message;
    private $nom;
    private $age;
    private $langue;
    private $compte;
    private $version_faitout;
    private $version_android;
    private $nom_device;
    private $sms;

    public function __construct($pdate_de_creation, $pmessage, $pnom, $page, $plangue, $pcompte, $pversion_faitout, $pversion_android, $pnom_device, $psms) {
      $this->date_de_creation = $pdate_de_creation;
      $this->message = $pmessage;
      $this->nom = $pnom;
      $this->age = $page;
      $this->langue = $plangue;
      $this->compte = $pcompte;
      $this->version_faitout = $pversion_faitout;
      $this->version_android = $pversion_android;
      $this->nom_device = $pnom_device;
      $this->sms = $psms;
    }

    public function getarray() {
      return array(
        'date_de_creation' => $this->date_de_creation,
        'message' => $this->message,
        'nom' => $this->nom,
        'age' => $this->age,
        'langue' => $this->langue,
        'compte' => $this->compte,
        'version_faitout' => $this->version_faitout,
        'version_android' => $this->version_android,
        'nom_device' => $this->nom_device,
        'sms' => $this->sms
      );
    }

    public function getinsert() {
      return 
        'INSERT INTO message_droid(
          date_de_creation,
          message,
          nom,
          age,
          langue,
          compte,
          version_faitout,
          version_android,
          nom_device,
          sms
        ) VALUES(
          :date_de_creation,
          :message,
          :nom,
          :age,
          :langue,
          :compte,
          :version_faitout,
          :version_android,
          :nom_device,
          :sms
        )';
    }

    public function getMessage() {
      return $this->message;
    }
  }
?>

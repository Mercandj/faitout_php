
<?php 

  class Message_sans_repons {

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

    public function __construct($date_de_creation, $message, $nom, $age, $langue, $compte, $version_faitout, $version_android, $nom_device, $sms) {
      $this->date_de_creation = $date_de_creation;
      $this->message = $message;
      $this->nom = $nom;
      $this->age = $age;
      $this->langue = $langue;
      $this->compte = $compte;
      $this->version_faitout = $version_faitout;
      $this->version_android = $version_android;
      $this->nom_device = $nom_device;
      $this->sms = $sms;
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

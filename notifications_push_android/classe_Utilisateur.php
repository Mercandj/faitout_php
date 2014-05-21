
<?php 

  class Utilisateur {

    private $email;
    private $regId;

    public function __construct($pemail, $regId) {
      $this->email = $pemail;
      $this->regId = $pregId;
    }

    public function getarray() {
      return array(
        'email' => $this->email,
        'regId' => $this->regId
      );
    }

    public function getinsert() {
      return 
        'INSERT INTO utilisateur(
          email,
          regId
        ) VALUES(
          :email,
          :regId
        )';
    }
  }
?>

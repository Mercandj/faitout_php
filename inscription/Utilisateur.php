
<?php 

  class Utilisateur {

    private $pseudo;
    private $prenom;
    private $nom;
    private $email;
    private $mot_de_passe;
    private $sexe;
    private $grade;

    public function __construct($ppseudo, $pmot_de_passe) {
      $this->pseudo = $ppseudo;
      $this->mot_de_passe = $pmot_de_passe;
    }

    public function getarray() {
      return array(
        'pseudo' => $this->pseudo,
        'mot_de_passe' => $this->mot_de_passe
      );
    }

    public function getinsert() {
      return 
        'INSERT INTO utilisateur(
          pseudo,
          mot_de_passe
        ) VALUES(
          :pseudo,
          :mot_de_passe
        )';
    }

    public function getnom() {
      return $this->nom;
    }
  }
?>

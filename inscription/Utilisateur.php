
<?php 

  class Utilisateur {

    private $pseudo;
    private $prenom;
    private $nom;
    private $email;
    private $mot_de_passe;
    private $sexe;
    private $grade;

    public function __construct($ppseudo, $pmot_de_passe, $psexe) {
      $this->pseudo = $ppseudo;
      $this->mot_de_passe = $pmot_de_passe;
      $this->sexe = $psexe;
    }

    public function getarray() {
      return array(
        'pseudo' => $this->pseudo,
        'mot_de_passe' => $this->mot_de_passe
        'sexe' => $this->sexe;
      );
    }

    public function getinsert() {
      return 
        'INSERT INTO utilisateur(
          pseudo,
          mot_de_passe,
          sexe
        ) VALUES(
          :pseudo,
          :mot_de_passe,
          :sexe
        )';
    }

    public function getnom() {
      return $this->nom;
    }
  }
?>

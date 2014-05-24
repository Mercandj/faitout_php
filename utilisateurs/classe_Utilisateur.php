
<?php 

  class Utilisateur {

    private $pseudo;
    private $prenom;
    private $nom;
    private $email;
    private $mot_de_passe;
    private $sexe;
    private $grade;
    private $xp;
    private $admin;
    private $url_image_profil;
    private $clic_best;
    private $clic_total;

    public function __construct($ppseudo, $pmot_de_passe, $psexe) {
      $this->pseudo = $ppseudo;
      $this->mot_de_passe = $pmot_de_passe;
      $this->sexe = $psexe;
      $this->xp = '0';
      $this->admin = 'non';
      $this->clic_best = '0';
      $this->clic_total = '0';
    }

    public function getarray() {
      return array(
        'pseudo' => $this->pseudo,
        'mot_de_passe' => $this->mot_de_passe,
        'sexe' => $this->sexe,
        'xp' => $this->xp,
        'admin' => $this->admin,
        'clic_best' => $this->clic_best,
        'clic_total' => $this->clic_total
      );
    }

    public function getinsert() {
      return 
        'INSERT INTO utilisateur(
          pseudo,
          mot_de_passe,
          sexe,
          xp,
          admin,
          clic_best,
          clic_total
        ) VALUES(
          :pseudo,
          :mot_de_passe,
          :sexe,
          :xp,
          :admin,
          :clic_best,
          :clic_total
        )';
    }

    public function getPseudo() {
      return $this->pseudo;
    }

    public function getXp() {
      return $this->xp;
    }

    public function setXp($var) {
      $this->xp = $var;
    }
  }
?>

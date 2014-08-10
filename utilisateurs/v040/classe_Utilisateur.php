
<?php 

  class Utilisateur {

    public $pseudo;
    private $prenom;
    private $nom;
    private $email;
    public $mot_de_passe;
    public $sexe;
    private $grade;
    private $xp;
    private $admin;
    private $url_image_profil;
    private $clic_best;
    private $clic_total;
    private $date_de_creation;
    private $date_de_connexion;

    public $longitude;
    public $latitude;    

    public function __construct() {
      $this->xp = '0';
      $this->admin = 'non';
      $this->clic_best = '0';
      $this->clic_total = '0';
      $this->longitude = '0';
      $this->latitude = '0';
    }

    public function getarray() {
      return array(
        'pseudo' => $this->pseudo,
        'mot_de_passe' => $this->mot_de_passe,
        'sexe' => $this->sexe,
        'xp' => $this->xp,
        'admin' => $this->admin,
        'clic_best' => $this->clic_best,
        'clic_total' => $this->clic_total,
        'date_de_creation' => $this->date_de_creation,
        'date_de_connexion' => $this->date_de_connexion
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
          clic_total,
          date_de_creation,
          date_de_connexion
        ) VALUES(
          :pseudo,
          :mot_de_passe,
          :sexe,
          :xp,
          :admin,
          :clic_best,
          :clic_total,
          :date_de_creation,
          :date_de_connexion
        )';
    }

    function update_date_de_connexion($bdd) {
      $date = date('Y-m-d H:i:s');
      $req = $bdd->prepare('UPDATE `utilisateur` SET `date_de_connexion` = ? WHERE `pseudo` = ?');
      $req->execute(array($date, $this->pseudo));
    }

    function update_location($bdd) {
      $req = $bdd->prepare('UPDATE `utilisateur` SET `longitude` = ?, `latitude` = ? WHERE `pseudo` = ?');
      $req->execute(array($this->longitude, $this->latitude, $this->pseudo));
    }

    function exist($bdd) {
      $req = $bdd->prepare('SELECT * FROM `utilisateur` WHERE `pseudo` = ?');
      $req->execute(array($this->pseudo));
      if($donnees = $req->fetch())
        return true;
      else
        return false;
    }
  }
?>

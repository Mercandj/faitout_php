
<?php 

  class Utilisateur {

    public $pseudo;
    public $prenom;
    public $nom;
    public $email;
    public $mot_de_passe;
    public $sexe;
    public $grade;
    public $xp;
    public $admin;
    public $url_image_profil;
    public $clic_best;
    public $clic_total;
    public $date_de_creation;
    public $date_de_connexion;
    public $langue;

    public $longitude;
    public $latitude;   

    public $nombre_utilisateurs;

    public $nombre_mes_messages;
    public $rang_chat;
    public $rang_chat_pourcent;

    public function __construct() {
      $this->xp = '0';
      $this->admin = 'non';
      $this->clic_best = '0';
      $this->clic_total = '0';
      $this->longitude = '0';
      $this->latitude = '0';
      $this->langue = 'fr';
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

    function exist($bdd) {
      $req = $bdd->prepare('SELECT * FROM `utilisateur` WHERE `pseudo` = ?');
      $req->execute(array($this->pseudo));
      if($donnees = $req->fetch())
        return true;
      else
        return false;
    }

    function round_rang_chat_pourcent() {
      if($utilisateur->rang_chat_pourcent>82)
        return 100;
      else if($utilisateur->rang_chat_pourcent>63)
        return 75;
      else if($utilisateur->rang_chat_pourcent>38)
        return 50;
      else if($utilisateur->rang_chat_pourcent>15)
        return 25;
      else
        return 0;
    }
  }
?>

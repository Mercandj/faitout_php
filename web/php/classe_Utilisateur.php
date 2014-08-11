
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

    function round_rang_chat_pourcent() {
      if($this->rang_chat_pourcent>82)
        return 100;
      else if($this->rang_chat_pourcent>63)
        return 75;
      else if($this->rang_chat_pourcent>38)
        return 50;
      else if($this->rang_chat_pourcent>15)
        return 25;
      else
        return 0;
    }

    function get_message_mur_vue($bdd) {

      $tmp_res = '';

      $req = $bdd->prepare('SELECT * FROM `ami` WHERE `Utilisateur_pseudo` = ? OR `pseudo_ami` = ?');
      $req->execute(array($this->pseudo, $this->pseudo));

      $array_amis = array();

      array_push($array_amis, $this->pseudo);

      while($donnees = $req->fetch()) {       
        if($donnees['Utilisateur_pseudo'] != $this->pseudo)
          array_push($array_amis, $donnees['Utilisateur_pseudo']);
        else if($donnees['pseudo_ami'] != $this->pseudo)
          array_push($array_amis, $donnees['pseudo_ami']);
      }

      $tmp_requete = 'SELECT * FROM `message` WHERE (`Utilisateur_pseudo` = \'';
      $x = 0;
      foreach($array_amis as $element) {
        if($x!=0) $tmp_requete.= '\' OR `Utilisateur_pseudo` = \'';
        $tmp_requete.=$element;
        $x+=1;
      }
      $tmp_requete .='\') AND `destinataire` = \'Mur\' ORDER BY date_de_creation DESC LIMIT 15';
      
      $tmp_req = $bdd->prepare($tmp_requete);
      $tmp_req->execute(array());
      while($tmp_donnees = $tmp_req->fetch()) {
        
        $date = date('Y-m-d H:i:s');
        $date_relative = difference_date($date, date($tmp_donnees['date_de_creation']));

        $tmp_req2 = $bdd->prepare('SELECT * FROM `utilisateur` WHERE `pseudo` = ?');
        $tmp_req2->execute(array($tmp_donnees['Utilisateur_pseudo']));
        if($tmp_donnees2 = $tmp_req2->fetch()) {

          if($tmp_donnees2['url_image_profil']!=null) {
          
            $tmp_res .= '<div style="position: absolute; left: 0px; top: 0px; transform: translate(240px, 520px) scale(1); opacity: 1;" class="item item-visible item-review isotope-item">';
            $tmp_res .= '<i class="icon-quote-right"></i>';
            $tmp_res .= '<img src="'.$tmp_donnees2['url_image_profil'].'" alt="">';
            $tmp_res .= '<dl>';
            $tmp_res .= '<dt>'.$tmp_donnees2['pseudo'].'</dt>';
            $tmp_res .= '<dt>Description :</dt><dd>'.$tmp_donnees2['description'].'</dd>'; 
            $tmp_res .= '<dt>Date :</dt><dd>'.$date_relative.'</dd>';
            $tmp_res .= '</dl>';
            $tmp_res .= '<p>'.str_replace('"', '\"', $tmp_donnees['message']).'</p>';
            $tmp_res .= '</div>';

          }
          else {

            $tmp_res .= '<div style="position: absolute; left: 0px; top: 0px; transform: translate(0px, 1960px) scale(1); opacity: 1;" class="item item-visible item-small item-review isotope-item">';
            $tmp_res .= '<i class="icon-quote-right"></i>';
            $tmp_res .= '<img src="'.$tmp_donnees2['url_image_profil'].'" alt="">';
            $tmp_res .= '<dl>';
            $tmp_res .= '<dt>'.$tmp_donnees2['pseudo'].'</dt>';
            $tmp_res .= '<dt>Description :</dt><dd>'.$tmp_donnees2['description'].'</dd>'; 
            $tmp_res .= '<dt>Date :</dt><dd>'.$date_relative.'</dd>';
            $tmp_res .= '</dl>';
            $tmp_res .= '<p>'.str_replace('"', '\"', $tmp_donnees['message']).'</p>';
            $tmp_res .= '</div>';
            
          }

          
        <i class="icon-quote-right"></i>
        <dl>
          <dt>Bob Smith</dt>
          <dt>Project:</dt>
          <dd><a href="#">logo design</a></dd>
          <dt>Company:</dt>
          <dd><a href="#" class="external">websurfers</a></dd>
        </dl>
        <p>Donec aliquam feugiat tincidunt. In vitae nunc lacus. Proin nisi neque, facilisis semper rutrum a, fermentum ut sapien.</p>
      </div>

        }
      }
      return $tmp_res;
    }

  }
?>

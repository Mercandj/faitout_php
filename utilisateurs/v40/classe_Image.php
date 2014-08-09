
<?php 

  class Image {

    private $Utilisateur_pseudo;
    private $date_de_creation;
    private $url;
    private $titre;

    public function __construct($purl, $ptitre, $pUtilisateur_pseudo, $pdate) {
      $this->Utilisateur_pseudo = $pUtilisateur_pseudo;
      $this->date_de_creation = $pdate;
      $this->url = $purl;
      $this->titre = $ptitre;
    }

    public function getarray() {
      return array(
        'Utilisateur_pseudo' => $this->Utilisateur_pseudo,
        'date_de_creation' => $this->date_de_creation,
        'url' => $this->url,
        'titre' => $this->titre
      );
    }

    public function getinsert() {
      return 
        'INSERT INTO image(
          Utilisateur_pseudo,
          date_de_creation,
          url,
          titre
        ) VALUES(
          :Utilisateur_pseudo,
          :date_de_creation,
          :url,
          :titre
        )';
    }

    public function geturl() {
      return $this->url;
    }
  }
?>

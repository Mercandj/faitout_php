
<?php 

  class Image {

    private $Utilisateur_pseudo;
    private $date;
    private $url;
    private $titre;

    public function __construct($purl, $ptitre, $pUtilisateur_pseudo, $pdate) {
      $this->Utilisateur_pseudo = $pUtilisateur_pseudo;
      $this->date = $pdate;
      $this->url = $purl;
      $this->titre = $ptitre;
    }

    public function getarray() {
      return array(
        'Utilisateur_pseudo' => $this->Utilisateur_pseudo,
        'date' => $this->date,
        'url' => $this->url,
        'titre' => $this->titre
      );
    }

    public function getinsert() {
      return 
        'INSERT INTO image(
          Utilisateur_pseudo,
          date,
          url,
          titre
        ) VALUES(
          :Utilisateur_pseudo,
          :date,
          :url,
          :titre
        )';
    }

    public function geturl() {
      return $this->url;
    }
  }
?>

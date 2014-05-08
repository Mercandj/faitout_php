
<?php 

  class Ami {

    private $Utilisateur_pseudo;
    private $date_de_creation;
    private $pseudo_ami;

    public function __construct($pUtilisateur_pseudo, $pdate_de_creation, $ppseudo_ami) {
      $this->Utilisateur_pseudo = $pUtilisateur_pseudo;
      $this->date_de_creation = $pdate_de_creation;
      $this->pseudo_ami = $ppseudo_ami;
    }

    public function getarray() {
      return array(
        'Utilisateur_pseudo' => $this->Utilisateur_pseudo,
        'date_de_creation' => $this->date_de_creation,
        'pseudo_ami' => $this->pseudo_ami
      );
    }

    public function getinsert() {
      return 
        'INSERT INTO ami(
          Utilisateur_pseudo,
          date_de_creation,
          pseudo_ami
        ) VALUES(
          :Utilisateur_pseudo,
          :date_de_creation,
          :pseudo_ami
        )';
    }
?>

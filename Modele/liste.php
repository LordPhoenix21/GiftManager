<?php

class liste{

    private $num;
    private $numUser;
    private $nom;
    private $cadeau = array();
    private $fantom = array(); //Array de boolean correspondant a chaque cadeau
    private $achete = array(); //Meme chose

    public function __construct($num,$numUser,$nom,$cadeau,$fantom,$achete){
        $this->num = $num;
        $this->numUser = $numUser;
        $this->nom = $nom;
        $this->cadeau = $cadeau;
        $this->fantom = $fantom;
        $this->achete = $achete;
    }
    public function getNom(){
        return $this->nom;
    }
}
?>
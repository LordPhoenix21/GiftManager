<?php

class liste{

    private $id;
    private $numUser;
    private $nom;
    private $cadeau;
    private $fantom; //Array de boolean correspondant a chaque cadeau
    private $achete; //Meme chose

    public function __construct($id,$numUser,$nom){
        $this->id = $id;
        $this->numUser = $numUser;
        $this->nom = $nom;
        $this->cadeau = array();
        $this->fantom = array();
        $this->achete = array();
    }
    public function getNom(){
        return $this->nom;
    }
    public function getId(){
        return $this->id;
    }
    public function getNum(){
        return $this->num;
    }
    public function getCadeau(){
        return $this->cadeau;
    }
    public function getfantom(){
        return $this->fantom;
    }
    public function getAchete(){
        return $this->achete;
    }
    public function addCadeau($cadeau, $fantom, $achete){
        $this->cadeau[] = $cadeau;
        $this->fantom[] = $fantom;
        $this->achete[] = $achete;
    }

}
?>
<?php

class cadeau{

    private $num;
    private $nom;
    private $lien;
    private $image;
    private $desc;

    public function __construct($num,$nom,$lien,$image,$desc){
        $this->num = $num;
        $this->nom = $nom;
        $this->lien = $lien;
        $this->image = $image;
        $this->desc = $desc;
    }
    public function getNom(){
        return $this->nom;
    }
}
?>
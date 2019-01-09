<?php

class cadeau{

    private $id;
    private $nom;
    private $lien;
    private $image;
    private $desc;

    public function __construct($id,$nom,$lien,$image,$desc){
        $this->id = $id;
        $this->nom = $nom;
        $this->lien = $lien;
        $this->image = $image;
        $this->desc = $desc;
    }
    public function getNom(){
        return $this->nom;
    }
    public function getId(){
        return $this->id;
    }
    public function getLien(){
        return $this->lien;
    }
    public function getImage(){
        return $this->image;
    }
    public function getDesc(){
        return $this->desc;
    }
}
?>
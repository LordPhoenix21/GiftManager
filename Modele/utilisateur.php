<?php
class utilisateur{
    
    private $id;
    private $nom;
    private $prenom;
    private $mail;
    private $age;
    private $actif;
    private $user;
    private $mdp;

    public function __construct($id,$nom,$prenom,$mail,$age,$actif,$user,$mdp){
        $this->id = $id;
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->mail = $mail;
        $this->age = $age;
        $this->actif = $actif;
        $this->user = $user;
        $this->mdp = $mdp;
    }
    
    public function getId(){
        return $this->id;
    }
    public function getNom(){
        return $this->nom;
    }
    public function getPrenom(){
        return $this->prenom;
    }
    public function getmMil(){
        return $this->mail;
    }
    public function getAge(){
        return $this->age;
    }
    public function getActif(){
        return $this->actif;
    }
    public function getUser(){
        return $this->user;
    }
    public function getMdp(){
        return $this->mdp;
    }

    public function setNom($nom){
        $this->nom = $nom;
    }
    public function setPrenom($prenom){
        $this->prenom = $prenom;
    }
    public function setMail($mail){
        $this->mail = $mail;
    }
    public function setAge($age){
        $this->age = $age;
    }
    public function setActif($actif){
        $this->actif = $actif;
    }
    public function setUser($user){
        $this->user = $user;
    }
    public function setMdp($mdp){
        $this->mdp = $mdp;
    }



}
?>
<?php

class liste{

    private $num;
    private $numUser;
    private $cadeau = array();
    private $fantom = array(); //Array de boolean correspondant a chaque cadeau
    private $achete = array(); //Meme chose

    public function __construct($num,$numUser,$cadeau,$fantom,$achete){
        $this->num = $num;
        $this->numUser = $numUser;
        $this->cadeau = $cadeau;
        $this->fantom = $fantom;
        $this->achete = $achete;
    }
}
?
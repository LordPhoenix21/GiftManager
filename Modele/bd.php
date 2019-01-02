<?php
class bd{
    
    private $host;
    private $user;
    private $mdp;
    private $bdd;
    public $co;

    public function __construct(){
        $this->host = "localhost";
        $this->user = "root";
        $this->mdp = "";
        $this->bdd = "projet";
    }

    public function connect(){
        $this->co = mysqli_connect($this->host, $this->user, $this->mdp, $this->bdd);
    }
}
?>
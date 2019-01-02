<?php
   require_once("../Modele/bd.php");
  
    if (isset($_POST['user'])) {
       
        $user = $_POST['user']; 
        $mdp = $_POST['mdp'];
             
        $bd = new bd();
        $bd->connect(); 
        $verifUser = "SELECT user FROM utilisateur";
        $result = mysqli_query($bd->co, $verifUser);

        $found = false;
            
        while($row = mysqli_fetch_array($result,MYSQLI_ASSOC)){
            if($row["user"] == $user){
                $found = true;
                break;
            }
        }
        if($found){
            $verifMdp = "SELECT mdp FROM utilisateur WHERE user = '$user'";
            $result = mysqli_query($bd->co, $verifMdp);
            $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
            if($mdp == $row["mdp"]){  
                echo "Bonjour ".$user;
            }
            else{
                echo "Mot de Passe Faux";
            }
        }
        else{
            echo "Ce compte n'existe pas";
        } 
    }
?>
<?php
   require_once("../Modele/bd.php");

  
    if (isset($_POST['user'])) {
        $nom = $_POST['nom'];   
        $prenom = $_POST['prenom']; 
        $mail = $_POST['mail'];
        $age = $_POST['age'];
        $user = $_POST['user']; 
        $mdp = $_POST['mdp'];
        $mdpConfirm = $_POST['mdpConfirm'];

        if($mdp == $mdpConfirm){
           
            $bd = new bd();
            $bd->connect(); 
            $requete = "SELECT user FROM utilisateur";
            $result = mysqli_query($bd->co, $requete);
            
            $found = false;
            
            while($row = mysqli_fetch_array($result,MYSQLI_ASSOC)){
                if($row["user"] == $user){
                    $found = true;
                    break;
                }
            }
            if(!$found){
                $requete = "INSERT INTO utilisateur (nom, prenom, mail, age, actif, user, mdp) VALUES ('$nom','$prenom','$mail','$age',1,'$user','$mdp')";
                if(mysqli_query($bd->co,$requete)){
                    echo "Inscription effectuée";
               } 
               else{
                    echo mysqli_error($bd->co);
               }
            }
            else{
                echo "Ce nom d'utilisateur est déjà utilisé";
            }                             
        }
        else{
            echo"Les mots de passe sont différents";
        }    
    }
?>
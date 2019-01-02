<?php
   require_once("../Modele/bd.php");

  
    if (isset($_POST['login'])) {
        $nom = $_POST['nom'];   
        $prenom = $_POST['prenom']; 
        $mail = $_POST['mail'];
        $age = $_POST['age'];
        $login = $_POST['login']; 
        $mdp = $_POST['mdp'];
        $mdpConfirm = $_POST['mdpConfirm'];

        if($mdp == $mdpConfirm){
           
            $bd = new bd();
            $bd->connect(); 
            $requete = "SELECT user FROM utilisateur";
            $result = mysqli_query($bd->co, $requete);
            $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
            
            if($row == NULL){ //Cas Base de données vide
                echo "test";
                $requete = "INSERT INTO utilisateur (nom, prenom, mail, age, actif, user, mdp) VALUES ('$nom','$prenom','$mail','$age',1,'$login','$mdp')";
                if(mysqli_query($bd->co,$requete)){
                    echo "Inscription effectuée";
               } 
               else{
                    echo mysqli_error($bd->co);
               }
            }
            else if(!(in_array($login, $row))){
                $requete = "INSERT INTO utilisateur (nom, prenom, mail, age, actif, user, mdp) VALUES ('$nom','$prenom','$mail','$age',1,'$login','$mdp')";
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
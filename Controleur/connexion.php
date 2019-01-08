<?php
    require_once("../Modele/bd.php");
    require_once("../Modele/utilisateur.php");

    session_start();

    if (isset($_POST['user'])) {
       
        $user = $_POST['user']; 
        $mdp = $_POST['mdp'];
             
        $bd = new bd();
        $bd->connect(); 
        $verifUser = "SELECT * FROM utilisateur";
        $resultUSer = mysqli_query($bd->co, $verifUser);

        $found = false;
            
        //Verification de l'existance du compte
        while($row = mysqli_fetch_array($resultUSer,MYSQLI_ASSOC)){
            if($row["user"] == $user){
                $found = true;
                break;
            }
        }
        if($found){
            //Verification du Mdp                
            $_SESSION['verifUser'] = true;

            $verif = "SELECT * FROM utilisateur WHERE user = '$user'";
            $result = mysqli_query($bd->co, $verif);
            $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
            if($mdp == $row["mdp"]){  

                //Creation de la variable de Session utilisateur afin d'y acceder plus simplement à travers tout le site
                $_SESSION['utilisateur'] = serialize(new utilisateur($row["id"],$row["nom"],$row["prenom"],$row["mail"],$row["age"],$row["actif"],$row["user"],$row["mdp"]));
                $_SESSION['verifMdp'] = true;

                header("Location: ../Vue/page_interne.php");
            }
            else{
                $_SESSION['verifMdp'] = false;
                header("Location: ../Vue/index.php");
            }
        }
        else{
            $_SESSION['verifUser'] = false;
            header("Location: ../Vue/index.php");
        } 
    }
?>
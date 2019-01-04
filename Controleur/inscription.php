<?php
    session_start();
    require_once("../Modele/bd.php");

    $_SESSION['mdpDiff'] = false;
    $_SESSION['userEnregistre'] = false;
    $_SESSION['verifAge'] = true;
    $_SESSION['inscriptionError'] = false;

    $_SESSION['insNom'] = true;
    $_SESSION['insPrenom'] = true;
    $_SESSION['insMail'] = true;
    $_SESSION['insAge'] = true;
    $_SESSION['insUser'] = true;
    $_SESSION['insMdp'] = true;
    $_SESSION['insMdpConfirm'] = true;

    if ($_POST['nom'] != null && $_POST['prenom'] != null && $_POST['mail'] != null && $_POST['age'] != null && $_POST['user'] != null && $_POST['mdp'] != null && $_POST['mdpConfirm'] != null) {
        
        $nom = $_POST['nom'];   
        $prenom = $_POST['prenom']; 
        $mail = $_POST['mail'];
        $age = $_POST['age'];
        $user = $_POST['user']; 
        $mdp = $_POST['mdp'];
        $mdpConfirm = $_POST['mdpConfirm'];

        if(is_numeric($age) && $age > -1 && $age < 150)
        {
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
                        $_SESSION['inscriptionValidee'] = true;
                        header("Location: ../Vue/index.php");
                } 
                else{
                    $_SESSION['inscriptionError'] = true;
                    header("Location: ../Vue/formulaire_inscription.php");
                }
                }
                else{
                    $_SESSION['userEnregistre'] = true;
                    header("Location: ../Vue/formulaire_inscription.php");
                }                             
            }
            else{
                $_SESSION['mdpDiff'] = true;
                header("Location: ../Vue/formulaire_inscription.php");
            }    
        }
        else{
            $_SESSION['verifAge'] = false;
            header("Location: ../Vue/formulaire_inscription.php");
        }
    }    
    else{
        if($_POST['nom'] == null) $_SESSION['insNom'] = false;
        if($_POST['prenom'] == null) $_SESSION['insPrenom'] = false;
        if($_POST['mail'] == null) $_SESSION['insMail'] = false;
        if($_POST['age'] == null) $_SESSION['insAge'] = false;
        if($_POST['user'] == null) $_SESSION['insUser'] = false;
        if($_POST['mdp'] == null) $_SESSION['insMdp'] = false;
        if($_POST['mdpConfirm'] == null) $_SESSION['insMdpConfirm'] = false;

        header("Location: ../Vue/formulaire_inscription.php");
    }
?>
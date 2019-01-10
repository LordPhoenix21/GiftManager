<?php
    session_start();
    require_once("../Modele/bd.php");
    require_once("../Modele/utilisateur.php");

    $_SESSION['userEnregistre'] = false;
    $_SESSION['verifAge'] = true;
    $_SESSION['mdpFalse'] = false;

    $_SESSION['updateNom'] = false;
    $_SESSION['updatePrenom'] = false;
    $_SESSION['updateMail'] = false;
    $_SESSION['updateAge'] = false;
    $_SESSION['updateUser'] = false;


    $_SESSION['confirmation'] = true;

    if ($_POST['mdpConfirm'] != null) {
        
        $nom = $_POST['nom'];   
        $prenom = $_POST['prenom']; 
        $mail = $_POST['mail'];
        $age = $_POST['age'];
        $newUser = $_POST['user']; 
        $mdpConfirm = $_POST['mdpConfirm'];
   
        $bd = new bd();
        $bd->connect();
        $user = unserialize($_SESSION['utilisateur']);

        if($user->getMdp() == $mdpConfirm){
            $id = $user->getId();

            if($nom != null){
                $update = "UPDATE utilisateur SET nom='$nom' WHERE id='$id'";
                if(mysqli_query($bd->co, $update)){
                    $user->setNom($nom);
                    $_SESSION['utilisateur'] = serialize($user);
                    $_SESSION['updateNom'] = true;
                }
                else{
                    echo mysqli_error($bd->co);
                }
            }   
            if($prenom != null){
                $update = "UPDATE utilisateur SET prenom='$prenom' WHERE id='$id'";
                if(mysqli_query($bd->co, $update)){
                    $user->setPrenom($prenom);
                    $_SESSION['utilisateur'] = serialize($user);
                    $_SESSION['updatePrenom'] = true;
                }
                else{
                    echo mysqli_error($bd->co);
                }
            }   
            if($mail != null){
                $update = "UPDATE utilisateur SET mail='$mail' WHERE id='$id'";
                if(mysqli_query($bd->co, $update)){
                    $user->setMail($mail);
                    $_SESSION['utilisateur'] = serialize($user);
                    $_SESSION['updateMail'] = true;
                }
                else{
                    echo mysqli_error($bd->co);
                }
            }
            if($age != null){
                if(is_numeric($age) && $age > -1 && $age < 150){
                    $update = "UPDATE utilisateur SET age='$age' WHERE id='$id'";
                    if(mysqli_query($bd->co, $update)){
                        $user->setAge($age);
                        $_SESSION['utilisateur'] = serialize($user);
                        $_SESSION['updateAge'] = true;
                    }
                    else{
                        echo mysqli_error($bd->co);
                    }
                }
                else{
                    $_SESSION['verifAge'] = false;
                }
            }
            if($newUser != null){
                $requete = "SELECT user FROM utilisateur";
                $result = mysqli_query($bd->co, $requete);
                $found = false;            
                while($row = mysqli_fetch_array($result,MYSQLI_ASSOC)){
                    if($row["user"] == $user->getNom()){
                        $found = true;
                        break;
                    }
                }
                if(!$found){
                    $update = "UPDATE utilisateur SET user='$newUser' WHERE id='$id'";
                    if(mysqli_query($bd->co, $update)){
                        $user->setUser($newUser);
                        $_SESSION['utilisateur'] = serialize($user);
                        $_SESSION['updateUser'] = true;
                    }
                    else{
                        echo mysqli_error($bd->co);
                    }
                }
                else{
                    $_SESSION['userEnregistre'] == true;
                }
            } 
        }
        else{
            $_SESSION['mdpFalse'] = true;
        }     
        header("Location: ../Vue/page_parametre.php");
    }    
    else{
       
        if($_POST['mdpConfirm'] == null) $_SESSION['confirmation'] = false;

        header("Location: ../Vue/page_parametre.php");
    }
?>
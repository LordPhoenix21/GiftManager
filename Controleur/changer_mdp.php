<?php
    session_start();
    require_once("../Modele/bd.php");
    require_once("../Modele/utilisateur.php");

    $_SESSION['mdpDiff'] = false;
    $_SESSION['mdpFalse'] = false;
    $_SESSION['updateMdp'] = false;

    $_SESSION['changeOldMdp'] = true;
    $_SESSION['changeNewMdp'] = true;
    $_SESSION['changeMdpConfirm'] = true;

    if ($_POST['oldMdp'] != null && $_POST['newMdp'] != null && $_POST['mdpConfirm'] != null) {
        $oldMdp = $_POST['oldMdp'];   
        $newMdp = $_POST['newMdp']; 
        $mdpConfirm = $_POST['mdpConfirm'];

       if($newMdp == $mdpConfirm){
            $bd = new bd();
            $bd->connect(); 
            $user = unserialize($_SESSION['utilisateur']);
            $id = $user->getId();
            $requete = "SELECT mdp FROM utilisateur WHERE id='$id'";
            $result = mysqli_query($bd->co, $requete);

            $reelMdp= mysqli_fetch_array($result,MYSQLI_ASSOC);
            if($oldMdp == $reelMdp['mdp']){
                $update = "UPDATE utilisateur SET mdp='$newMdp' WHERE id='$id'";
                if(mysqli_query($bd->co, $update)){
                    $_SESSION['updateMdp'] = true;
                    $user->setMdp($newMdp);
                    $_SESSION['utilisateur'] = serialize($user);
                    header("Location: ../Vue/page_parametre.php");
                }
                else{
                    echo mysqli_error($bd->co);
                }
            } 
            else{
                $_SESSION['mdpFalse'] = true;
                header("Location: ../Vue/page_parametre.php");
            }                   
        }
        else{
            $_SESSION['mdpDiff'] = true;
            header("Location: ../Vue/page_parametre.php");
        }    
       
    }    
    else{
        if($_POST['oldMdp'] == null) $_SESSION['changeOldMdp'] = false;
        if($_POST['newMdp'] == null) $_SESSION['changeNewMdp'] = false;
        if($_POST['mdpConfirm'] == null) $_SESSION['changeMdpConfirm'] = false;

        header("Location: ../Vue/page_parametre.php");
    }
?>
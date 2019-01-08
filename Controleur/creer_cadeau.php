<?php
    require_once("../Modele/bd.php");
    session_start();

    $_SESSION['cadNom'] = true;
    $_SESSION['cadeauValide'] = false;
    $_SESSION['cadeauError'] = false;
    $_SESSION['cadeauEnregistre'] = false;

    if ($_POST["nom"] != null) {
        
        $nom = $_POST['nom'];   
        $lien = $_POST['lien']; 
        $img = $_POST['img'];
        $desc = $_POST['desc'];

        $bd = new bd();
        $bd->connect(); 
        $requete = "SELECT nom FROM cadeau";
        $result = mysqli_query($bd->co, $requete);
        
        $found = false;
        
        while($row = mysqli_fetch_array($result,MYSQLI_ASSOC)){
            if($row["nom"] == $nom){
                $found = true;
                break;
            }
        }
        if(!$found){
            $requete = "INSERT INTO cadeau (nom, lien, image, description) VALUES ('$nom','$lien','$img','$desc')";
            if(mysqli_query($bd->co,$requete)){
                $_SESSION['cadeauValide'] = true;
                header("Location: ../Controleur/script_cadeaux.php");
            }
            else{
                $_SESSION['cadeauError'] = true;
                header("Location: ../Vue/formulaire_cadeau.php");
            }
        } 
        else{
            $_SESSION['cadeauEnregistre'] = true;
            header("Location: ../Vue/formulaire_cadeau.php");
        }

    }    
    else{
        if($_POST['nom'] == null) $_SESSION['cadNom'] = false;

        header("Location: ../Vue/formulaire_cadeau.php");
    }
?>
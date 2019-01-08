<?php
    require_once("../Modele/bd.php");
    require_once("../Modele/utilisateur.php");
    session_start();

    $_SESSION['lisNom'] = true;
    $_SESSION['listeValidee'] = false;
    $_SESSION['listeError'] = false;

    if ($_POST["nom"] != null) {
        
        $nom = $_POST['nom'];   

        $bd = new bd();
        $bd->connect(); 
        $user = unserialize($_SESSION['utilisateur']);
        $id = $user->getId();

        $requete = "INSERT INTO liste (id_utilisateur, nom) VALUES ('$id','$nom')";
        if(mysqli_query($bd->co,$requete)){
            $_SESSION['listeValidee'] = true;
            header("Location: ../Controleur/script_liste.php");
        }
        else{
            $_SESSION['listeError'] = true;
            header("Location: ../Vue/formulaire_liste.php");
        }
    }    
    else{
        if($_POST['nom'] == null) $_SESSION['lisNom'] = false;

        header("Location: ../Vue/formulaire_liste.php");
    }
<?php
    require_once("../Modele/bd.php");
    session_start();

    $_SESSION['cadNom'] = true;
    $_SESSION['cadeauValide'] = false;
    $_SESSION['cadeauError'] = false;
    $_SESSION['cadeauEnregistre'] = false;

    if ($_POST["nom"] != null) {
        
        $nom = $_POST['nom'];   

        $bd = new bd();
        $bd->connect(); 
        
        $requete = "INSERT INTO liste (id_utilisateur, nom) VALUES ('$_SESSION['utilisateur']->getId()','$nom')";
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
        if($_POST['nom'] == null) $_SESSION['cadNom'] = false;

        header("Location: ../Vue/formulaire_cadeau.php");
    }
<?php
    require_once("../Modele/bd.php");
    require_once("../Modele/liste.php");
    require_once("../Modele/cadeau.php");
    session_start();

    $_SESSION["addNull"] = false;
    $id = $_GET['idListe'];

    $bd = new bd();
    $bd->connect(); 
    
    if(isset($_POST["cadeau"])){
        foreach($_POST["cadeau"] as $id_cadeau){
            $requete = "INSERT INTO liste_cadeau (id_liste, id_cadeau, achete, fantome) VALUES ('$id','$id_cadeau',0,0)";
            if(mysqli_query($bd->co,$requete)){
                header("Location: ../Controleur/script_liste.php");
            }
            else{
               echo mysqli_error($bd->co);
            }
        }
    }
    else {
        $id = intval($_GET['idListe']);
        $_SESSION["addNull"] = true;
        header("Location: ../Vue/page_cadeaux.php?idListe=$id");
    }
    
?>
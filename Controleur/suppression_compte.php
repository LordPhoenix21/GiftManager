<?php
    require_once("../Modele/bd.php");
    require_once("../Modele/utilisateur.php");

    session_start();
    
    $bd = new bd();
    $bd->connect();
    
    $user = unserialize($_SESSION['utilisateur']);
    $id = $user->getId();

    $delete = "DELETE FROM utilisateur WHERE id = $id";
    mysqli_query($bd->co, $delete);

    $requete = "SELECT * FROM liste WHERE id_utilisateur = $id";
    $result = mysqli_query($bd->co,$requete);

    $id_liste = array();
    while($row = mysqli_fetch_array($result,MYSQLI_ASSOC))
    {                    
        $id_liste[] = $row['id'];
    }
    foreach($id_liste as $liste){
        $suppr_liste_cadeau = "DELETE FROM liste_cadeau WHERE id_liste = $liste";
        mysqli_query($bd->co, $suppr_liste_cadeau);
        $suppr_liste = "DELETE FROM liste WHERE id = $liste";
        mysqli_query($bd->co, $suppr_liste);
    }
    session_destroy();
    header("Location: ../Vue/index.php");
?>
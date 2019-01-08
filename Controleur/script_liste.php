<?php
    require_once("../Modele/bd.php");
    require_once("../Modele/utilisateur.php");
    require_once("../Modele/liste.php");
    session_start();

    $bd = new bd();
    $bd->connect();
    $user = unserialize($_SESSION['utilisateur']);
    $id = $user->getId();

    $requete = "SELECT * FROM liste WHERE id_utilisateur = $id";
    $result = mysqli_query($bd->co,$requete);

    $array_liste = array();
    while($row = mysqli_fetch_array($result,MYSQLI_ASSOC))
    {                    
        $array_liste[] = new liste($row['id'],$row['id_utilisateur'],$row['nom']);
    }
    $_SESSION["array_liste"] = $array_liste;

   header("Location: ../Vue/page_liste.php");
?>
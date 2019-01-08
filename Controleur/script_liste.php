<?php
    session_start();
    require_once("../Modele/bd.php");

    $bd = new bd();
    $bd->connect();
    $requete = "SELECT * FROM cadeau";
    $result = mysqli_query($bd->co,$requete);

    $array_cadeau = array();
    while($row = mysqli_fetch_array($result,MYSQLI_ASSOC))
    {                    
        $array_cadeau[] = new cadeau($row['num'],$row['nom'],$row['lien'],$row['image'],$row['description']);
    }
    $_SESSION["array_cadeau"] = $array_cadeau;

   header("Location: ../Vue/page_cadeaux.php");
?>
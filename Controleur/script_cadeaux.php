<?php
    session_start();
    require_once("../Modele/bd.php");
    require_once("../Modele/cadeau.php");

    $bd = new bd();
    $bd->connect(); 
    $requete = "SELECT * FROM cadeau";
    $result = mysqli_query($bd->co,$requete);

    $_SESSION["cadeaux"] = mysqli_fetch_array($result,MYSQLI_ASSOC);

    header("Location: ../Vue/page_cadeaux.php");
?>
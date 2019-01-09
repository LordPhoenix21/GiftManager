<?php
    require_once("../Modele/bd.php");

    $bd = new bd();
    $bd->connect();

    $sql = 'UPDATE liste_cadeau SET achete = 1 WHERE id_liste = '.$_GET['id_liste'].' AND id_cadeau = '.$_GET['id_cadeau'];
    echo mysqli_query($bd->co,$sql);

    $link = 'Location: ../Vue/page_groupe.php?gid='.$_GET['gid'].'&pid='.$_GET['pid'];
    header($link);
?>
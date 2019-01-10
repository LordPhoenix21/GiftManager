<?php
    session_start();

    require_once("../Modele/bd.php");
    require_once("../Modele/utilisateur.php");

    $user = unserialize($_SESSION['utilisateur']);
    $bd = new bd();
    $bd->connect();

    $sql = 'SELECT administrateur FROM acces_groupe WHERE id_utilisateur = '.$user->getId().' AND id_groupe = '.$_GET['gid'];
    $result = mysqli_query($bd->co, $sql);
    $donnees = mysqli_fetch_assoc($result);

    if($donnees['administrateur']){
        $sql = 'UPDATE acces_groupe SET administrateur = 1 WHERE id_groupe = '.$_GET['gid'].' AND id_utilisateur = '.$_GET['pid'];
        mysqli_query($bd->co, $sql);
    }

    header('Location: ../Vue/page_groupe.php?gid='.$_GET['gid']);
?>
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
        $sql = 'DELETE FROM groupe WHERE id='.$_GET['gid'];
        mysqli_query($bd->co, $sql);

        $sql = 'DELETE FROM acces_groupe WHERE id_groupe='.$_GET['gid'];
        mysqli_query($bd->co, $sql);
    }

    header('Location: ../Vue/page_groupe.php');
?>
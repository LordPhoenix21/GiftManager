<?php

    session_start();
    require_once("../Modele/bd.php");
    require_once("../Modele/utilisateur.php");

    $user = unserialize($_SESSION['utilisateur']);

    if(!isset($_POST['name']) || $_POST['name'] == ""){
        header('Location: ../Vue/nouveau_groupe.php?pid='.$user->getId());
    }

    $bd = new bd();
    $bd->connect();

    $sql = 'INSERT INTO groupe (nom) VALUES ("'.$_POST['name'].'")';
    mysqli_query($bd->co, $sql);
    $sql = 'INSERT INTO acces_groupe (id_groupe, id_utilisateur, administrateur) VALUES ('.mysqli_insert_id($bd->co).','.$user->getId().', 1)';
    mysqli_query($bd->co, $sql);

    header('Location: ../Vue/page_groupe.php');
?>
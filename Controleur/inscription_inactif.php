<?php
    session_start();

    require_once("../Modele/bd.php");
    require_once("../Modele/utilisateur.php");

    $user = unserialize($_SESSION['utilisateur']);
    $bd = new bd();
    $bd->connect();

    $sql = 'INSERT INTO utilisateur (prenom, nom, age, actif) VALUES ("'.$_POST['prenom'].'","'.$_POST['nom'].'",'.$_POST['age'].',0)';
    mysqli_query($bd->co, $sql);

    $sql = 'INSERT INTO gestion_inactif (num_actif, num_inactif) VALUES('.$user->getId().','.mysqli_insert_id($bd->co).')';
    mysqli_query($bd->co, $sql);

    header('Location: ../Vue/page_parametre.php');
?>
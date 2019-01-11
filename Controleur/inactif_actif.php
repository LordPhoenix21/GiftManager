<?php
    session_start();

    require_once("../Modele/bd.php");
    require_once("../Modele/utilisateur.php");

    $user = unserialize($_SESSION['utilisateur']);
    $bd = new bd();
    $bd->connect();

    $uniqusr = uniqid("user");
    $uniqmdp = uniqid("mdp");

    echo mail($_POST['mail'], $user->getPrenom()." ".$user->getNom()." invited you", "You have been invited to take control of an account at GiftManager.com by".$user->getPrenom()." ".$user->getNom()." /n Use login ".$uniqusr." and password ".$uniqmdp." to connect and go to settings to edit your personnal informations");

    $sql = 'UPDATE utilisateur SET user = "'.$uniqusr.'" WHERE id = '.$_GET['pid'];
    mysqli_query($bd->co, $sql);

    $sql = 'UPDATE utilisateur SET mdp = "'.$uniqmdp.'" WHERE id = '.$_GET['pid'];
    mysqli_query($bd->co, $sql);

    $sql = 'UPDATE utilisateur SET mail = "'.$_POST['mail'].'" WHERE id = '.$_GET['pid'];
    mysqli_query($bd->co, $sql);

    $sql = 'UPDATE utilisateur SET actif = 1 WHERE id = '.$_GET['pid'];
    mysqli_query($bd->co, $sql);

    $sql = 'DELETE FROM gestion_inactif WHERE num_inactif = '.$_GET['pid'];
    mysqli_query($bd->co, $sql);


    header('Location: ../Vue/page_parametre.php');
?>
<?php
    session_start();
    if(isset($_POST['selection'])){

        require_once("../Modele/bd.php");
        require_once("../Modele/utilisateur.php");

        $bd = new bd();
        $bd->connect();

        $user = unserialize($_SESSION['utilisateur']);

        $sql = 'UPDATE acces_groupe SET id_liste = '.$_POST['selection'].' WHERE id_utilisateur ='.$user->getId().' AND id_groupe = '.$_GET['gid'];
        $result = mysqli_query($bd->co, $sql);

        header('Location: ../Vue/page_groupe?gid='.$_GET['gid']);
    }
    else{
        header('Location: ../Vue/formulaire_selection_liste?gid='.$_GET['gid']);
    }

?>
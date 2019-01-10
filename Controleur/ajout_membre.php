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
        $sql = 'SELECT count(*) AS nb FROM utilisateur WHERE mail ="'.$_POST['mail'].'"';

        $result = mysqli_query($bd->co, $sql);
        $donnees = mysqli_fetch_assoc($result);

        if($donnees['nb'] == 1){
            $sql = 'SELECT id FROM utilisateur WHERE mail ="'.$_POST['mail'].'"';
            $result = mysqli_query($bd->co, $sql);
            $donnees = mysqli_fetch_assoc($result);

            $sql = 'insert into acces_groupe (id_groupe, id_utilisateur, administrateur) values ('.$_GET['gid'].', '.$donnees['id'].', 0)';
            mysqli_query($bd->co, $sql);
        }
        else{
            echo mail($_POST['mail'], $user->getPrenom()." ".$user->getNom()." invited you", "You have been invited to join a group at GiftManager.com by".$user->getPrenom()." ".$user->getNom()." /n you can know create an account and join your friends or relatives");
            echo $sql = 'create trigger trg_insert_'.$_POST['mail'].' on utilisateur for insert
                    as
                    begin
                        insert into acces_groupe (id_groupe, id_utilisateur, administrateur) values ('.$_GET['gid'].', (select id from Inserted), 0)
                    end';
            mysqli_query($bd->co, $sql);
        }
    }

    header('Location: ../Vue/page_groupe.php?gid='.$_GET['gid']);
?>
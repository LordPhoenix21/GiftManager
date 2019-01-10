<?php
    require_once("../Modele/bd.php");
    require_once("../Modele/utilisateur.php");

    session_start();
    
    $bd = new bd();
    $bd->connect();
    
    $user = unserialize($_SESSION['utilisateur']);
    $id = $user->getId();

    $sql = "SELECT administrateur FROM acces_groupe WHERE id_utilisateur = '$id'";
    $result = mysqli_query($bd->co, $sql);
    while ($row = mysqli_fetch_assoc($result)){
        if($row['administrateur']){
            $_SESSION['suppression_impossible'] = true;
            header("Location: ../Vue/page_parametre.php");
            exit;
        }
    }    

    $delete = "DELETE FROM utilisateur WHERE id = $id";
    mysqli_query($bd->co, $delete);

    $requete = "SELECT * FROM liste WHERE id_utilisateur = $id";
    $result = mysqli_query($bd->co,$requete);

    $id_liste = array();
    while($row = mysqli_fetch_array($result,MYSQLI_ASSOC))
    {                    
        $id_liste[] = $row['id'];
    }
    foreach($id_liste as $liste){
        $suppr_liste_cadeau = "DELETE FROM liste_cadeau WHERE id_liste = $liste";
        mysqli_query($bd->co, $suppr_liste_cadeau);
        $suppr_liste = "DELETE FROM liste WHERE id = $liste";
        mysqli_query($bd->co, $suppr_liste);
    }

    $requete = "SELECT id_groupe FROM acces_groupe WHERE id_utilisateur = $id";
    $result_grp = mysqli_query($bd->co,$requete);

    $suppr_membre = "DELETE FROM acces_groupe WHERE id_utilisateur = $id";
    mysqli_query($bd->co, $suppr_membre);

    $id_grp = array();
    while($row = mysqli_fetch_array($result_grp,MYSQLI_ASSOC))
    {                    
        $id_grp[] = $row['id_groupe'];
    }
    foreach($id_grp as $grp){
        $sql = "SELECT * FROM acces_groupe WHERE id_groupe = '$grp'";
        $result_grp = mysqli_query($bd->co,$requete);
        $num_rows = mysqli_num_rows($result_grp);
        echo $num_rows;
        if($num_rows <= 0){
            mysqli_query($bd->co, "DELETE FROM groupe WHERE id = '$grp'");
        }
    }

    $requete = "DELETE FROM gestion_inactif WHERE num_actif = $id";
    mysqli_query($bd->co, $delete);
    $requete = "DELETE FROM gestion_inactif WHERE num_inactif = $id";
    mysqli_query($bd->co, $delete);

    session_destroy();
    header("Location: ../Vue/index.php");
?>
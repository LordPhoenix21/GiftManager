<?php
    require_once("../Modele/bd.php");
    require_once("../Modele/utilisateur.php");
    require_once("../Modele/liste.php");
    require_once("../Modele/cadeau.php");
    session_start();

    $bd = new bd();
    $bd->connect();
    $user = unserialize($_SESSION['utilisateur']);
    $id = $user->getId();

    $requete = "SELECT * FROM liste WHERE id_utilisateur = $id";
    $result = mysqli_query($bd->co,$requete);

    $array_liste = array();
    while($row = mysqli_fetch_array($result,MYSQLI_ASSOC))
    {                    
        $array_liste[] = new liste($row['id'],$row['id_utilisateur'],$row['nom']);
    }

    foreach($array_liste as $lis){
        $id_liste = $lis->getId(); 
        $requete = "SELECT * FROM liste_cadeau WHERE id_liste = $id_liste";
        $result = mysqli_query($bd->co,$requete);
        while($row = mysqli_fetch_array($result,MYSQLI_ASSOC))
        {     
            $num_cad = $row['id_cadeau'];
            $requete_cadeau = "SELECT * FROM cadeau WHERE num = $num_cad";               
            $result_cad = mysqli_query($bd->co,$requete_cadeau);
            $cad = mysqli_fetch_array($result_cad,MYSQLI_ASSOC);
            
            $lis->addCadeau(new cadeau($cad['num'],$cad['nom'],$cad['lien'],$cad['image'],$cad['description']), 0,0);
        }
    }    

    $_SESSION["array_liste"] = $array_liste;

   header("Location: ../Vue/page_liste.php");
?>
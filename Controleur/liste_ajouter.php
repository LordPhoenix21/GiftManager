<?php
    require_once("../Modele/bd.php");
    require_once("../Modele/liste.php");
    require_once("../Modele/cadeau.php");
    session_start();


    $id = $_GET['idListe'];

    $bd = new bd();
    $bd->connect(); 
    
    if(isset($_POST["cadeau"])){
        foreach($_POST["cadeau"] as $id_cadeau){
            echo intval($id_cadeau);
            $requete = "INSERT INTO liste_cadeau (id_liste, id_cadeau, achete, fantome) VALUES ('$id','$id_cadeau',0,0)";
            if(mysqli_query($bd->co,$requete)){
                echo "Fonctionne";
            }
            else{
               echo mysqli_error($bd->co);
            }
        }
    }
    else {
        echo "Rien cocher";
    }
    
?>
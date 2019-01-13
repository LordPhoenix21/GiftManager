<?php
    session_start();
    require_once("../Modele/bd.php");
    require_once("../Modele/cadeau.php");

    $bd = new bd();
    $bd->connect();
    $requete = "SELECT * FROM cadeau";
    $result = mysqli_query($bd->co,$requete);

    $array_cadeau = array();
    //Cas recherche
    if(isset($_GET['search']) && $_POST['searchBar'] != null){
         $sch = strtolower($_POST['searchBar']);
          while($row = mysqli_fetch_array($result,MYSQLI_ASSOC))
          {
               if(strpos(strtolower($row['nom']), $sch) !== false){
                    $array_cadeau[] = new cadeau($row['num'],$row['nom'],$row['lien'],$row['image'],$row['description']);
               }       
          }
    }
    //Cas normal
    else{
          while($row = mysqli_fetch_array($result,MYSQLI_ASSOC))
          {       
               $array_cadeau[] = new cadeau($row['num'],$row['nom'],$row['lien'],$row['image'],$row['description']);
          }
    }
    
    $_SESSION["array_cadeau"] = $array_cadeau;

   if(isset($_GET['idListe'])){
        $id = intval($_GET['idListe']);
        header("Location: ../Vue/page_cadeaux.php?idListe=$id");
   }    
   else{
        header("Location: ../Vue/page_cadeaux.php");
   }
    

?>
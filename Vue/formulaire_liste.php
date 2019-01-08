<?php 
    session_start() 
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset = "utf-8"> 
        <title>GiftManager</title>
        <link rel = "stylesheet" href = "css.css">
    </head>
    <body>
        <?php
            if(isset($_SESSION["listeError"])){
                if($_SESSION["listeError"]){
                    echo "Il ya eu une erreur dans la création de la liste";
                }
            }
                
        ?> 
        <form method = "post" action ="../Controleur/creer_liste.php">
            Nom : <input type = "text" name = "nom" />
            <?php 
                if(isset($_SESSION["lisNom"])){                    
                    if(!($_SESSION["lisNom"])){
                        echo " Ce champ n'a pas été rempli";
                    }
                }                 
                ?> 
            <br>
            <input type = "submit" value ="Créer">
        </form>
    </body>
</html>
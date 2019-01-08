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
            if(isset($_SESSION["cadeauError"])){
                if($_SESSION["cadeauError"]){
                    echo "Il ya eu une erreur dans la création du cadeau";
                }
            }
                
        ?> 
        Seul le champ nom est obligatoire
        <form method = "post" action ="../Controleur/creer_cadeau.php">
            Nom : <input type = "text" name = "nom" />
            <?php 
                if(isset($_SESSION["cadNom"])){                    
                    if(!($_SESSION["cadNom"])){
                        echo " Ce champ n'a pas été rempli";
                    }
                } 
                if(isset($_SESSION["cadeauEnregistre"])){
                    if($_SESSION["cadeauEnregistre"]){
                        echo " Ce nom de cadeau existe déjà veuillez en choisir un autre";
                    }
                }
                
                ?> 
            <br>
            Lien : <input type = "text" name = "lien" />
            <br>
            Adresse de l'image : <input type = "text" name = "img" />
            <br>
            Description : <input type = "text" name = "desc" />
            <br>
            <input type = "submit" value ="Créer">
        </form>
    </body>
</html>
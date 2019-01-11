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
        Seul le champ nom est obligatoire
        <form method = "post" action ="../Controleur/creer_cadeau.php" enctype="multipart/form-data">
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
            image: <input type = "file" name = "img" />
            <br>
            Description : <input type = "text" name = "desc" />
            <br>
            <input type = "submit" value ="Créer">
        </form>
    </body>
</html>
<?php
   session_start();    
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset = "utf-8"> 
        <title>GiftManager</title>
        <link rel = "stylesheet" href = "css.css">
    </head>
    <header>
        <img src="Logo.png" class = "logo" alt="Logo" height="2%" width="2%">
        <div class = "header-liens"> 
            <a href = "page_groupe.php"> Vos Groupes </a>
            <a href = "page_liste.php"> Vos Listes </a>
            <a href = "../Controleur/script_cadeaux.php"> Les cadeaux </a>
        </div>
        <div class = "header-droite">
            <a href ="page_parametre.php"> Parametres </a>
        </div> 
    </header>
    <body>
        <ul>
            <?php
                foreach( $_SESSION["array_cadeau"] as $cad){
                    ?>
                    <li><?php echo $cad->getNom();?></li>
                    <?php
                }
            ?>
            <li><a href = "../Vue/formulaire_liste.php">Creer un cadeau</a></li>
        </ul>
    </body>
</html>
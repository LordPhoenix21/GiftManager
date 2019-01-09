<?php
    require_once("../Modele/utilisateur.php");
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
            <a href = "../Controleur/script_liste.php""> Vos Listes </a>
            <a href = "../Controleur/script_cadeaux.php"> Les cadeaux </a>
        </div>
        <div class = "header-droite">
            <ul id="menu_param">
                <?php $user = unserialize($_SESSION['utilisateur']);?>
                <li><a href="#"><?php echo $user->getPrenom()." ".$user->getNom(); ?></a>
                    <ul>
                        <li><a href="page_parametre.php">Paramatres</a></li>
                        <li><a href="index.php?deco=true">Deconnexion</a></li>
                    </ul>
                </li>
            <ul>
        </div> 
    </header>
    <body>
        Test
        
    </body>
</html>
<?php
session_start();
require_once("../Modele/bd.php");
require_once("../Modele/utilisateur.php");
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset = "utf-8">
    <title>GiftManager</title>
    <link rel = "stylesheet" href = "css.css">
</head>

    <body>
        <header>
            <img src="Logo.png" class = "logo" alt="Logo" height="2%" width="2%">
            <div class = "header-liens"> 
                <ul>
                    <li><a href = "page_groupe.php"> Vos Groupes </a></li>
                    <li><a href = "../Controleur/script_liste.php"> Vos Listes </a></li>
                    <li><a href = "../Controleur/script_cadeaux.php"> Les cadeaux </a></li>
                    <div class="reactive">
                        <li><a href="page_parametre.php">Paramètres</a></li>
                        <li><a href="index.php?deco=true">Deconnexion</a></li>
                    </div>
                </ul>
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

        <h1>Nouveau Groupe</h1>

        <form action="../Controleur/nouveau_groupe.php" method="post">

            <table>
                <tr>
                    <td>Nom</td><td><input type="text" name="name"</td>
                </tr>
            </table>

            <input type="submit" class="button">

        </form>

    </body>

</html>
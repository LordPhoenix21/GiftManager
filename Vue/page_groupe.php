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
                <a href = "page_groupe.php"> Vos Groupes </a>
                <a href = "../Controleur/script_liste.php"> Vos Listes </a>
                <a href = "../Controleur/script_cadeaux.php"> Les cadeaux </a>
            </div>
            <div class = "header-droite">
                <a href ="page_parametre.php"> Parametres </a>
            </div>
        </header>

        <h1>Vos groupes</h1>

        <a href="nouveau_groupe.php" style="margin-left:0" class="button"><span>Nouveau</span></a>

        <table>
            <?php
                $user = unserialize($_SESSION['utilisateur']);
                $bd = new bd();
                $bd->connect();
                $php = 'SELECT G.nom, G.id FROM groupe G, acces_groupe AG WHERE G.id = AG.id_groupe AND AG.id_utilisateur = '.$user->getId();
                $result = mysqli_query($bd->co, $php);
                while($donnees = mysqli_fetch_assoc($result)){
                    echo $donnees['nom'];
                }
            ?>
        </table>



    </body>

</html>
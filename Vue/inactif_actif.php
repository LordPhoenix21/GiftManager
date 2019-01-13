<?php
    session_start();
    require_once("../Modele/bd.php");
    require_once("../Modele/utilisateur.php");

    $bd = new bd();
$bd->connect();
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
            <img src="Logo.png" class = "logo" alt="Logo" height="3%" width="3%">
            <div class = "header-liens">
                <ul>
                    <li><a href = "page_groupe.php"> Vos Groupes </a></li>
                    <li><a href = "../Controleur/script_liste.php"> Vos Listes </a></li>
                    <li><a href = "../Controleur/script_cadeaux.php"> Les cadeaux </a></li>
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

        <h1>Rendre ce membre actif</h1>

        <form action="../Controleur/inactif_actif.php?pid=<?php echo $_GET['pid']?>" method="post">
            <table>

                <tr><td>mail</td><td><input name="mail" type="text"></td></tr>

            </table>
            <input type="submit" class="button">
        </form>

    </body>

</html>
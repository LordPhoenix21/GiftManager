<?php
    require_once("../Modele/liste.php");
    require_once("../Modele/cadeau.php");
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
    <body>
        <h1> Vos Listes </h1>
        <?php
            foreach($_SESSION["array_liste"] as $lis){
                ?>
                    <table class = "affichage_cadeau">
                        <tr>
                            <th class = "titre_liste" colspan="4"><?php echo $lis->getNom();?></th>
                        </tr>
                        <tr>
                            <th>Image</th>
                            <th>Nom</th>
                            <th>Lien</th>
                            <th>Descrition</th>
                        </tr>
                        <?php
                            foreach($lis->getCadeau() as $cad){
                                ?>
                                <tr>
                                    <td><img src = <?php echo $cad->getImage()?> alt = "Ce cadeau n'a pas d'image"></td>
                                    <td><?php echo $cad->getNom(); ?></td>
                                    <td><a href = <?php echo $cad->getLien(); ?>> <?php echo $cad->getLien();?> </a></td>
                                    <td><?php echo $cad->getDesc(); ?></td>
                                <tr>
                                <?php
                            }  
                        ?>
                        <tr>
                            <td colspan="4"><a href = "../Controleur/script_cadeaux.php?idListe=<?php echo $lis->getId() ?> ">Ajouter un cadeau</a></td>
                        </tr>
                    </table>
                <?php
            }
        ?>
        <br>
        <a href = "../Vue/formulaire_liste.php">Creer une liste</a>
    </body>
</html>
<?php
    require_once("../Modele/liste.php");
    require_once("../Modele/cadeau.php");
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
            <a href = "../Controleur/script_liste.php"> Vos Listes </a>
            <a href = "../Controleur/script_cadeaux.php"> Les cadeaux </a>
        </div>
        <div class = "header-droite">
            <a href ="page_parametre.php"> Parametres </a>
        </div> 
    </header>
    <body>
            <?php
                foreach($_SESSION["array_liste"] as $lis){
                    ?>
                        <table>
                            <tr>
                                <th><?php echo $lis->getNom();?></th>
                            </tr>
                            <?php
                                foreach($lis->getCadeau() as $cad){
                                    ?>
                                    <tr>
                                        <td><?php echo $cad->getNom();?></td>
                                    </tr>
                                    <?php
                                }
                            ?>
                            <tr>
                                <td><a href = "../Controleur/script_cadeaux.php?idListe=<?php echo $lis->getId() ?> ">Ajouter un cadeau</a></td>
                            </tr>
                        </table>
                    <?php
                }
            ?>
            <br>
            <a href = "../Vue/formulaire_liste.php">Creer une liste</a>
    </body>
</html>
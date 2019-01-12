<?php
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
        <form method = "post" action ="../Controleur/script_cadeaux.php?search=true&<?php if(isset($_GET['idListe']))echo 'idListe='.$_GET['idListe']?>">
            <input type ="text" name = "searchBar">
            <input type = "submit" value ="Rechercher">
        </form>

        <?php   
        if(isset($_SESSION["addNull"])){
            if($_SESSION["addNull"] == true){
                echo "Rien n'a été coché";
            }
        }   
        if(isset($_GET['idListe'])) echo '<form method = "post" action ="../Controleur/liste_ajouter.php?idListe='.$_GET['idListe'].'">' ?>
        <table class = "affichage_cadeau"> 
            <tr>
                <?php if(isset($_GET['idListe'])) echo "<th>Selection</th>"  ?>
                <th>Image</th>
                <th>Nom</th>
                <th>Lien</th>
                <th>Descrition</th>
            </tr>
            <?php
                foreach( $_SESSION["array_cadeau"] as $cad){
                    ?>
                    <tr>
                        <?php if(isset($_GET['idListe'])) echo '<td><input type="checkbox" name="cadeau[]" value = "'.$cad->getId().'";"></td>'?>
                        <td><img src = <?php echo $cad->getImage()?> alt = "Ce cadeau n'a pas d'image"></td>
                        <td><?php echo $cad->getNom(); ?></td>
                        <td><a href = <?php echo $cad->getLien(); ?>> <?php echo $cad->getLien();?> </a></td>
                        <td><?php echo $cad->getDesc(); ?></td>
                    <tr>
                    <?php
                }  
            ?>
        </table>
        <?php if(isset($_GET['idListe'])) echo '<input type = "submit" value ="Ajouter"></form>'?>
        <a href = "page_cadeaux.php?creerCadeau=true">Creer un cadeau</a>
        <?php    
            //Cas de la création d'un cadeau
            if(isset($_SESSION["cadeauError"])){
                if($_SESSION["cadeauError"]){
                    echo "Il ya eu une erreur dans la création du cadeau";
                }
            }
            if(isset($_GET['creerCadeau'])){
                ?>
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
            <?php
            }
        ?>
                
    </body>
</html>
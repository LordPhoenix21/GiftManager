<?php
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
        if(isset($_GET['idListe'])){
            //Affichage en checkbox pour la selection des cadeaux
            if(isset($_SESSION["addNull"])){
                if($_SESSION["addNull"] == true){
                    echo "Rien n'a été coché";
                }
            }            
            ?>
            <form method = "post" action ="../Controleur/liste_ajouter.php?idListe=<?php echo $_GET['idListe']; ?>">
            <?php
                foreach( $_SESSION["array_cadeau"] as $cad){
                    ?>
                    <input type="checkbox" name="cadeau[]" value = "<?php echo $cad->getId();?>">
                    <label for="<?php $cad->getNom();?>"><?php echo $cad->getNom();?></label>
                    <br>
                    <?php
                } 
                ?>
                <input type = "submit" value ="Ajouter">
            </form>
            <?php
        }
        else{
            //Affichage normal
            ?>
            <table class = "affichage_cadeau"> 
                <tr>
                    <th>Image</th>
                    <th>Nom</th>
                    <th>Lien</th>
                    <th>Descrition</th>
                </tr>
                <?php
                    foreach( $_SESSION["array_cadeau"] as $cad){
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
            </table>
            <a href = "page_cadeaux.php?creerCadeau=true">Creer un cadeau</a>
            <?php
        }         
        ?>
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
            <?php
            }
        ?>
                
    </body>
</html>
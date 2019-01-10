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
        <h1>Bienvenue sur Gift Manager</h1>
        
        <h2>Inscription</h2>

        <?php  
            if(isset($_SESSION['inscriptionError'])){             
                if($_SESSION['inscriptionError'] == true){
                    echo " Il y a eu une erreur lors de votre inscription...";
                }
            }
        ?>  

        <form method = "post" action ="../Controleur/inscription.php">
            Nom : <input type = "text" name = "nom" />
            <?php  verif('insNom'); ?>  <br>
            Prénom : <input type = "text" name = "prenom" />
            <?php  verif('insPrenom'); ?>  <br>
            Adresse mail : <input type = "text" name = "mail" />
            <?php  verif('insMail'); ?>  <br>
            Age : <input type = "text" name = "age" />
            <?php  
                verif('insAge'); 
                if(isset($_SESSION['verifAge'])){             
                    if($_SESSION['verifAge'] == false){
                        echo " Veuillez choisir un age valide en chiffre";
                    }
                }
            ?>  
            <br>
            Login : <input type = "text" name = "user" />
            <?php  
                verif('insUser'); 
                if(isset($_SESSION['userEnregistre'])){             
                    if($_SESSION['userEnregistre'] == true){
                        echo " Ce nom d'utilisateur existe déjà, veuillez en choisir un autre";
                    }
                }
            ?>          
            <br>
            Mot de passe : <input type = "password" name = "mdp" />
            <?php  verif('insMdp'); ?>  <br>
            Confirmez Mot de passe : <input type = "password" name = "mdpConfirm" />
            <?php 
                verif('insMdpConfirm'); 
                if(isset($_SESSION['mdpDiff'])){             
                    if($_SESSION['mdpDiff'] == true){
                        echo " Les mots de passe sont différents";
                    }
                }
            ?>  <br>
            <input type = "submit" value ="Inscription">
        </form>
    </body>
</html>


<?php
    function verif($var){
        if(isset($_SESSION[$var])){                    
            if(!($_SESSION[$var])){
                echo " Ce champ n'a pas été rempli";
            }
        }
    }
?>
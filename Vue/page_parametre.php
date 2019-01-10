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
        <h1>Parametres</h1>
        <h2>Changer de Mot de Passe</h2>
        <?php 
            if(isset($_SESSION['updateMdp'])){             
                if($_SESSION['updateMdp'] == true){
                    echo "Votre mot de passe a été correctement changé";
                }
            }
        ?>
        <form method = "post" action ="../Controleur/changer_mdp.php">
            Ancien Mot de passe : <input type = "text" name = "oldMdp" />
            <?php  
                verif('changeOldMdp');
                if(isset($_SESSION['mdpFalse'])){             
                    if($_SESSION['mdpFalse'] == true){
                        echo " Mot de passe Faux";
                    }
                }
            ?>  <br>
            Nouveau Mot de passe : <input type = "text" name = "newMdp" />
            <?php verif('changeNewMdp');  ?>  <br>
            Confirmez nouveau Mot de passe <input type = "text" name = "mdpConfirm" />
            <?php  
                verif('changeMdpConfirm'); 
                if(isset($_SESSION['mdpDiff'])){             
                    if($_SESSION['mdpDiff'] == true){
                        echo " Les mots de passe sont différents";
                    }
                } 
            ?>  <br>
            <input type = "submit" value ="Changer de Mot de passe">
        </form>

        <h2>Changer les autres parametres </h2>
        <?php 
            if(isset($_SESSION['update'])){             
                if($_SESSION['update'] == true){
                    echo "Vos parametres ont été correctement changés";
                }
            }
        ?>
        Seuls les champs où vous rentrez du texte seront changées. <br>
        Pensez à rentré votre mot de passe pour confirmer les changements.
        <form method = "post" action ="../Controleur/changer_param.php">
             Nom : <input type = "text" name = "nom" />
             <?php updateDone('updateNom'); ?>
            <br>
            Prénom : <input type = "text" name = "prenom" />
            <?php updateDone('updatePrenom'); ?>
             <br>
            Adresse mail : <input type = "text" name = "mail" />
            <?php updateDone('updateMail'); ?>
            <br>
            Age : <input type = "text" name = "age" />
            <?php   
                if(isset($_SESSION['verifAge'])){             
                    if($_SESSION['verifAge'] == false){
                        echo " Veuillez choisir un age valide en chiffre";
                    }
                }
                updateDone('updateAge');
            ?>  
            <br>
            Login : <input type = "text" name = "user" />
            <?php  
                if(isset($_SESSION['userEnregistre'])){             
                    if($_SESSION['userEnregistre'] == true){
                        echo " Ce nom d'utilisateur existe déjà, veuillez en choisir un autre";
                    }
                }
                updateDone('updateUser');
            ?>          
            <br>
            Confirmez les changements en entrant votre mot de passe : <input type = "text" name = "mdpConfirm" />
            <?php 
                verif('confirmation'); 
                if(isset($_SESSION['mdpFalse'])){             
                    if($_SESSION['mdpFalse'] == true){
                        echo " Mot de passe incorrect";
                    }
                }
            ?>  <br>
            <input type = "submit" value ="Changer ces parametres">
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

    function updateDone($var){
        if(isset($_SESSION[$var])){                    
            if($_SESSION[$var]){
                echo " La modification a bien été prise en compte";
            }
        }
    }
?>
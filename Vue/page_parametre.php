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
                    echo "Votre mot de passe a été correctement changé <br>";
                }
            }
        ?>
        <form method = "post" action ="../Controleur/changer_mdp.php">
            <table>
                <tr>
                    <td> Ancien Mot de passe : </td>
                    <td><input type = "password" name = "oldMdp" /></td>
                    <td>
                        <?php  
                            verif('changeOldMdp');
                            if(isset($_SESSION['mdpFalse'])){             
                                if($_SESSION['mdpFalse'] == true){
                                    echo " Mot de passe Faux";
                                }
                            }
                        ?>
                    </td>
                </tr>
                <tr>
                    <td> Nouveau Mot de passe : </td>
                    <td><input type = "password" name = "newMdp"/></td>
                    <td>    
                        <?php verif('changeNewMdp'); ?>
                    </td>
                </tr>
                <tr>
                    <td>Confirmez nouveau Mot de passe : </td>
                    <td><input type = "password" name = "mdpConfirm"/></td>
                    <td>
                        <?php  
                            verif('changeMdpConfirm'); 
                            if(isset($_SESSION['mdpDiff'])){             
                                if($_SESSION['mdpDiff'] == true){
                                    echo " Les mots de passe sont différents";
                                }
                            } 
                        ?>
                    </td>
                </tr>
                <tr>
                    <td>
                       <input type = "submit" value ="Changer de Mot de passe"/>
                    </td>
                </tr>            
           <table>
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
        Pensez à rentré votre mot de passe pour confirmer les changements.<br>
        <form method = "post" action ="../Controleur/changer_param.php">
            <table>
                <tr>
                    <td>Nom : </td>
                    <td><input type = "text" name = "nom" /></td>
                    <td><?php updateDone('updateNom'); ?></td>
                </tr>
                <tr>
                    <td>Prénom : </td>
                    <td><input type = "text" name = "prenom" /></td>
                    <td><?php updateDone('updatePrenom'); ?></td>
                </tr>
                <tr>
                    <td>Adresse mail : </td>
                    <td><input type = "text" name = "mail" /></td>
                    <td><?php updateDone('updateMail'); ?></td>
                </tr>
                <tr>
                    <td>Age : </td>
                    <td><input type = "text" name = "age" /></td>
                    <td>
                        <?php   
                            if(isset($_SESSION['verifAge'])){             
                                if($_SESSION['verifAge'] == false){
                                    echo " Veuillez choisir un age valide en chiffre";
                                }
                            }
                            updateDone('updateAge');
                       ?>  
                    </td>
                </tr>
                <tr>
                    <td>Login : </td>
                    <td><input type = "text" name = "user" /></td>
                    <td>
                        <?php  
                            if(isset($_SESSION['userEnregistre'])){             
                                if($_SESSION['userEnregistre'] == true){
                                    echo " Ce nom d'utilisateur existe déjà, veuillez en choisir un autre";
                                }
                            }
                            updateDone('updateUser');
                        ?>          
                    </td>
                </tr>
                <tr> 
                    <td>Confirmez les changements en entrant votre mot de passe : </td>
                    <td><input type = "password" name = "mdpConfirm" /></td>
                    <td>
                        <?php 
                            verif('confirmation'); 
                            if(isset($_SESSION['mdpFalse'])){             
                                if($_SESSION['mdpFalse'] == true){
                                    echo " Mot de passe incorrect";
                                }
                            }
                        ?>
                    </td>
                </tr>
                <tr>
                    <td><input type = "submit" value ="Changer ces parametres"></td>
                </tr>
            </table>
        </form>
        <?php 
            if(isset($_SESSION['suppression_impossible'])){             
                if($_SESSION['suppression_impossible'] == true){
                    echo "Impossible de supprimer votre compte car vous êtes administrateur d'un groupe. <br> Donnez vos droits d'administrateur à un autre utilisateur ou supprimer le groupe.";
                }
            }
        ?>
        <a href="../Vue/page_parametre.php?suppr=true" class="button"><span>Supprimer Compte</span></a>
        <?php
            if(isset($_GET['suppr'])){
            ?>
            Etes-vous sûr de vouloir supprimer votre compte ? Cette action est irréversible.
                <table>
                    <tr>
                        <td><a href="../Controleur/suppression_compte.php" class="button"><span>Oui</span></a></td>
                        <td><a href="../Vue/page_parametre.php" class="button"><span>Non</span></a></td>
                </table>
                <?php
            }
        ?>
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
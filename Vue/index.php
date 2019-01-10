<?php
    
    session_start();
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

        <?php  
            if(isset($_SESSION['inscriptionValidee'])){             
                if($_SESSION['inscriptionValidee'] == true){
                    echo "Votre inscription a été effectuée, vous pouvez maintenant vous connecter";
                }
            }
        ?> 

        <section class ="container">
            <div class ="description"> 
                <h2>Qui sommes-nous ?</h2>
                Gift Manager est un site de gestion de liste de cadeau. Il vous permettera de gérer vos liste de cadeaux en regroupant vos amis et votre famille dans differents groupe.<br>
                Ce site à été créer par Pierre Nicholson et Lucas Payet, dans le cadre du projet tuteuré S3 de l'IUT d'Orsay.  
            </div>
            <div class = "connexion">
                <h2>Connexion</h2>
                Connectez-vous pour accéder à GiftManager.<br>
                Pas encore de compte ? Cliquez <a href = "formulaire_inscription.php">ici</a> pour en créer un.
                <form method = "post" action ="../Controleur/connexion.php">
                    Nom d'utilisateur : <input type = "text" name = "user">
                    <?php
                        if(isset($_SESSION['verifUser'])){                    
                             if($_SESSION['verifUser'] == false){
                                echo "Ce nom d'utilisateur n'existe pas.";
                            }
                        }
                    ?>
                    <br>
                    Mot de passe : <input type = "password" name = "mdp">
                    <?php
                        if(isset($_SESSION['verifMdp'])){                    
                             if($_SESSION['verifMdp'] == false){
                                echo "Mot de passe Faux.";
                            }
                        }
                    ?>
                    <br>
                    <input type = "submit" value ="Connexion">
                </form>
            </div>
        </section>
    </body>
    <?php
        if(isset($_GET['deco'])){             
            if($_GET['deco'] == true){
                session_destroy();
            }
        }
    ?>
</html>
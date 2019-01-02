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
        <form method = "post" action ="../Controleur/inscription.php">
            Nom : <input type = "text" name = "nom" /></br>
            Prénom : <input type = "text" name = "prenom" /></br>
            Adresse mail : <input type = "text" name = "mail" /></br>
            Age : <input type = "text" name = "age" /></br>
            Login : <input type = "text" name = "login" /></br>
            Mot de passe : <input type = "text" name = "mdp" /></br>
            Confirmez Mot de passe : <input type = "text" name = "mdpConfirm" /></br>
            <input type = "submit" value ="Inscription">
        </form>
    </body>
</html>

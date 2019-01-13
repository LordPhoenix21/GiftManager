<?php
session_start();
require_once("../Modele/bd.php");
require_once("../Modele/utilisateur.php");
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

        <h1>Vos groupes</h1>
        <?php
        echo '<a href="nouveau_groupe.php?pid='.$user->getID().'" class="button"><span>Nouveau</span></a>';
        ?>
        <table>
            <?php
                if(isset($_GET['gid'])){
                    $gidv = false;
                }
                $user = unserialize($_SESSION['utilisateur']);
                $bd = new bd();
                $bd->connect();
                $sql = 'SELECT G.nom, G.id, AG.administrateur FROM groupe G, acces_groupe AG WHERE G.id = AG.id_groupe AND AG.id_utilisateur = '.$user->getId();
                $result = mysqli_query($bd->co, $sql);
                while($donnees = mysqli_fetch_assoc($result)){
                    echo '<tr><td><a href="page_groupe.php?gid='.$donnees['id'].'" class="button"><span>'.$donnees['nom'].'</span></a></td>';

                        if($donnees['administrateur']){
                            echo '<td><a href="../Controleur/supprimer_groupe.php?gid='.$donnees['id'].'" class="icobutton" ><img style="background-color: red" src="del.png"></a></td>';
                            echo '<td><a href="formulaire_ajout_membre.php?gid='.$donnees['id'].'" class="icobutton" ><img style="background-color: gray" src="inv.png"></a></td>';
                        }

                    echo '</tr>';


                    if(isset($_GET['gid']) && $_GET['gid'] == $donnees['id']){
                        $gidv = true;
                    }
                }
            ?>
        </table>

        <?php
            if(isset($_GET['gid']) && $gidv == false){
                header('Location: page_groupe.php');
            }

            if(isset($_GET['gid'])){

                if(isset($_GET['pid'])){
                    $pidv = false;
                }

                echo '<table class="tmg">';

                $sql = 'SELECT administrateur FROM acces_groupe WHERE id_utilisateur = '.$user->getId().' AND id_groupe = '.$_GET['gid'];
                $result = mysqli_query($bd->co, $sql);
                $donnees = mysqli_fetch_assoc($result);
                $admin = $donnees['administrateur'];

                $sql = 'SELECT U.prenom, U.nom, U.age, U.id FROM utilisateur U, acces_groupe AG WHERE U.id = AG.id_utilisateur AND AG.id_groupe = '.$_GET['gid'];
                $result = mysqli_query($bd->co, $sql);
                while($donnees = mysqli_fetch_assoc($result)){
                    echo '<tr><td>';
                    echo '<a class="button" href="page_groupe.php?gid='.$_GET['gid'].'&pid='.$donnees['id'].'"><span>'.$donnees['prenom']." ".$donnees['nom']." (".$donnees['age'].")</span></a>";

                    $sql2 = 'SELECT administrateur, id_liste FROM acces_groupe WHERE id_utilisateur = '.$donnees['id'].' AND id_groupe = '.$_GET['gid'];
                    $result2 = mysqli_query($bd->co, $sql2);
                    $donnees2 = mysqli_fetch_assoc($result2);

                    if($admin) {

                        if(!$donnees2['administrateur']){
                            echo '</td><td>';
                            echo '<a class="icobutton" href="../Controleur/supprimer_membre_groupe.php?gid='.$_GET['gid'].'&pid='.$donnees['id'].'"><img style="background-color: red" src="del.png"></a>';
                            echo '</td><td>';
                            echo '<a class="icobutton" href="../Controleur/op_membre_groupe.php?gid='.$_GET['gid'].'&pid='.$donnees['id'].'"><img style="background-color: lightgreen   " src="op.png"></a>';
                        }
                    }
                    if($user->getId() == $donnees['id'] && is_null($donnees2['id_liste'])){
                        echo '</td><td>';
                        echo '<a class="icobutton" href="formulaire_selection_liste.php?gid='.$_GET['gid'].'"><img style="background-color: lightgreen   " src="list.png"></a>';
                    }

                    $sql3 = 'SELECT count(*) as nb FROM gestion_inactif GI, acces_groupe AG WHERE AG.id_utilisateur = GI.num_inactif AND AG.id_liste IS NULL AND num_inactif = '.$donnees['id'].' AND num_actif = '.$user->getId();
                    $result3 = mysqli_query($bd->co, $sql3);
                    $donnees3 = mysqli_fetch_assoc($result3);

                    if($donnees3['nb'] == 1){
                        echo '</td><td>';
                        echo '<a class="icobutton" href="formulaire_selection_liste.php?gid='.$_GET['gid'].'&pid='.$donnees['id'].'"><img style="background-color: lightgreen   " src="list.png"></a>';
                    }
                    echo '</td></tr>';

                    if(isset($_GET['pid']) && $_GET['pid'] == $donnees['id']){
                        $pidv = true;
                    }
                }

                if(isset($_GET['pid']) && $pidv == false){
                    header('Location: page_groupe.php');
                }

                echo '</table>';
            }
        ?>

        <?php



            if(isset($_GET['pid'])){

                echo '<table class = "tcp">';

                $sql = 'SELECT C.nom, C.lien, LC.achete, LC.fantome, LC.id_liste, LC.id_cadeau FROM acces_groupe AC, liste_cadeau LC, cadeau C WHERE AC.id_utilisateur = '.$_GET['pid'].' AND AC.id_groupe = '.$_GET['gid'].' AND AC.id_liste = LC.id_liste AND LC.id_cadeau = C.num';
                $result = mysqli_query($bd->co, $sql);
                while($donnees = mysqli_fetch_assoc($result)){

                    if(!($donnees['fantome'] && $_GET['pid'] == $user['id'])){
                        if($donnees['achete']){
                            echo '<tr><td>';
                                echo '<a style="background-color: lawngreen" class="button" href="'.$donnees['lien'].'"><span>'.$donnees['nom']."</span></a>";
                            echo '</td></tr>';
                        }
                        else{
                            echo '<tr><td>';
                                echo '<a class="button" href="'.$donnees['lien'].'"><span>'.$donnees['nom']."</span></a>";
                            echo '</td><td>';
                                echo '<a class="icobutton" href="../Controleur/acheter_cadeau.php?id_liste='.$donnees['id_liste'].'&id_cadeau='.$donnees['id_cadeau'].'&gid='.$_GET['gid'].'&pid='.$_GET['pid'].'"><img style="background-color: lightgreen" src="gift.png"></a>';

                            echo '</td></tr>';
                        }
                    }


                }

                echo '</table>';
            }


        ?>




    </body>

</html>
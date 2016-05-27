<?php 
    include 'fonctions.php';

    $dbconnect = connectDB();

    isset($_COOKIE["session"]) ? $logged = true : $logged = false;

    $file = fopen("nbr_visites.txt", "c+");
    if(!$file)
    {
        header("Location: erreur.php?error=file_access_denied");
        die();
    }

    $visites = fgets($file);
    if(!$visites)
    {
        $visites = 0;
    }
    $visites++;
    rewind($file);
    fwrite($file, $visites);
 ?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" lang="fr" />

        <title>RCP : Research Collaborative Platform</title>
        
        <!-- Compatibilité IE et Chrome -->
        <meta content='IE=edge,chrome=1' http-equiv='X-UA-Compatible'>

        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">

        <!-- Optional theme -->
        <link rel="stylesheet" href="bootstrap/css/bootstrap-theme.min.css">

        <!-- Personnal css -->
        <link rel="stylesheet" href="Styles/bootstrap_mod.css">

        <!-- CSS pour le JQuery button "se connecter" -->
         <link rel="stylesheet" href="Styles/css_connecter_button.css">

        <!-- What is this ? -->
        <link rel="canonical" href="http://www.alessioatzeni.com/wp-content/tutorials/jquery/login-box-modal-dialog-window/index.html" />
        
    </head>

    <body role="document">

        <div class="container-fluid">
            <div class="banner-container">
                <table id="banner-content">
                    <tr>
                        <td><img id="img-banner" src="Images/logo2.png"></td>
                        <td><h1 id="banner-title">Research Collaborative Plateform</h1></td>
                        <td>
                            <div class="connexion">
                                <?php // vérification à faire par cookies non par session !
                                    if($logged)
                                    {
                                        echo "<p>  Bonjour " . $_COOKIE["session"] . "</p>";
                                        echo "<div class=\"post\">
                                                <div class=\"btn-sign\">
                                                   <a href=\"connexion.php?action=deconnexion\" class=\"login-window\">Déconnexion</a>
                                                </div>
                                             </div>";    
                                    }
                                    else
                                    {
                                        echo "<div class=\"post\">
                                                <div class=\"btn-sign\">
                                                   <a href=\"#login-box\" class=\"login-window\">Se Connecter</a>
                                                </div>
                                             </div>";
                                    }
                                ?>
                            </div>
                        </td>
                    </tr>
                </table>
            </div>

            <nav class="navbar navbar-default">
                <div class="container">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <a href="#" class="navbar-brand">RCP</a>
                    </div>
                     
                    <div id="navbar" class="navbar-collapse collapse">
                        <ul class="nav navbar-nav">
                            <li class="active"><a href="index.php">Accueil</a></li>
                            <li><a href="liste_publications.php">Publications</a></li>
                            
                            <li class="dropdown">
                                <a href="laboratoires.php" class="dropdown-toggle" data-toggle="dropdown" 
                                    role="button" aria-haspopup="true" aria-expanded="false">
                                        Laboratoires 
                                        <span class="caret"></span>
                                </a>
                                <ul class="dropdown-menu">
                                    <?php 
                                        $requete = "SELECT nomlabo from Laboratoire;";
                                        
                                        $labos = send_query($dbconnect, $requete);
                                        foreach($labos as $ligne)
                                        {
                                            echo "<li>
                                                    <a href=\"laboratoire.php?nomlaboratoire=".$ligne['nomlabo']."\">" 
                                                    . $ligne['nomlabo'] . "</a>";
                                            echo "</li>";
                                        }
                                     ?>
                                </ul>
                            </li>
                            
                            <li><a href="recherche.php">Recherche</a></li>
                            <?php 
                                if($logged)
                                {
                                    echo "<li class=\"dropdown\">
                                            <!-- menu déroulant -->
                                            <a href=\"#\" class=\"dropdown-toggle\" data-toggle=\"dropdown\" 
                                                role=\"button\" aria-haspopup=\"true\" aria-expanded=\"false\">
                                                    Privé
                                                    <span class=\"caret\"></span>
                                            </a>
                                            <ul class=\"dropdown-menu\">
                                                <li><a href=\"taches.php\">Tâches</a></li>
                                                <li><a href=\"listeMessage.php\">Messages</a></li>
                                                <li><a href=\"listeDoc.php\">Documents</a></li>
                                            </ul>
                                        </li>";                                    
                                }
                             ?>    

                            <li><a href="about.html">About us</a></li>
                        </ul>
                    </div>
                </div>                    
            </nav>

            <div class="main-container container-fluid">
                <form action="resr.php" method="GET">
                    <input type="text" name="rechrapide" placeholder="Recherche">
                    <input type="submit" name="boutonEnvoi" value="Rechercher">
                </form>
                
                <div class="sidebar-container">
                    <table class="personnal-sidebar" height="100%" width="100%" border ="1" cellspacing="1" cellpadding="1"
                     align="left">
                        <caption> <h2>Statistiques</h2> </caption>
                        <tr>
                            <td class="news-title">
                                <div>
                                    <p><b>Nombre de publications</b></p>
                                    <?php 
                                        $query = "SELECT COUNT(idpubli) FROM Publication;";
                                        $result = send_query($dbconnect, $query);
                                        echo "<p>";
                                        echo $result[0]['count'];
                                        echo "</p>";
                                     ?>

                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td class="news-title">
                                <p><b>Nombre de chercheurs</b></p>
                                <?php 
                                    $query = "SELECT COUNT(idch) FROM Chercheur;";
                                    $result = send_query($dbconnect, $query);
                                    echo "<p>";
                                    echo $result[0]['count'];
                                    echo "</p>";
                                 ?>
                            </td>
                        </tr>
                        <tr>
                            <td class="news-title">
                                <p><b>Nombre de laboratoires</b></p>
                                <?php 
                                    $query = "SELECT count(idLabo) FROM Laboratoire;";
                                    $result = send_query($dbconnect, $query);
                                    echo "<p>";
                                    echo $result[0]['count'];
                                    echo "</p>";
                                 ?>
                            </td>
                        </tr>
                        <tr>
                            <td class="news-title">
                                <p><b>Nombre de visites</b></p>
                                <?php 
                                    echo "<p>";
                                    echo $visites;
                                    echo "</p>";
                                 ?>
                            </td>
                        </tr>
                        <tr>
                            <td class="news-title">
                                <p><b>Budget moyen des projet</b></p>
                                <?php 
                                    $query = "SELECT avg(budget) FROM Projet;";
                                    $result = send_query($dbconnect, $query);
                                    echo "<p>";
                                    printf("%d €", $result[0]['avg']);
                                    echo "</p>";
                                 ?>
                            </td>
                        </tr>
                    </table>            
                </div>

                <!-- Contenu de la page -->
                <div class="content-container">
                       
                    <fieldset class="task-container">
                        <legend class="rubrique"> Tâches </legend>

                        <!-- Bouton vers la page d'ajout de tache -->
                        <div class="inline">                       
                            <form action="ajoutTaches.php" method="post">
                            <input class="bouton-ajoutT" type="submit" value="Ajouter une tache"> </form>
                        </div> 

                        <!-- Bouton vers la page de modification de date -->                        
                        <div class="inline">
                            <form action="modifTaches1.php" method="post">
                            <input class="bouton-modifT" type="submit" value="Modifier une tâche"> </form>
                        </div>

                        <!-- Bouton vers la page de suppression de tache -->                        
                        <div class="inline">
                            <form action="retraitTaches.php" method="post">
                            <input class="bouton-supprimerT" type="submit" value="Supprimer une tache"> </form>
                        </div>

                        <?php  
                        /*Récupère les taches de la BDD*/
                        $requete = "SELECT calendrier.datedebut, calendrier.datefin,nomtache,typetache,descriptiontaches FROM tache,calendrier WHERE tache.idcal = calendrier.idcal;";
                                        
                        $resultat = pg_query($dbconnect, $requete);
                        $taches = pg_fetch_all($resultat);
                        $cpt = count($taches);
                        if($taches)
                        {                            
                            for($i =0; $i<$cpt;$i++)
                            {
                                $nom = $taches[$i]['nomtache'];
                                $type = $taches[$i]['typetache'];
                                $description = $taches[$i]['descriptiontaches'];
                                $debut = $taches[$i]['datedebut'];
                                $fin = $taches[$i]['datefin'];

                                echo("<h2>$nom</h2> <br>");
                                echo("<p>Type : $type <br></p>");
                                echo("<p>Début : $debut Fin : $fin <br></p>");
                                echo("<p>Description : <br> $description</p>");
                                
                            }   
                        }
                        else
                        {
                            echo "<br><br><br><p>Aucune tâche</p>";
                        }

                                             
                    echo '</fieldset>';                 
                          
                    ?>                       
                </div>
            </div>


            <div class="mentions">
                <table height="75px" width="100%" border ="1" cellspacing="1" cellpadding="1" >
                    <caption>Mention légales</caption>
                    <tr>
                        <td> Nous contacter : stri@hmtl.com</td>
                    </tr>
                </table>
            </div>
        
        </div>

        <!-- Formulaire Caché pour se connecter-->
        <div id="login-box" class="login-popup">
        <a href="#" class="close"><img src="Images/close_pop.png" class="btn_close" title="Close Window" alt="Close" /></a>
          <form method="post" class="signin" action="connexion.php">
                <fieldset class="textbox">
                <label class="username">
                <span>Identifiant</span>
                <input id="username" name="username" value="" type="text" autocomplete="on" placeholder="identifiant">
                </label>
                
                <label class="password">
                <span>Mot de Passe</span>
                <input id="password" name="password" value="" type="password" placeholder="mot de passe">
                </label>
                
                <button class="submit button" type="submit">Se Connecter</button>
                </fieldset>
          </form>
        </div>

        <!-- INCLUSIONS DES SCRIPTS -->
        <!-- Include de JQuery -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <!-- JQuery Menu Connect -->
        <!-- <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script> -->

        <!-- Personnal script -->     
        <script type="text/javascript" src="Scripts/scripts.js"></script>

        <!-- Latest compiled and minified JavaScript -->
        <script src="bootstrap/js/bootstrap.min.js"></script>

    </body>


</html>
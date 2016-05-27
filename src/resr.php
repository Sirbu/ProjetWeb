<?php 
    include 'fonctions.php';

    $dbconnect = connectDB();

    isset($_COOKIE["session"]) ? $logged = true : $logged = false;
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
                            <li><a href="publications.php">Publications</a></li>
                            
                            <li class="dropdown">
                                <a href="laboratoires.php" class="dropdown-toggle" data-toggle="dropdown" 
                                    role="button" aria-haspopup="true" aria-expanded="false">
                                        Laboratoires 
                                        <span class="caret"></span>
                                </a>
                                <ul class="dropdown-menu">
                                    <?php 
                                        $requete = "SELECT nomlabo from laboratoire;";
                                        
                                        $labos = pg_query($dbconnect, $requete);
                                        while($nomLabo = pg_fetch_row($labos))
                                        {
                                            echo "<li>
                                                    <a href=\"laboratoire.php?nomlaboratoire=$nomLabo[0]\">" . $nomLabo[0] . "</a>";
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
                                                <li><a href=\"#\">Tâches</a></li>
                                                <li><a href=\"#\">Messages</a></li>
                                                <li><a href=\"listeDoc.php\">Documents</a></li>
                                                <li role=\"separator\" class=\"divider\"></li>
                                                <li><a href=\"#\">Gestion</a></li>
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
                <form action="recherche.php">
                    <input type="text" name="search" placeholder="Recherche">
                    <input type="submit" name="boutonEnvoi" value="OK">
                </form>


                <div class="content-container">
                    
                    <!-- Contenu de la page resr.php -->

                    <?php 
                        if(isset($_GET["rechrapide"]) && $_GET["rechrapide"] != ""){
                            $upup = strtoupper($_GET["rechrapide"]);
                            
                            $query = "SELECT Chercheur.nomch, Publication.idpubli, Publication.titre FROM Chercheur, Publication, Publie WHERE publie.idch = chercheur.idch AND publie.idpubli = publication.idpubli AND (upper(nomch) LIKE '%".$upup."%' OR upper(titre) LIKE '%".$upup."%')";
                            $result = pg_query($query);
                            $req = pg_fetch_all($result);

                            if(empty($req[0]['nomch']))
                                $cpt = 0;
                            else
                                $cpt = count($req);
                            
                            echo "<h1> Nombre de Resultats : $cpt </h1>";

                            echo "Chercheur:                Publication: <br>";
                            for($i = 0 ; $i < $cpt ; $i++){
                                $nom=$req[$i]['nomch'];
                                $pub=$req[$i]['titre'];
                                $pub2=$req[$i]['idpubli'];
                                echo "<a href='chercheur.php?nomchercheur=$nom'> $nom </a>"; 
                                echo "<a href='publication.php?idpublication=$pub2'> $pub </a><br>";
                            }

                        }
                        else if(isset($_POST["texterecherche"]) && $_POST["texterecherche"] != ""){
                            $texte = strtoupper($_POST["texterecherche"]);
                            $type = $_POST["typerecherche"];            // recupere l'une des 3 radios choisis
                            $t1 = $_POST["typerechercheplus1"];         // t1,t2,t3,t4 servent a voir si les checkBox sont cochés
                            $t2 = $_POST["typerechercheplus2"];
                            $t3 = $_POST["typerechercheplus3"];
                            $s1 = $_POST["selectionnomlabo"];           // s1,s2,s3,s4 recuperent respectivement le choix dans le menu déroulant de chaque checkBox
                            $s2 = $_POST["selectionnomeq"];
                            $s3 = $_POST["selectionspecialite"];

                            $query_select = "SELECT DISTINCT ";
                            $query_from =" FROM ";
                            $query_where = " WHERE ";
                            $query = $query_select.$type;
                            $query2 = $query_from."Publication, Chercheur, Publie, Equipe, Laboratoire";
                            $query3 = $query_where."upper(".$type.") LIKE '%".$texte."%'";

                            if($type == "nomch"){
                                $query_equipe = " AND Chercheur.idequipe = Equipe.idEquipe";
                                $query_labo = " AND Chercheur.idequipe = Equipe.idequipe AND Laboratoire.idlabo = Equipe.idLabo";
                            }else{
                                $query_equipe =" AND Equipe.idequipe = Chercheur.idch AND Publie.idch = Chercheur.idch AND Publication.idpubli = Publie.idpubli";
                                $query_labo = "AND Equipe.idequipe = Chercheur.idch AND Publie.idch = Chercheur.idch AND Publie.idpubli = Publication.idpubli AND Laboratoire.idlabo = Equipe.idlabo";
                            }

                            if($t1 != ""){
                                $query = "$query,nomlabo";
                                $query3 = "$query3 AND Laboratoire.nomlabo='".$s1."' $query_labo";
                                $query_equipe = "";
                            }
                            
                            if($t2 != ""){
                                $query = "$query,nomeq";
                                $query3 = "$query3 AND Equipe.nomeq='".$s2."' $query_equipe";
                                $query_equipe = "";
                            }
                            
                            
                            if($t3 != ""){
                                $query = "$query,specialite";
                                $query3 = "$query3 AND Equipe.specialite='".$s3."' $query_equipe";
                            }

                            

                            $query_final = $query.$query2.$query3;
                            
                            $resultat = pg_query($query_final);
                            $res = pg_fetch_all($resultat);
                            if ($res[0]['nomch'] == "" && $res[0]['titre'] == "" )
                                $cpt = 0;
                            else
                                $cpt = count($res);

                            if($type == "nomch")
                                echo "<h1> Chercheurs Trouvés: $cpt</h1>";
                            else
                                echo "<h1> Publications Trouvés: $cpt</h1>";

                            for($i=0; $i < $cpt ; $i++){
                                if($type == nomch){
                                    $nom = $res[$i]['nomch'];
                                    echo "<a href=chercheur.php?nomchercheur=$nom> $nom </a> <br>";
                                }
                                else{
                                    $idpub = "SELECT idpubli FROM Publication WHERE titre='".$res[$i][$type]."'";
                                    $resp = pg_query($idpub);
                                    $rp = pg_fetch_row($resp);

                                    $titre = $res[$i]['titre'];
                                    $idp = $rp[0];
                                    echo "<a href=publication.php?idpublication=$idp> $titre </a> <br>";
                                }
                            }
                        }
                        else
                            echo "Erreur lors de la saisie de Recherche !";
                        
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
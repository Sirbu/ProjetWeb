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
                    <div class="personnal-sidebar">
                        <table height="100%" width="100%" border ="1" cellspacing="1" cellpadding="1"
                         align="left">
                            <caption> <h2>News</h2> </caption>
                            <tr>
                                <td class="news-title">
                                    <div>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Id dignissimos odit quaerat, eos ex provident explicabo voluptas, aliquam quia sequi tenetur sint doloribus vel ut, veritatis libero iste, doloremque. Totam.</p>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="news-title">
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dignissimos iste autem quasi nostrum quia et, culpa mollitia blanditiis repellat quis ut beatae, accusantium fugit quod sapiente non doloremque, sed quam!</p>
                                </td>
                            </tr>
                        </table>            
                    </div>

                    <fieldset><legend>
                        <?php
                            $query = "SELECT prenomch FROM Chercheur WHERE nomch='".$_GET["nomchercheur"]."'";
                            $result=pg_query($query);
                            $ch = pg_fetch_row($result);
                            echo "$ch[0] ".$_GET["nomchercheur"];
                            if( $ch[0] == null){
                                echo "<script> window.location.replace('erreur.php?error=Chercheur+non+trouvé') </script>";
                            }
                            
                        ?>
                        </legend>
                        <?php
                            $query="SELECT nomlabo FROM Equipe, Chercheur, Laboratoire WHERE Chercheur.nomch='".$_GET["nomchercheur"]."' AND Chercheur.idequipe=Equipe.idequipe AND Equipe.idlabo=Laboratoire.idlabo";
                            $result=pg_query($query);
                            $nomlabo = pg_fetch_row($result);
                            echo "<p>Laboratoire : <a href="."laboratoire.php?nomlaboratoire=$nomlabo[0]".">$nomlabo[0]</a></p>";

                            $query="SELECT numbureau FROM Chercheur WHERE Chercheur.nomch='".$_GET["nomchercheur"]."'";
                            $result=pg_query($query);
                            $numBur = pg_fetch_row($result);
                            echo "<p>Bureau : $numBur[0]</p>";

                            $query="SELECT sigle FROM Equipe, Chercheur WHERE Chercheur.nomch='".$_GET["nomchercheur"]."' AND Chercheur.idequipe= Equipe.idequipe";
                            $result=pg_query($query);
                            $eq = pg_fetch_row($result);
                            echo "<p>Équipe : <a href='equipe.php?nomequipe=$eq[0]'>$eq[0]</a></p>";

                            $query="SELECT mail FROM Chercheur WHERE nomch='".$_GET["nomchercheur"]."'";
                            $result=pg_query($query);
                            $mail = pg_fetch_row($result);
                            echo "<p>E-Mail : $mail[0]</p>";

                            $query="SELECT numtel FROM Chercheur WHERE nomch='".$_GET["nomchercheur"]."'";
                            $result=pg_query($query);
                            $tel = pg_fetch_row($result);
                            echo "<p>Téléphone : $tel[0]</p>";

                        ?>
                    </fieldset>

                    <fieldset>
                        <legend>Publications</legend>
                        <?php 
                            $query="SELECT titre, datepubli, Publication.idpubli FROM Publication, Chercheur, Publie WHERE Chercheur.nomch ='".$_GET["nomchercheur"]."' AND Publication.idpubli= Publie.idpubli AND Chercheur.idch = Publie.idch";
                            $result=pg_query($query);
                            $pubs = pg_fetch_all($result);
                            $a = count($pubs);
                            for ($i = 0 ; $i < $a ; $i += 1 ){
                                $titrep = $pubs[$i][titre]; 
                                $datep = $pubs[$i][datepubli];
                                $idp = $pubs[$i][idpubli];
                                if($titrep != ""){
                                    echo "-<a href=publication.php?idpublication=$idp>$titrep</a> ($datep)</br>";
                                }
                                else{
                                    echo "Aucune Publication.";
                                }
                            }
                        ?>
                    </fieldset>

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
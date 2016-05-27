<?php 
    include 'fonctions.php';

    session_start();

    $dbconnect = connectDB();
 ?>



<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" lang="fr" />

        <title>RCP : Research Collaborative Platform</title>
        
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">

        <!-- Optional theme -->
        <link rel="stylesheet" href="bootstrap/css/bootstrap-theme.min.css">

        <!-- Personnal css -->
        <link rel="stylesheet" href="Styles/bootstrap_mod.css">

        <script type="text/javascript">
            function connexion()
            {
                alert("Connard!");
            }
        </script>

        <!-- Connexion -->
        <script type="text/javascript"> 
            function test()
            {
                do
                {
                    do
                    {
                        var myID = prompt("ID:","");
                    } 
                    while(myID == "");

                    if (myID != "" && myID != null)
                    {
                        do
                        {
                            var myPass = prompt("MDP:","");
                        }while(myPass == "");

                    }

                }while(myPass == null && myID != null);

                document.write("Vous avez saisi: " + myID + " et " + myPass );
                
            }
        </script> 
    </head>

    <body role="document">

        
        <div class="container-fluid">
            <!-- Bannière -->
            <div class="banner-container">
                <table>
                    <tr>
                        <td><img id="img-banner" src="Images/logo2.png"></td>
                        <td><h1 id="banner-title">Research Collaborative Plateform</h1></td>
                        <td>
                            <button onclick="test()" class="btn btn-lt btn-default connexion">
                                Se connecter
                            </button>
                        </td>
                    </tr>
                </table>
            </div>

            <!-- Barre de menu -->
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
                            <li><a href="laboratoires.php">Laboratoires</a></li>
                            <li><a href="recherche.php">Recherche</a></li>
                            <li class="dropdown">
                                <!-- menu déroulant -->
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> Privé <span class="caret"></span></a>
                                <ul class="dropdown-menu">
                                    <li><a href="#">Tâches</a></li>
                                    <li><a href="#">Messages</a></li>
                                    <li><a href="#">Documents</a></li>
                                    <li role="separator" class="divider"></li>
                                    <li><a href="#">Gestion</a></li>
                                </ul>
                            </li>
                            <li><a href="about.html">About us</a></li>
                        </ul>
                    </div>
                </div>                    
            </nav>

            <div class="main-container">
                <form action="recherche.php">
                    <input type="text" name="search" placeholder="Recherche">
                    <input type="submit" name="boutonEnvoi" value="OK">
                </form>

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

                <!-- Contenu de la page -->
                <div class="content-container">
                    <fieldset class="task-container">
                        <?php 
                            $nomT = (isset($_POST['nomT'])) ? $_POST['nomT'] : '';

                            echo '<legend class="rubrique"> Modification de la tâche "'.$nomT.'" </legend>';                                                   
                                                                    
                       
                        echo'<form method="post" action="modifTaches3.php" >     
                        <p>
                            Veuillez rensigner les champs que vous souhaitez modifier.<br>  

                            <label class="debutT">
                            <span>Date de début</span>
                            <input id="debutT" name="debutT" value="" type="date" placeholder="jj/mm/aaaa">
                            </label>

                            <label class="finT">
                            <span>Date de fin</span>
                            <input id="finT" name="finT" value="" type="date" placeholder="jj/mm/aaaa">
                            </label>
                            <br/>';

                            /*Transmission de l'idcal à modifier*/
                            $idcal = idcalFind($nomT);
                            echo'<input type="hidden" id="idcal" name = "idcal" value="'.$idcal.'"></input>'; 
                            ?>

                            <button class="submit button" type="submit">Modifier la tâche</button>

                            
                        </p>                         
                        </form>

                        

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

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

        <!-- Latest compiled and minified JavaScript -->
        <script src="bootstrap/js/bootstrap.min.js"></script>

    </body>
</html>

<?php 
	function connectDB()
	{
		$dbconnect = pg_connect("host=localhost port=5432 dbname=RCP user=postgres password=stri");

	    if(!$dbconnect)
	    {
	        header('Location: erreur.php?error=bdd_connect');
	    }
	    else
	    {
	    	return $dbconnect;
	    }
	}

	function send_query($query)
	{
		$dbconnect = connectDB();

		$result = pg_query($dbconnect, $query);
		if(!$result)
		{
			header('Location: erreur.php?error=err_send_query');
		}

		$lignes = pg_fetch_all($result);

		pg_close($dbconnect);

		return $lignes;
	}
 

	/* Retourne le dernier élément d'une table incrémenté de 1 */
	function idLastElement($id,$table)
	{
		$requete = "SELECT max($id) FROM $table;";
        $resultat = pg_query(connectDB(), $requete);
        $lignes = pg_fetch_row($resultat);
        
        if (!isset($lignes[0])){
        	$cpt = 1;
        }
        else{
        	$cpt = $lignes[0] + 1;
        }
        return $cpt;
	}

	
	/*Récupère la clé de la date (idcal) associée à la tâche*/
	function idcalFind($nomT)
	{
	    $requete1 = "SELECT idcal FROM tache WHERE nomtache = '".$nomT."';";    
	    $resultat = pg_query(connectDB(), $requete1);    
	    $lignes = pg_fetch_row($resultat);	            
	    $idcal = $lignes[0];
	    return $idcal;
	}


	// les deux fonctions qui suivent permettent d'afficher la base
	// du site, c'est à dire le squelette commun de chaque page.
	// le paramètre $logged indique si la page doit être accédée
	// seulement par des utilisateurs authentifiés
	function base_start($nav_actif = "none", $secure = false)
	{
	    isset($_COOKIE["session"]) ? $logged = true : $logged = false;

	    // ici on vérifie si l'utilisateur a le droit
	    // de voir la page
	    if($secure && !$logged)
	    {
	    	header('Location: erreur.php?error=Forbidden');
	    	die();
	    }

	    $file = fopen("nbr_visites.txt", "c+");
	    if(!$file)
	    {
	        header("Location: erreur.php?error=visit-file_access_denied");
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

		echo "
		<!DOCTYPE html>
		<html>
		    <head>
		        <meta charset=\"utf-8\" lang=\"fr\" />

		        <title>RCP : Research Collaborative Platform</title>
		        
		        <!-- Compatibilité IE et Chrome -->
		        <meta content='IE=edge,chrome=1' http-equiv='X-UA-Compatible'>

		        <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">

		        <!-- Latest compiled and minified CSS -->
		        <link rel=\"stylesheet\" href=\"bootstrap/css/bootstrap.min.css\">

		        <!-- Optional theme -->
		        <link rel=\"stylesheet\" href=\"bootstrap/css/bootstrap-theme.min.css\">

		        <!-- Personnal css -->
		        <link rel=\"stylesheet\" href=\"Styles/bootstrap_mod.css\">

		        <!-- CSS pour le JQuery button \"se connecter\" -->
		         <link rel=\"stylesheet\" href=\"Styles/css_connecter_button.css\">
		       
		    </head>

		    <body role=\"document\">

		        <div class=\"container-fluid\">
		            <div class=\"banner-container\">
		                <table id=\"banner-content\">
		                    <tr>
		                        <td><img id=\"img-banner\" src=\"Images/logo2.png\"></td>
		                        <td><h1 id=\"banner-title\">Research Collaborative Plateform</h1></td>
		                        <td>
		                            <div class=\"connexion\">";
		                                 // vérification à faire par cookies non par session !
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
		                                
		echo "                     </div>
		                        </td>
		                    </tr>
		                </table>
		            </div>

		            <nav class=\"navbar navbar-default\">
		                <div class=\"container\">
		                    <div class=\"navbar-header\">
		                        <button type=\"button\" class=\"navbar-toggle collapsed\" data-toggle=\"collapse\" data-target=\"#navbar\" aria-expanded=\"false\" aria-controls=\"navbar\">
		                            <span class=\"sr-only\">Toggle navigation</span>
		                            <span class=\"icon-bar\"></span>
		                            <span class=\"icon-bar\"></span>
		                            <span class=\"icon-bar\"></span>
		                        </button>
		                        <a href=\"#\" class=\"navbar-brand\">RCP</a>
		                    </div>
		                     
		                    <div id=\"navbar\" class=\"navbar-collapse collapse\">
		                        <ul class=\"nav navbar-nav\">";
		                        // ici on règle le problème du bouton actif
		                        if($nav_actif == "index")
		                        {
		                        	echo "<li class=\"active\"><a href=\"index.php\">Accueil</a></li>";
		                        }
		                        else
		                        {
		                        	echo "<li><a href=\"index.php\">Accueil</a></li>";
		                        }
		                        if($nav_actif == "publications")
		                        {
		                        	echo "<li class=\"active\"><a href=\"liste_publications.php\">Publications</a></li>";

		                        }
		                        else
		                        {
		                        	echo "<li><a href=\"liste_publications.php\">Publications</a></li>";

		                        }
		                            
		echo "                      <li class=\"dropdown\">
		                                <a href=\"#\" class=\"dropdown-toggle\" data-toggle=\"dropdown\" 
		                                    role=\"button\" aria-haspopup=\"true\" aria-expanded=\"false\">
		                                        Laboratoires 
		                                        <span class=\"caret\"></span>
		                                </a>
		                                <ul class=\"dropdown-menu\">";
		                                    
		                                        $requete = "SELECT nomlabo from Laboratoire;";
		                                        
		                                        $labos = send_query($requete);
		                                        foreach($labos as $ligne)
		                                        {
		                                            echo "<li>
		                                                    <a href=\"laboratoire.php?nomlaboratoire=".$ligne['nomlabo']."\">" 
		                                                    . $ligne['nomlabo'] . "</a>";
		                                            echo "</li>";
		                                        }
		                                     
		echo "                          </ul>
		                            </li>";
		                            
		                            if($nav_actif == "recherche")
		                            {
		                            	echo "<li class=\"active\"><a href=\"rech3.php\">Recherche</a></li>";
		                            }
		                            else
		                            {
		                            	echo "<li><a href=\"rech3.php\">Recherche</a></li>";
		                            }
		                            	
		                             
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
		                                
		                            if($nav_actif == "about")
		                            {
		                            	echo "<li class=\"active\"><a href=\"about.php\">About us</a></li>";
		                            }
		                            else
		                            {
		                            	echo "<li><a href=\"about.php\">About us</a></li>";
		                            }
			                        
		echo "                  </ul>
		                    </div>
		                </div>                    
		            </nav>

		            <div class=\"main-container container-fluid\">
		                <form action=\"resr.php\" method=\"GET\">
		                    <input type=\"text\" name=\"rechrapide\" placeholder=\"Chercheurs/Publications\">
		                    <input type=\"submit\" name=\"boutonEnvoi\" value=\"Rechercher\">
		                </form>
		                
		                <div class=\"sidebar-container\">
		                    <table class=\"personnal-sidebar\" height=\"100%\" width=\"100%\" border =\"1\" cellspacing=\"1\" cellpadding=\"1\"
		                     align=\"left\">
		                        <caption> <h2>Stats</h2> </caption>
		                        <tr>
		                            <td class=\"news-title\">
		                                <div>
		                                    <p><b>Nombre de publications</b></p>";
		                                    
		                                        $query = "SELECT COUNT(idpubli) FROM Publication;";
		                                        $result = send_query($query);
		                                        echo "<p>";
		                                        echo $result[0]['count'];
		                                        echo "</p>";
		echo "                          </div>
		                            </td>
		                        </tr>
		                        <tr>
		                            <td class=\"news-title\">
		                                <p><b>Nombre de chercheurs</b></p>";
		                                
		                                    $query = "SELECT COUNT(idch) FROM Chercheur;";
		                                    $result = send_query($query);
		                                    echo "<p>";
		                                    echo $result[0]['count'];
		                                    echo "</p>";
		                                
		echo "                      </td>
		                        </tr>
		                        <tr>
		                            <td class=\"news-title\">
		                                <p><b>Nombre de laboratoires</b></p>";
		                                
		                                    $query = "SELECT count(idLabo) FROM Laboratoire;";
		                                    $result = send_query($query);
		                                    echo "<p>";
		                                    echo $result[0]['count'];
		                                    echo "</p>";
		                                
		echo "                            </td>
		                        </tr>
		                        <tr>
		                            <td class=\"news-title\">
		                                <p><b>Nombre de visites</b></p>";
		                                 
		                                    echo "<p>";
		                                    echo $visites;
		                                    echo "</p>";
		                                 
		echo "                      </td>
		                        </tr>
		                        <tr>
		                            <td class=\"news-title\">
		                                <p><b>Budget moyen des projet</b></p>";
		                                 
		                                    $query = "SELECT avg(budget) FROM Projet;";
		                                    $result = send_query($query);
		                                    echo "<p>";
		                                    printf("%d €", $result[0]['avg']);
		                                    echo "</p>";
		                                
		echo "                      </td>
		                        </tr>
		                    </table>            
		                </div>";

	}

	function base_end()
	{
		echo "
		            </div>


		            <div class=\"mentions\">
		                <table rules=\"none\" height=\"75px\" width=\"100%\" border =\"1\" cellspacing=\"1\" cellpadding=\"1\" >
		                    <caption>Mention légales</caption>
		                    <tr>
		                        <td> Nous contacter : stri@hmtl.com</td>
		                        <td>
			                        <img class=\"img-responsive partners\" src=\"Images/Partenaires/upssitech.png\">
			                        <img class=\"img-responsive partners\" src=\"Images/Partenaires/stri.jpg\"/>
			                        <img class=\"img-responsive partners\" src=\"Images/Partenaires/ups.jpg\"/>
		                        </td>
		                    </tr>

		                </table>
		            </div>
		        
		        </div>

		        <!-- Formulaire Caché pour se connecter-->
		        <div id=\"login-box\" class=\"login-popup\">
		        <a href=\"#\" class=\"close\"><img src=\"Images/close_pop.png\" class=\"btn_close\" title=\"Close Window\" alt=\"Close\" /></a>
		          <form method=\"post\" class=\"signin\" action=\"connexion.php\">
		                <fieldset class=\"textbox\">
		                <label class=\"username\">
		                <span>Identifiant</span>
		                <input id=\"username\" name=\"username\" value=\"\" type=\"text\" autocomplete=\"on\" placeholder=\"identifiant\">
		                </label>
		                
		                <label class=\"password\">
		                <span>Mot de Passe</span>
		                <input id=\"password\" name=\"password\" value=\"\" type=\"password\" placeholder=\"mot de passe\">
		                </label>
		                
		                <button class=\"submit button\" type=\"submit\">Se Connecter</button>
		                </fieldset>
		          </form>
		        </div>

		        <!-- INCLUSIONS DES SCRIPTS -->
		        <!-- Include de JQuery -->
		        <script src=\"https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js\"></script>
		        <!-- JQuery Menu Connect -->
		        <!-- <script type=\"text/javascript\" src=\"http://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js\"></script> -->

		        <!-- Personnal script -->     
		        <script type=\"text/javascript\" src=\"Scripts/scripts.js\"></script>

		        <!-- Latest compiled and minified JavaScript -->
		        <script src=\"bootstrap/js/bootstrap.min.js\"></script>

		    </body>


		</html>

		";
	}

?>

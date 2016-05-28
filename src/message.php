<?php 
    include 'fonctions.php';

    base_start("none", true);
?>

                <!-- Contenu de la page -->
                <div class="content-container">
                    <fieldset class="task-container">
                        <?php 
                        // on récupère le login associé au nom stocké dans le cookie
                        $nomch = $_COOKIE["session"];

                        $requete_login = "SELECT loginch FROM chercheur WHERE nomch = '" . $nomch . "';";
                        $login = send_query($requete_login);

                        /*Récupère le message de la BDD*/
                        $requete2 = "SELECT chercheur.nomch,objet,dateenvoi,contenumess FROM message,chercheur "
                        ."WHERE chercheur.loginch='" . $login[0]['loginch'] ."' "
                        ."AND message.iddiscussion = '" . $_GET["idmess"] . "';";

                        
                        $colonne = send_query($requete2);
                        if(!$colonne)
                        {
                            echo "<p>Aucun messages</p>";                       
                        }
                        else
                        {
                            $objet= $colonne[0]['objet'];
                            $date = $colonne[0]['dateenvoi'];
                            $expediteur = $colonne[0]['nomch'];
                            $contenu = $colonne[0]['contenumess'];


                            /*Affichage*/
                            echo('<legend class="rubrique"> Objet : ' . $objet .'</legend>');
                            
                            echo("Expediteur : $expediteur<BR>");
                            echo("Date : $date<BR>");
                            echo("Contenu :<BR>$contenu");                         
                        }
                                               
                        
                        ?>
                        
                    
                    </fieldset>                     
                </div>
<?php 
    base_end();
 ?>
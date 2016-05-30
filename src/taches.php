<?php 
    include("fonctions.php");

    base_start("none", true);
 ?>
                <!-- Contenu de la page -->
                <div class="content-container">
                       
                    <fieldset class="task-container">
                        <legend class="rubrique"> Tâches </legend>
                        <?php 
                            // les boutons ne doivent s'afficher que
                            // si l'utilisateur est un coordinateur
                            $query = "SELECT statut FROM Participe, Chercheur "
                                    ."WHERE nomch = '" . $_COOKIE['session'] . "' "
                                    ."AND Chercheur.idch = Participe.idch "
                                    ."AND Participe.idprojet = '1';";    // ce test doit être changé pour du multi projet
                            $result = send_query($query);
                            if($result && $result[0]['statut'] == "Coordinateur")
                            {
                                echo "
                                <!-- Bouton vers la page d'ajout de tache -->
                                <div class=\"inline\">                       
                                    <form action=\"ajoutTaches.php\" method=\"post\">
                                    <input class=\"bouton-ajoutT\" type=\"submit\" value=\"Ajouter\"> </form>
                                </div> 

                                <!-- Bouton vers la page de modification de date -->                        
                                <div class=\"inline\">
                                    <form action=\"modifTaches1.php\" method=\"post\">
                                    <input class=\"bouton-modifT\" type=\"submit\" value=\"Modifier\"> </form>
                                </div>

                                <div class=\"inline\">
                                    <form action=\"assiTache.php\">
                                       <input type=\"submit\" value=\"Assigner\"> 
                                    </form>
                                </div>

                                <!-- Bouton vers la page de suppression de tache -->                        
                                <div class=\"inline\">
                                    <form action=\"retraitTaches.php\" method=\"post\">
                                    <input class=\"bouton-supprimerT\" type=\"submit\" value=\"Supprimer\"> </form>
                                </div>
                                ";
                            }

                         ?>

                        <?php  
                        /*Récupère les taches de la BDD*/
                        $requete = "SELECT tache.idtache, calendrier.datedebut, calendrier.datefin,nomtache,typetache,descriptiontaches FROM tache,calendrier WHERE tache.idcal = calendrier.idcal;";
                                        
                        $taches = send_query($requete);

                        $cpt = count($taches);
                        if($taches)
                        {                            
                            foreach ($taches as $ligne)
                            {
                                $nom = $ligne['nomtache'];
                                $type = $ligne['typetache'];
                                $description = $ligne['descriptiontaches'];
                                $debut = $ligne['datedebut'];
                                $fin = $ligne['datefin'];

                                echo("<h2>$nom</h2> <br>");
                                echo("<p>Type : $type <br></p>");
                                echo("<p>Début : $debut Fin : $fin <br></p>");
                                echo("<p>Description : <br> $description</p>");

                                $requ_assi = "SELECT nomch FROM effectue, Chercheur, tache "
                                            ."WHERE effectue.idch = chercheur.idch "
                                            ."AND effectue.idtache = " . $ligne['idtache'] . ";";
                                $result = send_query($requ_assi);
                                if(!$result)
                                {
                                    echo "<p>Aucun chercheur assigné</p>";
                                }
                                else
                                {
                                    echo "<p>Chercheurs assignés :<br></p>";
                                    foreach ($result as $chercheur)
                                    {
                                        echo "<a href=\"chercheur.php?nomchercheur=" . $chercheur['nomch'] . "\">" 
                                                . $chercheur['nomch'] . "</a><br></p>";
                                    }
                                }
                                
                            }   
                        }
                        else
                        {
                            echo "<br><br><br><p>Aucune tâche</p>";
                        }

                                             
                    echo '</fieldset>';                 
                          
                    ?>                       
                </div>
<?php 
    base_end();
 ?>
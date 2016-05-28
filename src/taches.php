<?php 
    include("fonctions.php");

    base_start("none", true);
 ?>
                <!-- Contenu de la page -->
                <div class="content-container">
                       
                    <fieldset class="task-container">
                        <legend class="rubrique"> Tâches </legend>

                        <!-- Bouton vers la page d'ajout de tache -->
                        <div class="inline">                       
                            <form action="ajoutTaches.php" method="post">
                            <input class="bouton-ajoutT" type="submit" value="Ajouter une tâche"> </form>
                        </div> 

                        <!-- Bouton vers la page de modification de date -->                        
                        <div class="inline">
                            <form action="modifTaches1.php" method="post">
                            <input class="bouton-modifT" type="submit" value="Modifier une tâche"> </form>
                        </div>

                        <!-- Bouton vers la page de suppression de tache -->                        
                        <div class="inline">
                            <form action="retraitTaches.php" method="post">
                            <input class="bouton-supprimerT" type="submit" value="Supprimer une tâche"> </form>
                        </div>

                        <?php  
                        /*Récupère les taches de la BDD*/
                        $requete = "SELECT calendrier.datedebut, calendrier.datefin,nomtache,typetache,descriptiontaches FROM tache,calendrier WHERE tache.idcal = calendrier.idcal;";
                                        
                        $taches = send_query($requete);

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
<?php 
    base_end();
 ?>
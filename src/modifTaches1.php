<?php 
    include("fonctions.php");

    base_start("none", true);
 ?>
                <!-- Contenu de la page -->
                <div class="content-container">
                    <fieldset class="task-container"> 
                        <legend class="rubrique"> Modifier une tâche </legend>

                        <?php 
                            $query = "SELECT nomtache FROM tache;";
                            $result = send_query($query);
                            if(!$result)
                            {
                                echo "<p>Il n'y a aucune tâche enregistrée !</p>";
                            }
                            else
                            {
                                echo "
                                    <!-- FORMULAIRE -->
                                    <form method=\"post\" action=\"modifTaches2.php\">
                                        <p>
                                            <label class=\"nomT\">
                                            <span>Nom de la tâche à modifier</span>
                                            <select name=\"nomT\">
                                    ";

                                foreach ($result as $tache) {
                                    
                                            echo "<option value=\"" . $tache['nomtache'] . "\">". $tache['nomtache'] . "</option>";
                                            // <input id=\"nomT\" name=\"nomT\" value=\"\" type=\"text\" placeholder=\"tache\">
                                }
                                    
                                echo "      </select>
                                            </label>
                                        </p>                            
                                        <p>
                                            <button class=\"submit button\" type=\"submit\">Modifier la tâche</button>   
                                        </p>                   
                                    </form>
                                    ";
                            }
                         ?>                        
                    </fieldset>                           
                </div>
<?php 
    base_end();
 ?>
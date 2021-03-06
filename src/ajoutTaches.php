<?php 
    include("fonctions.php");

    base_start("none", true);
 ?>

                <!-- Contenu de la page -->
                <div class="content-container">
                    <fieldset class="task-container"> 
                        <legend class="rubrique"> Ajouter une tâche </legend>

                                              
                        <!-- FORMULAIRE -->
                        <form method="post" action="creerTaches.php" >
                        <p>
                            <label class="nomT">
                            <span>Nom de la tâche</span>
                            <input id="nomT" name="nomT" value="" type="text" placeholder="tache">
                            </label>

                            <span>Type :</span>
                            <select name="typeT">
                                <option value="Avancement">Avancement</option>
                                <option value="Documentation">Documentation</option>
                                <option value="Expérience">Expérience</option>
                                <option value="Jalon">Jalon</option>
                                <option value="Réunion">Réunion</option>                                
                                <option value="Tests">Tests</option>
                            </select>

                                                        
                            <br/>

                            <label class="debutT">
                            <span>Date de début</span>
                            <input id="debutT" name="debutT" value="" type="date" placeholder="jj/mm/aaaa">
                            </label>

                            <label class="finT">
                            <span>Date de fin</span>
                            <input id="finT" name="finT" value="" type="date" placeholder="jj/mm/aaaa">
                            </label>
                            
                            <!-- Champ de description -->
                            <label class="descriptionT">
                            <textarea id="descriptionT" name="descriptionT" cols='50' rows='5' placeholder="description"></textarea>
                            </label>

                            <!-- Bouton de validation -->
                            <button class="submit button" type="submit">Créer la tâche</button> 

                        </p>                         
                        </form>
                    </fieldset>                                        
                </div>
 
<?php 
    base_end();
?>
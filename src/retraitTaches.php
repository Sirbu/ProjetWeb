<?php 
    include 'fonctions.php';

    base_start("none", true);
?>
                <!-- Contenu de la page -->
                <div class="content-container">
                    <fieldset class="task-container"> 
                        <legend class="rubrique"> Supprimer une tâche </legend>

                                              
                        <!-- FORMULAIRE -->
                        <form method="post" action="supprimerTaches.php">
                        <p>
                            <label class="nomT">
                            <span>Nom de la tâche à supprimer</span>
                            <input id="nomT" name="nomT" type="text" placeholder="tache">
                            </label>
                        </p>                            
                        <p>
                            <button class="submit button" type="submit">Supprimer la tâche</button>   
                        </p>        
                        </form>
                                             
                    </fieldset>
                                          
                </div>
<?php 
    base_end();
 ?>
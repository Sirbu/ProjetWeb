<?php 
    include("fonctions.php");

    base_start("none", true);
 ?>
                <!-- Contenu de la page -->
                <div class="content-container">
                    <fieldset class="task-container"> 
                        <legend class="rubrique"> Modifier une tâche </legend>

                                              
                        <!-- FORMULAIRE -->
                        <form method="post" action="modifTaches2.php">
                        <p>
                            <label class="nomT">
                            <span>Nom de la tâche à modifier</span>
                            <input id="nomT" name="nomT" value="" type="text" placeholder="tache">
                            </label>
                        </p>                            
                        <p>
                            <button class="submit button" type="submit">Modifier la tâche</button>   
                        </p>    
                                               
                        </form>

                        
                       
                                             
                    </fieldset>                           
                </div>
<?php 
    base_end();
 ?>
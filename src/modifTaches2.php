<?php 
    include 'fonctions.php';

    base_start("none", true);
?>
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

<?php 
    base_end();
 ?>
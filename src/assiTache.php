<?php 
    include 'fonctions.php';

    base_start("none", true);
?>
            <div class="content-container">
				<caption> <h2>  Assignation de Tâches : </h2> </caption>
                <?php
                    echo "<form method=\"post\" action=\"assiTache2.php\">                            
                            <div>";
								//affichage de liste des taches 
								$query = "SELECT nomtache FROM Tache";
								$res = send_query($query);
                                if(!$res)
                                {
                                    echo "<p>Aucune tâche enregistrée</p>";

                                }
                                else
                                {
									$a = count($res);
                                    echo "<p>Choix de la Tâche</p>";
									echo "<select name=\"selection2\">";
									for($i = 0 ; $i < $a ; $i++){
										$b = $res[$i]['nomtache'];
										echo "<option value='$b'>$b</option>";
									}
									echo "</select>";
                                    
                                    echo   "</div>
                                            <div>
                                                <p>Chercheurs à ajouter : </p>";
                                                    
                                                
                                                //affichage de liste des chercheurs 
                                                $query = "SELECT nomch FROM chercheur";
                                                $res = send_query($query);                                                

                                                $a = count($res);
                                                echo "<select name=\"selection\">";
                                                for($i = 0 ; $i < $a ; $i++){
                                                    $b = $res[$i][nomch];
                                                    echo "<option value='$b'>$b</option>";
                                                }
                                                echo "</select>";
                                                
                                                                    
                                    echo "      <input type=\"submit\" name=\"submit\" value=\"Ajouter\"/>    
                                            </div>";
                                }                     
                ?>

    					</form>							
				</div>

<?php 
    base_end();
?>
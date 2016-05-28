<?php 
    include 'fonctions.php';

    base_start("none", true);

?>
                <!-- Contenu de la page -->
                <div class="content-container">
                    <fieldset class="task-container"> 
                        <legend class="rubrique"> Envoyer un message</legend>

                                              
                        <!-- FORMULAIRE -->
                        <form method="post" action="envoyerMessage2.php">
                        <p>
                            
                            <?php
                                $requete1 = "SELECT idprojet, nomprojet FROM projet;";    
                                $projet = send_query($requete1);
                                if(!$projet)
                                {
                                    echo "<p>Aucun projet n'est présent dans la base de données !</p>";
                                    die();
                                }
                                else
                                {
                                    echo "
                                        <span>Projet concerné :</span>
                                        <select name=\"idprojet\">";
                                        
                                        /*Affichage de chaque projet*/
                                        $cpt = count($projet);
                                        for($i =0; $i<$cpt;$i++)
                                        {
                                            $idprojet= $projet[$i]['idprojet']; 
                                            $nomprojet= $projet[$i]['nomprojet'];   

                                            echo "<option value=".$idprojet.">".$idprojet." ".$nomprojet."</option>";
                                        }
                                }


                            ?>
                                
                            }
                                
                            </select>

                            
                            <span>Objet</span>
                            <input id="objetM" name="objetM" value="" type="text" placeholder="objet">

                            <button class="submit button" type="submit">Envoyer</button>                             
                            <br/>
                            
                            <textarea id="contenuM" name="contenuM" cols='50' rows='5' placeholder="contenu"></textarea>

                        </p>                         
                        </form>

                    </fieldset>     
                </div>
<?php 
    base_end();
 ?>
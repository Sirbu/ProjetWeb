<?php 
    include("fonctions.php");

    base_start("none", true);
 ?>                     
                <div class="content-container">
                    <caption> <h2>Documents</h2> </caption>
                    <a class=\"depot\" href="saisie_depot.php?type=Document">Déposer un document</a>
                    <fieldset>  
                    <?php 

                        $query= "SELECT document.idDoc, typeDoc, titreDoc,nomch FROM Document,Depose,Chercheur "
                                ."WHERE document.idDoc = depose.idDoc "
                                ."AND chercheur.idch= depose.idch "
                                ."AND chercheur.nomch='".$_COOKIE["session"]."'";

                        $docs = send_query($query);

                        if(!$docs)
                        {
                            echo "<p>Aucun document</p>";
                        }
                        else
                        {
                            $a = count($docs);
                                    
                            for ($i = 0 ; $i < $a ; $i++){ 
                                $idd = $docs[$i]['iddoc'];
                                $titred = $docs[$i]['titredoc'];
                                $nomcher = $docs[$i]['nomch'];
                                $type = $docs[$i]['typedoc'];
  
                                echo "<legend> - <a href=\"document.php?iddoc=$idd\">$titred</a> </legend>";
                                echo "<p> Auteur : $nomcher </p>";
                                echo "<p> Type : $type </p>";

                            }
                            
                        }
                     ?>
                    </fieldset>
                </div>
<?php 
    base_end();
?>

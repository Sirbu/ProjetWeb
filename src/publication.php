<?php 
    include("fonctions.php");

    base_start("publications");
?>
                    <!-- CONTENU -->
                    <div class="content-container">
                        <fieldset><legend>
                            <?php
                                $query = "SELECT titre, datePubli, urlpub FROM Publication WHERE idPubli='" 
                                    .$_GET["idpublication"]."'";                           
                                
                                $pub = send_query($query);

                                if( $pub[0]['titre'] == null){
                                    echo "<script> window.location.replace('erreur.php?error=Publication+non+trouvée') </script>";
                                }
                                echo $pub[0]['titre'] . " publiée le ". $pub[0]['datepubli'];
                                
                            
                                echo "</legend>";

                                $query = "SELECT nomch, prenomch FROM Publie, Chercheur, Publication "
                                        ."WHERE Publie.idch = Chercheur.idch "
                                        ."AND Publie.idpubli ='" . $_GET["idpublication"] . "';";
                                
                                $auteur = send_query($query);

                                echo "<p>Auteur/s : "
                                        ."<a href=\"" . "chercheur.php?nomchercheur=" . $auteur[0]['nomch'] . "\">"
                                        . $auteur[0]['prenomch'] . " " . $auteur[0]['nomch']."</a>"
                                    ."</p>";

                                if(file_exists($pub[0]['urlpub']))
                                {
                                    echo "<object class=\"pdf\" data=\"". $pub[0]['urlpub'] 
                                        . "\" >Balise non supportée</object>";
                                }
                                else
                                {
                                    echo "<p>Le fichier est inaccessible !</p>";
                                }

                            ?>
                        </fieldset>            
                    </div>
<?php 
    base_end();
?>
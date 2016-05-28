<?php 
    include("fonctions.php");

    base_start();
 ?>                
                <!-- Le contenu commence ici ! -->
                <div class="content-container">
                    <caption><h2>Liste des publications</h2></caption>
                    <fieldset>
                        <?php 
                            $query = "SELECT * FROM Publication";
                            $list_publi = send_query($query);
                            if(!$list_publi)
                            {
                                echo "<legend>Aucune publication !</legend>";
                            }
                            else
                            {
                                foreach($list_publi as $ligne)
                                {
                                    // on cherche le nom de l'auteur aussi !
                                    $requete_auteur = "
                                    SELECT nomch FROM Chercheur, Publie, Publication"
                                     . " WHERE Publication.idpubli = ". $ligne['idpubli']
                                     . " AND Publication.idpubli = Publie.idpubli"
                                     . " AND Publie.idch = Chercheur.idch;";

                                    // pas besoin de vérifier $auteur car tout
                                    // est fait dans send_query, et si on arrive
                                    // ici c'est qu'il y a forcément des lignes
                                    $auteur = send_query($requete_auteur);

                                    echo "<legend>" . $ligne['titre'] . "</legend>";
                                    echo "<p>Publiée le : " . $ligne['datepubli'] 
                                            . " par <a href=\"chercheur.php?nomchercheur=" . $auteur[0]['nomch'] . "\">"
                                            . $auteur[0]['nomch'] . "</a></p>";

                                    echo "<p>Lien : <a href=publication.php?idpublication=" . $ligne['idpubli'] . ">"
                                        . $ligne['titre'] . "</a></p>";
                                }

                            }
                        ?>
                    </fieldset>
                </div>

<?php 
    base_end();
 ?>
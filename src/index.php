<?php 
    include 'fonctions.php';

    base_start("index");
 ?>
                <!-- Le contenu commence ici ! -->
                <div class="content-container">
                    <div class="desc-projet">
                        <caption>
                            <h2>
                            <?php
                                // À METTRE DANS FONCTIONS.PHP !
                                $query = "SELECT * FROM Projet;";
                                $desc = send_query($query);

                                echo $desc[0]['nomprojet'] . "</h2>";
                                                                           
                                echo "<p>" . $desc[0]['descriptionprojet'] . "</p>";
                            ?> 
                        </caption>
                    </div>

                    
                    <div class="last-publi">
                        <caption>
                            <h2>Dernières publications :</h2>
                        </caption>
                        <br>
                        <div id="myCarousel" class="carousel slide" data-ride="carousel">
                              <ol class="carousel-indicators">    
                        <?php 
                            // ici on prépare l'affichage du carousel
                            // c'est un beau bordel d'ailleurs parce qu'un
                            // carousel ça prend un paquet de lignes et faire
                            // tout ça avec des echo ça fait mal aux yeux...
                            $query = "SELECT P.idpubli, titre, nomch FROM Publication as P, Publie as Pb, Chercheur as C"
                                    ." WHERE P.idpubli = Pb.idpubli"
                                    ." AND Pb.idch = C.idch"
                                    ." ORDER BY datePubli;";

                            $info_publi = send_query($query);

                            // nombre de publications à afficher
                            // dans le carousel
                            $nbr_publi = 3;

                            // on ne doit pas faire plus de slides que de publications
                            // disponibles. Même si au départ on veut en afficher 3, il 
                            // se peut qu'il n'y en aie que 2 dans la base de donnée.
                            for($i = 0; $i < min($nbr_publi, count($info_publi)); $i++)
                            {
                                echo "\t\t\t\t\t<li data-target=\"#myCarousel\" data-slide-to=\"$i\" ";
                                if($i == 0)
                                {
                                    echo "class=\"active\"";
                                }
                                echo "></li>\n\t\t\t\t\t";
                            }

                            echo "</ol>
                                  <div class=\"carousel-inner\">
                                  ";

                            for($i = 0; $i < min($nbr_publi, count($info_publi)); $i++)
                            {
                                echo "\n<div class=\"item ";
                                if($i == 0)
                                {
                                    echo "active";
                                }
                                echo "\">";
                                    
                                echo  "<img class=\"img-responsive center-block\" src=\"Images/blue-paper-texture.jpg\""
                                            . " alt=\"Slide $i\" />
                                        <div class=\"carousel-caption\">";

                                echo "          <a href=\"publication.php?idpublication=".$info_publi[$i]['idpubli']."\">
                                                    <h1>" . $info_publi[$i]['titre'] . "</h1>
                                                </a>";
                                echo "          <a href=\"chercheur.php?nomchercheur=".$info_publi[$i]['nomch']."\">
                                                    <p>" . $info_publi[$i]['nomch'] . "</p>
                                                </a>";

                                echo"        </div>
                                        </div>";
                                
                            }
                         ?>
                              <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
                                <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                                <span class="sr-only">Previous</span>
                              </a>
                              <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
                                <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                                <span class="sr-only">Next</span>
                              </a>
                            </div>                        
                        </div>
                    </div>
                </div>
<?php 
    base_end();
 ?>
<?php 
    include("fonctions.php");

    base_start("none", true);
 ?>
                <div class="content-container">
                    <caption>
                        <h2>Messages</h2>
                    </caption>

                    <!-- Bouton vers la page d'ajout de tache -->                      
                    <form action="envoyerMessage.php" method="post">
                        <input class="bouton-envoyerM" type="submit" value="Envoyer un message"> 
                    </form>  
                    <div>
                        <fieldset>  

                                <?php 
                                    $login = $_COOKIE["session"];

                                    $query1="SELECT projet.idprojet FROM projet, participe, chercheur WHERE loginch='".$login."' AND chercheur.idch = participe.idch AND participe.idprojet= projet.idprojet";
                                    $r = send_query($query1);

                                    $query= " SELECT DISTINCT Chercheur.nomch, idDiscussion, dateEnvoi, objet  FROM Message,Chercheur,participe,projet WHERE chercheur.idch = message.idch AND  chercheur.idch = participe.idch AND projet.idprojet=participe.idprojet AND participe.idprojet='".$r[0]."' ";
                                    $mess = send_query($query);

                                    if(!$mess)
                                    {
                                        echo "Aucun messages. <br>";
                                    }
                                    else
                                    {
                                        $a = count($mess);
       
                                        for ($i = 0 ; $i < $a ; $i++){ 
                                            $idmess = $mess[$i]['iddiscussion'];
                                            $obj = $mess[$i]['objet'];
                                            $nomcher = $mess[$i]['nomch'];
                                            $date = $mess[$i]['dateenvoi'];
                                                
                                            echo "<legend> - <a href=message.php?idmess=$idmess>$obj</a> </legend>";
                                            echo "<p> Expéditeur : $nomcher </p>";
                                            echo "<p> Date de réception : $date </p>";
                                                
                                        }

                                    }
                                 ?>
                        </fieldset>
                    </div>
                </div>
<?php 
    base_end();
 ?>
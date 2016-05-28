<?php 
    include("fonctions.php");

    base_start();
?>

                <div class="content-container">
                  <fieldset><legend>
                        <?php
                            $query = "SELECT prenomch FROM Chercheur WHERE nomch='".$_GET["nomchercheur"]."'";
                            $ch = send_query($query);
                            if(!$ch){
                                echo "<script> window.location.replace('erreur.php?error=Chercheur+non+trouvé') </script>";
                            }
                            echo $ch[0]['prenomch'] . " " . $_GET['nomchercheur'];
                            
                        ?>
                        </legend>
                        <?php
                            $query = "SELECT nomlabo FROM Equipe, Chercheur, Laboratoire WHERE Chercheur.nomch='"
                                .$_GET["nomchercheur"]
                                ."' AND Chercheur.idequipe=Equipe.idequipe AND Equipe.idlabo=Laboratoire.idlabo";
                            $nomlabo = send_query($query);
                            echo "<p>Laboratoire : <a href="."laboratoire.php?nomlaboratoire=".$nomlabo[0]['nomlabo'].">"
                                . $nomlabo[0]['nomlabo'] . "</a></p>";

                            $query = "SELECT numbureau FROM Chercheur WHERE Chercheur.nomch='".$_GET["nomchercheur"]."'";
                            $numBur = send_query($query);
                            echo "<p>Bureau : ". $numBur[0]['numbureau'] . "</p>";

                            $query="SELECT sigle FROM Equipe, Chercheur WHERE Chercheur.nomch='".$_GET["nomchercheur"]."' AND Chercheur.idequipe= Equipe.idequipe";
                            $eq = send_query($query);
                            echo "<p>Équipe : <a href=\"equipe.php?nomequipe=".$eq[0]['sigle']."\">".$eq[0]['sigle']."</a></p>";

                            $query = "SELECT mail FROM Chercheur WHERE nomch='".$_GET["nomchercheur"]."'";
                            $mail = send_query($query);
                            echo "<p>E-Mail : ".$mail[0]['mail']."</p>";

                            $query = "SELECT numtel FROM Chercheur WHERE nomch='".$_GET["nomchercheur"]."'";
                            $tel = send_query($query);
                            echo "<p>Téléphone : ".$tel[0]['numtel']."</p>";

                        ?>
                    </fieldset>

                    <fieldset>
                        <legend>Publications</legend>
                        <?php 
                            $query="SELECT titre, datepubli, Publication.idpubli FROM Publication, Chercheur, Publie WHERE Chercheur.nomch ='".$_GET["nomchercheur"]."' AND Publication.idpubli= Publie.idpubli AND Chercheur.idch = Publie.idch";
                            $pubs = send_query($query);
                            $a = count($pubs);
                            for ($i = 0 ; $i < $a ; $i += 1 ){
                                $titrep = $pubs[$i]['titre']; 
                                $datep = $pubs[$i]['datepubli'];
                                $idp = $pubs[$i]['idpubli'];
                                if($titrep != ""){
                                    echo "-<a href=publication.php?idpublication=$idp>$titrep</a> ($datep)</br>";
                                }
                                else{
                                    echo "Aucune Publication.";
                                }
                            }
                        ?>
                    </fieldset>
                </div>
                
<?php 
    base_end();
 ?>
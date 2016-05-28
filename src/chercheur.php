<?php 
    include 'fonctions.php';

    base_start();
?>

                <div class="content-container">
                  <fieldset><legend>
                        <?php
                            $query = "SELECT prenomch FROM Chercheur WHERE nomch='".$_GET["nomchercheur"]."'";
                            $result=pg_query($query);
                            $ch = pg_fetch_row($result);
                            echo "$ch[0] ".$_GET["nomchercheur"];
                            if( $ch[0] == null){
                                echo "<script> window.location.replace('erreur.php?error=Chercheur+non+trouvé') </script>";
                            }
                            
                        ?>
                        </legend>
                        <?php
                            $query="SELECT nomlabo FROM Equipe, Chercheur, Laboratoire WHERE Chercheur.nomch='".$_GET["nomchercheur"]."' AND Chercheur.idequipe=Equipe.idequipe AND Equipe.idlabo=Laboratoire.idlabo";
                            $result=pg_query($query);
                            $nomlabo = pg_fetch_row($result);
                            echo "<p>Laboratoire : <a href="."laboratoire.php?nomlaboratoire=$nomlabo[0]".">$nomlabo[0]</a></p>";

                            $query="SELECT numbureau FROM Chercheur WHERE Chercheur.nomch='".$_GET["nomchercheur"]."'";
                            $result=pg_query($query);
                            $numBur = pg_fetch_row($result);
                            echo "<p>Bureau : $numBur[0]</p>";

                            $query="SELECT sigle FROM Equipe, Chercheur WHERE Chercheur.nomch='".$_GET["nomchercheur"]."' AND Chercheur.idequipe= Equipe.idequipe";
                            $result=pg_query($query);
                            $eq = pg_fetch_row($result);
                            echo "<p>Équipe : <a href='equipe.php?nomequipe=$eq[0]'>$eq[0]</a></p>";

                            $query="SELECT mail FROM Chercheur WHERE nomch='".$_GET["nomchercheur"]."'";
                            $result=pg_query($query);
                            $mail = pg_fetch_row($result);
                            echo "<p>E-Mail : $mail[0]</p>";

                            $query="SELECT numtel FROM Chercheur WHERE nomch='".$_GET["nomchercheur"]."'";
                            $result=pg_query($query);
                            $tel = pg_fetch_row($result);
                            echo "<p>Téléphone : $tel[0]</p>";

                        ?>
                    </fieldset>

                    <fieldset>
                        <legend>Publications</legend>
                        <?php 
                            $query="SELECT titre, datepubli, Publication.idpubli FROM Publication, Chercheur, Publie WHERE Chercheur.nomch ='".$_GET["nomchercheur"]."' AND Publication.idpubli= Publie.idpubli AND Chercheur.idch = Publie.idch";
                            $result=pg_query($query);
                            $pubs = pg_fetch_all($result);
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
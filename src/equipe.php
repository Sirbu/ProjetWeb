<?php 
    include("fonctions.php");

    base_start();
 ?>
                    <!--Contenu principal de la page EQUIPE -->
                    <div class="content-container">
                        <fieldset><legend>
                        	<?php
                        		$query = "SELECT Equipe.idequipe FROM Equipe WHERE Equipe.sigle='".$_GET["nomequipe"]."'";
                        		$eq = send_query($query);
                                echo $_GET["nomequipe"];
                                if(!$eq){
                                	echo "<script> window.location.replace('erreur.php?error=Equipe+non+trouvé') </script>";
                                }
                        		
                        	?>
                        	</legend>
                            <?php
                            	$query="SELECT nomeq FROM Equipe WHERE Equipe.sigle='".$_GET["nomequipe"]."'";
                                $nomeq = send_query($query);
                                echo "<p>".$nomeq[0]['nomeq']."</p>";

                                $query="SELECT nomlabo FROM Equipe,Laboratoire WHERE Equipe.idlabo=Laboratoire.idlabo AND Equipe.sigle='".$_GET["nomequipe"]."'";
                                $nomlabo = send_query($query);
                                echo "<p>Laboratoire : <a href=\"laboratoire.php?nomlaboratoire=".$nomlabo[0]['nomlabo']."\">"
                                . $nomlabo[0]['nomlabo']."</a></p>";

                                $query="SELECT specialite FROM Equipe WHERE Equipe.sigle='".$_GET["nomequipe"]."'";
                                $specialite = send_query($query);
                                echo "<p>Specialité : ".$specialite[0]['specialite']."</p>";

                                $query="SELECT description FROM Equipe WHERE Equipe.sigle='".$_GET["nomequipe"]."'";
                                $desc = send_query($query);
                                echo "<p>Description : </br>".$desc[0]['description']."</p>";

                            ?>
                        </fieldset>

                        <fieldset><legend>Membres:</legend>
                            <?php
                                $query="SELECT nomch, prenomch FROM Equipe, Chercheur WHERE Equipe.sigle ='".$_GET["nomequipe"]."'AND Equipe.idequipe = Chercheur.idEquipe";
                                $membres = send_query($query);
                                if(!$membres)
                                {
                                    echo "<p>Aucun membre</p>";
                                }
                                else
                                {
                                    $a = count($membres);
                                    for ($i = 0 ; $i < $a ; $i += 1 ){
                                    	$nom = $membres[$i]['nomch'];
                                    	$prenom = $membres[$i]['prenomch'];
                                    	$query2 = "SELECT statut FROM participe,chercheur WHERE participe.idCh=chercheur.idch AND chercheur.nomch='$nom'";
                                    	$stat = send_query($query2);
                                    	$aux = $i + 1;
                                    	echo $stat[0]['statut'] .": <a href=\"chercheur.php?nomchercheur=$nom\"> $prenom $nom </a></br>";
                                    }
                                }
                                
                            ?>
                        </fieldset>
                    </div>
            
<?php 
    base_end();
 ?>
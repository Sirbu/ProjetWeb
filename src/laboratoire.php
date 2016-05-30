<?php 
    include("fonctions.php");

    base_start();
 ?>
                <div class="content-container">
                    <!--Contenu principal de la page Laboratoire -->
                    <fieldset><legend>
                    	<?php
                            // Selection du titre du laboratoire
                    		$query = "SELECT idLabo FROM Laboratoire WHERE nomlabo='".$_GET["nomlaboratoire"]."'";
                    		$lab = send_query($query);
                            echo $_GET["nomlaboratoire"];
                            if(!$lab){
                            	echo "<script> window.location.replace('erreur.php?error=Laboratoire+non+trouvé') </script>";
                            }
                    		
                    	?>
                    	</legend>
                        <?php
                            // Selection des attributs principaux du laboratoire
                        	$query="SELECT domaine FROM Laboratoire WHERE nomlabo='".$_GET["nomlaboratoire"]."'";
                            $dom = send_query($query);
                            echo "<p>Domaine : ".$dom[0]['domaine']."</p>";

                            $query="SELECT descriptionlabo FROM Laboratoire WHERE nomlabo='".$_GET["nomlaboratoire"]."'";
                            $desc = send_query($query);
                            echo "<p>Description : ".$desc[0]['descriptionlabo']."</p>";

                            $query="SELECT adresselabo FROM Laboratoire WHERE nomlabo='".$_GET["nomlaboratoire"]."'";
                            $addr = send_query($query);
                            echo "<p>Adresse : ".$addr[0]['adresselabo']."</p>";

                        ?>
                    </fieldset>

                    <fieldset><legend>Équipes Membres:</legend>
                        <?php
                            // Selection des equipes qui appartiennent au labo
                            $query="SELECT sigle FROM Equipe, Laboratoire WHERE Laboratoire.nomlabo ='".$_GET["nomlaboratoire"]."'AND Equipe.idlabo = Laboratoire.idlabo";
                            $membres = send_query($query);
                            
                            $a = count($membres);
                            for ($i = 0 ; $i < $a ; $i += 1 ){
                            	$eq = $membres[$i]['sigle'];
                                $query2="SELECT specialite FROM Equipe WHERE Equipe.sigle='".$eq."'";
                                $specialite = send_query($query2);
                            	echo "<a href='equipe.php?nomequipe=$eq'>$eq</a> (".$specialite[0]['specialite'].")</br>";
                            }
                            
                        ?>
                    </fieldset>   
                </div>
 
<?php 
    base_end();
 ?>
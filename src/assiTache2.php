<?php 
    include 'fonctions.php';

    base_start("none", true);
?>

                    <div class="content-container">	
                        <?php
    						$query = "SELECT idch FROM Chercheur WHERE nomch='".$_POST["selection"]."'";
    						$res1 = send_query($query);
    						
    						$query = "SELECT idtache FROM Tache WHERE nomtache='".$_POST["selection2"]."'";
    						$res2 = send_query($query);
    						
    						$query ="INSERT INTO effectue VALUES ('".$res1[0]['idch']."','".$res2[0]['idtache']."')"; 
    						$result=pg_query(connectDB(), $query);
    						
    						if (!$result)
    						{
                                echo"<p>ERREUR lors de l'ajout</p>";	
    						}
    						else
    						{
    							echo "<p>SUCCES lors de l'assignation de tâches</p>" ;
    						}
    					?>
					
			        </div>
<?php 
    base_end();
 ?>
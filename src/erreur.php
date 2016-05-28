<?php 
	include("fonctions.php");

	base_start();
 ?>

 		<div class="content-container">
 			
 			<h2>Oups... Il y a eu une erreur !</h2>
 			<p>Code d'erreur : <?php echo $_GET['error'] ?></p>

 		</div>

<?php 
	base_end();
 ?>
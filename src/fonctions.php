<?php 
	function connectDB()
	{
		$dbconnect = pg_connect("host=localhost port=5432 dbname=ProjetWeb2k16 user=willeMz password=123456");
	    if(!$dbconnect)
	    {
	        header('Location: erreur.php?error=bdd_connect');
	    }
	    else
	    {
	    	return $dbconnect;
	    }
	}
 ?>
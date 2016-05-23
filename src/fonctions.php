<?php 
	function connectDB()
	{
		$dbconnect = pg_connect("host=localhost port=5432 dbname=postgres user=postgres password=toto");
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
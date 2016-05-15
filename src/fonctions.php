<?php 
	function connectDB()
	{
		$dbconnect = pg_connect("host=localhost port=5432 dbname=RCP user=postgres password=post");
	    if(!$dbconnect)
	    {
	        // pourquoi pas une redirection vers une page d'erreur à la place ?
	        header('Location: error.php');
	    }
	    else
	    {
	    	return $dbconnect;
	    }
	}
 ?>
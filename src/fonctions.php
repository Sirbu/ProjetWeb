<?php 
	function connectDB()
	{
		$dbconnect = pg_connect("host=localhost port=5432 dbname=RCP user=postgres password=post");
	    if(!$dbconnect)
	    {
	        header('Location: error.php?error=404');
	    }
	    else
	    {
	    	return $dbconnect;
	    }
	}
 ?>
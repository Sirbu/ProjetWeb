<?php 
	function connectDB()
	{
		$dbconnect = pg_connect("host=localhost port=5432 dbname=RCP user=postgres password=post");
	    if(!$dbconnect)
	    {
	        header('Location: erreur.php?error=bdd_connect');
	    }
	    else
	    {
	    	return $dbconnect;
	    }
	}

	function send_query($dbconnect, $query)
	{
		$result = pg_query($dbconnect, $query);
		if(!$result)
		{
			header('Location: erreur.php?error=err_fct_req');
		}

		return pg_fetch_all($result);
	}
 ?>
<?php 
	function connectDB()
	{
		$dbconnect = pg_connect("host=localhost port=5432 dbname=RCP user=postgres password=stri");
	    if(!$dbconnect)
	    {
	        header('Location: erreur.php?error=bdd_connect');
	    }
	    else
	    {
	    	return $dbconnect;
	    }
	}


	function idLastElement($id,$table)
	{
		$requete = "SELECT max($id) FROM $table;";
        $resultat = pg_query(connectDB(), $requete);
        $lignes = pg_fetch_row($resultat);
        if (!isset($lignes[0])){
        	$cpt = 1;
        }
        else{
        	$cpt = $lignes[0] + 1;
        }
        return $cpt;
	}

 ?>
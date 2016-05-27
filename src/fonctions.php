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

	function send_query($query)
	{
		$dbconnect = connectDB();

		$result = pg_query($dbconnect, $query);
		if(!$result)
		{
			header('Location: erreur.php?error=err_fct_req');
		}

		$lignes = pg_fetch_all($result);

		pg_close($dbconnect);

		return $lignes;
	}
 

	/* Retourne le dernier élément d'une table incrémenté de 1 */
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

	
	/*Récupère la clé de la date (idcal) associée à la tâche*/
	function idcalFind($nomT)
	{
	    $requete1 = "SELECT idcal FROM tache WHERE nomtache = '".$nomT."';";    
	    $resultat = pg_query(connectDB(), $requete1);    
	    $lignes = pg_fetch_row($resultat);	            
	    $idcal = $lignes[0];
	    return $idcal;
	}

?>

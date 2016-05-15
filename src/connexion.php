<?php 
	include 'fonctions.php';

	$username = (isset($_POST['username'])) ? $_POST['username'] : '' ;
	// est-ce utile de stocker le password comme ça ? 
	$password = (isset($_POST['password'])) ? $_POST['password'] : '' ;

	if($username == '')
	{
		// si l'username est null il y a un problème
		header('Location: erreur.php?error=1');
	}
	else if($password == '')
	{
		header('Location: erreur.php?error=2');
	}


	$dbconnect = connectDB();

	$query = "SELECT passch from Chercheur
			  WHERE Chercheur.loginch = '" . $username . "';";

	$resultat = pg_query($query);
	if(!$resultat)
	{
		header('Location: erreur.php?error=3');
	}

	$db_pass = pg_fetch_row($resultat);

	if($db_pass[0] == $password)
	{
		session_start();

		$_SESSION['username'] = $username;
		$_SESSION['logged'] = true;

		header('Location: index.php');
	}
?>
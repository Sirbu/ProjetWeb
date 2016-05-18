<?php 
    require_once('fonctions.php');

    if($_GET['action'] == "deconnexion")
    {
        session_destroy();
        unset($_SESSION);
        setcookie("PHPSESSID", "", time() - 3600);
        header('Location: index.php');
    }


    $username = (isset($_POST['username'])) ? $_POST['username'] : '' ;
    $password = (isset($_POST['password'])) ? $_POST['password'] : '' ;

    if($username == '')
    {
        // si l'username est null il y a un problème
        header('Location: erreur.php?error=1');
    }
    else if($password == '')
    {
        // si le password est null il y a un problème
        header('Location: erreur.php?error=2');
    }

    // connexion à la base de donnée
    $dbconnect = connectDB();

    // on forme la requête permettant de trouver
    // le mot de passe correspondant à l'utilisateur
    // donné dans le forumlaire
    $query = "SELECT passch from Chercheur
              WHERE Chercheur.loginch = '" . $username . "';";

    // exécution de la requête sql
    $resultat = pg_query($query);        
    if(!$resultat)
    {
        // il y a une erreur ! (Problème bdd)
        header('Location: erreur.php?error=3');
    }


    $db_pass = pg_fetch_row($resultat);
    if(!$db_pass)
    {
        // si il n'y a aucune ligne alors
        // l'utilisateur n'existe pas !
        // réaction à changer peut être...
        header('Location: erreur.php?error=4');
    }
    else if($db_pass[0] != $password)
    {
        // utilisateur correct mais mauvais mot de passe
        header('Location: erreur.php?error=5');
    }
    else
    {   // username et password OK
        session_start();

        $_SESSION['username'] = $username;
        $_SESSION['logged'] = true;

        header('Location: index.php');
    }
?>
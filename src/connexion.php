<?php 
    require_once('fonctions.php');

    if($_GET["action"] == "deconnexion")
    {
        setcookie("session", "", time() - 10000);
        header('Location: index.php');
        die();
    }

    $username = (isset($_POST['username'])) ? $_POST['username'] : '' ;
    $password = (isset($_POST['password'])) ? $_POST['password'] : '' ;

    if($username == '')
    {
        // si l'username est null il y a un problème
        header('Location: erreur.php?error=auth');
        die();
    }
    else if($password == '')
    {
        // si le password est null il y a un problème
        header('Location: erreur.php?error=auth');
        die();
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
        header('Location: erreur.php?error=db_error');
        die();
    }


    $db_pass = pg_fetch_row($resultat);
    if(!$db_pass)
    {
        // si il n'y a aucune ligne alors
        // l'utilisateur n'existe pas !
        // réaction à changer peut être...
        header('Location: erreur.php?error=auth');
        die();
    }
    else if($db_pass[0] != $password)
    {
        // utilisateur correct mais mauvais mot de passe
        header('Location: erreur.php?error=auth');
        die();
    }
    else
    {   // username et password OK
        // le cookie expire en 15 minutes (valeur arbitraire à revoir plus tard probablement)
        setcookie("session", "$username", time() + 600);

        header('Location: index.php');
        die();
    }
?>
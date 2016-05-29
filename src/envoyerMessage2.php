<?php 
    require_once('fonctions.php');

    
    /*Récupérer l'id du dernier message*/
    $idLastM = idLastElement("iddiscussion","message");
    $date = date("d-m-Y");/*Récupère la date d'aujourd'hui*/    
    $idprojet = (isset($_POST['idprojet'])) ? $_POST['idprojet'] : '';
    $objetM = (isset($_POST['objetM'])) ? $_POST['objetM'] : '';
    $contenuM = (isset($_POST['contenuM'])) ? $_POST['contenuM'] : '' ;

    // ça vaudrai le coup de faire une fonction pour récupérer
    // l'id d'un chercheur à partir de son nom, mais il est tard (23h00 - 29/05/2016) ...
    $query = "SELECT idch FROM Chercheur WHERE nomch = '" . $_COOKIE['session'] . "';";
    $result = send_query($query);

    $idch = $result[0]['idch'];

    /*Vérification des dépassements des textes*/
    $taille = strlen($objetM);
    $taille1 = strlen($contenuM);  


    if($taille>100)
        $erreur = "le champ objet doit être de 100 caractères maximum, vous en avez rentré : ".$taille.".";    
    elseif($taille1>500) 
        $erreur = "le+contenu+doit+être+de+500+caractères+maximum.+Vous+en+avez+rentré+:+".$taille1.".";
    else
        $verif = 1;
    
    if($verif){
        /* Ajoute un message à la BDD*/    
        $requete1 = "INSERT INTO message VALUES ('".$idLastM."','".$objetM."','".$contenuM."','".$date."','".$idch."','".$idprojet."');";/* Attention penser à changer le type int en date en BDD*/
        $ret = pg_query(connectDB(), $requete1);
        if(!$ret)
            $erreur = "impossible+d'envoyer+le+message."; 
    }
   
    if(isset($erreur)){

        header("Location: erreur.php?error=" . $erreur);
        die();        
    }

    header("Location: listeMessage.php");

?>
    
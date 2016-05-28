<?php 
    require_once('fonctions.php');

    
    /*Récupérer l'id du dernier message*/
    $idLastM = idLastElement("iddiscussion","message");
    $date = date("d-m-Y");/*Récupère la date d'aujourd'hui*/    
    $idprojet = (isset($_POST['idprojet'])) ? $_POST['idprojet'] : '';
    $objetM = (isset($_POST['objetM'])) ? $_POST['objetM'] : '';
    $contenuM = (isset($_POST['contenuM'])) ? $_POST['contenuM'] : '' ;

    $idch = $_COOKIE["session"];

    /*Vérification des dépassements des textes*/
    $taille = strlen($objetM);
    $taille1 = strlen($contenuM);  


    if($taille>100)
        $erreur = "le champ objet doit être de 100 caractères maximum, vous en avez rentré : ".$taille.".";    
    elseif($taille1>500) 
        $erreur = "le contenu doit être de 500 caractères maximum, vous en avez rentré : ".$taille1.".";
    else
        $verif = 1;
    
    if($verif){
        /* Ajoute un message à la BDD*/    
        $requete1 = "INSERT INTO message VALUES ('".$idLastM."','".$objetM."','".$contenuM."','".$date."','".$idch."','".$idprojet."');";/* Attention penser à changer le type int en date en BDD*/
        $ret = pg_query(connectDB(), $requete1);
        if(!$ret)
            $erreur = "impossible d'envoyer le message."; 
    }
   
    if($erreur){

        echo"<script type=\"text/javascript\">alert(\"Erreur : $erreur\");</script> ";        
    }


?>
<!-- Retour à la page listeMessage.php -->
    <script type="text/javascript">window.location="listeMessage.php";</script>
    
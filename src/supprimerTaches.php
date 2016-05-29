<?php 
    require_once('fonctions.php');

    
    $nomT = (isset($_POST['nomT'])) ? $_POST['nomT'] : '';

    $idcal = idcalFind($nomT);

    // il faut vérifier si la tache n'a pas été assignée
    // mais d'abord il faut son id
    $requete = "SELECT idtache FROM tache WHERE nomtache = '" . $nomT . "';";
    $resultat = send_query($requete);
    if(!$resultat)
    {
        echo "MERDE";
        die();
    }

    $query = "SELECT idtache FROM effectue WHERE idtache = '" . $resultat[0]['idtache'] . "';";;
    $result = send_query($query);
    if($result !== false)
    {
        foreach ($result as $ligne)
        {
            $del_query = "DELETE FROM effectue WHERE idtache = '" . $resultat[0]['idtache'] . "';";
            send_query($del_query);
        }
    }

    /*Suppression de la date*/
    $requete3 = "DELETE FROM calendrier WHERE idcal = '".$idcal."';";    
    send_query($requete3);
    
    /*Suppression de la tache*/
    $requete2 = "DELETE FROM tache WHERE nomtache = '".$nomT."';";    
    $resultat = send_query($requete2);


    header("Location: taches.php");
?>
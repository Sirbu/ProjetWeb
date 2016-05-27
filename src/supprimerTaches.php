<?php 
    require_once('fonctions.php');

    
    $nomT = (isset($_POST['nomT'])) ? $_POST['nomT'] : '';    

    
    $idcal = idcalFind($nomT);

    /*Suppression de la tache*/
    $requete2 = "DELETE FROM tache WHERE nomtache = '".$nomT."';";    
    $resultat = pg_query(connectDB(), $requete2);
    
    

    /*Suppression de la date*/
    $requete3 = "DELETE FROM calendrier WHERE idcal = '".$idcal."';";    
    pg_query(connectDB(), $requete3);
?>


    <!-- Retour à la page taches.php -->
<script type="text/javascript">
    
        window.location="taches.php";  

</script> 
<?php 
    require_once('fonctions.php');

    
    /*Récupérer l'id de la derniere tache et du dernier idcal*/
    

    $idcal = (isset($_POST['idcal'])) ? $_POST['idcal'] : '' ;
    $debutT = (isset($_POST['debutT'])) ? $_POST['debutT'] : '';
    $finT = (isset($_POST['finT'])) ? $_POST['finT'] : '' ;

    /*Ajoute la date dans le calendrier*/                        
    $requete1 = "UPDATE calendrier SET datedebut ='".$debutT."', datefin ='".$finT."' WHERE idcal ='".$idcal."';";    
    send_query($requete1);
    
     
?>
    <!-- Retour à la page taches.php -->
    <script type="text/javascript">window.location="taches.php";</script>

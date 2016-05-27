<?php 
    require_once('fonctions.php');

    
    /*Récupérer l'id de la derniere tache et du dernier idcal*/
    $idLastT = idLastElement("idtache","tache");
    $idLastC = idLastElement("idcal","calendrier");

    $nomT = (isset($_POST['nomT'])) ? $_POST['nomT'] : '';
    $typeT = (isset($_POST['typeT'])) ? $_POST['typeT'] : '';
    $debutT = (isset($_POST['debutT'])) ? $_POST['debutT'] : '';
    $finT = (isset($_POST['finT'])) ? $_POST['finT'] : '' ;
    $descriptionT = (isset($_POST['descriptionT'])) ? $_POST['descriptionT'] : '' ;
    $idProjet = 1;    

    echo"$nomT<BR>";
    echo"$typeT<BR>";
    echo"$debutT<BR>";
    echo"$finT<BR>";
    echo"$descriptionT<BR>";
    echo"$idProjet<BR><BR>";
    echo"$idLastT<BR>";
    echo"$idLastC<BR><BR>";
    /*Ajoute la date dans le calendrier*/                        
    $requete1 = "INSERT INTO calendrier VALUES ('".$idLastC."','".$debutT."','".$finT."');";    
    pg_query(connectDB(), $requete1);       

    /* Ajoute une taches à la BDD*/ //ATTENTION : ON TRAVAILLE QUE SUR LE PROJET 1    
    $requete2 = "INSERT INTO tache VALUES ('".$idLastT."','".$nomT."','".$typeT."','".$descriptionT."',1,'".$idLastC."');";
    pg_query(connectDB(), $requete2);    
?>
    <!-- Retour à la page taches.php -->
    <script type="text/javascript">window.location="taches.php";</script> 

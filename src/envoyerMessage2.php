<?php 
    require_once('fonctions.php');

    
    /*Récupérer l'id du dernier message*/
    $idLastT = idLastElement("idmessage","message");
    $date = date("d-m-Y");
    
    $idprojet = (isset($_POST['idprojet'])) ? $_POST['idprojet'] : '';
    $idch = (isset($_POST['idch'])) ? $_POST['idch'] : '';
    $objetM = (isset($_POST['objetM'])) ? $_POST['objetM'] : '';
    $contenuM = (isset($_POST['contenuM'])) ? $_POST['contenuM'] : '' ;
    
    echo"$idprojet<BR>";
    echo"$date<BR>";
    echo"$idch<BR>";
    echo"$objetM<BR>";
    echo"$contenuM<BR>";
    
    /* Ajoute un message à la BDD*/    
    $requete1 = "INSERT INTO message VALUES ('".$idLastT."','".$objetM."','".$contenuM."','".$date."','".$idch."','".$idprojet."');";
    pg_query(connectDB(), $requete1);

?>
    <!-- Retour à la page taches.php -->
    <!-- <script type="text/javascript">window.location="message.php";</script>  -->

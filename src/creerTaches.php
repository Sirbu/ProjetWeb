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
    $verif = 0;

    /*Vérification des dépassements des textes*/
    $taille = strlen($nomT);
    $taille1 = strlen($descriptionT);   

    if($taille>50)
        $erreur = "le nom doit être de 50 caractères maximum, vous en avez rentré : ".$taille.".";    
    elseif($taille1>500) 
        $erreur = "la description doit être de 500 caractères maximum, vous en avez rentré : ".$taille1.".";
    else
        $verif = 1;

    if($verif){
        if($debutT<=$finT){
            /*Ajoute la date dans le calendrier*/                        
            $requete1 = "INSERT INTO calendrier VALUES ('".$idLastC."','".$debutT."','".$finT."');";    
            $ret = pg_query(connectDB(), $requete1);

            if($ret){   /* Ajoute une taches à la BDD*/ //ATTENTION : ON TRAVAILLE QUE SUR LE PROJET 1    
                $requete2 = "INSERT INTO tache VALUES ('".$idLastT."','".$nomT."','".$typeT."','".$descriptionT."','".$idProjet."','".$idLastC."');";
                $ret2 = pg_query(connectDB(), $requete2);
                if(!$ret2)
                    $erreur = "impossible+de+créer+la+tâche";                
            }
            else
                $erreur = "impossible+de+créer+la+date";            
        }
        else
            $erreur = "la date+de+fin+est+inférieure+à+la+date+de+début";
    }
    if(isset($erreur))
    {
            header("Location: erreur.php?error=".$erreur);
            die();
    }
    
    header("Location: assiTache.php?idtache=" . $idLastT);
?>
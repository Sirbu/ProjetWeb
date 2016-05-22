<?php 

    /*
     * PENSER À VÉRIFIER SI TOUS LES TESTS D'ERREURS SONT FAITS !
     */

    if(!isset($_POST["button"]))
    {
        // en cas d'accès direct à la page par un petit malin ;)
        header('Location: erreur.php?error=forbidden');
        die();
    }

    // le s est juste pour l'orthographe
    $dossier_dest="Uploads/" . $_POST["type"] . "s/";
    $fichier_dest = $dossier_dest . basename($_FILES["file"]["name"]);

    // récupère l'extension du fichier
    $fileType = pathinfo($fichier_dest, PATHINFO_EXTENSION);

    // controle du type de fichier
    if($fileType != "jpg" && $fileType != "png" && $fileType != "pdf" && $filetype != "odt")
    {
        // la fin de l'url avec le $fichier_dest va peut être
        // foutre la merde (à cause des slash...)
        header('Location: erreur.php?error=filetype?ext=' . $fileType . '?dest=' . $fichier_dest);
        die();
    }

    if(file_exists($fichier_dest))
    {
        header('Location: erreur.php?error=file_exists');
        die();
    }

    // on pourrait vérifier la taille aussi...
    // on verra plus tard
    // Check file size FROM w3schools
    // if ($_FILES["fileToUpload"]["size"] > 500000) {
    //     echo "Sorry, your file is too large.";
    //     $uploadOk = 0;
    // }

    // on met à jour la base de donnée uniquement si
    // l'upload s'est bien passé, donc teste d'abord l'upload
    if(move_uploaded_file($_FILES["file"]["tmp_name"], $fichier_dest))
    {
        echo "Le fichier " . basename($fichier_dest) . " a bien été uploadé";
        echo "<br><a href=index.php>Accueil</a>";
    }
    else
    {
        echo "Désolé il y a eu une erreur lors de l'upload de votre fichier...";
        echo "<br><a href=index.php>Accueil</a>";
        die();
    }

    // seulement maintenant parce que si il y a eu 
    // des erreurs avant le fichier sert à rien donc bon...
    include("fonctions.php");

    // maintenant on le rajoute dans la base de donnée !!
    $connector = connectDB();

    // il faut trouver le plus grand idDoc/idPub
    // pour qu'a l'ajout dans la table on l'incrémente
    $query = "SELECT ";
    if($_POST["type"] == "Publication")
    {
        $query .= "max(idPubli) FROM Publication;";
    }
    else
    {
        $query .= "max(idDoc) FROM Document;";
    }

    $result = pg_query($connector, $query);
    $idMax = pg_fetch_row($result);

    // Si on a pas eu de résultat, c'est parce qu'il
    // n'y a rien dans la base. Donc on met le premier
    // id à 1
    if(!isset($idMax[0]))
    {
        $idDepot = 1;
    }
    else
    {
        $idDepot = $idMax[0]+1;
    }

    // on crée la base de la requête d'insertion
    $query = "INSERT INTO " . $_POST["type"] . " VALUES($idDepot, '" . $_POST["titre"] . "', ";

    // si c'est une publication il faut mettre la date,
    // si c'est un document il faut mettre le type
    if($_POST["type"] == "Publication")
    {
        $query .= "'" . date("d/m/y") . "', '$fichier_dest');";
    } 
    else
    {
        $query .= "'" . $_POST["type_doc"] . "', '$fichier_dest');";
    }

    $result = pg_query($connector, $query);
    // éventuellement vérifier le résultat, mais si
    // on en est à ce niveau du code, je crois pas
    // qu'il puisse y avoir de problème ...

    // maintenant il faut aussi insérer une ligne
    // dans la table publie si c'est une publication
    // et la table dépose si c'est un document

    // il faut l'id du chercheur qui dépose le fichier...
    // (trop de requêtes, j'en ai marre)
    // pour l'instant un peu la flemme de vérifier si tout se
    // passe sans problème...
    $requete_ch = "SELECT idCH from Chercheur WHERE nomch = '" . $_COOKIE["session"] . "';";

    $result = pg_query($connector, $requete_ch);
    if(!$result)
    {
        header("Location: erreur.php?error=BDD_ERR_IDCH");
        die();
    }
    $info_ch = pg_fetch_row($result);

    // là c'est la requête d'insertion
    $query = "INSERT INTO ";
    if($_POST["type"] == "Publication")
    {
        $query .= "Publie ";
    }
    else
    {
        $query .= "Depose ";
    }

    $query .= "VALUES(" . $info_ch[0] . ", " . $idDepot . ");";
    if(!pg_query($connector, $query))
    {
        header("Location: erreur.php?error=INSERT");
        die();
    }

 ?>
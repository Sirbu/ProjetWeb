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
    $ext = pathinfo($fichier_dest, PATHINFO_EXTENSION);

    $ext = strtolower($ext);

    // controle du type de fichier
    if(($ext != "jpg") && ($ext != "png") && ($ext != "pdf") && ($ext != "odt"))
    {
        // la fin de l'url avec le $fichier_dest va peut être
        // foutre la merde (à cause des slash...)
        header('Location: erreur.php?error=ext?ext=' . $ext . '?dest=' . $fichier_dest);
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
    // si la maj de la bdd se passe mal on effacera ce fichier.
    if(!move_uploaded_file($_FILES["file"]["tmp_name"], $fichier_dest))
    {
        header('Location: erreur.php?error=err_upload');
        die();
    }

    // seulement maintenant parce que si il y a eu 
    // des erreurs avant le fichier sert à rien donc bon...
    include("fonctions.php");

    // maintenant on le rajoute dans la base de donnée !!

    // il faut trouver le plus grand idDoc/idPub
    // pour qu'a l'ajout dans la table on l'incrémente
    $query = "SELECT ";
    if($_POST["type"] == "Publication")
    {
        $idMax = idLastElement("idpubli", "Publication");
    }
    else
    {
        $idMax = idLastElement("iddoc", "Document");
    }

    // Si on a pas eu de résultat, c'est parce qu'il
    // n'y a rien dans la base. Donc on met le premier
    // id à 1
    if(!$idMax)
    {
        $idDepot = 1;
    }
    else
    {
        $idDepot = $idMax;
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

    // ici on utilise pg_query car la valeur de retour
    // de send_query est false lorsqu'il n'y a pas de lignes
    // et cela ne nous conviens pas.
    $result = pg_query(connectDB(), $query);
    if(!$result)
    {
        unlink($fichier_dest);
        header("Location: erreur.php?error=bdd_upload_error");
        die();
    }

    // maintenant il faut aussi insérer une ligne
    // dans la table publie si c'est une publication
    // et la table dépose si c'est un document

    // il faut l'id du chercheur qui dépose le fichier...
    // (trop de requêtes, j'en ai marre)
    $requete_ch = "SELECT idCH from Chercheur WHERE nomch = '" . $_COOKIE["session"] . "';";

    $info_ch = send_query($requete_ch);
    if(!$info_ch)
    {
        unlink($fichier_dest);
        header("Location: erreur.php?error=BDD_ERR_IDCH");
        die();
    }

    // là c'est la requête d'insertion dans la table
    // Dépose ou Publie en fonction du type de dépot
    $query = "INSERT INTO ";
    if($_POST["type"] == "Publication")
    {
        $query .= "Publie ";
    }
    else
    {
        $query .= "Depose ";
    }

    $query .= "VALUES(" . $info_ch[0]['idch'] . ", " . $idDepot . ");";

    if(!pg_query(connectDB(), $query))
    {
        unlink($fichier_dest);
        header("Location: erreur.php?error=INSERT");
        die();
    }

    // si on arrive ici c'est que tout s'est bien passé :)
    header("Location: depot_result.php?file=".basename($fichier_dest));

 ?>
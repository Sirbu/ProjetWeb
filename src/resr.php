<?php 
    include("fonctions.php");

    base_start("recherche");
 ?>
                <!-- Contenu de la page resr.php -->
                <div class="content-container">
                    

                    <?php 
                        // cette premiere partie du if est destinée au php associé a la barre de recherche rapide 
                        if(isset($_GET["rechrapide"]) && $_GET["rechrapide"] != ""){
                            $upup = strtoupper($_GET["rechrapide"]);
                            
                            $query = "SELECT Chercheur.nomch, Publication.idpubli, Publication.titre FROM Chercheur, Publication, Publie WHERE publie.idch = chercheur.idch AND publie.idpubli = publication.idpubli AND (upper(nomch) LIKE '%".$upup."%' OR upper(titre) LIKE '%".$upup."%')";

                            $req = send_query($query);

                            if(empty($req[0]['nomch']))
                                $cpt = 0;
                            else
                                $cpt = count($req);
                            
                            echo "<h1> Nombre de Resultats : $cpt </h1>";

                            echo "<h3> Chercheur / Publication: </h3>";
                            for($i = 0 ; $i < $cpt ; $i++){
                                $nom=$req[$i]['nomch'];
                                $pub=$req[$i]['titre'];
                                $pub2=$req[$i]['idpubli'];
                                echo "· <a href='chercheur.php?nomchercheur=$nom'> $nom </a> /"; 
                                echo "<a href='publication.php?idpublication=$pub2'> $pub </a><br>";
                            }

                        }
                        // a partir d'ici ce php est destinée au traitement de la recherche avancée
                        else if(isset($_POST["texterecherche"]) && $_POST["texterecherche"] != ""){
                            $texte = strtoupper($_POST["texterecherche"]); // met le texte saisi en majuscules pour faire le select convenablement
                            $type = $_POST["typerecherche"];            // recupere l'une des 3 radios choisis
                            
                            // t1,t2,t3 servent a voir si les checkBox sont cochés
                            isset($_POST["typerechercheplus1"]) ? $t1 = $_POST["typerechercheplus1"] : $t1 = "";
                            isset($_POST["typerechercheplus2"]) ? $t2 = $_POST["typerechercheplus2"] : $t2 = "";
                            isset($_POST["typerechercheplus3"]) ? $t3 = $_POST["typerechercheplus3"] : $t3 = "";
                            $s1 = $_POST["selectionnomlabo"];           // s1,s2,s3 recuperent respectivement le choix dans le menu déroulant de chaque checkBox
                            $s2 = $_POST["selectionnomeq"];
                            $s3 = $_POST["selectionspecialite"];

                            // Construction des querys de base
                            $query_select = "SELECT DISTINCT ";
                            $query_from =" FROM ";
                            $query_where = " WHERE ";
                            $query = $query_select.$type;
                            $query2 = $query_from."Publication, Chercheur, Publie, Equipe, Laboratoire";
                            $query3 = $query_where."upper(".$type.") LIKE '%".$texte."%'";

                            // Ajout dans la query en fonction de la radio box
                            if($type == "nomch"){
                                $query_equipe = " AND Chercheur.idequipe = Equipe.idEquipe";
                                $query_labo = " AND Chercheur.idequipe = Equipe.idequipe AND Laboratoire.idlabo = Equipe.idLabo";
                            }else{
                                $query_equipe =" AND Equipe.idequipe = Chercheur.idequipe AND Publie.idch = Chercheur.idch AND Publication.idpubli = Publie.idpubli";
                                $query_labo = "AND Equipe.idequipe = Chercheur.idequipe AND Publie.idch = Chercheur.idch AND Publie.idpubli = Publication.idpubli AND Laboratoire.idlabo = Equipe.idlabo";
                            }

                            // Complement des querys en fonction des checkbox 
                            if($t1 != ""){
                                $query = "$query,nomlabo";
                                $query3 = "$query3 AND Laboratoire.nomlabo='".$s1."' $query_labo";
                                $query_equipe = "";
                            }
                            
                            if($t2 != ""){
                                $query = "$query,nomeq";
                                $query3 = "$query3 AND Equipe.nomeq='".$s2."' $query_equipe";
                                $query_equipe = "";
                            }
                            
                            
                            if($t3 != ""){
                                $query = "$query,specialite";
                                $query3 = "$query3 AND Equipe.specialite='".$s3."' $query_equipe";
                            }

                            
                            // query totale
                            $query_final = $query.$query2.$query3;
                            
                            $res = send_query($query_final);

                            if ($res[0][$type] == "" && $res[0]['titre'] == "" )
                                $cpt = 0;
                            else
                                $cpt = count($res);


                            //affichage en fonction du type recherchée
                            if($type == "nomch")
                                echo "<h1> Chercheurs Trouvés: $cpt</h1>";
                            else
                                echo "<h1> Publications Trouvés: $cpt</h1>";

                            for($i=0; $i < $cpt ; $i++){
                                if($type == "nomch"){
                                    $nom = $res[$i]['nomch'];
                                    echo "<a href=chercheur.php?nomchercheur=$nom> $nom </a> <br>";
                                }
                                else{
                                    $idpub = "SELECT idpubli FROM Publication WHERE titre='".$res[$i][$type]."'";
                                    $rp = send_query($idpub);

                                    $titre = $res[$i]['titre'];
                                    $idp = $rp[0]['idpubli'];
                                    echo "<a href=publication.php?idpublication=$idp> $titre </a> <br>";
                                }
                            }
                        }
                        else
                            echo "Erreur lors de la saisie de Recherche !";
                        
                    ?>
                </div>
<?php 
    base_end();
 ?>
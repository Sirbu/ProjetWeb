<?php 
    include("fonctions.php");

    base_start("recherche");
 ?>

                <!-- Contenu de la page recherche.php -->
                <div class="content-container">
                    <script> 
                        /*Fcontion pour le submit de la recherche*/
                        function mysubmit(){
                            var testing = document.getElementById('texteR').value;
                            if ( testing == ""){
                                document.getElementById('texteR').placeholder = "Saisir Objet";
                                document.getElementById('objetR').style.color = "red";
                            }
                            else
                                document.getElementById('research').submit();
                        }
                    </script>  
                    
                    <form id="research" method="POST" action="resr.php">
                        <div id="objetR"> Objet de la recheche: </div>
                        <input id="texteR" type="text" name="texterecherche"/> <br>
                        <input type="radio" name="typerecherche" value="titre" checked/> Titre de Publication <br>
                        <input type="radio" name="typerecherche" value="nomch"/> Chercheur <br><br>
                        
                        
                        <input type="button" value="Rechercher" onclick="mysubmit()" /><br><br>

                        <script>
                            function redir(){
                                var labo = document.getElementById("selectionnomlabo").value;
                                var eq = document.getElementById("selectionnomeq").value;
                                var spec = document.getElementById("selectionspecialite").value;
                                window.location="rech3.php?lab=" + labo + "&equipe=" + eq + "&spec=" + spec;
                            }
                        </script>

                        <?php
                    
                            function listesR($idR,$nomR){
                                
                                if(isset($_GET["lab"]) && $idR == "nomeq"){
                                    $query = "SELECT $idR FROM Laboratoire, $nomR "
                                    . "WHERE Equipe.idlabo = Laboratoire.idLabo AND nomlabo='".$_GET["lab"]."'";

                                }else if(isset($_GET["equipe"]) && $idR == "specialite"){
                                   $query = "SELECT $idR FROM $nomR "
                                    . "WHERE nomeq IN (SELECT nomeq FROM Equipe, Laboratoire WHERE Laboratoire.idlabo = Equipe.idLabo AND Laboratoire.nomlabo='".$_GET["lab"]."')";
                                }else{
                                    $query = "SELECT $idR FROM $nomR";
                                }


                                    $res = send_query($query);
                                
                                    $a = count($res);
                                    
                                    echo "<select id=\"selection".$idR."\" name=\"selection".$idR."\" onchange=redir()>";
                                    
                                    for($i = 0 ; $i < $a ; $i++){
                                        $b = $res[$i][$idR];
                                        if ($b == $_GET["equipe"] || $b == $_GET["spec"] || $b == $_GET["lab"] )
                                            echo "<option selected value='$b'>$b</option>";
                                        else
                                            echo "<option value='$b'>$b</option>";
                                    }
                                    echo "</select>";
                            }

                        ?>

                        <input type="checkbox" name="typerechercheplus1" value="Laboratoire"> Laboratoire <?php listesR("nomlabo","Laboratoire"); ?> </input> <br>
                        <input type="checkbox" name="typerechercheplus2" value="Equipe"> Équipe <?php  listesR("nomeq","Equipe"); ?> </input> <br>
                        <input type="checkbox" name="typerechercheplus3" value="specialite"> Specialité <?php  listesR("specialite","Equipe"); ?> </input> <br>

                    </form>

                </div>
<?php 
    base_end();
?>
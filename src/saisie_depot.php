<?php 
    include("fonctions.php");

    base_start("none", true);
 ?>
                <div class="content-container">
                    <?php 
                        echo "<form method=post action=\"depot.php\" enctype=\"multipart/form-data\">";
                        echo "<h3>Dépôt de " . $_GET["type"] . "</h3>";
                     ?>

                    <table class="form_depot">
                         <tr>
                             <td><p>Titre : </p></td>
                             <td><input type="text" name="titre" placeholder="Entrez le titre"></td>
                         </tr>
                         <?php 
                            if($_GET["type"] == "Document")
                            {
                                echo "
                                     <tr>
                                         <td><p>Type : </p></td>
                                         <td>
                                            <select name=\"type_doc\">
                                                <option value=\"Compte rendu réunion\">Compte rendu réunion</option>
                                                <option value=\"Rapport expérience\">Rapport d'expérience</option>
                                                <option value=\"Brouillon\">Brouillon</option>
                                                <option value=\"Livrable\">Livrable</option>
                                            </select>
                                        </td>
                                    </tr>
                                ";
                            }

                          ?>
                         
                         <tr>
                             <td>Fichier : </td>
                             <td><input type="file" name="file"></td>
                         </tr>
                         <tr>
                            <td><input type="submit" name="button" value="Valider"></td>
                         </tr>

                    </table>
                    <?php
                        echo '<input type="hidden" name="type" value="' . $_GET["type"] . '">';
                        echo "</form>";
                     ?>                    
                </div>
<?php 
    base_end();
 ?>
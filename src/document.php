<?php 
    include 'fonctions.php';

    base_start("none", true);
?> 
                <div class="content-container">
                    <table height="100%" width="70%" border ="1" cellspacing="1" cellpadding="1">
                    <caption> <h2>Document</h2> </caption>
                        <tr>
                            <td class="news-title">
                                <div>
                                       <?php
                                            $query = "SELECT titreDoc, urlDoc,nomch,typeDoc FROM Document,Depose,Chercheur WHERE Document.idDoc='".$_GET["iddoc"]."' AND chercheur.nomch='".$_COOKIE["session"]."'";
                                                $data = send_query($query);
                                                echo "<p>" . $data[0]['titredoc'] . "</p>";
                                                echo "<p>Auteur : " . $data[0]['nomch'] . "</p>";
                                                echo " <p>Type : " . $data[0]['typedoc'] . "</p>";
                                                echo "<object class=\"pdf\" data=\"" . $data[0]['urldoc']
                                                    . "\" type=\"application/pdf\">";                                          
                                        ?>

                                </div>
                            </td>
                        </tr>
                    </table>
                </div>

<?php 
    base_end();
?>
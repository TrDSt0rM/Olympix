<!-- food section Table -->
<br />
<section class="food_section layout_padding-bottom">
    <div class="container">
        <div class="heading_container heading_center">
            <h2><?php echo $titre; ?></h2>
        </div>
        <div class="filters-content">
            <div class="candidature_texte">
                <?php if (isset($candidature)) {
                    echo "<div class='separe_box_en_deux'>";
                    echo "<p class='text_gauche'>Nom : " . $candidature->can_nom . "</p>";
                    echo "<p class='text_droite'>Prénom : " . $candidature->can_prenom . "</p>";
                    echo "</div>";
                    echo "<div class='can_texte'><p class='text_candidature'>Email : " . $candidature->can_email . "</p></div>";
                    echo "<div class='separe_box_en_deux'>";
                    echo "<p class='text_gauche'>Code Inscription : " . $candidature->can_code_inscription . "</p>";
                    echo "<p class='text_droite'>Code Candidature : " . $candidature->can_code_candidat . "</p>";
                    echo "</div>";
                    echo "<div class=can_texte><p class='text_candidature'>Présentation : " . $candidature->can_presentation . "</p></div>";
                    echo "<div class='separe_box_en_deux'>";
                    echo "<p class='text_gauche'>Etat de la  candidature : ";
                    if ($candidature->can_etat == 'A') {
                        echo "annulée";
                    } elseif ($candidature->can_etat == 'I') {
                        echo "inscrite";
                    } elseif ($candidature->can_etat == 'S') {
                        echo "sélectionnée";
                    } else {
                        echo "la candidature à un default, veuillez contacter l'organisateur du concours";
                    }
                    echo "<p class='text_droite'>Date Inscription : " . $candidature->can_date . "</div>";
                    echo "<div class='separe_box_en_deux'>";
                    echo "<p class='text_gauche'>Nom du Concours : " . $candidature->con_nom . "</p>";
                    echo "<p class='text_droite'>Nom de la Categorie : " . $candidature->cat_nom . "</p>";
                    echo "</div>";
                    echo "</div>"; //fermuture div candidature_texte
                    echo "<div class='ressource_candidature'>";
                    echo "<div class='ressource_texte'><p class='text_candidature'>Ressources de la Candidature : </p></div>";
                    echo "<div class='ressource_img'>";
                    if (!empty($ressource) && is_array($ressource)) {
                        foreach ($ressource as $res) {
                            if ($res['res_type'] == 1) {
                                echo "<a href='" . base_url() . "documents/" . $res['res_nom'] . "' target='_blank'><img class='img_candidature' src='" . base_url() . "documents/" . $res['res_nom'] . "' alt='" . $res['res_description'] . "' witdh=200px></a>";
                            } else {
                                // echo pour des videos
                            }
                        }
                    } else {
                        echo "aucune ressource pour le moment";
                    }
                    echo "</div>"; // fermeture div ressource_candidature
                    echo "<div class='candidature_bouton'>";
                    echo "<br />";
                    echo "<a href='https://obiwan.univ-brest.fr/~e22105002/index.php/candidature/supprimer/" . $candidature->can_code_inscription . "/" . $candidature->can_code_candidat . "'><input type='button' value='Supprimer la candidature' onclick='confirmDelete()'/><a>";
                    echo "</div>";
                    echo "</div>";
                } else {
                    echo ("Aucune candidature pour ce code d'inscription.");
                }
                ?>
                <script>
                    function confirmDelete() {
                        if (confirm("Êtes-vous sûr de vouloir supprimer votre candidature ?")) {
                            document.getElementById('deleteForm').submit();
                        }
                    }
                </script>
            </div>
        </div>
</section>

<!-- end food section Table -->

<!-- 
<script>
    function confirmDelete() {
        if (confirm("Êtes-vous sûr de vouloir supprimer votre candidature ?")) {
            document.getElementById('deleteForm').submit();
        }
    }
</script>
-->
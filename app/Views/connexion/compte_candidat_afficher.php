<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><?= $titre ?></h1>

    </div>

    <!-- Illustrations -->
    <div class="card shadow mb-4">
        <div class='text-center'>
            <?php
            if (!empty($candidature) && is_array($candidature)) {
                foreach ($candidature as $c) {
                    echo "<div class='card-header py-3'>";
                    echo "<h6 class='m-0 font-weight-bold text-primary'><center>" . $c['can_nom'] . " " . $c['can_prenom'] . "</center></h6>";
                    echo "</div>";

                    echo "<div class='card-body'>";
                    echo "<p>";
                    echo "Email : " . $c['can_email'] . "<br />";
                    echo "Description : " . $c['can_presentation'] . "<br /><br />";
                    echo "Catégorie : " . $c['cat_nom'] . "<br />";
                    if ($c['can_etat'] == 'S') {
                        echo "Etat de la candidature : Sélectionnée<br />";
                    } elseif ($c['can_etat'] == 'I') {
                        echo "Etat de la candidature : Inscrite<br />";
                    } else {
                        echo "Etat de la candidature : Annulée<br />";
                    }
                    echo "<br />Date d'inscription : " . $c['can_date'] . "<br />";
                    echo "</p>";

                    echo "<div class='text-center'>";
                    echo "<div class='ressource_img'>";
                    if (!empty($ressources) && is_array($ressources)) {
                        foreach ($ressources as $res) {
                            if ($res['res_type'] == 1) {
                                echo "<a href='" . base_url() . "documents/" . $res['res_nom'] . "' target='_blank'><img class='img_candidature' src='" . base_url() . "documents/" . $res['res_nom'] . "' alt='" . $res['res_description'] . "'></a>";
                            } else {
                                // echo pour des videos
                            }
                        }
                    } else {
                        echo "aucune ressource pour le moment";
                    }
                    echo "</div>";
                    echo "</div>";
                    echo "</div>";
                }
            }
            ?>
        </div>
    </div>


</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->
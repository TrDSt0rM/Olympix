<!-- Begin Page Content -->
<div class="container-fluid">

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">
        <?php
        if (isset($con)) {
            echo $con->con_nom;
        }
        ?>
    </h1>
</div>
<div class="row">
    <?php
    if (isset($con)) {
        echo "<div class='col-md-6 '>";
        echo "<div class='img-box'>";
        echo "<img src='" . base_url() . "images/" . $con->con_image . "' alt=''>";
        echo "</div></div>";

        echo "<div class='col-md-6 '>";
        echo "<div class='detail-box'>";
        echo "<div class='heading_container'>";
        echo "<h2>" . $con->con_nom . "</h2>";
        echo "</div>";

        echo "<p>";
        echo "Discipline : " . $con->con_discipline;
        echo "</p><p>";
        echo "Description : " . $con->con_description;
        echo "</p><p>";
        echo "Phase du concours : " . $con->phase;
        echo "</p>";
        echo "Date des phases :";
        echo "<div class='row'>";
        echo "<div class='col-md-6 '>";
        echo "<p>Début de la phase d'inscription :<br/>Début de la phase de pré-sélection :<br/>Début de la phase finale :<br/>Fin du concours :";
        echo "</div>";
        echo "<div class='col-md-6 '>";
        echo $con->all_date;
        echo "</div></div>";
        echo "<p>";
        echo "Catégorie : <br />";
        if ($con->categorie == NULL) {
            echo "aucune catégorie pour le moment";
        } else {
            echo $con->categorie;
        }
        echo "</p>";
        echo "<p>";
        echo "Membre du jury : <br />";
        if (!empty($jury) && is_array($jury)) {
            foreach ($jury as $j) {
                echo "<a href='" . $j['jur_url'] . "'>" . $j['cpt_nom'] . " " . $j['cpt_prenom'] . "<br />" . $j['jur_discipline'] . "</a>";
            }
        } else {
            echo "aucun membre du jury pour le moment";
        }
        echo "</p>";
        echo "<p>Organisateur du concours : " . $con->organisateur . "</p>";
        echo "</div></div>";
    } else {
        echo ("Aucnune informations pour le concours pour le momennt.");
    }

    if (!empty($candidature) && is_array($candidature)) {
        foreach ($candidature as $c) {
            echo "<div class='col-lg-6'>";
            echo "<!-- Basic Card Example -->";
            echo "<div class='card shadow mb-4'>";

            echo "<div class='card-header py-3'>";
            echo "<h6 class='m-0 font-weight-bold text-primary'><a href='https://obiwan.univ-brest.fr/~e22105002/index.php/concours/candidature_afficher/" . $c['can_id'] . "''>" . $c['can_nom'] . " " . $c['can_prenom'] . "</a></h6>";
            echo "</div>";

            echo "<div class='card-body'>";
            echo "Catégorie : " . $c['cat_nom'] . "<br />";
            if ($c['can_etat'] == 'S'){
                echo "Status : Sélectionnée";
            } elseif ($c['can_etat'] == 'I') {
                echo "Status : Inscrite";
            } else {
                echo "Status : Annulée";
            }
            echo "<br />date : " . $c['can_date'];
            echo "</div>";

            echo "</div>";
            echo "</div>";
        }
    }
    
    ?>          
</div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->
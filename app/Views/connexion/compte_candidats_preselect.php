<!-- Begin Page Content -->
<div class="container-fluid">

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"><?= $titre ?></h1>
</div>
<div class="row">
    <?php
    $session = session();
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
</div>
<!-- Galerie des candidats -->
<br />
<section class="food_section layout_padding-bottom">
  <div class="container">
    <div class="heading_container heading_center">
      <h2>
        <?php echo $titre ?>
      </h2>
    </div>

    <ul class="filters_menu">
      <li class="active" data-filter="*">All</li>
      <?php
      if (!empty($categories) && is_array($categories)) {
        foreach ($categories as $cat) {
          echo "<li data-filter='." . $cat['cat_nom'] . "'>" . $cat['cat_nom'] . "</li>";
        }
      }
      ?>
    </ul>
    <div class="filters-content">
      <div class="row grid">
        <?php
        if (!empty($candidats) && is_array($candidats)) {
          foreach ($candidats as $can) {
            echo "<div class='col-sm-6 col-lg-4 all " . $can['cat_nom'] . "'>";
            echo "<div class='box'>";
            echo "<div class='detail-box'>";
            echo "<br />";
            echo "<h5>";
            echo $can["can_nom"] . " " . $can["can_prenom"];
            echo "</h5>";
            echo "<p>";
            echo $can["can_presentation"];
            echo "</p>";
            if ($can["can_etat"] == 'S') {
              echo "<h5>";
              echo "Etat : Sélectionné";
              echo "</h5>";
            } elseif ($can["can_etat"] == 'I') {
              echo "<h5>";
              echo "Etat : Inscript";
              echo "</h5>";
            } else {
              echo "<h5>";
              echo "Etat : Annulé";
              echo "</h5>";
            }
            
            if (!empty($ressources) && is_array($ressources)) {
              foreach ($ressources as $r) {
                if ($r["can_id"] == $can["can_id"]) {
                  if ($r["res_type"] == '1') {
                    echo "<div class='img-box'>";
                    echo "<a href='" . base_url() . "documents/" . $r['res_nom'] . "' target='_blank'><img class='img_candidature' src='" . base_url() . "documents/" . $r['res_nom'] . "' alt='" . $r['res_description'] . "'></a>";
                    echo "</div>";
                  } else {
                    echo "autre type que image";
                  }
                }
              }
            }
            echo "</div>";
            echo "</div>";
            echo "</div>";
          }
        } else {
          echo ("<h3>Aucun candidats pour le moment</h3>");
        }
        ?>
      </div>
    </div>
  </div>
</section>

<!-- end galirie des candidats -->

<br />
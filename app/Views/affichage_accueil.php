<!-- offer section -->

<section class="offer_section layout_padding-bottom">
  <div class="offer_container">
    <div class="container">
      <h2>
        <center><?php echo $titre_actu; ?></center>
      </h2>
      <table class="table">
        <thead class="thead-dark">
          <tr>
            <th scope="col">Titre</th>
            <th scope="col">Description</th>
            <th scope="col">Date</th>
            <th scope="col">Auteur</th>
          </tr>
        </thead>
        <tbody>
          <?php
          if (!empty($actualites) && is_array($actualites)) {
            foreach ($actualites as $actu) {
              echo "<tr>";
              echo "<td>";
              echo $actu["act_titre"];
              echo "</td>";
              echo "<td>";
              echo $actu["act_description"];
              echo "</td>";
              echo "<td>";
              echo $actu["act_date"];
              echo "</td>";
              echo "<td>";
              echo $actu["cpt_login"];
              echo "</td>";
              echo "</tr>";
            }
          } else {
            echo ("<h3>Aucune actualités pour le moment</h3>");
          }
          ?>
        </tbody>
      </table>
    </div>
  </div>
</section>

<!-- end offer section -->

<!-- food section Galery -->

<section class="food_section layout_padding-bottom">
  <div class="container">
    <div class="heading_container heading_center">
      <h2>
        <?php echo $titre_concours ?>
      </h2>
    </div>

    <ul class="filters_menu">
      <li class="active" data-filter="*">All</li>
      <li data-filter=".A.venir">A venir</li>
      <li data-filter=".Inscription">Inscription</li>
      <li data-filter=".Sélection">Sélection</li>
      <li data-filter=".Finale">Finale</li>
      <li data-filter=".Terminé">Terminé</li>
    </ul>

    <div class="filters-content">
      <div class="row grid">

        <?php
        if (!empty($concours) && is_array($concours)) {
          foreach ($concours as $c) {
            echo "<div class='col-sm-6 col-lg-4 all " . $c['phase'] . "'>";
            echo "<div class='box'>";
            echo "<div>";
            echo "<div class='img-box'>";
            echo "<img src='" . base_url() . "images/" . $c['con_image'] . "' alt=''>";
            //  echo $c["con_image"];
            echo "</div>";
            echo "<div class='detail-box'>";
            echo "<h5>";
            echo $c["con_nom"];
            echo "</h5>";
            echo "<br />";
            echo "<h5>";
            echo "Phase : " . $c["phase"];
            echo "</h5>";
            echo "<p>";
            echo $c["con_description"];
            echo "</p>";
            echo "<br />";
            echo "<h5>";
            echo "Discipline : " . $c["con_discipline"];
            echo "</h5>";
            echo "<p>";
            echo "Début du concours le " . $c["con_date_debut"] . ". La phase d'inscription durera " . $c["con_tps_candidature"] . " jours, la phase de pré-selection " . $c["con_tps_preselect"] . " jours et la phase de la finale " . $c["con_tps_finale"] . " jours.";
            echo "</p>";
            echo "<br />";
            echo "<h5>";
            echo $c["Organisateur"];
            echo "</h5>";
            echo "<div class='options'>";
            echo "<a href='#'><img src='" . base_url() . "icons/loupe.png' width='25'></a>";

            if ($c["phase"] == 'Inscription') {
              echo "<a href='#'> <img src='" . base_url() . "icons/inscription.png' width='25'> </a>";
            }
            if ($c["phase"] == 'Finale') {
              echo "<a href='#'> <img src='" . base_url() . "icons/selection.png' width='25'> </a>";
            }
            if ($c["phase"] == 'Terminé') {
              echo "<a href='#'> <img src='" . base_url() . "icons/resultat.png' width='25'> </a>";
            }
            echo "<a href='#'><img src='" . base_url() . "icons/membre_jury.png' width='25'></a>";
            echo "</div>"; // class option
            echo "</div>"; // class detail box
            echo "</div>"; // div sans nom
            echo "</div>"; // class box
            echo "</div>"; // class col-sm-6
          }
        } else {
          echo ("<h3>Aucun concours pour le moment</h3>");
        }
        ?>
      </div>
    </div>
    <div class="btn-box">
      <a href="https://obiwan.univ-brest.fr/~e22105002/index.php/concours/afficher">
        Les Concours
      </a>
    </div>
  </div>
</section>

<!-- end food section -->

<!-- about section -->

<section class="about_section layout_padding">
  <div class="container  ">

    <div class="row">
      <div class="col-md-6 ">
        <div class="img-box">
          <img src="<?php echo base_url(); ?>icons/camera.png" alt="">
        </div>
      </div>
      <div class="col-md-6">
        <div class="detail-box">
          <div class="heading_container">
            <h2>
              Olympix
            </h2>
          </div>
          <p>
            Olympix est une application en ligne qui permet l'organisation de concours dématérialisés et à distance.
            Cette application réalise principalement des concours de photos mais pourrait évoluer dans le futur
            sur d'autre thème.
          </p>
          <a href="">
            En Savoir Plus
          </a>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- end about section -->

<br />
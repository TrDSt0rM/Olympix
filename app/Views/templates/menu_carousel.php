<!-- slider section V2 -->
<section class="slider_section ">
    <div id="customCarousel1" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
            <?php
            if (!empty($menu) && is_array($menu)) {
                // pour exécuter seulement une fois la class carousel-item active
                $carousel_actif = true;

                foreach ($menu as $m) {
                    if ($carousel_actif) {
                        echo "<div class='carousel-item active'>";
                        echo "<div class='container '>";
                        echo "<div class='row'>";
                        echo "<div class='col-md-7 col-lg-6 '>";
                        echo "<div class='detail-box'>";
                        echo "<h1>" . $m['con_nom'] . "</h1>";
                        echo "<p>" . $m['con_description'] . "</p>";
                        echo "<p>Phase du concours : " . $m['phase'] . "</p>";
                        echo "<p><b>" . $m['cpt_login'] . "</b></p>";
                        echo "<div class='btn-box'>";
                        echo "<a href='https://obiwan.univ-brest.fr/~e22105002/index.php/concours/afficher' class='btn1'>Visualiser</a>";
                        echo "</div>";
                        echo "</div>";
                        echo "</div>";
                        echo "</div>";
                        echo "</div>";
                        echo "</div>";
                        $carousel_actif = false;
                    } else {
                        echo "<div class='carousel-item '>";
                        echo "<div class='container '>";
                        echo "<div class='row'>";
                        echo "<div class='col-md-7 col-lg-6 '>";
                        echo "<div class='detail-box'>";
                        echo "<h1>" . $m['con_nom'] . "</h1>";
                        echo "<p>" . $m['con_description'] . "</p>";
                        echo "<p>" . $m['phase'] . "</p>";
                        echo "<p><b>" . $m['cpt_login'] . "</b></p>";
                        echo "<div class='btn-box'>";
                        echo "<a href='https://obiwan.univ-brest.fr/~e22105002/index.php/concours/afficher' class='btn1'>Visualiser</a>";
                        echo "</div></div></div></div></div></div>";
                    }
                }
            } else {
                echo "<div class='carousel-item active'>";
                echo "<div class='container '>";
                echo "<div class='row'>";
                echo "<div class='col-md-7 col-lg-6 '>";
                echo "<div class='detail-box'>";
                echo "<h1>Erreur</h1>";
                echo "<p>Erreur dans le chargement du menu</p>";
                echo "<div class='btn-box'>";
                echo "<a href='https://obiwan.univ-brest.fr/~e22105002/index.php/concours/afficher' class='btn1'>Visualiser</a>";
                echo "</div>";
                echo "</div>";
                echo "</div>";
                echo "</div>";
                echo "</div>";
                echo "</div>";
            }
            ?>
        </div>
        <div class="container">
            <ol class="carousel-indicators">
                <li data-target="#customCarousel1" data-slide-to="0" class="active"></li>
                <li data-target="#customCarousel1" data-slide-to="1"></li>
                <li data-target="#customCarousel1" data-slide-to="2"></li>
                <li data-target="#customCarousel1" data-slide-to="3"></li>
                <li data-target="#customCarousel1" data-slide-to="4"></li>
            </ol>
        </div>
    </div>
</section>
<!-- end slider section V2-->
</div>
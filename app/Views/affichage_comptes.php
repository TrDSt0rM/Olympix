<!-- offer section -->

<section class="offer_section layout_padding-bottom">
    <div class="offer_container">
        <div class="container">
            <h2>
                <?php
                echo $titre;
                echo " : ";
                echo $nb_compte->nb;
                ?>
            </h2>
            <?php
            if (! empty($logins) && is_array($logins)) {
                foreach ($logins as $pseudos) {
                    echo "<br />";
                    echo " -- ";
                    echo $pseudos["cpt_login"];
                    echo " -- ";
                    echo "<br />";

                
                }
            } else {
                echo ("<h3>Aucun compte pour le moment</h3>");
            }
            ?>
        </div>
    </div>
</section>

<!-- end offer section -->
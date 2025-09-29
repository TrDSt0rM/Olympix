<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary"><?php echo $titre; ?></h6>
            <h6 class="m-0 font-weight-bold text-primary"><a
                    href="https://obiwan.univ-brest.fr/~e22105002/index.php/concours/creer">+</a></h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead class="thead-dark">
                        <tr>
                            <th scope='col'>Titre</th>
                            <th scope='col'>Discipline</th>
                            <th scope='col'>Phase</th>
                            <th scope='col'>Date Phase</th>
                            <th scope='col'>Categorie</th>
                            <th scope='col'>Membre Jury</th>
                            <th scope='col'>Organisateur</th>
                            <th scope='col'></th>
                            <th scope='col'></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $session = session();
                        if (!empty($concours) && is_array($concours)) {
                            // Ordre personnalisé des phases
                            $ordre_phases = [
                                'A venir' => 1,
                                'Inscription' => 2,
                                'Sélection' => 3,
                                'Finale' => 4,
                                'Terminé' => 5
                            ];

                            // Trier le tableau $concours par phase
                            usort($concours, function ($a, $b) use ($ordre_phases) {
                                return $ordre_phases[$a['phase']] <=> $ordre_phases[$b['phase']];
                            });

                            foreach ($concours as $c) {
                                echo "<tr>";
                                echo "<td>";
                                echo $c["con_nom"];
                                echo "</td>";
                                //echo "<td>";
                                //echo $c["con_description"];
                                //echo "</td>";
                                echo "<td>";
                                echo $c["con_discipline"];
                                echo "</td>";
                                echo "<td>";
                                echo $c["phase"];
                                echo "</td>";
                                echo "<td>";
                                echo $c["all_date"];
                                echo "</td>";
                                if ($c["categorie"] == NULL) {
                                    echo "<td>Aucune categorie pour le moment.</td>";
                                } else {
                                    echo "<td>";
                                    echo $c["categorie"];
                                    echo "</td>";
                                }
                                if ($c["jury"] == NULL) {
                                    echo "<td>Aucun membre du jury pour le moment.</td>";
                                } else {
                                    echo "<td>";
                                    echo $c["jury"];
                                    echo "</td>";
                                }
                                echo "<td>";
                                echo $c["organisateur"];
                                echo "</td>";
                                echo "<td>";
                                echo "<a href='#'> <img src='" . base_url() . "icons/loupe.png' width='25'> </a>";
                                echo "</td>";
                                if ($c["phase"] == 'A venir') {
                                    echo "<td>";
                                    if (trim($session->get('user')) == trim($c["organisateur"])) {
                                        echo "<a href='https://obiwan.univ-brest.fr/~e22105002/index.php/concours/supprimer/suppression" . $c['con_id'] . "confirmer'> <img src='" . base_url() . "icons/poubelle.png' width='25'> </a>";
                                    }
                                    echo "</td>";
                                }
                                if ($c["phase"] == 'Inscription') {
                                    echo "<td>";
                                    echo "<a href='#'> <img src='" . base_url() . "icons/inscription.png' width='25'> </a>";
                                    echo "</td>";
                                }
                                if ($c["phase"] == 'Sélection') {
                                    echo "<td>";
                                    echo "<a href='#'> <img src='" . base_url() . "icons/inscription.png' width='25'> </a>";
                                    echo "</td>";
                                }
                                if ($c["phase"] == 'Finale') {
                                    echo "<td>";
                                    echo "<a href='#'> <img src='" . base_url() . "icons/inscription.png' width='25'> </a>";
                                    echo "<br />";
                                    echo "<a href='https://obiwan.univ-brest.fr/~e22105002/index.php/concours/candidats_afficher/" . $c['con_id'] . "'> <img src='" . base_url() . "icons/selection.png' width='25'> </a>";
                                    echo "</td>";
                                }
                                if ($c["phase"] == 'Terminé') {
                                    echo "<td>";
                                    echo "<a href='#'> <img src='" . base_url() . "icons/inscription.png' width='25'> </a>";
                                    echo "<br />";
                                    echo "<a href='https://obiwan.univ-brest.fr/~e22105002/index.php/concours/candidats_afficher/" . $c['con_id'] . "'> <img src='" . base_url() . "icons/selection.png' width='25'> </a>";
                                    echo "<br />";
                                    echo "<a href='#'> <img src='" . base_url() . "icons/resultat.png' width='25'> </a>";
                                    echo "</td>";
                                }
                                echo "</tr>";
                            }
                        } else {
                            echo ("<h3>Aucun concours pour le moment</h3>");
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->
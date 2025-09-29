<!-- Begin Page Content -->
<div class="container-fluid">

    <h1 class="h3 mb-2 text-gray-800"><?php echo $le_compte ?></h1>
    <p class="mb-4"><?php echo $le_message; ?><?php echo $le_total->nb; ?></p>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">

        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary"><?php echo $titre . " : " . $nb_compte->nb; ?></h6>
            <h6 class="m-0 font-weight-bold text-primary"><a
                    href="https://obiwan.univ-brest.fr/~e22105002/index.php/compte/creer">+</a></h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Login</th>
                            <th>Nom</th>
                            <th>Prénom</th>
                            <th>Etat</th>
                            <th>Discipline</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (!empty($logins) && is_array($logins)) {
                            foreach ($logins as $pseudos) {
                                echo "<tr>";
                                echo "<td>" . $pseudos["cpt_login"] . "</td>";
                                echo "<td>" . $pseudos["cpt_nom"] . "</td>";
                                echo "<td>" . $pseudos["cpt_prenom"] . "</td>";
                                echo "<td>" . $pseudos["cpt_etat"] . "</td>";
                                echo "<td>" . $pseudos["jur_discipline"] . "</td>";
                                echo "</tr>";
                            }
                        } else {
                            echo ("<h3>Aucun compte pour le moment</h3>");
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
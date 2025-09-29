<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800"><?php echo $titre; ?></h1>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <tbody>
                        <?php
                        if (isset($infoperso)) {
                            $session = session();
                            echo "<tr>";
                            echo "<td>Login</td>";
                            echo "<td>" . $infoperso->cpt_login . "</td>";
                            echo "</tr><tr>";
                            echo "<td>Nom</td>";
                            echo "<td>" . $infoperso->cpt_nom . "</td>";
                            echo "</tr><tr>";
                            echo "<td>Prenom</td>";
                            echo "<td>" . $infoperso->cpt_prenom . "</td>";
                            echo "</tr><tr>";
                            echo "<td>Etat compte</td>";
                            if ($infoperso->cpt_etat == 'A'){
                                echo "<td>Activé</td>";
                            } else {
                                echo "<td>Désactivé</td>";
                            }
                            if ($session->get('role') == 'J') {
                                echo "</tr><tr>";
                                echo "<td>Discipline</td>";
                                echo "<td>" . $infoperso->jur_discipline . "</td>";
                                echo "</tr><tr>";
                                echo "<td>Biograhpie</td>";
                                echo "<td>" . $infoperso->jur_biographie . "</td>";
                                echo "</tr><tr>";
                                echo "<td>Page Web</td>";
                                echo "<td><a href='" . $infoperso->jur_url . "'>Voir</td>";
                            }
                            echo "</tr><tr>";
                            echo "<td>Mot de passe</td>";
                            echo "<td><a href='https://obiwan.univ-brest.fr/~e22105002/index.php/compte/modifier'><input type='button' onclick='' value='modifier le mot de passe'></a></td>";
                            echo "</tr>";
                        } else {
                            echo ("Pas d'information personnelle");
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
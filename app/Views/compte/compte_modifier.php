<!-- Begin Page Content -->
<div class="container-fluid">
    <div class="container">
        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4"><?php echo $titre; ?></h1>
                            </div>

                            <?= session()->getFlashdata('error') ?>
                            <?php
                            // Création d’un formulaire qui pointe vers l’URL de base + /compte/modifier
                            echo form_open('/compte/modifier'); ?>
                            <?= csrf_field() ?>
                            <?= validation_show_error('pseudo') ?>
                            <?= validation_show_error('prenom') ?>
                            <?= validation_show_error('mdp') ?>
                            <?= validation_show_error('nom') ?>
                            <?= validation_show_error('confirmMdp') ?>

                            <?php
                            if (isset($infos)) {
                                $session = session();
                                echo "<div class='form-group'>";
                                echo "<input type='text' name='pseudo' class='form-control form-control-user'
                                    placeholder='pseudo' value='" . $infos->cpt_login . "'>";
                                echo "</div>";
                                echo "<div class='form-group row'>";
                                echo "<div class='col-sm-6 mb-3 mb-sm-0'>";
                                echo "<input type='text' name='prenom' class='form-control form-control-user'
                                        placeholder='Prénom' value='" . $infos->cpt_prenom . "'>";
                                echo "</div>";
                                echo "<div class='col-sm-6'>";
                                echo "<input type='text' name='nom' class='form-control form-control-user'
                                        placeholder='Nom' value='" . $infos->cpt_nom . "'>";
                                echo "</div>";
                                echo "</div>";
                                echo "<div class='form-group row'>";
                                echo "<div class='col-sm-6 mb-3 mb-sm-0'>";
                                echo "<input type='password' name='mdp' class='form-control form-control-user'
                                        placeholder='Mot de passe'>";
                                echo "</div>";
                                echo "<div class='col-sm-6'>";
                                echo "<input type='password' name='confirmMdp' class='form-control form-control-user'
                                        placeholder='Confirmer mot de passe'>";
                                echo "</div>";
                                echo "</div>";
                                echo "<center><input type='submit' name='submit' value='Valider'>";
                                echo "<a href='https://obiwan.univ-brest.fr/~e22105002/index.php/compte/informer'><input type='button' onclick='' value='Annuler'></a></center>";
                                echo "</form>";
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->
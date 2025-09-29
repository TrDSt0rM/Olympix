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
                            // Création d’un formulaire qui pointe vers l’URL de base + /compte/creer
                            echo form_open('/concours/creer'); ?>
                            <?= csrf_field() ?>
                            <div class="form-group">
                                <input type="text" name="nom" class="form-control form-control-user"
                                    placeholder="Nom du concours">
                                <?= validation_show_error('nom') ?>
                            </div>
                            <div class="form-group">
                                <input type="text" name="description" class="form-control form-control-user"
                                    placeholder="Description">
                                <?= validation_show_error('description') ?>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-6 mb-3 mb-sm-0">
                                    <input type="date" name="date_debut" class="form-control form-control-user"
                                        placeholder="">
                                    <?= validation_show_error('date_debut') ?>
                                    <?= $message_date_avant; ?>
                                </div>
                                <div class="col-sm-6">
                                    <input type="text" name="tps_candidature" class="form-control form-control-user"
                                        placeholder="Durée de la phase d'inscription">
                                    <?= validation_show_error('tps_candidature') ?>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-6 mb-3 mb-sm-0">
                                    <input type="text" name="tps_preselection" class="form-control form-control-user"
                                        placeholder="Durée de la phase de pré-sélection">
                                    <?= validation_show_error('tps_preselection') ?>
                                </div>
                                <div class="col-sm-6">
                                    <input type="text" name="tps_finale" class="form-control form-control-user"
                                        placeholder="Durée de la phase finale">
                                    <?= validation_show_error('tps_finale') ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <input type="text" name="discipline" class="form-control form-control-user"
                                    placeholder="Discipline du concours">
                                <?= validation_show_error('discipline') ?>
                            </div>
                            <center><input type="submit" name="submit" value="Créer un nouveau concours"></center>
                            </form>
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
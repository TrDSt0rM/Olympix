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
                            echo form_open('/compte/creer'); ?>
                            <?= csrf_field() ?>
                            <div class="form-group">
                                <?= $pseudo_existant ?>
                                <input type="text" name="pseudo" class="form-control form-control-user"
                                    placeholder="pseudo">
                                <?= validation_show_error('pseudo') ?>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-6 mb-3 mb-sm-0">
                                    <input type="text" name="prenom" class="form-control form-control-user"
                                        placeholder="Prénom">
                                    <?= validation_show_error('prenom') ?>
                                </div>
                                <div class="col-sm-6">
                                    <input type="text" name="nom" class="form-control form-control-user"
                                        placeholder="Nom">
                                    <?= validation_show_error('nom') ?>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-6 mb-3 mb-sm-0">
                                    <select name="validite" class="form-control form-control-user"
                                        placeholder="validite">
                                        <option value="A">Activé</option>
                                        <option value="D">Désactivé</option>
                                    </select>
                                </div>
                                <div class="col-sm-6">
                                    <select name="role" class="form-control form-control-user" placeholder="role">
                                        <option value="A">Administrateur</option>
                                        <option value="J">Jury</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-6 mb-3 mb-sm-0">
                                    <input type="password" name="mdp" class="form-control form-control-user"
                                        placeholder="Mot de passe">
                                    <?= validation_show_error('mdp') ?>
                                </div>
                                <div class="col-sm-6">
                                    <input type="password" name="confirmMdp" class="form-control form-control-user"
                                        placeholder="Confirmer mot de passe">
                                    <?= validation_show_error('confirmMdp') ?>
                                </div>
                            </div>
                            <center><input type="submit" name="submit" value="Créer un nouveau compte"></center>
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
<!-- slider section -->
<section class="slider_section ">
    <div id="customCarousel1" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <div class="container ">
                    <div class="row">
                        <div class="col-md-7 col-lg-6 ">
                            <div class="detail-box">
                                <div class="container mt-3">
                                    <h2><?php echo $titre; ?></h2>
                                    <?= session()->getFlashdata('error') ?>
                                    <?php echo form_open('/compte/connecter'); ?>
                                    <?= csrf_field() ?>
                                    <h6><?= $message ?></h6>
                                    <div class="mb-3 mt-3">
                                        <label for="pseudo">Pseudo :</label>
                                        <input type="email" class="form-control" id="email" placeholder="Enter email"
                                            name="pseudo">
                                        <?= validation_show_error('pseudo') ?>
                                    </div>
                                    <div class="mb-3">
                                        <label for="pwd">Mot de passe :</label>
                                        <input type="password" class="form-control" id="pwd"
                                            placeholder="Entrer mot de passe" name="mdp">
                                        <?= validation_show_error('mdp') ?>
                                    </div>
                                    <div class="form-check mb-3">
                                        <label class="form-check-label">
                                            <input class="form-check-input" type="checkbox" name="remember">
                                            Remember me
                                        </label>
                                    </div>
                                    <button type="submit" name="submit" class="btn btn-primary">Se connecter</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- end slider section -->
</div>
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
                                    <?php echo form_open('/candidature/connecter'); ?>
                                    <?= csrf_field() ?>
                                    <h6><?= $message ?></h6>
                                    <div class="mb-3 mt-3">
                                        <label for="codeI">Code Inscription : </label>
                                        <input type="password" class="form-control" id="pwd"
                                            placeholder="Entrer mot de passe" name="codeI">
                                        <?= validation_show_error('codeI') ?>
                                    </div>
                                    <div class="mb-3">
                                        <label for="codeC">Code Candidature : </label>
                                        <input type="password" class="form-control" id="pwd"
                                            placeholder="Entrer mot de passe" name="codeC">
                                        <?= validation_show_error('codeC') ?>
                                    </div>
                                    <button type="submit" name="submit" class="btn btn-primary">Visualiser</button>
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
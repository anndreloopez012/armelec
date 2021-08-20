<section class="content">
    <div class="container-fluid">
        <div class="col-12 logo-prelog">

        </div>
        <div class="row">
            <div class="col-1"></div>
            <div class="col-10">
                <div class="row">

                    <?php
                    if (is_array($arrModuloMenu) && (count($arrModuloMenu) > 0)) {
                        reset($arrModuloMenu);
                        foreach ($arrModuloMenu as $rTMP['key'] => $rTMP['value']) {
                            if ($rTMP["value"]['ctg_mod_siglas']!='TA') {
                    ?>
                            <a href="<?php echo  $rTMP["value"]['ctg_mod_rut']; ?>">
                                <div class="col-lg-2 col-6">
                                    <div class="small-box <?php echo  $rTMP["value"]['ctg_mod_color']; ?>">
                                        <div class="inner">
                                            <h4><?php echo  $rTMP["value"]['ctg_mod_siglas']; ?></h4>

                                            <p><?php echo  $rTMP["value"]['ctg_mod_desc']; ?></p>
                                        </div>
                                        <div class="icon">
                                            <?php echo  $rTMP["value"]['ctg_mod_btn']; ?>
                                        </div>
                                        <a href="<?php echo  $rTMP["value"]['ctg_mod_rut']; ?>" class="small-box-footer"><?php echo  $rTMP["value"]['ctg_mod_nom_btn']; ?><i class="fas fa-arrow-circle-right"></i></a>
                                    </div>
                                </div>
                            </a>
                    <?PHP }
                        }
                    }
                    ?>

                </div>
            </div>
            <?php if ($anuncios==1 ) { ?>
            <div class="col-1"></div><br><br><br>
            <div class="col-1"></div>

            <div class="col-4"><br><br><br>
                <div id="carouselExampleControls1" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img class="d-block w-100" src="../../asset/img/anuncios/anuncio1.png" alt="">
                        </div>
                        <div class="carousel-item ">
                            <img class="d-block w-100" src="../../asset/img/anuncios/anuncio11.png" alt="">
                        </div>
                  
                    </div>
                    <a class="carousel-control-prev" href="#carouselExampleControls1" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Anterior</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselExampleControls1" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Siguiente</span>
                    </a>
                </div>
            </div>
            <div class="col-3"><br><br><br>
                <div id="carouselExampleControls2" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                        <img class="d-block w-100" src="../../asset/img/anuncios/anuncio2.png" alt="">
                        </div>
                    </div>
                    <a class="carousel-control-prev" href="#carouselExampleControls2" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Anterior</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselExampleControls2" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Siguiente</span>
                    </a>
                </div>
            </div>
            <div class="col-3"><br><br><br>
                <div id="carouselExampleControls3" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                        <img class="d-block w-100" src="../../asset/img/anuncios/anuncio3.png" alt="">
                        </div>

                    </div>
                    <a class="carousel-control-prev" href="#carouselExampleControls3" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Anterior</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselExampleControls3" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Siguiente</span>
                    </a>
                </div>
            </div>
            <div class="col-1"></div>
            <?php }  ?>

        </div>
    </div>
</section>
<style>
    .logo-prelog {
        padding: 30px;
    }
</style>
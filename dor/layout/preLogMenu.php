<section class="content">
      <div class="container-fluid">
        <div class="col-12 logo-prelog">

        </div>
        <div class="row">
            <div class="col-1"></div>
                <div class="col-10">  
                    <div class="row">

                        <?php
                            if ( is_array($arrModulo) && ( count($arrModulo)>0 ) ){
                                reset($arrModulo);
                            foreach( $arrModulo as $rTMP['key'] => $rTMP['value'] ){
                                if ($rTMP["value"]['ctg_mod_siglas']=='PAC' || $rTMP["value"]['ctg_mod_siglas']=='MED') {
                        ?>
                            <div class="col-lg-6 col-6">
                        <?php } else { ?>
                            <div class="col-lg-2 col-6">
                        <?php } ?>

                                <div class="small-box <?php echo  $rTMP["value"]['ctg_mod_color']; ?>">
                                    <div class="inner">
                                        <h3><?php echo  $rTMP["value"]['ctg_mod_siglas']; ?></h3>
                                        <?php if ($rTMP["value"]['ctg_mod_siglas']=='PAC' || $rTMP["value"]['ctg_mod_siglas']=='MED') {?>
                                            <h1 style="text-align:center"><?php echo  $rTMP["value"]['ctg_mod_desc']; ?></h2>
                                        <?php }
                                        else { ?>
                                            <p><?php echo  $rTMP["value"]['ctg_mod_desc']; ?></p>
                                        <?php } ?>
                                        </div>
                                        <div class="icon">
                                            <?php echo  $rTMP["value"]['ctg_mod_btn']; ?>
                                    </div>
                                        <a  class="small-box-footer" href="data/log/<?php echo  $rTMP["value"]['ctg_mod_rut']; ?>"><?php echo  $rTMP["value"]['ctg_mod_nom_btn']; ?><i class="fas fa-arrow-circle-right" ></i></a>
                                </div>
                            </div>
                            <?PHP
                                }
                                    }
                            ?> 
                
                    </div>
                </div>
            <div class="col-1"></div>
        </div>
    </div>
</section>
<style>
.logo-prelog{
    padding: 30px;
}
</style>
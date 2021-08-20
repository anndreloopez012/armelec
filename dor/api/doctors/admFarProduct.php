
<?php require_once "../../data/conexion/tmfAdm.php"; ?>

<?php 
    $idCod = "";
    $arrTableFarProduct= array();
    $var_consulta= "SELECT * 
                    FROM ctg_productos pro
                    INNER JOIN ctg_farmacias_productos farPro
                    ON pro.ctg_pro_cod = farPro.ctg_fap_pro
                    INNER JOIN ctg_farmacias far
                    ON farPro.ctg_fap_contrato = far.ctg_far_contrato
                    WHERE pro.ctg_pro_cod = 'HO-184'";
    $sql = pg_query($rmfAdm, $var_consulta);
    $totalArticle = pg_num_rows($sql);
    

    while ( $rTMP = pg_fetch_assoc($sql) ){

        $arrTableFarProduct  [$rTMP["id"]]   ["id"]                                         = $rTMP["id"];      
        $arrTableFarProduct  [$rTMP["id"]]   ["ctg_fap_contrato"]                           = $rTMP["ctg_fap_contrato"];
        $arrTableFarProduct  [$rTMP["id"]]   ["ctg_fap_pro"]                                = $rTMP["ctg_fap_pro"];
        $arrTableFarProduct  [$rTMP["id"]]   ["ctg_fap_nomcom"]                             = $rTMP["ctg_fap_nomcom"];
        $arrTableFarProduct  [$rTMP["id"]]   ["ctg_fap_pre"]                                = $rTMP["ctg_fap_pre"];
        $arrTableFarProduct  [$rTMP["id"]]   ["ctg_fap_prinact"]                            = $rTMP["ctg_fap_prinact"];
        $arrTableFarProduct  [$rTMP["id"]]   ["ctg_fap_indi"]                               = $rTMP["ctg_fap_indi"];
        $arrTableFarProduct  [$rTMP["id"]]   ["ctg_fap_labfar"]                             = $rTMP["ctg_fap_labfar"];
        $arrTableFarProduct  [$rTMP["id"]]   ["ctg_fap_fecaut"]                             = $rTMP["ctg_fap_fecaut"];
        $arrTableFarProduct  [$rTMP["id"]]   ["ctg_fap_fecven"]                             = $rTMP["ctg_fap_fecven"];
        $arrTableFarProduct  [$rTMP["id"]]   ["ctg_fap_psinar"]                             = $rTMP["ctg_fap_psinar"];
        $arrTableFarProduct  [$rTMP["id"]]   ["ctg_fap_imagen"]                             = $rTMP["ctg_fap_imagen"];
        $arrTableFarProduct  [$rTMP["id"]]   ["ctg_fap_obs"]                                = $rTMP["ctg_fap_obs"];
        $arrTableFarProduct  [$rTMP["id"]]   ["ctg_fap_sta"]                                = $rTMP["ctg_fap_sta"];
        $arrTableFarProduct  [$rTMP["id"]]   ["ctg_fap_usr"]                                = $rTMP["ctg_fap_usr"];
        $arrTableFarProduct  [$rTMP["id"]]   ["ctg_fap_dt"]                                 = $rTMP["ctg_fap_dt"];   
        $arrTableFarProduct  [$rTMP["id"]]   ["ctg_far_nomcom"]                             = $rTMP["ctg_far_nomcom"];   
        $arrTableFarProduct  [$rTMP["id"]]   ["ctg_far_dir"]                                = $rTMP["ctg_far_dir"];   
        $arrTableFarProduct  [$rTMP["id"]]   ["ctg_far_zona"]                               = $rTMP["ctg_far_zona"];   

    }
    pg_free_result($sql);
?>



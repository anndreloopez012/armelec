<?php 
    $arrModulo= array();
    $var_consulta= "SELECT * FROM ctg_modulos WHERE ctg_mod_on = '1' ORDER BY ctg_mod_id ";

    $qTMP = pg_query($rmfAdm, $var_consulta);
    while ( $rTMP = pg_fetch_assoc($qTMP) ){

        $arrModulo  [$rTMP["id"]]   ["ctg_mod_id"]               = $rTMP["ctg_mod_id"];
        $arrModulo  [$rTMP["id"]]   ["ctg_mod_desc"]             = $rTMP["ctg_mod_desc"];
        $arrModulo  [$rTMP["id"]]   ["ctg_mod_on"]               = $rTMP["ctg_mod_on"];
        $arrModulo  [$rTMP["id"]]   ["ctg_mod_valor"]            = $rTMP["ctg_mod_valor"];
        $arrModulo  [$rTMP["id"]]   ["ctg_mod_siglas"]           = $rTMP["ctg_mod_siglas"];
        $arrModulo  [$rTMP["id"]]   ["ctg_mod_chat"]             = $rTMP["ctg_mod_chat"];
        $arrModulo  [$rTMP["id"]]   ["ctg_mod_tipo_contrato"]    = $rTMP["ctg_mod_tipo_contrato"];
        $arrModulo  [$rTMP["id"]]   ["id"]                       = $rTMP["id"];       
        $arrModulo  [$rTMP["id"]]   ["ctg_mod_color"]            = $rTMP["ctg_mod_color"];       
        $arrModulo  [$rTMP["id"]]   ["ctg_mod_nom_btn"]          = $rTMP["ctg_mod_nom_btn"];       
        $arrModulo  [$rTMP["id"]]   ["ctg_mod_rut"]              = $rTMP["ctg_mod_rut"];       
        $arrModulo  [$rTMP["id"]]   ["ctg_mod_btn"]              = $rTMP["ctg_mod_btn"];       
    }
    pg_free_result($qTMP);
?>
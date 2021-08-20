<?php
$arrModuloMenu = array();
$sucursal = isset($_SESSION['sucursal']) ? $_SESSION['sucursal']  : '';
//$sucursal = $_SESSION['sucursal'];
//print_r($sucursal);
if ($menu == 3) {
    if ($sucursal == 1) {
        $var_consulta = "SELECT * 
            FROM ctg_modulos_menu 
            WHERE ctg_mod_id_modulo = $menu 
            AND trim(ctg_mod_siglas) IN ('TPF','TPR', 'TOR', 'TREP', 'TS')
            ORDER BY ctg_mod_order ASC ";
        //print_r('sucursal--------------------');
        //print_r($var_consulta);
    } else {
        $var_consulta = "SELECT * 
            FROM ctg_modulos_menu 
            WHERE ctg_mod_id_modulo = $menu 
            AND trim(ctg_mod_siglas) IN ('TPF','TPR', 'TPC', 'TREP', 'TS', 'TA','TSC')
            ORDER BY ctg_mod_order ASC ";
        //print_r('mat--------------------');
        //print_r($var_consulta);
    }
} else {
    $var_consulta = "SELECT * 
        FROM ctg_modulos_menu 
        WHERE ctg_mod_id_modulo = $menu 
        ORDER BY ctg_mod_order ASC ";
}
//print_r($var_consulta);

$qTMP = pg_query($rmfAdm, $var_consulta);
while ($rTMP = pg_fetch_assoc($qTMP)) {/*
    $continue=1;
    switch ($rTMP["ctg_mod_siglas"]) {
        case 'FAR':{
            $var_consultaf = "SELECT * FROM ctg_farmacias";
            $qTMPf = pg_query($rmfAdm, $var_consultaf);
            $rs = pg_fetch_assoc($qTMPf);
            if (!$rs){
                $continue=0;
                echo '0 records';
            }
        } 
            break;
        case 'HOS':{
            $var_consultaf = "SELECT * FROM ctg_hospitales";
            $qTMPf = pg_query($rmfAdm, $var_consultaf);
            $rs = pg_fetch_assoc($qTMPf);
            if (!$rs){
                $continue=0;
                echo '0 records';
            }
        } 
            break;
        case 'LAB':{
            $var_consultaf = "SELECT * FROM ctg_lab_clinicos";
            $qTMPf = pg_query($rmfAdm, $var_consultaf);
            $rs = pg_fetch_assoc($qTMPf);
            if (!$rs){
                $continue=0;
                echo '0 records';
            }
        } 
            break;
        
    }
    if ($continue==1){
        $arrModuloMenu[$rTMP["id"]]["id"]                       = $rTMP["id"];
        $arrModuloMenu[$rTMP["id"]]["ctg_mod_desc"]             = $rTMP["ctg_mod_desc"];
        $arrModuloMenu[$rTMP["id"]]["ctg_mod_on"]               = $rTMP["ctg_mod_on"];
        $arrModuloMenu[$rTMP["id"]]["ctg_mod_siglas"]           = $rTMP["ctg_mod_siglas"];
        $arrModuloMenu[$rTMP["id"]]["ctg_mod_color"]            = $rTMP["ctg_mod_color"];
        $arrModuloMenu[$rTMP["id"]]["ctg_mod_nom_btn"]          = $rTMP["ctg_mod_nom_btn"];
        $arrModuloMenu[$rTMP["id"]]["ctg_mod_rut"]              = $rTMP["ctg_mod_rut"];
        $arrModuloMenu[$rTMP["id"]]["ctg_mod_btn"]              = $rTMP["ctg_mod_btn"];       
    }*/
    $arrModuloMenu[$rTMP["id"]]["id"]                       = $rTMP["id"];
    $arrModuloMenu[$rTMP["id"]]["ctg_mod_desc"]             = $rTMP["ctg_mod_desc"];
    $arrModuloMenu[$rTMP["id"]]["ctg_mod_on"]               = $rTMP["ctg_mod_on"];
    $arrModuloMenu[$rTMP["id"]]["ctg_mod_siglas"]           = $rTMP["ctg_mod_siglas"];
    $arrModuloMenu[$rTMP["id"]]["ctg_mod_color"]            = $rTMP["ctg_mod_color"];
    $arrModuloMenu[$rTMP["id"]]["ctg_mod_nom_btn"]          = $rTMP["ctg_mod_nom_btn"];
    $arrModuloMenu[$rTMP["id"]]["ctg_mod_rut"]              = $rTMP["ctg_mod_rut"];
    $arrModuloMenu[$rTMP["id"]]["ctg_mod_btn"]              = $rTMP["ctg_mod_btn"];       

}
pg_free_result($qTMP);
//print_r($var_consulta);

$username = isset($_SESSION['adm_usr_code']) ? $_SESSION['adm_usr_code']  : '';
$adm_usr_tipo = isset($_SESSION['adm_usr_tipo']) ? $_SESSION['adm_usr_tipo']  : '';

$arrMenbresia = array();
$var_consulta = "SELECT *
                FROM ctg_membresias
                WHERE ctg_mem_id = $username
                AND ctg_mem_type = '$adm_usr_tipo'";
$sql = pg_query($rmfAdm, $var_consulta);

while ($rTMP = pg_fetch_assoc($sql)) {

    $arrMenbresia[$rTMP["id"]]["id"]               = $rTMP["id"];
    $arrMenbresia[$rTMP["id"]]["ctg_mem_id"]               = $rTMP["ctg_mem_id"];
    $arrMenbresia[$rTMP["id"]]["ctg_mem_type"]               = $rTMP["ctg_mem_type"];
    $arrMenbresia[$rTMP["id"]]["ctg_mem_stat"]               = $rTMP["ctg_mem_stat"];
    $arrMenbresia[$rTMP["id"]]["ctg_mem_fec"]               = $rTMP["ctg_mem_fec"];
    $arrMenbresia[$rTMP["id"]]["ctg_mem_fec_venc"]               = $rTMP["ctg_mem_fec_venc"];
    $arrMenbresia[$rTMP["id"]]["ctg_mem_formpag"]               = $rTMP["ctg_mem_formpag"];
    $arrMenbresia[$rTMP["id"]]["ctg_mem_valor"]               = $rTMP["ctg_mem_valor"];
    $arrMenbresia[$rTMP["id"]]["ctg_mem_cuotas"]               = $rTMP["ctg_mem_cuotas"];
    $arrMenbresia[$rTMP["id"]]["ctg_mem_depban"]               = $rTMP["ctg_mem_depban"];
    $arrMenbresia[$rTMP["id"]]["ctg_mem_depnum"]               = $rTMP["ctg_mem_depnum"];
    $arrMenbresia[$rTMP["id"]]["ctg_mem_depdt"]               = $rTMP["ctg_mem_depdt"];
    $arrMenbresia[$rTMP["id"]]["ctg_mem_ccaban"]               = $rTMP["ctg_mem_ccaban"];
    $arrMenbresia[$rTMP["id"]]["ctg_mem_ccabancta"]               = $rTMP["ctg_mem_ccabancta"];
    $arrMenbresia[$rTMP["id"]]["ctg_mem_ccacuotas"]               = $rTMP["ctg_mem_ccacuotas"];
    $arrMenbresia[$rTMP["id"]]["ctg_mem_ccavalor"]               = $rTMP["ctg_mem_ccavalor"];
    $arrMenbresia[$rTMP["id"]]["ctg_mem_estatus"]               = $rTMP["ctg_mem_estatus"];
    $arrMenbresia[$rTMP["id"]]["ctg_mem_sta"]               = $rTMP["ctg_mem_sta"];
    $arrMenbresia[$rTMP["id"]]["ctg_mem_usr"]               = $rTMP["ctg_mem_usr"];
    $arrMenbresia[$rTMP["id"]]["ctg_mem_dt"]               = $rTMP["ctg_mem_dt"];
}
pg_free_result($sql);

if (is_array($arrMenbresia) && (count($arrMenbresia) > 0)) {
    reset($arrMenbresia);
    foreach ($arrMenbresia as $rTMP['key'] => $rTMP['value']) {
        $ctg_mem_id = isset($rTMP["value"]['ctg_mem_id']) ? $rTMP["value"]['ctg_mem_id']  : '';
        $ctg_mem_type = isset($rTMP["value"]['ctg_mem_type']) ? $rTMP["value"]['ctg_mem_type']  : '';
        $ctg_mem_stat = isset($rTMP["value"]['ctg_mem_stat']) ? $rTMP["value"]['ctg_mem_stat']  : '';
        $ctg_mem_fec = isset($rTMP["value"]['ctg_mem_fec']) ? $rTMP["value"]['ctg_mem_fec']  : '';
        $ctg_mem_fec_venc = isset($rTMP["value"]['ctg_mem_fec_venc']) ? $rTMP["value"]['ctg_mem_fec_venc']  : '';
        $ctg_mem_formpag = isset($rTMP["value"]['ctg_mem_formpag']) ? $rTMP["value"]['ctg_mem_formpag']  : '';
        $ctg_mem_valor = isset($rTMP["value"]['ctg_mem_valor']) ? $rTMP["value"]['ctg_mem_valor']  : '';
        $ctg_mem_cuotas = isset($rTMP["value"]['ctg_mem_cuotas']) ? $rTMP["value"]['ctg_mem_cuotas']  : '';
        $ctg_mem_depban = isset($rTMP["value"]['ctg_mem_depban']) ? $rTMP["value"]['ctg_mem_depban']  : '';
        $ctg_mem_depnum = isset($rTMP["value"]['ctg_mem_depnum']) ? $rTMP["value"]['ctg_mem_depnum']  : '';
        $ctg_mem_depdt = isset($rTMP["value"]['ctg_mem_depdt']) ? $rTMP["value"]['ctg_mem_depdt']  : '';
        $ctg_mem_ccaban = isset($rTMP["value"]['ctg_mem_ccaban']) ? $rTMP["value"]['ctg_mem_ccaban']  : '';
        $ctg_mem_ccabancta = isset($rTMP["value"]['ctg_mem_ccabancta']) ? $rTMP["value"]['ctg_mem_ccabancta']  : '';
        $ctg_mem_ccacuotas = isset($rTMP["value"]['ctg_mem_ccacuotas']) ? $rTMP["value"]['ctg_mem_ccacuotas']  : '';
        $ctg_mem_ccavalor = isset($rTMP["value"]['ctg_mem_ccavalor']) ? $rTMP["value"]['ctg_mem_ccavalor']  : '';
        $ctg_mem_estatus = isset($rTMP["value"]['ctg_mem_estatus']) ? $rTMP["value"]['ctg_mem_estatus']  : '';
        $ctg_mem_sta = isset($rTMP["value"]['ctg_mem_sta']) ? $rTMP["value"]['ctg_mem_sta']  : '';
        $ctg_mem_usr = isset($rTMP["value"]['ctg_mem_usr']) ? $rTMP["value"]['ctg_mem_usr']  : '';
        $ctg_mem_dt = isset($rTMP["value"]['ctg_mem_dt']) ? $rTMP["value"]['ctg_mem_dt']  : '';


        if($ctg_mem_formpag == 0){
            $ctg_mem_formpag = 'GRATIS';
        }else{
            $ctg_mem_formpag = 'PAGO';
        }
    }
}

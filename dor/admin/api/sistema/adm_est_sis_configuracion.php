<?php

if (isset($_GET["validaciones"]) && !empty($_GET["validaciones"])) {

    require_once '../../../api/globalFunctions.php';
    require_once '../../../data/conexion/tmfAdm.php';
    require_once '../../../api/config.php';

    $id = isset($_POST["codeId"]) ? $_POST["codeId"]  : '';
    $adm_cfg_cou = isset($_POST["adm_cfg_cou"]) ? $_POST["adm_cfg_cou"]  : '';
    $adm_cfg_cou_name = isset($_POST["adm_cfg_cou_name"]) ? $_POST["adm_cfg_cou_name"]  : '';
    $adm_cfg_lang = isset($_POST["adm_cfg_lang"]) ? $_POST["adm_cfg_lang"]  : '';
    $adm_cfg_cor_con_med = isset($_POST["adm_cfg_cor_con_med"]) ? $_POST["adm_cfg_cor_con_med"]  : '';
    $adm_cfg_cor_con_far = isset($_POST["adm_cfg_cor_con_far"]) ? $_POST["adm_cfg_cor_con_far"]  : '';
    $adm_cfg_cor_con_pac = isset($_POST["adm_cfg_cor_con_pac"]) ? $_POST["adm_cfg_cor_con_pac"]  : '';
    $adm_cfg_cor_con_laf = isset($_POST["adm_cfg_cor_con_laf"]) ? $_POST["adm_cfg_cor_con_laf"]  : '';
    $adm_cfg_cor_con_cli = isset($_POST["adm_cfg_cor_con_cli"]) ? $_POST["adm_cfg_cor_con_cli"]  : '';
    $adm_cfg_cor_con_ase = isset($_POST["adm_cfg_cor_con_ase"]) ? $_POST["adm_cfg_cor_con_ase"]  : '';
    $adm_cfg_cor_con_hos = isset($_POST["adm_cfg_cor_con_hos"]) ? $_POST["adm_cfg_cor_con_hos"]  : '';
    $amd_cfg_ip1 = isset($_POST["amd_cfg_ip1"]) ? $_POST["amd_cfg_ip1"]  : '';
    $adm_cfg_passw = isset($_POST["adm_cfg_passw"]) ? $_POST["adm_cfg_passw"]  : '';
    $adm_cfg_email_gerencia = isset($_POST["adm_cfg_email_gerencia"]) ? $_POST["adm_cfg_email_gerencia"]  : '';
    $adm_cfg_email_ventas = isset($_POST["adm_cfg_email_ventas"]) ? $_POST["adm_cfg_email_ventas"]  : '';
    $adm_cfg_email_conta = isset($_POST["adm_cfg_email_conta"]) ? $_POST["adm_cfg_email_conta"]  : '';
    $adm_cfg_email_tecnicos = isset($_POST["adm_cfg_email_tecnicos"]) ? $_POST["adm_cfg_email_tecnicos"]  : '';
    $adm_cfg_email_publicidad = isset($_POST["adm_cfg_email_publicidad"]) ? $_POST["adm_cfg_email_publicidad"]  : '';
    $adm_cfg_acceso = isset($_POST["adm_cfg_acceso"]) ? $_POST["adm_cfg_acceso"]  : '';
    $adm_cfg_sistema = isset($_POST["adm_cfg_sistema"]) ? $_POST["adm_cfg_sistema"]  : '';
    $adm_cfg_weblink1 = isset($_POST["adm_cfg_weblink1"]) ? $_POST["adm_cfg_weblink1"]  : '';
    $adm_cfg_weblink2 = isset($_POST["adm_cfg_weblink2"]) ? $_POST["adm_cfg_weblink2"]  : '';
    $adm_cfg_chat = isset($_POST["adm_cfg_chat"]) ? $_POST["adm_cfg_chat"]  : '';
    $adm_cfg_anuncios = isset($_POST["adm_cfg_anuncios"]) ? $_POST["adm_cfg_anuncios"]  : '';
    $adm_cfg_regpac = isset($_POST["adm_cfg_regpac"]) ? $_POST["adm_cfg_regpac"]  : '';
    $adm_cfg_regmed = isset($_POST["adm_cfg_regmed"]) ? $_POST["adm_cfg_regmed"]  : '';
    $adm_cfg_regfar = isset($_POST["adm_cfg_regfar"]) ? $_POST["adm_cfg_regfar"]  : '';
    $adm_cfg_reglab = isset($_POST["adm_cfg_reglab"]) ? $_POST["adm_cfg_reglab"]  : '';
    $adm_cfg_reghos = isset($_POST["adm_cfg_reghos"]) ? $_POST["adm_cfg_reghos"]  : '';
    $adm_cfg_reglaf = isset($_POST["adm_cfg_reglaf"]) ? $_POST["adm_cfg_reglaf"]  : '';
    $adm_cfg_regase = isset($_POST["adm_cfg_regase"]) ? $_POST["adm_cfg_regase"]  : '';
    $adm_cfg_regpub = isset($_POST["adm_cfg_regpub"]) ? $_POST["adm_cfg_regpub"]  : '';
    $adm_cfg_last_date = isset($_POST["adm_cfg_last_date"]) ? $_POST["adm_cfg_last_date"]  : '';


    $strTipoValidacion = isset($_REQUEST["validaciones"]) ? $_REQUEST["validaciones"] : '';
    if ($strTipoValidacion == "proces") {

        header('Content-Type: application/json');

        $val = 1;
        $var_ase_sulta = "UPDATE adm_config SET adm_cfg_cou = '$adm_cfg_cou',adm_cfg_cou_name = '$adm_cfg_cou_name',adm_cfg_lang = '$adm_cfg_lang',adm_cfg_cor_con_med = $adm_cfg_cor_con_med,adm_cfg_cor_con_far = $adm_cfg_cor_con_far,adm_cfg_cor_con_pac = $adm_cfg_cor_con_pac,adm_cfg_cor_con_laf = $adm_cfg_cor_con_laf,adm_cfg_cor_con_cli = $adm_cfg_cor_con_cli,adm_cfg_cor_con_ase = $adm_cfg_cor_con_ase,adm_cfg_cor_con_hos = $adm_cfg_cor_con_hos,amd_cfg_ip1 = '$amd_cfg_ip1',adm_cfg_passw = '$adm_cfg_passw',adm_cfg_email_gerencia = '$adm_cfg_email_gerencia',adm_cfg_email_ventas = '$adm_cfg_email_ventas',adm_cfg_email_conta = '$adm_cfg_email_conta',adm_cfg_email_tecnicos = '$adm_cfg_email_tecnicos',adm_cfg_email_publicidad = '$adm_cfg_email_publicidad',adm_cfg_acceso = $adm_cfg_acceso,adm_cfg_sistema = '$adm_cfg_sistema',adm_cfg_weblink1 = '$adm_cfg_weblink1',adm_cfg_weblink2 = '$adm_cfg_weblink2',adm_cfg_chat = $adm_cfg_chat,adm_cfg_anuncios = $adm_cfg_anuncios,adm_cfg_regpac = $adm_cfg_regpac,adm_cfg_regmed = $adm_cfg_regmed,adm_cfg_regfar = $adm_cfg_regfar,adm_cfg_reglab = $adm_cfg_reglab,adm_cfg_reghos = $adm_cfg_reghos,adm_cfg_reglaf = $adm_cfg_reglaf,adm_cfg_regase = $adm_cfg_regase,adm_cfg_regpub = $adm_cfg_regpub,adm_cfg_last_date = '$adm_cfg_last_date' WHERE id = $id;";
        if (pg_query($rmfAdm, $var_ase_sulta)) {
            $arrInfo['status'] = $val;
        } else {
            $arrInfo['status'] = 0;
            $arrInfo['error'] = $var_ase_sulta;
        }

        print json_encode($arrInfo);

        die();
    }
    die();
}

require_once '../../../api/globalFunctions.php';
require_once '../../../data/conexion/tmfAdm.php';
require_once '../../../api/config.php';

$arrConfig = array();
$var_consulta = "SELECT * FROM adm_config";

$qTMP = pg_query($rmfAdm, $var_consulta);
//echo $var_consulta;
while ($rTMP = pg_fetch_assoc($qTMP)) {

    $arrConfig[$rTMP["id"]]["id"]          = $rTMP["id"];
    $arrConfig[$rTMP["id"]]["adm_cfg_cou"]          = $rTMP["adm_cfg_cou"];
    $arrConfig[$rTMP["id"]]["adm_cfg_cou_name"]          = $rTMP["adm_cfg_cou_name"];
    $arrConfig[$rTMP["id"]]["adm_cfg_lang"]          = $rTMP["adm_cfg_lang"];
    $arrConfig[$rTMP["id"]]["adm_cfg_cor_con_med"]          = $rTMP["adm_cfg_cor_con_med"];
    $arrConfig[$rTMP["id"]]["adm_cfg_cor_con_far"]          = $rTMP["adm_cfg_cor_con_far"];
    $arrConfig[$rTMP["id"]]["adm_cfg_cor_con_pac"]          = $rTMP["adm_cfg_cor_con_pac"];
    $arrConfig[$rTMP["id"]]["adm_cfg_cor_con_laf"]          = $rTMP["adm_cfg_cor_con_laf"];
    $arrConfig[$rTMP["id"]]["adm_cfg_cor_con_cli"]          = $rTMP["adm_cfg_cor_con_cli"];
    $arrConfig[$rTMP["id"]]["adm_cfg_cor_con_ase"]          = $rTMP["adm_cfg_cor_con_ase"];
    $arrConfig[$rTMP["id"]]["adm_cfg_cor_con_hos"]          = $rTMP["adm_cfg_cor_con_hos"];
    $arrConfig[$rTMP["id"]]["amd_cfg_ip1"]          = $rTMP["amd_cfg_ip1"];
    $arrConfig[$rTMP["id"]]["adm_cfg_passw"]          = $rTMP["adm_cfg_passw"];
    $arrConfig[$rTMP["id"]]["adm_cfg_email_gerencia"]          = $rTMP["adm_cfg_email_gerencia"];
    $arrConfig[$rTMP["id"]]["adm_cfg_email_ventas"]          = $rTMP["adm_cfg_email_ventas"];
    $arrConfig[$rTMP["id"]]["adm_cfg_email_conta"]          = $rTMP["adm_cfg_email_conta"];
    $arrConfig[$rTMP["id"]]["adm_cfg_email_tecnicos"]          = $rTMP["adm_cfg_email_tecnicos"];
    $arrConfig[$rTMP["id"]]["adm_cfg_email_publicidad"]          = $rTMP["adm_cfg_email_publicidad"];
    $arrConfig[$rTMP["id"]]["adm_cfg_acceso"]          = $rTMP["adm_cfg_acceso"];
    $arrConfig[$rTMP["id"]]["adm_cfg_sistema"]          = $rTMP["adm_cfg_sistema"];
    $arrConfig[$rTMP["id"]]["adm_cfg_weblink1"]          = $rTMP["adm_cfg_weblink1"];
    $arrConfig[$rTMP["id"]]["adm_cfg_weblink2"]          = $rTMP["adm_cfg_weblink2"];
    $arrConfig[$rTMP["id"]]["adm_cfg_chat"]          = $rTMP["adm_cfg_chat"];
    $arrConfig[$rTMP["id"]]["adm_cfg_anuncios"]          = $rTMP["adm_cfg_anuncios"];
    $arrConfig[$rTMP["id"]]["adm_cfg_regpac"]          = $rTMP["adm_cfg_regpac"];
    $arrConfig[$rTMP["id"]]["adm_cfg_regmed"]          = $rTMP["adm_cfg_regmed"];
    $arrConfig[$rTMP["id"]]["adm_cfg_regfar"]          = $rTMP["adm_cfg_regfar"];
    $arrConfig[$rTMP["id"]]["adm_cfg_reglab"]          = $rTMP["adm_cfg_reglab"];
    $arrConfig[$rTMP["id"]]["adm_cfg_reghos"]          = $rTMP["adm_cfg_reghos"];
    $arrConfig[$rTMP["id"]]["adm_cfg_reglaf"]          = $rTMP["adm_cfg_reglaf"];
    $arrConfig[$rTMP["id"]]["adm_cfg_regase"]          = $rTMP["adm_cfg_regase"];
    $arrConfig[$rTMP["id"]]["adm_cfg_regpub"]          = $rTMP["adm_cfg_regpub"];
    $arrConfig[$rTMP["id"]]["adm_cfg_last_date"]          = $rTMP["adm_cfg_last_date"];
}
pg_free_result($qTMP);

if (is_array($arrConfig) && (count($arrConfig) > 0)) {
    reset($arrConfig);
    foreach ($arrConfig as $rTMP['key'] => $rTMP['value']) {
        $id = isset($rTMP["value"]['id']) ? $rTMP["value"]['id'] : '';
        $adm_cfg_cou = isset($rTMP["value"]['adm_cfg_cou']) ? $rTMP["value"]['adm_cfg_cou'] : '';
        $adm_cfg_cou_name = isset($rTMP["value"]['adm_cfg_cou_name']) ? $rTMP["value"]['adm_cfg_cou_name'] : '';
        $adm_cfg_lang = isset($rTMP["value"]['adm_cfg_lang']) ? $rTMP["value"]['adm_cfg_lang'] : '';
        $adm_cfg_cor_con_med = isset($rTMP["value"]['adm_cfg_cor_con_med']) ? $rTMP["value"]['adm_cfg_cor_con_med'] : '';
        $adm_cfg_cor_con_far = isset($rTMP["value"]['adm_cfg_cor_con_far']) ? $rTMP["value"]['adm_cfg_cor_con_far'] : '';
        $adm_cfg_cor_con_pac = isset($rTMP["value"]['adm_cfg_cor_con_pac']) ? $rTMP["value"]['adm_cfg_cor_con_pac'] : '';
        $adm_cfg_cor_con_laf = isset($rTMP["value"]['adm_cfg_cor_con_laf']) ? $rTMP["value"]['adm_cfg_cor_con_laf'] : '';
        $adm_cfg_cor_con_cli = isset($rTMP["value"]['adm_cfg_cor_con_cli']) ? $rTMP["value"]['adm_cfg_cor_con_cli'] : '';
        $adm_cfg_cor_con_ase = isset($rTMP["value"]['adm_cfg_cor_con_ase']) ? $rTMP["value"]['adm_cfg_cor_con_ase'] : '';
        $adm_cfg_cor_con_hos = isset($rTMP["value"]['adm_cfg_cor_con_hos']) ? $rTMP["value"]['adm_cfg_cor_con_hos'] : '';
        $amd_cfg_ip1 = isset($rTMP["value"]['amd_cfg_ip1']) ? $rTMP["value"]['amd_cfg_ip1'] : '';
        $adm_cfg_passw = isset($rTMP["value"]['adm_cfg_passw']) ? $rTMP["value"]['adm_cfg_passw'] : '';
        $adm_cfg_email_gerencia = isset($rTMP["value"]['adm_cfg_email_gerencia']) ? $rTMP["value"]['adm_cfg_email_gerencia'] : '';
        $adm_cfg_email_ventas = isset($rTMP["value"]['adm_cfg_email_ventas']) ? $rTMP["value"]['adm_cfg_email_ventas'] : '';
        $adm_cfg_email_conta = isset($rTMP["value"]['adm_cfg_email_conta']) ? $rTMP["value"]['adm_cfg_email_conta'] : '';
        $adm_cfg_email_tecnicos = isset($rTMP["value"]['adm_cfg_email_tecnicos']) ? $rTMP["value"]['adm_cfg_email_tecnicos'] : '';
        $adm_cfg_email_publicidad = isset($rTMP["value"]['adm_cfg_email_publicidad']) ? $rTMP["value"]['adm_cfg_email_publicidad'] : '';
        $adm_cfg_acceso = isset($rTMP["value"]['adm_cfg_acceso']) ? $rTMP["value"]['adm_cfg_acceso'] : '';
        $adm_cfg_sistema = isset($rTMP["value"]['adm_cfg_sistema']) ? $rTMP["value"]['adm_cfg_sistema'] : '';
        $adm_cfg_weblink1 = isset($rTMP["value"]['adm_cfg_weblink1']) ? $rTMP["value"]['adm_cfg_weblink1'] : '';
        $adm_cfg_weblink2 = isset($rTMP["value"]['adm_cfg_weblink2']) ? $rTMP["value"]['adm_cfg_weblink2'] : '';
        $adm_cfg_chat = isset($rTMP["value"]['adm_cfg_chat']) ? $rTMP["value"]['adm_cfg_chat'] : '';
        $adm_cfg_anuncios = isset($rTMP["value"]['adm_cfg_anuncios']) ? $rTMP["value"]['adm_cfg_anuncios'] : '';
        $adm_cfg_regpac = isset($rTMP["value"]['adm_cfg_regpac']) ? $rTMP["value"]['adm_cfg_regpac'] : '';
        $adm_cfg_regmed = isset($rTMP["value"]['adm_cfg_regmed']) ? $rTMP["value"]['adm_cfg_regmed'] : '';
        $adm_cfg_regfar = isset($rTMP["value"]['adm_cfg_regfar']) ? $rTMP["value"]['adm_cfg_regfar'] : '';
        $adm_cfg_reglab = isset($rTMP["value"]['adm_cfg_reglab']) ? $rTMP["value"]['adm_cfg_reglab'] : '';
        $adm_cfg_reghos = isset($rTMP["value"]['adm_cfg_reghos']) ? $rTMP["value"]['adm_cfg_reghos'] : '';
        $adm_cfg_reglaf = isset($rTMP["value"]['adm_cfg_reglaf']) ? $rTMP["value"]['adm_cfg_reglaf'] : '';
        $adm_cfg_regase = isset($rTMP["value"]['adm_cfg_regase']) ? $rTMP["value"]['adm_cfg_regase'] : '';
        $adm_cfg_regpub = isset($rTMP["value"]['adm_cfg_regpub']) ? $rTMP["value"]['adm_cfg_regpub'] : '';
        $adm_cfg_last_date = isset($rTMP["value"]['adm_cfg_last_date']) ? $rTMP["value"]['adm_cfg_last_date'] : '';

    }
}

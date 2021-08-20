<?PHP

$arrTableConfig = array();
$var_consulta = "SELECT * FROM adm_config";
$sql = pg_query($rmfAdm, $var_consulta);

while ($rTMP = pg_fetch_assoc($sql)) {
    $arrTableConfig[$rTMP["id"]]["id"]                    = $rTMP["id"];
    $arrTableConfig[$rTMP["id"]]["adm_cfg_cou"]            = $rTMP["adm_cfg_cou"];
    $arrTableConfig[$rTMP["id"]]["adm_cfg_cou_name"]    = $rTMP["adm_cfg_cou_name"];
    $arrTableConfig[$rTMP["id"]]["adm_cfg_lang"]        = $rTMP["adm_cfg_lang"];
    $arrTableConfig[$rTMP["id"]]["adm_cfg_anuncios"]    = $rTMP["adm_cfg_anuncios"];
    $arrTableConfig[$rTMP["id"]]["adm_cfg_weblink2"]    = $rTMP["adm_cfg_weblink2"];
    $arrTableConfig[$rTMP["id"]]["adm_cfg_weblink1"]    = $rTMP["adm_cfg_weblink1"];

    $arrTableConfig[$rTMP["id"]]["adm_cfg_regpac"]    = $rTMP["adm_cfg_regpac"];
    $arrTableConfig[$rTMP["id"]]["adm_cfg_regmed"]    = $rTMP["adm_cfg_regmed"];
    $arrTableConfig[$rTMP["id"]]["adm_cfg_regfar"]    = $rTMP["adm_cfg_regfar"];
    $arrTableConfig[$rTMP["id"]]["adm_cfg_reglab"]    = $rTMP["adm_cfg_reglab"];
    $arrTableConfig[$rTMP["id"]]["adm_cfg_reghos"]    = $rTMP["adm_cfg_reghos"];
    $arrTableConfig[$rTMP["id"]]["adm_cfg_reglaf"]    = $rTMP["adm_cfg_reglaf"];
    $arrTableConfig[$rTMP["id"]]["adm_cfg_regase"]    = $rTMP["adm_cfg_regase"];
    $arrTableConfig[$rTMP["id"]]["adm_cfg_regpub"]    = $rTMP["adm_cfg_regpub"];
}
pg_free_result($sql);

if (is_array($arrTableConfig) && (count($arrTableConfig) > 0)) {
    reset($arrTableConfig);
    foreach ($arrTableConfig as $rTMP['key'] => $rTMP['value']) {
        $paisName = isset($rTMP["value"]['adm_cfg_cou_name']) ? $rTMP["value"]['adm_cfg_cou_name']  : '';
        $lan = isset($rTMP["value"]['adm_cfg_lang']) ? $rTMP["value"]['adm_cfg_lang']  : '';
        $anuncios = isset($rTMP["value"]['adm_cfg_anuncios']) ? $rTMP["value"]['adm_cfg_anuncios']  : '';
        $url = isset($rTMP["value"]['adm_cfg_weblink2']) ? $rTMP["value"]['adm_cfg_weblink2']  : '';
        $urlAdm = isset($rTMP["value"]['adm_cfg_weblink1']) ? $rTMP["value"]['adm_cfg_weblink1']  : '';
        $paisDrop  = isset($rTMP["value"]['adm_cfg_cou']) ? $rTMP["value"]['adm_cfg_cou']  : '';

        //Vaiables de boton registro en login

        $RegPac = isset($rTMP["value"]['adm_cfg_regpac']) ? $rTMP["value"]['adm_cfg_regpac']  : 0;
        $RegMed = isset($rTMP["value"]['adm_cfg_regmed']) ? $rTMP["value"]['adm_cfg_regmed']  : 0;
        $RegFar = isset($rTMP["value"]['adm_cfg_regfar']) ? $rTMP["value"]['adm_cfg_regfar']  : 0;
        $RegCli = isset($rTMP["value"]['adm_cfg_reglab']) ? $rTMP["value"]['adm_cfg_reglab']  : 0;
        $RegHos = isset($rTMP["value"]['adm_cfg_reghos']) ? $rTMP["value"]['adm_cfg_reghos']  : 0;
        $RegLaf = isset($rTMP["value"]['adm_cfg_reglaf']) ? $rTMP["value"]['adm_cfg_reglaf']  : 0;
        $RegAse = isset($rTMP["value"]['adm_cfg_regase']) ? $rTMP["value"]['adm_cfg_regase']  : 0;
        $RegPub = isset($rTMP["value"]['adm_cfg_regpub']) ? $rTMP["value"]['adm_cfg_regpub']  : 0;
    }
}

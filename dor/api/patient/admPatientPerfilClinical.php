<?php
if (isset($_GET["validaciones"]) && !empty($_GET["validaciones"])) {
    require_once "../../api/globalFunctions.php";
    require_once "../../data/conexion/tmfAdm.php";
    require_once "../../api/config.php";

    $insert = 1;
    $update = 2;
    $delete = 3;

    $idUsuario_ = isset($_POST["id_url"]) ? $_POST["id_url"]  : '';
    $idUser = $_SESSION['adm_usr_code'];

    $dia = isset($_POST["dia"]) ? $_POST["dia"]  : 01;
    $mes = isset($_POST["mes"]) ? $_POST["mes"]  : 01;
    $año = isset($_POST["año"]) ? $_POST["año"]  : 0000 - 0000;

    $peso = isset($_POST["peso"]) ? $_POST["peso"]  : NULL;
    $estatura = isset($_POST["estatura"]) ? $_POST["estatura"]  : NULL;
    $tip_sangre = isset($_POST["tip_sangre"]) ? $_POST["tip_sangre"]  : NULL;

    $alergias_c = isset($_POST["alergias_c"]) ? $_POST["alergias_c"]  : 0;
    $alergias = isset($_POST["alergias"]) ? $_POST["alergias"]  : '';
    $enfermedades_c = isset($_POST["enfermedades_c"]) ? $_POST["enfermedades_c"]  : 0;
    $enfermedades = isset($_POST["enfermedades"]) ? $_POST["enfermedades"]  : '';
    $medicamento_c = isset($_POST["medicamento_c"]) ? $_POST["medicamento_c"]  : 0;
    $medicamento = isset($_POST["medicamento"]) ? $_POST["medicamento"]  : '';
    $hipertension_c = isset($_POST["hipertension_c"]) ? $_POST["hipertension_c"]  : 0;
    $hipertension = isset($_POST["hipertension"]) ? $_POST["hipertension"]  : '';
    $vih_c = isset($_POST["vih_c"]) ? $_POST["vih_c"]  : 0;
    $vih = isset($_POST["vih"]) ? $_POST["vih"]  : '';
    $parkinson_c = isset($_POST["parkinson_c"]) ? $_POST["parkinson_c"]  : 0;
    $parkinson = isset($_POST["parkinson"]) ? $_POST["parkinson"]  : '';
    $epoc_c = isset($_POST["epoc_c"]) ? $_POST["epoc_c"]  : 0;
    $epoc = isset($_POST["epoc"]) ? $_POST["epoc"]  : '';
    $tbc_c = isset($_POST["tbc_c"]) ? $_POST["tbc_c"]  : 0;
    $tbc = isset($_POST["tbc"]) ? $_POST["tbc"]  : '';
    $demencias_c = isset($_POST["demencias_c"]) ? $_POST["demencias_c"]  : 0;
    $demencias = isset($_POST["demencias"]) ? $_POST["demencias"]  : '';
    $diabetes_c = isset($_POST["diabetes_c"]) ? $_POST["diabetes_c"]  : 0;
    $diabetes = isset($_POST["diabetes"]) ? $_POST["diabetes"]  : '';
    $acv_c = isset($_POST["acv_c"]) ? $_POST["acv_c"]  : 0;
    $acv = isset($_POST["acv"]) ? $_POST["acv"]  : '';
    $terminal_c = isset($_POST["terminal_c"]) ? $_POST["terminal_c"]  : 0;
    $terminal = isset($_POST["terminal"]) ? $_POST["terminal"]  : '';
    $insuficiencia_c = isset($_POST["insuficiencia_c"]) ? $_POST["insuficiencia_c"]  : 0;
    $insuficiencia = isset($_POST["insuficiencia"]) ? $_POST["insuficiencia"]  : '';
    $iam_c = isset($_POST["iam_c"]) ? $_POST["iam_c"]  : 0;
    $iam = isset($_POST["iam"]) ? $_POST["iam"]  : '';
    $otr_c = isset($_POST["otr_c"]) ? $_POST["otr_c"]  : 0;
    $otr = isset($_POST["otr"]) ? $_POST["otr"]  : '';
    $region = isset($_POST["region"]) ? $_POST["region"]  : '';
    $distrito = isset($_POST["distrito"]) ? $_POST["distrito"]  : '';

    $status = 2;
    $fecha = date('Y-m-d H:i:s');
    $usuario = $_SESSION['adm_usr_id'];

    $strTipoValidacion = isset($_REQUEST["validaciones"]) ? $_REQUEST["validaciones"] : '';

    if ($strTipoValidacion == "update") {
        header('Content-Type: application/json');
        $val = 1;
        $var_consulta = " UPDATE ctg_pacientes SET ctg_pac_dep = '$region',ctg_pac_mun = '$distrito',ctg_pac_nac_dia = $dia,ctg_pac_nac_mes = $mes,ctg_pac_nac_ano = $año,ctg_pac_pcl_peso = $peso,ctg_pac_pcl_esta = $estatura ,ctg_pac_pcl_tpsa = $tip_sangre,ctg_pac_pcl_aler = $alergias_c,ctg_pac_pcl_aler_desc = '$alergias',ctg_pac_pcl_enfe = $enfermedades_c,ctg_pac_pcl_enfe_desc = '$enfermedades',ctg_pac_pcl_medi = $medicamento_c,ctg_pac_pcl_medi_desc = '$medicamento',ctg_pac_pcl_hipe = $hipertension_c,ctg_pac_pcl_hipe_desc = '$hipertension',ctg_pac_pcl_vih = $vih_c,ctg_pac_pcl_vih_desc = '$vih',ctg_pac_pcl_park = $parkinson_c,ctg_pac_pcl_park_desc = '$parkinson',ctg_pac_pcl_epoc = $epoc_c,ctg_pac_pcl_epoc_desc = '$epoc',ctg_pac_pcl_tbc = $tbc_c,ctg_pac_pcl_tbc_desc = '$tbc',ctg_pac_pcl_deme = $demencias_c,ctg_pac_pcl_deme_desc = '$demencias',ctg_pac_pcl_diab = $diabetes_c,ctg_pac_pcl_diab_desc = '$diabetes',ctg_pac_pcl_acv = $acv_c,ctg_pac_pcl_acv_desc = '$acv',ctg_pac_pcl_enft = $terminal_c,ctg_pac_pcl_enft_desc = '$terminal',ctg_pac_pcl_insr = $insuficiencia_c,ctg_pac_pcl_insr_desc = '$insuficiencia',ctg_pac_pcl_iamicc = $iam_c,ctg_pac_pcl_iamicc_desc = '$iam',ctg_pac_pcl_otra = $otr_c,ctg_pac_pcl_otra_desc = '$otr',ctg_pac_sta = '$status',ctg_pac_dt = '$fecha' WHERE ctg_pac_code = $idUser;";
        if (pg_query($rmfAdm, $var_consulta)) {
            $arrInfo['status'] = $val;
        } else {
            $arrInfo['status'] = 0;
            $arrInfo['error'] = $var_consulta;
        }
        print json_encode($arrInfo);
        die();
    } else if ($strTipoValidacion == "dibujo_dropdow_dep") {
        require_once "../../data/conexion/tmfWeb.php";

        $arrDepartamento = array();
        $var_consulta = "SELECT * 
                        FROM ctg_geografia 
                        WHERE  length(geo_id) <= 3
                        AND geo_pais = '$paisDrop'
                        ORDER BY geo_parent";
        $sql = pg_query($tmfWeb, $var_consulta);
        $totalArticle = pg_num_rows($sql);


        while ($rTMP = pg_fetch_assoc($sql)) {

            $arrDepartamento[$rTMP["id"]]["id"]                                         = $rTMP["id"];
            $arrDepartamento[$rTMP["id"]]["geo_id"]                                         = $rTMP["geo_id"];
            $arrDepartamento[$rTMP["id"]]["geo_desc"]                                         = $rTMP["geo_desc"];
            $arrDepartamento[$rTMP["id"]]["geo_obs"]                                         = $rTMP["geo_obs"];
            $arrDepartamento[$rTMP["id"]]["geo_parent"]                                         = $rTMP["geo_parent"];
            $arrDepartamento[$rTMP["id"]]["geo_moneda"]                                         = $rTMP["geo_moneda"];
            $arrDepartamento[$rTMP["id"]]["geo_cambio"]                                         = $rTMP["geo_cambio"];
            $arrDepartamento[$rTMP["id"]]["geo_cambio_dt"]                                         = $rTMP["geo_cambio_dt"];
            $arrDepartamento[$rTMP["id"]]["geo_sta"]                                         = $rTMP["geo_sta"];
            $arrDepartamento[$rTMP["id"]]["geo_usr"]                                         = $rTMP["geo_usr"];
            $arrDepartamento[$rTMP["id"]]["geo_dt"]                                         = $rTMP["geo_dt"];
            $arrDepartamento[$rTMP["id"]]["geo_pais"]                                         = $rTMP["geo_pais"];
            $arrDepartamento[$rTMP["id"]]["geo_tel"]                                         = $rTMP["geo_tel"];
            $arrDepartamento[$rTMP["id"]]["geo_flag"]                                         = $rTMP["geo_flag"];
        }
        pg_free_result($sql);

?>
        <option value="0">Seleccionar</option>
        <?php
        if (is_array($arrDepartamento) && (count($arrDepartamento) > 0)) {
            reset($arrDepartamento);
            foreach ($arrDepartamento as $rTMP['key'] => $rTMP['value']) {
        ?>
                <option value="<?php echo  $rTMP["value"]['geo_id']; ?>"><?php echo  $rTMP["value"]['geo_desc']; ?></option>

        <?PHP
            }
        }
        ?>
    <?php
        die();
    } else if ($strTipoValidacion == "dibujo_tip_sangre") {
        require_once "../../data/conexion/tmfAdm.php";
        $arrMunicipio = array();
        $var_consulta = "SELECT * 
                        FROM ctg_tipos_sangre 
                        ORDER BY id";
        $sql = pg_query($rmfAdm, $var_consulta);
        $totalArticle = pg_num_rows($sql);
        //print_r($sangre);


        while ($rTMP = pg_fetch_assoc($sql)) {

            $arrMunicipio[$rTMP["id"]]["id"]                                         = $rTMP["id"];
            $arrMunicipio[$rTMP["id"]]["ctg_tps_desc"]                                         = $rTMP["ctg_tps_desc"];
        }
        pg_free_result($sql);

    ?>
        <option value="0">Seleccionar</option>
        <?php
        if (is_array($arrMunicipio) && (count($arrMunicipio) > 0)) {
            reset($arrMunicipio);
            foreach ($arrMunicipio as $rTMP['key'] => $rTMP['value']) {
        ?>
                <option value="<?php echo  $rTMP["value"]['id']; ?>"><?php echo  $rTMP["value"]['ctg_tps_desc']; ?></option>

        <?PHP
            }
        }
        ?>
    <?php
        die();
    }else if ($strTipoValidacion == "dibujo_dropdow_mun") {
        require_once "../../data/conexion/tmfWeb.php";
        $strReg = isset($_POST["region"]) ? $_POST["region"]  : 1;

        $arrMunicipio = array();
        $var_consulta = "SELECT * 
                        FROM ctg_geografia 
                        WHERE  geo_pais = '$paisDrop'
                        AND geo_parent = '$strReg'
                        ORDER BY geo_id";
        $sql = pg_query($tmfWeb, $var_consulta);
        $totalArticle = pg_num_rows($sql);
       // print_r($var_consulta);


        while ($rTMP = pg_fetch_assoc($sql)) {

            $arrMunicipio[$rTMP["id"]]["id"]                                         = $rTMP["id"];
            $arrMunicipio[$rTMP["id"]]["geo_id"]                                         = $rTMP["geo_id"];
            $arrMunicipio[$rTMP["id"]]["geo_desc"]                                         = $rTMP["geo_desc"];
            $arrMunicipio[$rTMP["id"]]["geo_obs"]                                         = $rTMP["geo_obs"];
            $arrMunicipio[$rTMP["id"]]["geo_parent"]                                         = $rTMP["geo_parent"];
            $arrMunicipio[$rTMP["id"]]["geo_moneda"]                                         = $rTMP["geo_moneda"];
            $arrMunicipio[$rTMP["id"]]["geo_cambio"]                                         = $rTMP["geo_cambio"];
            $arrMunicipio[$rTMP["id"]]["geo_cambio_dt"]                                         = $rTMP["geo_cambio_dt"];
            $arrMunicipio[$rTMP["id"]]["geo_sta"]                                         = $rTMP["geo_sta"];
            $arrMunicipio[$rTMP["id"]]["geo_usr"]                                         = $rTMP["geo_usr"];
            $arrMunicipio[$rTMP["id"]]["geo_dt"]                                         = $rTMP["geo_dt"];
            $arrMunicipio[$rTMP["id"]]["geo_pais"]                                         = $rTMP["geo_pais"];
            $arrMunicipio[$rTMP["id"]]["geo_tel"]                                         = $rTMP["geo_tel"];
            $arrMunicipio[$rTMP["id"]]["geo_flag"]                                         = $rTMP["geo_flag"];
        }
        pg_free_result($sql);

    ?>
        <option value="0">Seleccionar</option>
        <?php
        if (is_array($arrMunicipio) && (count($arrMunicipio) > 0)) {
            reset($arrMunicipio);
            foreach ($arrMunicipio as $rTMP['key'] => $rTMP['value']) {
        ?>
                <option value="<?php echo  $rTMP["value"]['geo_id']; ?>"><?php echo  $rTMP["value"]['geo_desc']; ?></option>

        <?PHP
            }
        }
        ?>
<?php
        die();
    }

    die();
}

require_once "../../data/conexion/tmfAdm.php";
$UsuarioId = $_SESSION['adm_usr_code'];
$arrDataPerfilClinical = array();
$var_consulta = "SELECT * 
                    FROM ctg_pacientes 
                    WHERE ctg_pac_code = '$UsuarioId'
                    LIMIT 1";
$sql = pg_query($rmfAdm, $var_consulta);
$totalArticle = pg_num_rows($sql);


while ($rTMP = pg_fetch_assoc($sql)) {


    $arrDataPerfilClinical[$rTMP["id"]]["id"]                                         = $rTMP["id"];

    $arrDataPerfilClinical[$rTMP["id"]]["ctg_pac_sexo"]                               = $rTMP["ctg_pac_sexo"];
    $arrDataPerfilClinical[$rTMP["id"]]["ctg_pac_civil"]                              = $rTMP["ctg_pac_civil"];
    $arrDataPerfilClinical[$rTMP["id"]]["ctg_pac_nac_dia"]                            = $rTMP["ctg_pac_nac_dia"];
    $arrDataPerfilClinical[$rTMP["id"]]["ctg_pac_nac_mes"]                            = $rTMP["ctg_pac_nac_mes"];
    $arrDataPerfilClinical[$rTMP["id"]]["ctg_pac_nac_ano"]                            = $rTMP["ctg_pac_nac_ano"];
    $arrDataPerfilClinical[$rTMP["id"]]["ctg_pac_dir"]                                = $rTMP["ctg_pac_dir"];
    $arrDataPerfilClinical[$rTMP["id"]]["ctg_pac_zona"]                               = $rTMP["ctg_pac_zona"];
    $arrDataPerfilClinical[$rTMP["id"]]["ctg_pac_dep"]                                = $rTMP["ctg_pac_dep"];
    $arrDataPerfilClinical[$rTMP["id"]]["ctg_pac_mun"]                                = $rTMP["ctg_pac_mun"];


    $arrDataPerfilClinical[$rTMP["id"]]["ctg_pac_pcl_peso"]                               = $rTMP["ctg_pac_pcl_peso"];
    $arrDataPerfilClinical[$rTMP["id"]]["ctg_pac_pcl_esta"]                               = $rTMP["ctg_pac_pcl_esta"];
    $arrDataPerfilClinical[$rTMP["id"]]["ctg_pac_pcl_tpsa"]                               = $rTMP["ctg_pac_pcl_tpsa"];
    $arrDataPerfilClinical[$rTMP["id"]]["ctg_pac_pcl_aler"]                               = $rTMP["ctg_pac_pcl_aler"];
    $arrDataPerfilClinical[$rTMP["id"]]["ctg_pac_pcl_aler_desc"]                               = $rTMP["ctg_pac_pcl_aler_desc"];
    $arrDataPerfilClinical[$rTMP["id"]]["ctg_pac_pcl_enfe"]                               = $rTMP["ctg_pac_pcl_enfe"];
    $arrDataPerfilClinical[$rTMP["id"]]["ctg_pac_pcl_enfe_desc"]                               = $rTMP["ctg_pac_pcl_enfe_desc"];
    $arrDataPerfilClinical[$rTMP["id"]]["ctg_pac_pcl_medi"]                               = $rTMP["ctg_pac_pcl_medi"];
    $arrDataPerfilClinical[$rTMP["id"]]["ctg_pac_pcl_medi_desc"]                               = $rTMP["ctg_pac_pcl_medi_desc"];
    $arrDataPerfilClinical[$rTMP["id"]]["ctg_pac_pcl_hipe"]                               = $rTMP["ctg_pac_pcl_hipe"];
    $arrDataPerfilClinical[$rTMP["id"]]["ctg_pac_pcl_hipe_desc"]                               = $rTMP["ctg_pac_pcl_hipe_desc"];
    $arrDataPerfilClinical[$rTMP["id"]]["ctg_pac_pcl_vih"]                               = $rTMP["ctg_pac_pcl_vih"];
    $arrDataPerfilClinical[$rTMP["id"]]["ctg_pac_pcl_vih_desc"]                               = $rTMP["ctg_pac_pcl_vih_desc"];
    $arrDataPerfilClinical[$rTMP["id"]]["ctg_pac_pcl_park"]                               = $rTMP["ctg_pac_pcl_park"];
    $arrDataPerfilClinical[$rTMP["id"]]["ctg_pac_pcl_park_desc"]                               = $rTMP["ctg_pac_pcl_park_desc"];
    $arrDataPerfilClinical[$rTMP["id"]]["ctg_pac_pcl_epoc"]                               = $rTMP["ctg_pac_pcl_epoc"];
    $arrDataPerfilClinical[$rTMP["id"]]["ctg_pac_pcl_epoc_desc"]                               = $rTMP["ctg_pac_pcl_epoc_desc"];
    $arrDataPerfilClinical[$rTMP["id"]]["ctg_pac_pcl_tbc"]                               = $rTMP["ctg_pac_pcl_tbc"];
    $arrDataPerfilClinical[$rTMP["id"]]["ctg_pac_pcl_tbc_desc"]                               = $rTMP["ctg_pac_pcl_tbc_desc"];
    $arrDataPerfilClinical[$rTMP["id"]]["ctg_pac_pcl_deme"]                               = $rTMP["ctg_pac_pcl_deme"];
    $arrDataPerfilClinical[$rTMP["id"]]["ctg_pac_pcl_deme_desc"]                               = $rTMP["ctg_pac_pcl_deme_desc"];
    $arrDataPerfilClinical[$rTMP["id"]]["ctg_pac_pcl_diab"]                               = $rTMP["ctg_pac_pcl_diab"];
    $arrDataPerfilClinical[$rTMP["id"]]["ctg_pac_pcl_diab_desc"]                               = $rTMP["ctg_pac_pcl_diab_desc"];
    $arrDataPerfilClinical[$rTMP["id"]]["ctg_pac_pcl_acv"]                               = $rTMP["ctg_pac_pcl_acv"];
    $arrDataPerfilClinical[$rTMP["id"]]["ctg_pac_pcl_acv_desc"]                               = $rTMP["ctg_pac_pcl_acv_desc"];
    $arrDataPerfilClinical[$rTMP["id"]]["ctg_pac_pcl_enft"]                               = $rTMP["ctg_pac_pcl_enft"];
    $arrDataPerfilClinical[$rTMP["id"]]["ctg_pac_pcl_enft_desc"]                               = $rTMP["ctg_pac_pcl_enft_desc"];
    $arrDataPerfilClinical[$rTMP["id"]]["ctg_pac_pcl_insr"]                               = $rTMP["ctg_pac_pcl_insr"];
    $arrDataPerfilClinical[$rTMP["id"]]["ctg_pac_pcl_insr_desc"]                               = $rTMP["ctg_pac_pcl_insr_desc"];
    $arrDataPerfilClinical[$rTMP["id"]]["ctg_pac_pcl_iamicc"]                               = $rTMP["ctg_pac_pcl_iamicc"];
    $arrDataPerfilClinical[$rTMP["id"]]["ctg_pac_pcl_iamicc_desc"]                               = $rTMP["ctg_pac_pcl_iamicc_desc"];
    $arrDataPerfilClinical[$rTMP["id"]]["ctg_pac_pcl_otra"]                               = $rTMP["ctg_pac_pcl_otra"];
    $arrDataPerfilClinical[$rTMP["id"]]["ctg_pac_pcl_otra_desc"]                               = $rTMP["ctg_pac_pcl_otra_desc"];
}
pg_free_result($sql);
?>

<?php
if (is_array($arrDataPerfilClinical) && (count($arrDataPerfilClinical) > 0)) {
    reset($arrDataPerfilClinical);
    foreach ($arrDataPerfilClinical as $rTMP['key'] => $rTMP['value']) {

        $codUrl =  isset($rTMP["value"]['id']) ? $rTMP["value"]['id'] : '';
        $ctg_pac_sexo =  isset($rTMP["value"]['ctg_pac_sexo']) ? $rTMP["value"]['ctg_pac_sexo'] : '';
        $ctg_pac_civil =  isset($rTMP["value"]['ctg_pac_civil']) ? $rTMP["value"]['ctg_pac_civil'] : '';
        $ctg_pac_nac_dia =  isset($rTMP["value"]['ctg_pac_nac_dia']) ? $rTMP["value"]['ctg_pac_nac_dia'] : '';
        $ctg_pac_nac_mes =  isset($rTMP["value"]['ctg_pac_nac_mes']) ? $rTMP["value"]['ctg_pac_nac_mes'] : '';
        $ctg_pac_nac_ano =  isset($rTMP["value"]['ctg_pac_nac_ano']) ? $rTMP["value"]['ctg_pac_nac_ano'] : '';
        $ctg_pac_dir =  isset($rTMP["value"]['ctg_pac_dir']) ? $rTMP["value"]['ctg_pac_dir'] : '';
        $ctg_pac_zona =  isset($rTMP["value"]['ctg_pac_zona']) ? $rTMP["value"]['ctg_pac_zona'] : '';
        $ctg_pac_dep =  isset($rTMP["value"]['ctg_pac_dep']) ? $rTMP["value"]['ctg_pac_dep'] : '';
        $ctg_pac_mun =  isset($rTMP["value"]['ctg_pac_mun']) ? $rTMP["value"]['ctg_pac_mun'] : '';
        $ctg_pac_pcl_peso =  isset($rTMP["value"]['ctg_pac_pcl_peso']) ? $rTMP["value"]['ctg_pac_pcl_peso'] : '';
        $ctg_pac_pcl_esta =  isset($rTMP["value"]['ctg_pac_pcl_esta']) ? $rTMP["value"]['ctg_pac_pcl_esta'] : '';
        $ctg_pac_pcl_tpsa =  isset($rTMP["value"]['ctg_pac_pcl_tpsa']) ? $rTMP["value"]['ctg_pac_pcl_tpsa'] : '';
        $ctg_pac_pcl_aler =  isset($rTMP["value"]['ctg_pac_pcl_aler']) ? $rTMP["value"]['ctg_pac_pcl_aler'] : '';
        $ctg_pac_pcl_aler_desc =  isset($rTMP["value"]['ctg_pac_pcl_aler_desc']) ? $rTMP["value"]['ctg_pac_pcl_aler_desc'] : '';
        $ctg_pac_pcl_enfe =  isset($rTMP["value"]['ctg_pac_pcl_enfe']) ? $rTMP["value"]['ctg_pac_pcl_enfe'] : '';
        $ctg_pac_pcl_enfe_desc =  isset($rTMP["value"]['ctg_pac_pcl_enfe_desc']) ? $rTMP["value"]['ctg_pac_pcl_enfe_desc'] : '';
        $ctg_pac_pcl_medi =  isset($rTMP["value"]['ctg_pac_pcl_medi']) ? $rTMP["value"]['ctg_pac_pcl_medi'] : '';
        $ctg_pac_pcl_medi_desc =  isset($rTMP["value"]['ctg_pac_pcl_medi_desc']) ? $rTMP["value"]['ctg_pac_pcl_medi_desc'] : '';
        $ctg_pac_pcl_hipe =  isset($rTMP["value"]['ctg_pac_pcl_hipe']) ? $rTMP["value"]['ctg_pac_pcl_hipe'] : '';
        $ctg_pac_pcl_hipe_desc =  isset($rTMP["value"]['ctg_pac_pcl_hipe_desc']) ? $rTMP["value"]['ctg_pac_pcl_hipe_desc'] : '';
        $ctg_pac_pcl_vih =  isset($rTMP["value"]['ctg_pac_pcl_vih']) ? $rTMP["value"]['ctg_pac_pcl_vih'] : '';
        $ctg_pac_pcl_vih_desc =  isset($rTMP["value"]['ctg_pac_pcl_vih_desc']) ? $rTMP["value"]['ctg_pac_pcl_vih_desc'] : '';
        $ctg_pac_pcl_park =  isset($rTMP["value"]['ctg_pac_pcl_park']) ? $rTMP["value"]['ctg_pac_pcl_park'] : '';
        $ctg_pac_pcl_park_desc =  isset($rTMP["value"]['ctg_pac_pcl_park_desc']) ? $rTMP["value"]['ctg_pac_pcl_park_desc'] : '';
        $ctg_pac_pcl_epoc =  isset($rTMP["value"]['ctg_pac_pcl_epoc']) ? $rTMP["value"]['ctg_pac_pcl_epoc'] : '';
        $ctg_pac_pcl_epoc_desc =  isset($rTMP["value"]['ctg_pac_pcl_epoc_desc']) ? $rTMP["value"]['ctg_pac_pcl_epoc_desc'] : '';
        $ctg_pac_pcl_tbc =  isset($rTMP["value"]['ctg_pac_pcl_tbc']) ? $rTMP["value"]['ctg_pac_pcl_tbc'] : '';
        $ctg_pac_pcl_tbc_desc =  isset($rTMP["value"]['ctg_pac_pcl_tbc_desc']) ? $rTMP["value"]['ctg_pac_pcl_tbc_desc'] : '';
        $ctg_pac_pcl_deme =  isset($rTMP["value"]['ctg_pac_pcl_deme']) ? $rTMP["value"]['ctg_pac_pcl_deme'] : '';
        $ctg_pac_pcl_deme_desc =  isset($rTMP["value"]['ctg_pac_pcl_deme_desc']) ? $rTMP["value"]['ctg_pac_pcl_deme_desc'] : '';
        $ctg_pac_pcl_diab =  isset($rTMP["value"]['ctg_pac_pcl_diab']) ? $rTMP["value"]['ctg_pac_pcl_diab'] : '';
        $ctg_pac_pcl_diab_desc =  isset($rTMP["value"]['ctg_pac_pcl_diab_desc']) ? $rTMP["value"]['ctg_pac_pcl_diab_desc'] : '';
        $ctg_pac_pcl_acv =  isset($rTMP["value"]['ctg_pac_pcl_acv']) ? $rTMP["value"]['ctg_pac_pcl_acv'] : '';
        $ctg_pac_pcl_acv_desc =  isset($rTMP["value"]['ctg_pac_pcl_acv_desc']) ? $rTMP["value"]['ctg_pac_pcl_acv_desc'] : '';
        $ctg_pac_pcl_enft =  isset($rTMP["value"]['ctg_pac_pcl_enft']) ? $rTMP["value"]['ctg_pac_pcl_enft'] : '';
        $ctg_pac_pcl_enft_desc =  isset($rTMP["value"]['ctg_pac_pcl_enft_desc']) ? $rTMP["value"]['ctg_pac_pcl_enft_desc'] : '';
        $ctg_pac_pcl_insr =  isset($rTMP["value"]['ctg_pac_pcl_insr']) ? $rTMP["value"]['ctg_pac_pcl_insr'] : '';
        $ctg_pac_pcl_insr_desc =  isset($rTMP["value"]['ctg_pac_pcl_insr_desc']) ? $rTMP["value"]['ctg_pac_pcl_insr_desc'] : '';
        $ctg_pac_pcl_iamicc =  isset($rTMP["value"]['ctg_pac_pcl_iamicc']) ? $rTMP["value"]['ctg_pac_pcl_iamicc'] : '';
        $ctg_pac_pcl_iamicc_desc =  isset($rTMP["value"]['ctg_pac_pcl_iamicc_desc']) ? $rTMP["value"]['ctg_pac_pcl_iamicc_desc'] : '';
        $ctg_pac_pcl_otra =  isset($rTMP["value"]['ctg_pac_pcl_otra']) ? $rTMP["value"]['ctg_pac_pcl_otra'] : '';
        $ctg_pac_pcl_otra_desc =  isset($rTMP["value"]['ctg_pac_pcl_otra_desc']) ? $rTMP["value"]['ctg_pac_pcl_otra_desc'] : '';
        $departamento =  isset($rTMP["value"]['ctg_pac_dep']) ? $rTMP["value"]['ctg_pac_dep'] : '';
        $municipio =  isset($rTMP["value"]['ctg_pac_mun']) ? $rTMP["value"]['ctg_pac_mun'] : '';
    }
}
$year = date('Y');
$edad = $ctg_pac_nac_ano - $year;
?>
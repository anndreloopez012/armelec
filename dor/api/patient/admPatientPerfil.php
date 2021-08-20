<?php
if (isset($_GET["validaciones"]) && !empty($_GET["validaciones"])) {
    require_once "../../api/globalFunctions.php";
    require_once "../../data/conexion/tmfAdm.php";
    require_once "../../api/config.php";
    $idUsuario = 1;

    $id = isset($_POST["id"]) ? $_POST["id"]  : 0;
    $idMenbrecia = isset($_POST["id"]) ? $_POST["id"]  : 0;
    $med = 1;
    $rs = pg_query("SELECT ctg_pac_code FROM ctg_pacientes ORDER BY ctg_pac_code DESC LIMIT 1");
    if ($row = pg_fetch_array($rs)) {
        $idRow = trim($row[0]);
    }
    $idRow_ = isset($idRow) ? $idRow  : 0 + 1;

    $DocPersonal = isset($_POST["Hid_DocPersonal"]) ? $_POST["Hid_DocPersonal"]  : '';
    $Name = isset($_POST["Name"]) ? $_POST["Name"]  : '';
    $LastName = isset($_POST["LastName"]) ? $_POST["LastName"]  : '';
    $Sex = isset($_POST["Sex"]) ? $_POST["Sex"]  : 0;
    $Civil = isset($_POST["Sex"]) ? $_POST["Sex"]  : 0;
    $Pais = isset($_POST["Pais"]) ? $_POST["Pais"]  : 0;
    $Region = isset($_POST["region"]) ? $_POST["region"]  : 0;
    $Distri = isset($_POST["distrito"]) ? $_POST["distrito"]  : 0;
    $Tell = isset($_POST["Tell"]) ? $_POST["Tell"]  : 00000000;
    $TellCell = isset($_POST["Tell"]) ? $_POST["Tell"]  : 00000000;
    $Adress = isset($_POST["Adress"]) ? $_POST["Adress"]  : '';
    $Zona = isset($_POST["Zona"]) ? $_POST["Zona"]  : '';
    $Mail = isset($_POST["Mail"]) ? $_POST["Mail"]  : '';

    $Pass = isset($_POST["Mail"]) ? $_POST["Mail"]  : '';
    $UserName = isset($_POST["Mail"]) ? $_POST["Mail"]  : '';

    $FullName = isset($_POST["FullName"]) ? $_POST["FullName"]  : '';
    $Cell = isset($_POST["Cell"]) ? $_POST["Cell"]  : 00000000;
    $Email = isset($_POST["Email"]) ? $_POST["Email"]  : '';

    $status = 1; // estatus de afiliacion 
    $stat = 1;
    $fecha = date('Y-m-d H:i:s');
    $fechaD = date("d");
    $fechaM = date("m");
    $fechaA = date("Y");
    $usuario = $_SESSION['username'];
    $usuarioId = $_SESSION['adm_usr_id'];
    $usuarioCode = $_SESSION['adm_usr_code'];

    $pass = 0000000;

    $strTipoValidacion = isset($_REQUEST["validaciones"]) ? $_REQUEST["validaciones"] : '';

    if ($strTipoValidacion == "update") {
        header('Content-Type: application/json');
        $var_consulta = " UPDATE ctg_pacientes SET ctg_pac_dpi =' $DocPersonal', ctg_pac_codigo = '$DocPersonal',ctg_pac_nombres = '$Name',ctg_pac_apellidos = '$LastName', ctg_pac_sexo = '$Sex', ctg_pac_dir = '$Adress', ctg_pac_zona = '$Zona', ctg_pac_dep = '$Region', ctg_pac_mun = '$Distri', ctg_pac_telpar = '$Tell', ctg_pac_email = '$Mail' ,ctg_pac_eme_nombre = '$FullName' ,ctg_pac_eme_tels = '$Cell' ,ctg_pac_eme_email = '$Email' WHERE id = $id";
        $val = 1;
        if (pg_query($rmfAdm, $var_consulta)) {
            $arrInfo['status'] = $val;
        } else {
            $arrInfo['status'] = 0;
            $arrInfo['error'] = $var_consulta;
        }
        print json_encode($arrInfo);
        die();
    } else if ($strTipoValidacion == "busqueda_patient_adm") {
        $strFilter = "";
        if (!empty($strSearch)) {
            $strFilter = " WHERE ( UPPER(ctg_pac_nombres) LIKE UPPER('%{$strSearch}%' )) ";
        }
        $med = 1;
        $arrTablePatientGen = array();
        $var_consulta = "SELECT * 
                        FROM ctg_pacientes 
                        $strFilter 
                        WHERE ctg_pac_code =' $usuarioCode '
                        LIMIT 1";
        $sql = pg_query($rmfAdm, $var_consulta);
        $totalArticle = pg_num_rows($sql);
        //print_r($var_consulta);


        while ($rTMP = pg_fetch_assoc($sql)) {

            $arrTablePatientGen[$rTMP["id"]]["id"]                                         = $rTMP["id"];
            $arrTablePatientGen[$rTMP["id"]]["ctg_pac_dpi"]                                = $rTMP["ctg_pac_dpi"];
            $arrTablePatientGen[$rTMP["id"]]["ctg_pac_code"]                               = $rTMP["ctg_pac_code"];
            $arrTablePatientGen[$rTMP["id"]]["ctg_pac_codigo"]                             = $rTMP["ctg_pac_codigo"];
            $arrTablePatientGen[$rTMP["id"]]["ctg_pac_mem_id"]                             = $rTMP["ctg_pac_mem_id"];
            $arrTablePatientGen[$rTMP["id"]]["ctg_pac_nombres"]                            = $rTMP["ctg_pac_nombres"];
            $arrTablePatientGen[$rTMP["id"]]["ctg_pac_apellidos"]                          = $rTMP["ctg_pac_apellidos"];
            $arrTablePatientGen[$rTMP["id"]]["ctg_pac_sexo"]                               = $rTMP["ctg_pac_sexo"];
            $arrTablePatientGen[$rTMP["id"]]["ctg_pac_civil"]                              = $rTMP["ctg_pac_civil"];
            $arrTablePatientGen[$rTMP["id"]]["ctg_pac_nac_dia"]                            = $rTMP["ctg_pac_nac_dia"];
            $arrTablePatientGen[$rTMP["id"]]["ctg_pac_nac_mes"]                            = $rTMP["ctg_pac_nac_mes"];
            $arrTablePatientGen[$rTMP["id"]]["ctg_pac_nac_ano"]                            = $rTMP["ctg_pac_nac_ano"];
            $arrTablePatientGen[$rTMP["id"]]["ctg_pac_dir"]                                = $rTMP["ctg_pac_dir"];
            $arrTablePatientGen[$rTMP["id"]]["ctg_pac_zona"]                               = $rTMP["ctg_pac_zona"];
            $arrTablePatientGen[$rTMP["id"]]["ctg_pac_dep"]                                = $rTMP["ctg_pac_dep"];
            $arrTablePatientGen[$rTMP["id"]]["ctg_pac_mun"]                                = $rTMP["ctg_pac_mun"];
            $arrTablePatientGen[$rTMP["id"]]["ctg_pac_telcel"]                             = $rTMP["ctg_pac_telcel"];
            $arrTablePatientGen[$rTMP["id"]]["ctg_pac_telpar"]                             = $rTMP["ctg_pac_telpar"];
            $arrTablePatientGen[$rTMP["id"]]["ctg_pac_teltra"]                             = $rTMP["ctg_pac_teltra"];
            $arrTablePatientGen[$rTMP["id"]]["ctg_pac_email"]                              = $rTMP["ctg_pac_email"];
            $arrTablePatientGen[$rTMP["id"]]["ctg_pac_sol_dt"]                             = $rTMP["ctg_pac_sol_dt"];
            $arrTablePatientGen[$rTMP["id"]]["ctg_pac_aut_dt"]                             = $rTMP["ctg_pac_aut_dt"];
            $arrTablePatientGen[$rTMP["id"]]["ctg_pac_hab_dt"]                             = $rTMP["ctg_pac_hab_dt"];
            $arrTablePatientGen[$rTMP["id"]]["ctg_pac_ven_dt"]                             = $rTMP["ctg_pac_ven_dt"];
            $arrTablePatientGen[$rTMP["id"]]["ctg_pac_pass"]                               = $rTMP["ctg_pac_pass"];
            $arrTablePatientGen[$rTMP["id"]]["ctg_pac_username"]                           = $rTMP["ctg_pac_username"];
            $arrTablePatientGen[$rTMP["id"]]["ctg_pac_estatus"]                            = $rTMP["ctg_pac_estatus"];
            $arrTablePatientGen[$rTMP["id"]]["ctg_pac_eme_nombre"]                         = $rTMP["ctg_pac_eme_nombre"];
            $arrTablePatientGen[$rTMP["id"]]["ctg_pac_eme_tels"]                           = $rTMP["ctg_pac_eme_tels"];
            $arrTablePatientGen[$rTMP["id"]]["ctg_pac_eme_email"]                          = $rTMP["ctg_pac_eme_email"];
            $arrTablePatientGen[$rTMP["id"]]["ctg_pac_pcl_peso"]                           = $rTMP["ctg_pac_pcl_peso"];
            $arrTablePatientGen[$rTMP["id"]]["ctg_pac_pcl_esta"]                           = $rTMP["ctg_pac_pcl_esta"];
            $arrTablePatientGen[$rTMP["id"]]["ctg_pac_pcl_tpsa"]                           = $rTMP["ctg_pac_pcl_tpsa"];
            $arrTablePatientGen[$rTMP["id"]]["ctg_pac_pcl_aler"]                           = $rTMP["ctg_pac_pcl_aler"];
            $arrTablePatientGen[$rTMP["id"]]["ctg_pac_pcl_aler_desc"]                      = $rTMP["ctg_pac_pcl_aler_desc"];
            $arrTablePatientGen[$rTMP["id"]]["ctg_pac_pcl_enfe"]                           = $rTMP["ctg_pac_pcl_enfe"];
            $arrTablePatientGen[$rTMP["id"]]["ctg_pac_pcl_enfe_desc"]                      = $rTMP["ctg_pac_pcl_enfe_desc"];
            $arrTablePatientGen[$rTMP["id"]]["ctg_pac_pcl_medi"]                           = $rTMP["ctg_pac_pcl_medi"];
            $arrTablePatientGen[$rTMP["id"]]["ctg_pac_pcl_medi_desc"]                      = $rTMP["ctg_pac_pcl_medi_desc"];
            $arrTablePatientGen[$rTMP["id"]]["ctg_pac_pcl_hipe"]                           = $rTMP["ctg_pac_pcl_hipe"];
            $arrTablePatientGen[$rTMP["id"]]["ctg_pac_pcl_vih"]                            = $rTMP["ctg_pac_pcl_vih"];
            $arrTablePatientGen[$rTMP["id"]]["ctg_pac_pcl_park"]                           = $rTMP["ctg_pac_pcl_park"];
            $arrTablePatientGen[$rTMP["id"]]["ctg_pac_pcl_epoc"]                           = $rTMP["ctg_pac_pcl_epoc"];
            $arrTablePatientGen[$rTMP["id"]]["ctg_pac_pcl_tbc"]                            = $rTMP["ctg_pac_pcl_tbc"];
            $arrTablePatientGen[$rTMP["id"]]["ctg_pac_pcl_deme"]                           = $rTMP["ctg_pac_pcl_deme"];
            $arrTablePatientGen[$rTMP["id"]]["ctg_pac_pcl_diab"]                           = $rTMP["ctg_pac_pcl_diab"];
            $arrTablePatientGen[$rTMP["id"]]["ctg_pac_pcl_acv"]                            = $rTMP["ctg_pac_pcl_acv"];
            $arrTablePatientGen[$rTMP["id"]]["ctg_pac_pcl_enft"]                           = $rTMP["ctg_pac_pcl_enft"];
            $arrTablePatientGen[$rTMP["id"]]["ctg_pac_pcl_insr"]                           = $rTMP["ctg_pac_pcl_insr"];
            $arrTablePatientGen[$rTMP["id"]]["ctg_pac_pcl_iamicc"]                         = $rTMP["ctg_pac_pcl_iamicc"];
            $arrTablePatientGen[$rTMP["id"]]["ctg_pac_pcl_otra"]                           = $rTMP["ctg_pac_pcl_otra"];
            $arrTablePatientGen[$rTMP["id"]]["ctg_pac_pcl_otra_desc"]                      = $rTMP["ctg_pac_pcl_otra_desc"];
            $arrTablePatientGen[$rTMP["id"]]["ctg_pac_ant_morb"]                           = $rTMP["ctg_pac_ant_morb"];
            $arrTablePatientGen[$rTMP["id"]]["ctg_pac_ant_fami"]                           = $rTMP["ctg_pac_ant_fami"];
            $arrTablePatientGen[$rTMP["id"]]["ctg_pac_ant_gine"]                           = $rTMP["ctg_pac_ant_gine"];
            $arrTablePatientGen[$rTMP["id"]]["ctg_pac_ant_inmu"]                           = $rTMP["ctg_pac_ant_inmu"];
            $arrTablePatientGen[$rTMP["id"]]["ctg_pac_ant_habi"]                           = $rTMP["ctg_pac_ant_habi"];
            $arrTablePatientGen[$rTMP["id"]]["ctg_pac_ant_soci"]                           = $rTMP["ctg_pac_ant_soci"];
            $arrTablePatientGen[$rTMP["id"]]["ctg_pac_ant_oper"]                           = $rTMP["ctg_pac_ant_oper"];
            $arrTablePatientGen[$rTMP["id"]]["ctg_pac_ant_enfe"]                           = $rTMP["ctg_pac_ant_enfe"];
            $arrTablePatientGen[$rTMP["id"]]["ctg_pac_prf_far_code"]                       = $rTMP["ctg_pac_prf_far_code"];
            $arrTablePatientGen[$rTMP["id"]]["ctg_pac_prf_lab_code"]                       = $rTMP["ctg_pac_prf_lab_code"];
            $arrTablePatientGen[$rTMP["id"]]["ctg_pac_prf_hos_code"]                       = $rTMP["ctg_pac_prf_hos_code"];
            $arrTablePatientGen[$rTMP["id"]]["ctg_pac_medico_cabe_code"]                   = $rTMP["ctg_pac_medico_cabe_code"];
            $arrTablePatientGen[$rTMP["id"]]["ctg_pac_medico_code1"]                       = $rTMP["ctg_pac_medico_code1"];
            $arrTablePatientGen[$rTMP["id"]]["ctg_pac_medico_espe1"]                       = $rTMP["ctg_pac_medico_espe1"];
            $arrTablePatientGen[$rTMP["id"]]["ctg_pac_medico_code2"]                       = $rTMP["ctg_pac_medico_code2"];
            $arrTablePatientGen[$rTMP["id"]]["ctg_pac_medico_espe2"]                       = $rTMP["ctg_pac_medico_espe2"];
            $arrTablePatientGen[$rTMP["id"]]["ctg_pac_medico_code3"]                       = $rTMP["ctg_pac_medico_code3"];
            $arrTablePatientGen[$rTMP["id"]]["ctg_pac_medico_espe3"]                       = $rTMP["ctg_pac_medico_espe3"];
            $arrTablePatientGen[$rTMP["id"]]["ctg_pac_medico_code4"]                       = $rTMP["ctg_pac_medico_code4"];
            $arrTablePatientGen[$rTMP["id"]]["ctg_pac_medico_espe4"]                       = $rTMP["ctg_pac_medico_espe4"];
            $arrTablePatientGen[$rTMP["id"]]["ctg_pac_medico_code5"]                       = $rTMP["ctg_pac_medico_code5"];
            $arrTablePatientGen[$rTMP["id"]]["ctg_pac_medico_espe5"]                       = $rTMP["ctg_pac_medico_espe5"];
            $arrTablePatientGen[$rTMP["id"]]["ctg_pac_medico_code6"]                       = $rTMP["ctg_pac_medico_code6"];
            $arrTablePatientGen[$rTMP["id"]]["ctg_pac_medico_espe6"]                       = $rTMP["ctg_pac_medico_espe6"];
            $arrTablePatientGen[$rTMP["id"]]["ctg_pac_medico_code7"]                       = $rTMP["ctg_pac_medico_code7"];
            $arrTablePatientGen[$rTMP["id"]]["ctg_pac_medico_espe7"]                       = $rTMP["ctg_pac_medico_espe7"];
            $arrTablePatientGen[$rTMP["id"]]["ctg_pac_medico_code8"]                       = $rTMP["ctg_pac_medico_code8"];
            $arrTablePatientGen[$rTMP["id"]]["ctg_pac_medico_espe8"]                       = $rTMP["ctg_pac_medico_espe8"];
            $arrTablePatientGen[$rTMP["id"]]["ctg_pac_medico_code9"]                       = $rTMP["ctg_pac_medico_code9"];
            $arrTablePatientGen[$rTMP["id"]]["ctg_pac_medico_espe9"]                       = $rTMP["ctg_pac_medico_espe9"];
            $arrTablePatientGen[$rTMP["id"]]["ctg_pac_medica_code1"]                       = $rTMP["ctg_pac_medica_code1"];
            $arrTablePatientGen[$rTMP["id"]]["ctg_pac_medica_espe1"]                       = $rTMP["ctg_pac_medica_espe1"];
            $arrTablePatientGen[$rTMP["id"]]["ctg_pac_medica_cron1"]                       = $rTMP["ctg_pac_medica_cron1"];
            $arrTablePatientGen[$rTMP["id"]]["ctg_pac_medica_freq1"]                       = $rTMP["ctg_pac_medica_freq1"];
            $arrTablePatientGen[$rTMP["id"]]["ctg_pac_medica_code2"]                       = $rTMP["ctg_pac_medica_code2"];
            $arrTablePatientGen[$rTMP["id"]]["ctg_pac_medica_espe2"]                       = $rTMP["ctg_pac_medica_espe2"];
            $arrTablePatientGen[$rTMP["id"]]["ctg_pac_medica_cron2"]                       = $rTMP["ctg_pac_medica_cron2"];
            $arrTablePatientGen[$rTMP["id"]]["ctg_pac_medica_freq2"]                       = $rTMP["ctg_pac_medica_freq2"];
            $arrTablePatientGen[$rTMP["id"]]["ctg_pac_medica_code3"]                       = $rTMP["ctg_pac_medica_code3"];
            $arrTablePatientGen[$rTMP["id"]]["ctg_pac_medica_espe3"]                       = $rTMP["ctg_pac_medica_espe3"];
            $arrTablePatientGen[$rTMP["id"]]["ctg_pac_medica_cron3"]                       = $rTMP["ctg_pac_medica_cron3"];
            $arrTablePatientGen[$rTMP["id"]]["ctg_pac_medica_freq3"]                       = $rTMP["ctg_pac_medica_freq3"];
            $arrTablePatientGen[$rTMP["id"]]["ctg_pac_medica_code4"]                       = $rTMP["ctg_pac_medica_code4"];
            $arrTablePatientGen[$rTMP["id"]]["ctg_pac_medica_espe4"]                       = $rTMP["ctg_pac_medica_espe4"];
            $arrTablePatientGen[$rTMP["id"]]["ctg_pac_medica_cron4"]                       = $rTMP["ctg_pac_medica_cron4"];
            $arrTablePatientGen[$rTMP["id"]]["ctg_pac_medica_freq4"]                       = $rTMP["ctg_pac_medica_freq4"];
            $arrTablePatientGen[$rTMP["id"]]["ctg_pac_medica_code5"]                       = $rTMP["ctg_pac_medica_code5"];
            $arrTablePatientGen[$rTMP["id"]]["ctg_pac_medica_espe5"]                       = $rTMP["ctg_pac_medica_espe5"];
            $arrTablePatientGen[$rTMP["id"]]["ctg_pac_medica_cron5"]                       = $rTMP["ctg_pac_medica_cron5"];
            $arrTablePatientGen[$rTMP["id"]]["ctg_pac_medica_freq5"]                       = $rTMP["ctg_pac_medica_freq5"];
            $arrTablePatientGen[$rTMP["id"]]["ctg_pac_medica_code6"]                       = $rTMP["ctg_pac_medica_code6"];
            $arrTablePatientGen[$rTMP["id"]]["ctg_pac_medica_espe6"]                       = $rTMP["ctg_pac_medica_espe6"];
            $arrTablePatientGen[$rTMP["id"]]["ctg_pac_medica_cron6"]                       = $rTMP["ctg_pac_medica_cron6"];
            $arrTablePatientGen[$rTMP["id"]]["ctg_pac_medica_freq6"]                       = $rTMP["ctg_pac_medica_freq6"];
            $arrTablePatientGen[$rTMP["id"]]["ctg_pac_medica_code7"]                       = $rTMP["ctg_pac_medica_code7"];
            $arrTablePatientGen[$rTMP["id"]]["ctg_pac_medica_espe7"]                       = $rTMP["ctg_pac_medica_espe7"];
            $arrTablePatientGen[$rTMP["id"]]["ctg_pac_medica_cron7"]                       = $rTMP["ctg_pac_medica_cron7"];
            $arrTablePatientGen[$rTMP["id"]]["ctg_pac_medica_freq7"]                       = $rTMP["ctg_pac_medica_freq7"];
            $arrTablePatientGen[$rTMP["id"]]["ctg_pac_medica_code8"]                       = $rTMP["ctg_pac_medica_code8"];
            $arrTablePatientGen[$rTMP["id"]]["ctg_pac_medica_espe8"]                       = $rTMP["ctg_pac_medica_espe8"];
            $arrTablePatientGen[$rTMP["id"]]["ctg_pac_medica_cron8"]                       = $rTMP["ctg_pac_medica_cron8"];
            $arrTablePatientGen[$rTMP["id"]]["ctg_pac_medica_freq8"]                       = $rTMP["ctg_pac_medica_freq8"];
            $arrTablePatientGen[$rTMP["id"]]["ctg_pac_medica_code9"]                       = $rTMP["ctg_pac_medica_code9"];
            $arrTablePatientGen[$rTMP["id"]]["ctg_pac_medica_espe9"]                       = $rTMP["ctg_pac_medica_espe9"];
            $arrTablePatientGen[$rTMP["id"]]["ctg_pac_medica_cron9"]                       = $rTMP["ctg_pac_medica_cron9"];
            $arrTablePatientGen[$rTMP["id"]]["ctg_pac_medica_freq9"]                       = $rTMP["ctg_pac_medica_freq9"];
            $arrTablePatientGen[$rTMP["id"]]["ctg_pac_sta"]                                = $rTMP["ctg_pac_sta"];
            $arrTablePatientGen[$rTMP["id"]]["ctg_pac_dt"]                                 = $rTMP["ctg_pac_dt"];
            $arrTablePatientGen[$rTMP["id"]]["ctg_pac_usr"]                                = $rTMP["ctg_pac_usr"];
            $arrTablePatientGen[$rTMP["id"]]["ctg_pac_pict"]                                = $rTMP["ctg_pac_pict"];
        }
        pg_free_result($sql);
?>
        <div class="col-md-12 tableFixHead">
            <?php
            if (is_array($arrTablePatientGen) && (count($arrTablePatientGen) > 0)) {
                reset($arrTablePatientGen);
                foreach ($arrTablePatientGen as $rTMP['key'] => $rTMP['value']) {
            ?>
                    <td>
                        <input type="hidden" name="hidId_" id="hidId_" value="<?php echo  $rTMP["value"]['id']; ?>">
                        <input type="hidden" name="hidCodigo_" id="hidCodigo_" value="<?php echo  $rTMP["value"]['ctg_pac_code']; ?>">
                        <input type="hidden" name="hidDpi_" id="hidDpi_" value="<?php echo  $rTMP["value"]['ctg_pac_dpi']; ?>">
                        <input type="hidden" name="hidName_" id="hidName_" value="<?php echo  $rTMP["value"]['ctg_pac_nombres']; ?>">
                        <input type="hidden" name="hidLasName_" id="hidLasName_" value="<?php echo  $rTMP["value"]['ctg_pac_apellidos']; ?>">
                        <input type="hidden" name="hidSex_" id="hidSex_" value="<?php echo  $rTMP["value"]['ctg_pac_sexo']; ?>">
                        <input type="hidden" name="hidReg_" id="hidReg_" value="<?php echo  $rTMP["value"]['ctg_pac_dep']; ?>">
                        <input type="hidden" name="hidDis_" id="hidDis_" value="<?php echo  $rTMP["value"]['ctg_pac_mun']; ?>">
                        <input type="hidden" name="hidZona_" id="hidZona_" value="<?php echo  $rTMP["value"]['ctg_pac_zona']; ?>">
                        <input type="hidden" name="hidMail_" id="hidMail_" value="<?php echo  $rTMP["value"]['ctg_pac_email']; ?>">
                        <input type="hidden" name="hidCell_" id="hidCell_" value="<?php echo  $rTMP["value"]['ctg_pac_telpar']; ?>">
                        <input type="hidden" name="hidAdress_" id="hidAdress_" value="<?php echo  $rTMP["value"]['ctg_pac_dir']; ?>">
                        <input type="hidden" name="hidFullName_" id="hidFullName_" value="<?php echo  $rTMP["value"]['ctg_pac_eme_nombre']; ?>">
                        <input type="hidden" name="hidTell_" id="hidTell_" value="<?php echo  $rTMP["value"]['ctg_pac_eme_tels']; ?>">
                        <input type="hidden" name="hidEmail_" id="hidEmail_" value="<?php echo  $rTMP["value"]['ctg_pac_eme_email']; ?>">
                    </td>
            <?PHP
                    $ctg_pac_pict =  $rTMP["value"]['ctg_pac_pict'];
                }
            }
            ?>
        </div>
    <?php

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
    } else if ($strTipoValidacion == "dibujo_dropdow_mun") {
        require_once "../../data/conexion/tmfWeb.php";
        $strReg = isset($_POST["region"]) ? $_POST["region"]  : '';

        $arrMunicipio = array();
        $var_consulta = "SELECT * 
                            FROM ctg_geografia 
                            WHERE  geo_pais = '$paisDrop'
                            AND geo_parent = '$strReg'
                            ORDER BY geo_id";
        $sql = pg_query($tmfWeb, $var_consulta);
        $totalArticle = pg_num_rows($sql);
        //print_r($var_consulta);
        //print_r($strReg);


        while ($rTMP = pg_fetch_assoc($sql)) {

            $arrMunicipio[$rTMP["id"]]["id"]                                         = $rTMP["id"];
            $arrMunicipio[$rTMP["id"]]["geo_id"]                                     = $rTMP["geo_id"];
            $arrMunicipio[$rTMP["id"]]["geo_desc"]                                   = $rTMP["geo_desc"];
            $arrMunicipio[$rTMP["id"]]["geo_obs"]                                    = $rTMP["geo_obs"];
            $arrMunicipio[$rTMP["id"]]["geo_parent"]                                 = $rTMP["geo_parent"];
            $arrMunicipio[$rTMP["id"]]["geo_moneda"]                                 = $rTMP["geo_moneda"];
            $arrMunicipio[$rTMP["id"]]["geo_cambio"]                                 = $rTMP["geo_cambio"];
            $arrMunicipio[$rTMP["id"]]["geo_cambio_dt"]                              = $rTMP["geo_cambio_dt"];
            $arrMunicipio[$rTMP["id"]]["geo_sta"]                                    = $rTMP["geo_sta"];
            $arrMunicipio[$rTMP["id"]]["geo_usr"]                                    = $rTMP["geo_usr"];
            $arrMunicipio[$rTMP["id"]]["geo_dt"]                                     = $rTMP["geo_dt"];
            $arrMunicipio[$rTMP["id"]]["geo_pais"]                                   = $rTMP["geo_pais"];
            $arrMunicipio[$rTMP["id"]]["geo_tel"]                                    = $rTMP["geo_tel"];
            $arrMunicipio[$rTMP["id"]]["geo_flag"]                                   = $rTMP["geo_flag"];
        }
        pg_free_result($sql);

    ?>
        <option value="0">Seleccionar</option>
        <?php
        if (is_array($arrMunicipio) && (count($arrMunicipio) > 0)) {
            reset($arrMunicipio);
            foreach ($arrMunicipio as $rTMP['key'] => $rTMP['value']) {
        ?>
                <option value="<?php echo  $rTMP["value"]['id']; ?>"><?php echo  $rTMP["value"]['geo_desc']; ?></option>

        <?PHP
            }
        }
        ?>
<?php
        die();
    } else if ($strTipoValidacion == "proces_img") {

        if (isset($_POST["getPrecargarArchivos"])) {
            header('Content-Type: application/json');

            set_time_limit(1200);
            ini_set('memory_limit', '-1');
            header("Content-Type: text/html; charset=utf-8");

            $strExtension = isset($_POST["extension"]) ? $_POST["extension"] : "";
            $nombre = isset($_POST["nombre_archivo"]) ? $_POST["nombre_archivo"] : "";
            $idWeb = $_SESSION['adm_usr_code'];

            $rs = pg_query($rmfAdm, "SELECT ctg_pac_pict FROM ctg_pacientes WHERE ctg_pac_code = '$usuarioCode'");
            if ($row = pg_fetch_array($rs)) {
                $idRowS0 = trim($row[0]);
            }
            $url_img = isset($idRowS0) ? $idRowS0  : '';

            if ($url_img) {
                if (file_exists($url_img)) {
                    @chmod($url_img, 0777);
                    unlink($url_img);
                }
            }

            @chmod("../../asset/img/pacientes/perfil/", 0777);
            $strRespuesta = save_file_image("archivo", "pacientes/perfil/", "", 0, true, true, false);

            if (!empty($strRespuesta)) {
                $var_consulta = "UPDATE ctg_pacientes SET ctg_pac_pict = '$strRespuesta' WHERE ctg_pac_code = '$usuarioCode'";
                if (pg_query($rmfAdm, $var_consulta)) {
                    //print $var_consulta;
                    print json_encode(array("respuesta" => $strRespuesta));
                } else {
                    $arrInfo['status'] = 0;
                    $arrInfo['error'] = $var_consulta;
                }
            }

            die();
        }
    }

    die();
}
?>
<?php

require_once "../../data/conexion/tmfAdm.php";

$arrSexos = array();
$var_consulta = "SELECT * 
                    FROM ctg_sexos 
                    ORDER BY ctg_sex_cod";
$sql = pg_query($rmfAdm, $var_consulta);
$totalArticle = pg_num_rows($sql);


while ($rTMP = pg_fetch_assoc($sql)) {

    $arrSexos[$rTMP["id"]]["id"]                                         = $rTMP["id"];
    $arrSexos[$rTMP["id"]]["ctg_sex_cod"]                                = $rTMP["ctg_sex_cod"];
    $arrSexos[$rTMP["id"]]["ctg_sex_desc"]                               = $rTMP["ctg_sex_desc"];
    $arrSexos[$rTMP["id"]]["ctg_sex_sta"]                                = $rTMP["ctg_sex_sta"];
    $arrSexos[$rTMP["id"]]["ctg_sex_dt"]                                 = $rTMP["ctg_sex_dt"];
    $arrSexos[$rTMP["id"]]["ctg_sex_usr"]                                = $rTMP["ctg_sex_usr"];
}
pg_free_result($sql);


$usuarioCode = $_SESSION['adm_usr_code'];

$arrTablePatientGen2 = array();
$var_consulta = "SELECT * 
                        FROM ctg_pacientes 
                        WHERE ctg_pac_code =' $usuarioCode '
                        LIMIT 1";
$sql = pg_query($rmfAdm, $var_consulta);
$totalArticle = pg_num_rows($sql);
//print_r($var_consulta);


while ($rTMP = pg_fetch_assoc($sql)) {

    $arrTablePatientGen2[$rTMP["id"]]["ctg_pac_pict"]                                = $rTMP["ctg_pac_pict"];
}
pg_free_result($sql);
?>
<div class="col-md-12 tableFixHead">
    <?php
    if (is_array($arrTablePatientGen2) && (count($arrTablePatientGen2) > 0)) {
        reset($arrTablePatientGen2);
        foreach ($arrTablePatientGen2 as $rTMP['key'] => $rTMP['value']) {

            $ctg_pac_pict =  $rTMP["value"]['ctg_pac_pict'];
        }
    }



    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////


    function save_file_image($strInputFileName, $strExtraPath = "", $strAntelacionArchivo = "../../asset/img/", $intImagenId = 0, $boolDeletePreviousFile = true, $boolAjax = false, $boolNombreOriginal = false)
    {
        $strFileName = isset($_FILES[$strInputFileName]['name']) ? $_FILES[$strInputFileName]['name'] : "";

        if ($boolAjax)
            $strFileName = procesImput($strFileName, true);

        $strFileName = rem_special_caract(str_replace(" ", "_", $strFileName));
        $intImagenId = ($intImagenId == 0 || strlen($intImagenId) == 0) ? uniqid() : $intImagenId;

        $strAntelacionArchivo = empty($strAntelacionArchivo) ? "" : rem_special_caract($strAntelacionArchivo);

        $strPath = "../../asset/img/";

        if (!empty($strExtraPath)) {
            if (substr($strExtraPath, -1, 1) != "/") {
                $strExtraPath = $strExtraPath . "/";
            }
        }

        $strPath = $strPath . $strExtraPath;
        $strPathAndFile = "";
        if (!file_exists($strPath)) {
            mkdir($strPath, 0777, true);
        }

        if (file_exists($strPath)) {

            if (isset($_FILES[$strInputFileName]['name']) && $_FILES[$strInputFileName]['error'] == UPLOAD_ERR_OK) {

                $strExtension = pathinfo(strtolower($strFileName), PATHINFO_EXTENSION);

                //drawDebug($strExtension, "strExtension");

                if ($boolNombreOriginal) {
                    $strPathInfoFileName = $strPath . rem_special_caract(str_replace(" ", "_", pathinfo($strFileName, PATHINFO_FILENAME)));
                    $strPathAndFile .= empty($strAntelacionArchivo) ? "" : $strAntelacionArchivo . "_";
                    $strPathAndFile .= $strPathInfoFileName . "_" . $intImagenId . "." . $strExtension;
                } else {
                    $strPathAndFile = $strPath . $strAntelacionArchivo . "_" . $intImagenId . "." . $strExtension;
                }

                if (!file_exists($strPathAndFile)) {
                    @chmod("../../asset/img/", 0777);
                    move_uploaded_file($_FILES[$strInputFileName]["tmp_name"], $strPathAndFile);
                    @chmod($strPathAndFile, 0777);
                }
            }
        }

        return $strPathAndFile;
    }

    function procesImput($strInput, $boolUTF8Decode = false)
    {
        if ($boolUTF8Decode && mb_detect_encoding($strInput) == "UTF-8") {
            $strInput = utf8_decode($strInput);
        }
        return $strInput;
    }
    ?>
<?php
// VALIDATION INSERT UPDATE DELETE

if (isset($_GET["validaciones"]) && !empty($_GET["validaciones"])) {
    require_once "../../data/conexion/tmfAdm.php";
    $insert = 1;
    $update = 2;
    $delete = 3;

    $id = isset($_POST["id"]) ? $_POST["id"]  : 0;
    $idTabla = isset($_POST["id"]) ? $_POST["id"]  : 0;;
    $idMenbrecia = isset($_POST["id"]) ? $_POST["id"]  : 0;;
    $rs = pg_query("SELECT count(*)FROM  ctg_pacientes");
    if ($row = pg_fetch_row($rs)) {
        $idRow = trim($row[0]);
    }
    $idMax = $idRow + 1;
    $DocPersonal_ = isset($_POST["DocPersonal_"]) ? $_POST["DocPersonal_"]  : '';
    $DocPersonal = isset($_POST["DocPersonal"]) ? $_POST["DocPersonal"]  : '';
    $Name = isset($_POST["Name"]) ? $_POST["Name"]  : '';
    $LastName = isset($_POST["LastName"]) ? $_POST["LastName"]  : '';
    $Sex = isset($_POST["Sex"]) ? $_POST["Sex"]  : 0;
    $Pais = isset($_POST["Pais"]) ? $_POST["Pais"]  : 0;
    $Region = isset($_POST["Region"]) ? $_POST["Region"]  : 0;
    $Distri = isset($_POST["Distri"]) ? $_POST["Distri"]  : 0;
    $Tell = isset($_POST["Tell"]) ? $_POST["Tell"]  : 00000000;
    $Adress = isset($_POST["Adress"]) ? $_POST["Adress"]  : '';
    $Zona = isset($_POST["Zona"]) ? $_POST["Zona"]  : 0;
    $Mail = isset($_POST["Mail"]) ? $_POST["Mail"]  : '';

    $FullName = isset($_POST["FullName"]) ? $_POST["FullName"]  : '';
    $Cell = isset($_POST["Cell"]) ? $_POST["Cell"]  : 00000000;
    $Email = isset($_POST["Email"]) ? $_POST["Email"]  : '';

    $status = 1;
    $fecha = date("d-m-Y");
    $fechaD = date("d");
    $fechaM = date("m");
    $fechaA = date("Y");
    $usuario = $_SESSION['adm_usr_code'];

    if ($_GET["validaciones"] == "insert") {
        //print_r('hereeeeeeeeeeeeeeeeeeINSERT'.$idRow);
        header('Content-Type: application/json');
        $var_consulta = "SELECT doctors_perfil('$insert','$id','$idMax','$DocPersonal','$idTabla','$idMenbrecia','$Name','$LastName','$Sex','$fechaD','$fechaM','$fechaA','$Adress','$zona','$Region','$Distri','$fechaA','$Tell','$Mail','$fecha','$status','$FullName','$Cell','$Email','$fecha','$usuario')";
        $val = 1;
        if (pg_query($rmfAdm, $var_consulta)) {
            $arrInfo['status'] = $val;
        } else {
            $arrInfo['status'] = 0;
            $arrInfo['error'] = $var_consulta;
        }
        print json_encode($arrInfo);
        die();
    }

    if ($_GET["validaciones"] == "update") {
        //print_r('hereeeeeeeeeeeeeeeeeeUPDATE');
        $var_consulta = "SELECT doctors_perfil('$update','$id','$idMax','$DocPersonal_','$idTabla','$idMenbrecia','$Name','$LastName','$Sex','$fechaD','$fechaM','$fechaA','$Adress','$zona','$Region','$Distri','$fechaA','$Tell','$Mail','$fecha','$status','$FullName','$Cell','$Email','$fecha','$usuario')";
        $val = 1;
        if (pg_query($rmfAdm, $var_consulta)) {
            $arrInfo['status'] = $val;
        } else {
            $arrInfo['status'] = 0;
            $arrInfo['error'] = $var_consulta;
        }
        print json_encode($arrInfo);
        die();
    }

    if ($_GET["validaciones"] == "delete") {
        //print_r('hereeeeeeeeeeeeeeeeeeDELETE');

        $var_consulta = "SELECT doctors_perfil('$delete','$id','$idMax','$DocPersonal','$idTabla','$idMenbrecia','$Name','$LastName','$Sex','$fechaD','$fechaM','$fechaA','$Adress','$zona','$Region','$Distri','$fechaA','$Tell','$Mail','$fecha','$status','$FullName','$Cell','$Email','$fecha','$usuario')";
        if (pg_query($rmfAdm, $var_consulta)) {
            echo $val;
        } else {
            echo "Error: " . $var_consulta . "<br>";
        }
    }

    die();
}
?>

<?php
require_once "../../data/conexion/tmfAdm.php";
$med = 1;
$arrTablePatientGen = array();
$var_consulta = "SELECT * FROM ctg_pacientes ORDER BY id LIMIT 1000";
$sql = pg_query($rmfAdm, $var_consulta);
$totalArticle = pg_num_rows($sql);


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
}
pg_free_result($sql);
?>



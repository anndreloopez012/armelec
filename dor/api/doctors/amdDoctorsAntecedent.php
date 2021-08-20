<?php
// VALIDATION INSERT UPDATE DELETE

if (isset($_GET["validaciones"]) && !empty($_GET["validaciones"])) {
    require_once "../../data/conexion/tmfAdm.php";

    $id = $_SESSION['adm_usr_code'];
    $ctg_pac_ant_morb = isset($_POST["morbidos"]) ? $_POST["morbidos"]  : '';
    $ctg_pac_ant_fami = isset($_POST["familiares"]) ? $_POST["familiares"]  : '';
    $ctg_pac_ant_gine = isset($_POST["ginecobstetricos"]) ? $_POST["ginecobstetricos"]  : '';
    $ctg_pac_ant_inmu = isset($_POST["imnunizaciones"]) ? $_POST["imnunizaciones"]  : 0;
    $ctg_pac_ant_habi = isset($_POST["habitos"]) ? $_POST["habitos"]  : '';
    $ctg_pac_ant_soci = isset($_POST["personales"]) ? $_POST["personales"]  : 0;
    $fechaIng = date("Y-m-d");
    $usuario = $_SESSION['adm_usr_code'];

    $strTipoValidacion = isset($_REQUEST["validaciones"]) ? $_REQUEST["validaciones"] : '';

    if ($strTipoValidacion == "update") {
        header('Content-Type: application/json');

        $cod_id = isset($_GET["code"]) ? intval($_GET["code"]) : "";

        $var_consulta = "UPDATE ctg_pacientes SET ctg_pac_ant_morb = '$ctg_pac_ant_morb',ctg_pac_ant_fami = '$ctg_pac_ant_fami',ctg_pac_ant_gine = '$ctg_pac_ant_gine',ctg_pac_ant_inmu = '$ctg_pac_ant_inmu',ctg_pac_ant_habi = '$ctg_pac_ant_habi',ctg_pac_ant_soci = '$ctg_pac_ant_soci',ctg_pac_dt = '$fechaIng' WHERE ctg_pac_code = $cod_id";

        $val = 1;
        if (pg_query($rmfAdm, $var_consulta)) {
            $arrInfo['status'] = $val;
        } else {
            $arrInfo['status'] = 0;
            $arrInfo['error'] = $var_consulta;
        }
        //print_r($var_consulta);
        print json_encode($arrInfo);
        die();
    }

    die();
} ?>


<?php
$cod_id = $_GET['cod'];
$cod_id =  decrypt($cod_id, $key);
$idPac = isset($idPac) ? $idPac  : '';
require_once "../../data/conexion/tmfAdm.php"; ?>

<?php
$id = $_GET['cod'];
$id =  decrypt($id, $key);
$id = isset($id) ? $id  : '';
$arrDataPerfilAntecedent = array();
$var_consulta = "SELECT * 
                    FROM ctg_pacientes 
                    WHERE ctg_pac_code = '$id'
                    LIMIT 1";
$sql = pg_query($rmfAdm, $var_consulta);
$totalArticle = pg_num_rows($sql);


while ($rTMP = pg_fetch_assoc($sql)) {

    $arrDataPerfilAntecedent[$rTMP["id"]]["id"]                                         = $rTMP["id"];
    $arrDataPerfilAntecedent[$rTMP["id"]]["ctg_pac_ant_morb"]                           = $rTMP["ctg_pac_ant_morb"];
    $arrDataPerfilAntecedent[$rTMP["id"]]["ctg_pac_ant_fami"]                           = $rTMP["ctg_pac_ant_fami"];
    $arrDataPerfilAntecedent[$rTMP["id"]]["ctg_pac_ant_gine"]                           = $rTMP["ctg_pac_ant_gine"];
    $arrDataPerfilAntecedent[$rTMP["id"]]["ctg_pac_ant_inmu"]                           = $rTMP["ctg_pac_ant_inmu"];
    $arrDataPerfilAntecedent[$rTMP["id"]]["ctg_pac_ant_habi"]                           = $rTMP["ctg_pac_ant_habi"];
    $arrDataPerfilAntecedent[$rTMP["id"]]["ctg_pac_ant_soci"]                           = $rTMP["ctg_pac_ant_soci"];
    $arrDataPerfilAntecedent[$rTMP["id"]]["ctg_pac_ant_oper"]                           = $rTMP["ctg_pac_ant_oper"];
    $arrDataPerfilAntecedent[$rTMP["id"]]["ctg_pac_ant_enfe"]                           = $rTMP["ctg_pac_ant_enfe"];
}
pg_free_result($sql);
?>

<?php
if (is_array($arrDataPerfilAntecedent) && (count($arrDataPerfilAntecedent) > 0)) {
    reset($arrDataPerfilAntecedent);
    foreach ($arrDataPerfilAntecedent as $rTMP['key'] => $rTMP['value']) {

        $ctg_pac_ant_morb = isset($rTMP["value"]['ctg_pac_ant_morb']) ? $rTMP["value"]['ctg_pac_ant_morb']  : '';
        $ctg_pac_ant_fami = isset($rTMP["value"]['ctg_pac_ant_fami']) ? $rTMP["value"]['ctg_pac_ant_fami']  : '';
        $ctg_pac_ant_gine = isset($rTMP["value"]['ctg_pac_ant_gine']) ? $rTMP["value"]['ctg_pac_ant_gine']  : '';
        $ctg_pac_ant_inmu = isset($rTMP["value"]['ctg_pac_ant_inmu']) ? $rTMP["value"]['ctg_pac_ant_inmu']  : '';
        $ctg_pac_ant_habi = isset($rTMP["value"]['ctg_pac_ant_habi']) ? $rTMP["value"]['ctg_pac_ant_habi']  : '';
        $ctg_pac_ant_soci = isset($rTMP["value"]['ctg_pac_ant_soci']) ? $rTMP["value"]['ctg_pac_ant_soci']  : '';
        $ctg_pac_ant_oper = isset($rTMP["value"]['ctg_pac_ant_oper']) ? $rTMP["value"]['ctg_pac_ant_oper']  : '';
        $ctg_pac_ant_enfe = isset($rTMP["value"]['ctg_pac_ant_enfe']) ? $rTMP["value"]['ctg_pac_ant_enfe']  : '';
    }
}
?>   

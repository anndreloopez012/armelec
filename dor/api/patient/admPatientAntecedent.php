<?php
// VALIDATION INSERT UPDATE DELETE

if (isset($_GET["validaciones"]) && !empty($_GET["validaciones"])) {
    require_once "../../data/conexion/tmfAdm.php";

    $id = $_SESSION['adm_usr_id'];
    $cod_id = isset($_POST["code"]) ? $_POST["code"]  : '';
    $ctg_pac_ant_morb = isset($_POST["morbidos"]) ? $_POST["morbidos"]  : '';
    $ctg_pac_ant_fami = isset($_POST["familiares"]) ? $_POST["familiares"]  : '';
    $ctg_pac_ant_gine = isset($_POST["ginecobstetricos"]) ? $_POST["ginecobstetricos"]  : '';
    $ctg_pac_ant_inmu = isset($_POST["imnunizaciones"]) ? $_POST["imnunizaciones"]  : 0;
    $ctg_pac_ant_habi = isset($_POST["habitos"]) ? $_POST["habitos"]  : '';
    $ctg_pac_ant_soci = isset($_POST["personales"]) ? $_POST["personales"]  : 0;
    $fechaIng = date("Y-m-d");
    $usuario = $_SESSION['username'];

    $strTipoValidacion = isset($_REQUEST["validaciones"]) ? $_REQUEST["validaciones"] : '';

    if ($strTipoValidacion == "update") {
        header('Content-Type: application/json');
        $var_consulta = "UPDATE ctg_pacientes SET ctg_pac_ant_morb = '$ctg_pac_ant_morb',ctg_pac_ant_fami = '$ctg_pac_ant_fami',ctg_pac_ant_gine = '$ctg_pac_ant_gine',ctg_pac_ant_inmu = '$ctg_pac_ant_inmu',ctg_pac_ant_habi = '$ctg_pac_ant_habi',ctg_pac_ant_soci = '$ctg_pac_ant_soci', ctg_pac_usr = '$usuario',ctg_pac_dt = '$fechaIng' WHERE id = $cod_id";

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

    die();
}

require_once "../../data/conexion/tmfAdm.php";


$arrId = $_SESSION['adm_usr_code'];
$arrDataPerfilAntecedent = array();
$var_consulta = "SELECT * 
                    FROM ctg_pacientes 
                    WHERE ctg_pac_code = '$arrId'
                    LIMIT 1";
$sql = pg_query($rmfAdm, $var_consulta);
$totalArticle = pg_num_rows($sql);
//echo ($var_consulta);

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

        $cod_id =  $rTMP["value"]['id'];
        $ctg_pac_ant_morb =  $rTMP["value"]['ctg_pac_ant_morb'];
        $ctg_pac_ant_fami =  $rTMP["value"]['ctg_pac_ant_fami'];
        $ctg_pac_ant_gine =  $rTMP["value"]['ctg_pac_ant_gine'];
        $ctg_pac_ant_inmu =  $rTMP["value"]['ctg_pac_ant_inmu'];
        $ctg_pac_ant_habi =  $rTMP["value"]['ctg_pac_ant_habi'];
        $ctg_pac_ant_soci =  $rTMP["value"]['ctg_pac_ant_soci'];
        $ctg_pac_ant_oper =  $rTMP["value"]['ctg_pac_ant_oper'];
        $ctg_pac_ant_enfe =  $rTMP["value"]['ctg_pac_ant_enfe'];

        //echo ('cod_id'.$cod_id.'</br>');
        //echo ('ctg_pac_ant_morb'.$ctg_pac_ant_morb.'</br>');
        //echo ('ctg_pac_ant_fami'.$ctg_pac_ant_fami.'</br>');
        //echo ('ctg_pac_ant_gine'.$ctg_pac_ant_gine.'</br>');
        //echo ('ctg_pac_ant_inmu'.$ctg_pac_ant_inmu.'</br>');
        //echo ('ctg_pac_ant_habi'.$ctg_pac_ant_habi.'</br>');
        //echo ('ctg_pac_ant_soci'.$ctg_pac_ant_soci.'</br>');
        //echo ('ctg_pac_ant_oper'.$ctg_pac_ant_oper.'</br>');
        //echo ('ctg_pac_ant_enfe'.$ctg_pac_ant_enfe.'</br>');

    }
}
?>   

<?php
// VALIDATION INSERT UPDATE DELETE

if (isset($_GET["validaciones"]) && !empty($_GET["validaciones"])) {
    require_once "../../api/globalFunctions.php";
    require_once "../../data/conexion/tmfAdm.php";
    require_once "../../api/config.php";

    $idUser = $_SESSION['adm_usr_id'];
    $idCode = $_SESSION['adm_usr_code'];

    $id_reg = isset($_POST["id_reg"]) ? $_POST["id_reg"]  : '';
    $ctg_lab_nomcom = isset($_POST["ctg_lab_nomcom"]) ? $_POST["ctg_lab_nomcom"]  : '';
    $ctg_lab_nit = isset($_POST["ctg_lab_nit"]) ? $_POST["ctg_lab_nit"]  : '';
    $ctg_lab_suc = isset($_POST["ctg_lab_suc"]) ? $_POST["ctg_lab_suc"]  : '';
    $ctg_lab_hortda1 = isset($_POST["ctg_lab_hortda1"]) ? $_POST["ctg_lab_hortda1"]  : '';
    $ctg_lab_hortda2 = isset($_POST["ctg_lab_hortda2"]) ? $_POST["ctg_lab_hortda2"]  : '';
    $ctg_lab_dir = isset($_POST["ctg_lab_dir"]) ? $_POST["ctg_lab_dir"]  : '';
    $ctg_lab_zona = isset($_POST["ctg_lab_zona"]) ? $_POST["ctg_lab_zona"]  : '';
    $region = isset($_POST["region"]) ? $_POST["region"]  : '';
    $distrito = isset($_POST["distrito"]) ? $_POST["distrito"]  : '';
    $ctg_lab_tels = isset($_POST["ctg_lab_tels"]) ? $_POST["ctg_lab_tels"]  : '';

    $ctg_lab_enc_dpi = isset($_POST["ctg_lab_enc_dpi"]) ? $_POST["ctg_lab_enc_dpi"]  : '';
    $ctg_lab_enc_nom1 = isset($_POST["ctg_lab_enc_nom1"]) ? $_POST["ctg_lab_enc_nom1"]  : '';
    $ctg_lab_enc_edad = isset($_POST["ctg_lab_enc_edad"]) ? $_POST["ctg_lab_enc_edad"]  : '';
    $sexo_ = isset($_POST["sexo_"]) ? $_POST["sexo_"]  : '';

    $fechaIng = date("Y-m-d");
    $usuario = $_SESSION['adm_usr_id'];

    $strTipoValidacion = isset($_REQUEST["validaciones"]) ? $_REQUEST["validaciones"] : '';

    if ($strTipoValidacion == "update") {
        header('Content-Type: application/json');
        $var_consulta = "UPDATE ctg_lab_clinicos SET ctg_lab_tels = $ctg_lab_tels,ctg_lab_hortda1 = '$ctg_lab_hortda1' ,ctg_lab_hortda2 = '$ctg_lab_hortda2' ,ctg_lab_dir = '$ctg_lab_dir' ,ctg_lab_zona = '$ctg_lab_zona' ,ctg_lab_dep = '$region' ,ctg_lab_mun = '$distrito' ,ctg_lab_enc_dpi = '$ctg_lab_enc_dpi' ,ctg_lab_enc_nom1 = '$ctg_lab_enc_nom1' ,ctg_lab_enc_sexo = '$sexo_' WHERE id = '$id_reg';";
        $val = 1;
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
        print_r($var_consulta);


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
        print_r($var_consulta);
        //print_r($strReg);


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
                <option  value="<?php echo  $rTMP["value"]['id']; ?>"><?php echo  $rTMP["value"]['geo_desc']; ?></option>

        <?PHP
            }
        }
        ?>
<?php
        die();
    }else if ($strTipoValidacion == "proces_img") {

        if (isset($_POST["getPrecargarArchivos"])) {
            header('Content-Type: application/json');

            set_time_limit(1200);
            ini_set('memory_limit', '-1');
            header("Content-Type: text/html; charset=utf-8");

            $strExtension = isset($_POST["extension"]) ? $_POST["extension"] : "";
            $nombre = isset($_POST["nombre_archivo"]) ? $_POST["nombre_archivo"] : "";
            $idWeb = $_SESSION['adm_usr_code'];

            $rs = pg_query($rmfAdm, "SELECT ctg_lab_pict FROM ctg_lab_clinicos WHERE ctg_lab_code = '$idCode'");
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

            @chmod("../../asset/img/laboratorio/perfil/", 0777);
            $strRespuesta = save_file_image("archivo", "laboratorio/perfil/", "", 0, true, true, false);

            if (!empty($strRespuesta)) {
                $var_consulta = "UPDATE ctg_lab_clinicos SET ctg_lab_pict = '$strRespuesta' WHERE ctg_lab_code = '$idCode'";
                if (pg_query($rmfAdm, $var_consulta)) {
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

require_once "../../data/conexion/tmfAdm.php";

$idWeb = $_SESSION['adm_usr_code'];
$arrTableLabPerfil = array();
$var_consulta = "SELECT * 
                    FROM ctg_lab_clinicos
                    WHERE ctg_lab_code = '$idWeb'
                    LIMIT 1";
$sql = pg_query($rmfAdm, $var_consulta);
//print_r($var_consulta);

$totalArticle = pg_num_rows($sql);

while ($rTMP = pg_fetch_assoc($sql)) {

    $arrTableLabPerfil[$rTMP["id"]]["id"]                                         = $rTMP["id"];
    $arrTableLabPerfil[$rTMP["id"]]["ctg_lab_contrato"]                                         = $rTMP["ctg_lab_contrato"];
    $arrTableLabPerfil[$rTMP["id"]]["ctg_lab_nit"]                                         = $rTMP["ctg_lab_nit"];
    $arrTableLabPerfil[$rTMP["id"]]["ctg_lab_nomcom"]                                         = $rTMP["ctg_lab_nomcom"];
    $arrTableLabPerfil[$rTMP["id"]]["ctg_lab_suc"]                                         = $rTMP["ctg_lab_suc"];
    $arrTableLabPerfil[$rTMP["id"]]["ctg_lab_code"]                                         = $rTMP["ctg_lab_code"];
    $arrTableLabPerfil[$rTMP["id"]]["ctg_lab_hortda1"]                                         = $rTMP["ctg_lab_hortda1"];
    $arrTableLabPerfil[$rTMP["id"]]["ctg_lab_hortda2"]                                         = $rTMP["ctg_lab_hortda2"];
    $arrTableLabPerfil[$rTMP["id"]]["ctg_lab_dir"]                                         = $rTMP["ctg_lab_dir"];
    $arrTableLabPerfil[$rTMP["id"]]["ctg_lab_zona"]                                         = $rTMP["ctg_lab_zona"];
    $arrTableLabPerfil[$rTMP["id"]]["ctg_lab_dep"]                                         = $rTMP["ctg_lab_dep"];
    $arrTableLabPerfil[$rTMP["id"]]["ctg_lab_mun"]                                         = $rTMP["ctg_lab_mun"];
    $arrTableLabPerfil[$rTMP["id"]]["ctg_lab_tels"]                                         = $rTMP["ctg_lab_tels"];
    $arrTableLabPerfil[$rTMP["id"]]["ctg_lab_email"]                                         = $rTMP["ctg_lab_email"];
    $arrTableLabPerfil[$rTMP["id"]]["ctg_lab_enc_dpi"]                                         = $rTMP["ctg_lab_enc_dpi"];
    $arrTableLabPerfil[$rTMP["id"]]["ctg_lab_enc_nom1"]                                         = $rTMP["ctg_lab_enc_nom1"];
    $arrTableLabPerfil[$rTMP["id"]]["ctg_lab_enc_nom2"]                                         = $rTMP["ctg_lab_enc_nom2"];
    $arrTableLabPerfil[$rTMP["id"]]["ctg_lab_enc_ape1"]                                         = $rTMP["ctg_lab_enc_ape1"];
    $arrTableLabPerfil[$rTMP["id"]]["ctg_lab_enc_ape2"]                                         = $rTMP["ctg_lab_enc_ape2"];
    $arrTableLabPerfil[$rTMP["id"]]["ctg_lab_enc_ape3"]                                         = $rTMP["ctg_lab_enc_ape3"];
    $arrTableLabPerfil[$rTMP["id"]]["ctg_lab_enc_sexo"]                                         = $rTMP["ctg_lab_enc_sexo"];
    $arrTableLabPerfil[$rTMP["id"]]["ctg_lab_enc_civil"]                                         = $rTMP["ctg_lab_enc_civil"];
    $arrTableLabPerfil[$rTMP["id"]]["ctg_lab_enc_nac_dia"]                                         = $rTMP["ctg_lab_enc_nac_dia"];
    $arrTableLabPerfil[$rTMP["id"]]["ctg_lab_enc_nac_mes"]                                         = $rTMP["ctg_lab_enc_nac_mes"];
    $arrTableLabPerfil[$rTMP["id"]]["ctg_lab_enc_nac_ano"]                                         = $rTMP["ctg_lab_enc_nac_ano"];
    $arrTableLabPerfil[$rTMP["id"]]["ctg_lab_enc_dir"]                                         = $rTMP["ctg_lab_enc_dir"];
    $arrTableLabPerfil[$rTMP["id"]]["ctg_lab_enc_zona"]                                         = $rTMP["ctg_lab_enc_zona"];
    $arrTableLabPerfil[$rTMP["id"]]["ctg_lab_enc_dep"]                                         = $rTMP["ctg_lab_enc_dep"];
    $arrTableLabPerfil[$rTMP["id"]]["ctg_lab_enc_mun"]                                         = $rTMP["ctg_lab_enc_dep"];
    $arrTableLabPerfil[$rTMP["id"]]["ctg_lab_enc_cel"]                                         = $rTMP["ctg_lab_enc_cel"];
    $arrTableLabPerfil[$rTMP["id"]]["ctg_lab_enc_tels"]                                         = $rTMP["ctg_lab_enc_tels"];
    $arrTableLabPerfil[$rTMP["id"]]["ctg_lab_enc_email"]                                         = $rTMP["ctg_lab_enc_email"];
    $arrTableLabPerfil[$rTMP["id"]]["ctg_lab_username"]                                         = $rTMP["ctg_lab_username"];
    $arrTableLabPerfil[$rTMP["id"]]["ctg_lab_pass"]                                         = $rTMP["ctg_lab_pass"];
    $arrTableLabPerfil[$rTMP["id"]]["ctg_lab_estatus"]                                         = $rTMP["ctg_lab_estatus"];
    $arrTableLabPerfil[$rTMP["id"]]["ctg_lab_censuc"]                                         = $rTMP["ctg_lab_censuc"];
    $arrTableLabPerfil[$rTMP["id"]]["ctg_lab_sol_dt"]                                         = $rTMP["ctg_lab_sol_dt"];
    $arrTableLabPerfil[$rTMP["id"]]["ctg_lab_aut_dt"]                                         = $rTMP["ctg_lab_aut_dt"];
    $arrTableLabPerfil[$rTMP["id"]]["ctg_lab_ven_dt"]                                         = $rTMP["ctg_lab_ven_dt"];
    $arrTableLabPerfil[$rTMP["id"]]["ctg_lab_sta"]                                         = $rTMP["ctg_lab_sta"];
    $arrTableLabPerfil[$rTMP["id"]]["ctg_lab_dt"]                                         = $rTMP["ctg_lab_dt"];
    $arrTableLabPerfil[$rTMP["id"]]["ctg_lab_usr"]                                         = $rTMP["ctg_lab_usr"];
    $arrTableLabPerfil[$rTMP["id"]]["ctg_lab_pict"]                                         = $rTMP["ctg_lab_pict"];
}
pg_free_result($sql);



if (is_array($arrTableLabPerfil) && (count($arrTableLabPerfil) > 0)) {
    reset($arrTableLabPerfil);
    foreach ($arrTableLabPerfil as $rTMP['key'] => $rTMP['value']) {

        $id =  $rTMP["value"]['id'];
        $ctg_lab_contrato =  $rTMP["value"]['ctg_lab_contrato'];
        $ctg_lab_nit =  $rTMP["value"]['ctg_lab_nit'];
        $ctg_lab_nomcom =  $rTMP["value"]['ctg_lab_nomcom'];
        $ctg_lab_suc =  $rTMP["value"]['ctg_lab_suc'];
        $ctg_lab_code =  $rTMP["value"]['ctg_lab_code'];
        $ctg_lab_hortda1 =  $rTMP["value"]['ctg_lab_hortda1'];
        $ctg_lab_hortda2 =  $rTMP["value"]['ctg_lab_hortda2'];
        $ctg_lab_dir =  $rTMP["value"]['ctg_lab_dir'];
        $ctg_lab_zona =  $rTMP["value"]['ctg_lab_zona'];
        $ctg_lab_dep =  $rTMP["value"]['ctg_lab_dep'];
        $ctg_lab_mun =  $rTMP["value"]['ctg_lab_mun'];
        $ctg_lab_tels =  $rTMP["value"]['ctg_lab_tels'];
        $ctg_lab_email =  $rTMP["value"]['ctg_lab_email'];
        $ctg_lab_enc_dpi =  $rTMP["value"]['ctg_lab_enc_dpi'];
        $ctg_lab_enc_nom1 =  $rTMP["value"]['ctg_lab_enc_nom1'];
        $ctg_lab_enc_nom2 =  $rTMP["value"]['ctg_lab_enc_nom2'];
        $ctg_lab_enc_ape1 =  $rTMP["value"]['ctg_lab_enc_ape1'];
        $ctg_lab_enc_ape2 =  $rTMP["value"]['ctg_lab_enc_ape2'];
        $ctg_lab_enc_ape3 =  $rTMP["value"]['ctg_lab_enc_ape3'];
        $ctg_lab_enc_sexo =  $rTMP["value"]['ctg_lab_enc_sexo'];
        $ctg_lab_enc_civil =  $rTMP["value"]['ctg_lab_enc_civil'];
        $ctg_lab_enc_nac_dia =  $rTMP["value"]['ctg_lab_enc_nac_dia'];
        $ctg_lab_enc_nac_mes =  $rTMP["value"]['ctg_lab_enc_nac_mes'];
        $ctg_lab_enc_nac_ano =  $rTMP["value"]['ctg_lab_enc_nac_ano'];
        $ctg_lab_enc_dir =  $rTMP["value"]['ctg_lab_enc_dir'];
        $ctg_lab_enc_zona =  $rTMP["value"]['ctg_lab_enc_zona'];
        $ctg_lab_enc_dep =  $rTMP["value"]['ctg_lab_enc_dep'];
        $ctg_lab_enc_mun =  $rTMP["value"]['ctg_lab_enc_mun'];
        $ctg_lab_enc_cel =  $rTMP["value"]['ctg_lab_enc_cel'];
        $ctg_lab_enc_tels =  $rTMP["value"]['ctg_lab_enc_tels'];
        $ctg_lab_enc_email =  $rTMP["value"]['ctg_lab_enc_email'];
        $ctg_lab_username =  $rTMP["value"]['ctg_lab_username'];
        $ctg_lab_pass =  $rTMP["value"]['ctg_lab_pass'];
        $ctg_lab_estatus =  $rTMP["value"]['ctg_lab_estatus'];
        $ctg_lab_censuc =  $rTMP["value"]['ctg_lab_censuc'];
        $ctg_lab_sol_dt =  $rTMP["value"]['ctg_lab_sol_dt'];
        $ctg_lab_aut_dt =  $rTMP["value"]['ctg_lab_aut_dt'];
        $ctg_lab_ven_dt =  $rTMP["value"]['ctg_lab_ven_dt'];
        $ctg_lab_sta =  $rTMP["value"]['ctg_lab_sta'];
        $ctg_lab_dt =  $rTMP["value"]['ctg_lab_dt'];
        $ctg_lab_usr =  $rTMP["value"]['ctg_lab_usr'];
        $ctg_lab_pict =  $rTMP["value"]['ctg_lab_pict'];
    }
}

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


$arrEspecialidad = array();
$var_consulta = "SELECT * 
                    FROM ctg_especialidades 
                    ORDER BY ctg_esp_desc ";
$sql = pg_query($rmfAdm, $var_consulta);
$totalArticle = pg_num_rows($sql);


while ($rTMP = pg_fetch_assoc($sql)) {

    $arrEspecialidad[$rTMP["id"]]["id"]                                         = $rTMP["id"];
    $arrEspecialidad[$rTMP["id"]]["ctg_esp_desc"]                                = $rTMP["ctg_esp_desc"];
    $arrEspecialidad[$rTMP["id"]]["ctg_esp_cod"]                                = $rTMP["ctg_esp_cod"];
}
pg_free_result($sql);

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
<?php
// VALIDATION INSERT UPDATE DELETE

if (isset($_GET["validaciones"]) && !empty($_GET["validaciones"])) {
    require_once "../../api/globalFunctions.php";
    require_once "../../data/conexion/tmfAdm.php";
    require_once "../../api/config.php";

    $idUser = $_SESSION['adm_usr_id'];
    $idCode = $_SESSION['adm_usr_code'];

    $id_reg = isset($_POST["id_reg"]) ? $_POST["id_reg"]  : '';
    $ctg_hos_nomcom = isset($_POST["ctg_hos_nomcom"]) ? $_POST["ctg_hos_nomcom"]  : '';
    $ctg_hos_nit = isset($_POST["ctg_hos_nit"]) ? $_POST["ctg_hos_nit"]  : '';
    $ctg_hos_dir = isset($_POST["ctg_hos_dir"]) ? $_POST["ctg_hos_dir"]  : '';
    $ctg_hos_zona = isset($_POST["ctg_hos_zona"]) ? $_POST["ctg_hos_zona"]  : '';
    $region = isset($_POST["region"]) ? $_POST["region"]  : '';
    $distrito = isset($_POST["distrito"]) ? $_POST["distrito"]  : '';
    $ctg_hos_tels = isset($_POST["ctg_hos_tels"]) ? $_POST["ctg_hos_tels"]  : '';

    $ctg_hos_enc_dpi = isset($_POST["ctg_hos_enc_dpi"]) ? $_POST["ctg_hos_enc_dpi"]  : '';
    $ctg_hos_enc_nom1 = isset($_POST["ctg_hos_enc_nom1"]) ? $_POST["ctg_hos_enc_nom1"]  : '';
    $ctg_hos_enc_edad = isset($_POST["ctg_hos_enc_edad"]) ? $_POST["ctg_hos_enc_edad"]  : '';
    $sexo_ = isset($_POST["sexo_"]) ? $_POST["sexo_"]  : '';

    $fechaIng = date("Y-m-d");
    $usuario = $_SESSION['adm_usr_code'];

    $strTipoValidacion = isset($_REQUEST["validaciones"]) ? $_REQUEST["validaciones"] : '';

    if ($strTipoValidacion == "update") {
        header('Content-Type: application/json');
        $var_consulta = "UPDATE ctg_hospitales SET ctg_hos_tels= '$ctg_hos_tels',ctg_hos_dir= '$ctg_hos_dir', ctg_hos_zona = '$ctg_hos_zona' ,ctg_hos_dep = '$region' ,ctg_hos_mun = '$distrito' ,ctg_hos_enc_dpi = '$ctg_hos_enc_dpi' ,ctg_hos_enc_nomcom = '$ctg_hos_enc_nom1' ,ctg_hos_enc_sexo = '$sexo_' WHERE id = '$id_reg';";
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
        print_r($strReg);


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
                <option value="<?php echo  $rTMP["value"]['id']; ?>"><?php echo  $rTMP["value"]['geo_desc']; ?></option>

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

            $rs = pg_query($rmfAdm, "SELECT ctg_hos_pict FROM ctg_hospitales WHERE ctg_hos_code = '$idCode'");
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

            @chmod("../../asset/img/hospital/perfil/", 0777);
            $strRespuesta = save_file_image("archivo", "hospital/perfil/", "", 0, true, true, false);

            if (!empty($strRespuesta)) {
                $var_consulta = "UPDATE ctg_hospitales SET ctg_hos_pict = '$strRespuesta' WHERE ctg_hos_code = '$idCode'";
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

$Code = $_SESSION['adm_usr_contrato'];
$arrTableHosPerfil = array();
$var_consulta = "SELECT * 
                    FROM ctg_hospitales
                    WHERE ctg_hos_contrato = '$Code'
                    LIMIT 1";
$sql = pg_query($rmfAdm, $var_consulta);
//print_r($Code);

$totalArticle = pg_num_rows($sql);


while ($rTMP = pg_fetch_assoc($sql)) {

    $arrTableHosPerfil[$rTMP["id"]]["id"]                                         = $rTMP["id"];
    $arrTableHosPerfil[$rTMP["id"]]["ctg_hos_contrato"]                                         = $rTMP["ctg_hos_contrato"];
    $arrTableHosPerfil[$rTMP["id"]]["ctg_hos_nit"]                                         = $rTMP["ctg_hos_nit"];
    $arrTableHosPerfil[$rTMP["id"]]["ctg_hos_nomcom"]                                         = $rTMP["ctg_hos_nomcom"];
    $arrTableHosPerfil[$rTMP["id"]]["ctg_hos_code"]                                         = $rTMP["ctg_hos_code"];
    $arrTableHosPerfil[$rTMP["id"]]["ctg_hos_dir"]                                         = $rTMP["ctg_hos_dir"];
    $arrTableHosPerfil[$rTMP["id"]]["ctg_hos_zona"]                                         = $rTMP["ctg_hos_zona"];
    $arrTableHosPerfil[$rTMP["id"]]["ctg_hos_dep"]                                         = $rTMP["ctg_hos_dep"];
    $arrTableHosPerfil[$rTMP["id"]]["ctg_hos_mun"]                                         = $rTMP["ctg_hos_mun"];
    $arrTableHosPerfil[$rTMP["id"]]["ctg_hos_tels"]                                         = $rTMP["ctg_hos_tels"];
    $arrTableHosPerfil[$rTMP["id"]]["ctg_hos_email"]                                         = $rTMP["ctg_hos_email"];
    $arrTableHosPerfil[$rTMP["id"]]["ctg_hos_enc_dpi"]                                         = $rTMP["ctg_hos_enc_dpi"];
    $arrTableHosPerfil[$rTMP["id"]]["ctg_hos_enc_nomcom"]                                         = $rTMP["ctg_hos_enc_nomcom"];
    $arrTableHosPerfil[$rTMP["id"]]["ctg_hos_enc_sexo"]                                         = $rTMP["ctg_hos_enc_sexo"];
    $arrTableHosPerfil[$rTMP["id"]]["ctg_hos_enc_civil"]                                         = $rTMP["ctg_hos_enc_civil"];
    $arrTableHosPerfil[$rTMP["id"]]["ctg_hos_enc_nac_dia"]                                         = $rTMP["ctg_hos_enc_nac_dia"];
    $arrTableHosPerfil[$rTMP["id"]]["ctg_hos_enc_nac_mes"]                                         = $rTMP["ctg_hos_enc_nac_mes"];
    $arrTableHosPerfil[$rTMP["id"]]["ctg_hos_enc_nac_ano"]                                         = $rTMP["ctg_hos_enc_nac_ano"];
    $arrTableHosPerfil[$rTMP["id"]]["ctg_hos_enc_dir"]                                         = $rTMP["ctg_hos_enc_dir"];
    $arrTableHosPerfil[$rTMP["id"]]["ctg_hos_enc_zona"]                                         = $rTMP["ctg_hos_enc_zona"];
    $arrTableHosPerfil[$rTMP["id"]]["ctg_hos_enc_dep"]                                         = $rTMP["ctg_hos_enc_dep"];
    $arrTableHosPerfil[$rTMP["id"]]["ctg_hos_enc_mun"]                                         = $rTMP["ctg_hos_enc_mun"];
    $arrTableHosPerfil[$rTMP["id"]]["ctg_hos_enc_cel"]                                         = $rTMP["ctg_hos_enc_cel"];
    $arrTableHosPerfil[$rTMP["id"]]["ctg_hos_enc_tels"]                                         = $rTMP["ctg_hos_enc_tels"];
    $arrTableHosPerfil[$rTMP["id"]]["ctg_hos_enc_email"]                                         = $rTMP["ctg_hos_enc_email"];
    $arrTableHosPerfil[$rTMP["id"]]["ctg_hos_username"]                                         = $rTMP["ctg_hos_username"];
    $arrTableHosPerfil[$rTMP["id"]]["ctg_hos_pass"]                                         = $rTMP["ctg_hos_pass"];
    $arrTableHosPerfil[$rTMP["id"]]["ctg_hos_estatus"]                                         = $rTMP["ctg_hos_estatus"];
    $arrTableHosPerfil[$rTMP["id"]]["ctg_hos_sol_dt"]                                         = $rTMP["ctg_hos_sol_dt"];
    $arrTableHosPerfil[$rTMP["id"]]["ctg_hos_aut_dt"]                                         = $rTMP["ctg_hos_aut_dt"];
    $arrTableHosPerfil[$rTMP["id"]]["ctg_hos_ven_dt"]                                         = $rTMP["ctg_hos_ven_dt"];
    $arrTableHosPerfil[$rTMP["id"]]["ctg_hos_sta"]                                         = $rTMP["ctg_hos_sta"];
    $arrTableHosPerfil[$rTMP["id"]]["ctg_hos_dt"]                                         = $rTMP["ctg_hos_dt"];
    $arrTableHosPerfil[$rTMP["id"]]["ctg_hos_usr"]                                         = $rTMP["ctg_hos_usr"];
    $arrTableHosPerfil[$rTMP["id"]]["ctg_hos_pict"]                                         = $rTMP["ctg_hos_pict"];
}
pg_free_result($sql);



if (is_array($arrTableHosPerfil) && (count($arrTableHosPerfil) > 0)) {
    reset($arrTableHosPerfil);
    foreach ($arrTableHosPerfil as $rTMP['key'] => $rTMP['value']) {

        $id =  $rTMP["value"]['id'];
        $ctg_hos_contrato  =  $rTMP["value"]['ctg_hos_contrato'];
        $ctg_hos_nit  =  $rTMP["value"]['ctg_hos_nit'];
        $ctg_hos_nomcom  =  $rTMP["value"]['ctg_hos_nomcom'];
        $ctg_hos_code  =  $rTMP["value"]['ctg_hos_code'];
        $ctg_hos_dir  =  $rTMP["value"]['ctg_hos_dir'];
        $ctg_hos_zona  =  $rTMP["value"]['ctg_hos_zona'];
        $ctg_hos_dep  =  $rTMP["value"]['ctg_hos_dep'];
        $ctg_hos_mun  =  $rTMP["value"]['ctg_hos_mun'];
        $ctg_hos_tels  =  $rTMP["value"]['ctg_hos_tels'];
        $ctg_hos_email  =  $rTMP["value"]['ctg_hos_email'];
        $ctg_hos_enc_dpi  =  $rTMP["value"]['ctg_hos_enc_dpi'];
        $ctg_hos_enc_nomcom  =  $rTMP["value"]['ctg_hos_enc_nomcom'];
        $ctg_hos_enc_sexo  =  $rTMP["value"]['ctg_hos_enc_sexo'];
        $ctg_hos_enc_civil  =  $rTMP["value"]['ctg_hos_enc_civil'];
        $ctg_hos_enc_nac_dia  =  $rTMP["value"]['ctg_hos_enc_nac_dia'];
        $ctg_hos_enc_nac_mes  =  $rTMP["value"]['ctg_hos_enc_nac_mes'];
        $ctg_hos_enc_nac_ano  =  $rTMP["value"]['ctg_hos_enc_nac_ano'];
        $ctg_hos_enc_dir  =  $rTMP["value"]['ctg_hos_enc_dir'];
        $ctg_hos_enc_zona  =  $rTMP["value"]['ctg_hos_enc_zona'];
        $ctg_hos_enc_dep  =  $rTMP["value"]['ctg_hos_enc_dep'];
        $ctg_hos_enc_mun  =  $rTMP["value"]['ctg_hos_enc_mun'];
        $ctg_hos_enc_cel  =  $rTMP["value"]['ctg_hos_enc_cel'];
        $ctg_hos_enc_tels  =  $rTMP["value"]['ctg_hos_enc_tels'];
        $ctg_hos_enc_email  =  $rTMP["value"]['ctg_hos_enc_email'];
        $ctg_hos_username  =  $rTMP["value"]['ctg_hos_username'];
        $ctg_hos_pass  =  $rTMP["value"]['ctg_hos_pass'];
        $ctg_hos_estatus  =  $rTMP["value"]['ctg_hos_estatus'];
        $ctg_hos_sol_dt  =  $rTMP["value"]['ctg_hos_sol_dt'];
        $ctg_hos_aut_dt  =  $rTMP["value"]['ctg_hos_aut_dt'];
        $ctg_hos_ven_dt  =  $rTMP["value"]['ctg_hos_ven_dt'];
        $ctg_hos_sta  =  $rTMP["value"]['ctg_hos_sta'];
        $ctg_hos_dt  =  $rTMP["value"]['ctg_hos_dt'];
        $ctg_hos_usr  =  $rTMP["value"]['ctg_hos_usr'];
        $ctg_hos_pict  =  $rTMP["value"]['ctg_hos_pict'];
        
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
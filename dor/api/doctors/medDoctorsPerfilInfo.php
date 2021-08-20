<?php
if (isset($_GET["validaciones"]) && !empty($_GET["validaciones"])) {
    require_once "../../api/globalFunctions.php";
    require_once "../../data/conexion/tmfAdm.php";
    require_once "../../api/config.php";

    $id = $_SESSION['adm_usr_id'];
    $id_p = isset($_POST["id_p"]) ? $_POST["id_p"]  : '';
    $colegiado = isset($_POST["colegiado_"]) ? $_POST["colegiado_"]  : '';
    $nombre = isset($_POST["nombre_"]) ? $_POST["nombre_"]  : '';
    $apellido = isset($_POST["apellido_"]) ? $_POST["apellido_"]  : '';
    $sexo = isset($_POST["sexo_"]) ? $_POST["sexo_"]  : 0;
    $direccion = isset($_POST["direccion_"]) ? $_POST["direccion_"]  : '';
    $zona = isset($_POST["zona_"]) ? $_POST["zona_"]  : 0;
    $espec = isset($_POST["espec_"]) ? $_POST["espec_"]  : '';
    $tell = isset($_POST["tell_"]) ? $_POST["tell_"]  : 00000000;
    $municipio = isset($_POST["distrito"]) ? $_POST["distrito"]  : 0;
    $departamento = isset($_POST["region"]) ? $_POST["region"]  : 0;
    $informacion = isset($_POST["informacion_"]) ? $_POST["informacion_"]  : '';

    $ctg_med_cli_11 = isset($_POST["ctg_med_cli_11"]) ? $_POST["ctg_med_cli_11"]  : ' ';
    $ctg_med_cli_12 = isset($_POST["ctg_med_cli_12"]) ? $_POST["ctg_med_cli_12"]  : ' ';
    $ctg_med_cli_21 = isset($_POST["ctg_med_cli_21"]) ? $_POST["ctg_med_cli_21"]  : ' ';
    $ctg_med_cli_22 = isset($_POST["ctg_med_cli_22"]) ? $_POST["ctg_med_cli_22"]  : ' ';
    $ctg_med_cli_31 = isset($_POST["ctg_med_cli_31"]) ? $_POST["ctg_med_cli_31"]  : ' ';
    $ctg_med_cli_32 = isset($_POST["ctg_med_cli_32"]) ? $_POST["ctg_med_cli_32"]  : ' ';
    $ctg_med_cli_41 = isset($_POST["ctg_med_cli_41"]) ? $_POST["ctg_med_cli_41"]  : ' ';
    $ctg_med_cli_42 = isset($_POST["ctg_med_cli_42"]) ? $_POST["ctg_med_cli_42"]  : ' ';
    $ctg_med_cli_51 = isset($_POST["ctg_med_cli_51"]) ? $_POST["ctg_med_cli_51"]  : ' ';
    $ctg_med_cli_52 = isset($_POST["ctg_med_cli_52"]) ? $_POST["ctg_med_cli_52"]  : ' ';
    $ctg_med_cli_61 = isset($_POST["ctg_med_cli_61"]) ? $_POST["ctg_med_cli_61"]  : ' ';
    $ctg_med_cli_62 = isset($_POST["ctg_med_cli_62"]) ? $_POST["ctg_med_cli_62"]  : ' ';
    $ctg_med_cli_pweb  = isset($_POST["ctg_med_cli_pweb"]) ? $_POST["ctg_med_cli_pweb"]  : '#';
    $ctg_med_cli_pweb  = trim($ctg_med_cli_pweb);
    $ctg_med_cli_email = isset($_POST["ctg_med_cli_email"]) ? $_POST["ctg_med_cli_email"]  : ' ';
    $ctg_med_cli_dir = isset($_POST["ctg_med_cli_dir"]) ? $_POST["ctg_med_cli_dir"]  : ' ';
    $ctg_med_cli_tel1 = isset($_POST["ctg_med_cli_tel1"]) ? $_POST["ctg_med_cli_tel1"]  : ' ';
    $ctg_med_cli_tel2 = isset($_POST["ctg_med_cli_tel2"]) ? $_POST["ctg_med_cli_tel2"]  : ' ';
    $ctg_med_cli_tel3 = isset($_POST["ctg_med_cli_tel3"]) ? $_POST["ctg_med_cli_tel3"]  : ' ';
    $ctg_med_cli_tel4 = isset($_POST["ctg_med_cli_tel4"]) ? $_POST["ctg_med_cli_tel4"]  : ' ';
    $ctg_med_cli_tel5 = isset($_POST["ctg_med_cli_tel5"]) ? $_POST["ctg_med_cli_tel5"]  : ' ';

    $fechaIng = date("Y-m-d");
    $usuario = $_SESSION['adm_usr_code'];

    $strTipoValidacion = isset($_REQUEST["validaciones"]) ? $_REQUEST["validaciones"] : '';

    if ($strTipoValidacion == "update") {
        header('Content-Type: application/json');
        $var_consulta = "UPDATE ctg_medicos SET ctg_med_nombres = '$nombre' ,ctg_med_apellidos = '$apellido',ctg_med_sexo = '$sexo' ,ctg_med_dir = '$direccion' ,ctg_med_zona = '$zona' ,ctg_med_telpar = '$tell' ,ctg_med_esp = '$espec' ,ctg_med_dep = '$departamento' ,ctg_med_mun = '$municipio' ,ctg_med_infpro = '$informacion' ,ctg_med_dt = '$fechaIng',ctg_med_usr = '$usuario',ctg_med_cli_11 = '$ctg_med_cli_11' ,ctg_med_cli_12 = '$ctg_med_cli_12',ctg_med_cli_21 = '$ctg_med_cli_21' ,ctg_med_cli_22 = '$ctg_med_cli_22' ,ctg_med_cli_31 = '$ctg_med_cli_31' ,ctg_med_cli_32 = '$ctg_med_cli_32' ,ctg_med_cli_41 = '$ctg_med_cli_41' ,ctg_med_cli_42 = '$ctg_med_cli_42' ,ctg_med_cli_51 = '$ctg_med_cli_51' ,ctg_med_cli_52 = '$ctg_med_cli_52' ,ctg_med_cli_61 = '$ctg_med_cli_61',ctg_med_cli_62 = '$ctg_med_cli_62',ctg_med_cli_pweb = '$ctg_med_cli_pweb',ctg_med_cli_email = '$ctg_med_cli_email',ctg_med_cli_dir = '$ctg_med_cli_dir',ctg_med_cli_tel1 = '$ctg_med_cli_tel1',ctg_med_cli_tel2 = '$ctg_med_cli_tel2',ctg_med_cli_tel3 = '$ctg_med_cli_tel3',ctg_med_cli_tel4 = '$ctg_med_cli_tel4',ctg_med_cli_tel5 = '$ctg_med_cli_tel5' WHERE id = '$id_p'";
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
    } else if ($strTipoValidacion == "validacion_colegiado") {

        $intData = isset($_GET["colegiado_"]) ? intval($_GET["colegiado_"]) : "";

        $boolExiste = false;

        if ($intData) {

            $var_consulta = "SELECT * FROM ctg_medicos WHERE ctg_med_col  = '$intData'";
            if (pg_query($rmfAdm, $var_consulta)) {
                $boolExiste = true;
            } else {
                echo "Error: " . $var_consulta . "<br>";
            }
        }

        $strTextoFinal = $boolExiste ? "Y" : "N";
        print $strTextoFinal;
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

            $rs = pg_query($rmfAdm, "SELECT ctg_med_cli_pict FROM ctg_medicos WHERE ctg_med_code = '$idWeb'");
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

            @chmod("../../asset/img/doctor/perfil/", 0777);
            $strRespuesta = save_file_image("archivo", "doctor/perfil/", "", 0, true, true, false);

            if (!empty($strRespuesta)) {
                $var_consulta = "UPDATE ctg_medicos SET ctg_med_cli_pict = '$strRespuesta' WHERE ctg_med_code = '$idWeb';";
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

require_once "../../api/globalFunctions.php";
require_once "../../data/conexion/tmfAdm.php";
require_once "../../api/config.php";
$idWeb = $_SESSION['adm_usr_code'];
$arrTableMedicPerfil = array();
$var_consulta = "SELECT * 
                    FROM ctg_medicos 
                    WHERE ctg_med_code = '$idWeb'
                    LIMIT 1";
$sql = pg_query($rmfAdm, $var_consulta);
$totalArticle = pg_num_rows($sql);


while ($rTMP = pg_fetch_assoc($sql)) {

    $arrTableMedicPerfil[$rTMP["id"]]["id"]                                         = $rTMP["id"];
    $arrTableMedicPerfil[$rTMP["id"]]["ctg_med_col"]                                = $rTMP["ctg_med_col"];
    $arrTableMedicPerfil[$rTMP["id"]]["ctg_med_dpi"]                                = $rTMP["ctg_med_dpi"];
    $arrTableMedicPerfil[$rTMP["id"]]["ctg_med_code"]                               = $rTMP["ctg_med_code"];
    $arrTableMedicPerfil[$rTMP["id"]]["ctg_med_nombres"]                            = $rTMP["ctg_med_nombres"];
    $arrTableMedicPerfil[$rTMP["id"]]["ctg_med_apellidos"]                          = $rTMP["ctg_med_apellidos"];
    $arrTableMedicPerfil[$rTMP["id"]]["ctg_med_esp"]                                = $rTMP["ctg_med_esp"];
    $arrTableMedicPerfil[$rTMP["id"]]["ctg_med_espotr"]                             = $rTMP["ctg_med_espotr"];
    $arrTableMedicPerfil[$rTMP["id"]]["ctg_med_sexo"]                               = $rTMP["ctg_med_sexo"];
    $arrTableMedicPerfil[$rTMP["id"]]["ctg_med_civil"]                              = $rTMP["ctg_med_civil"];
    $arrTableMedicPerfil[$rTMP["id"]]["ctg_med_nac_dia"]                            = $rTMP["ctg_med_nac_dia"];
    $arrTableMedicPerfil[$rTMP["id"]]["ctg_med_nac_mes"]                            = $rTMP["ctg_med_nac_mes"];
    $arrTableMedicPerfil[$rTMP["id"]]["ctg_med_nac_ano"]                            = $rTMP["ctg_med_nac_ano"];
    $arrTableMedicPerfil[$rTMP["id"]]["ctg_med_dir"]                                = $rTMP["ctg_med_dir"];
    $arrTableMedicPerfil[$rTMP["id"]]["ctg_med_zona"]                               = $rTMP["ctg_med_zona"];
    $arrTableMedicPerfil[$rTMP["id"]]["ctg_med_dep"]                                = $rTMP["ctg_med_dep"];
    $arrTableMedicPerfil[$rTMP["id"]]["ctg_med_mun"]                                = $rTMP["ctg_med_mun"];
    $arrTableMedicPerfil[$rTMP["id"]]["ctg_med_telcel"]                             = $rTMP["ctg_med_telcel"];
    $arrTableMedicPerfil[$rTMP["id"]]["ctg_med_telpar"]                             = $rTMP["ctg_med_telpar"];
    $arrTableMedicPerfil[$rTMP["id"]]["ctg_med_email"]                              = $rTMP["ctg_med_email"];
    $arrTableMedicPerfil[$rTMP["id"]]["ctg_med_val_con"]                            = $rTMP["ctg_med_val_con"];
    $arrTableMedicPerfil[$rTMP["id"]]["ctg_med_sol_dt"]                             = $rTMP["ctg_med_sol_dt"];
    $arrTableMedicPerfil[$rTMP["id"]]["ctg_med_aut_dt"]                             = $rTMP["ctg_med_aut_dt"];
    $arrTableMedicPerfil[$rTMP["id"]]["ctg_med_ven_dt"]                             = $rTMP["ctg_med_ven_dt"];
    $arrTableMedicPerfil[$rTMP["id"]]["ctg_med_pass"]                               = $rTMP["ctg_med_pass"];
    $arrTableMedicPerfil[$rTMP["id"]]["ctg_med_username"]                           = $rTMP["ctg_med_username"];
    $arrTableMedicPerfil[$rTMP["id"]]["ctg_med_estatus"]                            = $rTMP["ctg_med_estatus"];
    $arrTableMedicPerfil[$rTMP["id"]]["ctg_med_infpro"]                             = $rTMP["ctg_med_infpro"];
    $arrTableMedicPerfil[$rTMP["id"]]["ctg_med_sta"]                                = $rTMP["ctg_med_sta"];
    $arrTableMedicPerfil[$rTMP["id"]]["ctg_med_dt"]                                 = $rTMP["ctg_med_dt"];
    $arrTableMedicPerfil[$rTMP["id"]]["ctg_med_usr"]                               = $rTMP["ctg_med_usr"];
    $arrTableMedicPerfil[$rTMP["id"]]["id_med_web"]                                = $rTMP["id_med_web"];
    $arrTableMedicPerfil[$rTMP["id"]]["ctg_med_cli_11"]                            = $rTMP["ctg_med_cli_11"];
    $arrTableMedicPerfil[$rTMP["id"]]["ctg_med_cli_12"]                            = $rTMP["ctg_med_cli_12"];
    $arrTableMedicPerfil[$rTMP["id"]]["ctg_med_cli_21"]                            = $rTMP["ctg_med_cli_21"];
    $arrTableMedicPerfil[$rTMP["id"]]["ctg_med_cli_22"]                            = $rTMP["ctg_med_cli_22"];
    $arrTableMedicPerfil[$rTMP["id"]]["ctg_med_cli_31"]                            = $rTMP["ctg_med_cli_31"];
    $arrTableMedicPerfil[$rTMP["id"]]["ctg_med_cli_32"]                            = $rTMP["ctg_med_cli_32"];
    $arrTableMedicPerfil[$rTMP["id"]]["ctg_med_cli_41"]                            = $rTMP["ctg_med_cli_41"];
    $arrTableMedicPerfil[$rTMP["id"]]["ctg_med_cli_42"]                            = $rTMP["ctg_med_cli_42"];
    $arrTableMedicPerfil[$rTMP["id"]]["ctg_med_cli_51"]                            = $rTMP["ctg_med_cli_51"];
    $arrTableMedicPerfil[$rTMP["id"]]["ctg_med_cli_52"]                            = $rTMP["ctg_med_cli_52"];
    $arrTableMedicPerfil[$rTMP["id"]]["ctg_med_cli_61"]                            = $rTMP["ctg_med_cli_61"];
    $arrTableMedicPerfil[$rTMP["id"]]["ctg_med_cli_62"]                            = $rTMP["ctg_med_cli_62"];
    $arrTableMedicPerfil[$rTMP["id"]]["ctg_med_cli_pweb"]                          = $rTMP["ctg_med_cli_pweb"];
    $arrTableMedicPerfil[$rTMP["id"]]["ctg_med_cli_email"]                         = $rTMP["ctg_med_cli_email"];
    $arrTableMedicPerfil[$rTMP["id"]]["ctg_med_cli_dir"]                           = $rTMP["ctg_med_cli_dir"];
    $arrTableMedicPerfil[$rTMP["id"]]["ctg_med_cli_tel1"]                          = $rTMP["ctg_med_cli_tel1"];
    $arrTableMedicPerfil[$rTMP["id"]]["ctg_med_cli_tel2"]                          = $rTMP["ctg_med_cli_tel2"];
    $arrTableMedicPerfil[$rTMP["id"]]["ctg_med_cli_tel3"]                          = $rTMP["ctg_med_cli_tel3"];
    $arrTableMedicPerfil[$rTMP["id"]]["ctg_med_cli_tel4"]                          = $rTMP["ctg_med_cli_tel4"];
    $arrTableMedicPerfil[$rTMP["id"]]["ctg_med_cli_tel5"]                          = $rTMP["ctg_med_cli_tel5"];
    $arrTableMedicPerfil[$rTMP["id"]]["ctg_med_cli_pict"]                          = $rTMP["ctg_med_cli_pict"];
}
pg_free_result($sql);



if (is_array($arrTableMedicPerfil) && (count($arrTableMedicPerfil) > 0)) {
    reset($arrTableMedicPerfil);
    foreach ($arrTableMedicPerfil as $rTMP['key'] => $rTMP['value']) {

        $id_p =  $rTMP["value"]['id'];
        $colegiado =  $rTMP["value"]['ctg_med_col'];
        $nombre =  $rTMP["value"]['ctg_med_nombres'];
        $apellido =  $rTMP["value"]['ctg_med_apellidos'];
        $sexo =  $rTMP["value"]['ctg_med_sexo'];
        $departamento =  $rTMP["value"]['ctg_med_dep'];
        $municipio =  $rTMP["value"]['ctg_med_mun'];
        $informacion =  $rTMP["value"]['ctg_med_infpro'];
        $direccion =  $rTMP["value"]['ctg_med_dir'];
        $telefono =  $rTMP["value"]['ctg_med_telpar'];
        $zona =  $rTMP["value"]['ctg_med_zona'];
        $esp =  $rTMP["value"]['ctg_med_esp'];
        $ctg_med_cli_11 =  $rTMP["value"]['ctg_med_cli_11'];
        $ctg_med_cli_12 =  $rTMP["value"]['ctg_med_cli_12'];
        $ctg_med_cli_21 =  $rTMP["value"]['ctg_med_cli_21'];
        $ctg_med_cli_22 =  $rTMP["value"]['ctg_med_cli_22'];
        $ctg_med_cli_31 =  $rTMP["value"]['ctg_med_cli_31'];
        $ctg_med_cli_32 =  $rTMP["value"]['ctg_med_cli_32'];
        $ctg_med_cli_41 =  $rTMP["value"]['ctg_med_cli_41'];
        $ctg_med_cli_42 =  $rTMP["value"]['ctg_med_cli_42'];
        $ctg_med_cli_51 =  $rTMP["value"]['ctg_med_cli_51'];
        $ctg_med_cli_52 =  $rTMP["value"]['ctg_med_cli_52'];
        $ctg_med_cli_61 =  $rTMP["value"]['ctg_med_cli_61'];
        $ctg_med_cli_62 =  $rTMP["value"]['ctg_med_cli_62'];
        $ctg_med_cli_pweb =  $rTMP["value"]['ctg_med_cli_pweb'];
        $ctg_med_cli_email =  $rTMP["value"]['ctg_med_cli_email'];
        $ctg_med_cli_dir =  $rTMP["value"]['ctg_med_cli_dir'];
        $ctg_med_cli_tel1 =  $rTMP["value"]['ctg_med_cli_tel1'];
        $ctg_med_cli_tel2 =  $rTMP["value"]['ctg_med_cli_tel2'];
        $ctg_med_cli_tel3 =  $rTMP["value"]['ctg_med_cli_tel3'];
        $ctg_med_cli_tel4 =  $rTMP["value"]['ctg_med_cli_tel4'];
        $ctg_med_cli_tel5 =  $rTMP["value"]['ctg_med_cli_tel5'];
        $ctg_med_cli_pict =  $rTMP["value"]['ctg_med_cli_pict'];
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
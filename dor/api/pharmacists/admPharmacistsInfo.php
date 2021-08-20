<?php
// VALIDATION INSERT UPDATE DELETE

if (isset($_GET["validaciones"]) && !empty($_GET["validaciones"])) {
    require_once "../../api/globalFunctions.php";
    require_once "../../data/conexion/tmfAdm.php";
    require_once "../../api/config.php";

    $idUser = $_SESSION['adm_usr_id'];
    $idCode = $_SESSION['adm_usr_code'];
    $id_reg = isset($_POST["id_reg"]) ? $_POST["id_reg"]  : '';
    $ctg_far_nomcom = isset($_POST["ctg_far_nomcom"]) ? $_POST["ctg_far_nomcom"]  : '';
    $ctg_far_nit = isset($_POST["ctg_far_nit"]) ? $_POST["ctg_far_nit"]  : '';
    $ctg_far_suc = isset($_POST["ctg_far_suc"]) ? $_POST["ctg_far_suc"]  : '';
    $ctg_far_hortda1 = isset($_POST["ctg_far_hortda1"]) ? $_POST["ctg_far_hortda1"]  : '';
    $ctg_far_hortda2 = isset($_POST["ctg_far_hortda2"]) ? $_POST["ctg_far_hortda2"]  : '';
    $ctg_far_serdom1 = isset($_POST["ctg_far_serdom1"]) ? $_POST["ctg_far_serdom1"]  : '';
    $ctg_far_serdom2 = isset($_POST["ctg_far_serdom2"]) ? $_POST["ctg_far_serdom2"]  : '';
    $ctg_far_dir = isset($_POST["ctg_far_dir"]) ? $_POST["ctg_far_dir"]  : '';
    $ctg_far_zona = isset($_POST["ctg_far_zona"]) ? $_POST["ctg_far_zona"]  : '';
    $region = isset($_POST["region"]) ? $_POST["region"]  : '';
    $distrito = isset($_POST["distrito"]) ? $_POST["distrito"]  : '';

    $ctg_far_enc_dpi = isset($_POST["ctg_far_enc_dpi"]) ? $_POST["ctg_far_enc_dpi"]  : '';
    $ctg_far_enc_nombre = isset($_POST["ctg_far_enc_nombre"]) ? $_POST["ctg_far_enc_nombre"]  : '';
    $ctg_far_enc_edad = isset($_POST["ctg_far_enc_edad"]) ? $_POST["ctg_far_enc_edad"]  : '';
    $sexo_ = isset($_POST["sexo_"]) ? $_POST["sexo_"]  : '';

    $fechaIng = date("Y-m-d");
    $usuario = $_SESSION['adm_usr_id'];

    $strTipoValidacion = isset($_REQUEST["validaciones"]) ? $_REQUEST["validaciones"] : '';

    if ($strTipoValidacion == "update_1") {
        header('Content-Type: application/json');
        $var_consulta = "UPDATE ctg_farmacias_sucursales SET ctg_far_hortda1 = '$ctg_far_hortda1' ,ctg_far_hortda2 = '$ctg_far_hortda2' ,ctg_far_serdom1 = '$ctg_far_serdom1' ,ctg_far_serdom2 = '$ctg_far_serdom2' ,ctg_far_dir = '$ctg_far_dir' ,ctg_far_zona = '$ctg_far_zona' ,ctg_far_dep = '$region' ,ctg_far_mun = '$distrito' ,ctg_far_enc_dpi = '$ctg_far_enc_dpi' ,ctg_far_enc_nombre = '$ctg_far_enc_nombre' ,ctg_far_enc_sexo = '$sexo_' WHERE id = '$id_reg'";
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
    } else if ($strTipoValidacion == "update_0") {
        header('Content-Type: application/json');
        $var_consulta = "UPDATE ctg_farmacias_sucursales SET  ctg_far_dir = '$ctg_far_dir' ,ctg_far_zona = '$ctg_far_zona' ,ctg_far_dep = '$region' ,ctg_far_mun = '$distrito' WHERE id = '$id_reg'";
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

            $rs = pg_query($rmfAdm, "SELECT ctg_far_pict FROM ctg_farmacias_sucursales WHERE ctg_far_code = '$idCode'");
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

            @chmod("../../asset/img/farmacia/perfil/", 0777);
            $strRespuesta = save_file_image("archivo", "farmacia/perfil/", "", 0, true, true, false);

            if (!empty($strRespuesta)) {
                $var_consulta = "UPDATE ctg_farmacias_sucursales SET ctg_far_pict = '$strRespuesta' WHERE ctg_far_code = '$idCode'";
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

require_once "../../data/conexion/tmfAdm.php";

$sucursal = isset($_SESSION['sucursal']) ? $_SESSION['sucursal']  : '';

if ($sucursal == 1) {
    $adm_usr_code = isset($_SESSION['adm_usr_code']) ? $_SESSION['adm_usr_code']  : '';

    $arrTableFarmacPerfil = array();
    $var_consulta = "SELECT * 
                        FROM ctg_farmacias_sucursales 
                        WHERE ctg_far_code = '$adm_usr_code'
                        LIMIT 1";
    $sql = pg_query($rmfAdm, $var_consulta);
    //print_r($var_consulta);
    $totalArticle = pg_num_rows($sql);


    while ($rTMP = pg_fetch_assoc($sql)) {

        $arrTableFarmacPerfil[$rTMP["id"]]["id"]                                         = $rTMP["id"];
        $arrTableFarmacPerfil[$rTMP["id"]]["ctg_far_contrato"]                                         = $rTMP["ctg_far_contrato"];
        $arrTableFarmacPerfil[$rTMP["id"]]["ctg_far_nit"]                                         = $rTMP["ctg_far_nit"];
        $arrTableFarmacPerfil[$rTMP["id"]]["ctg_far_nomcom"]                                         = $rTMP["ctg_far_nomcom"];
        $arrTableFarmacPerfil[$rTMP["id"]]["ctg_far_suc"]                                         = $rTMP["ctg_far_suc"];
        $arrTableFarmacPerfil[$rTMP["id"]]["ctg_far_code"]                                         = $rTMP["ctg_far_code"];
        $arrTableFarmacPerfil[$rTMP["id"]]["ctg_far_servicio"]                                         = $rTMP["ctg_far_servicio"];
        $arrTableFarmacPerfil[$rTMP["id"]]["ctg_far_hortda1"]                                         = $rTMP["ctg_far_hortda1"];
        $arrTableFarmacPerfil[$rTMP["id"]]["ctg_far_hortda2"]                                         = $rTMP["ctg_far_hortda2"];
        $arrTableFarmacPerfil[$rTMP["id"]]["ctg_far_serdom1"]                                         = $rTMP["ctg_far_serdom1"];
        $arrTableFarmacPerfil[$rTMP["id"]]["ctg_far_serdom2"]                                         = $rTMP["ctg_far_serdom2"];
        $arrTableFarmacPerfil[$rTMP["id"]]["ctg_far_dir"]                                         = $rTMP["ctg_far_dir"];
        $arrTableFarmacPerfil[$rTMP["id"]]["ctg_far_zona"]                                         = $rTMP["ctg_far_zona"];
        $arrTableFarmacPerfil[$rTMP["id"]]["ctg_far_dep"]                                         = $rTMP["ctg_far_dep"];
        $arrTableFarmacPerfil[$rTMP["id"]]["ctg_far_mun"]                                         = $rTMP["ctg_far_mun"];
        $arrTableFarmacPerfil[$rTMP["id"]]["ctg_far_tels"]                                         = $rTMP["ctg_far_tels"];
        $arrTableFarmacPerfil[$rTMP["id"]]["ctg_far_email"]                                         = $rTMP["ctg_far_email"];
        $arrTableFarmacPerfil[$rTMP["id"]]["ctg_far_enc_dpi"]                                         = $rTMP["ctg_far_enc_dpi"];
        $arrTableFarmacPerfil[$rTMP["id"]]["ctg_far_enc_nombre"]                                         = $rTMP["ctg_far_enc_nombre"];
        $arrTableFarmacPerfil[$rTMP["id"]]["ctg_far_enc_sexo"]                                         = $rTMP["ctg_far_enc_sexo"];
        $arrTableFarmacPerfil[$rTMP["id"]]["ctg_far_enc_edad"]                                         = $rTMP["ctg_far_enc_edad"];
        $arrTableFarmacPerfil[$rTMP["id"]]["ctg_far_enc_cel"]                                         = $rTMP["ctg_far_enc_cel"];
        $arrTableFarmacPerfil[$rTMP["id"]]["ctg_far_username"]                                         = $rTMP["ctg_far_username"];
        $arrTableFarmacPerfil[$rTMP["id"]]["ctg_far_pass"]                                         = $rTMP["ctg_far_pass"];
        $arrTableFarmacPerfil[$rTMP["id"]]["ctg_far_estatus"]                                         = $rTMP["ctg_far_estatus"];
        $arrTableFarmacPerfil[$rTMP["id"]]["ctg_far_censuc"]                                         = $rTMP["ctg_far_censuc"];
        $arrTableFarmacPerfil[$rTMP["id"]]["ctg_far_sol_dt"]                                         = $rTMP["ctg_far_sol_dt"];
        $arrTableFarmacPerfil[$rTMP["id"]]["ctg_far_aut_dt"]                                         = $rTMP["ctg_far_aut_dt"];
        $arrTableFarmacPerfil[$rTMP["id"]]["ctg_far_ven_dt"]                                         = $rTMP["ctg_far_ven_dt"];
        $arrTableFarmacPerfil[$rTMP["id"]]["ctg_far_sta"]                                         = $rTMP["ctg_far_sta"];
        $arrTableFarmacPerfil[$rTMP["id"]]["ctg_far_dt"]                                         = $rTMP["ctg_far_dt"];
        $arrTableFarmacPerfil[$rTMP["id"]]["ctg_far_usr"]                                         = $rTMP["ctg_far_usr"];
        $arrTableFarmacPerfil[$rTMP["id"]]["ctg_far_pict"]                                         = $rTMP["ctg_far_pict"];
    }
    pg_free_result($sql);



    if (is_array($arrTableFarmacPerfil) && (count($arrTableFarmacPerfil) > 0)) {
        reset($arrTableFarmacPerfil);
        foreach ($arrTableFarmacPerfil as $rTMP['key'] => $rTMP['value']) {

            $id =  $rTMP["value"]['id'];
            $ctg_far_contrato =  $rTMP["value"]['ctg_far_contrato'];
            $ctg_far_nit =  $rTMP["value"]['ctg_far_nit'];
            $ctg_far_nomcom =  $rTMP["value"]['ctg_far_nomcom'];
            $ctg_far_suc =  $rTMP["value"]['ctg_far_suc'];
            $ctg_far_code =  $rTMP["value"]['ctg_far_code'];
            $ctg_far_servicio =  $rTMP["value"]['ctg_far_servicio'];
            $ctg_far_hortda1 =  $rTMP["value"]['ctg_far_hortda1'];
            //date_format($ctg_far_hortda1, 'Y/m/d H:i:s');
            $ctg_far_hortda2 =  $rTMP["value"]['ctg_far_hortda2'];
            $ctg_far_serdom1 =  $rTMP["value"]['ctg_far_serdom1'];
            $ctg_far_serdom2 =  $rTMP["value"]['ctg_far_serdom2'];
            $ctg_far_dir =  $rTMP["value"]['ctg_far_dir'];
            $ctg_far_zona =  $rTMP["value"]['ctg_far_zona'];
            $ctg_far_dep =  $rTMP["value"]['ctg_far_dep'];
            $ctg_far_mun =  $rTMP["value"]['ctg_far_mun'];
            $ctg_far_tels =  $rTMP["value"]['ctg_far_tels'];
            $ctg_far_email =  $rTMP["value"]['ctg_far_email'];
            $ctg_far_enc_dpi =  $rTMP["value"]['ctg_far_enc_dpi'];
            $ctg_far_enc_nombre =  $rTMP["value"]['ctg_far_enc_nombre'];
            $ctg_far_enc_sexo =  $rTMP["value"]['ctg_far_enc_sexo'];
            $ctg_far_enc_edad =  $rTMP["value"]['ctg_far_enc_edad'];
            $ctg_far_enc_cel =  $rTMP["value"]['ctg_far_enc_cel'];
            $ctg_far_username =  $rTMP["value"]['ctg_far_username'];
            $ctg_far_pass =  $rTMP["value"]['ctg_far_pass'];
            $ctg_far_estatus =  $rTMP["value"]['ctg_far_estatus'];
            $ctg_far_censuc =  $rTMP["value"]['ctg_far_censuc'];
            $ctg_far_sol_dt =  $rTMP["value"]['ctg_far_sol_dt'];
            $ctg_far_aut_dt =  $rTMP["value"]['ctg_far_aut_dt'];
            $ctg_far_ven_dt =  $rTMP["value"]['ctg_far_ven_dt'];
            $ctg_far_sta =  $rTMP["value"]['ctg_far_sta'];
            $ctg_far_dt =  $rTMP["value"]['ctg_far_dt'];
            $ctg_far_usr =  $rTMP["value"]['ctg_far_usr'];
            $ctg_far_pict =  $rTMP["value"]['ctg_far_pict'];
        }
    }
}

if ($sucursal == 0) {
    $adm_usr_contrato = $_SESSION['adm_usr_contrato'];

    $arrTableFarmacPerfil = array();
    $var_consulta = "SELECT * 
                        FROM ctg_farmacias
                        WHERE ctg_fac_contrato = $adm_usr_contrato";
    $sql = pg_query($rmfAdm, $var_consulta);
    $totalArticle = pg_num_rows($sql);

    // print_r($var_consulta);

    while ($rTMP = pg_fetch_assoc($sql)) {

        $arrTableFarmacPerfil[$rTMP["id"]]["id"]                                         = $rTMP["id"];
        $arrTableFarmacPerfil[$rTMP["id"]]["ctg_fac_contrato"]                                         = $rTMP["ctg_fac_contrato"];
        $arrTableFarmacPerfil[$rTMP["id"]]["ctg_fac_nit"]                                         = $rTMP["ctg_fac_nit"];
        $arrTableFarmacPerfil[$rTMP["id"]]["ctg_fac_nom"]                                         = $rTMP["ctg_fac_nom"];
        $arrTableFarmacPerfil[$rTMP["id"]]["ctg_fac_razsoc"]                                         = $rTMP["ctg_fac_razsoc"];
        $arrTableFarmacPerfil[$rTMP["id"]]["ctg_fac_dir"]                                         = $rTMP["ctg_fac_dir"];
        $arrTableFarmacPerfil[$rTMP["id"]]["ctg_fac_zona"]                                         = $rTMP["ctg_fac_zona"];
        $arrTableFarmacPerfil[$rTMP["id"]]["ctg_fac_dep"]                                         = $rTMP["ctg_fac_dep"];
        $arrTableFarmacPerfil[$rTMP["id"]]["ctg_fac_mun"]                                         = $rTMP["ctg_fac_mun"];
        $arrTableFarmacPerfil[$rTMP["id"]]["ctg_fac_tels"]                                         = $rTMP["ctg_fac_tels"];
        $arrTableFarmacPerfil[$rTMP["id"]]["ctg_fac_email"]                                         = $rTMP["ctg_fac_email"];
        $arrTableFarmacPerfil[$rTMP["id"]]["ctg_fac_username"]                                         = $rTMP["ctg_fac_username"];
        $arrTableFarmacPerfil[$rTMP["id"]]["ctg_fac_pass"]                                         = $rTMP["ctg_fac_pass"];
        $arrTableFarmacPerfil[$rTMP["id"]]["ctg_fac_estatus"]                                         = $rTMP["ctg_fac_estatus"];
        $arrTableFarmacPerfil[$rTMP["id"]]["ctg_fac_sta"]                                         = $rTMP["ctg_fac_sta"];
        $arrTableFarmacPerfil[$rTMP["id"]]["ctg_fac_dt"]                                         = $rTMP["ctg_fac_dt"];
        $arrTableFarmacPerfil[$rTMP["id"]]["ctg_fac_usr"]                                         = $rTMP["ctg_fac_usr"];
    }
    pg_free_result($sql);



    if (is_array($arrTableFarmacPerfil) && (count($arrTableFarmacPerfil) > 0)) {
        reset($arrTableFarmacPerfil);
        foreach ($arrTableFarmacPerfil as $rTMP['key'] => $rTMP['value']) {

            $id =  $rTMP["value"]['id'];
            $ctg_far_contrato =  $rTMP["value"]['ctg_fac_contrato'];
            $ctg_far_nit =  $rTMP["value"]['ctg_fac_nit'];
            $ctg_far_nomcom =  $rTMP["value"]['ctg_fac_nom'];
            $ctg_far_dir =  $rTMP["value"]['ctg_fac_dir'];
            $ctg_far_zona =  $rTMP["value"]['ctg_fac_zona'];
            $ctg_far_dep =  $rTMP["value"]['ctg_fac_dep'];
            $ctg_far_mun =  $rTMP["value"]['ctg_fac_mun'];
            $ctg_far_tels =  $rTMP["value"]['ctg_fac_tels'];
            $ctg_far_email =  $rTMP["value"]['ctg_fac_email'];
            $ctg_far_username =  $rTMP["value"]['ctg_fac_username'];
            $ctg_far_pass =  $rTMP["value"]['ctg_fac_pass'];
            $ctg_far_estatus =  $rTMP["value"]['ctg_fac_estatus'];
            $ctg_far_sta =  $rTMP["value"]['ctg_fac_sta'];
            $ctg_far_dt =  $rTMP["value"]['ctg_fac_dt'];
            $ctg_far_usr =  $rTMP["value"]['ctg_fac_usr'];
        }
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
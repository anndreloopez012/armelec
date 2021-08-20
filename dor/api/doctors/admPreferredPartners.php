<?php
if (isset($_GET["validaciones"]) && !empty($_GET["validaciones"])) {
    require_once "../../data/conexion/tmfAdm.php";
    $usuario = $_SESSION['adm_usr_code'];

    //TABLA DE INTERACCION
    $idUser = $_SESSION['adm_usr_code'];
    $tablaVacunas = "med" . $usuario . "vacunas";
    $ctg_pac_prf_far_code = isset($_POST["hid_far"]) ? $_POST["hid_far"]  : 0;
    $ctg_pac_prf_lab_code = isset($_POST["hid_lab"]) ? $_POST["hid_lab"]  : 0;
    $ctg_pac_prf_hos_code = isset($_POST["hid_hosp"]) ? $_POST["hid_hosp"]  : 0;

    $status = 1;
    $fechaIng = date('Y-m-d H:i:s');
    $usuario = $_SESSION['username'];

    $strTipoValidacion = isset($_REQUEST["validaciones"]) ? $_REQUEST["validaciones"] : '';
    if ($strTipoValidacion == "update") {
        header('Content-Type: application/json');

        $cod_id = isset($_POST["code"]) ? $_POST["code"]  : 0;
        $var_consulta = "UPDATE ctg_pacientes SET ctg_pac_prf_far_code = '$ctg_pac_prf_far_code',ctg_pac_prf_lab_code = '$ctg_pac_prf_lab_code',ctg_pac_prf_hos_code = '$ctg_pac_prf_hos_code',ctg_pac_dt = '$fechaIng' WHERE id = $cod_id";
        $val = 1;
        if (pg_query($rmfAdm, $var_consulta)) {
            $arrInfo['status'] = $val;
        } else {
            $arrInfo['status'] = 0;
            $arrInfo['error'] = $var_consulta;
        }
        print json_encode($arrInfo);
        //print_r($var_consulta);
        die();
    }
    //DIBUJO DE TABLA PRODUCTOS CATEGORIAS
    else if ($strTipoValidacion == "busqueda_table_hosp") {
        $strSearch = isset($_POST["SearchHosp"]) ? $_POST["SearchHosp"]  : '';

        $strFilter = "";
        if (!empty($strSearch)) {
            $strFilter = " WHERE ( UPPER(ctg_hos_nomcom) LIKE  UPPER('%{$strSearch}%') ) ";
        }

        $arrTableLab = array();
        $var_consulta = "SELECT *
                            FROM ctg_hospitales $strFilter ";
        $sql = pg_query($rmfAdm, $var_consulta);
        $totalArticle = pg_num_rows($sql);

        while ($rTMP = pg_fetch_assoc($sql)) {

            $arrTableLab[$rTMP["id"]]["id"]                       = $rTMP["id"];
            $arrTableLab[$rTMP["id"]]["ctg_hos_contrato"]         = $rTMP["ctg_hos_contrato"];
            $arrTableLab[$rTMP["id"]]["ctg_hos_nit"]              = $rTMP["ctg_hos_nit"];
            $arrTableLab[$rTMP["id"]]["ctg_hos_nomcom"]           = $rTMP["ctg_hos_nomcom"];
            $arrTableLab[$rTMP["id"]]["ctg_hos_code"]             = $rTMP["ctg_hos_code"];
            $arrTableLab[$rTMP["id"]]["ctg_hos_dir"]              = $rTMP["ctg_hos_dir"];
            $arrTableLab[$rTMP["id"]]["ctg_hos_zona"]             = $rTMP["ctg_hos_zona"];
            $arrTableLab[$rTMP["id"]]["ctg_hos_dep"]              = $rTMP["ctg_hos_dep"];
            $arrTableLab[$rTMP["id"]]["ctg_hos_mun"]              = $rTMP["ctg_hos_mun"];
            $arrTableLab[$rTMP["id"]]["ctg_hos_tels"]             = $rTMP["ctg_hos_tels"];
            $arrTableLab[$rTMP["id"]]["ctg_hos_email"]            = $rTMP["ctg_hos_email"];
            $arrTableLab[$rTMP["id"]]["ctg_hos_enc_dpi"]          = $rTMP["ctg_hos_enc_dpi"];
            $arrTableLab[$rTMP["id"]]["ctg_hos_enc_sexo"]         = $rTMP["ctg_hos_enc_sexo"];
            $arrTableLab[$rTMP["id"]]["ctg_hos_enc_civil"]        = $rTMP["ctg_hos_enc_civil"];
            $arrTableLab[$rTMP["id"]]["ctg_hos_enc_nac_dia"]      = $rTMP["ctg_hos_enc_nac_dia"];
            $arrTableLab[$rTMP["id"]]["ctg_hos_enc_nac_mes"]      = $rTMP["ctg_hos_enc_nac_mes"];
            $arrTableLab[$rTMP["id"]]["ctg_hos_enc_nac_ano"]      = $rTMP["ctg_hos_enc_nac_ano"];
            $arrTableLab[$rTMP["id"]]["ctg_hos_enc_dir"]          = $rTMP["ctg_hos_enc_dir"];
            $arrTableLab[$rTMP["id"]]["ctg_hos_enc_zona"]         = $rTMP["ctg_hos_enc_zona"];
            $arrTableLab[$rTMP["id"]]["ctg_hos_enc_dep"]          = $rTMP["ctg_hos_enc_dep"];
            $arrTableLab[$rTMP["id"]]["ctg_hos_enc_mun"]          = $rTMP["ctg_hos_enc_mun"];
            $arrTableLab[$rTMP["id"]]["ctg_hos_enc_cel"]          = $rTMP["ctg_hos_enc_cel"];
            $arrTableLab[$rTMP["id"]]["ctg_hos_enc_tels"]         = $rTMP["ctg_hos_enc_tels"];
            $arrTableLab[$rTMP["id"]]["ctg_hos_enc_email"]        = $rTMP["ctg_hos_enc_email"];
            $arrTableLab[$rTMP["id"]]["ctg_hos_username"]         = $rTMP["ctg_hos_username"];
            $arrTableLab[$rTMP["id"]]["ctg_hos_pass"]             = $rTMP["ctg_hos_pass"];
            $arrTableLab[$rTMP["id"]]["ctg_hos_estatus"]          = $rTMP["ctg_hos_estatus"];
            $arrTableLab[$rTMP["id"]]["ctg_hos_sol_dt"]           = $rTMP["ctg_hos_sol_dt"];
            $arrTableLab[$rTMP["id"]]["ctg_hos_aut_dt"]           = $rTMP["ctg_hos_aut_dt"];
            $arrTableLab[$rTMP["id"]]["ctg_hos_ven_dt"]           = $rTMP["ctg_hos_ven_dt"];
            $arrTableLab[$rTMP["id"]]["ctg_hos_sta"]              = $rTMP["ctg_hos_sta"];
            $arrTableLab[$rTMP["id"]]["ctg_hos_dt"]               = $rTMP["ctg_hos_dt"];
            $arrTableLab[$rTMP["id"]]["ctg_hos_usr"]              = $rTMP["ctg_hos_usr"];
            $arrTableLab[$rTMP["id"]]["ctg_hos_contrato"]         = $rTMP["ctg_hos_contrato"];
        }
        pg_free_result($sql);

?>
        <div class="col-md-12 tableFixHead">
            <table id="tableHosp" class="table table-bordered table-striped table-hover table-sm">
                <thead>
                    <tr class="table-info">
                        <th>Nombre Del Hospital</th>
                        <th>Direccion</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (is_array($arrTableLab) && (count($arrTableLab) > 0)) {
                        $intContador = 1;
                        reset($arrTableLab);
                        foreach ($arrTableLab as $rTMP['key'] => $rTMP['value']) {
                    ?>
                            <tr data-dismiss="modal" style="cursor:pointer;" onclick="fntSelectHosp('<?php print $intContador; ?>');">
                                <td><?php echo  $rTMP["value"]['ctg_hos_nomcom']; ?></td>
                                <td><?php echo  $rTMP["value"]['ctg_hos_dir']; ?></td>
                            </tr>
                            <input type="hidden" name="hidIdHosp_<?php print $intContador; ?>" id="hidIdHosp_<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['id']; ?>">
                            <input type="hidden" name="hidNameHosp_<?php print $intContador; ?>" id="hidNameHosp_<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['ctg_hos_nomcom']; ?>">
                            <input type="hidden" name="hidDirHosp_<?php print $intContador; ?>" id="hidDirHosp_<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['ctg_hos_dir']; ?>">

                    <?PHP
                            $intContador++;
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>
    <?php
        die();
    } else if ($strTipoValidacion == "busqueda_table_lab") {
        $strSearch = isset($_POST["SearchLab"]) ? $_POST["SearchLab"]  : '';

        $strFilter = "";
        if (!empty($strSearch)) {
            $strFilter = " WHERE ( UPPER(ctg_lab_nomcom) LIKE  UPPER('%{$strSearch}%') ) ";
        }

        $arrTableLab = array();
        $var_consulta = "SELECT * FROM ctg_lab_clinicos $strFilter ORDER BY ctg_lab_nomcom ";
        $sql = pg_query($rmfAdm, $var_consulta);
        $totalArticle = pg_num_rows($sql);
      //  print_r($var_consulta);

        while ($rTMP = pg_fetch_assoc($sql)) {

            $arrTableLab[$rTMP["id"]]["id"]                       = $rTMP["id"];
            $arrTableLab[$rTMP["id"]]["ctg_lab_contrato"]         = $rTMP["ctg_lab_contrato"];
            $arrTableLab[$rTMP["id"]]["ctg_lab_nit"]              = $rTMP["ctg_lab_nit"];
            $arrTableLab[$rTMP["id"]]["ctg_lab_nomcom"]           = $rTMP["ctg_lab_nomcom"];
            $arrTableLab[$rTMP["id"]]["ctg_lab_suc"]              = $rTMP["ctg_lab_suc"];
            $arrTableLab[$rTMP["id"]]["ctg_lab_code"]             = $rTMP["ctg_lab_code"];
            $arrTableLab[$rTMP["id"]]["ctg_lab_hortda1"]          = $rTMP["ctg_lab_hortda1"];
            $arrTableLab[$rTMP["id"]]["ctg_lab_hortda2"]          = $rTMP["ctg_lab_hortda2"];
            $arrTableLab[$rTMP["id"]]["ctg_lab_dir"]              = $rTMP["ctg_lab_dir"];
            $arrTableLab[$rTMP["id"]]["ctg_lab_zona"]             = $rTMP["ctg_lab_zona"];
            $arrTableLab[$rTMP["id"]]["ctg_lab_mun"]              = $rTMP["ctg_lab_mun"];
            $arrTableLab[$rTMP["id"]]["ctg_lab_tels"]             = $rTMP["ctg_lab_tels"];
            $arrTableLab[$rTMP["id"]]["ctg_lab_email"]            = $rTMP["ctg_lab_email"];
            $arrTableLab[$rTMP["id"]]["ctg_lab_enc_dpi"]          = $rTMP["ctg_lab_enc_dpi"];
            $arrTableLab[$rTMP["id"]]["ctg_lab_enc_sexo"]         = $rTMP["ctg_lab_enc_sexo"];
            $arrTableLab[$rTMP["id"]]["ctg_lab_enc_civil"]        = $rTMP["ctg_lab_enc_civil"];
            $arrTableLab[$rTMP["id"]]["ctg_lab_enc_nac_dia"]      = $rTMP["ctg_lab_enc_nac_dia"];
            $arrTableLab[$rTMP["id"]]["ctg_lab_enc_nac_mes"]      = $rTMP["ctg_lab_enc_nac_mes"];
            $arrTableLab[$rTMP["id"]]["ctg_lab_enc_nac_ano"]      = $rTMP["ctg_lab_enc_nac_ano"];
            $arrTableLab[$rTMP["id"]]["ctg_lab_enc_dir"]          = $rTMP["ctg_lab_enc_dir"];
            $arrTableLab[$rTMP["id"]]["ctg_lab_enc_zona"]         = $rTMP["ctg_lab_enc_zona"];
            $arrTableLab[$rTMP["id"]]["ctg_lab_enc_dep"]          = $rTMP["ctg_lab_enc_dep"];
            $arrTableLab[$rTMP["id"]]["ctg_lab_enc_mun"]          = $rTMP["ctg_lab_enc_mun"];
            $arrTableLab[$rTMP["id"]]["ctg_lab_enc_cel"]          = $rTMP["ctg_lab_enc_cel"];
            $arrTableLab[$rTMP["id"]]["ctg_lab_enc_tels"]         = $rTMP["ctg_lab_enc_tels"];
            $arrTableLab[$rTMP["id"]]["ctg_lab_enc_email"]        = $rTMP["ctg_lab_enc_email"];
            $arrTableLab[$rTMP["id"]]["ctg_lab_username"]         = $rTMP["ctg_lab_username"];
            $arrTableLab[$rTMP["id"]]["ctg_lab_pass"]             = $rTMP["ctg_lab_pass"];
            $arrTableLab[$rTMP["id"]]["ctg_lab_estatus"]          = $rTMP["ctg_lab_estatus"];
            $arrTableLab[$rTMP["id"]]["ctg_lab_censuc"]           = $rTMP["ctg_lab_censuc"];
            $arrTableLab[$rTMP["id"]]["ctg_lab_sol_dt"]           = $rTMP["ctg_lab_sol_dt"];
            $arrTableLab[$rTMP["id"]]["ctg_lab_aut_dt"]           = $rTMP["ctg_lab_aut_dt"];
            $arrTableLab[$rTMP["id"]]["ctg_lab_ven_dt"]           = $rTMP["ctg_lab_ven_dt"];
            $arrTableLab[$rTMP["id"]]["ctg_lab_sta"]              = $rTMP["ctg_lab_sta"];
            $arrTableLab[$rTMP["id"]]["ctg_lab_dt"]               = $rTMP["ctg_lab_dt"];
            $arrTableLab[$rTMP["id"]]["ctg_lab_usr"]              = $rTMP["ctg_lab_usr"];
        }
        pg_free_result($sql);

    ?>
        <div class="col-md-12 tableFixHead">
            <table id="tableFarmac" class="table table-bordered table-striped table-hover table-sm">
                <thead>
                    <tr class="table-info">
                        <th>Nombre Del Laboratorio</th>
                        <th>Direccion</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (is_array($arrTableLab) && (count($arrTableLab) > 0)) {
                        $intContador = 1;
                        reset($arrTableLab);
                        foreach ($arrTableLab as $rTMP['key'] => $rTMP['value']) {
                    ?>
                            <tr data-dismiss="modal" style="cursor:pointer;" onclick="fntSelectLab('<?php print $intContador; ?>');">
                                <td><?php echo  $rTMP["value"]['ctg_lab_nomcom']; ?></td>
                                <td><?php echo  $rTMP["value"]['ctg_lab_dir']; ?></td>
                            </tr>
                            <input type="hidden" name="hidIdLab_<?php print $intContador; ?>" id="hidIdLab_<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['id']; ?>">
                            <input type="hidden" name="hidNameLab_<?php print $intContador; ?>" id="hidNameLab_<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['ctg_lab_nomcom']; ?>">
                            <input type="hidden" name="hidDirLab_<?php print $intContador; ?>" id="hidDirLab_<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['ctg_lab_dir']; ?>">

                    <?PHP
                            $intContador++;
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>
    <?php
        die();
    } else if ($strTipoValidacion == "busqueda_table_far") {
        $strSearch = isset($_POST["SearchFar"]) ? $_POST["SearchFar"]  : '';

        $strFilter = "";
        if (!empty($strSearch)) {
            $strFilter = " WHERE ( UPPER(ctg_far_nomcom) LIKE  UPPER('%{$strSearch}%') ) ";
        }

        $arrTableFarmac = array();
        $var_consulta = "SELECT * FROM ctg_farmacias_sucursales $strFilter ORDER BY id ";
        $sql = pg_query($rmfAdm, $var_consulta);
        $totalArticle = pg_num_rows($sql);
    //print_r($var_consulta);

        while ($rTMP = pg_fetch_assoc($sql)) {

            $arrTableFarmac[$rTMP["id"]]["id"]                       = $rTMP["id"];
            $arrTableFarmac[$rTMP["id"]]["ctg_far_contrato"]         = $rTMP["ctg_far_contrato"];
            $arrTableFarmac[$rTMP["id"]]["ctg_far_nit"]              = $rTMP["ctg_far_nit"];
            $arrTableFarmac[$rTMP["id"]]["ctg_far_nomcom"]           = $rTMP["ctg_far_nomcom"];
            $arrTableFarmac[$rTMP["id"]]["ctg_far_suc"]              = $rTMP["ctg_far_suc"];
            $arrTableFarmac[$rTMP["id"]]["ctg_far_code"]             = $rTMP["ctg_far_code"];
            $arrTableFarmac[$rTMP["id"]]["ctg_far_servicio"]         = $rTMP["ctg_far_servicio"];
            $arrTableFarmac[$rTMP["id"]]["ctg_far_hortda1"]          = $rTMP["ctg_far_hortda1"];
            $arrTableFarmac[$rTMP["id"]]["ctg_far_hortda2"]          = $rTMP["ctg_far_hortda2"];
            $arrTableFarmac[$rTMP["id"]]["ctg_far_serdom1"]          = $rTMP["ctg_far_serdom1"];
            $arrTableFarmac[$rTMP["id"]]["ctg_far_serdom2"]          = $rTMP["ctg_far_serdom2"];
            $arrTableFarmac[$rTMP["id"]]["ctg_far_dir"]              = $rTMP["ctg_far_dir"];
            $arrTableFarmac[$rTMP["id"]]["ctg_far_zona"]             = $rTMP["ctg_far_zona"];
            $arrTableFarmac[$rTMP["id"]]["ctg_far_dep"]              = $rTMP["ctg_far_dep"];
            $arrTableFarmac[$rTMP["id"]]["ctg_far_mun"]              = $rTMP["ctg_far_mun"];
            $arrTableFarmac[$rTMP["id"]]["ctg_far_tels"]             = $rTMP["ctg_far_tels"];
            $arrTableFarmac[$rTMP["id"]]["ctg_far_email"]            = $rTMP["ctg_far_email"];
            $arrTableFarmac[$rTMP["id"]]["ctg_far_enc_dpi"]          = $rTMP["ctg_far_enc_dpi"];
            $arrTableFarmac[$rTMP["id"]]["ctg_far_enc_nombre"]       = $rTMP["ctg_far_enc_nombre"];
            $arrTableFarmac[$rTMP["id"]]["ctg_far_enc_sexo"]         = $rTMP["ctg_far_enc_sexo"];
            $arrTableFarmac[$rTMP["id"]]["ctg_far_enc_edad"]         = $rTMP["ctg_far_enc_edad"];
            $arrTableFarmac[$rTMP["id"]]["ctg_far_enc_cel"]          = $rTMP["ctg_far_enc_cel"];
            $arrTableFarmac[$rTMP["id"]]["ctg_far_username"]         = $rTMP["ctg_far_username"];
            $arrTableFarmac[$rTMP["id"]]["ctg_far_pass"]             = $rTMP["ctg_far_pass"];
            $arrTableFarmac[$rTMP["id"]]["ctg_far_estatus"]          = $rTMP["ctg_far_estatus"];
            $arrTableFarmac[$rTMP["id"]]["ctg_far_censuc"]           = $rTMP["ctg_far_censuc"];
            $arrTableFarmac[$rTMP["id"]]["ctg_far_sol_dt"]           = $rTMP["ctg_far_sol_dt"];
            $arrTableFarmac[$rTMP["id"]]["ctg_far_aut_dt"]           = $rTMP["ctg_far_aut_dt"];
            $arrTableFarmac[$rTMP["id"]]["ctg_far_ven_dt"]           = $rTMP["ctg_far_ven_dt"];
            $arrTableFarmac[$rTMP["id"]]["ctg_far_sta"]              = $rTMP["ctg_far_sta"];
            $arrTableFarmac[$rTMP["id"]]["ctg_far_dt"]               = $rTMP["ctg_far_dt"];
            $arrTableFarmac[$rTMP["id"]]["ctg_far_usr"]              = $rTMP["ctg_far_usr"];
        }
        pg_free_result($sql);

    ?>
        <div class="col-md-12 tableFixHead">
            <table id="tableFarmac" class="table table-bordered table-striped table-hover table-sm">
                <thead>
                    <tr class="table-info">
                        <th>Farmacia</th>
                        <th>Direccion</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (is_array($arrTableFarmac) && (count($arrTableFarmac) > 0)) {
                        $intContador = 1;
                        reset($arrTableFarmac);
                        foreach ($arrTableFarmac as $rTMP['key'] => $rTMP['value']) {
                    ?>
                            <tr data-dismiss="modal" style="cursor:pointer;" onclick="fntSelectFar('<?php print $intContador; ?>');">
                                <td><?php echo  $rTMP["value"]['ctg_far_nomcom']; ?> - <?php echo  $rTMP["value"]['ctg_far_suc']; ?> </td>
                                <td><?php echo  $rTMP["value"]['ctg_far_dir']; ?></td>
                            </tr>
                            <input type="hidden" name="hidIdFar_<?php print $intContador; ?>" id="hidIdFar_<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['id']; ?>">
                            <input type="hidden" name="hidNameFar_<?php print $intContador; ?>" id="hidNameFar_<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['ctg_far_nomcom']; ?>">
                            <input type="hidden" name="hidDirFar_<?php print $intContador; ?>" id="hidDirFar_<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['ctg_far_dir']; ?>">

                    <?PHP
                            $intContador++;
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>
<?php
        die();
    }else if ($strTipoValidacion == "print_table_far") {
        $arrFarmac = array();
        $var_consulta = "SELECT * 
                    FROM ctg_farmacias_sucursales 
                    WHERE id = '$ctg_pac_prf_far_code'
                    LIMIT 1";
        $sql = pg_query($rmfAdm, $var_consulta);
        $totalArticle = pg_num_rows($sql);


        while ($rTMP = pg_fetch_assoc($sql)) {

            $arrFarmac[$rTMP["id"]]["id"]                                         = $rTMP["id"];
            $arrFarmac[$rTMP["id"]]["ctg_far_nomcom"]                       = $rTMP["ctg_far_nomcom"];
            $arrFarmac[$rTMP["id"]]["ctg_far_dir"]                       = $rTMP["ctg_far_dir"];
        }
        pg_free_result($sql);
    ?>

        <?php
        if (is_array($arrFarmac) && (count($arrFarmac) > 0)) {
            reset($arrFarmac);
            foreach ($arrFarmac as $rTMP['key'] => $rTMP['value']) {

                $id_farmac =  $rTMP["value"]['id'];
                $ctg_far_nomcom =  $rTMP["value"]['ctg_far_nomcom'];
                $ctg_far_dir =  $rTMP["value"]['ctg_far_dir'];
            }
        }

        die();
    } else if ($strTipoValidacion == "print_table_lab") {

        $arrLab = array();
        $var_consulta = "SELECT * 
                    FROM ctg_lab_clinicos 
                    WHERE id = '$ctg_pac_prf_lab_code'
                    LIMIT 1";
        $sql = pg_query($rmfAdm, $var_consulta);
        $totalArticle = pg_num_rows($sql);


        while ($rTMP = pg_fetch_assoc($sql)) {

            $arrLab[$rTMP["id"]]["id"]                                         = $rTMP["id"];
            $arrLab[$rTMP["id"]]["ctg_lab_nomcom"]                       = $rTMP["ctg_lab_nomcom"];
            $arrLab[$rTMP["id"]]["ctg_lab_dir"]                       = $rTMP["ctg_lab_dir"];
        }
        pg_free_result($sql);
        ?>

        <?php
        if (is_array($arrLab) && (count($arrLab) > 0)) {
            reset($arrLab);
            foreach ($arrLab as $rTMP['key'] => $rTMP['value']) {

                $id_lab =  $rTMP["value"]['id'];
                $ctg_lab_nomcom =  $rTMP["value"]['ctg_lab_nomcom'];
                $ctg_lab_dir =  $rTMP["value"]['ctg_lab_dir'];
            }
        }

        die();
    } else if ($strTipoValidacion == "print_table_hosp") {


        $arrHosp = array();
        $var_consulta = "SELECT * 
                    FROM ctg_hospitales 
                    WHERE id = '$ctg_pac_prf_hos_code'
                    LIMIT 1";
        $sql = pg_query($rmfAdm, $var_consulta);
        $totalArticle = pg_num_rows($sql);


        while ($rTMP = pg_fetch_assoc($sql)) {

            $arrHosp[$rTMP["id"]]["id"]                                         = $rTMP["id"];
            $arrHosp[$rTMP["id"]]["ctg_hos_nomcom"]                       = $rTMP["ctg_hos_nomcom"];
            $arrHosp[$rTMP["id"]]["ctg_hos_dir"]                       = $rTMP["ctg_hos_dir"];
        }
        pg_free_result($sql);
        ?>

<?php
        if (is_array($arrHosp) && (count($arrHosp) > 0)) {
            reset($arrHosp);
            foreach ($arrHosp as $rTMP['key'] => $rTMP['value']) {

                $id_hos =  $rTMP["value"]['id'];
                $ctg_hos_nomcom = isset($rTMP["value"]['ctg_hos_nomcom']) ? $rTMP["value"]['ctg_hos_nomcom']  : '';
                //$ctg_hos_nomcom =  $rTMP["value"]['ctg_hos_nomcom'];

                $ctg_hos_dir = isset($rTMP["value"]['ctg_hos_dir']) ? $rTMP["value"]['ctg_hos_dir']  : '';
                //$ctg_hos_dir =  $rTMP["value"]['ctg_hos_dir'];
            }
        }

        die();
    }
    die();
}


?>




<?php 
require_once "../../data/conexion/tmfAdm.php"; ?>

<?php
$usuarioId = $_GET['cod'];
$usuarioId =  decrypt($usuarioId, $key);
$usuarioId = isset($usuarioId) ? $usuarioId  : '';
$cod_id = $_GET['cod'];
$cod_id =  decrypt($cod_id, $key);
$cod_id = isset($cod_id) ? $cod_id  : '';
$arrDataPerfilPartners = array();
$var_consulta = "SELECT * 
                    FROM ctg_pacientes 
                    WHERE ctg_pac_code = $usuarioId";
$sql = pg_query($rmfAdm, $var_consulta);
$totalArticle = pg_num_rows($sql);
//print_r($var_consulta);

while ($rTMP = pg_fetch_assoc($sql)) {

    $arrDataPerfilPartners[$rTMP["id"]]["id"]                                         = $rTMP["id"];
    $arrDataPerfilPartners[$rTMP["id"]]["ctg_pac_prf_far_code"]                       = $rTMP["ctg_pac_prf_far_code"];
    $arrDataPerfilPartners[$rTMP["id"]]["ctg_pac_prf_lab_code"]                       = $rTMP["ctg_pac_prf_lab_code"];
    $arrDataPerfilPartners[$rTMP["id"]]["ctg_pac_prf_hos_code"]                       = $rTMP["ctg_pac_prf_hos_code"];
}
pg_free_result($sql);
?>

<?php
if (is_array($arrDataPerfilPartners) && (count($arrDataPerfilPartners) > 0)) {
    reset($arrDataPerfilPartners);
    foreach ($arrDataPerfilPartners as $rTMP['key'] => $rTMP['value']) {

        $cod_id = isset( $rTMP["value"]['id']) ? $rTMP["value"]['id']  : 0;
        $ctg_pac_prf_far_code = isset( $rTMP["value"]['ctg_pac_prf_far_code']) ?  $rTMP["value"]['ctg_pac_prf_far_code']  : 0;
        $ctg_pac_prf_lab_code = isset( $rTMP["value"]['ctg_pac_prf_lab_code']) ?  $rTMP["value"]['ctg_pac_prf_lab_code']  : 0;
        $ctg_pac_prf_hos_code = isset( $rTMP["value"]['ctg_pac_prf_hos_code']) ?  $rTMP["value"]['ctg_pac_prf_hos_code']  : 0;

        //echo $usuarioId.'$usuarioId<br/>';
        //echo $cod_id.'cod_id<br/>';
        //echo $ctg_pac_prf_far_code.'ctg_pac_prf_far_code<br/>';
        //echo $ctg_pac_prf_lab_code.'ctg_pac_prf_lab_code<br/>';
        //echo $ctg_pac_prf_hos_code.'ctg_pac_prf_hos_code<br/>';
    }
}

$arrFarmac = array();
$var_consulta = "SELECT * 
                    FROM ctg_farmacias_sucursales 
                    WHERE id = '$ctg_pac_prf_far_code'
                    LIMIT 1";
$sql = pg_query($rmfAdm, $var_consulta);
$totalArticle = pg_num_rows($sql);


while ($rTMP = pg_fetch_assoc($sql)) {

    $arrFarmac[$rTMP["id"]]["id"]                                         = $rTMP["id"];
    $arrFarmac[$rTMP["id"]]["ctg_far_nomcom"]                       = $rTMP["ctg_far_nomcom"];
    $arrFarmac[$rTMP["id"]]["ctg_far_dir"]                       = $rTMP["ctg_far_dir"];
}
pg_free_result($sql);
?>

<?php
if (is_array($arrFarmac) && (count($arrFarmac) > 0)) {
    reset($arrFarmac);
    foreach ($arrFarmac as $rTMP['key'] => $rTMP['value']) {

        $id_farmac =  $rTMP["value"]['id'];
        $ctg_far_nomcom =  $rTMP["value"]['ctg_far_nomcom'];
        $ctg_far_dir =  $rTMP["value"]['ctg_far_dir'];
    }
}


$arrLab = array();
$var_consulta = "SELECT * 
                    FROM ctg_lab_clinicos 
                    WHERE id = $ctg_pac_prf_lab_code ";
$sql = pg_query($rmfAdm, $var_consulta);
$totalArticle = pg_num_rows($sql);
//print_r($var_consulta);

while ($rTMP = pg_fetch_assoc($sql)) {

    $arrLab[$rTMP["id"]]["id"]                                         = $rTMP["id"];
    $arrLab[$rTMP["id"]]["ctg_lab_nomcom"]                       = $rTMP["ctg_lab_nomcom"];
    $arrLab[$rTMP["id"]]["ctg_lab_dir"]                       = $rTMP["ctg_lab_dir"];
}
pg_free_result($sql);
?>

<?php
if (is_array($arrLab) && (count($arrLab) > 0)) {
    reset($arrLab);
    foreach ($arrLab as $rTMP['key'] => $rTMP['value']) {

        $id_lab =  $rTMP["value"]['id'];
        $ctg_lab_nomcom =  $rTMP["value"]['ctg_lab_nomcom'];
        $ctg_lab_dir =  $rTMP["value"]['ctg_lab_dir'];
    }
}


$arrHospIni = array();
$var_consulta = "SELECT * 
                    FROM ctg_hospitales 
                    WHERE id = '$ctg_pac_prf_hos_code'
                    LIMIT 1";
$sql = pg_query($rmfAdm, $var_consulta);
$totalArticle = pg_num_rows($sql);


while ($rTMP = pg_fetch_assoc($sql)) {

    $arrHospIni[$rTMP["id"]]["id"]                                         = $rTMP["id"];
    $arrHospIni[$rTMP["id"]]["ctg_hos_nomcom"]                       = $rTMP["ctg_hos_nomcom"];
    $arrHospIni[$rTMP["id"]]["ctg_hos_dir"]                       = $rTMP["ctg_hos_dir"];
}
pg_free_result($sql);
?>

<?php
if (is_array($arrHospIni) && (count($arrHospIni) > 0)) {
    reset($arrHospIni);
    foreach ($arrHospIni as $rTMP['key'] => $rTMP['value']) {

        $id_hos =  $rTMP["value"]['id'];
        //$ctg_hos_nomcom =  $rTMP["value"]['ctg_hos_nomcom'];
        $ctg_hos_nomcom = isset($rTMP["value"]['ctg_hos_nomcom']) ? $rTMP["value"]['ctg_hos_nomcom']  : '';

        //$ctg_hos_dir =  $rTMP["value"]['ctg_hos_dir'];
        $ctg_hos_dir = isset($rTMP["value"]['ctg_hos_dir']) ? $rTMP["value"]['ctg_hos_dir']  : '';

    }
}

?>


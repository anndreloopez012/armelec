<?php
//GLOBAL variableId
require_once '../../api/var_global.php';

// VALIDATION INSERT UPDATE DELETE
if (isset($_GET["validaciones"]) && !empty($_GET["validaciones"])) {

    require_once '../../../data/conexion/tmfAdm.php';
    require_once '../../../data/conexion/tmfLab.php';

    $usuarioId = 1;

    $codeId = isset($_POST["codeId"]) ? $_POST["codeId"]  : '';
    $ctg_con_id = isset($_POST["ctg_con_id"]) ? $_POST["ctg_con_id"]  : '';

    $ctg_con_nomcom = isset($_POST["ctg_con_nomcom"]) ? $_POST["ctg_con_nomcom"]  : '';
    $ctg_con_razsoc = isset($_POST["ctg_con_razsoc"]) ? $_POST["ctg_con_razsoc"]  : '';
    $ctg_con_nit = isset($_POST["ctg_con_nit"]) ? $_POST["ctg_con_nit"]  : '';
    $ctg_con_suc = isset($_POST["ctg_con_suc"]) ? $_POST["ctg_con_suc"]  : '';
    $ctg_con_dir = isset($_POST["ctg_con_dir"]) ? $_POST["ctg_con_dir"]  : '';
    $ctg_con_zona = isset($_POST["ctg_con_zona"]) ? $_POST["ctg_con_zona"]  : '';
    $region = isset($_POST["region"]) ? $_POST["region"]  : '';
    $distrito = isset($_POST["distrito"]) ? $_POST["distrito"]  : '';
    $ctg_con_tels = isset($_POST["ctg_con_tels"]) ? $_POST["ctg_con_tels"]  : '';
    $ctg_con_email = isset($_POST["ctg_con_email"]) ? $_POST["ctg_con_email"]  : '';

    $ctg_con_rep_nom1 = isset($_POST["username"]) ? $_POST["username"]  : '';
    $ctg_con_rep_nom2 = isset($_POST["ctg_con_rep_nom2"]) ? $_POST["ctg_con_rep_nom2"]  : '';
    $ctg_con_rep_ape1 = isset($_POST["ctg_con_rep_ape1"]) ? $_POST["ctg_con_rep_ape1"]  : '';
    $ctg_con_rep_ape2 = isset($_POST["ctg_con_rep_ape2"]) ? $_POST["ctg_con_rep_ape2"]  : '';

    $ctg_con_tpo = '9';
    $sucursal = 1;
    $ctg_con_censuc = 1;
    $ctg_con_estatus = 1;
    $ctg_con_sta = 1;
    $ctg_con_sol_dt = date("Y-m-d");
    $ctg_con_aut_dt = date("Y-m-d");

    $ctg_con_ven_dt_Y = date("Y");
    $ctg_con_ven_dt_Y = $ctg_con_ven_dt_Y + 1;
    $ctg_con_ven_dt_m = date("m");
    $ctg_con_ven_dt_d = date("d");
    $ctg_con_ven_dt = $ctg_con_ven_dt_Y . "-" . $ctg_con_ven_dt_m . "-" . $ctg_con_ven_dt_d;
    $ctg_con_dt = date("Y-m-d");
    $strTipoValidacion = isset($_REQUEST["validaciones"]) ? $_REQUEST["validaciones"] : '';
    if ($strTipoValidacion == "proces") {

        header('Content-Type: application/json');
        $val = 1;
        $var_consulta = "INSERT INTO ctg_contratos(ctg_con_id,ctg_con_tpo,ctg_con_nit,ctg_con_razsoc,ctg_con_nomcom,ctg_con_dir,ctg_con_zona,ctg_con_dep,ctg_con_mun,ctg_con_tels,ctg_con_rep_nom1,ctg_con_rep_nom2,ctg_con_rep_ape1,ctg_con_rep_ape2,ctg_con_aut_dt,ctg_con_ven_dt,ctg_con_sta,ctg_con_dt,ctg_con_usr,ctg_con_fec,ctg_con_status) VALUES ('$ctg_con_id','$ctg_con_tpo','$ctg_con_nit','$ctg_con_razsoc','$ctg_con_nomcom','$ctg_con_dir','$ctg_con_zona','$region','$distrito','$ctg_con_tels','$ctg_con_rep_nom1','$ctg_con_rep_nom2','$ctg_con_rep_ape1','$ctg_con_rep_ape2','$ctg_con_aut_dt','$ctg_con_ven_dt','$ctg_con_sta','$ctg_con_dt','$usuarioId','$ctg_con_dt','2');";
        if (pg_query($rmfAdm, $var_consulta)) {
            $arrInfo['status'] = $val;
        } else {
            $arrInfo['status'] = 0;
            $arrInfo['error'] = $var_consulta;
        }
        // print_r($var_consulta);
        print json_encode($arrInfo);

        die();
    } else if ($strTipoValidacion == "delete") {
        $val = 1;
        $var_consulta = "DELETE FROM ctg_contratos WHERE ctg_con_id = $codeId;";
        if (pg_query($rmfAdm, $var_consulta)) {
            $arrInfo['status'] = $val;
        } else {
            $arrInfo['status'] = 0;
            $arrInfo['error'] = $var_consulta;
        }
        //print_r($codeId);
        print json_encode($arrInfo);

        die();
    }

    //DIBUJO DE TABLA PRODUCTOS CATEGORIAS
    else if ($strTipoValidacion == "busqueda_tabla") {
        $strSearch = isset($_POST["Search"]) ? $_POST["Search"]  : '';

        $strFilter = "";
        if (!empty($strSearch)) {
            $strFilter = " AND ( UPPER(ctg_con_razsoc) LIKE UPPER('%{$strSearch}%') OR UPPER(ctg_con_nomcom) LIKE UPPER('%{$strSearch}%') ) ";
        }

        $arrUsuarios = array();
        $var_consulta = "SELECT * 
        FROM ctg_contratos 
        WHERE ctg_con_tpo = '$ctg_con_tpo'
        $strFilter
        ORDER BY ctg_con_fec DESC";

        $qTMP = pg_query($rmfAdm, $var_consulta);
        //echo $var_consulta;
        while ($rTMP = pg_fetch_assoc($qTMP)) {

            $arrUsuarios[$rTMP["ctg_con_id"]]["ctg_con_id"]                          = $rTMP["ctg_con_id"];
            $arrUsuarios[$rTMP["ctg_con_id"]]["ctg_con_fec"]            = $rTMP["ctg_con_fec"];
            $arrUsuarios[$rTMP["ctg_con_id"]]["ctg_con_razsoc"]              = $rTMP["ctg_con_razsoc"];
            $arrUsuarios[$rTMP["ctg_con_id"]]["ctg_con_nomcom"]            = $rTMP["ctg_con_nomcom"];
        }
        pg_free_result($qTMP);

?>
        <div class="col-md-12 tableFixHead">
            <table id="tableData" class="table table-bordered table-striped table-hover table-sm">
                <thead>
                    <tr class="table-info">
                        <th>Fecha del Contrato</th>
                        <th>Contrato</th>
                        <th>Razon Social</th>
                        <th>Nombre Comercial</th>
                        <th>-</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (is_array($arrUsuarios) && (count($arrUsuarios) > 0)) {
                        $intContador = 1;
                        reset($arrUsuarios);
                        foreach ($arrUsuarios as $rTMP['key'] => $rTMP['value']) {
                            $date = date('d-m-Y', strtotime($rTMP["value"]['ctg_con_fec']));
                    ?>
                            <tr>
                                <td width='10%'><?php echo $date; ?></td>
                                <td width='10%'><?php echo  $rTMP["value"]['ctg_con_id']; ?></td>
                                <td width='40%'><?php echo  $rTMP["value"]['ctg_con_razsoc']; ?></td>
                                <td width='30%'><?php echo  $rTMP["value"]['ctg_con_nomcom']; ?></td>
                                <td width='3%' style="cursor:pointer;" onclick="fntSelect('<?php print $intContador; ?>');"><i class="fad fa-trash-alt"></i></td>
                            </tr>
                            <input type="hidden" name="hid_id<?php print $intContador; ?>" id="hid_id<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['ctg_con_id']; ?>">
                    <?PHP
                            $intContador++;
                        }

                        die();
                    }
                    ?>
                </tbody>
            </table>
        </div>
    <?php
        die();
    } else if ($strTipoValidacion == "val_com_empresa") {
        $val = 1;

        $var_consulta = pg_query($rmfAdm, "SELECT COUNT(ctg_con_suc) FROM ctg_contratos WHERE UPPER(ctg_con_suc) = UPPER('$ctg_con_suc') ;");

        if ($row = pg_fetch_array($var_consulta)) {
            $idRow = trim($row[0]);
        }
        $usuarioCode = isset($idRow) ? $idRow  : 0;

        if ($usuarioCode >= $val) {
            $arrInfo['status'] = $val;
        } else {
            $arrInfo['status'] = 0;
            //$arrInfo['error'] = $var_consulta;
        }
        //print_r($var_consulta);

        print json_encode($arrInfo);

        die();
    } else if ($strTipoValidacion == "val_contrato") {
        $val = 1;

        $var_consulta = pg_query($rmfAdm, "SELECT COUNT(ctg_con_id) FROM ctg_contratos WHERE ctg_con_id = $ctg_con_id LIMIT 1;");

        if ($row = pg_fetch_array($var_consulta)) {
            $idRow = trim($row[0]);
        }
        $usuarioCode = isset($idRow) ? $idRow  : 0;

        if ($usuarioCode >= $val) {
            $arrInfo['status'] = $val;
        } else {
            $arrInfo['status'] = 0;
            //$arrInfo['error'] = $var_consulta;
        }
        //print_r($usuarioCode);

        print json_encode($arrInfo);

        die();
    } else if ($strTipoValidacion == "dibujo_dropdow_dep") {

        require_once "../../../data/conexion/tmfWeb.php";
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
        require_once "../../../data/conexion/tmfWeb.php";
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
    }
    die();
}

<?php
if (isset($_GET["validaciones"]) && !empty($_GET["validaciones"])) {
    require_once "../../data/conexion/tmfAdm.php";
    $usuario = $_SESSION['adm_usr_code'];

    $ctg_pac_medica_code1 = isset($_POST["ctg_pac_medica_code1"]) ? $_POST["ctg_pac_medica_code1"]  : '';
    $ctg_pac_medica_espe1 = isset($_POST["ctg_pac_medica_espe1"]) ? $_POST["ctg_pac_medica_espe1"]  : '';
    $ctg_pac_medica_cron1 = isset($_POST["ctg_pac_medica_cron1"]) ? $_POST["ctg_pac_medica_cron1"]  : 0;
    $ctg_pac_medica_freq1 = isset($_POST["ctg_pac_medica_freq1"]) ? $_POST["ctg_pac_medica_freq1"]  : 0;
    $ctg_pac_medica_date1_a = isset($_POST["ctg_pac_medica_date1"]) ? trim($_POST["ctg_pac_medica_date1"])   : '';
    $ctg_pac_medica_date1 = !$ctg_pac_medica_date1_a ? "NULL" : "'{$_POST["ctg_pac_medica_date1"]}'";

    $ctg_pac_medica_code2 = isset($_POST["ctg_pac_medica_code2"]) ? $_POST["ctg_pac_medica_code2"]  : '';
    $ctg_pac_medica_espe2 = isset($_POST["ctg_pac_medica_espe2"]) ? $_POST["ctg_pac_medica_espe2"]  : '';
    $ctg_pac_medica_cron2 = isset($_POST["ctg_pac_medica_cron2"]) ? $_POST["ctg_pac_medica_cron2"]  : 0;
    $ctg_pac_medica_freq2 = isset($_POST["ctg_pac_medica_freq2"]) ? $_POST["ctg_pac_medica_freq2"]  : 0;
    $ctg_pac_medica_date2_a = isset($_POST["ctg_pac_medica_date2"]) ? trim($_POST["ctg_pac_medica_date2"])  : '';
    $ctg_pac_medica_date2 = !$ctg_pac_medica_date2_a ? "NULL" : "'{$_POST["ctg_pac_medica_date2"]}'";

    $ctg_pac_medica_code3 = isset($_POST["ctg_pac_medica_code3"]) ? $_POST["ctg_pac_medica_code3"]  : '';
    $ctg_pac_medica_espe3 = isset($_POST["ctg_pac_medica_espe3"]) ? $_POST["ctg_pac_medica_espe3"]  : '';
    $ctg_pac_medica_cron3 = isset($_POST["ctg_pac_medica_cron3"]) ? $_POST["ctg_pac_medica_cron3"]  : 0;
    $ctg_pac_medica_freq3 = isset($_POST["ctg_pac_medica_freq3"]) ? $_POST["ctg_pac_medica_freq3"]  : 0;
    $ctg_pac_medica_date3_a = isset($_POST["ctg_pac_medica_date3"]) ? $_POST["ctg_pac_medica_date3"]  : '';
    $ctg_pac_medica_date3 = !$ctg_pac_medica_date3_a ? "NULL" : "'{$_POST["ctg_pac_medica_date3"]}'";

    $ctg_pac_medica_code4 = isset($_POST["ctg_pac_medica_code4"]) ? $_POST["ctg_pac_medica_code4"]  : '';
    $ctg_pac_medica_espe4 = isset($_POST["ctg_pac_medica_espe4"]) ? $_POST["ctg_pac_medica_espe4"]  : '';
    $ctg_pac_medica_cron4 = isset($_POST["ctg_pac_medica_cron4"]) ? $_POST["ctg_pac_medica_cron4"]  : 0;
    $ctg_pac_medica_freq4 = isset($_POST["ctg_pac_medica_freq4"]) ? $_POST["ctg_pac_medica_freq4"]  : 0;
    $ctg_pac_medica_date4_a = isset($_POST["ctg_pac_medica_date4"]) ? $_POST["ctg_pac_medica_date4"]  : '';
    $ctg_pac_medica_date4 = !$ctg_pac_medica_date4_a ? "NULL" : "'{$_POST["ctg_pac_medica_date4"]}'";

    $ctg_pac_medica_code5 = isset($_POST["ctg_pac_medica_code5"]) ? $_POST["ctg_pac_medica_code5"]  : '';
    $ctg_pac_medica_espe5 = isset($_POST["ctg_pac_medica_espe5"]) ? $_POST["ctg_pac_medica_espe5"]  : '';
    $ctg_pac_medica_cron5 = isset($_POST["ctg_pac_medica_cron5"]) ? $_POST["ctg_pac_medica_cron5"]  : 0;
    $ctg_pac_medica_freq5 = isset($_POST["ctg_pac_medica_freq5"]) ? $_POST["ctg_pac_medica_freq5"]  : 0;
    $ctg_pac_medica_date5_a = isset($_POST["ctg_pac_medica_date5"]) ? $_POST["ctg_pac_medica_date5"]  : '';
    $ctg_pac_medica_date5 = !$ctg_pac_medica_date5_a ? "NULL" : "'{$_POST["ctg_pac_medica_date5"]}'";

    $ctg_pac_medica_code6 = isset($_POST["ctg_pac_medica_code6"]) ? $_POST["ctg_pac_medica_code6"]  : '';
    $ctg_pac_medica_espe6 = isset($_POST["ctg_pac_medica_espe6"]) ? $_POST["ctg_pac_medica_espe6"]  : '';
    $ctg_pac_medica_cron6 = isset($_POST["ctg_pac_medica_cron6"]) ? $_POST["ctg_pac_medica_cron6"]  : 0;
    $ctg_pac_medica_freq6 = isset($_POST["ctg_pac_medica_freq6"]) ? $_POST["ctg_pac_medica_freq6"]  : 0;
    $ctg_pac_medica_date6_a = isset($_POST["ctg_pac_medica_date6"]) ? $_POST["ctg_pac_medica_date6"]  : '';
    $ctg_pac_medica_date6 = !$ctg_pac_medica_date6_a ? "NULL" : "'{$_POST["ctg_pac_medica_date6"]}'";

    $ctg_pac_medica_code7 = isset($_POST["ctg_pac_medica_code7"]) ? $_POST["ctg_pac_medica_code7"]  : '';
    $ctg_pac_medica_espe7 = isset($_POST["ctg_pac_medica_espe7"]) ? $_POST["ctg_pac_medica_espe7"]  : '';
    $ctg_pac_medica_cron7 = isset($_POST["ctg_pac_medica_cron7"]) ? $_POST["ctg_pac_medica_cron7"]  : 0;
    $ctg_pac_medica_freq7 = isset($_POST["ctg_pac_medica_freq7"]) ? $_POST["ctg_pac_medica_freq7"]  : 0;
    $ctg_pac_medica_date7_a = isset($_POST["ctg_pac_medica_date7"]) ? $_POST["ctg_pac_medica_date7"]  : '';
    $ctg_pac_medica_date7 = !$ctg_pac_medica_date7_a ? "NULL" : "'{$_POST["ctg_pac_medica_date7"]}'";

    $ctg_pac_medica_code8 = isset($_POST["ctg_pac_medica_code8"]) ? $_POST["ctg_pac_medica_code8"]  : '';
    $ctg_pac_medica_espe8 = isset($_POST["ctg_pac_medica_espe8"]) ? $_POST["ctg_pac_medica_espe8"]  : '';
    $ctg_pac_medica_cron8 = isset($_POST["ctg_pac_medica_cron8"]) ? $_POST["ctg_pac_medica_cron8"]  : 0;
    $ctg_pac_medica_freq8 = isset($_POST["ctg_pac_medica_freq8"]) ? $_POST["ctg_pac_medica_freq8"]  : 0;
    $ctg_pac_medica_date8_a = isset($_POST["ctg_pac_medica_date8"]) ? $_POST["ctg_pac_medica_date8"]  : '';
    $ctg_pac_medica_date8 = !$ctg_pac_medica_date8_a ? "NULL" : "'{$_POST["ctg_pac_medica_date8"]}'";

    $ctg_pac_medica_code9 = isset($_POST["ctg_pac_medica_code9"]) ? $_POST["ctg_pac_medica_code9"]  : '';
    $ctg_pac_medica_espe9 = isset($_POST["ctg_pac_medica_espe9"]) ? $_POST["ctg_pac_medica_espe9"]  : '';
    $ctg_pac_medica_cron9 = isset($_POST["ctg_pac_medica_cron9"]) ? $_POST["ctg_pac_medica_cron9"]  : 0;
    $ctg_pac_medica_freq9 = isset($_POST["ctg_pac_medica_freq9"]) ? $_POST["ctg_pac_medica_freq9"]  : 0;
    $ctg_pac_medica_date9_a = isset($_POST["ctg_pac_medica_date9"]) ? $_POST["ctg_pac_medica_date9"]  : '';
    $ctg_pac_medica_date9 = !$ctg_pac_medica_date9_a ? "NULL" : "'{$_POST["ctg_pac_medica_date9"]}'";



    $status = 1;
    $fechaIng = date('Y-m-d H:i:s');
    $val = 1;
    $strTipoValidacion = isset($_REQUEST["validaciones"]) ? $_REQUEST["validaciones"] : '';
    if ($strTipoValidacion == "insert") {
        header('Content-Type: application/json');
        $var_consulta = "INSERT INTO $tablaVacunas(med_vac_id,med_vac_nom,med_vac_des,med_vac_costo,med_vac_precio,med_vac_sali,med_vac_comp,med_vac_vent,med_vac_sta,med_vac_dt,med_vac_usr,med_vac_sal_act,med_vac_vent_precio,id) VALUES ($med_vac_id_,'$med_vac_nom_','$med_vac_des_',$med_vac_costo_,$med_vac_precio_,$med_vac_sali_,$med_vac_comp_,$med_vac_vent_,'$status','$fechaIng','$usuario',$med_vac_sal_act_,$med_vac_precio_,$idMax);";
        $val = 1;
        if (pg_query($rmfAdm, $var_consulta)) {
            $arrInfo['status'] = $val;
        } else {
            $arrInfo['status'] = 0;
            $arrInfo['error'] = $var_consulta;
        }
        print json_encode($arrInfo);
        die();
    } else if ($strTipoValidacion == "update") {
        header('Content-Type: application/json');
        $cod_id = isset($_GET["code"]) ? intval($_GET["code"]) : "";
        $var_consulta = "UPDATE ctg_pacientes SET ctg_pac_medica_code1 = '$ctg_pac_medica_code1',ctg_pac_medica_espe1 = '$ctg_pac_medica_espe1',ctg_pac_medica_cron1 = $ctg_pac_medica_cron1,ctg_pac_medica_freq1 = $ctg_pac_medica_freq1,ctg_pac_medica_date1= $ctg_pac_medica_date1,ctg_pac_medica_code2 = '$ctg_pac_medica_code2',ctg_pac_medica_espe2 = '$ctg_pac_medica_espe2',ctg_pac_medica_cron2 = $ctg_pac_medica_cron2,ctg_pac_medica_freq2 = $ctg_pac_medica_freq2,ctg_pac_medica_date2 = $ctg_pac_medica_date2,ctg_pac_medica_code3 = '$ctg_pac_medica_code3',ctg_pac_medica_espe3 = '$ctg_pac_medica_espe3',ctg_pac_medica_cron3 = $ctg_pac_medica_cron3,ctg_pac_medica_freq3 = $ctg_pac_medica_freq3,ctg_pac_medica_date3 = $ctg_pac_medica_date3,ctg_pac_medica_code4 = '$ctg_pac_medica_code4',ctg_pac_medica_espe4 = '$ctg_pac_medica_espe4',ctg_pac_medica_cron4 = $ctg_pac_medica_cron4,ctg_pac_medica_freq4 = $ctg_pac_medica_freq4,ctg_pac_medica_date4 = $ctg_pac_medica_date4,ctg_pac_medica_code5 = '$ctg_pac_medica_code5',ctg_pac_medica_espe5 = '$ctg_pac_medica_espe5',ctg_pac_medica_cron5 = $ctg_pac_medica_cron5,ctg_pac_medica_freq5 = $ctg_pac_medica_freq5,ctg_pac_medica_date5 = $ctg_pac_medica_date5,ctg_pac_medica_code6 = '$ctg_pac_medica_code6',ctg_pac_medica_espe6 = '$ctg_pac_medica_espe6',ctg_pac_medica_cron6 = $ctg_pac_medica_cron6,ctg_pac_medica_freq6 = $ctg_pac_medica_freq6,ctg_pac_medica_date6 = $ctg_pac_medica_date6,ctg_pac_medica_code7 = '$ctg_pac_medica_code7',ctg_pac_medica_espe7 = '$ctg_pac_medica_espe7',ctg_pac_medica_cron7 = $ctg_pac_medica_cron7,ctg_pac_medica_freq7 = $ctg_pac_medica_freq7,ctg_pac_medica_date7 = $ctg_pac_medica_date7,ctg_pac_medica_code8 = '$ctg_pac_medica_code8',ctg_pac_medica_espe8 = '$ctg_pac_medica_espe8',ctg_pac_medica_cron8 = $ctg_pac_medica_cron8,ctg_pac_medica_freq8 = $ctg_pac_medica_freq8,ctg_pac_medica_date8 = $ctg_pac_medica_date8,ctg_pac_medica_code9 = '$ctg_pac_medica_code9',ctg_pac_medica_espe9 = '$ctg_pac_medica_espe9',ctg_pac_medica_cron9 = $ctg_pac_medica_cron9,ctg_pac_medica_freq9 = $ctg_pac_medica_freq9,ctg_pac_medica_date9 = $ctg_pac_medica_date9,ctg_pac_dt = '$fechaIng',ctg_pac_usr = '$usuario' WHERE ctg_pac_code = $cod_id";
        $val = 1;
        if (pg_query($rmfAdm, $var_consulta)) {
            $arrInfo['status'] = $val;
        } else {
            $arrInfo['status'] = 0;
            $arrInfo['error'] = $var_consulta;
        }
        print json_encode($arrInfo);
        die();
    } else if ($strTipoValidacion == "busqueda_table1") {
        $strSearch = isset($_POST["Search"]) ? $_POST["Search"]  : '';

        $strFilter = "";
        if (!empty($strSearch)) {
            $strFilter = " WHERE ( UPPER(ctg_pro_desc) LIKE '%{$strSearch}%' OR UPPER(ctg_pro_prinact) LIKE '%{$strSearch}%' ) ";
        }

        $arrTableMed = array();
        $var_consulta = "SELECT * FROM ctg_productos $strFilter ORDER BY ctg_pro_desc LIMIT 1000 ";
        $sql = pg_query($rmfAdm, $var_consulta);
        $totalArticle = pg_num_rows($sql);
        //print_r($var_consulta);

        while ($rTMP = pg_fetch_assoc($sql)) {

            $arrTableMed[$rTMP["id"]]["id"]                       = $rTMP["id"];
            $arrTableMed[$rTMP["id"]]["ctg_pro_cod"]              = $rTMP["ctg_pro_cod"];
            $arrTableMed[$rTMP["id"]]["ctg_pro_desc"]             = $rTMP["ctg_pro_desc"];
            $arrTableMed[$rTMP["id"]]["ctg_pro_prinact"]          = $rTMP["ctg_pro_prinact"];
            $arrTableMed[$rTMP["id"]]["ctg_pro_labfar"]           = $rTMP["ctg_pro_labfar"];
            $arrTableMed[$rTMP["id"]]["ctg_pro_fecaut"]           = $rTMP["ctg_pro_fecaut"];
            $arrTableMed[$rTMP["id"]]["ctg_pro_fecven"]           = $rTMP["ctg_pro_fecven"];
            $arrTableMed[$rTMP["id"]]["ctg_pro_psinar"]           = $rTMP["ctg_pro_psinar"];
            $arrTableMed[$rTMP["id"]]["ctg_pro_labfar"]           = $rTMP["ctg_pro_labfar"];
            $arrTableMed[$rTMP["id"]]["ctg_pro_indi"]           = $rTMP["ctg_pro_indi"];
        }
        pg_free_result($sql);

?>
        <div class="col-md-12 tableFixHead">
            <table id="tableHosp" class="table table-bordered table-striped table-hover table-sm">

                <tbody>
                    <?php
                    if (is_array($arrTableMed) && (count($arrTableMed) > 0)) {
                        $intContador = 1;
                        reset($arrTableMed);
                        foreach ($arrTableMed as $rTMP['key'] => $rTMP['value']) {
                    ?>

                            <tr data-dismiss="modal" style="cursor:pointer;" onclick="fntSelectView1('<?php print $intContador; ?>');">
                                <th>No. de Registro</th>
                                <td><?php echo  $rTMP["value"]['ctg_pro_cod']; ?></td>
                            </tr>
                            <tr data-dismiss="modal" style="cursor:pointer;" onclick="fntSelectView1('<?php print $intContador; ?>');">
                                <th>Nombre</th>
                                <td><?php echo  $rTMP["value"]['ctg_pro_desc']; ?></td>
                            </tr>
                            <tr data-dismiss="modal" style="cursor:pointer;" onclick="fntSelectView1('<?php print $intContador; ?>');">
                                <th>Principio Activo</th>
                                <td><?php echo  $rTMP["value"]['ctg_pro_prinact']; ?></td>
                            </tr>
                            <tr data-dismiss="modal" style="cursor:pointer;" onclick="fntSelectView1('<?php print $intContador; ?>');">
                                <th>Fabricante</th>
                                <td><?php echo  $rTMP["value"]['ctg_pro_labfar']; ?></td>
                            </tr>
                            <tr data-dismiss="modal" style="cursor:pointer;" onclick="fntSelectView1('<?php print $intContador; ?>');">
                                <th>Ficha Tecnica</th>
                                <td><?php echo  $rTMP["value"]['ctg_pro_indi']; ?></td>
                            </tr>
                            <tr data-dismiss="modal" style="cursor:pointer;" onclick="fntSelectView1('<?php print $intContador; ?>');">
                                <th>Vence</th>
                                <td><?php echo  $rTMP["value"]['ctg_pro_fecven']; ?></td>
                            </tr>
                            <tr>
                                <th style="background: #d6eaf8;"></th>
                                <td style="background: #d6eaf8;"></td>
                            </tr>
                            <tr>
                                <th style="background: #d6eaf8;"></th>
                                <td style="background: #d6eaf8;"></td>
                            </tr>

                            <input type="hidden" name="hidId_<?php print $intContador; ?>" id="hidId_<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['ctg_pro_cod']; ?>">
                            <input type="hidden" name="hidNombre_<?php print $intContador; ?>" id="hidNombre_<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['ctg_pro_desc']; ?>">
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
    } else if ($strTipoValidacion == "busqueda_table2") {
        $strSearch = isset($_POST["Search"]) ? $_POST["Search"]  : '';

        $strFilter = "";
        if (!empty($strSearch)) {
            $strFilter = " WHERE ( UPPER(ctg_pro_desc) LIKE '%{$strSearch}%' OR UPPER(ctg_pro_prinact) LIKE '%{$strSearch}%' ) ";
        }

        $arrTableMed = array();
        $var_consulta = "SELECT * FROM ctg_productos $strFilter ORDER BY ctg_pro_desc LIMIT 1000 ";

        $sql = pg_query($rmfAdm, $var_consulta);
        $totalArticle = pg_num_rows($sql);
        //print_r($var_consulta);

        while ($rTMP = pg_fetch_assoc($sql)) {

            $arrTableMed[$rTMP["id"]]["id"]                       = $rTMP["id"];
            $arrTableMed[$rTMP["id"]]["ctg_pro_cod"]              = $rTMP["ctg_pro_cod"];
            $arrTableMed[$rTMP["id"]]["ctg_pro_desc"]             = $rTMP["ctg_pro_desc"];
            $arrTableMed[$rTMP["id"]]["ctg_pro_prinact"]          = $rTMP["ctg_pro_prinact"];
            $arrTableMed[$rTMP["id"]]["ctg_pro_labfar"]           = $rTMP["ctg_pro_labfar"];
            $arrTableMed[$rTMP["id"]]["ctg_pro_fecaut"]           = $rTMP["ctg_pro_fecaut"];
            $arrTableMed[$rTMP["id"]]["ctg_pro_fecven"]           = $rTMP["ctg_pro_fecven"];
            $arrTableMed[$rTMP["id"]]["ctg_pro_psinar"]           = $rTMP["ctg_pro_psinar"];
            $arrTableMed[$rTMP["id"]]["ctg_pro_labfar"]           = $rTMP["ctg_pro_labfar"];
            $arrTableMed[$rTMP["id"]]["ctg_pro_indi"]           = $rTMP["ctg_pro_indi"];
        }
        pg_free_result($sql);

    ?>
        <div class="col-md-12 tableFixHead">
            <table id="tableHosp" class="table table-bordered table-striped table-hover table-sm">
                <tbody>
                    <?php
                    if (is_array($arrTableMed) && (count($arrTableMed) > 0)) {
                        $intContador = 1;
                        reset($arrTableMed);
                        foreach ($arrTableMed as $rTMP['key'] => $rTMP['value']) {
                    ?>

                            <tr data-dismiss="modal" style="cursor:pointer;" onclick="fntSelectView2('<?php print $intContador; ?>');">
                                <th>No. de Registro</th>
                                <td><?php echo  $rTMP["value"]['ctg_pro_cod']; ?></td>
                            </tr>
                            <tr data-dismiss="modal" style="cursor:pointer;" onclick="fntSelectView2('<?php print $intContador; ?>');">
                                <th>Nombre</th>
                                <td><?php echo  $rTMP["value"]['ctg_pro_desc']; ?></td>
                            </tr>
                            <tr data-dismiss="modal" style="cursor:pointer;" onclick="fntSelectView2('<?php print $intContador; ?>');">
                                <th>Principio Activo</th>
                                <td><?php echo  $rTMP["value"]['ctg_pro_prinact']; ?></td>
                            </tr>
                            <tr data-dismiss="modal" style="cursor:pointer;" onclick="fntSelectView2('<?php print $intContador; ?>');">
                                <th>Fabricante</th>
                                <td><?php echo  $rTMP["value"]['ctg_pro_labfar']; ?></td>
                            </tr>
                            <tr data-dismiss="modal" style="cursor:pointer;" onclick="fntSelectView2('<?php print $intContador; ?>');">
                                <th>Ficha Tecnica</th>
                                <td><?php echo  $rTMP["value"]['ctg_pro_indi']; ?></td>
                            </tr>
                            <tr data-dismiss="modal" style="cursor:pointer;" onclick="fntSelectView2('<?php print $intContador; ?>');">
                                <th>Vence</th>
                                <td><?php echo  $rTMP["value"]['ctg_pro_fecven']; ?></td>
                            </tr>
                            <tr>
                                <th style="background: #d6eaf8;"></th>
                                <td style="background: #d6eaf8;"></td>
                            </tr>
                            <tr>
                                <th style="background: #d6eaf8;"></th>
                                <td style="background: #d6eaf8;"></td>
                            </tr>

                            <input type="hidden" name="hidId_<?php print $intContador; ?>" id="hidId_<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['ctg_pro_cod']; ?>">
                            <input type="hidden" name="hidNombre_<?php print $intContador; ?>" id="hidNombre_<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['ctg_pro_desc']; ?>">
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
    } else if ($strTipoValidacion == "busqueda_table3") {
        $strSearch = isset($_POST["Search"]) ? $_POST["Search"]  : '';

        $strFilter = "";
        if (!empty($strSearch)) {
            $strFilter = " WHERE ( UPPER(ctg_pro_desc) LIKE '%{$strSearch}%' OR UPPER(ctg_pro_prinact) LIKE '%{$strSearch}%' ) ";
        }

        $arrTableMed = array();
        $var_consulta = "SELECT * FROM ctg_productos $strFilter ORDER BY ctg_pro_desc LIMIT 1000 ";
        $sql = pg_query($rmfAdm, $var_consulta);
        $totalArticle = pg_num_rows($sql);


        while ($rTMP = pg_fetch_assoc($sql)) {

            $arrTableMed[$rTMP["id"]]["id"]                       = $rTMP["id"];
            $arrTableMed[$rTMP["id"]]["ctg_pro_cod"]              = $rTMP["ctg_pro_cod"];
            $arrTableMed[$rTMP["id"]]["ctg_pro_desc"]             = $rTMP["ctg_pro_desc"];
            $arrTableMed[$rTMP["id"]]["ctg_pro_prinact"]          = $rTMP["ctg_pro_prinact"];
            $arrTableMed[$rTMP["id"]]["ctg_pro_labfar"]           = $rTMP["ctg_pro_labfar"];
            $arrTableMed[$rTMP["id"]]["ctg_pro_fecaut"]           = $rTMP["ctg_pro_fecaut"];
            $arrTableMed[$rTMP["id"]]["ctg_pro_fecven"]           = $rTMP["ctg_pro_fecven"];
            $arrTableMed[$rTMP["id"]]["ctg_pro_psinar"]           = $rTMP["ctg_pro_psinar"];
            $arrTableMed[$rTMP["id"]]["ctg_pro_labfar"]           = $rTMP["ctg_pro_labfar"];
            $arrTableMed[$rTMP["id"]]["ctg_pro_indi"]           = $rTMP["ctg_pro_indi"];
        }
        pg_free_result($sql);

    ?>
        <div class="col-md-12 tableFixHead">
            <table id="tableHosp" class="table table-bordered table-striped table-hover table-sm">
                <tbody>
                    <?php
                    if (is_array($arrTableMed) && (count($arrTableMed) > 0)) {
                        $intContador = 1;
                        reset($arrTableMed);
                        foreach ($arrTableMed as $rTMP['key'] => $rTMP['value']) {
                    ?>

                            <tr data-dismiss="modal" style="cursor:pointer;" onclick="fntSelectView3('<?php print $intContador; ?>');">
                                <th>No. de Registro</th>
                                <td><?php echo  $rTMP["value"]['ctg_pro_cod']; ?></td>
                            </tr>
                            <tr data-dismiss="modal" style="cursor:pointer;" onclick="fntSelectView3('<?php print $intContador; ?>');">
                                <th>Nombre</th>
                                <td><?php echo  $rTMP["value"]['ctg_pro_desc']; ?></td>
                            </tr>
                            <tr data-dismiss="modal" style="cursor:pointer;" onclick="fntSelectView3('<?php print $intContador; ?>');">
                                <th>Principio Activo</th>
                                <td><?php echo  $rTMP["value"]['ctg_pro_prinact']; ?></td>
                            </tr>
                            <tr data-dismiss="modal" style="cursor:pointer;" onclick="fntSelectView3('<?php print $intContador; ?>');">
                                <th>Fabricante</th>
                                <td><?php echo  $rTMP["value"]['ctg_pro_labfar']; ?></td>
                            </tr>
                            <tr data-dismiss="modal" style="cursor:pointer;" onclick="fntSelectView3('<?php print $intContador; ?>');">
                                <th>Ficha Tecnica</th>
                                <td><?php echo  $rTMP["value"]['ctg_pro_indi']; ?></td>
                            </tr>
                            <tr data-dismiss="modal" style="cursor:pointer;" onclick="fntSelectView3('<?php print $intContador; ?>');">
                                <th>Vence</th>
                                <td><?php echo  $rTMP["value"]['ctg_pro_fecven']; ?></td>
                            </tr>
                            <tr>
                                <th style="background: #d6eaf8;"></th>
                                <td style="background: #d6eaf8;"></td>
                            </tr>
                            <tr>
                                <th style="background: #d6eaf8;"></th>
                                <td style="background: #d6eaf8;"></td>
                            </tr>

                            <input type="hidden" name="hidId_<?php print $intContador; ?>" id="hidId_<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['ctg_pro_cod']; ?>">
                            <input type="hidden" name="hidNombre_<?php print $intContador; ?>" id="hidNombre_<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['ctg_pro_desc']; ?>">
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
    } else if ($strTipoValidacion == "busqueda_table4") {
        $strSearch = isset($_POST["Search"]) ? $_POST["Search"]  : '';

        $strFilter = "";
        if (!empty($strSearch)) {
            $strFilter = " WHERE ( UPPER(ctg_pro_desc) LIKE '%{$strSearch}%' OR UPPER(ctg_pro_prinact) LIKE '%{$strSearch}%' ) ";
        }

        $arrTableMed = array();
        $var_consulta = "SELECT * FROM ctg_productos $strFilter ORDER BY ctg_pro_desc LIMIT 1000 ";
        $sql = pg_query($rmfAdm, $var_consulta);
        $totalArticle = pg_num_rows($sql);


        while ($rTMP = pg_fetch_assoc($sql)) {

            $arrTableMed[$rTMP["id"]]["id"]                       = $rTMP["id"];
            $arrTableMed[$rTMP["id"]]["ctg_pro_cod"]              = $rTMP["ctg_pro_cod"];
            $arrTableMed[$rTMP["id"]]["ctg_pro_desc"]             = $rTMP["ctg_pro_desc"];
            $arrTableMed[$rTMP["id"]]["ctg_pro_prinact"]          = $rTMP["ctg_pro_prinact"];
            $arrTableMed[$rTMP["id"]]["ctg_pro_labfar"]           = $rTMP["ctg_pro_labfar"];
            $arrTableMed[$rTMP["id"]]["ctg_pro_fecaut"]           = $rTMP["ctg_pro_fecaut"];
            $arrTableMed[$rTMP["id"]]["ctg_pro_fecven"]           = $rTMP["ctg_pro_fecven"];
            $arrTableMed[$rTMP["id"]]["ctg_pro_psinar"]           = $rTMP["ctg_pro_psinar"];
            $arrTableMed[$rTMP["id"]]["ctg_pro_labfar"]           = $rTMP["ctg_pro_labfar"];
            $arrTableMed[$rTMP["id"]]["ctg_pro_indi"]           = $rTMP["ctg_pro_indi"];
        }
        pg_free_result($sql);

    ?>
        <div class="col-md-12 tableFixHead">
            <table id="tableHosp" class="table table-bordered table-striped table-hover table-sm">
                <tbody>
                    <?php
                    if (is_array($arrTableMed) && (count($arrTableMed) > 0)) {
                        $intContador = 1;
                        reset($arrTableMed);
                        foreach ($arrTableMed as $rTMP['key'] => $rTMP['value']) {
                    ?>

                            <tr data-dismiss="modal" style="cursor:pointer;" onclick="fntSelectView4('<?php print $intContador; ?>');">
                                <th>No. de Registro</th>
                                <td><?php echo  $rTMP["value"]['ctg_pro_cod']; ?></td>
                            </tr>
                            <tr data-dismiss="modal" style="cursor:pointer;" onclick="fntSelectView4('<?php print $intContador; ?>');">
                                <th>Nombre</th>
                                <td><?php echo  $rTMP["value"]['ctg_pro_desc']; ?></td>
                            </tr>
                            <tr data-dismiss="modal" style="cursor:pointer;" onclick="fntSelectView4('<?php print $intContador; ?>');">
                                <th>Principio Activo</th>
                                <td><?php echo  $rTMP["value"]['ctg_pro_prinact']; ?></td>
                            </tr>
                            <tr data-dismiss="modal" style="cursor:pointer;" onclick="fntSelectView4('<?php print $intContador; ?>');">
                                <th>Fabricante</th>
                                <td><?php echo  $rTMP["value"]['ctg_pro_labfar']; ?></td>
                            </tr>
                            <tr data-dismiss="modal" style="cursor:pointer;" onclick="fntSelectView4('<?php print $intContador; ?>');">
                                <th>Ficha Tecnica</th>
                                <td><?php echo  $rTMP["value"]['ctg_pro_indi']; ?></td>
                            </tr>
                            <tr data-dismiss="modal" style="cursor:pointer;" onclick="fntSelectView4('<?php print $intContador; ?>');">
                                <th>Vence</th>
                                <td><?php echo  $rTMP["value"]['ctg_pro_fecven']; ?></td>
                            </tr>
                            <tr>
                                <th style="background: #d6eaf8;"></th>
                                <td style="background: #d6eaf8;"></td>
                            </tr>
                            <tr>
                                <th style="background: #d6eaf8;"></th>
                                <td style="background: #d6eaf8;"></td>
                            </tr>

                            <input type="hidden" name="hidId_<?php print $intContador; ?>" id="hidId_<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['ctg_pro_cod']; ?>">
                            <input type="hidden" name="hidNombre_<?php print $intContador; ?>" id="hidNombre_<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['ctg_pro_desc']; ?>">
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
    } else if ($strTipoValidacion == "busqueda_table5") {
        $strSearch = isset($_POST["Search"]) ? $_POST["Search"]  : '';

        $strFilter = "";
        if (!empty($strSearch)) {
            $strFilter = " WHERE ( UPPER(ctg_pro_desc) LIKE '%{$strSearch}%' OR UPPER(ctg_pro_prinact) LIKE '%{$strSearch}%' ) ";
        }

        $arrTableMed = array();
        $var_consulta = "SELECT * FROM ctg_productos $strFilter ORDER BY ctg_pro_desc LIMIT 1000 ";
        $sql = pg_query($rmfAdm, $var_consulta);
        $totalArticle = pg_num_rows($sql);


        while ($rTMP = pg_fetch_assoc($sql)) {

            $arrTableMed[$rTMP["id"]]["id"]                       = $rTMP["id"];
            $arrTableMed[$rTMP["id"]]["ctg_pro_cod"]              = $rTMP["ctg_pro_cod"];
            $arrTableMed[$rTMP["id"]]["ctg_pro_desc"]             = $rTMP["ctg_pro_desc"];
            $arrTableMed[$rTMP["id"]]["ctg_pro_prinact"]          = $rTMP["ctg_pro_prinact"];
            $arrTableMed[$rTMP["id"]]["ctg_pro_labfar"]           = $rTMP["ctg_pro_labfar"];
            $arrTableMed[$rTMP["id"]]["ctg_pro_fecaut"]           = $rTMP["ctg_pro_fecaut"];
            $arrTableMed[$rTMP["id"]]["ctg_pro_fecven"]           = $rTMP["ctg_pro_fecven"];
            $arrTableMed[$rTMP["id"]]["ctg_pro_psinar"]           = $rTMP["ctg_pro_psinar"];
            $arrTableMed[$rTMP["id"]]["ctg_pro_labfar"]           = $rTMP["ctg_pro_labfar"];
            $arrTableMed[$rTMP["id"]]["ctg_pro_indi"]           = $rTMP["ctg_pro_indi"];
        }
        pg_free_result($sql);

    ?>
        <div class="col-md-12 tableFixHead">
            <table id="tableHosp" class="table table-bordered table-striped table-hover table-sm">
                <tbody>
                    <?php
                    if (is_array($arrTableMed) && (count($arrTableMed) > 0)) {
                        $intContador = 1;
                        reset($arrTableMed);
                        foreach ($arrTableMed as $rTMP['key'] => $rTMP['value']) {
                    ?>

                            <tr data-dismiss="modal" style="cursor:pointer;" onclick="fntSelectView5('<?php print $intContador; ?>');">
                                <th>No. de Registro</th>
                                <td><?php echo  $rTMP["value"]['ctg_pro_cod']; ?></td>
                            </tr>
                            <tr data-dismiss="modal" style="cursor:pointer;" onclick="fntSelectView5('<?php print $intContador; ?>');">
                                <th>Nombre</th>
                                <td><?php echo  $rTMP["value"]['ctg_pro_desc']; ?></td>
                            </tr>
                            <tr data-dismiss="modal" style="cursor:pointer;" onclick="fntSelectView5('<?php print $intContador; ?>');">
                                <th>Principio Activo</th>
                                <td><?php echo  $rTMP["value"]['ctg_pro_prinact']; ?></td>
                            </tr>
                            <tr data-dismiss="modal" style="cursor:pointer;" onclick="fntSelectView5('<?php print $intContador; ?>');">
                                <th>Fabricante</th>
                                <td><?php echo  $rTMP["value"]['ctg_pro_labfar']; ?></td>
                            </tr>
                            <tr data-dismiss="modal" style="cursor:pointer;" onclick="fntSelectView5('<?php print $intContador; ?>');">
                                <th>Ficha Tecnica</th>
                                <td><?php echo  $rTMP["value"]['ctg_pro_indi']; ?></td>
                            </tr>
                            <tr data-dismiss="modal" style="cursor:pointer;" onclick="fntSelectView5('<?php print $intContador; ?>');">
                                <th>Vence</th>
                                <td><?php echo  $rTMP["value"]['ctg_pro_fecven']; ?></td>
                            </tr>
                            <tr>
                                <th style="background: #d6eaf8;"></th>
                                <td style="background: #d6eaf8;"></td>
                            </tr>
                            <tr>
                                <th style="background: #d6eaf8;"></th>
                                <td style="background: #d6eaf8;"></td>
                            </tr>

                            <input type="hidden" name="hidId_<?php print $intContador; ?>" id="hidId_<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['ctg_pro_cod']; ?>">
                            <input type="hidden" name="hidNombre_<?php print $intContador; ?>" id="hidNombre_<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['ctg_pro_desc']; ?>">
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
    } else if ($strTipoValidacion == "busqueda_table6") {
        $strSearch = isset($_POST["Search"]) ? $_POST["Search"]  : '';

        $strFilter = "";
        if (!empty($strSearch)) {
            $strFilter = " WHERE ( UPPER(ctg_pro_desc) LIKE '%{$strSearch}%' OR UPPER(ctg_pro_prinact) LIKE '%{$strSearch}%' ) ";
        }

        $arrTableMed = array();
        $var_consulta = "SELECT * FROM ctg_productos $strFilter ORDER BY ctg_pro_desc LIMIT 1000 ";
        $sql = pg_query($rmfAdm, $var_consulta);
        $totalArticle = pg_num_rows($sql);


        while ($rTMP = pg_fetch_assoc($sql)) {

            $arrTableMed[$rTMP["id"]]["id"]                       = $rTMP["id"];
            $arrTableMed[$rTMP["id"]]["ctg_pro_cod"]              = $rTMP["ctg_pro_cod"];
            $arrTableMed[$rTMP["id"]]["ctg_pro_desc"]             = $rTMP["ctg_pro_desc"];
            $arrTableMed[$rTMP["id"]]["ctg_pro_prinact"]          = $rTMP["ctg_pro_prinact"];
            $arrTableMed[$rTMP["id"]]["ctg_pro_labfar"]           = $rTMP["ctg_pro_labfar"];
            $arrTableMed[$rTMP["id"]]["ctg_pro_fecaut"]           = $rTMP["ctg_pro_fecaut"];
            $arrTableMed[$rTMP["id"]]["ctg_pro_fecven"]           = $rTMP["ctg_pro_fecven"];
            $arrTableMed[$rTMP["id"]]["ctg_pro_psinar"]           = $rTMP["ctg_pro_psinar"];
            $arrTableMed[$rTMP["id"]]["ctg_pro_labfar"]           = $rTMP["ctg_pro_labfar"];
            $arrTableMed[$rTMP["id"]]["ctg_pro_indi"]           = $rTMP["ctg_pro_indi"];
        }
        pg_free_result($sql);

    ?>
        <div class="col-md-12 tableFixHead">
            <table id="tableHosp" class="table table-bordered table-striped table-hover table-sm">
                <tbody>
                    <?php
                    if (is_array($arrTableMed) && (count($arrTableMed) > 0)) {
                        $intContador = 1;
                        reset($arrTableMed);
                        foreach ($arrTableMed as $rTMP['key'] => $rTMP['value']) {
                    ?>

                            <tr data-dismiss="modal" style="cursor:pointer;" onclick="fntSelectView6('<?php print $intContador; ?>');">
                                <th>No. de Registro</th>
                                <td><?php echo  $rTMP["value"]['ctg_pro_cod']; ?></td>
                            </tr>
                            <tr data-dismiss="modal" style="cursor:pointer;" onclick="fntSelectView6('<?php print $intContador; ?>');">
                                <th>Nombre</th>
                                <td><?php echo  $rTMP["value"]['ctg_pro_desc']; ?></td>
                            </tr>
                            <tr data-dismiss="modal" style="cursor:pointer;" onclick="fntSelectView6('<?php print $intContador; ?>');">
                                <th>Principio Activo</th>
                                <td><?php echo  $rTMP["value"]['ctg_pro_prinact']; ?></td>
                            </tr>
                            <tr data-dismiss="modal" style="cursor:pointer;" onclick="fntSelectView6('<?php print $intContador; ?>');">
                                <th>Fabricante</th>
                                <td><?php echo  $rTMP["value"]['ctg_pro_labfar']; ?></td>
                            </tr>
                            <tr data-dismiss="modal" style="cursor:pointer;" onclick="fntSelectView6('<?php print $intContador; ?>');">
                                <th>Ficha Tecnica</th>
                                <td><?php echo  $rTMP["value"]['ctg_pro_indi']; ?></td>
                            </tr>
                            <tr data-dismiss="modal" style="cursor:pointer;" onclick="fntSelectView6('<?php print $intContador; ?>');">
                                <th>Vence</th>
                                <td><?php echo  $rTMP["value"]['ctg_pro_fecven']; ?></td>
                            </tr>
                            <tr>
                                <th style="background: #d6eaf8;"></th>
                                <td style="background: #d6eaf8;"></td>
                            </tr>
                            <tr>
                                <th style="background: #d6eaf8;"></th>
                                <td style="background: #d6eaf8;"></td>
                            </tr>

                            <input type="hidden" name="hidId_<?php print $intContador; ?>" id="hidId_<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['ctg_pro_cod']; ?>">
                            <input type="hidden" name="hidNombre_<?php print $intContador; ?>" id="hidNombre_<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['ctg_pro_desc']; ?>">
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
    } else if ($strTipoValidacion == "busqueda_table7") {
        $strSearch = isset($_POST["Search"]) ? $_POST["Search"]  : '';

        $strFilter = "";
        if (!empty($strSearch)) {
            $strFilter = " WHERE ( UPPER(ctg_pro_desc) LIKE '%{$strSearch}%' OR UPPER(ctg_pro_prinact) LIKE '%{$strSearch}%' ) ";
        }

        $arrTableMed = array();
        $var_consulta = "SELECT * FROM ctg_productos $strFilter ORDER BY ctg_pro_desc LIMIT 1000 ";
        $sql = pg_query($rmfAdm, $var_consulta);
        $totalArticle = pg_num_rows($sql);


        while ($rTMP = pg_fetch_assoc($sql)) {

            $arrTableMed[$rTMP["id"]]["id"]                       = $rTMP["id"];
            $arrTableMed[$rTMP["id"]]["ctg_pro_cod"]              = $rTMP["ctg_pro_cod"];
            $arrTableMed[$rTMP["id"]]["ctg_pro_desc"]             = $rTMP["ctg_pro_desc"];
            $arrTableMed[$rTMP["id"]]["ctg_pro_prinact"]          = $rTMP["ctg_pro_prinact"];
            $arrTableMed[$rTMP["id"]]["ctg_pro_labfar"]           = $rTMP["ctg_pro_labfar"];
            $arrTableMed[$rTMP["id"]]["ctg_pro_fecaut"]           = $rTMP["ctg_pro_fecaut"];
            $arrTableMed[$rTMP["id"]]["ctg_pro_fecven"]           = $rTMP["ctg_pro_fecven"];
            $arrTableMed[$rTMP["id"]]["ctg_pro_psinar"]           = $rTMP["ctg_pro_psinar"];
            $arrTableMed[$rTMP["id"]]["ctg_pro_labfar"]           = $rTMP["ctg_pro_labfar"];
            $arrTableMed[$rTMP["id"]]["ctg_pro_indi"]           = $rTMP["ctg_pro_indi"];
        }
        pg_free_result($sql);

    ?>
        <div class="col-md-12 tableFixHead">
            <table id="tableHosp" class="table table-bordered table-striped table-hover table-sm">
                <tbody>
                    <?php
                    if (is_array($arrTableMed) && (count($arrTableMed) > 0)) {
                        $intContador = 1;
                        reset($arrTableMed);
                        foreach ($arrTableMed as $rTMP['key'] => $rTMP['value']) {
                    ?>

                            <tr data-dismiss="modal" style="cursor:pointer;" onclick="fntSelectView7('<?php print $intContador; ?>');">
                                <th>No. de Registro</th>
                                <td><?php echo  $rTMP["value"]['ctg_pro_cod']; ?></td>
                            </tr>
                            <tr data-dismiss="modal" style="cursor:pointer;" onclick="fntSelectView7('<?php print $intContador; ?>');">
                                <th>Nombre</th>
                                <td><?php echo  $rTMP["value"]['ctg_pro_desc']; ?></td>
                            </tr>
                            <tr data-dismiss="modal" style="cursor:pointer;" onclick="fntSelectView7('<?php print $intContador; ?>');">
                                <th>Principio Activo</th>
                                <td><?php echo  $rTMP["value"]['ctg_pro_prinact']; ?></td>
                            </tr>
                            <tr data-dismiss="modal" style="cursor:pointer;" onclick="fntSelectView7('<?php print $intContador; ?>');">
                                <th>Fabricante</th>
                                <td><?php echo  $rTMP["value"]['ctg_pro_labfar']; ?></td>
                            </tr>
                            <tr data-dismiss="modal" style="cursor:pointer;" onclick="fntSelectView7('<?php print $intContador; ?>');">
                                <th>Ficha Tecnica</th>
                                <td><?php echo  $rTMP["value"]['ctg_pro_indi']; ?></td>
                            </tr>
                            <tr data-dismiss="modal" style="cursor:pointer;" onclick="fntSelectView7('<?php print $intContador; ?>');">
                                <th>Vence</th>
                                <td><?php echo  $rTMP["value"]['ctg_pro_fecven']; ?></td>
                            </tr>
                            <tr>
                                <th style="background: #d6eaf8;"></th>
                                <td style="background: #d6eaf8;"></td>
                            </tr>
                            <tr>
                                <th style="background: #d6eaf8;"></th>
                                <td style="background: #d6eaf8;"></td>
                            </tr>

                            <input type="hidden" name="hidId_<?php print $intContador; ?>" id="hidId_<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['ctg_pro_cod']; ?>">
                            <input type="hidden" name="hidNombre_<?php print $intContador; ?>" id="hidNombre_<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['ctg_pro_desc']; ?>">
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
    } else if ($strTipoValidacion == "busqueda_table8") {
        $strSearch = isset($_POST["Search"]) ? $_POST["Search"]  : '';

        $strFilter = "";
        if (!empty($strSearch)) {
            $strFilter = " WHERE ( UPPER(ctg_pro_desc) LIKE '%{$strSearch}%' OR UPPER(ctg_pro_prinact) LIKE '%{$strSearch}%' ) ";
        }

        $arrTableMed = array();
        $var_consulta = "SELECT * FROM ctg_productos $strFilter ORDER BY ctg_pro_desc LIMIT 1000 ";
        $sql = pg_query($rmfAdm, $var_consulta);
        $totalArticle = pg_num_rows($sql);


        while ($rTMP = pg_fetch_assoc($sql)) {

            $arrTableMed[$rTMP["id"]]["id"]                       = $rTMP["id"];
            $arrTableMed[$rTMP["id"]]["ctg_pro_cod"]              = $rTMP["ctg_pro_cod"];
            $arrTableMed[$rTMP["id"]]["ctg_pro_desc"]             = $rTMP["ctg_pro_desc"];
            $arrTableMed[$rTMP["id"]]["ctg_pro_prinact"]          = $rTMP["ctg_pro_prinact"];
            $arrTableMed[$rTMP["id"]]["ctg_pro_labfar"]           = $rTMP["ctg_pro_labfar"];
            $arrTableMed[$rTMP["id"]]["ctg_pro_fecaut"]           = $rTMP["ctg_pro_fecaut"];
            $arrTableMed[$rTMP["id"]]["ctg_pro_fecven"]           = $rTMP["ctg_pro_fecven"];
            $arrTableMed[$rTMP["id"]]["ctg_pro_psinar"]           = $rTMP["ctg_pro_psinar"];
            $arrTableMed[$rTMP["id"]]["ctg_pro_labfar"]           = $rTMP["ctg_pro_labfar"];
            $arrTableMed[$rTMP["id"]]["ctg_pro_indi"]           = $rTMP["ctg_pro_indi"];
        }
        pg_free_result($sql);

    ?>
        <div class="col-md-12 tableFixHead">
            <table id="tableHosp" class="table table-bordered table-striped table-hover table-sm">
                <tbody>
                    <?php
                    if (is_array($arrTableMed) && (count($arrTableMed) > 0)) {
                        $intContador = 1;
                        reset($arrTableMed);
                        foreach ($arrTableMed as $rTMP['key'] => $rTMP['value']) {
                    ?>

                            <tr data-dismiss="modal" style="cursor:pointer;" onclick="fntSelectView8('<?php print $intContador; ?>');">
                                <th>No. de Registro</th>
                                <td><?php echo  $rTMP["value"]['ctg_pro_cod']; ?></td>
                            </tr>
                            <tr data-dismiss="modal" style="cursor:pointer;" onclick="fntSelectView8('<?php print $intContador; ?>');">
                                <th>Nombre</th>
                                <td><?php echo  $rTMP["value"]['ctg_pro_desc']; ?></td>
                            </tr>
                            <tr data-dismiss="modal" style="cursor:pointer;" onclick="fntSelectView8('<?php print $intContador; ?>');">
                                <th>Principio Activo</th>
                                <td><?php echo  $rTMP["value"]['ctg_pro_prinact']; ?></td>
                            </tr>
                            <tr data-dismiss="modal" style="cursor:pointer;" onclick="fntSelectView8('<?php print $intContador; ?>');">
                                <th>Fabricante</th>
                                <td><?php echo  $rTMP["value"]['ctg_pro_labfar']; ?></td>
                            </tr>
                            <tr data-dismiss="modal" style="cursor:pointer;" onclick="fntSelectView8('<?php print $intContador; ?>');">
                                <th>Ficha Tecnica</th>
                                <td><?php echo  $rTMP["value"]['ctg_pro_indi']; ?></td>
                            </tr>
                            <tr data-dismiss="modal" style="cursor:pointer;" onclick="fntSelectView8('<?php print $intContador; ?>');">
                                <th>Vence</th>
                                <td><?php echo  $rTMP["value"]['ctg_pro_fecven']; ?></td>
                            </tr>
                            <tr>
                                <th style="background: #d6eaf8;"></th>
                                <td style="background: #d6eaf8;"></td>
                            </tr>
                            <tr>
                                <th style="background: #d6eaf8;"></th>
                                <td style="background: #d6eaf8;"></td>
                            </tr>

                            <input type="hidden" name="hidId_<?php print $intContador; ?>" id="hidId_<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['ctg_pro_cod']; ?>">
                            <input type="hidden" name="hidNombre_<?php print $intContador; ?>" id="hidNombre_<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['ctg_pro_desc']; ?>">
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
    } else if ($strTipoValidacion == "busqueda_table9") {
        $strSearch = isset($_POST["Search"]) ? $_POST["Search"]  : '';

        $strFilter = "";
        if (!empty($strSearch)) {
            $strFilter = " WHERE ( UPPER(ctg_pro_desc) LIKE '%{$strSearch}%' OR UPPER(ctg_pro_prinact) LIKE '%{$strSearch}%' ) ";
        }

        $arrTableMed = array();
        $var_consulta = "SELECT * FROM ctg_productos $strFilter ORDER BY ctg_pro_desc LIMIT 1000 ";
        $sql = pg_query($rmfAdm, $var_consulta);
        $totalArticle = pg_num_rows($sql);


        while ($rTMP = pg_fetch_assoc($sql)) {

            $arrTableMed[$rTMP["id"]]["id"]                       = $rTMP["id"];
            $arrTableMed[$rTMP["id"]]["ctg_pro_cod"]              = $rTMP["ctg_pro_cod"];
            $arrTableMed[$rTMP["id"]]["ctg_pro_desc"]             = $rTMP["ctg_pro_desc"];
            $arrTableMed[$rTMP["id"]]["ctg_pro_prinact"]          = $rTMP["ctg_pro_prinact"];
            $arrTableMed[$rTMP["id"]]["ctg_pro_labfar"]           = $rTMP["ctg_pro_labfar"];
            $arrTableMed[$rTMP["id"]]["ctg_pro_fecaut"]           = $rTMP["ctg_pro_fecaut"];
            $arrTableMed[$rTMP["id"]]["ctg_pro_fecven"]           = $rTMP["ctg_pro_fecven"];
            $arrTableMed[$rTMP["id"]]["ctg_pro_psinar"]           = $rTMP["ctg_pro_psinar"];
            $arrTableMed[$rTMP["id"]]["ctg_pro_labfar"]           = $rTMP["ctg_pro_labfar"];
            $arrTableMed[$rTMP["id"]]["ctg_pro_indi"]           = $rTMP["ctg_pro_indi"];
        }
        pg_free_result($sql);

    ?>
        <div class="col-md-12 tableFixHead">
            <table id="tableHosp" class="table table-bordered table-striped table-hover table-sm">
                <tbody>
                    <?php
                    if (is_array($arrTableMed) && (count($arrTableMed) > 0)) {
                        $intContador = 1;
                        reset($arrTableMed);
                        foreach ($arrTableMed as $rTMP['key'] => $rTMP['value']) {
                    ?>

                            <tr data-dismiss="modal" style="cursor:pointer;" onclick="fntSelectView9('<?php print $intContador; ?>');">
                                <th>No. de Registro</th>
                                <td><?php echo  $rTMP["value"]['ctg_pro_cod']; ?></td>
                            </tr>
                            <tr data-dismiss="modal" style="cursor:pointer;" onclick="fntSelectView9('<?php print $intContador; ?>');">
                                <th>Nombre</th>
                                <td><?php echo  $rTMP["value"]['ctg_pro_desc']; ?></td>
                            </tr>
                            <tr data-dismiss="modal" style="cursor:pointer;" onclick="fntSelectView9('<?php print $intContador; ?>');">
                                <th>Principio Activo</th>
                                <td><?php echo  $rTMP["value"]['ctg_pro_prinact']; ?></td>
                            </tr>
                            <tr data-dismiss="modal" style="cursor:pointer;" onclick="fntSelectView9('<?php print $intContador; ?>');">
                                <th>Fabricante</th>
                                <td><?php echo  $rTMP["value"]['ctg_pro_labfar']; ?></td>
                            </tr>
                            <tr data-dismiss="modal" style="cursor:pointer;" onclick="fntSelectView9('<?php print $intContador; ?>');">
                                <th>Ficha Tecnica</th>
                                <td><?php echo  $rTMP["value"]['ctg_pro_indi']; ?></td>
                            </tr>
                            <tr data-dismiss="modal" style="cursor:pointer;" onclick="fntSelectView9('<?php print $intContador; ?>');">
                                <th>Vence</th>
                                <td><?php echo  $rTMP["value"]['ctg_pro_fecven']; ?></td>
                            </tr>
                            <tr>
                                <th style="background: #d6eaf8;"></th>
                                <td style="background: #d6eaf8;"></td>
                            </tr>
                            <tr>
                                <th style="background: #d6eaf8;"></th>
                                <td style="background: #d6eaf8;"></td>
                            </tr>

                            <input type="hidden" name="hidId_<?php print $intContador; ?>" id="hidId_<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['ctg_pro_cod']; ?>">
                            <input type="hidden" name="hidNombre_<?php print $intContador; ?>" id="hidNombre_<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['ctg_pro_desc']; ?>">
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
    }


    die();
}
?>
<?php

//codigo de la url para update
$cod_id = $_GET['cod'];
$cod_id =  decrypt($cod_id, $key);
$cod_id = isset($cod_id) ? $cod_id  : '';

require_once "../../data/conexion/tmfAdm.php";
if ($cod_id) {
    $arrData = array();
    $var_consulta = "SELECT * 
                        FROM ctg_pacientes 
                        WHERE ctg_pac_code = '$cod_id'
                        LIMIT 1";
    $sql = pg_query($rmfAdm, $var_consulta);
    $totalArticle = pg_num_rows($sql);


    while ($rTMP = pg_fetch_assoc($sql)) {

        $arrData[$rTMP["id"]]["id"]                           = $rTMP["id"];

        $arrData[$rTMP["id"]]["ctg_pac_medica_code1"]         = $rTMP["ctg_pac_medica_code1"];
        $arrData[$rTMP["id"]]["ctg_pac_medica_espe1"]         = $rTMP["ctg_pac_medica_espe1"];
        $arrData[$rTMP["id"]]["ctg_pac_medica_cron1"]         = $rTMP["ctg_pac_medica_cron1"];
        $arrData[$rTMP["id"]]["ctg_pac_medica_freq1"]         = $rTMP["ctg_pac_medica_freq1"];
        $arrData[$rTMP["id"]]["ctg_pac_medica_date1"]         = $rTMP["ctg_pac_medica_date1"];

        $arrData[$rTMP["id"]]["ctg_pac_medica_code2"]         = $rTMP["ctg_pac_medica_code2"];
        $arrData[$rTMP["id"]]["ctg_pac_medica_espe2"]         = $rTMP["ctg_pac_medica_espe2"];
        $arrData[$rTMP["id"]]["ctg_pac_medica_cron2"]         = $rTMP["ctg_pac_medica_cron2"];
        $arrData[$rTMP["id"]]["ctg_pac_medica_freq2"]         = $rTMP["ctg_pac_medica_freq2"];
        $arrData[$rTMP["id"]]["ctg_pac_medica_date2"]         = $rTMP["ctg_pac_medica_date2"];

        $arrData[$rTMP["id"]]["ctg_pac_medica_code3"]         = $rTMP["ctg_pac_medica_code3"];
        $arrData[$rTMP["id"]]["ctg_pac_medica_espe3"]         = $rTMP["ctg_pac_medica_espe3"];
        $arrData[$rTMP["id"]]["ctg_pac_medica_cron3"]         = $rTMP["ctg_pac_medica_cron3"];
        $arrData[$rTMP["id"]]["ctg_pac_medica_freq3"]         = $rTMP["ctg_pac_medica_freq3"];
        $arrData[$rTMP["id"]]["ctg_pac_medica_date3"]         = $rTMP["ctg_pac_medica_date3"];

        $arrData[$rTMP["id"]]["ctg_pac_medica_code4"]         = $rTMP["ctg_pac_medica_code4"];
        $arrData[$rTMP["id"]]["ctg_pac_medica_espe4"]         = $rTMP["ctg_pac_medica_espe4"];
        $arrData[$rTMP["id"]]["ctg_pac_medica_cron4"]         = $rTMP["ctg_pac_medica_cron4"];
        $arrData[$rTMP["id"]]["ctg_pac_medica_freq4"]         = $rTMP["ctg_pac_medica_freq4"];
        $arrData[$rTMP["id"]]["ctg_pac_medica_date4"]         = $rTMP["ctg_pac_medica_date4"];

        $arrData[$rTMP["id"]]["ctg_pac_medica_code5"]         = $rTMP["ctg_pac_medica_code5"];
        $arrData[$rTMP["id"]]["ctg_pac_medica_espe5"]         = $rTMP["ctg_pac_medica_espe5"];
        $arrData[$rTMP["id"]]["ctg_pac_medica_cron5"]         = $rTMP["ctg_pac_medica_cron5"];
        $arrData[$rTMP["id"]]["ctg_pac_medica_freq5"]         = $rTMP["ctg_pac_medica_freq5"];
        $arrData[$rTMP["id"]]["ctg_pac_medica_date5"]         = $rTMP["ctg_pac_medica_date5"];

        $arrData[$rTMP["id"]]["ctg_pac_medica_code6"]         = $rTMP["ctg_pac_medica_code6"];
        $arrData[$rTMP["id"]]["ctg_pac_medica_espe6"]         = $rTMP["ctg_pac_medica_espe6"];
        $arrData[$rTMP["id"]]["ctg_pac_medica_cron6"]         = $rTMP["ctg_pac_medica_cron6"];
        $arrData[$rTMP["id"]]["ctg_pac_medica_freq6"]         = $rTMP["ctg_pac_medica_freq6"];
        $arrData[$rTMP["id"]]["ctg_pac_medica_date6"]         = $rTMP["ctg_pac_medica_date6"];

        $arrData[$rTMP["id"]]["ctg_pac_medica_code7"]         = $rTMP["ctg_pac_medica_code7"];
        $arrData[$rTMP["id"]]["ctg_pac_medica_espe7"]         = $rTMP["ctg_pac_medica_espe7"];
        $arrData[$rTMP["id"]]["ctg_pac_medica_cron7"]         = $rTMP["ctg_pac_medica_cron7"];
        $arrData[$rTMP["id"]]["ctg_pac_medica_freq7"]         = $rTMP["ctg_pac_medica_freq7"];
        $arrData[$rTMP["id"]]["ctg_pac_medica_date7"]         = $rTMP["ctg_pac_medica_date7"];

        $arrData[$rTMP["id"]]["ctg_pac_medica_code8"]         = $rTMP["ctg_pac_medica_code8"];
        $arrData[$rTMP["id"]]["ctg_pac_medica_espe8"]         = $rTMP["ctg_pac_medica_espe8"];
        $arrData[$rTMP["id"]]["ctg_pac_medica_cron8"]         = $rTMP["ctg_pac_medica_cron8"];
        $arrData[$rTMP["id"]]["ctg_pac_medica_freq8"]         = $rTMP["ctg_pac_medica_freq8"];
        $arrData[$rTMP["id"]]["ctg_pac_medica_date8"]         = $rTMP["ctg_pac_medica_date8"];

        $arrData[$rTMP["id"]]["ctg_pac_medica_code9"]         = $rTMP["ctg_pac_medica_code9"];
        $arrData[$rTMP["id"]]["ctg_pac_medica_espe9"]         = $rTMP["ctg_pac_medica_espe9"];
        $arrData[$rTMP["id"]]["ctg_pac_medica_cron9"]         = $rTMP["ctg_pac_medica_cron9"];
        $arrData[$rTMP["id"]]["ctg_pac_medica_freq9"]         = $rTMP["ctg_pac_medica_freq9"];
        $arrData[$rTMP["id"]]["ctg_pac_medica_date9"]         = $rTMP["ctg_pac_medica_date9"];
    }
    pg_free_result($sql);
?>

<?php
    if (is_array($arrData) && (count($arrData) > 0)) {
        reset($arrData);
        foreach ($arrData as $rTMP['key'] => $rTMP['value']) {

            $id_farmac =  $rTMP["value"]['id'];

            $ctg_pac_medica_code1 = $rTMP["value"]['ctg_pac_medica_code1'];
            $ctg_pac_medica_espe1 = $rTMP["value"]['ctg_pac_medica_espe1'];
            $ctg_pac_medica_cron1 = $rTMP["value"]['ctg_pac_medica_cron1'];
            $ctg_pac_medica_freq1 = $rTMP["value"]['ctg_pac_medica_freq1'];
            $ctg_pac_medica_date1 = $rTMP["value"]['ctg_pac_medica_date1'];

            $ctg_pac_medica_code2 = $rTMP["value"]['ctg_pac_medica_code2'];
            $ctg_pac_medica_espe2 = $rTMP["value"]['ctg_pac_medica_espe2'];
            $ctg_pac_medica_cron2 = $rTMP["value"]['ctg_pac_medica_cron2'];
            $ctg_pac_medica_freq2 = $rTMP["value"]['ctg_pac_medica_freq2'];
            $ctg_pac_medica_date2 = $rTMP["value"]['ctg_pac_medica_date2'];

            $ctg_pac_medica_code3 = $rTMP["value"]['ctg_pac_medica_code3'];
            $ctg_pac_medica_espe3 = $rTMP["value"]['ctg_pac_medica_espe3'];
            $ctg_pac_medica_cron3 = $rTMP["value"]['ctg_pac_medica_cron3'];
            $ctg_pac_medica_freq3 = $rTMP["value"]['ctg_pac_medica_freq3'];
            $ctg_pac_medica_date3 = $rTMP["value"]['ctg_pac_medica_date3'];

            $ctg_pac_medica_code4 = $rTMP["value"]['ctg_pac_medica_code4'];
            $ctg_pac_medica_espe4 = $rTMP["value"]['ctg_pac_medica_espe4'];
            $ctg_pac_medica_cron4 = $rTMP["value"]['ctg_pac_medica_cron4'];
            $ctg_pac_medica_freq4 = $rTMP["value"]['ctg_pac_medica_freq4'];
            $ctg_pac_medica_date4 = $rTMP["value"]['ctg_pac_medica_date4'];

            $ctg_pac_medica_code5 = $rTMP["value"]['ctg_pac_medica_code5'];
            $ctg_pac_medica_espe5 = $rTMP["value"]['ctg_pac_medica_espe5'];
            $ctg_pac_medica_cron5 = $rTMP["value"]['ctg_pac_medica_cron5'];
            $ctg_pac_medica_freq5 = $rTMP["value"]['ctg_pac_medica_freq5'];
            $ctg_pac_medica_date5 = $rTMP["value"]['ctg_pac_medica_date5'];

            $ctg_pac_medica_code6 = $rTMP["value"]['ctg_pac_medica_code6'];
            $ctg_pac_medica_espe6 = $rTMP["value"]['ctg_pac_medica_espe6'];
            $ctg_pac_medica_cron6 = $rTMP["value"]['ctg_pac_medica_cron6'];
            $ctg_pac_medica_freq6 = $rTMP["value"]['ctg_pac_medica_freq6'];
            $ctg_pac_medica_date6 = $rTMP["value"]['ctg_pac_medica_date6'];

            $ctg_pac_medica_code7 = $rTMP["value"]['ctg_pac_medica_code7'];
            $ctg_pac_medica_espe7 = $rTMP["value"]['ctg_pac_medica_espe7'];
            $ctg_pac_medica_cron7 = $rTMP["value"]['ctg_pac_medica_cron7'];
            $ctg_pac_medica_freq7 = $rTMP["value"]['ctg_pac_medica_freq7'];
            $ctg_pac_medica_date7 = $rTMP["value"]['ctg_pac_medica_date7'];

            $ctg_pac_medica_code8 = $rTMP["value"]['ctg_pac_medica_code8'];
            $ctg_pac_medica_espe8 = $rTMP["value"]['ctg_pac_medica_espe8'];
            $ctg_pac_medica_cron8 = $rTMP["value"]['ctg_pac_medica_cron8'];
            $ctg_pac_medica_freq8 = $rTMP["value"]['ctg_pac_medica_freq8'];
            $ctg_pac_medica_date8 = $rTMP["value"]['ctg_pac_medica_date8'];

            $ctg_pac_medica_code9 = $rTMP["value"]['ctg_pac_medica_code9'];
            $ctg_pac_medica_espe9 = $rTMP["value"]['ctg_pac_medica_espe9'];
            $ctg_pac_medica_cron9 = $rTMP["value"]['ctg_pac_medica_cron9'];
            $ctg_pac_medica_freq9 = $rTMP["value"]['ctg_pac_medica_freq9'];
            $ctg_pac_medica_date9 = $rTMP["value"]['ctg_pac_medica_date9'];
        }
    }
}

?>
<?php
if (isset($_GET["validaciones"]) && !empty($_GET["validaciones"])) {
    require_once "../../data/conexion/tmfAdm.php";
    $usuario = $_SESSION['adm_usr_code'];

    $cod_id = isset($_POST["code"]) ? $_POST["code"]  : '';

    $ctg_pac_medico_cabe_code = isset($_POST["ctg_pac_medico_cabe_code"]) ? $_POST["ctg_pac_medico_cabe_code"]  : '';
    $ctg_pac_medico_cabe_descrip = isset($_POST["ctg_pac_medico_cabe_descrip"]) ? $_POST["ctg_pac_medico_cabe_descrip"]  : '';
    $ctg_pac_medico_cabe_espe = isset($_POST["ctg_pac_medico_cabe_espe"]) ? $_POST["ctg_pac_medico_cabe_espe"]  : 0;

    $ctg_pac_medico_code1 = isset($_POST["ctg_pac_medico_code1"]) ? $_POST["ctg_pac_medico_code1"]  : '';
    $ctg_pac_medico_descrip1 = isset($_POST["ctg_pac_medico_descrip1"]) ? $_POST["ctg_pac_medico_descrip1"]  : '';
    $ctg_pac_medico_espe1 = isset($_POST["ctg_pac_medico_espe1_"]) ? $_POST["ctg_pac_medico_espe1_"]  : 0;

    $ctg_pac_medico_code2 = isset($_POST["ctg_pac_medico_code2"]) ? $_POST["ctg_pac_medico_code2"]  : '';
    $ctg_pac_medico_descrip2 = isset($_POST["ctg_pac_medico_descrip2"]) ? $_POST["ctg_pac_medico_descrip2"]  : '';
    $ctg_pac_medico_espe2 = isset($_POST["ctg_pac_medico_espe2_"]) ? $_POST["ctg_pac_medico_espe2_"]  : 0;

    $ctg_pac_medico_code3 = isset($_POST["ctg_pac_medico_code3"]) ? $_POST["ctg_pac_medico_code3"]  : '';
    $ctg_pac_medico_descrip3 = isset($_POST["ctg_pac_medico_descrip3"]) ? $_POST["ctg_pac_medico_descrip3"]  : '';
    $ctg_pac_medico_espe3 = isset($_POST["ctg_pac_medico_espe3_"]) ? $_POST["ctg_pac_medico_espe3_"]  : 0;

    $ctg_pac_medico_code4 = isset($_POST["ctg_pac_medico_code4"]) ? $_POST["ctg_pac_medico_code4"]  : '';
    $ctg_pac_medico_descrip4 = isset($_POST["ctg_pac_medico_descrip4"]) ? $_POST["ctg_pac_medico_descrip4"]  : '';
    $ctg_pac_medico_espe4 = isset($_POST["ctg_pac_medico_espe4_"]) ? $_POST["ctg_pac_medico_espe4_"]  : 0;

    $ctg_pac_medico_code5 = isset($_POST["ctg_pac_medico_code5"]) ? $_POST["ctg_pac_medico_code5"]  : '';
    $ctg_pac_medico_descrip5 = isset($_POST["ctg_pac_medico_descrip5"]) ? $_POST["ctg_pac_medico_descrip5"]  : '';
    $ctg_pac_medico_espe5 = isset($_POST["ctg_pac_medico_espe5_"]) ? $_POST["ctg_pac_medico_espe5_"]  : 0;

    $ctg_pac_medico_code6 = isset($_POST["ctg_pac_medico_code6"]) ? $_POST["ctg_pac_medico_code6"]  : '';
    $ctg_pac_medico_descrip6 = isset($_POST["ctg_pac_medico_descrip6"]) ? $_POST["ctg_pac_medico_descrip6"]  : '';
    $ctg_pac_medico_espe6 = isset($_POST["ctg_pac_medico_espe6_"]) ? $_POST["ctg_pac_medico_espe6_"]  : 0;

    $ctg_pac_medico_code7 = isset($_POST["ctg_pac_medico_code7"]) ? $_POST["ctg_pac_medico_code7"]  : '';
    $ctg_pac_medico_descrip7 = isset($_POST["ctg_pac_medico_descrip7"]) ? $_POST["ctg_pac_medico_descrip7"]  : '';
    $ctg_pac_medico_espe7 = isset($_POST["ctg_pac_medico_espe7_"]) ? $_POST["ctg_pac_medico_espe7_"]  : 0;

    $ctg_pac_medico_code8 = isset($_POST["ctg_pac_medico_code8"]) ? $_POST["ctg_pac_medico_code8"]  : '';
    $ctg_pac_medico_descrip8 = isset($_POST["ctg_pac_medico_descrip8"]) ? $_POST["ctg_pac_medico_descrip8"]  : '';
    $ctg_pac_medico_espe8 = isset($_POST["ctg_pac_medico_espe8_"]) ? $_POST["ctg_pac_medico_espe8_"]  : 0;

    $ctg_pac_medico_code9 = isset($_POST["ctg_pac_medico_code9"]) ? $_POST["ctg_pac_medico_code9"]  : '';
    $ctg_pac_medico_descrip9 = isset($_POST["ctg_pac_medico_descrip9"]) ? $_POST["ctg_pac_medico_descrip9"]  : '';
    $ctg_pac_medico_espe9 = isset($_POST["ctg_pac_medico_espe9_"]) ? $_POST["ctg_pac_medico_espe9_"]  : 0;

    $status = 1;
    $fechaIng = date('Y-m-d H:i:s');
    $val = 1;
    $strTipoValidacion = isset($_REQUEST["validaciones"]) ? $_REQUEST["validaciones"] : '';
    if ($strTipoValidacion == "update") {
        header('Content-Type: application/json');
        $var_consulta = "UPDATE ctg_pacientes SET ctg_pac_medico_cabe_code = '$ctg_pac_medico_cabe_code',ctg_pac_medico_cabe_descrip = '$ctg_pac_medico_cabe_descrip',ctg_pac_medico_cabe_espe = '$ctg_pac_medico_cabe_espe',ctg_pac_medico_code1 ='$ctg_pac_medico_code1',ctg_pac_medico_descrip1 = '$ctg_pac_medico_descrip1',ctg_pac_medico_espe1 = '$ctg_pac_medico_espe1',ctg_pac_medico_code2 = '$ctg_pac_medico_code2',ctg_pac_medico_descrip2 = '$ctg_pac_medico_descrip2',ctg_pac_medico_espe2 = '$ctg_pac_medico_espe2',ctg_pac_medico_code3 = '$ctg_pac_medico_code3',ctg_pac_medico_descrip3 = '$ctg_pac_medico_descrip3',ctg_pac_medico_espe3 = '$ctg_pac_medico_espe3',ctg_pac_medico_code4 = '$ctg_pac_medico_code4',ctg_pac_medico_descrip4 = '$ctg_pac_medico_descrip4',ctg_pac_medico_espe4 = '$ctg_pac_medico_espe4',ctg_pac_medico_code5 = '$ctg_pac_medico_code5',ctg_pac_medico_descrip5 = '$ctg_pac_medico_descrip5',ctg_pac_medico_espe5 = '$ctg_pac_medico_espe5',ctg_pac_medico_code6 = '$ctg_pac_medico_code6',ctg_pac_medico_descrip6 = '$ctg_pac_medico_descrip6',ctg_pac_medico_espe6 = '$ctg_pac_medico_espe6',ctg_pac_medico_code7 = '$ctg_pac_medico_code7',ctg_pac_medico_descrip7 = '$ctg_pac_medico_descrip7',ctg_pac_medico_espe7 = '$ctg_pac_medico_espe7',ctg_pac_medico_code8 = '$ctg_pac_medico_code8',ctg_pac_medico_descrip8 = '$ctg_pac_medico_descrip8',ctg_pac_medico_espe8 = '$ctg_pac_medico_espe8',ctg_pac_medico_code9 = '$ctg_pac_medico_code9',ctg_pac_medico_descrip9 = '$ctg_pac_medico_descrip9',ctg_pac_medico_espe9 = '$ctg_pac_medico_espe9',ctg_pac_dt = '$fechaIng' WHERE id = $cod_id";
        $val = 1;
        if (pg_query($rmfAdm, $var_consulta)) {
            $arrInfo['status'] = $val;
        } else {
            $arrInfo['status'] = 0;
            $arrInfo['error'] = $var_consulta;
        }
               // print_r($var_consulta);

        print json_encode($arrInfo);
        die();
    } else if ($strTipoValidacion == "busqueda_tableCabe") {
        $strSearch = isset($_POST["Search"]) ? $_POST["Search"]  : '';

        $strFilter = "";
        if (!empty($strSearch)) {
            $strFilter = " WHERE ( UPPER(ctg_med_nombres) LIKE UPPER('%{$strSearch}%') ";
        }

        $arrTableMed = array();
        $var_consulta = "SELECT *
                        FROM ctg_medicos
                        $strFilter 
                        ORDER BY ctg_med_nombres
                        LIMIT 1000";
        $sql = pg_query($rmfAdm, $var_consulta);
        $totalArticle = pg_num_rows($sql);
        //print_r($var_consulta);

        while ($rTMP = pg_fetch_assoc($sql)) {

            $arrTableMed[$rTMP["id"]]["id"]                       = $rTMP["id"];
            $arrTableMed[$rTMP["id"]]["ctg_med_code"]              = $rTMP["ctg_med_code"];
            $arrTableMed[$rTMP["id"]]["ctg_med_nombres"]             = $rTMP["ctg_med_nombres"];
            $arrTableMed[$rTMP["id"]]["ctg_med_apellidos"]             = $rTMP["ctg_med_apellidos"];
        }
        pg_free_result($sql);

?>
        <div class="col-md-12 tableFixHead">
            <table id="tableHosp" class="table table-bordered table-striped table-hover table-sm">
                <thead>
                    <tr class="table-info">
                        <th>Nombre</th>
                    </tr>
                </thead>

                <tbody>
                    <?php
                    if (is_array($arrTableMed) && (count($arrTableMed) > 0)) {
                        $intContador = 1;
                        reset($arrTableMed);
                        foreach ($arrTableMed as $rTMP['key'] => $rTMP['value']) {
                    ?>

                            <tr data-dismiss="modal" style="cursor:pointer;" onclick="fntSelectViewCabe('<?php print $intContador; ?>');">

                            <td><?php echo  $rTMP["value"]['ctg_med_nombres']; ?> <?php echo  $rTMP["value"]['ctg_med_apellidos']; ?></td>
                            </tr>

                            <input type="hidden" name="hidId_<?php print $intContador; ?>" id="hidId_<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['ctg_med_code']; ?>">
                            <input type="hidden" name="hidNombre_<?php print $intContador; ?>" id="hidNombre_<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['ctg_med_nombres']; ?>">
                            <input type="hidden" name="hidApellido_<?php print $intContador; ?>" id="hidApellido_<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['ctg_med_apellidos']; ?>">
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
    } else if ($strTipoValidacion == "busqueda_table1") {
        $strSearch = isset($_POST["Search"]) ? $_POST["Search"]  : '';

        $strFilter = "";
        if (!empty($strSearch)) {
            $strFilter = " WHERE ( UPPER(ctg_med_nombres) LIKE UPPER('%{$strSearch}%') ";
        }

        $arrTableMed = array();
        $var_consulta = "SELECT *
                        FROM ctg_medicos
                        $strFilter 
                        ORDER BY ctg_med_nombres
                        LIMIT 1000";
        $sql = pg_query($rmfAdm, $var_consulta);
        $totalArticle = pg_num_rows($sql);
        //print_r($var_consulta);

        while ($rTMP = pg_fetch_assoc($sql)) {

            $arrTableMed[$rTMP["id"]]["id"]                       = $rTMP["id"];
            $arrTableMed[$rTMP["id"]]["ctg_med_code"]              = $rTMP["ctg_med_code"];
            $arrTableMed[$rTMP["id"]]["ctg_med_nombres"]             = $rTMP["ctg_med_nombres"];
            $arrTableMed[$rTMP["id"]]["ctg_med_apellidos"]             = $rTMP["ctg_med_apellidos"];
        }
        pg_free_result($sql);

?>
        <div class="col-md-12 tableFixHead">
            <table id="tableHosp" class="table table-bordered table-striped table-hover table-sm">
                <thead>
                    <tr class="table-info">
                        <th>Nombre</th>
                    </tr>
                </thead>

                <tbody>
                    <?php
                    if (is_array($arrTableMed) && (count($arrTableMed) > 0)) {
                        $intContador = 1;
                        reset($arrTableMed);
                        foreach ($arrTableMed as $rTMP['key'] => $rTMP['value']) {
                    ?>

                            <tr data-dismiss="modal" style="cursor:pointer;" onclick="fntSelectView1('<?php print $intContador; ?>');">

                            <td><?php echo  $rTMP["value"]['ctg_med_nombres']; ?> <?php echo  $rTMP["value"]['ctg_med_apellidos']; ?></td>
                            </tr>

                            <input type="hidden" name="hidId_<?php print $intContador; ?>" id="hidId_<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['ctg_med_code']; ?>">
                            <input type="hidden" name="hidNombre_<?php print $intContador; ?>" id="hidNombre_<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['ctg_med_nombres']; ?>">
                            <input type="hidden" name="hidApellido_<?php print $intContador; ?>" id="hidApellido_<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['ctg_med_apellidos']; ?>">
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
            $strFilter = " WHERE ( UPPER(ctg_med_nombres) LIKE UPPER('%{$strSearch}%') ";
        }

        $arrTableMed = array();
        $var_consulta = "SELECT *
                        FROM ctg_medicos
                        $strFilter 
                        ORDER BY ctg_med_nombres
                        LIMIT 1000";
        $sql = pg_query($rmfAdm, $var_consulta);
        $totalArticle = pg_num_rows($sql);


        while ($rTMP = pg_fetch_assoc($sql)) {

            $arrTableMed[$rTMP["id"]]["id"]                       = $rTMP["id"];
            $arrTableMed[$rTMP["id"]]["ctg_med_code"]              = $rTMP["ctg_med_code"];
            $arrTableMed[$rTMP["id"]]["ctg_med_nombres"]             = $rTMP["ctg_med_nombres"];
            $arrTableMed[$rTMP["id"]]["ctg_med_apellidos"]             = $rTMP["ctg_med_apellidos"];
        }
        pg_free_result($sql);

    ?>
        <div class="col-md-12 tableFixHead">
            <table id="tableHosp" class="table table-bordered table-striped table-hover table-sm">
                <thead>
                    <tr class="table-info">
                        <th>Nombre</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (is_array($arrTableMed) && (count($arrTableMed) > 0)) {
                        $intContador = 1;
                        reset($arrTableMed);
                        foreach ($arrTableMed as $rTMP['key'] => $rTMP['value']) {
                    ?>

                            <tr data-dismiss="modal" style="cursor:pointer;" onclick="fntSelectView2('<?php print $intContador; ?>');">

                            <td><?php echo  $rTMP["value"]['ctg_med_nombres']; ?> <?php echo  $rTMP["value"]['ctg_med_apellidos']; ?></td>
                            </tr>

                            <input type="hidden" name="hidId_<?php print $intContador; ?>" id="hidId_<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['ctg_med_code']; ?>">
                            <input type="hidden" name="hidNombre_<?php print $intContador; ?>" id="hidNombre_<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['ctg_med_nombres']; ?>">
                            <input type="hidden" name="hidApellido_<?php print $intContador; ?>" id="hidApellido_<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['ctg_med_apellidos']; ?>">
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
            $strFilter = " WHERE ( UPPER(ctg_med_nombres) LIKE UPPER('%{$strSearch}%') ";
        }

        $arrTableMed = array();
        $var_consulta = "SELECT *
                        FROM ctg_medicos
                        $strFilter 
                        ORDER BY ctg_med_nombres
                        LIMIT 1000";
        $sql = pg_query($rmfAdm, $var_consulta);
        $totalArticle = pg_num_rows($sql);


        while ($rTMP = pg_fetch_assoc($sql)) {

            $arrTableMed[$rTMP["id"]]["id"]                       = $rTMP["id"];
            $arrTableMed[$rTMP["id"]]["ctg_med_code"]              = $rTMP["ctg_med_code"];
            $arrTableMed[$rTMP["id"]]["ctg_med_nombres"]             = $rTMP["ctg_med_nombres"];
            $arrTableMed[$rTMP["id"]]["ctg_med_apellidos"]             = $rTMP["ctg_med_apellidos"];
        }
        pg_free_result($sql);

    ?>
        <div class="col-md-12 tableFixHead">
            <table id="tableHosp" class="table table-bordered table-striped table-hover table-sm">
                <thead>
                    <tr class="table-info">
                        <th>Nombre</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (is_array($arrTableMed) && (count($arrTableMed) > 0)) {
                        $intContador = 1;
                        reset($arrTableMed);
                        foreach ($arrTableMed as $rTMP['key'] => $rTMP['value']) {
                    ?>

                            <tr data-dismiss="modal" style="cursor:pointer;" onclick="fntSelectView3('<?php print $intContador; ?>');">

                            <td><?php echo  $rTMP["value"]['ctg_med_nombres']; ?> <?php echo  $rTMP["value"]['ctg_med_apellidos']; ?></td>
                            </tr>

                            <input type="hidden" name="hidId_<?php print $intContador; ?>" id="hidId_<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['ctg_med_code']; ?>">
                            <input type="hidden" name="hidNombre_<?php print $intContador; ?>" id="hidNombre_<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['ctg_med_nombres']; ?>">
                            <input type="hidden" name="hidApellido_<?php print $intContador; ?>" id="hidApellido_<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['ctg_med_apellidos']; ?>">
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
            $strFilter = " WHERE ( UPPER(ctg_med_nombres) LIKE UPPER('%{$strSearch}%') ";
        }

        $arrTableMed = array();
        $var_consulta = "SELECT *
                        FROM ctg_medicos
                        ORDER BY ctg_med_nombres
                        LIMIT 1000";
        $sql = pg_query($rmfAdm, $var_consulta);
        $totalArticle = pg_num_rows($sql);


        while ($rTMP = pg_fetch_assoc($sql)) {

            $arrTableMed[$rTMP["id"]]["id"]                       = $rTMP["id"];
            $arrTableMed[$rTMP["id"]]["ctg_med_code"]              = $rTMP["ctg_med_code"];
            $arrTableMed[$rTMP["id"]]["ctg_med_nombres"]             = $rTMP["ctg_med_nombres"];
            $arrTableMed[$rTMP["id"]]["ctg_med_apellidos"]             = $rTMP["ctg_med_apellidos"];
        }
        pg_free_result($sql);

    ?>
        <div class="col-md-12 tableFixHead">
            <table id="tableHosp" class="table table-bordered table-striped table-hover table-sm">
                <thead>
                    <tr class="table-info">
                        <th>Nombre</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (is_array($arrTableMed) && (count($arrTableMed) > 0)) {
                        $intContador = 1;
                        reset($arrTableMed);
                        foreach ($arrTableMed as $rTMP['key'] => $rTMP['value']) {
                    ?>

                            <tr data-dismiss="modal" style="cursor:pointer;" onclick="fntSelectView4('<?php print $intContador; ?>');">

                            <td><?php echo  $rTMP["value"]['ctg_med_nombres']; ?> <?php echo  $rTMP["value"]['ctg_med_apellidos']; ?></td>
                            </tr>

                            <input type="hidden" name="hidId_<?php print $intContador; ?>" id="hidId_<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['ctg_med_code']; ?>">
                            <input type="hidden" name="hidNombre_<?php print $intContador; ?>" id="hidNombre_<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['ctg_med_nombres']; ?>">
                            <input type="hidden" name="hidApellido_<?php print $intContador; ?>" id="hidApellido_<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['ctg_med_apellidos']; ?>">
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
            $strFilter = " WHERE ( UPPER(ctg_med_nombres) LIKE UPPER('%{$strSearch}%') ";
        }

        $arrTableMed = array();
        $var_consulta = "SELECT *
                        FROM ctg_medicos
                        $strFilter 
                        ORDER BY ctg_med_nombres
                        LIMIT 1000";
        $sql = pg_query($rmfAdm, $var_consulta);
        $totalArticle = pg_num_rows($sql);


        while ($rTMP = pg_fetch_assoc($sql)) {

            $arrTableMed[$rTMP["id"]]["id"]                       = $rTMP["id"];
            $arrTableMed[$rTMP["id"]]["ctg_med_code"]              = $rTMP["ctg_med_code"];
            $arrTableMed[$rTMP["id"]]["ctg_med_nombres"]             = $rTMP["ctg_med_nombres"];
            $arrTableMed[$rTMP["id"]]["ctg_med_apellidos"]             = $rTMP["ctg_med_apellidos"];
        }
        pg_free_result($sql);

    ?>
        <div class="col-md-12 tableFixHead">
            <table id="tableHosp" class="table table-bordered table-striped table-hover table-sm">
                <thead>
                    <tr class="table-info">
                        <th>Nombre</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (is_array($arrTableMed) && (count($arrTableMed) > 0)) {
                        $intContador = 1;
                        reset($arrTableMed);
                        foreach ($arrTableMed as $rTMP['key'] => $rTMP['value']) {
                    ?>

                            <tr data-dismiss="modal" style="cursor:pointer;" onclick="fntSelectView5('<?php print $intContador; ?>');">

                            <td><?php echo  $rTMP["value"]['ctg_med_nombres']; ?> <?php echo  $rTMP["value"]['ctg_med_apellidos']; ?></td>
                            </tr>

                            <input type="hidden" name="hidId_<?php print $intContador; ?>" id="hidId_<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['ctg_med_code']; ?>">
                            <input type="hidden" name="hidNombre_<?php print $intContador; ?>" id="hidNombre_<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['ctg_med_nombres']; ?>">
                            <input type="hidden" name="hidApellido_<?php print $intContador; ?>" id="hidApellido_<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['ctg_med_apellidos']; ?>">
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
            $strFilter = " WHERE ( UPPER(ctg_med_nombres) LIKE UPPER('%{$strSearch}%') ";
        }

        $arrTableMed = array();
        $var_consulta = "SELECT *
                        FROM ctg_medicos
                        $strFilter 
                        ORDER BY ctg_med_nombres
                        LIMIT 1000";
        $sql = pg_query($rmfAdm, $var_consulta);
        $totalArticle = pg_num_rows($sql);


        while ($rTMP = pg_fetch_assoc($sql)) {

            $arrTableMed[$rTMP["id"]]["id"]                       = $rTMP["id"];
            $arrTableMed[$rTMP["id"]]["ctg_med_code"]              = $rTMP["ctg_med_code"];
            $arrTableMed[$rTMP["id"]]["ctg_med_nombres"]             = $rTMP["ctg_med_nombres"];
            $arrTableMed[$rTMP["id"]]["ctg_med_apellidos"]             = $rTMP["ctg_med_apellidos"];
     
        }
        pg_free_result($sql);

    ?>
        <div class="col-md-12 tableFixHead">
            <table id="tableHosp" class="table table-bordered table-striped table-hover table-sm">
                <thead>
                    <tr class="table-info">
                        <th>Nombre</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (is_array($arrTableMed) && (count($arrTableMed) > 0)) {
                        $intContador = 1;
                        reset($arrTableMed);
                        foreach ($arrTableMed as $rTMP['key'] => $rTMP['value']) {
                    ?>

                            <tr data-dismiss="modal" style="cursor:pointer;" onclick="fntSelectView6('<?php print $intContador; ?>');">

                            <td><?php echo  $rTMP["value"]['ctg_med_nombres']; ?> <?php echo  $rTMP["value"]['ctg_med_apellidos']; ?></td>
                            </tr>

                            <input type="hidden" name="hidId_<?php print $intContador; ?>" id="hidId_<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['ctg_med_code']; ?>">
                            <input type="hidden" name="hidNombre_<?php print $intContador; ?>" id="hidNombre_<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['ctg_med_nombres']; ?>">
                            <input type="hidden" name="hidApellido_<?php print $intContador; ?>" id="hidApellido_<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['ctg_med_apellidos']; ?>">
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
            $strFilter = " WHERE ( UPPER(ctg_med_nombres) LIKE UPPER('%{$strSearch}%') ";
        }

        $arrTableMed = array();
        $var_consulta = "SELECT *
                        FROM ctg_medicos
                        $strFilter 
                        ORDER BY ctg_med_nombres
                        LIMIT 1000";
        $sql = pg_query($rmfAdm, $var_consulta);
        $totalArticle = pg_num_rows($sql);


        while ($rTMP = pg_fetch_assoc($sql)) {

            $arrTableMed[$rTMP["id"]]["id"]                       = $rTMP["id"];
            $arrTableMed[$rTMP["id"]]["ctg_med_code"]              = $rTMP["ctg_med_code"];
            $arrTableMed[$rTMP["id"]]["ctg_med_nombres"]             = $rTMP["ctg_med_nombres"];
            $arrTableMed[$rTMP["id"]]["ctg_med_apellidos"]             = $rTMP["ctg_med_apellidos"];
        }
        pg_free_result($sql);

    ?>
        <div class="col-md-12 tableFixHead">
            <table id="tableHosp" class="table table-bordered table-striped table-hover table-sm">
                <thead>
                    <tr class="table-info">
                        <th>Nombre</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (is_array($arrTableMed) && (count($arrTableMed) > 0)) {
                        $intContador = 1;
                        reset($arrTableMed);
                        foreach ($arrTableMed as $rTMP['key'] => $rTMP['value']) {
                    ?>

                            <tr data-dismiss="modal" style="cursor:pointer;" onclick="fntSelectView7('<?php print $intContador; ?>');">

                            <td><?php echo  $rTMP["value"]['ctg_med_nombres']; ?> <?php echo  $rTMP["value"]['ctg_med_apellidos']; ?></td>
                            </tr>

                            <input type="hidden" name="hidId_<?php print $intContador; ?>" id="hidId_<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['ctg_med_code']; ?>">
                            <input type="hidden" name="hidNombre_<?php print $intContador; ?>" id="hidNombre_<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['ctg_med_nombres']; ?>">
                            <input type="hidden" name="hidApellido_<?php print $intContador; ?>" id="hidApellido_<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['ctg_med_apellidos']; ?>">
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
            $strFilter = " WHERE ( UPPER(ctg_med_nombres) LIKE UPPER('%{$strSearch}%') ";
        }

        $arrTableMed = array();
        $var_consulta = "SELECT *
                        FROM ctg_medicos
                        $strFilter 
                        ORDER BY ctg_med_nombres
                        LIMIT 1000";
        $sql = pg_query($rmfAdm, $var_consulta);
        $totalArticle = pg_num_rows($sql);


        while ($rTMP = pg_fetch_assoc($sql)) {

            $arrTableMed[$rTMP["id"]]["id"]                       = $rTMP["id"];
            $arrTableMed[$rTMP["id"]]["ctg_med_code"]              = $rTMP["ctg_med_code"];
            $arrTableMed[$rTMP["id"]]["ctg_med_nombres"]             = $rTMP["ctg_med_nombres"];
            $arrTableMed[$rTMP["id"]]["ctg_med_apellidos"]             = $rTMP["ctg_med_apellidos"];
        }
        pg_free_result($sql);

    ?>
        <div class="col-md-12 tableFixHead">
            <table id="tableHosp" class="table table-bordered table-striped table-hover table-sm">
                <thead>
                    <tr class="table-info">
                        <th>Nombre</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (is_array($arrTableMed) && (count($arrTableMed) > 0)) {
                        $intContador = 1;
                        reset($arrTableMed);
                        foreach ($arrTableMed as $rTMP['key'] => $rTMP['value']) {
                    ?>

                            <tr data-dismiss="modal" style="cursor:pointer;" onclick="fntSelectView8('<?php print $intContador; ?>');">

                            <td><?php echo  $rTMP["value"]['ctg_med_nombres']; ?> <?php echo  $rTMP["value"]['ctg_med_apellidos']; ?></td>
                            </tr>

                            <input type="hidden" name="hidId_<?php print $intContador; ?>" id="hidId_<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['ctg_med_code']; ?>">
                            <input type="hidden" name="hidNombre_<?php print $intContador; ?>" id="hidNombre_<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['ctg_med_nombres']; ?>">
                            <input type="hidden" name="hidApellido_<?php print $intContador; ?>" id="hidApellido_<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['ctg_med_apellidos']; ?>">
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
            $strFilter = " WHERE ( UPPER(ctg_med_nombres) LIKE UPPER('%{$strSearch}%')  ) ";
        }

        $arrTableMed = array();
        $var_consulta = "SELECT *
                        FROM ctg_medicos
                        $strFilter 
                        ORDER BY ctg_med_nombres
                        LIMIT 1000";
        $sql = pg_query($rmfAdm, $var_consulta);
        $totalArticle = pg_num_rows($sql);


        while ($rTMP = pg_fetch_assoc($sql)) {

            $arrTableMed[$rTMP["id"]]["id"]                       = $rTMP["id"];
            $arrTableMed[$rTMP["id"]]["ctg_med_code"]              = $rTMP["ctg_med_code"];
            $arrTableMed[$rTMP["id"]]["ctg_med_nombres"]             = $rTMP["ctg_med_nombres"];
            $arrTableMed[$rTMP["id"]]["ctg_med_apellidos"]             = $rTMP["ctg_med_apellidos"];
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

                            <td><?php echo  $rTMP["value"]['ctg_med_nombres']; ?> <?php echo  $rTMP["value"]['ctg_med_apellidos']; ?></td>
                            </tr>

                            <input type="hidden" name="hidId_<?php print $intContador; ?>" id="hidId_<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['ctg_med_code']; ?>">
                            <input type="hidden" name="hidNombre_<?php print $intContador; ?>" id="hidNombre_<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['ctg_med_nombres']; ?>">
                            <input type="hidden" name="hidApellido_<?php print $intContador; ?>" id="hidApellido_<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['ctg_med_apellidos']; ?>">
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
require_once "../../data/conexion/tmfAdm.php";
$usuarioId = $_SESSION['adm_usr_code'];
$arrData = array();
$var_consulta = "SELECT * 
                    FROM ctg_pacientes 
                    WHERE ctg_pac_code = '$usuarioId'
                    LIMIT 1";
$sql = pg_query($rmfAdm, $var_consulta);
$totalArticle = pg_num_rows($sql);


while ($rTMP = pg_fetch_assoc($sql)) {

    $arrData[$rTMP["id"]]["id"]                                         = $rTMP["id"];

    $arrData[$rTMP["id"]]["ctg_pac_medico_cabe_code"]         = $rTMP["ctg_pac_medico_cabe_code"];
    $arrData[$rTMP["id"]]["ctg_pac_medico_cabe_descrip"]         = $rTMP["ctg_pac_medico_cabe_descrip"];
    $arrData[$rTMP["id"]]["ctg_pac_medico_cabe_espe"]         = $rTMP["ctg_pac_medico_cabe_espe"];

    $arrData[$rTMP["id"]]["ctg_pac_medico_code1"]         = $rTMP["ctg_pac_medico_code1"];
    $arrData[$rTMP["id"]]["ctg_pac_medico_descrip1"]         = $rTMP["ctg_pac_medico_descrip1"];
    $arrData[$rTMP["id"]]["ctg_pac_medico_espe1"]         = $rTMP["ctg_pac_medico_espe1"];

    $arrData[$rTMP["id"]]["ctg_pac_medico_code2"]         = $rTMP["ctg_pac_medico_code2"];
    $arrData[$rTMP["id"]]["ctg_pac_medico_descrip2"]         = $rTMP["ctg_pac_medico_descrip2"];
    $arrData[$rTMP["id"]]["ctg_pac_medico_espe2"]         = $rTMP["ctg_pac_medico_espe2"];

    $arrData[$rTMP["id"]]["ctg_pac_medico_code3"]         = $rTMP["ctg_pac_medico_code3"];
    $arrData[$rTMP["id"]]["ctg_pac_medico_descrip3"]         = $rTMP["ctg_pac_medico_descrip3"];
    $arrData[$rTMP["id"]]["ctg_pac_medico_espe3"]         = $rTMP["ctg_pac_medico_espe3"];

    $arrData[$rTMP["id"]]["ctg_pac_medico_code4"]         = $rTMP["ctg_pac_medico_code4"];
    $arrData[$rTMP["id"]]["ctg_pac_medico_descrip4"]         = $rTMP["ctg_pac_medico_descrip4"];
    $arrData[$rTMP["id"]]["ctg_pac_medico_espe4"]         = $rTMP["ctg_pac_medico_espe4"];

    $arrData[$rTMP["id"]]["ctg_pac_medico_code5"]         = $rTMP["ctg_pac_medico_code5"];
    $arrData[$rTMP["id"]]["ctg_pac_medico_descrip5"]         = $rTMP["ctg_pac_medico_descrip5"];
    $arrData[$rTMP["id"]]["ctg_pac_medico_espe5"]         = $rTMP["ctg_pac_medico_espe5"];

    $arrData[$rTMP["id"]]["ctg_pac_medico_code6"]         = $rTMP["ctg_pac_medico_code6"];
    $arrData[$rTMP["id"]]["ctg_pac_medico_descrip6"]         = $rTMP["ctg_pac_medico_descrip6"];
    $arrData[$rTMP["id"]]["ctg_pac_medico_espe6"]         = $rTMP["ctg_pac_medico_espe6"];

    $arrData[$rTMP["id"]]["ctg_pac_medico_code7"]         = $rTMP["ctg_pac_medico_code7"];
    $arrData[$rTMP["id"]]["ctg_pac_medico_descrip7"]         = $rTMP["ctg_pac_medico_descrip7"];
    $arrData[$rTMP["id"]]["ctg_pac_medico_espe7"]         = $rTMP["ctg_pac_medico_espe7"];

    $arrData[$rTMP["id"]]["ctg_pac_medico_code8"]         = $rTMP["ctg_pac_medico_code8"];
    $arrData[$rTMP["id"]]["ctg_pac_medico_descrip8"]         = $rTMP["ctg_pac_medico_descrip8"];
    $arrData[$rTMP["id"]]["ctg_pac_medico_espe8"]         = $rTMP["ctg_pac_medico_espe8"];

    $arrData[$rTMP["id"]]["ctg_pac_medico_code9"]         = $rTMP["ctg_pac_medico_code9"];
    $arrData[$rTMP["id"]]["ctg_pac_medico_descrip9"]         = $rTMP["ctg_pac_medico_descrip9"];
    $arrData[$rTMP["id"]]["ctg_pac_medico_espe9"]         = $rTMP["ctg_pac_medico_espe9"];
}
pg_free_result($sql);
?>

<?php
if (is_array($arrData) && (count($arrData) > 0)) {
    reset($arrData);
    foreach ($arrData as $rTMP['key'] => $rTMP['value']) {

        $cod_id =  $rTMP["value"]['id'];

        $ctg_pac_medico_cabe_code = $rTMP["value"]['ctg_pac_medico_cabe_code'];
        $ctg_pac_medico_cabe_descrip = $rTMP["value"]['ctg_pac_medico_cabe_descrip'];
        $ctg_pac_medico_cabe_espe = $rTMP["value"]['ctg_pac_medico_cabe_espe'];

        $ctg_pac_medico_code1 = $rTMP["value"]['ctg_pac_medico_code1'];
        $ctg_pac_medico_descrip1 = $rTMP["value"]['ctg_pac_medico_descrip1'];
        $ctg_pac_medico_espe1 = $rTMP["value"]['ctg_pac_medico_espe1'];

        $ctg_pac_medico_code2 = $rTMP["value"]['ctg_pac_medico_code2'];
        $ctg_pac_medico_descrip2 = $rTMP["value"]['ctg_pac_medico_descrip2'];
        $ctg_pac_medico_espe2 = $rTMP["value"]['ctg_pac_medico_espe2'];

        $ctg_pac_medico_code3 = $rTMP["value"]['ctg_pac_medico_code3'];
        $ctg_pac_medico_descrip3 = $rTMP["value"]['ctg_pac_medico_descrip3'];
        $ctg_pac_medico_espe3 = $rTMP["value"]['ctg_pac_medico_espe3'];

        $ctg_pac_medico_code4 = $rTMP["value"]['ctg_pac_medico_code4'];
        $ctg_pac_medico_descrip4 = $rTMP["value"]['ctg_pac_medico_descrip4'];
        $ctg_pac_medico_espe4 = $rTMP["value"]['ctg_pac_medico_espe4'];

        $ctg_pac_medico_code5 = $rTMP["value"]['ctg_pac_medico_code5'];
        $ctg_pac_medico_descrip5 = $rTMP["value"]['ctg_pac_medico_descrip5'];
        $ctg_pac_medico_espe5 = $rTMP["value"]['ctg_pac_medico_espe5'];

        $ctg_pac_medico_code6 = $rTMP["value"]['ctg_pac_medico_code6'];
        $ctg_pac_medico_descrip6 = $rTMP["value"]['ctg_pac_medico_descrip6'];
        $ctg_pac_medico_espe6 = $rTMP["value"]['ctg_pac_medico_espe6'];

        $ctg_pac_medico_code7 = $rTMP["value"]['ctg_pac_medico_code7'];
        $ctg_pac_medico_descrip7 = $rTMP["value"]['ctg_pac_medico_descrip7'];
        $ctg_pac_medico_espe7 = $rTMP["value"]['ctg_pac_medico_espe7'];

        $ctg_pac_medico_code8 = $rTMP["value"]['ctg_pac_medico_code8'];
        $ctg_pac_medico_descrip8 = $rTMP["value"]['ctg_pac_medico_descrip8'];
        $ctg_pac_medico_espe8 = $rTMP["value"]['ctg_pac_medico_espe8'];

        $ctg_pac_medico_code9 = $rTMP["value"]['ctg_pac_medico_code9'];
        $ctg_pac_medico_descrip9 = $rTMP["value"]['ctg_pac_medico_descrip9'];
        $ctg_pac_medico_espe9 = $rTMP["value"]['ctg_pac_medico_espe9'];
    }
}

$arrDataEspecialidad = array();
$var_consulta = "SELECT * FROM ctg_especialidades ";
$sql = pg_query($rmfAdm, $var_consulta);
$totalArticle = pg_num_rows($sql);


while ($rTMP = pg_fetch_assoc($sql)) {

    $arrDataEspecialidad[$rTMP["id"]]["id"]                  = $rTMP["id"];
    $arrDataEspecialidad[$rTMP["id"]]["ctg_esp_cod"]         = $rTMP["ctg_esp_cod"];
    $arrDataEspecialidad[$rTMP["id"]]["ctg_esp_desc"]        = $rTMP["ctg_esp_desc"];
}
pg_free_result($sql);
?>


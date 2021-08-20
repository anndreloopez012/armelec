<?php
if (isset($_GET["validaciones"]) && !empty($_GET["validaciones"])) {
    require_once "../../data/conexion/tmfAdm.php";
    $usuario = $_SESSION['adm_usr_code'];

    $ctg_ase_code1 = isset($_POST["nombre1"]) ? $_POST["nombre1"]  : 0;
    $ctg_ase_code2 = isset($_POST["nombre2"]) ? $_POST["nombre2"]  : 0;
    $ctg_ase_code3 = isset($_POST["nombre3"]) ? $_POST["nombre3"]  : 0;
    $ctg_ase_code4 = isset($_POST["nombre4"]) ? $_POST["nombre4"]  : 0;
    $ctg_ase_code5 = isset($_POST["nombre5"]) ? $_POST["nombre5"]  : 0;

    $status = 1;
    $fechaIng = date('Y-m-d H:i:s');

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

        $var_consulta = " UPDATE ctg_pacientes SET ctg_ase_code1 = $ctg_ase_code1,ctg_ase_code2 = $ctg_ase_code2,ctg_ase_code3 = $ctg_ase_code3,ctg_ase_code4 = $ctg_ase_code4,ctg_ase_code5= $ctg_ase_code5,ctg_pac_dt = '$fechaIng',ctg_pac_usr = '$usuario' WHERE ctg_pac_code = $cod_id";
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
            $strFilter = " AND ( UPPER(pro.ctg_ase_nomcom) LIKE '%{$strSearch}%' ) ";
        }

        $arrTableMed = array();
        $var_consulta = "SELECT *
                        FROM ctg_aseguradoras 
                        ORDER BY ctg_ase_nomcom
                        LIMIT 1000";
        $sql = pg_query($rmfAdm, $var_consulta);
        $totalArticle = pg_num_rows($sql);


        while ($rTMP = pg_fetch_assoc($sql)) {

            $arrTableMed[$rTMP["id"]]["id"]                       = $rTMP["id"];
            $arrTableMed[$rTMP["id"]]["ctg_ase_contrato"]                       = $rTMP["ctg_ase_contrato"];
            $arrTableMed[$rTMP["id"]]["ctg_ase_nit"]                       = $rTMP["ctg_ase_nit"];
            $arrTableMed[$rTMP["id"]]["ctg_ase_nomcom"]                       = $rTMP["ctg_ase_nomcom"];
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
                                <td><?php echo  $rTMP["value"]['ctg_ase_nomcom']; ?></td>
                            </tr>

                            <input type="hidden" name="hidId_<?php print $intContador; ?>" id="hidId_<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['id']; ?>">
                            <input type="hidden" name="hidNombre_<?php print $intContador; ?>" id="hidNombre_<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['ctg_ase_nomcom']; ?>">
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
            $strFilter = " AND ( UPPER(pro.ctg_ase_nomcom) LIKE '%{$strSearch}%' ) ";
        }

        $arrTableMed = array();
        $var_consulta = "SELECT *
                        FROM ctg_aseguradoras 
                        ORDER BY ctg_ase_nomcom
                        LIMIT 1000";
        $sql = pg_query($rmfAdm, $var_consulta);
        $totalArticle = pg_num_rows($sql);


        while ($rTMP = pg_fetch_assoc($sql)) {

            $arrTableMed[$rTMP["id"]]["id"]                       = $rTMP["id"];
            $arrTableMed[$rTMP["id"]]["ctg_ase_contrato"]                       = $rTMP["ctg_ase_contrato"];
            $arrTableMed[$rTMP["id"]]["ctg_ase_nit"]                       = $rTMP["ctg_ase_nit"];
            $arrTableMed[$rTMP["id"]]["ctg_ase_nomcom"]                       = $rTMP["ctg_ase_nomcom"];
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
                                <td><?php echo  $rTMP["value"]['ctg_ase_nomcom']; ?></td>
                            </tr>

                            <input type="hidden" name="hidId_<?php print $intContador; ?>" id="hidId_<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['id']; ?>">
                            <input type="hidden" name="hidNombre_<?php print $intContador; ?>" id="hidNombre_<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['ctg_ase_nomcom']; ?>">
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
            $strFilter = " AND ( UPPER(pro.ctg_ase_nomcom) LIKE '%{$strSearch}%' ) ";
        }

        $arrTableMed = array();
        $var_consulta = "SELECT *
                        FROM ctg_aseguradoras 
                        ORDER BY ctg_ase_nomcom
                        LIMIT 1000";
        $sql = pg_query($rmfAdm, $var_consulta);
        $totalArticle = pg_num_rows($sql);


        while ($rTMP = pg_fetch_assoc($sql)) {

            $arrTableMed[$rTMP["id"]]["id"]                       = $rTMP["id"];
            $arrTableMed[$rTMP["id"]]["ctg_ase_contrato"]                       = $rTMP["ctg_ase_contrato"];
            $arrTableMed[$rTMP["id"]]["ctg_ase_nit"]                       = $rTMP["ctg_ase_nit"];
            $arrTableMed[$rTMP["id"]]["ctg_ase_nomcom"]                       = $rTMP["ctg_ase_nomcom"];
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
                                <td><?php echo  $rTMP["value"]['ctg_ase_nomcom']; ?></td>
                            </tr>

                            <input type="hidden" name="hidId_<?php print $intContador; ?>" id="hidId_<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['id']; ?>">
                            <input type="hidden" name="hidNombre_<?php print $intContador; ?>" id="hidNombre_<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['ctg_ase_nomcom']; ?>">
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
            $strFilter = " AND ( UPPER(pro.ctg_ase_nomcom) LIKE '%{$strSearch}%' ) ";
        }

        $arrTableMed = array();
        $var_consulta = "SELECT *
                        FROM ctg_aseguradoras 
                        ORDER BY ctg_ase_nomcom
                        LIMIT 1000";
        $sql = pg_query($rmfAdm, $var_consulta);
        $totalArticle = pg_num_rows($sql);


        while ($rTMP = pg_fetch_assoc($sql)) {

            $arrTableMed[$rTMP["id"]]["id"]                       = $rTMP["id"];
            $arrTableMed[$rTMP["id"]]["ctg_ase_contrato"]                       = $rTMP["ctg_ase_contrato"];
            $arrTableMed[$rTMP["id"]]["ctg_ase_nit"]                       = $rTMP["ctg_ase_nit"];
            $arrTableMed[$rTMP["id"]]["ctg_ase_nomcom"]                       = $rTMP["ctg_ase_nomcom"];
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
                                <td><?php echo  $rTMP["value"]['ctg_ase_nomcom']; ?></td>
                            </tr>

                            <input type="hidden" name="hidId_<?php print $intContador; ?>" id="hidId_<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['id']; ?>">
                            <input type="hidden" name="hidNombre_<?php print $intContador; ?>" id="hidNombre_<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['ctg_ase_nomcom']; ?>">
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
            $strFilter = " AND ( UPPER(pro.ctg_ase_nomcom) LIKE '%{$strSearch}%' ) ";
        }

        $arrTableMed = array();
        $var_consulta = "SELECT *
                        FROM ctg_aseguradoras 
                        ORDER BY ctg_ase_nomcom
                        LIMIT 1000";
        $sql = pg_query($rmfAdm, $var_consulta);
        $totalArticle = pg_num_rows($sql);


        while ($rTMP = pg_fetch_assoc($sql)) {

            $arrTableMed[$rTMP["id"]]["id"]                       = $rTMP["id"];
            $arrTableMed[$rTMP["id"]]["ctg_ase_contrato"]                       = $rTMP["ctg_ase_contrato"];
            $arrTableMed[$rTMP["id"]]["ctg_ase_nit"]                       = $rTMP["ctg_ase_nit"];
            $arrTableMed[$rTMP["id"]]["ctg_ase_nomcom"]                       = $rTMP["ctg_ase_nomcom"];
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
                                <td><?php echo  $rTMP["value"]['ctg_ase_nomcom']; ?></td>
                            </tr>

                            <input type="hidden" name="hidId_<?php print $intContador; ?>" id="hidId_<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['id']; ?>">
                            <input type="hidden" name="hidNombre_<?php print $intContador; ?>" id="hidNombre_<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['ctg_ase_nomcom']; ?>">
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

//codigo para url de update
$cod_id = $_GET['cod'];
$cod_id =  decrypt($cod_id, $key);
$cod_id = isset($cod_id) ? $cod_id  : '';

require_once "../../data/conexion/tmfAdm.php";
if($cod_id){

}
$arrData = array();
$var_consulta = "SELECT * 
                    FROM ctg_pacientes 
                    WHERE ctg_pac_code = '$cod_id'
                    LIMIT 1";
$sql = pg_query($rmfAdm, $var_consulta);
$totalArticle = pg_num_rows($sql);


while ($rTMP = pg_fetch_assoc($sql)) {

    $arrData[$rTMP["id"]]["id"]                                         = $rTMP["id"];
    $arrData[$rTMP["id"]]["ctg_ase_code1"]                              = $rTMP["ctg_ase_code1"];
    $arrData[$rTMP["id"]]["ctg_ase_code2"]                              = $rTMP["ctg_ase_code2"];
    $arrData[$rTMP["id"]]["ctg_ase_code3"]                              = $rTMP["ctg_ase_code3"];
    $arrData[$rTMP["id"]]["ctg_ase_code4"]                              = $rTMP["ctg_ase_code4"];
    $arrData[$rTMP["id"]]["ctg_ase_code5"]                              = $rTMP["ctg_ase_code5"];

}
pg_free_result($sql);
?>

<?php
if (is_array($arrData) && (count($arrData) > 0)) {
    reset($arrData);
    foreach ($arrData as $rTMP['key'] => $rTMP['value']) {

        $num_ctg_ase_code1 = isset($rTMP["value"]['ctg_ase_code1']) ? $rTMP["value"]['ctg_ase_code1']:0;
        $num_ctg_ase_code2 = isset($rTMP["value"]['ctg_ase_code2']) ? $rTMP["value"]['ctg_ase_code2']:0;
        $num_ctg_ase_code3 = isset($rTMP["value"]['ctg_ase_code3']) ? $rTMP["value"]['ctg_ase_code3']:0;
        $num_ctg_ase_code4 = isset($rTMP["value"]['ctg_ase_code4']) ? $rTMP["value"]['ctg_ase_code4']:0;
        $num_ctg_ase_code5 = isset($rTMP["value"]['ctg_ase_code5']) ? $rTMP["value"]['ctg_ase_code5']:0;
     
    }
}

$arrDataInsur1 = array();
$var_consulta = "SELECT * 
                    FROM ctg_aseguradoras 
                    WHERE id = '$num_ctg_ase_code1'
                    LIMIT 1";
$sql = pg_query($rmfAdm, $var_consulta);
$totalArticle = pg_num_rows($sql);


while ($rTMP = pg_fetch_assoc($sql)) {

    $arrDataInsur1[$rTMP["id"]]["id"]                                         = $rTMP["id"];
    $arrDataInsur1[$rTMP["id"]]["ctg_ase_nomcom"]                             = $rTMP["ctg_ase_nomcom"];

}
pg_free_result($sql);
?>

<?php
if (is_array($arrDataInsur1) && (count($arrDataInsur1) > 0)) {
    reset($arrDataInsur1);
    foreach ($arrDataInsur1 as $rTMP['key'] => $rTMP['value']) {

        $id_insur_one = isset($rTMP["value"]['id']) ? $rTMP["value"]['id']:"";
        $ctg_ase_code1 = isset($rTMP["value"]['ctg_ase_nomcom']) ? $rTMP["value"]['ctg_ase_nomcom']:"";
     
    }
}

$arrDataInsur2 = array();
$var_consulta = "SELECT * 
                    FROM ctg_aseguradoras 
                    WHERE id = '$num_ctg_ase_code2'
                    LIMIT 1";
$sql = pg_query($rmfAdm, $var_consulta);
$totalArticle = pg_num_rows($sql);


while ($rTMP = pg_fetch_assoc($sql)) {

    $arrDataInsur2[$rTMP["id"]]["id"]                                         = $rTMP["id"];
    $arrDataInsur2[$rTMP["id"]]["ctg_ase_nomcom"]                             = $rTMP["ctg_ase_nomcom"];

}
pg_free_result($sql);
?>

<?php
if (is_array($arrDataInsur2) && (count($arrDataInsur2) > 0)) {
    reset($arrDataInsur2);
    foreach ($arrDataInsur2 as $rTMP['key'] => $rTMP['value']) {

        $id_insur_two = isset($rTMP["value"]['id']) ? $rTMP["value"]['id']:"";
        $ctg_ase_code2 = isset($rTMP["value"]['ctg_ase_nomcom']) ? $rTMP["value"]['ctg_ase_nomcom']:"";
     
    }
}

$arrDataInsur3 = array();
$var_consulta = "SELECT * 
                    FROM ctg_aseguradoras 
                    WHERE id = '$num_ctg_ase_code3'
                    LIMIT 1";
$sql = pg_query($rmfAdm, $var_consulta);
$totalArticle = pg_num_rows($sql);


while ($rTMP = pg_fetch_assoc($sql)) {

    $arrDataInsur3[$rTMP["id"]]["id"]                                         = $rTMP["id"];
    $arrDataInsur3[$rTMP["id"]]["ctg_ase_nomcom"]                             = $rTMP["ctg_ase_nomcom"];

}
pg_free_result($sql);
?>

<?php
if (is_array($arrDataInsur3) && (count($arrDataInsur3) > 0)) {
    reset($arrDataInsur3);
    foreach ($arrDataInsur3 as $rTMP['key'] => $rTMP['value']) {

        $id_insur_thre = isset($rTMP["value"]['id']) ? $rTMP["value"]['id']:"";
        $ctg_ase_code3 = isset($rTMP["value"]['ctg_ase_nomcom']) ? $rTMP["value"]['ctg_ase_nomcom']:"";
     
    }
}

$arrDataInsur4 = array();
$var_consulta = "SELECT * 
                    FROM ctg_aseguradoras 
                    WHERE id = '$num_ctg_ase_code4'
                    LIMIT 1";
$sql = pg_query($rmfAdm, $var_consulta);
$totalArticle = pg_num_rows($sql);


while ($rTMP = pg_fetch_assoc($sql)) {

    $arrDataInsur4[$rTMP["id"]]["id"]                                         = $rTMP["id"];
    $arrDataInsur4[$rTMP["id"]]["ctg_ase_nomcom"]                             = $rTMP["ctg_ase_nomcom"];

}
pg_free_result($sql);
?>

<?php
if (is_array($arrDataInsur4) && (count($arrDataInsur4) > 0)) {
    reset($arrDataInsur4);
    foreach ($arrDataInsur4 as $rTMP['key'] => $rTMP['value']) {

        $id_insur_four = isset($rTMP["value"]['id']) ? $rTMP["value"]['id']:"";
        $ctg_ase_code4 = isset($rTMP["value"]['ctg_ase_nomcom']) ? $rTMP["value"]['ctg_ase_nomcom']:"";
     
    }
}

$arrDataInsur5 = array();
$var_consulta = "SELECT * 
                    FROM ctg_aseguradoras 
                    WHERE id = '$num_ctg_ase_code5'
                    LIMIT 1";
$sql = pg_query($rmfAdm, $var_consulta);
$totalArticle = pg_num_rows($sql);


while ($rTMP = pg_fetch_assoc($sql)) {

    $arrDataInsur5[$rTMP["id"]]["id"]                                         = $rTMP["id"];
    $arrDataInsur5[$rTMP["id"]]["ctg_ase_nomcom"]                             = $rTMP["ctg_ase_nomcom"];

}
pg_free_result($sql);
?>

<?php
if (is_array($arrDataInsur5) && (count($arrDataInsur5) > 0)) {
    reset($arrDataInsur5);
    foreach ($arrDataInsur5 as $rTMP['key'] => $rTMP['value']) {

        $id_insur_five = isset($rTMP["value"]['id']) ? $rTMP["value"]['id']:"";
        $ctg_ase_code5 = isset($rTMP["value"]['ctg_ase_nomcom']) ? $rTMP["value"]['ctg_ase_nomcom']:"";
     
    }
}
?>
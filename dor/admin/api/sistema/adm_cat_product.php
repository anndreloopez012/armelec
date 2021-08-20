<?php
//GLOBAL variableId
require_once '../../api/var_global.php';

// VALIDATION INSERT UPDATE DELETE
if (isset($_GET["validaciones"]) && !empty($_GET["validaciones"])) {

    require_once '../../../data/conexion/tmfAdm.php';
    require_once '../../../data/conexion/tmfLab.php';

    $ctg_pro_usr = $_SESSION['adm_usr_code'];
    $ctg_pro_cod = isset($_POST["ctg_pro_cod"]) ? $_POST["ctg_pro_cod"]  : '';
    $ctg_pro_desc = isset($_POST["ctg_pro_desc"]) ? $_POST["ctg_pro_desc"]  : '';
    $ctg_pro_labfar = isset($_POST["ctg_pro_labfar"]) ? $_POST["ctg_pro_labfar"]  : '';
    $ctg_pro_labfar_name = isset($_POST["ctg_pro_labfar_name"]) ? $_POST["ctg_pro_labfar_name"]  : '';
    $ctg_pro_fecaut = isset($_POST["ctg_pro_fecaut"]) ? $_POST["ctg_pro_fecaut"]  : '';
    $ctg_pro_fecven = isset($_POST["ctg_pro_fecven"]) ? $_POST["ctg_pro_fecven"]  : '';
    $ctg_pro_psinar = isset($_POST["ctg_pro_psinar"]) ? $_POST["ctg_pro_psinar"]  : '';
    $ctg_pro_prinact = isset($_POST["ctg_pro_prinact"]) ? $_POST["ctg_pro_prinact"]  : '';
    $ctg_pro_indi = isset($_POST["ctg_pro_indi"]) ? $_POST["ctg_pro_indi"]  : '';
    $ctg_pro_sta = '1';
    $ctg_pro_dt = date("Y-m-d");
    $strTipoValidacion = isset($_REQUEST["validaciones"]) ? $_REQUEST["validaciones"] : '';
    if ($strTipoValidacion == "proces") {

        header('Content-Type: application/json');
        $val = 1;
        $var_consulta = "INSERT INTO ctg_productos(ctg_pro_cod,ctg_pro_desc,ctg_pro_prinact,ctg_pro_indi,ctg_pro_labfar,ctg_pro_fecaut,ctg_pro_fecven,ctg_pro_psinar,ctg_pro_sta,ctg_pro_dt,ctg_pro_usr) VALUES ('$ctg_pro_cod','$ctg_pro_desc','$ctg_pro_prinact','$ctg_pro_indi','$ctg_pro_labfar','$ctg_pro_fecaut','$ctg_pro_fecven','$ctg_pro_psinar','$ctg_pro_sta','$ctg_pro_dt','$ctg_pro_usr');";
        if (pg_query($rmfAdm, $var_consulta)) {
            $arrInfo['status'] = $val;
        } else {
            $arrInfo['status'] = 0;
            $arrInfo['error'] = $var_consulta;
        }
        // print_r($var_consulta);
        print json_encode($arrInfo);

        die();
    } else if ($strTipoValidacion == "edit") {
        $val = 1;
        $var_consulta = "UPDATE ctg_productos SET ctg_pro_desc = '$ctg_pro_desc', ctg_pro_prinact = '$ctg_pro_prinact', ctg_pro_indi = '$ctg_pro_indi', ctg_pro_labfar = '$ctg_pro_labfar', ctg_pro_fecaut = '$ctg_pro_fecaut', ctg_pro_fecven = '$ctg_pro_fecven', ctg_pro_psinar = '$ctg_pro_psinar' WHERE ctg_pro_cod = '$ctg_pro_cod'";
        if (pg_query($rmfAdm, $var_consulta)) {
            $arrInfo['status'] = $val;
        } else {
            $arrInfo['status'] = 0;
            $arrInfo['error'] = $var_consulta;
        }
        //print_r($codeId);
        print json_encode($arrInfo);

        die();
    } else if ($strTipoValidacion == "delete") {
        $val = 1;
        $var_consulta = "DELETE FROM ctg_productos WHERE ctg_pro_cod = '$ctg_pro_cod'";
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
            $strFilter = " WHERE ( UPPER(ctg_pro_cod) LIKE UPPER('%{$strSearch}%') OR UPPER(ctg_pro_desc) LIKE UPPER('%{$strSearch}%') ) ";
        }

        $arrUsuarios = array();
        $var_consulta = "SELECT * 
        FROM ctg_productos
        $strFilter
        ORDER BY ctg_pro_desc ASC LIMIT 100";

        $qTMP = pg_query($rmfAdm, $var_consulta);
        //echo $var_consulta;
        while ($rTMP = pg_fetch_assoc($qTMP)) {

            $arrUsuarios[$rTMP["id"]]["id"]                          = $rTMP["id"];
            $arrUsuarios[$rTMP["id"]]["ctg_pro_cod"]            = $rTMP["ctg_pro_cod"];
            $arrUsuarios[$rTMP["id"]]["ctg_pro_desc"]              = $rTMP["ctg_pro_desc"];
            $arrUsuarios[$rTMP["id"]]["ctg_pro_prinact"]            = $rTMP["ctg_pro_prinact"];
            $arrUsuarios[$rTMP["id"]]["ctg_pro_indi"]            = $rTMP["ctg_pro_indi"];
            $arrUsuarios[$rTMP["id"]]["ctg_pro_labfar"]            = $rTMP["ctg_pro_labfar"];
            $arrUsuarios[$rTMP["id"]]["ctg_pro_fecaut"]            = $rTMP["ctg_pro_fecaut"];
            $arrUsuarios[$rTMP["id"]]["ctg_pro_fecven"]            = $rTMP["ctg_pro_fecven"];
            $arrUsuarios[$rTMP["id"]]["ctg_pro_psinar"]            = $rTMP["ctg_pro_psinar"];
            $arrUsuarios[$rTMP["id"]]["ctg_pro_emp"]            = $rTMP["ctg_pro_emp"];
        }
        pg_free_result($qTMP);

?>
        <div class="col-md-12 tableFixHead">
            <table id="tableData" class="table table-bordered table-striped table-hover table-sm">
                <thead>
                    <tr class="table-info">
                        <th>Codigo</th>
                        <th>Descripcion</th>
                        <th>Empaque</th>
                        <th>Principio Activo</th>
                        <th>Indicaciones</th>
                        <th>Laboratorio</th>
                        <th>psinar</th>
                        <th>Fecha de Autorizacion</th>
                        <th>Fecha de Vencimiento</th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (is_array($arrUsuarios) && (count($arrUsuarios) > 0)) {
                        $intContador = 1;
                        reset($arrUsuarios);
                        foreach ($arrUsuarios as $rTMP['key'] => $rTMP['value']) {
                            $ctg_pro_fecaut = date('d-m-Y', strtotime($rTMP["value"]['ctg_pro_fecaut']));
                            $ctg_pro_fecven = date('d-m-Y', strtotime($rTMP["value"]['ctg_pro_fecven']));
                    ?>
                            <tr>
                                <td width='5%'><?php echo  $rTMP["value"]['ctg_pro_cod']; ?></td>
                                <td width='20%'><?php echo  $rTMP["value"]['ctg_pro_desc']; ?></td>
                                <td width='10%'><?php echo  $rTMP["value"]['ctg_pro_emp']; ?></td>
                                <td width='10%'><?php echo  $rTMP["value"]['ctg_pro_prinact']; ?> input de seleccion</td>
                                <td width='1%'><a class="btn btn-outline-info" data-toggle="modal" data-target="#indiView"><i class="fad fa-2x fa-eye"></i></a></td>
                                <td width='10%'><?php echo  $rTMP["value"]['ctg_pro_labfar']; ?> input de seleccion</td>
                                <td width='3%'><?php echo  $rTMP["value"]['ctg_pro_psinar']; ?></td>
                                <td width='5%'><?php echo $ctg_pro_fecaut; ?></td>
                                <td width='5%'><?php echo $ctg_pro_fecven; ?></td>
                                <td width='1%' style="cursor:pointer;" onclick="fntSelectEdit('<?php print $intContador; ?>');"><i class="fad fa-2x fa-edit"></i></td>
                                <td width='1%' style="cursor:pointer;" onclick="fntSelectDelete('<?php print $intContador; ?>');"><i class="fad fa-2x fa-trash-alt"></i></td>
                            </tr>
                            <input type="hidden" name="hid_id<?php print $intContador; ?>" id="hid_id<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['ctg_con_id']; ?>">
                            <input type="hidden" name="hid_ctg_pro_cod<?php print $intContador; ?>" id="hid_ctg_pro_cod<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['ctg_pro_cod']; ?>">
                            <input type="hidden" name="hid_ctg_pro_desc<?php print $intContador; ?>" id="hid_ctg_pro_desc<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['ctg_pro_desc']; ?>">
                            <input type="hidden" name="hid_ctg_pro_prinact<?php print $intContador; ?>" id="hid_ctg_pro_prinact<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['ctg_pro_prinact']; ?>">
                            <input type="hidden" name="hid_ctg_pro_indi<?php print $intContador; ?>" id="hid_ctg_pro_indi<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['ctg_pro_indi']; ?>">
                            <input type="hidden" name="hid_ctg_pro_labfar<?php print $intContador; ?>" id="hid_ctg_pro_labfar<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['ctg_pro_labfar']; ?>">
                            <input type="hidden" name="hid_ctg_pro_psinar<?php print $intContador; ?>" id="hid_ctg_pro_psinar<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['ctg_pro_psinar']; ?>">
                            <input type="hidden" name="hid_ctg_pro_fecaut<?php print $intContador; ?>" id="hid_ctg_pro_fecaut<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['ctg_pro_fecaut']; ?>">
                            <input type="hidden" name="hid_ctg_pro_fecven<?php print $intContador; ?>" id="hid_ctg_pro_fecven<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['ctg_pro_fecven']; ?>">



                            <div class="modal fade bd-example-modal-lg" id="indiView" tabindex="-1" role="dialog" aria-labelledby="indiViewLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="indiViewLabel">Indicaciones</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <textarea class="form-control" id="indi" name="indi" rows="25"><?php echo  $rTMP["value"]['ctg_pro_indi']; ?></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

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
    } else if ($strTipoValidacion == "val_codigo") {
        $val = 1;

        $var_consulta = pg_query($rmfAdm, "SELECT COUNT(ctg_pro_cod) FROM ctg_productos WHERE UPPER(ctg_pro_cod) = UPPER('$ctg_pro_cod') ;");

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
    } else if ($strTipoValidacion == "tabla_prinActiv") {

        $arrPrin = array();
        $var_consulta = "SELECT * 
        FROM ctg_principios
        ORDER BY ctg_principios ASC LIMIT 100";

        $qTMP = pg_query($rmfAdm, $var_consulta);
        //echo $var_consulta;
        while ($rTMP = pg_fetch_assoc($qTMP)) {

            $arrPrin[$rTMP["id"]]["id"]                          = $rTMP["id"];
            $arrPrin[$rTMP["id"]]["ctg_pri_desc"]            = $rTMP["ctg_pri_desc"];
        }
        pg_free_result($qTMP);

    ?>
        <div class="col-md-12 tableFixHead">
            <table id="tableData" class="table table-bordered table-striped table-hover table-sm">
                <thead>
                    <tr class="table-info">
                        <th>Descripcion</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (is_array($arrPrin) && (count($arrPrin) > 0)) {
                        $intContador = 1;
                        reset($arrPrin);
                        foreach ($arrPrin as $rTMP['key'] => $rTMP['value']) {
                    ?>
                            <tr>
                                <td style="cursor:pointer;" onclick="fntSelectPrin('<?php print $intContador; ?>');"><?php echo  $rTMP["value"]['ctg_pri_desc']; ?></td>
                            </tr>
                            <input type="hidden" name="hid_ctg_pri_desc__<?php print $intContador; ?>" id="hid_ctg_pri_desc__<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['ctg_pri_desc']; ?>">

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
    } else if ($strTipoValidacion == "tabla_labo") {

        $arrLab = array();
        $var_consulta = "SELECT * 
        FROM ctg_lab_farmaceuticos
        ORDER BY ctg_laf_nomcom ASC LIMIT 100";

        $qTMP = pg_query($rmfAdm, $var_consulta);
        //echo $var_consulta;
        while ($rTMP = pg_fetch_assoc($qTMP)) {

            $arrLab[$rTMP["id"]]["id"]                          = $rTMP["id"];
            $arrLab[$rTMP["id"]]["ctg_laf_nomcom"]            = $rTMP["ctg_laf_nomcom"];
        }
        pg_free_result($qTMP);

    ?>
        <div class="col-md-12 tableFixHead">
            <table id="tableData" class="table table-bordered table-striped table-hover table-sm">
                <thead>
                    <tr class="table-info">
                        <th>Descripcion</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (is_array($arrLab) && (count($arrLab) > 0)) {
                        $intContador = 1;
                        reset($arrLab);
                        foreach ($arrLab as $rTMP['key'] => $rTMP['value']) {

                    ?>
                            <tr>
                                <td  style="cursor:pointer;" onclick="fntSelectLab('<?php print $intContador; ?>');"><?php echo  $rTMP["value"]['ctg_laf_nomcom']; ?></td>
                            </tr>
                            <input type="hidden" name="hid_ctg_laf_nomcom__<?php print $intContador; ?>" id="hid_ctg_laf_nomcom__<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['ctg_laf_nomcom']; ?>">

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
    }
    die();
}

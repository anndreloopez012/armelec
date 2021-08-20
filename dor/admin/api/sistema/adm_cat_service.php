<?php
//GLOBAL variableId
require_once '../../api/var_global.php';

// VALIDATION INSERT UPDATE DELETE
if (isset($_GET["validaciones"]) && !empty($_GET["validaciones"])) {

    require_once '../../../data/conexion/tmfAdm.php';
    require_once '../../../data/conexion/tmfLab.php';

    $ctg_ser_usr = $_SESSION['adm_usr_code'];
    $ctg_ser_code = isset($_POST["ctg_ser_code"]) ? $_POST["ctg_ser_code"]  : '';
    $ctg_ser_descrip = isset($_POST["ctg_ser_descrip"]) ? $_POST["ctg_ser_descrip"]  : '';
    $ctg_ser_obs = isset($_POST["ctg_ser_obs"]) ? $_POST["ctg_ser_obs"]  : '';  
    $ctg_ser_sta = '1';
    $ctg_ser_dt = date("Y-m-d");
    $strTipoValidacion = isset($_REQUEST["validaciones"]) ? $_REQUEST["validaciones"] : '';
    if ($strTipoValidacion == "proces") {

        header('Content-Type: application/json');
        $val = 1;
        $var_consulta = "INSERT INTO ctg_servicios(ctg_ser_code,ctg_ser_descrip,ctg_ser_obs,ctg_ser_sta,ctg_ser_dt,ctg_ser_usr) VALUES ('$ctg_ser_code','$ctg_ser_descrip','$ctg_ser_obs','$ctg_ser_sta','$ctg_ser_dt','$ctg_ser_usr');";
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
        $var_consulta = "UPDATE ctg_servicios SET ctg_ser_descrip = '$ctg_ser_descrip', ctg_ser_obs = '$ctg_ser_obs' WHERE ctg_ser_code = '$ctg_ser_code'";
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
        $var_consulta = "DELETE FROM ctg_servicios WHERE ctg_ser_code = '$ctg_ser_code'";
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
            $strFilter = " WHERE ( UPPER(ctg_ser_code) LIKE UPPER('%{$strSearch}%') OR UPPER(ctg_ser_descrip) LIKE UPPER('%{$strSearch}%') ) ";
        }

        $arrUsuarios = array();
        $var_consulta = "SELECT * 
        FROM ctg_servicios
        $strFilter
        ORDER BY ctg_ser_descrip ASC LIMIT 100";

        $qTMP = pg_query($rmfAdm, $var_consulta);
        //echo $var_consulta;
        while ($rTMP = pg_fetch_assoc($qTMP)) {

            $arrUsuarios[$rTMP["id"]]["id"]                          = $rTMP["id"];
            $arrUsuarios[$rTMP["id"]]["ctg_ser_code"]            = $rTMP["ctg_ser_code"];
            $arrUsuarios[$rTMP["id"]]["ctg_ser_descrip"]              = $rTMP["ctg_ser_descrip"];
            $arrUsuarios[$rTMP["id"]]["ctg_ser_obs"]              = $rTMP["ctg_ser_obs"];
        }
        pg_free_result($qTMP);

?>
        <div class="col-md-12 tableFixHead">
            <table id="tableData" class="table table-bordered table-striped table-hover table-sm">
                <thead>
                    <tr class="table-info">
                        <th>Codigo</th>
                        <th>Descripcion</th>
                        <th>Observacion</th>
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
                  
                    ?>
                            <tr>
                                <td width='5%'><?php echo  $rTMP["value"]['ctg_ser_code']; ?></td>
                                <td width='40%'><?php echo  $rTMP["value"]['ctg_ser_descrip']; ?></td>
                                <td width='50%'><textarea cols="75" rows="1" disabled><?php echo  $rTMP["value"]['ctg_ser_obs']; ?></textarea></td>
                                <td width='1%' style="cursor:pointer;" onclick="fntSelectEdit('<?php print $intContador; ?>');"><i class="fad fa-2x fa-edit"></i></td>
                                <td width='1%' style="cursor:pointer;" onclick="fntSelectDelete('<?php print $intContador; ?>');"><i class="fad fa-2x fa-trash-alt"></i></td>
                            </tr>
                            <input type="hidden" name="hid_ctg_ser_code<?php print $intContador; ?>" id="hid_ctg_ser_code<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['ctg_ser_code']; ?>">
                            <input type="hidden" name="hid_ctg_ser_descrip<?php print $intContador; ?>" id="hid_ctg_ser_descrip<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['ctg_ser_descrip']; ?>">
                            <input type="hidden" name="hid_ctg_ser_obs<?php print $intContador; ?>" id="hid_ctg_ser_obs<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['ctg_ser_obs']; ?>">
                           
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

        $var_consulta = pg_query($rmfAdm, "SELECT COUNT(ctg_ser_code) FROM ctg_servicios WHERE UPPER(ctg_ser_code) = UPPER('$ctg_ser_code') ;");

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
    }
    die();
}

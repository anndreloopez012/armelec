<?php
//GLOBAL variableId
require_once '../../api/var_global.php';

// VALIDATION INSERT UPDATE DELETE
if (isset($_GET["validaciones"]) && !empty($_GET["validaciones"])) {

    require_once '../../../data/conexion/tmfAdm.php';
    require_once '../../../data/conexion/tmfLab.php';

    $ctg_exa_usr = $_SESSION['adm_usr_code'];
    $ctg_exa_code = isset($_POST["ctg_exa_code"]) ? $_POST["ctg_exa_code"]  : '';
    $ctg_exa_descrip = isset($_POST["ctg_exa_descrip"]) ? $_POST["ctg_exa_descrip"]  : '';
    $ctg_exa_obs = isset($_POST["ctg_exa_obs"]) ? $_POST["ctg_exa_obs"]  : '';  
    $ctg_exa_sta = '1';
    $ctg_exa_dt = date("Y-m-d");
    $strTipoValidacion = isset($_REQUEST["validaciones"]) ? $_REQUEST["validaciones"] : '';
    if ($strTipoValidacion == "proces") {

        header('Content-Type: application/json');
        $val = 1;
        $var_consulta = "INSERT INTO ctg_examenes(ctg_exa_code,ctg_exa_descrip,ctg_exa_obs,ctg_exa_sta,ctg_exa_dt,ctg_exa_usr) VALUES ('$ctg_exa_code','$ctg_exa_descrip','$ctg_exa_obs','$ctg_exa_sta','$ctg_exa_dt','$ctg_exa_usr');";
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
        $var_consulta = "UPDATE ctg_examenes SET ctg_exa_descrip = '$ctg_exa_descrip', ctg_exa_obs = '$ctg_exa_obs' WHERE ctg_exa_code = '$ctg_exa_code'";
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
        $var_consulta = "DELETE FROM ctg_examenes WHERE ctg_exa_code = '$ctg_exa_code'";
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
            $strFilter = " WHERE ( UPPER(ctg_exa_code) LIKE UPPER('%{$strSearch}%') OR UPPER(ctg_exa_descrip) LIKE UPPER('%{$strSearch}%') ) ";
        }

        $arrUsuarios = array();
        $var_consulta = "SELECT * 
        FROM ctg_examenes
        $strFilter
        ORDER BY ctg_exa_descrip ASC LIMIT 100";

        $qTMP = pg_query($rmfAdm, $var_consulta);
        //echo $var_consulta;
        while ($rTMP = pg_fetch_assoc($qTMP)) {

            $arrUsuarios[$rTMP["id"]]["id"]                          = $rTMP["id"];
            $arrUsuarios[$rTMP["id"]]["ctg_exa_code"]            = $rTMP["ctg_exa_code"];
            $arrUsuarios[$rTMP["id"]]["ctg_exa_descrip"]              = $rTMP["ctg_exa_descrip"];
            $arrUsuarios[$rTMP["id"]]["ctg_exa_obs"]              = $rTMP["ctg_exa_obs"];
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
                                <td width='5%'><?php echo  $rTMP["value"]['ctg_exa_code']; ?></td>
                                <td width='40%'><?php echo  $rTMP["value"]['ctg_exa_descrip']; ?></td>
                                <td width='50%'><textarea cols="75" rows="1" disabled><?php echo  $rTMP["value"]['ctg_exa_obs']; ?></textarea></td>
                                <td width='1%' style="cursor:pointer;" onclick="fntSelectEdit('<?php print $intContador; ?>');"><i class="fad fa-2x fa-edit"></i></td>
                                <td width='1%' style="cursor:pointer;" onclick="fntSelectDelete('<?php print $intContador; ?>');"><i class="fad fa-2x fa-trash-alt"></i></td>
                            </tr>
                            
                            <input type="hidden" name="hid_ctg_exa_code<?php print $intContador; ?>" id="hid_ctg_exa_code<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['ctg_exa_code']; ?>">
                            <input type="hidden" name="hid_ctg_exa_descrip<?php print $intContador; ?>" id="hid_ctg_exa_descrip<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['ctg_exa_descrip']; ?>">
                            <input type="hidden" name="hid_ctg_exa_obs<?php print $intContador; ?>" id="hid_ctg_exa_obs<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['ctg_exa_obs']; ?>">
                           
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

        $var_consulta = pg_query($rmfAdm, "SELECT COUNT(ctg_exa_code) FROM ctg_examenes WHERE UPPER(ctg_exa_code) = UPPER('$ctg_exa_code') ;");

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

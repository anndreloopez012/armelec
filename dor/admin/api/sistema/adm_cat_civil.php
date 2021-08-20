<?php
//GLOBAL variableId
require_once '../../api/var_global.php';

// VALIDATION INSERT UPDATE DELETE
if (isset($_GET["validaciones"]) && !empty($_GET["validaciones"])) {

    require_once '../../../data/conexion/tmfAdm.php';
    require_once '../../../data/conexion/tmfLab.php';

    $ctg_civ_usr = $_SESSION['adm_usr_code'];
    $ctg_civ_cod = isset($_POST["ctg_civ_cod"]) ? $_POST["ctg_civ_cod"]  : '';
    $ctg_civ_desc = isset($_POST["ctg_civ_desc"]) ? $_POST["ctg_civ_desc"]  : '';
    $ctg_civ_sta = '1';
    $ctg_civ_dt = date("Y-m-d");
    $strTipoValidacion = isset($_REQUEST["validaciones"]) ? $_REQUEST["validaciones"] : '';
    if ($strTipoValidacion == "proces") {

        header('Content-Type: application/json');
        $val = 1;
        $var_consulta = "INSERT INTO ctg_civil(ctg_civ_cod,ctg_civ_desc,ctg_civ_sta,ctg_civ_dt,ctg_civ_usr) VALUES ('$ctg_civ_cod','$ctg_civ_desc','$ctg_civ_sta','$ctg_civ_dt','$ctg_civ_usr');";
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
        $var_consulta = "UPDATE ctg_civil SET ctg_civ_desc = '$ctg_civ_desc' WHERE ctg_civ_cod = '$ctg_civ_cod'";
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
        $var_consulta = "DELETE FROM ctg_civil WHERE ctg_civ_cod = '$ctg_civ_cod'";
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
            $strFilter = " WHERE ( UPPER(ctg_civ_cod) LIKE UPPER('%{$strSearch}%') OR UPPER(ctg_civ_desc) LIKE UPPER('%{$strSearch}%') ) ";
        }

        $arrUsuarios = array();
        $var_consulta = "SELECT * 
        FROM ctg_civil
        $strFilter
        ORDER BY ctg_civ_desc ASC LIMIT 100";

        $qTMP = pg_query($rmfAdm, $var_consulta);
        //echo $var_consulta;
        while ($rTMP = pg_fetch_assoc($qTMP)) {

            $arrUsuarios[$rTMP["id"]]["id"]                          = $rTMP["id"];
            $arrUsuarios[$rTMP["id"]]["ctg_civ_cod"]            = $rTMP["ctg_civ_cod"];
            $arrUsuarios[$rTMP["id"]]["ctg_civ_desc"]              = $rTMP["ctg_civ_desc"];
        }
        pg_free_result($qTMP);

?>
        <div class="col-md-12 tableFixHead">
            <table id="tableData" class="table table-bordered table-striped table-hover table-sm">
                <thead>
                    <tr class="table-info">
                        <th>Codigo</th>
                        <th>Descripcion</th>
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
                                <td width='5%'><?php echo  $rTMP["value"]['ctg_civ_cod']; ?></td>
                                <td width='20%'><?php echo  $rTMP["value"]['ctg_civ_desc']; ?></td>
                                <td width='1%' style="cursor:pointer;" onclick="fntSelectEdit('<?php print $intContador; ?>');"><i class="fad fa-2x fa-edit"></i></td>
                                <td width='1%' style="cursor:pointer;" onclick="fntSelectDelete('<?php print $intContador; ?>');"><i class="fad fa-2x fa-trash-alt"></i></td>
                            </tr>
                            
                            <input type="hidden" name="hid_ctg_civ_cod<?php print $intContador; ?>" id="hid_ctg_civ_cod<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['ctg_civ_cod']; ?>">
                            <input type="hidden" name="hid_ctg_civ_desc<?php print $intContador; ?>" id="hid_ctg_civ_desc<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['ctg_civ_desc']; ?>">
                           
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

        $var_consulta = pg_query($rmfAdm, "SELECT COUNT(ctg_civ_cod) FROM ctg_civil WHERE UPPER(ctg_civ_cod) = UPPER('$ctg_civ_cod') ;");

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

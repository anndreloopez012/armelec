<?php
//GLOBAL variableId
require_once '../../api/var_global.php';

// VALIDATION INSERT UPDATE DELETE
if (isset($_GET["validaciones"]) && !empty($_GET["validaciones"])) {

    require_once '../../../data/conexion/tmfAdm.php';
    require_once '../../../data/conexion/tmfLab.php';

    $ctg_pri_usr = $_SESSION['adm_usr_code'];
    $ctg_pri_id = isset($_POST["ctg_pri_id"]) ? $_POST["ctg_pri_id"]  : '';
    $ctg_pri_desc = isset($_POST["ctg_pri_desc"]) ? $_POST["ctg_pri_desc"]  : '';
    $ctg_pri_sta = '1';
    $ctg_pri_dt = date("Y-m-d");
    $strTipoValidacion = isset($_REQUEST["validaciones"]) ? $_REQUEST["validaciones"] : '';
    if ($strTipoValidacion == "proces") {

        header('Content-Type: application/json');
        $val = 1;
        $var_consulta = "INSERT INTO ctg_principios(ctg_pri_id,ctg_pri_desc,ctg_pri_sta,ctg_pri_dt,ctg_pri_usr) VALUES ('$ctg_pri_id','$ctg_pri_desc','$ctg_pri_sta','$ctg_pri_dt','$ctg_pri_usr');";
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
        $var_consulta = "UPDATE ctg_principios SET ctg_pri_desc = '$ctg_pri_desc' WHERE ctg_pri_id = '$ctg_pri_id'";
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
        $var_consulta = "DELETE FROM ctg_principios WHERE ctg_pri_id = '$ctg_pri_id'";
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
            $strFilter = " WHERE ( UPPER(ctg_pri_desc) LIKE UPPER('%{$strSearch}%') ) ";
        }

        $arrUsuarios = array();
        $var_consulta = "SELECT * 
        FROM ctg_principios
        $strFilter
        ORDER BY ctg_pri_desc ASC LIMIT 100";

        $qTMP = pg_query($rmfAdm, $var_consulta);
       // echo $var_consulta;
        while ($rTMP = pg_fetch_assoc($qTMP)) {

            $arrUsuarios[$rTMP["id"]]["id"]                          = $rTMP["id"];
            $arrUsuarios[$rTMP["id"]]["ctg_pri_id"]            = $rTMP["ctg_pri_id"];
            $arrUsuarios[$rTMP["id"]]["ctg_pri_desc"]              = $rTMP["ctg_pri_desc"];
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
                                <td width='5%'><?php echo  $rTMP["value"]['ctg_pri_id']; ?></td>
                                <td width='20%'><?php echo  $rTMP["value"]['ctg_pri_desc']; ?></td>
                                <td width='1%' style="cursor:pointer;" onclick="fntSelectEdit('<?php print $intContador; ?>');"><i class="fad fa-2x fa-edit"></i></td>
                                <td width='1%' style="cursor:pointer;" onclick="fntSelectDelete('<?php print $intContador; ?>');"><i class="fad fa-2x fa-trash-alt"></i></td>
                            </tr>
                            
                            <input type="hidden" name="hid_ctg_pri_id<?php print $intContador; ?>" id="hid_ctg_pri_id<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['ctg_pri_id']; ?>">
                            <input type="hidden" name="hid_ctg_pri_desc<?php print $intContador; ?>" id="hid_ctg_pri_desc<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['ctg_pri_desc']; ?>">
                           
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

        $var_consulta = pg_query($rmfAdm, "SELECT COUNT(ctg_pri_id) FROM ctg_principios WHERE UPPER(ctg_pri_id) = UPPER('$ctg_pri_id') ;");

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

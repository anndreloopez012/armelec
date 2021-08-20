<?php
if (isset($_GET["validaciones"]) && !empty($_GET["validaciones"])) {
    require_once "../../data/conexion/tmfAdm.php";

    $idUser = $_SESSION['adm_usr_id'];
    $idCode = $_SESSION['adm_usr_code'];
    $idContrato = $_SESSION['adm_usr_contrato'];

    $ctg_pro_cod = isset($_POST["ctg_pro_cod"]) ? $_POST["ctg_pro_cod"]  : 0;
    $ctg_pro_desc = isset($_POST["ctg_pro_desc"]) ? $_POST["ctg_pro_desc"]  : '';
    $ctg_pro_pre = isset($_POST["ctg_pro_pre"]) ? $_POST["ctg_pro_pre"]  : '';
    $ctg_pro_imagen = isset($_POST["ctg_pro_imagen"]) ? $_POST["ctg_pro_imagen"]  : '';

    $ctg_pro_prinact = isset($_POST["ctg_pro_prinact"]) ? $_POST["ctg_pro_prinact"]  : '';
    $ctg_pro_labfar = isset($_POST["ctg_pro_labfar"]) ? $_POST["ctg_pro_labfar"]  : '';
    $ctg_pro_fecaut = isset($_POST["ctg_pro_fecaut"]) ? $_POST["ctg_pro_fecaut"]  : '';
    $ctg_pro_fecven = isset($_POST["ctg_pro_fecven"]) ? $_POST["ctg_pro_fecven"]  : '';

    $ctg_fap_pre  = isset($_POST["ctg_fap_pre"]) ? $_POST["ctg_fap_pre"]  : 0;
    $ctg_fap_prinact  = isset($_POST["ctg_fap_prinact"]) ? $_POST["ctg_fap_prinact"]  : '';
    $ctg_fap_indi  = isset($_POST["ctg_fap_indi"]) ? $_POST["ctg_fap_indi"]  : '';
    $ctg_fap_psinar  = isset($_POST["ctg_fap_psinar"]) ? $_POST["ctg_fap_psinar"]  : '';

    $ctg_pro_img  = isset($_POST["ctg_pro_img"]) ? $_POST["ctg_pro_img"]  : '';
    $ctg_pro_imagen  = isset($_POST["ctg_pro_imagen"]) ? $_POST["ctg_pro_imagen"]  : '';


    $id = isset($_POST["id"]) ? $_POST["id"]  : '';
    $ctg_lce_code = isset($_POST["ctg_lce_code"]) ? $_POST["ctg_lce_code"]  : '';
    $ctg_lce_code = strtoupper($ctg_lce_code);

    $ctg_lce_descrip = isset($_POST["ctg_lce_descrip"]) ? $_POST["ctg_lce_descrip"]  : '';
    $ctg_fap_imagen = isset($_POST["ctg_fap_imagen"]) ? $_POST["ctg_fap_imagen"]  : '';
    $ctg_fap_img = isset($_POST["ctg_fap_img"]) ? $_POST["ctg_fap_img"]  : '';
    $ctg_lce_pre = isset($_POST["ctg_lce_pre"]) ? $_POST["ctg_lce_pre"]  : '';

    $ctg_exa_obs = isset($_POST["ctg_obs"]) ? $_POST["ctg_obs"]  : '';
    $ctg_lce_obs = isset($_POST["ctg_obs"]) ? $_POST["ctg_obs"]  : '';



    $status = 1;
    $fechaIng = date('Y-m-d H:i:s');

    $strTipoValidacion = isset($_REQUEST["validaciones"]) ? $_REQUEST["validaciones"] : '';
    if ($strTipoValidacion == "insert_new") {
        header('Content-Type: application/json');
        $var_consulta = "INSERT INTO ctg_lab_clinicos_examenes(ctg_lce_contrato,ctg_lce_code,ctg_lce_descrip,ctg_lce_obs,ctg_lce_pre,ctg_lce_imagen,ctg_lce_sta,ctg_lce_usr,ctg_lce_dt) VALUES ($idContrato,$ctg_pro_cod,'$ctg_pro_desc','$ctg_lce_obs','$ctg_pro_pre','$ctg_pro_imagen','1','$idUser','$fechaIng');";
        //print_r($var_consulta);
        $val = 1;
        if (pg_query($rmfAdm, $var_consulta)) {
            $arrInfo['status'] = $val;
        } else {
            $arrInfo['status'] = 0;
            $arrInfo['error'] = $var_consulta;
        }
        print json_encode($arrInfo);
        die();
    }
    if ($strTipoValidacion == "insert") {
        header('Content-Type: application/json');
        if ($ctg_lce_descrip) {
            $var_consulta = "INSERT INTO ctg_examenes(ctg_exa_code,ctg_exa_descrip,ctg_exa_obs,ctg_exa_imagen,ctg_exa_sta,ctg_exa_dt,ctg_exa_usr) VALUES ($ctg_lce_code,'$ctg_lce_descrip','$ctg_exa_obs','$ctg_fap_img','1','$fechaIng','$idUser')";
            $val = 1;
            if (pg_query($rmfAdm, $var_consulta)) {
                $arrInfo['status'] = $val;
            } else {
                $arrInfo['status'] = 0;
                $arrInfo['error'] = $var_consulta;
            }
            //print json_encode($arrInfo);
        }
        if ($ctg_lce_descrip) {

            $var_consulta = "INSERT INTO ctg_lab_clinicos_examenes(ctg_lce_contrato,ctg_lce_code,ctg_lce_obs,ctg_lce_descrip,ctg_lce_pre,ctg_lce_imagen,ctg_lce_sta,ctg_lce_usr,ctg_lce_dt) VALUES ($idContrato,'$ctg_lce_code','$ctg_lce_obs','$ctg_lce_descrip','$ctg_lce_pre','$ctg_fap_imagen','1','$idUser','$fechaIng')";
            $val = 1;
            //print_r($var_consulta);

            if (pg_query($rmfAdm, $var_consulta)) {
                $arrInfo['status'] = $val;
            } else {
                $arrInfo['status'] = 0;
                $arrInfo['error'] = $var_consulta;
            }
        }
        print json_encode($arrInfo);

        die();
    } else if ($strTipoValidacion == "update_precio") {

        $precio = isset($_POST["precio"]) ? $_POST["precio"]  : '';
        $id_pre = isset($_POST["id_pre"]) ? $_POST["id_pre"]  : '';

        header('Content-Type: application/json');
        $var_consulta = "UPDATE ctg_lab_clinicos_examenes SET ctg_lce_pre = '$precio' WHERE id = $id_pre;";
        //print_r($var_consulta);
        $val = 1;
        if (pg_query($rmfAdm, $var_consulta)) {
            $arrInfo['status'] = $val;
        } else {
            $arrInfo['status'] = 0;
            $arrInfo['error'] = $var_consulta;
        }
        print json_encode($arrInfo);
        die();
    } else if ($strTipoValidacion == "delete") {
        header('Content-Type: application/json');
        $var_consulta = "DELETE FROM ctg_lab_clinicos_examenes WHERE id = $id;";
        $val = 1;
        if (pg_query($rmfAdm, $var_consulta)) {
            $arrInfo['status'] = $val;
        } else {
            $arrInfo['status'] = 0;
            $arrInfo['error'] = $var_consulta;
        }
        print json_encode($arrInfo);
        die();
    }

    //DIBUJO DE TABLA PRODUCTOS CATEGORIAS
    else if ($strTipoValidacion == "busqueda_table") {
        $strSearch = isset($_POST["Search"]) ? $_POST["Search"]  : '';

        $strFilter = "";
        if (!empty($strSearch)) {
            $strFilter = " AND ( UPPER(ctg_lce_descrip) LIKE UPPER('%{$strSearch}%') ) ";
        }

        $Code = $_SESSION['adm_usr_contrato'];
        //print_r($Code);

        $arrTableProduct = array();
        $var_consulta = "SELECT * 
                        FROM ctg_lab_clinicos_examenes 
                        WHERE ctg_lce_contrato = '$Code' 
                        $strFilter 
                        ORDER BY ctg_lce_descrip  
                        LIMIT 100";
        $sql = pg_query($rmfAdm, $var_consulta);
        // print_r($var_consulta);

        $totalArticle = pg_num_rows($sql);

        while ($rTMP = pg_fetch_assoc($sql)) {

            $arrTableProduct[$rTMP["id"]]["id"]                       = $rTMP["id"];
            $arrTableProduct[$rTMP["id"]]["ctg_lce_contrato"]                       = $rTMP["ctg_lce_contrato"];
            $arrTableProduct[$rTMP["id"]]["ctg_lce_code"]                       = $rTMP["ctg_lce_code"];
            $arrTableProduct[$rTMP["id"]]["ctg_lce_descrip"]                       = $rTMP["ctg_lce_descrip"];
            $arrTableProduct[$rTMP["id"]]["ctg_lce_pre"]                       = $rTMP["ctg_lce_pre"];
            $arrTableProduct[$rTMP["id"]]["ctg_lce_imagen"]                       = $rTMP["ctg_lce_imagen"];
            $arrTableProduct[$rTMP["id"]]["ctg_lce_obs"]                       = $rTMP["ctg_lce_obs"];
            $arrTableProduct[$rTMP["id"]]["ctg_lce_sta"]                       = $rTMP["ctg_lce_sta"];
            $arrTableProduct[$rTMP["id"]]["ctg_lce_dt"]                       = $rTMP["ctg_lce_dt"];
            $arrTableProduct[$rTMP["id"]]["ctg_lce_usr"]                       = $rTMP["ctg_lce_usr"];
        }
        pg_free_result($sql);

?>
        <div class="col-md-12 tableFixHead">
            <table id="tableVaccine" class="table table-bordered table-striped table-hover table-sm">
                <thead>
                    <tr class="table-info">
                        <th>Codigo</th>
                        <th>Nombre</th>
                        <th>Precio</th>
                        <th>$</th>
                        <th>-</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (is_array($arrTableProduct) && (count($arrTableProduct) > 0)) {
                        $intContador = 1;
                        reset($arrTableProduct);
                        foreach ($arrTableProduct as $rTMP['key'] => $rTMP['value']) {
                    ?>
                            <tr>
                                <td width="5%"><?php echo  $rTMP["value"]['ctg_lce_code']; ?></td>
                                <td width="80%"><?php echo  $rTMP["value"]['ctg_lce_descrip']; ?></td>
                                <td width="5%"><?php echo  $rTMP["value"]['ctg_lce_pre']; ?></td>

                                <td width="3%" style="cursor:pointer;" onclick="fntSelectPrecio('<?php print $intContador; ?>');">
                                    <i title="Cambiar Precio " class="fad fa-money-bill-wave"></i>
                                </td>
                                <td width="3%" style="cursor:pointer;" onclick="fntSelectDelete('<?php print $intContador; ?>');">
                                    <i title="Eliminar " class="fad fa-trash-alt"></i>
                                </td>
                            </tr>
                            <input type="hidden" name="hidId_<?php print $intContador; ?>" id="hidId_<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['id']; ?>">
                            <input type="hidden" name="hidPre_<?php print $intContador; ?>" id="hidPre_<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['ctg_lce_pre']; ?>">

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
    } else if ($strTipoValidacion == "busqueda_table_new") {
        $strSearch = isset($_POST["Search"]) ? $_POST["Search"]  : '';

        $strFilter = "";
        if (!empty($strSearch)) {
            $strFilter = " AND ( UPPER(exa.ctg_exa_descrip) LIKE UPPER('%{$strSearch}%') ) ";
        }

        $arrTableProduct = array();
        $var_consulta = "SELECT * FROM ctg_examenes 
        WHERE ctg_exa_code NOT IN 
        (select ctg_lce_code 
        from ctg_lab_clinicos_examenes 
        where ctg_lce_contrato='$idContrato' ) 
        $strFilter
        ORDER BY ctg_exa_descrip 
        LIMIT 100";

        $sql = pg_query($rmfAdm, $var_consulta);
        $totalArticle = pg_num_rows($sql);
        //print_r($var_consulta);
        while ($rTMP = pg_fetch_assoc($sql)) {

            $arrTableProduct[$rTMP["id"]]["id"]                       = $rTMP["id"];
            $arrTableProduct[$rTMP["id"]]["ctg_exa_code"]                       = $rTMP["ctg_exa_code"];
            $arrTableProduct[$rTMP["id"]]["ctg_exa_descrip"]                       = $rTMP["ctg_exa_descrip"];
            $arrTableProduct[$rTMP["id"]]["ctg_exa_pre"]                       = $rTMP["ctg_exa_pre"];
            $arrTableProduct[$rTMP["id"]]["ctg_exa_imagen"]                       = $rTMP["ctg_exa_imagen"];
            $arrTableProduct[$rTMP["id"]]["ctg_exa_obs"]                       = $rTMP["ctg_exa_obs"];
            $arrTableProduct[$rTMP["id"]]["ctg_exa_sta"]                       = $rTMP["ctg_exa_sta"];
            $arrTableProduct[$rTMP["id"]]["ctg_exa_dt"]                       = $rTMP["ctg_exa_dt"];
            $arrTableProduct[$rTMP["id"]]["ctg_exa_usr"]                       = $rTMP["ctg_exa_usr"];
        }
        pg_free_result($sql);

    ?>
        <div class="col-md-12 tableFixHead">
            <table id="tableVaccine" class="table table-bordered table-striped table-hover table-sm">
                <thead>
                    <tr class="table-info">
                        <th>Cod</th>
                        <th>Nombre</th>
                        <th>Precio</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (is_array($arrTableProduct) && (count($arrTableProduct) > 0)) {
                        $intContador = 1;
                        reset($arrTableProduct);
                        foreach ($arrTableProduct as $rTMP['key'] => $rTMP['value']) {
                    ?>
                            <tr>
                                <td width="5%"><?php echo  $rTMP["value"]['ctg_exa_code']; ?></td>
                                <td width="80%"><?php echo  $rTMP["value"]['ctg_exa_descrip']; ?></td>
                                <td width="5%"><?php echo  $rTMP["value"]['ctg_exa_pre']; ?></td>
                                <td width="5%" style="cursor:pointer;" onclick="fntSelectSave('<?php print $intContador; ?>');">
                                    <i title="Agregar " class="fad fa-plus-square"></i>
                                </td>
                            </tr>
                            <input type="hidden" name="hidId_<?php print $intContador; ?>" id="hidId_<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['id']; ?>">
                            <input type="hidden" name="hid_ctg_exa_code_<?php print $intContador; ?>" id="hid_ctg_exa_code_<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['ctg_exa_code']; ?>">
                            <input type="hidden" name="hid_ctg_exa_descrip_<?php print $intContador; ?>" id="hid_ctg_exa_descrip_<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['ctg_exa_descrip']; ?>">
                            <input type="hidden" name="hid_ctg_exa_pre_<?php print $intContador; ?>" id="hid_ctg_exa_pre_<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['ctg_exa_pre']; ?>">
                            <input type="hidden" name="hid_ctg_exa_imagen_<?php print $intContador; ?>" id="hid_ctg_exa_imagen_<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['ctg_exa_imagen']; ?>">

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
    } else if ($strTipoValidacion == "validacion_nombre") {

        $intData = isset($_GET["nombre"]) ? intval($_GET["nombre"]) : "";

        $boolExiste = false;

        if ($intData) {

            $var_consulta = "SELECT * FROM $tablaVacunas WHERE med_vac_nom  = '$intData'";
            if (pg_query($rmfAdm, $var_consulta)) {
                $boolExiste = true;
            } else {
                echo "Error: " . $var_consulta . "<br>";
            }
        }

        $strTextoFinal = $boolExiste ? "Y" : "N";
        print $strTextoFinal;
        die();
    } else if ($strTipoValidacion == "validacion_code") {

        $intData = isset($_GET["code"]) ? $_GET["code"] : "";
        $intData = strtoupper($intData);

        header('Content-Type: application/json');

        $val = 1;
        if ($intData) {

            $rs = pg_query("SELECT ctg_lce_code FROM ctg_lab_clinicos_examenes WHERE ctg_lce_code  = '$intData'");
            if ($row = pg_fetch_array($rs)) {
                $idRow = trim($row[0]);
            }
            $idMaxMed = isset($idRow) ? $idRow : "";

            if ($idMaxMed == "") {
                $arrInfo['status'] = 0;
            } else {
                $arrInfo['status'] = $val;
            }
        }
        // print_r($var_consulta);
        print json_encode($arrInfo);

        die();
    }

    die();
}


?>
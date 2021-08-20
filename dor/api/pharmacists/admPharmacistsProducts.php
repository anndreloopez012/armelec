<?php
if (isset($_GET["validaciones"]) && !empty($_GET["validaciones"])) {
    require_once "../../data/conexion/tmfAdm.php";

    $idUser = $_SESSION['adm_usr_id'];
    $idCode = $_SESSION['adm_usr_code'];
    $adm_usr_contrato = $_SESSION['adm_usr_contrato'];

    $ctg_pro_cod = isset($_POST["ctg_pro_cod"]) ? $_POST["ctg_pro_cod"]  : 0;
    $ctg_pro_desc = isset($_POST["ctg_pro_desc"]) ? $_POST["ctg_pro_desc"]  : '';
    $ctg_pro_pre = isset($_POST["ctg_pro_pre"]) ? $_POST["ctg_pro_pre"]  : '';

    $ctg_pro_prinact = isset($_POST["ctg_pro_prinact"]) ? $_POST["ctg_pro_prinact"]  : '';
    $ctg_fap_pre = isset($_POST["ctg_fap_pre"]) ? $_POST["ctg_fap_pre"]  : '';
    $ctg_pro_fecaut = isset($_POST["ctg_pro_fecaut"]) ? $_POST["ctg_pro_fecaut"]  : '';
    $ctg_pro_fecven = isset($_POST["ctg_pro_fecven"]) ? $_POST["ctg_pro_fecven"]  : '';
    $ctg_pro_labfar = isset($_POST["ctg_pro_labfar"]) ? $_POST["ctg_pro_labfar"]  : '';
    $ctg_pro_indi = isset($_POST["ctg_pro_indi"]) ? $_POST["ctg_pro_indi"]  : '';

    $ctg_fap_prinact  = isset($_POST["ctg_fap_prinact"]) ? $_POST["ctg_fap_prinact"]  : '';
    $ctg_fap_indi  = isset($_POST["ctg_fap_indi"]) ? $_POST["ctg_fap_indi"]  : '';
    $ctg_fap_psinar  = isset($_POST["ctg_fap_psinar"]) ? $_POST["ctg_fap_psinar"]  : '';

    $ctg_pro_img  = isset($_POST["ctg_pro_img"]) ? $_POST["ctg_pro_img"]  : '';
    $ctg_pro_imagen  = isset($_POST["ctg_pro_imagen"]) ? $_POST["ctg_pro_imagen"]  : '';


    $id = isset($_POST["id"]) ? $_POST["id"]  : '';
    $ctg_fap_pro = isset($_POST["ctg_fap_pro"]) ? $_POST["ctg_fap_pro"]  : '';
    $ctg_fap_pro = strtoupper($ctg_fap_pro);

    $ctg_fap_nomcom = isset($_POST["ctg_fap_nomcom"]) ? $_POST["ctg_fap_nomcom"]  : '';
    
    $ctg_fap_fecaut = isset($_POST["ctg_fap_fecaut"]) ? $_POST["ctg_fap_fecaut"]  : '';
    $ctg_fap_fecven = isset($_POST["ctg_fap_fecven"]) ? $_POST["ctg_fap_fecven"]  : '';
    $ctg_fap_prinact = isset($_POST["ctg_fap_prinact"]) ? $_POST["ctg_fap_prinact"]  : '';
    $ctg_fap_labfar = isset($_POST["ctg_fap_labfar"]) ? $_POST["ctg_fap_labfar"]  : '';
    $ctg_fap_indi = isset($_POST["ctg_fap_indi"]) ? $_POST["ctg_fap_indi"]  : '';
    
    $ctg_fap_imagen = isset($_POST["ctg_fap_imagen"]) ? $_POST["ctg_fap_imagen"]  : '';
    $ctg_fap_img = isset($_POST["ctg_fap_img"]) ? $_POST["ctg_fap_img"]  : '';

    $status = 1;
    $fechaIng = date('Y-m-d H:i:s');

    $rs = pg_query($rmfAdm, "SELECT id FROM ctg_farmacias_productos ORDER BY id DESC LIMIT 1");
    if ($row = pg_fetch_array($rs)) {
        $idRow = trim($row[0]);
    }
    //id para insert de tabla medicos
    $idContrato = isset($idRow) ? $idRow  : 0;
    $idContrato = $idContrato + 1;

    $strTipoValidacion = isset($_REQUEST["validaciones"]) ? $_REQUEST["validaciones"] : '';
    if ($strTipoValidacion == "insert_new") {
        header('Content-Type: application/json');
        $ctg_fap_psinar = 0;
        $ctg_pro_imagen = 0;
        $var_consulta = "INSERT INTO ctg_farmacias_productos(ctg_fap_contrato,ctg_fap_pro,ctg_fap_nomcom,ctg_fap_pre,ctg_fap_prinact,ctg_fap_labfar,ctg_fap_fecaut,ctg_fap_fecven,ctg_fap_psinar,ctg_fap_imagen,ctg_fap_sta,ctg_fap_usr,ctg_fap_dt,ctg_fap_img,ctg_fap_indi) VALUES ('$adm_usr_contrato','$ctg_pro_cod','$ctg_pro_desc',$ctg_pro_pre,'$ctg_pro_prinact','$ctg_pro_labfar','$ctg_pro_fecaut','$ctg_pro_fecven','$ctg_fap_psinar','$ctg_pro_imagen','1','$idCode','$fechaIng','$ctg_pro_img','$ctg_pro_indi');";
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
        if ($ctg_fap_nomcom) {
            $var_consulta = "INSERT INTO ctg_productos(ctg_pro_cod,ctg_pro_desc,ctg_pro_img,ctg_pro_sta,ctg_pro_dt,ctg_pro_usr,ctg_pro_fecaut,ctg_pro_fecven,ctg_pro_prinact,ctg_pro_labfar,ctg_pro_indi) VALUES ('$ctg_fap_pro','$ctg_fap_nomcom','$ctg_fap_img','1','$fechaIng','$idCode','$ctg_fap_fecaut','$ctg_fap_fecven','$ctg_fap_prinact','$ctg_fap_labfar','$ctg_fap_indi')";
            $val = 1;
            if (pg_query($rmfAdm, $var_consulta)) {
                $arrInfo['status'] = $val;
            } else {
                $arrInfo['status'] = 0;
                $arrInfo['error'] = $var_consulta;
            }
            // print json_encode($arrInfo);
        }
        //  print_r($var_consulta);

        if ($ctg_fap_nomcom) {
            $var_consulta = "INSERT INTO ctg_farmacias_productos(ctg_fap_contrato,ctg_fap_pro,ctg_fap_nomcom,ctg_fap_pre,ctg_fap_imagen,ctg_fap_sta,ctg_fap_usr,ctg_fap_dt,ctg_fap_img,ctg_fap_fecaut,ctg_fap_fecven,ctg_fap_prinact,ctg_fap_labfar,ctg_fap_indi) VALUES ('$adm_usr_contrato','$ctg_fap_pro','$ctg_fap_nomcom','$ctg_fap_pre','$ctg_fap_imagen','1','$idCode','$fechaIng','$ctg_fap_img','$ctg_fap_fecaut','$ctg_fap_fecven','$ctg_fap_prinact','$ctg_fap_labfar','$ctg_fap_indi')";
            $val = 1;
            if (pg_query($rmfAdm, $var_consulta)) {
                $arrInfo['status'] = $val;
            } else {
                $arrInfo['status'] = 0;
                $arrInfo['error'] = $var_consulta;
            }
            //    print_r($var_consulta);

        }
        print json_encode($arrInfo);


        die();
    } else if ($strTipoValidacion == "delete") {
        header('Content-Type: application/json');
        $var_consulta = "DELETE FROM ctg_farmacias_productos WHERE id = $id;";
        $val = 1;
        if (pg_query($rmfAdm, $var_consulta)) {
            $arrInfo['status'] = $val;
        } else {
            $arrInfo['status'] = 0;
            $arrInfo['error'] = $var_consulta;
        }
        print json_encode($arrInfo);
        die();
    }else if ($strTipoValidacion == "update_precio") {

        $precio = isset($_POST["precio"]) ? $_POST["precio"]  : '';
        $id_pre = isset($_POST["id_pre"]) ? $_POST["id_pre"]  : '';

        header('Content-Type: application/json');
        $var_consulta = "UPDATE ctg_farmacias_productos SET ctg_fap_pre = '$precio' WHERE id = $id_pre;";
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

    //DIBUJO DE TABLA PRODUCTOS CATEGORIAS
    else if ($strTipoValidacion == "busqueda_table") {
        $strSearch = isset($_POST["Search"]) ? $_POST["Search"]  : '';

        $strFilter = "";
        if (!empty($strSearch)) {
            $strFilter = " AND ( UPPER(ctg_fap_nomcom) LIKE UPPER('%{$strSearch}%') ) ";
        }

        $Code = $_SESSION['adm_usr_contrato'];

        $arrTableProduct = array();
        $var_consulta = "SELECT * FROM ctg_farmacias_productos WHERE ctg_fap_contrato = '$Code'  $strFilter ORDER BY ctg_fap_nomcom  LIMIT 100";
        $sql = pg_query($rmfAdm, $var_consulta);
        $totalArticle = pg_num_rows($sql);
        //print_r($var_consulta);

        while ($rTMP = pg_fetch_assoc($sql)) {

            $arrTableProduct[$rTMP["id"]]["id"]                       = $rTMP["id"];
            $arrTableProduct[$rTMP["id"]]["ctg_fap_contrato"]                       = $rTMP["ctg_fap_contrato"];
            $arrTableProduct[$rTMP["id"]]["ctg_fap_pro"]                       = $rTMP["ctg_fap_pro"];
            $arrTableProduct[$rTMP["id"]]["ctg_fap_nomcom"]                       = $rTMP["ctg_fap_nomcom"];
            $arrTableProduct[$rTMP["id"]]["ctg_fap_pre"]                       = $rTMP["ctg_fap_pre"];
            $arrTableProduct[$rTMP["id"]]["ctg_fap_prinact"]                       = $rTMP["ctg_fap_prinact"];
            $arrTableProduct[$rTMP["id"]]["ctg_fap_indi"]                       = $rTMP["ctg_fap_indi"];
            $arrTableProduct[$rTMP["id"]]["ctg_fap_labfar"]                       = $rTMP["ctg_fap_labfar"];
            $arrTableProduct[$rTMP["id"]]["ctg_fap_fecaut"]                       = $rTMP["ctg_fap_fecaut"];
            $arrTableProduct[$rTMP["id"]]["ctg_fap_fecven"]                       = $rTMP["ctg_fap_fecven"];
            $arrTableProduct[$rTMP["id"]]["ctg_fap_psinar"]                       = $rTMP["ctg_fap_psinar"];
            $arrTableProduct[$rTMP["id"]]["ctg_fap_imagen"]                       = $rTMP["ctg_fap_imagen"];
            $arrTableProduct[$rTMP["id"]]["ctg_fap_obs"]                       = $rTMP["ctg_fap_obs"];
            $arrTableProduct[$rTMP["id"]]["ctg_fap_sta"]                       = $rTMP["ctg_fap_sta"];
            $arrTableProduct[$rTMP["id"]]["ctg_fap_usr"]                       = $rTMP["ctg_fap_usr"];
            $arrTableProduct[$rTMP["id"]]["ctg_fap_dt"]                       = $rTMP["ctg_fap_dt"];
            $arrTableProduct[$rTMP["id"]]["ctg_fap_img"]                       = $rTMP["ctg_fap_img"];
        }
        pg_free_result($sql);

?>
        <div class="col-md-12 tableFixHead">
            <table id="tableVaccine" class="table table-bordered table-striped table-hover table-sm">
                <thead>
                    <tr class="table-info">
                        <th>Registro No.</th>
                        <th>Nombre</th>
                        <th>Principio Activo</th>
                        <th>Fabricante</th>
                        <th>Autorizada</th>
                        <th>Vence</th>
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
                                <td><?php echo  $rTMP["value"]['ctg_fap_pro']; ?></td>
                                <td><?php echo  $rTMP["value"]['ctg_fap_nomcom']; ?></td>
                                <td><?php echo  $rTMP["value"]['ctg_fap_prinact']; ?></td>
                                <td><?php echo  $rTMP["value"]['ctg_fap_labfar']; ?></td>
                                <td><?php echo  $rTMP["value"]['ctg_fap_fecaut']; ?></td>
                                <td><?php echo  $rTMP["value"]['ctg_fap_pre']; ?></td>
                                <td width="3%" style="cursor:pointer;" onclick="fntSelectPrecio('<?php print $intContador; ?>');">
                                    <i title="Cambiar Precio " class="fad fa-money-bill-wave"></i>
                                </td>
                                <td>
                                <i title="Eliminar " class="fad fa-trash-alt" style="cursor:pointer;" onclick="fntSelectDelete('<?php print $intContador; ?>');"></i>
                                </td>
                            </tr>
                            <input type="hidden" name="hid__Id_<?php print $intContador; ?>" id="hid__Id_<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['id']; ?>">
                            <input type="hidden" name="hid_ctg_fap_pre<?php print $intContador; ?>" id="hid_ctg_fap_pre<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['ctg_fap_pre']; ?>">

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

        $Code = $_SESSION['adm_usr_contrato'];

        $strSearch = isset($_POST["Search"]) ? $_POST["Search"]  : '';

        $strFilter = "";
        if (!empty($strSearch)) {
            $strFilter = " AND ( UPPER(ctg_pro_desc) LIKE UPPER('%{$strSearch}%') OR UPPER(ctg_pro_cod) LIKE UPPER('%{$strSearch}%') ) ";
        }

        $arrTableProduct = array();
        $var_consulta = "SELECT * FROM ctg_productos 
                        WHERE ctg_pro_cod NOT IN 
                        (select ctg_fap_pro
                        from ctg_farmacias_productos 
                        where ctg_fap_contrato='$Code' ) 
                        $strFilter
                        ORDER BY ctg_pro_desc
                        LIMIT 100";
        $sql = pg_query($rmfAdm, $var_consulta);
        $totalArticle = pg_num_rows($sql);
        //print_r($var_consulta);

        while ($rTMP = pg_fetch_assoc($sql)) {

            $arrTableProduct[$rTMP["id"]]["id"]                       = $rTMP["id"];
            $arrTableProduct[$rTMP["id"]]["ctg_pro_cod"]                       = $rTMP["ctg_pro_cod"];
            $arrTableProduct[$rTMP["id"]]["ctg_pro_desc"]                       = $rTMP["ctg_pro_desc"];
            $arrTableProduct[$rTMP["id"]]["ctg_pro_prinact"]                       = $rTMP["ctg_pro_prinact"];
            $arrTableProduct[$rTMP["id"]]["ctg_pro_indi"]                       = $rTMP["ctg_pro_indi"];
            $arrTableProduct[$rTMP["id"]]["ctg_pro_labfar"]                       = $rTMP["ctg_pro_labfar"];
            $arrTableProduct[$rTMP["id"]]["ctg_pro_fecaut"]                       = $rTMP["ctg_pro_fecaut"];
            $arrTableProduct[$rTMP["id"]]["ctg_pro_fecven"]                       = $rTMP["ctg_pro_fecven"];
            $arrTableProduct[$rTMP["id"]]["ctg_pro_psinar"]                       = $rTMP["ctg_pro_psinar"];
            $arrTableProduct[$rTMP["id"]]["ctg_pro_sta"]                       = $rTMP["ctg_pro_sta"];
            $arrTableProduct[$rTMP["id"]]["ctg_pro_dt"]                       = $rTMP["ctg_pro_dt"];
            $arrTableProduct[$rTMP["id"]]["ctg_pro_usr"]                       = $rTMP["ctg_pro_usr"];
            $arrTableProduct[$rTMP["id"]]["ctg_pro_img"]                       = $rTMP["ctg_pro_img"];
            $arrTableProduct[$rTMP["id"]]["ctg_pro_pre"]                       = $rTMP["ctg_pro_pre"];
        }
        pg_free_result($sql);

    ?>
        <div class="col-md-12 tableFixHead">
            <table id="tableVaccine" class="table table-bordered table-striped table-hover table-sm">
                <thead>
                    <tr class="table-info">
                        <th width="10%">Cod</th>
                        <th width="30%">Nombre</th>
                        <th width="20%">Principio Activo</th>
                        <th width="10%">Fabricante</th>
                        <th width="10%">Autorizada</th>
                        <th width="10%">Vence</th>
                        <th width="10%">Precio</th>
                        <th width="5%"></th>
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
                                <td><?php echo  $rTMP["value"]['ctg_pro_cod']; ?></td>
                                <td><?php echo  $rTMP["value"]['ctg_pro_desc']; ?></td>
                                <td><?php echo  $rTMP["value"]['ctg_pro_prinact']; ?></td>
                                <td><?php echo  $rTMP["value"]['ctg_pro_labfar']; ?></td>
                                <td><?php echo  $rTMP["value"]['ctg_pro_fecaut']; ?></td>
                                <td><?php echo  $rTMP["value"]['ctg_pro_fecven']; ?></td>
                                <td><?php echo  $rTMP["value"]['ctg_pro_pre']; ?></td>
                                <td style="cursor:pointer;" onclick="fntSelectSave('<?php print $intContador; ?>');">
                                    <i title="Agregar " class="fad fa-plus-square"></i>
                                </td>
                            </tr>
                            <input type="hidden" name="hidId_<?php print $intContador; ?>" id="hidId_<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['ctg_pro_cod']; ?>">
                            <input type="hidden" name="hid_ctg_pro_cod_<?php print $intContador; ?>" id="hid_ctg_pro_cod_<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['ctg_pro_cod']; ?>">
                            <input type="hidden" name="hid_ctg_pro_desc_<?php print $intContador; ?>" id="hid_ctg_pro_desc_<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['ctg_pro_desc']; ?>">
                            <input type="hidden" name="hid_ctg_pro_pre_<?php print $intContador; ?>" id="hid_ctg_pro_pre_<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['ctg_pro_pre']; ?>">
                            <input type="hidden" name="hid_ctg_pro_prinact_<?php print $intContador; ?>" id="hid_ctg_pro_prinact_<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['ctg_pro_prinact']; ?>">
                            <input type="hidden" name="hid_ctg_pro_labfar_<?php print $intContador; ?>" id="hid_ctg_pro_labfar_<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['ctg_pro_labfar']; ?>">
                            <input type="hidden" name="hid_ctg_pro_fecaut_<?php print $intContador; ?>" id="hid_ctg_pro_fecaut_<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['ctg_pro_fecaut']; ?>">
                            <input type="hidden" name="hid_ctg_pro_fecven_<?php print $intContador; ?>" id="hid_ctg_pro_fecven_<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['ctg_pro_fecven']; ?>">
                            <input type="hidden" name="hid_ctg_pro_indi_<?php print $intContador; ?>" id="hid_ctg_pro_indi_<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['ctg_pro_indi']; ?>">

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

            $var_consulta = pg_query("SELECT COUNT(ctg_fap_pro) FROM ctg_farmacias_productos WHERE UPPER(ctg_fap_pro)  = '$intData'");

            if ($row = pg_fetch_array($var_consulta)) {
                $idRow = trim($row[0]);
            }
            $idMaxMed = isset($idRow) ? $idRow : 0;

            if ($idMaxMed >= 1) {
                $arrInfo['status'] = $val;
            } else {
                $arrInfo['status'] = 0;
            }
        }

        print json_encode($arrInfo);

        die();
    }


    die();
}


?>
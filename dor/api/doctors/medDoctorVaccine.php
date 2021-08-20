<?php
if (isset($_GET["validaciones"]) && !empty($_GET["validaciones"])) {
    require_once "../../data/conexion/tmlMed.php";
    require_once "../../data/conexion/tmfAdm.php";
    $usuario = $_SESSION['adm_usr_code'];
    $idUser = $_SESSION['adm_usr_code'];

    //TABLA DE INTERACCION
    $tablaVacunas = "med" . $idUser . "vacunas";
    $tablaVacunasCompra = "med" . $idUser . "vacunas_compras";

    $insert = 1;
    $update = 2;
    $delete = 3;

    $id = isset($_POST["id"]) ? $_POST["id"]  : '';
    $med_vac_id_ = isset($_POST["codigo"]) ? $_POST["codigo"]  : '';
    $med_vac_nom_ = isset($_POST["nombre"]) ? $_POST["nombre"]  : '';
    $med_vac_costo_ = isset($_POST["costo"]) ? $_POST["costo"]  : 0;
    $med_vac_precio_ = isset($_POST["precio_venta"]) ? $_POST["precio_venta"]  : 0;
    $med_vac_sali_ = isset($_POST["saldo_inicial"]) ? $_POST["saldo_inicial"]  : 0;
    $med_vac_sal_act_ = isset($_POST["saldo_actual"]) ? $_POST["saldo_actual"]  : 0;
    $med_vac_des_ = isset($_POST["descripcion"]) ? $_POST["descripcion"]  : '';

    $med_vam_id = isset($_POST["med_vam_id"]) ? $_POST["med_vam_id"]  : '';
    $med_vam_nom = isset($_POST["med_vam_nom"]) ? $_POST["med_vam_nom"]  : '';
    $med_vam_fac = isset($_POST["med_vam_fac"]) ? $_POST["med_vam_fac"]  : '';
    $med_vam_fac_dt = isset($_POST["med_vam_fac_dt"]) ? $_POST["med_vam_fac_dt"]  : '';
    $med_vam_costo = isset($_POST["med_vam_costo"]) ? $_POST["med_vam_costo"]  : 0;
    $med_vam_uni = isset($_POST["med_vam_uni"]) ? $_POST["med_vam_uni"]  : 0;
    $med_vac_des_ = isset($_POST["descripcion"]) ? $_POST["descripcion"]  : '';


    $status = 1;
    $fechaIng = date('Y-m-d H:i:s');

    $val = 1;
    $strTipoValidacion = isset($_REQUEST["validaciones"]) ? $_REQUEST["validaciones"] : '';
    if ($strTipoValidacion == "insert") {
        header('Content-Type: application/json');
        $var_consulta = "INSERT INTO $tablaVacunas(med_vac_id,med_vac_nom,med_vac_des,med_vac_costo,med_vac_precio,med_vac_sali,med_vac_sta,med_vac_dt,med_vac_usr,med_vac_sal_act,med_vac_comp,med_vac_vent) VALUES ($med_vac_id_,'$med_vac_nom_','$med_vac_des_',$med_vac_costo_,$med_vac_precio_,$med_vac_sali_,'$status','$fechaIng','$usuario',$med_vac_sali_,0,0);";
        $val = 1;
        if (pg_query($tmfMed, $var_consulta)) {
            $arrInfo['status'] = $val;
        } else {
            $arrInfo['status'] = 0;

            $arrInfo['error'] = $var_consulta;
        }
        //print_r( $var_consulta);

        $var_consulta = "INSERT INTO ctg_vacunas(ctg_med_id,ctg_vac_id,ctg_vac_nom,ctg_vac_sta,ctg_vac_dt,ctg_vac_usr) VALUES ($usuario,$med_vac_id_,'$med_vac_nom_','$status','$fechaIng','$usuario');";
        $val = 1;
        if (pg_query($rmfAdm, $var_consulta)) {
            $arrInfo['status'] = $val;
        } else {
            $arrInfo['status'] = 0;

            $arrInfo['error'] = $var_consulta;
        }
        //print_r('<br>');
        //print_r( $var_consulta);
        print json_encode($arrInfo);
        die();
    } else if ($strTipoValidacion == "update") {
        header('Content-Type: application/json');
        $var_consulta = " UPDATE $tablaVacunas SET med_vac_nom = '$med_vac_nom_',med_vac_des = '$med_vac_des_',med_vac_costo = $med_vac_costo_,med_vac_precio = $med_vac_precio_,med_vac_sta = '$status',med_vac_dt = '$fechaIng',med_vac_usr = '$usuario',med_vac_sali = '$med_vac_sali_',med_vac_sal_act = ('$med_vac_sali_' + med_vac_comp) - med_vac_vent  WHERE med_vac_id = $med_vac_id_;";
        if (pg_query($tmfMed, $var_consulta)) {
            $arrInfo['status'] = $val;
        } else {
            $arrInfo['status'] = 0;
            $arrInfo['error'] = $var_consulta;
        }
        //print json_encode($arrInfo);
        //print_r($var_consulta);

        $var_consulta = "UPDATE ctg_vacunas SET ctg_vac_nom = '$med_vac_nom_',ctg_vac_dt = '$fechaIng',ctg_vac_usr = '$usuario' WHERE ctg_vac_id = '$med_vac_id_' AND ctg_med_id = '$usuario';";
        if (pg_query($rmfAdm, $var_consulta)) {
            $arrInfo['status'] = $val;
        } else {
            $arrInfo['status'] = 0;
            $arrInfo['error'] = $var_consulta;
        }
        print json_encode($arrInfo);
        die();
    } else if ($strTipoValidacion == "update_compra") {
        header('Content-Type: application/json');
        $var_consulta = "INSERT INTO $tablaVacunasCompra(med_vam_id,med_vam_fac,med_vam_fac_dt,med_vam_costo,med_vam_uni,med_vam_sta,med_vam_dt,med_vam_usr) VALUES ($med_vam_id,'$med_vam_fac','$med_vam_fac_dt',$med_vam_costo,$med_vam_uni,'$status','$fechaIng','$usuario');";
        $val = 1;
        if (pg_query($tmfMed, $var_consulta)) {
            $arrInfo['status'] = $val;
        } else {
            $arrInfo['status'] = 0;
            $arrInfo['error'] = $var_consulta;
        }

        $var_consulta = "UPDATE $tablaVacunas SET med_vac_nom = '$med_vam_nom',med_vac_comp = med_vac_comp + $med_vam_uni, med_vac_dt = '$fechaIng',med_vac_usr = '$usuario',med_vac_sal_act = (med_vac_sali + ('$med_vam_uni' + med_vac_comp)) - med_vac_vent  WHERE med_vac_id = $med_vam_id;";
        $val = 1;
        if (pg_query($tmfMed, $var_consulta)) {
            $arrInfo['status'] = $val;
        } else {
            $arrInfo['status'] = 0;
            $arrInfo['error'] = $var_consulta;
        }
        //print_r($var_consulta);
        print json_encode($arrInfo);
        die();
    } else if ($strTipoValidacion == "delete") {
        header('Content-Type: application/json');
        $var_consulta = "DELETE FROM $tablaVacunas WHERE id = $id;";
        if (pg_query($tmfMed, $var_consulta)) {
            $arrInfo['status'] = $val;
        } else {
            $arrInfo['status'] = 0;
            $arrInfo['error'] = $var_consulta;
        }
        print json_encode($arrInfo);
        die();
    } else if ($strTipoValidacion == "val_codigo") {
        header('Content-Type: application/json');

        $Search = isset($_POST["Search"]) ? $_POST["Search"]  : 0;

        $val = 1;
        if ($Search >= $val) {
            $var_consulta = pg_query($tmfMed, "SELECT COUNT(med_vac_id) FROM $tablaVacunas WHERE med_vac_id = $Search LIMIT 1;");
            if ($row = pg_fetch_array($var_consulta)) {
                $idRow = trim($row[0]);
            }
        }
        $usuarioCode = isset($idRow) ? $idRow  : 0;

        if ($usuarioCode >= $val) {
            $arrInfo['status'] = $val;
        } else {
            $arrInfo['status'] = 0;
            //$arrInfo['error'] = $var_consulta;
        }
        // print_r($usuarioCode);
        print json_encode($arrInfo);

        die();
    }

    //DIBUJO DE TABLA PRODUCTOS CATEGORIAS
    else if ($strTipoValidacion == "busqueda_vaccineBuyList") {
        $strSearch = isset($_POST["Search"]) ? $_POST["Search"]  : '';

        $strFilter = "";
        if (!empty($strSearch)) {
            $strFilter = " WHERE ( UPPER(med_vam_fac) LIKE UPPER('%{$strSearch}%' )) ";
        }

        $med = $idUser;
        $numVacBuy = "med" . $med . "vacunas_compras";
        $numVac = "med" . $med . "vacunas";
        $arrTableVaccineBuy = array();
        $var_consulta = "SELECT *
                            FROM $numVacBuy com
                            INNER JOIN $numVac vac
                            ON com.med_vam_id = vac.med_vac_id
                            $strFilter
                            ORDER BY com.med_vam_dt DESC";
        $sql = pg_query($tmfMed, $var_consulta);
        $totalArticleVacBuy = pg_num_rows($sql);
        //print_r( $var_consulta);


        while ($rTMP = pg_fetch_assoc($sql)) {

            $arrTableVaccineBuy[$rTMP["id"]]["id"]                       = $rTMP["id"];
            $arrTableVaccineBuy[$rTMP["id"]]["med_vam_id"]               = $rTMP["med_vam_id"];
            $arrTableVaccineBuy[$rTMP["id"]]["med_vam_fac"]              = $rTMP["med_vam_fac"];
            $arrTableVaccineBuy[$rTMP["id"]]["med_vam_fac_dt"]           = $rTMP["med_vam_fac_dt"];
            $arrTableVaccineBuy[$rTMP["id"]]["med_vam_costo"]            = $rTMP["med_vam_costo"];
            $arrTableVaccineBuy[$rTMP["id"]]["med_vam_uni"]              = $rTMP["med_vam_uni"];
            $arrTableVaccineBuy[$rTMP["id"]]["med_vam_sta"]              = $rTMP["med_vam_sta"];
            $arrTableVaccineBuy[$rTMP["id"]]["med_vam_dt"]               = $rTMP["med_vam_dt"];
            $arrTableVaccineBuy[$rTMP["id"]]["med_vam_usr"]              = $rTMP["med_vam_usr"];
            $arrTableVaccineBuy[$rTMP["id"]]["med_vac_id"]               = $rTMP["med_vac_id"];
            $arrTableVaccineBuy[$rTMP["id"]]["med_vac_nom"]              = $rTMP["med_vac_nom"];
            $arrTableVaccineBuy[$rTMP["id"]]["med_vac_des"]              = $rTMP["med_vac_des"];
        }
        pg_free_result($sql);

?>
        <div class="col-md-12 tableFixHead">
            <table id="tableVaccine" class="table table-bordered table-striped table-hover table-sm">
                <thead>
                    <tr class="table-info">
                        <th >No. Factura</th>
                        <th>Fecha</th>
                        <th>Costo</th>
                        <th>Unidades</th>
                        <th>Codigo</th>
                        <th>Descripcion de la Vacuna</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (is_array($arrTableVaccineBuy) && (count($arrTableVaccineBuy) > 0)) {
                        reset($arrTableVaccineBuy);
                        foreach ($arrTableVaccineBuy as $rTMP['key'] => $rTMP['value']) {
                    ?>
                            <tr>
                                <td><?php echo  $rTMP["value"]['med_vam_fac']; ?></td>
                                <td><?php echo  $rTMP["value"]['med_vam_fac_dt']; ?></td>
                                <td><?php echo  $rTMP["value"]['med_vam_costo']; ?></td>
                                <td><?php echo  $rTMP["value"]['med_vam_uni']; ?></td>
                                <td><?php echo  $rTMP["value"]['med_vam_id']; ?></td>
                                <td></td>

                            </tr>
                    <?PHP
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>
    <?php
        die();
    } else if ($strTipoValidacion == "busqueda_tableVaccine") {
        $strSearch = isset($_POST["Search"]) ? $_POST["Search"]  : '';

        $strFilter = "";
        if (!empty($strSearch)) {
            $strFilter = " WHERE ( UPPER(med_vac_nom) LIKE UPPER('%{$strSearch}%' )) ";
        }

        $med = $idUser;
        $numVac = "med" . $med . "vacunas";
        $arrTableVaccine = array();
        $var_consulta = "SELECT * FROM $numVac $strFilter ORDER BY med_vac_nom DESC ";
        $sql = pg_query($tmfMed, $var_consulta);
        $totalArticleVac = pg_num_rows($sql);
        //print_r( $var_consulta);


        while ($rTMP = pg_fetch_assoc($sql)) {

            $arrTableVaccine[$rTMP["id"]]["id"]                       = $rTMP["id"];
            $arrTableVaccine[$rTMP["id"]]["med_vac_id"]               = $rTMP["med_vac_id"];
            $arrTableVaccine[$rTMP["id"]]["med_vac_nom"]              = $rTMP["med_vac_nom"];
            $arrTableVaccine[$rTMP["id"]]["med_vac_des"]              = $rTMP["med_vac_des"];
            $arrTableVaccine[$rTMP["id"]]["med_vac_costo"]            = $rTMP["med_vac_costo"];
            $arrTableVaccine[$rTMP["id"]]["med_vac_precio"]           = $rTMP["med_vac_precio"];
            $arrTableVaccine[$rTMP["id"]]["med_vac_sali"]             = $rTMP["med_vac_sali"];
            $arrTableVaccine[$rTMP["id"]]["med_vac_comp"]             = $rTMP["med_vac_comp"];
            $arrTableVaccine[$rTMP["id"]]["med_vac_vent"]             = $rTMP["med_vac_vent"];
            $arrTableVaccine[$rTMP["id"]]["med_vac_sta"]              = $rTMP["med_vac_sta"];
            $arrTableVaccine[$rTMP["id"]]["med_vac_dt"]               = $rTMP["med_vac_dt"];
            $arrTableVaccine[$rTMP["id"]]["med_vac_usr"]              = $rTMP["med_vac_usr"];
            $arrTableVaccine[$rTMP["id"]]["med_vac_sal_act"]          = $rTMP["med_vac_sal_act"];
            $arrTableVaccine[$rTMP["id"]]["med_vac_vent_precio"]      = $rTMP["med_vac_vent_precio"];
        }
        pg_free_result($sql);

    ?>
        <div class="col-md-12 tableFixHead">
            <table id="tableVaccine" class="table table-bordered table-striped table-hover table-sm ">
                <thead>
                    <tr class="table-info">
                        <th>Codigo</th>
                        <th>Nombre de la Vacuna</th>
                        <th>Costo</th>
                        <th>Precio</th>
                        <th>Saldo Inicial</th>
                        <th>Compras</th>
                        <th>Ventas</th>
                        <th>Saldo Actual</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (is_array($arrTableVaccine) && (count($arrTableVaccine) > 0)) {
                        $intContador = 1;
                        reset($arrTableVaccine);
                        foreach ($arrTableVaccine as $rTMP['key'] => $rTMP['value']) {
                    ?>
                            <tr>
                                <td><?php echo  $rTMP["value"]['med_vac_id']; ?></td>
                                <td><?php echo  $rTMP["value"]['med_vac_nom']; ?></td>
                                <td><?php echo  $rTMP["value"]['med_vac_costo']; ?></td>
                                <td><?php echo  $rTMP["value"]['med_vac_precio']; ?></td>
                                <td><?php echo  $rTMP["value"]['med_vac_sali']; ?></td>
                                <td><?php echo  $rTMP["value"]['med_vac_comp']; ?></td>
                                <td><?php echo  $rTMP["value"]['med_vac_vent']; ?></td>
                                <td><?php echo  $rTMP["value"]['med_vac_sal_act']; ?></td>
                                <td class="table-info">
                                    <i title="ver " class="fad fa-eye" style="cursor:pointer;" onclick="fntSelectView('<?php print $intContador; ?>');"></i>
                                    <i class="fad fa-user-minus " style="cursor:pointer;" id="delete" onclick="fntSelectDelete('<?php print $intContador; ?>'); "></i>
                                    <i class="fad fa-user-edit" style="cursor:pointer;" onclick="fntSelectEdit('<?php print $intContador; ?>');"></i>
                                </td>
                            </tr>

                            <input type="hidden" name="id_<?php print $intContador; ?>" id="id_<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['id']; ?>">
                            <input type="hidden" name="med_vac_id_<?php print $intContador; ?>" id="med_vac_id_<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['med_vac_id']; ?>">
                            <input type="hidden" name="med_vac_nom_<?php print $intContador; ?>" id="med_vac_nom_<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['med_vac_nom']; ?>">
                            <input type="hidden" name="med_vac_costo_<?php print $intContador; ?>" id="med_vac_costo_<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['med_vac_costo']; ?>">
                            <input type="hidden" name="med_vac_precio_<?php print $intContador; ?>" id="med_vac_precio_<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['med_vac_precio']; ?>">
                            <input type="hidden" name="med_vac_sali_<?php print $intContador; ?>" id="med_vac_sali_<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['med_vac_sali']; ?>">
                            <input type="hidden" name="med_vac_comp_<?php print $intContador; ?>" id="med_vac_comp_<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['med_vac_comp']; ?>">
                            <input type="hidden" name="med_vac_sal_act_<?php print $intContador; ?>" id="med_vac_sal_act_<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['med_vac_sal_act']; ?>">
                            <input type="hidden" name="med_vac_des_<?php print $intContador; ?>" id="med_vac_des_<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['med_vac_des']; ?>">
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
    } else if ($strTipoValidacion == "selectVaccine") {
        $med = $idUser;
        $numVac = "med" . $med . "vacunas";
        $arrTableVaccine = array();
        $var_consulta = "SELECT * FROM $numVac ORDER BY med_vac_nom DESC ";
        $sql = pg_query($tmfMed, $var_consulta);
        $totalArticleVac = pg_num_rows($sql);
        //print_r( $var_consulta);
        while ($rTMP = pg_fetch_assoc($sql)) {

            $arrTableVaccine[$rTMP["id"]]["id"]                       = $rTMP["id"];
            $arrTableVaccine[$rTMP["id"]]["med_vac_id"]               = $rTMP["med_vac_id"];
            $arrTableVaccine[$rTMP["id"]]["med_vac_nom"]              = $rTMP["med_vac_nom"];
            $arrTableVaccine[$rTMP["id"]]["med_vac_des"]              = $rTMP["med_vac_des"];
            $arrTableVaccine[$rTMP["id"]]["med_vac_costo"]            = $rTMP["med_vac_costo"];
            $arrTableVaccine[$rTMP["id"]]["med_vac_precio"]           = $rTMP["med_vac_precio"];
            $arrTableVaccine[$rTMP["id"]]["med_vac_sali"]             = $rTMP["med_vac_sali"];
            $arrTableVaccine[$rTMP["id"]]["med_vac_comp"]             = $rTMP["med_vac_comp"];
            $arrTableVaccine[$rTMP["id"]]["med_vac_vent"]             = $rTMP["med_vac_vent"];
            $arrTableVaccine[$rTMP["id"]]["med_vac_sta"]              = $rTMP["med_vac_sta"];
            $arrTableVaccine[$rTMP["id"]]["med_vac_dt"]               = $rTMP["med_vac_dt"];
            $arrTableVaccine[$rTMP["id"]]["med_vac_usr"]              = $rTMP["med_vac_usr"];
            $arrTableVaccine[$rTMP["id"]]["med_vac_sal_act"]          = $rTMP["med_vac_sal_act"];
            $arrTableVaccine[$rTMP["id"]]["med_vac_vent_precio"]      = $rTMP["med_vac_vent_precio"];
        }
        pg_free_result($sql);

    ?>
        <div class="col-md-12 tableFixHead">
            <table id="tableVaccine" class="table table-bordered table-striped table-hover table-sm ">
                <thead>
                    <tr class="table-info">
                        <th>Codigo</th>
                        <th>Nombre de la Vacuna</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (is_array($arrTableVaccine) && (count($arrTableVaccine) > 0)) {
                        $intContador = 1;
                        reset($arrTableVaccine);
                        foreach ($arrTableVaccine as $rTMP['key'] => $rTMP['value']) {
                    ?>
                            <tr style="cursor:pointer;" onclick="fntSelectVaccine_('<?php print $intContador; ?>');">
                                <td><?php echo  $rTMP["value"]['med_vac_id']; ?></td>
                                <td><?php echo  $rTMP["value"]['med_vac_nom']; ?></td>
                            </tr>

                            <input type="hidden" name="id_<?php print $intContador; ?>" id="id_<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['id']; ?>">
                            <input type="hidden" name="med_vac_id_<?php print $intContador; ?>" id="med_vac_id_<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['med_vac_id']; ?>">
                            <input type="hidden" name="med_vac_nom_<?php print $intContador; ?>" id="med_vac_nom_<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['med_vac_nom']; ?>">
                            <input type="hidden" name="med_vac_costo_<?php print $intContador; ?>" id="med_vac_costo_<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['med_vac_costo']; ?>">
                            <input type="hidden" name="med_vac_precio_<?php print $intContador; ?>" id="med_vac_precio_<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['med_vac_precio']; ?>">
                            <input type="hidden" name="med_vac_sali_<?php print $intContador; ?>" id="med_vac_sali_<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['med_vac_sali']; ?>">
                            <input type="hidden" name="med_vac_comp_<?php print $intContador; ?>" id="med_vac_comp_<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['med_vac_comp']; ?>">
                            <input type="hidden" name="med_vac_sal_act_<?php print $intContador; ?>" id="med_vac_sal_act_<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['med_vac_sal_act']; ?>">
                            <input type="hidden" name="med_vac_des_<?php print $intContador; ?>" id="med_vac_des_<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['med_vac_des']; ?>">
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
    } else if ($strTipoValidacion == "validacion_codigo") {

        $intData = isset($_GET["codigo"]) ? intval($_GET["codigo"]) : "";

        $boolExiste = false;
        if ($intData) {
            $var_consulta = pg_query($rmfAdm, "SELECT * FROM ctg_vacunas WHERE ctg_vac_id  = '$intData';");
            if ($row = pg_fetch_array($var_consulta)) {
                $idRow = trim($row[0]);
            }
            $vacuna_global = isset($idRow) ? $idRow  : 0;

            $var_consulta = pg_query($tmfMed, "SELECT * FROM $tablaVacunas WHERE med_vac_id  = '$intData';");
            if ($row = pg_fetch_array($var_consulta)) {
                $idRow = trim($row[0]);
            }
            $vacuna_med = isset($idRow) ? $idRow  : 0;

            if ($vacuna_global >= $val || $vacuna_med >= $val) {
                $boolExiste = true;
            } else {
                echo "Error: " . $var_consulta . "<br>";
            }
        }

        $strTextoFinal = $boolExiste ? "Y" : "N";
        print $strTextoFinal;
        die();
    }

    die();
}


?>
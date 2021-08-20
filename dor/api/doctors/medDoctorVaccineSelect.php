<?php
if (isset($_GET["validaciones"]) && !empty($_GET["validaciones"])) {
    require_once "../../data/conexion/tmlMed.php";
    $usuario =  $_SESSION['adm_usr_id'];
    $idUser = $_SESSION['adm_usr_code'];

    //TABLA DE INTERACCION
    $tablaVacunas = "med".$idUser."vacunas";

    $insert = 1;
    $update = 2;
    $delete = 3;    

    $id = isset($_POST["id"]) ? $_POST["id"]  : '';
    $med_vac_id_ = isset($_POST["codigo"]) ? $_POST["codigo"]  : '';
    $med_vac_nom_ = isset($_POST["nombre"]) ? $_POST["nombre"]  : '';
    $med_vac_costo_ = isset($_POST["costo"]) ? $_POST["costo"]  :0;
    $med_vac_precio_ = isset($_POST["precio_venta"]) ? $_POST["precio_venta"]  :0;
    $med_vac_sali_ = isset($_POST["saldo_inicial"]) ? $_POST["saldo_inicial"]  :0;
    $med_vac_comp_ = isset($_POST["compra"]) ? $_POST["compra"]  : 0;
    $med_vac_vent_ = isset($_POST["venta"]) ? $_POST["venta"]  : 0;
    $med_vac_sal_act_ = isset($_POST["saldo_actual"]) ? $_POST["saldo_actual"]  :0;
    $med_vac_des_ = isset($_POST["descripcion"]) ? $_POST["descripcion"]  : '';

    $rs = pg_query("SELECT count(*)FROM $tablaVacunas");
    if ($row = pg_fetch_row($rs)) {
        $idRow = trim($row[0]);
    }
    $idMax = $idRow + 1;

    $status = 1;
    $fechaIng = date('Y-m-d H:i:s');
    
    $val = 1;
    $strTipoValidacion = isset($_REQUEST["validaciones"]) ? $_REQUEST["validaciones"] : '';
    if ($strTipoValidacion == "insert") {
        header('Content-Type: application/json');
            $var_consulta = "INSERT INTO $tablaVacunas(med_vac_id,med_vac_nom,med_vac_des,med_vac_costo,med_vac_precio,med_vac_sali,med_vac_comp,med_vac_vent,med_vac_sta,med_vac_dt,med_vac_usr,med_vac_sal_act,med_vac_vent_precio,id) VALUES ($med_vac_id_,'$med_vac_nom_','$med_vac_des_',$med_vac_costo_,$med_vac_precio_,$med_vac_sali_,$med_vac_comp_,$med_vac_vent_,'$status','$fechaIng','$usuario',$med_vac_sal_act_,$med_vac_precio_,$idMax);";
            $val = 1;
            if (pg_query($tmfMed, $var_consulta)) {
                $arrInfo['status'] = $val;
            } else {
                $arrInfo['status'] = 0;
                
                $arrInfo['error'] = $var_consulta;
            }
        print json_encode($arrInfo);
        die();
    } else if ($strTipoValidacion == "update") {
        header('Content-Type: application/json');
        $var_consulta =" UPDATE $tablaVacunas SET med_vac_id  = $med_vac_id_,med_vac_nom = '$med_vac_nom_',med_vac_des = '$med_vac_des_',med_vac_costo = $med_vac_costo_,med_vac_precio = $med_vac_precio_,med_vac_sali = $med_vac_sali_,med_vac_comp = $med_vac_comp_,med_vac_vent = $med_vac_vent_,med_vac_sta = '$status',med_vac_dt = '$fechaIng',med_vac_usr = '$usuario',med_vac_sal_act = $med_vac_sal_act_,med_vac_vent_precio = $med_vac_precio_ WHERE id = $id;";
        if (pg_query($tmfMed, $var_consulta)) {
            $arrInfo['status'] = $val;
        } else {
            $arrInfo['status'] = 0;
            $arrInfo['error'] = $var_consulta;
        }
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
    }

    //DIBUJO DE TABLA PRODUCTOS CATEGORIAS
    else if ($strTipoValidacion == "busqueda_vaccineBuyList") {
        $strSearch = isset($_POST["Search"]) ? $_POST["Search"]  : '';

        $strFilter = "";
        if (!empty($strSearch)) {
            $strFilter = " AND ( UPPER(med_vam_fac) LIKE '%{$strSearch}%' ) ";
        }

        $med = $idUser;
        $numVacBuy = "med".$med."vacunas_compras";
        $numVac = "med" . $med . "vacunas";
        $arrTableVaccineBuy = array();
        $var_consulta = "SELECT *
                            FROM $numVacBuy com
                            INNER JOIN $numVac vac
                            ON com.med_vam_id = vac.med_vac_id
                            ORDER BY com.id DESC";
        $sql = pg_query($tmfMed, $var_consulta);
        $totalArticleVacBuy = pg_num_rows($sql);


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
        }
        pg_free_result($sql);

?>
        <div class="col-md-12 tableFixHead">
            <table id="tableVaccine" class="table table-bordered table-striped table-hover table-sm">
                <thead>
                    <tr class="table-info">
                        <th>No. Factura</th>
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
    } 

    else if ($strTipoValidacion == "busqueda_tableVaccine") {
        $strSearch = isset($_POST["Search"]) ? $_POST["Search"]  : '';

        $strFilter = "";
        if (!empty($strSearch)) {
            $strFilter = " AND ( UPPER(med_vac_nom) LIKE '%{$strSearch}%' ) ";
        }

        $med = $idUser;
        $numVac = "med" . $med . "vacunas";
        $arrTableVaccine = array();
        $var_consulta = "SELECT * FROM $numVac ORDER BY id DESC ";
        $sql = pg_query($tmfMed, $var_consulta);
        $totalArticleVac = pg_num_rows($sql);


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
                        <th>Nombre de la Vcuna</th>
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
                                <td style="cursor:pointer; color:white; background:cadetblue; text-align:center;" ><i class="fas fa-2x fa-band-aid"></i></td>
                            </tr>

                            <input type="hidden" name="id_<?php print $intContador; ?>" id="id_<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['id']; ?>">
                            <input type="hidden" name="med_vac_id_<?php print $intContador; ?>" id="med_vac_id_<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['med_vac_id']; ?>">
                            <input type="hidden" name="med_vac_nom_<?php print $intContador; ?>" id="med_vac_nom_<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['med_vac_nom']; ?>">
                            <input type="hidden" name="med_vac_costo_<?php print $intContador; ?>" id="med_vac_costo_<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['med_vac_costo']; ?>">
                            <input type="hidden" name="med_vac_precio_<?php print $intContador; ?>" id="med_vac_precio_<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['med_vac_precio']; ?>">
                            <input type="hidden" name="med_vac_sali_<?php print $intContador; ?>" id="med_vac_sali_<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['med_vac_sali']; ?>">
                            <input type="hidden" name="med_vac_comp_<?php print $intContador; ?>" id="med_vac_comp_<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['med_vac_comp']; ?>">
                            <input type="hidden" name="med_vac_vent_<?php print $intContador; ?>" id="med_vac_vent_<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['med_vac_vent']; ?>">
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
    }

    else if ($strTipoValidacion == "validacion_codigo") {

        $intData = isset($_GET["codigo"]) ? intval($_GET["codigo"]) : "";

        $boolExiste = false;

        if ($intData) {

            $var_consulta = "SELECT * FROM $tablaVacunas WHERE med_vac_id  = '$intData'";
            if (pg_query($rmfAdm, $var_consulta)) {
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
<?php
if (isset($_GET["validaciones"]) && !empty($_GET["validaciones"])) {
    require_once "../../data/conexion/tmlMed.php";
    $usuario = $_SESSION['adm_usr_id'];
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
    else if ($strTipoValidacion == "busqueda_table_med") {
        require_once "../../data/conexion/tmfAdm.php";
        $strSearch = isset($_POST["Search"]) ? $_POST["Search"]  : '';

        $strFilter = "";
        if (!empty($strSearch)) {
            $strFilter = " AND ( UPPER(pro.ctg_pro_desc) LIKE '%{$strSearch}%',UPPER(pro.ctg_pro_prinact) LIKE '%{$strSearch}%' ) ";
        }

        $arrTableMed = array();
        $var_consulta = "SELECT pro.*, fab.*
                        FROM ctg_productos pro
                        INNER JOIN ctg_fabricantes fab
                        ON pro.ctg_pro_labfar = fab.ctg_fab_id
                        ORDER BY pro.ctg_pro_desc
                        LIMIT 1000";
        $sql = pg_query($rmfAdm, $var_consulta);
        $totalArticle = pg_num_rows($sql);


        while ($rTMP = pg_fetch_assoc($sql)) {

            $arrTableMed[$rTMP["id"]]["id"]                       = $rTMP["id"];
            $arrTableMed[$rTMP["id"]]["ctg_pro_cod"]              = $rTMP["ctg_pro_cod"];
            $arrTableMed[$rTMP["id"]]["ctg_pro_desc"]             = $rTMP["ctg_pro_desc"];
            $arrTableMed[$rTMP["id"]]["ctg_pro_prinact"]          = $rTMP["ctg_pro_prinact"];
            $arrTableMed[$rTMP["id"]]["ctg_pro_indi"]             = $rTMP["ctg_pro_indi"];
            $arrTableMed[$rTMP["id"]]["ctg_pro_labfar"]           = $rTMP["ctg_pro_labfar"];
            $arrTableMed[$rTMP["id"]]["ctg_pro_fecaut"]           = $rTMP["ctg_pro_fecaut"];
            $arrTableMed[$rTMP["id"]]["ctg_pro_fecven"]           = $rTMP["ctg_pro_fecven"];
            $arrTableMed[$rTMP["id"]]["ctg_pro_psinar"]           = $rTMP["ctg_pro_psinar"];
            $arrTableMed[$rTMP["id"]]["ctg_fab_desc"]           = $rTMP["ctg_fab_desc"];
        }
        pg_free_result($sql);

        ?>
        <div class="col-md-12 tableFixHead">
            <table id="tableHosp" class="table table-bordered table-striped table-hover table-sm">
                <thead>
                    <tr class="table-info">
                        <th>No. de Registro</th>
                        <th>Nombre</th>
                        <th>Principio Activo</th>
                        <th>Fabricante</th>
                        <th>Ficha Tecnica</th>
                        <th>Vence</th>
                        <th>FarmaciasSSS</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (is_array($arrTableMed) && (count($arrTableMed) > 0)) {
                        reset($arrTableMed);
                        foreach ($arrTableMed as $rTMP['key'] => $rTMP['value']) {
                    ?>
                            <tr>
                                <td><?php echo  $rTMP["value"]['ctg_pro_cod']; ?></td>
                                <td><?php echo  $rTMP["value"]['ctg_pro_desc']; ?></td>
                                <td><?php echo  $rTMP["value"]['ctg_pro_prinact']; ?></td>
                                <td><?php echo  $rTMP["value"]['ctg_fab_desc']; ?></td>
                                <td style="cursor:pointer; text-align:center;"><i class="fad fa-2x fa-eye"></i></td>
                                <td><?php echo  $rTMP["value"]['ctg_pro_fecven']; ?></td>
                                <td style="cursor:pointer; color:white; background:cadetblue; text-align:center;" ><i class="fas fa-2x fa-band-aid"></i></td>
                            </tr>

                            <input type="hidden" name="info" value="<?php echo  $rTMP["value"]['ctg_pro_indi']; ?>">
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

    else if ($strTipoValidacion == "busqueda_table_far") {
        require_once "../../data/conexion/tmfAdm.php";
        $strSearch = isset($_POST["Search"]) ? $_POST["Search"]  : '';

        $strFilter = "";
        if (!empty($strSearch)) {
            $strFilter = " AND ( UPPER(ctg_far_nomcom) LIKE '%{$strSearch}%' ) ";
        }

        $arrTableFarmac = array();
        $var_consulta = "SELECT * FROM ctg_farmacias ORDER BY id ";
        $sql = pg_query($rmfAdm, $var_consulta);
        $totalArticle = pg_num_rows($sql);


        while ($rTMP = pg_fetch_assoc($sql)) {

            $arrTableFarmac[$rTMP["id"]]["id"]                       = $rTMP["id"];
            $arrTableFarmac[$rTMP["id"]]["ctg_far_contrato"]         = $rTMP["ctg_far_contrato"];
            $arrTableFarmac[$rTMP["id"]]["ctg_far_nit"]              = $rTMP["ctg_far_nit"];
            $arrTableFarmac[$rTMP["id"]]["ctg_far_nomcom"]           = $rTMP["ctg_far_nomcom"];
            $arrTableFarmac[$rTMP["id"]]["ctg_far_suc"]              = $rTMP["ctg_far_suc"];
            $arrTableFarmac[$rTMP["id"]]["ctg_far_code"]             = $rTMP["ctg_far_code"];
            $arrTableFarmac[$rTMP["id"]]["ctg_far_servicio"]         = $rTMP["ctg_far_servicio"];
            $arrTableFarmac[$rTMP["id"]]["ctg_far_hortda1"]          = $rTMP["ctg_far_hortda1"];
            $arrTableFarmac[$rTMP["id"]]["ctg_far_hortda2"]          = $rTMP["ctg_far_hortda2"];
            $arrTableFarmac[$rTMP["id"]]["ctg_far_serdom1"]          = $rTMP["ctg_far_serdom1"];
            $arrTableFarmac[$rTMP["id"]]["ctg_far_serdom2"]          = $rTMP["ctg_far_serdom2"];
            $arrTableFarmac[$rTMP["id"]]["ctg_far_dir"]              = $rTMP["ctg_far_dir"];
            $arrTableFarmac[$rTMP["id"]]["ctg_far_zona"]             = $rTMP["ctg_far_zona"];
            $arrTableFarmac[$rTMP["id"]]["ctg_far_dep"]              = $rTMP["ctg_far_dep"];
            $arrTableFarmac[$rTMP["id"]]["ctg_far_mun"]              = $rTMP["ctg_far_mun"];
            $arrTableFarmac[$rTMP["id"]]["ctg_far_tels"]             = $rTMP["ctg_far_tels"];
            $arrTableFarmac[$rTMP["id"]]["ctg_far_email"]            = $rTMP["ctg_far_email"];
            $arrTableFarmac[$rTMP["id"]]["ctg_far_enc_dpi"]          = $rTMP["ctg_far_enc_dpi"];
            $arrTableFarmac[$rTMP["id"]]["ctg_far_enc_nombre"]       = $rTMP["ctg_far_enc_nombre"];
            $arrTableFarmac[$rTMP["id"]]["ctg_far_enc_sexo"]         = $rTMP["ctg_far_enc_sexo"];
            $arrTableFarmac[$rTMP["id"]]["ctg_far_enc_edad"]         = $rTMP["ctg_far_enc_edad"];
            $arrTableFarmac[$rTMP["id"]]["ctg_far_enc_cel"]          = $rTMP["ctg_far_enc_cel"];
            $arrTableFarmac[$rTMP["id"]]["ctg_far_username"]         = $rTMP["ctg_far_username"];
            $arrTableFarmac[$rTMP["id"]]["ctg_far_pass"]             = $rTMP["ctg_far_pass"];
            $arrTableFarmac[$rTMP["id"]]["ctg_far_estatus"]          = $rTMP["ctg_far_estatus"];
            $arrTableFarmac[$rTMP["id"]]["ctg_far_censuc"]           = $rTMP["ctg_far_censuc"];
            $arrTableFarmac[$rTMP["id"]]["ctg_far_sol_dt"]           = $rTMP["ctg_far_sol_dt"];
            $arrTableFarmac[$rTMP["id"]]["ctg_far_aut_dt"]           = $rTMP["ctg_far_aut_dt"];
            $arrTableFarmac[$rTMP["id"]]["ctg_far_ven_dt"]           = $rTMP["ctg_far_ven_dt"];
            $arrTableFarmac[$rTMP["id"]]["ctg_far_sta"]              = $rTMP["ctg_far_sta"];
            $arrTableFarmac[$rTMP["id"]]["ctg_far_dt"]               = $rTMP["ctg_far_dt"];
            $arrTableFarmac[$rTMP["id"]]["ctg_far_usr"]              = $rTMP["ctg_far_usr"];
        }
        pg_free_result($sql);

    ?>
        <div class="col-md-12 tableFixHead">
            <table id="tableFarmac" class="table table-bordered table-striped table-hover table-sm">
                <thead>
                    <tr class="table-info">
                        <th>Farmacia</th>
                        <th>Sucursal</th>
                        <th>Direccion</th>
                        <th>Telefono</th>
                        <th>Medicamento</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (is_array($arrTableFarmac) && (count($arrTableFarmac) > 0)) {
                        reset($arrTableFarmac);
                        foreach ($arrTableFarmac as $rTMP['key'] => $rTMP['value']) {
                    ?>
                            <tr>
                                <td><?php echo  $rTMP["value"]['ctg_far_nomcom']; ?></td>
                                <td><?php echo  $rTMP["value"]['ctg_far_suc']; ?></td>
                                <td><?php echo  $rTMP["value"]['ctg_far_dir']; ?></td>
                                <td><?php echo  $rTMP["value"]['ctg_far_tels']; ?></td>
                                <td style="cursor:pointer; color:white; background:cadetblue; text-align:center;" ><i class="fas fa-2x fa-band-aid"></i></td>
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
<?php
if (isset($_GET["validaciones"]) && !empty($_GET["validaciones"])) {
    require_once "../../data/conexion/tmlMed.php";
    $usuario = $_SESSION['adm_usr_id'];
    $idUser = $_SESSION['adm_usr_code'];

    //TABLA DE INTERACCION
    $tablaCitas = "med" . $idUser . "citas";

    $insert = 1;
    $update = 2;
    $delete = 3;

    $med_vac_id_ = isset($_POST["codigo"]) ? $_POST["codigo"]  : '';
    $med_vac_nom_ = isset($_POST["nombre"]) ? $_POST["nombre"]  : '';
    $med_vac_costo_ = isset($_POST["costo"]) ? $_POST["costo"]  : 0;
    $med_vac_precio_ = isset($_POST["precio_venta"]) ? $_POST["precio_venta"]  : 0;
    $med_vac_sali_ = isset($_POST["saldo_inicial"]) ? $_POST["saldo_inicial"]  : 0;
    $med_vac_comp_ = isset($_POST["compra"]) ? $_POST["compra"]  : 0;
    $med_vac_vent_ = isset($_POST["venta"]) ? $_POST["venta"]  : 0;
    $med_vac_sal_act_ = isset($_POST["saldo_actual"]) ? $_POST["saldo_actual"]  : 0;
    $med_vac_des_ = isset($_POST["descripcion"]) ? $_POST["descripcion"]  : '';

    $rs = pg_query("SELECT count(*)FROM $tablaCitas");
    if ($row = pg_fetch_row($rs)) {
        $idRow = trim($row[0]);
    }
    $idMax = $idRow + 1;

    $status = 1;
    $fechaIng = date('Y-m-d H:i:s');

    $strTipoValidacion = isset($_REQUEST["validaciones"]) ? $_REQUEST["validaciones"] : '';
    if ($strTipoValidacion == "insert") {
        header('Content-Type: application/json');
        $var_consulta = "INSERT INTO $tablaCitas(med_vac_id,med_vac_nom,med_vac_des,med_vac_costo,med_vac_precio,med_vac_sali,med_vac_comp,med_vac_vent,med_vac_sta,med_vac_dt,med_vac_usr,med_vac_sal_act,med_vac_vent_precio,id) VALUES ($med_vac_id_,'$med_vac_nom_','$med_vac_des_',$med_vac_costo_,$med_vac_precio_,$med_vac_sali_,$med_vac_comp_,$med_vac_vent_,'$status','$fechaIng','$usuario',$med_vac_sal_act_,$med_vac_precio_,$idMax);";
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
        $var_consulta = " UPDATE $tablaVacunas 
                        SET $med_vac_id_,
                        '$med_vac_nom_',
                        '$med_vac_des_',
                        $med_vac_costo_,
                        $med_vac_precio_,
                        $med_vac_sali_,
                        $med_vac_comp_,
                        $med_vac_vent_,
                        '$status',
                        '$fechaIng',
                        '$usuario',
                        $med_vac_sal_act_,
                        $med_vac_precio_,
                        $idMax
                        WHERE id = $med_vac_id_;";
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
        $var_consulta = "DELETE FROM $tablaVacunas WHERE id = $med_vac_id_;";
        if (pg_query($tmfMed, $var_consulta)) {
            $arrInfo['status'] = $val;
        } else {
            $arrInfo['status'] = 0;
            $arrInfo['error'] = $var_consulta;
        }
        print json_encode($arrInfo);
        die();
    } else if ($strTipoValidacion == "busqueda_table") {
        $strSearch = isset($_POST["Search"]) ? $_POST["Search"]  : '';

        $strFilter = "";
        if (!empty($strSearch)) {
            $strFilter = " WHERE ( UPPER(med_pac_nom) LIKE '%{$strSearch}%' ) ";
        }

        $idPac = $_GET['cod'];
        $idPac =  decrypt($idPac, $key);
        $idPac = isset($idPac) ? $idPac  : '';

        $idUser = $_SESSION['adm_usr_code'];

        $med = $idUser;
        $pac = $idUser;

        if ($idPac) {
            $numMed = "med" . $med . "citas";
            $numPac = "med" . $pac . "pacientes";
            $arrTableCita = array();
            $var_consulta = "SELECT cita.id idcita, cita.med_cit_id, cita.med_cit_cita_dt, cita.med_cit_pac_id, cita.med_cit_motivo, cita.med_cit_sta, cita.med_cit_estatus, pac.med_pac_code, pac.med_pac_nom
                            FROM $numMed AS cita 
                            INNER JOIN $numPac AS pac
                            ON cita.med_cit_pac_id=pac.id
                            $strFilter
                            ORDER BY cita.med_cit_cita_dt;";
            $sql = pg_query($tmfMed, $var_consulta);
            $totalArticle = pg_num_rows($sql);


            while ($rTMP = pg_fetch_assoc($sql)) {

                $arrTableCita[$rTMP["idcita"]]["idcita"]                   = $rTMP["idcita"];
                $arrTableCita[$rTMP["idcita"]]["med_cit_id"]               = $rTMP["med_cit_id"];
                $arrTableCita[$rTMP["idcita"]]["med_cit_cita_dt"]          = $rTMP["med_cit_cita_dt"];
                $arrTableCita[$rTMP["idcita"]]["med_cit_pac_id"]           = $rTMP["med_cit_pac_id"];
                $arrTableCita[$rTMP["idcita"]]["med_cit_motivo"]           = $rTMP["med_cit_motivo"];
                $arrTableCita[$rTMP["idcita"]]["med_cit_estatus"]          = $rTMP["med_cit_estatus"];
                $arrTableCita[$rTMP["idcita"]]["med_cit_sta"]              = $rTMP["med_cit_sta"];
                $arrTableCita[$rTMP["idcita"]]["med_pac_code"]             = $rTMP["med_pac_code"];
                $arrTableCita[$rTMP["idcita"]]["med_pac_nom"]              = $rTMP["med_pac_nom"];
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
                                    <td class="table-info">
                                        <i title="ver " class="fad fa-eye" style="cursor:pointer;" onclick="fntSelectView('<?php print $intContador; ?>');"></i>
                                        <i class="fad fa-user-minus " id="delete" onclick="fntDelete() "></i>
                                        <i class="fad fa-user-edit" style="cursor:pointer;" onclick="fntSelectEdit('<?php print $intContador; ?>');"></i>
                                    </td>
                                </tr>

                                <input type="hidden" name="med_vac_id_<?php print $intContador; ?>" id="med_vac_id_<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['med_vac_id']; ?>">
                                <input type="hidden" name="med_vac_nom_<?php print $intContador; ?>" id="med_vac_nom_<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['med_vac_nom']; ?>">
                                <input type="hidden" name="med_vac_costo_<?php print $intContador; ?>" id="med_vac_costo_<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['med_vac_costo']; ?>">
                                <input type="hidden" name="med_vac_precio_<?php print $intContador; ?>" id="med_vac_precio_<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['med_vac_precio']; ?>">
                                <input type="hidden" name="med_vac_sali_<?php print $intContador; ?>" id="med_vac_sali_<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['med_vac_sali']; ?>">
                                <input type="hidden" name="med_vac_comp_<?php print $intContador; ?>" id="med_vac_comp_<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['med_vac_comp']; ?>">
                                <input type="hidden" name="med_vac_vent_<?php print $intContador; ?>" id="med_vac_vent_<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['med_vac_vent']; ?>">
                                <input type="hidden" name="med_vac_sal_act_<?php print $intContador; ?>" id="med_vac_sal_act_<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['med_vac_sal_act']; ?>">
                                <input type="hidden" name="med_vac_des_<?php print $intContador; ?>" id="med_vac_des_       <?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['med_vac_des']; ?>">
                        <?PHP
                                $intContador++;
                            }
                        }
                        ?>
                    </tbody>
                </table>
            </div>
<?php
        }

        die();
    } else if ($strTipoValidacion == "validacion_codigo") {

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


<?php require_once "../../data/conexion/tmlMed.php"; ?>

<?php



?>
<?php
if (isset($_GET["validaciones"]) && !empty($_GET["validaciones"])) {
    require_once "../../data/conexion/tmlMed.php";
    $idUser = $_SESSION['adm_usr_id'];
    //TABLA DE INTERACCION

    $med_vac_id_ = isset($_POST["idDiet"]) ? $_POST["idDiet"]  : 0;
    $med_vac_nom_ = isset($_POST["nombre"]) ? $_POST["nombre"]  : '';
    $med_vac_des_ = isset($_POST["descripcion"]) ? $_POST["descripcion"]  : '';


    $lab_ord_cod = isset($_POST["id_orden"]) ? $_POST["id_orden"]  : '';


    $status = 1;
    $fechaIng = date('Y-m-d H:i:s');

    $strTipoValidacion = isset($_REQUEST["validaciones"]) ? $_REQUEST["validaciones"] : '';
    if ($strTipoValidacion == "insert") {
        header('Content-Type: application/json');
        $var_consulta = "INSERT INTO $tablaVacunas(med_die_id,med_die_nom,med_die_des,med_die_sta,med_die_dt,med_die_usr,id) VALUES ($idMax,'$med_vac_nom_','$med_vac_des_','1','$fechaIng','$usuario',$idMax);";
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
        $orden = "lab" . $idUser . "orden";
        $var_consulta = "UPDATE $orden 
                        SET lab_ord_est = '2',
                        WHERE lab_ord_cod = $lab_ord_cod;";
        $val = 1;
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
        $val = 1;
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
    else if ($strTipoValidacion == "busqueda_table") {
        $Code = $_SESSION['adm_usr_code'];

        require_once "../../data/conexion/tmfLab.php";
        require_once "../../data/conexion/tmfAdm.php";
        $orden = "lab" . $Code . "orden";
        $prod = "lab" . $Code . "orden_items";
        $arrTableConsulta = array();
        $var_consulta = "SELECT to_char(orden.lab_ord_dt::date,'DD-MM-YYYY') fecha, orden.* , prod.* 
                        FROM $orden orden
                        INNER JOIN $prod prod
                        ON orden.lab_ord_cod = prod.lab_ori_cod
                        ORDER BY orden.lab_ord_fec";
        $sql = pg_query($tmfLab, $var_consulta);
        //print_r($var_consulta);
        $totalArticle = pg_num_rows($sql);

        while ($rTMP = pg_fetch_assoc($sql)) {
            //ORDENES
            $arrTableConsulta[$rTMP["lab_ord_cod"]]["lab_ord_cod"]                   = $rTMP["lab_ord_cod"];
            $arrTableConsulta[$rTMP["lab_ord_cod"]]["lab_ord_cod"]                   = $rTMP["lab_ord_cod"];
            $arrTableConsulta[$rTMP["lab_ord_cod"]]["lab_ord_tipo"]                   = $rTMP["lab_ord_tipo"];
            $arrTableConsulta[$rTMP["lab_ord_cod"]]["lab_ord_fec"]                   = $rTMP["lab_ord_fec"];
            $arrTableConsulta[$rTMP["lab_ord_cod"]]["lab_ord_med_id"]                   = $rTMP["lab_ord_med_id"];
            $arrTableConsulta[$rTMP["lab_ord_cod"]]["lab_ord_pac_id"]                   = $rTMP["lab_ord_pac_id"];
            $arrTableConsulta[$rTMP["lab_ord_cod"]]["lab_ord_pac_nombre"]                   = $rTMP["lab_ord_pac_nombre"];
            $arrTableConsulta[$rTMP["lab_ord_cod"]]["lab_ord_pac_mem_id"]                   = $rTMP["lab_ord_pac_mem_id"];
            $arrTableConsulta[$rTMP["lab_ord_cod"]]["lab_ord_valor"]                   = $rTMP["lab_ord_valor"];
            $arrTableConsulta[$rTMP["lab_ord_cod"]]["lab_ord_valor_desl"]                   = $rTMP["lab_ord_valor_desl"];
            $arrTableConsulta[$rTMP["lab_ord_cod"]]["lab_ord_valor_iva"]                   = $rTMP["lab_ord_valor_iva"];
            $arrTableConsulta[$rTMP["lab_ord_cod"]]["lab_ord_total"]                   = $rTMP["lab_ord_total"];
            $arrTableConsulta[$rTMP["lab_ord_cod"]]["lab_ord_est"]                   = $rTMP["lab_ord_est"];
            $arrTableConsulta[$rTMP["lab_ord_cod"]]["lab_ord_sta"]                   = $rTMP["lab_ord_sta"];
            $arrTableConsulta[$rTMP["lab_ord_cod"]]["fecha"]                   = $rTMP["fecha"];
            $arrTableConsulta[$rTMP["lab_ord_cod"]]["lab_ord_usr"]                   = $rTMP["lab_ord_usr"];

            //ARTICULOS
            $arrTableConsulta[$rTMP['lab_ord_cod']]['accesos'][$rTMP['lab_ori_cod']]['lab_ori_cod']        = $rTMP['lab_ori_cod'];
            $arrTableConsulta[$rTMP['lab_ord_cod']]['accesos'][$rTMP['lab_ori_cod']]['lab_ori_exa_id']        = $rTMP['lab_ori_exa_id'];
            $arrTableConsulta[$rTMP['lab_ord_cod']]['accesos'][$rTMP['lab_ori_cod']]['lab_ori_pre']        = $rTMP['lab_ori_pre'];
            $arrTableConsulta[$rTMP['lab_ord_cod']]['accesos'][$rTMP['lab_ori_cod']]['lab_ori_can']        = $rTMP['lab_ori_can'];
            $arrTableConsulta[$rTMP['lab_ord_cod']]['accesos'][$rTMP['lab_ori_cod']]['lab_ori_desl']        = $rTMP['lab_ori_desl'];
            $arrTableConsulta[$rTMP['lab_ord_cod']]['accesos'][$rTMP['lab_ori_cod']]['lab_ori_valor']        = $rTMP['lab_ori_valor'];
            $arrTableConsulta[$rTMP['lab_ord_cod']]['accesos'][$rTMP['lab_ori_cod']]['lab_ori_sta']        = $rTMP['lab_ori_sta'];
            $arrTableConsulta[$rTMP['lab_ord_cod']]['accesos'][$rTMP['lab_ori_cod']]['lab_ori_dt']        = $rTMP['lab_ori_dt'];
            $arrTableConsulta[$rTMP['lab_ord_cod']]['accesos'][$rTMP['lab_ori_cod']]['lab_ori_usr']        = $rTMP['lab_ori_usr'];
        }
        pg_free_result($sql);
?>

        <div class="col-md-12 tableFixHead">
            <div class="row">
                <div class="col-2"></div>
                <div class="col-8">
                    <table id="tableVaccine" class="table table-bordered table-striped table-hover table-sm">
                        <thead>
                            <tr class="table-info">
                                <th width="5%">Orden</th>
                                <th width="5%">Fecha</th>
                                <th width="20%">Nombre</th>
                                <th width="5%">Valor Total</th>
                                <th width="2%">Detalle</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (is_array($arrTableConsulta) && (count($arrTableConsulta) > 0)) {
                                $intContador = 1;
                                reset($arrTableConsulta);
                                foreach ($arrTableConsulta as $keyA => $valueA) {
                                    $boolHasAccesos = isset($valueA["accesos"]) && is_array($valueA["accesos"]) && (count($valueA["accesos"]) > 0);

                                    $idPac = isset($valueA['lab_ord_pac_id']) ?  $valueA['lab_ord_pac_id']  : '';

                            ?>
                                    <tr>
                                        <td><?php echo  $valueA['lab_ord_cod']; ?></td>
                                        <td><?php echo  $valueA['fecha']; ?></td>
                                        <td><?php echo  $valueA['lab_ord_pac_nombre']; ?></td>
                                        <td><?php echo  $valueA['lab_ord_total']; ?></td>
                                        <td data-toggle="modal" data-target="#ModalOrderMedicament<?php echo  $valueA['lab_ord_cod']; ?>">
                                            <i title="ver " class="fad fa-eye fa-2x" style="cursor:pointer;"></i>
                                        </td>
                                    </tr>

                                    <input type="hidden" name="hidId_<?php print $intContador; ?>" id="hidId_<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['lab_ord_cod']; ?>">
                            <?php
                                    $intContador++;
                                }
                            }

                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <?php
        if (is_array($arrTableConsulta) && (count($arrTableConsulta) > 0)) {
            $intContador = 1;
            reset($arrTableConsulta);
            foreach ($arrTableConsulta as $keyA => $valueA) {
                $boolHasAccesos = isset($valueA["accesos"]) && is_array($valueA["accesos"]) && (count($valueA["accesos"]) > 0);
                ?>
        <div class="modal fade" id="ModalOrderMedicament<?php echo  $valueA['lab_ord_cod']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title w-100" id="myModalLabel">EXAMENES</h4>
                        <button type="button" class="CERRAR" data-dismiss="modal" aria-label="CERRAR">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="card-primary collapsed-card">
                            <div class="card-body">
                                <div class="div1">
                                    <div class="tableFixHead">
                                        <table id="" class="table table-bordered table-striped table-hover table-sm">
                                            <thead>
                                                <tr class="table-info">
                                                    <th width="80%">Nombre</th>
                                                    <th width="10%">Precio</th>
                                                    <th width="5%"> Cantidad</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            <?php
                                                        if ($boolHasAccesos) {
                                                            reset($valueA["accesos"]);
                                                            foreach ($valueA["accesos"] as $keyB => $valueB) {
                                                                $ori_id = $valueB['lab_ori_exa_id'];

                                                                $rsFar = pg_query($rmfAdm, "SELECT ctg_exa_descrip FROM ctg_examenes WHERE ctg_exa_code = '$ori_id' LIMIT 1");
                                                               // print_r($rsFar);

                                                                if ($row = pg_fetch_array($rsFar)) {
                                                                    $idRowCode = trim($row[0]);
                                                                }
                                                                $descrip = isset($idRowCode) ? $idRowCode : "";
                                                ?>
                                                                <tr>
                                                                    <td><?php echo  $descrip; ?></td>
                                                                    <td><?php echo  $valueB['lab_ori_pre']; ?></td>
                                                                    <td><?php echo  $valueB['lab_ori_can']; ?></td>
                                                                </tr>
                                                        <?php
                                                            }
                                                        }
                                                        ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">CERRAR</button>
                        <button class="btn btn-info btn-sm" onclick="fntSelectUpdate('<?php print $intContador; ?>');">Precesado</button>
                    </div>
                </div>
            </div>
        </div>
<?php
                                                    }
                                                }
?>
</div>
<?php

        die();
    }
}
?>
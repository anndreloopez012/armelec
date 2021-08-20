<?php
if (isset($_GET["validaciones"]) && !empty($_GET["validaciones"])) {
    require_once "../../data/conexion/tmlMed.php";
    $idUser = $_SESSION['adm_usr_code'];
    //TABLA DE INTERACCION

    $med_vac_id_ = isset($_POST["idDiet"]) ? $_POST["idDiet"]  : 0;
    $med_vac_nom_ = isset($_POST["nombre"]) ? $_POST["nombre"]  : '';
    $med_vac_des_ = isset($_POST["descripcion"]) ? $_POST["descripcion"]  : '';


    $far_ord_id = isset($_POST["id_orden"]) ? $_POST["id_orden"]  : '';


    $status = 1;
    $fechaIng = date('Y-m-d H:i:s');

    $strTipoValidacion = isset($_REQUEST["validaciones"]) ? $_REQUEST["validaciones"] : '';
    if ($strTipoValidacion == "insert") {
        header('Content-Type: application/json');
        $var_consulta =     "INSERT INTO $tablaVacunas(med_die_id,med_die_nom,med_die_des,med_die_sta,med_die_dt,med_die_usr,id) VALUES ($idMax,'$med_vac_nom_','$med_vac_des_','1','$fechaIng','$usuario',$idMax);";
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
        $orden = "far" . $idUser . "orden";
        $var_consulta = "UPDATE $orden 
                        SET far_ord_est = '2',
                        WHERE far_ord_id = $far_ord_id;";
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
        $idWeb = $_SESSION['adm_usr_code'];
      
        require_once "../../data/conexion/tmlFar.php";
        require_once "../../data/conexion/tmfAdm.php";
        $orden = "far" . $idWeb . "orden";
        $prod = "far" . $idWeb . "orden_prod";
        $arrTableConsulta = array();
        $var_consulta = "SELECT to_char(orden.far_ord_dt::date,'DD-MM-YYYY') fecha, orden.* , prod.* 
                        FROM $orden orden
                        INNER JOIN $prod prod
                        ON orden.far_ord_cod = prod.far_orp_cod
                        ORDER BY orden.far_ord_fec";
        $sql = pg_query($tmfFar, $var_consulta);
        //print_r($idWeb);

        $totalArticle = pg_num_rows($sql);


        while ($rTMP = pg_fetch_assoc($sql)) {
            //ORDENES
            $arrTableConsulta[$rTMP["far_ord_id"]]["far_ord_id"]                   = $rTMP["far_ord_id"];
            $arrTableConsulta[$rTMP["far_ord_id"]]["far_ord_cod"]                   = $rTMP["far_ord_cod"];
            $arrTableConsulta[$rTMP["far_ord_id"]]["far_ord_tipo"]                   = $rTMP["far_ord_tipo"];
            $arrTableConsulta[$rTMP["far_ord_id"]]["far_ord_fec"]                   = $rTMP["far_ord_fec"];
            $arrTableConsulta[$rTMP["far_ord_id"]]["far_ord_med_id"]                   = $rTMP["far_ord_med_id"];
            $arrTableConsulta[$rTMP["far_ord_id"]]["far_ord_pac_id"]                   = $rTMP["far_ord_pac_id"];
            $arrTableConsulta[$rTMP["far_ord_id"]]["far_ord_pac_nombre"]                   = $rTMP["far_ord_pac_nombre"];
            $arrTableConsulta[$rTMP["far_ord_id"]]["far_ord_pac_mem_id"]                   = $rTMP["far_ord_pac_mem_id"];
            $arrTableConsulta[$rTMP["far_ord_id"]]["far_ord_por_fac"]                   = $rTMP["far_ord_por_fac"];
            $arrTableConsulta[$rTMP["far_ord_id"]]["far_ord_por_laf"]                   = $rTMP["far_ord_por_laf"];
            $arrTableConsulta[$rTMP["far_ord_id"]]["far_ord_valor"]                   = $rTMP["far_ord_valor"];
            $arrTableConsulta[$rTMP["far_ord_id"]]["far_ord_valor_desf"]                   = $rTMP["far_ord_valor_desf"];
            $arrTableConsulta[$rTMP["far_ord_id"]]["far_ord_valor_desl"]                   = $rTMP["far_ord_valor_desl"];
            $arrTableConsulta[$rTMP["far_ord_id"]]["far_ord_valor_iva"]                   = $rTMP["far_ord_valor_iva"];
            $arrTableConsulta[$rTMP["far_ord_id"]]["far_ord_total"]                   = $rTMP["far_ord_total"];
            $arrTableConsulta[$rTMP["far_ord_id"]]["far_ord_est"]                   = $rTMP["far_ord_est"];
            $arrTableConsulta[$rTMP["far_ord_id"]]["far_ord_sta"]                   = $rTMP["far_ord_sta"];
            $arrTableConsulta[$rTMP["far_ord_id"]]["fecha"]                   = $rTMP["fecha"];
            $arrTableConsulta[$rTMP["far_ord_id"]]["far_ord_usr"]                   = $rTMP["far_ord_usr"];

            //ARTICULOS
            $arrTableConsulta[$rTMP['far_ord_id']]['accesos'][$rTMP['far_orp_id']]['far_orp_id']        = $rTMP['far_orp_id'];
            $arrTableConsulta[$rTMP['far_ord_id']]['accesos'][$rTMP['far_orp_id']]['far_orp_cod']        = $rTMP['far_orp_cod'];
            $arrTableConsulta[$rTMP['far_ord_id']]['accesos'][$rTMP['far_orp_id']]['far_orp_pro_id']        = $rTMP['far_orp_pro_id'];
            $arrTableConsulta[$rTMP['far_ord_id']]['accesos'][$rTMP['far_orp_id']]['far_orp_pre']        = $rTMP['far_orp_pre'];
            $arrTableConsulta[$rTMP['far_ord_id']]['accesos'][$rTMP['far_orp_id']]['far_orp_can']        = $rTMP['far_orp_can'];
            $arrTableConsulta[$rTMP['far_ord_id']]['accesos'][$rTMP['far_orp_id']]['far_orp_desf']        = $rTMP['far_orp_desf'];
            $arrTableConsulta[$rTMP['far_ord_id']]['accesos'][$rTMP['far_orp_id']]['far_orp_desl']        = $rTMP['far_orp_desl'];
            $arrTableConsulta[$rTMP['far_ord_id']]['accesos'][$rTMP['far_orp_id']]['far_orp_valor']        = $rTMP['far_orp_valor'];
            $arrTableConsulta[$rTMP['far_ord_id']]['accesos'][$rTMP['far_orp_id']]['far_orp_sta']        = $rTMP['far_orp_sta'];
            $arrTableConsulta[$rTMP['far_ord_id']]['accesos'][$rTMP['far_orp_id']]['far_orp_dt']        = $rTMP['far_orp_dt'];
            $arrTableConsulta[$rTMP['far_ord_id']]['accesos'][$rTMP['far_orp_id']]['far_orp_usr']        = $rTMP['far_orp_usr'];
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
                                <th width="30%">Nombre</th>
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

                                    $idPac = isset($valueA['far_ord_pac_id']) ?  $valueA['far_ord_pac_id']  : '';
                            ?>
                                    <tr>
                                        <td><?php echo  $valueA['far_ord_cod']; ?></td>
                                        <td><?php echo  $valueA['fecha']; ?></td>
                                        <td><?php echo  $valueA['far_ord_pac_nombre']; ?></td>
                                        <td><?php echo  $valueA['far_ord_total']; ?></td>
                                        <td class="table-info" data-toggle="modal" data-target="#ModalOrderMedicament<?php echo  $valueA['far_ord_id']; ?>">
                                            <i title="ver " class="fad fa-eye fa-2x" style="cursor:pointer;"></i>
                                        </td>
                                    </tr>

                                    <input type="hidden" name="hidId_<?php print $intContador; ?>" id="hidId_<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['far_ord_id']; ?>">
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

                $idPac = isset($valueA['far_ord_pac_id']) ?  $valueA['far_ord_pac_id']  : '';
        ?>
                <div class="modal fade" id="ModalOrderMedicament<?php echo  $valueA['far_ord_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title w-100" id="myModalLabel">PRODUCTOS</h4>
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
                                                        <?PHP
                                                        if ($boolHasAccesos) {
                                                            reset($valueA["accesos"]);
                                                            foreach ($valueA["accesos"] as $keyB => $valueB) {
                                                                $ori_id = $valueB['far_orp_pro_id'];

                                                                $rsFar = pg_query($rmfAdm, "SELECT ctg_pro_desc FROM ctg_productos WHERE ctg_pro_cod = '$ori_id' LIMIT 1");
                                                                if ($row = pg_fetch_array($rsFar)) {
                                                                    $idRowCode = trim($row[0]);
                                                                }
                                                                $descrip = isset($idRowCode) ? $idRowCode : 0;
                                                                //print_r($ori_id);
                                                        ?>
                                                                <tr>
                                                                    <td><?php echo  $descrip; ?></td>
                                                                    <td><?php echo  $valueB['far_orp_pre']; ?></td>
                                                                    <td><?php echo  $valueB['far_orp_can']; ?></td>
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
                $intContador++;
            }
        }

        ?>
        </div>
        <?php
        ?>

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
    }

    die();
}


?>
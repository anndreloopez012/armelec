<?php
if (isset($_GET["validaciones"]) && !empty($_GET["validaciones"])) {
    require_once "../../data/conexion/tmfPac.php";
    $usuario = $_SESSION['adm_usr_id'];

    //TABLA DE INTERACCION
    $idUser = $_SESSION['adm_usr_code'];
    $Year = date('Y');
    $medic = "a" . $Year . "_medicos_consultas";

    $ctg__cit_id = isset($_POST["id"]) ? $_POST["id"]  : '';
    $ctg_cit_cita_dt = isset($_POST["fecha_consulta"]) ? $_POST["fecha_consulta"]  : 0000 - 00 - 00;
    $ctg_cit_cita_dt_prox = isset($_POST["fecha_consulta_prox"]) ? $_POST["fecha_consulta_prox"]  : 0000 - 00 - 00;
    $ctg_cit_med_id = isset($_POST["Medico_id"]) ? $_POST["Medico_id"]  : '';
    $ctg_cit_pac = $_SESSION['adm_usr_code'];
    $med_con_motivo = isset($_POST["Motivo"]) ? $_POST["Motivo"]  : '';
    $med_con_examen = isset($_POST["Examen"]) ? $_POST["Examen"]  : '';
    $med_con_receta = isset($_POST["Receta"]) ? $_POST["Receta"]  : '';
    $med_con_dieta = isset($_POST["Dieta"]) ? $_POST["Dieta"]  : '';
    $ctg_cit_estatus = "1";
    $status = 1;
    $fechaIng = date('Y-m-d H:i:s');
    $val = 1;
    $strTipoValidacion = isset($_REQUEST["validaciones"]) ? $_REQUEST["validaciones"] : '';
    if ($strTipoValidacion == "insert") {
        header('Content-Type: application/json');
        $var_consulta = "INSERT INTO $medic(med_con_med_id,med_con_pac_id,med_con_cita_dt,med_con_motivo,med_con_examen,med_con_receta,med_con_dieta,med_con_sta,med_con_dt,med_con_usr) VALUES ('$ctg_cit_med_id','$ctg_cit_pac','$ctg_cit_cita_dt','$med_con_motivo','$med_con_examen','$med_con_receta','$med_con_dieta','$status','$fechaIng','$idUser');";
        $val = 1;
        if (pg_query($tmfPac, $var_consulta)) {
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
            $strFilter = " AND ( UPPER(pro.ctg_pro_desc) LIKE '%{$strSearch}%',UPPER(pro.ctg_pro_prinact) LIKE '%{$strSearch}%' ) ";
        }

        $year = date('Y');;
        $Consulta = "a" . $year . "_medicos_consultas";
        $arrTableConsulta = array();
        $var_consulta = "SELECT  to_char(med_con_cita_dt::date,'DD-MM-YYYY') fecha,to_char(med_con_citap_dt::date,'DD-MM-YYYY') fecha_d,* 
                        FROM $Consulta 
                        WHERE med_con_pac_id = '$idUser'
                        ORDER BY fecha DESC";
        $sql = pg_query($tmfPac, $var_consulta);
        $totalArticle = pg_num_rows($sql);

        //print_r($var_consulta);



        while ($rTMP = pg_fetch_assoc($sql)) {

            $arrTableConsulta[$rTMP["med_con_id"]]["med_con_id"]                   = $rTMP["med_con_id"];
            $arrTableConsulta[$rTMP["med_con_id"]]["med_con_med_id"]                   = $rTMP["med_con_med_id"];
            $arrTableConsulta[$rTMP["med_con_id"]]["med_con_pac_id"]                   = $rTMP["med_con_pac_id"];
            $arrTableConsulta[$rTMP["med_con_id"]]["fecha"]                   = $rTMP["fecha"];
            $arrTableConsulta[$rTMP["med_con_id"]]["med_con_motivo"]                   = $rTMP["med_con_motivo"];
            $arrTableConsulta[$rTMP["med_con_id"]]["med_con_examen"]                   = $rTMP["med_con_examen"];
            $arrTableConsulta[$rTMP["med_con_id"]]["med_con_receta"]                   = $rTMP["med_con_receta"];
            $arrTableConsulta[$rTMP["med_con_id"]]["med_con_dieta"]                   = $rTMP["med_con_dieta"];
            $arrTableConsulta[$rTMP["med_con_id"]]["med_con_observa"]                   = $rTMP["med_con_observa"];
            $arrTableConsulta[$rTMP["med_con_id"]]["med_con_sta"]                   = $rTMP["med_con_sta"];
            $arrTableConsulta[$rTMP["med_con_id"]]["med_con_dt"]                   = $rTMP["med_con_dt"];
            $arrTableConsulta[$rTMP["med_con_id"]]["med_con_usr"]                   = $rTMP["med_con_usr"];
            $arrTableConsulta[$rTMP["med_con_id"]]["med_con_uni_id"]                   = $rTMP["med_con_uni_id"];
            $arrTableConsulta[$rTMP["med_con_id"]]["med_con_enf_id"]                   = $rTMP["med_con_enf_id"];
            $arrTableConsulta[$rTMP["med_con_id"]]["fecha_d"]                   = $rTMP["fecha_d"];
        }
        pg_free_result($sql);

?>
        <div class="col-md-12 tableFixHead">
            <table id="tableVaccine" class="table table-bordered table-striped table-hover table-sm">
                <thead>
                    <tr class="table-info">
                        <th width="10%">Orden</th>
                        <th width="10%">Fecha</th>
                        <th width="10%">Prox. Cita</th>
                        <th width="20%">Medico</th>
                        <th>Motivo</th>
                        <th width="5%">DETALLE DE LA CONSULTA</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (is_array($arrTableConsulta) && (count($arrTableConsulta) > 0)) {
                        $intContador = 1;
                        reset($arrTableConsulta);
                        foreach ($arrTableConsulta as $rTMP['key'] => $rTMP['value']) {
                            require_once "../../data/conexion/tmfAdm.php";

                            $enfermedad_id = $rTMP["value"]['med_con_enf_id'];
                            $rsFarEnfermedad = pg_query($rmfAdm, "SELECT ctg_enf_desc FROM ctg_enfermedades WHERE ctg_enf_cod = '$enfermedad_id' LIMIT 1");
                            //print_r($rsFar);
                            if ($row = pg_fetch_array($rsFarEnfermedad)) {
                                $idRowEnfer = trim($row[0]);
                            }
                            $enfermedad = isset($idRowEnfer) ? $idRowEnfer : '';

                            $ori_id = $rTMP["value"]['med_con_med_id'];
                            $rsFar = pg_query($rmfAdm, "SELECT ctg_med_nombres , ctg_med_apellidos FROM ctg_medicos WHERE ctg_med_code = '$ori_id' LIMIT 1");
                            //print_r($ori_id);
                            if ($row = pg_fetch_array($rsFar)) {
                                $idRowCodeN = trim($row[0]);
                                $idRowCodeL = trim($row[1]);
                            }
                            $nombres = isset($idRowCodeN) ? $idRowCodeN : '';
                            $apellidos = isset($idRowCodeL) ? $idRowCodeL : '';

                            $unidad_id = $rTMP["value"]['med_con_uni_id'];
                            //print_r($unidad_id);

                            $rsFarUnidad = pg_query($rmfAdm, "SELECT ctg_uns_desc FROM ctg_uni_sanitarias WHERE ctg_uns_cod = '$unidad_id' ");
                            if ($row = pg_fetch_array($rsFarUnidad)) {
                                $idRowUni = trim($row[0]);
                            }
                            $unidad_desc = isset($idRowUni) ? $idRowUni : 'Unidad no Seleccionada';
                    ?>
                            <tr>
                                <td><?php echo  $rTMP["value"]['med_con_id']; ?></td>
                                <td><?php echo  $rTMP["value"]['fecha']; ?></td>
                                <td><?php echo  $rTMP["value"]['fecha_d']; ?></td>
                                <td><?php echo  $nombres; ?> <?php echo  $apellidos; ?></td>
                                <td><?php echo  $rTMP["value"]['med_con_motivo']; ?></td>
                                <td data-toggle="modal" data-target="#ModalMoreView<?php echo  $intContador; ?>">
                                    <i title="ver " class="fad fa-eye fa-2x" style="cursor:pointer;"></i>
                                </td>
                            </tr>

                            <div class="modal fade" id="ModalMoreView<?php echo  $intContador; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel<?php echo  $intContador; ?>" aria-hidden="true">
                                <div class="modal-dialog modal-lg" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title w-100" id="myModalLabel">DETALLE DE LA CONSULTA</h4>
                                            <button type="button" class="CERRAR" data-dismiss="modal" aria-label="CERRAR">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="card-primary collapsed-card">
                                                <div class="card-body">
                                                    <div class="div1">
                                                        <div id="" name="">                                                            
                                                            <div class="form-group col-md-12">
                                                                <label for="Examen" class=" color-label">Unidad</label>
                                                                <text class="form-control" id="Examen" rows="0" name="Examen"><?php echo  $unidad_desc; ?></text>
                                                            </div>
                                                            <div class="form-group col-md-12">
                                                                <label for="Examen" class=" color-label">Enfermedad</label>
                                                                <text class="form-control" id="Examen" rows="0" name="Examen"><?php echo  $enfermedad; ?></text>
                                                            </div>
                                                            <div class="form-group col-md-12">
                                                                <label for="Examen" class=" color-label">Examen</label>
                                                                <textarea class="form-control" id="Examen" rows="3" name="Examen"><?php echo  $rTMP["value"]['med_con_examen']; ?></textarea>
                                                            </div>
                                                            <div class="form-group col-md-12">
                                                                <label for="Receta" class=" color-label">Receta</label>
                                                                <textarea class="form-control" id="Receta" rows="3" name="Receta"><?php echo  TRIM($rTMP["value"]['med_con_receta']); ?></textarea>
                                                            </div>
                                                            <div class="form-group col-md-12">
                                                                <label for="Dieta" class=" color-label">Dieta</label>
                                                                <textarea class="form-control" id="Dieta" rows="3" name="Dieta"><?php echo TRIM($rTMP["value"]['med_con_dieta']); ?></textarea>
                                                            </div>
                                                            <div class="form-group col-md-12">
                                                                <label for="Observaciones" class=" color-label">Observaciones</label>
                                                                <textarea class="form-control" id="Observaciones" rows="2" name="Observaciones"><?php echo  $rTMP["value"]['med_con_observa']; ?></textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">CERRAR</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
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
    } else if ($strTipoValidacion == "busqueda_table_doctor") {
        require_once "../../data/conexion/tmfAdm.php";
        $strSearch = isset($_POST["Search"]) ? $_POST["Search"]  : '';

        $strFilter = "";
        if (!empty($strSearch)) {
            $intContador = 1;
            $strFilter = " WHERE ( UPPER(ctg_med_nombres) LIKE UPPER('%{$strSearch}%' )) ";
        }

        $arrTableDoctor = array();
        $var_consulta = "SELECT * 
                        FROM ctg_medicos medic
                        INNER JOIN ctg_especialidades as esp
                        ON medic.ctg_med_esp = esp.ctg_esp_cod
                        ORDER BY medic.id  ";
        $sql = pg_query($rmfAdm, $var_consulta);
        $totalArticle = pg_num_rows($sql);


        while ($rTMP = pg_fetch_assoc($sql)) {

            $arrTableDoctor[$rTMP["id"]]["id"]                       = $rTMP["id"];
            $arrTableDoctor[$rTMP["id"]]["ctg_med_col"]              = $rTMP["ctg_med_col"];
            $arrTableDoctor[$rTMP["id"]]["ctg_med_dpi"]              = $rTMP["ctg_med_dpi"];
            $arrTableDoctor[$rTMP["id"]]["ctg_med_code"]             = $rTMP["ctg_med_code"];
            $arrTableDoctor[$rTMP["id"]]["ctg_med_nombres"]          = $rTMP["ctg_med_nombres"];
            $arrTableDoctor[$rTMP["id"]]["ctg_med_apellidos"]        = $rTMP["ctg_med_apellidos"];
            $arrTableDoctor[$rTMP["id"]]["ctg_med_esp"]              = $rTMP["ctg_med_esp"];
            $arrTableDoctor[$rTMP["id"]]["ctg_med_espotr"]           = $rTMP["ctg_med_espotr"];
            $arrTableDoctor[$rTMP["id"]]["ctg_med_sexo"]             = $rTMP["ctg_med_sexo"];
            $arrTableDoctor[$rTMP["id"]]["ctg_med_civil"]            = $rTMP["ctg_med_civil"];
            $arrTableDoctor[$rTMP["id"]]["ctg_med_nac_dia"]          = $rTMP["ctg_med_nac_dia"];
            $arrTableDoctor[$rTMP["id"]]["ctg_med_nac_mes"]          = $rTMP["ctg_med_nac_mes"];
            $arrTableDoctor[$rTMP["id"]]["ctg_med_nac_ano"]          = $rTMP["ctg_med_nac_ano"];
            $arrTableDoctor[$rTMP["id"]]["ctg_med_dir"]              = $rTMP["ctg_med_dir"];
            $arrTableDoctor[$rTMP["id"]]["ctg_med_zona"]             = $rTMP["ctg_med_zona"];
            $arrTableDoctor[$rTMP["id"]]["ctg_med_dep"]              = $rTMP["ctg_med_dep"];
            $arrTableDoctor[$rTMP["id"]]["ctg_med_mun"]              = $rTMP["ctg_med_mun"];
            $arrTableDoctor[$rTMP["id"]]["ctg_med_telcel"]           = $rTMP["ctg_med_telcel"];
            $arrTableDoctor[$rTMP["id"]]["ctg_med_telpar"]           = $rTMP["ctg_med_telpar"];
            $arrTableDoctor[$rTMP["id"]]["ctg_med_email"]            = $rTMP["ctg_med_email"];
            $arrTableDoctor[$rTMP["id"]]["ctg_med_val_con"]          = $rTMP["ctg_med_val_con"];
            $arrTableDoctor[$rTMP["id"]]["ctg_med_sol_dt"]           = $rTMP["ctg_med_sol_dt"];
            $arrTableDoctor[$rTMP["id"]]["ctg_med_aut_dt"]           = $rTMP["ctg_med_aut_dt"];
            $arrTableDoctor[$rTMP["id"]]["ctg_med_ven_dt"]           = $rTMP["ctg_med_ven_dt"];
            $arrTableDoctor[$rTMP["id"]]["ctg_med_pass"]             = $rTMP["ctg_med_pass"];
            $arrTableDoctor[$rTMP["id"]]["ctg_med_username"]         = $rTMP["ctg_med_username"];
            $arrTableDoctor[$rTMP["id"]]["ctg_med_estatus"]          = $rTMP["ctg_med_estatus"];
            $arrTableDoctor[$rTMP["id"]]["ctg_med_infpro"]           = $rTMP["ctg_med_infpro"];
            $arrTableDoctor[$rTMP["id"]]["ctg_med_sta"]              = $rTMP["ctg_med_sta"];
            $arrTableDoctor[$rTMP["id"]]["ctg_med_dt"]               = $rTMP["ctg_med_dt"];
            $arrTableDoctor[$rTMP["id"]]["ctg_med_usr"]              = $rTMP["ctg_med_usr"];
            $arrTableDoctor[$rTMP["id"]]["ctg_esp_desc"]             = $rTMP["ctg_esp_desc"];
        }
        pg_free_result($sql);

    ?>
        <div class="col-md-12 tableFixHead">
            <table id="tableFarmac" class="table table-bordered table-striped table-hover table-sm">
                <thead>
                    <tr class="table-info">
                        <th width="50%">Nombre</th>
                        <th>Especialidad</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (is_array($arrTableDoctor) && (count($arrTableDoctor) > 0)) {
                        $intContador = 1;
                        reset($arrTableDoctor);
                        foreach ($arrTableDoctor as $rTMP['key'] => $rTMP['value']) {
                    ?>
                            <tr style="cursor:pointer;" onclick="fntSelectPatient('<?php print $intContador; ?>');">
                                <td width="50%"><?php echo  $rTMP["value"]['ctg_med_nombres'];
                                                $rTMP["value"]['ctg_med_apellidos']; ?></td>
                                <td><?php echo  $rTMP["value"]['ctg_esp_desc']; ?></td>
                            </tr>

                            <input type="hidden" name="hid_doc_id_<?php print $intContador; ?>" id="hid_doc_id_<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['id']; ?>">
                            <input type="hidden" name="hid_doc_<?php print $intContador; ?>" id="hid_doc_<?php print $intContador; ?>" value="<?php echo   $rTMP["value"]['ctg_med_nombres'];
                                                                                                                                                $rTMP["value"]['ctg_med_apellidos']; ?>">
                    <?PHP
                        }
                        $intContador++;
                    }
                    ?>
                </tbody>
            </table>
            </table>
        </div>
    <?php
        die();
    } else if ($strTipoValidacion == "busqueda_table_order_medicament") {
        $year = date('Y');;
        $orden = "a" . $year . "_farmacias_orden";
        $prod = "a" . $year . "_farmacias_orden_prod";
        $arrTableConsulta = array();
        $var_consulta = "SELECT to_char(orden.far_ord_fec::date,'DD-MM-YYYY') fecha,orden.* , prod.* 
                        FROM $orden orden
                        INNER JOIN $prod prod
                        ON orden.far_ord_cod = prod.far_orp_cod
                        WHERE orden.far_ord_pac_id = '$idUser'
                        ORDER BY orden.far_ord_fec DESC";
        $sql = pg_query($tmfPac, $var_consulta);
        //print_r($var_consulta);
        $totalArticle = pg_num_rows($sql);


        while ($rTMP = pg_fetch_assoc($sql)) {
            //ORDENES
            $arrTableConsulta[$rTMP["far_ord_cod"]]["far_ord_cod"]                   = $rTMP["far_ord_cod"];
            $arrTableConsulta[$rTMP["far_ord_cod"]]["far_ord_tipo"]                   = $rTMP["far_ord_tipo"];
            $arrTableConsulta[$rTMP["far_ord_cod"]]["fecha"]                   = $rTMP["fecha"];
            $arrTableConsulta[$rTMP["far_ord_cod"]]["far_ord_med_id"]                   = $rTMP["far_ord_med_id"];
            $arrTableConsulta[$rTMP["far_ord_cod"]]["far_ord_pac_id"]                   = $rTMP["far_ord_pac_id"];
            $arrTableConsulta[$rTMP["far_ord_cod"]]["far_ord_pac_nombre"]                   = $rTMP["far_ord_pac_nombre"];
            $arrTableConsulta[$rTMP["far_ord_cod"]]["far_ord_pac_mem_id"]                   = $rTMP["far_ord_pac_mem_id"];
            $arrTableConsulta[$rTMP["far_ord_cod"]]["far_ord_por_fac"]                   = $rTMP["far_ord_por_fac"];
            $arrTableConsulta[$rTMP["far_ord_cod"]]["far_ord_por_laf"]                   = $rTMP["far_ord_por_laf"];
            $arrTableConsulta[$rTMP["far_ord_cod"]]["far_ord_valor"]                   = $rTMP["far_ord_valor"];
            $arrTableConsulta[$rTMP["far_ord_cod"]]["far_ord_valor_desf"]                   = $rTMP["far_ord_valor_desf"];
            $arrTableConsulta[$rTMP["far_ord_cod"]]["far_ord_valor_desl"]                   = $rTMP["far_ord_valor_desl"];
            $arrTableConsulta[$rTMP["far_ord_cod"]]["far_ord_valor_iva"]                   = $rTMP["far_ord_valor_iva"];
            $arrTableConsulta[$rTMP["far_ord_cod"]]["far_ord_total"]                   = $rTMP["far_ord_total"];
            $arrTableConsulta[$rTMP["far_ord_cod"]]["far_ord_est"]                   = $rTMP["far_ord_est"];
            $arrTableConsulta[$rTMP["far_ord_cod"]]["far_ord_sta"]                   = $rTMP["far_ord_sta"];
            $arrTableConsulta[$rTMP["far_ord_cod"]]["far_ord_dt"]                   = $rTMP["far_ord_dt"];
            $arrTableConsulta[$rTMP["far_ord_cod"]]["far_ord_usr"]                   = $rTMP["far_ord_usr"];
            $arrTableConsulta[$rTMP["far_ord_cod"]]["far_ord_comcom"]                   = $rTMP["far_ord_comcom"];
            //ARTICULOS
            $arrTableConsulta[$rTMP['far_ord_cod']]['accesos'][$rTMP['far_orp_cod']]['far_orp_cod']        = $rTMP['far_orp_cod'];
            $arrTableConsulta[$rTMP['far_ord_cod']]['accesos'][$rTMP['far_orp_cod']]['far_orp_med_id']        = $rTMP['far_orp_med_id'];
            $arrTableConsulta[$rTMP['far_ord_cod']]['accesos'][$rTMP['far_orp_cod']]['far_orp_pac_id']        = $rTMP['far_orp_pac_id'];
            $arrTableConsulta[$rTMP['far_ord_cod']]['accesos'][$rTMP['far_orp_cod']]['far_orp_pro_id']        = $rTMP['far_orp_pro_id'];
            $arrTableConsulta[$rTMP['far_ord_cod']]['accesos'][$rTMP['far_orp_cod']]['far_orp_pre']        = $rTMP['far_orp_pre'];
            $arrTableConsulta[$rTMP['far_ord_cod']]['accesos'][$rTMP['far_orp_cod']]['far_orp_can']        = $rTMP['far_orp_can'];
            $arrTableConsulta[$rTMP['far_ord_cod']]['accesos'][$rTMP['far_orp_cod']]['far_orp_desf']        = $rTMP['far_orp_desf'];
            $arrTableConsulta[$rTMP['far_ord_cod']]['accesos'][$rTMP['far_orp_cod']]['far_orp_desl']        = $rTMP['far_orp_desl'];
            $arrTableConsulta[$rTMP['far_ord_cod']]['accesos'][$rTMP['far_orp_cod']]['far_orp_valor']        = $rTMP['far_orp_valor'];
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
                                <th width="10%">Orden</th>
                                <th width="15%">Fecha</th>
                                <th width="60%">Nombre Comercial</th>
                                <th width="10%">Valor Total</th>
                                <th width="3%">Detalle</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (is_array($arrTableConsulta) && (count($arrTableConsulta) > 0)) {
                                reset($arrTableConsulta);
                                foreach ($arrTableConsulta as $keyA => $valueA) {
                                    $boolHasAccesos = isset($valueA["accesos"]) && is_array($valueA["accesos"]) && (count($valueA["accesos"]) > 0);
                            ?>
                                    <tr>
                                        <td><?php echo  $valueA['far_ord_cod']; ?></td>
                                        <td><?php echo  $valueA['fecha']; ?></td>
                                        <td><?php echo  $valueA['far_ord_comcom']; ?></td>
                                        <td><?php echo  $valueA['far_ord_total']; ?></td>
                                        <td data-toggle="modal" data-target="#ModalOrderMedicament_<?php echo  $valueA['far_ord_cod']; ?>">
                                            <i title="ver " class="fad fa-eye fa-2x" style="cursor:pointer;"></i>
                                        </td>
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
        <?php
        if (is_array($arrTableConsulta) && (count($arrTableConsulta) > 0)) {
            reset($arrTableConsulta);
            foreach ($arrTableConsulta as $keyA => $valueA) {
                $boolHasAccesos = isset($valueA["accesos"]) && is_array($valueA["accesos"]) && (count($valueA["accesos"]) > 0);
        ?>
                <div class="modal fade" id="ModalOrderMedicament_<?php echo  $valueA['far_ord_cod']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
                                                            <th>Nombre</th>
                                                            <th>Precio</th>
                                                            <th>Cantidad</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?PHP
                                                        if ($boolHasAccesos) {
                                                            reset($valueA["accesos"]);
                                                            foreach ($valueA["accesos"] as $keyB => $valueB) {
                                                                $ori_id = $valueB['far_orp_pro_id'];
                                                                
                                                                require_once "../../data/conexion/tmfAdm.php";
                                                                $rsFar = pg_query($rmfAdm, "SELECT ctg_pro_desc FROM ctg_productos WHERE ctg_pro_cod = '$ori_id' ");
                                                                if ($row = pg_fetch_array($rsFar)) {
                                                                    $idRowCode = trim($row[0]);
                                                                }
                                                                $medicamento = isset($idRowCode) ? $idRowCode : 0;
                                                                //print_r($medicamento);
                                                        ?>
                                                                <tr>
                                                                    <td width="80%"><?php echo  $medicamento; ?></td>
                                                                    <td width="10%"><?php echo  $valueB['far_orp_pre']; ?></td>
                                                                    <td width="10%"><?php echo  $valueB['far_orp_can']; ?></td>
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
                            </div>
                        </div>
                    </div>
                </div>
        <?php
            }
        }
        ?>
    <?php
        die();
    } else if ($strTipoValidacion == "busqueda_table_order_hospital") {
        $year = date('Y');;
        $orden = "a" . $year . "_hospitales_orden";
        $prod = "a" . $year . "_hospitales_orden_items";
        $arrTableConsultaHosp = array();
        $var_consulta = "SELECT to_char(orden.hos_ord_fec::date,'DD-MM-YYYY') fecha, orden.* , prod.* 
                        FROM $orden orden
                        INNER JOIN $prod prod
                        ON orden.hos_ord_cod = prod.hos_ori_cod
                        WHERE orden.hos_ord_pac_id = '$idUser'
                        ORDER BY orden.hos_ord_fec DESC";
        $sql = pg_query($tmfPac, $var_consulta);
        $totalArticle = pg_num_rows($sql);


        while ($rTMP = pg_fetch_assoc($sql)) {
            //ORDENES
            $arrTableConsultaHosp[$rTMP["hos_ord_cod"]]["hos_ord_cod"]                   = $rTMP["hos_ord_cod"];
            $arrTableConsultaHosp[$rTMP["hos_ord_cod"]]["hos_ord_hos_id"]                   = $rTMP["hos_ord_hos_id"];
            $arrTableConsultaHosp[$rTMP["hos_ord_cod"]]["hos_ord_pac_id"]                   = $rTMP["hos_ord_pac_id"];
            $arrTableConsultaHosp[$rTMP["hos_ord_cod"]]["hos_ord_tipo"]                   = $rTMP["hos_ord_tipo"];
            $arrTableConsultaHosp[$rTMP["hos_ord_cod"]]["hos_ord_med_id"]                   = $rTMP["hos_ord_med_id"];
            $arrTableConsultaHosp[$rTMP["hos_ord_cod"]]["fecha"]                   = $rTMP["fecha"];
            $arrTableConsultaHosp[$rTMP["hos_ord_cod"]]["hos_ord_pac_nombre"]                   = $rTMP["hos_ord_pac_nombre"];
            $arrTableConsultaHosp[$rTMP["hos_ord_cod"]]["hos_ord_por_lab"]                   = $rTMP["hos_ord_por_lab"];
            $arrTableConsultaHosp[$rTMP["hos_ord_cod"]]["hos_ord_valor"]                   = $rTMP["hos_ord_valor"];
            $arrTableConsultaHosp[$rTMP["hos_ord_cod"]]["hos_ord_valor_desh"]                   = $rTMP["hos_ord_valor_desh"];
            $arrTableConsultaHosp[$rTMP["hos_ord_cod"]]["hos_ord_valor_iva"]                   = $rTMP["hos_ord_valor_iva"];
            $arrTableConsultaHosp[$rTMP["hos_ord_cod"]]["hos_ord_total"]                   = $rTMP["hos_ord_total"];
            $arrTableConsultaHosp[$rTMP["hos_ord_cod"]]["hos_ord_est"]                   = $rTMP["hos_ord_est"];
            $arrTableConsultaHosp[$rTMP["hos_ord_cod"]]["hos_ord_sta"]                   = $rTMP["hos_ord_sta"];
            $arrTableConsultaHosp[$rTMP["hos_ord_cod"]]["hos_ord_dt"]                   = $rTMP["hos_ord_dt"];
            $arrTableConsultaHosp[$rTMP["hos_ord_cod"]]["hos_ord_usr"]                   = $rTMP["hos_ord_usr"];
            $arrTableConsultaHosp[$rTMP["hos_ord_cod"]]["hos_ord_nomcom"]                   = $rTMP["hos_ord_nomcom"];

            //ARTICULOS
            $arrTableConsultaHosp[$rTMP['hos_ord_cod']]['accesos'][$rTMP['hos_ori_cod']]['hos_ori_cod']        = $rTMP['hos_ori_cod'];
            $arrTableConsultaHosp[$rTMP['hos_ord_cod']]['accesos'][$rTMP['hos_ori_cod']]['hos_ori_tipo']        = $rTMP['hos_ori_tipo'];
            $arrTableConsultaHosp[$rTMP['hos_ord_cod']]['accesos'][$rTMP['hos_ori_cod']]['hos_ori_hos_id']        = $rTMP['hos_ori_hos_id'];
            $arrTableConsultaHosp[$rTMP['hos_ord_cod']]['accesos'][$rTMP['hos_ori_cod']]['hos_ori_pac_id']        = $rTMP['hos_ori_pac_id'];
            $arrTableConsultaHosp[$rTMP['hos_ord_cod']]['accesos'][$rTMP['hos_ori_cod']]['hos_ori_med_id']        = $rTMP['hos_ori_med_id'];
            $arrTableConsultaHosp[$rTMP['hos_ord_cod']]['accesos'][$rTMP['hos_ori_cod']]['hos_ori_gpo_id']        = $rTMP['hos_ori_gpo_id'];
            $arrTableConsultaHosp[$rTMP['hos_ord_cod']]['accesos'][$rTMP['hos_ori_cod']]['hos_ori_ser_id']        = $rTMP['hos_ori_ser_id'];
            $arrTableConsultaHosp[$rTMP['hos_ord_cod']]['accesos'][$rTMP['hos_ori_cod']]['hos_ori_pre']        = $rTMP['hos_ori_pre'];
            $arrTableConsultaHosp[$rTMP['hos_ord_cod']]['accesos'][$rTMP['hos_ori_cod']]['hos_ori_can']        = $rTMP['hos_ori_can'];
            $arrTableConsultaHosp[$rTMP['hos_ord_cod']]['accesos'][$rTMP['hos_ori_cod']]['hos_ori_desh']        = $rTMP['hos_ori_desh'];
            $arrTableConsultaHosp[$rTMP['hos_ord_cod']]['accesos'][$rTMP['hos_ori_cod']]['hos_ori_valor']        = $rTMP['hos_ori_valor'];
        }
        pg_free_result($sql);
    ?>

        <div class="col-md-12 tableFixHead">
            <div class="row">
                <div class="col-3"></div>
                <div class="col-6">
                    <table id="tableVaccine" class="table table-bordered table-striped table-hover table-sm">
                        <thead>
                            <tr class="table-info">
                                <th width="10%">Orden</th>
                                <th width="15%">Fecha</th>
                                <th width="60%">Nombre Comercial</th>
                                <th width="15%">Valor Total</th>
                                <th width="3%">Detalle</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (is_array($arrTableConsultaHosp) && (count($arrTableConsultaHosp) > 0)) {
                                reset($arrTableConsultaHosp);
                                foreach ($arrTableConsultaHosp as $keyA => $valueA) {
                                    $boolHasAccesos = isset($valueA["accesos"]) && is_array($valueA["accesos"]) && (count($valueA["accesos"]) > 0);
                            ?>
                                    <tr>
                                        <td><?php echo  $valueA['hos_ord_cod']; ?></td>
                                        <td><?php echo  $valueA['fecha']; ?></td>
                                        <td><?php echo  $valueA['hos_ord_nomcom']; ?></td>
                                        <td><?php echo  $valueA['hos_ord_total']; ?></td>
                                        <td data-toggle="modal" data-target="#ModalOrderHospital_<?php echo  $valueA['hos_ord_cod']; ?>">
                                            <i title="ver " class="fad fa-eye fa-2x" style="cursor:pointer;"></i>
                                        </td>
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
        <?php
        if (is_array($arrTableConsultaHosp) && (count($arrTableConsultaHosp) > 0)) {
            reset($arrTableConsultaHosp);
            foreach ($arrTableConsultaHosp as $keyA => $valueA) {
                $boolHasAccesos = isset($valueA["accesos"]) && is_array($valueA["accesos"]) && (count($valueA["accesos"]) > 0);
        ?>
                <div class="modal fade" id="ModalOrderHospital_<?php echo  $valueA['hos_ord_cod']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
                                                            <th>Nombre</th>
                                                            <th>Precio</th>
                                                            <th>Cantidad</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>

                                                        <?PHP
                                                        if ($boolHasAccesos) {
                                                            reset($valueA["accesos"]);
                                                            foreach ($valueA["accesos"] as $keyB => $valueB) {
                                                                $ori_id = $valueB['hos_ori_ser_id'];
                                                                require_once "../../data/conexion/tmfAdm.php";
                                                                $rsFar = pg_query($rmfAdm, "SELECT ctg_hpp_descrip FROM ctg_hospitales_servicios WHERE ctg_hpp_code = '$ori_id' LIMIT 1");
                                                                if ($row = pg_fetch_array($rsFar)) {
                                                                    $idRowCode = trim($row[0]);
                                                                }
                                                                $descrip = isset($idRowCode) ? $idRowCode : 0;
                                                                //print_r($valueB);
                                                        ?>
                                                                <tr>
                                                                    <td width="80%"><?php echo  $descrip; ?></td>
                                                                    <td width="10%"><?php echo  $valueB['hos_ori_pre']; ?></td>
                                                                    <td width="10%"><?php echo  $valueB['hos_ori_can']; ?></td>
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
                            </div>
                        </div>
                    </div>
                </div>
        <?php
            }
        }
        ?>
    <?php
        die();
    } else if ($strTipoValidacion == "busqueda_table_order_farmac") {
        $year = date('Y');;
        $orden = "a" . $year . "_labclinicos_orden";
        $prod = "a" . $year . "_labclinicos_orden_items";
        $arrTableConsultaLab = array();
        $var_consulta = "SELECT to_char(orden.lab_ord_fec::date,'DD-MM-YYYY') fecha, orden.* , prod.* 
                        FROM $orden orden
                        INNER JOIN $prod prod
                        ON orden.lab_ord_cod = prod.lab_ori_cod
                        WHERE orden.lab_ord_pac_id = '$idUser'
                        ORDER BY orden.lab_ord_fec DESC";
        $sql = pg_query($tmfPac, $var_consulta);
        $totalArticle = pg_num_rows($sql);


        while ($rTMP = pg_fetch_assoc($sql)) {
            //ORDENES
            $arrTableConsultaLab[$rTMP["lab_ord_cod"]]["lab_ord_cod"]                   = $rTMP["lab_ord_cod"];
            $arrTableConsultaLab[$rTMP["lab_ord_cod"]]["lab_ord_tipo"]                   = $rTMP["lab_ord_tipo"];
            $arrTableConsultaLab[$rTMP["lab_ord_cod"]]["lab_ord_pac_id"]                   = $rTMP["lab_ord_pac_id"];
            $arrTableConsultaLab[$rTMP["lab_ord_cod"]]["lab_ord_med_id"]                   = $rTMP["lab_ord_med_id"];
            $arrTableConsultaLab[$rTMP["lab_ord_cod"]]["fecha"]                   = $rTMP["fecha"];
            $arrTableConsultaLab[$rTMP["lab_ord_cod"]]["lab_ord_pac_nombre"]                   = $rTMP["lab_ord_pac_nombre"];
            $arrTableConsultaLab[$rTMP["lab_ord_cod"]]["lab_ord_pac_mem_id"]                   = $rTMP["lab_ord_pac_mem_id"];
            $arrTableConsultaLab[$rTMP["lab_ord_cod"]]["lab_ord_por_lab"]                   = $rTMP["lab_ord_por_lab"];
            $arrTableConsultaLab[$rTMP["lab_ord_cod"]]["lab_ord_valor"]                   = $rTMP["lab_ord_valor"];
            $arrTableConsultaLab[$rTMP["lab_ord_cod"]]["lab_ord_valor_desl"]                   = $rTMP["lab_ord_valor_desl"];
            $arrTableConsultaLab[$rTMP["lab_ord_cod"]]["lab_ord_valor_iva"]                   = $rTMP["lab_ord_valor_iva"];
            $arrTableConsultaLab[$rTMP["lab_ord_cod"]]["lab_ord_total"]                   = $rTMP["lab_ord_total"];
            $arrTableConsultaLab[$rTMP["lab_ord_cod"]]["lab_ord_est"]                   = $rTMP["lab_ord_est"];
            $arrTableConsultaLab[$rTMP["lab_ord_cod"]]["lab_ord_nomcom"]                   = $rTMP["lab_ord_nomcom"];

            //ARTICULOS
            $arrTableConsultaLab[$rTMP["lab_ord_cod"]]['accesos'][$rTMP['lab_ori_cod']]["lab_ori_cod"]                   = $rTMP["lab_ori_cod"];
            $arrTableConsultaLab[$rTMP["lab_ord_cod"]]['accesos'][$rTMP['lab_ori_cod']]["lab_ori_tipo"]                   = $rTMP["lab_ori_tipo"];
            $arrTableConsultaLab[$rTMP["lab_ord_cod"]]['accesos'][$rTMP['lab_ori_cod']]["lab_ori_pac_id"]                   = $rTMP["lab_ori_pac_id"];
            $arrTableConsultaLab[$rTMP["lab_ord_cod"]]['accesos'][$rTMP['lab_ori_cod']]["lab_ori_med_id"]                   = $rTMP["lab_ori_med_id"];
            $arrTableConsultaLab[$rTMP["lab_ord_cod"]]['accesos'][$rTMP['lab_ori_cod']]["lab_ori_gpo_id"]                   = $rTMP["lab_ori_gpo_id"];
            $arrTableConsultaLab[$rTMP["lab_ord_cod"]]['accesos'][$rTMP['lab_ori_cod']]["lab_ori_exa_id"]                   = $rTMP["lab_ori_exa_id"];
            $arrTableConsultaLab[$rTMP["lab_ord_cod"]]['accesos'][$rTMP['lab_ori_cod']]["lab_ori_pre"]                   = $rTMP["lab_ori_pre"];
            $arrTableConsultaLab[$rTMP["lab_ord_cod"]]['accesos'][$rTMP['lab_ori_cod']]["lab_ori_can"]                   = $rTMP["lab_ori_can"];
            $arrTableConsultaLab[$rTMP["lab_ord_cod"]]['accesos'][$rTMP['lab_ori_cod']]["lab_ori_desl"]                   = $rTMP["lab_ori_desl"];
            $arrTableConsultaLab[$rTMP["lab_ord_cod"]]['accesos'][$rTMP['lab_ori_cod']]["lab_ori_valor"]                   = $rTMP["lab_ori_valor"];
            $arrTableConsultaLab[$rTMP["lab_ord_cod"]]['accesos'][$rTMP['lab_ori_cod']]["lab_ori_exa_dt"]                   = $rTMP["lab_ori_exa_dt"];
            $arrTableConsultaLab[$rTMP["lab_ord_cod"]]['accesos'][$rTMP['lab_ori_cod']]["lab_ori_exa_ranmin"]                   = $rTMP["lab_ori_exa_ranmin"];
            $arrTableConsultaLab[$rTMP["lab_ord_cod"]]['accesos'][$rTMP['lab_ori_cod']]["lab_ori_exa_ranmax"]                   = $rTMP["lab_ori_exa_ranmax"];
            $arrTableConsultaLab[$rTMP["lab_ord_cod"]]['accesos'][$rTMP['lab_ori_cod']]["lab_ori_exa_res"]                   = $rTMP["lab_ori_exa_res"];
            $arrTableConsultaLab[$rTMP["lab_ord_cod"]]['accesos'][$rTMP['lab_ori_cod']]["lab_ori_sta"]                   = $rTMP["lab_ori_sta"];
            $arrTableConsultaLab[$rTMP["lab_ord_cod"]]['accesos'][$rTMP['lab_ori_cod']]["lab_ori_dt"]                   = $rTMP["lab_ori_dt"];
            $arrTableConsultaLab[$rTMP["lab_ord_cod"]]['accesos'][$rTMP['lab_ori_cod']]["lab_ori_usr"]                   = $rTMP["lab_ori_usr"];
        }
        pg_free_result($sql);
    ?>

        <div class="col-md-12 tableFixHead">
            <div class="row">
                <div class="col-3"></div>
                <div class="col-6">
                    <table id="tableVaccine" class="table table-bordered table-striped table-hover table-sm">
                        <thead>
                            <tr class="table-info">
                                <th width="10%">Orden</th>
                                <th width="15%">Fecha</th>
                                <th width="60%">Nombre Comercial</th>
                                <th width="15%">Valor Total</th>
                                <th width="3%">Detalle</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (is_array($arrTableConsultaLab) && (count($arrTableConsultaLab) > 0)) {
                                reset($arrTableConsultaLab);
                                foreach ($arrTableConsultaLab as $keyA => $valueA) {
                                    $boolHasAccesos = isset($valueA["accesos"]) && is_array($valueA["accesos"]) && (count($valueA["accesos"]) > 0);
                            ?>
                                    <tr>
                                        <td><?php echo  $valueA['lab_ord_cod']; ?></td>
                                        <td><?php echo  $valueA['fecha']; ?></td>
                                        <td><?php echo  $valueA['lab_ord_nomcom']; ?></td>
                                        <td><?php echo  $valueA['lab_ord_total']; ?></td>
                                        <td data-toggle="modal" data-target="#ModalOrderFarmac_<?php echo  $valueA['lab_ord_cod']; ?>">
                                            <i title="ver " class="fad fa-eye fa-2x" style="cursor:pointer;"></i>
                                        </td>
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
        <?php
        if (is_array($arrTableConsultaLab) && (count($arrTableConsultaLab) > 0)) {
            reset($arrTableConsultaLab);
            foreach ($arrTableConsultaLab as $keyA => $valueA) {
                $boolHasAccesos = isset($valueA["accesos"]) && is_array($valueA["accesos"]) && (count($valueA["accesos"]) > 0);
        ?>
                <div class="modal fade" id="ModalOrderFarmac_<?php echo  $valueA['lab_ord_cod']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
                                                            <th>Nombre</th>
                                                            <th>Precio</th>
                                                            <th>Cantidad</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?PHP
                                                        if ($boolHasAccesos) {
                                                            reset($valueA["accesos"]);
                                                            foreach ($valueA["accesos"] as $keyB => $valueB) {
                                                                $ori_id = $valueB['lab_ori_cod'];
                                                                require_once "../../data/conexion/tmfAdm.php";
                                                                $rsFar = pg_query($rmfAdm, "SELECT ctg_exa_descrip FROM ctg_examenes WHERE ctg_exa_code = '$ori_id' LIMIT 1");
                                                                if ($row = pg_fetch_array($rsFar)) {
                                                                    $idRowCode = trim($row[0]);
                                                                }
                                                                $descrip = isset($idRowCode) ? $idRowCode : 0;
                                                                //print_r($valueB);
                                                        ?>
                                                                <tr>
                                                                    <td width="80%"><?php echo  $descrip; ?></td>
                                                                    <td width="10%"><?php echo  $valueB['lab_ori_pre']; ?></td>
                                                                    <td width="10%"><?php echo  $valueB['lab_ori_can']; ?></td>
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
                            </div>
                        </div>
                    </div>
                </div>
        <?php
            }
        }
        ?>
    <?php
        die();
    } else if ($strTipoValidacion == "busqueda_table_order_vac") {
        $year = date('Y');;
        $Consulta = "a" . $year . "_medicos_consultas_vacunas";
        $arrTableConsultaVac = array();
        $var_consulta = "SELECT to_char(med_cov_dt::date,'DD-MM-YYYY') fecha,*
                        FROM $Consulta 
                        WHERE med_cov_pac_id = '$idUser'
                        ORDER BY fecha DESC";
        $sql = pg_query($tmfPac, $var_consulta);
        $totalArticle = pg_num_rows($sql);


        while ($rTMP = pg_fetch_assoc($sql)) {

            $arrTableConsultaVac[$rTMP["med_cov_id"]]["med_cov_id"]                   = $rTMP["med_cov_id"];
            $arrTableConsultaVac[$rTMP["med_cov_id"]]["med_cov_med_id"]                   = $rTMP["med_cov_med_id"];
            $arrTableConsultaVac[$rTMP["med_cov_id"]]["med_cov_pac_id"]                   = $rTMP["med_cov_pac_id"];
            $arrTableConsultaVac[$rTMP["med_cov_id"]]["med_cov_vac_id"]                   = $rTMP["med_cov_vac_id"];
            $arrTableConsultaVac[$rTMP["med_cov_id"]]["med_cov_mat"]                   = $rTMP["med_cov_mat"];
            $arrTableConsultaVac[$rTMP["med_cov_id"]]["med_cov_dosis"]                   = $rTMP["med_cov_dosis"];
            $arrTableConsultaVac[$rTMP["med_cov_id"]]["med_cov_obs"]                   = $rTMP["med_cov_obs"];
            $arrTableConsultaVac[$rTMP["med_cov_id"]]["med_cov_sta"]                   = $rTMP["med_cov_sta"];
            $arrTableConsultaVac[$rTMP["med_cov_id"]]["fecha"]                   = $rTMP["fecha"];
            $arrTableConsultaVac[$rTMP["med_cov_id"]]["med_cov_usr"]                   = $rTMP["med_cov_usr"];
        }
        pg_free_result($sql);

    ?>
        <div class="col-md-12 tableFixHead">
            <div class="row">
                <div class="col-3"></div>
                <div class="col-6">
                    <table id="tableVaccine" class="table table-bordered table-striped table-hover table-sm">
                        <thead>
                            <tr class="table-info">
                                <th width="10%">Orden</th>
                                <th width="15%">Fecha</th>
                                <th width="35%">Medico</th>
                                <th width="35%">Nombre</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (is_array($arrTableConsultaVac) && (count($arrTableConsultaVac) > 0)) {
                                $intContador = 1;
                                reset($arrTableConsultaVac);
                                foreach ($arrTableConsultaVac as $rTMP['key'] => $rTMP['value']) {
                                    $vac_id = $rTMP["value"]['med_cov_vac_id'];
                                    $idMed = $rTMP["value"]['med_cov_med_id'];

                                    require_once "../../data/conexion/tmfAdm.php";
                                    $rsFar = pg_query($rmfAdm, "SELECT ctg_vac_nom FROM ctg_vacunas WHERE ctg_vac_id = '$vac_id' LIMIT 1");
                                    if ($row = pg_fetch_array($rsFar)) {
                                        $idRowCode = trim($row[0]);
                                    }
                                    $descrip = isset($idRowCode) ? $idRowCode : '';

                                    $rsFar2 = pg_query($rmfAdm, "SELECT ctg_med_nombres,ctg_med_apellidos FROM ctg_medicos WHERE ctg_med_code = '$idMed' LIMIT 1");
                                    if ($row = pg_fetch_array($rsFar2)) {
                                        $idRowCode1 = trim($row[0]);
                                        $idRowCode2 = trim($row[1]);
                                    }
                                    $nombre = isset($idRowCode1) ? $idRowCode1 : '';
                                    $apellido = isset($idRowCode2) ? $idRowCode2 : '';
                                    $fullName = "$nombre" . "$apellido";
                            ?>
                                    <tr>
                                        <td><?php echo  $rTMP["value"]['med_cov_id']; ?></td>
                                        <td><?php echo  $rTMP["value"]['fecha']; ?></td>
                                        <td><?php echo  $fullName; ?></td>
                                        <td><?php echo  $descrip; ?></td>
                                    </tr>
                            <?PHP
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
        die();
    }
    die();
}


?>
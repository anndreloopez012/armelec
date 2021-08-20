<?php
if (isset($_GET["validaciones"]) && !empty($_GET["validaciones"])) {
    require_once "../../data/conexion/tmlMed.php";
    $idUser = $_SESSION['adm_usr_code'];
    //TABLA DE INTERACCION

    $med_vac_id_ = isset($_POST["idDiet"]) ? $_POST["idDiet"]  : 0;
    $med_vac_nom_ = isset($_POST["nombre"]) ? $_POST["nombre"]  : '';
    $med_vac_des_ = isset($_POST["descripcion"]) ? $_POST["descripcion"]  : '';


    $hos_ord_cod = isset($_POST["id_orden"]) ? $_POST["id_orden"]  : '';


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
        $orden = "hos" . $idUser . "orden";
        $var_consulta = "UPDATE $orden 
                        SET hos_ord_est = '2',
                        WHERE hos_ord_cod = $hos_ord_cod;";
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
        require_once "../../data/conexion/tmfAdm.php";
        require_once "../../data/conexion/tmfHos.php";
        $orden = "hos" . $Code . "orden";
        $prod = "hos" . $Code . "orden_items";
        $arrTableConsulta = array();
        $var_consulta = "SELECT to_char(orden.hos_ord_dt::date,'DD-MM-YYYY') fecha,orden.* , prod.* 
                        FROM $orden orden
                        INNER JOIN $prod prod
                        ON orden.hos_ord_cod = prod.hos_ori_cod
                        ORDER BY orden.hos_ord_fec";
        $sql = pg_query($tmfHos, $var_consulta);
        //print_r($var_consulta);

        $totalArticle = pg_num_rows($sql);


        while ($rTMP = pg_fetch_assoc($sql)) {
            //ORDENES
            $arrTableConsulta[$rTMP["hos_ord_cod"]]["hos_ord_cod"]                   = $rTMP["hos_ord_cod"];
            $arrTableConsulta[$rTMP["hos_ord_cod"]]["hos_ord_cod"]                   = $rTMP["hos_ord_cod"];
            $arrTableConsulta[$rTMP["hos_ord_cod"]]["hos_ord_tipo"]                   = $rTMP["hos_ord_tipo"];
            $arrTableConsulta[$rTMP["hos_ord_cod"]]["hos_ord_fec"]                   = $rTMP["hos_ord_fec"];
            $arrTableConsulta[$rTMP["hos_ord_cod"]]["hos_ord_med_id"]                   = $rTMP["hos_ord_med_id"];
            $arrTableConsulta[$rTMP["hos_ord_cod"]]["hos_ord_pac_id"]                   = $rTMP["hos_ord_pac_id"];
            $arrTableConsulta[$rTMP["hos_ord_cod"]]["hos_ord_pac_nombre"]                   = $rTMP["hos_ord_pac_nombre"];
            $arrTableConsulta[$rTMP["hos_ord_cod"]]["hos_ord_pac_id"]                   = $rTMP["hos_ord_pac_id"];
            $arrTableConsulta[$rTMP["hos_ord_cod"]]["hos_ord_valor"]                   = $rTMP["hos_ord_valor"];
            $arrTableConsulta[$rTMP["hos_ord_cod"]]["hos_ord_valor_iva"]                   = $rTMP["hos_ord_valor_iva"];
            $arrTableConsulta[$rTMP["hos_ord_cod"]]["hos_ord_total"]                   = $rTMP["hos_ord_total"];
            $arrTableConsulta[$rTMP["hos_ord_cod"]]["hos_ord_est"]                   = $rTMP["hos_ord_est"];
            $arrTableConsulta[$rTMP["hos_ord_cod"]]["hos_ord_sta"]                   = $rTMP["hos_ord_sta"];
            $arrTableConsulta[$rTMP["hos_ord_cod"]]["fecha"]                   = $rTMP["fecha"];
            $arrTableConsulta[$rTMP["hos_ord_cod"]]["hos_ord_usr"]                   = $rTMP["hos_ord_usr"];

            //ARTICULOS
            $arrTableConsulta[$rTMP['hos_ord_cod']]['accesos'][$rTMP['hos_ori_cod']]['hos_ori_cod']        = $rTMP['hos_ori_cod'];
            $arrTableConsulta[$rTMP['hos_ord_cod']]['accesos'][$rTMP['hos_ori_cod']]['hos_ori_ser_id']        = $rTMP['hos_ori_ser_id'];
            $arrTableConsulta[$rTMP['hos_ord_cod']]['accesos'][$rTMP['hos_ori_cod']]['hos_ori_pre']        = $rTMP['hos_ori_pre'];
            $arrTableConsulta[$rTMP['hos_ord_cod']]['accesos'][$rTMP['hos_ori_cod']]['hos_ori_can']        = $rTMP['hos_ori_can'];
            $arrTableConsulta[$rTMP['hos_ord_cod']]['accesos'][$rTMP['hos_ori_cod']]['hos_ori_valor']        = $rTMP['hos_ori_valor'];
            $arrTableConsulta[$rTMP['hos_ord_cod']]['accesos'][$rTMP['hos_ori_cod']]['hos_ori_sta']        = $rTMP['hos_ori_sta'];
            $arrTableConsulta[$rTMP['hos_ord_cod']]['accesos'][$rTMP['hos_ori_cod']]['hos_ori_dt']        = $rTMP['hos_ori_dt'];
            $arrTableConsulta[$rTMP['hos_ord_cod']]['accesos'][$rTMP['hos_ori_cod']]['hos_ori_usr']        = $rTMP['hos_ori_usr'];
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

                                    $idPac = isset($valueA['hos_ord_pac_id']) ?  $valueA['hos_ord_pac_id']  : '';
                            ?>
                                    <tr>
                                        <td><?php echo  $valueA['hos_ord_cod']; ?></td>
                                        <td><?php echo  $valueA['fecha']; ?></td>
                                        <td><?php echo  $valueA['hos_ord_pac_nombre']; ?></td>
                                        <td><?php echo  $valueA['hos_ord_total']; ?></td>
                                        <td class="table-info" data-toggle="modal" data-target="#ModalOrderMedicament<?php echo  $valueA['hos_ord_cod']; ?>">
                                            <i title="ver " class="fad fa-eye fa-2x" style="cursor:pointer;"></i>
                                        </td>
                                    </tr>

                                    <input type="hidden" name="hidId_<?php print $intContador; ?>" id="hidId_<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['hos_ord_cod']; ?>">
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

                $idPac = isset($valueA['hos_ord_pac_id']) ?  $valueA['hos_ord_pac_id']  : '';
        ?>
                <div class="modal fade" id="ModalOrderMedicament<?php echo  $valueA['hos_ord_cod']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title w-100" id="myModalLabel">SERVICIOS</h4>
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
                                                                $ori_id = $valueB['hos_ori_ser_id'];

                                                                $rsFar = pg_query($rmfAdm, "SELECT ctg_hpp_descrip FROM ctg_hospitales_servicios WHERE ctg_hpp_code = '$ori_id' LIMIT 1");
                                                                if ($row = pg_fetch_array($rsFar)) {
                                                                    $idRowCode = trim($row[0]);
                                                                }
                                                                $descrip = isset($idRowCode) ? $idRowCode : "";
                                                                // print_r($ori_id);
                                                        ?>
                                                                <tr>
                                                                    <td><?php echo  $descrip; ?></td>
                                                                    <td><?php echo  $valueB['hos_ori_pre']; ?></td>
                                                                    <td><?php echo  $valueB['hos_ori_can']; ?></td>
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

        die();
    } else if ($strTipoValidacion == "validacion_nombre") {

        require_once "../../data/conexion/tmfAdm.php";

        $arrTablePatientGen = array();
        $var_consulta = "SELECT * 
                                    FROM ctg_pacientes 
                                    WHERE ctg_pac_code =' $idPac '
                                    LIMIT 1";
        $sql = pg_query($rmfAdm, $var_consulta);
        $totalArticle = pg_num_rows($sql);
        //print_r($var_consulta);

        while ($rTMP = pg_fetch_assoc($sql)) {

            $arrTablePatientGen[$rTMP["id"]]["id"]                                         = $rTMP["id"];
            $arrTablePatientGen[$rTMP["id"]]["ctg_pac_dpi"]                                = $rTMP["ctg_pac_dpi"];
            $arrTablePatientGen[$rTMP["id"]]["ctg_pac_code"]                               = $rTMP["ctg_pac_code"];
            $arrTablePatientGen[$rTMP["id"]]["ctg_pac_codigo"]                             = $rTMP["ctg_pac_codigo"];
            $arrTablePatientGen[$rTMP["id"]]["ctg_pac_mem_id"]                             = $rTMP["ctg_pac_mem_id"];
            $arrTablePatientGen[$rTMP["id"]]["ctg_pac_nombres"]                            = $rTMP["ctg_pac_nombres"];
            $arrTablePatientGen[$rTMP["id"]]["ctg_pac_apellidos"]                          = $rTMP["ctg_pac_apellidos"];
            $arrTablePatientGen[$rTMP["id"]]["ctg_pac_sexo"]                               = $rTMP["ctg_pac_sexo"];
            $arrTablePatientGen[$rTMP["id"]]["ctg_pac_civil"]                              = $rTMP["ctg_pac_civil"];
            $arrTablePatientGen[$rTMP["id"]]["ctg_pac_nac_dia"]                            = $rTMP["ctg_pac_nac_dia"];
            $arrTablePatientGen[$rTMP["id"]]["ctg_pac_nac_mes"]                            = $rTMP["ctg_pac_nac_mes"];
            $arrTablePatientGen[$rTMP["id"]]["ctg_pac_nac_ano"]                            = $rTMP["ctg_pac_nac_ano"];
            $arrTablePatientGen[$rTMP["id"]]["ctg_pac_dir"]                                = $rTMP["ctg_pac_dir"];
            $arrTablePatientGen[$rTMP["id"]]["ctg_pac_zona"]                               = $rTMP["ctg_pac_zona"];
            $arrTablePatientGen[$rTMP["id"]]["ctg_pac_dep"]                                = $rTMP["ctg_pac_dep"];
            $arrTablePatientGen[$rTMP["id"]]["ctg_pac_mun"]                                = $rTMP["ctg_pac_mun"];
            $arrTablePatientGen[$rTMP["id"]]["ctg_pac_telcel"]                             = $rTMP["ctg_pac_telcel"];
            $arrTablePatientGen[$rTMP["id"]]["ctg_pac_telpar"]                             = $rTMP["ctg_pac_telpar"];
            $arrTablePatientGen[$rTMP["id"]]["ctg_pac_teltra"]                             = $rTMP["ctg_pac_teltra"];
            $arrTablePatientGen[$rTMP["id"]]["ctg_pac_email"]                              = $rTMP["ctg_pac_email"];
            $arrTablePatientGen[$rTMP["id"]]["ctg_pac_sol_dt"]                             = $rTMP["ctg_pac_sol_dt"];
            $arrTablePatientGen[$rTMP["id"]]["ctg_pac_aut_dt"]                             = $rTMP["ctg_pac_aut_dt"];
            $arrTablePatientGen[$rTMP["id"]]["ctg_pac_hab_dt"]                             = $rTMP["ctg_pac_hab_dt"];
            $arrTablePatientGen[$rTMP["id"]]["ctg_pac_ven_dt"]                             = $rTMP["ctg_pac_ven_dt"];
            $arrTablePatientGen[$rTMP["id"]]["ctg_pac_pass"]                               = $rTMP["ctg_pac_pass"];
            $arrTablePatientGen[$rTMP["id"]]["ctg_pac_username"]                           = $rTMP["ctg_pac_username"];
            $arrTablePatientGen[$rTMP["id"]]["ctg_pac_estatus"]                            = $rTMP["ctg_pac_estatus"];
        }
        pg_free_result($sql);
    ?>
        <div class="col-md-12 tableFixHead">
            <?php
            if (is_array($arrTablePatientGen) && (count($arrTablePatientGen) > 0)) {
                reset($arrTablePatientGen);
                foreach ($arrTablePatientGen as $rTMP['key'] => $rTMP['value']) {
            ?>
                    <div class="modal fade" id="ModalCliente" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title w-100" id="myModalLabel">CLIENTE</h4>
                                    <button type="button" class="CERRAR" data-dismiss="modal" aria-label="CERRAR">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="card card-primary collapsed-card">
                                        <div class="card-body ">
                                            <div class="row">
                                                <div class="form-group col-md-3">
                                                    <label for="exampleInputEmail1" class=" color-label">No. De Documento Personal </label>
                                                    <input type="hidden" class="form-control" id="id" name="id">
                                                    <input type="text" class="form-control" id="DocPersonal" name="DocPersonal" maxlength="13" value="<?php echo  $rTMP["value"]['ctg_pac_dpi']; ?>" disabled>
                                                    <input type="hidden" class="form-control" id="Hid_DocPersonal" name="Hid_DocPersonal" maxlength="13">
                                                    <span class="bmd-help"> Ingresa numero de documento personal </span>
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <label for="exampleInputEmail1" class=" color-label">Nombre </label>
                                                    <input type="text" class="form-control" id="Name" name="Name" value="<?php echo  $rTMP["value"]['ctg_pac_nombres']; ?>" disabled>
                                                    <span class="bmd-help"> Ingresas tus dos nombres</span>
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <label for="exampleInputEmail1" class=" color-label">Apellido </label>
                                                    <input type="text" class="form-control" id="LastName" name="LastName" value="<?php echo  $rTMP["value"]['ctg_pac_apellidos']; ?>" disabled>
                                                    <span class="bmd-help"> Ingresa tus dos apellidos </span>
                                                </div>
                                                <div class="form-group col-md-1">
                                                    <label for="exampleInputEmail1" class=" color-label">Zona </label>
                                                    <input type="email" class="form-control" id="Zona" name="Zona" value="<?php echo  $rTMP["value"]['ctg_pac_zona']; ?>" disabled>
                                                </div>
                                                <div class="form-group col-md-3">
                                                    <label for="exampleInputEmail1" class=" color-label">Telefono </label>
                                                    <input type="email" class="form-control" id="Tell" name="Tell" value="<?php echo  $rTMP["value"]['ctg_pac_telcel']; ?>" disabled>
                                                    <span class="bmd-help"> Ingresa tu numero telefonico </span>
                                                </div>
                                                <div class="form-group col-md-3">
                                                    <label for="exampleInputEmail1" class=" color-label">Correo </label>
                                                    <input type="email" class="form-control" id="Mail" name="Mail" value="<?php echo  $rTMP["value"]['ctg_pac_eme_email']; ?>" disabled>
                                                    <span class="bmd-help"> Ingresa tu correo electronico </span>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="exampleTextarea" class=" color-label">Direccion</label>
                                                    <textarea class="form-control" id="Adress" name="Adress" rows="3" disabled><?php echo  $rTMP["value"]['ctg_pac_dir']; ?></textarea>
                                                    <span class="bmd-help">Ingresa tu direccion exacta </span>
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
    <?PHP
                }
            }
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
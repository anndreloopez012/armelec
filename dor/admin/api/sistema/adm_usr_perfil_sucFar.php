<?php
//GLOBAL variableId
require_once '../../api/var_global.php';

// VALIDATION INSERT UPDATE DELETE
if (isset($_GET["validaciones"]) && !empty($_GET["validaciones"])) {

    require_once '../../../api/globalFunctions.php';

    require_once '../../../data/conexion/tmfAdm.php';
    require_once '../../../data/conexion/tmlFar.php';
    require_once '../../../data/conexion/tmlMed.php';

    require_once '../../../api/config.php';

    $usuarioId = $_SESSION['adm_usr_code'];

    $codeId = isset($_POST["codeId"]) ? $_POST["codeId"]  : '';

    $ctg_far_nomcom = isset($_POST["ctg_far_nomcom"]) ? $_POST["ctg_far_nomcom"]  : '';
    $ctg_far_nit = isset($_POST["ctg_far_nit"]) ? $_POST["ctg_far_nit"]  : '';
    $ctg_far_suc = isset($_POST["ctg_far_suc"]) ? $_POST["ctg_far_suc"]  : '';
    $ctg_far_dir = isset($_POST["ctg_far_dir"]) ? $_POST["ctg_far_dir"]  : '';
    $ctg_far_zona = isset($_POST["ctg_far_zona"]) ? $_POST["ctg_far_zona"]  : '';
    $region = isset($_POST["region"]) ? $_POST["region"]  : '';
    $distrito = isset($_POST["distrito"]) ? $_POST["distrito"]  : '';
    $ctg_far_tels = isset($_POST["ctg_far_tels"]) ? $_POST["ctg_far_tels"]  : '';
    $ctg_far_email = isset($_POST["ctg_far_email"]) ? $_POST["ctg_far_email"]  : '';

    $username = isset($_POST["username"]) ? $_POST["username"]  : '';
    $ctg_far_enc_dpi = isset($_POST["ctg_far_enc_dpi"]) ? $_POST["ctg_far_enc_dpi"]  : '';
    $ctg_far_enc_nombre = isset($_POST["ctg_far_enc_nom"]) ? $_POST["ctg_far_enc_nom"]  : '';
    $password = isset($_POST["password"]) ? $_POST["password"]  : '';
    $password_conf = isset($_POST["password_conf"]) ? $_POST["password_conf"]  : '';

    $ctg_far_contrato = isset($_POST["ctg_far_contrato"]) ? $_POST["ctg_far_contrato"]  : '';
    $adm_usr_contrato = isset($ctg_far_contrato) ? $ctg_far_contrato  : '';

    $adm_usr_tipo = 'far';
    $sucursal = 1;
    $ctg_far_censuc = 1;
    $status_actual = 1;
    $ctg_far_sta = 1;
    $ctg_far_estatus = 0;
    $ctg_far_sol_dt = date("Y-m-d");
    $ctg_far_aut_dt = date("Y-m-d");

    $ctg_far_ven_dt_Y = date("Y");
    $ctg_far_ven_dt_Y = $ctg_far_ven_dt_Y + 1;
    $ctg_far_ven_dt_m = date("m");
    $ctg_far_ven_dt_d = date("d");
    $ctg_far_ven_dt = $ctg_far_ven_dt_Y . "-" . $ctg_far_ven_dt_m . "-" . $ctg_far_ven_dt_d;
    $ctg_far_dt = date("Y-m-d");
    $ctg_far_ven_dt = date('Y-m-d', strtotime($ctg_far_dt . " + 90 day"));

    $fecha = date('d-m-Y');

    $strTipoValidacion = isset($_REQUEST["validaciones"]) ? $_REQUEST["validaciones"] : '';
    if ($strTipoValidacion == "proces") {

        header('Content-Type: application/json');

        $rs = pg_query($rmfAdm, "SELECT CAST ( ctg_far_code AS integer) from ctg_farmacias_sucursales ORDER BY ctg_far_code DESC");

        if ($row = pg_fetch_array($rs)) {
            $idRow = trim($row[0]);
        }
        $variableCode_ = isset($idRow) ? $idRow  : 0;
        $variableCode = $variableCode_ + 1;
        $val = 2;
        $var_consulta = "INSERT INTO ctg_farmacias_sucursales(ctg_far_contrato,ctg_far_nit,ctg_far_nomcom,ctg_far_suc,ctg_far_code,ctg_far_dir,ctg_far_zona,ctg_far_dep,ctg_far_mun,ctg_far_tels,ctg_far_email,ctg_far_enc_dpi,ctg_far_enc_nombre,ctg_far_username,ctg_far_pass,ctg_far_estatus,ctg_far_censuc,ctg_far_sol_dt,ctg_far_aut_dt,ctg_far_ven_dt,ctg_far_sta,ctg_far_dt,ctg_far_usr) VALUES ('$ctg_far_contrato','$ctg_far_nit','$ctg_far_nomcom','$ctg_far_suc','$variableCode','$ctg_far_dir','$ctg_far_zona','$region','$distrito','$ctg_far_tels','$ctg_far_email','$ctg_far_enc_dpi','$ctg_far_enc_nombre','$username','$password','$ctg_far_estatus','$ctg_far_censuc','$ctg_far_sol_dt','$ctg_far_aut_dt','$ctg_far_ven_dt','$ctg_far_sta','$ctg_far_dt','$usuarioId');";
        if (pg_query($rmfAdm, $var_consulta)) {
            $arrInfo['status'] = $val;
        } else {
            $arrInfo['status'] = 0;
            $arrInfo['error'] = $var_consulta;
        }
        // print_r($var_consulta);
       //print json_encode($arrInfo);

        $usuarioCode = $variableCode;
        $val = 1;
        $var_consulta = "INSERT INTO web_users(mail,username,adm_usr_tipo,adm_usr_code,password,nombre_completo,adm_usr_contrato,status_actual,adm_date_ven,sucursal) VALUES ('$ctg_far_email','$username','$adm_usr_tipo','$usuarioCode','".md5($password)."','$ctg_far_nomcom','$ctg_far_contrato',$status_actual,'$ctg_far_ven_dt',$sucursal);";
        if (pg_query($rmfAdm, $var_consulta)) {
            $arrInfo['status'] = $val;
        } else {
            $arrInfo['status'] = 0;
            $arrInfo['error'] = $var_consulta;
        }

        $var_consulta = "INSERT INTO ctg_membresias(ctg_mem_id,ctg_mem_type,ctg_mem_stat,ctg_mem_fec,ctg_mem_fec_venc,ctg_mem_estatus,ctg_mem_formpag,ctg_mem_valor,ctg_mem_cuotas) VALUES ('$usuarioCode','$adm_usr_tipo','1','now()','$ctg_pac_far_dt','2','0',0,3);";
        if (pg_query($rmfAdm, $var_consulta)) {
            $arrInfo['status'] = $val;
        } else {
            $arrInfo['status'] = 0;
            $arrInfo['error'] = $var_consulta;
        }
  

        if ($val) {
            $subject_ = 'BIENVENIDA FARMACIA SUCURSAL A VISUALMED.online';
            $address_  = $ctg_far_email;
            $mailContent = '<b>BIENVENIDA FARMACIA SUCURSAL A VISUALMED.online</b><br><br>
            <table class="default" width="100%">
	<tr border="1">
		<td align="center" bgcolor= "#0464fc">
			<img src="https://i.ibb.co/MZ35wKk/vmo-header2-1.png" alt="vmo-header2-1" border="0">
 		</td>
	</tr>
</table>
            <table class="default" width="100%">
            <tr border="1">
            <td align="center"><b>TE DAMOS LA MAS CORDIAL BIENVENIDA</b></td><br>
            </tr>
            </table><br><br>

            <b>Estimado:</b><b>' . $ctg_far_nomcom .' '. $ctg_far_suc. '</b><br><br>
            <b>Fecha:</b><b>' . $fecha . '</b><br><br>

            <b>Hemos registrado un perfil con los datos de tu sucursal de tu casa matriz en nuestra plataforma.
            Con este usuario podras acceder al modulo de FARMACIAS que se encuentra en la pagina
            <a href="www.visualmed.online">www.visualmed.online</a> y actualizar la informacion de tu perfil, ver las ordenes recibidas en
            lineas y generar reportes entre otras utilidades.</a><br><br>

            <b>Usuario:</b><a>'.$username.'</a><br>
            <b>Contraseña:</b><a>'.$password.'</a><br><br>

            <b>Su menbresia vence el:</b><a>'.$ctg_far_ven_dt.'</a><br>

            <b>¡Bienvenido!!</a><br><br>
            <table class="default" width="100%">	
	<tr border="1">	
		<td align="center" bgcolor= "#0464fc">	
			<img src="https://i.ibb.co/ckwzNgQ/vmo-footer2-1.png" alt="vmo-footer2-1" border="0">
		</td>
	</tr>
</table>';

            require_once "../../../PHPMAILER/index.php";
        }
        ////print_r($var_consulta);
        print json_encode($arrInfo);

        $variableId = $variableCode;

        if ($val) {
            $val = 3;
            $tabla1 = "far" . $variableId . "prod";
            $llave1 = "far" . $variableId . "prod_pkey";

            $sql = "CREATE TABLE IF NOT EXISTS {$tabla1}
            (
              far_pro_id serial,
              far_pro_cod character varying(20) NOT NULL, -- Id del producto de referencia
              far_pro_contador integer, -- Contador de productos ordenados
              far_pro_sta char(1), -- estatus del registro 1=creacion 2=edicion 3=borrado
              far_pro_dt timestamp without time zone, -- fecha de actualizacion
              far_pro_usr character varying(15), -- ID del usuario que actualiza
              CONSTRAINT {$llave1} PRIMARY KEY (far_pro_cod)
            );
            COMMENT ON COLUMN {$tabla1}.far_pro_id IS 'Id del producto secuencial';
            COMMENT ON COLUMN {$tabla1}.far_pro_cod IS 'Id del producto de referencia';
            COMMENT ON COLUMN {$tabla1}.far_pro_contador IS 'Contador de productos ordenados';
            COMMENT ON COLUMN {$tabla1}.far_pro_sta IS 'estatus del registro 1=creacion 2=edicion 3=borrado';
            COMMENT ON COLUMN {$tabla1}.far_pro_dt IS 'fecha de actualizacion';
            COMMENT ON COLUMN {$tabla1}.far_pro_usr IS 'ID del usuario que actualiza';
            ";
            if (pg_query($tmfFar, $sql)) {
                $arrInfo['status'] = $val;
            } else {
                $arrInfo['status'] = 0;
                $arrInfo['error'] = $sql;
            }
           //print_r('<br>');
           //print_r($sql);
           //print json_encode($arrInfo);

            $val = 4;
            $tabla1 = "far" . $variableId . "orden";
            $llave1 = "far" . $variableId . "ord_pkey";

            $sql = "CREATE TABLE IF NOT EXISTS {$tabla1}
               (
                far_ord_id serial,
                far_ord_cod integer NOT NULL, -- Id de orden
                far_ord_nomcom character varying(100) NOT NULL, -- Nombre comercial del establecimiento
                far_ord_tipo char(1) NOT NULL, -- 1=orden del medico 2=orden de internet 3=orden en tienda
                far_ord_fec timestamp without time zone NOT NULL, -- fecha de orden
                far_ord_med_id character varying(10) NOT NULL, -- ID del medico
                far_ord_pac_id character varying(20) NOT NULL, -- ID del paciente
                far_ord_pac_nombre character varying(100) NOT NULL, -- Nombre del paciente
                far_ord_pac_mem_id character varying(20) NOT NULL, -- ID de la membresia
                far_ord_por_fac numeric(2,0), -- Porcentaje de descuento de la farmacia
                far_ord_por_laf numeric(2,0), -- Porcentaje de descuento del laboratorio farmaceutico
                far_ord_valor numeric(15,2), -- Valor total de la orden
                far_ord_valor_desf numeric(15,2), -- Valor descuento farmacia
                far_ord_valor_desl numeric(15,2), -- valor descuento laboratorio
                far_ord_valor_iva numeric(15,2), -- valor iva
                far_ord_total numeric(15,2), -- valor total
                far_ord_est char(1), -- Estatus de la orden  1=emitida 2=entregada 3=anulada
                far_ord_sta char(1), -- estatus del registiro 1=creacion 2=edicion 3=borrado
                far_ord_dt timestamp without time zone, -- fecha de actualizacion
                far_ord_usr character varying(15), -- ID del usuario que actualiza
                CONSTRAINT {$llave1} PRIMARY KEY (far_ord_cod, far_ord_tipo)
                );
                COMMENT ON COLUMN {$tabla1}.far_ord_id IS 'Id secuencial';
                COMMENT ON COLUMN {$tabla1}.far_ord_cod IS 'Id de orden';
                COMMENT ON COLUMN {$tabla1}.far_ord_nomcom IS 'Nombre comercial del establecimiento';
                COMMENT ON COLUMN {$tabla1}.far_ord_tipo IS '1=orden del medico 2=orden de internet 3=orden en tienda';
                COMMENT ON COLUMN {$tabla1}.far_ord_fec IS 'fecha de orden';
                COMMENT ON COLUMN {$tabla1}.far_ord_med_id IS 'ID del medico';
                COMMENT ON COLUMN {$tabla1}.far_ord_pac_id IS 'ID del paciente';
                COMMENT ON COLUMN {$tabla1}.far_ord_pac_nombre IS 'Nombre del paciente';
                COMMENT ON COLUMN {$tabla1}.far_ord_pac_mem_id IS 'ID de la membresia';
                COMMENT ON COLUMN {$tabla1}.far_ord_por_fac IS 'Porcentaje de descuento de la farmacia';
                COMMENT ON COLUMN {$tabla1}.far_ord_por_laf IS 'Porcentaje de descuento del laboratorio farmaceutico';
                COMMENT ON COLUMN {$tabla1}.far_ord_valor IS 'Valor total de la orden';
                COMMENT ON COLUMN {$tabla1}.far_ord_valor_desf IS 'Valor descuento farmacia';
                COMMENT ON COLUMN {$tabla1}.far_ord_valor_desl IS 'valor descuento laboratorio';
                COMMENT ON COLUMN {$tabla1}.far_ord_valor_iva IS 'valor iva';
                COMMENT ON COLUMN {$tabla1}.far_ord_total IS 'valor total';
                COMMENT ON COLUMN {$tabla1}.far_ord_est IS 'Estatus de la orden  1=emitida 2=entregada 3=anulada';
                COMMENT ON COLUMN {$tabla1}.far_ord_sta IS 'estatus del registiro 1=creacion 2=edicion 3=borrado';
                COMMENT ON COLUMN {$tabla1}.far_ord_dt IS 'fecha de actualizacion';
                COMMENT ON COLUMN {$tabla1}.far_ord_usr IS 'ID del usuario que actualiza';
                ";;
            if (pg_query($tmfFar, $sql)) {
                $arrInfo['status'] = $val;
            } else {
                $arrInfo['status'] = 0;
                $arrInfo['error'] = $sql;
            }
            // print_r($sql);
            //print json_encode($arrInfo);

            $val = 5;
            $tabla1 = "far" . $variableId . "orden_prod";
            $llave1 = "far" . $variableId . "orp_pkey";

            $sql = "CREATE TABLE IF NOT EXISTS {$tabla1}
                (
                far_orp_id serial,
                far_orp_cod integer NOT NULL, -- Id de orden de referencia
                far_orp_pro_id character varying(20) NOT NULL, -- ID del producto
                far_orp_pre numeric(15,2) NOT NULL, -- precio
                far_orp_can integer, -- cantidad
                far_orp_desf numeric(10,2), -- descuento farmacia
                far_orp_desl numeric(10,2), -- descuento laboratorio
                far_orp_valor numeric(10,2), -- subtotal
                far_orp_sta char(1), -- estatus del registro 1=creacion 2=edicion 3=borrado
                far_orp_dt timestamp without time zone, -- fecha de actualizacion
                far_orp_usr character varying(15), -- ID del usuario que actualiza
                CONSTRAINT {$llave1} PRIMARY KEY (far_orp_cod, far_orp_pro_id)
                );
                COMMENT ON COLUMN {$tabla1}.far_orp_id IS 'Id de orden secuencial';
                COMMENT ON COLUMN {$tabla1}.far_orp_cod IS 'Id de orden de referencia';
                COMMENT ON COLUMN {$tabla1}.far_orp_pro_id IS 'ID del producto';
                COMMENT ON COLUMN {$tabla1}.far_orp_pre IS 'precio';
                COMMENT ON COLUMN {$tabla1}.far_orp_can IS 'cantidad';
                COMMENT ON COLUMN {$tabla1}.far_orp_desf IS 'descuento farmacia';
                COMMENT ON COLUMN {$tabla1}.far_orp_desl IS 'descuento laboratorio';
                COMMENT ON COLUMN {$tabla1}.far_orp_valor IS 'subtotal';
                COMMENT ON COLUMN {$tabla1}.far_orp_sta IS 'estatus del registro 1=creacion 2=edicion 3=borrado';
                COMMENT ON COLUMN {$tabla1}.far_orp_dt IS 'fecha de actualizacion';
                COMMENT ON COLUMN {$tabla1}.far_orp_usr IS 'ID del usuario que actualiza';";
            if (pg_query($tmfFar, $sql)) {
                $arrInfo['status'] = $val;
            } else {
                $arrInfo['status'] = 0;
                $arrInfo['error'] = $sql;
            }
            // print_r($sql);
            //print json_encode($arrInfo);
        }

        die();
    } else if ($strTipoValidacion == "delete") {
        $val = 2;
        $var_consulta = "DELETE FROM ctg_farmacias_sucursales WHERE ctg_far_code = '$codeId';";
        if (pg_query($rmfAdm, $var_consulta)) {
            $arrInfo['status'] = $val;
        } else {
            $arrInfo['status'] = 0;
            $arrInfo['error'] = $var_consulta;
        }
        // //print_r($var_consulta);
        //print json_encode($arrInfo);

        $val = 1;
        $var_consulta = "DELETE FROM web_users WHERE adm_usr_code = '$codeId';";
        if (pg_query($rmfAdm, $var_consulta)) {
            $arrInfo['status'] = $val;
        } else {
            $arrInfo['status'] = 0;
            $arrInfo['error'] = $var_consulta;
        }
        ////print_r($var_consulta);
        print json_encode($arrInfo);

        if ($val) {
            $val = 3;
            $tabla1 = "far" . $codeId . "prod";
            $sql = "DROP TABLE {$tabla1} ;";
            if (pg_query($tmfLab, $sql)) {
                $arrInfo['status'] = $val;
            } else {
                $arrInfo['status'] = 0;
                $arrInfo['error'] = $sql;
            }
            //print_r('<br>');
            //print_r($sql);
            //print json_encode($arrInfo);

            $val = 4;
            $tabla1 = "far" . $codeId . "orden";
            $sql = "DROP TABLE {$tabla1};";
            if (pg_query($tmfLab, $sql)) {
                $arrInfo['status'] = $val;
            } else {
                $arrInfo['status'] = 0;
                $arrInfo['error'] = $sql;
            }
            // print_r($sql);
           // print json_encode($arrInfo);

            $val = 5;
            $tabla1 = "far" . $codeId . "orden_prod";
            $sql = "DROP TABLE {$tabla1};";
            if (pg_query($tmfLab, $sql)) {
                $arrInfo['status'] = $val;
            } else {
                $arrInfo['status'] = 0;
                $arrInfo['error'] = $sql;
            }
            // print_r($sql);
          //  print json_encode($arrInfo);
        }

        die();
    }

    //DIBUJO DE TABLA PRODUCTOS CATEGORIAS
    else if ($strTipoValidacion == "busqueda_tabla") {
        $strSearch = isset($_POST["Search"]) ? $_POST["Search"]  : '';

        $strFilter = "";
        if (!empty($strSearch)) {
            $strFilter = " WHERE ( UPPER(ctg_far_nomcom) LIKE UPPER('%{$strSearch}%') OR UPPER(ctg_far_username) LIKE UPPER('%{$strSearch}%') ) ";
        }

        $arrUsuarios = array();
        $var_consulta = "SELECT * 
        FROM ctg_farmacias_sucursales 
        $strFilter
        ORDER BY ctg_far_nomcom";

        $qTMP = pg_query($rmfAdm, $var_consulta);
        //echo $var_consulta;
        while ($rTMP = pg_fetch_assoc($qTMP)) {

            $arrUsuarios[$rTMP["id"]]["id"]                          = $rTMP["id"];
            $arrUsuarios[$rTMP["id"]]["ctg_far_contrato"]            = $rTMP["ctg_far_contrato"];
            $arrUsuarios[$rTMP["id"]]["ctg_far_nomcom"]              = $rTMP["ctg_far_nomcom"];
            $arrUsuarios[$rTMP["id"]]["ctg_far_suc"]                 = $rTMP["ctg_far_suc"];
            $arrUsuarios[$rTMP["id"]]["ctg_far_username"]            = $rTMP["ctg_far_username"];
        }
        pg_free_result($qTMP);

?>
        <div class="col-md-12 tableFixHead">
            <table id="tableData" class="table table-bordered table-striped table-hover table-sm">
                <thead>
                    <tr class="table-info">
                        <th>No. Contrato</th>
                        <th>Nombre Completo</th>
                        <th>Sucursal</th>
                        <th>Nombre de Usuario</th>
                        <th>-</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (is_array($arrUsuarios) && (count($arrUsuarios) > 0)) {
                        $intContador = 1;
                        reset($arrUsuarios);
                        foreach ($arrUsuarios as $rTMP['key'] => $rTMP['value']) {
                    ?>
                            <tr>
                                <td whidth='%10'><?php echo  $rTMP["value"]['ctg_far_contrato']; ?></td>
                                <td whidth='%30'><?php echo  $rTMP["value"]['ctg_far_nomcom']; ?></td>
                                <td whidth='%30'><?php echo  $rTMP["value"]['ctg_far_suc']; ?></td>
                                <td whidth='%30'><?php echo  $rTMP["value"]['ctg_far_username']; ?></td>
                                <td whidth='%30' style="cursor:pointer;" onclick="fntSelect('<?php print $intContador; ?>');"><i class="fad fa-trash-alt"></i></td>
                            </tr>
                            <input type="hidden" name="hid_id<?php print $intContador; ?>" id="hid_id<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['id']; ?>">
                    <?PHP
                            $intContador++;
                        }

                        die();
                    }
                    ?>
                </tbody>
            </table>
        </div>
    <?php
        die();
    } else if ($strTipoValidacion == "busqueda_tabla_far") {
        $strSearch = isset($_POST["Search"]) ? $_POST["Search"]  : '';

        $strFilter = "";
        if (!empty($strSearch)) {
            $strFilter = " WHERE ( UPPER(ctg_fac_razsoc) LIKE UPPER('%{$strSearch}%') ) ";
        }

        $arrFar = array();
        $var_consulta = "SELECT * 
        FROM ctg_farmacias 
        $strFilter
        ORDER BY ctg_fac_razsoc";

        $qTMP = pg_query($rmfAdm, $var_consulta);
        //echo $var_consulta;
        while ($rTMP = pg_fetch_assoc($qTMP)) {

            $arrFar[$rTMP["id"]]["id"]                          = $rTMP["id"];
            $arrFar[$rTMP["id"]]["ctg_fac_razsoc"]            = $rTMP["ctg_fac_razsoc"];
            $arrFar[$rTMP["id"]]["ctg_fac_contrato"]            = $rTMP["ctg_fac_contrato"];
            $arrFar[$rTMP["id"]]["ctg_fac_nit"]            = $rTMP["ctg_fac_nit"];
            $arrFar[$rTMP["id"]]["ctg_fac_nom"]            = $rTMP["ctg_fac_nom"];
        }
        pg_free_result($qTMP);

?>
        <div class="col-md-12 tableFixHead">
            <table id="tableData" class="table table-bordered table-striped table-hover table-sm">
                <thead>
                    <tr class="table-info">
                        <th>No. Contrato</th>
                        <th>Nombre Completo</th>
                        <th>Nombre Comercial</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (is_array($arrFar) && (count($arrFar) > 0)) {
                        $intContador = 1;
                        reset($arrFar);
                        foreach ($arrFar as $rTMP['key'] => $rTMP['value']) {
                    ?>
                            <tr style="cursor:pointer;" data-dismiss="modal" onclick="fntSelectFar('<?php print $intContador; ?>');  ">
                                <td whidth='%10'><?php echo  $rTMP["value"]['ctg_fac_contrato']; ?></td>
                                <td whidth='%10'><?php echo  $rTMP["value"]['ctg_fac_razsoc']; ?></td>
                                <td whidth='%10'><?php echo  $rTMP["value"]['ctg_fac_nom']; ?></td>
                            </tr>
                            <input type="hidden" name="hid_id<?php print $intContador; ?>" id="hid_id<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['id']; ?>">
                            <input type="hidden" name="hid_nom<?php print $intContador; ?>" id="hid_nom<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['ctg_fac_razsoc']; ?>">
                            <input type="hidden" name="hid_contrato<?php print $intContador; ?>" id="hid_contrato<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['ctg_fac_contrato']; ?>">
                            <input type="hidden" name="hid_nit<?php print $intContador; ?>" id="hid_nit<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['ctg_fac_nit']; ?>">
                    <?PHP
                            $intContador++;
                        }

                        die();
                    }
                    ?>
                </tbody>
            </table>
        </div>
    <?php
        die();
    } 
    else if ($strTipoValidacion == "val_usuario") {
        $val = 1;
        $var_consulta = pg_query($rmfAdm, "SELECT COUNT(username) FROM web_users WHERE UPPER(username) = UPPER('$username') LIMIT 1;");
        if ($row = pg_fetch_array($var_consulta)) {
            $idRow = trim($row[0]);
        }
        $usuarioCode = isset($idRow) ? $idRow  : 0;

        if ($usuarioCode >= $val) {
            $arrInfo['status'] = $val;
        } else {
            $arrInfo['status'] = 0;
            //$arrInfo['error'] = $var_consulta;
        }
        // //print_r($var_consulta);
        print json_encode($arrInfo);

        die();
    }else if ($strTipoValidacion == "val_mail") {

        $val = 1;
        $var_consulta = pg_query($rmfAdm, "SELECT COUNT(sru_id) FROM sol_regis_user WHERE email = '$ctg_ase_email' AND sru_modulo = 'far' LIMIT 1;");
        if ($row = pg_fetch_array($var_consulta)) {
            $idRow = trim($row[0]);
        }
        $usuarioCode = isset($idRow) ? $idRow  : 0;

        $var_consulta = pg_query($rmfAdm, "SELECT COUNT(adm_usr_id) FROM web_users WHERE mail = '$ctg_far_email' AND adm_usr_tipo = 'far' LIMIT 1;");
        if ($row = pg_fetch_array($var_consulta)) {
            $idRow = trim($row[0]);
        }
        $usuario = isset($idRow) ? $idRow  : 0;

        if ($usuarioCode >= $val || $usuario >= $val) {
            $arrInfo['status'] = $val;
        } else {
            $arrInfo['status'] = 0;
            //$arrInfo['error'] = $var_consulta;
        }
        // print_r($var_consulta);
        print json_encode($arrInfo);

        die();
    } else if ($strTipoValidacion == "val_com_empresa") {
        $val = 1;

        $var_consulta = pg_query($rmfAdm, "SELECT COUNT(ctg_far_suc) FROM ctg_farmacias_sucursales WHERE UPPER(ctg_far_suc) = UPPER('$ctg_far_suc') ;");

        if ($row = pg_fetch_array($var_consulta)) {
            $idRow = trim($row[0]);
        }
        $usuarioCode = isset($idRow) ? $idRow  : 0;

        if ($usuarioCode >= $val) {
            $arrInfo['status'] = $val;
        } else {
            $arrInfo['status'] = 0;
            //$arrInfo['error'] = $var_consulta;
        }
        ////print_r($var_consulta);

        print json_encode($arrInfo);

        die();
    } 
    else if ($strTipoValidacion == "dibujo_dropdow_dep") {

        require_once "../../../data/conexion/tmfWeb.php";
        $arrDepartamento = array();
        $var_consulta = "SELECT * 
                            FROM ctg_geografia 
                            WHERE  length(geo_id) <= 3
                            AND geo_pais = '$paisDrop'
                            ORDER BY geo_parent";
        $sql = pg_query($tmfWeb, $var_consulta);
        $totalArticle = pg_num_rows($sql);


        while ($rTMP = pg_fetch_assoc($sql)) {

            $arrDepartamento[$rTMP["id"]]["id"]                                         = $rTMP["id"];
            $arrDepartamento[$rTMP["id"]]["geo_id"]                                         = $rTMP["geo_id"];
            $arrDepartamento[$rTMP["id"]]["geo_desc"]                                         = $rTMP["geo_desc"];
            $arrDepartamento[$rTMP["id"]]["geo_obs"]                                         = $rTMP["geo_obs"];
            $arrDepartamento[$rTMP["id"]]["geo_parent"]                                         = $rTMP["geo_parent"];
            $arrDepartamento[$rTMP["id"]]["geo_moneda"]                                         = $rTMP["geo_moneda"];
            $arrDepartamento[$rTMP["id"]]["geo_cambio"]                                         = $rTMP["geo_cambio"];
            $arrDepartamento[$rTMP["id"]]["geo_cambio_dt"]                                         = $rTMP["geo_cambio_dt"];
            $arrDepartamento[$rTMP["id"]]["geo_sta"]                                         = $rTMP["geo_sta"];
            $arrDepartamento[$rTMP["id"]]["geo_usr"]                                         = $rTMP["geo_usr"];
            $arrDepartamento[$rTMP["id"]]["geo_dt"]                                         = $rTMP["geo_dt"];
            $arrDepartamento[$rTMP["id"]]["geo_pais"]                                         = $rTMP["geo_pais"];
            $arrDepartamento[$rTMP["id"]]["geo_tel"]                                         = $rTMP["geo_tel"];
            $arrDepartamento[$rTMP["id"]]["geo_flag"]                                         = $rTMP["geo_flag"];
        }
        pg_free_result($sql);
        //print_r($var_consulta);


    ?>
        <option value="0">Seleccionar</option>
        <?php
        if (is_array($arrDepartamento) && (count($arrDepartamento) > 0)) {
            reset($arrDepartamento);
            foreach ($arrDepartamento as $rTMP['key'] => $rTMP['value']) {
        ?>
                <option value="<?php echo  $rTMP["value"]['geo_id']; ?>"><?php echo  $rTMP["value"]['geo_desc']; ?></option>

        <?PHP
            }
        }
        ?>
    <?php
        die();
    } else if ($strTipoValidacion == "dibujo_dropdow_mun") {
        require_once "../../../data/conexion/tmfWeb.php";
        $strReg = isset($_POST["region"]) ? $_POST["region"]  : '';

        $arrMunicipio = array();
        $var_consulta = "SELECT * 
                            FROM ctg_geografia 
                            WHERE  geo_pais = '$paisDrop'
                            AND geo_parent = '$strReg'
                            ORDER BY geo_id";
        $sql = pg_query($tmfWeb, $var_consulta);
        $totalArticle = pg_num_rows($sql);
        //print_r($var_consulta);
        //print_r($strReg);


        while ($rTMP = pg_fetch_assoc($sql)) {

            $arrMunicipio[$rTMP["id"]]["id"]                                         = $rTMP["id"];
            $arrMunicipio[$rTMP["id"]]["geo_id"]                                         = $rTMP["geo_id"];
            $arrMunicipio[$rTMP["id"]]["geo_desc"]                                         = $rTMP["geo_desc"];
            $arrMunicipio[$rTMP["id"]]["geo_obs"]                                         = $rTMP["geo_obs"];
            $arrMunicipio[$rTMP["id"]]["geo_parent"]                                         = $rTMP["geo_parent"];
            $arrMunicipio[$rTMP["id"]]["geo_moneda"]                                         = $rTMP["geo_moneda"];
            $arrMunicipio[$rTMP["id"]]["geo_cambio"]                                         = $rTMP["geo_cambio"];
            $arrMunicipio[$rTMP["id"]]["geo_cambio_dt"]                                         = $rTMP["geo_cambio_dt"];
            $arrMunicipio[$rTMP["id"]]["geo_sta"]                                         = $rTMP["geo_sta"];
            $arrMunicipio[$rTMP["id"]]["geo_usr"]                                         = $rTMP["geo_usr"];
            $arrMunicipio[$rTMP["id"]]["geo_dt"]                                         = $rTMP["geo_dt"];
            $arrMunicipio[$rTMP["id"]]["geo_pais"]                                         = $rTMP["geo_pais"];
            $arrMunicipio[$rTMP["id"]]["geo_tel"]                                         = $rTMP["geo_tel"];
            $arrMunicipio[$rTMP["id"]]["geo_flag"]                                         = $rTMP["geo_flag"];
        }
        pg_free_result($sql);

    ?>
        <option value="0">Seleccionar</option>
        <?php
        if (is_array($arrMunicipio) && (count($arrMunicipio) > 0)) {
            reset($arrMunicipio);
            foreach ($arrMunicipio as $rTMP['key'] => $rTMP['value']) {
        ?>
                <option value="<?php echo  $rTMP["value"]['id']; ?>"><?php echo  $rTMP["value"]['geo_desc']; ?></option>

        <?PHP
            }
        }
        ?>
<?php
        die();
    }
    die();
}

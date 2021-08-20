<?php
//GLOBAL variableId
require_once '../../api/var_global.php';

// VALIDATION INSERT UPDATE DELETE
if (isset($_GET["validaciones"]) && !empty($_GET["validaciones"])) {

    require_once '../../../data/conexion/tmfAdm.php';
    require_once '../../../data/conexion/tmfHos.php';

    $ctg_hos_usr = $_SESSION['adm_usr_code'];

    $codeId = isset($_POST["codeId"]) ? $_POST["codeId"]  : '';

    $modulo = isset($_POST["modulo"]) ? $_POST["modulo"]  : '';
    $nombres = isset($_POST["nombres"]) ? $_POST["nombres"]  : '';
    $apellidos = isset($_POST["apellidos"]) ? $_POST["apellidos"]  : '';
    $dpi = isset($_POST["dpi"]) ? $_POST["dpi"]  : '';
    $email = isset($_POST["email"]) ? $_POST["email"]  : '';
    $nombre_usuario = isset($_POST["nombre_usuario"]) ? $_POST["nombre_usuario"]  : '';
    $colegiado = isset($_POST["colegiado"]) ? $_POST["colegiado"]  : '';
    $contrato = isset($_POST["contrato"]) ? $_POST["contrato"]  : '';
    $nombre_comercial = isset($_POST["nombre_comercial"]) ? $_POST["nombre_comercial"]  : '';
    $sucursal = isset($_POST["sucursal"]) ? $_POST["sucursal"]  : '';
    $clave1 = isset($_POST["clave1"]) ? $_POST["clave1"]  : '';
    $clave2 = isset($_POST["clave2"]) ? $_POST["clave2"]  : '';
    $ctg_hos_nombreFull = $nombre_comercial;

    $adm_usr_tipo = 'hos';
    $status_actual = 1;
    $ctg_hos_sta = 1;
    $ctg_hos_estatus = 0;
    $ctg_hos_sol_dt = date("Y-m-d");
    $ctg_hos_aut_dt = date("Y-m-d");

    $ctg_con_tpo = '7';
    $ctg_hos_censuc = 1;
    $ctg_hos_estatus = 1;
    $ctg_hos_sta = 1;
    $ctg_hos_sol_dt = date("Y-m-d");
    $ctg_hos_aut_dt = date("Y-m-d");

    $ctg_hos_ven_dt_Y = date("Y");
    $ctg_hos_ven_dt_Y = $ctg_hos_ven_dt_Y;
    $ctg_hos_ven_dt_m = date("m");
    $ctg_hos_ven_dt_d = date("d");
    $ctg_hos_ven_dt = $ctg_hos_ven_dt_Y . "-" . $ctg_hos_ven_dt_m . "-" . $ctg_hos_ven_dt_d;
    $ctg_hos_dt = date("Y-m-d");
    $ctg_hos_ven_dt = date('Y-m-d', strtotime($ctg_hos_dt . " + 30 day"));

    $fecha = date('d-m-Y');


    $strTipoValidacion = isset($_REQUEST["validaciones"]) ? $_REQUEST["validaciones"] : '';
    if ($strTipoValidacion == "proces") {

        header('Content-Type: application/json');

        $rs = pg_query($rmfAdm, "SELECT CAST ( ctg_hos_code AS integer) from ctg_hospitales ORDER BY ctg_hos_code DESC");
        if ($row = pg_fetch_array($rs)) {
            $idRow = trim($row[0]);
        }
        $variableCode_ = isset($idRow) ? $idRow  : 0;
        $variableCode = $variableCode_ + 1;

        $rs = pg_query($rmfAdm, "SELECT ctg_con_nit FROM ctg_contratos WHERE ctg_con_id = $contrato");
        if ($row = pg_fetch_array($rs)) {
            $idRow = trim($row[0]);
        }
        $nit = isset($idRow) ? $idRow  : 0;

        $val = 3;
        $var_consulta = "INSERT INTO ctg_hospitales(ctg_hos_nomcom,ctg_hos_nit,ctg_hos_contrato,ctg_hos_enc_nomcom,ctg_hos_enc_dpi,ctg_hos_code,ctg_hos_email,ctg_hos_username,ctg_hos_pass,ctg_hos_estatus,ctg_hos_sol_dt,ctg_hos_aut_dt,ctg_hos_ven_dt,ctg_hos_sta,ctg_hos_dt,ctg_hos_usr) VALUES('$nombre_comercial','$nit','$contrato','$ctg_hos_nombreFull','$dpi','$variableCode','$email','$nombre_usuario','".md5($clave2)."','$ctg_hos_estatus','$ctg_hos_sol_dt','$ctg_hos_aut_dt','$ctg_hos_ven_dt','$ctg_hos_sta','$ctg_hos_dt','$ctg_hos_usr');";
        if (pg_query($rmfAdm, $var_consulta)) {
            $arrInfo['status'] = $val;
        } else {
            $arrInfo['status'] = 0;
            $arrInfo['error'] = $var_consulta;
        }

        //print_r($var_consulta);
        //print json_encode($var_consulta);

        $usuarioCode = $variableCode;
        $val = 2;
        $var_consulta = "INSERT INTO web_users(mail,username,adm_usr_tipo,adm_usr_code,password,nombre_completo,adm_usr_contrato,status_actual,adm_date_ven) VALUES ('$email','$nombre_usuario','$adm_usr_tipo','$usuarioCode','".md5($clave2)."','$ctg_hos_nombreFull','$contrato',$ctg_hos_estatus,'$ctg_hos_ven_dt');";
        if (pg_query($rmfAdm, $var_consulta)) {
            $arrInfo['status'] = $val;
        } else {
            $arrInfo['status'] = 0;
            $arrInfo['error'] = $var_consulta;
        }

        $var_consulta = "INSERT INTO ctg_membresias(ctg_mem_id,ctg_mem_type,ctg_mem_stat,ctg_mem_fec,ctg_mem_fec_venc,ctg_mem_estatus,ctg_mem_formpag,ctg_mem_valor,ctg_mem_cuotas,ctg_mem_valor,ctg_mem_cuotas) VALUES ('$usuarioCode','$adm_usr_tipo','1','now()','$ctg_hos_ven_dt','2','0',0,1,0,1);";
        if (pg_query($rmfAdm, $var_consulta)) {
            $arrInfo['status'] = $val;
        } else {
            $arrInfo['status'] = 0;
            $arrInfo['error'] = $var_consulta;
        }

        $val = 3;
        $var_consulta = "UPDATE ctg_contratos SET ctg_con_status = '3' WHERE ctg_con_id = $contrato";
        if (pg_query($rmfAdm, $var_consulta)) {
            $arrInfo['status'] = $val;
        } else {
            $arrInfo['status'] = 0;
            $arrInfo['error'] = $var_consulta;
        }

        //print_r($var_consulta);
        //print json_encode($var_consulta);
        $val = 1;
        $var_consulta = "DELETE FROM sol_regis_user WHERE sru_id = $codeId;";
        if (pg_query($rmfAdm, $var_consulta)) {
            $arrInfo['status'] = $val;
        } else {
            $arrInfo['status'] = 0;
            $arrInfo['error'] = $var_consulta;
        }

        if ($val) {
            $subject_ = 'BIENVENIDO HOSPITAL A VISUALMED.online';
            $address_  = $email;
            $mailContent = '<b>BIENVENIDO HOSPITAL A VISUALMED.online</b><br><br>
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

            <b>Estimado:</b><b>' . $nombre_comercial . '</b><br><br>
            <b>Fecha:</b><b>' . $fecha . '</b><br><br>

            <b>Hemos registrado un perfil con los datos de tu hospital en nuestra plataforma. Con este usuario
            podras acceder al modulo de HOSPITALES que se encuentra en la pagina <a href="www.visualmed.online">www.visualmed.online</a>
            y actualizar la informacion de tu perfil, cargar tus servicios y precios de venta, ver las ordenes
            recibidas en lineas y generar reportes entre otras utilidades.</a><br><br>

            <b>Usuario:</b><a>'.$nombre_usuario.'</a><br>
            <b>Contraseña:</b><a>'.$clave2.'</a><br><br>

            <b>Su menbresia vence el:</b><a>'.$ctg_hos_ven_dt.'</a><br>

            <b>¡Bienvenido!!</a><br><br>
            <table class="default" width="100%">	
	<tr border="1">	
		<td align="center" bgcolor= "#0464fc">	
			<img src="https://i.ibb.co/ckwzNgQ/vmo-footer2-1.png" alt="vmo-footer2-1" border="0">
		</td>
	</tr>
</table>';;

            require_once "../../../PHPMAILER/index.php";
        }

        // print_r($var_consulta);
        print json_encode($arrInfo);

        $variableId = $variableCode;

        if ($val) {
            $val = 3;
            $tabla1 = "hos" . $variableId . "servicios";
            $llave1 = "hos" . $variableId . "servicios_pkey";

            $sql = "CREATE TABLE IF NOT EXISTS {$tabla1}( 
                hos_id serial,
                hos_ser_id character varying(10) NOT NULL,
                hos_ser_nom character varying(100),
                hos_ser_contador integer,
                hos_ser_ind text,
                hos_ser_sta char(1),
                hos_ser_dt timestamp without time zone,
                hos_ser_usr character varying(15),
                CONSTRAINT {$llave1} PRIMARY KEY (hos_ser_id));
                COMMENT ON COLUMN {$tabla1}.hos_id IS 'Id secuencial';
                COMMENT ON COLUMN {$tabla1}.hos_ser_id IS 'Id del servicio';
                COMMENT ON COLUMN {$tabla1}.hos_ser_nom IS 'Nombre del servicio';
                COMMENT ON COLUMN {$tabla1}.hos_ser_contador IS 'contador de numero de veces solicitado el servicio';
                COMMENT ON COLUMN {$tabla1}.hos_ser_sta IS 'estatus del registro 1=creacion 2=edicion 3=borrado';
                COMMENT ON COLUMN {$tabla1}.hos_ser_dt IS 'fecha de actualizacion';
                COMMENT ON COLUMN {$tabla1}.hos_ser_usr IS 'ID del usuario que actualiza';";
            if (pg_query($tmfHos, $sql)) {
                $arrInfo['status'] = $val;
            } else {
                $arrInfo['status'] = 0;
                $arrInfo['error'] = $sql;
            }
            // print_r('<br>');
            // print_r($sql);
            // print json_encode($arrInfo);

            $val = 4;
            $tabla1 = "hos" . $variableId . "orden";
            $llave1 = "hos" . $variableId . "ord_pkey";

            $sql = "CREATE TABLE IF NOT EXISTS {$tabla1}(
                hos_ord_id serial,
                hos_ord_cod integer NOT NULL, -- Id de orden
                hos_ord_nomcom character varying(100), -- Nombre comercial del establecimiento
                hos_ord_tipo char(1) NOT NULL, -- 1=orden del medico 2=orden de internet 3=orden en tienda
                hos_ord_fec timestamp without time zone NOT NULL, -- fecha de orden
                hos_ord_med_id character varying(8) NOT NULL, -- ID del medico
                hos_ord_hos_id character varying(8) NOT NULL, -- ID del paciente
                hos_ord_hos_nombre character varying(100) NOT NULL, -- Nombre del paciente
                hos_ord_por_lab numeric(2,0), -- Porcentaje de descuento del laboratorio clinico
                hos_ord_valor numeric(15,2), -- Valor total de la orden
                hos_ord_valor_desh numeric(15,2), -- valor descuento hospital
                hos_ord_valor_iva numeric(15,2), -- valor iva
                hos_ord_total numeric(15,2), -- valor total
                hos_ord_est char(1), -- Estatus de la orden  1=emitida 2=entregada 3=anulada
                hos_ord_sta char(1), -- estatus del registiro 1=creacion 2=edicion 3=borrado
                hos_ord_dt timestamp without time zone, -- fecha de actualizacion
                hos_ord_usr character varying(15), -- ID del usuario que actualiza
                CONSTRAINT {$llave1} PRIMARY KEY (hos_ord_cod, hos_ord_tipo));
                COMMENT ON COLUMN {$tabla1}.hos_ord_id IS 'Id secuencial';
                COMMENT ON COLUMN {$tabla1}.hos_ord_cod IS 'Id de orden';
                COMMENT ON COLUMN {$tabla1}.hos_ord_nomcom IS 'Nombre comercial del establecimiento';
                COMMENT ON COLUMN {$tabla1}.hos_ord_tipo IS '1=orden del medico 2=orden de internet 3=orden en tienda';
                COMMENT ON COLUMN {$tabla1}.hos_ord_fec IS 'fecha de orden';
                COMMENT ON COLUMN {$tabla1}.hos_ord_med_id IS 'ID del medico';
                COMMENT ON COLUMN {$tabla1}.hos_ord_hos_id IS 'ID del paciente';
                COMMENT ON COLUMN {$tabla1}.hos_ord_hos_nombre IS 'Nombre del paciente';
                COMMENT ON COLUMN {$tabla1}.hos_ord_por_lab IS 'Porcentaje de descuento del laboratorio clinico';
                COMMENT ON COLUMN {$tabla1}.hos_ord_valor IS 'Valor total de la orden';
                COMMENT ON COLUMN {$tabla1}.hos_ord_valor_desh IS 'valor descuento hospital';
                COMMENT ON COLUMN {$tabla1}.hos_ord_valor_iva IS 'valor iva';
                COMMENT ON COLUMN {$tabla1}.hos_ord_total IS 'valor total';
                COMMENT ON COLUMN {$tabla1}.hos_ord_est IS 'Estatus de la orden  1=emitida 2=entregada 3=anulada';
                COMMENT ON COLUMN {$tabla1}.hos_ord_sta IS 'estatus del registiro 1=creacion 2=edicion 3=borrado';
                COMMENT ON COLUMN {$tabla1}.hos_ord_dt IS 'fecha de actualizacion';
                COMMENT ON COLUMN {$tabla1}.hos_ord_usr IS 'ID del usuario que actualiza';";
            if (pg_query($tmfHos, $sql)) {
                $arrInfo['status'] = $val;
            } else {
                $arrInfo['status'] = 0;
                $arrInfo['error'] = $sql;
            }
            // print_r($sql);
            //print json_encode($arrInfo);

            $val = 5;
            $tabla1 = "hos" . $variableId . "orden_items";
            $llave1 = "hos" . $variableId . "ori_pkey";

            $sql = "CREATE TABLE IF NOT EXISTS {$tabla1}(
                hos_ori_cod integer NOT NULL, -- Id de orden
                hos_ori_gpo_id character varying(10) NOT NULL, -- ID del grupo de items
                hos_ori_ser_id character varying(10) NOT NULL, -- ID del item
                hos_ori_pre numeric(15,2) NOT NULL, -- precio
                hos_ori_can integer, -- cantidad
                hos_ori_desh numeric(10,2), -- descuento hospital
                hos_ori_valor numeric(10,2), -- subtotal
                hos_ori_sta char(1), -- estatus del registro 1=creacion 2=edicion 3=borrado
                hos_ori_dt timestamp without time zone, -- fecha de actualizacion
                hos_ori_usr character varying(15), -- ID del usuario que actualiza
                CONSTRAINT {$llave1} PRIMARY KEY (hos_ori_cod, hos_ori_gpo_id, hos_ori_ser_id));
                COMMENT ON COLUMN public.{$tabla1}.hos_ori_cod IS 'Id de orden';
                COMMENT ON COLUMN public.{$tabla1}.hos_ori_gpo_id IS 'ID del grupo de items';
                COMMENT ON COLUMN public.{$tabla1}.hos_ori_ser_id IS 'ID del item';
                COMMENT ON COLUMN public.{$tabla1}.hos_ori_pre IS 'precio';
                COMMENT ON COLUMN public.{$tabla1}.hos_ori_can IS 'cantidad';
                COMMENT ON COLUMN public.{$tabla1}.hos_ori_desh IS 'descuento hospital';
                COMMENT ON COLUMN public.{$tabla1}.hos_ori_valor IS 'subtotal';
                COMMENT ON COLUMN public.{$tabla1}.hos_ori_sta IS 'estatus del registro 1=creacion 2=edicion 3=borrado';
                COMMENT ON COLUMN public.{$tabla1}.hos_ori_dt IS 'fecha de actualizacion';
                COMMENT ON COLUMN public.{$tabla1}.hos_ori_usr IS 'ID del usuario que actualiza';";
            if (pg_query($tmfHos, $sql)) {
                $arrInfo['status'] = $val;
            } else {
                $arrInfo['status'] = 0;
                $arrInfo['error'] = $sql;
            }
            // print_r($sql);
            // print json_encode($arrInfo);

            $val = 6;
            $tabla1 = "hos" . $variableId . "paquetes";
            $llave1 = "hos" . $variableId . "paquetes_pkey";

            $sql = "CREATE TABLE IF NOT EXISTS {$tabla1}(
                hos_id serial,
                hos_paq_id character varying(10) NOT NULL, -- Id del paquete
                hos_paq_nom character varying(100), -- Nombre del paquete
                hos_paq_pre numeric(10,2), -- Precio del paquete
                hos_paq_ind text, -- Indicaciones
                hos_paq_sta char(1), -- estatus del registro 1=creacion 2=edicion 3=borrado
                hos_paq_dt timestamp without time zone, -- fecha de actualizacion
                hos_paq_usr character varying(15), -- ID del usuario que actualiza
                CONSTRAINT {$llave1} PRIMARY KEY (hos_paq_id));
                COMMENT ON COLUMN {$tabla1}.hos_paq_id IS 'Id del paquete';
                COMMENT ON COLUMN {$tabla1}.hos_paq_nom IS 'Nombre del paquete';
                COMMENT ON COLUMN {$tabla1}.hos_paq_pre IS 'Precio del paquete';
                COMMENT ON COLUMN {$tabla1}.hos_paq_ind IS 'Indicaciones';
                COMMENT ON COLUMN {$tabla1}.hos_paq_sta IS 'estatus del registro 1=creacion 2=edicion 3=borrado';
                COMMENT ON COLUMN {$tabla1}.hos_paq_dt IS 'fecha de actualizacion';
                COMMENT ON COLUMN {$tabla1}.hos_paq_usr IS 'ID del usuario que actualiza';";
            if (pg_query($tmfHos, $sql)) {
                $arrInfo['status'] = $val;
            } else {
                $arrInfo['status'] = 0;
                $arrInfo['error'] = $sql;
            }
            // print_r($sql);
            //print json_encode($arrInfo);

            $val = 7;
            $tabla1 = "hos" . $variableId . "paquetes_servicios";
            $llave1 = "hos" . $variableId . "paquetes_servicios_pkey";

            $sql = "CREATE TABLE IF NOT EXISTS {$tabla1}(
                hos_paq_id character varying(10) NOT NULL, -- Id del paquete
                hos_ser_id character varying(10) NOT NULL, -- id del servicio
                hos_paq_pre numeric(10,2), -- Precio del servicio
                hos_paq_sta char(1), -- estatus del registro 1=creacion 2=edicion 3=borrado
                hos_paq_dt timestamp without time zone, -- fecha de actualizacion
                hos_paq_usr character varying(15), -- ID del usuario que actualiza
                CONSTRAINT {$llave1} PRIMARY KEY (hos_paq_id, hos_ser_id));
                COMMENT ON COLUMN {$tabla1}.hos_paq_id IS 'Id del paquete';
                COMMENT ON COLUMN {$tabla1}.hos_ser_id IS 'id del servicio';
                COMMENT ON COLUMN {$tabla1}.hos_paq_pre IS 'Precio del servicio';
                COMMENT ON COLUMN {$tabla1}.hos_paq_sta IS 'estatus del registro 1=creacion 2=edicion 3=borrado';
                COMMENT ON COLUMN {$tabla1}.hos_paq_dt IS 'fecha de actualizacion';
                COMMENT ON COLUMN {$tabla1}.hos_paq_usr IS 'ID del usuario que actualiza';";
            if (pg_query($tmfHos, $sql)) {
                $arrInfo['status'] = $val;
            } else {
                $arrInfo['status'] = 0;
                $arrInfo['error'] = $sql;
            }
            // print_r($sql);
            // print json_encode($arrInfo);
        }

        die();
    } else if ($strTipoValidacion == "delete") {
        $val = 1;
        $var_consulta = "DELETE FROM sol_regis_user WHERE sru_id = $codeId;";
        if (pg_query($rmfAdm, $var_consulta)) {
            $arrInfo['status'] = $val;
        } else {
            $arrInfo['status'] = 0;
            $arrInfo['error'] = $var_consulta;
        }

        if ($var_consulta) {
            $subject_ = 'Usuario - ' . ' ' . $nombre_usuario;
            $address_  = $email;
            $mailContent = '<br>VisualMed - Solicitud</br><br><br>
            <table class="default" width="100%">
	<tr border="1">
		<td align="center" bgcolor= "#0464fc">
			<img src="https://i.ibb.co/MZ35wKk/vmo-header2-1.png" alt="vmo-header2-1" border="0">
 		</td>
	</tr>
</table>

            <b>Su solicitudad a sido denegada.</b><br><br>

            <table class="default" width="100%">	
	<tr border="1">	
		<td align="center" bgcolor= "#0464fc">	
			<img src="https://i.ibb.co/ckwzNgQ/vmo-footer2-1.png" alt="vmo-footer2-1" border="0">
		</td>
	</tr>
</table>';

            require_once "../../../PHPMAILER/index.php";
        }
        //print_r($codeId);
        print json_encode($arrInfo);

        die();
    }

    //DIBUJO DE TABLA PRODUCTOS CATEGORIAS
    else if ($strTipoValidacion == "busqueda_tabla") {
        $strSearch = isset($_POST["Search"]) ? $_POST["Search"]  : '';

        $strFilter = "";
        if (!empty($strSearch)) {
            $strFilter = " AND ( UPPER(sru_nombres) LIKE UPPER('%{$strSearch}%') OR UPPER(sru_apellidos) LIKE UPPER('%{$strSearch}%') ) ";
        }

        $arrUsuarios = array();
        $var_consulta = "SELECT * 
        FROM sol_regis_user 
        WHERE sru_modulo = '$adm_usr_tipo'
        AND sru_solicitud = '0'
        $strFilter
        ORDER BY sru_nombres DESC";

        $qTMP = pg_query($rmfAdm, $var_consulta);
        //echo $var_consulta;
        while ($rTMP = pg_fetch_assoc($qTMP)) {

            $arrUsuarios[$rTMP["sru_id"]]["sru_id"]                          = $rTMP["sru_id"];
            $arrUsuarios[$rTMP["sru_id"]]["sru_modulo"]                          = $rTMP["sru_modulo"];
            $arrUsuarios[$rTMP["sru_id"]]["sru_nombres"]                          = $rTMP["sru_nombres"];
            $arrUsuarios[$rTMP["sru_id"]]["sru_apellidos"]                          = $rTMP["sru_apellidos"];
            $arrUsuarios[$rTMP["sru_id"]]["sru_dpi"]                          = $rTMP["sru_dpi"];
            $arrUsuarios[$rTMP["sru_id"]]["sru_email"]                          = $rTMP["sru_email"];
            $arrUsuarios[$rTMP["sru_id"]]["sru_nombre_usuario"]                          = $rTMP["sru_nombre_usuario"];
            $arrUsuarios[$rTMP["sru_id"]]["sru_colegiado"]                          = $rTMP["sru_colegiado"];
            $arrUsuarios[$rTMP["sru_id"]]["sru_contrato"]                          = $rTMP["sru_contrato"];
            $arrUsuarios[$rTMP["sru_id"]]["sru_nombre_comercial"]                          = $rTMP["sru_nombre_comercial"];
            $arrUsuarios[$rTMP["sru_id"]]["sru_sucursal"]                          = $rTMP["sru_sucursal"];
            $arrUsuarios[$rTMP["sru_id"]]["sru_clave1"]                          = $rTMP["sru_clave1"];
            $arrUsuarios[$rTMP["sru_id"]]["sru_clave2"]                          = $rTMP["sru_clave2"];
            $arrUsuarios[$rTMP["sru_id"]]["sru_solicitud"]                          = $rTMP["sru_solicitud"];
        }
        pg_free_result($qTMP);

?>
        <div class="col-md-12 tableFixHead">
            <table id="tableData" class="table table-bordered table-striped table-hover table-sm">
                <thead>
                    <tr class="table-info">
                        <th>Nombre</th>
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
                                <td width='43%'><?php echo  $rTMP["value"]['sru_nombre_comercial']; ?></td>
                                <td width='30%'><?php echo  $rTMP["value"]['sru_nombre_usuario']; ?></td>
                                <td width='3%' style="cursor:pointer;" onclick="fntView('<?php print $intContador; ?>');"><i class="fad fa-eye"></i></td>
                                <td width='3%' style="cursor:pointer;" onclick="fntSelect('<?php print $intContador; ?>');"><i class="far fa-check-double"></i></td>
                                <td width='3%' style="cursor:pointer;" onclick="fntSelectDelete('<?php print $intContador; ?>');"><i class="fad fa-trash-alt"></i></i></td>
                            </tr>
                            <input type="hidden" name="hid_id<?php print $intContador; ?>" id="hid_id<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['sru_id']; ?>">
                            <input type="hidden" name="hid_modulo<?php print $intContador; ?>" id="hid_modulo<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['sru_modulo']; ?>">
                            <input type="hidden" name="hid_nombres<?php print $intContador; ?>" id="hid_nombres<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['sru_nombres']; ?>">
                            <input type="hidden" name="hid_apellidos<?php print $intContador; ?>" id="hid_apellidos<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['sru_apellidos']; ?>">
                            <input type="hidden" name="hid_dpi<?php print $intContador; ?>" id="hid_dpi<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['sru_dpi']; ?>">
                            <input type="hidden" name="hid_email<?php print $intContador; ?>" id="hid_email<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['sru_email']; ?>">
                            <input type="hidden" name="hid_nombre_usuario<?php print $intContador; ?>" id="hid_nombre_usuario<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['sru_nombre_usuario']; ?>">
                            <input type="hidden" name="hid_colegiado<?php print $intContador; ?>" id="hid_colegiado<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['sru_colegiado']; ?>">
                            <input type="hidden" name="hid_contrato<?php print $intContador; ?>" id="hid_contrato<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['sru_contrato']; ?>">
                            <input type="hidden" name="hid_nombre_comercial<?php print $intContador; ?>" id="hid_nombre_comercial<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['sru_nombre_comercial']; ?>">
                            <input type="hidden" name="hid_sucursal<?php print $intContador; ?>" id="hid_sucursal<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['sru_sucursal']; ?>">
                            <input type="hidden" name="hid_clave1<?php print $intContador; ?>" id="hid_clave1<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['sru_clave1']; ?>">
                            <input type="hidden" name="hid_clave2<?php print $intContador; ?>" id="hid_clave2<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['sru_clave2']; ?>">

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
    die();
}

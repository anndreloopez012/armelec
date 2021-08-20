<?php
//GLOBAL variableId
require_once '../../api/var_global.php';

// VALIDATION INSERT UPDATE DELETE
if (isset($_GET["validaciones"]) && !empty($_GET["validaciones"])) {

    require_once '../../../data/conexion/tmfAdm.php';
    require_once '../../../data/conexion/tmfLaf.php';
    require_once '../../../data/conexion/tmfLab.php';

    $ctg_lab_usr = $_SESSION['adm_usr_code'];

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
    $ctg_lab_nombreFull = $nombre_comercial . ' ' . $sucursal;

    $adm_usr_tipo = 'cli';
    $ctg_lab_censuc = 1;
    $status_actual = 1;
    $ctg__sta = 1;
    $ctg_lab_estatus = 0;
    $ctg_lab_sol_dt = date("Y-m-d");
    $ctg_lab_aut_dt = date("Y-m-d");

    $ctg_con_tpo = '6';
    $ctg_lab_censuc = 1;
    $ctg_lab_estatus = 1;
    $ctg_lab_sta = 1;
    $ctg_lab_sol_dt = date("Y-m-d");
    $ctg_lab_aut_dt = date("Y-m-d");

    $ctg_lab_ven_dt_Y = date("Y");
    $ctg_lab_ven_dt_Y = $ctg_lab_ven_dt_Y;
    $ctg_lab_ven_dt_m = date("m");
    $ctg_lab_ven_dt_d = date("d");
    $ctg_lab_ven_dt = $ctg_lab_ven_dt_Y . "-" . $ctg_lab_ven_dt_m . "-" . $ctg_lab_ven_dt_d;
    $ctg_lab_dt = date("Y-m-d");
    $ctg_lab_ven_dt = date('Y-m-d', strtotime($ctg_lab_dt . " + 30 day"));

    $fecha = date('d-m-Y');


    $strTipoValidacion = isset($_REQUEST["validaciones"]) ? $_REQUEST["validaciones"] : '';
    if ($strTipoValidacion == "proces") {

        header('Content-Type: application/json');

        $rs = pg_query($rmfAdm, "SELECT CAST ( ctg_lab_code AS integer) from ctg_lab_clinicos ORDER BY ctg_lab_code DESC");
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
        $var_consulta = "INSERT INTO ctg_lab_clinicos(ctg_lab_nomcom,ctg_lab_nit,ctg_lab_suc,ctg_lab_contrato,ctg_lab_code,ctg_lab_email,ctg_lab_username,ctg_lab_pass,ctg_lab_estatus,ctg_lab_sol_dt,ctg_lab_aut_dt,ctg_lab_ven_dt,ctg_lab_sta,ctg_lab_dt,ctg_lab_usr) VALUES('$nombre_comercial','$nit','$sucursal','$contrato','$variableCode','$email','$nombre_usuario','" . md5($clave2) . "','$ctg_lab_estatus','$ctg_lab_sol_dt','$ctg_lab_aut_dt','$ctg_lab_ven_dt','$ctg_lab_sta','$ctg_lab_dt','$ctg_lab_usr');";
        if (pg_query($rmfAdm, $var_consulta)) {
            $arrInfo['status'] = $val;
        } else {
            $arrInfo['status'] = 0;
            $arrInfo['error'] = $var_consulta;
        }

        //print_r($var_consulta);
        //print json_encode($arrInfo);

        $usuarioCode = $variableCode;
        $val = 2;
        $var_consulta = "INSERT INTO web_users(mail,username,adm_usr_tipo,adm_usr_code,password,nombre_completo,adm_usr_contrato,status_actual,adm_date_ven) VALUES ('$email','$nombre_usuario','$adm_usr_tipo','$usuarioCode','" . md5($clave2) . "','$ctg_lab_nombreFull','$contrato',$ctg_lab_estatus,'$ctg_lab_ven_dt');";
        if (pg_query($rmfAdm, $var_consulta)) {
            $arrInfo['status'] = $val;
        } else {
            $arrInfo['status'] = 0;
            $arrInfo['error'] = $var_consulta;
        }

        $var_consulta = "INSERT INTO ctg_membresias(ctg_mem_id,ctg_mem_type,ctg_mem_stat,ctg_mem_fec,ctg_mem_fec_venc,ctg_mem_estatus,ctg_mem_formpag,ctg_mem_valor,ctg_mem_cuotas) VALUES ('$usuarioCode','$adm_usr_tipo','1','now()','$ctg_lab_ven_dt','2','0',0,1);";
        if (pg_query($rmfAdm, $var_consulta)) {
            $arrInfo['status'] = $val;
        } else {
            $arrInfo['status'] = 0;
            $arrInfo['error'] = $var_consulta;
        }

        //print_r($var_consulta);
        //print json_encode($arrInfo);

        $val = 3;
        $var_consulta = "UPDATE ctg_contratos SET ctg_con_status = '3' WHERE ctg_con_id = $contrato";
        if (pg_query($rmfAdm, $var_consulta)) {
            $arrInfo['status'] = $val;
        } else {
            $arrInfo['status'] = 0;
            $arrInfo['error'] = $var_consulta;
        }

        $val = 1;
        $var_consulta = "DELETE FROM sol_regis_user WHERE sru_id = $codeId;";
        if (pg_query($rmfAdm, $var_consulta)) {
            $arrInfo['status'] = $val;
        } else {
            $arrInfo['status'] = 0;
            $arrInfo['error'] = $var_consulta;
        }

        if ($val) {
            $subject_ = 'BIENVENIDO LABORATORIO CLINICO A VISUALMED.online';
            $address_  = $email;
            $mailContent = '<b>BIENVENIDO LABORATORIO CLINICO A VISUALMED.online</b><br><br>
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

            <b>Hemos registrado un perfil con los datos de tu laboratorio en nuestra plataforma. Con este
            usuario podras acceder al modulo de LAB. CLINICOS que se encuentra en la pagina
            <a href="www.visualmed.online">www.visualmed.online</a> y actualizar la informacion de tu perfil, cargar tus examenes y precios de
            venta, ver las ordenes recibidas en lineas y generar reportes entre otras utilidades.</a><br><br>

            <b>Usuario:</b><a>' . $nombre_usuario . '</a><br>
            <b>Contraseña:</b><a>' . $clave2 . '</a><br><br>

            <b>Su menbresia vence el:</b><a>' . $ctg_lab_ven_dt . '</a><br>

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

        //print_r($var_consulta);
        print json_encode($arrInfo);

        $variableId = $variableCode;

        if ($val) {
            $val = 3;
            $tabla1 = "lab" . $variableId . "examenes";
            $llave1 = "lab" . $variableId . "examenes_pkey";

            $sql = "CREATE TABLE IF NOT EXISTS {$tabla1} 
                (
                lab_id serial,
                lab_exa_id character varying(10) NOT NULL, -- Id del examen
                lab_exa_contador integer, -- numero de veces que se ha solicitado el examen
                lab_exa_sta char(1), -- estatus del registro 1=creacion 2=edicion 3=borrado
                lab_exa_dt timestamp without time zone, -- fecha de actualizacion
                lab_exa_usr character varying(15), -- ID del usuario que actualiza
                CONSTRAINT {$llave1}  PRIMARY KEY (lab_exa_id));
                COMMENT ON COLUMN {$tabla1}.lab_id IS 'ID secuencial';
                COMMENT ON COLUMN {$tabla1}.lab_exa_id IS 'Id del examen';
                COMMENT ON COLUMN {$tabla1}.lab_exa_contador IS 'numero de veces que se ha solicitado el examen';
                COMMENT ON COLUMN {$tabla1}.lab_exa_sta IS 'estatus del registro 1=creacion 2=edicion 3=borrado';
                COMMENT ON COLUMN {$tabla1}.lab_exa_dt IS 'fecha de actualizacion';
                COMMENT ON COLUMN {$tabla1}.lab_exa_usr IS 'ID del usuario que actualiza';";
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
            $tabla1 = "lab" . $variableId . "orden";
            $llave1 = "lab" . $variableId . "ord_pkey";

            $sql = "CREATE TABLE IF NOT EXISTS {$tabla1}
                (
                lab_ord_id serial,
                lab_ord_cod integer NOT NULL, -- Id de orden
                lab_ord_nomcom character varying(100), -- Nombre comercial del establecimiento
                lab_ord_tipo char(1) NOT NULL, -- 1=orden del medico 2=orden de internet 3=orden en tienda
                lab_ord_fec timestamp without time zone NOT NULL, -- fecha de orden
                lab_ord_med_id character varying(10) NOT NULL, -- ID del medico
                lab_ord_pac_id character varying(20) NOT NULL, -- ID del paciente
                lab_ord_pac_nombre character varying(100) NOT NULL, -- Nombre del paciente
                lab_ord_pac_mem_id character varying(20) NOT NULL, -- ID de la membresia
                lab_ord_por_lab numeric(2,0), -- Porcentaje de descuento del laboratorio clinico
                lab_ord_valor numeric(15,2), -- Valor total de la orden
                lab_ord_valor_desl numeric(15,2), -- valor descuento laboratorio
                lab_ord_valor_iva numeric(15,2), -- valor iva
                lab_ord_total numeric(15,2), -- valor total
                lab_ord_est char(1), -- Estatus de la orden  1=emitida 2=entregada 3=anulada
                lab_ord_sta char(1), -- estatus del registiro 1=creacion 2=edicion 3=borrado
                lab_ord_dt timestamp without time zone, -- fecha de actualizacion
                lab_ord_usr character varying(15), -- ID del usuario que actualiza
                CONSTRAINT {$llave1} PRIMARY KEY (lab_ord_cod, lab_ord_tipo));
                COMMENT ON COLUMN {$tabla1}.lab_ord_id IS 'Id secuencial';
                COMMENT ON COLUMN {$tabla1}.lab_ord_cod IS 'Id de orden';
                COMMENT ON COLUMN {$tabla1}.lab_ord_nomcom IS 'Nombre comercial del establecimiento';
                COMMENT ON COLUMN {$tabla1}.lab_ord_tipo IS '1=orden del medico 2=orden de internet 3=orden en tienda';
                COMMENT ON COLUMN {$tabla1}.lab_ord_fec IS 'fecha de orden';
                COMMENT ON COLUMN {$tabla1}.lab_ord_med_id IS 'ID del medico';
                COMMENT ON COLUMN {$tabla1}.lab_ord_pac_id IS 'ID del paciente';
                COMMENT ON COLUMN {$tabla1}.lab_ord_pac_nombre IS 'Nombre del paciente';
                COMMENT ON COLUMN {$tabla1}.lab_ord_pac_mem_id IS 'ID de la membresia';
                COMMENT ON COLUMN {$tabla1}.lab_ord_por_lab IS 'Porcentaje de descuento del laboratorio clinico';
                COMMENT ON COLUMN {$tabla1}.lab_ord_valor IS 'Valor total de la orden';
                COMMENT ON COLUMN {$tabla1}.lab_ord_valor_desl IS 'valor descuento laboratorio';
                COMMENT ON COLUMN {$tabla1}.lab_ord_valor_iva IS 'valor iva';
                COMMENT ON COLUMN {$tabla1}.lab_ord_total IS 'valor total';
                COMMENT ON COLUMN {$tabla1}.lab_ord_est IS 'Estatus de la orden  1=emitida 2=entregada 3=anulada';
                COMMENT ON COLUMN {$tabla1}.lab_ord_sta IS 'estatus del registiro 1=creacion 2=edicion 3=borrado';
                COMMENT ON COLUMN {$tabla1}.lab_ord_dt IS 'fecha de actualizacion';
                COMMENT ON COLUMN {$tabla1}.lab_ord_usr IS 'ID del usuario que actualiza';";
            if (pg_query($tmfLab, $sql)) {
                $arrInfo['status'] = $val;
            } else {
                $arrInfo['status'] = 0;
                $arrInfo['error'] = $sql;
            }
            // print_r($sql);
            // print json_encode($arrInfo);

            $val = 5;
            $tabla1 = "lab" . $variableId . "orden_items";
            $llave1 = "lab" . $variableId . "ori_pkey";

            $sql = "CREATE TABLE IF NOT EXISTS {$tabla1}
                (
                lab_ori_cod integer NOT NULL, -- Id de orden
                lab_ori_gpo_id character varying(10) NOT NULL, -- ID del grupo de items
                lab_ori_exa_id character varying(10) NOT NULL, -- ID del item
                lab_ori_pre numeric(15,2) NOT NULL, -- precio
                lab_ori_can integer, -- cantidad
                lab_ori_desl numeric(10,2), -- descuento laboratorio
                lab_ori_valor numeric(10,2), -- subtotal
                lab_ori_exa_dt timestamp without time zone, -- fecha de realizacion del examen
                lab_ori_exa_ranmin character varying(100), -- rango minimo
                lab_ori_exa_ranmax character varying(100), -- rango maximo
                lab_ori_exa_res character varying(100), -- resultado del examen
                lab_ori_sta char(1), -- estatus del registro 1=creacion 2=edicion 3=borrado
                lab_ori_dt timestamp without time zone, -- fecha de actualizacion
                lab_ori_usr character varying(15), -- ID del usuario que actualiza
                CONSTRAINT {$llave1} PRIMARY KEY (lab_ori_cod, lab_ori_gpo_id, lab_ori_exa_id));
                COMMENT ON COLUMN {$tabla1}.lab_ori_cod IS 'Id de orden';
                COMMENT ON COLUMN {$tabla1}.lab_ori_gpo_id IS 'ID del grupo de items';
                COMMENT ON COLUMN {$tabla1}.lab_ori_exa_id IS 'ID del item';
                COMMENT ON COLUMN {$tabla1}.lab_ori_pre IS 'precio';
                COMMENT ON COLUMN {$tabla1}.lab_ori_can IS 'cantidad';
                COMMENT ON COLUMN {$tabla1}.lab_ori_desl IS 'descuento laboratorio';
                COMMENT ON COLUMN {$tabla1}.lab_ori_valor IS 'subtotal';
                COMMENT ON COLUMN {$tabla1}.lab_ori_exa_dt IS 'fecha de realizacion del examen';
                COMMENT ON COLUMN {$tabla1}.lab_ori_exa_ranmin IS 'rango minimo';
                COMMENT ON COLUMN {$tabla1}.lab_ori_exa_ranmax IS 'rango maximo';
                COMMENT ON COLUMN {$tabla1}.lab_ori_exa_res IS 'resultado del examen';
                COMMENT ON COLUMN {$tabla1}.lab_ori_sta IS 'estatus del registro 1=creacion 2=edicion 3=borrado';
                COMMENT ON COLUMN {$tabla1}.lab_ori_dt IS 'fecha de actualizacion';
                COMMENT ON COLUMN {$tabla1}.lab_ori_usr IS 'ID del usuario que actualiza';";
            if (pg_query($tmfLab, $sql)) {
                $arrInfo['status'] = $val;
            } else {
                $arrInfo['status'] = 0;
                $arrInfo['error'] = $sql;
            }
            // print_r($sql);
            // print json_encode($arrInfo);

            $val = 6;
            $tabla1 = "lab" . $variableId . "grupos";
            $llave1 = "lab" . $variableId . "grupos_pkey";

            $sql = "CREATE TABLE IF NOT EXISTS {$tabla1}
                (
                lab_id serial,
                lab_gpo_id character varying(10) NOT NULL, -- Id del examen
                lab_gpo_nom character varying(100), -- Nombre del examen
                lab_gpo_pre numeric(10,2), -- Precio del examen
                lab_gpo_ind text, -- Indicaciones
                lab_gpo_sta char(1), -- estatus del registro 1=creacion 2=edicion 3=borrado
                lab_gpo_dt timestamp without time zone, -- fecha de actualizacion
                lab_gpo_usr character varying(15), -- ID del usuario que actualiza
                CONSTRAINT {$llave1} PRIMARY KEY (lab_gpo_id));
                COMMENT ON COLUMN {$tabla1}.lab_gpo_id IS 'Id del examen';
                COMMENT ON COLUMN {$tabla1}.lab_gpo_nom IS 'Nombre del examen';
                COMMENT ON COLUMN {$tabla1}.lab_gpo_pre IS 'Precio del examen';
                COMMENT ON COLUMN {$tabla1}.lab_gpo_ind IS 'Indicaciones';
                COMMENT ON COLUMN {$tabla1}.lab_gpo_sta IS 'estatus del registro 1=creacion 2=edicion 3=borrado';
                COMMENT ON COLUMN {$tabla1}.lab_gpo_dt IS 'fecha de actualizacion';
                COMMENT ON COLUMN {$tabla1}.lab_gpo_usr IS 'ID del usuario que actualiza';";
            if (pg_query($tmfLab, $sql)) {
                $arrInfo['status'] = $val;
            } else {
                $arrInfo['status'] = 0;
                $arrInfo['error'] = $sql;
            }
            //print_r($sql);
            //print json_encode($arrInfo);

            $val = 7;
            $tabla1 = "lab" . $variableId . "grupos_examenes";
            $llave1 = "lab" . $variableId . "grupos_examenes_pkey";

            $sql = "CREATE TABLE IF NOT EXISTS {$tabla1}
                (
                lab_gpe_id character varying(10) NOT NULL, -- Id del grupo
                lab_gpe_exa_id character varying(10) NOT NULL, -- Id del examen
                lab_gpe_pre numeric(10,2), -- Precio del examen
                lab_gpe_sta char(1), -- estatus del registro 1=creacion 2=edicion 3=borrado
                lab_gpe_dt timestamp without time zone, -- fecha de actualizacion
                lab_gpe_usr character varying(15), -- ID del usuario que actualiza
                CONSTRAINT {$llave1} PRIMARY KEY (lab_gpe_id, lab_gpe_exa_id));
                COMMENT ON COLUMN {$tabla1}.lab_gpe_id IS 'Id del grupo';
                COMMENT ON COLUMN {$tabla1}.lab_gpe_exa_id IS 'Id del examen';
                COMMENT ON COLUMN {$tabla1}.lab_gpe_pre IS 'Precio del examen';
                COMMENT ON COLUMN {$tabla1}.lab_gpe_sta IS 'estatus del registro 1=creacion 2=edicion 3=borrado';
                COMMENT ON COLUMN {$tabla1}.lab_gpe_dt IS 'fecha de actualizacion';
                COMMENT ON COLUMN {$tabla1}.lab_gpe_usr IS 'ID del usuario que actualiza';";
            if (pg_query($tmfLab, $sql)) {
                $arrInfo['status'] = $val;
            } else {
                $arrInfo['status'] = 0;
                $arrInfo['error'] = $sql;
            }
            //print_r($sql);
            //print json_encode($arrInfo);
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

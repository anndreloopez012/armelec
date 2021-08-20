<?php
//GLOBAL variableId
require_once '../../api/var_global.php';

// VALIDATION INSERT UPDATE DELETE
if (isset($_GET["validaciones"]) && !empty($_GET["validaciones"])) {

    require_once '../../../api/globalFunctions.php';

    require_once '../../../data/conexion/tmfAdm.php';
    require_once '../../../data/conexion/tmfLab.php';
    require_once '../../../data/conexion/tmfHos.php';
    require_once '../../../data/conexion/tmlFar.php';
    require_once '../../../data/conexion/tmlMed.php';

    require_once '../../../api/config.php';

    $usuarioId = $_SESSION['adm_usr_code'];

    $codeId = isset($_POST["codeId"]) ? $_POST["codeId"]  : '';

    $ctg_lab_nomcom = isset($_POST["ctg_lab_nomcom"]) ? $_POST["ctg_lab_nomcom"]  : '';
    $ctg_lab_nit = isset($_POST["ctg_lab_nit"]) ? $_POST["ctg_lab_nit"]  : '';
    $ctg_lab_suc = isset($_POST["ctg_lab_suc"]) ? $_POST["ctg_lab_suc"]  : '';
    $ctg_lab_dir = isset($_POST["ctg_lab_dir"]) ? $_POST["ctg_lab_dir"]  : '';
    $ctg_lab_zona = isset($_POST["ctg_lab_zona"]) ? $_POST["ctg_lab_zona"]  : '';
    $region = isset($_POST["region"]) ? $_POST["region"]  : '';
    $distrito = isset($_POST["distrito"]) ? $_POST["distrito"]  : '';
    $ctg_lab_tels = isset($_POST["ctg_lab_tels"]) ? $_POST["ctg_lab_tels"]  : '';
    $ctg_lab_email = isset($_POST["ctg_lab_email"]) ? $_POST["ctg_lab_email"]  : '';

    $username = isset($_POST["username"]) ? $_POST["username"]  : '';
    $ctg_lab_enc_dpi = isset($_POST["ctg_lab_enc_dpi"]) ? $_POST["ctg_lab_enc_dpi"]  : '';
    $ctg_lab_enc_nom = isset($_POST["ctg_lab_enc_nom"]) ? $_POST["ctg_lab_enc_nom"]  : '';
    $password = isset($_POST["password"]) ? $_POST["password"]  : '';
    $password_conf = isset($_POST["password_conf"]) ? $_POST["password_conf"]  : '';

    $ctg_lab_contrato = isset($_POST["ctg_lab_contrato"]) ? $_POST["ctg_lab_contrato"]  : '';
    $adm_usr_contrato = isset($ctg_lab_contrato) ? $ctg_lab_contrato  : '';

    $adm_usr_tipo = 'cli';
    $sucursal = 1;
    $ctg_lab_censuc = 1;
    $status_actual = 1;
    $ctg_lab_sta = 1;
    $ctg_lab_estatus = 0;
    $ctg_lab_sol_dt = date("Y-m-d");
    $ctg_lab_aut_dt = date("Y-m-d");

    $ctg_lab_ven_dt_Y = date("Y");
    $ctg_lab_ven_dt_Y = $ctg_lab_ven_dt_Y + 1;
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
        $val = 2;
        $var_consulta = "INSERT INTO ctg_lab_clinicos(ctg_lab_contrato,ctg_lab_nit,ctg_lab_nomcom,ctg_lab_suc,ctg_lab_code,ctg_lab_dir,ctg_lab_zona,ctg_lab_dep,ctg_lab_mun,ctg_lab_tels,ctg_lab_email,ctg_lab_enc_dpi,ctg_lab_enc_nom1,ctg_lab_username,ctg_lab_pass,ctg_lab_estatus,ctg_lab_censuc,ctg_lab_sol_dt,ctg_lab_aut_dt,ctg_lab_ven_dt,ctg_lab_sta,ctg_lab_dt,ctg_lab_usr) VALUES ('$ctg_lab_contrato','$ctg_lab_nit','$ctg_lab_nomcom','$ctg_lab_suc','$variableCode','$ctg_lab_dir','$ctg_lab_zona','$region','$distrito','$ctg_lab_tels','$ctg_lab_email','$ctg_lab_enc_dpi','$ctg_lab_enc_nom','$username','$password','$ctg_lab_estatus','$ctg_lab_censuc','$ctg_lab_sol_dt','$ctg_lab_aut_dt','$ctg_lab_ven_dt','$ctg_lab_sta','$ctg_lab_dt','$usuarioId');";
        if (pg_query($rmfAdm, $var_consulta)) {
            $arrInfo['status'] = $val;
        } else {
            $arrInfo['status'] = 0;
            $arrInfo['error'] = $var_consulta;
        }
       // //print_r($var_consulta);
       // print json_encode($arrInfo);

       $val = 3;
        $var_consulta = "UPDATE ctg_contratos SET ctg_con_status = '3' WHERE ctg_con_id = $ctg_lab_contrato";
        if (pg_query($rmfAdm, $var_consulta)) {
            $arrInfo['status'] = $val;
        } else {
            $arrInfo['status'] = 0;
            $arrInfo['error'] = $var_consulta;
        }
        
        $usuarioCode = $variableCode;
        $val = 1;
        $var_consulta = "INSERT INTO web_users(mail,username,adm_usr_tipo,adm_usr_code,password,nombre_completo,adm_usr_contrato,status_actual,adm_date_ven) VALUES ('$ctg_lab_email','$username','$adm_usr_tipo','$usuarioCode','".md5($password)."','$ctg_lab_nomcom','$ctg_lab_contrato',$status_actual,'$ctg_lab_ven_dt');";
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
  

        if ($val) {
            $subject_ = 'BIENVENIDO LABORATORIO CLINICO A VISUALMED.online';
            $address_  = $ctg_lab_email;
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

            <b>Estimado:</b><b>' . $ctg_lab_nomcom . '</b><br><br>
            <b>Fecha:</b><b>' . $fecha . '</b><br><br>

            <b>Hemos registrado un perfil con los datos de tu laboratorio en nuestra plataforma. Con este
            usuario podras acceder al modulo de LAB. CLINICOS que se encuentra en la pagina
            <a href="www.visualmed.online">www.visualmed.online</a> y actualizar la informacion de tu perfil, cargar tus examenes y precios de
            venta, ver las ordenes recibidas en lineas y generar reportes entre otras utilidades.</a><br><br>

            <b>Usuario:</b><a>'.$username.'</a><br>
            <b>Contraseña:</b><a>'.$password.'</a><br><br>

            <b>Su menbresia vence el:</b><a>'.$ctg_lab_ven_dt.'</a><br>

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
        ////print_r($var_consulta);
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
    }else if ($strTipoValidacion == "delete") {
        $val = 1;
        $var_consulta = "DELETE FROM ctg_lab_clinicos WHERE ctg_lab_code = '$codeId';";
        if (pg_query($rmfAdm, $var_consulta)) {
            $arrInfo['status'] = $val;
        } else {
            $arrInfo['status'] = 0;
            $arrInfo['error'] = $var_consulta;
        }
       // //print_r($var_consulta);
       // print json_encode($arrInfo);

        $val = 2;
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
            $tabla1 = "lab" . $codeId . "examenes";
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
            $tabla1 = "lab" . $codeId . "orden";
            $sql = "DROP TABLE {$tabla1};";
                if (pg_query($tmfLab, $sql)) {
                    $arrInfo['status'] = $val;
                } else {
                    $arrInfo['status'] = 0;
                    $arrInfo['error'] = $sql;
                }
               // print_r($sql);
               /// print json_encode($arrInfo);

            $val = 5;
            $tabla1 = "lab" . $codeId . "orden_items";
            $sql = "DROP TABLE {$tabla1};";
                if (pg_query($tmfLab, $sql)) {
                    $arrInfo['status'] = $val;
                } else {
                    $arrInfo['status'] = 0;
                    $arrInfo['error'] = $sql;
                }
               // print_r($sql);
               // print json_encode($arrInfo);

            $val = 6;
            $tabla1 = "lab" . $codeId . "grupos";
            $sql = "DROP TABLE {$tabla1};";
                if (pg_query($tmfLab, $sql)) {
                    $arrInfo['status'] = $val;
                } else {
                    $arrInfo['status'] = 0;
                    $arrInfo['error'] = $sql;
                }
                //print_r($sql);
               // print json_encode($arrInfo);

            $val = 7;
            $tabla1 = "lab" . $codeId . "grupos_examenes";
            $sql = "DROP TABLE {$tabla1};";
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
    }

    //DIBUJO DE TABLA PRODUCTOS CATEGORIAS
    else if ($strTipoValidacion == "busqueda_tabla") {
        $strSearch = isset($_POST["Search"]) ? $_POST["Search"]  : '';

        $strFilter = "";
        if (!empty($strSearch)) {
            $strFilter = " WHERE ( UPPER(ctg_lab_nomcom) LIKE UPPER('%{$strSearch}%') OR UPPER(ctg_lab_username) LIKE UPPER('%{$strSearch}%') ) ";
        }

        $arrUsuarios = array();
        $var_consulta = "SELECT * 
        FROM ctg_lab_clinicos 
        $strFilter
        ORDER BY ctg_lab_nomcom";

        $qTMP = pg_query($rmfAdm, $var_consulta);
        //echo $var_consulta;
        while ($rTMP = pg_fetch_assoc($qTMP)) {

            $arrUsuarios[$rTMP["id"]]["id"]                          = $rTMP["id"];
            $arrUsuarios[$rTMP["id"]]["ctg_lab_contrato"]            = $rTMP["ctg_lab_contrato"];
            $arrUsuarios[$rTMP["id"]]["ctg_lab_nomcom"]              = $rTMP["ctg_lab_nomcom"];
            $arrUsuarios[$rTMP["id"]]["ctg_lab_suc"]                 = $rTMP["ctg_lab_suc"];
            $arrUsuarios[$rTMP["id"]]["ctg_lab_username"]            = $rTMP["ctg_lab_username"];
            $arrUsuarios[$rTMP["id"]]["ctg_lab_code"]            = $rTMP["ctg_lab_code"];

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
                                <td whidth='%10'><?php echo  $rTMP["value"]['ctg_lab_contrato']; ?></td>
                                <td whidth='%30'><?php echo  $rTMP["value"]['ctg_lab_nomcom']; ?></td>
                                <td whidth='%30'><?php echo  $rTMP["value"]['ctg_lab_suc']; ?></td>
                                <td whidth='%30'><?php echo  $rTMP["value"]['ctg_lab_username']; ?></td>
                                <td whidth='%30' style="cursor:pointer;" onclick="fntSelect('<?php print $intContador; ?>');"><i class="fad fa-trash-alt"></i></td>
                            </tr>
                            <input type="hidden" name="hid_id<?php print $intContador; ?>" id="hid_id<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['ctg_lab_code']; ?>">
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
        $var_consulta = pg_query($rmfAdm, "SELECT COUNT(sru_id) FROM sol_regis_user WHERE email = '$ctg_ase_email' AND sru_modulo = 'cli' LIMIT 1;");
        if ($row = pg_fetch_array($var_consulta)) {
            $idRow = trim($row[0]);
        }
        $usuarioCode = isset($idRow) ? $idRow  : 0;

        $var_consulta = pg_query($rmfAdm, "SELECT COUNT(adm_usr_id) FROM web_users WHERE mail = '$ctg_lab_email' AND adm_usr_tipo = 'cli' LIMIT 1;");
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

        $var_consulta = pg_query($rmfAdm, "SELECT COUNT(ctg_lab_nomcom) FROM ctg_lab_clinicos WHERE UPPER(ctg_lab_nomcom) = UPPER('$ctg_lab_nomcom') LIMIT 1;");

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
        //print_r($usuarioCode);

        print json_encode($arrInfo);

        die();
    } else if ($strTipoValidacion == "val_suc_empresa") {
        $val = 1;

        $var_consulta = pg_query($rmfAdm, "SELECT COUNT(ctg_lab_suc) FROM ctg_lab_clinicos WHERE UPPER(ctg_lab_suc) = UPPER('$ctg_lab_suc') LIMIT 1;");

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
        //print_r($usuarioCode);

        print json_encode($arrInfo);

        die();
    } else if ($strTipoValidacion == "tabla_contrato") {
        $strSearch = isset($_POST["Search"]) ? $_POST["Search"]  : '';

        $strFilter = "";
        if (!empty($strSearch)) {
            $strFilter = " AND ( UPPER(ctg_con_razsoc) LIKE UPPER('%{$strSearch}%') OR UPPER(ctg_con_nomcom) LIKE UPPER('%{$strSearch}%') ) ";
        }

        $arrUsuarios = array();
        $var_consulta = "SELECT * 
        FROM ctg_contratos 
        WHERE ctg_con_tpo = '6'
        $strFilter
        AND ctg_con_status = '2'
        ORDER BY ctg_con_nomcom";

        $qTMP = pg_query($rmfAdm, $var_consulta);
        //echo $var_consulta;
        while ($rTMP = pg_fetch_assoc($qTMP)) {

            $arrUsuarios[$rTMP["ctg_con_id"]]["ctg_con_id"]          = $rTMP["ctg_con_id"];
            $arrUsuarios[$rTMP["ctg_con_id"]]["ctg_con_razsoc"]              = $rTMP["ctg_con_razsoc"];
            $arrUsuarios[$rTMP["ctg_con_id"]]["ctg_con_nomcom"]              = $rTMP["ctg_con_nomcom"];
            $arrUsuarios[$rTMP["ctg_con_id"]]["ctg_con_nit"]              = $rTMP["ctg_con_nit"];
            $arrUsuarios[$rTMP["ctg_con_id"]]["ctg_con_dir"]              = $rTMP["ctg_con_dir"];
            $arrUsuarios[$rTMP["ctg_con_id"]]["ctg_con_zona"]              = $rTMP["ctg_con_zona"];
            $arrUsuarios[$rTMP["ctg_con_id"]]["ctg_con_tels"]              = $rTMP["ctg_con_tels"];
            $arrUsuarios[$rTMP["ctg_con_id"]]["ctg_con_email"]              = $rTMP["ctg_con_email"];
        }
        pg_free_result($qTMP);

?>
        <div class="col-md-12 tableFixHead">
            <table id="tableData" class="table table-bordered table-striped table-hover table-sm">
                <thead>
                    <tr class="table-info">
                        <th>No. Contrato</th>
                        <th>Nombre Completo</th>
                        <th>Nombre de Comercial</th>
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
                            <tr style="cursor:pointer;" onclick="fntSelectContrato('<?php print $intContador; ?>');">
                                <td width='10%'><?php echo  $rTMP["value"]['ctg_con_id']; ?></td>
                                <td width='50%'><?php echo  $rTMP["value"]['ctg_con_nomcom']; ?></td>
                                <td width='35%'><?php echo  $rTMP["value"]['ctg_con_razsoc']; ?></td>
                            </tr>
                            <input type="hidden" name="hid_contrato<?php print $intContador; ?>" id="hid_contrato<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['ctg_con_id']; ?>">
                            <input type="hidden" name="hid_nombre<?php print $intContador; ?>" id="hid_nombre<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['ctg_con_nomcom']; ?>">
                            <input type="hidden" name="hid_razon<?php print $intContador; ?>" id="hid_razon<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['ctg_con_razsoc']; ?>">
                            <input type="hidden" name="hid_nit<?php print $intContador; ?>" id="hid_nit<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['ctg_con_nit']; ?>">
                            <input type="hidden" name="hid_dir<?php print $intContador; ?>" id="hid_dir<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['ctg_con_dir']; ?>">
                            <input type="hidden" name="hid_zona<?php print $intContador; ?>" id="hid_zona<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['ctg_con_zona']; ?>">
                            <input type="hidden" name="hid_tels<?php print $intContador; ?>" id="hid_tels<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['ctg_con_tels']; ?>">
                            <input type="hidden" name="hid_email<?php print $intContador; ?>" id="hid_email<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['ctg_con_email']; ?>">
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
    } else if ($strTipoValidacion == "dibujo_dropdow_dep") {

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

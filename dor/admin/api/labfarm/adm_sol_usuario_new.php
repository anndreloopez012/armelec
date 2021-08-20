<?php
//GLOBAL variableId
require_once '../../api/var_global.php';

// VALIDATION INSERT UPDATE DELETE
if (isset($_GET["validaciones"]) && !empty($_GET["validaciones"])) {

    require_once '../../../data/conexion/tmfAdm.php';
    require_once '../../../data/conexion/tmfLaf.php';

    $ctg_laf_usr = $_SESSION['adm_usr_code'];

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
    $ctg_laf_nombreFull = $nombre_comercial;

    $adm_usr_tipo = 'laf';
    $ctg_laf_censuc = 1;
    $status_actual = 1;
    $ctg_laf_sta = 1;
    $ctg_laf_estatus = 1;
    $ctg_laf_sol_dt = date("Y-m-d");
    $ctg_laf_aut_dt = date("Y-m-d");

    $ctg_con_tpo = '4';
    $ctg_laf_censuc = 1;
    $ctg_laf_estatus = 1;
    $ctg_laf_sta = 1;
    $ctg_laf_sol_dt = date("Y-m-d");
    $ctg_laf_aut_dt = date("Y-m-d");

    $ctg_laf_ven_dt_Y = date("Y");
    $ctg_laf_ven_dt_Y = $ctg_laf_ven_dt_Y ;
    $ctg_laf_ven_dt_m = date("m");
    $ctg_laf_ven_dt_d = date("d");
    $ctg_laf_ven_dt = $ctg_laf_ven_dt_Y . "-" . $ctg_laf_ven_dt_m . "-" . $ctg_laf_ven_dt_d;
    $ctg_laf_dt = date("Y-m-d");
    $ctg_laf_ven_dt = date('Y-m-d', strtotime($ctg_laf_dt . " + 30 day"));

    $fecha = date('d-m-Y');


    $strTipoValidacion = isset($_REQUEST["validaciones"]) ? $_REQUEST["validaciones"] : '';
    if ($strTipoValidacion == "proces") {

        header('Content-Type: application/json');

        
        $rs = pg_query($rmfAdm, "SELECT CAST ( ctg_laf_code AS integer) from ctg_lab_farmaceuticos ORDER BY ctg_laf_code DESC");
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
        $var_consulta = "INSERT INTO ctg_lab_farmaceuticos(ctg_laf_nomcom,ctg_laf_nit,ctg_laf_contrato,ctg_laf_code,ctg_laf_email,ctg_laf_username,ctg_laf_pass,ctg_laf_estatus,ctg_laf_sol_dt,ctg_laf_aut_dt,ctg_laf_ven_dt,ctg_laf_sta,ctg_laf_dt,ctg_laf_usr) VALUES('$nombre_comercial','$nit','$contrato','$variableCode','$email','$nombre_usuario','".md5($clave2)."','$ctg_laf_estatus','$ctg_laf_sol_dt','$ctg_laf_aut_dt','$ctg_laf_ven_dt','$ctg_laf_sta','$ctg_laf_dt','$ctg_laf_usr');";
        if (pg_query($rmfAdm, $var_consulta)) {
            $arrInfo['status'] = $val;
        } else {
            $arrInfo['status'] = 0;
            $arrInfo['error'] = $var_consulta;
        }
       
        $usuarioCode = $variableCode;
        $val = 2;
        $var_consulta = "INSERT INTO web_users(mail,username,adm_usr_tipo,adm_usr_code,password,nombre_completo,adm_usr_contrato,status_actual,adm_date_ven) VALUES ('$email','$nombre_usuario','$adm_usr_tipo','$usuarioCode','".md5($clave2)."','$ctg_laf_nombreFull','$contrato',$ctg_laf_estatus,'$ctg_laf_ven_dt');";
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
            $subject_ = 'BIENVENIDO LABORATORIO FARMACEUTICO A VISUALMED.online';
            $address_  = $email;
            $mailContent = '<b>BIENVENIDO LABORATORIO FARMACEUTICO A VISUALMED.online</b><br><br>
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

            <b>Usuario:</b><a>'.$nombre_usuario.'</a><br>
            <b>Contraseña:</b><a>'.$clave2.'</a><br><br>

            <b>Su menbresia vence el:</b><a>'.$ctg_laf_ven_dt.'</a><br>

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
            $tabla1 = "laf" . $variableId . "medicos";
            $llave1 = "laf" . $variableId . "med_key";

            $sql = "CREATE TABLE IF NOT EXISTS {$tabla1}
                (
                laf_med_id serial,
                laf_med_col integer, -- colegiado del medico
                laf_med_code integer NOT NULL, -- Id del medico
                laf_med_nombre character varying(100), -- nombre del medico
                laf_med_sta char(1), -- estatus del registro 1=creacion 2=edicion 3=borrado
                laf_med_dt timestamp without time zone, -- fecha de actualizacion
                laf_med_usr character varying(15), -- ID del usuario que actualiza
                CONSTRAINT {$llave1} PRIMARY KEY (laf_med_code)
                );
                COMMENT ON COLUMN {$tabla1}.laf_med_id IS 'Id secuencial';
                COMMENT ON COLUMN {$tabla1}.laf_med_col IS 'colegiado del medico';
                COMMENT ON COLUMN {$tabla1}.laf_med_code IS 'Id del medico';
                COMMENT ON COLUMN {$tabla1}.laf_med_nombre IS 'nombre del medico';
                COMMENT ON COLUMN {$tabla1}.laf_med_sta IS 'estatus del registro 1=creacion 2=edicion 3=borrado';
                COMMENT ON COLUMN {$tabla1}.laf_med_dt IS 'fecha de actualizacion';
                COMMENT ON COLUMN {$tabla1}.laf_med_usr IS 'ID del usuario que actualiza';
                ";
            if (pg_query($tmfLaf, $sql)) {
                $arrInfo['status'] = $val;
            } else {
                $arrInfo['status'] = 0;
                $arrInfo['error'] = $sql;
            }
            //print_r('<br>');
            //print_r($sql);
            //print json_encode($arrInfo);

            $val = 4;
            $tabla1 = "laf" . $variableId . "medicosproductos";
            $llave1 = "laf" . $variableId . "medp_key";

            $sql = "CREATE TABLE IF NOT EXISTS {$tabla1}
                (
                laf_medp_id serial,
                laf_medp_code integer NOT NULL, -- Id del medico
                laf_medp_nombre character varying(100), -- nombre del medico
                laf_medp_codprod character varying(20) NOT NULL, -- ID del producto de referencia
                laf_medp_nomprod character varying(200), -- nombre del producto
                laf_medp_month integer NOT NULL, -- mes de orden
                laf_medp_year integer NOT NULL, -- año de orden
                laf_medp_contador integer, -- contador
                laf_medp_sta char(1), -- estatus del registro 1=creacion 2=edicion 3=borrado
                laf_medp_dt timestamp without time zone, -- fecha de actualizacion
                laf_medp_usr character varying(15), -- ID del usuario que actualiza
                CONSTRAINT {$llave1} PRIMARY KEY (laf_medp_code, laf_medp_codprod, laf_medp_year, laf_medp_month)
                );
                COMMENT ON COLUMN {$tabla1}.laf_medp_id IS 'Id secuencial';
                COMMENT ON COLUMN {$tabla1}.laf_medp_code IS 'Id del medico';
                COMMENT ON COLUMN {$tabla1}.laf_medp_nombre IS 'nombre del medico';
                COMMENT ON COLUMN {$tabla1}.laf_medp_codprod IS 'ID del producto de referencia';
                COMMENT ON COLUMN {$tabla1}.laf_medp_nomprod IS 'nombre del producto';
                COMMENT ON COLUMN {$tabla1}.laf_medp_month IS 'mes de orden';
                COMMENT ON COLUMN {$tabla1}.laf_medp_year IS 'año de orden';
                COMMENT ON COLUMN {$tabla1}.laf_medp_contador IS 'contador';
                COMMENT ON COLUMN {$tabla1}.laf_medp_sta IS 'estatus del registro 1=creacion 2=edicion 3=borrado';
                COMMENT ON COLUMN {$tabla1}.laf_medp_dt IS 'fecha de actualizacion';
                COMMENT ON COLUMN {$tabla1}.laf_medp_usr IS 'ID del usuario que actualiza';
                ";
            if (pg_query($tmfLaf, $sql)) {
                $arrInfo['status'] = $val;
            } else {
                $arrInfo['status'] = 0;
                $arrInfo['error'] = $sql;
            }
            // print_r($sql);
            //print json_encode($arrInfo);

            $val = 5;
            $tabla1 = "laf" . $variableId . "productos";
            $llave1 = "laf" . $variableId . "prod_pkey";

            $sql = "CREATE TABLE IF NOT EXISTS {$tabla1}
                (
                laf_pro_id serial,
                laf_pro_cod character varying(20) NOT NULL, -- Id del producto de referencia
                laf_pro_nombre character varying(200),
                laf_pro_contador integer, -- Contador de productos ordenados
                laf_pro_sta char(1), -- estatus del registro 1=creacion 2=edicion 3=borrado
                laf_pro_dt timestamp without time zone, -- fecha de actualizacion
                laf_pro_usr character varying(15), -- ID del usuario que actualiza
                CONSTRAINT {$llave1} PRIMARY KEY (laf_pro_cod)
                );
                COMMENT ON COLUMN {$tabla1}.laf_pro_id IS 'Id del producto secuencial';
                COMMENT ON COLUMN {$tabla1}.laf_pro_cod IS 'Id del producto de referencia';
                COMMENT ON COLUMN {$tabla1}.laf_pro_contador IS 'Contador de productos ordenados';
                COMMENT ON COLUMN {$tabla1}.laf_pro_sta IS 'estatus del registro 1=creacion 2=edicion 3=borrado';
                COMMENT ON COLUMN {$tabla1}.laf_pro_dt IS 'fecha de actualizacion';
                COMMENT ON COLUMN {$tabla1}.laf_pro_usr IS 'ID del usuario que actualiza';
                ";
            if (pg_query($tmfLaf, $sql)) {
                $arrInfo['status'] = $val;
            } else {
                $arrInfo['status'] = 0;
                $arrInfo['error'] = $sql;
            }
            // print_r($sql);
            // print json_encode($arrInfo);

            $val = 6;
            $tabla1 = "laf" . $variableId . "productoscontador";
            $llave1 = "laf" . $variableId . "prodc_key";

            $sql = "CREATE TABLE IF NOT EXISTS {$tabla1}
                (
                laf_prodc_id serial,
                laf_prodc_cod character varying(20) NOT NULL, -- Id del producto de referencia
                laf_prodc_month integer NOT NULL, -- mes del contador
                laf_prodc_year integer NOT NULL, -- año del contador
                laf_prodc_contador integer, -- Contador de productos recetados
                laf_prodc_sta char(1), -- estatus del registro 1=creacion 2=edicion 3=borrado
                laf_prodc_dt timestamp without time zone, -- fecha de actualizacion
                laf_prodc_usr character varying(15), -- ID del usuario que actualiza
                CONSTRAINT {$llave1} PRIMARY KEY (laf_prodc_cod, laf_prodc_year, laf_prodc_month)
                );
                COMMENT ON COLUMN {$tabla1}.laf_prodc_id IS 'Id  secuencial';
                COMMENT ON COLUMN {$tabla1}.laf_prodc_cod IS 'Id del producto de referencia';
                COMMENT ON COLUMN {$tabla1}.laf_prodc_month IS 'mes del contador';
                COMMENT ON COLUMN {$tabla1}.laf_prodc_year IS 'año del contador';
                COMMENT ON COLUMN {$tabla1}.laf_prodc_contador IS 'Contador de productos recetados';
                COMMENT ON COLUMN {$tabla1}.laf_prodc_sta IS 'estatus del registro 1=creacion 2=edicion 3=borrado';
                COMMENT ON COLUMN {$tabla1}.laf_prodc_dt IS 'fecha de actualizacion';
                COMMENT ON COLUMN {$tabla1}.laf_prodc_usr IS 'ID del usuario que actualiza';
                ";
            if (pg_query($tmfLaf, $sql)) {
                $arrInfo['status'] = $val;
            } else {
                $arrInfo['status'] = 0;
                $arrInfo['error'] = $sql;
            }
            //print_r($sql);
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
                                <td width='30%'><?php echo  $rTMP["value"]['sru_nombre_comercial']; ?></td>
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

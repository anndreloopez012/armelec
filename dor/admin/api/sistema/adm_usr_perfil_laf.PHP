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
    require_once '../../../data/conexion/tmfLaf.php';
    require_once '../../../data/conexion/tmlMed.php';

    require_once '../../../api/config.php';

    $usuarioId = $_SESSION['adm_usr_code'];

    $codeId = isset($_POST["codeId"]) ? $_POST["codeId"]  : '';

    $ctg_laf_nomcom = isset($_POST["ctg_laf_nomcom"]) ? $_POST["ctg_laf_nomcom"]  : '';
    $ctg_laf_nit = isset($_POST["ctg_laf_nit"]) ? $_POST["ctg_laf_nit"]  : '';
    $ctg_laf_suc = isset($_POST["ctg_laf_suc"]) ? $_POST["ctg_laf_suc"]  : '';
    $ctg_laf_dir = isset($_POST["ctg_laf_dir"]) ? $_POST["ctg_laf_dir"]  : '';
    $ctg_laf_zona = isset($_POST["ctg_laf_zona"]) ? $_POST["ctg_laf_zona"]  : '';
    $region = isset($_POST["region"]) ? $_POST["region"]  : '';
    $distrito = isset($_POST["distrito"]) ? $_POST["distrito"]  : '';
    $ctg_laf_tels = isset($_POST["ctg_laf_tels"]) ? $_POST["ctg_laf_tels"]  : '';
    $ctg_laf_email = isset($_POST["ctg_laf_email"]) ? $_POST["ctg_laf_email"]  : '';
    $ctg_laf_nombreFull = $ctg_laf_nomcom.' '.$ctg_laf_suc ;

    $username = isset($_POST["username"]) ? $_POST["username"]  : '';
    $ctg_laf_enc_dpi = isset($_POST["ctg_laf_enc_dpi"]) ? $_POST["ctg_laf_enc_dpi"]  : '';
    $ctg_laf_enc_nom = isset($_POST["ctg_laf_enc_nom"]) ? $_POST["ctg_laf_enc_nom"]  : '';
    $password = isset($_POST["password"]) ? $_POST["password"]  : '';
    $password_conf = isset($_POST["password_conf"]) ? $_POST["password_conf"]  : '';

    $ctg_laf_contrato = isset($_POST["ctg_laf_contrato"]) ? $_POST["ctg_laf_contrato"]  : '';
    $adm_usr_contrato = isset($ctg_laf_contrato) ? $ctg_laf_contrato  : '';

    $adm_usr_tipo = 'laf';
    $sucursal = 1;
    $ctg_laf_censuc = 1;
    $status_actual = 1;
    $ctg_laf_sta = 1;
    $ctg_laf_estatus = 1;
    $ctg_laf_sol_dt = date("Y-m-d");
    $ctg_laf_aut_dt = date("Y-m-d");

    $ctg_laf_ven_dt_Y = date("Y");
    $ctg_laf_ven_dt_Y = $ctg_laf_ven_dt_Y + 1;
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
        $val = 2;
        $var_consulta = "INSERT INTO ctg_lab_farmaceuticos(ctg_laf_contrato,ctg_laf_nit,ctg_laf_nomcom,ctg_laf_code,ctg_laf_dir,ctg_laf_zona,ctg_laf_dep,ctg_laf_mun,ctg_laf_tels,ctg_laf_email,ctg_laf_enc_dpi,ctg_laf_enc_nom1,ctg_laf_username,ctg_laf_pass,ctg_laf_estatus,ctg_laf_sol_dt,ctg_laf_aut_dt,ctg_laf_ven_dt,ctg_laf_sta,ctg_laf_dt,ctg_laf_usr) VALUES ('$ctg_laf_contrato','$ctg_laf_nit','$ctg_laf_nomcom','$variableCode','$ctg_laf_dir','$ctg_laf_zona','$region','$distrito','$ctg_laf_tels','$ctg_laf_email','$ctg_laf_enc_dpi','$ctg_laf_enc_nom','$username','$password','$ctg_laf_estatus','$ctg_laf_sol_dt','$ctg_laf_aut_dt','$ctg_laf_ven_dt','$ctg_laf_sta','$ctg_laf_dt','$usuarioId');";
        if (pg_query($rmfAdm, $var_consulta)) {
            $arrInfo['status'] = $val;
        } else {
            $arrInfo['status'] = 0;
            $arrInfo['error'] = $var_consulta;
        }
       // //print_r($var_consulta);
       // print json_encode($arrInfo);

       $val = 3;
        $var_consulta = "UPDATE ctg_contratos SET ctg_con_status = '3' WHERE ctg_con_id = $ctg_laf_contrato";
        if (pg_query($rmfAdm, $var_consulta)) {
            $arrInfo['status'] = $val;
        } else {
            $arrInfo['status'] = 0;
            $arrInfo['error'] = $var_consulta;
        }
        
        $usuarioCode = $variableCode;
        $val = 1;
        $var_consulta = "INSERT INTO web_users(mail,username,adm_usr_tipo,adm_usr_code,password,nombre_completo,adm_usr_contrato,status_actual,adm_date_ven) 
                                    VALUES ('$ctg_laf_email','$username','$adm_usr_tipo','$usuarioCode','".md5($password)."','$ctg_laf_nombreFull','$ctg_laf_contrato',$status_actual,'$ctg_laf_ven_dt');";
        if (pg_query($rmfAdm, $var_consulta)) {
            $arrInfo['status'] = $val;
        } else {
            $arrInfo['status'] = 0;
            $arrInfo['error'] = $var_consulta;
        }

        $var_consulta = "INSERT INTO ctg_membresias(ctg_mem_id,ctg_mem_type,ctg_mem_stat,ctg_mem_fec,ctg_mem_fec_venc,ctg_mem_estatus,ctg_mem_formpag,ctg_mem_valor,ctg_mem_cuotas) VALUES ('$usuarioCode','$adm_usr_tipo','1','now()','$ctg_laf_ven_dt','2','0',0,1);";
        if (pg_query($rmfAdm, $var_consulta)) {
            $arrInfo['status'] = $val;
        } else {
            $arrInfo['status'] = 0;
            $arrInfo['error'] = $var_consulta;
        }
  

        if ($val) {
            $subject_ = 'BIENVENIDO LABORATORIO FARMACEUTICO A VISUALMED.online';
            $address_  = $ctg_laf_email;
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

            <b>Estimado:</b><b>' . $ctg_laf_nomcom . '</b><br><br>
            <b>Fecha:</b><b>' . $fecha . '</b><br><br>

            <b>Hemos registrado un perfil con los datos de tu laboratorio en nuestra plataforma. Con este
            usuario podras acceder al modulo de LAB. CLINICOS que se encuentra en la pagina
            <a href="www.visualmed.online">www.visualmed.online</a> y actualizar la informacion de tu perfil, cargar tus examenes y precios de
            venta, ver las ordenes recibidas en lineas y generar reportes entre otras utilidades.</a><br><br>

            <b>Usuario:</b><a>'.$username.'</a><br>
            <b>Contraseña:</b><a>'.$password.'</a><br><br>

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
        ////print_r($var_consulta);
        print json_encode($arrInfo);
        $variableId = $variableCode;

        if ($val) {
            $val = 3;
            $tabla1="laf".$variableId."medicos";
            $llave1="laf".$variableId."med_key";
        
            $sql="CREATE TABLE IF NOT EXISTS {$tabla1}
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
            $tabla1="laf".$variableId."medicosproductos";
            $llave1="laf".$variableId."medp_key";
        
            $sql="CREATE TABLE IF NOT EXISTS {$tabla1}
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
            $tabla1="laf".$variableId."productos";
            $llave1="laf".$variableId."prod_pkey";
        
            $sql="CREATE TABLE IF NOT EXISTS {$tabla1}
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
            $tabla1="laf".$variableId."productoscontador";
            $llave1="laf".$variableId."prodc_key";
        
            $sql="CREATE TABLE IF NOT EXISTS {$tabla1}
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
    }else if ($strTipoValidacion == "delete") {
        $val = 1;
        $var_consulta = "DELETE FROM ctg_lab_farmaceuticos WHERE ctg_laf_code = '$codeId';";
        if (pg_query($rmfAdm, $var_consulta)) {
            $arrInfo['status'] = $val;
        } else {
            $arrInfo['status'] = 0;
            $arrInfo['error'] = $var_consulta;
        }
       // //print_r($var_consulta);
        //print json_encode($arrInfo);

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
            $tabla1="laf".$variableId."medicos";
            $sql = "DROP TABLE {$tabla1} ;";
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
            $tabla1="laf".$variableId."medicosproductos";
            $sql = "DROP TABLE {$tabla1};";
                if (pg_query($tmfLaf, $sql)) {
                    $arrInfo['status'] = $val;
                } else {
                    $arrInfo['status'] = 0;
                    $arrInfo['error'] = $sql;
                }
               // print_r($sql);
               // print json_encode($arrInfo);

            $val = 5;
            $tabla1="laf".$variableId."productos";
            $sql = "DROP TABLE {$tabla1};";
                if (pg_query($tmfLaf, $sql)) {
                    $arrInfo['status'] = $val;
                } else {
                    $arrInfo['status'] = 0;
                    $arrInfo['error'] = $sql;
                }
               // print_r($sql);
               // print json_encode($arrInfo);

            $val = 6;
            $tabla1="laf".$variableId."productoscontador";
            $sql = "DROP TABLE {$tabla1};";
                if (pg_query($tmfLaf, $sql)) {
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
            $strFilter = " WHERE ( UPPER(ctg_laf_nomcom) LIKE UPPER('%{$strSearch}%') OR UPPER(ctg_laf_username) LIKE UPPER('%{$strSearch}%') ) ";
        }

        $arrUsuarios = array();
        $var_consulta = "SELECT * 
        FROM ctg_lab_farmaceuticos 
        $strFilter
        ORDER BY ctg_laf_nomcom";

        $qTMP = pg_query($rmfAdm, $var_consulta);
        //echo $var_consulta;
        while ($rTMP = pg_fetch_assoc($qTMP)) {

            $arrUsuarios[$rTMP["id"]]["id"]                          = $rTMP["id"];
            $arrUsuarios[$rTMP["id"]]["ctg_laf_contrato"]            = $rTMP["ctg_laf_contrato"];
            $arrUsuarios[$rTMP["id"]]["ctg_laf_nomcom"]              = $rTMP["ctg_laf_nomcom"];
            $arrUsuarios[$rTMP["id"]]["ctg_laf_username"]            = $rTMP["ctg_laf_username"];
            $arrUsuarios[$rTMP["id"]]["ctg_laf_code"]            = $rTMP["ctg_laf_code"];

        }
        pg_free_result($qTMP);

?>
        <div class="col-md-12 tableFixHead">
            <table id="tableData" class="table table-bordered table-striped table-hover table-sm">
                <thead>
                    <tr class="table-info">
                        <th>No. Contrato</th>
                        <th>Nombre Completo</th>
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
                                <td whidth='%10'><?php echo  $rTMP["value"]['ctg_laf_contrato']; ?></td>
                                <td whidth='%30'><?php echo  $rTMP["value"]['ctg_laf_nomcom']; ?></td>
                                <td whidth='%30'><?php echo  $rTMP["value"]['ctg_laf_username']; ?></td>
                                <td whidth='%30' style="cursor:pointer;" onclick="fntSelect('<?php print $intContador; ?>');"><i class="fad fa-trash-alt"></i></td>
                            </tr>
                            <input type="hidden" name="hid_id<?php print $intContador; ?>" id="hid_id<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['ctg_laf_code']; ?>">
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
        $var_consulta = pg_query($rmfAdm, "SELECT COUNT(sru_id) FROM sol_regis_user WHERE email = '$ctg_ase_email' AND sru_modulo = 'laf' LIMIT 1;");
        if ($row = pg_fetch_array($var_consulta)) {
            $idRow = trim($row[0]);
        }
        $usuarioCode = isset($idRow) ? $idRow  : 0;

        $var_consulta = pg_query($rmfAdm, "SELECT COUNT(adm_usr_id) FROM web_users WHERE mail = '$ctg_laf_email' AND adm_usr_tipo = 'laf' LIMIT 1;");
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

        $var_consulta = pg_query($rmfAdm, "SELECT COUNT(ctg_laf_nomcom) FROM ctg_lab_farmaceuticos WHERE UPPER(ctg_laf_nomcom) = UPPER('$ctg_laf_nomcom') LIMIT 1;");

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

        $var_consulta = pg_query($rmfAdm, "SELECT COUNT(ctg_laf_suc) FROM ctg_lab_farmaceuticos WHERE UPPER(ctg_laf_suc) = UPPER('$ctg_laf_suc') LIMIT 1;");

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
        WHERE ctg_con_tpo = '4'
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

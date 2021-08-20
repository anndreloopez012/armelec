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

    $ctg_med_nombres = isset($_POST["ctg_med_nombres"]) ? $_POST["ctg_med_nombres"]  : '';
    $ctg_med_apellidos = isset($_POST["ctg_med_apellidos"]) ? $_POST["ctg_med_apellidos"]  : '';
    $ctg_med_nit = isset($_POST["ctg_med_nit"]) ? $_POST["ctg_med_nit"]  : '';
    $ctg_med_dpi = isset($_POST["ctg_med_dpi"]) ? $_POST["ctg_med_dpi"]  : '';
    $ctg_med_dir = isset($_POST["ctg_med_dir"]) ? $_POST["ctg_med_dir"]  : '';
    $ctg_med_zona = isset($_POST["ctg_med_zona"]) ? $_POST["ctg_med_zona"]  : '';
    $region = isset($_POST["region"]) ? $_POST["region"]  : '';
    $distrito = isset($_POST["distrito"]) ? $_POST["distrito"]  : '';
    $ctg_med_tels = isset($_POST["ctg_med_tels"]) ? $_POST["ctg_med_tels"]  : '';
    $ctg_med_email = isset($_POST["ctg_med_email"]) ? $_POST["ctg_med_email"]  : '';

    $username = isset($_POST["username"]) ? $_POST["username"]  : '';
    $ctg_med_enc_nom =$ctg_med_nombres ." ". $ctg_med_apellidos;
    $password = isset($_POST["password"]) ? $_POST["password"]  : '';
    $password_conf = isset($_POST["password_conf"]) ? $_POST["password_conf"]  : '';

    $ctg_med_col = isset($_POST["ctg_med_col"]) ? $_POST["ctg_med_col"]  : '';
    $adm_usr_contrato = isset($ctg_med_col) ? $ctg_med_col  : '';

    $adm_usr_tipo = 'med';
    $sucursal = 1;
    $ctg_med_censuc = 1;
    $status_actual = 1;
    $ctg_med_sta = 1;
    $ctg_med_estatus = 0;
    $ctg_med_sol_dt = date("Y-m-d");
    $ctg_med_aut_dt = date("Y-m-d");

    $ctg_med_ven_dt_Y = date("Y");
    $ctg_med_ven_dt_Y = $ctg_med_ven_dt_Y + 1;
    $ctg_med_ven_dt_m = date("m");
    $ctg_med_ven_dt_d = date("d");
    $ctg_med_ven_dt = $ctg_med_ven_dt_Y . "-" . $ctg_med_ven_dt_m . "-" . $ctg_med_ven_dt_d;
    $ctg_med_dt = date("Y-m-d");
    $ctg_med_ven_dt = date('Y-m-d', strtotime($ctg_med_dt . " + 180 day"));

    $fecha = date('d-m-Y');


    $strTipoValidacion = isset($_REQUEST["validaciones"]) ? $_REQUEST["validaciones"] : '';
    if ($strTipoValidacion == "proces") {

        header('Content-Type: application/json');

        $rs = pg_query($rmfAdm, "SELECT CAST ( ctg_med_code AS integer) from ctg_medicos ORDER BY ctg_med_code DESC");
        if ($row = pg_fetch_array($rs)) {
            $idRow = trim($row[0]);
        }
        $variableCode_ = isset($idRow) ? $idRow  : 0;
        $variableCode = $variableCode_ + 1;
        $val = 2;
        $var_consulta = "INSERT INTO ctg_medicos(ctg_med_col,ctg_med_nit,ctg_med_dpi,ctg_med_nombres,ctg_med_apellidos,ctg_med_code,ctg_med_dir,ctg_med_zona,ctg_med_dep,ctg_med_mun,ctg_med_telcel,ctg_med_email,ctg_med_username,ctg_med_pass,ctg_med_estatus,ctg_med_sol_dt,ctg_med_aut_dt,ctg_med_ven_dt,ctg_med_sta,ctg_med_dt,ctg_med_usr,ctg_med_esp) VALUES ('$ctg_med_col','$ctg_med_nit','$ctg_med_dpi','$ctg_med_nombres','$ctg_med_apellidos','$variableCode','$ctg_med_dir','$ctg_med_zona','$region','$distrito','$ctg_med_tels','$ctg_med_email','$username','$password','$ctg_med_estatus','$ctg_med_sol_dt','$ctg_med_aut_dt','$ctg_med_ven_dt','$ctg_med_sta','$ctg_med_dt','$usuarioId',99);";
        if (pg_query($rmfAdm, $var_consulta)) {
            $arrInfo['status'] = $val;
        } else {
            $arrInfo['status'] = 0;
            $arrInfo['error'] = $var_consulta;
        }

        if ($val) {
            $subject_ = 'BIENVENIDO DOCTOR A VISUALMED.online';
            $address_  = $ctg_med_email;
            $mailContent = '<b>BIENVENIDO DOCTOR A VISUALMED.online</b><br><br>
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

            <b>Estimado:</b><b>' . $ctg_med_enc_nom . '</b><br><br>
            <b>Fecha:</b><b>' . $fecha . '</b><br><br>

            <b>Hemos registrado un perfil con tu nombre en nuestra plataforma de registro y consultas de
            archivo medico. Con este usuario podras acceder al modulo de MEDICOS que se encuentra en la
            pagina <a href="www.visualmed.online">www.visualmed.online</a> y actualizar la informacion de tu perfil, crear tu archivo
            electronico de pacientes y sus familiares, registrar tu inventario de vacunas, registrar tu catalogo
            de dietas, registrar las consultas de los pacientes que te visiten y generar citas entre otras
            utilidades. Tambien podras buscar medicamentos en linea de las distintas farmacias
            participantes, buscar en linea ordenes de examenes de laboratorio y buscar en linea servicios
            hospitalarios.</a><br><br>

            <b>Usuario:</b><a>'.$username.'</a><br>
            <b>Contraseña:</b><a>'.$password.'</a><br><br>

            <b>Su menbresia vence el:</b><a>'.$ctg_med_ven_dt.'</a><br>

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
        //print json_encode($arrInfo);

        $usuarioCode = $variableCode;
        $val = 1;
        $var_consulta = "INSERT INTO web_users(mail,username,adm_usr_tipo,adm_usr_code,password,nombre_completo,status_actual,adm_date_ven) VALUES ('$ctg_med_email','$username','$adm_usr_tipo','$usuarioCode','".md5($password)."','$ctg_med_enc_nom',$status_actual,'$ctg_med_ven_dt');";
        if (pg_query($rmfAdm, $var_consulta)) {
            $arrInfo['status'] = $val;
        } else {
            $arrInfo['status'] = 0;
            $arrInfo['error'] = $var_consulta;
        }

        $var_consulta = "INSERT INTO ctg_membresias(ctg_mem_id,ctg_mem_type,ctg_mem_stat,ctg_mem_fec,ctg_mem_fec_venc,ctg_mem_estatus,ctg_mem_formpag,ctg_mem_valor,ctg_mem_cuotas) VALUES ('$usuarioCode','$adm_usr_tipo','1','now()','$ctg_med_ven_dt','2','0',0,6);";
        if (pg_query($rmfAdm, $var_consulta)) {
            $arrInfo['status'] = $val;
        } else {
            $arrInfo['status'] = 0;
            $arrInfo['error'] = $var_consulta;
        }

        //print_r($var_consulta);
        print json_encode($arrInfo);
        $variableId = $variableCode;

        if ($val) {        
            $val = 3;
            $tabla1 = "med" . $variableId . "citas";
            $llave1 = "med" . $variableId . "cit_pkey";

            $sql = "CREATE TABLE IF NOT EXISTS {$tabla1}
            (
            id serial,
            med_cit_id integer NOT NULL, -- ID de la cita
            med_cit_cita_dt timestamp without time zone NOT NULL, -- fecha de cita
            med_cit_pac_id integer NOT NULL, -- ID interno del paciente
            med_cit_motivo text, -- motivo de la cita
            med_cit_estatus char(1), -- 0=programada 1=realizada 2=anulada
            med_cit_sta char(1), -- estatus del registro 1=creacion 2=edicion 3=borrado
            med_cit_dt timestamp without time zone, -- fecha de actualizacion
            med_cit_usr character varying(15), -- ID del usuario que actualiza
            CONSTRAINT {$llave1} PRIMARY KEY (med_cit_id, med_cit_cita_dt, med_cit_pac_id)
            );
            COMMENT ON COLUMN {$tabla1}.id IS 'id secuencial';
            COMMENT ON COLUMN {$tabla1}.med_cit_id IS 'ID de la cita';
            COMMENT ON COLUMN {$tabla1}.med_cit_cita_dt IS 'fecha de cita';
            COMMENT ON COLUMN {$tabla1}.med_cit_pac_id IS 'ID interno del paciente';
            COMMENT ON COLUMN {$tabla1}.med_cit_motivo IS 'motivo de la cita';
            COMMENT ON COLUMN {$tabla1}.med_cit_estatus IS '0=programada 1=realizada 2=anulada';
            COMMENT ON COLUMN {$tabla1}.med_cit_sta IS 'estatus del registro 1=creacion 2=edicion 3=borrado';
            COMMENT ON COLUMN {$tabla1}.med_cit_dt IS 'fecha de actualizacion';
            COMMENT ON COLUMN {$tabla1}.med_cit_usr IS 'ID del usuario que actualiza';
            ";
            
            if (pg_query($tmfMed, $sql)) {
                $arrInfo['status'] = $val;
            } else {
                $arrInfo['status'] = 0;
                $arrInfo['error'] = $sql;
            }
            //print_r('<br>');
            //print_r($sql);
            //print json_encode($arrInfo);

            $val = 4;
            $tabla1 = "med" . $variableId . "consultas";
            $llave1 = "med" . $variableId . "consultas_pkey";

            $sql = "CREATE TABLE IF NOT EXISTS {$tabla1}
                (
                id serial,
                med_con_id integer NOT NULL, -- ID de la consulta
                med_con_pac_id integer NOT NULL, -- ID interno del paciente
                med_con_cita_dt timestamp without time zone NOT NULL, -- fecha de consulta
                med_con_motivo text, -- motivo de la consulta
                med_con_examen text, -- examen realizado
                med_con_receta text, -- descripcion de la receta
                med_con_dieta text, -- descripcion de la dieta
                med_con_observa text, -- observaciones
                med_con_uni_id integer, -- ID de la unidad sanitaria
                med_con_enf_id integer, -- ID interno de la enfermedad
                med_con_citap_dt timestamp without time zone, -- fecha de proxima consulta
                med_con_sta char(1), -- estatus del registro 1=creacion 2=edicion 3=borrado
                med_con_dt timestamp without time zone, -- fecha de actualizacion
                med_con_usr character varying(15), -- ID del usuario que actualiza
                CONSTRAINT {$llave1} PRIMARY KEY (med_con_id)
                );
                COMMENT ON COLUMN {$tabla1}.id IS 'ID secuencial';
                COMMENT ON COLUMN {$tabla1}.med_con_id IS 'ID de la consulta';
                COMMENT ON COLUMN {$tabla1}.med_con_pac_id IS 'ID interno del paciente';
                COMMENT ON COLUMN {$tabla1}.med_con_cita_dt IS 'fecha de consulta';
                COMMENT ON COLUMN {$tabla1}.med_con_motivo IS 'motivo de la consulta';
                COMMENT ON COLUMN {$tabla1}.med_con_examen IS 'examen realizado';
                COMMENT ON COLUMN {$tabla1}.med_con_receta IS 'descripcion de la receta';
                COMMENT ON COLUMN {$tabla1}.med_con_dieta IS 'descripcion de la dieta';
                COMMENT ON COLUMN {$tabla1}.med_con_observa IS 'observaciones';
                COMMENT ON COLUMN {$tabla1}.med_con_uni_id IS 'ID de la unidad sanitaria';
                COMMENT ON COLUMN {$tabla1}.med_con_enf_id IS 'ID interno de la enfermedad';
                COMMENT ON COLUMN {$tabla1}.med_con_citap_dt IS 'fecha de proxima consulta';
                COMMENT ON COLUMN {$tabla1}.med_con_sta IS 'estatus del registro 1=creacion 2=edicion 3=borrado';
                COMMENT ON COLUMN {$tabla1}.med_con_dt IS 'fecha de actualizacion';
                COMMENT ON COLUMN {$tabla1}.med_con_usr IS 'ID del usuario que actualiza';
                ";
                if (pg_query($tmfMed, $sql)) {
                    $arrInfo['status'] = $val;
                } else {
                    $arrInfo['status'] = 0;
                    $arrInfo['error'] = $sql;
                }
            $val = 5;
            $tabla1 = "med" . $variableId . "consultas_examenes";
            $llave1 = "med" . $variableId . "exa_pkey";

            $sql = "CREATE TABLE IF NOT EXISTS {$tabla1}
                (
                id serial,
                med_coe_id integer NOT NULL, -- Id de la consulta
                med_coe_lab_id character varying(32) NOT NULL, -- ID del laboratorio
                med_coe_lax_id character varying(32) NOT NULL, -- ID del examen
                med_coe_pre numeric(15,2) NOT NULL, -- precio
                med_coe_can integer, -- cantidad
                med_coe_desl numeric(10,2), -- descuento laboratorio
                med_coe_valor numeric(10,2), -- subtotal
                med_coe_sta char(1), -- estatus del registro 1=creacion 2=edicion 3=borrado
                med_coe_dt timestamp without time zone, -- fecha de actualizacion
                med_coe_usr character varying(15), -- ID del usuario que actualiza
                CONSTRAINT {$llave1} PRIMARY KEY (med_coe_id, med_coe_lab_id, med_coe_lax_id)
                );
                COMMENT ON COLUMN {$tabla1}.id IS 'ID secuencial';
                COMMENT ON COLUMN {$tabla1}.med_coe_id IS 'Id de la consulta';
                COMMENT ON COLUMN {$tabla1}.med_coe_lab_id IS 'ID del laboratorio';
                COMMENT ON COLUMN {$tabla1}.med_coe_lax_id IS 'ID del examen';
                COMMENT ON COLUMN {$tabla1}.med_coe_pre IS 'precio';
                COMMENT ON COLUMN {$tabla1}.med_coe_can IS 'cantidad';
                COMMENT ON COLUMN {$tabla1}.med_coe_desl IS 'descuento laboratorio';
                COMMENT ON COLUMN {$tabla1}.med_coe_valor IS 'subtotal';
                COMMENT ON COLUMN {$tabla1}.med_coe_sta IS 'estatus del registro 1=creacion 2=edicion 3=borrado';
                COMMENT ON COLUMN {$tabla1}.med_coe_dt IS 'fecha de actualizacion';
                COMMENT ON COLUMN {$tabla1}.med_coe_usr IS 'ID del usuario que actualiza';
                ";
                if (pg_query($tmfMed, $sql)) {
                    $arrInfo['status'] = $val;
                } else {
                    $arrInfo['status'] = 0;
                    $arrInfo['error'] = $sql;
                }
            $val = 6;
            $tabla1 = "med" . $variableId . "consultas_hospitales";
            $llave1 = "med" . $variableId . "hos_pkey";

            $sql = "CREATE TABLE IF NOT EXISTS {$tabla1}
                (
                med_id serial,
                med_coh_id integer NOT NULL, -- Id de la consulta
                med_coh_hos_id character varying(8) NOT NULL, -- ID del laboratorio
                med_coh_ser_id character varying(32) NOT NULL, -- ID del examen
                med_coh_pre numeric(15,2) NOT NULL, -- precio
                med_coh_can integer, -- cantidad
                med_coh_desl numeric(10,2), -- descuento laboratorio
                med_coh_valor numeric(10,2), -- subtotal
                med_coh_sta char(1), -- estatus del registro 1=creacion 2=edicion 3=borrado
                med_coh_dt timestamp without time zone, -- fecha de actualizacion
                med_coh_usr character varying(15), -- ID del usuario que actualiza
                CONSTRAINT {$llave1} PRIMARY KEY (med_coh_id, med_coh_hos_id, med_coh_ser_id)
                );
                COMMENT ON COLUMN {$tabla1}.med_id IS 'Id secuencial';
                COMMENT ON COLUMN {$tabla1}.med_coh_id IS 'Id de la consulta';
                COMMENT ON COLUMN {$tabla1}.med_coh_hos_id IS 'ID del laboratorio';
                COMMENT ON COLUMN {$tabla1}.med_coh_ser_id IS 'ID del examen';
                COMMENT ON COLUMN {$tabla1}.med_coh_pre IS 'precio';
                COMMENT ON COLUMN {$tabla1}.med_coh_can IS 'cantidad';
                COMMENT ON COLUMN {$tabla1}.med_coh_desl IS 'descuento laboratorio';
                COMMENT ON COLUMN {$tabla1}.med_coh_valor IS 'subtotal';
                COMMENT ON COLUMN {$tabla1}.med_coh_sta IS 'estatus del registro 1=creacion 2=edicion 3=borrado';
                COMMENT ON COLUMN {$tabla1}.med_coh_dt IS 'fecha de actualizacion';
                COMMENT ON COLUMN {$tabla1}.med_coh_usr IS 'ID del usuario que actualiza';
                ";
                if (pg_query($tmfMed, $sql)) {
                    $arrInfo['status'] = $val;
                } else {
                    $arrInfo['status'] = 0;
                    $arrInfo['error'] = $sql;
                }

            $val = 7;
            $tabla1 = "med" . $variableId . "consultas_productos";
            $llave1 = "med" . $variableId . "cop_pkey";

            $sql = "CREATE TABLE IF NOT EXISTS {$tabla1}
                (
                id serial,
                med_cop_id integer NOT NULL, -- Id de la consulta
                med_cop_far_id character varying(8) NOT NULL, -- ID de la farmacia
                med_cop_pro_id character varying(20) NOT NULL, -- ID del producto
                med_cop_pre numeric(15,2) NOT NULL, -- precio
                med_cop_can integer, -- cantidad
                med_cop_desf numeric(10,2), -- descuento farmacia
                med_cop_desl numeric(10,2), -- descuento laboratorio
                med_cop_valor numeric(10,2), -- subtotal
                med_cop_sta char(1), -- estatus del registro 1=creacion 2=edicion 3=borrado
                med_cop_dt timestamp without time zone, -- fecha de actualizacion
                med_cop_usr character varying(15), -- ID del usuario que actualiza
                CONSTRAINT {$llave1} PRIMARY KEY (med_cop_id, med_cop_far_id, med_cop_pro_id)
                );
                COMMENT ON COLUMN {$tabla1}.id IS 'Id secuencial';
                COMMENT ON COLUMN {$tabla1}.med_cop_id IS 'Id de la consulta';
                COMMENT ON COLUMN {$tabla1}.med_cop_far_id IS 'ID de la farmacia';
                COMMENT ON COLUMN {$tabla1}.med_cop_pro_id IS 'ID del producto';
                COMMENT ON COLUMN {$tabla1}.med_cop_pre IS 'precio';
                COMMENT ON COLUMN {$tabla1}.med_cop_can IS 'cantidad';
                COMMENT ON COLUMN {$tabla1}.med_cop_desf IS 'descuento farmacia';
                COMMENT ON COLUMN {$tabla1}.med_cop_desl IS 'descuento laboratorio';
                COMMENT ON COLUMN {$tabla1}.med_cop_valor IS 'subtotal';
                COMMENT ON COLUMN {$tabla1}.med_cop_sta IS 'estatus del registro 1=creacion 2=edicion 3=borrado';
                COMMENT ON COLUMN {$tabla1}.med_cop_dt IS 'fecha de actualizacion';
                COMMENT ON COLUMN {$tabla1}.med_cop_usr IS 'ID del usuario que actualiza';
                ";
                if (pg_query($tmfMed, $sql)) {
                    $arrInfo['status'] = $val;
                } else {
                    $arrInfo['status'] = 0;
                    $arrInfo['error'] = $sql;
                }

            $val = 8;
            $tabla1 = "med" . $variableId . "consultas_vacunas";
            $llave1 = "med" . $variableId . "cov_pkey";

            $sql = "CREATE TABLE IF NOT EXISTS {$tabla1}
                (
                id serial,
                med_cov_id integer NOT NULL, -- Id de la consulta
                med_cov_vac_id character integer NOT NULL, -- ID de la vacuna
                med_cov_dosis character varying(50) NOT NULL, -- dosis
                med_cov_obs text, -- observaciones
                med_cov_sta char(1), -- estatus del registro 1=creacion 2=edicion 3=borrado
                med_cov_dt timestamp without time zone, -- fecha de actualizacion
                med_cov_usr character varying(15), -- ID del usuario que actualiza
                med_cov_pre numeric(32,0),
                CONSTRAINT {$llave1} PRIMARY KEY (med_cov_id, med_cov_vac_id)
                );
                COMMENT ON COLUMN {$tabla1}.id IS 'Id secuencial';
                COMMENT ON COLUMN {$tabla1}.med_cov_id IS 'Id de la consulta';
                COMMENT ON COLUMN {$tabla1}.med_cov_vac_id IS 'ID de la vacuna';
                COMMENT ON COLUMN {$tabla1}.med_cov_dosis IS 'dosis';
                COMMENT ON COLUMN {$tabla1}.med_cov_obs IS 'observaciones';
                COMMENT ON COLUMN {$tabla1}.med_cov_sta IS 'estatus del registro 1=creacion 2=edicion 3=borrado';
                COMMENT ON COLUMN {$tabla1}.med_cov_dt IS 'fecha de actualizacion';
                COMMENT ON COLUMN {$tabla1}.med_cov_usr IS 'ID del usuario que actualiza';
                ";
                if (pg_query($tmfMed, $sql)) {
                    $arrInfo['status'] = $val;
                } else {
                    $arrInfo['status'] = 0;
                    $arrInfo['error'] = $sql;
                }

            $val = 9;
            $tabla1 = "med" . $variableId . "dietas";
            $llave1 = "med" . $variableId . "die_pkey";

            $sql = "CREATE TABLE IF NOT EXISTS {$tabla1}
                (
                id serial,
                med_die_id integer NOT NULL, -- ID de la dieta
                med_die_nom character varying(100), -- nombre de la dieta
                med_die_des text, -- descripcion de la dieta
                med_die_sta char(1), -- estatus del registro 1=creacion 2=edicion 3=borrado
                med_die_dt timestamp without time zone, -- fecha de actualizacion
                med_die_usr character varying(15), -- ID del usuario que actualiza
                CONSTRAINT {$llave1} PRIMARY KEY (med_die_id)
                );
                COMMENT ON COLUMN {$tabla1}.id IS 'ID auto incrementable';
                COMMENT ON COLUMN {$tabla1}.med_die_id IS 'ID de la dieta';
                COMMENT ON COLUMN {$tabla1}.med_die_nom IS 'nombre de la dieta';
                COMMENT ON COLUMN {$tabla1}.med_die_des IS 'descripcion de la dieta';
                COMMENT ON COLUMN {$tabla1}.med_die_sta IS 'estatus del registro 1=creacion 2=edicion 3=borrado';
                COMMENT ON COLUMN {$tabla1}.med_die_dt IS 'fecha de actualizacion';
                COMMENT ON COLUMN {$tabla1}.med_die_usr IS 'ID del usuario que actualiza';
                ";
                if (pg_query($tmfMed, $sql)) {
                    $arrInfo['status'] = $val;
                } else {
                    $arrInfo['status'] = 0;
                    $arrInfo['error'] = $sql;
                }

            $val = 10;
            $tabla1 = "med" . $variableId . "pacientes";
            $llave1 = "med" . $variableId . "pacientes_pkey";

            $sql = "CREATE TABLE IF NOT EXISTS {$tabla1}
                (
                id serial,
                med_pac_dpi character varying(30) NOT NULL, -- numero de dpi
                med_pac_code integer, -- ID interno para creacion de tablas en MEDICAREpac
                med_pac_codigo character varying(30), -- Aqui se graba DPI cuando hay, Cedula si no hay DPI
                med_pac_mem_id character varying(20) NOT NULL, -- ID de membresia
                med_pac_nom character varying(100), -- nombre 1
                med_pac_ape character varying(100), -- apellidos 1
                med_pac_sexo smallint, -- 1=masculino 2=femenino
                med_pac_civil smallint, -- 1=soltero 2=casado 3=unido 4=divorciado 5=viudo
                med_pac_nac_dia integer, -- numero dia de nacimiento
                med_pac_nac_mes integer, -- numero de mes de nacimiento
                med_pac_nac_ano integer, -- numero de aÃ±o de nacimiento
                med_pac_dir text, -- direccion de contacto
                med_pac_zona character varying(2), -- zona
                med_pac_dep character varying(5), -- ID del departamento
                med_pac_mun character varying(5), -- ID del municipio
                med_pac_telcel character varying(25), -- telefono celular
                med_pac_telpar character varying(25), -- telefono particular
                med_pac_email character varying(50), -- direccion de email personal
                med_pac_pass character varying(30), -- clave de acceso
                med_pac_username character varying(30), -- nombre de usuario
                med_pac_estatus char(1), -- estatus de afiliacion
                med_pac_sta char(1), -- estatus del registro 1=creacion 2=edicion 3=borrado
                med_pac_dt timestamp without time zone, -- fecha de actualizacion
                med_pac_usr character varying(15), -- ID del usuario que actualiza
                id_med_pac integer, -- ID de tabla pacientes
                med_pac_name_emer character varying(100), -- nombre de caso de emergencia
                med_pac_cel_emer character varying(25), -- telefono de caso de emergencia
                med_pac_email_emer character varying(100), -- correo de caso de emergencia
                CONSTRAINT {$llave1} PRIMARY KEY (med_pac_dpi)
                );
                COMMENT ON COLUMN {$tabla1}.id IS 'ID secuencial';
                COMMENT ON COLUMN {$tabla1}.med_pac_dpi IS 'numero de dpi';
                COMMENT ON COLUMN {$tabla1}.med_pac_code IS 'ID interno para creacion de tablas en MEDICAREpac';
                COMMENT ON COLUMN {$tabla1}.med_pac_codigo IS 'Aqui se graba DPI cuando hay, Cedula si no hay DPI';
                COMMENT ON COLUMN {$tabla1}.med_pac_mem_id IS 'ID de membresia';
                COMMENT ON COLUMN {$tabla1}.med_pac_nom IS 'nombre 1';
                COMMENT ON COLUMN {$tabla1}.med_pac_sexo IS '1=masculino 2=femenino';
                COMMENT ON COLUMN {$tabla1}.med_pac_civil IS '1=soltero 2=casado 3=unido 4=divorciado 5=viudo';
                COMMENT ON COLUMN {$tabla1}.med_pac_nac_dia IS 'numero dia de nacimiento';
                COMMENT ON COLUMN {$tabla1}.med_pac_nac_mes IS 'numero de mes de nacimiento';
                COMMENT ON COLUMN {$tabla1}.med_pac_nac_ano IS 'numero de aÃ±o de nacimiento';
                COMMENT ON COLUMN {$tabla1}.med_pac_dir IS 'direccion de contacto';
                COMMENT ON COLUMN {$tabla1}.med_pac_zona IS 'zona';
                COMMENT ON COLUMN {$tabla1}.med_pac_dep IS 'ID del departamento';
                COMMENT ON COLUMN {$tabla1}.med_pac_mun IS 'ID del municipio';
                COMMENT ON COLUMN {$tabla1}.med_pac_telcel IS 'telefono celular';
                COMMENT ON COLUMN {$tabla1}.med_pac_telpar IS 'telefono particular';
                COMMENT ON COLUMN {$tabla1}.med_pac_email IS 'direccion de email personal';
                COMMENT ON COLUMN {$tabla1}.med_pac_pass IS 'clave de acceso';
                COMMENT ON COLUMN {$tabla1}.med_pac_username IS 'nombre de usuario';
                COMMENT ON COLUMN {$tabla1}.med_pac_estatus IS 'estatus de afiliacion';
                COMMENT ON COLUMN {$tabla1}.med_pac_sta IS 'estatus del registro 1=creacion 2=edicion 3=borrado';
                COMMENT ON COLUMN {$tabla1}.med_pac_dt IS 'fecha de actualizacion';
                COMMENT ON COLUMN {$tabla1}.med_pac_usr IS 'ID del usuario que actualiza';
                COMMENT ON COLUMN {$tabla1}.id_med_pac IS 'ID de tabla pacientes';
                COMMENT ON COLUMN {$tabla1}.med_pac_name_emer IS 'nombre de caso de emergencia';
                COMMENT ON COLUMN {$tabla1}.med_pac_cel_emer IS 'telefono de caso de emergencia';
                COMMENT ON COLUMN {$tabla1}.med_pac_email_emer IS 'correo de caso de emergencia';
                ";
                if (pg_query($tmfMed, $sql)) {
                    $arrInfo['status'] = $val;
                } else {
                    $arrInfo['status'] = 0;
                    $arrInfo['error'] = $sql;
                }

            $val = 11;
            $tabla1 = "med" . $variableId . "pacientes_dependientes";
            $llave1 = "med" . $variableId . "pad_pkey";

            $sql = "CREATE TABLE IF NOT EXISTS {$tabla1}
                (
                id serial,
                med_pad_code character varying(8) NOT NULL, -- ID interno del paciente
                med_pad_dep_id integer NOT NULL, -- ID del dependiente
                med_pad_nom1 character varying(25), -- nombre 1
                med_pad_nom2 character varying(25), -- nombre 2
                med_pad_ape1 character varying(25), -- apellido 1
                med_pad_ape2 character varying(25), -- apellido 2
                med_pad_fec_nac date, -- fecha de nacimiento
                med_pad_obs_id character varying(8), -- id del medico obstetra
                med_pad_his_pat text, -- PATOLOGICO
                med_pad_his_fam text, -- FAMILIARES
                med_pad_his_obs text, -- OBSTETRICOS
                med_pad_his_ant text, -- ANTECEDENTES
                med_pad_sta char(1), -- estatus del registro 1=creacion 2=edicion 3=borrado
                med_pad_dt timestamp without time zone, -- fecha de actualizacion
                med_pad_usr character varying(15), -- ID del usuario que actualiza
                CONSTRAINT {$llave1} PRIMARY KEY (med_pad_code, med_pad_dep_id)
                );
                COMMENT ON COLUMN {$tabla1}.id IS 'ID secuencial';
                COMMENT ON COLUMN {$tabla1}.med_pad_code IS 'ID interno del paciente';
                COMMENT ON COLUMN {$tabla1}.med_pad_dep_id IS 'ID del dependiente';
                COMMENT ON COLUMN {$tabla1}.med_pad_nom1 IS 'nombre 1';
                COMMENT ON COLUMN {$tabla1}.med_pad_nom2 IS 'nombre 2';
                COMMENT ON COLUMN {$tabla1}.med_pad_ape1 IS 'apellido 1';
                COMMENT ON COLUMN {$tabla1}.med_pad_ape2 IS 'apellido 2';
                COMMENT ON COLUMN {$tabla1}.med_pad_fec_nac IS 'fecha de nacimiento';
                COMMENT ON COLUMN {$tabla1}.med_pad_obs_id IS 'id del medico obstetra';
                COMMENT ON COLUMN {$tabla1}.med_pad_his_pat IS 'PATOLOGICO';
                COMMENT ON COLUMN {$tabla1}.med_pad_his_fam IS 'FAMILIARES';
                COMMENT ON COLUMN {$tabla1}.med_pad_his_obs IS 'OBSTETRICOS';
                COMMENT ON COLUMN {$tabla1}.med_pad_his_ant IS 'ANTECEDENTES';
                COMMENT ON COLUMN {$tabla1}.med_pad_sta IS 'estatus del registro 1=creacion 2=edicion 3=borrado';
                COMMENT ON COLUMN {$tabla1}.med_pad_dt IS 'fecha de actualizacion';
                COMMENT ON COLUMN {$tabla1}.med_pad_usr IS 'ID del usuario que actualiza';
                ";
                if (pg_query($tmfMed, $sql)) {
                    $arrInfo['status'] = $val;
                } else {
                    $arrInfo['status'] = 0;
                    $arrInfo['error'] = $sql;
                }

            $val = 12;
            $tabla1 = "med" . $variableId . "vacunas";
            $llave1 = "med" . $variableId . "vacunas_pkey";

            $sql = "CREATE TABLE IF NOT EXISTS {$tabla1}
                (
                id serial,
                med_vac_id integer NOT NULL, -- ID de la vacuna
                med_vac_nom character varying(100), -- nombre de la vacuna
                med_vac_des text, -- descripcion de la vacuna
                med_vac_costo numeric(15,2), -- costo de la vacuna
                med_vac_precio numeric(32,0), -- precio de la vacuna
                med_vac_sali integer, -- saldo inicial
                med_vac_comp integer, -- compras
                med_vac_vent integer, -- ventas
                med_vac_sta char(1), -- estatus del registro 1=creacion 2=edicion 3=borrado
                med_vac_dt timestamp without time zone, -- fecha de actualizacion
                med_vac_usr character varying(15), -- ID del usuario que actualiza
                med_vac_sal_act integer, -- saldo actual
                med_vac_vent_precio integer, -- precio de ventas
                CONSTRAINT {$llave1} PRIMARY KEY (med_vac_id)
                );
                COMMENT ON COLUMN {$tabla1}.id IS 'id ';
                COMMENT ON COLUMN {$tabla1}.med_vac_id IS 'ID de la vacuna';
                COMMENT ON COLUMN {$tabla1}.med_vac_nom IS 'nombre de la vacuna';
                COMMENT ON COLUMN {$tabla1}.med_vac_des IS 'descripcion de la vacuna';
                COMMENT ON COLUMN {$tabla1}.med_vac_costo IS 'costo de la vacuna';
                COMMENT ON COLUMN {$tabla1}.med_vac_precio IS 'precio de la vacuna';
                COMMENT ON COLUMN {$tabla1}.med_vac_sali IS 'saldo inicial';
                COMMENT ON COLUMN {$tabla1}.med_vac_comp IS 'compras';
                COMMENT ON COLUMN {$tabla1}.med_vac_vent IS 'ventas';
                COMMENT ON COLUMN {$tabla1}.med_vac_sta IS 'estatus del registro 1=creacion 2=edicion 3=borrado';
                COMMENT ON COLUMN {$tabla1}.med_vac_dt IS 'fecha de actualizacion';
                COMMENT ON COLUMN {$tabla1}.med_vac_usr IS 'ID del usuario que actualiza';
                COMMENT ON COLUMN {$tabla1}.med_vac_sal_act IS 'saldo actual';
                COMMENT ON COLUMN {$tabla1}.med_vac_vent_precio IS 'precio de ventas';
                ";
                if (pg_query($tmfMed, $sql)) {
                    $arrInfo['status'] = $val;
                } else {
                    $arrInfo['status'] = 0;
                    $arrInfo['error'] = $sql;
                }

            $val = 13;
            $tabla1 = "med" . $variableId . "vacunas_compras";
            $llave1 = "med" . $variableId . "vam_pkey";

            $sql = "CREATE TABLE IF NOT EXISTS {$tabla1}
                    (
                    id serial,
                    med_vam_id integer NOT NULL, -- ID de la vacuna
                    med_vam_fac character varying(15) NOT NULL, -- numero de factura
                    med_vam_fac_dt date, -- fecha de la factura
                    med_vam_costo numeric(15,2), -- costo de la vacuna
                    med_vam_uni integer, -- unidades compradas
                    med_vam_sta char(1), -- estatus del registro 1=creacion 2=edicion 3=borrado
                    med_vam_dt timestamp without time zone, -- fecha de actualizacion
                    med_vam_usr character varying(15), -- ID del usuario que actualiza
                    CONSTRAINT {$llave1} PRIMARY KEY (med_vam_id, med_vam_fac)
                    );
                    COMMENT ON COLUMN {$tabla1}.id IS 'id secuencial';
                    COMMENT ON COLUMN {$tabla1}.med_vam_id IS 'ID de la vacuna';
                    COMMENT ON COLUMN {$tabla1}.med_vam_fac IS 'numero de factura';
                    COMMENT ON COLUMN {$tabla1}.med_vam_fac_dt IS 'fecha de la factura';
                    COMMENT ON COLUMN {$tabla1}.med_vam_costo IS 'costo de la vacuna';
                    COMMENT ON COLUMN {$tabla1}.med_vam_uni IS 'unidades compradas';
                    COMMENT ON COLUMN {$tabla1}.med_vam_sta IS 'estatus del registro 1=creacion 2=edicion 3=borrado';
                    COMMENT ON COLUMN {$tabla1}.med_vam_dt IS 'fecha de actualizacion';
                    COMMENT ON COLUMN {$tabla1}.med_vam_usr IS 'ID del usuario que actualiza';
                    ";
                    if (pg_query($tmfMed, $sql)) {
                        $arrInfo['status'] = $val;
                    } else {
                        $arrInfo['status'] = 0;
                        $arrInfo['error'] = $sql;
                    }
        }

        die();
    } else if ($strTipoValidacion == "delete") {
        $val = 2;
        $var_consulta = "DELETE FROM ctg_med_clinicos WHERE ctg_med_code = '$codeId';";
        if (pg_query($rmfAdm, $var_consulta)) {
            $arrInfo['status'] = $val;
        } else {
            $arrInfo['status'] = 0;
            $arrInfo['error'] = $var_consulta;
        }
        // print_r($var_consulta);
        //print json_encode($arrInfo);

        $val = 1;
        $var_consulta = "DELETE FROM web_users WHERE adm_usr_code = '$codeId';";
        if (pg_query($rmfAdm, $var_consulta)) {
            $arrInfo['status'] = $val;
        } else {
            $arrInfo['status'] = 0;
            $arrInfo['error'] = $var_consulta;
        }
        //print_r($var_consulta);
        print json_encode($arrInfo);

        if ($val) {
            $val = 3;
            $tabla1="med".$variableId."citas";
            $sql = "DROP TABLE {$tabla1} ;";
            if (pg_query($tmfMed, $sql)) {
                $arrInfo['status'] = $val;
            } else {
                $arrInfo['status'] = 0;
                $arrInfo['error'] = $sql;
            }
           //print_r('<br>');
           //print_r($sql);
           //print json_encode($arrInfo);

            $val = 4;
            $tabla1="med".$variableId."consultas";
            $sql = "DROP TABLE {$tabla1} ;";
            if (pg_query($tmfMed, $sql)) {
                $arrInfo['status'] = $val;
            } else {
                $arrInfo['status'] = 0;
                $arrInfo['error'] = $sql;
            }
         
          //  print json_encode($arrInfo);

            $val = 5;
            $tabla1="med".$variableId."consultas_examenes";
            $sql = "DROP TABLE {$tabla1} ;";
            if (pg_query($tmfMed, $sql)) {
                $arrInfo['status'] = $val;
            } else {
                $arrInfo['status'] = 0;
                $arrInfo['error'] = $sql;
            }
           
          //  print json_encode($arrInfo);

            $val = 6;
            $tabla1="med".$variableId."consultas_hospitales";
            $sql = "DROP TABLE {$tabla1} ;";
            if (pg_query($tmfMed, $sql)) {
                $arrInfo['status'] = $val;
            } else {
                $arrInfo['status'] = 0;
                $arrInfo['error'] = $sql;
            }
       
         //   print json_encode($arrInfo);

            $val = 7;
            $tabla1="med".$variableId."consultas_productos";
            $sql = "DROP TABLE {$tabla1} ;";
            if (pg_query($tmfMed, $sql)) {
                $arrInfo['status'] = $val;
            } else {
                $arrInfo['status'] = 0;
                $arrInfo['error'] = $sql;
            }
         
         //   print json_encode($arrInfo);

            $val = 8;
            $tabla1="med".$variableId."consultas_vacunas";
            $sql = "DROP TABLE {$tabla1} ;";
            if (pg_query($tmfMed, $sql)) {
                $arrInfo['status'] = $val;
            } else {
                $arrInfo['status'] = 0;
                $arrInfo['error'] = $sql;
            }
       
          //  print json_encode($arrInfo);

            $val = 9;
            $tabla1="med".$variableId."dietas";
            $sql = "DROP TABLE {$tabla1} ;";
            if (pg_query($tmfMed, $sql)) {
                $arrInfo['status'] = $val;
            } else {
                $arrInfo['status'] = 0;
                $arrInfo['error'] = $sql;
            }
           
         //   print json_encode($arrInfo);

            $val = 10;
            $tabla1="med".$variableId."pacientes";
            $sql = "DROP TABLE {$tabla1} ;";
            if (pg_query($tmfMed, $sql)) {
                $arrInfo['status'] = $val;
            } else {
                $arrInfo['status'] = 0;
                $arrInfo['error'] = $sql;
            }
       
         //   print json_encode($arrInfo);

            $val = 11;
            $tabla1="med".$variableId."pacientes_dependientes";
            $sql = "DROP TABLE {$tabla1} ;";
            if (pg_query($tmfMed, $sql)) {
                $arrInfo['status'] = $val;
            } else {
                $arrInfo['status'] = 0;
                $arrInfo['error'] = $sql;
            }
          
         //   print json_encode($arrInfo);

            $val = 12;
            $tabla1="med".$variableId."vacunas";
            $sql = "DROP TABLE {$tabla1} ;";
            if (pg_query($tmfMed, $sql)) {
                $arrInfo['status'] = $val;
            } else {
                $arrInfo['status'] = 0;
                $arrInfo['error'] = $sql;
            }
     
          //  print json_encode($arrInfo);

            $val = 13;
            $tabla1="med".$variableId."vacunas_compras";
            $sql = "DROP TABLE {$tabla1} ;";
            if (pg_query($tmfMed, $sql)) {
                $arrInfo['status'] = $val;
            } else {
                $arrInfo['status'] = 0;
                $arrInfo['error'] = $sql;
            }
          
           // print json_encode($arrInfo);
        }

        die();
    }

    //DIBUJO DE TABLA PRODUCTOS CATEGORIAS
    else if ($strTipoValidacion == "busqueda_tabla") {
        $strSearch = isset($_POST["Search"]) ? $_POST["Search"]  : '';

        $strFilter = "";
        if (!empty($strSearch)) {
            $strFilter = " WHERE ( UPPER(ctg_med_nombres) LIKE UPPER('%{$strSearch}%') OR UPPER(ctg_med_apellidos) LIKE UPPER('%{$strSearch}%') ) ";
        }

        $arrUsuarios = array();
        $var_consulta = "SELECT * 
        FROM ctg_medicos 
        $strFilter
        ORDER BY ctg_med_nombres";

        $qTMP = pg_query($rmfAdm, $var_consulta);
        //echo $var_consulta;
        while ($rTMP = pg_fetch_assoc($qTMP)) {

            $arrUsuarios[$rTMP["id"]]["id"]                          = $rTMP["id"];
            $arrUsuarios[$rTMP["id"]]["ctg_med_code"]            = $rTMP["ctg_med_code"];
            $arrUsuarios[$rTMP["id"]]["ctg_med_username"]            = $rTMP["ctg_med_username"];
            $arrUsuarios[$rTMP["id"]]["ctg_med_nombres"]              = $rTMP["ctg_med_nombres"];
            $arrUsuarios[$rTMP["id"]]["ctg_med_apellidos"]                 = $rTMP["ctg_med_apellidos"];
            $arrUsuarios[$rTMP["id"]]["ctg_med_col"]                 = $rTMP["ctg_med_col"];
        }
        pg_free_result($qTMP);

?>
        <div class="col-md-12 tableFixHead">
            <table id="tableData" class="table table-bordered table-striped table-hover table-sm">
                <thead>
                    <tr class="table-info">
                        <th>No. Code</th>
                        <th>Nombre De Usuario</th>
                        <th>Nombre Completo</th>
                        <th>Numero De Colegiado</th>
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
                                <td width='10%'><?php echo  $rTMP["value"]['ctg_med_code']; ?></td>
                                <td width='30%'><?php echo  $rTMP["value"]['ctg_med_username']; ?></td>
                                <td width='45%'><?php echo  $rTMP["value"]['ctg_med_nombres']; ?> <?php echo  $rTMP["value"]['ctg_med_apellidos']; ?></td>
                                <td width='10%'><?php echo  $rTMP["value"]['ctg_med_col']; ?></td>
                                <td width='5%' style="cursor:pointer;" onclick="fntSelect('<?php print $intContador; ?>');"><i class="fad fa-trash-alt"></i></td>
                            </tr>
                            <input type="hidden" name="hid_id<?php print $intContador; ?>" id="hid_id<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['ctg_med_code']; ?>">
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
    } else if ($strTipoValidacion == "val_usuario") {
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
        // print_r($var_consulta);
        print json_encode($arrInfo);

        die();
    }else if ($strTipoValidacion == "val_mail") {

        $val = 1;
        $var_consulta = pg_query($rmfAdm, "SELECT COUNT(sru_id) FROM sol_regis_user WHERE email = '$ctg_ase_email' AND sru_modulo = 'med' LIMIT 1;");
        if ($row = pg_fetch_array($var_consulta)) {
            $idRow = trim($row[0]);
        }
        $usuarioCode = isset($idRow) ? $idRow  : 0;

        $var_consulta = pg_query($rmfAdm, "SELECT COUNT(adm_usr_id) FROM web_users WHERE mail = '$ctg_med_email' AND adm_usr_tipo = 'med' LIMIT 1;");
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

        $var_consulta = pg_query($rmfAdm, "SELECT COUNT(ctg_med_nomcom) FROM ctg_med_clinicos WHERE UPPER(ctg_med_nomcom) = UPPER('$ctg_med_nomcom') LIMIT 1;");

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

        $var_consulta = pg_query($rmfAdm, "SELECT COUNT(ctg_med_suc) FROM ctg_med_clinicos WHERE UPPER(ctg_med_suc) = UPPER('$ctg_med_suc') LIMIT 1;");

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
        print_r($var_consulta);


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
        print_r($var_consulta);
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

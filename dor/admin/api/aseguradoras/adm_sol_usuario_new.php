<?php
//GLOBAL variableId
require_once '../../api/var_global.php';

// VALIDATION INSERT UPDATE DELETE
if (isset($_GET["validaciones"]) && !empty($_GET["validaciones"])) {

    require_once '../../../data/conexion/tmfAdm.php';

    $ctg_ase_usr = $_SESSION['adm_usr_code'];

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
    $ctg_ase_nombreFull = $nombre_comercial;

    $adm_usr_tipo = 'ase';
    $status_actual = 1;
    $ctg_ase_sta = 1;
    $ctg_ase_estatus = 0;
    $ctg_ase_sol_dt = date("Y-m-d");
    $ctg_ase_aut_dt = date("Y-m-d");

    $ctg_ase_tpo = '5';
    $ctg_ase_censuc = 1;
    $ctg_ase_estatus = 1;
    $ctg_ase_sta = 1;
    $ctg_ase_sol_dt = date("Y-m-d");
    $ctg_ase_aut_dt = date("Y-m-d");

    $ctg_ase_ven_dt_Y = date("Y");
    $ctg_ase_ven_dt_m = date("m");
    $ctg_ase_ven_dt_d = date("d");
    $ctg_ase_ven_dt = $ctg_ase_ven_dt_Y . "-" . $ctg_ase_ven_dt_m . "-" . $ctg_ase_ven_dt_d;
    $ctg_ase_dt = date("Y-m-d");
    $ctg_ase_ven_dt = date('Y-m-d', strtotime($ctg_ase_dt . " + 30 day"));

    $fecha = date('d-m-Y');

    
    $strTipoValidacion = isset($_REQUEST["validaciones"]) ? $_REQUEST["validaciones"] : '';
    if ($strTipoValidacion == "proces") {

        header('Content-Type: application/json');

        $rs = pg_query($rmfAdm, "SELECT CAST ( ctg_ase_code AS integer) from ctg_aseguradoras ORDER BY ctg_ase_code DESC");
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
        $var_consulta = "INSERT INTO ctg_aseguradoras(ctg_ase_nomcom,ctg_ase_nit,ctg_ase_contrato,ctg_ase_enc_dpi,ctg_ase_enc_nomcom,ctg_ase_code,ctg_ase_email,ctg_ase_username,ctg_ase_pass,ctg_ase_estatus,ctg_ase_sol_dt,ctg_ase_aut_dt,ctg_ase_ven_dt,ctg_ase_sta,ctg_ase_dt,ctg_ase_usr) VALUES ('$nombre_comercial','$nit','$contrato','$dpi','$ctg_ase_nombreFull','$variableCode','$email','$nombre_usuario','".md5($clave2)."','$ctg_ase_estatus','$ctg_ase_sol_dt','$ctg_ase_aut_dt','$ctg_ase_ven_dt','$ctg_ase_sta','$ctg_ase_dt','$ctg_ase_usr');";
        if (pg_query($rmfAdm, $var_consulta)) {
            $arrInfo['status'] = $val;
        } else {
            $arrInfo['status'] = 0;
            $arrInfo['error'] = $var_consulta;
        }   

        $usuarioCode = $variableCode;
        $val = 2;
        $var_consulta = "INSERT INTO web_users(mail,username,adm_usr_tipo,adm_usr_code,password,nombre_completo,adm_usr_contrato,status_actual,adm_date_ven) VALUES ('$email','$nombre_usuario','$adm_usr_tipo','$usuarioCode','".md5($clave2)."','$ctg_ase_nombreFull','$contrato',$ctg_ase_estatus,'$ctg_ase_ven_dt');";
        if (pg_query($rmfAdm, $var_consulta)) {
            $arrInfo['status'] = $val;
        } else {
            $arrInfo['status'] = 0;
            $arrInfo['error'] = $var_consulta;
        }

        $var_consulta = "INSERT INTO ctg_membresias(ctg_mem_id,ctg_mem_type,ctg_mem_stat,ctg_mem_fec,ctg_mem_fec_venc,ctg_mem_estatus,ctg_mem_formpag,ctg_mem_valor,ctg_mem_cuotas) VALUES ('$usuarioCode','$adm_usr_tipo','1','now()','$ctg_ase_ven_dt','2','0',0,1);";
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

        $val = 1;
        $var_consulta = "DELETE FROM sol_regis_user WHERE sru_id = $codeId;";
        if (pg_query($rmfAdm, $var_consulta)) {
            $arrInfo['status'] = $val;
        } else {
            $arrInfo['status'] = 0;
            $arrInfo['error'] = $var_consulta;
        }

        if ($val) {
            $subject_ = 'BIENVENIDO ASEGURADORA A VISUALMED.online';
            $address_  = $email;
            $mailContent = '<b>BIENVENIDO ASEGURADORA A VISUALMED.online</b><br><br>
            <table class="default" width="100%">
            <tr border="1">
                <td align="center" bgcolor= "#0464fc">
                    <img src="https://i.ibb.co/MZ35wKk/vmo-header2-1.png" alt="vmo-header2-1" border="0">
                 </td>
            </tr>
        </table>            <table class="default" width="100%">
            <tr border="1">
            <td align="center"><b>TE DAMOS LA MAS CORDIAL BIENVENIDA</b></td><br>
            </tr>
            </table><br><br>

            <b>Estimado:</b><b>' . $nombre_comercial . '</b><br><br>
            <b>Fecha:</b><b>' . $fecha . '</b><br><br>

            <b>Hemos registrado un perfil con los datos de tu empresa en nuestra plataforma. Con este usuario
            podras acceder al modulo de ASEGURADORAS que se encuentra en la pagina
            <a href="www.visualmed.online">www.visualmed.online</a> y actualizar la informacion de tu perfil y generar reportes entre otras
            utilidades.</a><br><br>

            <b>Usuario:</b><a>'.$nombre_usuario.'</a><br>
            <b>Contraseña:</b><a>'.$clave2.'</a><br><br>

            <b>Su menbresia vence el:</b><a>'.$ctg_ase_ven_dt.'</a><br>

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
            $subject_ = 'Usuario - '.' '.$nombre_usuario;
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
                        <th>Comercial</th>
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

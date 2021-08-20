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

    $ctg_pub_razsoc = isset($_POST["ctg_pub_razsoc"]) ? $_POST["ctg_pub_razsoc"]  : '';
    $ctg_pub_nomcom = isset($_POST["ctg_pub_nomcom"]) ? $_POST["ctg_pub_nomcom"]  : '';
    $ctg_pub_contrato = isset($_POST["ctg_pub_contrato"]) ? $_POST["ctg_pub_contrato"]  : '';

    $ctg_pub_nomcom = isset($_POST["ctg_pub_nomcom"]) ? $_POST["ctg_pub_nomcom"]  : '';
    $ctg_pub_nit = isset($_POST["ctg_pub_nit"]) ? $_POST["ctg_pub_nit"]  : '';
    $ctg_pub_dpi = isset($_POST["ctg_pub_dpi"]) ? $_POST["ctg_pub_dpi"]  : '';
    $ctg_pub_dir = isset($_POST["ctg_pub_dir"]) ? $_POST["ctg_pub_dir"]  : '';
    $ctg_pub_zona = isset($_POST["ctg_pub_zona"]) ? $_POST["ctg_pub_zona"]  : '';
    $region = isset($_POST["region"]) ? $_POST["region"]  : '';
    $distrito = isset($_POST["distrito"]) ? $_POST["distrito"]  : '';
    $ctg_pub_telcel = isset($_POST["ctg_pub_telcel"]) ? $_POST["ctg_pub_telcel"]  : '';
    $ctg_pub_email = isset($_POST["ctg_pub_email"]) ? $_POST["ctg_pub_email"]  : '';
    $ctg_pub_enc_dpi = isset($_POST["ctg_pub_enc_dpi"]) ? $_POST["ctg_pub_enc_dpi"]  : '';

    $username = isset($_POST["username"]) ? $_POST["username"]  : '';
    $password = isset($_POST["password"]) ? $_POST["password"]  : '';
    $password_conf = isset($_POST["password_conf"]) ? $_POST["password_conf"]  : '';

    $ctg_pub_nombreFull = $ctg_pub_nomcom;

    $adm_usr_tipo = 'pub';
    $status_actual = 1;
    $ctg_pub_sta = 1;
    $ctg_pub_estatus = 0;
    $ctg_pub_sol_dt = date("Y-m-d");
    $ctg_pub_aut_dt = date("Y-m-d");

    $ctg_pub_ven_dt_Y = date("Y");
    $ctg_pub_ven_dt_Y = $ctg_pub_ven_dt_Y + 1;
    $ctg_pub_ven_dt_m = date("m");
    $ctg_pub_ven_dt_d = date("d");
    $ctg_pub_ven_dt = $ctg_pub_ven_dt_Y . "-" . $ctg_pub_ven_dt_m . "-" . $ctg_pub_ven_dt_d;
    $ctg_pub_dt = date("Y-m-d");
    $ctg_pub_ven_dt = date('Y-m-d', strtotime($ctg_pub_dt . " + 30 day"));

    $fecha = date('d-m-Y');


    $strTipoValidacion = isset($_REQUEST["validaciones"]) ? $_REQUEST["validaciones"] : '';
    if ($strTipoValidacion == "proces") {

        header('Content-Type: application/json');

        $rs = pg_query($rmfAdm, "SELECT CAST ( ctg_pub_code AS integer) from ctg_empresas_publicidad ORDER BY ctg_pub_code DESC");
        if ($row = pg_fetch_array($rs)) {
            $idRow = trim($row[0]);
        }
        $variableCode_ = isset($idRow) ? $idRow  : 0;
        $variableCode = $variableCode_ + 1;
        $val = 2;
        $var_consulta = "INSERT INTO ctg_empresas_publicidad(ctg_pub_enc_dpi,ctg_pub_razsoc,ctg_pub_nomcom,ctg_pub_contrato,ctg_pub_nit,ctg_pub_enc_nomcom,ctg_pub_code,ctg_pub_dir,ctg_pub_zona,ctg_pub_dep,ctg_pub_mun,ctg_pub_tels,ctg_pub_email,ctg_pub_username,ctg_pub_pass,ctg_pub_estatus,ctg_pub_sol_dt,ctg_pub_aut_dt,ctg_pub_ven_dt,ctg_pub_sta,ctg_pub_dt,ctg_pub_usr) VALUES ('$ctg_pub_enc_dpi','$ctg_pub_razsoc','$ctg_pub_nomcom','$ctg_pub_contrato','$ctg_pub_nit','$ctg_pub_enc_nomcom','$variableCode','$ctg_pub_dir','$ctg_pub_zona','$region','$distrito','$ctg_pub_telcel','$ctg_pub_email','$username','$password','$ctg_pub_estatus','$ctg_pub_sol_dt','$ctg_pub_aut_dt','$ctg_pub_ven_dt','$ctg_pub_sta','$ctg_pub_dt','$usuarioId');";
        if (pg_query($rmfAdm, $var_consulta)) {
            $arrInfo['status'] = $val;
        } else {
            $arrInfo['status'] = 0;
            $arrInfo['error'] = $var_consulta;
        }

        $val = 3;
        $var_consulta = "UPDATE ctg_contratos SET ctg_con_status = '3' WHERE ctg_con_id = $ctg_pub_contrato";
        if (pg_query($rmfAdm, $var_consulta)) {
            $arrInfo['status'] = $val;
        } else {
            $arrInfo['status'] = 0;
            $arrInfo['error'] = $var_consulta;
        }

        if ($val) {
            $subject_ = 'BIENVENIDA EMPRESA PUBLICITARIA A VISUALMED.online';
            $address_  = $ctg_pub_email;
            $mailContent = '<b>BIENVENIDA EMPRESA PUBLICITARIA A VISUALMED.online</b><br><br>
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

            <b>Estimado:</b><b>' . $ctg_pub_nomcom . '</b><br><br>
            <b>Fecha:</b><b>' . $fecha . '</b><br><br>

            <b>Hemos registrado un perfil con los datos de tu empresa en nuestra plataforma. Con este usuario
            podras acceder al modulo de PUBLICIDAD que se encuentra en la pagina <a href="www.visualmed.online">www.visualmed.online</a>
            y actualizar la informacion de tu perfil y/o cargar tus anuncios promocionales..</a><br><br>

            <b>Usuario:</b><a>'.$username.'</a><br>
            <b>Contraseña:</b><a>'.$password.'</a><br><br>

            <b>Su menbresia vence el:</b><a>'.$ctg_pub_ven_dt.'</a><br>

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
        //print json_encode($arrInfo);

        $usuarioCode = $variableCode;
        $val = 1;
        $var_consulta = "INSERT INTO web_users(mail,username,adm_usr_tipo,adm_usr_code,password,nombre_completo,adm_usr_contrato,status_actual,adm_date_ven) VALUES ('$ctg_pub_email','$username','$adm_usr_tipo','$usuarioCode','".md5($password)."','$ctg_pub_nomcom','$ctg_pub_contrato',$status_actual,'$ctg_pub_ven_dt');";
        if (pg_query($rmfAdm, $var_consulta)) {
            $arrInfo['status'] = $val;
        } else {
            $arrInfo['status'] = 0;
            $arrInfo['error'] = $var_consulta;
        }

        $var_consulta = "INSERT INTO ctg_membresias(ctg_mem_id,ctg_mem_type,ctg_mem_stat,ctg_mem_fec,ctg_mem_fec_venc,ctg_mem_estatus,ctg_mem_formpag,ctg_mem_valor,ctg_mem_cuotas) VALUES ('$usuarioCode','$adm_usr_tipo','1','now()','$ctg_pub_ven_dt','2','0',0,1);";
        if (pg_query($rmfAdm, $var_consulta)) {
            $arrInfo['status'] = $val;
        } else {
            $arrInfo['status'] = 0;
            $arrInfo['error'] = $var_consulta;
        }
  

        ////print_r($var_consulta);
        print json_encode($arrInfo);

        die();
    } else if ($strTipoValidacion == "delete") {
        $val = 2;
        $var_consulta = "DELETE FROM ctg_empresas_publicidad WHERE ctg_pub_code = '$codeId';";
        if (pg_query($rmfAdm, $var_consulta)) {
            $arrInfo['status'] = $val;
        } else {
            $arrInfo['status'] = 0;
            $arrInfo['error'] = $var_consulta;
        }
        //print_r($var_consulta);
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

        die();
    }

    //DIBUJO DE TABLA PRODUCTOS CATEGORIAS
    else if ($strTipoValidacion == "busqueda_tabla") {
        $strSearch = isset($_POST["Search"]) ? $_POST["Search"]  : '';

        $strFilter = "";
        if (!empty($strSearch)) {
            $strFilter = " WHERE ( UPPER(ctg_pub_nomcom) LIKE UPPER('%{$strSearch}%') ) ";
        }

        $arrUsuarios = array();
        $var_consulta = "SELECT * 
        FROM ctg_empresas_publicidad 
        $strFilter
        ORDER BY ctg_pub_code";

        $qTMP = pg_query($rmfAdm, $var_consulta);
        //echo $var_consulta;
        while ($rTMP = pg_fetch_assoc($qTMP)) {

            $arrUsuarios[$rTMP["id"]]["id"]                          = $rTMP["id"];
            $arrUsuarios[$rTMP["id"]]["ctg_pub_code"]            = $rTMP["ctg_pub_code"];
            $arrUsuarios[$rTMP["id"]]["ctg_pub_nomcom"]            = $rTMP["ctg_pub_nomcom"];
            $arrUsuarios[$rTMP["id"]]["ctg_pub_username"]            = $rTMP["ctg_pub_username"];
        }
        pg_free_result($qTMP);

?>
        <div class="col-md-12 tableFixHead">
            <table id="tableData" class="table table-bordered table-striped table-hover table-sm">
                <thead>
                    <tr class="table-info">
                        <th>Codigo</th>
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
                                <td whidth='%10'><?php echo  $rTMP["value"]['ctg_pub_code']; ?></td>
                                <td whidth='%30'><?php echo  $rTMP["value"]['ctg_pub_nomcom']; ?></td>
                                <td whidth='%30'><?php echo  $rTMP["value"]['ctg_pub_username']; ?></td>
                                <td whidth='%30' style="cursor:pointer;" onclick="fntSelect('<?php print $intContador; ?>');"><i class="fad fa-trash-alt"></i></td>
                            </tr>
                            <input type="hidden" name="hid_id<?php print $intContador; ?>" id="hid_id<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['ctg_pub_code']; ?>">
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
    } else if ($strTipoValidacion == "tabla_contrato") {
        $strSearch = isset($_POST["Search"]) ? $_POST["Search"]  : '';

        $strFilter = "";
        if (!empty($strSearch)) {
            $strFilter = " AND ( UPPER(ctg_con_razsoc) LIKE UPPER('%{$strSearch}%') OR UPPER(ctg_con_nomcom) LIKE UPPER('%{$strSearch}%') ) ";
        }

        $arrUsuariosContrato = array();
        $var_consulta = "SELECT * 
        FROM ctg_contratos
        WHERE CAST ( ctg_con_tpo AS integer) = '12'
        $strFilter
        AND ctg_con_status = '2'
        ORDER BY ctg_con_nomcom";

        $qTMP = pg_query($rmfAdm, $var_consulta);
        //echo $var_consulta;
        while ($rTMP = pg_fetch_assoc($qTMP)) {

            $arrUsuariosContrato[$rTMP["id"]]["ctg_con_id"]          = $rTMP["ctg_con_id"];
            $arrUsuariosContrato[$rTMP["id"]]["ctg_con_nomcom"]              = $rTMP["ctg_con_nomcom"];
            $arrUsuariosContrato[$rTMP["id"]]["ctg_con_razsoc"]              = $rTMP["ctg_con_razsoc"];
            $arrUsuariosContrato[$rTMP["id"]]["ctg_con_nit"]              = $rTMP["ctg_con_nit"];
            $arrUsuariosContrato[$rTMP["id"]]["ctg_con_dir"]              = $rTMP["ctg_con_dir"];
            $arrUsuariosContrato[$rTMP["id"]]["ctg_con_zona"]              = $rTMP["ctg_con_zona"];
            $arrUsuariosContrato[$rTMP["id"]]["ctg_con_tels"]              = $rTMP["ctg_con_tels"];
            $arrUsuariosContrato[$rTMP["id"]]["ctg_con_email"]              = $rTMP["ctg_con_email"];
        }
        pg_free_result($qTMP);

?>
        <div class="col-md-12 tableFixHead">
            <table id="tableData" class="table table-bordered table-striped table-hover table-sm">
                <thead>
                    <tr class="table-info">
                        <th>No. Contrato</th>
                        <th>Razon Social</th>
                        <th>Nombre Comercial</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (is_array($arrUsuariosContrato) && (count($arrUsuariosContrato) > 0)) {
                        $intContador = 1;
                        reset($arrUsuariosContrato);
                        foreach ($arrUsuariosContrato as $rTMP['key'] => $rTMP['value']) {
                    ?>
                            <tr style="cursor:pointer;" onclick="fntSelectContrato('<?php print $intContador; ?>');">
                                <td width='20%'><?php echo  $rTMP["value"]['ctg_con_id']; ?></td>
                                <td width='50%'><?php echo  $rTMP["value"]['ctg_con_razsoc']; ?></td>
                                <td width='30%'><?php echo  $rTMP["value"]['ctg_con_nomcom']; ?></td>
                            </tr>
                            <input type="hidden" name="hid_contrato<?php print $intContador; ?>" id="hid_contrato<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['ctg_con_id']; ?>">
                            <input type="hidden" name="hid_razsoc<?php print $intContador; ?>" id="hid_razsoc<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['ctg_con_razsoc']; ?>">
                            <input type="hidden" name="hid_nombre<?php print $intContador; ?>" id="hid_nombre<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['ctg_con_nomcom']; ?>">
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
        // //print_r($var_consulta);
        print json_encode($arrInfo);

        die();
    }else if ($strTipoValidacion == "val_mail") {

        $val = 1;
        $var_consulta = pg_query($rmfAdm, "SELECT COUNT(sru_id) FROM sol_regis_user WHERE email = '$ctg_ase_email' AND sru_modulo = 'pub' LIMIT 1;");
        if ($row = pg_fetch_array($var_consulta)) {
            $idRow = trim($row[0]);
        }
        $usuarioCode = isset($idRow) ? $idRow  : 0;

        $var_consulta = pg_query($rmfAdm, "SELECT COUNT(adm_usr_id) FROM web_users WHERE mail = '$ctg_pub_email' AND adm_usr_tipo = 'pub' LIMIT 1;");
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

<?php
//GLOBAL variableId
require_once '../../api/var_global.php';

// VALIDATION INSERT UPDATE DELETE
if (isset($_GET["validaciones"]) && !empty($_GET["validaciones"])) {

    require_once '../../../data/conexion/tmfAdm.php';

    $ctg_con_usr = $_SESSION['adm_usr_code'];

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
    $ctg_ase_nombreFull = $nombres.' '.$apellidos;

    $ctg_con_tpo = '8';
    $sucursal = 1;
    $ctg_con_censuc = 1;
    $ctg_con_estatus = 1;
    $ctg_con_sta = 1;
    $ctg_con_sol_dt = date("Y-m-d");
    $ctg_con_aut_dt = date("Y-m-d");

    $ctg_con_ven_dt_Y = date("Y");
    $ctg_con_ven_dt_Y = $ctg_con_ven_dt_Y + 1;
    $ctg_con_ven_dt_m = date("m");
    $ctg_con_ven_dt_d = date("d");
    $ctg_con_ven_dt = $ctg_con_ven_dt_Y . "-" . $ctg_con_ven_dt_m . "-" . $ctg_con_ven_dt_d;
    $ctg_con_dt = date("Y-m-d");
    $strTipoValidacion = isset($_REQUEST["validaciones"]) ? $_REQUEST["validaciones"] : '';
    if ($strTipoValidacion == "proces") {

        header('Content-Type: application/json');
        
        if ($var_consulta) {
            $subject_ = 'Usuario - '.' '.$nombre_usuario;
            $address_  = $email;
            $mailContent = '<b>VisualMed - Solicitud</b><br><br>
            <b>Bienvenido a visualMed.- Su usuario esta registrado.</b><br><br>
            <b>Usuario:</b><a>'.$nombre_usuario.'</a><br>
            <b>Contraseña:</b><a>'.$password.'</a>';
        
            require_once "../../../PHPMAILER/index.php";
        }
       // $val = 3;
        
        $usuarioCode = $variableCode;
        //$val = 2;
        $var_ase_sulta = "INSERT INTO web_users(username,adm_usr_tipo,adm_usr_code,password,nombre_completo,adm_usr_contrato,status_actual) VALUES ('$nombre_usuario','$adm_usr_tipo','$usuarioCode','".md5($clave1)."','$ctg_ase_nombreFull','$contrato',$ctg_con_estatus);";
        if (pg_query($rmfAdm, $var_ase_sulta)) {
            $arrInfo['status'] = $val;
        } else {
            $arrInfo['status'] = 0;
            $arrInfo['error'] = $var_ase_sulta;
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
        $var_consulta = "UPDATE INTO adm_solicitud_registro SET solicitud = '2');";
        if (pg_query($rmfAdm, $var_consulta)) {
            $arrInfo['status'] = $val;
        } else {
            $arrInfo['status'] = 0;
            $arrInfo['error'] = $var_consulta;
        }

        // print_r($var_consulta);
        print json_encode($arrInfo);

        die();
    } else if ($strTipoValidacion == "delete") {
        $val = 1;
        $var_consulta = "DELETE FROM adm_solicitud_registro WHERE id = $codeId;";
        if (pg_query($rmfAdm, $var_consulta)) {
            $arrInfo['status'] = $val;
        } else {
            $arrInfo['status'] = 0;
            $arrInfo['error'] = $var_consulta;
        }

        if ($var_consulta) {
            $subject_ = 'Usuario - '.' '.$nombre_usuario;
            $address_  = $email;
            $mailContent = '<b>VisualMed - Solicitud</b><br><br>
            <b>Su solicitudad a sido denegada.</b><br><br>';
    
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
            $strFilter = " AND ( UPPER(nombres) LIKE UPPER('%{$strSearch}%') OR UPPER(apellidos) LIKE UPPER('%{$strSearch}%') ) ";
        }

        $arrUsuarios = array();
        $var_consulta = "SELECT * 
        FROM adm_solicitud_registro 
        WHERE modulo = '$adm_usr_tipo'
        AND solicitud = '0'
        $strFilter
        ORDER BY nombres DESC";

        $qTMP = pg_query($rmfAdm, $var_consulta);
        //echo $var_consulta;
        while ($rTMP = pg_fetch_assoc($qTMP)) {

            $arrUsuarios[$rTMP["id"]]["id"]                          = $rTMP["id"];
            $arrUsuarios[$rTMP["id"]]["modulo"]                          = $rTMP["modulo"];
            $arrUsuarios[$rTMP["id"]]["nombres"]                          = $rTMP["nombres"];
            $arrUsuarios[$rTMP["id"]]["apellidos"]                          = $rTMP["apellidos"];
            $arrUsuarios[$rTMP["id"]]["dpi"]                          = $rTMP["dpi"];
            $arrUsuarios[$rTMP["id"]]["email"]                          = $rTMP["email"];
            $arrUsuarios[$rTMP["id"]]["nombre_usuario"]                          = $rTMP["nombre_usuario"];
            $arrUsuarios[$rTMP["id"]]["colegiado"]                          = $rTMP["colegiado"];
            $arrUsuarios[$rTMP["id"]]["contrato"]                          = $rTMP["colegiado"];
            $arrUsuarios[$rTMP["id"]]["nombre_comercial"]                          = $rTMP["nombre_comercial"];
            $arrUsuarios[$rTMP["id"]]["sucursal"]                          = $rTMP["sucursal"];
            $arrUsuarios[$rTMP["id"]]["clave1"]                          = $rTMP["clave1"];
            $arrUsuarios[$rTMP["id"]]["clave2"]                          = $rTMP["clave2"];
            $arrUsuarios[$rTMP["id"]]["solicitud"]                          = $rTMP["solicitud"];

        }
        pg_free_result($qTMP);

?>
        <div class="col-md-12 tableFixHead">
            <table id="tableData" class="table table-bordered table-striped table-hover table-sm">
                <thead>
                    <tr class="table-info">
                        <th>Nombre</th>
                        <th>Apellido</th>
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
                                <td width='30%'><?php echo  $rTMP["value"]['nombres']; ?></td>
                                <td width='43%'><?php echo  $rTMP["value"]['apellidos']; ?></td>
                                <td width='30%'><?php echo  $rTMP["value"]['nombre_usuario']; ?></td>
                                <td width='3%' style="cursor:pointer;" onclick="fntView('<?php print $intContador; ?>');"><i class="fad fa-eye"></i></td>
                                <td width='3%' style="cursor:pointer;" onclick="fntSelect('<?php print $intContador; ?>');"><i class="far fa-check-double"></i></td>
                                <td width='3%' style="cursor:pointer;" onclick="fntSelectDelete('<?php print $intContador; ?>');"><i class="fad fa-trash-alt"></i></i></td>
                            </tr>
                            <input type="hidden" name="hid_id<?php print $intContador; ?>" id="hid_id<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['id']; ?>">
                            <input type="hidden" name="hid_modulo<?php print $intContador; ?>" id="hid_modulo<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['modulo']; ?>">
                            <input type="hidden" name="hid_nombres<?php print $intContador; ?>" id="hid_nombres<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['nombres']; ?>">
                            <input type="hidden" name="hid_apellidos<?php print $intContador; ?>" id="hid_apellidos<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['apellidos']; ?>">
                            <input type="hidden" name="hid_dpi<?php print $intContador; ?>" id="hid_dpi<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['dpi']; ?>">
                            <input type="hidden" name="hid_email<?php print $intContador; ?>" id="hid_email<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['email']; ?>">
                            <input type="hidden" name="hid_nombre_usuario<?php print $intContador; ?>" id="hid_nombre_usuario<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['nombre_usuario']; ?>">
                            <input type="hidden" name="hid_colegiado<?php print $intContador; ?>" id="hid_colegiado<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['colegiado']; ?>">
                            <input type="hidden" name="hid_contrato<?php print $intContador; ?>" id="hid_contrato<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['contrato']; ?>">
                            <input type="hidden" name="hid_nombre_comercial<?php print $intContador; ?>" id="hid_nombre_comercial<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['nombre_comercial']; ?>">
                            <input type="hidden" name="hid_sucursal<?php print $intContador; ?>" id="hid_sucursal<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['sucursal']; ?>">
                            <input type="hidden" name="hid_clave1<?php print $intContador; ?>" id="hid_clave1<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['clave1']; ?>">

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

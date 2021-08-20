<?php
if (isset($_GET["validacionesContacto"]) && !empty($_GET["validacionesContacto"])) {
    session_start();
    require_once "../api/globalFunctions.php";
    require_once "../data/conexion/tmfAdm.php";

    $strTipoValidacionContacto = isset($_REQUEST["validacionesContacto"]) ? $_REQUEST["validacionesContacto"] : '';

    if ($strTipoValidacionContacto == "insert_form_contacto") {

        $ctg_nombre_completo = isset($_SESSION['username']) ? $_SESSION['username']  : '';
        $ctg_departamento = isset($_POST["ctg_departamento"]) ? $_POST["ctg_departamento"]  : '';
        $ctg_telefono = isset($_POST["ctg_telefono"]) ? $_POST["ctg_telefono"]  : '';
        $ctg_correo = isset($_POST["ctg_correo"]) ? $_POST["ctg_correo"]  : '';
        $ctg_mensaje = isset($_POST["ctg_mensaje"]) ? $_POST["ctg_mensaje"]  : '';
        $ctg_modulo = isset($_SESSION['adm_usr_tipo']) ? $_SESSION['adm_usr_tipo']  : '';

        $img = '';

        $estatus = 0;
        $modulo = 'ase';
        $fecha = date('d-m-Y');
        $trn_date = date("Y-m-d H:i:s");
        $var_consulta = "INSERT INTO ctg_contacto(ctg_nombre_completo,ctg_telefono,ctg_correo,ctg_mensaje,img,ctg_modulo) VALUES ('$ctg_nombre_completo',$ctg_telefono,'$ctg_correo','$ctg_mensaje','$img','$ctg_modulo')";
        $val = 1;

        if ($val) {
            $subject_ = 'CONTACTO';
            $address_  = 'gut.contacto@visualmed.online';
            $mailContent = '<b>VisualMed - Contacto VISUALMED.online</b><br><br>
                <table class="default" width="100%">
                    <tr border="1">
                        <td align="center" bgcolor= "#0464fc">
                            <img src="https://i.ibb.co/MZ35wKk/vmo-header2-1.png" alt="vmo-header2-1" border="0">
                        </td>
                    </tr>
                </table>
                <table class="default" width="100%">
                <tr border="1">
                <td align="center"><b>NOTIFICACION DE CORREO CONTACTO</b></td><br>
                </tr>
                <tr border="1">
                <td align="center"><b> USUARIO: ' . $ctg_nombre_completo . '</b></td><br>
                </tr>
                </table><br><br>
    
                <b>Telefono:</b><b>' . $ctg_telefono . '</b><br>
                <b>Correo:</b><b>' . $ctg_correo . '</b><br>
                <b>Mensaje:</b><b>' . $ctg_mensaje . '</b><br><br>
                <b>Fecha:</b><b>' . $fecha . '</b><br><br><br><br>
                <b>Modulo:</b><b>' . $ctg_modulo . '</b><br><br><br><br>
    
            
                <table class="default" width="100%">	
                    <tr border="1">	
                        <td align="center" bgcolor= "#0464fc">	
                            <img src="https://i.ibb.co/ckwzNgQ/vmo-footer2-1.png" alt="vmo-footer2-1" border="0">
                        </td>
                    </tr>
                </table>';

            require_once "../PHPMAILER/index.php";
        }

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
    die();
}
?>

<?php require_once "../../api/globalFunctions.php" ?>

<?php
require_once "../conexion/tmfAdm.php";
if (isset($_GET["validaciones"]) && !empty($_GET["validaciones"])) {
    $strTipoValidacion = isset($_REQUEST["validaciones"]) ? $_REQUEST["validaciones"] : '';

    if ($strTipoValidacion == "val_usuario") {
        $nombre_usuario = $_POST['nombre_usuario'];

        $val = 1;
        $var_consulta = pg_query($rmfAdm, "SELECT COUNT(sru_id) FROM sol_regis_user WHERE sru_nombre_usuario = '$nombre_usuario' AND sru_modulo = 'hos' LIMIT 1;");
        if ($row = pg_fetch_array($var_consulta)) {
            $idRow = trim($row[0]);
        }
        $usuarioCode = isset($idRow) ? $idRow  : 0;

        $var_consulta = pg_query($rmfAdm, "SELECT COUNT(adm_usr_id) FROM web_users WHERE username = '$nombre_usuario' AND adm_usr_tipo = 'hos' LIMIT 1;");
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
    }
    if ($strTipoValidacion == "val_mail") {
        $email = $_POST['email'];

        $val = 1;
        $var_consulta = pg_query($rmfAdm, "SELECT COUNT(sru_id) FROM sol_regis_user WHERE sru_email = '$email' AND sru_modulo = 'hos' LIMIT 1;");
        if ($row = pg_fetch_array($var_consulta)) {
            $idRow = trim($row[0]);
        }
        $usuarioCode = isset($idRow) ? $idRow  : 0;

        $var_consulta = pg_query($rmfAdm, "SELECT COUNT(adm_usr_id) FROM web_users WHERE mail = '$email' AND adm_usr_tipo = 'hos' LIMIT 1;");
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
    } else if ($strTipoValidacion == "val_contrato_sol_reg") {
        header('Content-Type: application/json');

        $contrato = $_POST['contrato'];
        $tipo = 'hos';

        $val = 1;
        if ($contrato >= 1) {
            $var_consulta = pg_query($rmfAdm, "SELECT COUNT(sru_id) FROM sol_regis_user WHERE sru_contrato = '$contrato' AND sru_modulo = '$tipo' LIMIT 1;");
            if ($row = pg_fetch_array($var_consulta)) {
                $idRow = trim($row[0]);
            }
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
    } else if ($strTipoValidacion == "val_contrato_web_user") {
        header('Content-Type: application/json');

        $contrato = $_POST['contrato'];
        $tipo = 'hos';

        $val = 1;
        if ($contrato >= 1) {
            $var_consulta = pg_query($rmfAdm, "SELECT COUNT(adm_usr_id) FROM web_users WHERE adm_usr_contrato = $contrato AND adm_usr_tipo = '$tipo' LIMIT 1;");
            if ($row = pg_fetch_array($var_consulta)) {
                $idRow = trim($row[0]);
            }
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
    } else if ($strTipoValidacion == "val_contrato") {
        $contrato = $_POST['contrato'];

        $val = 1;
        if ($contrato >= 1) {
            $var_consulta = pg_query($rmfAdm, "SELECT COUNT(ctg_con_id) FROM ctg_contratos WHERE ctg_con_id = '$contrato' AND ctg_con_tpo = '7' LIMIT 1;");
            if ($row = pg_fetch_array($var_consulta)) {
                $idRow = trim($row[0]);
            }
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
    } else if ($strTipoValidacion == "data_contrato") {
        $contrato = $_POST['contrato'];

        $arrData = array();
        $var_consulta = "SELECT * FROM ctg_contratos WHERE ctg_con_id = '$contrato' AND ctg_con_tpo = '7' LIMIT 1;";
        $sql = pg_query($rmfAdm, $var_consulta);
        $totalArticle = pg_num_rows($sql);
        //print_r($var_consulta);

        while ($rTMP = pg_fetch_assoc($sql)) {

            $arrData[$rTMP["ctg_con_id"]]["ctg_con_id"]                       = $rTMP["ctg_con_id"];
            $arrData[$rTMP["ctg_con_id"]]["ctg_con_nomcom"]              = $rTMP["ctg_con_nomcom"];
            $arrData[$rTMP["ctg_con_id"]]["ctg_con_email"]             = $rTMP["ctg_con_email"];
            $arrData[$rTMP["ctg_con_id"]]["ctg_con_razsoc"]             = $rTMP["ctg_con_razsoc"];
        }
        pg_free_result($sql);

        if (is_array($arrData) && (count($arrData) > 0)) {
            $intContador = 1;
            reset($arrData);
            foreach ($arrData as $rTMP['key'] => $rTMP['value']) {
?>
                <input type="hidden" name="hidctg_con_nomcom_" id="hidctg_con_nomcom_" value="<?php echo  $rTMP["value"]['ctg_con_nomcom']; ?>">
                <input type="hidden" name="hidctg_con_email_" id="hidctg_con_email_" value="<?php echo  $rTMP["value"]['ctg_con_email']; ?>">
                <input type="hidden" name="hidctg_con_razsoc_" id="hidctg_con_razsoc_" value="<?php echo  $rTMP["value"]['ctg_con_razsoc']; ?>">
<?PHP
                $intContador++;
            }
        }


        die();
    } else if ($strTipoValidacion == "insert_form_user") {

        $nombre_usuario = stripslashes($_REQUEST['nombre_usuario']);
        $nombre_usuario = pg_escape_string($rmfAdm, $nombre_usuario);
        $nombre_usuario = isset($nombre_usuario) ? $nombre_usuario  : '';

        $clave1 = stripslashes($_REQUEST['clave1']);
        $clave1 = pg_escape_string($rmfAdm, $clave2);
        $clave1 = isset($clave1) ? $clave1  : '';

        $clave2 = stripslashes($_REQUEST['clave2']);
        $clave2 = pg_escape_string($rmfAdm, $clave2);
        $clave2 = isset($clave2) ? $clave2  : '';

        $user = stripslashes($_REQUEST['user']);
        $user = pg_escape_string($rmfAdm, $user);
        $user = isset($user) ? $user  : '';

        $nombres = stripslashes($_REQUEST['nombres']);
        $nombres = pg_escape_string($rmfAdm, $nombres);
        $nombres = isset($nombres) ? $nombres  : '';

        $apellidos = stripslashes($_REQUEST['apellidos']);
        $apellidos = pg_escape_string($rmfAdm, $apellidos);
        $apellidos = isset($apellidos) ? $apellidos  : '';

        $dpi = stripslashes($_REQUEST['dpi']);
        $dpi = pg_escape_string($rmfAdm, $dpi);
        $dpi = isset($dpi) ? $dpi  : '';

        $email = stripslashes($_REQUEST['email']);
        $email = pg_escape_string($rmfAdm, $email);
        $email = isset($email) ? $email  : '';

        $colegiado = stripslashes($_REQUEST['colegiado']);
        $colegiado = pg_escape_string($rmfAdm, $colegiado);
        $colegiado = isset($colegiado) ? $colegiado  : '';

        $contrato = stripslashes($_REQUEST['contrato']);
        $contrato = pg_escape_string($rmfAdm, $contrato);
        $contrato = isset($contrato) ? $contrato  : '';

        $nombre_comercial = stripslashes($_REQUEST['nombre_comercial']);
        $nombre_comercial = pg_escape_string($rmfAdm, $nombre_comercial);
        $nombre_comercial = isset($nombre_comercial) ? $nombre_comercial  : '';

        $sucursal = stripslashes($_REQUEST['sucursal']);
        $sucursal = pg_escape_string($rmfAdm, $sucursal);
        $sucursal = isset($sucursal) ? $sucursal  : '';

        $estatus = 0;
        $modulo = 'hos';

        $fecha = date('d-m-Y');

        $val = 1;
        $trn_date = date("Y-m-d H:i:s");
        $var_consulta = "INSERT INTO sol_regis_user (sru_modulo,sru_nombres,sru_apellidos,sru_dpi,sru_email,sru_nombre_usuario,sru_colegiado,sru_contrato,sru_nombre_comercial,sru_sucursal,sru_solicitud,sru_clave1,sru_clave2) VALUES ('$modulo','$nombres','$apellidos','$dpi','$email','$nombre_usuario','$colegiado','$contrato','$nombre_comercial','$sucursal','$estatus','" . md5($clave1) . "','$clave2')";

        if ($val) {
            $subject_ = 'SOLICITUD DE CREACION DE NUEVO USUARIO VISUALMED.online';
            $address_  = $email;
            $mailContent = '<b>VisualMed - SOLICITUD DE CREACION DE NUEVO USUARIO VISUALMED.online</b><br><br>
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
            <tr border="1">
            <td align="center"><b> HOSPITAL' . $nombre_comercial . '</b></td><br>
            </tr>
            </table><br><br>

            <b>Estimado:</b><b>' . $nombres . '</b>' . ' ' . '<b>' . $apellidos . '</b><br><br>
            <b>Fecha:</b><b>' . $fecha . '</b><br><br>

            <b>Hemos recibido una solicitud para la creacion de un usuario en el modulo de hospitales de nuestra
            plataforma www.visualmed.online..</b><br><br>
            <b>Estaremos procesando tu solicitud lo antes posible y te nofiticaremos por esta misma via el
            resultado de la misma.</a><br><br>
            <b>¡Saludos!</a><br><br>
            <table class="default" width="100%">	
	<tr border="1">	
		<td align="center" bgcolor= "#0464fc">	
			<img src="https://i.ibb.co/ckwzNgQ/vmo-footer2-1.png" alt="vmo-footer2-1" border="0">
		</td>
	</tr>
</table>';;

            require_once "../../PHPMAILER/index.php";
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
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<title>VisualMed.Online</title>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
<link rel="stylesheet" type="text/css" href="../../lib/alertify/css/themes/default.css">
<link rel="stylesheet" type="text/css" href="../../lib/alertify/css/alertify.css">
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="../../lib/alertify/alertify.js"></script>

<!-- Material Design Login Form -->
<ins class="adsbygoogle" style="display:inline-block;width:728px;height:90px" data-ad-client="ca-pub-5715866801509976" data-ad-slot="3213535644"></ins>
<script>
    (adsbygoogle = window.adsbygoogle || []).push({});
</script>
<div id="loading-screen" style="display:none">
    <img src="../../asset/img/gif/spinning-circles.svg">
</div>
<section class="content col-md-12">

    <style>
        #loading-screen {
            background-color: rgba(36, 113, 163, 0.2);
            height: 100%;
            width: 100%;
            position: fixed;
            z-index: 9999;
            margin-top: 0;
            top: 0;
            text-align: center;
        }

        #loading-screen img {
            width: 200px;
            height: 200px;
            position: relative;
            margin-top: -50px;
            margin-left: -50px;
            top: 50%;
        }
    </style>
    <hgroup>
        <img src="../../lib/dist/img/vmo_log_<?php echo $pais ?>.png" alt="logo" class="rounded mx-auto d-block" alt="Responsive image">
    </hgroup>

    <div id="datos" name="datos">
        <!-- DIBUJO DE DATOS CONTRATO-->
    </div>
    <div style="text-align:center;">
        <h2>REGISTRO DE USUARIO</h2>
        <h3>HOSPITALES</h3>
    </div>
    <div id="loading-screen" style="display:none">
        <img src="../../asset/img/gif/spinning-circles.svg">
    </div>
    <form id="formData" method="POST">

        <div style="text-align:right;">
            <a href="../../index.php" class="btn btn-raised btn-danger">Cancelar</a>
        </div><br>
        <div class="form-group row">
            <label for=" No. de Contrato" class="col-sm-6 col-form-label"> No. de Contrato</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name="contrato" id="contrato" required onblur="fntValContratoSolReg()"><span class="highlight"></span><span class="bar"></span>
            </div>
        </div>
        <div class="form-group row">
            <label for="Nombre Comercial" class="col-sm-6 col-form-label">Nombre Comercial</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name="nombre_comercial" id="nombre_comercial" required><span class="highlight"></span><span class="bar"></span>
            </div>
        </div>
        <div class="form-group row">
            <label for="Correo Electronico" class="col-sm-6 col-form-label">Correo Electronico</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name="email" id="email" onblur="fntValMail()" required><span class="highlight"></span><span class="bar"></span>
            </div>
        </div>
        <div class="form-group row">
            <label for="Nombre De Usuario" class="col-sm-6 col-form-label">Nombre De Usuario</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" id="nombre_usuario" name="nombre_usuario" required onblur="fntValUsuario()"><span class="highlight"></span><span class="bar"></span>
            </div>
        </div>
        <div class="form-group row">
            <label for="inputPassword" class="col-sm-6 col-form-label">Contraseña</label>
            <div class="col-sm-6">
                <input type="password" class="form-control" id="clave1" name="clave1" required><span class="highlight"></span><span class="bar"></span>
            </div>
        </div>
        <div class="form-group row">
            <label for="inputPassword" class="col-sm-6 col-form-label">Validar contraseña</label>
            <div class="col-sm-6">
                <input type="password" class="form-control" id="clave2" name="clave2" required onblur="fntPass()"><span class="highlight"></span><span class="bar"></span>
            </div>
        </div>
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <font size="6px" face="Arial">Términos y condiciones para usuarios del App<br></font>
                    <font size="2px" face="Arial">Fecha Efectiva: 01, de julio de 2021.<br><br></font>
                    <font size="4x" face="Arial">Introducción<br><br></font>
                    <font size="2px" face="Arial">
                        Este contrato describe los términos y condiciones generales (en adelante referido únicamente como “TÉRMINOS Y CONDICIONES”) aplicables al uso de la aplicación de Visualmed.online (en adelante, “EL APP”), del cual es titular Rosalta, Sociedad Anonima (en adelante, la “TITULAR”) con domicilio en Santo Domingo, Republica de Guatemala. <br><br>EL APP tendrá como objetivo posibilidad que los usuarios de la TITULAR puedan acceder a la información registrada por los médicos, farmacias, laboratorios clínicos y hospitales relacionada con su historial médico y a promociones ofrecidas por distintos comercios afiliados (Farmacias, Laboratorios Clínicos, Hospitales y otros) en Visualmed.online. Estas promociones las podrán canjear los usuarios en los comercios afiliados, sujetándose a los lineamientos y consideraciones expuestas en los presentes TÉRMINOS Y CONDICIONES. <br><br>Cualquier persona de trece (18) años de edad o mayor que desee utilizar en EL APP (en adelante, el “USUARIO”), podrá hacerlo sujetándose a los presentes TÉRMINOS Y CONDICIONES, así como a políticas y principios incorporados al presente documento, lo cual lo hace un contrato vinculante entre ambas partes.<br><br>Por el solo hecho de utilizar EL APP, al momento de activar su cuenta de suscripción, el USUARIO acepta las condiciones aquí estipuladas y certifica que tiene al menos diez y ocho (18) años de edad.<br><br><br></font>

                    <font size="4x" face="Arial">Consideraciones de EL APP<br><br></font>
                    <font size="2px" face="Arial">
                        Para todo aquel USUARIO que utilice EL APP aplicarán las siguientes consideraciones:<br><br>1. Todos los USUARIOS de EL APP tendrán que pagar por el uso de la misma, pagando la suscripción por medio de un monto mensual,<br>2. EL APP tendrá un período de prueba gratis, por medio del cual los USUARIOS tendrán acceso a todos los beneficios de consumo de los comercios afiliados, tal y como si fueran un usuario activo.<br>3. Una vez vencido el período de prueba gratis, el costo de la suscripción comenzará a requerirse pudiendo ser este a través de depósito bancario, transferencia o cheque bancario y/o tarjeta de crédito.<br>4. El canje de las promociones publicadas y promovidas a través de EL APP, son responsabilidad de los comercios afiliados. En base a lo anterior, la TITULAR no se hace responsable por:<br> &nbsp;&nbsp;&nbsp;i) la insatisfacción del USUARIO con la calidad del producto o servicio otorgado a través de cualquier promoción;<br>&nbsp;&nbsp;&nbsp;ii) Por la disponibilidad de inventario en productos o servicios ofrecidos por los comercios afiliados; y <br> &nbsp;&nbsp;&nbsp;iii) Por la reserva de espacios o por el horario de atención de los comercios afiliados, para canje de promociones.<br><br></font>

                    <font size="4x" face="Arial">Otras Consideraciones<br><br></font>
                    <font size="2px" face="Arial">
                        Visualmed.online podrá adicionar, modificar o eliminar las funcionalidades en cualquier momento, lo cual acepta el usuario mediante la utilización de la aplicación. En todo caso, al momento de realizar dichas modificaciones se notificarán al usuario a través de la misma aplicación una vez inicie sesión.<br><br>
                        El usuario acepta y autoriza que los registros electrónicos de las actividades mencionadas, que realice en la aplicación constituyen plena prueba de los mismos.<br><br>
                    </font>

                    <font size="4x" face="Arial">Obligaciones de los Usuarios<br><br></font>
                    <font size="2px" face="Arial">
                        El USUARIO se obliga a usar EL APP y los contenidos encontrados en ella de una manera diligente, correcta, lícita y en especial, se compromete a NO realizar las conductas descritas a continuación:<br><br> &nbsp;&nbsp;&nbsp;(a) Utilizar los contenidos de forma, con fines o efectos contrarios a la ley, a la moral y a las buenas costumbres generalmente aceptadas o al orden público;<br> &nbsp;&nbsp;&nbsp;(b) Reproducir, copiar, representar, utilizar, distribuir, transformar o modificar los contenidos de EL APP, por cualquier procedimiento o sobre cualquier soporte, total o parcial, o permitir el acceso del público a través de cualquier modalidad de comunicación pública;<br> &nbsp;&nbsp;&nbsp;(c) Utilizar los contenidos de cualquier manera que entrañen un riesgo de daño o inutilización de EL APP o de los contenidos o de terceros;<br> &nbsp;&nbsp;&nbsp;(d) Suprimir, eludir o manipular el derecho de autor y demás datos identificativos de los derechos de autor incorporados a los contenidos, así como los dispositivos técnicos de protección, o cualesquiera mecanismos de información que pudieren tener los contenidos;<br> &nbsp;&nbsp;&nbsp;(e) Emplear los contenidos y, en particular, la información de cualquier clase obtenida a través de EL APP para distribuir, transmitir, remitir, modificar, rehusar o reportar la publicidad o los contenidos de esta con fines de venta directa o con cualquier otra clase de finalidad comercial, mensajes no solicitados dirigidos a una pluralidad de personas con independencia de su finalidad, así como comercializar o divulgar de cualquier modo dicha información;<br> &nbsp;&nbsp;&nbsp;(f) No permitir que terceros ajenos al USUARIO usen EL APP con su clave;<br> &nbsp;&nbsp;&nbsp;g) Utilizar EL APP y los contenidos con fines lícitos y/o ilícitos, contrarios a lo establecido en estos TÉRMINOS Y CONDICIONES, o al uso mismo de EL APP, que sean lesivos de los derechos e intereses de terceros, o que de cualquier forma puedan dañar, inutilizar, sobrecargar o deteriorar EL APP y los contenidos o impedir la normal utilización o disfrute de esta y de los contenidos por parte de los usuarios.<br><br>
                    </font>

                    <font size="4x" face="Arial">Propiedad Intelectual<br><br></font>
                    <font size="2px" face="Arial">Todo el material informático, gráfico, publicitario, fotográfico, de multimedia, audiovisual y de diseño, así como todos los contenidos, textos y bases de datos puestos a su disposición en EL APP están protegidos por derechos de autor y/o propiedad industrial cuyo titular es Rosalta, S.A., o sus compañías filiales, vinculadas o subsidiarias, en algunos casos, de terceros que han autorizado su uso o explotación. Igualmente, el uso en EL APP de algunos materiales de propiedad de terceros se encuentra expresamente autorizado por la ley o por dichos terceros. Todos los contenidos en EL APP están protegidos por las normas sobre derecho de autor y por todas las normas nacionales e internacionales que le sean aplicables.<br><br>Exceptuando lo expresamente estipulado en estos TÉRMINOS Y CONDICIONES, queda prohibido todo acto de copia, reproducción, modificación, creación de trabajos derivados, venta o distribución, exhibición de los contenidos de EL APP, de manera o por medio alguno, incluyendo, más no limitado a, medios electrónicos, mecánicos, de fotocopiado, de grabación o de cualquier otra índole, sin el permiso previo y por escrito de la TITULAR o del titular de los respectivos derechos.<br><br>En ningún caso estos TÉRMINOS Y CONDICIONES confieren derechos, licencias ni autorizaciones para realizar los actos anteriormente prohibidos. Cualquier uso no autorizado de los contenidos constituirá una violación del presente documento y a las normas vigentes sobre derechos de autor, a las normas vigentes nacionales e internacionales sobre Propiedad Industrial, y a cualquier otra que sea aplicable.<br><br>
                    </font>

                    <font size="4x" face="Arial">Uso de Información y Privacidad<br><br></font>
                    <font size="2px" face="Arial">Con la creación de cuenta en EL APP, el USUARIO acepta y autoriza que la TITULAR, utilice sus datos en calidad de responsable del tratamiento para fines derivados de la ejecución de EL APP. La TITULAR informa que el USUARIO podrá ejercer sus derechos a conocer, actualizar, rectificar y suprimir su información personal; así como el derecho a revocar el consentimiento otorgado para el tratamiento de datos personales a través del correo electrónico gut.contacto@visualmed.online o del teléfono (+502) 7830-4642, siendo voluntario responder preguntas sobre información sensible o de menores de edad.<br><br>La TITULAR podrá dar a conocer, transferir y/o trasmitir sus datos personales dentro y fuera del país a cualquier empresa miembro del grupo de empresas afiliadas a la TITULAR, así como a terceros a consecuencia de un contrato, ley o vínculo lícito que así lo requiera, para lo cual el USUARIO otorga su autorización expresa e inequívoca.<br><br>De conformidad a lo anterior el USUARIO autoriza el tratamiento de su información en los términos señalados, y transfiere a la TITULAR de manera total, y sin limitación estos derechos de manera voluntaria, previa, explicita, informada e inequívoca.<br><br>
                    </font>


                    <font size="4x" face="Arial">Responsabilidad de la TITULAR<br><br></font>
                    <font size="2px" face="Arial">La TITULAR procurará garantizar disponibilidad, continuidad o buen funcionamiento de EL APP. La TITULAR podrá bloquear, interrumpir o restringir el acceso a esta cuando lo considere necesario para el mejoramiento de la aplicación o por dada de baja de la misma.<br><br>Se recomienda al USUARIO tomar medidas adecuadas y actuar diligentemente al momento de acceder a la aplicación, como, por ejemplo, contar con programas de protección, antivirus para manejo de malware, spyware y herramientas similares.<br><br>La TITULAR no será responsable por: a) Fuerza mayor o caso fortuito; b) Por la pérdida, extravío o hurto de su dispositivo móvil que implique el acceso de terceros a EL APP; c) Por errores en la digitación o accesos por parte del USUARIO; d) Por los perjuicios, lucro cesante, daño emergente, morales, y en general sumas a cargo de la TITULAR, por los retrasos, no procesamiento de información o suspensión del servicio del operador móvil o daños en los dispositivos móviles.<br><br>
                    </font>

                    <font size="4x" face="Arial">Denegación y Retirada del Acceso a EL APP<br><br></font>
                    <font size="2px" face="Arial">
                        En el evento en que un USUARIO incumpla estos TÉRMINOS Y CONDICIONES, o cualesquiera otras disposiciones que resulten de aplicación, la TITULAR podrá suspender su acceso a EL APP.<br><br>
                    </font>

                    <font size="4x" face="Arial">Aceptación<br><br></font>
                    <font size="2px" face="Arial">EL USUARIO acepta expresamente los TÉRMINOS Y CONDICIONES, siendo condición esencial para la utilización de EL APP. En el evento en que EL USUARIO se encuentre en desacuerdo con estos TÉRMINOS Y CONDICIONES, solicitamos abandonar la aplicación inmediatamente.<br><br>La TITULAR podrá modificar los presentes TÉRMINOS Y CONDICIONES, avisando al USUARIO de EL APP mediante publicación en la página web www.visualmed.online o mediante la difusión de las modificaciones por algún medio electrónico, redes sociales, SMS y/o correo electrónico, lo cual se entenderá aceptado por el USUARIO si éste continua con el uso de EL APP.<br><br>
                    </font>

                    <font size="4x" face="Arial">Jurisdicción<br><br></font>
                    <font size="2px" face="Arial">Estos TÉRMINOS Y CONDICIONES y todo lo que tenga que ver con esta aplicación, se rigen por las leyes de la República de Guatemala.<br><br>
                    </font>


                    <font size="4x" face="Arial">Uso de Direcciones IP<br><br></font>
                    <font size="2px" face="Arial">
                        La TITULAR podrá recolectar direcciones IP para propósitos de administración de sistemas y para auditar el uso de nuestro sitio, todo lo anterior de acuerdo con la autorización de protección de datos que se suscribe en estos TÉRMINOS Y CONDICIONES. <br><br>
                    </font><br>

                    <div>
                        <button type="button" onclick="fntAceptCondi()" class="btn btn-primary" data-dismiss="modal">ACEPTO TODOS LOS TERMINOS Y CONDICIONES</button><br>
                    </div>
                    <div>
                        <hr>
                    </div>
                </div>

            </div>
        </div>

        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">ACEPTAR TERMINOS Y CONDICIONES</button>

        <a onclick="fntInsertUs()" id="insert" class="button buttonBlue">Enviar Solicitud
            <div class="ripples buttonRipples"><span class="ripplesCircle"></span></div>
        </a>
    </form>

    <script>
        document.getElementById('insert').style.display = 'none';

        function fntAceptCondi() {
            document.getElementById('insert').style.display = 'block';
        }

        function fntInsertUs() {

            valorNom = document.getElementById("contrato").value;
            if (valorNom == null || valorNom.length == 0 || /^\s+$/.test(valorNom)) {
                alertify.alert('AVISO ', 'Por favor seleccione o ingrese un contrato');
                return false;
            }

            valorNom = document.getElementById("nombre_comercial").value;
            if (valorNom == null || valorNom.length == 0 || /^\s+$/.test(valorNom)) {
                alertify.alert('AVISO ', 'Por favor seleccione o ingrese un nombre comercial');
                return false;
            }

            valorNom = document.getElementById("email").value;
            if (valorNom == null || valorNom.length == 0 || /^\s+$/.test(valorNom)) {
                alertify.alert('AVISO ', 'Por favor seleccione o ingrese un email');
                return false;
            }

            valorNom = document.getElementById("nombre_usuario").value;
            if (valorNom == null || valorNom.length == 0 || /^\s+$/.test(valorNom)) {
                alertify.alert('AVISO ', 'Por favor seleccione o ingrese un nombre usuario');
                return false;
            }

            valorNom = document.getElementById("clave1").value;
            if (valorNom == null || valorNom.length == 0 || /^\s+$/.test(valorNom)) {
                alertify.alert('AVISO ', 'Por favor seleccione o ingrese una clave');
                return false;
            }

            valorNom = document.getElementById("clave2").value;
            if (valorNom == null || valorNom.length == 0 || /^\s+$/.test(valorNom)) {
                alertify.alert('AVISO ', 'Por favor seleccione o ingrese un clave');
                return false;
            }

            document.getElementById("loading-screen").style.display = "block";

            var datos = $('#formData').serialize();
            //alert(datos);
            //return false;

            $.ajax({
                type: "POST",
                data: datos,
                dataType: 'json',
                url: "register_hospitales.php?ajax=true&validaciones=insert_form_user",
                success: function(r) {
                    if (r.status) {
                        if (r.status == 1) {
                            //$('#formData')[0].reset();
                            document.getElementById("loading-screen").style.display = "none";
                            document.getElementById('insert').disabled = false;

                            alertify.confirm('Datos cargados correctamente!', ' ', function() {}, function() {
                                alertify.error('Cancel')
                            })

                            $('#formData')[0].reset();

                            window.location = "login_hospitales.php?usr=6";

                        }
                    } else {
                        alertify.alert('Tus Consultas', 'no se pudo completar!');
                        //location.reload(); 
                    }
                }
            });

            return false;
        };

        function fntPass() {
            var x = $("#password").val();
            var y = $("#password_conf").val();

            if (x == y) {
                alertify.set('notifier', 'position', 'bottom-right');
                alertify.success('Contraseña : Efectiva');
            } else {
                alertify.alert('AVISO', 'Las contraseñas no coinciden!');
            }

        };

        function fntValUsuario() {

            var datos = $('#registration').serialize();
            //alert(datos);
            //return false;
            $.ajax({
                type: "POST",
                data: datos,
                dataType: 'json',
                url: "register_hospitales.php?ajax=true&validaciones=val_usuario",
                success: function(r) {
                    if (r.status) {
                        if (r.status == 1) {
                            alertify.alert('AVISO', 'Esta usuario ya existe!');
                            document.getElementById("nombre_usuario").value = "";

                        }
                    } else {
                        if (r.status == 0) {
                            alertify.set('notifier', 'position', 'bottom-right');
                            alertify.success('Usuario : Disponible');
                        }
                    }
                }
            });

            return false;
        };

        function fntValMail() {

            var datos = $('#registration').serialize();
            //alert(datos);
            //return false;
            $.ajax({
                type: "POST",
                data: datos,
                dataType: 'json',
                url: "register_publicidad.php?ajax=true&validaciones=val_mail",
                success: function(r) {
                    if (r.status) {
                        if (r.status == 1) {
                            alertify.alert('AVISO', 'Esta email ya existe!');
                            document.getElementById("email").value = "";
                        }
                    } else {
                        if (r.status == 0) {
                            alertify.set('notifier', 'position', 'bottom-right');
                            alertify.success('email : Disponible');
                        }
                    }
                }
            });

            return false;
        };

        function fntValContratoSolReg() {

            var datos = $('#registration').serialize();
            //alert(datos);
            //return false;
            document.getElementById("loading-screen").style.display = "block";

            $.ajax({
                type: "POST",
                data: datos,
                dataType: 'json',
                url: "register_hospitales.php?ajax=true&validaciones=val_contrato_sol_reg",
                success: function(r) {
                    if (r.status) {
                        if (r.status == 1) {
                            document.getElementById("loading-screen").style.display = "none";

                            alertify.set('notifier', 'position', 'bottom-right');
                            alertify.success('Numero contrato : No disponible');
                            document.getElementById("contrato").value = "";
                        }
                    } else {
                        if (r.status == 0) {
                            fntValContratoWebUser();
                        }
                    }
                }
            });

            return false;
        };

        function fntValContratoWebUser() {

            var datos = $('#registration').serialize();
            //alert(datos);
            //return false;

            $.ajax({
                type: "POST",
                data: datos,
                dataType: 'json',
                url: "register_hospitales.php?ajax=true&validaciones=val_contrato_web_user",
                success: function(r) {
                    if (r.status) {
                        if (r.status == 1) {
                            document.getElementById("loading-screen").style.display = "none";

                            alertify.set('notifier', 'position', 'bottom-right');
                            alertify.success('Numero contrato : No disponible');
                            document.getElementById("contrato").value = "";
                        }
                    } else {
                        if (r.status == 0) {
                            fntValContrato();
                        }
                    }
                }
            });

            return false;
        };

        function fntValContrato() {

            var datos = $('#registration').serialize();
            //alert(datos);
            //return false;
            $.ajax({
                type: "POST",
                data: datos,
                dataType: 'json',
                url: "register_hospitales.php?ajax=true&validaciones=val_contrato",
                success: function(r) {
                    if (r.status) {
                        if (r.status == 1) {
                            alertify.alert('AVISO', 'Este contrato esta dispobible!');
                            fntDataContrato();
                        }
                    } else {
                        if (r.status == 0) {
                            alertify.set('notifier', 'position', 'bottom-right');
                            alertify.success('Numero contrato : No disponible');
                            document.getElementById("contrato").value = "";
                            document.getElementById("loading-screen").style.display = "none";

                        }
                    }
                }
            });

            return false;
        };

        function fntDataContrato() {

            var datos = $('#registration').serialize();
            $.ajax({

                url: "register_hospitales.php?ajax=true&validaciones=data_contrato",
                data: datos,
                async: true,
                global: false,
                type: "post",
                dataType: "html",
                success: function(data) {

                    $("#datos").html("");
                    $("#datos").html(data);
                    fntData()
                    return false;
                }
            });

        };

        function fntData() {
            var hidctg_con_nomcom_ = $("#hidctg_con_nomcom_").val();
            var hidctg_con_email_ = $("#hidctg_con_email_").val();
            var hidctg_con_razsoc_ = $("#hidctg_con_razsoc_").val();
            //alert(hidctg_con_nomcom_ + "                         hidctg_con_nomcom_");
            //alert(hidctg_con_email_ + "                         hidctg_con_email_");
            $("#nombre_comercial").val(hidctg_con_nomcom_);
            $("#email").val(hidctg_con_email_);
            document.getElementById("loading-screen").style.display = "none";

        }
    </script>

    <style type="text/css">
        * {
            box-sizing: border-box;
        }

        body {
            margin: -100;
            font-family: Helvetica;
            background: #eee;
            -webkit-font-smoothing: antialiased;
        }

        hgroup {
            text-align: center;
            margin-top: 4em;
        }

        h1,
        h3 {
            font-weight: 300;
        }

        h1 {
            color: #636363;
        }

        h2 {
            color: #007bff;
        }

        h3 {
            color: #4a89dc;
        }

        form {
            width: 600px;
            margin: 1em auto;
            padding: 3em 2em 2em 2em;
            background: #fafafa;
            border: 1px solid #ebebeb;
            box-shadow: rgba(0, 0, 0, 0.14902) 0px 1px 1px 0px, rgba(0, 0, 0, 0.09804) 0px 1px 2px 0px;
        }

        .group {
            position: relative;
            margin-bottom: 45px;
        }

        input {
            font-size: inherit;
            padding: 5px 5px 10px 5px;
            -webkit-appearance: none;
            display: block;
            background: #fafafa;
            color: #636363;
            width: 100%;
            border: none;
            border-radius: 0;
            border-bottom: 1px solid #757575;
        }

        input:focus {
            outline: none;
        }


        /* Label */

        label {
            color: #999;
            font-size: 18px;
            font-weight: normal;
            position: absolute;
            pointer-events: none;
            left: 5px;
            top: 10px;
            transition: all 0.2s ease;
        }


        /* active */

        input:focus~label,
        input.used~label {
            top: -20px;
            transform: scale(.75);
            left: -2px;
            /* font-size: 14px; */
            color: #4a89dc;
        }


        /* Underline */

        .bar {
            position: relative;
            display: block;
            width: 100%;
        }

        .bar:before,
        .bar:after {
            content: '';
            height: 2px;
            width: 0;
            bottom: 1px;
            position: absolute;
            background: #4a89dc;
            transition: all 0.2s ease;
        }

        .bar:before {
            left: 50%;
        }

        .bar:after {
            right: 50%;
        }


        /* active */

        input:focus~.bar:before,
        input:focus~.bar:after {
            width: 50%;
        }


        /* Highlight */



        /* active */

        input:focus~.highlight {
            animation: inputHighlighter 0.3s ease;
        }


        /* Animations */

        @keyframes inputHighlighter {
            from {
                background: #4a89dc;
            }

            to {
                width: 0;
                background: transparent;
            }
        }


        /* Button */

        .button {
            position: relative;
            display: inline-block;
            padding: 12px 24px;
            margin: .3em 0 1em 0;
            width: 100%;
            vertical-align: middle;
            color: #fff;
            font-size: 16px;
            line-height: 20px;
            -webkit-font-smoothing: antialiased;
            text-align: center;
            letter-spacing: 1px;
            background: transparent;
            border: 0;
            border-bottom: 2px solid #3160B6;
            cursor: pointer;
            transition: all 0.15s ease;
        }

        .button:focus {
            outline: 0;
        }


        /* Button modifiers */

        .buttonBlue {
            background: #4a89dc;
            text-shadow: 1px 1px 0 rgba(39, 110, 204, .5);
        }

        .buttonBlue:hover {
            background: #357bd8;
        }


        /* Ripples container */

        .ripples {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            overflow: hidden;
            background: transparent;
        }


        /* Ripples circle */

        .ripplesCircle {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            opacity: 0;
            width: 0;
            height: 0;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.25);
        }

        .ripples.is-active .ripplesCircle {
            animation: ripples .4s ease-in;
        }


        /* Ripples animation */

        @keyframes ripples {
            0% {
                opacity: 0;
            }

            25% {
                opacity: 1;
            }

            100% {
                width: 200%;
                padding-bottom: 200%;
                opacity: 0;
            }
        }

        footer {
            text-align: center;
        }

        footer p {
            color: #888;
            font-size: 13px;
            letter-spacing: .4px;
        }

        footer a {
            color: #4a89dc;
            text-decoration: none;
            transition: all .2s ease;
        }

        footer a:hover {
            color: #666;
            text-decoration: underline;
        }

        footer img {
            width: 80px;
            transition: all .2s ease;
        }

        footer img:hover {
            opacity: .83;
        }

        footer img:focus,
        footer a:focus {
            outline: none;
        }
    </style>

    <script>
        $(window, document, undefined).ready(function() {

            $('input').blur(function() {
                var $this = $(this);
                if ($this.val())
                    $this.addClass('used');
                else
                    $this.removeClass('used');
            });

            var $ripples = $('.ripples');

            $ripples.on('click.Ripples', function(e) {

                var $this = $(this);
                var $offset = $this.parent().offset();
                var $circle = $this.find('.ripplesCircle');

                var x = e.pageX - $offset.left;
                var y = e.pageY - $offset.top;

                $circle.css({
                    top: y + 'px',
                    left: x + 'px'
                });

                $this.addClass('is-active');

            });

            $ripples.on('animationend webkitAnimationEnd mozAnimationEnd oanimationend MSAnimationEnd', function(e) {
                $(this).removeClass('is-active');
            });

        });
    </script>
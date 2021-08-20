<?php require_once "../../api/globalFunctions.php" ?>

<?php
require_once "../conexion/tmfAdm.php";
if (isset($_GET["validaciones"]) && !empty($_GET["validaciones"])) {
    $strTipoValidacion = isset($_REQUEST["validaciones"]) ? $_REQUEST["validaciones"] : '';

    if ($strTipoValidacion == "val_usuario") {
        $nombre_usuario = $_POST['nombre_usuario'];

        $val = 1;
        $var_consulta = pg_query($rmfAdm, "SELECT COUNT(id) FROM adm_solicitud_registro WHERE nombre_usuario = '$nombre_usuario' LIMIT 1;");
        if ($row = pg_fetch_array($var_consulta)) {
            $idRow = trim($row[0]);
        }
        $usuarioCode = isset($idRow) ? $idRow  : 0;

        $var_consulta = pg_query($rmfAdm, "SELECT COUNT(amd_usr_id) FROM web_users WHERE username = '$nombre_usuario' LIMIT 1;");
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
    } else if ($strTipoValidacion == "val_dpi") {
        $dpi = $_POST['dpi'];

        $val = 1;
        $var_consulta = pg_query($rmfAdm, "SELECT COUNT(id) FROM adm_solicitud_registro WHERE UPPER(dpi) = UPPER('$dpi') LIMIT 1;");
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
    }
    die();
}
?>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<title>VisualMed.Online</title>
<link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<link rel="stylesheet" type="text/css" href="../../lib/alertify/css/themes/default.css">
<link rel="stylesheet" type="text/css" href="../../lib/alertify/css/alertify.css">
<script src="//netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<script src="../../lib/alertify/alertify.js"></script>
<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<!-- Material Design Login Form -->
<ins class="adsbygoogle" style="display:inline-block;width:728px;height:90px" data-ad-client="ca-pub-5715866801509976" data-ad-slot="3213535644"></ins>
<script>
    (adsbygoogle = window.adsbygoogle || []).push({});
</script>
<hgroup>
    <img src="../../lib/dist/img/vmo_logo_<?php $pais ?>.png" alt="logo" class="rounded mx-auto d-block" alt="Responsive image">
</hgroup>

<?php

if (isset($_REQUEST['nombre_usuario'])) {
    $nombre_usuario = stripslashes($_REQUEST['nombre_usuario']);
    $nombre_usuario = pg_escape_string($rmfAdm, $nombre_usuario);
    $nombre_usuario = isset($nombre_usuario) ? $nombre_usuario  : '';

    $clave1 = stripslashes($_REQUEST['clave1']);
    $clave1 = pg_escape_string($rmfAdm, $clave2);
    $clave1 = isset($clave1) ? $clave1  : '';

    $clave2 = stripslashes($_REQUEST['clave1']);
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
    $modulo = 'pac';



    $trn_date = date("Y-m-d H:i:s");
    $query = "INSERT INTO adm_solicitud_registro (modulo,nombres,apellidos,dpi,email,nombre_usuario,colegiado,contrato,nombre_comercial,sucursal,estatus,clave1,clave2) 
                        VALUES ('$modulo','$nombres','$apellidos','$dpi','$email','$nombre_usuario','$colegiado','$contrato','$nombre_comercial','$sucursal','$estatus','" . md5($clave1) . "','" . md5($clave2) . "')";
    $result = pg_query($rmfAdm, $query);

    if ($result) {
        header('Location:login_pacientes.php?usr=6');
    }
} else {
?>
    <div style="text-align:center;">
        <h2>REGISTRO DE USUARIO</h2>
    </div>
    <form name="registration" id="registration" action="" method="post">
        <div style="text-align:right;">
            <a href="../../index.php" class="btn btn-raised btn-danger">Cancelar</a>
        </div>
        <div class="group">
            <input type="text" name="dpi" required onblur="fntValDpi()"><span class="highlight"></span><span class="bar"></span>
            <label> DPI</label>
        </div>
        <div class="group">
            <input type="text" name="nombres" required><span class="highlight"></span><span class="bar"></span>
            <label> Nombres</label>
        </div>
        <div class="group">
            <input type="text" name="apellidos" required><span class="highlight"></span><span class="bar"></span>
            <label> Apellidos</label>
        </div>
        <div class="group">
            <input type="email" name="email" required><span class="highlight"></span><span class="bar"></span>
            <label> Correo Electronico</label>
        </div>
        <div class="group">
            <input type="text" name="nombre_usuario" required onblur="fntValUsuario()"><span class="highlight"></span><span class="bar"></span>
            <label>Nombre De Usuario</label>
        </div>
        <div class="group">
            <input type="password" name="clave1" required><span class="highlight"></span><span class="bar"></span>
            <label>Contraseña</label>
        </div>
        <div class="group">
            <input type="password" name="clave2" required onblur="fntPass()"><span class="highlight"></span><span class="bar"></span>
            <label>Validar contraseña</label>
        </div>
        <button type="submit" name="submit" value="Register" class="button buttonBlue">Enviar Solicitud
            <div class="ripples buttonRipples"><span class="ripplesCircle"></span></div>
        </button>
    </form>

<?php
}
?>

<script>
    function fntPass() {
        var x = $("#password").val();
        var y = $("#password_conf").val();

        if (x == y) {
            alertify.set('notifier','position', 'bottom-right');
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
            url: "register.php?ajax=true&validaciones=val_usuario",
            success: function(r) {
                if (r.status) {
                    if (r.status == 1) {
                        alertify.alert('AVISO', 'Este usuario ya existe!');
                        document.getElementById("nombre_usuario").value = "";

                    }
                } else {
                    if (r.status == 0) {
                        alertify.set('notifier','position', 'bottom-right');
                        alertify.success('Usuario : Disponible');
                    }
                }
            }
        });

        return false;
    };

    function fntValDpi() {

        var datos = $('#registration').serialize();
        //alert(datos);
        //return false;
        $.ajax({
            type: "POST",
            data: datos,
            dataType: 'json',
            url: "register.php?ajax=true&validaciones=val_dpi",
            success: function(r) {
                if (r.status) {
                    if (r.status == 1) {
                        alertify.alert('AVISO', 'Este DPI ya existe!');
                        document.getElementById("dpi").value = "";
                    }
                } else {
                    if (r.status == 0) {
                        alertify.set('notifier','position', 'bottom-right');
                        alertify.success('Numero de DPI : Disponible');
                    }
                }
            }
        });

        return false;
    };
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
        width: 380px;
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
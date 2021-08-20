<?php require_once "../../api/globalFunctions.php" ?>

<?php

if (isset($_GET["validaciones"]) && !empty($_GET["validaciones"])) {
    require_once "../conexion/tmfAdm.php";
    $strTipoValidacion = isset($_REQUEST["validaciones"]) ? $_REQUEST["validaciones"] : '';

    if ($strTipoValidacion == "val_mail") {
        header('Content-Type: application/json');
        $username = $_POST['username'];
        $mail = trim($_POST["mail"]) ? $_POST["mail"]  : '';

        $usuario_ = trim($_POST["us"]) ? $_POST["us"]  : '';
        //$usuario_ = openssl_decrypt($usuario_, COD, KEY);

        $val = 1;
        $var_consulta = pg_query($rmfAdm, "SELECT COUNT(adm_usr_id) FROM web_users WHERE UPPER(mail) = UPPER('$mail') AND username = '$username' AND adm_usr_tipo = '$usuario_'  LIMIT 1;");
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
        //print_r('<br>'. $usuarioCode .'CONSULTA <br>');
        print json_encode($arrInfo);
        die();
    }
    die();
}
?>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<title>VisualMed.Online</title>
<link rel="icon" href="../../lib/dist/img/vmo_ICO.png" type="image/png" sizes="16x16">
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
<?php

if (isset($_REQUEST['mail'])) {

    require_once "../conexion/tmfAdm.php";

    $mail = stripslashes($_REQUEST['mail']);
    $mail = pg_escape_string($rmfAdm, $mail);
    $mail = isset($mail) ? $mail  : '';
    $mail_ = openssl_encrypt($mail, COD, KEY);;
    $mail_ = urlencode($mail_);

    $nomUs = stripslashes($_REQUEST['username']);
    $nomUs = pg_escape_string($rmfAdm, $mail);
    $nomUs = isset($nomUs) ? $nomUs  : '';
    $nomUs = openssl_encrypt($nomUs, COD, KEY);;
    $nomUs = urlencode($nomUs);

    $ctg_dt = date("Y-m-d");
    $ctg_dt = date('Y-m-d', strtotime($ctg_dt . " + 1 day"));
    $ctg_dt_ = openssl_encrypt($ctg_dt, COD, KEY);;
    $ctg_dt_ = urlencode($ctg_dt_);

    $usuario_ = trim($_GET["us"]) ? $_GET["us"]  : '';
    $usuario = trim($_GET["us"]) ? $_GET["us"]  : '';

    $unidad = $ctg_dt . $mail;


    $rand_part = str_shuffle($unidad . uniqid());
    $pais = strtolower($pais);

    $enlace = "https://visualmed.online/" . $pais . "/data/log/resc_pass_new.php?tk=" . $rand_part . "&dt=" . $ctg_dt_ . "&ml=" . $mail_ . "&us=" . $usuario . "&usn=" . $mail_;

    $query = "UPDATE web_users
                SET remember_token = '$rand_part',
                    proces_new_pass = 1
                WHERE UPPER(mail) = UPPER('$mail')
                    AND adm_usr_tipo = '$usuario_';";
    $result = pg_query($rmfAdm, $query);

    if ($result) {
        $subject_ = 'Recuperacion De Contraseña';
        $address_  = $mail;
        $mailContent = '<b>VisualMed</b><br><br>
        <b>Hemos recibido una solicitud para restablecer la contraseña de tu cuenta.<br><br></b>
        <a>Para cambiar tu contraseña, haz clic en este enlace:</a><br><br>
        <a href="' . $enlace . '">' . $enlace . '</a><br><br>
        <a>Los enlaces para restablecer contraseñas solo son válidos durante 24 horas. Si el enlace expira, tendrás que enviar una solicitud nueva aquí: <a href="https://visualmed.online/dor/data/log/resc_pass.php">https://visualmed.online/dor/data/log/resc_pass.php</a></a><br><br>
        <a>Si no has solicitado un cambio, ignora este mensaje y tu contraseña seguirá siendo la misma.</a><br><br>
        <a>¿Necesitas ayuda o tienes preguntas sobre tu cuenta de VisualMed? Visita nuestra página de ayuda técnica: <a href="https://visualmed.online/support.php">https://visualmed.online/support.php</a></a><br><br>
        <a>Este enlace vence el :' . $ctg_dt . '</a><br><br>
        <a>Un saludo,</a><br><br>
        <a>El equipo de ayuda técnica de VisualMed</a><br><br>
        <br>';

        require_once "../../PHPMAILER/index.php";
    }
    if ($result) {
        header('Location:../../pre_log.php');
    }
} else {
    $error = '';

    if ($error == 1) {
?>
        <div class="modal fade show" id="exampleModal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Alerta!</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <span>Datos de Ingreso no validos, el correo que ingreso no contiene ningun usuario!</span> <br>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    <?php
    }
    $usuario_ = trim($_GET["us"]) ? $_GET["us"]  : '';

    ?>
    <br><br><br><br><br>
    <hgroup>
        <img src="../../lib/dist/img/vmo_log_<?php echo $pais ?>.png" alt="logo" class="rounded mx-auto d-block" alt="Responsive image">
    </hgroup>
    <div style="text-align:center;">
        <h2>RESTABLECER CONTRASEÑA</h2>
    </div>
    <form name="registration" id="registration" action="" method="post">
        <div style="text-align:right;">
            <a href="../../index.php" class="btn btn-raised btn-danger">Cancelar</a>
        </div>
        <div class="group">
            <input type="text" name="username" id="username" required><span class="highlight"></span><span class="bar"></span>
            <label>Nombre De Usuario</label>
        </div>
        <div class="group">
            <input type="text" name="mail" id="mail" onblur="fntValMail()" required><span class="highlight"></span><span class="bar"></span>
            <input type="hidden" name="us" id="us" value="<?php echo $usuario_ ?>" required>
            <label>Correo Electronico</label>
        </div>

        <button type="submit" name="submit" value="Register" class="button buttonBlue">Enviar Solicitud
            <div class="ripples buttonRipples"><span class="ripplesCircle"></span></div>
        </button>
    </form>

<?php
}
?>

<script>
    function fntValMail() {

        var datos = $('#registration').serialize();
        //alert(datos);
        //return false;
        $.ajax({
            type: "POST",
            data: datos,
            dataType: 'json',
            url: "resc_pass.php?ajax=true&validaciones=val_mail",
            success: function(r) {
                if (r.status) {
                    if (r.status == 1) {
                        alertify.alert('AVISO', 'Este username/correo contiene cuenta!');
                    }
                } else {
                    if (r.status == 0) {
                        alertify.set('notifier', 'position', 'bottom-right');
                        alertify.success('username/correo : no contiene ninguna cuenta!');
                        document.getElementById("mail").value = " ";
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

    function fntError1() {
        $('#exampleModal1').modal('show')
    }

    window.addEventListener('load', fntError1, false)
</script>
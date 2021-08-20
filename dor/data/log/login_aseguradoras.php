<?php
require_once "../../api/globalFunctions.php";
?>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<title>VisualMed.Online</title>
<link rel="icon" href="../../lib/dist/img/vmo_ICO.png" type="image/png" sizes="16x16">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<!-- Material Design Login Form -->
<ins class="adsbygoogle" style="display:inline-block;width:728px;height:90px" data-ad-client="ca-pub-5715866801509976" data-ad-slot="3213535644"></ins>
<script>
    (adsbygoogle = window.adsbygoogle || []).push({});
</script>

<hgroup>
    <img src="../../lib/dist/img/vmo_log_<?php echo $pais ?>.png" alt="logo" class="rounded mx-auto d-block" alt="Responsive image">
</hgroup>
<?php
require_once "../../api/globalFunctions.php";
require_once "../conexion/tmfAdm.php";
require_once "../../api/config.php";

$username = isset($_POST['username']) ? $_POST['username']  : '';
$password = isset($_POST['password']) ? $_POST['password']  : '';
$date = date("Y-m-d");
$hora = date("h:i:sa");
$usuario  = 'ase';
$variableStatus = "";
$variableUsr = "";

if (isset($_POST['username'])) {
    $rs = pg_query($rmfAdm, "SELECT COUNT(adm_usr_id) FROM web_users WHERE username='$username' AND adm_isr_med = 1 ");
    if ($row = pg_fetch_array($rs)) {
        $idRow = $row[0];
    }
    $variableUsr = isset($idRow) ? $idRow  : 0;
}
if ($variableUsr >= 1) {

    header('Location:login_resc.php?ur=' . $username);
} else {
    if (isset($_POST['username'])) {

        $rs = pg_query($rmfAdm, "SELECT username,adm_usr_tipo from web_users WHERE username='$username' and adm_usr_tipo='$usuario' ");
        if ($row = pg_fetch_array($rs)) {
            $idRow = trim($row[0]);
        }
        $variableCode = isset($idRow) ? $idRow  : 0;
        if ($variableCode) {
            if (isset($_POST['username'])) {

                $username = stripslashes($_REQUEST['username']);
                $username = pg_escape_string($rmfAdm, $username);
                $password = stripslashes($_REQUEST['password']);
                $password = pg_escape_string($rmfAdm, $password);

                $query = "SELECT * FROM web_users WHERE username='$username' and adm_usr_tipo='$usuario' and password ='" . md5($password) . "' AND status_actual = 1";
                $result = pg_query($rmfAdm, $query) or die(pg_last_error());
                $rows = pg_num_rows($result);
                if ($rows == 1) {
                    while ($rTMP = pg_fetch_assoc($result)) {
                        $_SESSION['logged'] = true;
                        $_SESSION['username'] = $rTMP['username'];
                        $_SESSION['mail'] = $rTMP['mail'];
                        $_SESSION['nombre_completo'] = $rTMP['nombre_completo'];
                        $_SESSION['adm_usr_id'] = $rTMP['adm_usr_id'];
                        $_SESSION['adm_usr_tipo'] = $rTMP['adm_usr_tipo'];
                        $_SESSION['adm_usr_code'] = $rTMP['adm_usr_code'];
                        $_SESSION['adm_usr_contrato'] = $rTMP['adm_usr_contrato'];
                        $_SESSION['remember_token'] = $rTMP['remember_token'];
                        $_SESSION['adm_date_ven'] = $rTMP['adm_date_ven'];
                        $_SESSION['status_actual'] = $rTMP['status_actual'];
                    }
                    $var_consulta = "INSERT INTO control_usuario (username, intentos, fecha,hora) VALUES ('$username',1,'$date','$hora')";
                    $val = 1;
                    if (pg_query($rmfAdm, $var_consulta)) {
                        $arrInfo['status'] = $val;
                    } else {
                        $arrInfo['status'] = 0;
                        $arrInfo['error'] = $var_consulta;
                    }

                    $var_consulta = pg_query($rmfAdm, "DELETE FROM control_usuario WHERE username = '$username' AND intentos = 2 AND fecha = '$date'");
                    $val = 1;
                    if (pg_query($rmfAdm, $var_consulta)) {
                        $arrInfo['status'] = $val;
                    } else {
                        $arrInfo['status'] = 0;
                        $arrInfo['error'] = $var_consulta;
                    }

                    //print_r($var_consulta);
                    print json_encode($arrInfo);

                    header('Location:../../app/insurers/index.php');
                } else {
                    $usuario = $_POST['username'];
                    $date = date("Y-m-d");
                    $hora = date("h:i:sa");

                    $var_consulta = "INSERT INTO control_usuario (username, intentos, fecha,hora) VALUES ('$username',2,'$date','$hora')";
                    $val = 1;
                    if (pg_query($rmfAdm, $var_consulta)) {
                        $arrInfo['status'] = $val;
                    } else {
                        $arrInfo['status'] = 0;
                        $arrInfo['error'] = $var_consulta;
                    }
                    //print_r($var_consulta);
                    print json_encode($arrInfo);

                    $rs = pg_query($rmfAdm, "SELECT COUNT(id) FROM control_usuario WHERE username = '$username' AND intentos = 2 AND fecha = '$date'");
                    if ($row = pg_fetch_array($rs)) {
                        $idRow = trim($row[0]);
                    }
                    $contador = isset($idRow) ? $idRow  : 0;

                    if ($contador >= 5) {
                        $usuario = $_POST['username'];

                        $var_consulta = "UPDATE web_users SET status_actual = 0 WHERE username  = '$username'";
                        $val = 1;
                        if (pg_query($rmfAdm, $var_consulta)) {
                            $arrInfo['status'] = $val;
                        } else {
                            $arrInfo['status'] = 0;
                            $arrInfo['error'] = $var_consulta;
                        }
                        //print_r($var_consulta);
                        print json_encode($arrInfo);

                        header('Location:login_aseguradoras.php?error=2');
                    } else {
                        $rs = pg_query($rmfAdm, "SELECT COUNT(adm_usr_id) FROM web_users WHERE username  = '$username' AND status_actual = 0");
                        if ($row = pg_fetch_array($rs)) {
                            $idRow = trim($row[0]);
                        }
                        $validar = isset($idRow) ? $idRow  : 0;
                        if ($validar) {
                            header('Location:login_aseguradoras.php?error=2');
                        } else {
                            $rs = pg_query($rmfAdm, "SELECT COUNT(id) from control_usuario WHERE username = '$username' AND intentos ='2' ");
                            if ($row = pg_fetch_array($rs)) {
                                $idRow = $row[0];
                            }
                            $intentos = isset($idRow) ? $idRow  : 0;

                            $_SESSION['intentos'] = $intentos;

                            header('Location:login_aseguradoras.php?error=1');
                        }
                    }
                }
            }
        } else {
            header('Location:login_aseguradoras.php?error=4');
        }
    }
}
?>
<div style="text-align:center;">
    <h2>ASEGURADORAS</h2>
</div>
<form action="" method="post" name="login">
    <?php
    $error = isset($_GET["error"]) ? $_GET["error"]  : '';
    $usr = isset($_GET["usr"]) ? $_GET["usr"]  : '';
    if ($usr == 1) {
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
                        <span>Solicitud Enviada / pendiente de autorizacion!</span> <br>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        <?php
    }
    if ($error == 1) {
        require_once "../conexion/tmfAdm.php";
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
                            <span>Datos de Ingreso no validos, intente de nuevo!</span> <br>
                            <span> Intentos realizados = <?php echo $_SESSION['intentos'] ?></span>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        <?php
    }
    if ($error == 2) {
        ?>
            <div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Alerta!</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <span>Su cuenta ha sido deshabilitada!
                            </span>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        <?php
    }
    if ($error == 3) {
        ?>
            <div class="modal fade" id="exampleModal3" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Alerta!</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <span>Comuniquese con el administrador del sistema!!</span><br><br>
                            <span>Su cuenta esta deshabilitada!</span><br>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        <?php
    }
    if ($error == 4) {
        ?>
            <div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Alerta!</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <span>Usuario no existe
                            </span>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        <?php
    }
    if ($error == 5) {
        ?>
            <div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Alerta!</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <span>Usuario pendiente de autorizacion!!
                            </span>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        <?php
    }
    if ($usr == 6) {
        ?>
            <div class="modal fade" id="exampleModal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Alerta!</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <span>Usuario creado /pendiente de autorizacion!!
                            </span>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        <?php
    }
    if (isset($_SESSION['usuario']) && $_SESSION['usuario'] != '') {
        header('Location:../../app/insurers/index.php');
    }
        ?>
        <div style="text-align:right;">
            <a href="../../index.php" class="btn btn-raised btn-danger">Regresar</a>
        </div>
        <div class="group">
            <input type="text" name="username" required><span class="highlight"></span><span class="bar"></span>
            <label>Nombre De Usuario</label>
        </div>
        <div class="group">
            <input type="password" name="password" required><span class="highlight"></span><span class="bar"></span>
            <label>Contraseña</label>
        </div>
        <div id="register-link" class="text-right">
            <a href="resc_pass.php?us=ase" class="text-info">Olvidaste tu Contraseña?</a>
        </div><br>
        <button name="submit" type="submit" class="button buttonBlue">Ingresar
            <div class="ripples buttonRipples"><span class="ripplesCircle"></span></div>
        </button>
        <div id="register-link" class="text-right">
            <?php
            //echo $RegAse;
            if ($RegAse == 1) { ?>
                <a href="register_aseguradoras.php" class="text-info">Crear usuario nuevo!</a>
            <?php
            } ?>
        </div><br>
        <div style="font-size:15px; text-align: center;color: #9B9B9B;">
        Sé parte de las Aseguradoras recomendadas para nuestros Pacientes. Si deseas formar parte de Visualmed escríbenos a <a href="mailto:gut.contacto@visualmed.online" title="Abre el administrador de correo electronico haciendo clic aqui">gut.contacto@visualmed.online</a> 
        </div>        
</form>
<?php


?>

<script>
    function fntError1() {
        $('#exampleModal1').modal('show')
    }

    function fntError2() {
        $('#exampleModal2').modal('show')
    }

    function fntError3() {
        $('#exampleModal3').modal('show')
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
        font-size: 18px;
        padding: 10px 10px 10px 5px;
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

    window.addEventListener('load', fntError1, false)
    window.addEventListener('load', fntError2, false)
    window.addEventListener('load', fntError3, false)
</script>
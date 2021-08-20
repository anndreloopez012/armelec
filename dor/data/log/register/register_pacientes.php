<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<title>VisualMed.Online</title>
<link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>

<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<!-- Material Design Login Form -->
<ins class="adsbygoogle"
     style="display:inline-block;width:728px;height:90px"
     data-ad-client="ca-pub-5715866801509976"
     data-ad-slot="3213535644"></ins>
<script>
(adsbygoogle = window.adsbygoogle || []).push({});
</script>

<hgroup>
  <h1>Registro De Usuarios</h1>
</hgroup>
<?php
    require_once "../../conexion/tmfAdm.php";
   
    if (isset($_REQUEST['username'])){
        $username = stripslashes($_REQUEST['username']); 
        $username = pg_escape_string($rmfAdm,$username); 
        $password = stripslashes($_REQUEST['password']);
        $password = pg_escape_string($rmfAdm,$password);
        $user = stripslashes($_REQUEST['user']);
        $user = pg_escape_string($rmfAdm,$user);
        

        $trn_date = date("Y-m-d H:i:s");
        $query = "INSERT into ctg_pacientes (username, password, adm_usr_tipo) 
                        VALUES ('$username', '".md5($password)."','$user')";
        $result = pg_query($rmfAdm,$query);

        //require_once "../../log/newTables/pacientes.php";

        if($result){
            header('Location:../login_pacientes.php');
        }
    }else{
?>
<form  name="registration" action="" method="post">
    <div class="group">
        <input type="text" name="user" required><span class="highlight"></span><span class="bar"></span>
        <label>Tipo De Usuario</label>
    </div>
    <div class="group">
        <input type="text" name="username" required><span class="highlight"></span><span class="bar"></span>
        <label>Nombre De Usuario</label>
    </div>
    <div class="group">
        <input type="password" name="password" required><span class="highlight"></span><span class="bar"></span>
        <label>Contraseña</label>
    </div>
    <button  type="submit" name="submit" value="Register" class="button buttonBlue">Registrar
    <div class="ripples buttonRipples"><span class="ripplesCircle"></span></div>
  </button>
</form>

<?php 
}
?>


<style type="text/css">
        * { box-sizing:border-box; }

    body {
        font-family: Helvetica;
        background: #eee;
    -webkit-font-smoothing: antialiased;
    }

    hgroup { 
        text-align:center;
        margin-top: 4em;
    }

    h1, h3 { font-weight: 300; }

    h1 { color: #636363; }

    h3 { color: #4a89dc; }

    form {
        width: 380px;
        margin: 4em auto;
        padding: 3em 2em 2em 2em;
        background: #fafafa;
        border: 1px solid #ebebeb;
        box-shadow: rgba(0,0,0,0.14902) 0px 1px 1px 0px,rgba(0,0,0,0.09804) 0px 1px 2px 0px;
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

    input:focus { outline: none; }


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

    input:focus ~ label, input.used ~ label {
        top: -20px;
    transform: scale(.75); left: -2px;
        /* font-size: 14px; */
        color: #4a89dc;
    }


    /* Underline */

    .bar {
        position: relative;
        display: block;
        width: 100%;
    }

    .bar:before, .bar:after {
        content: '';
        height: 2px; 
        width: 0;
        bottom: 1px; 
        position: absolute;
        background: #4a89dc; 
        transition: all 0.2s ease;
    }

    .bar:before { left: 50%; }

    .bar:after { right: 50%; }


    /* active */

    input:focus ~ .bar:before, input:focus ~ .bar:after { width: 50%; }


    /* Highlight */

    .highlight {
        position: absolute;
        height: 60%; 
        width: 100px; 
        top: 25%; 
        left: 0;
        pointer-events: none;
        opacity: 0.5;
    }


    /* active */

    input:focus ~ .highlight {
        animation: inputHighlighter 0.3s ease;
    }


    /* Animations */

    @keyframes inputHighlighter {
        from { background: #4a89dc; }
        to 	{ width: 0; background: transparent; }
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
    .button:focus { outline: 0; }


    /* Button modifiers */

    .buttonBlue {
    background: #4a89dc;
    text-shadow: 1px 1px 0 rgba(39, 110, 204, .5);
    }

    .buttonBlue:hover { background: #357bd8; }


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
    0% { opacity: 0; }

    25% { opacity: 1; }

    100% {
        width: 200%;
        padding-bottom: 200%;
        opacity: 0;
    }
    }

    footer { text-align: center; }

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

    footer img:hover { opacity: .83; }

    footer img:focus , footer a:focus { outline: none; }
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
                 
    
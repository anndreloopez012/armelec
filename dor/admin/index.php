<?php
    if(isset($_SESSION['tiempo']) ) {
        $inactivo = 30;
        $vida_session = time() - $_SESSION['tiempo'];

            if($vida_session > $inactivo)
            {
                session_unset();
                session_destroy();              
                header("Location:irims_adm/index.php");
                exit();
            }
    }
    $_SESSION['tiempo'] = time();
?>
<?php
    //SESSION
    require_once 'interbase/auth.php';
    
    $logout = '../irims_adm/interbase/logout.php';

    $title = "VisualMed.online";
    
    require_once '../api/globalFunctions.php';

    require_once '../data/conexion/tmfAdm.php';
    
    require_once 'dependenciasHead.php';
    
    require_once 'api/home/amdHome.php';

    require_once 'layout/home/nav.php';

    require_once 'layout/home/menu.php';

    require_once 'layout/home/homeComponent.php';
    
    require_once 'dependenciasFooter.php';

?>

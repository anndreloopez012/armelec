<?php
    require_once '../../interbase/auth.php';
    $logout = '../../../data/log/logout.php';
    require_once '../../interbase/timeLog.php';

    //btn nav
    $user = $_SESSION['username'];
    $home = '../../index.php';
    $back = '../../index.php';

    $menu = 2;
    $title = ' FARMACIAS / SOLICITUDES DE USUARIO';
     
    require_once '../../../api/globalFunctions.php';

    require_once '../../../data/conexion/tmfAdm.php';

    require_once '../../../api/config.php';

    require_once '../../api/farmacias/adm_sol_usuario_new.php';

    require_once '../dependenciasHead.php';
    
    require_once '../../api/admMenu.php';

    require_once '../../api/farmacias/adm_sol_usuario_newAJAX.php';

    require_once '../../layout/nav.php';

    //require_once '../../layout/menu.php';

    require_once '../../layout/farmacias/sol_usuario_newComponent.php';
    
    require_once '../dependenciasFooter.php';

?>

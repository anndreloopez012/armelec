<?php
    require_once '../../interbase/auth.php';
    $logout = '../../../data/log/logout.php';
    require_once '../../interbase/timeLog.php';

    //btn nav
    $user = $_SESSION['username'];
    $home = '../../index.php';
    $back = '../../index.php';
 
    $menu = 8;
    $title = 'ADMIN EMPRESAS DE CREDITO';

    require_once '../../../api/globalFunctions.php';

    require_once '../../../data/conexion/tmfAdm.php';
     
    require_once '../dependenciasHead.php';
    
    require_once '../../api/admMenu.php';

    require_once '../../api/empresas/admEmpresas.php';

    require_once '../../layout/nav.php';

    //require_once '../../layout/menu.php';

    require_once '../../layout/empresas/empresasComponent.php';
    
    require_once '../dependenciasFooter.php';

?>

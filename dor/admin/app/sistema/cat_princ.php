<?php
    require_once '../../interbase/auth.php';
    $logout = '../../../data/log/logout.php';
    require_once '../../interbase/timeLog.php';

    //btn nav
    $user = $_SESSION['username'];
    $home = '../../index.php';
    $back = '../../index.php';

    $menu = 13;
    $title = 'ADMIN SISTEMA / CATALOGOS DE PRINCIPIOS ACTIVOS';
     
    require_once '../../../api/globalFunctions.php';

    require_once '../../../data/conexion/tmfAdm.php';

    require_once '../../../api/config.php';

    require_once '../../api/sistema/adm_cat_princ.php';

    require_once '../dependenciasHead.php';
    
    require_once '../../api/admMenu.php';

    require_once '../../api/sistema/adm_cat_princAJAX.php';

    require_once '../../layout/nav.php';

    //require_once '../../layout/menu.php';

    require_once '../../layout/sistema/cat_princComponent.php';
    
    require_once '../dependenciasFooter.php';

?>
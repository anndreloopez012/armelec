<?php
    require_once '../../interbase/auth.php';
    $logout = '../../../data/log/logout.php';
    require_once '../../interbase/timeLog.php';

    //btn nav
    $user = $_SESSION['username'];
    $home = '../../index.php';
    $back = '../../index.php';

    $menu = 6;
    $title = 'ADMIN LABORATORIOS CLINICOS';

    require_once '../../../api/globalFunctions.php';

    require_once '../../../data/conexion/tmfAdm.php';
     
    require_once '../dependenciasHead.php';
    
    require_once '../../api/admMenu.php';

    require_once '../../api/labclinicos/admLabClinicos.php';

    require_once '../../layout/nav.php';

    //require_once '../../layout/menu.php';

    require_once '../../layout/labclinicos/labClinicosComponent.php';
    
    require_once '../dependenciasFooter.php';

?>

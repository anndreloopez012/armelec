<?php
    require_once '../../interbase/auth.php';
    $logout = '../../../data/log/logout.php';
    require_once '../../interbase/timeLog.php';

    //btn nav
    $user = $_SESSION['username'];
    $home = '../../index.php';
    $back = '../../index.php';

    $menu = 13;
    $title = 'ADMIN SISTEMA / CREAR USUARIO LABORATORIO FARMACEUTICO';
     
    require_once '../../../api/globalFunctions.php';

    require_once '../../../data/conexion/tmfAdm.php';

    require_once '../../../api/config.php';

    require_once '../../api/sistema/adm_usr_perfil_laf.PHP';

    require_once '../dependenciasHead.php';
    
    require_once '../../api/admMenu.php';

    require_once '../../api/sistema/adm_usr_perfil_lafAJAX.php';

    require_once '../../layout/nav.php';

    //require_once '../../layout/menu.php';

    require_once '../../layout/sistema/usr_perfil_lafComponent.php';
    
    require_once '../dependenciasFooter.php';

?>

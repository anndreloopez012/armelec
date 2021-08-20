<?php
    require_once '../../interbase/auth.php';
    $logout = '../../../data/log/logout.php';
    require_once '../../interbase/timeLog.php';

    //btn nav
    $user = $_SESSION['username'];
    $home = '../../index.php';
    $back = '../../index.php';

    $menu = 7;
    $title = 'ADMIN SISTEMA / CATALOGOS CONTRATO DE HOSPITALES';
     
    require_once '../../../api/globalFunctions.php';

    require_once '../../../data/conexion/tmfAdm.php';

    require_once '../../../api/config.php';

    require_once '../../api/hospitales/adm_cat_contract.php';

    require_once '../dependenciasHead.php';
    
    require_once '../../api/admMenu.php';

    require_once '../../api/hospitales/adm_cat_contractAJAX.php';

    require_once '../../layout/nav.php';

    //require_once '../../layout/menu.php';

    require_once '../../layout/hospitales/cat_contractComponent.php';
    
    require_once '../dependenciasFooter.php';

?>

<?php
/////////////////////////////////////////////////////////////
///////////////////CUENTA NUEVA//////////////////////
//////////////////////////////////////////////////////////////

if(isset($_SESSION['adm_date_ven']) ) {

        $date_session = $_SESSION['adm_date_ven'];
        $date = date("Y-m-d"); 

        if($date_session < $date)
        {
            session_unset();
            session_destroy();              
            header("Location:../../membershipDate.html");
            exit();
        }
}

/////////////////////////////////////////////////////////////
///////////////////TIEMPO/////////////////////////////////////
//////////////////////////////////////////////////////////////

    if(isset($_SESSION['tiempo']) ) {
        $inactivo = 60*60;
        $vida_session = time() - $_SESSION['tiempo'];

            if($vida_session > $inactivo)
            {
                session_unset();
                session_destroy();              
                header("Location:../../pre_log.php");
                exit();
            }
    }
    $_SESSION['tiempo'] = time();

/////////////////////////////////////////////////////////////
///////////////////BLOQUEADO/////////////////////////////////////
//////////////////////////////////////////////////////////////

if(isset($_SESSION['status_actual']) ) {

    $status_session = $_SESSION['status_actual'];

    if($status_session == 4)
    {
        session_unset();
        session_destroy();              
        header("Location:../../disabled.html");
        exit();
    }
}
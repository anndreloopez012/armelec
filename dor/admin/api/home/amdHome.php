

<?php 

    $arrModulo= array();
    $var_consulta= "SELECT modulos.*
                    FROM adm_modulos_l modulos
                    WHERE modulos.adm_status = 1
                    ORDER BY modulos.adm_order";

    $qTMP = pg_query($rmfAdm, $var_consulta);
   // print_r($var_consulta);
    while ( $rTMP = pg_fetch_assoc($qTMP) ){

        $arrModulo  [$rTMP["id"]]   ["id"]               = $rTMP["id"]; 
        $arrModulo  [$rTMP["id"]]   ["adm_name"]             = $rTMP["adm_name"]; 
        $arrModulo  [$rTMP["id"]]   ["adm_btn"]              = $rTMP["adm_btn"]; 
        $arrModulo  [$rTMP["id"]]   ["adm_rtu"]               = $rTMP["adm_rtu"]; 
    }
    pg_free_result($qTMP);
?>
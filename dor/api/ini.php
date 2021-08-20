<?php 

    $arrNation= array();
    $var_consulta= "SELECT * FROM ctg_geografia where geo_parent = 0 ORDER BY id ";

    $qTMP = pg_query($tmfWeb, $var_consulta);
    while ( $rTMP = pg_fetch_assoc($qTMP) ){
        $arrNation  [$rTMP["id"]]   ["id"]                               = $rTMP["id"]; 
        $arrNation  [$rTMP["id"]]   ["geo_desc"]                         = $rTMP["geo_desc"]; 
        $arrNation  [$rTMP["id"]]   ["geo_obs"]                          = $rTMP["geo_obs"]; 
    }
    pg_free_result($qTMP);
?>
<?php 
require_once '../../../api/globalFunctions.php';

require_once '../../../data/conexion/tmfAdm.php';

require_once '../../../api/config.php';

    $arrModulo= array();
    $var_consulta= "SELECT  content.id contenido_id,
                            content.adm_nombre_menu contenido_nombre,
                            content.adm_btn contenido_btn,
                            content.adm_link contenido_link,
                            content.adm_order ,
                            
                            acceso.id acceso_id,
                            acceso.adm_order adm_order,
                            acceso.adm_name  acceso_nombre,
                            acceso.adm_btn acceso_btn,
                            acceso.adm_link acceso_link,
                            acceso.adm_acceso_pertenece acceso_pertenece
                        FROM adm_modulos_ll content
                        LEFT JOIN adm_modulos_lll acceso
                        ON content.id = acceso.id_modulo_ll 
                        WHERE content.adm_contenido = $menu 
                        ORDER BY acceso.adm_order";
                    
    //print $var_consulta;
    $qTMP = pg_query($rmfAdm, $var_consulta);
    while ( $rTMP = pg_fetch_assoc($qTMP) ){
        $arrModulo  [$rTMP["contenido_id"]]["id"] = $rTMP["contenido_id"]; 
        $arrModulo  [$rTMP["contenido_id"]]["nombre"] = $rTMP["contenido_nombre"]; 
        $arrModulo  [$rTMP["contenido_id"]]["btn"]  = $rTMP["contenido_btn"]; 
        $arrModulo  [$rTMP["contenido_id"]]["link"] = $rTMP["contenido_link"]; 
                                                
        if( isset( $rTMP['acceso_id']  ) && intval( $rTMP['acceso_id']  ) > 0  ){
    
            if( isset($rTMP['acceso_pertenece']) && intval( $rTMP['acceso_pertenece'] ) > 0  ){
                if ( isset($arrModulo[$rTMP['contenido_id']]['accesos'][ $rTMP['acceso_pertenece'] ]) ){
                    $arrModulo  [$rTMP['contenido_id']]['accesos'][ $rTMP['acceso_pertenece'] ]['hijos'][ $rTMP['acceso_id'] ] ['nombre']        = $rTMP['acceso_nombre'];
                    $arrModulo  [$rTMP['contenido_id']]['accesos'][ $rTMP['acceso_pertenece'] ]['hijos'][ $rTMP['acceso_id'] ]['btn']        = $rTMP['acceso_btn'];
                    $arrModulo  [$rTMP['contenido_id']]['accesos'][ $rTMP['acceso_pertenece'] ]['hijos'][ $rTMP['acceso_id'] ]['link']        = $rTMP['acceso_link'];
            
                }              
            }
            else{
                $arrModulo  [$rTMP['contenido_id']]['accesos'][ $rTMP['acceso_id'] ]['nombre']        = $rTMP['acceso_nombre'];
                $arrModulo  [$rTMP['contenido_id']]['accesos'][ $rTMP['acceso_id'] ]['btn']        = $rTMP['acceso_btn'];
                $arrModulo  [$rTMP['contenido_id']]['accesos'][ $rTMP['acceso_id'] ]['link']        = $rTMP['acceso_link'];
            
            }
        }

    }
    //print_r($arrModulo);
    pg_free_result($qTMP);
?>


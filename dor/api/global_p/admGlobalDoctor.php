<?php
if (isset($_GET["validaciones"]) && !empty($_GET["validaciones"])) {
    require_once "../../data/conexion/tmfAdm.php";
    $usuario =  $_SESSION['adm_usr_code'];

    //TABLA DE INTERACCION
    $idUser = $_SESSION['adm_usr_code'];
    $tablaVacunas = "med" . $idUser . "vacunas";

    $insert = 1;
    $update = 2;
    $delete = 3;

    $med_vac_nom_ = isset($_POST["nombre"]) ? $_POST["nombre"]  : '';
    $med_vac_des_ = isset($_POST["descripcion"]) ? $_POST["descripcion"]  : '';

    $status = 1;
    $fechaIng = date('Y-m-d H:i:s');

    $strTipoValidacion = isset($_REQUEST["validaciones"]) ? $_REQUEST["validaciones"] : '';
    //DIBUJO DE TABLA PRODUCTOS CATEGORIAS
     if ($strTipoValidacion == "busqueda_table") {
        $strSearch = isset($_POST["Search"]) ? $_POST["Search"]  : '';

        $strFilter = "";
        if (!empty($strSearch)) {
            $strFilter = " WHERE ( UPPER(ctg_med_nombres) LIKE UPPER('%{$strSearch}%' )) ";
        }

        $arrTableDoctor= array();
        $var_consulta= "SELECT * 
                        FROM ctg_medicos medic
                        INNER JOIN ctg_especialidades as esp
                        ON medic.ctg_med_esp = esp.ctg_esp_cod
                        ORDER BY medic.id  ";
        $sql = pg_query($rmfAdm, $var_consulta);
        $totalArticle = pg_num_rows($sql);
        
    
        while ( $rTMP = pg_fetch_assoc($sql) ){
    
            $arrTableDoctor  [$rTMP["ctg_med_col"]]   ["id"]                       = $rTMP["id"];       
            $arrTableDoctor  [$rTMP["ctg_med_col"]]   ["ctg_med_col"]              = $rTMP["ctg_med_col"];  
            $arrTableDoctor  [$rTMP["ctg_med_col"]]   ["ctg_med_dpi"]              = $rTMP["ctg_med_dpi"];  
            $arrTableDoctor  [$rTMP["ctg_med_col"]]   ["ctg_med_code"]             = $rTMP["ctg_med_code"];  
            $arrTableDoctor  [$rTMP["ctg_med_col"]]   ["ctg_med_nombres"]          = $rTMP["ctg_med_nombres"];  
            $arrTableDoctor  [$rTMP["ctg_med_col"]]   ["ctg_med_apellidos"]        = $rTMP["ctg_med_apellidos"];  
            $arrTableDoctor  [$rTMP["ctg_med_col"]]   ["ctg_med_esp"]              = $rTMP["ctg_med_esp"];  
            $arrTableDoctor  [$rTMP["ctg_med_col"]]   ["ctg_med_espotr"]           = $rTMP["ctg_med_espotr"];  
            $arrTableDoctor  [$rTMP["ctg_med_col"]]   ["ctg_med_sexo"]             = $rTMP["ctg_med_sexo"];  
            $arrTableDoctor  [$rTMP["ctg_med_col"]]   ["ctg_med_civil"]            = $rTMP["ctg_med_civil"];  
            $arrTableDoctor  [$rTMP["ctg_med_col"]]   ["ctg_med_nac_dia"]          = $rTMP["ctg_med_nac_dia"];  
            $arrTableDoctor  [$rTMP["ctg_med_col"]]   ["ctg_med_nac_mes"]          = $rTMP["ctg_med_nac_mes"];  
            $arrTableDoctor  [$rTMP["ctg_med_col"]]   ["ctg_med_nac_ano"]          = $rTMP["ctg_med_nac_ano"];  
            $arrTableDoctor  [$rTMP["ctg_med_col"]]   ["ctg_med_dir"]              = $rTMP["ctg_med_dir"];  
            $arrTableDoctor  [$rTMP["ctg_med_col"]]   ["ctg_med_zona"]             = $rTMP["ctg_med_zona"];  
            $arrTableDoctor  [$rTMP["ctg_med_col"]]   ["ctg_med_dep"]              = $rTMP["ctg_med_dep"];  
            $arrTableDoctor  [$rTMP["ctg_med_col"]]   ["ctg_med_mun"]              = $rTMP["ctg_med_mun"];  
            $arrTableDoctor  [$rTMP["ctg_med_col"]]   ["ctg_med_telcel"]           = $rTMP["ctg_med_telcel"];  
            $arrTableDoctor  [$rTMP["ctg_med_col"]]   ["ctg_med_telpar"]           = $rTMP["ctg_med_telpar"];  
            $arrTableDoctor  [$rTMP["ctg_med_col"]]   ["ctg_med_email"]            = $rTMP["ctg_med_email"];  
            $arrTableDoctor  [$rTMP["ctg_med_col"]]   ["ctg_med_val_con"]          = $rTMP["ctg_med_val_con"];  
            $arrTableDoctor  [$rTMP["ctg_med_col"]]   ["ctg_med_sol_dt"]           = $rTMP["ctg_med_sol_dt"];  
            $arrTableDoctor  [$rTMP["ctg_med_col"]]   ["ctg_med_aut_dt"]           = $rTMP["ctg_med_aut_dt"];  
            $arrTableDoctor  [$rTMP["ctg_med_col"]]   ["ctg_med_ven_dt"]           = $rTMP["ctg_med_ven_dt"];  
            $arrTableDoctor  [$rTMP["ctg_med_col"]]   ["ctg_med_pass"]             = $rTMP["ctg_med_pass"];  
            $arrTableDoctor  [$rTMP["ctg_med_col"]]   ["ctg_med_username"]         = $rTMP["ctg_med_username"];  
            $arrTableDoctor  [$rTMP["ctg_med_col"]]   ["ctg_med_estatus"]          = $rTMP["ctg_med_estatus"];  
            $arrTableDoctor  [$rTMP["ctg_med_col"]]   ["ctg_med_infpro"]           = $rTMP["ctg_med_infpro"];  
            $arrTableDoctor  [$rTMP["ctg_med_col"]]   ["ctg_med_sta"]              = $rTMP["ctg_med_sta"];  
            $arrTableDoctor  [$rTMP["ctg_med_col"]]   ["ctg_med_dt"]               = $rTMP["ctg_med_dt"];  
            $arrTableDoctor  [$rTMP["ctg_med_col"]]   ["ctg_med_usr"]              = $rTMP["ctg_med_usr"];  
            $arrTableDoctor  [$rTMP["ctg_med_col"]]   ["ctg_esp_desc"]             = $rTMP["ctg_esp_desc"];  
       
        }
        pg_free_result($sql);

    ?>
        <div class="col-md-12 tableFixHead">
        <table id="tableFarmac" class="table table-bordered table-striped table-hover table-sm">
                            <thead>
                            <tr  class="table-info">
                                <th>Nombre</th>
                                <th>Especialidad</th>
                                <th>Direccion</th>
                                <th>Telefono</th>
                            </tr>
                            </thead>
                            <tbody>
                                <?php
                                    if ( is_array($arrTableDoctor) && ( count($arrTableDoctor)>0 ) ){
                                        reset($arrTableDoctor);
                                    foreach( $arrTableDoctor as $rTMP['key'] => $rTMP['value'] ){
                                ?> 
                                    <tr>
                                        <td><?php echo  $rTMP["value"]['ctg_med_nombres'].' '. $rTMP["value"]['ctg_med_apellidos'];?></td>
                                        <td><?php echo  $rTMP["value"]['ctg_esp_desc']; ?></td>
                                        <td><?php echo  $rTMP["value"]['ctg_med_dir']; ?></td>
                                        <td><?php echo  $rTMP["value"]['ctg_med_telpar']; ?></td>
                                    </tr>
                                <?PHP
                                    }
                                        }
                                ?>     
                            </tbody>
                        </table>
        </div>
    <?php
        die();
    }

    die();
}


?>

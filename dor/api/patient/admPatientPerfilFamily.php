<?php
if (isset($_GET["validaciones"]) && !empty($_GET["validaciones"])) {
    require_once "../../data/conexion/tmfAdm.php";
    $usuario = $_SESSION['adm_usr_code'];

    //TABLA DE INTERACCION
    $idUser = $_SESSION['adm_usr_code'];

    $id = isset($_POST["id"]) ? $_POST["id"]  : '';
    $ctg_paf_nac_full = isset($_POST["Fecha"]) ? trim($_POST["Fecha"])  : 0000 - 00 - 00;
    $ctg_paf_dpi = isset($_POST["DPI"]) ? $_POST["DPI"]  : '';
    $ctg_paf_nombres = isset($_POST["Nombres"]) ? $_POST["Nombres"]  : '';
    $ctg_paf_apellidos = isset($_POST["Apellidos"]) ? $_POST["Apellidos"]  : '';
    $ctg_pef_sexo = isset($_POST["sexo"]) ? $_POST["sexo"]  : '';
    $ctg_paf_peso = isset($_POST["Peso"]) ? $_POST["Peso"]  : '';
    $ctg_paf_esta = isset($_POST["Estatura"]) ? $_POST["Estatura"]  : '';
    $ctg_paf_rel_id = isset($_POST["relacion"]) ? $_POST["relacion"]  : '';
    $ctg_paf_tpsa = 1;

    $status = 1;
    $fechaIng = date('Y-m-d H:i:s');


    $val = 1;
    $strTipoValidacion = isset($_REQUEST["validaciones"]) ? $_REQUEST["validaciones"] : '';
    if ($strTipoValidacion == "insert") {
        header('Content-Type: application/json');
        $var_consulta = "INSERT INTO ctg_pacientes_familiar(ctg_paf_code,ctg_paf_rel_id,ctg_paf_dpi,ctg_paf_nombres,ctg_paf_apellidos,ctg_pef_sexo,ctg_paf_peso,ctg_paf_esta,ctg_paf_tpsa,ctg_paf_sta,ctg_paf_dt,ctg_paf_usr,ctg_paf_nac_full)VALUES ('$usuario','$ctg_paf_rel_id','$ctg_paf_dpi','$ctg_paf_nombres','$ctg_paf_apellidos',$ctg_pef_sexo,'$ctg_paf_peso','$ctg_paf_esta',$ctg_paf_tpsa,'$status','$fechaIng','$usuario','$ctg_paf_nac_full');";
        $val = 1;
        if (pg_query($rmfAdm, $var_consulta)) {
            $arrInfo['status'] = $val;
        } else {
            $arrInfo['status'] = 0;
            $arrInfo['error'] = $var_consulta;
        }
        print json_encode($arrInfo);
        die();
    }  else if ($strTipoValidacion == "delete") {
        header('Content-Type: application/json');
        $var_consulta = "DELETE FROM ctg_pacientes_familiar WHERE id = $id;";
        if (pg_query($rmfAdm, $var_consulta)) {
            $arrInfo['status'] = $val;
        } else {
            $arrInfo['status'] = 0;
            $arrInfo['error'] = $var_consulta;
        }
        print json_encode($arrInfo);
        die();
    }
    //DIBUJO DE TABLA PRODUCTOS CATEGORIAS
    else if ($strTipoValidacion == "busqueda_table") {
        $strSearch = isset($_POST["Search"]) ? $_POST["Search"]  : '';

        $strFilter = "";
        if (!empty($strSearch)) {
            $strFilter = " AND ( UPPER(ctg_paf_nombres) LIKE UPPER('%{$strSearch}%') ) ";
        }
        $arrTableFamlia = array();
        $var_consulta = "SELECT to_char(ctg_paf_nac_full::date,'DD-MM-YYYY') fecha,* FROM ctg_pacientes_familiar WHERE ctg_paf_code = $usuario ORDER BY ctg_paf_nombres ";
        $sql = pg_query($rmfAdm, $var_consulta);
        $totalArticle = pg_num_rows($sql);


        while ($rTMP = pg_fetch_assoc($sql)) {

            $arrTableFamlia[$rTMP["id"]]["id"]                       = $rTMP["id"];
            $arrTableFamlia[$rTMP["id"]]["ctg_paf_code"]                       = $rTMP["ctg_paf_code"] ;
            $arrTableFamlia[$rTMP["id"]]["ctg_paf_rel_id"]                       = $rTMP["ctg_paf_rel_id"] ;
            $arrTableFamlia[$rTMP["id"]]["ctg_paf_dpi"]                       = $rTMP["ctg_paf_dpi"] ;
            $arrTableFamlia[$rTMP["id"]]["ctg_paf_nombres"]                       = $rTMP["ctg_paf_nombres"] ;
            $arrTableFamlia[$rTMP["id"]]["ctg_paf_apellidos"]                       = $rTMP["ctg_paf_apellidos"] ;
            $arrTableFamlia[$rTMP["id"]]["ctg_pef_sexo"]                       = $rTMP["ctg_pef_sexo"] ;
            $arrTableFamlia[$rTMP["id"]]["ctg_paf_peso"]                       = $rTMP["ctg_paf_peso"] ;
            $arrTableFamlia[$rTMP["id"]]["ctg_paf_esta"]                       = $rTMP["ctg_paf_esta"] ;
            $arrTableFamlia[$rTMP["id"]]["ctg_paf_tpsa"]                       = $rTMP["ctg_paf_tpsa"] ;
            $arrTableFamlia[$rTMP["id"]]["ctg_paf_sta"]                       = $rTMP["ctg_paf_sta"] ;
            $arrTableFamlia[$rTMP["id"]]["ctg_paf_dt"]                       = $rTMP["ctg_paf_dt"] ;
            $arrTableFamlia[$rTMP["id"]]["ctg_paf_usr"]                       = $rTMP["ctg_paf_usr"] ;
            $arrTableFamlia[$rTMP["id"]]["fecha"]                       = $rTMP["fecha"] ;
            
        }
        pg_free_result($sql);

    ?>
        <div class="col-md-12 tableFixHead">
            <table id="tablePatient" class="table table-bordered table-striped table-hover table-sm">
                <thead>
                    <tr class="table-info">
                        <th width="10%">No. De Identificacion</th>
                        <th>Nombre</th>
                        <th width="10%">Relacion</th>
                        <th width="10%">Fecha de nacimiento</th>
                        <th width="5%">Eliminar</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (is_array($arrTableFamlia) && (count($arrTableFamlia) > 0)) {
                        $intContador = 1;
                        reset($arrTableFamlia);
                        foreach ($arrTableFamlia as $rTMP['key'] => $rTMP['value']) {
                    ?>
                            <tr>
                                <td><?php echo  $rTMP["value"]['ctg_paf_dpi']; ?></td>
                                <td><?php echo  $rTMP["value"]['ctg_paf_nombres']." ";  ?><?php echo  $rTMP["value"]['ctg_paf_apellidos'];  ?></td>
                                <td>

                                    <?php if($rTMP["value"]['ctg_paf_rel_id'] == 1){?>
                                        Hijo/a
                                    <?php }  ?>
                                    <?php if($rTMP["value"]['ctg_paf_rel_id'] == 2){?>
                                        Esposo/a
                                    <?php }  ?>
                                    <?php if($rTMP["value"]['ctg_paf_rel_id'] == 3){?>
                                        Sobrino/a
                                    <?php }  ?>
                                    <?php if($rTMP["value"]['ctg_paf_rel_id'] == 4){?>
                                        Suegro/a
                                    <?php }  ?>
                                    <?php if($rTMP["value"]['ctg_paf_rel_id'] == 5){?>
                                        Primo/a
                                    <?php }  ?>
                                
                                </td>
                                <td><?php echo  $rTMP["value"]['fecha']; ?></td>
                                <td><a  style="cursor:pointer;" onclick="fntSelectDelete('<?php print $intContador; ?>');"><i class="fad fa-user-minus"></i></a></td>
                                <input type="hidden" name="hidId_<?php print $intContador; ?>" id="hidId_<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['id']; ?>">
                            </tr>
                    <?PHP
                            $intContador++;
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
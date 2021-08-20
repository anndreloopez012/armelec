<?php
if (isset($_GET["validaciones"]) && !empty($_GET["validaciones"])) {
    require_once "../../data/conexion/tmlMed.php";
    require_once "../../data/conexion/tmfPac.php";
    $usuario = $_SESSION['adm_usr_code'];

    //TABLA DE INTERACCION
    $idUser =  $_SESSION['adm_usr_code'];
    $tablaCitas = "med" . $idUser . "citas";

    $insert = 1;
    $update = 2;
    $delete = 3;

    $id = isset($_POST["id"]) ? $_POST["id"]  : '';
    $med_cit_id = isset($_POST["id"]) ? $_POST["id"]  : '';
    $med_cit_cita_dt = isset($_POST["Fecha"]) ? trim($_POST["Fecha"])  : 0000 - 00 - 00;
    $med_cit_pac = isset($_POST["NombresId"]) ? $_POST["NombresId"]  : '';
    $med_cit_motivo = isset($_POST["Motivo"]) ? $_POST["Motivo"]  : '';
    $med_cit_estatus = isset($_POST["Estado"]) ? $_POST["Estado"]  : '';

    $status = 1;
    $fechaIng = date('Y-m-d H:i:s');

    $rs = pg_query($tmfMed,"SELECT id FROM $tablaCitas ORDER BY id DESC LIMIT 1");
    if ($row = pg_fetch_row($rs)) {
        $idRow = trim($row[0]);
    }
    $idMax = isset($idRow) ? $idRow  : 0;

    $idMax = $idMax + 1;
    $val = 1;
    $strTipoValidacion = isset($_REQUEST["validaciones"]) ? $_REQUEST["validaciones"] : '';
    if ($strTipoValidacion == "insert") {
        header('Content-Type: application/json');
        $var_consulta = "INSERT INTO $tablaCitas(med_cit_id,med_cit_cita_dt,med_cit_pac_id,med_cit_motivo,med_cit_estatus,med_cit_sta,med_cit_dt,med_cit_usr,id) VALUES ($idMax,'$med_cit_cita_dt','$med_cit_pac','$med_cit_motivo','$med_cit_estatus','$status','$fechaIng','$usuario',$idMax);";
        $val = 1;
        if (pg_query($tmfMed, $var_consulta)) {
            $arrInfo['status'] = $val;
        } else {
            $arrInfo['status'] = 0;
            $arrInfo['error'] = $var_consulta;
        }

        $var_consulta = "INSERT INTO $tablaCitas(med_cit_id,med_cit_cita_dt,med_cit_pac_id,med_cit_motivo,med_cit_estatus,med_cit_sta,med_cit_dt,med_cit_usr,id) VALUES ($idMax,'$med_cit_cita_dt','$med_cit_pac','$med_cit_motivo','$med_cit_estatus','$status','$fechaIng','$usuario',$idMax);";
        $val = 1;
        if (pg_query($tmfPac, $var_consulta)) {
            $arrInfo['status'] = $val;
        } else {
            $arrInfo['status'] = 0;
            $arrInfo['error'] = $var_consulta;
        }
        print json_encode($arrInfo);
        die();
    } else if ($strTipoValidacion == "update") {
        header('Content-Type: application/json');
        $var_consulta = " UPDATE $tablaCitas SET med_cit_id = $med_cit_id,med_cit_cita_dt = '$med_cit_cita_dt',med_cit_pac_id = '$med_cit_pac',med_cit_motivo = '$med_cit_motivo',med_cit_estatus = '$med_cit_estatus',med_cit_sta = '$status',med_cit_dt = '$fechaIng',med_cit_usr = '$usuario' WHERE id = $id;";
        if (pg_query($tmfMed, $var_consulta)) {
            $arrInfo['status'] = $val;
        } else {
            $arrInfo['status'] = 0;
            $arrInfo['error'] = $var_consulta;
        }

        $var_consulta = "UPDATE $tablaCitas SET med_cit_id = $med_cit_id,med_cit_cita_dt = '$med_cit_cita_dt',med_cit_pac_id = '$med_cit_pac',med_cit_motivo = '$med_cit_motivo',med_cit_estatus = '$med_cit_estatus',med_cit_sta = '$status',med_cit_dt = '$fechaIng',med_cit_usr = '$usuario' WHERE id = $id;";
        if (pg_query($tmfPac, $var_consulta)) {
            $arrInfo['status'] = $val;
        } else {
            $arrInfo['status'] = 0;
            $arrInfo['error'] = $var_consulta;
        }
        print json_encode($arrInfo);
        die();
    } else if ($strTipoValidacion == "delete") {
        header('Content-Type: application/json');
        $var_consulta = "DELETE FROM $tablaCitas WHERE id = $id;";
        if (pg_query($tmfMed, $var_consulta)) {
            $arrInfo['status'] = $val;
        } else {
            $arrInfo['status'] = 0;
            $arrInfo['error'] = $var_consulta;
        }

        $var_consulta = "DELETE FROM $tablaCitas WHERE id = $id;";
        if (pg_query($tmfPac, $var_consulta)) {
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
            $strFilter = " AND ( UPPER(pro.ctg_pro_desc) LIKE '%{$strSearch}%',UPPER(pro.ctg_pro_prinact) LIKE '%{$strSearch}%' ) ";
        }

        $cita = $idUser;
        $pac = $idUser;

        $idCodePac = isset($_POST["idCodePac"]) ? $_POST["idCodePac"]  : '';
        $idCodePac =  decrypt($idCodePac, $key);
        $idCodePac = isset($idCodePac) ? $idCodePac  : '';

        $numCita = "med" . $cita . "citas";
        $numPac = "med" . $pac . "pacientes";
        $arrTableCita = array();
        $var_consulta = "SELECT to_char(cita.med_cit_cita_dt::date,'DD-MM-YYYY') fecha, cita.id idcita, cita.med_cit_id, cita.med_cit_cita_dt, cita.med_cit_pac_id, cita.med_cit_motivo, cita.med_cit_sta, cita.med_cit_estatus, pac.med_pac_code, pac.med_pac_nom, pac.med_pac_ape ,pac.id
                        FROM $numCita AS cita 
                        INNER JOIN $numPac AS pac
                        ON cita.med_cit_pac_id=pac.id
                        WHERE cita.med_cit_estatus='0';";
        $sql = pg_query($tmfMed, $var_consulta);
        $totalArticle = pg_num_rows($sql);
        //print_r($var_consulta);

        while ($rTMP = pg_fetch_assoc($sql)) {

            $arrTableCita[$rTMP["idcita"]]["idcita"]                   = $rTMP["idcita"];
            $arrTableCita[$rTMP["idcita"]]["med_cit_id"]               = $rTMP["med_cit_id"];
            $arrTableCita[$rTMP["idcita"]]["fecha"]          = $rTMP["fecha"];
            $arrTableCita[$rTMP["idcita"]]["med_cit_pac_id"]           = $rTMP["med_cit_pac_id"];
            $arrTableCita[$rTMP["idcita"]]["med_cit_motivo"]           = $rTMP["med_cit_motivo"];
            $arrTableCita[$rTMP["idcita"]]["med_cit_estatus"]          = $rTMP["med_cit_estatus"];
            $arrTableCita[$rTMP["idcita"]]["med_cit_sta"]              = $rTMP["med_cit_sta"];
            $arrTableCita[$rTMP["idcita"]]["med_pac_code"]             = $rTMP["med_pac_code"];
            $arrTableCita[$rTMP["idcita"]]["med_pac_nom"]              = $rTMP["med_pac_nom"];
            $arrTableCita[$rTMP["idcita"]]["med_pac_ape"]              = $rTMP["med_pac_ape"];
            $arrTableCita[$rTMP["idcita"]]["id"]                       = $rTMP["id"];
        }
        pg_free_result($sql);

?>
        <div class="col-md-12 tableFixHead">
            <table id="tableVaccine" class="table table-bordered table-striped table-hover table-sm">
                <thead>
                    <tr class="table-info">
                        <th>Fecha</th>
                        <th>Paciente</th>
                        <th>Motivo</th>
                        <th>Estado</th>
                      <!--  <th>Acciones</th>-->
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (is_array($arrTableCita) && (count($arrTableCita) > 0)) {
                        $intContador = 1;
                        reset($arrTableCita);
                        foreach ($arrTableCita as $rTMP['key'] => $rTMP['value']) {
                    ?>
                            <tr>
                                <td><?php echo   $rTMP["value"]['fecha']; ?></td>
                                <td><?php echo  $rTMP["value"]['med_pac_nom']; ?> <?php echo  $rTMP["value"]['med_pac_ape']; ?></td>
                                <td><?php echo  $rTMP["value"]['med_cit_motivo']; ?></td>
                                <td><?php   
                                    if($rTMP["value"]['med_cit_estatus'] == 0){
                                        echo 'Programada';
                                    }else if($rTMP["value"]['med_cit_estatus'] == 1){
                                        echo 'Realizada';
                                    }else if($rTMP["value"]['med_cit_estatus'] == 2){
                                        echo 'Cancelada';
                                    } 
                                ?></td>
                              <!--  <td class="table-info">
                                    <i title="ver " class="fad fa-eye" style="cursor:pointer;" onclick="fntSelectView('<?php print $intContador; ?>');"></i>
                                    <i class="fad fa-user-minus " style="cursor:pointer;" id="delete" onclick="fntSelectDelete('<?php print $intContador; ?>'); "></i>
                                    <i class="fad fa-user-edit" style="cursor:pointer;" onclick="fntSelectEdit('<?php print $intContador; ?>');"></i>
                                </td>-->
                            </tr>

                            <input type="hidden" name="med_id_<?php print $intContador; ?>" id="med_id_<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['idcita']; ?>">
                            <input type="hidden" name="med_cit_cita_dt_<?php print $intContador; ?>" id="med_cit_cita_dt_<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['med_cit_cita_dt']; ?>">
                            <input type="hidden" name="med_pac_nom_<?php print $intContador; ?>" id="med_pac_nom_<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['med_pac_nom']; ?>">
                            <input type="hidden" name="med_pac_nom_id<?php print $intContador; ?>" id="med_pac_nom_id<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['id']; ?>">
                            <input type="hidden" name="med_cit_motivo_<?php print $intContador; ?>" id="med_cit_motivo_<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['med_cit_motivo']; ?>">
                            <input type="hidden" name="med_cit_estatus_<?php print $intContador; ?>" id="med_cit_estatus_<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['med_cit_estatus']; ?>">
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
    } else if ($strTipoValidacion == "busqueda_table_patient") {
        $strSearch = isset($_POST["Search"]) ? $_POST["Search"]  : '';

        $strFilter = "";
        if (!empty($strSearch)) {
            $strFilter = " AND ( UPPER(med_pac_nom) LIKE '%{$strSearch}%' ) ";
        }
        $med = $idUser;
        $numPac = "med" . $med . "pacientes";
        $arrTablePatient = array();
        $var_consulta = "SELECT * FROM $numPac ORDER BY id ";
        $sql = pg_query($tmfMed, $var_consulta);
        $totalArticle = pg_num_rows($sql);


        while ($rTMP = pg_fetch_assoc($sql)) {

            $arrTablePatient[$rTMP["id"]]["id"]                       = $rTMP["id"];
            $arrTablePatient[$rTMP["id"]]["med_pac_dpi"]              = $rTMP["med_pac_dpi"];
            $arrTablePatient[$rTMP["id"]]["med_pac_code"]             = $rTMP["med_pac_code"];
            $arrTablePatient[$rTMP["id"]]["med_pac_codigo"]           = $rTMP["med_pac_codigo"];
            $arrTablePatient[$rTMP["id"]]["med_pac_mem_id"]           = $rTMP["med_pac_mem_id"];
            $arrTablePatient[$rTMP["id"]]["med_pac_nom"]              = $rTMP["med_pac_nom"];
            $arrTablePatient[$rTMP["id"]]["med_pac_sexo"]             = $rTMP["med_pac_sexo"];
            $arrTablePatient[$rTMP["id"]]["med_pac_civil"]            = $rTMP["med_pac_civil"];
            $arrTablePatient[$rTMP["id"]]["med_pac_nac_dia"]          = $rTMP["med_pac_nac_dia"];
            $arrTablePatient[$rTMP["id"]]["med_pac_nac_mes"]          = $rTMP["med_pac_nac_mes"];
            $arrTablePatient[$rTMP["id"]]["med_pac_nac_ano"]          = $rTMP["med_pac_nac_ano"];
            $arrTablePatient[$rTMP["id"]]["med_pac_dir"]              = $rTMP["med_pac_dir"];
            $arrTablePatient[$rTMP["id"]]["med_pac_zona"]             = $rTMP["med_pac_zona"];
            $arrTablePatient[$rTMP["id"]]["med_pac_dep"]              = $rTMP["med_pac_dep"];
            $arrTablePatient[$rTMP["id"]]["med_pac_mun"]              = $rTMP["med_pac_mun"];
            $arrTablePatient[$rTMP["id"]]["med_pac_telcel"]           = $rTMP["med_pac_telcel"];
            $arrTablePatient[$rTMP["id"]]["med_pac_telpar"]           = $rTMP["med_pac_telpar"];
            $arrTablePatient[$rTMP["id"]]["med_pac_email"]            = $rTMP["med_pac_email"];
            $arrTablePatient[$rTMP["id"]]["med_pac_pass"]             = $rTMP["med_pac_pass"];
            $arrTablePatient[$rTMP["id"]]["med_pac_username"]         = $rTMP["med_pac_username"];
            $arrTablePatient[$rTMP["id"]]["med_pac_estatus"]          = $rTMP["med_pac_estatus"];
            $arrTablePatient[$rTMP["id"]]["med_pac_sta"]              = $rTMP["med_pac_sta"];
            $arrTablePatient[$rTMP["id"]]["med_pac_dt"]               = $rTMP["med_pac_dt"];
            $arrTablePatient[$rTMP["id"]]["med_pac_usr"]              = $rTMP["med_pac_usr"];
            $arrTablePatient[$rTMP["id"]]["id_med_pac"]               = $rTMP["id_med_pac"];
        }
        pg_free_result($sql);

    ?>
        <div class="col-md-12 tableFixHead">
            <table id="tablePatient" class="table table-bordered table-striped table-hover table-sm">
                <thead>
                    <tr class="table-info">
                        <th>No. De Identificacion</th>
                        <th>Nombre</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (is_array($arrTablePatient) && (count($arrTablePatient) > 0)) {
                        $intContador = 1;
                        reset($arrTablePatient);
                        foreach ($arrTablePatient as $rTMP['key'] => $rTMP['value']) {
                    ?>
                            <tr data-dismiss="modal" style="cursor:pointer;" onclick="fntSelectPatient('<?php print $intContador; ?>');">
                                <td><?php echo  $rTMP["value"]['med_pac_dpi']; ?></td>
                                <td><?php echo  $rTMP["value"]['med_pac_nom']; ?></td>
                                <input type="hidden" name="hidId_<?php print $intContador; ?>" id="hidId_<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['id']; ?>">
                                <input type="hidden" name="hidName_<?php print $intContador; ?>" id="hidName_<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['med_pac_nom']; ?>">
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
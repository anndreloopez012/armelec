<?php
if (isset($_GET["validaciones"]) && !empty($_GET["validaciones"])) {
    require_once "../../data/conexion/tmlMed.php";
    require_once "../../data/conexion/tmfPac.php";
    require_once "../../data/conexion/tmfAdm.php";
    $usuario = $_SESSION['adm_usr_code'];

    //TABLA DE INTERACCION
    $idUser = $_SESSION['adm_usr_code'];
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
        print json_encode($arrInfo);
        die();
    } else if ($strTipoValidacion == "update") {
        header('Content-Type: application/json');
        $var_consulta = " UPDATE $tablaCitas SET med_cit_id = $med_cit_id,med_cit_cita_dt = '$med_cit_cita_dt',med_cit_pac_id = '$med_cit_pac',med_cit_motivo = '$med_cit_motivo',med_cit_estatus = '$med_cit_estatus',med_cit_sta = '$status',med_cit_dt = '$fechaIng' WHERE id = $id;";
        if (pg_query($tmfMed, $var_consulta)) {
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
        print json_encode($arrInfo);
        die();
    }
    //DIBUJO DE TABLA PRODUCTOS CATEGORIAS
    else if ($strTipoValidacion == "busqueda_table") {
        $strSearch = isset($_POST["Search"]) ? $_POST["Search"]  : '';

        $strFilter = "";
        if (!empty($strSearch)) {
            $strFilter = " AND ( UPPER(med_cit_cita_dt) LIKE '%{$strSearch}%',UPPER(med_cit_motivo) LIKE '%{$strSearch}%' ) ";
        }
        $year = date("Y");
        $tabla = "a" . $year . "_citas";
        $arrTableCita = array();
        $var_consulta = "SELECT to_char(med_cit_cita_dt::date,'DD-MM-YYYY') fecha, * FROM $tabla WHERE med_cit_pac_id = $idUser AND med_cit_estatus = '0' ORDER BY med_cit_cita_dt DESC";
        $sql = pg_query($tmfPac, $var_consulta);
        $totalArticle = pg_num_rows($sql);
        //print_r($var_consulta);

        while ($rTMP = pg_fetch_assoc($sql)) {
            $arrTableCita[$rTMP["id"]]["id"]                       = $rTMP["id"];
            $arrTableCita[$rTMP["id"]]["med_cit_id"]                       = $rTMP["med_cit_id"];
            $arrTableCita[$rTMP["id"]]["med_cit_cita_dt"]                       = $rTMP["med_cit_cita_dt"];
            $arrTableCita[$rTMP["id"]]["med_cit_med_id"]                       = $rTMP["med_cit_med_id"];
            $arrTableCita[$rTMP["id"]]["med_cit_pac_id"]                       = $rTMP["med_cit_pac_id"];
            $arrTableCita[$rTMP["id"]]["med_cit_motivo"]                       = $rTMP["med_cit_motivo"];
            $arrTableCita[$rTMP["id"]]["med_cit_estatus"]                       = $rTMP["med_cit_estatus"];
            $arrTableCita[$rTMP["id"]]["med_cit_sta"]                       = $rTMP["med_cit_sta"];
            $arrTableCita[$rTMP["id"]]["med_cit_dt"]                       = $rTMP["med_cit_dt"];
            $arrTableCita[$rTMP["id"]]["med_cit_usr"]                       = $rTMP["med_cit_usr"];
            $arrTableCita[$rTMP["id"]]["fecha"]                       = $rTMP["fecha"];
        }
        pg_free_result($sql);

?>
        <div class="col-md-12 tableFixHead">
            <table id="tableVaccine" class="table table-bordered table-striped table-hover table-sm">
                <thead>
                    <tr class="table-info">
                        <th>Fecha</th>
                        <th>Medico</th>
                        <th>Motivo</th>
                        <th>Estado</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (is_array($arrTableCita) && (count($arrTableCita) > 0)) {
                        $intContador = 1;
                        reset($arrTableCita);
                        foreach ($arrTableCita as $rTMP['key'] => $rTMP['value']) {
                            $idMedico = $rTMP["value"]['med_cit_med_id'];

                            $rsMed = pg_query($rmfAdm, "SELECT ctg_med_nombres, ctg_med_apellidos FROM ctg_medicos WHERE ctg_med_code = '$idMedico' LIMIT 1");
                            if ($row = pg_fetch_array($rsMed)) {
                                $idRowCode = trim($row[0]);
                                $idRowCode2 = trim($row[1]);
                            }
                            $nombre = isset($idRowCode) ? $idRowCode : "";
                            $apellido = isset($idRowCode2) ? $idRowCode2 : "";
                            $NombreMedico = $nombre . " " .$apellido;
                    ?>
                            <tr>
                                <td width = "10%"><?php echo  $rTMP["value"]['fecha']; ?></td>
                                <td width = "20%"><?php echo  $NombreMedico; ?></td>
                                <td width = "60%"><?php echo  $rTMP["value"]['med_cit_motivo']; ?></td>
                                <td width = "10%"><?php
                                    if ($rTMP["value"]['med_cit_cita_dt'] > $fechaIng ) {
                                        echo 'Programada';
                                    } else {
                                        echo 'Realizada';
                                    } 
                                    ?></td>
                               
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
<?php
//PREPARAR LIBRERIA
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../../PHPMAILER/PHPMailer.php';
require '../../PHPMAILER/SMTP.php';
require '../../PHPMAILER/Exception.php';
//error_reporting(E_ALL);
//ini_set('display_errors', 1);
require_once "../../api/globalFunctions.php";
// VALIDATION INSERT UPDATE DELETE
if (isset($_GET["validaciones"]) && !empty($_GET["validaciones"])) {
    require_once "../../api/globalFunctions.php";

    require_once "../../data/conexion/tmlMed.php";
    require_once "../../data/conexion/tmfAdm.php";
    require_once "../../data/conexion/tmlFar.php";

    $idUser = $_SESSION['adm_usr_code'];
    $id = $_SESSION['adm_usr_code'];
    $tablaConsultas = "med" . $id . "consultas";
    $year = date("Y");
    $fechaDia = date("d-m-Y");


    $rs = pg_query($rmfAdm, "SELECT ctg_med_nombres,ctg_med_apellidos,ctg_med_dir,ctg_med_telcel FROM ctg_medicos WHERE ctg_med_code = $id ORDER BY ctg_med_nombres DESC LIMIT 1");
    if ($row = pg_fetch_array($rs)) {
        $idRow0 = trim($row[0]);
        $idRow1 = trim($row[1]);
        $idRow2 = trim($row[2]);
        $idRow3 = trim($row[3]);
    }
    //id para insert de tabla medicos
    $medicoNombres = isset($idRow0) ? $idRow0  : '';
    $medicoApellidos = isset($idRow1) ? $idRow1  : '';
    $medicoDireccion = isset($idRow2) ? $idRow2  : '';
    $medicoTelefono = isset($idRow3) ? $idRow3  : '';
    $nombreCmMedico = $medicoNombres . ' ' . $medicoApellidos;

    $rs = pg_query($tmfMed, "SELECT COUNT(med_con_id) FROM $tablaConsultas");
    if ($row = pg_fetch_array($rs)) {
        $idRow = trim($row[0]);
    }
    //id para insert de tabla medicos
    $med_con_id_ = isset($idRow) ? $idRow  : 0;
    $med_con_id = $med_con_id_ + 1;

    $med_con_pac_id = isset($_POST["code"]) ? $_POST["code"]  : '';

    $idPacienteVacuna = isset($_POST["idPacienteVacuna"]) ? $_POST["idPacienteVacuna"]  : '';
    $idPacientebHospital = isset($_POST["idPacientebHospital"]) ? $_POST["idPacientebHospital"]  : '';
    $idPacientecLaboratorio = isset($_POST["idPacientecLaboratorio"]) ? $_POST["idPacientecLaboratorio"]  : '';
    $idPacientedFarmacia = isset($_POST["idPacientedFarmacia"]) ? $_POST["idPacientedFarmacia"]  : '';

    $nombrePacienteVacuna = isset($_POST["nombrePacienteVacuna"]) ? $_POST["nombrePacienteVacuna"]  : '';
    $nombrePacientebHospital = isset($_POST["nombrePacientebHospital"]) ? $_POST["nombrePacientebHospital"]  : '';
    $nombrePacientecLaboratorio = isset($_POST["nombrePacientecLaboratorio"]) ? $_POST["nombrePacientecLaboratorio"]  : '';
    $nombrePacientedFarmacia = isset($_POST["nombrePacientedFarmacia"]) ? $_POST["nombrePacientedFarmacia"]  : '';
    $nombreConsulta = isset($_POST["nombre_hid"]) ? $_POST["nombre_hid"]  : '';

    $med_con_cita_dt = isset($_POST["fecha"]) ? $_POST["fecha"]  : '';
    $med_con_motivo = isset($_POST["motivo"]) ? $_POST["motivo"]  : '';
    $med_con_examen = isset($_POST["examen"]) ? $_POST["examen"]  : '';
    $med_con_receta = isset($_POST["receta"]) ? $_POST["receta"]  : '';
    $med_con_dieta = isset($_POST["dieta"]) ? $_POST["dieta"]  : '';
    $med_con_observa = isset($_POST["colegiado"]) ? $_POST["colegiado"]  : '';

    $proxima_cita_ = isset($_POST["proxima_cita"]) ? $_POST["proxima_cita"]  : null;
    if ($proxima_cita_ == "") {
        $proxima_cita_ = date("Y-m-d");
    }

    $proxima_cita = isset($_POST["proxima_cita"]) ? $_POST["proxima_cita"]  : '';
    $proxima_cita = date("d-m-Y", strtotime($proxima_cita));
    $proxima_cita = isset($proxima_cita) ? $proxima_cita  : '';

    $med_con_uni_id = isset($_POST["sanitaria"]) ? $_POST["sanitaria"]  : '';
    $med_con_enf_id = isset($_POST["enfermedad"]) ? $_POST["enfermedad"]  : '';
    $correo = isset($_POST["correo"]) ? $_POST["correo"]  : '';
    $med_pac_zona = isset($_POST["zona"]) ? $_POST["zona"]  : '';
    $med_pac_dep = isset($_POST["hid_region"]) ? $_POST["hid_region"]  : 0;
    $med_pac_mun = isset($_POST["hid_distrito"]) ? $_POST["hid_distrito"]  : 0;
    if ($med_pac_mun == "") {
        $med_pac_mun = 0;
    }
    $stat = 1;
    $fechaIng = date("Y-m-d");
    $usuario = $_SESSION['adm_usr_code'];

    $tablaMedic = "";

    $strTipoValidacion = isset($_REQUEST["validaciones"]) ? $_REQUEST["validaciones"] : '';

    $strSearch = isset($_POST["Search"]) ? $_POST["Search"]  : '';
    if ($strTipoValidacion == "insert") {
        header('Content-Type: application/json');

        $var_consulta = "INSERT INTO $tablaConsultas(med_con_id,med_con_pac_id,med_con_cita_dt,med_con_motivo,med_con_examen,med_con_receta,med_con_dieta,med_con_sta,med_con_dt,med_con_usr,med_con_citap_dt) VALUES ($med_con_id,'$med_con_pac_id','$fechaIng','$med_con_motivo','$med_con_examen','$med_con_receta','$med_con_dieta','$stat','$fechaIng','$usuario','$proxima_cita_');";
        $val = 1;
        if (pg_query($tmfMed, $var_consulta)) {
            $arrInfo['status'] = $val;
        } else {
            $arrInfo['status'] = 0;
            $arrInfo['error'] = $var_consulta;
        }
        print json_encode($arrInfo);

        die();
    }

    if ($strTipoValidacion == "insert_consulta_paciente") {

        require_once "../../data/conexion/tmfPac.php";
        $id = $_SESSION['adm_usr_code'];
        $medicosConsultasMed = "a" . $year . "medconsultas";
        $medicosConsultasFar = "a" . $year . "_medicos_consultas";
        $medicosConsultasPac = "a" . $year . "_medicos_consultas";

        $sesionMedicos = isset($_SESSION['CARRITOMED']) ? $_SESSION['CARRITOMED']  : '';
        $sesionPacientes = isset($_SESSION['CARRITOLAB']) ? $_SESSION['CARRITOLAB']  : '';
        $sesionLaboratorios = isset($_SESSION['CARRITOLAB']) ? $_SESSION['CARRITOLAB']  : '';
        $sesionHospitales = isset($_SESSION['CARRITOHOSP']) ? $_SESSION['CARRITOHOSP']  : '';

        header('Content-Type: application/json');

        ////////////////// VALIDAR TIENDAS AL HACER LOS PROCESOS ///////////////////////

        $var_consulta = "INSERT INTO $medicosConsultasMed(med_con_id,med_con_med_id,med_con_pac_id,med_con_cita_dt,med_con_motivo,med_con_examen,med_con_receta,med_con_dieta,med_con_uni_id,med_con_enf_id,med_pac_zona,med_pac_dep,med_pac_mun,med_con_sta,med_con_dt,med_con_usr,med_con_citap_dt) VALUES ($med_con_id_,'$id','$med_con_pac_id','$fechaIng','$med_con_motivo','$med_con_examen','$med_con_receta','$med_con_dieta','$med_con_uni_id','$med_con_enf_id','$med_pac_zona','$med_pac_dep','$med_pac_mun','$stat','$fechaIng','$usuario','$proxima_cita_');";
        $val = 3;
        if (pg_query($tmfMed, $var_consulta)) {
            $arrInfo['status'] = $val;
        } else {
            $arrInfo['status'] = 0;
            $arrInfo['error'] = $var_consulta;
        }

        //print_r($var_consulta);
        //print json_encode($arrInfo);

        $var_consulta = "INSERT INTO $medicosConsultasFar(med_con_id,med_con_med_id,med_con_pac_id,med_con_cita_dt,med_con_motivo,med_con_examen,med_con_receta,med_con_dieta,med_con_uni_id,med_con_enf_id,med_pac_zona,med_pac_dep,med_pac_mun,med_con_sta,med_con_dt,med_con_usr,med_con_citap_dt) VALUES ($med_con_id_,'$id','$med_con_pac_id','$fechaIng','$med_con_motivo','$med_con_examen','$med_con_receta','$med_con_dieta','$med_con_uni_id','$med_con_enf_id','$med_pac_zona','$med_pac_dep','$med_pac_mun','$stat','$fechaIng','$usuario','$proxima_cita_');";
        $val = 2;
        if (pg_query($tmfFar, $var_consulta)) {
            $arrInfo['status'] = $val;
        } else {
            $arrInfo['status'] = 0;
            $arrInfo['error'] = $var_consulta;
        }

        //print_r($var_consulta);
        //print json_encode($arrInfo);

        $var_consulta = "INSERT INTO $medicosConsultasPac(med_con_id,med_con_med_id,med_con_pac_id,med_con_cita_dt,med_con_motivo,med_con_examen,med_con_receta,med_con_dieta,med_con_uni_id,med_con_enf_id,med_pac_zona,med_pac_dep,med_pac_mun,med_con_sta,med_con_dt,med_con_usr,med_con_citap_dt) VALUES ($med_con_id_,'$id','$med_con_pac_id','$fechaIng','$med_con_motivo','$med_con_examen','$med_con_receta','$med_con_dieta','$med_con_uni_id','$med_con_enf_id','$med_pac_zona','$med_pac_dep','$med_pac_mun','$stat','$fechaIng','$usuario','$proxima_cita_');";
        $val = 1;
        if (pg_query($tmfPac, $var_consulta)) {
            $arrInfo['status'] = $val;
        } else {
            $arrInfo['status'] = 0;
            $arrInfo['error'] = $var_consulta;
        }
        //print_r($var_consulta);
        /////////////////////////////////////////


        //CORREO DE CONSULTA MEDICA

        //LISTA DE VACUNAS PARA LA RECETA MEDICA
        $tablaConsultasVac = "med" . $id . "consultas_vacunas";
        $tablaVac = "med" . $id . "vacunas";
        $rs = pg_query($tmfMed, "SELECT COUNT(med_cov_id) FROM $tablaConsultasVac WHERE med_cov_id = $med_con_id_");
        if ($row = pg_fetch_array($rs)) {
            $idRow = trim($row[0]);
        }
        $idVac = isset($idRow) ? $idRow  : 0;
        $tablaVacunas = "";
        if ($idVac >= 1) {

            $arrTableVaccine = array();
            $var_consulta = "SELECT com.id,com.med_cov_id,vac.med_vac_nom,vac.med_vac_des,vac.med_vac_precio,vac.med_vac_id
                            FROM $tablaConsultasVac com
                            INNER JOIN $tablaVac vac
                            ON com.med_cov_vac_id = vac.med_vac_id
                            WHERE com.med_cov_id = $med_con_id_";
            $sql = pg_query($tmfMed, $var_consulta);
            $total = pg_num_rows($sql);
            //print_r($var_consulta);

            while ($rTMP = pg_fetch_assoc($sql)) {

                $arrTableVaccine[$rTMP["id"]]["med_vac_nom"] = $rTMP["med_vac_nom"];
                $arrTableVaccine[$rTMP["id"]]["med_vac_des"] = $rTMP["med_vac_des"];
                $arrTableVaccine[$rTMP["id"]]["med_vac_precio"] = $rTMP["med_vac_precio"];
            }
            pg_free_result($sql);

            if (is_array($arrTableVaccine) && (count($arrTableVaccine) > 0)) {
                reset($arrTableVaccine);
                foreach ($arrTableVaccine as $rTMP['key'] => $rTMP['value']) {
                    $med_vac_nom = $rTMP["value"]['med_vac_nom'];
                    $med_vac_des = $rTMP["value"]['med_vac_des'];
                    $med_vac_precio = $rTMP["value"]['med_vac_precio'];

                    $tablaVacunas .=
                        '<tr border="1" >
                        <td align="right" width="10%" bgcolor= "#3498db">Nombre de la vacuna: </td>'
                        . '<td width="50%">' . $med_vac_nom . '</td> </tr>'
                        . '<tr border="1" >'
                        . '<td bgcolor= "#3498db" align="right">Descripcion: </td>'
                        . '<td>' . $med_vac_des . '</td></tr>'
                        . '<tr border="1">'
                        . '<td bgcolor= "#3498db" align="right">Precio: </td>'
                        . '<td>' . $med_vac_precio . '</td></tr>'
                        . '<tr border="1" >'
                        . '<td>.</td></tr>';
                }
            }
        }

        if ($proxima_cita > $fechaIng) {
            $_proxima_cita = '  <b color="teal">Fecha de la prixima cita:</><a>' . $proxima_cita . '</a><br><br>';
        } else {
            $_proxima_cita = '';
        }
        if ($med_con_dieta) {
            $_med_con_dieta = '  <b color="teal">Fecha de la prixima cita:</><a>' . $proxima_cita . '</a><br><br>';
        } else {
            $_med_con_dieta = '';
        }


        if ($sesionMedicos) {

            $medicosConsultasProductosMed = "a" . $year . "medconsultas_productos";

            $arrRecFar = array();
            $var_consulta = "SELECT med_cop_far_id var_id_far,
                            med_cop_pro_id var_id_prod
                            FROM $medicosConsultasProductosMed 
                            WHERE med_cop_id = $med_con_id_
                            ORDER BY var_id_far";
            $sql = pg_query($tmfMed, $var_consulta);
            //$total = pg_num_rows($sql);
            //print_r( $var_consulta);

            while ($rTMP = pg_fetch_assoc($sql)) {

                $arrRecFar[$rTMP["var_id_far"]]["idFarm"] = $rTMP["var_id_far"];
                $arrRecFar[$rTMP['var_id_far']]['productos'][$rTMP['var_id_prod']]['pro_id'] = $rTMP['var_id_prod'];
            }
            pg_free_result($sql);

            $tablaMedic = '';

            if (is_array($arrRecFar) && (count($arrRecFar) > 0)) {
                reset($arrRecFar);
                foreach ($arrRecFar as $keyC => $valueC) {

                    $med_cop_far_id = $valueC['idFarm'];

                    $rs = pg_query($rmfAdm, "SELECT ctg_far_contrato
                                            FROM ctg_farmacias_sucursales
                                            WHERE ctg_far_code =  '$med_cop_far_id'");
                    if ($row = pg_fetch_array($rs)) {
                        $idRowP = trim($row[0]);
                    }
                    $ctg_far_contrato = isset($idRowP) ? $idRowP  : '';

                    if (isset($valueC["productos"]) && is_array($valueC["productos"]) && (count($valueC["productos"]) > 0)) {
                        reset($valueC["productos"]);
                        foreach ($valueC["productos"] as $keyP => $valueP) {
                            $med_cop_pro_id = $valueP['pro_id'];
                            $rs = pg_query($rmfAdm, "SELECT ctg_fap_nomcom,ctg_fap_prinact,ctg_fap_indi
                                            FROM ctg_farmacias_productos
                                            WHERE ctg_fap_pro =  '$med_cop_pro_id'
                                            AND ctg_fap_contrato =  $ctg_far_contrato");
                            if ($row = pg_fetch_array($rs)) {
                                $idRowP0 = trim($row[0]);
                                $idRowP1 = trim($row[1]);
                                $idRowP2 = trim($row[2]);
                            }
                            $ctg_fap_nomcom = isset($idRowP0) ? $idRowP0  : '';
                            $ctg_fap_prinact = isset($idRowP1) ? $idRowP1  : '';
                            $ctg_fap_indi = isset($idRowP2) ? $idRowP2  : '';

                            $tablaMedic .=
                                '<tr border="1" >
                                <td align="right" width="10%" bgcolor= "#3498db">Numero de Registro: </td>'
                                . '<td width="50%">' . $med_cop_pro_id . '</td> </tr>'
                                . '<tr border="1" >'
                                . '<td bgcolor= "#3498db" align="right">Nombre del Medicamento: </td>'
                                . '<td>' . $ctg_fap_nomcom . '</td></tr>'
                                . '<tr border="1">'
                                . '<td bgcolor= "#3498db" align="right">Principio Activo: </td>'
                                . '<td>' . $ctg_fap_prinact . '</td></tr>'
                                . '<tr border="1">'
                                . '<td bgcolor= "#3498db" align="right">Indicaciones: </td>'
                                . '<td align="justify" >' . $ctg_fap_indi . '</td></tr>'
                                . '<tr border="1" >'
                                . '<td>.</td></tr>';
                        }
                    }
                }
            }
            if ($tablaVacunas==''){
                $tablaVacunas='NO SE APLICARON VACUNAS';
            }            
            $subject_ = 'Receta Medica - ' . ' ' . $med_con_id_;
            $address_  =  $correo;
            $mailContent = '<br>VisualMed - Receta Medica </br><br>
            <table class="default" width="100%">
                <tr border="1">
                    <td align="center" bgcolor= "#0464fc">
                        <img src="https://i.ibb.co/MZ35wKk/vmo-header2-1.png" alt="vmo-header2-1" border="0">
                    </td>
                </tr>
            </table>
            <table class="default" width="100%">
            <tr border="1">
            <td align="center"><h3>Dr. ' . $nombreCmMedico . '</h3></td><br>
            </tr>
            <tr border="1">
            <td align="center"><b>' . $medicoDireccion . '</b></td><br>
            </tr>
            <tr border="1">
            <td align="center"><b>' . $medicoTelefono . '</b></td>
            </tr>
            </table><br><br>
            <b color="teal">Nombre del paciente:</b><a>' . $nombreConsulta . '</a><br>
            <b color="teal">Fecha de la consulta:</b><a>' . $fechaDia . '</a><br>'
                . $_proxima_cita . '
            <b color="teal">INDICACIONES DE LA RECETA:</b><br>
            <a>' . $med_con_receta . '</a><br><br>
            ' . $_med_con_dieta . '            
            <b color="teal">INFORMACION SOBRE VACUNAS APLICADAS</b><br><br>
            <table class="default" width="100%">'
                . $tablaVacunas . '
            </table><br><br><br>
            <b color="teal">INFORMACION SOBRE MEDICAMENTOS RECETADOS</b><br><br>
            <table class="default" width="100%">'
                . $tablaMedic . '
            </table><br><br><br>
            <table class="default" width="100%">
                <tr border="1">
                    <td align="center" bgcolor= "#0464fc">
                        <img src="https://i.ibb.co/ckwzNgQ/vmo-footer2-1.png" alt="vmo-footer2-1" border="0">
                    </td>
                </tr>
            </table>';

            $mail = new PHPMailer(true);
            try {
                $mail->SMTPDebug = 0;
                $mail->isSMTP();
                $mail->Host       = 'mail.privateemail.com';
                $mail->SMTPAuth   = true;
                $mail->Username   = 'dor.contacto@visualmed.online';
                $mail->Password   = 'D0r.C0ntact02020';
                $mail->SMTPSecure = 'TLS';
                $mail->Port       =  587;
                $mail->setFrom('dor.contacto@visualmed.online', 'VisualMed');
                $subject  = $subject_;
                $address  = $address_;
                $mail->addAddress($address, $subject);
                $mail->addAddress('andrelopez012@gmail.com', 'andre');
                $mail->isHTML(true);
                $mail->Subject = $subject;
                $mail->Body    = $mailContent;
                $mail->CharSet = 'UTF-8';

                $mail->send();
            } catch (Exception $e) {
                echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            }
        } else {
            if ($tablaVacunas==''){
                $tablaVacunas='NO SE APLICARON VACUNAS';
            }            
            $subject_ = 'Receta Medica - ' . ' ' . $med_con_id_;
            $address_  =  $correo;
            $mailContent = '<br>VisualMed - Receta Medica </br><br>
            <table class="default" width="100%">
                <tr border="1">
                    <td align="center" bgcolor= "#0464fc">
                        <img src="https://i.ibb.co/MZ35wKk/vmo-header2-1.png" alt="vmo-header2-1" border="0">
                    </td>
                </tr>
            </table>
            <table class="default" width="100%">
            <tr border="1">
            <td align="center"><h3>Dr. ' . $nombreCmMedico . '</h3></td><br>
            </tr>
            <tr border="1">
            <td align="center"><b>' . $medicoDireccion . '</b></td><br>
            </tr>
            <tr border="1">
            <td align="center"><b>' . $medicoTelefono . '</b></td>
            </tr>
            </table><br><br>

            <b color="teal">Nombre del paciente:</b><a>' . $nombreConsulta . '</a><br>
            <b color="teal">Fecha de la consulta:</b><a>' . $fechaDia . '</a><br>'
                . $_proxima_cita . '
            <b color="teal">INDICACIONES DE LA RECETA:</b><br>
            <a>' . $med_con_receta . '</a><br><br>
            ' . $_med_con_dieta . ' 
            <b color="teal">INFORMACION SOBRE VACUNAS APLICADAS</b><br><br>
            <table class="default" width="100%">'
                . $tablaVacunas . '
            </table><br><br><br>    
            <table class="default" width="100%">
                <tr border="1">
                    <td align="center" bgcolor= "#0464fc">
                        <img src="https://i.ibb.co/ckwzNgQ/vmo-footer2-1.png" alt="vmo-footer2-1" border="0">
                    </td>
                </tr>
            </table>';

            $mail = new PHPMailer(true);
            try {
                $mail->SMTPDebug = 0;
                $mail->isSMTP();
                $mail->Host       = 'mail.privateemail.com';
                $mail->SMTPAuth   = true;
                $mail->Username   = 'dor.contacto@visualmed.online';
                $mail->Password   = 'D0r.C0ntact02020';
                $mail->SMTPSecure = 'TLS';
                $mail->Port       =  587;
                $mail->setFrom('dor.contacto@visualmed.online', 'VisualMed');
                $subject  = $subject_;
                $address  = $address_;
                $mail->addAddress($address, $subject);
                $mail->addAddress('andrelopez012@gmail.com', 'andre');
                $mail->isHTML(true);
                $mail->Subject = $subject;
                $mail->Body    = $mailContent;
                $mail->CharSet = 'UTF-8';

                $mail->send();
            } catch (Exception $e) {
                echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            }
        }
        //CORREO DE FARMACIA
        if ($sesionMedicos) {

            $medicosConsultasMed = "a" . $year . "medconsultas";
            $medicosConsultasProductosMed = "a" . $year . "medconsultas_productos";

            $arrRecFar = array();
            $var_consulta = "SELECT med_cop_far_id var_id_far,
                            med_cop_pro_id var_id_prod
                            FROM $medicosConsultasProductosMed 
                            WHERE med_cop_id = $med_con_id_
                            ORDER BY var_id_far";
            $sql = pg_query($tmfMed, $var_consulta);
            $total = pg_num_rows($sql);
            //print_r( $var_consulta);

            while ($rTMP = pg_fetch_assoc($sql)) {

                $arrRecFar[$rTMP["var_id_far"]]["idFarm"] = $rTMP["var_id_far"];
                $arrRecFar[$rTMP['var_id_far']]['productos'][$rTMP['var_id_prod']]['pro_id'] = $rTMP['var_id_prod'];
            }
            pg_free_result($sql);

            $tablaMedic = '';
            if (is_array($arrRecFar) && (count($arrRecFar) > 0)) {
                reset($arrRecFar);
                foreach ($arrRecFar as $keyC => $valueC) {

                    $med_cop_far_id = $valueC['idFarm'];

                    $rs = pg_query($rmfAdm, "SELECT ctg_far_contrato
                                            FROM ctg_farmacias_sucursales
                                            WHERE ctg_far_code =  '$med_cop_far_id'");
                    if ($row = pg_fetch_array($rs)) {
                        $idRowP = trim($row[0]);
                    }
                    $ctg_far_contrato = isset($idRowP) ? $idRowP  : '';

                    if (isset($valueC["productos"]) && is_array($valueC["productos"]) && (count($valueC["productos"]) > 0)) {
                        reset($valueC["productos"]);
                        foreach ($valueC["productos"] as $keyP => $valueP) {
                            $med_cop_pro_id = $valueP['pro_id'];
                            $rs = pg_query($rmfAdm, "SELECT ctg_fap_nomcom,ctg_fap_pre
                                            FROM ctg_farmacias_productos
                                            WHERE ctg_fap_pro =  '$med_cop_pro_id'
                                            AND ctg_fap_contrato =  $ctg_far_contrato");
                            if ($row = pg_fetch_array($rs)) {
                                $idRowP0 = trim($row[0]);
                                $idRowP1 = trim($row[1]);
                            }
                            $ctg_fap_nomcom = isset($idRowP0) ? $idRowP0  : '';
                            $ctg_fap_pre = isset($idRowP1) ? $idRowP1  : '';

                            $tablaMedic .=
                                '<tr border="1" >
                                <td align="right" width="10%" bgcolor= "#3498db">Numero de Registro: </td>'
                                . '<td width="50%">' . $med_cop_pro_id . '</td> </tr>'
                                . '<tr border="1" >'
                                . '<td bgcolor= "#3498db" align="right">Nombre del Medicamento: </td>'
                                . '<td>' . $ctg_fap_nomcom . '</td></tr>'
                                . '<tr border="1">'
                                . '<td bgcolor= "#3498db" align="right">Precio: </td>'
                                . '<td>' . $ctg_fap_pre . '</td></tr>'
                                . '<tr border="1" >'
                                . '<td>.</td></tr>';
                        }
                    }

                    $rs = pg_query($rmfAdm, "SELECT ctg_far_nomcom,ctg_far_suc,ctg_far_email
                                            FROM ctg_farmacias_sucursales
                                            WHERE ctg_far_code = '$med_cop_far_id'");
                    if ($row = pg_fetch_array($rs)) {
                        $idRowS0 = trim($row[0]);
                        $idRowS1 = trim($row[1]);
                        $idRowS2 = trim($row[2]);
                    }
                    $ctg_far_nomcom = isset($idRowS0) ? $idRowS0  : '';
                    $ctg_far_suc = isset($idRowS1) ? $idRowS1  : '';
                    $ctg_far_email = isset($idRowS2) ? $idRowS2  : '';
                    $total = 0;

                    $subject_ = 'ORDEN DE MEDICAMENTOS - ' . ' ' . $med_con_id_;
                    $address_  =  $ctg_far_email;
                    $mailContent = '<br>VisualMed - ORDEN DE MEDICAMENTOS - ' . $ctg_far_nomcom . "-" . $ctg_far_suc . ' </br><br>
                                    <table class="default" width="100%">
                                        <tr border="1">
                                            <td align="center" bgcolor= "#0464fc">
                                                <img src="https://i.ibb.co/MZ35wKk/vmo-header2-1.png" alt="vmo-header2-1" border="0">
                                            </td>
                                        </tr>
                                    </table>
                                    <table class="default" width="100%">
                                    <tr border="1">
                                    <td align="center"><h3>Dr. ' . $nombreCmMedico . '</h3></td><br>
                                    </tr>
                                    <tr border="1">
                                    <td align="center"><b>' . $medicoDireccion . '</b></td><br>
                                    </tr>
                                    <tr border="1">
                                    <td align="center"><b>' . $medicoTelefono . '</b></td>
                                    </tr>
                                    </table><br><br>

                                    <b color="teal">Nombre del paciente:</b><a>' . $nombreConsulta . '</a><br>
                                    <b color="teal">Fecha de la consulta:</b><a>' . $fechaDia . '</a><br><br>

                                    <b color="teal">MEDICAMENTOS</b><br><br><br>
                                    <table class="default" width="100%">'
                        . $tablaMedic . '
                                    </table>
                                    <br>
                                    <b color="teal">COSTO TOTAL:</b><a>' . $total . '</a><br>
                                    <br>
                                    <table class="default" width="100%">
                                        <tr border="1">
                                            <td align="center" bgcolor= "#0464fc">
                                                <img src="https://i.ibb.co/ckwzNgQ/vmo-footer2-1.png" alt="vmo-footer2-1" border="0">
                                            </td>
                                        </tr>
                                    </table>';

                    $mail = new PHPMailer(true);
                    try {
                        $mail->SMTPDebug = 0;
                        $mail->isSMTP();
                        $mail->Host       = 'mail.privateemail.com';
                        $mail->SMTPAuth   = true;
                        $mail->Username   = 'dor.contacto@visualmed.online';
                        $mail->Password   = 'D0r.C0ntact02020';
                        $mail->SMTPSecure = 'TLS';
                        $mail->Port       =  587;
                        $mail->setFrom('dor.contacto@visualmed.online', 'VisualMed');
                        $subject  = $subject_;
                        $address  = $address_;
                        $mail->addAddress($address, $subject);
                        $mail->addAddress('andrelopez012@gmail.com', 'andre');
                        $mail->isHTML(true);
                        $mail->Subject = $subject;
                        $mail->Body    = $mailContent;
                        $mail->CharSet = 'UTF-8';

                        $mail->send();
                    } catch (Exception $e) {
                        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
                    }
                    $tablaMedic = '';
                }
            }
        }

        //CORREO DE LABORATORIO
        if ($sesionLaboratorios) {

            $medicosConsultasProductosLab = "a" . $year . "medconsultas_examenes";

            $arrRecLab = array();
            $var_consulta = "SELECT med_coe_lab_id var_id_lab,
                                    med_coe_lax_id var_id_exa
                            FROM $medicosConsultasProductosLab 
                            WHERE med_coe_id = $med_con_id_
                            ORDER BY var_id_lab";
            $sql = pg_query($tmfMed, $var_consulta);
            $total = pg_num_rows($sql);
            //print_r( $var_consulta);

            while ($rTMP = pg_fetch_assoc($sql)) {

                $arrRecLab[$rTMP["var_id_lab"]]["idLab"] = $rTMP["var_id_lab"];
                $arrRecLab[$rTMP['var_id_lab']]['productos'][$rTMP['var_id_exa']]['pro_id'] = $rTMP['var_id_exa'];
            }
            pg_free_result($sql);

            $tablaMedic = '';
            if (is_array($arrRecLab) && (count($arrRecLab) > 0)) {
                reset($arrRecLab);
                foreach ($arrRecLab as $keyC => $valueC) {

                    $med_coe_lab_id = $valueC['idLab'];

                    if (isset($valueC["productos"]) && is_array($valueC["productos"]) && (count($valueC["productos"]) > 0)) {
                        reset($valueC["productos"]);
                        foreach ($valueC["productos"] as $keyP => $valueP) {

                            $med_coe_lax_id = $valueP['pro_id'];
                            $rs = pg_query($rmfAdm, "SELECT ctg_lce_descrip,ctg_lce_obs,ctg_lce_pre
                            FROM ctg_lab_clinicos_examenes exa
                            WHERE ctg_lce_code = '$med_coe_lax_id'");
                            if ($row = pg_fetch_array($rs)) {
                                $idRow0 = trim($row[0]);
                                $idRow1 = trim($row[1]);
                                $idRow2 = trim($row[2]);
                            }
                            $ctg_lce_descrip = isset($idRow0) ? $idRow0  : '';
                            $ctg_lce_obs = isset($idRow1) ? $idRow1  : '';
                            $ctg_lce_pre = isset($idRow2) ? $idRow2  : '';

                            $tablaMedic .=
                                '<tr border="1" >
                                <td align="right" width="10%" bgcolor= "#3498db">Codigo del examen: </td>'
                                . '<td width="50%">' . $med_coe_lax_id . '</td> </tr>'
                                . '<tr border="1" >'
                                . '<td bgcolor= "#3498db" align="right">Nombre del examen: </td>'
                                . '<td>' . $ctg_lce_descrip . '</td></tr>'
                                . '<tr border="1">'
                                . '<td bgcolor= "#3498db" align="right">Observaciones: </td>'
                                . '<td align="justify" >' . $ctg_lce_obs . '</td></tr>'
                                . '<tr border="1">'
                                . '<td bgcolor= "#3498db" align="right">Precio: </td>'
                                . '<td align="justify" >' . $ctg_lce_pre . '</td></tr>'
                                . '<tr border="1" >'
                                . '<td>.</td></tr>';
                        }
                    }

                    $rs = pg_query($rmfAdm, "SELECT ctg_lab_nomcom,ctg_lab_email
                                                    FROM ctg_lab_clinicos
                                                    WHERE ctg_lab_code = '$med_coe_lab_id'");
                    if ($row = pg_fetch_array($rs)) {
                        $idRowS0 = trim($row[0]);
                        $idRowS1 = trim($row[1]);
                    }
                    $ctg_lab_nomcom = isset($idRowS0) ? $idRowS0  : '';
                    $ctg_lab_email = isset($idRowS1) ? $idRowS1  : '';
                    $total = 0;
                    $subject_ = 'ORDEN DE LABORATORIO CLINICO - ' . ' ' . $med_con_id_;
                    $address_  =  $ctg_lab_email;
                    $mailContent = '<br>VisualMed - ORDEN DE LABORATORIO CLINICO - ' . $ctg_lab_nomcom . ' </br><br>
                                        <table class="default" width="100%">
                                        <tr border="1">
                                            <td align="center" bgcolor= "#0464fc">
                                                <img src="https://i.ibb.co/MZ35wKk/vmo-header2-1.png" alt="vmo-header2-1" border="0">
                                            </td>
                                        </tr>
                                    </table>
                                    <table class="default" width="100%">
                                    <tr border="1">
                                    <td align="center"><h3>Dr. ' . $nombreCmMedico . '</h3></td><br>
                                    </tr>
                                    <tr border="1">
                                    <td align="center"><b>' . $medicoDireccion . '</b></td><br>
                                    </tr>
                                    <tr border="1">
                                    <td align="center"><b>' . $medicoTelefono . '</b></td>
                                    </tr>
                                    </table><br><br>
        
                                    <b color="teal">Numero de orden:</b><a>' . $med_con_id_ . '</a><br>
                                    <b color="teal">Nombre del laboratorio:</b><a>' . $ctg_lab_nomcom . '</a><br>
                                    <b color="teal">Fecha de la orden:</b><a>' . $fechaDia . '</a><br><br>
        
                                    <b color="teal">EXAMENES DE LABORATORIO ORDENADOS</b><br><br>
                                    <table class="default" width="100%">'
                        . $tablaMedic . '
                                    </table>
                                    <br>
                                    <b color="teal">COSTO TOTAL:</b><a>' . $total . '</a><br>
                                    <br><br><br>
                                    <table class="default" width="100%">
                                        <tr border="1">
                                            <td align="center" bgcolor= "#0464fc">
                                                <img src="https://i.ibb.co/ckwzNgQ/vmo-footer2-1.png" alt="vmo-footer2-1" border="0">
                                            </td>
                                        </tr>
                                    </table>';

                    $mail = new PHPMailer(true);
                    try {
                        $mail->SMTPDebug = 0;
                        $mail->isSMTP();
                        $mail->Host       = 'mail.privateemail.com';
                        $mail->SMTPAuth   = true;
                        $mail->Username   = 'dor.contacto@visualmed.online';
                        $mail->Password   = 'D0r.C0ntact02020';
                        $mail->SMTPSecure = 'TLS';
                        $mail->Port       =  587;
                        $mail->setFrom('dor.contacto@visualmed.online', 'VisualMed');
                        $subject  = $subject_;
                        $address  = $address_;
                        $mail->addAddress($address, $subject);
                        $mail->addAddress('andrelopez012@gmail.com', 'andre');
                        $mail->isHTML(true);
                        $mail->Subject = $subject;
                        $mail->Body    = $mailContent;
                        $mail->CharSet = 'UTF-8';

                        $mail->send();
                    } catch (Exception $e) {
                        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
                    }
                    $tablaMedic = '';
                }
            }
        }

        //CORREO DE HOSPITAL
        if ($sesionHospitales) {

            $medicosConsultasProductosHos = "a" . $year . "medconsultas_hospitales";

            $arrRecHos = array();
            $var_consulta = "SELECT med_coh_hos_id var_id_hos,
                                    med_coh_ser_id var_id_ser
                            FROM $medicosConsultasProductosHos 
                            WHERE med_coh_id = $med_con_id_
                            ORDER BY var_id_hos";
            $sql = pg_query($tmfMed, $var_consulta);
            $total = pg_num_rows($sql);
            //print_r( $var_consulta);

            while ($rTMP = pg_fetch_assoc($sql)) {

                $arrRecHos[$rTMP["var_id_hos"]]["idHos"] = $rTMP["var_id_hos"];
                $arrRecHos[$rTMP['var_id_hos']]['productos'][$rTMP['var_id_ser']]['pro_id'] = $rTMP['var_id_ser'];
            }
            pg_free_result($sql);

            $tablaMedic = '';
            if (is_array($arrRecHos) && (count($arrRecHos) > 0)) {
                reset($arrRecHos);
                foreach ($arrRecHos as $keyC => $valueC) {

                    $med_coh_hos_id = $valueC['idHos'];

                    if (isset($valueC["productos"]) && is_array($valueC["productos"]) && (count($valueC["productos"]) > 0)) {
                        reset($valueC["productos"]);
                        foreach ($valueC["productos"] as $keyP => $valueP) {

                            $med_coh_ser_id = $valueP['pro_id'];
                            $rs = pg_query($rmfAdm, "SELECT ctg_hpp_descrip,ctg_hpp_obs,ctg_hpp_pre
                                                    FROM ctg_hospitales_servicios  
                                                    WHERE ctg_hpp_code = '$med_coh_ser_id'");
                            if ($row = pg_fetch_array($rs)) {
                                $idRow0 = trim($row[0]);
                                $idRow1 = trim($row[1]);
                                $idRow2 = trim($row[2]);
                            }
                            $ctg_hpp_descrip = isset($idRow0) ? $idRow0  : '';
                            $ctg_hpp_obs = isset($idRow1) ? $idRow1  : '';
                            $ctg_hpp_pre = isset($idRow2) ? $idRow2  : '';

                            $tablaMedic .=
                                '<tr border="1" >
                                <td align="right" width="10%" bgcolor= "#3498db">Codigo de servicio: </td>'
                                . '<td width="50%">' . $med_coh_ser_id . '</td> </tr>'
                                . '<tr border="1" >'
                                . '<td bgcolor= "#3498db" align="right">Nombre del Servicio: </td>'
                                . '<td>' . $ctg_hpp_descrip . '</td></tr>'
                                . '<tr border="1">'
                                . '<td bgcolor= "#3498db" align="right">Observaciones: </td>'
                                . '<td align="justify" >' . $ctg_hpp_obs . '</td></tr>'
                                . '<tr border="1">'
                                . '<td bgcolor= "#3498db" align="right">Precio: </td>'
                                . '<td align="justify" >' . $ctg_hpp_pre . '</td></tr>'
                                . '<tr border="1" >'
                                . '<td>.</td></tr>';
                        }
                    }

                    $rs = pg_query($rmfAdm, "SELECT ctg_hos_nomcom,ctg_hos_email
                                                    FROM ctg_hospitales
                                                    WHERE ctg_hos_code = '$med_coh_hos_id'");
                    if ($row = pg_fetch_array($rs)) {
                        $idRowS0 = trim($row[0]);
                        $idRowS1 = trim($row[1]);
                    }
                    $ctg_hos_nomcom = isset($idRowS0) ? $idRowS0  : '';
                    $ctg_hos_email = isset($idRowS1) ? $idRowS1  : '';
                    $total = 0;
                    $subject_ = 'ORDEN DE SERVICIOS HOSPITALARIOS - ' . ' ' . $med_con_id_;
                    $address_  =  $ctg_hos_email;
                    $mailContent = '<br>VisualMed - ORDEN DE SERVICIOS HOSPITALARIOS - ' . $ctg_hos_nomcom . ' </br><br>
                                    <table class="default" width="100%">
                                    <tr border="1">
                                        <td align="center" bgcolor= "#0464fc">
                                            <img src="https://i.ibb.co/MZ35wKk/vmo-header2-1.png" alt="vmo-header2-1" border="0">
                                        </td>
                                    </tr>
                                </table>
                                    <table class="default" width="100%">
                                    <tr border="1">
                                    <td align="center"><h3>Dr. ' . $nombreCmMedico . '</h3></td><br>
                                    </tr>
                                    <tr border="1">
                                    <td align="center"><b>' . $medicoDireccion . '</b></td><br>
                                    </tr>
                                    <tr border="1">
                                    <td align="center"><b>' . $medicoTelefono . '</b></td>
                                    </tr>
                                    </table><br><br>
        
                                    <b color="teal">Numero de orden:</b><a>' . $med_con_id_ . '</a><br>
                                    <b color="teal">Nombre del hospital:</b><a>' . $ctg_hos_nomcom . '</a><br>
                                    <b color="teal">Fecha de la orden:</b><a>' . $fechaDia . '</a><br><br>
        
                                    <b color="teal">SERVICIOS HOSPITALARIOS ORDENADOS</b><br><br>
                                    <table class="default" width="100%">'
                        . $tablaMedic . '
                                    </table><br>
                                    <b color="teal">COSTO TOTAL:</b><a>' . $total . '</a><br>
                                    <br>
                                    <table class="default" width="100%">
                                        <tr border="1">
                                            <td align="center" bgcolor= "#0464fc">
                                                <img src="https://i.ibb.co/ckwzNgQ/vmo-footer2-1.png" alt="vmo-footer2-1" border="0">
                                            </td>
                                        </tr>
                                    </table>';

                    $mail = new PHPMailer(true);
                    try {
                        $mail->SMTPDebug = 0;
                        $mail->isSMTP();
                        $mail->Host       = 'mail.privateemail.com';
                        $mail->SMTPAuth   = true;
                        $mail->Username   = 'dor.contacto@visualmed.online';
                        $mail->Password   = 'D0r.C0ntact02020';
                        $mail->SMTPSecure = 'TLS';
                        $mail->Port       =  587;
                        $mail->setFrom('dor.contacto@visualmed.online', 'VisualMed');
                        $subject  = $subject_;
                        $address  = $address_;
                        $mail->addAddress($address, $subject);
                        $mail->addAddress('andrelopez012@gmail.com', 'andre');
                        $mail->isHTML(true);
                        $mail->Subject = $subject;
                        $mail->Body    = $mailContent;
                        $mail->CharSet = 'UTF-8';

                        $mail->send();
                    } catch (Exception $e) {
                        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
                    }
                    $tablaMedic = '';
                }
            }
        }
        print json_encode($arrInfo);
        die();
    }

    if ($strTipoValidacion == "insert_cita_paciente") {
        require_once "../../data/conexion/tmfPac.php";
        $medicosConsultasCitasPac = "a" . $year . "_citas";
        $medicosConsultasCitasMedG = "a" . $year . "medcitas";
        $medCitas = "med" . $idUser . "citas";

        //header('Content-Type: application/json');
        $ctg_cit_estatus = 0;
        $var_consulta = "INSERT INTO $medicosConsultasCitasPac(med_cit_id,med_cit_cita_dt,med_cit_med_id,med_cit_pac_id,med_cit_motivo,med_cit_estatus,med_cit_sta,med_cit_dt,med_cit_usr) VALUES ($med_con_id_,'$proxima_cita_','$usuario','$med_con_pac_id','$med_con_motivo','$ctg_cit_estatus','$stat','$fechaIng','$usuario');";

        $val = 1;
        if (pg_query($tmfPac, $var_consulta)) {
            $arrInfo['status'] = $val;
        } else {
            $arrInfo['status'] = 0;
            $arrInfo['error'] = $var_consulta;
        }
        //print_r($var_consulta);
        print json_encode($arrInfo);

        $var_consulta = "INSERT INTO $medicosConsultasCitasMedG(med_cit_id,med_cit_cita_dt,med_cit_med_id,med_cit_pac_id,med_cit_motivo,med_cit_estatus,med_cit_sta,med_cit_dt,med_cit_usr) VALUES ($med_con_id_,'$proxima_cita_','$usuario','$med_con_pac_id','$med_con_motivo','$ctg_cit_estatus','$stat','$fechaIng','$usuario');";

        $val = 2;
        if (pg_query($tmfMed, $var_consulta)) {
            $arrInfo['status'] = $val;
        } else {
            $arrInfo['status'] = 0;
            $arrInfo['error'] = $var_consulta;
        }
        //print_r($var_consulta);
        print json_encode($arrInfo);

        $var_consulta = "INSERT INTO $medCitas(med_cit_id,med_cit_cita_dt,med_cit_pac_id,med_cit_motivo,med_cit_estatus,med_cit_sta,med_cit_dt,med_cit_usr) VALUES ($med_con_id_,'$proxima_cita_','$med_con_pac_id','$med_con_motivo','$ctg_cit_estatus','$stat','$fechaIng','$usuario');";

        $val = 3;
        if (pg_query($tmfMed, $var_consulta)) {
            $arrInfo['status'] = $val;
        } else {
            $arrInfo['status'] = 0;
            $arrInfo['error'] = $var_consulta;
        }
        //print_r($var_consulta);
        print json_encode($arrInfo);
        die();
    }
    //////////////////// INSERT SESIONES MEDICOS 
    if ($strTipoValidacion == "med_insert_med") {
        //header('Content-Type: application/json');

        $tablaConsultasMed = "med" . $id . "consultas_productos";

        if (isset($_SESSION['CARRITOMED'])) {
            reset($_SESSION['CARRITOMED']);
            foreach ($_SESSION['CARRITOMED'] as $indice => $producto) {

                $var_consulta = "INSERT INTO $tablaConsultasMed(med_cop_id,med_cop_far_id,med_cop_pro_id,med_cop_pre,med_cop_can,med_cop_desf,med_cop_desl,med_cop_valor,med_cop_sta,med_cop_dt,med_cop_usr) VALUES ($med_con_id_,'" . $producto["CTG_FAR_CODE"] . "','" . $producto["CTG_FAP_PRO"] . "','" . $producto["CTG_FAP_PRE"] . "','" . $producto["CANTIDAD"] . "',NULL,NULL,NULL,'$stat','$fechaIng','$usuario');";
                $val = 1;
                if (pg_query($tmfMed, $var_consulta)) {
                    $arrInfo['status'] = $val;
                } else {
                    $arrInfo['status'] = 0;
                    $arrInfo['error'] = $var_consulta;
                }
                //print_r($var_consulta);
                print json_encode($arrInfo);
                // unset($_SESSION['CARRITOMED']);
            }
        }

        die();
    }
    if ($strTipoValidacion == "med_insert_vac") {
        //header('Content-Type: application/json');

        $tablaConsultasVacc = "med" . $id . "consultas_vacunas";
        $tablaVacc = "med" . $id . "vacunas";

        if (isset($_SESSION['CARRITOVAC'])) {
            reset($_SESSION['CARRITOVAC']);
            foreach ($_SESSION['CARRITOVAC'] as $indice => $producto) {

                $var_consulta = "INSERT INTO $tablaConsultasVacc(med_cov_id,med_cov_vac_id,med_cov_dosis,med_cov_obs,med_cov_sta,med_cov_dt,med_cov_usr,med_cov_pre) VALUES ($med_con_id_,'" . $producto["MED_VAC_ID"] . "','" . $producto["CANTIDAD"] . "',NULL,'$stat','$fechaIng','$usuario','" . $producto["MED_VAC_PRECIO"] . "');";
                $val = 1;
                if (pg_query($tmfMed, $var_consulta)) {
                    $arrInfo['status'] = $val;
                } else {
                    $arrInfo['status'] = 0;
                    $arrInfo['error'] = $var_consulta;
                }
                //print_r($var_consulta);
                print json_encode($arrInfo);

                $var_consulta = "UPDATE $tablaVacc SET med_vac_vent = med_vac_vent + 1, med_vac_sal_act = (med_vac_sali + med_vac_comp) - (med_vac_vent + 1) WHERE med_vac_id = '" . $producto["MED_VAC_ID"] . "';";
                $val = 2;
                if (pg_query($tmfMed, $var_consulta)) {
                    $arrInfo['status'] = $val;
                } else {
                    $arrInfo['status'] = 0;
                    $arrInfo['error'] = $var_consulta;
                }
                //print_r($var_consulta);
                print json_encode($arrInfo);
                //unset($_SESSION['CARRITOVAC']);
            }
        }
        die();
    }
    if ($strTipoValidacion == "med_insert_lab") {
        //('Content-Type: application/json');

        $tablaConsultasExa = "med" . $id . "consultas_examenes";
        $tablaConsultasExaY = "a" . $year . "medconsultas_examenes";

        if (isset($_SESSION['CARRITOLAB'])) {
            reset($_SESSION['CARRITOLAB']);
            foreach ($_SESSION['CARRITOLAB'] as $indice => $producto) {

                $var_consulta = "INSERT INTO $tablaConsultasExa(med_coe_id,med_coe_lab_id,med_coe_lax_id,med_coe_pre,med_coe_can,med_coe_desl,med_coe_valor,med_coe_sta,med_coe_dt,med_coe_usr) VALUES ($med_con_id_,'" . $producto["CTG_LAB_CODE"] . "','" . $producto["CTG_LCE_CODE"] . "','" . $producto["CTG_LCE_PRE"] . "','" . $producto["CANTIDAD"] . "',NULL,NULL,'$stat','$fechaIng','$usuario');";
                $val = 1;
                if (pg_query($tmfMed, $var_consulta)) {
                    $arrInfo['status'] = $val;
                } else {
                    $arrInfo['status'] = 0;
                    $arrInfo['error'] = $var_consulta;
                }
                print json_encode($arrInfo);

                $var_consulta = "INSERT INTO $tablaConsultasExaY(med_coe_id,med_coe_lab_id,med_coe_lax_id,med_coe_pre,med_coe_can,med_coe_desl,med_coe_valor,med_coe_sta,med_coe_dt,med_coe_usr) VALUES ($med_con_id_,'" . $producto["CTG_LAB_CODE"] . "','" . $producto["CTG_LCE_CODE"] . "','" . $producto["CTG_LCE_PRE"] . "','" . $producto["CANTIDAD"] . "',NULL,NULL,'$stat','$fechaIng','$usuario');";
                $val = 2;
                if (pg_query($tmfMed, $var_consulta)) {
                    $arrInfo['status'] = $val;
                } else {
                    $arrInfo['status'] = 0;
                    $arrInfo['error'] = $var_consulta;
                }
                // print_r($var_consulta);
                print json_encode($arrInfo);
                // unset($_SESSION['CARRITOLAB']);
            }
        }
        die();
    }
    if ($strTipoValidacion == "med_insert_hosp") {
        //header('Content-Type: application/json');

        $tablaConsultasHosp = "med" . $id . "consultas_hospitales";
        $tablaConsultasHospY = "a" . $year . "medconsultas_hospitales";


        if (isset($_SESSION['CARRITOHOSP'])) {
            reset($_SESSION['CARRITOHOSP']);
            foreach ($_SESSION['CARRITOHOSP'] as $indice => $producto) {
                $med_coh_desl = 0;
                $med_coh_valor =  $producto["CTG_HPP_PRE"] * $producto["CANTIDAD"];


                $var_consulta = "INSERT INTO $tablaConsultasHosp(med_coh_id,med_coh_hos_id,med_coh_ser_id,med_coh_pre,med_coh_can,med_coh_desl,med_coh_valor,med_coh_sta,med_coh_dt,med_coh_usr) VALUES ($med_con_id_,'" . $producto["CTG_HOS_CODE"] . "','" . $producto["CTG_HPP_CODE"] . "','" . $producto["CTG_HPP_PRE"] . "','" . $producto["CANTIDAD"] . "', '$med_coh_desl','$med_coh_valor','$stat','$fechaIng','$usuario');";
                $val = 1;
                if (pg_query($tmfMed, $var_consulta)) {
                    $arrInfo['status'] = $val;
                } else {
                    $arrInfo['status'] = 0;
                    $arrInfo['error'] = $var_consulta;
                }
                //print_r($var_consulta);
                print json_encode($arrInfo);

                $var_consulta = "INSERT INTO $tablaConsultasHospY(med_coh_id,med_coh_hos_id,med_coh_ser_id,med_coh_pre,med_coh_can,med_coh_desl,med_coh_valor,med_coh_sta,med_coh_dt,med_coh_usr) VALUES ($med_con_id_,'" . $producto["CTG_HOS_CODE"] . "','" . $producto["CTG_HPP_CODE"] . "','" . $producto["CTG_HPP_PRE"] . "','" . $producto["CANTIDAD"] . "', '$med_coh_desl','$med_coh_valor','$stat','$fechaIng','$usuario');";
                $val = 2;
                if (pg_query($tmfMed, $var_consulta)) {
                    $arrInfo['status'] = $val;
                } else {
                    $arrInfo['status'] = 0;
                    $arrInfo['error'] = $var_consulta;
                }
                //print_r($var_consulta);
                print json_encode($arrInfo);
                // unset($_SESSION['CARRITOHOSP']);
            }
        }
        die();
    }
    ///////////////////// INSERT SESSIONES PACIENTES////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    if ($strTipoValidacion == "pac_insert_med") {
        require_once "../../data/conexion/tmfPac.php";
        //header('Content-Type: application/json');
        $medicosConsultasProductosMed = "a" . $year . "medconsultas_productos";
        $medicosConsultasProductosFar = "a" . $year . "_medicos_consultas_productos";
        $medicosConsultasProductosPac = "a" . $year . "_medicos_consultas_productos";

        if (isset($_SESSION['CARRITOMED'])) {
            reset($_SESSION['CARRITOMED']);
            foreach ($_SESSION['CARRITOMED'] as $indice => $producto) {
                $idPac = $idPacientedFarmacia;
                $Mrs = pg_query($tmfMed, "SELECT  med_cop_id, med_cop_far_id, med_cop_pro_id FROM $medicosConsultasProductosMed ORDER BY med_cop_id DESC LIMIT 1");
                if ($row = pg_fetch_array($Mrs)) {
                    $MidRow1 = trim($row[0]);
                    $MidRow2 = trim($row[0]);
                    $MidRow3 = trim($row[0]);
                }
                $Mcode1 = isset($MidRow1) ? $MidRow1  : '';
                $Mcode2 = isset($MidRow2) ? $MidRow2  : '';
                $Mcode3 = isset($MidRow3) ? $MidRow3  : '';

                if ($med_con_id_ <> $Mcode1 || $Mcode2 <> $producto["CTG_FAR_CODE"]  || $Mcode3 <> $producto["CTG_FAP_PRO"]) {
                    $var_consulta = "INSERT INTO $medicosConsultasProductosMed(med_cop_id,med_cop_far_id,med_cop_pro_id,med_cop_pre,med_cop_can,med_cop_desf,med_cop_desl,med_cop_valor,med_cop_sta,med_cop_dt,med_cop_usr) VALUES ($med_con_id_,'" . $producto["CTG_FAR_CODE"] . "','" . $producto["CTG_FAP_PRO"] . "','" . $producto["CTG_FAP_PRE"] . "','" . $producto["CANTIDAD"] . "',NULL,NULL,NULL,'$stat','$fechaIng','$usuario');";
                    $val = 1;
                    if (pg_query($tmfMed, $var_consulta)) {
                        $arrInfo['status'] = $val;
                    } else {
                        $arrInfo['status'] = 0;
                        $arrInfo['error'] = $var_consulta;
                    }
                    //print_r($var_consulta);
                    print json_encode($arrInfo);
                }
                $Prs = pg_query($tmfFar, "SELECT med_cop_id , med_cop_med_id, med_cop_pac_id, med_cop_far_id, med_cop_pro_id FROM $medicosConsultasProductosFar ORDER BY med_cop_id DESC LIMIT 1");
                if ($row = pg_fetch_array($Prs)) {
                    $PidRow1 = trim($row[0]);
                    $PidRow2 = trim($row[1]);
                    $PidRow3 = trim($row[2]);
                    $PidRow4 = trim($row[3]);
                    $PidRow5 = trim($row[4]);
                }

                $Pcode1 = isset($PidRow1) ? $PidRow1  : '';
                $Pcode2 = isset($PidRow2) ? $PidRow2  : '';
                $Pcode3 = isset($PidRow3) ? $PidRow3  : '';
                $Pcode4 = isset($PidRow4) ? $PidRow4  : '';
                $Pcode5 = isset($PidRow5) ? $PidRow5  : '';

                if ($med_con_id_ <> $Pcode1 || $idUser <> $Pcode2 || $idPac <> $Pcode3 || $producto["CTG_FAR_CODE"] <> $Pcode4 || $producto["CTG_FAP_PRO"] <> $Pcode5) {
                    $var_consulta = "INSERT INTO $medicosConsultasProductosFar(med_cop_id,med_cop_med_id,med_cop_pac_id,med_cop_far_id,med_cop_pro_id,med_cop_pre,med_cop_can,med_cop_desf,med_cop_desl,med_cop_valor,med_cop_sta,med_cop_dt,med_cop_usr) VALUES ($med_con_id_,'$idUser','$idPac','" . $producto["CTG_FAR_CODE"] . "','" . $producto["CTG_FAP_PRO"] . "','" . $producto["CTG_FAP_PRE"] . "','" . $producto["CANTIDAD"] . "',NULL,NULL,NULL,'$stat','$fechaIng','$usuario');";
                    $val = 2;
                    if (pg_query($tmfFar, $var_consulta)) {
                        $arrInfo['status'] = $val;
                    } else {
                        $arrInfo['status'] = 0;
                        $arrInfo['error'] = $var_consulta;
                    }
                    //print_r($var_consulta);
                    print json_encode($arrInfo);
                }


                $Frs = pg_query($tmfPac, "SELECT med_cop_id , med_cop_med_id, med_cop_pac_id, med_cop_far_id, med_cop_pro_id FROM $medicosConsultasProductosPac ORDER BY med_cop_id DESC LIMIT 1");
                if ($row = pg_fetch_array($Frs)) {
                    $FidRow1 = trim($row[0]);
                    $FidRow2 = trim($row[1]);
                    $FidRow3 = trim($row[2]);
                    $FidRow4 = trim($row[3]);
                    $FidRow5 = trim($row[4]);
                }
                $Fcode1 = isset($FidRow1) ? $FidRow1  : '';
                $Fcode2 = isset($FidRow2) ? $FidRow2  : '';
                $Fcode3 = isset($FidRow3) ? $FidRow3  : '';
                $Fcode4 = isset($FidRow4) ? $FidRow4  : '';
                $Fcode5 = isset($FidRow5) ? $FidRow5  : '';

                if ($med_con_id_ <> $Fcode1 || $idUser <> $Fcode2 || $idPac <> $Fcode3 || $producto["CTG_FAR_CODE"] <> $Fcode4 || $producto["CTG_FAP_PRO"] <> $Fcode5) {
                    $var_consulta = "INSERT INTO $medicosConsultasProductosPac(med_cop_id,med_cop_med_id,med_cop_pac_id,med_cop_far_id,med_cop_pro_id,med_cop_pre,med_cop_can,med_cop_desf,med_cop_desl,med_cop_valor,med_cop_sta,med_cop_dt,med_cop_usr) VALUES ($med_con_id_,'$idUser','$idPac','" . $producto["CTG_FAR_CODE"] . "','" . $producto["CTG_FAP_PRO"] . "','" . $producto["CTG_FAP_PRE"] . "','" . $producto["CANTIDAD"] . "',NULL,NULL,NULL,'$stat','$fechaIng','$usuario');";
                    $val = 3;
                    if (pg_query($tmfPac, $var_consulta)) {
                        $arrInfo['status'] = $val;
                    } else {
                        $arrInfo['status'] = 0;
                        $arrInfo['error'] = $var_consulta;
                    }
                    //print_r($var_consulta);
                    print json_encode($arrInfo);
                }
            }
        }

        die();
    }
    if ($strTipoValidacion == "pac_insert_med_pac") {
        require_once "../../data/conexion/tmfPac.php";
        // header('Content-Type: application/json');

        $farmacias_orden_ = "a" . $year . "_farmacias_orden";
        $farmacias_orden_items_ = "a" . $year . "_farmacias_orden_prod";

        $namePac = $nombrePacientedFarmacia;
        $idPac = $idPacientedFarmacia;

        if (isset($_SESSION['CARRITOMED'])) {
            reset($_SESSION['CARRITOMED']);
            foreach ($_SESSION['CARRITOMED'] as $indice => $producto) {

                $rsClinica = pg_query($tmfPac, "SELECT COUNT(*) FROM $farmacias_orden_ WHERE far_ord_cod = $med_con_id_ LIMIT 1");
                if ($row = pg_fetch_array($rsClinica)) {
                    $idRowExa = trim($row[0]);
                }
                //print_r($rsClinica);

                $OrdenClinica = isset($idRowExa) ? $idRowExa : 0;

                if (empty($OrdenClinica)) {
                    // $TOTAL = isset($_POST["TOTAL"]) ? $_POST["TOTAL"]  : 0; //valor total de la orden
                    $TOTAL = $producto["CANTIDAD"] * $producto["CTG_FAP_PRE"];
                    $far_ord_por_fac = 0; //Porcentaje de descuento del laboratorio clinico
                    $far_ord_por_laf = 0; //valor descuento laboratorio
                    $far_ord_valor_iva = ($TOTAL / 1.12) * 0.12;  //valor iva
                    $far_ord_valor_iva = number_format($far_ord_valor_iva, 2);  //valor iva
                    $far_ord_est = 1;
                    $far_ord_sta = 1;
                    $far_ord_valor_desf = 0.0;
                    $far_ord_valor_desl = 0.0;
                    $far_ord_pac_mem_id = 0;

                    $fullFarmacia = $producto["CTG_FAR_NOMCOM"] . '' . $producto["CTG_FAR_SUC"];
                    $far_ord_far_id = $producto["CTG_FAR_CODE"];

                    $var_consulta = "INSERT INTO $farmacias_orden_(far_ord_cod,far_ord_comcom,far_ord_far_id,far_ord_tipo,far_ord_fec,far_ord_med_id,far_ord_pac_id,far_ord_pac_nombre,far_ord_pac_mem_id,far_ord_por_fac,far_ord_por_laf,far_ord_valor,far_ord_valor_desf,far_ord_valor_desl,far_ord_valor_iva,far_ord_total,far_ord_est,far_ord_sta,far_ord_dt,far_ord_usr) VALUES ($med_con_id_,'$fullFarmacia','$far_ord_far_id','1','$fechaIng','$idUser','$idPac','$namePac','$far_ord_pac_mem_id','$far_ord_por_fac','$far_ord_por_laf','$TOTAL','$far_ord_valor_desf','$far_ord_valor_desl','$far_ord_valor_iva','$TOTAL','$far_ord_est','$far_ord_sta','$fechaIng','$usuario');";
                    $val = 1;
                    if (pg_query($tmfPac, $var_consulta)) {
                        $arrInfo['status'] = $val;
                    } else {
                        $arrInfo['status'] = 0;
                        $arrInfo['error'] = $var_consulta;
                    }
                    //print_r($var_consulta);
                    print json_encode($arrInfo);

                    $var_consulta = "INSERT INTO $farmacias_orden_(far_ord_cod,far_ord_comcom,far_ord_far_id,far_ord_tipo,far_ord_fec,far_ord_med_id,far_ord_pac_id,far_ord_pac_nombre,far_ord_pac_mem_id,far_ord_por_fac,far_ord_por_laf,far_ord_valor,far_ord_valor_desf,far_ord_valor_desl,far_ord_valor_iva,far_ord_total,far_ord_est,far_ord_sta,far_ord_dt,far_ord_usr) VALUES ($med_con_id_,'$fullFarmacia','$far_ord_far_id','1','$fechaIng','$idUser','$idPac','$namePac','$far_ord_pac_mem_id','$far_ord_por_fac','$far_ord_por_laf','$TOTAL','$far_ord_valor_desf','$far_ord_valor_desl','$far_ord_valor_iva','$TOTAL','$far_ord_est','$far_ord_sta','$fechaIng','$usuario');";
                    $val = 2;
                    if (pg_query($tmfFar, $var_consulta)) {
                        $arrInfo['status'] = $val;
                    } else {
                        $arrInfo['status'] = 0;
                        $arrInfo['error'] = $var_consulta;
                    }
                    //print_r($var_consulta);
                    print json_encode($arrInfo);
                }
                if ($idPac) {
                    $total = $producto["CANTIDAD"] * $producto["CTG_FAP_PRE"];

                    $var_consulta = "INSERT INTO $farmacias_orden_items_(far_orp_cod,far_orp_med_id,far_orp_pac_id,far_orp_pro_id,far_orp_pre,far_orp_can,far_orp_desf,far_orp_desl,far_orp_valor,far_orp_sta,far_orp_dt,far_orp_usr)VALUES ($med_con_id_,'$idUser','$idPac','" . $producto["CTG_FAP_PRO"] . "','" . $producto["CTG_FAP_PRE"] . "','" . $producto["CANTIDAD"] . "',$total,NULL,NULL,'$stat','$fechaIng','$usuario');";
                    $val = 3;
                    if (pg_query($tmfPac, $var_consulta)) {
                        $arrInfo['status'] = $val;
                    } else {
                        $arrInfo['status'] = 0;
                        $arrInfo['error'] = $var_consulta;
                    }
                    //print_r($var_consulta);
                    print json_encode($arrInfo);

                    $var_consulta = "INSERT INTO $farmacias_orden_items_(far_orp_cod,far_orp_med_id,far_orp_pac_id,far_orp_pro_id,far_orp_pre,far_orp_can,far_orp_desf,far_orp_desl,far_orp_valor,far_orp_sta,far_orp_dt,far_orp_usr)VALUES ($med_con_id_,'$idUser','$idPac','" . $producto["CTG_FAP_PRO"] . "','" . $producto["CTG_FAP_PRE"] . "','" . $producto["CANTIDAD"] . "',$total,NULL,NULL,'$stat','$fechaIng','$usuario');";
                    $val = 4;
                    if (pg_query($tmfFar, $var_consulta)) {
                        $arrInfo['status'] = $val;
                    } else {
                        $arrInfo['status'] = 0;
                        $arrInfo['error'] = $var_consulta;
                    }
                    //print_r($var_consulta);
                    print json_encode($arrInfo);
                    //unset($_SESSION['CARRITOLAB']);
                }
            }
        }
        die();
    }
    if ($strTipoValidacion == "pac_insert_vac") {
        require_once "../../data/conexion/tmfPac.php";
        //header('Content-Type: application/json');

        if (isset($_SESSION['CARRITOVAC'])) {
            reset($_SESSION['CARRITOVAC']);
            foreach ($_SESSION['CARRITOVAC'] as $indice => $producto) {

                //INSERT ITEMS DE ORDEN
                $medicosVacunasPac = "a" . $year . "_medicos_consultas_vacunas";

                $pacId = $idPacienteVacuna;

                $var_consulta = "INSERT INTO $medicosVacunasPac(med_cov_id,med_cov_med_id,med_cov_pac_id,med_cov_vac_id,med_cov_mat,med_cov_dosis,med_cov_obs,med_cov_sta,med_cov_dt,med_cov_usr) VALUES ($med_con_id_,'$idUser','$pacId','" . $producto["MED_VAC_ID"] . "',NULL,NULL,NULL,'$stat','$fechaIng','$usuario');";
                $val = 1;
                if (pg_query($tmfPac, $var_consulta)) {
                    $arrInfo['status'] = $val;
                } else {
                    $arrInfo['status'] = 0;
                    $arrInfo['error'] = $var_consulta;
                }
                print_r($var_consulta);
                print json_encode($arrInfo);

                // unset($_SESSION['CARRITOVAC']);
            }
        }
        die();
    }
    if ($strTipoValidacion == "pac_insert_lab") {
        require_once "../../data/conexion/tmfPac.php";
        //header('Content-Type: application/json');

        $labclinicos_orden_ = "a" . $year . "_labclinicos_orden";
        $labclinicos_orden_items_ = "a" . $year . "_labclinicos_orden_items";

        $namePac = $nombrePacientecLaboratorio;
        $idPac = $idPacientecLaboratorio;

        if (isset($_SESSION['CARRITOLAB'])) {
            reset($_SESSION['CARRITOLAB']);
            foreach ($_SESSION['CARRITOLAB'] as $indice => $producto) {

                $rsClinica = pg_query($tmfPac, "SELECT COUNT(*) FROM $labclinicos_orden_ WHERE lab_ord_cod = $med_con_id_ LIMIT 1");
                if ($row = pg_fetch_array($rsClinica)) {
                    $idRowExa = trim($row[0]);
                }
                //print_r($rsClinica);

                $OrdenClinica = isset($idRowExa) ? $idRowExa : 0;

                if (empty($OrdenClinica)) {
                    $TOTAL = isset($_POST["TOTAL"]) ? $_POST["TOTAL"]  : ''; //valor total de la orden
                    $lab_ord_por_lab = 0; //Porcentaje de descuento del laboratorio clinico
                    $lab_ord_valor_desl = 0; //valor descuento laboratorio
                    $lab_ord_valor_iva = ($TOTAL / 1.12) * 0.12;  //valor iva
                    $lab_ord_valor_iva = number_format($lab_ord_valor_iva, 2);  //valor iva
                    $lab_ord_est = 1;
                    $statOrder = 1;

                    $lab_ord_lab_id = $producto["CTG_LAB_CODE"];

                    $var_consulta = "INSERT INTO $labclinicos_orden_(lab_ord_cod,lab_ord_lab_id,lab_ord_tipo,lab_ord_pac_id,lab_ord_med_id,lab_ord_fec,lab_ord_pac_nombre,lab_ord_pac_mem_id,lab_ord_por_lab,lab_ord_valor,lab_ord_valor_desl,lab_ord_valor_iva,lab_ord_total,lab_ord_est,lab_ord_sta,lab_ord_dt,lab_ord_usr,lab_ord_nomcom) VALUES ($med_con_id_,'$lab_ord_lab_id','1','$idPac','$idUser','$fechaIng','$namePac','$idPac','$lab_ord_por_lab','$TOTAL','$lab_ord_valor_desl','$lab_ord_valor_iva','$TOTAL','$lab_ord_est','$stat','$fechaIng','$usuario','" . $producto["CTG_LAB_NOMCOM"] . "');";
                    $val = 2;
                    if (pg_query($tmfPac, $var_consulta)) {
                        $arrInfo['status'] = $val;
                    } else {
                        $arrInfo['status'] = 0;
                        $arrInfo['error'] = $var_consulta;
                    }
                    //print_r($var_consulta);
                    print json_encode($arrInfo);
                }
                if ($idPac) {

                    $var_consulta = "INSERT INTO $labclinicos_orden_items_(lab_ori_cod,lab_ori_tipo,lab_ori_pac_id,lab_ori_med_id,lab_ori_gpo_id,lab_ori_exa_id,lab_ori_pre,lab_ori_can,lab_ori_desl,lab_ori_valor,lab_ori_exa_dt,lab_ori_exa_ranmin,lab_ori_exa_ranmax,lab_ori_exa_res,lab_ori_sta,lab_ori_dt,lab_ori_usr)VALUES ($med_con_id_,'1','$idPac','$idUser','" . $producto["CTG_LAB_CODE"] . "','" . $producto["CTG_LCE_CODE"] . "','" . $producto["CTG_LCE_PRE"] . "','" . $producto["CANTIDAD"] . "',NULL,NULL,'$fechaIng',NULL,NULL,NULL,'$stat','$fechaIng','$usuario');";
                    $val = 1;
                    if (pg_query($tmfPac, $var_consulta)) {
                        $arrInfo['status'] = $val;
                    } else {
                        $arrInfo['status'] = 0;
                        $arrInfo['error'] = $var_consulta;
                    }
                    //print_r($var_consulta);
                    print json_encode($arrInfo);
                    //unset($_SESSION['CARRITOLAB']);
                }
            }
        }
        die();
    }
    if ($strTipoValidacion == "pac_insert_hosp") {
        require_once "../../data/conexion/tmfPac.php";
        //header('Content-Type: application/json');

        $hospitales_orden_ = "a" . $year . "_hospitales_orden";
        $hospitales_orden_items_ = "a" . $year . "_hospitales_orden_items";

        $namePac = $nombrePacientebHospital;
        $idPac = $idPacientebHospital;

        if (isset($_SESSION['CARRITOHOSP'])) {
            reset($_SESSION['CARRITOHOSP']);
            foreach ($_SESSION['CARRITOHOSP'] as $indice => $producto) {

                $rsHosp = pg_query($tmfPac, "SELECT COUNT(*) FROM $hospitales_orden_ WHERE hos_ord_cod = $med_con_id_ LIMIT 1");
                if ($row = pg_fetch_array($rsHosp)) {
                    $idRowHosp = trim($row[0]);
                }
                //print_r($rsHosp);

                $OrdenHosp = isset($idRowHosp) ? $idRowHosp : 0;
                $hos_ord_por_lab = '0';
                $hos_ord_valor_desh = '0';
                $hos_ord_est = '1';

                if (empty($OrdenHosp)) {
                    $TOTAL = isset($_POST["TOTAL"]) ? $_POST["TOTAL"]  : 0; //valor total de la orden
                    $hos_ord_valor_iva = ($TOTAL / 1.12) * 0.12;  //valor iva 
                    $hos_ord_valor_iva = number_format($hos_ord_valor_iva, 2);  //valor iva 
                    $hos_ord_total = $TOTAL;
                    $statOrder = 1;
                    $var_consulta = "INSERT INTO $hospitales_orden_(hos_ord_cod,hos_ord_hos_id,hos_ord_pac_id,hos_ord_tipo,hos_ord_med_id,hos_ord_fec,hos_ord_pac_nombre,hos_ord_por_lab,hos_ord_valor,hos_ord_valor_desh,hos_ord_valor_iva,hos_ord_total,hos_ord_est,hos_ord_sta,hos_ord_dt,hos_ord_usr,hos_ord_nomcom) VALUES ($med_con_id_,'" . $producto["CTG_HOS_CODE"] . "','$idPac','1','$idUser','$fechaIng','$namePac','$hos_ord_por_lab','$TOTAL','$hos_ord_valor_desh','$hos_ord_valor_iva','$hos_ord_total','$hos_ord_est','$stat','$fechaIng','$usuario','" . $producto["CTG_HOS_NOMCOM"] . "');";
                    $val = 2;
                    if (pg_query($tmfPac, $var_consulta)) {
                        $arrInfo['status'] = $val;
                    } else {
                        $arrInfo['status'] = 0;
                        $arrInfo['error'] = $var_consulta;
                    }
                    //print_r($var_consulta);
                    print json_encode($arrInfo);
                }
                if ($idPac) {
                    $lab_ori_gpo_id = $producto["CTG_HOS_CODE"];
                    $hos_ori_desh = 0;
                    $hos_ori_valor = $producto["CTG_HPP_PRE"] * $producto["CANTIDAD"];

                    $var_consulta = "INSERT INTO  $hospitales_orden_items_(hos_ori_cod,hos_ori_tipo,hos_ori_hos_id,hos_ori_pac_id,hos_ori_med_id,hos_ori_gpo_id,hos_ori_ser_id,hos_ori_pre,hos_ori_can,hos_ori_desh,hos_ori_valor,hos_ori_sta,hos_ori_dt,hos_ori_usr)VALUES ($med_con_id_,'1','" . $producto["CTG_HOS_CODE"] . "','$idPac','$idUser',' $lab_ori_gpo_id','" . $producto["CTG_HPP_CODE"] . "','" . $producto["CTG_HPP_PRE"] . "','" . $producto["CANTIDAD"] . "','$hos_ori_desh','$hos_ori_valor','$stat','$fechaIng','$usuario');";
                    $val = 1;
                    if (pg_query($tmfPac, $var_consulta)) {
                        $arrInfo['status'] = $val;
                    } else {
                        $arrInfo['status'] = 0;
                        $arrInfo['error'] = $var_consulta;
                    }
                    //print_r($var_consulta);
                    print json_encode($arrInfo);
                    //unset($_SESSION['CARRITOHOSP']);
                }
            }
        }
        die();
    }
    ///////////////////// INSERT SESSIONES HOSPITALES LABORATORIOS FARMACEUTICAS////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //////////////////////////////////////////////////////////////FARMACEUTICAS //////////////////////////////////////////////////////////////////////////////////////////////////////////////
    if ($strTipoValidacion == "insert_tmfFar") {
        require_once "../../data/conexion/tmlFar.php";
        //header('Content-Type: application/json');

        if (isset($_SESSION['CARRITOMED'])) {
            reset($_SESSION['CARRITOMED']);
            foreach ($_SESSION['CARRITOMED'] as $indice => $producto) {
                $idFar = $producto["CTG_FAR_CODE"];
                $far_orden = "far" . $idFar . "orden";
                $far_orden_prod = "far" . $idFar . "orden_prod";
                $far_prod = "far" . $idFar . "prod";

                $namePac = $nombrePacientedFarmacia;
                $idPac = $idPacientedFarmacia;

                $rsFarOrden = pg_query($tmfFar, "SELECT COUNT(*) FROM $far_orden WHERE far_ord_cod = $med_con_id_ LIMIT 1");
                if ($row = pg_fetch_array($rsFarOrden)) {
                    $idRowFar = trim($row[0]);
                }
                $OrdenFar = isset($idRowFar) ? $idRowFar : 0;

                $hos_ord_por_lab = '0';
                $hos_ord_valor_desh = '0';
                $hos_ord_est = '1';
                $TOTAL = isset($_POST["CTG_TOTAL"]) ? $_POST["CTG_TOTAL"]  : ''; //valor total de la orden

                if (empty($OrdenFar)) {

                    $far_ord_valor_iva = ($TOTAL / 1.12) * 0.12;  //valor iva 
                    $far_ord_valor_iva = number_format($far_ord_valor_iva, 2);  //valor iva 
                    $statOrder = 1;
                    $far_ord_por_fac = 0;
                    $far_ord_por_laf = 0;
                    $far_ord_valor_desf = 0;
                    $far_ord_valor_desl = 0;
                    $far_ord_nomcom = $producto["CTG_FAR_NOMCOM"];

                    $var_consulta = "INSERT INTO $far_orden(far_ord_cod,far_ord_tipo,far_ord_fec,far_ord_med_id,far_ord_pac_id,far_ord_pac_nombre,far_ord_pac_mem_id,far_ord_por_fac,far_ord_por_laf,far_ord_valor,far_ord_valor_desf,far_ord_valor_desl,far_ord_valor_iva,far_ord_total,far_ord_est,far_ord_sta,far_ord_dt,far_ord_usr,far_ord_nomcom) VALUES ($med_con_id_,'1','$fechaIng','$idUser','$idPac','$namePac','$idPac' ,'$far_ord_por_fac','$far_ord_por_laf',$TOTAL,'$far_ord_valor_desf','$far_ord_valor_desl','$far_ord_valor_iva','$TOTAL','$statOrder','$stat','$fechaIng','$usuario','$far_ord_nomcom');";
                    $val = 1;
                    if (pg_query($tmfFar, $var_consulta)) {
                        $arrInfo['status'] = $val;
                    } else {
                        $arrInfo['status'] = 0;
                        $arrInfo['error'] = $var_consulta;
                    }
                    //echo '<pre>';
                    //print_r($var_consulta);
                    //echo  '</pre>';

                    print json_encode($arrInfo);


                    $rsFarOrdenProd = pg_query($tmfFar, "SELECT COUNT(*) FROM $far_orden_prod WHERE far_orp_cod = $med_con_id_ LIMIT 1");
                    if ($row = pg_fetch_array($rsFarOrdenProd)) {
                        $idRowFarOrdenProd = trim($row[0]);
                    }
                    $OrdenFarPro = isset($idRowFarOrdenProd) ? $idRowFarOrdenProd : 0;

                    $rsFar = pg_query($tmfFar, "SELECT COUNT(*) FROM $far_orden_prod WHERE far_orp_pro_id = '" . $producto["CTG_FAP_PRO"] . "' AND far_orp_cod = $med_con_id_ LIMIT 1");
                    if ($row = pg_fetch_array($rsFar)) {
                        $idRowFarPro = trim($row[0]);
                    }
                    $ProFar = isset($idRowFarPro) ? $idRowFarPro : 0;

                    //echo '<pre> OrdenFarPro';
                    //print_r($OrdenFarPro);
                    //echo  '</pre>';
                    //echo '<pre>';
                    //print_r($ProFar);
                    //echo  '</pre> ProFar';

                    if ((empty($OrdenFarPro) && empty($ProFar)) || ($OrdenFarPro >= 1 && empty($ProFar))) {
                        $far_orp_desf = $TOTAL;
                        $far_orp_desl = 0;
                        $far_orp_valor = 0;

                        $var_consulta = "INSERT INTO  $far_orden_prod(far_orp_cod,far_orp_pro_id,far_orp_pre,far_orp_can,far_orp_desf,far_orp_desl,far_orp_valor,far_orp_sta,far_orp_dt,far_orp_usr)VALUES ($med_con_id_,'" . $producto["CTG_FAP_PRO"] . "','" . $producto["CTG_FAP_PRE"] . "','" . $producto["CANTIDAD"] . "',$far_orp_desf,'$far_orp_desl',' $far_orp_valor','$stat','$fechaIng','$usuario');";
                        $val = 2;
                        if (pg_query($tmfFar, $var_consulta)) {
                            $arrInfo['status'] = $val;
                        } else {
                            $arrInfo['status'] = 0;
                            $arrInfo['error'] = $var_consulta;
                        }
                        //echo '<pre>';
                        //print_r($var_consulta);
                        //echo  '</pre>';

                        print json_encode($arrInfo);


                        $rsFarContador = pg_query($tmfFar, "SELECT COUNT(*) FROM $far_prod WHERE far_pro_cod = '" . $producto["CTG_FAP_PRO"] . "' LIMIT 1");
                        if ($row = pg_fetch_array($rsFarContador)) {
                            $idRowFarContador = trim($row[0]);
                        }
                        $ProFarContador = isset($idRowFarContador) ? $idRowFarContador : 0;

                        if (empty($ProFarContador)) {

                            $var_consulta = "INSERT INTO  $far_prod(far_pro_cod,far_pro_contador,far_pro_sta,far_pro_dt,far_pro_usr)VALUES ('" . $producto["CTG_FAP_PRO"] . "',1,'$stat','$fechaIng','$usuario');";
                            $val = 3;
                            if (pg_query($tmfFar, $var_consulta)) {
                                $arrInfo['status'] = $val;
                            } else {
                                $arrInfo['status'] = 0;
                                $arrInfo['error'] = $var_consulta;
                            }
                            //echo '<pre>';
                            //print_r($var_consulta);
                            //echo  '</pre>';

                            print json_encode($arrInfo);
                        } else {
                            $var_consulta = "UPDATE $far_prod SET far_pro_contador = far_pro_contador + 1 WHERE far_pro_cod = '" . $producto["CTG_FAP_PRO"] . "'";
                            $val = 3;
                            if (pg_query($tmfFar, $var_consulta)) {
                                $arrInfo['status'] = $val;
                            } else {
                                $arrInfo['status'] = 0;
                                $arrInfo['error'] = $var_consulta;
                            }
                            //echo '<pre>';
                            //print_r($var_consulta);
                            //echo  '</pre>';

                            print json_encode($arrInfo);
                        }
                    }
                }
            }
        }
        die();
    }

    //////////////////////////////////////////////////////////////LABORATOPRIOS //////////////////////////////////////////////////////////////////////////////////////////////////////////////
    if ($strTipoValidacion == "insert_tmflab") {
        require_once "../../data/conexion/tmfLab.php";
        //header('Content-Type: application/json');

        if (isset($_SESSION['CARRITOLAB'])) {
            reset($_SESSION['CARRITOLAB']);
            foreach ($_SESSION['CARRITOLAB'] as $indice => $producto) {
                $idLab = $producto["CTG_LAB_CODE"];
                $lab_orden = "lab" . $idLab . "orden";
                $lab_orden_prod = "lab" . $idLab . "orden_items";
                $lab_prod = "lab" . $idLab . "examenes";

                $namePac = $nombrePacientecLaboratorio;
                $idPac = $idPacientecLaboratorio;

                $rsLabOrden = pg_query($tmfLab, "SELECT COUNT(*) FROM $lab_orden WHERE lab_ord_cod = $med_con_id_ LIMIT 1");
                if ($row = pg_fetch_array($rsLabOrden)) {
                    $idRowLab = trim($row[0]);
                }
                $OrdenLab = isset($idRowLab) ? $idRowLab : 0;

                $hos_ord_por_lab = '0';
                $hos_ord_valor_desh = '0';
                $hos_ord_est = '1';
                $TOTAL = isset($_POST["TOTAL"]) ? $_POST["TOTAL"]  : ''; //valor total de la orden

                if (empty($OrdenLab)) {

                    $lab_ord_valor_iva = ($TOTAL / 1.12) * 0.12;  //valor iva 
                    $lab_ord_valor_iva = number_format($lab_ord_valor_iva, 2);  //valor iva 
                    $statOrder = 1;
                    $lab_ord_por_lab = 0;
                    $lab_ord_valor = 0;
                    $far_ord_valor_desf = 0;
                    $lab_ord_valor_desl = 0;

                    $var_consulta = "INSERT INTO $lab_orden(lab_ord_cod,lab_ord_tipo,lab_ord_fec,lab_ord_med_id,lab_ord_pac_id,lab_ord_pac_nombre,lab_ord_pac_mem_id,lab_ord_por_lab,lab_ord_valor,lab_ord_valor_desl,lab_ord_valor_iva,lab_ord_total,lab_ord_est,lab_ord_sta,lab_ord_dt,lab_ord_usr)  VALUES ($med_con_id_,'1','$fechaIng','$idUser','$idPac','$namePac','$idPac' ,'$lab_ord_por_lab',$TOTAL,'$lab_ord_valor_desl','$lab_ord_valor_iva','$TOTAL','$statOrder','$stat','$fechaIng','$usuario');";
                    $val = 1;
                    if (pg_query($tmfLab, $var_consulta)) {
                        $arrInfo['status'] = $val;
                    } else {
                        $arrInfo['status'] = 0;
                        $arrInfo['error'] = $var_consulta;
                    }
                    //echo '<pre>';
                    //print_r($var_consulta);
                    //echo  '</pre>';
                    print json_encode($arrInfo);

                    $rsLabOrdenProd = pg_query($tmfLab, "SELECT COUNT(*) FROM $lab_orden_prod WHERE lab_ori_cod = $med_con_id_ LIMIT 1");
                    if ($row = pg_fetch_array($rsLabOrdenProd)) {
                        $idRowLabOrdenProd = trim($row[0]);
                    }
                    $OrdenLabPro = isset($idRowLabOrdenProd) ? $idRowLabOrdenProd : 0;

                    $rsLab = pg_query($tmfLab, "SELECT COUNT(*) FROM $lab_orden_prod WHERE lab_ori_exa_id = '" . $producto["CTG_LCE_CODE"] . "' AND lab_ori_cod = $med_con_id_ LIMIT 1");
                    if ($row = pg_fetch_array($rsLab)) {
                        $idRowLabPro = trim($row[0]);
                    }
                    $ProLab = isset($idRowLabPro) ? $idRowLabPro : 0;

                    //echo '<pre> OrdenLabPro';
                    //print_r($OrdenLabPro);
                    //echo  '</pre>';
                    //echo  '<pre> ProLab';
                    //print_r($ProLab);
                    //echo '</pre>';

                    if ((empty($OrdenLabPro) && empty($ProLab)) || ($OrdenLabPro >= 1 && empty($ProLab))) {
                        $lab_ori_valor = $TOTAL;
                        $far_orp_desf = 0;
                        $lab_ori_desl = 0;
                        $lab_ori_exa_ranmin = 0;
                        $lab_ori_exa_ranmax = 0;
                        $lab_ori_exa_res = "";

                        $var_consulta = "INSERT INTO  $lab_orden_prod(lab_ori_cod,lab_ori_gpo_id,lab_ori_exa_id,lab_ori_pre,lab_ori_can,lab_ori_desl,lab_ori_valor,lab_ori_exa_dt,lab_ori_exa_ranmin,lab_ori_exa_ranmax,lab_ori_exa_res,lab_ori_sta,lab_ori_dt,lab_ori_usr)
                        VALUES ($med_con_id_,'" . $producto["CTG_LAB_CODE"] . "','" . $producto["CTG_LCE_CODE"] . "','" . $producto["CTG_LCE_PRE"] . "','" . $producto["CANTIDAD"] . "',$lab_ori_desl,$lab_ori_valor,'$fechaIng','$lab_ori_exa_ranmin','$lab_ori_exa_ranmax',' $lab_ori_exa_res','$stat','$fechaIng','$usuario');";
                        $val = 2;
                        if (pg_query($tmfLab, $var_consulta)) {
                            $arrInfo['status'] = $val;
                        } else {
                            $arrInfo['status'] = 0;
                            $arrInfo['error'] = $var_consulta;
                        }
                        //echo '<pre>';
                        //print_r($var_consulta);
                        //echo  '</pre>';

                        print json_encode($arrInfo);

                        $rsLabContador = pg_query($tmfLab, "SELECT COUNT(*) FROM $lab_prod WHERE lab_exa_id = '" . $producto["CTG_LCE_CODE"] . "' LIMIT 1");
                        if ($row = pg_fetch_array($rsLabContador)) {
                            $idRowLabContador = trim($row[0]);
                        }
                        $ProLabContador = isset($idRowLabContador) ? $idRowLabContador : 0;

                        if (empty($ProLabContador)) {

                            $var_consulta = "INSERT INTO  $lab_prod(lab_exa_id,lab_exa_contador,lab_exa_sta,lab_exa_dt,lab_exa_usr)VALUES ('" . $producto["CTG_LCE_CODE"] . "',1,'$stat','$fechaIng','$usuario');";
                            $val = 3;
                            if (pg_query($tmfLab, $var_consulta)) {
                                $arrInfo['status'] = $val;
                            } else {
                                $arrInfo['status'] = 0;
                                $arrInfo['error'] = $var_consulta;
                            }
                            //echo '<pre>';
                            //print_r($var_consulta);
                            //echo  '</pre>';

                            print json_encode($arrInfo);
                        } else {
                            $var_consulta = "UPDATE $lab_prod SET lab_exa_contador = lab_exa_contador + 1 WHERE lab_exa_id = '" . $producto["CTG_LCE_CODE"] . "'";
                            $val = 3;
                            if (pg_query($tmfLab, $var_consulta)) {
                                $arrInfo['status'] = $val;
                            } else {
                                $arrInfo['status'] = 0;
                                $arrInfo['error'] = $var_consulta;
                            }
                            //echo '<pre>';
                            //print_r($var_consulta);
                            //echo  '</pre>';

                            print json_encode($arrInfo);
                        }
                    }
                }
            }
        }
        die();
    }

    //////////////////////////////////////////////////////////////HOSPITALES //////////////////////////////////////////////////////////////////////////////////////////////////////////////
    if ($strTipoValidacion == "insert_tmfhosp") {
        require_once "../../data/conexion/tmfHos.php";
        //header('Content-Type: application/json');

        if (isset($_SESSION['CARRITOHOSP'])) {
            reset($_SESSION['CARRITOHOSP']);
            foreach ($_SESSION['CARRITOHOSP'] as $indice => $producto) {
                $idHos = $producto["CTG_HOS_CODE"];
                $hos_orden = "hos" . $idHos . "orden";
                $hos_orden_prod = "hos" . $idHos . "orden_items";
                $hos_prod = "hos" . $idHos . "servicios";

                $namePac = $nombrePacientebHospital;
                $idPac = $idPacientebHospital;


                $rsHosOrden = pg_query($tmfHos, "SELECT COUNT(*) FROM $hos_orden WHERE hos_ord_cod = $med_con_id_ LIMIT 1");
                if ($row = pg_fetch_array($rsHosOrden)) {
                    $idRowHos = trim($row[0]);
                }
                $OrdenHos = isset($idRowHos) ? $idRowHos : 0;

                $TOTAL = isset($_POST["TOTAL"]) ? $_POST["TOTAL"]  : ''; //valor total de la orden

                if (empty($OrdenHos)) {

                    $hos_ord_valor_iva = ($TOTAL / 1.12) * 0.12;  //valor iva 
                    $hos_ord_valor_iva = number_format($hos_ord_valor_iva, 2);  //valor iva 
                    $statOrder = 1;
                    $hos_ord_por_lab = 0;
                    $hos_ord_valor_desh = 0;

                    $var_consulta = "INSERT INTO $hos_orden(hos_ord_cod,hos_ord_tipo,hos_ord_fec,hos_ord_med_id,hos_ord_pac_id,hos_ord_pac_nombre,hos_ord_por_lab,hos_ord_valor,hos_ord_valor_desh,hos_ord_valor_iva,hos_ord_total,hos_ord_est,hos_ord_sta,hos_ord_dt,hos_ord_usr) VALUES ($med_con_id_,'1','$fechaIng','$idUser','$idPac','$namePac' ,'$hos_ord_por_lab',$TOTAL,'$hos_ord_valor_desh','$hos_ord_valor_iva','$TOTAL','$statOrder','$stat','$fechaIng','$usuario');";
                    $val = 1;
                    if (pg_query($tmfHos, $var_consulta)) {
                        $arrInfo['status'] = $val;
                    } else {
                        $arrInfo['status'] = 0;
                        $arrInfo['error'] = $var_consulta;
                    }
                    //echo '<pre>';
                    // print_r($var_consulta);
                    //echo  '</pre>';

                    print json_encode($arrInfo);

                    $rsHosOrdenProd = pg_query($tmfHos, "SELECT COUNT(*) FROM $hos_orden_prod WHERE hos_ori_cod = $med_con_id_ LIMIT 1");
                    if ($row = pg_fetch_array($rsHosOrdenProd)) {
                        $idRowHosOrdenProd = trim($row[0]);
                    }
                    $OrdenHosPro = isset($idRowHosOrdenProd) ? $idRowHosOrdenProd : 0;

                    $rsHos = pg_query($tmfHos, "SELECT COUNT(*) FROM $hos_orden_prod WHERE hos_ori_ser_id = '" . $producto["CTG_HPP_CODE"] . "' AND hos_ori_cod = $med_con_id_ LIMIT 1");
                    if ($row = pg_fetch_array($rsHos)) {
                        $idRowHosPro = trim($row[0]);
                    }
                    $ProHos = isset($idRowHosPro) ? $idRowHosPro : 0;

                    //print_r($rsHos);
                    //echo '<pre>';
                    //print_r($ProFar);
                    //echo  '</pre> ProFar';

                    if ((empty($OrdenHosPro) && empty($ProHos)) || ($OrdenHosPro >= 1 && empty($ProHos))) {
                        $hos_ori_valor = $TOTAL;
                        $hos_ori_desh = 0;


                        $var_consulta = "INSERT INTO  $hos_orden_prod(hos_ori_cod,hos_ori_gpo_id,hos_ori_ser_id,hos_ori_pre,hos_ori_can,hos_ori_desh,hos_ori_valor,hos_ori_sta,hos_ori_dt,hos_ori_usr)VALUES ($med_con_id_,'" . $producto["CTG_HOS_CODE"] . "','" . $producto["CTG_HPP_CODE"] . "','" . $producto["CTG_HPP_PRE"] . "','" . $producto["CANTIDAD"] . "',$hos_ori_desh,$hos_ori_valor,'$stat','$fechaIng','$usuario');";
                        $val = 2;
                        if (pg_query($tmfHos, $var_consulta)) {
                            $arrInfo['status'] = $val;
                        } else {
                            $arrInfo['status'] = 0;
                            $arrInfo['error'] = $var_consulta;
                        }
                        //print_r($var_consulta);

                        print json_encode($arrInfo);

                        $rsHosContador = pg_query($tmfHos, "SELECT COUNT(*) FROM $hos_prod WHERE hos_ser_id = '" . $producto["CTG_HPP_CODE"] . "' LIMIT 1");
                        if ($row = pg_fetch_array($rsHosContador)) {
                            $idRowHosContador = trim($row[0]);
                        }
                        $ProHosContador = isset($idRowHosContador) ? $idRowHosContador : 0;

                        if (empty($ProHosContador)) {

                            $var_consulta = "INSERT INTO  $hos_prod(hos_ser_id,hos_ser_contador,hos_ser_sta,hos_ser_dt,hos_ser_usr)VALUES ('" . $producto["CTG_HPP_CODE"] . "',1,'$stat','$fechaIng','$usuario');";
                            $val = 3;
                            if (pg_query($tmfHos, $var_consulta)) {
                                $arrInfo['status'] = $val;
                            } else {
                                $arrInfo['status'] = 0;
                                $arrInfo['error'] = $var_consulta;
                            }
                            //echo '<pre>';
                            //print_r($var_consulta);
                            //echo  '</pre>';

                            print json_encode($arrInfo);
                        } else {
                            $var_consulta = "UPDATE $hos_prod SET hos_ser_contador = hos_ser_contador + 1 WHERE hos_ser_id = '" . $producto["CTG_HPP_CONTRATO"] . "'";
                            $val = 3;
                            if (pg_query($tmfHos, $var_consulta)) {
                                $arrInfo['status'] = $val;
                            } else {
                                $arrInfo['status'] = 0;
                                $arrInfo['error'] = $var_consulta;
                            }
                            //echo '<pre>';
                            //print_r($var_consulta);
                            //echo  '</pre>';

                            print json_encode($arrInfo);
                        }
                    }
                }
            }
        }
        die();
    }

    //////////////////////////////////////////////////////////////////////////////////////

    else if ($strTipoValidacion == "tabla_patient") {
        $strSearch = isset($_POST["Search"]) ? $_POST["Search"]  : '';

        $strFilter = "";
        if (!empty($strSearch)) {
            $strFilter = " AND ( UPPER(med_pac_nom) LIKE '%{$strSearch}%' ) ";
        }
        $med = $_SESSION['adm_usr_code'];
        $tablaPacientes = "med" . $med . "pacientes";
        $arrTablePatient = array();
        $var_consulta = "SELECT * 
                        FROM $tablaPacientes 
                        ORDER BY id 
                        LIMIT 100";
        $sql = pg_query($tmfMed, $var_consulta);
        $totalArticle = pg_num_rows($sql);


        while ($rTMP = pg_fetch_assoc($sql)) {

            $arrTablePatient[$rTMP["id"]]["id"]                       = $rTMP["id"];
            $arrTablePatient[$rTMP["id"]]["med_pac_dpi"]              = $rTMP["med_pac_dpi"];
            $arrTablePatient[$rTMP["id"]]["med_pac_code"]             = $rTMP["med_pac_code"];
            $arrTablePatient[$rTMP["id"]]["med_pac_codigo"]           = $rTMP["med_pac_codigo"];
            $arrTablePatient[$rTMP["id"]]["med_pac_mem_id"]           = $rTMP["med_pac_mem_id"];
            $arrTablePatient[$rTMP["id"]]["med_pac_nom"]              = $rTMP["med_pac_nom"];
            $arrTablePatient[$rTMP["id"]]["med_pac_ape"]              = $rTMP["med_pac_ape"];
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
                            <tr data-dismiss="modal" style="cursor:pointer;" onclick="fntSelectView('<?php print $intContador; ?>');">
                                <td><?php echo  $rTMP["value"]['med_pac_dpi']; ?></td>
                                <td><?php echo  $rTMP["value"]['med_pac_nom']; ?> <?php echo  $rTMP["value"]['med_pac_ape']; ?></td>

                                <input type="hidden" name="hidId_<?php print $intContador; ?>" id="hidId_<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['id']; ?>">
                                <input type="hidden" name="hidFecha_<?php print $intContador; ?>" id="hidFecha_<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['id']; ?>">
                                <input type="hidden" name="hidCodigo_<?php print $intContador; ?>" id="hidCodigo_<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['med_pac_code']; ?>">
                                <input type="hidden" name="hidDpi_<?php print $intContador; ?>" id="hidDpi_<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['med_pac_dpi']; ?>">
                                <input type="hidden" name="hidName_<?php print $intContador; ?>" id="hidName_<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['med_pac_nom']; ?> <?php echo  $rTMP["value"]['med_pac_ape']; ?>">
                                <input type="hidden" name="hidSex_<?php print $intContador; ?>" id="hidSex_<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['med_pac_sexo']; ?>">
                                <input type="hidden" name="hidReg_<?php print $intContador; ?>" id="hidReg_<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['med_pac_dep']; ?>">
                                <input type="hidden" name="hidDis_<?php print $intContador; ?>" id="hidDis_<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['med_pac_mun']; ?>">
                                <input type="hidden" name="hidCell_<?php print $intContador; ?>" id="hidCell_<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['med_pac_telcel']; ?>">
                                <input type="hidden" name="hidAdress_<?php print $intContador; ?>" id="hidAdress_<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['med_pac_dir']; ?>">
                                <input type="hidden" name="hidMail_<?php print $intContador; ?>" id="hidMail_<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['med_pac_email']; ?>">
                            </tr>



                    <?PHP
                            $intContador++;
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>

    <?PHP
        die();
    } else if ($strTipoValidacion == "dibujo_dropdow_dep") {
        require_once "../../data/conexion/tmfWeb.php";

        $arrDepartamento = array();
        $var_consulta = "SELECT * 
                            FROM ctg_geografia 
                            WHERE  length(geo_id) <= 3
                            AND geo_pais = '$paisDrop'
                            ORDER BY geo_parent";
        $sql = pg_query($tmfWeb, $var_consulta);
        $totalArticle = pg_num_rows($sql);


        while ($rTMP = pg_fetch_assoc($sql)) {

            $arrDepartamento[$rTMP["id"]]["id"]                                         = $rTMP["id"];
            $arrDepartamento[$rTMP["id"]]["geo_id"]                                         = $rTMP["geo_id"];
            $arrDepartamento[$rTMP["id"]]["geo_desc"]                                         = $rTMP["geo_desc"];
            $arrDepartamento[$rTMP["id"]]["geo_obs"]                                         = $rTMP["geo_obs"];
            $arrDepartamento[$rTMP["id"]]["geo_parent"]                                         = $rTMP["geo_parent"];
            $arrDepartamento[$rTMP["id"]]["geo_moneda"]                                         = $rTMP["geo_moneda"];
            $arrDepartamento[$rTMP["id"]]["geo_cambio"]                                         = $rTMP["geo_cambio"];
            $arrDepartamento[$rTMP["id"]]["geo_cambio_dt"]                                         = $rTMP["geo_cambio_dt"];
            $arrDepartamento[$rTMP["id"]]["geo_sta"]                                         = $rTMP["geo_sta"];
            $arrDepartamento[$rTMP["id"]]["geo_usr"]                                         = $rTMP["geo_usr"];
            $arrDepartamento[$rTMP["id"]]["geo_dt"]                                         = $rTMP["geo_dt"];
            $arrDepartamento[$rTMP["id"]]["geo_pais"]                                         = $rTMP["geo_pais"];
            $arrDepartamento[$rTMP["id"]]["geo_tel"]                                         = $rTMP["geo_tel"];
            $arrDepartamento[$rTMP["id"]]["geo_flag"]                                         = $rTMP["geo_flag"];
        }
        pg_free_result($sql);
        //print_r($var_consulta);
    ?>
        <option value="0">Seleccionar</option>
        <?php
        if (is_array($arrDepartamento) && (count($arrDepartamento) > 0)) {
            reset($arrDepartamento);
            foreach ($arrDepartamento as $rTMP['key'] => $rTMP['value']) {
        ?>
                <option value="<?php echo  $rTMP["value"]['geo_id']; ?>"><?php echo  $rTMP["value"]['geo_desc']; ?></option>

        <?PHP
            }
        }
        ?>
    <?php
        die();
    } else if ($strTipoValidacion == "dibujo_dropdow_mun") {
        require_once "../../data/conexion/tmfWeb.php";
        $strReg = isset($_POST["region"]) ? $_POST["region"]  : '';

        $arrMunicipio = array();
        $var_consulta = "SELECT * 
                            FROM ctg_geografia 
                            WHERE  geo_pais = '$paisDrop'
                            AND geo_parent = '$strReg'
                            ORDER BY geo_id";
        $sql = pg_query($tmfWeb, $var_consulta);
        $totalArticle = pg_num_rows($sql);
        //print_r($var_consulta);
        //print_r($strReg);


        while ($rTMP = pg_fetch_assoc($sql)) {

            $arrMunicipio[$rTMP["id"]]["id"]                                         = $rTMP["id"];
            $arrMunicipio[$rTMP["id"]]["geo_id"]                                         = $rTMP["geo_id"];
            $arrMunicipio[$rTMP["id"]]["geo_desc"]                                         = $rTMP["geo_desc"];
            $arrMunicipio[$rTMP["id"]]["geo_obs"]                                         = $rTMP["geo_obs"];
            $arrMunicipio[$rTMP["id"]]["geo_parent"]                                         = $rTMP["geo_parent"];
            $arrMunicipio[$rTMP["id"]]["geo_moneda"]                                         = $rTMP["geo_moneda"];
            $arrMunicipio[$rTMP["id"]]["geo_cambio"]                                         = $rTMP["geo_cambio"];
            $arrMunicipio[$rTMP["id"]]["geo_cambio_dt"]                                         = $rTMP["geo_cambio_dt"];
            $arrMunicipio[$rTMP["id"]]["geo_sta"]                                         = $rTMP["geo_sta"];
            $arrMunicipio[$rTMP["id"]]["geo_usr"]                                         = $rTMP["geo_usr"];
            $arrMunicipio[$rTMP["id"]]["geo_dt"]                                         = $rTMP["geo_dt"];
            $arrMunicipio[$rTMP["id"]]["geo_pais"]                                         = $rTMP["geo_pais"];
            $arrMunicipio[$rTMP["id"]]["geo_tel"]                                         = $rTMP["geo_tel"];
            $arrMunicipio[$rTMP["id"]]["geo_flag"]                                         = $rTMP["geo_flag"];
        }
        pg_free_result($sql);

    ?>
        <option value="0">Seleccionar</option>
        <?php
        if (is_array($arrMunicipio) && (count($arrMunicipio) > 0)) {
            reset($arrMunicipio);
            foreach ($arrMunicipio as $rTMP['key'] => $rTMP['value']) {
        ?>
                <option value="<?php echo  $rTMP["value"]['id']; ?>"><?php echo  $rTMP["value"]['geo_desc']; ?></option>

        <?PHP
            }
        }
        ?>
    <?php
        die();
    }

    ////////////////////////// TABLAS PRIMER NIVEL////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    else if ($strTipoValidacion == "table_med") {
        require_once "../../data/conexion/tmfAdm.php";

        $strSearch = isset($_POST["Search"]) ? $_POST["Search"]  : '';
        $strSearch = rem_special_caract($strSearch, true);

        $strFilter = "";
        if (!empty($strSearch)) {
            $strFilter = " WHERE ( UPPER(pro.ctg_pro_desc) LIKE UPPER('%{$strSearch}%') OR UPPER(pro.ctg_pro_cod) LIKE UPPER('%{$strSearch}%')) ";
        }

        $var_consultaf = "SELECT * ctg_farmacias";
        $sqlf = pg_query($rmfAdm, $var_consultaf);
        $totalArticlef = pg_num_rows($sqlf);

        $arrTableMed = array();
        $var_consulta = "SELECT pro.*
                        FROM ctg_productos pro
                        $strFilter
                        ORDER BY pro.ctg_pro_desc ASC
                        LIMIT 100";
        $sql = pg_query($rmfAdm, $var_consulta);
        $totalArticle = pg_num_rows($sql);
        //print_r($var_consulta);

        while ($rTMP = pg_fetch_assoc($sql)) {

            $arrTableMed[$rTMP["id"]]["id"]                       = $rTMP["id"];
            $arrTableMed[$rTMP["id"]]["ctg_pro_cod"]              = $rTMP["ctg_pro_cod"];
            $arrTableMed[$rTMP["id"]]["ctg_pro_desc"]             = $rTMP["ctg_pro_desc"];
            $arrTableMed[$rTMP["id"]]["ctg_pro_prinact"]          = $rTMP["ctg_pro_prinact"];
            $arrTableMed[$rTMP["id"]]["ctg_pro_indi"]             = $rTMP["ctg_pro_indi"];
            $arrTableMed[$rTMP["id"]]["ctg_pro_labfar"]           = $rTMP["ctg_pro_labfar"];
            $arrTableMed[$rTMP["id"]]["ctg_pro_fecaut"]           = $rTMP["ctg_pro_fecaut"];
            $arrTableMed[$rTMP["id"]]["ctg_pro_fecven"]           = $rTMP["ctg_pro_fecven"];
            $arrTableMed[$rTMP["id"]]["ctg_pro_psinar"]           = $rTMP["ctg_pro_psinar"];
        }

        $arrTableMed = rem_special_caract($arrTableMed);

        pg_free_result($sql);
    ?>
        <div class="col-md-12 tableFixHead">
            <table id="tableHosp" class="table table-bordered table-striped table-hover table-sm">
                <thead>
                    <tr class="table-info">
                        <th>No. de Registro</th>
                        <th>Nombre</th>
                        <th>Principio Activo</th>
                        <th>Indicaciones</th>
                        <th>Medicamento</th>
                        <?php if ($totalArticlef>0) { ?>
                        <th>Farmacias</th>
                        <?php }?>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (is_array($arrTableMed) && (count($arrTableMed) > 0)) {

                        $intContador = 1;
                        reset($arrTableMed);

                        foreach ($arrTableMed as $rTMP['key'] => $rTMP['value']) {
                    ?>
                            <tr>
                                <td><?php echo rem_special_caract($rTMP["value"]['ctg_pro_cod']); ?></td>
                                <td id="trNameProd_<?php print $intContador; ?>"><?php echo rem_special_caract($rTMP["value"]['ctg_pro_desc']); ?></td>
                                <td><?php echo  $rTMP["value"]['ctg_pro_prinact']; ?></td>
                                <td><?php echo  $rTMP["value"]['ctg_pro_indi']; ?></td>
                                <td onclick="fntSelectMed('<?php print $intContador; ?>')" style="cursor:pointer;  text-align:center;"><i class="fad fa-2x fa-pills"></i></td>
                                <?php if ($totalArticlef>0) { ?>
                                <td onclick="fntModalFar('<?php print $intContador; ?>')" style="cursor:pointer;  text-align:center;"><i class="fad fa-2x fa-clinic-medical"></i></td>
                                <?php } ?>
                            </tr>

                            <input type="hidden" name="hidFilterMed_<?php print $intContador; ?>" id="hidFilterMed_<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['ctg_pro_cod']; ?>">
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
    } else if ($strTipoValidacion == "table_vaccine") {
        require_once "../../data/conexion/tmlMed.php";
        $strSearch = isset($_POST["Search"]) ? $_POST["Search"]  : '';

        $strFilter = "";
        if (!empty($strSearch)) {
            $strFilter = " AND ( UPPER(med_vac_nom) LIKE '%{$strSearch}%' ) ";
        }

        $med = 1;
        $numVac = "med" . $med . "vacunas";
        $arrTableVaccine = array();
        $var_consulta = "SELECT * 
                        FROM $numVac 
                        ORDER BY id ASC
                        LIMIT 100 ";
        $sql = pg_query($tmfMed, $var_consulta);
        $totalArticleVac = pg_num_rows($sql);


        while ($rTMP = pg_fetch_assoc($sql)) {

            $arrTableVaccine[$rTMP["id"]]["id"]                       = $rTMP["id"];
            $arrTableVaccine[$rTMP["id"]]["med_vac_id"]               = $rTMP["med_vac_id"];
            $arrTableVaccine[$rTMP["id"]]["med_vac_nom"]              = $rTMP["med_vac_nom"];
            $arrTableVaccine[$rTMP["id"]]["med_vac_des"]              = $rTMP["med_vac_des"];
            $arrTableVaccine[$rTMP["id"]]["med_vac_costo"]            = $rTMP["med_vac_costo"];
            $arrTableVaccine[$rTMP["id"]]["med_vac_precio"]           = $rTMP["med_vac_precio"];
            $arrTableVaccine[$rTMP["id"]]["med_vac_sali"]             = $rTMP["med_vac_sali"];
            $arrTableVaccine[$rTMP["id"]]["med_vac_comp"]             = $rTMP["med_vac_comp"];
            $arrTableVaccine[$rTMP["id"]]["med_vac_vent"]             = $rTMP["med_vac_vent"];
            $arrTableVaccine[$rTMP["id"]]["med_vac_sta"]              = $rTMP["med_vac_sta"];
            $arrTableVaccine[$rTMP["id"]]["med_vac_dt"]               = $rTMP["med_vac_dt"];
            $arrTableVaccine[$rTMP["id"]]["med_vac_usr"]              = $rTMP["med_vac_usr"];
            $arrTableVaccine[$rTMP["id"]]["med_vac_sal_act"]          = $rTMP["med_vac_sal_act"];
            //$arrTableVaccine[$rTMP["id"]]["med_vac_vent_precio"]      = $rTMP["med_vac_vent_precio"];
        }
        pg_free_result($sql);

    ?>
        <div class="col-md-12 tableFixHead">
            <table id="tableVaccine" class="table table-bordered table-striped table-hover table-sm ">
                <thead>
                    <tr class="table-info">
                        <th>Codigo</th>
                        <th>Nombre de la Vacuna</th>
                        <th>Costo</th>
                        <th>Precio</th>
                        <th>Saldo Actual</th>
                        <th>Agregar</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (is_array($arrTableVaccine) && (count($arrTableVaccine) > 0)) {
                        $intContador = 1;
                        reset($arrTableVaccine);
                        foreach ($arrTableVaccine as $rTMP['key'] => $rTMP['value']) {
                    ?>
                            <tr>
                                <td><?php echo  $rTMP["value"]['med_vac_id']; ?></td>
                                <td><?php echo  $rTMP["value"]['med_vac_nom']; ?></td>
                                <td><?php echo  $rTMP["value"]['med_vac_costo']; ?></td>
                                <td><?php echo  $rTMP["value"]['med_vac_precio']; ?></td>
                                <td><?php echo  $rTMP["value"]['med_vac_sal_act']; ?></td>
                                <td style="cursor:pointer;  text-align:center;">

                                    <input type="hidden" name="hidv_id_<?php print $intContador; ?>" id="hidv_id_<?php print $intContador; ?>" value="<?php echo openssl_encrypt($rTMP["value"]['id'], COD, KEY); ?>"><!-- id-->
                                    <input type="hidden" name="hidv_med_vac_nom_<?php print $intContador; ?>" id="hidv_med_vac_nom_<?php print $intContador; ?>" value="<?php echo openssl_encrypt($rTMP["value"]['med_vac_nom'], COD, KEY); ?>"><!-- nombre producto-->

                                    <input type="hidden" name="hidv_med_vac_id_<?php print $intContador; ?>" id="hidv_med_vac_id_<?php print $intContador; ?>" value="<?php echo openssl_encrypt($rTMP["value"]['med_vac_id'], COD, KEY); ?>">

                                    <input type="hidden" name="hidv_med_vac_precio_<?php print $intContador; ?>" id="hidv_med_vac_precio_<?php print $intContador; ?>" value="<?php echo openssl_encrypt($rTMP["value"]['med_vac_precio'], COD, KEY); ?>"><!-- precio-->

                                    <input type="hidden" name="hidv_cantidad_<?php print $intContador; ?>" id="hidv_cantidad_<?php print $intContador; ?>" value="<?php echo openssl_encrypt(1, COD, KEY); ?>"><!-- precio-->

                                    <button class="btn btn-dark btn-responsive btninter centrado" name="btnAccionVacc" onclick="fntSelectSessionVac(<?php print $intContador; ?>)" type="buttom"><i class="fad fa-2x fa-box-check"></i></button>

                                </td>
                            </tr>

                    <?PHP
                            $intContador++;
                        }
                    }
                    ?>
                </tbody>
            </table>

            <form id="v_formData" method="POST">

                <input type="hidden" name="v_id" id="v_id"><!-- id-->
                <input type="hidden" name="med_vac_nom" id="med_vac_nom"><!-- nombre producto-->

                <input type="hidden" name="med_vac_id" id="med_vac_id">

                <input type="hidden" name="med_vac_precio" id="med_vac_precio"><!-- precio-->

                <input type="hidden" name="v_cantidad" id="v_cantidad"><!-- precio-->

            </form>
        </div>
    <?php
        die();
    } else if ($strTipoValidacion == "table_lab_exa") {
        require_once "../../data/conexion/tmfAdm.php";
        $strSearch = isset($_POST["Search"]) ? $_POST["Search"]  : '';

        $strFilter = "";
        if (!empty($strSearch)) {
            $strFilter = " WHERE ( UPPER(ctg_exa_descrip) LIKE UPPER('%{$strSearch}%') ) ";
        }

        $var_consultal = "SELECT * FROM ctg_lab_clinicos";
        $sqll = pg_query($rmfAdm, $var_consultal);
        $totalArticlel = pg_num_rows($sqll);

        $arrTableLabExa = array();
        $var_consulta = "SELECT * 
                        FROM ctg_examenes $strFilter 
                        ORDER BY ctg_exa_descrip ASC
                        LIMIT 100";
        $sql = pg_query($rmfAdm, $var_consulta);
        $totalArticle = pg_num_rows($sql);


        while ($rTMP = pg_fetch_assoc($sql)) {

            $arrTableLabExa[$rTMP["id"]]["id"]                                   = $rTMP["id"];
            $arrTableLabExa[$rTMP["id"]]["ctg_exa_code"]                                   = $rTMP["ctg_exa_code"];
            $arrTableLabExa[$rTMP["id"]]["ctg_exa_descrip"]                                   = $rTMP["ctg_exa_descrip"];
            $arrTableLabExa[$rTMP["id"]]["ctg_exa_pre"]                                   = $rTMP["ctg_exa_pre"];
            $arrTableLabExa[$rTMP["id"]]["ctg_exa_imagen"]                                   = $rTMP["ctg_exa_imagen"];
            $arrTableLabExa[$rTMP["id"]]["ctg_exa_obs"]                                   = $rTMP["ctg_exa_obs"];
            $arrTableLabExa[$rTMP["id"]]["ctg_exa_sta"]                                   = $rTMP["ctg_exa_sta"];
            $arrTableLabExa[$rTMP["id"]]["ctg_exa_dt"]                                   = $rTMP["ctg_exa_dt"];
            $arrTableLabExa[$rTMP["id"]]["ctg_exa_usr"]                                   = $rTMP["ctg_exa_usr"];
        }
        pg_free_result($sql);

    ?>
        <div class="col-md-12 tableFixHead">
            <table id="tableFarmac" class="table table-bordered table-striped table-hover table-sm">
                <thead>
                    <tr class="table-info">
                        <th>Nombre Del Examen</th>
                        <th>Observaciones</th>
                        <?php if ($totalArticlel>0) {?>
                        <th>Laboratorio</th>
                        <?php }?>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (is_array($arrTableLabExa) && (count($arrTableLabExa) > 0)) {
                        $intContador = 1;
                        reset($arrTableLabExa);
                        foreach ($arrTableLabExa as $rTMP['key'] => $rTMP['value']) {
                    ?>
                            <tr>
                                <td><?php echo  $rTMP["value"]['ctg_exa_descrip']; ?></td>
                                <td><?php echo  $rTMP["value"]['ctg_exa_obs']; ?></td>
                                <?php if ($totalArticlel>0) {?>
                                <td onclick="fntModalLab('<?php print $intContador; ?>')" style="cursor:pointer;  text-align:center;"><i class="fad fa-2x fa-microscope"></i></td>
                                <?php }?>
                            </tr>

                            <input type="hidden" name="hidFilterExa_<?php print $intContador; ?>" id="hidFilterExa_<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['ctg_exa_code']; ?>">
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
    } else if ($strTipoValidacion == "table_hosp_serv") {
        require_once "../../data/conexion/tmfAdm.php";
        $strSearch = isset($_POST["Search"]) ? $_POST["Search"]  : '';

        $strFilter = "";
        if (!empty($strSearch)) {
            $strFilter = " WHERE ( UPPER(serv.ctg_hpp_descrip) LIKE UPPER('%{$strSearch}%' )) ";
        }
        $var_consultah = "SELECT * FROM ctg_hospitales";
        $sqlh = pg_query($rmfAdm, $var_consultah);
        $totalArticleh = pg_num_rows($sql);

        $arrTableHospServ = array();
        $var_consulta = "SELECT *
                        FROM ctg_servicios as serv
                        $strFilter
                        ORDER BY serv.ctg_ser_descrip ASC
                        LIMIT 100";
        $sql = pg_query($rmfAdm, $var_consulta);
        $totalArticle = pg_num_rows($sql);

        while ($rTMP = pg_fetch_assoc($sql)) {

            $arrTableHospServ[$rTMP["id"]]["id"]                       = $rTMP["id"];
            $arrTableHospServ[$rTMP["id"]]["ctg_ser_code"]             = $rTMP["ctg_ser_code"];
            $arrTableHospServ[$rTMP["id"]]["ctg_ser_descrip"]          = $rTMP["ctg_ser_descrip"];
            $arrTableHospServ[$rTMP["id"]]["ctg_ser_pre"]              = $rTMP["ctg_ser_pre"];
            $arrTableHospServ[$rTMP["id"]]["ctg_ser_imagen"]           = $rTMP["ctg_ser_imagen"];
            $arrTableHospServ[$rTMP["id"]]["ctg_ser_obs"]              = $rTMP["ctg_ser_obs"];
            $arrTableHospServ[$rTMP["id"]]["ctg_ser_sta"]              = $rTMP["ctg_ser_sta"];
            $arrTableHospServ[$rTMP["id"]]["ctg_ser_dt"]               = $rTMP["ctg_ser_dt"];
            $arrTableHospServ[$rTMP["id"]]["ctg_ser_usr"]              = $rTMP["ctg_ser_usr"];
        }
        pg_free_result($sql);

    ?>
        <div class="col-md-12 tableFixHead">
            <table id="tableHosp" class="table table-bordered table-striped table-hover table-sm">
                <thead>
                    <tr class="table-info">
                        <th>Codigo</th>
                        <th>Servicio</th>
                        <th>Observaciones</th>
                        <?php if ($totalArticleh>0) {?>
                        <th>Hospitales</th>
                        <?php }?>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (is_array($arrTableHospServ) && (count($arrTableHospServ) > 0)) {
                        $intContador = 1;
                        reset($arrTableHospServ);
                        foreach ($arrTableHospServ as $rTMP['key'] => $rTMP['value']) {
                    ?>
                            <tr>
                                <td><?php echo  $rTMP["value"]['ctg_ser_code']; ?></td>
                                <td><?php echo  $rTMP["value"]['ctg_ser_descrip']; ?></td>
                                <td><?php echo  $rTMP["value"]['ctg_ser_obs']; ?></td>
                                <?php if ($totalArticleh>0) {?>
                                <td onclick="fntModalHosp('<?php print $intContador; ?>')" style="cursor:pointer;  text-align:center;"><i class="fad fa-2x fa-hospital"></i></td>
                                <?php }?>
                            </tr>

                            <input type="hidden" name="hidFilterServ_<?php print $intContador; ?>" id="hidFilterServ_<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['ctg_ser_code']; ?>">
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

    ///// TABLAS SEGUNDO NIVEL///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    else if ($strTipoValidacion == "table_med_far") {
        require_once "../../data/conexion/tmfAdm.php";
        $strSearch = isset($_POST["Search"]) ? $_POST["Search"]  : '';
        $strFilterFar = isset($_POST["strFilterFar"]) ? $_POST["strFilterFar"]  : '';

        $strFilter = "";
        if (!empty($strSearch)) {
            $strFilter = " AND ( UPPER(far.ctg_far_nomcom) LIKE UPPER('%{$strSearch}%') OR UPPER(far.ctg_far_suc) LIKE UPPER('%{$strSearch}%')) ";
        }

        $arrTableMed = array();
        $var_consulta = "SELECT pro.*,far.id farid ,far.ctg_far_contrato ,far.ctg_far_nomcom ,far.ctg_far_suc ,far.ctg_far_code ,far.ctg_far_dir ,far.ctg_far_tels ,far.ctg_far_email
                        FROM ctg_farmacias_productos pro 
                        INNER JOIN ctg_farmacias_sucursales far 
                        ON pro.ctg_fap_contrato = far.ctg_far_contrato 
                        WHERE pro.ctg_fap_pro = '$strFilterFar' 
                        $strFilter
                        ORDER BY far.ctg_far_nomcom ASC 
                        LIMIT 100";
        $sql = pg_query($rmfAdm, $var_consulta);
        $totalArticle = pg_num_rows($sql);
        //print_r($var_consulta);

        while ($rTMP = pg_fetch_assoc($sql)) {
            //ARMACIAS PRODUCTOS
            $arrTableMed[$rTMP["farid"]]["id"]                       = $rTMP["id"];
            $arrTableMed[$rTMP["farid"]]["ctg_fap_contrato"]                       = $rTMP["ctg_fap_contrato"];
            $arrTableMed[$rTMP["farid"]]["ctg_fap_pro"]                       = $rTMP["ctg_fap_pro"];
            $arrTableMed[$rTMP["farid"]]["ctg_fap_nomcom"]                       = $rTMP["ctg_fap_nomcom"];
            $arrTableMed[$rTMP["farid"]]["ctg_fap_pre"]                       = $rTMP["ctg_fap_pre"];
            $arrTableMed[$rTMP["farid"]]["ctg_fap_prinact"]                       = $rTMP["ctg_fap_prinact"];
            $arrTableMed[$rTMP["farid"]]["ctg_fap_indi"]                       = $rTMP["ctg_fap_indi"];
            $arrTableMed[$rTMP["farid"]]["ctg_fap_labfar"]                       = $rTMP["ctg_fap_labfar"];
            $arrTableMed[$rTMP["farid"]]["ctg_fap_fecaut"]                       = $rTMP["ctg_fap_fecaut"];
            $arrTableMed[$rTMP["farid"]]["ctg_fap_fecven"]                       = $rTMP["ctg_fap_fecven"];
            $arrTableMed[$rTMP["farid"]]["ctg_fap_psinar"]                       = $rTMP["ctg_fap_psinar"];
            $arrTableMed[$rTMP["farid"]]["ctg_fap_imagen"]                       = $rTMP["ctg_fap_imagen"];
            $arrTableMed[$rTMP["farid"]]["ctg_fap_obs"]                       = $rTMP["ctg_fap_obs"];
            $arrTableMed[$rTMP["farid"]]["ctg_fap_sta"]                       = $rTMP["ctg_fap_sta"];
            $arrTableMed[$rTMP["farid"]]["ctg_fap_usr"]                       = $rTMP["ctg_fap_usr"];
            $arrTableMed[$rTMP["farid"]]["ctg_fap_dt"]                       = $rTMP["ctg_fap_dt"];
            $arrTableMed[$rTMP["farid"]]["ctg_fap_img"]                       = $rTMP["ctg_fap_img"];

            //FARMACIAS
            $arrTableMed[$rTMP["farid"]]["farid"]                       = $rTMP["farid"];
            $arrTableMed[$rTMP["farid"]]["ctg_far_contrato"]                       = $rTMP["ctg_far_contrato"];
            $arrTableMed[$rTMP["farid"]]["ctg_far_nomcom"]                       = $rTMP["ctg_far_nomcom"];
            $arrTableMed[$rTMP["farid"]]["ctg_far_suc"]                       = $rTMP["ctg_far_suc"];
            $arrTableMed[$rTMP["farid"]]["ctg_far_code"]                       = $rTMP["ctg_far_code"];
            $arrTableMed[$rTMP["farid"]]["ctg_far_dir"]                       = $rTMP["ctg_far_dir"];
            $arrTableMed[$rTMP["farid"]]["ctg_far_tels"]                       = $rTMP["ctg_far_tels"];
            $arrTableMed[$rTMP["farid"]]["ctg_far_email"]                       = $rTMP["ctg_far_email"];
        }
        pg_free_result($sql);

    ?>
        <div class="col-md-12 tableFixHead">
            <table id="tableHosp" class="table table-bordered table-striped table-hover table-sm">
                <thead>
                    <tr class="table-info">
                        <th>Nombre</th>
                        <th>Sucursal</th>
                        <th>Direccion</th>
                        <th>Telefono</th>
                        <th>Precio</th>
                        <th>Agregar</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (is_array($arrTableMed) && (count($arrTableMed) > 0)) {
                        $intContador = 1;
                        reset($arrTableMed);
                        foreach ($arrTableMed as $rTMP['key'] => $rTMP['value']) {
                    ?>
                            <tr>
                                <td><?php echo  $rTMP["value"]['ctg_far_nomcom']; ?></td>
                                <td><?php echo  $rTMP["value"]['ctg_far_suc']; ?></td>
                                <td><?php echo  $rTMP["value"]['ctg_far_dir']; ?></td>
                                <td><?php echo  $rTMP["value"]['ctg_far_tels']; ?></td>
                                <td><?php echo  $rTMP["value"]['ctg_fap_pre']; ?></td>
                                <td style="cursor:pointer;  text-align:center;">

                                    <input type="hidden" name="hid_id_<?php print $intContador; ?>" id="hid_id_<?php print $intContador; ?>" value="<?php echo openssl_encrypt($rTMP["value"]['id'] . $intContador, COD, KEY); ?>"><!-- id-->
                                    <input type="hidden" name="hid_ctg_fap_nomcom_<?php print $intContador; ?>" id="hid_ctg_fap_nomcom_<?php print $intContador; ?>" value="<?php echo openssl_encrypt($rTMP["value"]['ctg_fap_nomcom'], COD, KEY); ?>"><!-- nombre producto-->
                                    <input type="hidden" name="hid_ctg_far_nomcom_<?php print $intContador; ?>" id="hid_ctg_far_nomcom_<?php print $intContador; ?>" value="<?php echo openssl_encrypt($rTMP["value"]['ctg_far_nomcom'], COD, KEY); ?>"><!-- nombre ubicacion-->
                                    <input type="hidden" name="hid_ctg_far_suc_<?php print $intContador; ?>" id="hid_ctg_far_suc_<?php print $intContador; ?>" value="<?php echo openssl_encrypt($rTMP["value"]['ctg_far_suc'], COD, KEY); ?>"><!-- nombre ubicacion-->

                                    <input type="hidden" name="hid_ctg_fap_contrato_<?php print $intContador; ?>" id="hid_ctg_fap_contrato_<?php print $intContador; ?>" value="<?php echo openssl_encrypt($rTMP["value"]['ctg_fap_contrato'], COD, KEY); ?>">
                                    <!--id  nombre producto-->
                                    <input type="hidden" name="hid_ctg_far_code_<?php print $intContador; ?>" id="hid_ctg_far_code_<?php print $intContador; ?>" value="<?php echo openssl_encrypt($rTMP["value"]['ctg_far_code'], COD, KEY); ?>"><!-- id nombre ubicacion-->

                                    <input type="hidden" name="hid_ctg_fap_pre_<?php print $intContador; ?>" id="hid_ctg_fap_pre_<?php print $intContador; ?>" value="<?php echo openssl_encrypt($rTMP["value"]['ctg_fap_pre'], COD, KEY); ?>"><!-- precio-->
                                    <input type="hidden" name="hid_ctg_fap_pro_<?php print $intContador; ?>" id="hid_ctg_fap_pro_<?php print $intContador; ?>" value="<?php echo openssl_encrypt($rTMP["value"]['ctg_fap_pro'], COD, KEY); ?>"><!-- precio-->
                                    <input type="hidden" name="hid_ctg_far_email_<?php print $intContador; ?>" id="hid_ctg_far_email_<?php print $intContador; ?>" value="<?php echo openssl_encrypt($rTMP["value"]['ctg_far_email'], COD, KEY); ?>"><!-- precio-->

                                    <input type="hidden" name="hid_cantidad_<?php print $intContador; ?>" id="hid_cantidad_<?php print $intContador; ?>" value="<?php echo openssl_encrypt(1, COD, KEY); ?>"><!-- precio-->

                                    <button class="btn btn-dark btn-responsive btninter centrado" name="btnAccionMed" onclick="fntSelectSessionMed(<?php print $intContador; ?>)" type="buttom"><i class="fad fa-2x fa-box-check"></i></button>

                                </td>
                                <input type="hidden" name="hidFilterMedImg_<?php print $intContador; ?>" id="hidFilterMedImg_<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['ctg_fap_contrato']; ?>">
                                <input type="hidden" name="hidFilterMedImgPro_<?php print $intContador; ?>" id="hidFilterMedImgPro_<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['ctg_fap_pro']; ?>">
                                <input type="hidden" name="hidtrNameProd_<?php print $intContador; ?>" id="hidtrNameProd_<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['ctg_fap_nomcom']; ?>">

                            </tr>
                        <?PHP
                            $intContador++;
                        }
                    } else {
                        ?>
                        <div class="alert alert-danger" role="alert">
                            No hay disposición!!!
                        </div>
                    <?PHP
                    }
                    ?>
                </tbody>
            </table>

            <form id="formData_m" method="POST">

                <input type="hidden" name="m_id" id="m_id"><!-- id-->
                <input type="hidden" name="ctg_fap_nomcom" id="ctg_fap_nomcom"><!-- nombre producto-->
                <input type="hidden" name="ctg_far_nomcom" id="ctg_far_nomcom"><!-- nombre ubicacion-->
                <input type="hidden" name="ctg_far_suc" id="ctg_far_suc"><!-- nombre ubicacion-->

                <input type="hidden" name="ctg_fap_contrato" id="ctg_fap_contrato">
                <!--id  nombre producto-->
                <input type="hidden" name="ctg_far_code" id="ctg_far_code"><!-- id nombre ubicacion-->

                <input type="hidden" name="ctg_fap_pre" id="ctg_fap_pre"><!-- precio-->
                <input type="hidden" name="ctg_fap_pro" id="ctg_fap_pro"><!-- precio-->

                <input type="hidden" name="ctg_far_email" id="ctg_far_email"><!-- email-->

                <input type="hidden" name="cantidad" id="cantidad"><!-- precio-->

            </form>
        </div>
    <?php
        die();
    } else if ($strTipoValidacion == "table_lab") {
        require_once "../../data/conexion/tmfAdm.php";
        $strSearch = isset($_POST["Search"]) ? $_POST["Search"]  : '';
        $strFilterLab = isset($_POST["strFilterLab"]) ? $_POST["strFilterLab"]  : '';

        $strFilter = "";
        if (!empty($strSearch)) {
            $strFilter = " AND ( UPPER(ctg_lab_nomcom) LIKE UPPER('%{$strSearch}%') ) ";
        }

        $arrTableLab = array();
        $var_consulta = "SELECT lab.*,exa.*  
                        FROM ctg_lab_clinicos lab
                        INNER JOIN ctg_lab_clinicos_examenes exa
                        ON lab.ctg_lab_contrato = exa.ctg_lce_contrato
                        WHERE exa.ctg_lce_code = '$strFilterLab'
                        $strFilter 
                        ORDER BY lab.ctg_lab_nomcom ASC
                        LIMIT 100";
        $sql = pg_query($rmfAdm, $var_consulta);
        $totalArticle = pg_num_rows($sql);


        while ($rTMP = pg_fetch_assoc($sql)) {

            // LAB CLINICOS
            $arrTableLab[$rTMP["id"]]["id"]                       = $rTMP["id"];
            $arrTableLab[$rTMP["id"]]["ctg_lab_contrato"]         = $rTMP["ctg_lab_contrato"];
            $arrTableLab[$rTMP["id"]]["ctg_lab_nit"]              = $rTMP["ctg_lab_nit"];
            $arrTableLab[$rTMP["id"]]["ctg_lab_nomcom"]           = $rTMP["ctg_lab_nomcom"];
            $arrTableLab[$rTMP["id"]]["ctg_lab_suc"]              = $rTMP["ctg_lab_suc"];
            $arrTableLab[$rTMP["id"]]["ctg_lab_code"]             = $rTMP["ctg_lab_code"];
            $arrTableLab[$rTMP["id"]]["ctg_lab_hortda1"]          = $rTMP["ctg_lab_hortda1"];
            $arrTableLab[$rTMP["id"]]["ctg_lab_hortda2"]          = $rTMP["ctg_lab_hortda2"];
            $arrTableLab[$rTMP["id"]]["ctg_lab_dir"]              = $rTMP["ctg_lab_dir"];
            $arrTableLab[$rTMP["id"]]["ctg_lab_zona"]             = $rTMP["ctg_lab_zona"];
            $arrTableLab[$rTMP["id"]]["ctg_lab_mun"]              = $rTMP["ctg_lab_mun"];
            $arrTableLab[$rTMP["id"]]["ctg_lab_tels"]             = $rTMP["ctg_lab_tels"];
            $arrTableLab[$rTMP["id"]]["ctg_lab_email"]            = $rTMP["ctg_lab_email"];
            $arrTableLab[$rTMP["id"]]["ctg_lab_enc_dpi"]          = $rTMP["ctg_lab_enc_dpi"];
            $arrTableLab[$rTMP["id"]]["ctg_lab_enc_nom1"]         = $rTMP["ctg_lab_enc_nom1"];
            $arrTableLab[$rTMP["id"]]["ctg_lab_enc_nom2"]         = $rTMP["ctg_lab_enc_nom2"];
            $arrTableLab[$rTMP["id"]]["ctg_lab_enc_ape2"]         = $rTMP["ctg_lab_enc_ape2"];
            $arrTableLab[$rTMP["id"]]["ctg_lab_enc_ape3"]         = $rTMP["ctg_lab_enc_ape3"];
            $arrTableLab[$rTMP["id"]]["ctg_lab_enc_sexo"]         = $rTMP["ctg_lab_enc_sexo"];
            $arrTableLab[$rTMP["id"]]["ctg_lab_enc_civil"]        = $rTMP["ctg_lab_enc_civil"];
            $arrTableLab[$rTMP["id"]]["ctg_lab_enc_nac_dia"]      = $rTMP["ctg_lab_enc_nac_dia"];
            $arrTableLab[$rTMP["id"]]["ctg_lab_enc_nac_mes"]      = $rTMP["ctg_lab_enc_nac_mes"];
            $arrTableLab[$rTMP["id"]]["ctg_lab_enc_nac_ano"]      = $rTMP["ctg_lab_enc_nac_ano"];
            $arrTableLab[$rTMP["id"]]["ctg_lab_enc_dir"]          = $rTMP["ctg_lab_enc_dir"];
            $arrTableLab[$rTMP["id"]]["ctg_lab_enc_zona"]         = $rTMP["ctg_lab_enc_zona"];
            $arrTableLab[$rTMP["id"]]["ctg_lab_enc_dep"]          = $rTMP["ctg_lab_enc_dep"];
            $arrTableLab[$rTMP["id"]]["ctg_lab_enc_mun"]          = $rTMP["ctg_lab_enc_mun"];
            $arrTableLab[$rTMP["id"]]["ctg_lab_enc_cel"]          = $rTMP["ctg_lab_enc_cel"];
            $arrTableLab[$rTMP["id"]]["ctg_lab_enc_tels"]         = $rTMP["ctg_lab_enc_tels"];
            $arrTableLab[$rTMP["id"]]["ctg_lab_enc_email"]        = $rTMP["ctg_lab_enc_email"];
            $arrTableLab[$rTMP["id"]]["ctg_lab_username"]         = $rTMP["ctg_lab_username"];
            $arrTableLab[$rTMP["id"]]["ctg_lab_pass"]             = $rTMP["ctg_lab_pass"];
            $arrTableLab[$rTMP["id"]]["ctg_lab_estatus"]          = $rTMP["ctg_lab_estatus"];
            $arrTableLab[$rTMP["id"]]["ctg_lab_censuc"]           = $rTMP["ctg_lab_censuc"];
            $arrTableLab[$rTMP["id"]]["ctg_lab_sol_dt"]           = $rTMP["ctg_lab_sol_dt"];
            $arrTableLab[$rTMP["id"]]["ctg_lab_aut_dt"]           = $rTMP["ctg_lab_aut_dt"];
            $arrTableLab[$rTMP["id"]]["ctg_lab_ven_dt"]           = $rTMP["ctg_lab_ven_dt"];
            $arrTableLab[$rTMP["id"]]["ctg_lab_sta"]              = $rTMP["ctg_lab_sta"];
            $arrTableLab[$rTMP["id"]]["ctg_lab_dt"]               = $rTMP["ctg_lab_dt"];
            $arrTableLab[$rTMP["id"]]["ctg_lab_usr"]              = $rTMP["ctg_lab_usr"];
            // LAB CLINICOS EXAMENES
            $arrTableLab[$rTMP["id"]]["ctg_lce_contrato"]              = $rTMP["ctg_lce_contrato"];
            $arrTableLab[$rTMP["id"]]["ctg_lce_code"]              = $rTMP["ctg_lce_code"];
            $arrTableLab[$rTMP["id"]]["ctg_lce_descrip"]              = $rTMP["ctg_lce_descrip"];
            $arrTableLab[$rTMP["id"]]["ctg_lce_pre"]              = $rTMP["ctg_lce_pre"];
            $arrTableLab[$rTMP["id"]]["ctg_lce_imagen"]              = $rTMP["ctg_lce_imagen"];
            $arrTableLab[$rTMP["id"]]["ctg_lce_obs"]              = $rTMP["ctg_lce_obs"];
        }
        pg_free_result($sql);

    ?>
        <div class="col-md-12 tableFixHead">
            <table id="tableFarmac" class="table table-bordered table-striped table-hover table-sm">
                <thead>
                    <tr class="table-info">
                        <th>Nombre Del Laboratorio</th>
                        <th>Sucursal</th>
                        <th>Direccion</th>
                        <th>Telefono</th>
                        <th>Precio</th>
                        <th>Agregar</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (is_array($arrTableLab) && (count($arrTableLab) > 0)) {
                        $intContador = 1;
                        reset($arrTableLab);
                        foreach ($arrTableLab as $rTMP['key'] => $rTMP['value']) {
                    ?>
                            <tr>
                                <td><?php echo  $rTMP["value"]['ctg_lab_nomcom']; ?></td>
                                <td><?php echo  $rTMP["value"]['ctg_lab_suc']; ?></td>
                                <td><?php echo  $rTMP["value"]['ctg_lab_dir']; ?></td>
                                <td><?php echo  $rTMP["value"]['ctg_lab_tels']; ?></td>
                                <td><?php echo  $rTMP["value"]['ctg_lce_pre']; ?></td>
                                <td style="cursor:pointer;  text-align:center;">

                                    <input type="hidden" name="hidl_id_<?php print $intContador; ?>" id="hidl_id_<?php print $intContador; ?>" value="<?php echo openssl_encrypt($rTMP["value"]['id'], COD, KEY); ?>"><!-- id-->
                                    <input type="hidden" name="hidl_ctg_lce_descrip_<?php print $intContador; ?>" id="hidl_ctg_lce_descrip_<?php print $intContador; ?>" value="<?php echo openssl_encrypt($rTMP["value"]['ctg_lce_descrip'], COD, KEY); ?>"><!-- nombre producto-->
                                    <input type="hidden" name="hidl_ctg_lab_nomcom_<?php print $intContador; ?>" id="hidl_ctg_lab_nomcom_<?php print $intContador; ?>" value="<?php echo openssl_encrypt($rTMP["value"]['ctg_lab_nomcom'], COD, KEY); ?>"><!-- nombre ubicacion-->
                                    <input type="hidden" name="hidl_ctg_lce_code_<?php print $intContador; ?>" id="hidl_ctg_lce_code_<?php print $intContador; ?>" value="<?php echo openssl_encrypt($rTMP["value"]['ctg_lce_code'], COD, KEY); ?>">
                                    <input type="hidden" name="hidl_ctg_lce_contrato_<?php print $intContador; ?>" id="hidl_ctg_lce_contrato_<?php print $intContador; ?>" value="<?php echo openssl_encrypt($rTMP["value"]['ctg_lce_contrato'], COD, KEY); ?>"><!-- id  examen clinico-->
                                    <input type="hidden" name="hidl_ctg_lab_contrato_<?php print $intContador; ?>" id="hidl_ctg_lab_contrato_<?php print $intContador; ?>" value="<?php echo openssl_encrypt($rTMP["value"]['ctg_lab_contrato'], COD, KEY); ?>"><!-- id  clinica-->
                                    <input type="hidden" name="hidl_ctg_lab_code_<?php print $intContador; ?>" id="hidl_ctg_lab_code_<?php print $intContador; ?>" value="<?php echo openssl_encrypt($rTMP["value"]['ctg_lab_code'], COD, KEY); ?>"><!-- id  clinica-->
                                    <input type="hidden" name="hidl_ctg_lce_pre_<?php print $intContador; ?>" id="hidl_ctg_lce_pre_<?php print $intContador; ?>" value="<?php echo openssl_encrypt($rTMP["value"]['ctg_lce_pre'], COD, KEY); ?>"><!-- precio-->
                                    <input type="hidden" name="hidl_ctg_lab_email_<?php print $intContador; ?>" id="hidl_ctg_lab_email_<?php print $intContador; ?>" value="<?php echo openssl_encrypt($rTMP["value"]['ctg_lab_email'], COD, KEY); ?>"><!-- precio-->
                                    <input type="hidden" name="hidl_cantidad_l_<?php print $intContador; ?>" id="hidl_cantidad_l_<?php print $intContador; ?>" value="<?php echo openssl_encrypt(1, COD, KEY); ?>"><!-- precio-->

                                    <button class="btn btn-dark btn-responsive btninter centrado" name="btnAccionLab" onclick="fntSelectSessionLab(<?php print $intContador; ?>)" type="buttom"><i class="fad fa-2x fa-box-check"></i></button>

                                </td>
                            </tr>
                        <?PHP
                            $intContador++;
                        }
                    } else {
                        ?>
                        <div class="alert alert-danger" role="alert">
                            No hay disposición!!!
                        </div>
                    <?PHP
                    }
                    ?>
                </tbody>
            </table>
            <form id="formData_l" method="POST">

                <input type="hidden" name="id_l" id="id_l"><!-- id-->
                <input type="hidden" name="ctg_lce_descrip" id="ctg_lce_descrip"><!-- nombre producto-->
                <input type="hidden" name="ctg_lab_nomcom" id="ctg_lab_nomcom"><!-- nombre ubicacion-->
                <input type="hidden" name="ctg_lce_code" id="ctg_lce_code">
                <input type="hidden" name="ctg_lce_contrato" id="ctg_lce_contrato"><!-- id  examen clinico-->
                <input type="hidden" name="ctg_lab_contrato" id="ctg_lab_contrato"><!-- id  clinica-->
                <input type="hidden" name="ctg_lab_code" id="ctg_lab_code"><!-- id  clinica-->
                <input type="hidden" name="ctg_lce_pre" id="ctg_lce_pre"><!-- precio-->
                <input type="hidden" name="ctg_lab_email" id="ctg_lab_email"><!-- precio-->
                <input type="hidden" name="l_cantidad" id="l_cantidad"><!-- precio-->

            </form>
        </div>
    <?php
        die();
    } else if ($strTipoValidacion == "table_hosp") {
        require_once "../../data/conexion/tmfAdm.php";
        $strSearch = isset($_POST["Search"]) ? $_POST["Search"]  : '';
        $strFilterHosp = isset($_POST["strFilterHosp"]) ? $_POST["strFilterHosp"]  : '';

        $strFilter = "";
        if (!empty($strSearch)) {
            $strFilter = " AND ( UPPER(hop.ctg_hos_nomcom) LIKE UPPER('%{$strSearch}%' )) ";
        }

        $arrTableHosp = array();
        $var_consulta = "SELECT hop.*, serv.*
                        FROM ctg_hospitales hop 
                        LEFT JOIN ctg_hospitales_servicios serv
                        ON hop.ctg_hos_contrato = serv.ctg_hpp_contrato
                        WHERE serv.ctg_hpp_code = '$strFilterHosp'
                        $strFilter
                        ORDER BY hop.ctg_hos_nomcom ASC
                        LIMIT 100";
        $sql = pg_query($rmfAdm, $var_consulta);
        $totalArticle = pg_num_rows($sql);
        //print_r($var_consulta);


        while ($rTMP = pg_fetch_assoc($sql)) {
            //HOSPITALES
            $arrTableHosp[$rTMP["ctg_id"]]["id"]                       = $rTMP["id"];
            $arrTableHosp[$rTMP["ctg_id"]]["ctg_hos_contrato"]         = $rTMP["ctg_hos_contrato"];
            $arrTableHosp[$rTMP["ctg_id"]]["ctg_hos_nit"]              = $rTMP["ctg_hos_nit"];
            $arrTableHosp[$rTMP["ctg_id"]]["ctg_hos_nomcom"]           = $rTMP["ctg_hos_nomcom"];
            $arrTableHosp[$rTMP["ctg_id"]]["ctg_hos_code"]             = $rTMP["ctg_hos_code"];
            $arrTableHosp[$rTMP["ctg_id"]]["ctg_hos_dir"]              = $rTMP["ctg_hos_dir"];
            $arrTableHosp[$rTMP["ctg_id"]]["ctg_hos_zona"]             = $rTMP["ctg_hos_zona"];
            $arrTableHosp[$rTMP["ctg_id"]]["ctg_hos_dep"]              = $rTMP["ctg_hos_dep"];
            $arrTableHosp[$rTMP["ctg_id"]]["ctg_hos_mun"]              = $rTMP["ctg_hos_mun"];
            $arrTableHosp[$rTMP["ctg_id"]]["ctg_hos_tels"]             = $rTMP["ctg_hos_tels"];
            $arrTableHosp[$rTMP["ctg_id"]]["ctg_hos_email"]            = $rTMP["ctg_hos_email"];
            $arrTableHosp[$rTMP["ctg_id"]]["ctg_hos_enc_dpi"]          = $rTMP["ctg_hos_enc_dpi"];
            $arrTableHosp[$rTMP["ctg_id"]]["ctg_hos_enc_sexo"]         = $rTMP["ctg_hos_enc_sexo"];
            $arrTableHosp[$rTMP["ctg_id"]]["ctg_hos_enc_civil"]        = $rTMP["ctg_hos_enc_civil"];
            $arrTableHosp[$rTMP["ctg_id"]]["ctg_hos_enc_nac_dia"]      = $rTMP["ctg_hos_enc_nac_dia"];
            $arrTableHosp[$rTMP["ctg_id"]]["ctg_hos_enc_nac_mes"]      = $rTMP["ctg_hos_enc_nac_mes"];
            $arrTableHosp[$rTMP["ctg_id"]]["ctg_hos_enc_nac_ano"]      = $rTMP["ctg_hos_enc_nac_ano"];
            $arrTableHosp[$rTMP["ctg_id"]]["ctg_hos_enc_dir"]          = $rTMP["ctg_hos_enc_dir"];
            $arrTableHosp[$rTMP["ctg_id"]]["ctg_hos_enc_zona"]         = $rTMP["ctg_hos_enc_zona"];
            $arrTableHosp[$rTMP["ctg_id"]]["ctg_hos_enc_dep"]          = $rTMP["ctg_hos_enc_dep"];
            $arrTableHosp[$rTMP["ctg_id"]]["ctg_hos_enc_mun"]          = $rTMP["ctg_hos_enc_mun"];
            $arrTableHosp[$rTMP["ctg_id"]]["ctg_hos_enc_cel"]          = $rTMP["ctg_hos_enc_cel"];
            $arrTableHosp[$rTMP["ctg_id"]]["ctg_hos_enc_tels"]         = $rTMP["ctg_hos_enc_tels"];
            $arrTableHosp[$rTMP["ctg_id"]]["ctg_hos_enc_email"]        = $rTMP["ctg_hos_enc_email"];
            $arrTableHosp[$rTMP["ctg_id"]]["ctg_hos_username"]         = $rTMP["ctg_hos_username"];
            $arrTableHosp[$rTMP["ctg_id"]]["ctg_hos_pass"]             = $rTMP["ctg_hos_pass"];
            $arrTableHosp[$rTMP["ctg_id"]]["ctg_hos_estatus"]          = $rTMP["ctg_hos_estatus"];
            $arrTableHosp[$rTMP["ctg_id"]]["ctg_hos_sol_dt"]           = $rTMP["ctg_hos_sol_dt"];
            $arrTableHosp[$rTMP["ctg_id"]]["ctg_hos_aut_dt"]           = $rTMP["ctg_hos_aut_dt"];
            $arrTableHosp[$rTMP["ctg_id"]]["ctg_hos_ven_dt"]           = $rTMP["ctg_hos_ven_dt"];
            $arrTableHosp[$rTMP["ctg_id"]]["ctg_hos_sta"]              = $rTMP["ctg_hos_sta"];
            $arrTableHosp[$rTMP["ctg_id"]]["ctg_hos_dt"]               = $rTMP["ctg_hos_dt"];
            $arrTableHosp[$rTMP["ctg_id"]]["ctg_hos_usr"]              = $rTMP["ctg_hos_usr"];

            //HOSPITALES SERVICIOS
            $arrTableHosp[$rTMP["ctg_id"]]["ctg_id"]                       = $rTMP["ctg_id"];
            $arrTableHosp[$rTMP["ctg_id"]]["ctg_hpp_contrato"]                       = $rTMP["ctg_hpp_contrato"];
            $arrTableHosp[$rTMP["ctg_id"]]["ctg_hpp_code"]                       = $rTMP["ctg_hpp_code"];
            $arrTableHosp[$rTMP["ctg_id"]]["ctg_hpp_descrip"]                       = $rTMP["ctg_hpp_descrip"];
            $arrTableHosp[$rTMP["ctg_id"]]["ctg_hpp_pre"]                       = $rTMP["ctg_hpp_pre"];
            $arrTableHosp[$rTMP["ctg_id"]]["ctg_hpp_imagen"]                       = $rTMP["ctg_hpp_imagen"];
            $arrTableHosp[$rTMP["ctg_id"]]["ctg_hpp_obs"]                       = $rTMP["ctg_hpp_obs"];
            $arrTableHosp[$rTMP["ctg_id"]]["ctg_hpp_sta"]                       = $rTMP["ctg_hpp_sta"];
            $arrTableHosp[$rTMP["ctg_id"]]["ctg_hpp_dt"]                       = $rTMP["ctg_hpp_dt"];
            $arrTableHosp[$rTMP["ctg_id"]]["ctg_hpp_usr"]                       = $rTMP["ctg_hpp_usr"];
        }
        pg_free_result($sql);

    ?>
        <div class="col-md-12 tableFixHead">
            <table id="tableHosp" class="table table-bordered table-striped table-hover table-sm">
                <thead>
                    <tr class="table-info">
                        <th>Nombre Del Hospital</th>
                        <th>Zona</th>
                        <th>Direccion</th>
                        <th>Telefono</th>
                        <th>Precio</th>
                        <th>Agregar</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (is_array($arrTableHosp) && (count($arrTableHosp) > 0)) {
                        $intContador = 1;
                        reset($arrTableHosp);
                        foreach ($arrTableHosp as $rTMP['key'] => $rTMP['value']) {
                    ?>
                            <tr>
                                <td><?php echo  $rTMP["value"]['ctg_hos_nomcom']; ?></td>
                                <td><?php echo  $rTMP["value"]['ctg_hos_zona']; ?></td>
                                <td><?php echo  $rTMP["value"]['ctg_hos_dir']; ?></td>
                                <td><?php echo  $rTMP["value"]['ctg_hos_tels']; ?></td>
                                <td><?php echo  $rTMP["value"]['ctg_hpp_pre']; ?></td>
                                <td style="cursor:pointer;  text-align:center;">

                                    <input type="hidden" name="hidh_id" id="hidh_id_<?php print $intContador; ?>" value="<?php echo openssl_encrypt($rTMP["value"]['ctg_id'] . $intContador, COD, KEY); ?>"><!-- id-->
                                    <input type="hidden" name="hidh_ctg_hpp_descrip_<?php print $intContador; ?>" id="hidh_ctg_hpp_descrip_<?php print $intContador; ?>" value="<?php echo openssl_encrypt($rTMP["value"]['ctg_hpp_descrip'], COD, KEY); ?>"><!-- nombre producto-->
                                    <input type="hidden" name="hidh_ctg_hos_nomcom_<?php print $intContador; ?>" id="hidh_ctg_hos_nomcom_<?php print $intContador; ?>" value="<?php echo openssl_encrypt($rTMP["value"]['ctg_hos_nomcom'], COD, KEY); ?>"><!-- nombre ubicacion-->

                                    <input type="hidden" name="hidh_ctg_hos_contrato_<?php print $intContador; ?>" id="hidh_ctg_hos_contrato_<?php print $intContador; ?>" value="<?php echo openssl_encrypt($rTMP["value"]['ctg_hos_contrato'], COD, KEY); ?>">
                                    <input type="hidden" name="hidh_ctg_hos_code_<?php print $intContador; ?>" id="hidh_ctg_hos_code_<?php print $intContador; ?>" value="<?php echo openssl_encrypt($rTMP["value"]['ctg_hos_code'], COD, KEY); ?>">
                                    <!--id  nombre producto-->
                                    <input type="hidden" name="hidh_ctg_hpp_code_<?php print $intContador; ?>" id="hidh_ctg_hpp_code_<?php print $intContador; ?>" value="<?php echo openssl_encrypt($rTMP["value"]['ctg_hpp_code'], COD, KEY); ?>"><!-- id nombre ubicacion-->
                                    <input type="hidden" name="hidh_ctg_hpp_contrato_<?php print $intContador; ?>" id="hidh_ctg_hpp_contrato_<?php print $intContador; ?>" value="<?php echo openssl_encrypt($rTMP["value"]['ctg_hpp_contrato'], COD, KEY); ?>"><!-- id nombre ubicacion-->

                                    <input type="hidden" name="hidh_ctg_hpp_pre_<?php print $intContador; ?>" id="hidh_ctg_hpp_pre_<?php print $intContador; ?>" value="<?php echo openssl_encrypt($rTMP["value"]['ctg_hpp_pre'], COD, KEY); ?>"><!-- precio-->
                                    <input type="hidden" name="hidh_ctg_hos_email_<?php print $intContador; ?>" id="hidh_ctg_hos_email_<?php print $intContador; ?>" value="<?php echo openssl_encrypt($rTMP["value"]['ctg_hos_email'], COD, KEY); ?>"><!-- precio-->

                                    <input type="hidden" name="hidh_cantidad_<?php print $intContador; ?>" id="hidh_cantidad_<?php print $intContador; ?>" value="<?php echo openssl_encrypt(1, COD, KEY); ?>"><!-- precio-->

                                    <button class="btn btn-dark btn-responsive btninter centrado" name="btnAccionHosp" onclick="fntSelectSessionHosp(<?php print $intContador; ?>)" type="buttom"><i class="fad fa-2x fa-box-check"></i></button>

                                </td>
                            </tr>
                        <?PHP
                            $intContador++;
                        }
                    } else {
                        ?>
                        <div class="alert alert-danger" role="alert">
                            No hay disposición!!!
                        </div>
                    <?PHP
                    }
                    ?>
                </tbody>
            </table>

            <form id="formData_h" method="POST">
                <input type="hidden" name="id_h" id="id_h"><!-- id-->
                <input type="hidden" name="ctg_hpp_descrip" id="ctg_hpp_descrip"><!-- nombre producto-->
                <input type="hidden" name="ctg_hos_nomcom" id="ctg_hos_nomcom"><!-- nombre ubicacion-->

                <input type="hidden" name="ctg_hos_contrato" id="ctg_hos_contrato">
                <input type="hidden" name="ctg_hos_code" id="ctg_hos_code">
                <!--id  nombre producto-->
                <input type="hidden" name="ctg_hpp_code" id="ctg_hpp_code"><!-- id nombre ubicacion-->
                <input type="hidden" name="ctg_hpp_contrato" id="ctg_hpp_contrato"><!-- id nombre ubicacion-->

                <input type="hidden" name="ctg_hpp_pre" id="ctg_hpp_pre"><!-- precio-->
                <input type="hidden" name="ctg_hos_email" id="ctg_hos_email"><!-- precio-->

                <input type="hidden" name="cantidad_h" id="cantidad_h"><!-- precio-->
            </form>
        </div>
    <?php
        die();
    }

    ////////////////////////////////////////////////////////// MUESTRA DE IMAGENES PARA CONSULTA DE TABLA ///////////////////////////////////////////////////////

    else if ($strTipoValidacion == "table_med_far_img") {
        require_once "../../data/conexion/tmfAdm.php";
        $strSearch = isset($_POST["Search"]) ? $_POST["Search"]  : '';
        $strFilterFar = isset($_POST["strFilterFar"]) ? $_POST["strFilterFar"]  : '';
        $strFilterFarPro = isset($_POST["strFilterFarPro"]) ? $_POST["strFilterFarPro"]  : '';

        $strFilter = "";
        if (!empty($strSearch)) {
            $strFilter = " AND ( UPPER(far.ctg_far_nomcom) LIKE UPPER('%{$strSearch}%')) ";
        }

        $arrTableMedImg = array();
        $var_consulta = "SELECT pro.*
                        FROM ctg_farmacias_productos pro 
                        WHERE pro.ctg_fap_contrato = '$strFilterFar' 
                        AND pro.ctg_fap_pro = '$strFilterFarPro' ";
        $sql = pg_query($rmfAdm, $var_consulta);
        $totalArticle = pg_num_rows($sql);
        //print_r($var_consulta);

        while ($rTMP = pg_fetch_assoc($sql)) {
            //ARMACIAS PRODUCTOS
            $arrTableMedImg[$rTMP["id"]]["id"]                       = $rTMP["id"];
            $arrTableMedImg[$rTMP["id"]]["ctg_fap_nomcom"]                       = $rTMP["ctg_fap_nomcom"];
            $arrTableMedImg[$rTMP["id"]]["ctg_fap_img"]                       = $rTMP["ctg_fap_img"];
        }
        pg_free_result($sql);

    ?>
        <div class="col-md-12 tableFixHead">
            <table id="tableHosp" class="table table-bordered table-striped table-hover table-sm">
                <?php
                if (is_array($arrTableMedImg) && (count($arrTableMedImg) > 0)) {
                    $intContador = 1;
                    reset($arrTableMedImg);
                    foreach ($arrTableMedImg as $rTMP['key'] => $rTMP['value']) {
                ?>
                        <thead>
                            <tr class="table-info">
                                <th>
                                    <h3><?php echo  $rTMP["value"]['ctg_fap_nomcom']; ?></h3>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <div class="center">
                                        <img src="../../asset/img/farmacia/<?php echo  $rTMP["value"]['ctg_fap_img']; ?>" width="400px" height="400px" />
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    <?PHP
                        $intContador++;
                    }
                } else {
                    ?>
                    <div class="alert alert-danger" role="alert">
                        No hay disposición!!!
                    </div>
                <?PHP
                }
                ?>
            </table>
            <button onclick="fntModalFarImgReturn()" type="button" class="btn btn-outline-danger">REGRESAR</button>

        </div>
    <?php
        die();
    }

    /////////////////////////////////////////////////////////////////////////// SESSION PARA CARRITOS///////////////////////////////////////////////
    /////////////////////////////////////////////////////////////////////////// SESSION PARA CARRITOS///////////////////////////////////////////////
    else if ($strTipoValidacion == "session_med_s") {
        if (is_numeric(openssl_decrypt($_POST['m_id'], COD, KEY))) {
            $ID = openssl_decrypt($_POST['m_id'], COD, KEY);
            $mensajeMed .= "OK ES CORRECTO ID " . $ID . "</br>";
        } else {
            $mensajeMed .= "UPPSS...... ID INCORRECTO" . $ID . "</br>";
        }

        if (is_string(openssl_decrypt($_POST['ctg_fap_nomcom'], COD, KEY))) {
            $CTG_FAP_NOMCOM = openssl_decrypt($_POST['ctg_fap_nomcom'], COD, KEY);
            $mensajeMed .= "OK ES CORRECTO CTG_FAP_NOMCOM " . $CTG_FAP_NOMCOM . "</br>";
        } else {
            $mensajeMed .= "UPPSS...... CTG_FAP_NOMCOM INCORRECTO" . "</br>";
        }

        if (is_string(openssl_decrypt($_POST['ctg_far_nomcom'], COD, KEY))) {
            $CTG_FAR_NOMCOM = openssl_decrypt($_POST['ctg_far_nomcom'], COD, KEY);
            $mensajeMed .= "OK ES CORRECTO CTG_FAR_NOMCOM " . $CTG_FAR_NOMCOM . "</br>";
        } else {
            $mensajeMed .= "UPPSS...... CTG_FAR_NOMCOM INCORRECTO" . "</br>";
        }

        if (is_string(openssl_decrypt($_POST['ctg_far_suc'], COD, KEY))) {
            $CTG_FAR_SUC = openssl_decrypt($_POST['ctg_far_suc'], COD, KEY);
            $mensajeMed .= "OK ES CORRECTO CTG_FAR_SUC " . $CTG_FAR_SUC . "</br>";
        } else {
            $mensajeMed .= "UPPSS...... CTG_FAR_SUC INCORRECTO" . "</br>";
        }

        if (is_string(openssl_decrypt($_POST['ctg_fap_contrato'], COD, KEY))) {
            $CTG_FAP_CONTRATO = openssl_decrypt($_POST['ctg_fap_contrato'], COD, KEY);
            $mensajeMed .= "OK ES CORRECTO CTG_FAP_CONTRATO " . $CTG_FAP_CONTRATO . "</br>";
        } else {
            $mensajeMed .= "UPPSS...... CTG_FAP_CONTRATO INCORRECTO" . "</br>";
        }

        if (is_string(openssl_decrypt($_POST['ctg_far_code'], COD, KEY))) {
            $CTG_FAR_CODE = openssl_decrypt($_POST['ctg_far_code'], COD, KEY);
            $mensajeMed .= "OK ES CORRECTO CTG_FAR_CODE " . $CTG_FAR_CODE . "</br>";
        } else {
            $mensajeMed .= "UPPSS...... CTG_FAR_CODE INCORRECTO" . "</br>";
        }

        if (is_string(openssl_decrypt($_POST['ctg_fap_pre'], COD, KEY))) {
            $CTG_FAP_PRE = openssl_decrypt($_POST['ctg_fap_pre'], COD, KEY);
            $mensajeMed .= "OK ES CORRECTO CTG_FAP_PRE " . $CTG_FAP_PRE . "</br>";
        } else {
            $mensajeMed .= "UPPSS...... CTG_FAP_PRE INCORRECTO" . "</br>";
        }

        if (is_string(openssl_decrypt($_POST['ctg_fap_pro'], COD, KEY))) {
            $CTG_FAP_PRO = openssl_decrypt($_POST['ctg_fap_pro'], COD, KEY);
            $mensajeMed .= "OK ES CORRECTO CTG_FAP_PRO " . $CTG_FAP_PRO . "</br>";
        } else {
            $mensajeMed .= "UPPSS...... CTG_FAP_PRO INCORRECTO" . "</br>";
        }

        if (is_string(openssl_decrypt($_POST['ctg_far_email'], COD, KEY))) {
            $CTG_FAR_EMAIL = openssl_decrypt($_POST['ctg_far_email'], COD, KEY);
            $mensajeMed .= "OK ES CORRECTO CTG_FAR_EMAIL " . $CTG_FAR_EMAIL . "</br>";
        } else {
            $mensajeMed .= "UPPSS...... CTG_FAR_EMAIL INCORRECTO" . "</br>";
        }

        if (is_numeric(openssl_decrypt($_POST['cantidad'], COD, KEY))) {
            $CANTIDAD = openssl_decrypt($_POST['cantidad'], COD, KEY);
            $mensajeMed .= "OK ES CORRECTO CANTIDAD " . $CANTIDAD . "</br>";
        } else {
            $mensajeMed .= "UPPSS...... CANTIDAD INCORRECTO" . "</br>";
        }


        if (!isset($_SESSION['CARRITOMED'])) {
            $producto = array(
                'ID' => $ID,
                'CTG_FAP_NOMCOM' => $CTG_FAP_NOMCOM,
                'CTG_FAR_NOMCOM' => $CTG_FAR_NOMCOM,
                'CTG_FAR_SUC' => $CTG_FAR_SUC,
                'CTG_FAP_CONTRATO' => $CTG_FAP_CONTRATO,
                'CTG_FAR_CODE' => $CTG_FAR_CODE,
                'CTG_FAP_PRE' => $CTG_FAP_PRE,
                'CTG_FAP_PRO' => $CTG_FAP_PRO,
                'CTG_FAR_EMAIL' => $CTG_FAR_EMAIL,
                'CANTIDAD' => $CANTIDAD
            );
            $_SESSION['CARRITOMED'][0] = $producto;
            $mensajeMed = "Producto agregado al CARRITOMED";
        } else {

            $idProductos = array_column($_SESSION['CARRITOMED'], "ID");

            if (in_array($ID, $idProductos)) {
                echo "<script> alert('El producto ya a sido seleccionado..')</script>";
                $mensajeMed = "";
            } else {
                $NumeroProductos = count($_SESSION['CARRITOMED']);
                $producto = array(
                    'ID' => $ID,
                    'CTG_FAP_NOMCOM' => $CTG_FAP_NOMCOM,
                    'CTG_FAR_NOMCOM' => $CTG_FAR_NOMCOM,
                    'CTG_FAR_SUC' => $CTG_FAR_SUC,
                    'CTG_FAP_CONTRATO' => $CTG_FAP_CONTRATO,
                    'CTG_FAR_CODE' => $CTG_FAR_CODE,
                    'CTG_FAP_PRE' => $CTG_FAP_PRE,
                    'CTG_FAP_PRO' => $CTG_FAP_PRO,
                    'CTG_FAR_EMAIL' => $CTG_FAR_EMAIL,
                    'CANTIDAD' => $CANTIDAD
                );
                $_SESSION['CARRITOMED'][$NumeroProductos] = $producto;
                $mensajeMed = "Producto agregado al CARRITOMED";
            }
        }

        die();
    } else if ($strTipoValidacion == "session_med_d") {

        if (is_numeric(openssl_decrypt($_POST['m_id_d'], COD, KEY))) {
            $ID = openssl_decrypt($_POST['m_id_d'], COD, KEY);

            foreach ($_SESSION['CARRITOMED'] as $indice => $producto) {
                if ($producto['ID'] == $ID) {
                    unset($_SESSION['CARRITOMED'][$indice]);
                }
            }
        } else {
            $mensajeMed .= "UPPSS...... ID INCORRECTO";
        }

        die();
    } else if ($strTipoValidacion == "session_vac_s") {

        if (is_numeric(openssl_decrypt($_POST['v_id'], COD, KEY))) {
            $ID = openssl_decrypt($_POST['v_id'], COD, KEY);
            $mensajeVacc .= "OK ES CORRECTO ID " . $ID . "</br>";
        } else {
            $mensajeVacc .= "UPPSS...... ID INCORRECTO" . $ID . "</br>";
        }

        if (is_numeric(openssl_decrypt($_POST['med_vac_id'], COD, KEY))) {
            $MED_VAC_ID = openssl_decrypt($_POST['med_vac_id'], COD, KEY);
            $mensajeVacc .= "OK ES CORRECTO MED_VAC_ID " . $MED_VAC_ID . "</br>";
        } else {
            $mensajeVacc .= "UPPSS...... MED_VAC_ID INCORRECTO" . "</br>";
        }

        if (is_string(openssl_decrypt($_POST['med_vac_nom'], COD, KEY))) {
            $MED_VAC_NOM = openssl_decrypt($_POST['med_vac_nom'], COD, KEY);
            $mensajeVacc .= "OK ES CORRECTO MED_VAC_NOM " . $MED_VAC_NOM . "</br>";
        } else {
            $mensajeVacc .= "UPPSS...... MED_VAC_NOM INCORRECTO" . "</br>";
        }

        if (is_string(openssl_decrypt($_POST['med_vac_precio'], COD, KEY))) {
            $MED_VAC_PRECIO = openssl_decrypt($_POST['med_vac_precio'], COD, KEY);
            $mensajeVacc .= "OK ES CORRECTO MED_VAC_PRECIO " . $MED_VAC_PRECIO . "</br>";
        } else {
            $mensajeVacc .= "UPPSS...... MED_VAC_PRECIO INCORRECTO" . "</br>";
        }

        if (is_numeric(openssl_decrypt($_POST['v_cantidad'], COD, KEY))) {
            $CANTIDAD = openssl_decrypt($_POST['v_cantidad'], COD, KEY);
            $mensajeVacc .= "OK ES CORRECTO CANTIDAD " . $CANTIDAD . "</br>";
        } else {
            $mensajeVacc .= "UPPSS...... CANTIDAD INCORRECTO" . "</br>";
        }



        if (!isset($_SESSION['CARRITOVAC'])) {
            $producto = array(
                'ID' => $ID,
                'MED_VAC_ID' => $MED_VAC_ID,
                'MED_VAC_NOM' => $MED_VAC_NOM,
                'MED_VAC_PRECIO' => $MED_VAC_PRECIO,
                'CANTIDAD' => $CANTIDAD
            );
            $_SESSION['CARRITOVAC'][0] = $producto;
            $mensajeVacc = "Producto agregado al CARRITOVAC";
        } else {

            $idProductos = array_column($_SESSION['CARRITOVAC'], "ID");

            if (in_array($ID, $idProductos)) {
                //echo "<script> alertify.alert('VACUNAS', 'El producto ya a sido seleccionado..')</script>";
                echo "<script> alert('El producto ya a sido seleccionado..')</script>";
                $mensajeVacc = "";
            } else {
                $NumeroProductos = count($_SESSION['CARRITOVAC']);
                $producto = array(
                    'ID' => $ID,
                    'MED_VAC_ID' => $MED_VAC_ID,
                    'MED_VAC_NOM' => $MED_VAC_NOM,
                    'MED_VAC_PRECIO' => $MED_VAC_PRECIO,
                    'CANTIDAD' => $CANTIDAD
                );
                $_SESSION['CARRITOVAC'][$NumeroProductos] = $producto;
                $mensajeVacc = "Producto agregado al CARRITOVAC";
            }
        }

        die();
    } else if ($strTipoValidacion == "session_vac_d") {

        if (is_numeric(openssl_decrypt($_POST['v_id_d'], COD, KEY))) {
            $ID = openssl_decrypt($_POST['v_id_d'], COD, KEY);

            foreach ($_SESSION['CARRITOVAC'] as $indice => $producto) {
                if ($producto['ID'] == $ID) {
                    unset($_SESSION['CARRITOVAC'][$indice]);
                }
            }
        } else {
            $mensajeVacc .= "UPPSS...... ID INCORRECTO";
        }

        die();
    } else if ($strTipoValidacion == "session_lab_s") {

        if (is_numeric(openssl_decrypt($_POST['id_l'], COD, KEY))) {
            $ID = openssl_decrypt($_POST['id_l'], COD, KEY);
            $mensaje .= "OK ES CORRECTO ID " . $ID . "</br>";
        } else {
            $mensaje .= "UPPSS...... ID INCORRECTO" . $ID . "</br>";
        }

        if (is_string(openssl_decrypt($_POST['ctg_lce_descrip'], COD, KEY))) {
            $CTG_LCE_DESCRIP = openssl_decrypt($_POST['ctg_lce_descrip'], COD, KEY);
            $mensaje .= "OK ES CORRECTO OK ES CORRECTO CTG_LCE_DESCRIP " . $CTG_LCE_DESCRIP . "</br>";
        } else {
            $mensaje .= "UPPSS...... CTG_LCE_DESCRIP INCORRECTO" . "</br>";
        }

        if (is_string(openssl_decrypt($_POST['ctg_lab_nomcom'], COD, KEY))) {
            $CTG_LAB_NOMCOM = openssl_decrypt($_POST['ctg_lab_nomcom'], COD, KEY);
            $mensaje .= "OK ES CORRECTO CTG_LAB_NOMCOM " . $CTG_LAB_NOMCOM . "</br>";
        } else {
            $mensaje .= "UPPSS...... CTG_LAB_NOMCOM INCORRECTO" . "</br>";
        }

        if (is_numeric(openssl_decrypt($_POST['ctg_lce_code'], COD, KEY))) {
            $CTG_LCE_CODE = openssl_decrypt($_POST['ctg_lce_code'], COD, KEY);
            $mensaje .= "OK ES CORRECTO CTG_LCE_CODE " . $CTG_LCE_CODE . "</br>";
        } else {
            $mensaje .= "UPPSS...... CTG_LCE_CODE INCORRECTO" . "</br>";
        }

        if (is_numeric(openssl_decrypt($_POST['ctg_lab_code'], COD, KEY))) {
            $CTG_LAB_CODE = openssl_decrypt($_POST['ctg_lab_code'], COD, KEY);
            $mensaje .= "OK ES CORRECTO CTG_LAB_CODE " . $CTG_LCE_CODE . "</br>";
        } else {
            $mensaje .= "UPPSS...... CTG_LAB_CODE INCORRECTO" . "</br>";
        }

        if (is_string(openssl_decrypt($_POST['ctg_lce_contrato'], COD, KEY))) {
            $CTG_LCE_CONTRATO = openssl_decrypt($_POST['ctg_lce_contrato'], COD, KEY);
            $mensaje .= "OK ES CORRECTO CTG_LCE_CONTRATO " . $CTG_LCE_CONTRATO . "</br>";
        } else {
            $mensaje .= "UPPSS...... CTG_LCE_CONTRATO INCORRECTO" . "</br>";
        }

        if (is_string(openssl_decrypt($_POST['ctg_lab_contrato'], COD, KEY))) {
            $CTG_LAB_CONTRATO = openssl_decrypt($_POST['ctg_lab_contrato'], COD, KEY);
            $mensaje .= "OK ES CORRECTO CTG_LAB_CONTRATO " . $CTG_LAB_CONTRATO . "</br>";
        } else {
            $mensaje .= "UPPSS...... CTG_LAB_CONTRATO INCORRECTO" . "</br>";
        }

        if (is_string(openssl_decrypt($_POST['ctg_lce_pre'], COD, KEY))) {
            $CTG_LCE_PRE = openssl_decrypt($_POST['ctg_lce_pre'], COD, KEY);
            $mensaje .= "OK ES CORRECTO CTG_LCE_PRE " . $CTG_LCE_PRE . "</br>";
        } else {
            $mensaje .= "UPPSS...... CTG_LCE_PRE INCORRECTO" . "</br>";
        }

        if (is_string(openssl_decrypt($_POST['ctg_lab_email'], COD, KEY))) {
            $CTG_LAB_EMAIL = openssl_decrypt($_POST['ctg_lab_email'], COD, KEY);
            $mensaje .= "OK ES CORRECTO CTG_LAB_EMAIL " . $CTG_LAB_EMAIL . "</br>";
        } else {
            $mensaje .= "UPPSS...... CTG_LAB_EMAIL INCORRECTO" . "</br>";
        }

        if (is_numeric(openssl_decrypt($_POST['l_cantidad'], COD, KEY))) {
            $CANTIDAD = openssl_decrypt($_POST['l_cantidad'], COD, KEY);
            $mensaje .= "OK ES CORRECTO CANTIDAD " . $CANTIDAD . "</br>";
        } else {
            $mensaje .= "UPPSS...... CANTIDAD INCORRECTO" . "</br>";
        }

        if (is_numeric(openssl_decrypt($_POST['TOTAL'], COD, KEY))) {
            $TOTAL = openssl_decrypt($_POST['TOTAL'], COD, KEY);
            $mensaje .= "OK ES CORRECTO CANTIDAD " . $TOTAL . "</br>";
        } else {
            $mensaje .= "UPPSS...... TOTAL INCORRECTO" . "</br>";
        }



        if (!isset($_SESSION['CARRITOLAB'])) {
            $producto = array(
                'ID' => $ID,
                'CTG_LCE_DESCRIP' => $CTG_LCE_DESCRIP,
                'CTG_LAB_NOMCOM' => $CTG_LAB_NOMCOM,
                'CTG_LCE_CODE' => $CTG_LCE_CODE,
                'CTG_LAB_CODE' => $CTG_LAB_CODE,
                'CTG_LCE_CONTRATO' => $CTG_LCE_CONTRATO,
                'CTG_LAB_CONTRATO' => $CTG_LAB_CONTRATO,
                'CTG_LCE_PRE' => $CTG_LCE_PRE,
                'CTG_LAB_EMAIL' => $CTG_LAB_EMAIL,
                'CANTIDAD' => $CANTIDAD,
                'TOTAL' => $TOTAL
            );
            $_SESSION['CARRITOLAB'][0] = $producto;
            $mensaje = "Producto agregado al CARRITOLAB";
        } else {

            $idProductos = array_column($_SESSION['CARRITOLAB'], "ID");

            if (in_array($ID, $idProductos)) {
                echo "<script> alert('El producto ya a sido seleccionado..')</script>";
                $mensaje = "";
            } else {
                $NumeroProductos = count($_SESSION['CARRITOLAB']);
                $producto = array(
                    'ID' => $ID,
                    'CTG_LCE_DESCRIP' => $CTG_LCE_DESCRIP,
                    'CTG_LAB_NOMCOM' => $CTG_LAB_NOMCOM,
                    'CTG_LCE_CODE' => $CTG_LCE_CODE,
                    'CTG_LAB_CODE' => $CTG_LAB_CODE,
                    'CTG_LCE_CONTRATO' => $CTG_LCE_CONTRATO,
                    'CTG_LAB_CONTRATO' => $CTG_LAB_CONTRATO,
                    'CTG_LCE_PRE' => $CTG_LCE_PRE,
                    'CTG_LAB_EMAIL' => $CTG_LAB_EMAIL,
                    'CANTIDAD' => $CANTIDAD,
                    'TOTAL' => $TOTAL
                );
                $_SESSION['CARRITOLAB'][$NumeroProductos] = $producto;
                $mensaje = "Producto agregado al CARRITOLAB";
            }
        }

        die();
    } else if ($strTipoValidacion == "session_lab_d") {

        if (is_numeric(openssl_decrypt($_POST['id_l_d'], COD, KEY))) {
            $ID = openssl_decrypt($_POST['id_l_d'], COD, KEY);

            foreach ($_SESSION['CARRITOLAB'] as $indice => $producto) {
                if ($producto['ID'] == $ID) {
                    unset($_SESSION['CARRITOLAB'][$indice]);
                }
            }
        } else {
            $mensaje .= "UPPSS...... ID INCORRECTO";
        }

        die();
    } else if ($strTipoValidacion == "session_hosp_s") {

        if (is_numeric(openssl_decrypt($_POST['id_h'], COD, KEY))) {
            $ID = openssl_decrypt($_POST['id_h'], COD, KEY);
            $mensajeHosp .= "OK ES CORRECTO ID " . $ID . "</br>";
        } else {
            $mensajeHosp .= "UPPSS...... ID INCORRECTO" . $ID . "</br>";
        }

        if (is_string(openssl_decrypt($_POST['ctg_hpp_descrip'], COD, KEY))) {
            $CTG_HPP_DESCRIP = openssl_decrypt($_POST['ctg_hpp_descrip'], COD, KEY);
            $mensajeHosp .= "OK ES CORRECTO CTG_HPP_DESCRIP " . $CTG_HPP_DESCRIP . "</br>";
        } else {
            $mensajeHosp .= "UPPSS...... CTG_HPP_DESCRIP INCORRECTO" . "</br>";
        }

        if (is_string(openssl_decrypt($_POST['ctg_hos_nomcom'], COD, KEY))) {
            $CTG_HOS_NOMCOM = openssl_decrypt($_POST['ctg_hos_nomcom'], COD, KEY);
            $mensajeHosp .= "OK ES CORRECTO CTG_HOS_NOMCOM " . $CTG_HOS_NOMCOM . "</br>";
        } else {
            $mensajeHosp .= "UPPSS...... CTG_HOS_NOMCOM INCORRECTO" . "</br>";
        }

        if (is_string(openssl_decrypt($_POST['ctg_hos_contrato'], COD, KEY))) {
            $CTG_HOS_CONTRATO = openssl_decrypt($_POST['ctg_hos_contrato'], COD, KEY);
            $mensajeHosp .= "OK ES CORRECTO CTG_HOS_CONTRATO " . $CTG_HOS_CONTRATO . "</br>";
        } else {
            $mensajeHosp .= "UPPSS...... CTG_HOS_CONTRATO INCORRECTO" . "</br>";
        }

        if (is_string(openssl_decrypt($_POST['ctg_hos_code'], COD, KEY))) {
            $CTG_HOS_CODE = openssl_decrypt($_POST['ctg_hos_code'], COD, KEY);
            $mensajeHosp .= "OK ES CORRECTO CTG_HOS_CODE " . $CTG_HOS_CODE . "</br>";
        } else {
            $mensajeHosp .= "UPPSS...... CTG_HOS_CODE INCORRECTO" . "</br>";
        }

        if (is_string(openssl_decrypt($_POST['ctg_hpp_code'], COD, KEY))) {
            $CTG_HPP_CODE = openssl_decrypt($_POST['ctg_hpp_code'], COD, KEY);
            $mensajeHosp .= "OK ES CORRECTO CTG_HPP_CODE " . $CTG_HPP_CODE . "</br>";
        } else {
            $mensajeHosp .= "UPPSS...... CTG_HPP_CODE INCORRECTO" . "</br>";
        }

        if (is_string(openssl_decrypt($_POST['ctg_hpp_contrato'], COD, KEY))) {
            $CTG_HPP_CONTRATO = openssl_decrypt($_POST['ctg_hpp_contrato'], COD, KEY);
            $mensajeHosp .= "OK ES CORRECTO CTG_HPP_CONTRATO " . $CTG_HPP_CONTRATO . "</br>";
        } else {
            $mensajeHosp .= "UPPSS...... CTG_HPP_CONTRATO INCORRECTO" . "</br>";
        }

        if (is_string(openssl_decrypt($_POST['ctg_hpp_pre'], COD, KEY))) {
            $CTG_HPP_PRE = openssl_decrypt($_POST['ctg_hpp_pre'], COD, KEY);
            $mensajeHosp .= "OK ES CORRECTO CTG_HPP_PRE " . $CTG_HPP_PRE . "</br>";
        } else {
            $mensajeHosp .= "UPPSS...... CTG_HPP_PRE INCORRECTO" . "</br>";
        }

        if (is_string(openssl_decrypt($_POST['ctg_hos_email'], COD, KEY))) {
            $CTG_HOS_EMAIL = openssl_decrypt($_POST['ctg_hos_email'], COD, KEY);
            $mensajeHosp .= "OK ES CORRECTO CTG_HOS_EMAIL " . $CTG_HOS_EMAIL . "</br>";
        } else {
            $mensajeHosp .= "UPPSS...... CTG_HOS_EMAIL INCORRECTO" . "</br>";
        }

        if (is_numeric(openssl_decrypt($_POST['cantidad_h'], COD, KEY))) {
            $CANTIDAD = openssl_decrypt($_POST['cantidad_h'], COD, KEY);
            $mensajeHosp .= "OK ES CORRECTO CANTIDAD " . $CANTIDAD . "</br>";
        } else {
            $mensajeHosp .= "UPPSS...... CANTIDAD INCORRECTO" . "</br>";
        }

        if (is_numeric(openssl_decrypt($_POST['TOTAL'], COD, KEY))) {
            $TOTAL = openssl_decrypt($_POST['TOTAL'], COD, KEY);
            $mensajeHosp .= "OK ES CORRECTO CANTIDAD " . $TOTAL . "</br>";
        } else {
            $mensajeHosp .= "UPPSS...... TOTAL INCORRECTO" . "</br>";
        }



        if (!isset($_SESSION['CARRITOHOSP'])) {
            $producto = array(
                'ID' => $ID,
                'CTG_HPP_DESCRIP' => $CTG_HPP_DESCRIP,
                'CTG_HOS_NOMCOM' => $CTG_HOS_NOMCOM,
                'CTG_HOS_CONTRATO' => $CTG_HOS_CONTRATO,
                'CTG_HPP_CONTRATO' => $CTG_HPP_CONTRATO,
                'CTG_HPP_CODE' => $CTG_HPP_CODE,
                'CTG_HOS_CODE' => $CTG_HOS_CODE,
                'CTG_HPP_PRE' => $CTG_HPP_PRE,
                'CTG_HOS_EMAIL' => $CTG_HOS_EMAIL,
                'CANTIDAD' => $CANTIDAD,
                'TOTAL' => $TOTAL
            );
            $_SESSION['CARRITOHOSP'][0] = $producto;
            $mensajeHosp = "Producto agregado al CARRITOHOSP";
        } else {

            $idProductos = array_column($_SESSION['CARRITOHOSP'], "ID");

            if (in_array($ID, $idProductos)) {
                echo "<script> alert('El producto ya a sido seleccionado..')</script>";
                $mensajeHosp = "";
            } else {
                $NumeroProductos = count($_SESSION['CARRITOHOSP']);
                $producto = array(
                    'ID' => $ID,
                    'CTG_HPP_DESCRIP' => $CTG_HPP_DESCRIP,
                    'CTG_HOS_NOMCOM' => $CTG_HOS_NOMCOM,
                    'CTG_HOS_CONTRATO' => $CTG_HOS_CONTRATO,
                    'CTG_HPP_CONTRATO' => $CTG_HPP_CONTRATO,
                    'CTG_HPP_CODE' => $CTG_HPP_CODE,
                    'CTG_HOS_CODE' => $CTG_HOS_CODE,
                    'CTG_HPP_PRE' => $CTG_HPP_PRE,
                    'CTG_HOS_EMAIL' => $CTG_HOS_EMAIL,
                    'CANTIDAD' => $CANTIDAD,
                    'TOTAL' => $TOTAL
                );
                $_SESSION['CARRITOHOSP'][$NumeroProductos] = $producto;
                $mensajeHosp = "Producto agregado al CARRITOHOSP";
            }
        }

        die();
    } else if ($strTipoValidacion == "session_hosp_d") {

        if (is_numeric(openssl_decrypt($_POST['id_h_d'], COD, KEY))) {
            $ID = openssl_decrypt($_POST['id_h_d'], COD, KEY);

            foreach ($_SESSION['CARRITOHOSP'] as $indice => $producto) {
                if ($producto['ID'] == $ID) {
                    unset($_SESSION['CARRITOHOSP'][$indice]);
                }
            }
        } else {
            $mensajeHosp .= "UPPSS...... ID INCORRECTO";
        }

        die();
    } else if ($strTipoValidacion == "session_carrito_med") {
    ?>
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-12 col-md-12 ">
                    <div class=" collapse show" id="sessionMedicine">
                        <div class="card-body">
                            <div class="card-primary collapsed-card">
                                <div class="card-body" id="tableMedSession_" name="tableMedSession_" style="display: none;">
                                    <div class="div1">
                                        <div id="tableMedSession" name="tableMedSession">
                                            <h4>ORDENES DE MEDICAMENTOS</h4>
                                            <a class="btn btn-raised btn-info btn-center" onclick="fntMedicamentSessionClose()"><i class="fad fa-2x fa-reply"></i></a>
                                            <input type="hidden" class="form-control" id="VAL_CARRITOMED" name="VAL_CARRITOMED" value="<?php echo (empty($_SESSION['CARRITOMED'])) ? '' : count($_SESSION['CARRITOMED']); ?>">

                                            <!-- DIBUJO DE TABLA -->
                                            <?php if (!empty($_SESSION['CARRITOMED'])) { ?>
                                                <table class="table table-bordered table-striped table-hover table-sm">
                                                    <tbody>
                                                        <thead>
                                                            <tr>
                                                                <th width="30%">Medicamento</th>
                                                                <th width="30%">Farmacia</th>
                                                                <th width="15%" class="text-center">Cantidad</th>
                                                                <th width="10%" class="text-center">Precio</th>
                                                                <th width="10%" class="text-center">Total</th>
                                                                <th width="5%"></th>
                                                            </tr>
                                                        </thead>
                                                        <?php $total = 0; ?>
                                                        <?php
                                                        $intContador = 1;
                                                        foreach ($_SESSION['CARRITOMED'] as $indice => $producto) { ?>

                                                            <tr>
                                                                <td width="30%"><?php echo $producto['CTG_FAP_NOMCOM'] ?></td>
                                                                <td width="30%"><?php echo $producto['CTG_FAR_NOMCOM'] ?></td>
                                                                <td width="15%" class="text-center"><?php echo $producto['CANTIDAD'] ?></td>
                                                                <td width="10%" class="text-center">Q<?php echo $producto['CTG_FAP_PRE'] ?></td>
                                                                <td width="10%" class="text-center">Q<?php echo number_format($producto['CTG_FAP_PRE'] * $producto['CANTIDAD'], 2); ?></td>
                                                                <td width="5%">
                                                                    <input type="hidden" name="hidf_d_id_<?php print $intContador; ?>" id="hidf_d_id_<?php print $intContador; ?>" value="<?php echo openssl_encrypt($producto['ID'], COD, KEY);  ?>">
                                                                    <button class="btn btn-danger" name="btnAccionMed" onclick="fntSelectSessionMed_d('<?php print $intContador; ?>')" type="buttom"><i class="fad fa-2x fa-ban"></i></button>
                                                                </td>
                                                            </tr>
                                                            <?php $total = $total + ($producto['CTG_FAP_PRE'] * $producto['CANTIDAD']); ?>
                                                        <?php
                                                            $intContador++;
                                                        } ?>
                                                        <tr>
                                                            <td colspan="4" aling="right">Total</td>
                                                            <td aling="right">
                                                                <h4>Q<?php echo number_format($total, 2); ?></h4>
                                                            </td>
                                                            <td></td>
                                                        </tr>
                                                        <tr>
                                                            <td colspan="5">
                                                                <form id="formDataMed" method="POST">
                                                                    <input type="hidden" name="idPacientedFarmacia" id="idPacientedFarmacia">
                                                                    <input type="hidden" name="nombrePacientedFarmacia" id="nombrePacientedFarmacia">

                                                                    <input id="CTG_FAP_NOMCOM" name="CTG_FAP_NOMCOM" class="form-control" value="<?php echo $producto['CTG_FAP_NOMCOM']; ?>" type="hidden">
                                                                    <input id="CTG_FAR_NOMCOM" name="CTG_FAR_NOMCOM" class="form-control" value="<?php echo $producto['CTG_FAR_NOMCOM']; ?>" type="hidden">

                                                                    <input id="CTG_FAP_CONTRATO" name="CTG_FAP_CONTRATO" class="form-control" value="<?php echo $producto['CTG_FAP_CONTRATO']; ?>" type="hidden">
                                                                    <input id="CTG_FAR_CODE" name="CTG_FAR_CODE" class="form-control" value="<?php echo $producto['CTG_FAR_CODE']; ?>" type="hidden">
                                                                    <input id="CTG_FAP_PRO" name="CTG_FAP_PRO" class="form-control" value="<?php echo $producto['CTG_FAP_PRO']; ?>" type="hidden">

                                                                    <input id="CANTIDAD" name="CANTIDAD" class="form-control" value="<?php echo $producto['CANTIDAD']; ?>" type="hidden">
                                                                    <input id="CTG_FAP_PRE" name="CTG_FAP_PRE" class="form-control" value="<?php echo $producto['CTG_FAP_PRE']; ?>" type="hidden">
                                                                    <input id="CTG_FAR_EMAIL" name="CTG_FAR_EMAIL" class="form-control" value="<?php echo $producto['CTG_FAR_EMAIL']; ?>" type="hidden">
                                                                    <input id="CTG_TOTAL" name="CTG_TOTAL" class="form-control" value="<?php echo number_format($total, 2); ?>" type="hidden">

                                                                </form>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>

                                                <form id="formData_m_d" method="POST">
                                                    <input type="hidden" name="m_id_d" id="m_id_d">

                                                </form>
                                            <?php } else { ?>
                                                <div class="alert alert-success">
                                                    NO HAY PRODUCTOS SELECCIONADOS
                                                </div>
                                            <?php } ?>
                                            <!-- 
                        <button type="button" class="btn btn-raised btn-primary" id="InsertMed" onclick="fntInsertMed()"><i class="fad fa-2x fa-save"></i></button>
                        -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-2 col-md-1 "></div>
            </div>
        </div>

    <?php

    } else if ($strTipoValidacion == "session_carrito_vac") {
    ?>
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-12 col-md-12 ">
                    <div class=" collapse show" id="sessionVaccine">
                        <div class="card-body">
                            <div class="card-primary collapsed-card">
                                <div class="card-body" id="tableVaccineSession_" name="tableVaccineSession_" style="display: none;">
                                    <div class="div1">
                                        <div id="tableVaccineSession" name="tableVaccineSession">
                                            <h4>ORDENES DE VACUNAS</h4>
                                            <a class="btn btn-raised btn-info btn-center" onclick="fntVaccineSessionClose()"><i class="fad fa-2x fa-reply"></i></a>
                                            <input type="hidden" class="form-control" id="VAL_CARRITOVAC" name="VAL_CARRITOVAC" value="<?php echo (empty($_SESSION['CARRITOVAC'])) ? '' : count($_SESSION['CARRITOVAC']); ?>">

                                            <!-- DIBUJO DE TABLA -->
                                            <?php if (!empty($_SESSION['CARRITOVAC'])) { ?>
                                                <table class="table table-bordered table-striped table-hover table-sm">
                                                    <tbody>
                                                        <thead>
                                                            <tr>
                                                                <th width="0%">Vacuna</th>
                                                                <th width="15%" class="text-center">Cantidad</th>
                                                                <th width="10%" class="text-center">Precio</th>
                                                                <th width="10%" class="text-center">Total</th>
                                                                <th width="5%"></th>
                                                            </tr>
                                                        </thead>
                                                        <?php $total = 0; ?>
                                                        <?php
                                                        $intContador = 1;
                                                        foreach ($_SESSION['CARRITOVAC'] as $indice => $producto) { ?>
                                                            <tr>
                                                                <td width="0%"><?php echo $producto['MED_VAC_NOM'] ?></td>
                                                                <td width="15%" class="text-center"><?php echo $producto['CANTIDAD'] ?></td>
                                                                <td width="10%" class="text-center">Q<?php echo $producto['MED_VAC_PRECIO'] ?></td>
                                                                <td width="10%" class="text-center">Q<?php echo number_format($producto['MED_VAC_PRECIO'] * $producto['CANTIDAD'], 2); ?></td>
                                                                <td width="5%">
                                                                    <input type="hidden" name="hidv_id_d_<?php print $intContador; ?>" id="hidv_id_d_<?php print $intContador; ?>" value="<?php echo openssl_encrypt($producto['ID'], COD, KEY);  ?>">

                                                                    <button class="btn btn-danger" name="btnAccionVacc" onclick="fntSelectSessionVac_d('<?php print $intContador; ?>')" type="buttom"><i class="fad fa-2x fa-ban"></i></button>
                                                                </td>
                                                            </tr>
                                                            <?php $total = $total + ($producto['MED_VAC_PRECIO'] * $producto['CANTIDAD']); ?>
                                                        <?php
                                                            $intContador++;
                                                        } ?>
                                                        <tr>
                                                            <td colspan="4" aling="right">Total</td>
                                                            <td aling="right">
                                                                <h4>Q<?php echo number_format($total, 2); ?></h4>
                                                            </td>
                                                            <td></td>
                                                        </tr>
                                                        <tr>
                                                            <td colspan="5">
                                                                <form id="formDataVac" method="post">
                                                                    <input type="hidden" name="idPacienteVacuna" id="idPacienteVacuna">
                                                                    <input type="hidden" name="nombrePacienteVacuna" id="nombrePacienteVacuna">

                                                                    <input id="MED_VAC_NOM" name="MED_VAC_NOM" class="form-control" value="<?php echo $producto['MED_VAC_NOM']; ?>" type="hidden">
                                                                    <input id="MED_VAC_ID" name="MED_VAC_ID" class="form-control" value="<?php echo $producto['MED_VAC_ID']; ?>" type="hidden">

                                                                    <input id="CANTIDAD" name="CANTIDAD" class="form-control" value="<?php echo $producto['CANTIDAD']; ?>" type="hidden">
                                                                    <input id="MED_VAC_PRECIO" name="MED_VAC_PRECIO" class="form-control" value="<?php echo $producto['MED_VAC_PRECIO']; ?>" type="hidden">
                                                                    <input id="TOTAL" name="TOTAL" class="form-control" value="<?php echo number_format($total, 2); ?>" type="hidden">
                                                                </form>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>

                                                <form id="v_formData_d" method="post">
                                                    <input type="hidden" name="v_id_d" id="v_id_d">

                                                </form>
                                            <?php } else { ?>
                                                <div class="alert alert-success">
                                                    NO HAY PRODUCTOS SELECCIONADOS
                                                </div>
                                            <?php } ?>
                                            <!--
                        <button type="button" class="btn btn-raised btn-primary" id="InsertVac" onclick="fntInsertVac()"><i class="fad fa-2x fa-save"></i></button>
                          -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-2 col-md-1 "></div>
            </div>
        </div>
    <?php
    } else if ($strTipoValidacion == "session_carrito_lab") {
    ?>
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-12 col-md-12 ">
                    <div class=" collapse show" id="sessionLaboratory">
                        <div class="card-body">
                            <div class="card-primary collapsed-card">
                                <div class="card-body " id="tableLabExaSession_" name="tableLabExaSession_" style="display: none;">
                                    <div class="div1">
                                        <div id="tableLabExaSession" name="tableLabExaSession">
                                            <h4>ORDENES DE LABORATORIO</h4>
                                            <a class="btn btn-raised btn-info btn-center" onclick="fntLaboratorySessionClose()"><i class="fad fa-2x fa-reply"></i></a>
                                            <input type="hidden" class="form-control" id="VAL_CARRITOLAB" name="VAL_CARRITOLAB" value="<?php echo (empty($_SESSION['CARRITOLAB'])) ? '' : count($_SESSION['CARRITOLAB']); ?>">

                                            <!-- DIBUJO DE TABLA -->
                                            <?php if (!empty($_SESSION['CARRITOLAB'])) { ?>
                                                <table class="table table-bordered table-striped table-hover table-sm">
                                                    <tbody>
                                                        <thead>
                                                            <tr>
                                                                <th width="30%">Servicio</th>
                                                                <th width="30%">Laboratorio</th>
                                                                <th width="15%" class="text-center">Cantidad</th>
                                                                <th width="10%" class="text-center">Precio</th>
                                                                <th width="10%" class="text-center">Total</th>
                                                                <th width="5%"></th>
                                                            </tr>
                                                        </thead>
                                                        <?php $total = 0; ?>
                                                        <?php
                                                        $intContador = 1;
                                                        foreach ($_SESSION['CARRITOLAB'] as $indice => $producto) { ?>
                                                            <tr>
                                                                <td width="30%"><?php echo $producto['CTG_LCE_DESCRIP'] ?></td>
                                                                <td width="30%"><?php echo $producto['CTG_LAB_NOMCOM'] ?></td>
                                                                <td width="15%" class="text-center"><?php echo $producto['CANTIDAD'] ?></td>
                                                                <td width="10%" class="text-center">Q<?php echo $producto['CTG_LCE_PRE'] ?></td>
                                                                <td width="10%" class="text-center">Q<?php echo number_format($producto['CTG_LCE_PRE'] * $producto['CANTIDAD'], 2); ?></td>
                                                                <td width="5%">
                                                                    <input type="hidden" name="hidl_id_d_<?php print $intContador; ?>" id="hidl_id_d_<?php print $intContador; ?>" value="<?php echo openssl_encrypt($producto['ID'], COD, KEY);  ?>">

                                                                    <button class="btn btn-danger" name="btnAccionLab" onclick="fntSelectSessionLab_d('<?php print $intContador; ?>')" type="buttom"><i class="fad fa-2x fa-ban"></i></button>
                                                                </td>
                                                            </tr>
                                                            <?php $total = $total + ($producto['CTG_LCE_PRE'] * $producto['CANTIDAD']); ?>
                                                        <?php
                                                            $intContador = 1;
                                                        } ?>
                                                        <tr>
                                                            <td colspan="4" aling="right">Total</td>
                                                            <td aling="right">
                                                                <h4>Q<?php echo number_format($total, 2); ?></h4>
                                                            </td>
                                                            <td></td>
                                                        </tr>
                                                        <tr>
                                                            <td colspan="5">
                                                                <form id="formDataLab" method="post">
                                                                    <input type="hidden" name="idPacientecLaboratorio" id="idPacientecLaboratorio">
                                                                    <input type="hidden" name="nombrePacientecLaboratorio" id="nombrePacientecLaboratorio">

                                                                    <input id="CTG_LCE_DESCRIP" name="CTG_LCE_DESCRIP" class="form-control" value="<?php echo $producto['CTG_LCE_DESCRIP']; ?>" type="hidden">
                                                                    <input id="CTG_LAB_NOMCOM" name="CTG_LAB_NOMCOM" class="form-control" value="<?php echo $producto['CTG_LAB_NOMCOM']; ?>" type="hidden">

                                                                    <input id="CTG_LCE_CONTRATO" name="CTG_LCE_CONTRATO" class="form-control" value="<?php echo $producto['CTG_LCE_CONTRATO']; ?>" type="hidden">
                                                                    <input id="CTG_LAB_CONTRATO" name="CTG_LAB_CONTRATO" class="form-control" value="<?php echo $producto['CTG_LAB_CONTRATO']; ?>" type="hidden">
                                                                    <input id="CTG_LCE_CODE" name="CTG_LCE_CODE" class="form-control" value="<?php echo $producto['CTG_LCE_CODE']; ?>" type="hidden">
                                                                    <input id="CTG_LAB_CODE" name="CTG_LAB_CODE" class="form-control" value="<?php echo $producto['CTG_LAB_CODE']; ?>" type="hidden">

                                                                    <input id="CANTIDAD" name="CANTIDAD" class="form-control" value="<?php echo $producto['CANTIDAD']; ?>" type="hidden">
                                                                    <input id="CTG_LCE_PRE" name="CTG_LCE_PRE" class="form-control" value="<?php echo $producto['CTG_LCE_PRE']; ?>" type="hidden">
                                                                    <input id="CTG_LAB_EMAIL" name="CTG_LAB_EMAIL" class="form-control" value="<?php echo $producto['CTG_LAB_EMAIL']; ?>" type="hidden">
                                                                    <input id="TOTAL" name="TOTAL" class="form-control" value="<?php echo number_format($total, 2); ?>" type="hidden">
                                                                </form>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>

                                                <form id="formData_l_d" method="post">
                                                    <input type="hidden" name="id_l_d" id="id_l_d">

                                                </form>
                                            <?php } else { ?>
                                                <div class="alert alert-success">
                                                    NO HAY PRODUCTOS SELECCIONADOS
                                                </div>
                                            <?php } ?>
                                            <!--
                          <button type="button" class="btn btn-raised btn-primary" id="InsertLab" onclick="fntInsertLab()"><i class="fad fa-2x fa-save"></i></button>
                          -->

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-2 col-md-1 "></div>
            </div>
        </div>
         <?php
        } else if ($strTipoValidacion == "session_carrito_hosp") {
            ?>
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-12 col-md-12 ">
                    <div class="collapse" id="sessionHospital">
                        <div class="card-body">
                            <div class="card-primary collapsed-card">
                                <div class="card-body " id="tableHospServSession_" name="tableHospServSession_" style="display: none;">
                                    <div class="div1">
                                        <div id="tableHospServSession" name="tableHospServSession">
                                            <h4>ORDENES SERVICIOS DE HOSPITALES</h4>
                                            <a class="btn btn-raised btn-info btn-center" onclick="fntHospitalSessionClose()"><i class="fad fa-2x fa-reply"></i></a>
                                            <input type="hidden" class="form-control" id="VAL_CARRITOHOSP" name="VAL_CARRITOHOSP" value="<?php echo (empty($_SESSION['CARRITOHOSP'])) ? '' : count($_SESSION['CARRITOHOSP']); ?>">

                                            <!-- DIBUJO DE TABLA -->
                                            <?php if (!empty($_SESSION['CARRITOHOSP'])) { ?>
                                                <table class="table table-bordered table-striped table-hover table-sm">
                                                    <tbody>
                                                        <thead>
                                                            <tr>
                                                                <th width="30%">Servicio</th>
                                                                <th width="30%">Hospital</th>
                                                                <th width="15%" class="text-center">Cantidad</th>
                                                                <th width="10%" class="text-center">Precio</th>
                                                                <th width="10%" class="text-center">Total</th>
                                                                <th width="5%"></th>
                                                            </tr>
                                                        </thead>
                                                        <?php $total = 0; ?>
                                                        <?php
                                                        $intContador = 1;
                                                        foreach ($_SESSION['CARRITOHOSP'] as $indice => $producto) { ?>
                                                            <tr>
                                                                <td width="30%"><?php echo $producto['CTG_HPP_DESCRIP'] ?></td>
                                                                <td width="30%"><?php echo $producto['CTG_HOS_NOMCOM'] ?></td>
                                                                <td width="15%" class="text-center"><?php echo $producto['CANTIDAD'] ?></td>
                                                                <td width="10%" class="text-center">Q<?php echo $producto['CTG_HPP_PRE'] ?></td>
                                                                <td width="10%" class="text-center">Q<?php echo number_format($producto['CTG_HPP_PRE'] * $producto['CANTIDAD'], 2); ?></td>
                                                                <td width="5%">
                                                                    <input type="hidden" name="hidh_id_d_<?php print $intContador; ?>" id="hidh_id_d_<?php print $intContador; ?>" value="<?php echo openssl_encrypt($producto['ID'], COD, KEY);  ?>">

                                                                    <button class="btn btn-danger" name="btnAccionHosp" onclick="fntSelectSessionHosp_d('<?php print $intContador; ?>')" type="buttom"><i class="fad fa-2x fa-ban"></i></button>
                                                                </td>
                                                            </tr>
                                                            <?php $total = $total + ($producto['CTG_HPP_PRE'] * $producto['CANTIDAD']); ?>
                                                        <?php
                                                            $intContador++;
                                                        } ?>
                                                        <tr>
                                                            <td colspan="4" aling="right">Total</td>
                                                            <td aling="right">
                                                                <h4>Q<?php echo number_format($total, 2); ?></h4>
                                                            </td>
                                                            <td></td>
                                                        </tr>
                                                        <tr>
                                                            <td colspan="5">
                                                                <form id="formDataHosp" method="post">
                                                                    <input type="hidden" name="idPacientebHospital" id="idPacientebHospital">
                                                                    <input type="hidden" name="nombrePacientebHospital" id="nombrePacientebHospital">

                                                                    <input id="CTG_HPP_DESCRIP" name="CTG_HPP_DESCRIP" class="form-control" value="<?php echo $producto['CTG_HPP_DESCRIP']; ?>" type="hidden">
                                                                    <input id="CTG_HOS_NOMCOM" name="CTG_HOS_NOMCOM" class="form-control" value="<?php echo $producto['CTG_HOS_NOMCOM']; ?>" type="hidden">

                                                                    <input id="CTG_HOS_CONTRATO" name="CTG_HOS_CONTRATO" class="form-control" value="<?php echo $producto['CTG_HOS_CONTRATO']; ?>" type="hidden">
                                                                    <input id="CTG_HOS_CODE" name="CTG_HOS_CODE" class="form-control" value="<?php echo $producto['CTG_HOS_CODE']; ?>" type="hidden">

                                                                    <input id="CTG_HPP_CODE" name="CTG_HPP_CODE" class="form-control" value="<?php echo $producto['CTG_HPP_CODE']; ?>" type="hidden">
                                                                    <input id="CTG_HPP_CONTRATO" name="CTG_HPP_CONTRATO" class="form-control" value="<?php echo $producto['CTG_HPP_CONTRATO']; ?>" type="hidden">

                                                                    <input id="CANTIDAD" name="CANTIDAD" class="form-control" value="<?php echo $producto['CANTIDAD']; ?>" type="hidden">
                                                                    <input id="CTG_HPP_PRE" name="CTG_HPP_PRE" class="form-control" value="<?php echo $producto['CTG_HPP_PRE']; ?>" type="hidden">
                                                                    <input id="CTG_HOS_EMAIL" name="CTG_HOS_EMAIL" class="form-control" value="<?php echo $producto['CTG_HOS_EMAIL']; ?>" type="hidden">
                                                                    <input id="TOTAL" name="TOTAL" class="form-control" value="<?php echo number_format($total, 2); ?>" type="hidden">
                                                                </form>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                                <form id="formData_h_d" method="post">


                                                    <input type="hidden" name="id_h_d" id="id_h_d">

                                                </form>
                                            <?php } else { ?>
                                                <div class="alert alert-success">
                                                    NO HAY PRODUCTOS SELECCIONADOS
                                                </div>
                                            <?php } ?>
                                            <!--
                          <button type="button" class="btn btn-raised btn-primary" id="InsertLab" onclick="fntInsertHosp()"><i class="fad fa-2x fa-save"></i></button>
                            -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-2 col-md-1 "></div>
            </div>
        </div>
         <?php
        } else if ($strTipoValidacion == "LimpiarSesiones") {

            header('Content-Type: application/json');
            $val = 1;
            if ($val) {
                unset(
                    $_SESSION['CARRITOLAB'],
                    $_SESSION['CARRITOHOSP'],
                    $_SESSION['CARRITOMED'],
                    $_SESSION['CARRITOVAC']
                );
            }

            if ($val) {
                $arrInfo['status'] = $val;
            } else {
                $arrInfo['status'] = 0;
                $arrInfo['error'] = $var_consulta;
            }

            print json_encode($arrInfo);
        }else if ($strTipoValidacion == "LimpiarSesionesLocal") {

            header('Content-Type: application/json');
            $val = 1;
            if ($val) {
                unset(
                    $_SESSION['CARRITOLAB'],
                    $_SESSION['CARRITOHOSP'],
                    $_SESSION['CARRITOMED'],
                    $_SESSION['CARRITOVAC']
                );
            }

            if ($val) {
                $arrInfo['status'] = $val;
            } else {
                $arrInfo['status'] = 0;
                $arrInfo['error'] = $var_consulta;
            }

            print json_encode($arrInfo);
        } else if ($strTipoValidacion == "table_dietas") {
            require_once "../../data/conexion/tmlMed.php";
            $tablaDietas = "med" . $id . "dietas";
            $strSearch = isset($_POST["Search"]) ? $_POST["Search"]  : '';

            $strFilter = "";
            if (!empty($strSearch)) {
                $strFilter = " WHERE ( UPPER(med_die_nom) LIKE UPPER('%{$strSearch}%') ) ";
            }

            $arrTableLabExa = array();
            $var_consulta = "SELECT * 
                            FROM $tablaDietas
                            $strFilter 
                            ORDER BY med_die_nom DESC
                            LIMIT 100";
            $sql = pg_query($tmfMed, $var_consulta);
            $totalArticle = pg_num_rows($sql);


            while ($rTMP = pg_fetch_assoc($sql)) {

                $arrTableLabExa[$rTMP["id"]]["id"]                                   = $rTMP["id"];
                $arrTableLabExa[$rTMP["id"]]["med_die_id"]                                   = $rTMP["med_die_id"];
                $arrTableLabExa[$rTMP["id"]]["med_die_nom"]                                   = $rTMP["med_die_nom"];
                $arrTableLabExa[$rTMP["id"]]["med_die_des"]                                   = $rTMP["med_die_des"];
            }
            pg_free_result($sql);

            ?>
        <div class="col-md-12 tableFixHead">
            <table id="tableFarmac" class="table table-bordered table-striped table-hover table-sm">
                <thead>
                    <tr class="table-info">
                        <th>Nombre de la dieta</th>

                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (is_array($arrTableLabExa) && (count($arrTableLabExa) > 0)) {
                        $intContador = 1;
                        reset($arrTableLabExa);
                        foreach ($arrTableLabExa as $rTMP['key'] => $rTMP['value']) {
                    ?>
                            <tr style="cursor:pointer;  text-align:center;">
                                <td onclick="fntSelectDieta('<?php print $intContador; ?>')"><?php echo  $rTMP["value"]['med_die_nom']; ?></td>
                            </tr>

                            <input type="hidden" name="hidMed_die_des_<?php print $intContador; ?>" id="hidMed_die_des_<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['med_die_des']; ?>">
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
        } else if ($strTipoValidacion == "table_historial_medic") {
            require_once "../../data/conexion/tmlMed.php";
            require_once "../../data/conexion/tmfPac.php";
            $code = isset($_POST["code"]) ? $_POST["code"]  : '';
            $year = date('Y');
            $Consulta = "a" . $year . "_medicos_consultas";
            $arrTableConsulta = array();
            $var_consulta = "SELECT  to_char(med_con_cita_dt::date,'DD-MM-YYYY') fecha,to_char(med_con_citap_dt::date,'DD-MM-YYYY') fecha_d,* 
                            FROM $Consulta 
                            WHERE med_con_pac_id = '$code'
                            ORDER BY fecha DESC";
            $sql = pg_query($tmfPac, $var_consulta);
            $totalArticle = pg_num_rows($sql);


            while ($rTMP = pg_fetch_assoc($sql)) {

                $arrTableConsulta[$rTMP["med_con_id"]]["med_con_id"]                   = $rTMP["med_con_id"];
                $arrTableConsulta[$rTMP["med_con_id"]]["med_con_med_id"]                   = $rTMP["med_con_med_id"];
                $arrTableConsulta[$rTMP["med_con_id"]]["med_con_pac_id"]                   = $rTMP["med_con_pac_id"];
                $arrTableConsulta[$rTMP["med_con_id"]]["fecha"]                   = $rTMP["fecha"];
                $arrTableConsulta[$rTMP["med_con_id"]]["med_con_motivo"]                   = $rTMP["med_con_motivo"];
                $arrTableConsulta[$rTMP["med_con_id"]]["med_con_examen"]                   = $rTMP["med_con_examen"];
                $arrTableConsulta[$rTMP["med_con_id"]]["med_con_receta"]                   = $rTMP["med_con_receta"];
                $arrTableConsulta[$rTMP["med_con_id"]]["med_con_dieta"]                   = $rTMP["med_con_dieta"];
                $arrTableConsulta[$rTMP["med_con_id"]]["med_con_observa"]                   = $rTMP["med_con_observa"];
                $arrTableConsulta[$rTMP["med_con_id"]]["med_con_sta"]                   = $rTMP["med_con_sta"];
                $arrTableConsulta[$rTMP["med_con_id"]]["med_con_dt"]                   = $rTMP["med_con_dt"];
                $arrTableConsulta[$rTMP["med_con_id"]]["med_con_usr"]                   = $rTMP["med_con_usr"];
                $arrTableConsulta[$rTMP["med_con_id"]]["med_con_uni_id"]                   = $rTMP["med_con_uni_id"];
                $arrTableConsulta[$rTMP["med_con_id"]]["med_con_enf_id"]                   = $rTMP["med_con_enf_id"];
                $arrTableConsulta[$rTMP["med_con_id"]]["fecha_d"]                   = $rTMP["fecha_d"];
            }
            pg_free_result($sql);

    ?>
        <div class="col-md-12 tableFixHead">
            <table id="tableVaccine" class="table table-bordered table-striped table-hover table-sm">
                <thead>
                    <tr class="table-info">
                        <th width="10%">Orden</th>
                        <th width="10%">Fecha</th>
                        <th width="10%">Prox. Cita</th>
                        <th width="20%">Medico</th>
                        <th>Motivo</th>
                        <th width="5%">Mas Informacion</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (is_array($arrTableConsulta) && (count($arrTableConsulta) > 0)) {
                        $intContador = 1;
                        reset($arrTableConsulta);
                        foreach ($arrTableConsulta as $rTMP['key'] => $rTMP['value']) {
                            require_once "../../data/conexion/tmfAdm.php";

                            $unidad_id = $rTMP["value"]['med_con_uni_id'];
                            //print_r($unidad_id);

                            $rsFarUnidad = pg_query($rmfAdm, "SELECT ctg_uns_desc FROM ctg_uni_sanitarias WHERE ctg_uns_cod = $unidad_id ");
                            if ($row = pg_fetch_array($rsFarUnidad)) {
                                $idRowUni = trim($row[0]);
                            }
                            $unidad = isset($idRowUni) ? $idRowUni : 0;
                            //print_r($unidad);
                            $enfermedad_id = $rTMP["value"]['med_con_enf_id'];
                            $rsFarEnfermedad = pg_query($rmfAdm, "SELECT ctg_enf_desc FROM ctg_enfermedades WHERE ctg_enf_cod = '$enfermedad_id' LIMIT 1");
                            //print_r($rsFar);
                            if ($row = pg_fetch_array($rsFarEnfermedad)) {
                                $idRowEnfer = trim($row[0]);
                            }
                            $enfermedad = isset($idRowEnfer) ? $idRowEnfer : 0;

                            $ori_id = $rTMP["value"]['med_con_med_id'];
                            $rsFar = pg_query($rmfAdm, "SELECT ctg_med_nombres , ctg_med_apellidos FROM ctg_medicos WHERE id = '$ori_id' LIMIT 1");
                            //print_r($rsFar);
                            if ($row = pg_fetch_array($rsFar)) {
                                $idRowCodeN = trim($row[0]);
                                $idRowCodeL = trim($row[1]);
                            }
                            $nombres = isset($idRowCodeN) ? $idRowCodeN : 0;
                            $apellidos = isset($idRowCodeL) ? $idRowCodeL : 0;
                    ?>
                            <tr>
                                <td><?php echo  $rTMP["value"]['med_con_id']; ?></td>
                                <td><?php echo  $rTMP["value"]['fecha']; ?></td>
                                <td><?php echo  $rTMP["value"]['fecha_d']; ?></td>
                                <td><?php echo  $nombres; ?> <?php echo  $apellidos; ?></td>
                                <td><?php echo  $rTMP["value"]['med_con_motivo']; ?></td>
                                <td data-toggle="modal" data-target="#ModalMoreView">
                                    <i title="ver " class="fad fa-eye fa-2x" style="cursor:pointer;"></i>
                                </td>
                            </tr>

                            <div class="modal fade" id="ModalMoreView" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title w-100" id="myModalLabel">MAS INFORMACION</h4>
                                            <button type="button" class="CERRAR" data-dismiss="modal" aria-label="CERRAR">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="card-primary collapsed-card">
                                                <div class="card-body">
                                                    <div class="div1">
                                                        <div id="" name="">
                                                            <div class="form-group col-md-12">
                                                                <label for="Examen" class=" color-label">Unidad Sanitaria</label>
                                                                <textarea class="form-control" id="Examen" rows="5" name="Examen"><?php echo  $unidad ?></textarea>
                                                            </div>
                                                            <div class="form-group col-md-12">
                                                                <label for="Examen" class=" color-label">Enfermedad</label>
                                                                <textarea class="form-control" id="Examen" rows="5" name="Examen"><?php echo  $enfermedad; ?></textarea>
                                                            </div>
                                                            <div class="form-group col-md-12">
                                                                <label for="Examen" class=" color-label">Examen</label>
                                                                <textarea class="form-control" id="Examen" rows="5" name="Examen"><?php echo  $rTMP["value"]['med_con_examen']; ?></textarea>
                                                            </div>
                                                            <div class="form-group col-md-12">
                                                                <label for="Receta" class=" color-label">Receta</label>
                                                                <textarea class="form-control" id="Receta" rows="5" name="Receta"><?php echo  $rTMP["value"]['med_con_receta']; ?></textarea>
                                                            </div>
                                                            <div class="form-group col-md-12">
                                                                <label for="Dieta" class=" color-label">Dieta</label>
                                                                <textarea class="form-control" id="Dieta" rows="5" name="Dieta"><?php echo  $rTMP["value"]['med_con_dieta']; ?></textarea>
                                                            </div>
                                                            <div class="form-group col-md-12">
                                                                <label for="Observaciones" class=" color-label">Observaciones</label>
                                                                <textarea class="form-control" id="Observaciones" rows="5" name="Observaciones"><?php echo  $rTMP["value"]['med_con_observa']; ?></textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">CERRAR</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php
                        }
                    } else {
                        ?>
                        <div class="alert alert-danger" role="alert">
                            No tiene historial!!!
                        </div>
            <?PHP
                        die();
                    }
                }
                die();
            }

            require_once "../../data/conexion/tmfAdm.php";

            $arrSexos = array();
            $var_consulta = "SELECT * 
                    FROM ctg_sexos 
                    ORDER BY ctg_sex_cod";
            $sql = pg_query($rmfAdm, $var_consulta);
            $totalArticle = pg_num_rows($sql);


            while ($rTMP = pg_fetch_assoc($sql)) {

                $arrSexos[$rTMP["id"]]["id"]                                         = $rTMP["id"];
                $arrSexos[$rTMP["id"]]["ctg_sex_cod"]                                = $rTMP["ctg_sex_cod"];
                $arrSexos[$rTMP["id"]]["ctg_sex_desc"]                               = $rTMP["ctg_sex_desc"];
                $arrSexos[$rTMP["id"]]["ctg_sex_sta"]                                = $rTMP["ctg_sex_sta"];
                $arrSexos[$rTMP["id"]]["ctg_sex_dt"]                                 = $rTMP["ctg_sex_dt"];
                $arrSexos[$rTMP["id"]]["ctg_sex_usr"]                                = $rTMP["ctg_sex_usr"];
            }
            pg_free_result($sql);


            $arrSan = array();
            $var_consulta = "SELECT * 
                    FROM ctg_uni_sanitarias 
                    ORDER BY ctg_uns_cod";
            $sql = pg_query($rmfAdm, $var_consulta);
            $totalArticle = pg_num_rows($sql);


            while ($rTMP = pg_fetch_assoc($sql)) {

                $arrSan[$rTMP["ctg_uns_id"]]["ctg_uns_id"]                                         = $rTMP["ctg_uns_id"];
                $arrSan[$rTMP["ctg_uns_id"]]["ctg_uns_cod"]                                = $rTMP["ctg_uns_cod"];
                $arrSan[$rTMP["ctg_uns_id"]]["ctg_uns_desc"]                               = $rTMP["ctg_uns_desc"];
            }
            pg_free_result($sql);

            $arrEnfermedades = array();
            $var_consulta = "SELECT * 
                    FROM ctg_enfermedades 
                    ORDER BY ctg_enf_desc";
            $sql = pg_query($rmfAdm, $var_consulta);
            $totalArticle = pg_num_rows($sql);


            while ($rTMP = pg_fetch_assoc($sql)) {

                $arrEnfermedades[$rTMP["id"]]["id"]                                         = $rTMP["id"];
                $arrEnfermedades[$rTMP["id"]]["ctg_enf_cod"]                                         = $rTMP["ctg_enf_cod"];
                $arrEnfermedades[$rTMP["id"]]["ctg_enf_desc"]                                         = $rTMP["ctg_enf_desc"];
            }
            pg_free_result($sql);

            require_once "../../data/conexion/tmlMed.php";
            $med = 1;
            $numPac = "med" . $med . "consultas";
            $arrTableDiet = array();
            $var_consulta = "SELECT * FROM $numPac ORDER BY id ";
            $sql = pg_query($tmfMed, $var_consulta);
            $totalArticle = pg_num_rows($sql);


            while ($rTMP = pg_fetch_assoc($sql)) {

                $arrTableDiet[$rTMP["med_con_id"]]["med_con_id"]                       = $rTMP["med_con_id"];
                $arrTableDiet[$rTMP["med_con_id"]]["med_con_pac_id"]                   = $rTMP["med_con_pac_id"];
                $arrTableDiet[$rTMP["med_con_id"]]["med_con_cita_dt"]                  = $rTMP["med_con_cita_dt"];
                $arrTableDiet[$rTMP["med_con_id"]]["med_con_motivo"]                   = $rTMP["med_con_motivo"];
                $arrTableDiet[$rTMP["med_con_id"]]["med_con_examen"]                   = $rTMP["med_con_examen"];
                $arrTableDiet[$rTMP["med_con_id"]]["med_con_receta"]                   = $rTMP["med_con_receta"];
                $arrTableDiet[$rTMP["med_con_id"]]["med_con_dieta"]                    = $rTMP["med_con_dieta"];
                $arrTableDiet[$rTMP["med_con_id"]]["med_con_observa"]                  = $rTMP["med_con_observa"];
                $arrTableDiet[$rTMP["med_con_id"]]["med_con_sta"]                      = $rTMP["med_con_sta"];
                $arrTableDiet[$rTMP["med_con_id"]]["med_con_dt"]                       = $rTMP["med_con_dt"];
                $arrTableDiet[$rTMP["med_con_id"]]["med_con_usr"]                      = $rTMP["med_con_usr"];
            }
            pg_free_result($sql);



            ?>
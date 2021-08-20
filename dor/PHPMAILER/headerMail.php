<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;


require 'PHPMailer.php';
require 'SMTP.php';
require 'Exception.php';

require_once "../api/globalFunctions.php";
require_once "../data/conexion/tmfAdm.php";
require_once "../data/conexion/tmlFar.php";
require_once "../data/conexion/tmlMed.php";
$val = 1;
$year  = '2021';
$correo  = 'andrelopez012@gmail.com';
$med_con_id_  = '127';
$nombreCmMedico  = 'Dr. Mario Casas';
$medicoDireccion  = '14 av a 13-81';
$medicoTelefono  = '22222222';
$nombreConsulta   = 'andre lopez';
$med_con_receta   = 'med_con_receta';
$med_con_dieta   = 'med_con_dieta';
$proxima_cita   = '10/10/2020';
$fechaDia   = '05-03-2021';
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
                    echo $med_coh_hos_id . '  tienda ';
                    echo '<br>';
                    if (isset($valueC["productos"]) && is_array($valueC["productos"]) && (count($valueC["productos"]) > 0)) {
                        reset($valueC["productos"]);
                        foreach ($valueC["productos"] as $keyP => $valueP) {

                            $med_coh_ser_id = $valueP['pro_id'];
                            echo $med_coh_ser_id . '  producto ';
                    echo '<br>';
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
                                <td align="right" width="10%" bgcolor= "#3498db">Numero de Registro: </td>'
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
        
                                    <b color="teal">SERVICIOS HOSPITALARIOS ORDENADOS</b><br>
                                    <table class="default" width="100%">'
                        . $tablaMedic . '
                                    </table><br><br>
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
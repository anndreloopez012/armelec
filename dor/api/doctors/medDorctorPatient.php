<?php
if (isset($_GET["validaciones"]) && !empty($_GET["validaciones"])) {
    require_once "../../api/globalFunctions.php";
    require_once "../../data/conexion/tmfAdm.php";
    require_once "../../api/config.php";
    require_once "../../data/conexion/tmlMed.php";

    $idUsuario = $_SESSION['adm_usr_code'];
    $tabla = 'med' . $idUsuario . 'pacientes';

    $insert = 1;
    $update = 2;
    $delete = 3;

    $rs = pg_query($rmfAdm, "SELECT ctg_med_nombres,ctg_med_apellidos,ctg_med_dir,ctg_med_telcel FROM ctg_medicos WHERE ctg_med_code = $idUsuario ORDER BY ctg_med_nombres DESC LIMIT 1");
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

    $id = isset($_POST["id"]) ? $_POST["id"]  : 0;
    $idMenbrecia = isset($_POST["id"]) ? $_POST["id"]  : 0;
    $med = $_SESSION['adm_usr_code'];;
    $tablaPacientes = "med" . $med . "pacientes";
    $rs = pg_query($tmfMed, "SELECT id FROM  $tablaPacientes ORDER BY id DESC LIMIT 1");
    if ($row = pg_fetch_array($rs)) {
        $idRow = trim($row[0]);
    }
    $idRow_ = isset($idRow) ? $idRow  : 0;
    $idMax = $idRow_ + 1;
    $id_med_pac = isset($_POST["id_med_pac"]) ? $_POST["id_med_pac"]  : 0;
    $DocPersonal = isset($_POST["DocPersonal"]) ? $_POST["DocPersonal"]  : '';
    $DocPersonal_ = isset($_POST["DocPersonal_"]) ? $_POST["DocPersonal_"]  : '';
    $Name = isset($_POST["Name"]) ? $_POST["Name"]  : '';
    $LastName = isset($_POST["LastName"]) ? $_POST["LastName"]  : '';
    $Fullname = $Name . " " . $LastName;
    $Sex = isset($_POST["Sex"]) ? $_POST["Sex"]  : 0;
    $Civil = isset($_POST["Sex"]) ? $_POST["Sex"]  : 0;
    $Pais = isset($_POST["Pais"]) ? $_POST["Pais"]  : 0;
    $Region = isset($_POST["region"]) ? $_POST["region"]  : 0;
    $Distri = isset($_POST["distrito"]) ? $_POST["distrito"]  : 0;
    $Tell = isset($_POST["Tell"]) ? $_POST["Tell"]  : 00000000;
    $TellCell = isset($_POST["Tell"]) ? $_POST["Tell"]  : 00000000;
    $Adress = isset($_POST["Adress"]) ? $_POST["Adress"]  : '';
    $Zona = isset($_POST["Zona"]) ? $_POST["Zona"]  : ' ';
    $Mail = isset($_POST["Mail"]) ? $_POST["Mail"]  : '';

    $Pass = isset($_POST["Mail"]) ? $_POST["Mail"]  : '';
    $UserName = isset($_POST["Mail"]) ? $_POST["Mail"]  : '';

    $FullNameEmer = isset($_POST["FullName"]) ? $_POST["FullName"]  : '';
    $Cell = isset($_POST["Cell"]) ? $_POST["Cell"]  : 00000000;
    $Email = isset($_POST["Email"]) ? $_POST["Email"]  : '';

    $status = 1; // estatus de afiliacion 
    $stat = 1;
    $adm_usr_tipo = 'pac';
    $fecha = date('Y-m-d H:i:s');
    $fechaD = date("d");
    $fechaM = date("m");
    $fechaA = date("Y");
    $usuario = $_SESSION['username'];

    $ctg_ven_dt = date('Y-m-d', strtotime($fecha . " + 90 day"));

    $pass = 0000000;

    $strTipoValidacion = isset($_REQUEST["validaciones"]) ? $_REQUEST["validaciones"] : '';

    if ($strTipoValidacion == "insert") {
        header('Content-Type: application/json');

        $rs = pg_query($rmfAdm, "SELECT COUNT(ctg_pac_dpi) FROM ctg_pacientes WHERE ctg_pac_dpi = '$DocPersonal'");
        if ($row = pg_fetch_array($rs)) {
            $idRow = trim($row[0]);
        }
        $id = isset($idRow) ? $idRow  : '';

        $rsm = pg_query($tmfMed, "SELECT COUNT(med_pac_dpi) FROM $tablaPacientes WHERE med_pac_dpi = '$DocPersonal'");
        if ($row = pg_fetch_array($rsm)) {
            $idRowp = trim($row[0]);
        }
        $idPac = isset($idRowp) ? $idRowp  : '';

        if (empty($id)) {

            $rs = pg_query($rmfAdm, "SELECT COUNT( ctg_pac_code ) from ctg_pacientes");
            if ($row = pg_fetch_array($rs)) {
                $idRow = trim($row[0]);
            }
            $variableCode_ = isset($idRow) ? $idRow  : 0;
            $variableCode = $variableCode_ + 1;

            $rs = pg_query($rmfAdm, "SELECT ctg_med_esp,ctg_med_nombres,ctg_med_nombres from ctg_medicos WHERE ctg_med_code = $idUsuario ");
            if ($row = pg_fetch_array($rs)) {
                $idRow = trim($row[0]);
                $idRow2 = trim($row[1]);
                $idRow3 = trim($row[2]);
            }
            $variableEspec = isset($idRow) ? $idRow  : '';
            $variableNombreMedico = isset($idRow2) ? $idRow2  : '';
            $variableApeliidoMedico = isset($idRow3) ? $idRow3  : '';
            $variableMedico = $variableNombreMedico . ' ' . $variableApeliidoMedico;

            $var_consulta = "INSERT INTO ctg_pacientes(ctg_pac_ven_dt,ctg_pac_dpi,ctg_pac_code,ctg_pac_codigo,ctg_pac_mem_id,ctg_pac_nombres,ctg_pac_apellidos,ctg_pac_sexo,ctg_pac_civil,ctg_pac_nac_dia,ctg_pac_nac_mes,ctg_pac_nac_ano,ctg_pac_dir,ctg_pac_zona,ctg_pac_dep,ctg_pac_mun,ctg_pac_telcel,ctg_pac_telpar,ctg_pac_email,ctg_pac_pass,ctg_pac_username,ctg_pac_estatus,ctg_pac_sta,ctg_pac_dt,ctg_pac_usr,ctg_pac_eme_nombre,ctg_pac_eme_tels,ctg_pac_eme_email,ctg_pac_medico_cabe_code,ctg_pac_medico_cabe_espe,ctg_pac_medico_cabe_descrip) VALUES ('$ctg_ven_dt','$DocPersonal','$variableCode','$DocPersonal','$variableCode','$Name','$LastName',$Sex,$Civil,$fechaD,$fechaM,$fechaA,'$Adress','$Zona','$Region','$Distri','$Tell','$TellCell','$Mail','$DocPersonal','$DocPersonal','$status','$stat','$fecha','$idUsuario','$FullNameEmer','$Cell','$Email','$idUsuario','$variableEspec','$variableMedico')";
            $val = 2;
            if (pg_query($rmfAdm, $var_consulta)) {
                $arrInfo['status'] = $val;
            } else {
                $arrInfo['status'] = 0;
                $arrInfo['error'] = $var_consulta;
            }
            //print json_encode($arrInfo);
            //print_r($var_consulta );


            $var_consulta = "INSERT INTO $tablaPacientes(med_pac_dpi,med_pac_code,med_pac_codigo,med_pac_mem_id,med_pac_nom,med_pac_ape,med_pac_sexo,med_pac_civil,med_pac_nac_dia,med_pac_nac_mes,med_pac_nac_ano,med_pac_dir,med_pac_zona,med_pac_dep,med_pac_mun,med_pac_telcel,med_pac_telpar,med_pac_email,med_pac_pass,med_pac_username,med_pac_estatus,med_pac_sta,med_pac_dt,med_pac_usr,med_pac_name_emer,med_pac_cel_emer,med_pac_email_emer) VALUES ('$DocPersonal',$variableCode,'$DocPersonal','$variableCode','$Name','$LastName',$Sex,$Civil,$fechaD,$fechaM,$fechaA,'$Adress','$Zona','$Region','$Distri','$Tell','$TellCell','$Mail','$DocPersonal','$DocPersonal','$status','$stat','$fecha','$idUsuario','$FullNameEmer','$Cell','$Email')";
            $val = 2;
            if (pg_query($tmfMed, $var_consulta)) {
                $arrInfo['status'] = $val;
            } else {
                $arrInfo['status'] = 0;
                $arrInfo['error'] = $var_consulta;
            }
            //print json_encode($arrInfo);
            //print_r($var_consulta);

            $val = 1;
            $var_consulta = "INSERT INTO web_users(mail,username,adm_usr_tipo,adm_usr_code,password,nombre_completo,status_actual,adm_date_ven) VALUES ('$Mail','$DocPersonal','$adm_usr_tipo','$variableCode','" . md5($DocPersonal) . "','$Fullname',$status,'$ctg_ven_dt');";
            if (pg_query($rmfAdm, $var_consulta)) {
                $arrInfo['status'] = $val;
            } else {
                $arrInfo['status'] = 0;
                $arrInfo['error'] = $var_consulta;
            }
            //print json_encode($arrInfo);
            //print_r($var_consulta);

            if ($val) {
                $subject_ = 'BIENVENIDO A VISUALMED.online';
                $address_  = $Mail;
                $mailContent = '<b>VisualMed - Paciente</b><br><br>
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
                <tr border="1">
                <td align="center"><b>TE DAMOS LA MAS CORDIAL BIENVENIDA</b></td><br>
                </tr>
                </table><br><br>

                <b>Estimado:</b><a>' . $Fullname . '</a><br><br>

                <b>El doctor ' . $nombreCmMedico . ' ha registrado tu perfil en nuestra plataforma VisualMed www.visualmed.online/gut/<br><br>
                Dentro de nuestros servicios podrás encontrar:<br><br>
                -  Visualizar tu historial medico<br>
                -  Programar citas<br>
                -  Buscar y ordener medicamentos en linea directamente a las farmacias participantes<br>
                -  Crear en linea solicitudes de exámenes de laboratorio directamente con los laboratorios participantes<br>
                -  Tener facilidad de acceso a la busqueda de servicios hospitalarios mas cercanos a ti.<br><br>
                Tus datos de acceso son:<br><br>
                - <b>Usuario:</b><a>' . $DocPersonal . '</a><br>
                <b>Contraseña:</b><a>' . $DocPersonal . '</a><br>
                <b>Fecha de vencimiento:</b><a>' . $ctg_ven_dt . '</a><br><br><br>' .
                    '<table class="default" width="100%">   
                    <tr border="1"> 
                        <td align="center" bgcolor= "#0464fc">  
                            <img src="https://i.ibb.co/ckwzNgQ/vmo-footer2-1.png" alt="vmo-footer2-1" border="0">
                        </td>
                    </tr>
                </table>';

                require_once "../../PHPMAILER/index.php";
            }
            ////print_r($var_consulta);
            print json_encode($arrInfo);
            // print_r('paciente nuevo');
        }

        if ($id >= 1) {
            $variableCode = isset($_POST["id_med_pac"]) ? $_POST["id_med_pac"]  : 0;

            if (empty($idPac)) {
                $var_consulta = "INSERT INTO $tablaPacientes(med_pac_dpi,med_pac_code,med_pac_codigo,med_pac_mem_id,med_pac_nom,med_pac_ape,med_pac_sexo,med_pac_civil,med_pac_nac_dia,med_pac_nac_mes,med_pac_nac_ano,med_pac_dir,med_pac_zona,med_pac_dep,med_pac_mun,med_pac_telcel,med_pac_telpar,med_pac_email,med_pac_pass,med_pac_username,med_pac_estatus,med_pac_sta,med_pac_dt,med_pac_usr,med_pac_name_emer,med_pac_cel_emer,med_pac_email_emer) VALUES ('$DocPersonal',$variableCode,'$DocPersonal','$variableCode','$Name','$LastName',$Sex,$Civil,$fechaD,$fechaM,$fechaA,'$Adress','$Zona','$Region','$Distri','$Tell','$TellCell','$Mail','$DocPersonal','$DocPersonal','$status','$stat','$fecha','$idUsuario','$FullNameEmer','$Cell','$Email')";
                $val = 2;
                if (pg_query($tmfMed, $var_consulta)) {
                    $arrInfo['status'] = $val;
                } else {
                    $arrInfo['status'] = 0;
                    $arrInfo['error'] = $var_consulta;
                }
                //print json_encode($arrInfo);
            }else{
                $var_consulta = " UPDATE $tablaPacientes SET med_pac_dpi =' $DocPersonal_', med_pac_codigo = '$DocPersonal_', med_pac_nom = '$Name', med_pac_ape = '$LastName', med_pac_sexo = '$Sex', med_pac_dir = '$Adress', med_pac_zona = '$Zona', med_pac_dep = '$Region', med_pac_mun = '$Distri', med_pac_telpar = '$Tell', med_pac_email = '$Mail' ,med_pac_name_emer = '$FullNameEmer' ,med_pac_cel_emer = '$Cell' ,med_pac_email_emer = '$Email' WHERE med_pac_code = $variableCode";
                $val = 1;
                if (pg_query($tmfMed, $var_consulta)) {
                    $arrInfo['status'] = $val;
                } else {
                    $arrInfo['status'] = 0;
                    $arrInfo['error'] = $var_consulta;
                }
            }
            require_once "../../data/conexion/tmfAdm.php";
            $var_consulta = " UPDATE ctg_pacientes SET ctg_pac_dpi =' $DocPersonal_',ctg_pac_nombres = '$Name', ctg_pac_apellidos = '$LastName', ctg_pac_sexo = '$Sex',ctg_pac_dir = '$Adress', ctg_pac_zona = '$Zona',ctg_pac_dep = '$Region',ctg_pac_mun = '$Distri',ctg_pac_telcel = '$Tell', ctg_pac_email = '$Mail' ,ctg_pac_eme_nombre = '$FullNameEmer' ,ctg_pac_eme_tels = '$Cell' ,ctg_pac_eme_email = '$Email'WHERE ctg_pac_code = $variableCode";
            $val = 1;
            if (pg_query($rmfAdm, $var_consulta)) {
                $arrInfo['status'] = $val;
            } else {
                $arrInfo['status'] = 0;
                $arrInfo['error'] = $var_consulta;
            }
            print json_encode($arrInfo);
            //print_r($var_consulta );
            //print_r('paciente nuevo existente');
        }
        //print json_encode($arrInfo);
        //print_r($var_consulta );
        die();
    } else if ($strTipoValidacion == "update") {
        header('Content-Type: application/json');
        $var_consulta = " UPDATE $tablaPacientes SET med_pac_dpi =' $DocPersonal_', med_pac_codigo = '$DocPersonal_', med_pac_nom = '$Name', med_pac_ape = '$LastName', med_pac_sexo = '$Sex', med_pac_dir = '$Adress', med_pac_zona = '$Zona', med_pac_dep = '$Region', med_pac_mun = '$Distri',med_pac_telcel = '$Tell', med_pac_telpar = '$Tell',med_pac_name_emer = '$FullNameEmer' ,med_pac_cel_emer = '$Cell' ,med_pac_email_emer = '$Email' WHERE id = $id";
        $val = 1;
        if (pg_query($tmfMed, $var_consulta)) {
            $arrInfo['status'] = $val;
        } else {
            $arrInfo['status'] = 0;
            $arrInfo['error'] = $var_consulta;
        }
        
       // print json_encode($arrInfo);
        //print_r($var_consulta.'<br><br>' );

        require_once "../../data/conexion/tmfAdm.php";
        $var_consulta = " UPDATE ctg_pacientes SET ctg_pac_dpi =' $DocPersonal_',ctg_pac_codigo = '$DocPersonal_',ctg_pac_nombres = '$Name', ctg_pac_apellidos = '$LastName', ctg_pac_sexo = '$Sex',ctg_pac_dir = '$Adress', ctg_pac_zona = '$Zona',ctg_pac_dep = '$Region',ctg_pac_mun = '$Distri',ctg_pac_telcel = '$Tell',ctg_pac_telpar = '$Tell', ctg_pac_email = '$Mail' ,ctg_pac_eme_nombre = '$FullNameEmer' ,ctg_pac_eme_tels = '$Cell' ,ctg_pac_eme_email = '$Email'WHERE id = $id";
        $val = 2;
        if (pg_query($rmfAdm, $var_consulta)) {
            $arrInfo['status'] = $val;
        } else {
            $arrInfo['status'] = 0;
            $arrInfo['error'] = $var_consulta;
        }
            //print_r($var_consulta );

        print json_encode($arrInfo);
        die();
    } else if ($strTipoValidacion == "delete") {
        header('Content-Type: application/json');
        $val = 1;
        $var_consulta = "DELETE FROM $tablaPacientes WHERE id = $id;";
        if (pg_query($tmfMed, $var_consulta)) {
            $arrInfo['status'] = $val;
        } else {
            $arrInfo['status'] = 0;
            $arrInfo['error'] = $var_consulta;
        }
        print json_encode($arrInfo);
        die();
    } else if ($strTipoValidacion == "val_dpi") {
        header('Content-Type: application/json');

        $Search = $_POST['Search'];

        $val = 1;
        if ($Search >= $val) {
            $var_consulta = pg_query($rmfAdm, "SELECT COUNT(ctg_pac_dpi) FROM ctg_pacientes WHERE ctg_pac_dpi = '$Search' LIMIT 1;");
            if ($row = pg_fetch_array($var_consulta)) {
                $idRow = trim($row[0]);
            }
        }
        $usuarioCode = isset($idRow) ? $idRow  : 0;

        if ($usuarioCode >= $val) {
            $arrInfo['status'] = $val;
        } else {
            $arrInfo['status'] = 0;
            //$arrInfo['error'] = $var_consulta;
        }
        // print_r($usuarioCode);
        print json_encode($arrInfo);

        die();
    } else if ($strTipoValidacion == "val_mail") {
        $email = $_POST['Search'];

        $val = 1;
        $var_consulta = pg_query($rmfAdm, "SELECT COUNT(sru_id) FROM sol_regis_user WHERE sru_email = '$email' AND sru_modulo = 'pac' LIMIT 1;");
        if ($row = pg_fetch_array($var_consulta)) {
            $idRow = trim($row[0]);
        }
        $usuarioCode = isset($idRow) ? $idRow  : 0;

        $var_consulta = pg_query($rmfAdm, "SELECT COUNT(adm_usr_id) FROM web_users WHERE mail = '$email' AND adm_usr_tipo = 'pac' LIMIT 1;");
        if ($row = pg_fetch_array($var_consulta)) {
            $idRow = trim($row[0]);
        }
        $usuario = isset($idRow) ? $idRow  : 0;

        if ($usuarioCode >= $val || $usuario >= $val) {
            $arrInfo['status'] = $val;
        } else {
            $arrInfo['status'] = 0;
            //$arrInfo['error'] = $var_consulta;
        }
        // print_r($var_consulta);
        print json_encode($arrInfo);

        die();
    } else if ($strTipoValidacion == "validacion_colegiado") {

        $intData = isset($_GET["colegiado_"]) ? intval($_GET["colegiado_"]) : "";

        $boolExiste = false;

        if ($intData) {

            $var_consulta = "SELECT * FROM ctg_medicos WHERE ctg_med_col  = '$intData'";
            if (pg_query($rmfAdm, $var_consulta)) {
                $boolExiste = true;
            } else {
                echo "Error: " . $var_consulta . "<br>";
            }
        }

        $strTextoFinal = $boolExiste ? "Y" : "N";
        print $strTextoFinal;
        die();
    } else if ($strTipoValidacion == "busqueda_patient_adm") {

        $strSearch = isset($_POST["Search"]) ? $_POST["Search"]  : '';

        require_once "../../data/conexion/tmfAdm.php";
        $strFilter = "";
        if (!empty($strSearch)) {
            $strFilter = " AND ( UPPER(ctg_pac_nombres) LIKE UPPER('%{$strSearch}%') OR UPPER(ctg_pac_apellidos) LIKE UPPER('%{$strSearch}%')) ";
        }
        $med = 1;
        $arrTablePatientGen = array();
        $var_consulta = "SELECT * 
                        FROM ctg_pacientes
                        WHERE ctg_pac_estatus = '1' 
                        $strFilter
                        ORDER BY ctg_pac_nombres LIMIT 1000";
        $sql = pg_query($rmfAdm, $var_consulta);
        $totalArticle = pg_num_rows($sql);
        //print_r($var_consulta);


        while ($rTMP = pg_fetch_assoc($sql)) {

            $arrTablePatientGen[$rTMP["id"]]["id"]                                         = $rTMP["id"];
            $arrTablePatientGen[$rTMP["id"]]["ctg_pac_dpi"]                                = $rTMP["ctg_pac_dpi"];
            $arrTablePatientGen[$rTMP["id"]]["ctg_pac_code"]                               = $rTMP["ctg_pac_code"];
            $arrTablePatientGen[$rTMP["id"]]["ctg_pac_codigo"]                             = $rTMP["ctg_pac_codigo"];
            $arrTablePatientGen[$rTMP["id"]]["ctg_pac_mem_id"]                             = $rTMP["ctg_pac_mem_id"];
            $arrTablePatientGen[$rTMP["id"]]["ctg_pac_nombres"]                            = $rTMP["ctg_pac_nombres"];
            $arrTablePatientGen[$rTMP["id"]]["ctg_pac_apellidos"]                          = $rTMP["ctg_pac_apellidos"];
            $arrTablePatientGen[$rTMP["id"]]["ctg_pac_sexo"]                               = $rTMP["ctg_pac_sexo"];
            $arrTablePatientGen[$rTMP["id"]]["ctg_pac_civil"]                              = $rTMP["ctg_pac_civil"];
            $arrTablePatientGen[$rTMP["id"]]["ctg_pac_nac_dia"]                            = $rTMP["ctg_pac_nac_dia"];
            $arrTablePatientGen[$rTMP["id"]]["ctg_pac_nac_mes"]                            = $rTMP["ctg_pac_nac_mes"];
            $arrTablePatientGen[$rTMP["id"]]["ctg_pac_nac_ano"]                            = $rTMP["ctg_pac_nac_ano"];
            $arrTablePatientGen[$rTMP["id"]]["ctg_pac_dir"]                                = $rTMP["ctg_pac_dir"];
            $arrTablePatientGen[$rTMP["id"]]["ctg_pac_zona"]                               = $rTMP["ctg_pac_zona"];
            $arrTablePatientGen[$rTMP["id"]]["ctg_pac_dep"]                                = $rTMP["ctg_pac_dep"];
            $arrTablePatientGen[$rTMP["id"]]["ctg_pac_mun"]                                = $rTMP["ctg_pac_mun"];
            $arrTablePatientGen[$rTMP["id"]]["ctg_pac_telcel"]                             = $rTMP["ctg_pac_telcel"];
            $arrTablePatientGen[$rTMP["id"]]["ctg_pac_telpar"]                             = $rTMP["ctg_pac_telpar"];
            $arrTablePatientGen[$rTMP["id"]]["ctg_pac_teltra"]                             = $rTMP["ctg_pac_teltra"];
            $arrTablePatientGen[$rTMP["id"]]["ctg_pac_email"]                              = $rTMP["ctg_pac_email"];
            $arrTablePatientGen[$rTMP["id"]]["ctg_pac_sol_dt"]                             = $rTMP["ctg_pac_sol_dt"];
            $arrTablePatientGen[$rTMP["id"]]["ctg_pac_aut_dt"]                             = $rTMP["ctg_pac_aut_dt"];
            $arrTablePatientGen[$rTMP["id"]]["ctg_pac_hab_dt"]                             = $rTMP["ctg_pac_hab_dt"];
            $arrTablePatientGen[$rTMP["id"]]["ctg_pac_ven_dt"]                             = $rTMP["ctg_pac_ven_dt"];
            $arrTablePatientGen[$rTMP["id"]]["ctg_pac_pass"]                               = $rTMP["ctg_pac_pass"];
            $arrTablePatientGen[$rTMP["id"]]["ctg_pac_username"]                           = $rTMP["ctg_pac_username"];
            $arrTablePatientGen[$rTMP["id"]]["ctg_pac_estatus"]                            = $rTMP["ctg_pac_estatus"];
            $arrTablePatientGen[$rTMP["id"]]["ctg_pac_eme_nombre"]                         = $rTMP["ctg_pac_eme_nombre"];
            $arrTablePatientGen[$rTMP["id"]]["ctg_pac_eme_tels"]                           = $rTMP["ctg_pac_eme_tels"];
            $arrTablePatientGen[$rTMP["id"]]["ctg_pac_eme_email"]                          = $rTMP["ctg_pac_eme_email"];
            $arrTablePatientGen[$rTMP["id"]]["ctg_pac_pcl_peso"]                           = $rTMP["ctg_pac_pcl_peso"];
            $arrTablePatientGen[$rTMP["id"]]["ctg_pac_pcl_esta"]                           = $rTMP["ctg_pac_pcl_esta"];
            $arrTablePatientGen[$rTMP["id"]]["ctg_pac_pcl_tpsa"]                           = $rTMP["ctg_pac_pcl_tpsa"];
            $arrTablePatientGen[$rTMP["id"]]["ctg_pac_pcl_aler"]                           = $rTMP["ctg_pac_pcl_aler"];
            $arrTablePatientGen[$rTMP["id"]]["ctg_pac_pcl_aler_desc"]                      = $rTMP["ctg_pac_pcl_aler_desc"];
            $arrTablePatientGen[$rTMP["id"]]["ctg_pac_pcl_enfe"]                           = $rTMP["ctg_pac_pcl_enfe"];
            $arrTablePatientGen[$rTMP["id"]]["ctg_pac_pcl_enfe_desc"]                      = $rTMP["ctg_pac_pcl_enfe_desc"];
            $arrTablePatientGen[$rTMP["id"]]["ctg_pac_pcl_medi"]                           = $rTMP["ctg_pac_pcl_medi"];
            $arrTablePatientGen[$rTMP["id"]]["ctg_pac_pcl_medi_desc"]                      = $rTMP["ctg_pac_pcl_medi_desc"];
            $arrTablePatientGen[$rTMP["id"]]["ctg_pac_pcl_hipe"]                           = $rTMP["ctg_pac_pcl_hipe"];
            $arrTablePatientGen[$rTMP["id"]]["ctg_pac_pcl_vih"]                            = $rTMP["ctg_pac_pcl_vih"];
            $arrTablePatientGen[$rTMP["id"]]["ctg_pac_pcl_park"]                           = $rTMP["ctg_pac_pcl_park"];
            $arrTablePatientGen[$rTMP["id"]]["ctg_pac_pcl_epoc"]                           = $rTMP["ctg_pac_pcl_epoc"];
            $arrTablePatientGen[$rTMP["id"]]["ctg_pac_pcl_tbc"]                            = $rTMP["ctg_pac_pcl_tbc"];
            $arrTablePatientGen[$rTMP["id"]]["ctg_pac_pcl_deme"]                           = $rTMP["ctg_pac_pcl_deme"];
            $arrTablePatientGen[$rTMP["id"]]["ctg_pac_pcl_diab"]                           = $rTMP["ctg_pac_pcl_diab"];
            $arrTablePatientGen[$rTMP["id"]]["ctg_pac_pcl_acv"]                            = $rTMP["ctg_pac_pcl_acv"];
            $arrTablePatientGen[$rTMP["id"]]["ctg_pac_pcl_enft"]                           = $rTMP["ctg_pac_pcl_enft"];
            $arrTablePatientGen[$rTMP["id"]]["ctg_pac_pcl_insr"]                           = $rTMP["ctg_pac_pcl_insr"];
            $arrTablePatientGen[$rTMP["id"]]["ctg_pac_pcl_iamicc"]                         = $rTMP["ctg_pac_pcl_iamicc"];
            $arrTablePatientGen[$rTMP["id"]]["ctg_pac_pcl_otra"]                           = $rTMP["ctg_pac_pcl_otra"];
            $arrTablePatientGen[$rTMP["id"]]["ctg_pac_pcl_otra_desc"]                      = $rTMP["ctg_pac_pcl_otra_desc"];
            $arrTablePatientGen[$rTMP["id"]]["ctg_pac_ant_morb"]                           = $rTMP["ctg_pac_ant_morb"];
            $arrTablePatientGen[$rTMP["id"]]["ctg_pac_ant_fami"]                           = $rTMP["ctg_pac_ant_fami"];
            $arrTablePatientGen[$rTMP["id"]]["ctg_pac_ant_gine"]                           = $rTMP["ctg_pac_ant_gine"];
            $arrTablePatientGen[$rTMP["id"]]["ctg_pac_ant_inmu"]                           = $rTMP["ctg_pac_ant_inmu"];
            $arrTablePatientGen[$rTMP["id"]]["ctg_pac_ant_habi"]                           = $rTMP["ctg_pac_ant_habi"];
            $arrTablePatientGen[$rTMP["id"]]["ctg_pac_ant_soci"]                           = $rTMP["ctg_pac_ant_soci"];
            $arrTablePatientGen[$rTMP["id"]]["ctg_pac_ant_oper"]                           = $rTMP["ctg_pac_ant_oper"];
            $arrTablePatientGen[$rTMP["id"]]["ctg_pac_ant_enfe"]                           = $rTMP["ctg_pac_ant_enfe"];
            $arrTablePatientGen[$rTMP["id"]]["ctg_pac_prf_far_code"]                       = $rTMP["ctg_pac_prf_far_code"];
            $arrTablePatientGen[$rTMP["id"]]["ctg_pac_prf_lab_code"]                       = $rTMP["ctg_pac_prf_lab_code"];
            $arrTablePatientGen[$rTMP["id"]]["ctg_pac_prf_hos_code"]                       = $rTMP["ctg_pac_prf_hos_code"];
            $arrTablePatientGen[$rTMP["id"]]["ctg_pac_medico_cabe_code"]                   = $rTMP["ctg_pac_medico_cabe_code"];
            $arrTablePatientGen[$rTMP["id"]]["ctg_pac_medico_code1"]                       = $rTMP["ctg_pac_medico_code1"];
            $arrTablePatientGen[$rTMP["id"]]["ctg_pac_medico_espe1"]                       = $rTMP["ctg_pac_medico_espe1"];
            $arrTablePatientGen[$rTMP["id"]]["ctg_pac_medico_code2"]                       = $rTMP["ctg_pac_medico_code2"];
            $arrTablePatientGen[$rTMP["id"]]["ctg_pac_medico_espe2"]                       = $rTMP["ctg_pac_medico_espe2"];
            $arrTablePatientGen[$rTMP["id"]]["ctg_pac_medico_code3"]                       = $rTMP["ctg_pac_medico_code3"];
            $arrTablePatientGen[$rTMP["id"]]["ctg_pac_medico_espe3"]                       = $rTMP["ctg_pac_medico_espe3"];
            $arrTablePatientGen[$rTMP["id"]]["ctg_pac_medico_code4"]                       = $rTMP["ctg_pac_medico_code4"];
            $arrTablePatientGen[$rTMP["id"]]["ctg_pac_medico_espe4"]                       = $rTMP["ctg_pac_medico_espe4"];
            $arrTablePatientGen[$rTMP["id"]]["ctg_pac_medico_code5"]                       = $rTMP["ctg_pac_medico_code5"];
            $arrTablePatientGen[$rTMP["id"]]["ctg_pac_medico_espe5"]                       = $rTMP["ctg_pac_medico_espe5"];
            $arrTablePatientGen[$rTMP["id"]]["ctg_pac_medico_code6"]                       = $rTMP["ctg_pac_medico_code6"];
            $arrTablePatientGen[$rTMP["id"]]["ctg_pac_medico_espe6"]                       = $rTMP["ctg_pac_medico_espe6"];
            $arrTablePatientGen[$rTMP["id"]]["ctg_pac_medico_code7"]                       = $rTMP["ctg_pac_medico_code7"];
            $arrTablePatientGen[$rTMP["id"]]["ctg_pac_medico_espe7"]                       = $rTMP["ctg_pac_medico_espe7"];
            $arrTablePatientGen[$rTMP["id"]]["ctg_pac_medico_code8"]                       = $rTMP["ctg_pac_medico_code8"];
            $arrTablePatientGen[$rTMP["id"]]["ctg_pac_medico_espe8"]                       = $rTMP["ctg_pac_medico_espe8"];
            $arrTablePatientGen[$rTMP["id"]]["ctg_pac_medico_code9"]                       = $rTMP["ctg_pac_medico_code9"];
            $arrTablePatientGen[$rTMP["id"]]["ctg_pac_medico_espe9"]                       = $rTMP["ctg_pac_medico_espe9"];
            $arrTablePatientGen[$rTMP["id"]]["ctg_pac_medica_code1"]                       = $rTMP["ctg_pac_medica_code1"];
            $arrTablePatientGen[$rTMP["id"]]["ctg_pac_medica_espe1"]                       = $rTMP["ctg_pac_medica_espe1"];
            $arrTablePatientGen[$rTMP["id"]]["ctg_pac_medica_cron1"]                       = $rTMP["ctg_pac_medica_cron1"];
            $arrTablePatientGen[$rTMP["id"]]["ctg_pac_medica_freq1"]                       = $rTMP["ctg_pac_medica_freq1"];
            $arrTablePatientGen[$rTMP["id"]]["ctg_pac_medica_code2"]                       = $rTMP["ctg_pac_medica_code2"];
            $arrTablePatientGen[$rTMP["id"]]["ctg_pac_medica_espe2"]                       = $rTMP["ctg_pac_medica_espe2"];
            $arrTablePatientGen[$rTMP["id"]]["ctg_pac_medica_cron2"]                       = $rTMP["ctg_pac_medica_cron2"];
            $arrTablePatientGen[$rTMP["id"]]["ctg_pac_medica_freq2"]                       = $rTMP["ctg_pac_medica_freq2"];
            $arrTablePatientGen[$rTMP["id"]]["ctg_pac_medica_code3"]                       = $rTMP["ctg_pac_medica_code3"];
            $arrTablePatientGen[$rTMP["id"]]["ctg_pac_medica_espe3"]                       = $rTMP["ctg_pac_medica_espe3"];
            $arrTablePatientGen[$rTMP["id"]]["ctg_pac_medica_cron3"]                       = $rTMP["ctg_pac_medica_cron3"];
            $arrTablePatientGen[$rTMP["id"]]["ctg_pac_medica_freq3"]                       = $rTMP["ctg_pac_medica_freq3"];
            $arrTablePatientGen[$rTMP["id"]]["ctg_pac_medica_code4"]                       = $rTMP["ctg_pac_medica_code4"];
            $arrTablePatientGen[$rTMP["id"]]["ctg_pac_medica_espe4"]                       = $rTMP["ctg_pac_medica_espe4"];
            $arrTablePatientGen[$rTMP["id"]]["ctg_pac_medica_cron4"]                       = $rTMP["ctg_pac_medica_cron4"];
            $arrTablePatientGen[$rTMP["id"]]["ctg_pac_medica_freq4"]                       = $rTMP["ctg_pac_medica_freq4"];
            $arrTablePatientGen[$rTMP["id"]]["ctg_pac_medica_code5"]                       = $rTMP["ctg_pac_medica_code5"];
            $arrTablePatientGen[$rTMP["id"]]["ctg_pac_medica_espe5"]                       = $rTMP["ctg_pac_medica_espe5"];
            $arrTablePatientGen[$rTMP["id"]]["ctg_pac_medica_cron5"]                       = $rTMP["ctg_pac_medica_cron5"];
            $arrTablePatientGen[$rTMP["id"]]["ctg_pac_medica_freq5"]                       = $rTMP["ctg_pac_medica_freq5"];
            $arrTablePatientGen[$rTMP["id"]]["ctg_pac_medica_code6"]                       = $rTMP["ctg_pac_medica_code6"];
            $arrTablePatientGen[$rTMP["id"]]["ctg_pac_medica_espe6"]                       = $rTMP["ctg_pac_medica_espe6"];
            $arrTablePatientGen[$rTMP["id"]]["ctg_pac_medica_cron6"]                       = $rTMP["ctg_pac_medica_cron6"];
            $arrTablePatientGen[$rTMP["id"]]["ctg_pac_medica_freq6"]                       = $rTMP["ctg_pac_medica_freq6"];
            $arrTablePatientGen[$rTMP["id"]]["ctg_pac_medica_code7"]                       = $rTMP["ctg_pac_medica_code7"];
            $arrTablePatientGen[$rTMP["id"]]["ctg_pac_medica_espe7"]                       = $rTMP["ctg_pac_medica_espe7"];
            $arrTablePatientGen[$rTMP["id"]]["ctg_pac_medica_cron7"]                       = $rTMP["ctg_pac_medica_cron7"];
            $arrTablePatientGen[$rTMP["id"]]["ctg_pac_medica_freq7"]                       = $rTMP["ctg_pac_medica_freq7"];
            $arrTablePatientGen[$rTMP["id"]]["ctg_pac_medica_code8"]                       = $rTMP["ctg_pac_medica_code8"];
            $arrTablePatientGen[$rTMP["id"]]["ctg_pac_medica_espe8"]                       = $rTMP["ctg_pac_medica_espe8"];
            $arrTablePatientGen[$rTMP["id"]]["ctg_pac_medica_cron8"]                       = $rTMP["ctg_pac_medica_cron8"];
            $arrTablePatientGen[$rTMP["id"]]["ctg_pac_medica_freq8"]                       = $rTMP["ctg_pac_medica_freq8"];
            $arrTablePatientGen[$rTMP["id"]]["ctg_pac_medica_code9"]                       = $rTMP["ctg_pac_medica_code9"];
            $arrTablePatientGen[$rTMP["id"]]["ctg_pac_medica_espe9"]                       = $rTMP["ctg_pac_medica_espe9"];
            $arrTablePatientGen[$rTMP["id"]]["ctg_pac_medica_cron9"]                       = $rTMP["ctg_pac_medica_cron9"];
            $arrTablePatientGen[$rTMP["id"]]["ctg_pac_medica_freq9"]                       = $rTMP["ctg_pac_medica_freq9"];
            $arrTablePatientGen[$rTMP["id"]]["ctg_pac_sta"]                                = $rTMP["ctg_pac_sta"];
            $arrTablePatientGen[$rTMP["id"]]["ctg_pac_dt"]                                 = $rTMP["ctg_pac_dt"];
            $arrTablePatientGen[$rTMP["id"]]["ctg_pac_usr"]                                = $rTMP["ctg_pac_usr"];
        }
        pg_free_result($sql);
?>
        <div class="col-md-12 tableFixHead">
            <table id="tablePac" class="table table-bordered table-striped table-hover table-sm">
                <thead>
                    <tr class="table-info">
                        <th>No. DPI</th>
                        <th>Nombres</th>
                        <th>Apellidos</th>
                    </tr>
                </thead>
                <tbody>

                    <?php
                    if (is_array($arrTablePatientGen) && (count($arrTablePatientGen) > 0)) {
                        $intContador = 1;
                        reset($arrTablePatientGen);
                        foreach ($arrTablePatientGen as $rTMP['key'] => $rTMP['value']) {


                    ?>
                            <tr data-dismiss="modal" style="cursor:pointer;" onclick="fntSelectPatientAdm('<?php print $intContador; ?>');">
                                <td><?php echo  $rTMP["value"]['ctg_pac_dpi']; ?></td>
                                <td><?php echo  $rTMP["value"]['ctg_pac_nombres']; ?></td>
                                <td><?php echo  $rTMP["value"]['ctg_pac_apellidos']; ?></td>
                            </tr>
                            <input type="hidden" name="hid_Id_<?php print $intContador; ?>" id="hid_Id_<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['id']; ?>">
                            <input type="hidden" name="hid_Codigo_<?php print $intContador; ?>" id="hid_Codigo_<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['ctg_pac_code']; ?>">
                            <input type="hidden" name="hid_Dpi_<?php print $intContador; ?>" id="hid_Dpi_<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['ctg_pac_dpi']; ?>">
                            <input type="hidden" name="hid_Name_<?php print $intContador; ?>" id="hid_Name_<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['ctg_pac_nombres']; ?>">
                            <input type="hidden" name="hid_LasName_<?php print $intContador; ?>" id="hid_LasName_<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['ctg_pac_apellidos']; ?>">
                            <input type="hidden" name="hid_Sex_<?php print $intContador; ?>" id="hid_Sex_<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['ctg_pac_sexo']; ?>">
                            <input type="hidden" name="hid_Zona_<?php print $intContador; ?>" id="hid_Zona_<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['ctg_pac_zona']; ?>">
                            <input type="hidden" name="hid_EmailPac_<?php print $intContador; ?>" id="hid_EmailPac_<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['ctg_pac_email']; ?>">

                            <input type="hidden" name="hid_Reg_<?php print $intContador; ?>" id="hid_Reg_<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['ctg_pac_dep']; ?>">
                            <input type="hidden" name="hid_Dis_<?php print $intContador; ?>" id="hid_Dis_<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['ctg_pac_mun']; ?>">
                            <input type="hidden" name="hid_Cell_<?php print $intContador; ?>" id="hid_Cell_<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['ctg_pac_telcel']; ?>">
                            <input type="hidden" name="hid_Adress_<?php print $intContador; ?>" id="hid_Adress_<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['ctg_pac_dir']; ?>">
                            <input type="hidden" name="hid_FullName_<?php print $intContador; ?>" id="hid_FullName_<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['ctg_pac_eme_nombre']; ?>">
                            <input type="hidden" name="hid_Tell_<?php print $intContador; ?>" id="hid_Tell_<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['ctg_pac_eme_tels']; ?>">
                            <input type="hidden" name="hid_Email_<?php print $intContador; ?>" id="hid_Email_<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['ctg_pac_eme_email']; ?>">
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
    } else if ($strTipoValidacion == "busqueda_patient") {
        require_once "../../data/conexion/tmlMed.php";
        $strSearch = isset($_POST["Search"]) ? $_POST["Search"]  : '';

        $strFilter = "";
        if (!empty($strSearch)) {
            $strFilter = " WHERE ( UPPER(med_pac_nom) LIKE UPPER('%{$strSearch}%' )) ";
        }
        $med = $_SESSION['adm_usr_code'];
        $tablaPacientes = "med" . $med . "pacientes";
        $arrTablePatient = array();
        $var_consulta = "SELECT * FROM $tablaPacientes $strFilter ORDER BY med_pac_nom ";
        $sql = pg_query($tmfMed, $var_consulta);
        $totalArticle = pg_num_rows($sql);
        // print_r($var_consulta);


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
            $arrTablePatient[$rTMP["id"]]["med_pac_name_emer"]               = $rTMP["med_pac_name_emer"];
            $arrTablePatient[$rTMP["id"]]["med_pac_cel_emer"]               = $rTMP["med_pac_cel_emer"];
            $arrTablePatient[$rTMP["id"]]["med_pac_email_emer"]               = $rTMP["med_pac_email_emer"];
        
        }
        pg_free_result($sql);

    ?>
        <div class="col-md-12 tableFixHead">
            <table id="tablePatient" class="table table-bordered table-striped table-hover table-sm">
                <thead>
                    <tr class="table-info">
                        <th>No. De Identificacion</th>
                        <th>Nombre</th>
                        <th>Fecha/Nac</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (is_array($arrTablePatient) && (count($arrTablePatient) > 0)) {
                        $intContador = 1;
                        reset($arrTablePatient);
                        foreach ($arrTablePatient as $rTMP['key'] => $rTMP['value']) {
                    ?>
                            <tr>
                                <td WIDTH="10%"><?php echo  $rTMP["value"]['med_pac_dpi']; ?></td>
                                <td WIDTH="40%"><?php echo  $rTMP["value"]['med_pac_nom']; ?> <?php echo  $rTMP["value"]['med_pac_ape']; ?></td>
                                <td WIDTH="10%"><?php echo  $rTMP["value"]['med_pac_nac_dia']; ?>/<?php echo  $rTMP["value"]['med_pac_nac_mes']; ?>/<?php echo  $rTMP["value"]['med_pac_nac_ano']; ?></td>
                                <td WIDTH="40%">
                                    <i title="ver " class="fad fa-2x fa-eye" style="cursor:pointer;" onclick="fntSelectView('<?php print $intContador; ?>');"></i>
                                    <i title="Eliminar " class="fad fa-2x fa-user-minus" style="cursor:pointer;" onclick="fntSelectDelete('<?php print $intContador; ?>');"></i>
                                    <i title="Editar " class="fad fa-2x fa-user-edit" style="cursor:pointer;" onclick="fntSelectEdit('<?php print $intContador; ?>');"></i>
                                    <a title="Perfil Clinico" href="../../app/doctors/doctorsPerfilClinical.php?cod=<?php echo encrypt($rTMP["value"]['med_pac_code'], $key); ?>"><i class="fad fa-2x fa-briefcase-medical"></i></a>
                                    <a title="Antecedentes " href="../../app/doctors/doctorsAntecedent.php?cod=<?php echo encrypt($rTMP["value"]['med_pac_code'], $key); ?>"><i class="fad fa-2x fa-users"></i></a>
                                    <a title="Asociados Preferidos " href="../../app/doctors/doctorsPreferredPartners.php?cod=<?php echo  encrypt($rTMP["value"]['med_pac_code'], $key); ?>"><i class="fad fa-2x fa-chalkboard-teacher"></i></a>
                                    <a title="Consultas " href="../../app/doctors/doctorsQuery.php"><i class="fad fa-2x fa-files-medical"></i></a>
                                    <a title="CItas" href="doctorsActiveAppointments.php?cod=<?php echo  encrypt($rTMP["value"]['med_pac_code'], $key); ?>"><i class="fad fa-2x fa-calendar-alt"></i></a>
                                    <a title="Medicamentos Suministrados Actualmente" href="doctorCurrentlySupplied.php?cod=<?php echo  encrypt($rTMP["value"]['med_pac_code'], $key); ?>"><i class="fad fa-2x fa-tablets"></i></a>
                                    <a title="Aseguradoras" href="doctorInsurers.php?cod=<?php echo  encrypt($rTMP["value"]['med_pac_code'], $key); ?>"><i class="fad fa-2x fa-briefcase"></i></a>
                                </td>
                                <input type="hidden" name="hidId_<?php print $intContador; ?>" id="hidId_<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['id']; ?>">
                                <input type="hidden" name="hidCodigo_<?php print $intContador; ?>" id="hidCodigo_<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['med_pac_code']; ?>">
                                <input type="hidden" name="hidDpi_<?php print $intContador; ?>" id="hidDpi_<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['med_pac_dpi']; ?>">
                                <input type="hidden" name="hidName_<?php print $intContador; ?>" id="hidName_<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['med_pac_nom']; ?>">
                                <input type="hidden" name="hidLastName_<?php print $intContador; ?>" id="hidLastName_<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['med_pac_ape']; ?>">
                                <input type="hidden" name="hidSex_<?php print $intContador; ?>" id="hidSex_<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['med_pac_sexo']; ?>">
                                <input type="hidden" name="hidReg_<?php print $intContador; ?>" id="hidReg_<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['med_pac_dep']; ?>">
                                <input type="hidden" name="hidDis_<?php print $intContador; ?>" id="hidDis_<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['med_pac_mun']; ?>">
                                <input type="hidden" name="hidCell_<?php print $intContador; ?>" id="hidCell_<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['med_pac_telcel']; ?>">
                                <input type="hidden" name="hidAdress_<?php print $intContador; ?>" id="hidAdress_<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['med_pac_dir']; ?>">
                                <input type="hidden" name="hidMail_<?php print $intContador; ?>" id="hidMail_<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['med_pac_email']; ?>">
                                <input type="hidden" name="hid_Zona_<?php print $intContador; ?>" id="hid_Zona_<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['med_pac_zona']; ?>">

                                <input type="hidden" name="hidDep_<?php print $intContador; ?>" id="hidDep_<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['med_pac_dep']; ?>">
                                <input type="hidden" name="hidMun_<?php print $intContador; ?>" id="hidMun_<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['med_pac_mun']; ?>">
                                
                                <input type="hidden" name="hidEmerName_<?php print $intContador; ?>" id="hidEmerName_<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['med_pac_name_emer']; ?>">
                                <input type="hidden" name="hidEmerCell_<?php print $intContador; ?>" id="hidEmerCell_<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['med_pac_cel_emer']; ?>">
                                <input type="hidden" name="hidEmerEmail_<?php print $intContador; ?>" id="hidEmerEmail_<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['med_pac_email_emer']; ?>">
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

    die();
}
?>
<?php

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
?>
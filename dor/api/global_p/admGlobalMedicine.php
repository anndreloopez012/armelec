<?php

//error_reporting(E_ALL);
//ini_set('display_errors', 1);
require_once "../../api/globalFunctions.php";
// VALIDATION INSERT UPDATE DELETE
if (isset($_GET["validaciones"]) && !empty($_GET["validaciones"])) {
    require_once "../../data/conexion/tmlMed.php";

    $idUser = $_SESSION['adm_usr_id'];
    $id =  $_SESSION['adm_usr_code'];
    //$tablaConsultas = "med" . $id . "consultas";
    $year = date("Y");


    //$rs = pg_query($tmfMed, "SELECT med_con_id FROM $tablaConsultas ORDER BY med_con_id DESC LIMIT 1");
    //if ($row = pg_fetch_array($rs)) {
     //   $idRow = trim($row[0]);
   // }
    //id para insert de tabla medicos
   // $med_con_id_ = $idRow + 1;
    //id para insert de tabla pacientes y farmaceuticas
   // $med_con_id = $idRow;

    $med_con_pac_id = isset($_POST["id"]) ? $_POST["id"]  : '';

    $idPacienteVacuna = isset($_POST["idPacienteVacuna"]) ? $_POST["idPacienteVacuna"]  : '';
    $idPacientebHospital = isset($_POST["idPacientebHospital"]) ? $_POST["idPacientebHospital"]  : '';
    $idPacientecLaboratorio = isset($_POST["idPacientecLaboratorio"]) ? $_POST["idPacientecLaboratorio"]  : '';
    $idPacientedFarmacia = isset($_POST["idPacientedFarmacia"]) ? $_POST["idPacientedFarmacia"]  : '';

    $nombrePacienteVacuna = isset($_POST["nombrePacienteVacuna"]) ? $_POST["nombrePacienteVacuna"]  : '';
    $nombrePacientebHospital = isset($_POST["nombrePacientebHospital"]) ? $_POST["nombrePacientebHospital"]  : '';
    $nombrePacientecLaboratorio = isset($_POST["nombrePacientecLaboratorio"]) ? $_POST["nombrePacientecLaboratorio"]  : '';
    $nombrePacientedFarmacia = isset($_POST["nombrePacientedFarmacia"]) ? $_POST["nombrePacientedFarmacia"]  : '';

    $med_con_cita_dt = isset($_POST["fecha"]) ? $_POST["fecha"]  : '';
    $med_con_motivo = isset($_POST["motivo"]) ? $_POST["motivo"]  : '';
    $med_con_examen = isset($_POST["examen"]) ? $_POST["examen"]  : '';
    $med_con_receta = isset($_POST["receta"]) ? $_POST["receta"]  : '';
    $med_con_dieta = isset($_POST["dieta"]) ? $_POST["dieta"]  : '';
    $med_con_observa = isset($_POST["colegiado"]) ? $_POST["colegiado"]  : '';
    $proxima_cita = isset($_POST["proxima_cita"]) ? $_POST["proxima_cita"]  : '';

    $sanitaria = isset($_POST["sanitaria"]) ? $_POST["sanitaria"]  : '';

    $correo = isset($_POST["correo"]) ? $_POST["correo"]  : '';

    $stat = 1;
    $fechaIng = date("Y-m-d");
    $usuario = $_SESSION['adm_usr_code'];

    $strTipoValidacion = isset($_REQUEST["validaciones"]) ? $_REQUEST["validaciones"] : '';

    $strSearch = isset($_POST["Search"]) ? $_POST["Search"]  : '';
    if ($strTipoValidacion == "insert") {
        header('Content-Type: application/json');
        $var_consulta = "INSERT INTO $tablaConsultas(med_con_id,med_con_pac_id,med_con_cita_dt,med_con_motivo,med_con_examen,med_con_receta,med_con_dieta,med_con_sta,med_con_dt,med_con_usr) VALUES ($med_con_id_,'$med_con_pac_id','$fechaIng','$med_con_motivo','$med_con_examen','$med_con_receta','$med_con_dieta','$stat','$fechaIng','$usuario');";
        $val = 1;
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

    if ($strTipoValidacion == "insert_consulta_paciente") {
        require_once "../../data/conexion/tmfPac.php";
        $medicosConsultasPac = "a" . $year . "_medicos_consultas";
        header('Content-Type: application/json');

        $var_consulta = "INSERT INTO $medicosConsultasPac(med_con_id,med_con_med_id,med_con_pac_id,med_con_cita_dt,med_con_motivo,med_con_examen,med_con_receta,med_con_dieta,med_con_sta,med_con_dt,med_con_usr) VALUES ($med_con_id,'$usuario','$med_con_pac_id','$fechaIng','$med_con_motivo','$med_con_examen','$med_con_receta','$med_con_dieta','$stat','$fechaIng','$usuario');";

        $val = 1;
        if ($val){
            unset($_SESSION['CARRITOLAB']);
            unset($_SESSION['CARRITOHOSP']);
            unset($_SESSION['CARRITOMED']);
            unset($_SESSION['CARRITOVAC']);        
        }
        if (pg_query($tmfPac, $var_consulta)) {
            $arrInfo['status'] = $val;
        } else {
            $arrInfo['status'] = 0;
            $arrInfo['error'] = $var_consulta;
        }
        //print_r($var_consulta);
        print json_encode($arrInfo);
                            unset($_SESSION['CARRITOLAB']);
                             unset($_SESSION['CARRITOHOSP']);
                             unset($_SESSION['CARRITOMED']);
                             unset($_SESSION['CARRITOVAC']);
                           
        die();
    }

    if ($strTipoValidacion == "insert_cita_paciente") {
        require_once "../../data/conexion/tmfPac.php";
        $medicosConsultasCitas = "a" . $year . "_citas";

        header('Content-Type: application/json');
        $ctg_cit_estatus = 0;
        $var_consulta = "INSERT INTO $medicosConsultasCitas(ctg_cit_id,ctg_cit_cita_dt,ctg_cit_med_id,ctg_cit_pac_id,ctg_cit_motivo,ctg_cit_estatus,ctg_cit_sta,ctg_cit_dt,ctg_cit_usr) VALUES ($med_con_id,'$proxima_cita','$usuario','$med_con_pac_id','$med_con_motivo','$ctg_cit_estatus','$stat','$fechaIng','$usuario');";

        $val = 1;
        if (pg_query($tmfPac, $var_consulta)) {
            $arrInfo['status'] = $val;
        } else {
            $arrInfo['status'] = 0;
            $arrInfo['error'] = $var_consulta;
        }
        print_r($var_consulta);
        print json_encode($arrInfo);
        die();
    }
    //////////////////// INSERT SESIONES MEDICOS 
    if ($strTipoValidacion == "med_insert_med") {
        header('Content-Type: application/json');

        $tablaConsultasMed = "med" . $id . "consultas_productos";
        $rs = pg_query("SELECT id FROM $tablaConsultasMed ORDER BY id DESC LIMIT 1");
        if ($row = pg_fetch_array($rs)) {
            $idRow = trim($row[0]);
        }
        $idMaxMed = $idRow + 1;

        if (isset($_SESSION['CARRITOMED'])) {
            reset($_SESSION['CARRITOMED']);
            foreach ($_SESSION['CARRITOMED'] as $indice => $producto) {

                $var_consulta = "INSERT INTO $tablaConsultasMed(med_cop_id,med_cop_far_id,med_cop_pro_id,med_cop_pre,med_cop_can,med_cop_desf,med_cop_desl,med_cop_valor,med_cop_sta,med_cop_dt,med_cop_usr) VALUES ($med_con_id,'" . $producto["CTG_FAR_CODE"] . "','" . $producto["CTG_FAP_CONTRATO"] . "','" . $producto["CTG_FAP_PRE"] . "','" . $producto["CANTIDAD"] . "',NULL,NULL,NULL,'$stat','$fechaIng','$usuario');";
                $val = 1;
                if (pg_query($tmfMed, $var_consulta)) {
                    $arrInfo['status'] = $val;
                } else {
                    $arrInfo['status'] = 0;
                    $arrInfo['error'] = $var_consulta;
                }
                print_r($var_consulta);
                print json_encode($arrInfo);
               // unset($_SESSION['CARRITOMED']);
            }
        }

        die();
    }
    if ($strTipoValidacion == "med_insert_vac") {
        header('Content-Type: application/json');

        $tablaConsultasVacc = "med" . $id . "consultas_vacunas";
        $rs = pg_query("SELECT id FROM $tablaConsultasVacc ORDER BY id DESC LIMIT 1");
        if ($row = pg_fetch_array($rs)) {
            $idRow = trim($row[0]);
        }
        $idMaxMed = $idRow + 1;

        if (isset($_SESSION['CARRITOVAC'])) {
            reset($_SESSION['CARRITOVAC']);
            foreach ($_SESSION['CARRITOVAC'] as $indice => $producto) {

                $var_consulta = "INSERT INTO $tablaConsultasVacc(med_cov_id,med_cov_vac_id,med_cov_dosis,med_cov_obs,med_cov_sta,med_cov_dt,med_cov_usr,med_cov_pre) VALUES ($med_con_id,'" . $producto["MED_VAC_ID"] . "','" . $producto["CANTIDAD"] . "',NULL,'$stat','$fechaIng','$usuario','" . $producto["MED_VAC_PRECIO"] . "');";
                $val = 1;
                if (pg_query($tmfMed, $var_consulta)) {
                    $arrInfo['status'] = $val;
                } else {
                    $arrInfo['status'] = 0;
                    $arrInfo['error'] = $var_consulta;
                }
                print_r($var_consulta);
                print json_encode($arrInfo);
                //unset($_SESSION['CARRITOVAC']);
            }
        }
        die();
    }
    if ($strTipoValidacion == "med_insert_lab") {
        header('Content-Type: application/json');

        $tablaConsultasExa = "med" . $id . "consultas_examenes";
        $rs = pg_query("SELECT id FROM $tablaConsultasExa ORDER BY id DESC LIMIT 1");
        if ($row = pg_fetch_array($rs)) {
            $idRow = trim($row[0]);
        }
        $idMaxMed = $idRow + 1;

        if (isset($_SESSION['CARRITOLAB'])) {
            reset($_SESSION['CARRITOLAB']);
            foreach ($_SESSION['CARRITOLAB'] as $indice => $producto) {

                $var_consulta = "INSERT INTO $tablaConsultasExa(med_coe_id,med_coe_lab_id,med_coe_lax_id,med_coe_pre,med_coe_can,med_coe_desl,med_coe_valor,med_coe_sta,med_coe_dt,med_coe_usr) VALUES ($med_con_id,'" . $producto["CTG_LAB_CODE"] . "','" . $producto["CTG_LCE_CODE"] . "','" . $producto["CTG_LCE_PRE"] . "','" . $producto["CANTIDAD"] . "',NULL,NULL,'$stat','$fechaIng','$usuario');";
                $val = 1;
                if (pg_query($tmfMed, $var_consulta)) {
                    $arrInfo['status'] = $val;
                } else {
                    $arrInfo['status'] = 0;
                    $arrInfo['error'] = $var_consulta;
                }
                print_r($var_consulta);
                print json_encode($arrInfo);
               // unset($_SESSION['CARRITOLAB']);
            }
        }
        die();
    }
    if ($strTipoValidacion == "med_insert_hosp") {
        header('Content-Type: application/json');

        $tablaConsultasHosp = "med" . $id . "consultas_hospitales";
        $rs = pg_query("SELECT med_id FROM $tablaConsultasHosp ORDER BY med_id DESC LIMIT 1");
        if ($row = pg_fetch_array($rs)) {
            $idRow = trim($row[0]);
        }
        $idMaxMed = $idRow + 1;

        if (isset($_SESSION['CARRITOHOSP'])) {
            reset($_SESSION['CARRITOHOSP']);
            foreach ($_SESSION['CARRITOHOSP'] as $indice => $producto) {
                $med_coh_desl = 0;
                $med_coh_valor =  $producto["CTG_HPP_PRE"] * $producto["CANTIDAD"];


                $var_consulta = "INSERT INTO $tablaConsultasHosp(med_coh_id,med_coh_hos_id,med_coh_ser_id,med_coh_pre,med_coh_can,med_coh_desl,med_coh_valor,med_coh_sta,med_coh_dt,med_coh_usr) VALUES ($med_con_id,'" . $producto["CTG_HOS_CODE"] . "','" . $producto["CTG_HPP_CODE"] . "','" . $producto["CTG_HPP_PRE"] . "','" . $producto["CANTIDAD"] . "', '$med_coh_desl','$med_coh_valor','$stat','$fechaIng','$usuario');";
                $val = 1;
                if (pg_query($tmfMed, $var_consulta)) {
                    $arrInfo['status'] = $val;
                } else {
                    $arrInfo['status'] = 0;
                    $arrInfo['error'] = $var_consulta;
                }
                print_r($var_consulta);
                print json_encode($arrInfo);
               // unset($_SESSION['CARRITOHOSP']);
            }
        }
        die();
    }
    ///////////////////// INSERT SESSIONES PACIENTES////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    if ($strTipoValidacion == "pac_insert_med") {
        require_once "../../data/conexion/tmfPac.php";
        header('Content-Type: application/json');

        $medicosConsultasProductosPac = "a" . $year . "_medicos_consultas_productos";

        //ordernes
        //oden_itens


        if (isset($_SESSION['CARRITOMED'])) {
            reset($_SESSION['CARRITOMED']);
            foreach ($_SESSION['CARRITOMED'] as $indice => $producto) {
                $idPac = $idPacientedFarmacia;

                $var_consulta = "INSERT INTO $medicosConsultasProductosPac(med_cop_id,med_cop_med_id,med_cop_pac_id,med_cop_far_id,med_cop_pro_id,med_cop_pre,med_cop_can,med_cop_desf,med_cop_desl,med_cop_valor,med_cop_sta,med_cop_dt,med_cop_usr) VALUES ($med_con_id,'$idUser','$idPac','" . $producto["CTG_FAR_CODE"] . "','" . $producto["CTG_FAP_CONTRATO"] . "','" . $producto["CTG_FAP_PRE"] . "','" . $producto["CANTIDAD"] . "',NULL,NULL,NULL,'$stat','$fechaIng','$usuario');";
                $val = 1;
                if (pg_query($tmfPac, $var_consulta)) {
                    $arrInfo['status'] = $val;
                } else {
                    $arrInfo['status'] = 0;
                    $arrInfo['error'] = $var_consulta;
                }
                print_r($var_consulta);
                print json_encode($arrInfo);
                //unset($_SESSION['CARRITOMED']);

                if ($idPac) {

                    $to = "andrelopez012@hotmail.com";
                    $Modulo = "Medicamento";
                    $Orden = $med_con_id;
                    $titulo = "Orden de medicamentos";
                    $lugar = '" . $producto["CTG_FAR_NOMCOM"] . "';

                    require_once "../../mail.php";
                }
            }
        }

        die();
    }
    if ($strTipoValidacion == "pac_insert_vac") {
        require_once "../../data/conexion/tmfPac.php";
        header('Content-Type: application/json');

        if (isset($_SESSION['CARRITOVAC'])) {
            reset($_SESSION['CARRITOVAC']);
            foreach ($_SESSION['CARRITOVAC'] as $indice => $producto) {

                //INSERT ITEMS DE ORDEN
                $medicosVacunasPac = "a" . $year . "_medicos_consultas_vacunas";

                $pacId = $idPacienteVacuna;

                $var_consulta = "INSERT INTO $medicosVacunasPac(med_cov_id,med_cov_med_id,med_cov_pac_id,med_cov_vac_id,med_cov_mat,med_cov_dosis,med_cov_obs,med_cov_sta,med_cov_dt,med_cov_usr) VALUES ($med_con_id,'$idUser','$pacId','" . $producto["MED_VAC_ID"] . "',NULL,NULL,NULL,'$stat','$fechaIng','$usuario');";
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
        header('Content-Type: application/json');

        $labclinicos_orden_ = "a" . $year . "_labclinicos_orden";
        $labclinicos_orden_items_ = "a" . $year . "_labclinicos_orden_items";

        $namePac = $nombrePacientecLaboratorio;
        $idPac = $idPacientecLaboratorio;

        if (isset($_SESSION['CARRITOLAB'])) {
            reset($_SESSION['CARRITOLAB']);
            foreach ($_SESSION['CARRITOLAB'] as $indice => $producto) {

                $rsClinica = pg_query($tmfPac, "SELECT COUNT(*) FROM $labclinicos_orden_ WHERE lab_ord_cod = $med_con_id LIMIT 1");
                if ($row = pg_fetch_array($rsClinica)) {
                    $idRowExa = trim($row[0]);
                }
                print_r($rsClinica);

                $OrdenClinica = isset($idRowExa) ? $idRowExa : 0;

                if ($OrdenClinica == 0) {
                    $TOTAL = isset($_POST["TOTAL"]) ? $_POST["TOTAL"]  : ''; //valor total de la orden
                    $lab_ord_por_lab = 0; //Porcentaje de descuento del laboratorio clinico
                    $lab_ord_valor_desl = 0; //valor descuento laboratorio
                    $lab_ord_valor_iva = ($TOTAL / 1.12) * 0.12;  //valor iva
                    $lab_ord_est = 1;
                    $statOrder = 1;

                    $var_consulta = "INSERT INTO $labclinicos_orden_(lab_ord_cod,lab_ord_tipo,lab_ord_pac_id,lab_ord_med_id,lab_ord_fec,lab_ord_pac_nombre,lab_ord_pac_mem_id,lab_ord_por_lab,lab_ord_valor,lab_ord_valor_desl,lab_ord_valor_iva,lab_ord_total,lab_ord_est,lab_ord_sta,lab_ord_dt,lab_ord_usr) VALUES ($med_con_id,'1','$idPac','$idUser','$fechaIng','$namePac','$idPac','$lab_ord_por_lab','$TOTAL','$lab_ord_valor_desl','$lab_ord_valor_iva','$TOTAL','$lab_ord_est','$stat','$fechaIng','$usuario');";
                    $val = 2;
                    if (pg_query($tmfPac, $var_consulta)) {
                        $arrInfo['status'] = $val;
                    } else {
                        $arrInfo['status'] = 0;
                        $arrInfo['error'] = $var_consulta;
                    }
                    print_r($var_consulta);
                    print json_encode($arrInfo);

                    if ($idPac) {

                        $to = "andrelopez012@hotmail.com";
                        $Modulo = "Laboratorio";
                        $Orden = $med_con_id;
                        $titulo = "Orden de laboratorio";
                        $lugar = '" . $producto["CTG_LAB_NOMCOM"] . "';

                        require_once "../../mail.php";
                    }
                }
                if ($idPac) {

                    $var_consulta = "INSERT INTO $labclinicos_orden_items_(lab_ori_cod,lab_ori_tipo,lab_ori_pac_id,lab_ori_med_id,lab_ori_gpo_id,lab_ori_exa_id,lab_ori_pre,lab_ori_can,lab_ori_desl,lab_ori_valor,lab_ori_exa_dt,lab_ori_exa_ranmin,lab_ori_exa_ranmax,lab_ori_exa_res,lab_ori_sta,lab_ori_dt,lab_ori_usr)VALUES ($med_con_id,'1','$idPac','$idUser','" . $producto["CTG_LAB_CODE"] . "','" . $producto["CTG_LCE_CODE"] . "','" . $producto["CTG_LCE_PRE"] . "','" . $producto["CANTIDAD"] . "',NULL,NULL,'$fechaIng',NULL,NULL,NULL,'$stat','$fechaIng','$usuario');";
                    $val = 1;
                    if (pg_query($tmfPac, $var_consulta)) {
                        $arrInfo['status'] = $val;
                    } else {
                        $arrInfo['status'] = 0;
                        $arrInfo['error'] = $var_consulta;
                    }
                    print_r($var_consulta);
                    print json_encode($arrInfo);
                    //unset($_SESSION['CARRITOLAB']);
                }
            }
        }
        die();
    }
    if ($strTipoValidacion == "pac_insert_hosp") {
        require_once "../../data/conexion/tmfPac.php";
        header('Content-Type: application/json');

        $hospitales_orden_ = "a" . $year . "_hospitales_orden";
        $hospitales_orden_items_ = "a" . $year . "_hospitales_orden_items";

        $namePac = $nombrePacientebHospital;
        $idPac = $idPacientebHospital;

        if (isset($_SESSION['CARRITOHOSP'])) {
            reset($_SESSION['CARRITOHOSP']);
            foreach ($_SESSION['CARRITOHOSP'] as $indice => $producto) {

                $rsHosp = pg_query($tmfPac, "SELECT COUNT(*) FROM $hospitales_orden_ WHERE hos_ord_cod = $med_con_id LIMIT 1");
                if ($row = pg_fetch_array($rsHosp)) {
                    $idRowHosp = trim($row[0]);
                }
                //print_r($rsHosp);

                $OrdenHosp = isset($idRowHosp) ? $idRowHosp : 0;
                $hos_ord_por_lab = '0';
                $hos_ord_valor_desh = '0';
                $hos_ord_est = '1';

                if ($OrdenHosp == 0) {
                    $TOTAL = isset($_POST["TOTAL"]) ? $_POST["TOTAL"]  : 0; //valor total de la orden
                    $hos_ord_valor_iva = ($TOTAL / 1.12) * 0.12;  //valor iva 
                    $hos_ord_total = $TOTAL;
                    $statOrder = 1;
                    $var_consulta = "INSERT INTO $hospitales_orden_(hos_ord_cod,hos_ord_hos_id,hos_ord_pac_id,hos_ord_tipo,hos_ord_med_id,hos_ord_fec,hos_ord_pac_nombre,hos_ord_por_lab,hos_ord_valor,hos_ord_valor_desh,hos_ord_valor_iva,hos_ord_total,hos_ord_est,hos_ord_sta,hos_ord_dt,hos_ord_usr) VALUES ($med_con_id,'" . $producto["CTG_HOS_CODE"] . "','$namePac','1','$idUser','$fechaIng','$namePac','$hos_ord_por_lab','$TOTAL','$hos_ord_valor_desh','$hos_ord_valor_iva','$hos_ord_total','$hos_ord_est','$stat','$fechaIng','$usuario');";
                    $val = 2;
                    if (pg_query($tmfPac, $var_consulta)) {
                        $arrInfo['status'] = $val;
                    } else {
                        $arrInfo['status'] = 0;
                        $arrInfo['error'] = $var_consulta;
                    }
                    print_r($var_consulta);
                    print json_encode($arrInfo);

                    if ($idPac) {

                        $to = "andrelopez012@hotmail.com";
                        $Modulo = "Hospital";
                        $Orden = $med_con_id;
                        $titulo = "Orden de Hospital";
                        $lugar = '" . $producto["CTG_HOS_NOMCOM"] . "';

                        require_once "../../mail.php";
                    }
                }
                if ($idPac) {
                    $lab_ori_gpo_id = $producto["CTG_HOS_CODE"];
                    $hos_ori_desh = 0;
                    $hos_ori_valor = $producto["CTG_HPP_PRE"] * $producto["CANTIDAD"];

                    $var_consulta = "INSERT INTO  $hospitales_orden_items_(hos_ori_cod,hos_ori_tipo,hos_ori_hos_id,hos_ori_pac_id,hos_ori_med_id,hos_ori_gpo_id,hos_ori_ser_id,hos_ori_pre,hos_ori_can,hos_ori_desh,hos_ori_valor,hos_ori_sta,hos_ori_dt,hos_ori_usr)VALUES ($med_con_id,'1','" . $producto["CTG_HOS_CODE"] . "','$idPac','$idUser',' $lab_ori_gpo_id','" . $producto["CTG_HPP_CODE"] . "','" . $producto["CTG_HPP_PRE"] . "','" . $producto["CANTIDAD"] . "','$hos_ori_desh','$hos_ori_valor','$stat','$fechaIng','$usuario');";
                    $val = 1;
                    if (pg_query($tmfPac, $var_consulta)) {
                        $arrInfo['status'] = $val;
                    } else {
                        $arrInfo['status'] = 0;
                        $arrInfo['error'] = $var_consulta;
                    }
                    print_r($var_consulta);
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
        header('Content-Type: application/json');

        if (isset($_SESSION['CARRITOMED'])) {
            reset($_SESSION['CARRITOMED']);
            foreach ($_SESSION['CARRITOMED'] as $indice => $producto) {
                $idFar = $producto["CTG_FAR_CODE"];
                $far_orden = "far" . $idFar . "orden";
                $far_orden_prod = "far" . $idFar . "orden_prod";
                $far_prod = "far" . $idFar . "prod";

                $namePac = $nombrePacientedFarmacia;
                $idPac = $idPacientedFarmacia;


                $rsFarOrden = pg_query($tmfFar, "SELECT COUNT(*) FROM $far_orden WHERE far_ord_cod = $med_con_id LIMIT 1");
                if ($row = pg_fetch_array($rsFarOrden)) {
                    $idRowFar = trim($row[0]);
                }
                $OrdenFar = isset($idRowFar) ? $idRowFar : 0;

                $hos_ord_por_lab = '0';
                $hos_ord_valor_desh = '0';
                $hos_ord_est = '1';
                $TOTAL = isset($_POST["CTG_TOTAL"]) ? $_POST["CTG_TOTAL"]  : ''; //valor total de la orden

                if ($OrdenFar == 0) {

                    $far_ord_valor_iva = ($TOTAL / 1.12) * 0.12;  //valor iva 
                    $statOrder = 1;
                    $far_ord_por_fac = 0;
                    $far_ord_por_laf = 0;
                    $far_ord_valor_desf = 0;
                    $far_ord_valor_desl = 0;

                    $var_consulta = "INSERT INTO $far_orden(far_ord_cod,far_ord_tipo,far_ord_fec,far_ord_med_id,far_ord_pac_id,far_ord_pac_nombre,far_ord_pac_mem_id,far_ord_por_fac,far_ord_por_laf,far_ord_valor,far_ord_valor_desf,far_ord_valor_desl,far_ord_valor_iva,far_ord_total,far_ord_est,far_ord_sta,far_ord_dt,far_ord_usr) VALUES ($med_con_id,'1','$fechaIng','$idUser','$idPac','$namePac','$idPac' ,'$far_ord_por_fac','$far_ord_por_laf',$TOTAL,'$far_ord_valor_desf','$far_ord_valor_desl','$far_ord_valor_iva','$TOTAL','$statOrder','$stat','$fechaIng','$usuario');";
                    $val = 1;
                    if (pg_query($tmfFar, $var_consulta)) {
                        $arrInfo['status'] = $val;
                    } else {
                        $arrInfo['status'] = 0;
                        $arrInfo['error'] = $var_consulta;
                    }
                   //echo '<pre>';
                    print_r($var_consulta);
                    //echo  '</pre>';

                    print json_encode($arrInfo);


                    $rsFarOrdenProd = pg_query($tmfFar, "SELECT COUNT(*) FROM $far_orden_prod WHERE far_orp_cod = $med_con_id LIMIT 1");
                    if ($row = pg_fetch_array($rsFarOrdenProd)) {
                        $idRowFarOrdenProd = trim($row[0]);
                    }
                    $OrdenFarPro = isset($idRowFarOrdenProd) ? $idRowFarOrdenProd : 0;

                    $rsFar = pg_query($tmfFar, "SELECT COUNT(*) FROM $far_orden_prod WHERE far_orp_pro_id = '" . $producto["CTG_FAP_PRO"] . "' LIMIT 1");
                    if ($row = pg_fetch_array($rsFar)) {
                        $idRowFarPro = trim($row[0]);
                    }
                    $ProFar = isset($idRowFarPro) ? $idRowFarPro : 0;

                    echo '<pre> OrdenFarPro';
                    print_r($OrdenFarPro);
                    echo  '</pre>';
                    echo '<pre>';
                    print_r($ProFar);
                    echo  '</pre> ProFar';

                    if (($OrdenFarPro == 0 && $ProFar == 0) || ($OrdenFarPro >= 1 && $ProFar == 0)) {
                        $far_orp_desf = $TOTAL;
                        $far_orp_desl = 0;
                        $far_orp_valor = 0;

                        $var_consulta = "INSERT INTO  $far_orden_prod(far_orp_cod,far_orp_pro_id,far_orp_pre,far_orp_can,far_orp_desf,far_orp_desl,far_orp_valor,far_orp_sta,far_orp_dt,far_orp_usr)VALUES ($med_con_id,'" . $producto["CTG_FAP_PRO"] . "','" . $producto["CTG_FAP_PRE"] . "','" . $producto["CANTIDAD"] . "',$far_orp_desf,'$far_orp_desl',' $far_orp_valor','$stat','$fechaIng','$usuario');";
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

                        if ($val) {

                            $to = "andrelopez012@hotmail.com";
                            $Modulo = "Farmacia -";
                            $Orden = $med_con_id;
                            $titulo = "Orden de Farmacia";
                            $lugar = '" . $producto["CTG_FAR_NOMCOM"] . "';
    
                            require_once "../../mail.php";
                        }

                        $rsFarContador = pg_query($tmfFar, "SELECT COUNT(*) FROM $far_prod WHERE far_pro_cod = '" . $producto["CTG_FAP_PRO"] . "' LIMIT 1");
                        if ($row = pg_fetch_array($rsFarContador)) {
                            $idRowFarContador = trim($row[0]);
                        }
                        $ProFarContador = isset($idRowFarContador) ? $idRowFarContador : 0;

                        if ($ProFarContador == 0) {

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


                $rsLabOrden = pg_query($tmfLab, "SELECT COUNT(*) FROM $lab_orden WHERE lab_ord_cod = $med_con_id LIMIT 1");
                if ($row = pg_fetch_array($rsLabOrden)) {
                    $idRowLab = trim($row[0]);
                }
                $OrdenLab = isset($idRowLab) ? $idRowLab : 0;

                $hos_ord_por_lab = '0';
                $hos_ord_valor_desh = '0';
                $hos_ord_est = '1';
                $TOTAL = isset($_POST["TOTAL"]) ? $_POST["TOTAL"]  : ''; //valor total de la orden

                if ($OrdenLab == 0) {

                    $lab_ord_valor_iva = ($TOTAL / 1.12) * 0.12;  //valor iva 
                    $statOrder = 1;
                    $lab_ord_por_lab = 0;
                    $lab_ord_valor = 0;
                    $far_ord_valor_desf = 0;
                    $lab_ord_valor_desl = 0;

                    $var_consulta = "INSERT INTO $lab_orden(lab_ord_cod,lab_ord_tipo,lab_ord_fec,lab_ord_med_id,lab_ord_pac_id,lab_ord_pac_nombre,lab_ord_pac_mem_id,lab_ord_por_lab,lab_ord_valor,lab_ord_valor_desl,lab_ord_valor_iva,lab_ord_total,lab_ord_est,lab_ord_sta,lab_ord_dt,lab_ord_usr) 
                                    VALUES ($med_con_id,'1','$fechaIng','$idUser','$idPac','$namePac','$idPac' ,'$lab_ord_por_lab',$TOTAL,'$lab_ord_valor_desl','$lab_ord_valor_iva','$TOTAL','$statOrder','$stat','$fechaIng','$usuario');";
                    $val = 1;
                    if (pg_query($tmfLab, $var_consulta)) {
                        $arrInfo['status'] = $val;
                    } else {
                        $arrInfo['status'] = 0;
                        $arrInfo['error'] = $var_consulta;
                    }
                    //echo '<pre>';
                    print_r($var_consulta);
                    //echo  '</pre>';

                    print json_encode($arrInfo);

                    if ($val) {

                        $to = "andrelopez012@hotmail.com";
                        $Modulo = "Laboratorio -";
                        $Orden = $med_con_id;
                        $titulo = "Orden de laboratorio";
                        $lugar = '" . $producto["CTG_LAB_NOMCOM"] . "';
                
                        require_once "../../mail.php";
                    }

                    $rsLabOrdenProd = pg_query($tmfLab, "SELECT COUNT(*) FROM $lab_orden_prod WHERE lab_ori_cod = $med_con_id LIMIT 1");
                    if ($row = pg_fetch_array($rsLabOrdenProd)) {
                        $idRowLabOrdenProd = trim($row[0]);
                    }
                    $OrdenLabPro = isset($idRowLabOrdenProd) ? $idRowLabOrdenProd : 0;

                    $rsLab = pg_query($tmfLab, "SELECT COUNT(*) FROM $lab_orden_prod WHERE lab_ori_exa_id = '" . $producto["CTG_LCE_CODE"] . "' LIMIT 1");
                    if ($row = pg_fetch_array($rsLab)) {
                        $idRowLabPro = trim($row[0]);
                    }
                    $ProLab = isset($idRowLabPro) ? $idRowLabPro : 0;

                    //echo '<pre> OrdenFarPro';
                    //print_r($OrdenFarPro);
                    //echo  '</pre>';
                    //echo '<pre>';
                    //print_r($ProFar);
                    //echo  '</pre> ProFar';

                    if (($OrdenLabPro == 0 && $ProLab == 0) || ($OrdenLabPro >= 1 && $ProLab == 0)) {
                        $lab_ori_valor = $TOTAL;
                        $far_orp_desf = 0;
                        $lab_ori_desl = 0;
                        $lab_ori_exa_ranmin = 0;
                        $lab_ori_exa_ranmax = 0;
                        $lab_ori_exa_res = "";

                        $var_consulta = "INSERT INTO  $lab_orden_prod(lab_ori_cod,lab_ori_gpo_id,lab_ori_exa_id,lab_ori_pre,lab_ori_can,lab_ori_desl,lab_ori_valor,lab_ori_exa_dt,lab_ori_exa_ranmin,lab_ori_exa_ranmax,lab_ori_exa_res,lab_ori_sta,lab_ori_dt,lab_ori_usr)
                        VALUES ($med_con_id,'" . $producto["CTG_LAB_CODE"] . "','" . $producto["CTG_LCE_CODE"] . "','" . $producto["CTG_LCE_PRE"] . "','" . $producto["CANTIDAD"] . "',$lab_ori_desl,$lab_ori_valor,'$fechaIng','$lab_ori_exa_ranmin','$lab_ori_exa_ranmax',' $lab_ori_exa_res','$stat','$fechaIng','$usuario');";
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

                        if ($ProLabContador == 0) {

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
        header('Content-Type: application/json');

        if (isset($_SESSION['CARRITOHOSP'])) {
            reset($_SESSION['CARRITOHOSP']);
            foreach ($_SESSION['CARRITOHOSP'] as $indice => $producto) {
                $idHos = $producto["CTG_HOS_CODE"];
                $hos_orden = "hos" . $idHos . "orden";
                $hos_orden_prod = "hos" . $idHos . "orden_items";
                $hos_prod = "hos" . $idHos . "servicios";

                $namePac = $nombrePacientebHospital;
                $idPac = $idPacientebHospital;


                $rsHosOrden = pg_query($tmfHos, "SELECT COUNT(*) FROM $hos_orden WHERE hos_ord_cod = $med_con_id LIMIT 1");
                if ($row = pg_fetch_array($rsHosOrden)) {
                    $idRowHos = trim($row[0]);
                }
                $OrdenHos = isset($idRowHos) ? $idRowHos : 0;

                $TOTAL = isset($_POST["TOTAL"]) ? $_POST["TOTAL"]  : ''; //valor total de la orden

                if ($OrdenHos == 0) {

                    $hos_ord_valor_iva = ($TOTAL / 1.12) * 0.12;  //valor iva 
                    $statOrder = 1;
                    $hos_ord_por_lab = 0;
                    $hos_ord_valor_desh = 0;

                    $var_consulta = "INSERT INTO $hos_orden(hos_ord_cod,hos_ord_tipo,hos_ord_fec,hos_ord_med_id,hos_ord_pac_id,hos_ord_pac_nombre,hos_ord_por_lab,hos_ord_valor,hos_ord_valor_desh,hos_ord_valor_iva,hos_ord_total,hos_ord_est,hos_ord_sta,hos_ord_dt,hos_ord_usr)
                     VALUES ($med_con_id,'1','$fechaIng','$idUser','$idPac','$namePac' ,'$hos_ord_por_lab',$TOTAL,'$hos_ord_valor_desh','$hos_ord_valor_iva','$TOTAL','$statOrder','$stat','$fechaIng','$usuario');";
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

                    if ($val) {

                            $to = "andrelopez012@hotmail.com";
                            $Modulo = "Hospital -";
                            $Orden = $med_con_id;
                            $titulo = "Orden de Hospital";
                            $lugar = '" . $producto["CTG_HOS_NOMCOM"] . "';

                            require_once "../../mail.php";
                        }

                    $rsHosOrdenProd = pg_query($tmfHos, "SELECT COUNT(*) FROM $hos_orden_prod WHERE hos_ori_cod = $med_con_id LIMIT 1");
                    if ($row = pg_fetch_array($rsHosOrdenProd)) {
                        $idRowHosOrdenProd = trim($row[0]);
                    }
                    $OrdenHosPro = isset($idRowHosOrdenProd) ? $idRowHosOrdenProd : 0;

                    $rsHos = pg_query($tmfHos, "SELECT COUNT(*) FROM $hos_orden_prod WHERE hos_ori_ser_id = '" . $producto["CTG_HPP_CODE"] . "' LIMIT 1");
                    if ($row = pg_fetch_array($rsHos)) {
                        $idRowHosPro = trim($row[0]);
                    }
                    $ProHos = isset($idRowHosPro) ? $idRowHosPro : 0;

                    //print_r($rsHos);
                    //echo '<pre>';
                    //print_r($ProFar);
                    //echo  '</pre> ProFar';

                    if (($OrdenHosPro == 0 && $ProHos == 0) || ($OrdenHosPro >= 1 && $ProHos == 0)) {
                        $hos_ori_valor = $TOTAL;
                        $hos_ori_desh = 0;


                        $var_consulta = "INSERT INTO  $hos_orden_prod(hos_ori_cod,hos_ori_gpo_id,hos_ori_ser_id,hos_ori_pre,hos_ori_can,hos_ori_desh,hos_ori_valor,hos_ori_sta,hos_ori_dt,hos_ori_usr)VALUES ($med_con_id,'" . $producto["CTG_HOS_CODE"] . "','" . $producto["CTG_HPP_CODE"] . "','" . $producto["CTG_HPP_PRE"] . "','" . $producto["CANTIDAD"] . "',$hos_ori_desh,$hos_ori_valor,'$stat','$fechaIng','$usuario');";
                        $val = 2;
                        if (pg_query($tmfHos, $var_consulta)) {
                            $arrInfo['status'] = $val;
                        } else {
                            $arrInfo['status'] = 0;
                            $arrInfo['error'] = $var_consulta;
                        }
                        print_r($var_consulta);

                        print json_encode($arrInfo);

                        $rsHosContador = pg_query($tmfHos, "SELECT COUNT(*) FROM $hos_prod WHERE hos_ser_id = '" . $producto["CTG_HPP_CODE"] . "' LIMIT 1");
                        if ($row = pg_fetch_array($rsHosContador)) {
                            $idRowHosContador = trim($row[0]);
                        }
                        $ProHosContador = isset($idRowHosContador) ? $idRowHosContador : 0;

                        if ($ProHosContador == 0) {

                            $var_consulta = "INSERT INTO  $hos_prod(hos_ser_id,hos_ser_contador,hos_ser_sta,hos_ser_dt,hos_ser_usr)VALUES ('" . $producto["CTG_HPP_CODE"] . "',1,'$stat','$fechaIng','$usuario');";
                            $val = 3;
                            if (pg_query($tmfHos, $var_consulta)) {
                                $arrInfo['status'] = $val;
                            } else {
                                $arrInfo['status'] = 0;
                                $arrInfo['error'] = $var_consulta;
                            }
                            echo '<pre>';
                            print_r($var_consulta);
                            echo  '</pre>';

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
                            echo '<pre>';
                            print_r($var_consulta);
                            echo  '</pre>';

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
        $med = 1;
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
                                <td><?php echo  $rTMP["value"]['med_pac_nom']; ?></td>

                                <input type="hidden" name="hidId_<?php print $intContador; ?>" id="hidId_<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['id']; ?>">
                                <input type="hidden" name="hidFecha_<?php print $intContador; ?>" id="hidFecha_<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['id']; ?>">
                                <input type="hidden" name="hidCodigo_<?php print $intContador; ?>" id="hidCodigo_<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['med_pac_code']; ?>">
                                <input type="hidden" name="hidDpi_<?php print $intContador; ?>" id="hidDpi_<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['med_pac_dpi']; ?>">
                                <input type="hidden" name="hidName_<?php print $intContador; ?>" id="hidName_<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['med_pac_nom']; ?>">
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

        $strFilter = "";
        if (!empty($strSearch)) {
            $strFilter = " WHERE ( UPPER(pro.ctg_pro_desc) LIKE UPPER('%{$strSearch}%') OR UPPER(pro.ctg_pro_cod) LIKE UPPER('%{$strSearch}%')) ";
        }
        $var_consultaf = "SELECT FROM ctg_farmacias";
        $sqlf = pg_query($rmfAdm, $var_consultaf);
        $totalArticlef = pg_num_rows($sqlf);

        $arrTableMed = array();
        $var_consulta = "SELECT pro.*
                        FROM ctg_productos pro
                        $strFilter
                        ORDER BY pro.ctg_pro_desc DESC
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
                        <?php if ($totalArticlef>0) {?>
                        <th>Farmacias</th>
                        <?php } ?>
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
                                <td><?php echo  $rTMP["value"]['ctg_pro_cod']; ?></td>
                                <td><?php echo  $rTMP["value"]['ctg_pro_desc']; ?></td>
                                <td><?php echo  $rTMP["value"]['ctg_pro_prinact']; ?></td>
                                <td><?php echo  $rTMP["value"]['ctg_pro_indi']; ?></td>
                                <?php if ($totalArticlef>0) {?>
                                <td onclick="fntModalFar('<?php print $intContador; ?>')" style="cursor:pointer;  text-align:center;"><i class="fad fa-2x fa-clinic-medical"></i></td>
                                <?php }?>
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
                        ORDER BY id DESC
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
            $arrTableVaccine[$rTMP["id"]]["med_vac_vent_precio"]      = $rTMP["med_vac_vent_precio"];
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
                        <th>Precio Actual</th>
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
                                <td style="cursor:pointer; color:white; background:cadetblue; text-align:center;">
                                    <form id="formDataSessionVac" method="post">

                                        <input type="hidden" name="id" id="id" value="<?php echo openssl_encrypt($rTMP["value"]['id'], COD, KEY); ?>"><!-- id-->
                                        <input type="hidden" name="med_vac_nom" id="med_vac_nom" value="<?php echo openssl_encrypt($rTMP["value"]['med_vac_nom'], COD, KEY); ?>"><!-- nombre producto-->

                                        <input type="hidden" name="med_vac_id" id="med_vac_id" value="<?php echo openssl_encrypt($rTMP["value"]['med_vac_id'], COD, KEY); ?>">
                                        <!--id  nombre producto-->

                                        <input type="hidden" name="med_vac_precio" id="med_vac_precio" value="<?php echo openssl_encrypt($rTMP["value"]['med_vac_precio'], COD, KEY); ?>"><!-- precio-->

                                        <input type="hidden" name="cantidad" id="cantidad" value="<?php echo openssl_encrypt(1, COD, KEY); ?>"><!-- precio-->

                                        <button class="btn btn-dark btn-responsive btninter centrado" name="btnAccionVacc" value="agregarVacc" type="submit"><i class="fad fa-2x fa-box-check"></i></button>

                                    </form>
                                </td>
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
    } else if ($strTipoValidacion == "table_lab_exa") {
        require_once "../../data/conexion/tmfAdm.php";
        $strSearch = isset($_POST["Search"]) ? $_POST["Search"]  : '';

        $strFilter = "";
        if (!empty($strSearch)) {
            $strFilter = " WHERE ( UPPER(ctg_exa_descrip) LIKE UPPER('%{$strSearch}%') ) ";
        }

        $arrTableLabExa = array();
        $var_consulta = "SELECT * 
                        FROM ctg_examenes $strFilter 
                        ORDER BY ctg_exa_descrip DESC
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
                        <th>Codigo</th>
                        <th>Nombre Del Examen</th>
                        <th>Laboratorio</th>
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
                                <td onclick="fntModalLab('<?php print $intContador; ?>')" style="cursor:pointer; color:white; background:cadetblue; text-align:center;"><i class="fad fa-2x fa-microscope"></i></td>
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

        $arrTableHospServ = array();
        $var_consulta = "SELECT *
                        FROM ctg_servicios as serv
                        $strFilter
                        ORDER BY serv.ctg_ser_descrip DESC
                        LIMIT 100";
        $sql = pg_query($rmfAdm, $var_consulta);
        $totalArticle = pg_num_rows($sql);
        //print_r($var_consulta);


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
                        <th>Hospitales</th>
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
                                <td onclick="fntModalHosp('<?php print $intContador; ?>')" style="cursor:pointer; color:white; background:cadetblue; text-align:center;"><i class="fad fa-2x fa-hospital"></i></td>
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
            $strFilter = " AND ( UPPER(far.ctg_far_nomcom) LIKE UPPER('%{$strSearch}%')) ";
        }

        $arrTableMed = array();
        $var_consulta = "SELECT pro.*, far.* 
                        FROM ctg_farmacias_productos pro 
                        INNER JOIN ctg_farmacias_sucursales far 
                        ON pro.ctg_fap_contrato = far.ctg_far_contrato 
                        WHERE pro.ctg_fap_pro = '$strFilterFar' 
                        ORDER BY far.ctg_far_nomcom DESC 
                        LIMIT 100";
        $sql = pg_query($rmfAdm, $var_consulta);
        $totalArticle = pg_num_rows($sql);
        //print_r($var_consulta);

        while ($rTMP = pg_fetch_assoc($sql)) {
            //ARMACIAS PRODUCTOS
            $arrTableMed[$rTMP["id"]]["id"]                       = $rTMP["id"];
            $arrTableMed[$rTMP["id"]]["ctg_fap_contrato"]                       = $rTMP["ctg_fap_contrato"];
            $arrTableMed[$rTMP["id"]]["ctg_fap_pro"]                       = $rTMP["ctg_fap_pro"];
            $arrTableMed[$rTMP["id"]]["ctg_fap_nomcom"]                       = $rTMP["ctg_fap_nomcom"];
            $arrTableMed[$rTMP["id"]]["ctg_fap_pre"]                       = $rTMP["ctg_fap_pre"];
            $arrTableMed[$rTMP["id"]]["ctg_fap_prinact"]                       = $rTMP["ctg_fap_prinact"];
            $arrTableMed[$rTMP["id"]]["ctg_fap_indi"]                       = $rTMP["ctg_fap_indi"];
            $arrTableMed[$rTMP["id"]]["ctg_fap_labfar"]                       = $rTMP["ctg_fap_labfar"];
            $arrTableMed[$rTMP["id"]]["ctg_fap_fecaut"]                       = $rTMP["ctg_fap_fecaut"];
            $arrTableMed[$rTMP["id"]]["ctg_fap_fecven"]                       = $rTMP["ctg_fap_fecven"];
            $arrTableMed[$rTMP["id"]]["ctg_fap_psinar"]                       = $rTMP["ctg_fap_psinar"];
            $arrTableMed[$rTMP["id"]]["ctg_fap_imagen"]                       = $rTMP["ctg_fap_imagen"];
            $arrTableMed[$rTMP["id"]]["ctg_fap_obs"]                       = $rTMP["ctg_fap_obs"];
            $arrTableMed[$rTMP["id"]]["ctg_fap_sta"]                       = $rTMP["ctg_fap_sta"];
            $arrTableMed[$rTMP["id"]]["ctg_fap_usr"]                       = $rTMP["ctg_fap_usr"];
            $arrTableMed[$rTMP["id"]]["ctg_fap_dt"]                       = $rTMP["ctg_fap_dt"];
            $arrTableMed[$rTMP["id"]]["ctg_fap_img"]                       = $rTMP["ctg_fap_img"];

            //FARMACIAS
            $arrTableMed[$rTMP["id"]]["ctg_far_contrato"]                       = $rTMP["ctg_far_contrato"];
            $arrTableMed[$rTMP["id"]]["ctg_far_nit"]                       = $rTMP["ctg_far_nit"];
            $arrTableMed[$rTMP["id"]]["ctg_far_nomcom"]                       = $rTMP["ctg_far_nomcom"];
            $arrTableMed[$rTMP["id"]]["ctg_far_suc"]                       = $rTMP["ctg_far_suc"];
            $arrTableMed[$rTMP["id"]]["ctg_far_code"]                       = $rTMP["ctg_far_code"];
            $arrTableMed[$rTMP["id"]]["ctg_far_servicio"]                       = $rTMP["ctg_far_servicio"];
            $arrTableMed[$rTMP["id"]]["ctg_far_hortda1"]                       = $rTMP["ctg_far_hortda1"];
            $arrTableMed[$rTMP["id"]]["ctg_far_hortda2"]                       = $rTMP["ctg_far_hortda2"];
            $arrTableMed[$rTMP["id"]]["ctg_far_serdom1"]                       = $rTMP["ctg_far_serdom1"];
            $arrTableMed[$rTMP["id"]]["ctg_far_serdom2"]                       = $rTMP["ctg_far_serdom2"];
            $arrTableMed[$rTMP["id"]]["ctg_far_dir"]                       = $rTMP["ctg_far_dir"];
            $arrTableMed[$rTMP["id"]]["ctg_far_zona"]                       = $rTMP["ctg_far_zona"];
            $arrTableMed[$rTMP["id"]]["ctg_far_dep"]                       = $rTMP["ctg_far_dep"];
            $arrTableMed[$rTMP["id"]]["ctg_far_mun"]                       = $rTMP["ctg_far_mun"];
            $arrTableMed[$rTMP["id"]]["ctg_far_tels"]                       = $rTMP["ctg_far_tels"];
            $arrTableMed[$rTMP["id"]]["ctg_far_email"]                       = $rTMP["ctg_far_email"];
            $arrTableMed[$rTMP["id"]]["ctg_far_enc_dpi"]                       = $rTMP["ctg_far_enc_dpi"];
            $arrTableMed[$rTMP["id"]]["ctg_far_enc_nombre"]                       = $rTMP["ctg_far_enc_nombre"];
            $arrTableMed[$rTMP["id"]]["ctg_far_enc_sexo"]                       = $rTMP["ctg_far_enc_sexo"];
            $arrTableMed[$rTMP["id"]]["ctg_far_enc_edad"]                       = $rTMP["ctg_far_enc_edad"];
            $arrTableMed[$rTMP["id"]]["ctg_far_enc_cel"]                       = $rTMP["ctg_far_enc_cel"];
            $arrTableMed[$rTMP["id"]]["ctg_far_username"]                       = $rTMP["ctg_far_username"];
            $arrTableMed[$rTMP["id"]]["ctg_far_pass"]                       = $rTMP["ctg_far_pass"];
            $arrTableMed[$rTMP["id"]]["ctg_far_estatus"]                       = $rTMP["ctg_far_estatus"];
            $arrTableMed[$rTMP["id"]]["ctg_far_censuc"]                       = $rTMP["ctg_far_censuc"];
            $arrTableMed[$rTMP["id"]]["ctg_far_sol_dt"]                       = $rTMP["ctg_far_sol_dt"];
            $arrTableMed[$rTMP["id"]]["ctg_far_aut_dt"]                       = $rTMP["ctg_far_aut_dt"];
            $arrTableMed[$rTMP["id"]]["ctg_far_ven_dt"]                       = $rTMP["ctg_far_ven_dt"];
            $arrTableMed[$rTMP["id"]]["ctg_far_sta"]                       = $rTMP["ctg_far_sta"];
            $arrTableMed[$rTMP["id"]]["ctg_far_dt"]                       = $rTMP["ctg_far_dt"];
            $arrTableMed[$rTMP["id"]]["ctg_far_usr"]                       = $rTMP["ctg_far_usr"];
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
                                <td style="cursor:pointer; color:white; background:cadetblue; text-align:center;">
                                    <form method="POST" action="">

                                        <input type="hidden" name="id" id="id" value="<?php echo openssl_encrypt($rTMP["value"]['id'], COD, KEY); ?>"><!-- id-->
                                        <input type="hidden" name="ctg_fap_nomcom" id="ctg_fap_nomcom" value="<?php echo openssl_encrypt($rTMP["value"]['ctg_fap_nomcom'], COD, KEY); ?>"><!-- nombre producto-->
                                        <input type="hidden" name="ctg_far_nomcom" id="ctg_far_nomcom" value="<?php echo openssl_encrypt($rTMP["value"]['ctg_far_nomcom'], COD, KEY); ?>"><!-- nombre ubicacion-->

                                        <input type="hidden" name="ctg_fap_contrato" id="ctg_fap_contrato" value="<?php echo openssl_encrypt($rTMP["value"]['ctg_fap_contrato'], COD, KEY); ?>">
                                        <!--id  nombre producto-->
                                        <input type="hidden" name="ctg_far_code" id="ctg_far_code" value="<?php echo openssl_encrypt($rTMP["value"]['ctg_far_code'], COD, KEY); ?>"><!-- id nombre ubicacion-->

                                        <input type="hidden" name="ctg_fap_pre" id="ctg_fap_pre" value="<?php echo openssl_encrypt($rTMP["value"]['ctg_fap_pre'], COD, KEY); ?>"><!-- precio-->
                                        <input type="hidden" name="ctg_fap_pro" id="ctg_fap_pro" value="<?php echo openssl_encrypt($rTMP["value"]['ctg_fap_pro'], COD, KEY); ?>"><!-- precio-->

                                        <input type="hidden" name="cantidad" id="cantidad" value="<?php echo openssl_encrypt(1, COD, KEY); ?>"><!-- precio-->

                                        <button class="btn btn-dark btn-responsive btninter centrado" name="btnAccionMed" value="agregarMed" type="submit"><i class="fad fa-2x fa-box-check"></i></button>

                                    </form>
                                </td>
                                <input type="hidden" name="hidFilterMedImg_<?php print $intContador; ?>" id="hidFilterMedImg_<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['ctg_fap_contrato']; ?>">
                                <input type="hidden" name="hidFilterMedImgPro_<?php print $intContador; ?>" id="hidFilterMedImgPro_<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['ctg_fap_pro']; ?>">

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
                        ORDER BY lab.ctg_lab_nomcom DESC
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
            $arrTableLab[$rTMP["id"]]["ctg_lab_enc_ced1"]         = $rTMP["ctg_lab_enc_ced1"];
            $arrTableLab[$rTMP["id"]]["ctg_lab_enc_ced2"]         = $rTMP["ctg_lab_enc_ced2"];
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
            $arrTableLab[$rTMP["id"]]["ctg_lce_sta"]              = $rTMP["ctg_lce_sta"];
            $arrTableLab[$rTMP["id"]]["ctg_lce_dt"]              = $rTMP["ctg_lce_dt"];
            $arrTableLab[$rTMP["id"]]["ctg_lce_usr"]              = $rTMP["ctg_lce_usr"];
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
                        reset($arrTableLab);
                        foreach ($arrTableLab as $rTMP['key'] => $rTMP['value']) {
                    ?>
                            <tr>
                                <td><?php echo  $rTMP["value"]['ctg_lab_nomcom']; ?></td>
                                <td><?php echo  $rTMP["value"]['ctg_lab_suc']; ?></td>
                                <td><?php echo  $rTMP["value"]['ctg_lab_dir']; ?></td>
                                <td><?php echo  $rTMP["value"]['ctg_lab_tels']; ?></td>
                                <td><?php echo  $rTMP["value"]['ctg_lce_pre']; ?></td>
                                <td style="cursor:pointer; color:white; background:cadetblue; text-align:center;">
                                    <form method="POST" action="">

                                        <input type="hidden" name="id" id="id" value="<?php echo openssl_encrypt($rTMP["value"]['id'], COD, KEY); ?>"><!-- id-->
                                        <input type="hidden" name="ctg_lce_descrip" id="ctg_lce_descrip" value="<?php echo openssl_encrypt($rTMP["value"]['ctg_lce_descrip'], COD, KEY); ?>"><!-- nombre producto-->
                                        <input type="hidden" name="ctg_lab_nomcom" id="ctg_lab_nomcom" value="<?php echo openssl_encrypt($rTMP["value"]['ctg_lab_nomcom'], COD, KEY); ?>"><!-- nombre ubicacion-->

                                        <input type="hidden" name="ctg_lce_code" id="ctg_lce_code" value="<?php echo openssl_encrypt($rTMP["value"]['ctg_lce_code'], COD, KEY); ?>">
                                        <!--id  nombre producto-->
                                        <input type="hidden" name="ctg_lce_contrato" id="ctg_lce_contrato" value="<?php echo openssl_encrypt($rTMP["value"]['ctg_lce_contrato'], COD, KEY); ?>"><!-- id  examen clinico-->
                                        <input type="hidden" name="ctg_lab_contrato" id="ctg_lab_contrato" value="<?php echo openssl_encrypt($rTMP["value"]['ctg_lab_contrato'], COD, KEY); ?>"><!-- id  clinica-->
                                        <input type="hidden" name="ctg_lab_code" id="ctg_lab_code" value="<?php echo openssl_encrypt($rTMP["value"]['ctg_lab_code'], COD, KEY); ?>"><!-- id  clinica-->


                                        <input type="hidden" name="ctg_lce_pre" id="ctg_lce_pre" value="<?php echo openssl_encrypt($rTMP["value"]['ctg_lce_pre'], COD, KEY); ?>"><!-- precio-->

                                        <input type="hidden" name="cantidad" id="cantidad" value="<?php echo openssl_encrypt(1, COD, KEY); ?>"><!-- precio-->

                                        <button class="btn btn-dark btn-responsive btninter centrado" name="btnAccionLab" value="agregarLab" type="submit"><i class="fad fa-2x fa-box-check"></i></button>

                                    </form>
                                </td>
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
                        ORDER BY hop.ctg_hos_nomcom DESC
                        LIMIT 100";
        $sql = pg_query($rmfAdm, $var_consulta);
        $totalArticle = pg_num_rows($sql);
        //print_r($var_consulta);


        while ($rTMP = pg_fetch_assoc($sql)) {
            //HOSPITALES
            $arrTableHosp[$rTMP["id"]]["id"]                       = $rTMP["id"];
            $arrTableHosp[$rTMP["id"]]["ctg_hos_contrato"]         = $rTMP["ctg_hos_contrato"];
            $arrTableHosp[$rTMP["id"]]["ctg_hos_nit"]              = $rTMP["ctg_hos_nit"];
            $arrTableHosp[$rTMP["id"]]["ctg_hos_nomcom"]           = $rTMP["ctg_hos_nomcom"];
            $arrTableHosp[$rTMP["id"]]["ctg_hos_code"]             = $rTMP["ctg_hos_code"];
            $arrTableHosp[$rTMP["id"]]["ctg_hos_dir"]              = $rTMP["ctg_hos_dir"];
            $arrTableHosp[$rTMP["id"]]["ctg_hos_zona"]             = $rTMP["ctg_hos_zona"];
            $arrTableHosp[$rTMP["id"]]["ctg_hos_dep"]              = $rTMP["ctg_hos_dep"];
            $arrTableHosp[$rTMP["id"]]["ctg_hos_mun"]              = $rTMP["ctg_hos_mun"];
            $arrTableHosp[$rTMP["id"]]["ctg_hos_tels"]             = $rTMP["ctg_hos_tels"];
            $arrTableHosp[$rTMP["id"]]["ctg_hos_email"]            = $rTMP["ctg_hos_email"];
            $arrTableHosp[$rTMP["id"]]["ctg_hos_enc_ced1"]         = $rTMP["ctg_hos_enc_ced1"];
            $arrTableHosp[$rTMP["id"]]["ctg_hos_enc_ced2"]         = $rTMP["ctg_hos_enc_ced2"];
            $arrTableHosp[$rTMP["id"]]["ctg_hos_enc_dpi"]          = $rTMP["ctg_hos_enc_dpi"];
            $arrTableHosp[$rTMP["id"]]["ctg_hos_enc_nom1"]         = $rTMP["ctg_hos_enc_nom1"];
            $arrTableHosp[$rTMP["id"]]["ctg_hos_enc_nom2"]         = $rTMP["ctg_hos_enc_nom2"];
            $arrTableHosp[$rTMP["id"]]["ctg_hos_enc_ape1"]         = $rTMP["ctg_hos_enc_ape1"];
            $arrTableHosp[$rTMP["id"]]["ctg_hos_enc_ape2"]         = $rTMP["ctg_hos_enc_ape2"];
            $arrTableHosp[$rTMP["id"]]["ctg_hos_enc_ape3"]         = $rTMP["ctg_hos_enc_ape3"];
            $arrTableHosp[$rTMP["id"]]["ctg_hos_enc_sexo"]         = $rTMP["ctg_hos_enc_sexo"];
            $arrTableHosp[$rTMP["id"]]["ctg_hos_enc_civil"]        = $rTMP["ctg_hos_enc_civil"];
            $arrTableHosp[$rTMP["id"]]["ctg_hos_enc_nac_dia"]      = $rTMP["ctg_hos_enc_nac_dia"];
            $arrTableHosp[$rTMP["id"]]["ctg_hos_enc_nac_mes"]      = $rTMP["ctg_hos_enc_nac_mes"];
            $arrTableHosp[$rTMP["id"]]["ctg_hos_enc_nac_ano"]      = $rTMP["ctg_hos_enc_nac_ano"];
            $arrTableHosp[$rTMP["id"]]["ctg_hos_enc_dir"]          = $rTMP["ctg_hos_enc_dir"];
            $arrTableHosp[$rTMP["id"]]["ctg_hos_enc_zona"]         = $rTMP["ctg_hos_enc_zona"];
            $arrTableHosp[$rTMP["id"]]["ctg_hos_enc_dep"]          = $rTMP["ctg_hos_enc_dep"];
            $arrTableHosp[$rTMP["id"]]["ctg_hos_enc_mun"]          = $rTMP["ctg_hos_enc_mun"];
            $arrTableHosp[$rTMP["id"]]["ctg_hos_enc_cel"]          = $rTMP["ctg_hos_enc_cel"];
            $arrTableHosp[$rTMP["id"]]["ctg_hos_enc_tels"]         = $rTMP["ctg_hos_enc_tels"];
            $arrTableHosp[$rTMP["id"]]["ctg_hos_enc_email"]        = $rTMP["ctg_hos_enc_email"];
            $arrTableHosp[$rTMP["id"]]["ctg_hos_username"]         = $rTMP["ctg_hos_username"];
            $arrTableHosp[$rTMP["id"]]["ctg_hos_pass"]             = $rTMP["ctg_hos_pass"];
            $arrTableHosp[$rTMP["id"]]["ctg_hos_estatus"]          = $rTMP["ctg_hos_estatus"];
            $arrTableHosp[$rTMP["id"]]["ctg_hos_sol_dt"]           = $rTMP["ctg_hos_sol_dt"];
            $arrTableHosp[$rTMP["id"]]["ctg_hos_aut_dt"]           = $rTMP["ctg_hos_aut_dt"];
            $arrTableHosp[$rTMP["id"]]["ctg_hos_ven_dt"]           = $rTMP["ctg_hos_ven_dt"];
            $arrTableHosp[$rTMP["id"]]["ctg_hos_sta"]              = $rTMP["ctg_hos_sta"];
            $arrTableHosp[$rTMP["id"]]["ctg_hos_dt"]               = $rTMP["ctg_hos_dt"];
            $arrTableHosp[$rTMP["id"]]["ctg_hos_usr"]              = $rTMP["ctg_hos_usr"];

            //HOSPITALES SERVICIOS
            $arrTableHosp[$rTMP["id"]]["ctg_hpp_contrato"]                       = $rTMP["ctg_hpp_contrato"];
            $arrTableHosp[$rTMP["id"]]["ctg_hpp_code"]                       = $rTMP["ctg_hpp_code"];
            $arrTableHosp[$rTMP["id"]]["ctg_hpp_descrip"]                       = $rTMP["ctg_hpp_descrip"];
            $arrTableHosp[$rTMP["id"]]["ctg_hpp_pre"]                       = $rTMP["ctg_hpp_pre"];
            $arrTableHosp[$rTMP["id"]]["ctg_hpp_imagen"]                       = $rTMP["ctg_hpp_imagen"];
            $arrTableHosp[$rTMP["id"]]["ctg_hpp_obs"]                       = $rTMP["ctg_hpp_obs"];
            $arrTableHosp[$rTMP["id"]]["ctg_hpp_sta"]                       = $rTMP["ctg_hpp_sta"];
            $arrTableHosp[$rTMP["id"]]["ctg_hpp_dt"]                       = $rTMP["ctg_hpp_dt"];
            $arrTableHosp[$rTMP["id"]]["ctg_hpp_usr"]                       = $rTMP["ctg_hpp_usr"];
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
                        reset($arrTableHosp);
                        foreach ($arrTableHosp as $rTMP['key'] => $rTMP['value']) {
                    ?>
                            <tr>
                                <td><?php echo  $rTMP["value"]['ctg_hos_nomcom']; ?></td>
                                <td><?php echo  $rTMP["value"]['ctg_hos_zona']; ?></td>
                                <td><?php echo  $rTMP["value"]['ctg_hos_dir']; ?></td>
                                <td><?php echo  $rTMP["value"]['ctg_hos_tels']; ?></td>
                                <td><?php echo  $rTMP["value"]['ctg_hpp_pre']; ?></td>
                                <td style="cursor:pointer; color:white; background:cadetblue; text-align:center;">
                                    <form method="POST" action="">

                                        <input type="hidden" name="id" id="id" value="<?php echo openssl_encrypt($rTMP["value"]['id'], COD, KEY); ?>"><!-- id-->
                                        <input type="hidden" name="ctg_hpp_descrip" id="ctg_hpp_descrip" value="<?php echo openssl_encrypt($rTMP["value"]['ctg_hpp_descrip'], COD, KEY); ?>"><!-- nombre producto-->
                                        <input type="hidden" name="ctg_hos_nomcom" id="ctg_hos_nomcom" value="<?php echo openssl_encrypt($rTMP["value"]['ctg_hos_nomcom'], COD, KEY); ?>"><!-- nombre ubicacion-->

                                        <input type="hidden" name="ctg_hos_contrato" id="ctg_hos_contrato" value="<?php echo openssl_encrypt($rTMP["value"]['ctg_hos_contrato'], COD, KEY); ?>">
                                        <input type="hidden" name="ctg_hos_code" id="ctg_hos_code" value="<?php echo openssl_encrypt($rTMP["value"]['ctg_hos_code'], COD, KEY); ?>">
                                        <!--id  nombre producto-->
                                        <input type="hidden" name="ctg_hpp_code" id="ctg_hpp_code" value="<?php echo openssl_encrypt($rTMP["value"]['ctg_hpp_code'], COD, KEY); ?>"><!-- id nombre ubicacion-->
                                        <input type="hidden" name="ctg_hpp_contrato" id="ctg_hpp_contrato" value="<?php echo openssl_encrypt($rTMP["value"]['ctg_hpp_contrato'], COD, KEY); ?>"><!-- id nombre ubicacion-->

                                        <input type="hidden" name="ctg_hpp_pre" id="ctg_hpp_pre" value="<?php echo openssl_encrypt($rTMP["value"]['ctg_hpp_pre'], COD, KEY); ?>"><!-- precio-->

                                        <input type="hidden" name="cantidad" id="cantidad" value="<?php echo openssl_encrypt(1, COD, KEY); ?>"><!-- precio-->

                                        <button class="btn btn-dark btn-responsive btninter centrado" name="btnAccionHosp" value="agregarHosp" type="submit"><i class="fad fa-2x fa-box-check"></i></button>

                                    </form>
                                </td>
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

    if (is_numeric(openssl_decrypt($_POST['id'], COD, KEY))) {
        $ID = openssl_decrypt($_POST['id'], COD, KEY);
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
            'CTG_FAP_CONTRATO' => $CTG_FAP_CONTRATO,
            'CTG_FAR_CODE' => $CTG_FAR_CODE,
            'CTG_FAP_PRE' => $CTG_FAP_PRE,
            'CTG_FAP_PRO' => $CTG_FAP_PRO,
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
                'CTG_FAP_CONTRATO' => $CTG_FAP_CONTRATO,
                'CTG_FAR_CODE' => $CTG_FAR_CODE,
                'CTG_FAP_PRE' => $CTG_FAP_PRE,
                'CTG_FAP_PRO' => $CTG_FAP_PRO,
                'CANTIDAD' => $CANTIDAD
            );
            $_SESSION['CARRITOMED'][$NumeroProductos] = $producto;
            $mensajeMed = "Producto agregado al CARRITOMED";
        }
    }

    die();
} else if ($strTipoValidacion == "session_med_d") {

    if (is_numeric(openssl_decrypt($_POST['id'], COD, KEY))) {
        $ID = openssl_decrypt($_POST['id'], COD, KEY);

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

    if (is_numeric(openssl_decrypt($_POST['id'], COD, KEY))) {
        $ID = openssl_decrypt($_POST['id'], COD, KEY);
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

    if (is_numeric(openssl_decrypt($_POST['cantidad'], COD, KEY))) {
        $CANTIDAD = openssl_decrypt($_POST['cantidad'], COD, KEY);
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

    if (is_numeric(openssl_decrypt($_POST['id'], COD, KEY))) {
        $ID = openssl_decrypt($_POST['id'], COD, KEY);

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

    if (is_numeric(openssl_decrypt($_POST['id'], COD, KEY))) {
        $ID = openssl_decrypt($_POST['id'], COD, KEY);
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

    if (is_numeric(openssl_decrypt($_POST['cantidad'], COD, KEY))) {
        $CANTIDAD = openssl_decrypt($_POST['cantidad'], COD, KEY);
        $mensaje .= "OK ES CORRECTO CANTIDAD " . $CANTIDAD . "</br>";
    } else {
        $mensaje .= "UPPSS...... CANTIDAD INCORRECTO" . "</br>";
        
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
            'CANTIDAD' => $CANTIDAD
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
                'CANTIDAD' => $CANTIDAD
            );
            $_SESSION['CARRITOLAB'][$NumeroProductos] = $producto;
            $mensaje = "Producto agregado al CARRITOLAB";
        }
    }

    die();
} else if ($strTipoValidacion == "session_lab_d") {

    if (is_numeric(openssl_decrypt($_POST['id'], COD, KEY))) {
        $ID = openssl_decrypt($_POST['id'], COD, KEY);

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

    if (is_numeric(openssl_decrypt($_POST['id'], COD, KEY))) {
        $ID = openssl_decrypt($_POST['id'], COD, KEY);
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

    if (is_numeric(openssl_decrypt($_POST['cantidad'], COD, KEY))) {
        $CANTIDAD = openssl_decrypt($_POST['cantidad'], COD, KEY);
        $mensajeHosp .= "OK ES CORRECTO CANTIDAD " . $CANTIDAD . "</br>";
    } else {
        $mensajeHosp .= "UPPSS...... CANTIDAD INCORRECTO" . "</br>";
        
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
            'CANTIDAD' => $CANTIDAD
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
                'CANTIDAD' => $CANTIDAD
            );
            $_SESSION['CARRITOHOSP'][$NumeroProductos] = $producto;
            $mensajeHosp = "Producto agregado al CARRITOHOSP";
        }
    }

    die();
} else if ($strTipoValidacion == "session_hosp_d") {

    if (is_numeric(openssl_decrypt($_POST['id'], COD, KEY))) {
        $ID = openssl_decrypt($_POST['id'], COD, KEY);

        foreach ($_SESSION['CARRITOHOSP'] as $indice => $producto) {
            if ($producto['ID'] == $ID) {
                unset($_SESSION['CARRITOHOSP'][$indice]);
            }
        }
    } else {
        $mensajeHosp .= "UPPSS...... ID INCORRECTO";
    }

    die();
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

<?php


//LINEAS PARA SEGMENTO DE SELECCION DE PACIENTES
//$med = 1;
//$tablaPacientes = "med" . $med . "pacientes";
//$tablaConsultas = "med" . $med . "consultas";
//$arrTablePatient = array();
//$var_consulta = "SELECT  pac.* , con.*
//                    FROM $tablaPacientes pac
//                    LEFT JOIN $tablaConsultas con
//                    ON pac.id = con.med_con_pac_id
//                    ORDER BY pac.id ";
//$sql = pg_query($tmfMed, $var_consulta);
//$totalArticle = pg_num_rows($sql);
?>
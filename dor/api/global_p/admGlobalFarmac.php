<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once "../../api/globalFunctions.php";
// VALIDATION INSERT UPDATE DELETE
if (isset($_GET["validaciones"]) && !empty($_GET["validaciones"])) {
    require_once "../../data/conexion/tmlMed.php";

    $idUser = $_SESSION['adm_usr_id'];
    $id =  $_SESSION['adm_usr_code'];
    $tablaConsultas = "med" . $id . "consultas";
    $year = date("Y");


    $rs = pg_query($tmfMed, "SELECT med_con_id FROM $tablaConsultas ORDER BY med_con_id DESC LIMIT 1");
    if ($row = pg_fetch_array($rs)) {
        $idRow = trim($row[0]);
    }
    //id para insert de tabla medicos
    $med_con_id_ = $idRow + 1;
    //id para insert de tabla pacientes y farmaceuticas
    $med_con_id = $idRow;

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

  
    else if ($strTipoValidacion == "table_med") {
        require_once "../../data/conexion/tmfAdm.php";
        $strSearch = isset($_POST["Search"]) ? $_POST["Search"]  : '';

        $strFilter = "";
        if (!empty($strSearch)) {
            $strFilter = " WHERE ( UPPER(pro.ctg_pro_desc) LIKE UPPER('%{$strSearch}%') OR UPPER(pro.ctg_pro_cod) LIKE UPPER('%{$strSearch}%')) ";
        }

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
                        <th>Farmacias</th>
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
                                <td onclick="fntModalFar('<?php print $intContador; ?>')" style="cursor:pointer;  text-align:center;"><i class="fad fa-2x fa-clinic-medical"></i></td>
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
    } 

    ///// TABLAS SEGUNDO NIVEL///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    else if ($strTipoValidacion == "table_med_far") {
        require_once "../../data/conexion/tmfAdm.php";
        $strSearch = isset($_POST["Search"]) ? $_POST["Search"]  : '';
        $strFilterFar = isset($_POST["strFilterFar"]) ? $_POST["strFilterFar"]  : '';

        $strFilter = "";
        if (!empty($strSearch)) {
            $strFilter = " WHERE ( UPPER(far.ctg_far_nomcom) LIKE UPPER('%{$strSearch}%')) ";
        }

        $arrTableMed = array();
        $var_consulta = "SELECT  far.* 
                        FROM ctg_farmacias_sucursales far 
                        $strFilter
                        ORDER BY far.ctg_far_nomcom DESC 
                        LIMIT 100";
        $sql = pg_query($rmfAdm, $var_consulta);
        $totalArticle = pg_num_rows($sql);
        //print_r($var_consulta);

        while ($rTMP = pg_fetch_assoc($sql)) {
           

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
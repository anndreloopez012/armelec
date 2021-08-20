<?php


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

     else if ($strTipoValidacion == "table_lab_exa") {
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
    }  else if ($strTipoValidacion == "table_lab") {
        require_once "../../data/conexion/tmfAdm.php";
        $strSearch = isset($_POST["Search"]) ? $_POST["Search"]  : '';
        $strFilterLab = isset($_POST["strFilterLab"]) ? $_POST["strFilterLab"]  : '';

        $strFilter = "";
        if (!empty($strSearch)) {
            $strFilter = " AND ( UPPER(ctg_lab_nomcom) LIKE UPPER('%{$strSearch}%') ) ";
        }

        $arrTableLab = array();
        $var_consulta = "SELECT *
                        FROM ctg_lab_clinicos lab
                        $strFilter 
                        ORDER BY ctg_lab_nomcom DESC
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
       
        }
        pg_free_result($sql);

    ?>
        <div class="col-md-12 tableFixHead">
            <table id="tableFarmac" class="table table-bordered table-striped table-hover table-sm">
                <?php if ($totalArticle>0) { ?>
                <thead>
                    <tr class="table-info">
                        <th>Nombre Del Laboratorio</th>
                        <th>Sucursal</th>
                        <th>Direccion</th>
                        <th>Telefono</th>
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
                            </tr>
                    <?PHP
                        }
                    }
                    ?>
                <?php } else  { ?>
                <thead>
                    <tr class="table-info">
                        <th style="font-size: 20px;" >MUY PRONTO ENCONTRARAS LA RED MAS GRANDE DE LABORATORIOS CLINICOS DEL PAIS</th>
                    </tr>
                </thead>
                <?php }  ?>
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
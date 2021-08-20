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
    if ($strTipoValidacion == "insert") {
        header('Content-Type: application/json');
        $var_consulta = "SELECT doctors_diet('$tablaVacunas',$insert,$med_vac_id_,'$med_vac_nom_','$med_vac_des_'
            ,'$status','$fechaIng','$usuario',$idRow,$idMax)";
        $val = 1;
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
            $strFilter = " AND ( UPPER(ctg_hos_nomcom) LIKE '%{$strSearch}%' ) ";
        }

        $arrTableLab = array();
        $var_consulta = "SELECT *
                            FROM ctg_hospitales as hop 
                            INNER JOIN ctg_hospitales_servicios as serv
                            ON hop.ctg_hos_contrato = serv.ctg_hos_contrato";
        $sql = pg_query($rmfAdm, $var_consulta);
        $totalArticle = pg_num_rows($sql);


        while ($rTMP = pg_fetch_assoc($sql)) {

            $arrTableLab[$rTMP["id"]]["id"]                       = $rTMP["id"];
            $arrTableLab[$rTMP["id"]]["ctg_hos_contrato"]         = $rTMP["ctg_hos_contrato"];
            $arrTableLab[$rTMP["id"]]["ctg_hos_nit"]              = $rTMP["ctg_hos_nit"];
            $arrTableLab[$rTMP["id"]]["ctg_hos_nomcom"]           = $rTMP["ctg_hos_nomcom"];
            $arrTableLab[$rTMP["id"]]["ctg_hos_code"]             = $rTMP["ctg_hos_code"];
            $arrTableLab[$rTMP["id"]]["ctg_hos_dir"]              = $rTMP["ctg_hos_dir"];
            $arrTableLab[$rTMP["id"]]["ctg_hos_zona"]             = $rTMP["ctg_hos_zona"];
            $arrTableLab[$rTMP["id"]]["ctg_hos_dep"]              = $rTMP["ctg_hos_dep"];
            $arrTableLab[$rTMP["id"]]["ctg_hos_mun"]              = $rTMP["ctg_hos_mun"];
            $arrTableLab[$rTMP["id"]]["ctg_hos_tels"]             = $rTMP["ctg_hos_tels"];
            $arrTableLab[$rTMP["id"]]["ctg_hos_email"]            = $rTMP["ctg_hos_email"];
            $arrTableLab[$rTMP["id"]]["ctg_hos_enc_ced1"]         = $rTMP["ctg_hos_enc_ced1"];
            $arrTableLab[$rTMP["id"]]["ctg_hos_enc_ced2"]         = $rTMP["ctg_hos_enc_ced2"];
            $arrTableLab[$rTMP["id"]]["ctg_hos_enc_dpi"]          = $rTMP["ctg_hos_enc_dpi"];
            $arrTableLab[$rTMP["id"]]["ctg_hos_enc_nom1"]         = $rTMP["ctg_hos_enc_nom1"];
            $arrTableLab[$rTMP["id"]]["ctg_hos_enc_nom2"]         = $rTMP["ctg_hos_enc_nom2"];
            $arrTableLab[$rTMP["id"]]["ctg_hos_enc_ape1"]         = $rTMP["ctg_hos_enc_ape1"];
            $arrTableLab[$rTMP["id"]]["ctg_hos_enc_ape2"]         = $rTMP["ctg_hos_enc_ape2"];
            $arrTableLab[$rTMP["id"]]["ctg_hos_enc_ape3"]         = $rTMP["ctg_hos_enc_ape3"];
            $arrTableLab[$rTMP["id"]]["ctg_hos_enc_sexo"]         = $rTMP["ctg_hos_enc_sexo"];
            $arrTableLab[$rTMP["id"]]["ctg_hos_enc_civil"]        = $rTMP["ctg_hos_enc_civil"];
            $arrTableLab[$rTMP["id"]]["ctg_hos_enc_nac_dia"]      = $rTMP["ctg_hos_enc_nac_dia"];
            $arrTableLab[$rTMP["id"]]["ctg_hos_enc_nac_mes"]      = $rTMP["ctg_hos_enc_nac_mes"];
            $arrTableLab[$rTMP["id"]]["ctg_hos_enc_nac_ano"]      = $rTMP["ctg_hos_enc_nac_ano"];
            $arrTableLab[$rTMP["id"]]["ctg_hos_enc_dir"]          = $rTMP["ctg_hos_enc_dir"];
            $arrTableLab[$rTMP["id"]]["ctg_hos_enc_zona"]         = $rTMP["ctg_hos_enc_zona"];
            $arrTableLab[$rTMP["id"]]["ctg_hos_enc_dep"]          = $rTMP["ctg_hos_enc_dep"];
            $arrTableLab[$rTMP["id"]]["ctg_hos_enc_mun"]          = $rTMP["ctg_hos_enc_mun"];
            $arrTableLab[$rTMP["id"]]["ctg_hos_enc_cel"]          = $rTMP["ctg_hos_enc_cel"];
            $arrTableLab[$rTMP["id"]]["ctg_hos_enc_tels"]         = $rTMP["ctg_hos_enc_tels"];
            $arrTableLab[$rTMP["id"]]["ctg_hos_enc_email"]        = $rTMP["ctg_hos_enc_email"];
            $arrTableLab[$rTMP["id"]]["ctg_hos_username"]         = $rTMP["ctg_hos_username"];
            $arrTableLab[$rTMP["id"]]["ctg_hos_pass"]             = $rTMP["ctg_hos_pass"];
            $arrTableLab[$rTMP["id"]]["ctg_hos_estatus"]          = $rTMP["ctg_hos_estatus"];
            $arrTableLab[$rTMP["id"]]["ctg_hos_sol_dt"]           = $rTMP["ctg_hos_sol_dt"];
            $arrTableLab[$rTMP["id"]]["ctg_hos_aut_dt"]           = $rTMP["ctg_hos_aut_dt"];
            $arrTableLab[$rTMP["id"]]["ctg_hos_ven_dt"]           = $rTMP["ctg_hos_ven_dt"];
            $arrTableLab[$rTMP["id"]]["ctg_hos_sta"]              = $rTMP["ctg_hos_sta"];
            $arrTableLab[$rTMP["id"]]["ctg_hos_dt"]               = $rTMP["ctg_hos_dt"];
            $arrTableLab[$rTMP["id"]]["ctg_hos_usr"]              = $rTMP["ctg_hos_usr"];
            $arrTableLab[$rTMP["id"]]["ctg_hos_contrato"]         = $rTMP["ctg_hos_contrato"];
            $arrTableLab[$rTMP["id"]]["ctg_hos_descrip"]          = $rTMP["ctg_hos_descrip"];
            $arrTableLab[$rTMP["id"]]["ctg_hos_pre"]              = $rTMP["ctg_hos_pre"];
            $arrTableLab[$rTMP["id"]]["ctg_hos_imagen"]           = $rTMP["ctg_hos_imagen"];
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
                        <th>Servicio</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (is_array($arrTableLab) && (count($arrTableLab) > 0)) {
                        reset($arrTableLab);
                        foreach ($arrTableLab as $rTMP['key'] => $rTMP['value']) {
                    ?>
                            <tr>
                                <td><?php echo  $rTMP["value"]['ctg_hos_nomcom']; ?></td>
                                <td><?php echo  $rTMP["value"]['ctg_hos_zona']; ?></td>
                                <td><?php echo  $rTMP["value"]['ctg_hos_dir']; ?></td>
                                <td><?php echo  $rTMP["value"]['ctg_hos_tels']; ?></td>
                                <td style="cursor:pointer; color:white; background:cadetblue; text-align:center;" ><i class="fas fa-2x fa-band-aid"></i></td>
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


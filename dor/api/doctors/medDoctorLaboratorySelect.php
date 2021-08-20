<?php
if (isset($_GET["validaciones"]) && !empty($_GET["validaciones"])) {
    require_once "../../data/conexion/tmfAdm.php";
    $usuario = $_SESSION['adm_usr_code'];

    //TABLA DE INTERACCION
    $idUser =  $_SESSION['adm_usr_code'];
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
            $strFilter = " AND ( UPPER(ctg_far_nomcom) LIKE '%{$strSearch}%' ) ";
        }

        $arrTableFarmac = array();
        $var_consulta = "SELECT * FROM ctg_farmacias ORDER BY id ";
        $sql = pg_query($rmfAdm, $var_consulta);
        $totalArticle = pg_num_rows($sql);


        while ($rTMP = pg_fetch_assoc($sql)) {

            $arrTableFarmac[$rTMP["id"]]["id"]                       = $rTMP["id"];
            $arrTableFarmac[$rTMP["id"]]["ctg_far_contrato"]         = $rTMP["ctg_far_contrato"];
            $arrTableFarmac[$rTMP["id"]]["ctg_far_nit"]              = $rTMP["ctg_far_nit"];
            $arrTableFarmac[$rTMP["id"]]["ctg_far_nomcom"]           = $rTMP["ctg_far_nomcom"];
            $arrTableFarmac[$rTMP["id"]]["ctg_far_suc"]              = $rTMP["ctg_far_suc"];
            $arrTableFarmac[$rTMP["id"]]["ctg_far_code"]             = $rTMP["ctg_far_code"];
            $arrTableFarmac[$rTMP["id"]]["ctg_far_servicio"]         = $rTMP["ctg_far_servicio"];
            $arrTableFarmac[$rTMP["id"]]["ctg_far_hortda1"]          = $rTMP["ctg_far_hortda1"];
            $arrTableFarmac[$rTMP["id"]]["ctg_far_hortda2"]          = $rTMP["ctg_far_hortda2"];
            $arrTableFarmac[$rTMP["id"]]["ctg_far_serdom1"]          = $rTMP["ctg_far_serdom1"];
            $arrTableFarmac[$rTMP["id"]]["ctg_far_serdom2"]          = $rTMP["ctg_far_serdom2"];
            $arrTableFarmac[$rTMP["id"]]["ctg_far_dir"]              = $rTMP["ctg_far_dir"];
            $arrTableFarmac[$rTMP["id"]]["ctg_far_zona"]             = $rTMP["ctg_far_zona"];
            $arrTableFarmac[$rTMP["id"]]["ctg_far_dep"]              = $rTMP["ctg_far_dep"];
            $arrTableFarmac[$rTMP["id"]]["ctg_far_mun"]              = $rTMP["ctg_far_mun"];
            $arrTableFarmac[$rTMP["id"]]["ctg_far_tels"]             = $rTMP["ctg_far_tels"];
            $arrTableFarmac[$rTMP["id"]]["ctg_far_email"]            = $rTMP["ctg_far_email"];
            $arrTableFarmac[$rTMP["id"]]["ctg_far_enc_dpi"]          = $rTMP["ctg_far_enc_dpi"];
            $arrTableFarmac[$rTMP["id"]]["ctg_far_enc_nombre"]       = $rTMP["ctg_far_enc_nombre"];
            $arrTableFarmac[$rTMP["id"]]["ctg_far_enc_sexo"]         = $rTMP["ctg_far_enc_sexo"];
            $arrTableFarmac[$rTMP["id"]]["ctg_far_enc_edad"]         = $rTMP["ctg_far_enc_edad"];
            $arrTableFarmac[$rTMP["id"]]["ctg_far_enc_cel"]          = $rTMP["ctg_far_enc_cel"];
            $arrTableFarmac[$rTMP["id"]]["ctg_far_username"]         = $rTMP["ctg_far_username"];
            $arrTableFarmac[$rTMP["id"]]["ctg_far_pass"]             = $rTMP["ctg_far_pass"];
            $arrTableFarmac[$rTMP["id"]]["ctg_far_estatus"]          = $rTMP["ctg_far_estatus"];
            $arrTableFarmac[$rTMP["id"]]["ctg_far_censuc"]           = $rTMP["ctg_far_censuc"];
            $arrTableFarmac[$rTMP["id"]]["ctg_far_sol_dt"]           = $rTMP["ctg_far_sol_dt"];
            $arrTableFarmac[$rTMP["id"]]["ctg_far_aut_dt"]           = $rTMP["ctg_far_aut_dt"];
            $arrTableFarmac[$rTMP["id"]]["ctg_far_ven_dt"]           = $rTMP["ctg_far_ven_dt"];
            $arrTableFarmac[$rTMP["id"]]["ctg_far_sta"]              = $rTMP["ctg_far_sta"];
            $arrTableFarmac[$rTMP["id"]]["ctg_far_dt"]               = $rTMP["ctg_far_dt"];
            $arrTableFarmac[$rTMP["id"]]["ctg_far_usr"]              = $rTMP["ctg_far_usr"];
        }
        pg_free_result($sql);

    ?>
        <div class="col-md-12 tableFixHead">
            <table id="tableFarmac" class="table table-bordered table-striped table-hover table-sm">
                <thead>
                    <tr class="table-info">
                        <th>Farmacia</th>
                        <th>Sucursal</th>
                        <th>Direccion</th>
                        <th>Telefono</th>
                        <th>Medicamento</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (is_array($arrTableFarmac) && (count($arrTableFarmac) > 0)) {
                        reset($arrTableFarmac);
                        foreach ($arrTableFarmac as $rTMP['key'] => $rTMP['value']) {
                    ?>
                            <tr>
                                <td><?php echo  $rTMP["value"]['ctg_far_nomcom']; ?></td>
                                <td><?php echo  $rTMP["value"]['ctg_far_suc']; ?></td>
                                <td><?php echo  $rTMP["value"]['ctg_far_dir']; ?></td>
                                <td><?php echo  $rTMP["value"]['ctg_far_tels']; ?></td>
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

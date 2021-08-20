<?php
if (isset($_GET["validaciones"]) && !empty($_GET["validaciones"])) {
    require_once "../../data/conexion/tmlMed.php";
    $usuario = $_SESSION['adm_usr_code'];

    //TABLA DE INTERACCION
    $idUser = $_SESSION['adm_usr_code'];
    $tablaVacunas = "med" . $idUser . "dietas";

    $insert = 1;
    $update = 2;
    $delete = 3;

    $med_vac_id_ = isset($_POST["idDiet"]) ? $_POST["idDiet"]  : 0;
    $med_vac_nom_ = isset($_POST["nombre"]) ? $_POST["nombre"]  : '';
    $med_vac_des_ = isset($_POST["descripcion"]) ? $_POST["descripcion"]  : '';

    $rs = pg_query("SELECT id FROM $tablaVacunas ORDER BY id DESC LIMIT 1");
    if ($row = pg_fetch_array($rs)) {
        $idRow = trim($row[0]);
    }
    $idMax = isset($idRow) ? $idRow  : 0;
    $idMax = $idMax + 1;

    $status = 1;
    $fechaIng = date('Y-m-d H:i:s');

    $strTipoValidacion = isset($_REQUEST["validaciones"]) ? $_REQUEST["validaciones"] : '';
    if ($strTipoValidacion == "insert") {
        header('Content-Type: application/json');
        $var_consulta ="INSERT INTO $tablaVacunas(med_die_id,med_die_nom,med_die_des,med_die_sta,med_die_dt,med_die_usr,id) VALUES ($idMax,'$med_vac_nom_','$med_vac_des_','1','$fechaIng','$usuario',$idMax);";
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
        $var_consulta ="UPDATE $tablaVacunas 
                        SET med_die_nom = '$med_vac_nom_',
                            med_die_des = '$med_vac_des_',
                            med_die_sta = '2',
                            med_die_dt = '$fechaIng',
                            med_die_usr = '$usuario' 
                        WHERE id = $med_vac_id_;";
        $val = 1;
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
        $var_consulta = "DELETE FROM $tablaVacunas WHERE id = $med_vac_id_;";
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

    //DIBUJO DE TABLA PRODUCTOS CATEGORIAS
    else if ($strTipoValidacion == "busqueda_table") {
        $strSearch = isset($_POST["Search"]) ? $_POST["Search"]  : '';

        $strFilter = "";
        if (!empty($strSearch)) {
            $strFilter = " WHERE ( UPPER(med_die_nom) LIKE UPPER('%{$strSearch}%') ) ";
        }

        $med = $idUser;
        $numPac = "med" . $med . "dietas";
        $arrTableDiet = array();
        $var_consulta = "SELECT * FROM $numPac $strFilter ORDER BY med_die_nom ";
        $sql = pg_query($tmfMed, $var_consulta);
        $totalArticle = pg_num_rows($sql);


        while ($rTMP = pg_fetch_assoc($sql)) {

            $arrTableDiet[$rTMP["id"]]["id"]                       = $rTMP["id"];
            $arrTableDiet[$rTMP["id"]]["med_die_id"]               = $rTMP["med_die_id"];
            $arrTableDiet[$rTMP["id"]]["med_die_nom"]              = $rTMP["med_die_nom"];
            $arrTableDiet[$rTMP["id"]]["med_die_des"]              = $rTMP["med_die_des"];
            $arrTableDiet[$rTMP["id"]]["med_die_sta"]              = $rTMP["med_die_sta"];
            $arrTableDiet[$rTMP["id"]]["med_die_dt"]               = $rTMP["med_die_dt"];
            $arrTableDiet[$rTMP["id"]]["med_die_usr"]              = $rTMP["med_die_usr"];
        }
        pg_free_result($sql);

?>
        <div class="col-md-12 tableFixHead">
            <table id="tableVaccine" class="table table-bordered table-striped table-hover table-sm">
                <thead>
                    <tr class="table-info">
                        <th>ID</th>
                        <th>Nombre de la DIeta</th>
                        <th>Descripcion de la Dieta</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (is_array($arrTableDiet) && (count($arrTableDiet) > 0)) {
                        $intContador = 1;
                        reset($arrTableDiet);
                        foreach ($arrTableDiet as $rTMP['key'] => $rTMP['value']) {
                    ?>
                            <tr>
                                <td><?php echo  $rTMP["value"]['med_die_id']; ?></td>
                                <td><?php echo  $rTMP["value"]['med_die_nom']; ?></td>
                                <td><?php echo  $rTMP["value"]['med_die_des']; ?></td>
                                <td class="table-info">
                                    <i title="ver " class="fad fa-eye" style="cursor:pointer;" onclick="fntSelectView('<?php print $intContador; ?>');"></i>
                                    <i title="Eliminar " class="fad fa-user-minus" style="cursor:pointer;" onclick="fntSelectDelete('<?php print $intContador; ?>');"></i>
                                    <i title="Editar " class="fad fa-user-edit" style="cursor:pointer;" onclick="fntSelectEdit('<?php print $intContador; ?>');"></i>
                                </td>
                            </tr>
                            <input type="hidden" name="hidId_<?php print $intContador; ?>" id="hidId_<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['med_die_id']; ?>">
                            <input type="hidden" name="hidName_<?php print $intContador; ?>" id="hidName_<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['med_die_nom']; ?>">
                            <input type="hidden" name="hidDescrip_<?php print $intContador; ?>" id="hidDescrip_<?php print $intContador; ?>" value="<?php echo  $rTMP["value"]['med_die_des']; ?>">

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
    } else if ($strTipoValidacion == "validacion_nombre") {

        $intData = isset($_GET["nombre"]) ? intval($_GET["nombre"]) : "";

        $boolExiste = false;

        if ($intData) {

            $var_consulta = "SELECT * FROM $tablaVacunas WHERE med_vac_nom  = '$intData'";
            if (pg_query($rmfAdm, $var_consulta)) {
                $boolExiste = true;
            } else {
                echo "Error: " . $var_consulta . "<br>";
            }
        }

        $strTextoFinal = $boolExiste ? "Y" : "N";
        print $strTextoFinal;
        die();
    }

    die();
}


?>
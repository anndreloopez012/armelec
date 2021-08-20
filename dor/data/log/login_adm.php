<?php require_once "../../api/globalFunctions.php" ?>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<title>VisualMed.Online</title>
<link rel="icon" href="../../lib/dist/img/vmo_ICO.png" type="image/png" sizes="16x16">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<!-- Material Design Login Form -->
<ins class="adsbygoogle" style="display:inline-block;width:728px;height:90px" data-ad-client="ca-pub-5715866801509976" data-ad-slot="3213535644"></ins>
<script>
    (adsbygoogle = window.adsbygoogle || []).push({});
</script>

<hgroup>
    <img src="../../lib/dist/img/vmo_log_<?php echo $pais ?>.png" alt="logo" class="rounded mx-auto d-block" alt="Responsive image">
</hgroup>
<?php require_once "../../api/globalFunctions.php" ?>

<?php
require_once "../conexion/tmfAdm.php";
require_once "../conexion/tmlMed.php";
require_once "../conexion/tmlFar.php";
require_once "../conexion/tmfPac.php";
require_once "../conexion/tmfLaf.php";
session_start();
$username = isset($_POST['username']) ? $_POST['username']  : '';
$date = date("Y-m-d");
$dateA = date("Y");
$hora = date("h:i:sa");
$usuario  = 'adm';
$variableUsr = "";

if (isset($_POST['username'])) {
    //////////////////////////////TABLAS ANUALES ///////////////////////////////////
    $rsDate = pg_query($rmfAdm, "SELECT adm_cfg_last_date from adm_config");
    if ($row = pg_fetch_array($rsDate)) {
        $dateB = trim($row[0]);
    }

    $dateB = date('Y', strtotime($dateB));
    if ($dateB <> $dateA) {
        $variableId = $dateA;

        //////////////////////////MEDICOS//////////////////////////////////
        $val = 1;

        $tabla1 = "a" . $variableId . "medcitas";
        $llave1 = "a" . $variableId . "medcit_pkey";

        $sql = "CREATE TABLE IF NOT EXISTS {$tabla1}
        (
        id serial,
        med_cit_id integer NOT NULL, -- ID de la cita
        med_cit_cita_dt timestamp without time zone NOT NULL, -- fecha de cita
        med_cit_pac_id integer NOT NULL, -- ID interno del paciente
        med_cit_med_id integer NOT NULL, -- ID interno del medico
        med_cit_motivo text, -- motivo de la cita
        med_cit_estatus char(1), -- 0=programada 1=realizada 2=anulada
        med_cit_sta char(1), -- estatus del registro 1=creacion 2=edicion 3=borrado
        med_cit_dt timestamp without time zone, -- fecha de actualizacion
        med_cit_usr character varying(15), -- ID del usuario que actualiza
        CONSTRAINT {$llave1} PRIMARY KEY (med_cit_id, med_cit_cita_dt, med_cit_pac_id)
        );
        COMMENT ON COLUMN {$tabla1}.id IS 'id';
        COMMENT ON COLUMN {$tabla1}.med_cit_id IS 'ID de la cita';
        COMMENT ON COLUMN {$tabla1}.med_cit_cita_dt IS 'fecha de cita';
        COMMENT ON COLUMN {$tabla1}.med_cit_pac_id IS 'ID interno del paciente';
        COMMENT ON COLUMN {$tabla1}.med_cit_med_id IS 'ID interno del medico';
        COMMENT ON COLUMN {$tabla1}.med_cit_motivo IS 'motivo de la cita';
        COMMENT ON COLUMN {$tabla1}.med_cit_estatus IS '0=programada 1=realizada 2=anulada';
        COMMENT ON COLUMN {$tabla1}.med_cit_sta IS 'estatus del registro 1=creacion 2=edicion 3=borrado';
        COMMENT ON COLUMN {$tabla1}.med_cit_dt IS 'fecha de actualizacion';
        COMMENT ON COLUMN {$tabla1}.med_cit_usr IS 'ID del usuario que actualiza';
        ";

        if (pg_query($tmfMed, $sql)) {
            $arrInfo['status'] = $val;
        } else {
            $arrInfo['status'] = 0;
            $arrInfo['error'] = $sql;
        }
        //print_r('<br>');
        //print_r($sql);
        print json_encode($arrInfo);

        $tabla1 = "a" . $variableId . "medconsultas";
        $llave1 = "a" . $variableId . "medconsultas_pkey";

        $sql = "CREATE TABLE IF NOT EXISTS {$tabla1}
        (
        id serial,
        med_con_id integer NOT NULL, -- ID de la consulta
        med_con_pac_id integer NOT NULL, -- ID interno del paciente
        med_con_uni_id integer NOT NULL, -- ID de la unidad sanitaria
        med_con_enf_id integer NOT NULL, -- ID interno de la enfermedad
        med_pac_zona character varying(2),
        med_pac_dep character varying(5),
        med_pac_mun character varying(5),
        med_con_cita_dt timestamp without time zone NOT NULL, -- fecha de consulta
        med_con_motivo text, -- motivo de la consulta
        med_con_examen text, -- examen realizado
        med_con_receta text, -- descripcion de la receta
        med_con_dieta text, -- descripcion de la dieta
        med_con_observa text, -- observaciones
        med_con_citap_dt timestamp without time zone, -- fecha de proxima consulta
        med_con_sta char(1), -- estatus del registro 1=creacion 2=edicion 3=borrado
        med_con_dt timestamp without time zone, -- fecha de actualizacion
        med_con_usr character varying(15), -- ID del usuario que actualiza
        CONSTRAINT {$llave1} PRIMARY KEY (med_con_id)
        );
        COMMENT ON COLUMN {$tabla1}.id IS 'ID secuencial';
        COMMENT ON COLUMN {$tabla1}.med_con_id IS 'ID de la consulta';
        COMMENT ON COLUMN {$tabla1}.med_con_pac_id IS 'ID interno del paciente';
        COMMENT ON COLUMN {$tabla1}.med_con_uni_id IS 'ID de la unidad sanitaria';
        COMMENT ON COLUMN {$tabla1}.med_con_enf_id IS 'ID interno de la enfermedad';
        COMMENT ON COLUMN {$tabla1}.med_con_cita_dt IS 'fecha de consulta';
        COMMENT ON COLUMN {$tabla1}.med_con_motivo IS 'motivo de la consulta';
        COMMENT ON COLUMN {$tabla1}.med_con_examen IS 'examen realizado';
        COMMENT ON COLUMN {$tabla1}.med_con_receta IS 'descripcion de la receta';
        COMMENT ON COLUMN {$tabla1}.med_con_dieta IS 'descripcion de la dieta';
        COMMENT ON COLUMN {$tabla1}.med_con_observa IS 'observaciones';
        COMMENT ON COLUMN {$tabla1}.med_con_citap_dt IS 'fecha de proxima consulta';
        COMMENT ON COLUMN {$tabla1}.med_con_sta IS 'estatus del registro 1=creacion 2=edicion 3=borrado';
        COMMENT ON COLUMN {$tabla1}.med_con_dt IS 'fecha de actualizacion';
        COMMENT ON COLUMN {$tabla1}.med_con_usr IS 'ID del usuario que actualiza';
        ";

        if (pg_query($tmfMed, $sql)) {
            $arrInfo['status'] = $val;
        } else {
            $arrInfo['status'] = 0;
            $arrInfo['error'] = $sql;
        }
        //print_r('<br>');
        //print_r($sql);
        print json_encode($arrInfo);

        $tabla1 = "a" . $variableId . "medconsultas_examenes";
        $llave1 = "a" . $variableId . "medexa_pkey";

        $sql = "CREATE TABLE IF NOT EXISTS {$tabla1}
        (
        id serial,
        med_coe_id integer NOT NULL, -- Id de la consulta
        med_coe_lab_id character varying(32) NOT NULL, -- ID del laboratorio
        med_coe_lax_id character varying(32) NOT NULL, -- ID del examen
        med_coe_pre numeric(15,2) NOT NULL, -- precio
        med_coe_can integer, -- cantidad
        med_coe_desl numeric(10,2), -- descuento laboratorio
        med_coe_valor numeric(10,2), -- subtotal
        med_coe_sta char(1), -- estatus del registro 1=creacion 2=edicion 3=borrado
        med_coe_dt timestamp without time zone, -- fecha de actualizacion
        med_coe_usr character varying(15), -- ID del usuario que actualiza
        CONSTRAINT {$llave1} PRIMARY KEY (med_coe_id, med_coe_lab_id, med_coe_lax_id)
        );
        COMMENT ON COLUMN {$tabla1}.id IS 'ID secuencial';
        COMMENT ON COLUMN {$tabla1}.med_coe_id IS 'Id de la consulta';
        COMMENT ON COLUMN {$tabla1}.med_coe_lab_id IS 'ID del laboratorio';
        COMMENT ON COLUMN {$tabla1}.med_coe_lax_id IS 'ID del examen';
        COMMENT ON COLUMN {$tabla1}.med_coe_pre IS 'precio';
        COMMENT ON COLUMN {$tabla1}.med_coe_can IS 'cantidad';
        COMMENT ON COLUMN {$tabla1}.med_coe_desl IS 'descuento laboratorio';
        COMMENT ON COLUMN {$tabla1}.med_coe_valor IS 'subtotal';
        COMMENT ON COLUMN {$tabla1}.med_coe_sta IS 'estatus del registro 1=creacion 2=edicion 3=borrado';
        COMMENT ON COLUMN {$tabla1}.med_coe_dt IS 'fecha de actualizacion';
        COMMENT ON COLUMN {$tabla1}.med_coe_usr IS 'ID del usuario que actualiza';
        ";

        if (pg_query($tmfMed, $sql)) {
            $arrInfo['status'] = $val;
        } else {
            $arrInfo['status'] = 0;
            $arrInfo['error'] = $sql;
        }
        //print_r('<br>');
        //print_r($sql);
        print json_encode($arrInfo);

        $tabla1 = "a" . $variableId . "medconsultas_hospitales";
        $llave1 = "a" . $variableId . "medhos_pkey";

        $sql = "CREATE TABLE IF NOT EXISTS {$tabla1}
        (
        med_id serial,
        med_coh_id integer NOT NULL, -- Id de la consulta
        med_coh_hos_id character varying(8) NOT NULL, -- ID del laboratorio
        med_coh_ser_id character varying(32) NOT NULL, -- ID del examen
        med_coh_pre numeric(15,2) NOT NULL, -- precio
        med_coh_can integer, -- cantidad
        med_coh_desl numeric(10,2), -- descuento laboratorio
        med_coh_valor numeric(10,2), -- subtotal
        med_coh_sta char(1), -- estatus del registro 1=creacion 2=edicion 3=borrado
        med_coh_dt timestamp without time zone, -- fecha de actualizacion
        med_coh_usr character varying(15), -- ID del usuario que actualiza
        CONSTRAINT {$llave1} PRIMARY KEY (med_coh_id, med_coh_hos_id, med_coh_ser_id)
        );
        COMMENT ON COLUMN {$tabla1}.med_id IS 'Id secuencial';
        COMMENT ON COLUMN {$tabla1}.med_coh_id IS 'Id de la consulta';
        COMMENT ON COLUMN {$tabla1}.med_coh_hos_id IS 'ID del laboratorio';
        COMMENT ON COLUMN {$tabla1}.med_coh_ser_id IS 'ID del examen';
        COMMENT ON COLUMN {$tabla1}.med_coh_pre IS 'precio';
        COMMENT ON COLUMN {$tabla1}.med_coh_can IS 'cantidad';
        COMMENT ON COLUMN {$tabla1}.med_coh_desl IS 'descuento laboratorio';
        COMMENT ON COLUMN {$tabla1}.med_coh_valor IS 'subtotal';
        COMMENT ON COLUMN {$tabla1}.med_coh_sta IS 'estatus del registro 1=creacion 2=edicion 3=borrado';
        COMMENT ON COLUMN {$tabla1}.med_coh_dt IS 'fecha de actualizacion';
        COMMENT ON COLUMN {$tabla1}.med_coh_usr IS 'ID del usuario que actualiza';
        ";

        if (pg_query($tmfMed, $sql)) {
            $arrInfo['status'] = $val;
        } else {
            $arrInfo['status'] = 0;
            $arrInfo['error'] = $sql;
        }
        //print_r('<br>');
        //print_r($sql);
        print json_encode($arrInfo);

        $tabla1 = "a" . $variableId . "medconsultas_productos";
        $llave1 = "a" . $variableId . "medcop_pkey";

        $sql = "CREATE TABLE IF NOT EXISTS {$tabla1}
        (
        id serial,
        med_cop_id integer NOT NULL, -- Id de la consulta
        med_cop_far_id character varying(8) NOT NULL, -- ID de la farmacia
        med_cop_pro_id character varying(20) NOT NULL, -- ID del producto
        med_cop_pre numeric(15,2) NOT NULL, -- precio
        med_cop_can integer, -- cantidad
        med_cop_desf numeric(10,2), -- descuento farmacia
        med_cop_desl numeric(10,2), -- descuento laboratorio
        med_cop_valor numeric(10,2), -- subtotal
        med_cop_sta char(1), -- estatus del registro 1=creacion 2=edicion 3=borrado
        med_cop_dt timestamp without time zone, -- fecha de actualizacion
        med_cop_usr character varying(15), -- ID del usuario que actualiza
        CONSTRAINT {$llave1} PRIMARY KEY (med_cop_id, med_cop_far_id, med_cop_pro_id)
        );
        COMMENT ON COLUMN {$tabla1}.id IS 'Id secuencial';
        COMMENT ON COLUMN {$tabla1}.med_cop_id IS 'Id de la consulta';
        COMMENT ON COLUMN {$tabla1}.med_cop_far_id IS 'ID de la farmacia';
        COMMENT ON COLUMN {$tabla1}.med_cop_pro_id IS 'ID del producto';
        COMMENT ON COLUMN {$tabla1}.med_cop_pre IS 'precio';
        COMMENT ON COLUMN {$tabla1}.med_cop_can IS 'cantidad';
        COMMENT ON COLUMN {$tabla1}.med_cop_desf IS 'descuento farmacia';
        COMMENT ON COLUMN {$tabla1}.med_cop_desl IS 'descuento laboratorio';
        COMMENT ON COLUMN {$tabla1}.med_cop_valor IS 'subtotal';
        COMMENT ON COLUMN {$tabla1}.med_cop_sta IS 'estatus del registro 1=creacion 2=edicion 3=borrado';
        COMMENT ON COLUMN {$tabla1}.med_cop_dt IS 'fecha de actualizacion';
        COMMENT ON COLUMN {$tabla1}.med_cop_usr IS 'ID del usuario que actualiza';
        ";

        if (pg_query($tmfMed, $sql)) {
            $arrInfo['status'] = $val;
        } else {
            $arrInfo['status'] = 0;
            $arrInfo['error'] = $sql;
        }
        //print_r('<br>');
        //print_r($sql);
        print json_encode($arrInfo);

        $tabla1 = "a" . $variableId . "medconsultas_vacunas";
        $llave1 = "a" . $variableId . "medcov_pkey";

        $sql = "CREATE TABLE IF NOT EXISTS {$tabla1}
        (
        id serial,
        med_cov_id integer NOT NULL, -- Id de la consulta
        med_cov_vac_id character varying(10) NOT NULL, -- ID de la vacuna
        med_cov_dosis character varying(50) NOT NULL, -- dosis
        med_cov_obs text, -- observaciones
        med_cov_sta char(1), -- estatus del registro 1=creacion 2=edicion 3=borrado
        med_cov_dt timestamp without time zone, -- fecha de actualizacion
        med_cov_usr character varying(15), -- ID del usuario que actualiza
        med_cov_pre numeric(32,0),
        CONSTRAINT a2020medcov_pkey PRIMARY KEY (med_cov_id, med_cov_vac_id)
        );
        COMMENT ON COLUMN {$tabla1}.id IS 'Id secuencial';
        COMMENT ON COLUMN {$tabla1}.med_cov_id IS 'Id de la consulta';
        COMMENT ON COLUMN {$tabla1}.med_cov_vac_id IS 'ID de la vacuna';
        COMMENT ON COLUMN {$tabla1}.med_cov_dosis IS 'dosis';
        COMMENT ON COLUMN {$tabla1}.med_cov_obs IS 'observaciones';
        COMMENT ON COLUMN {$tabla1}.med_cov_sta IS 'estatus del registro 1=creacion 2=edicion 3=borrado';
        COMMENT ON COLUMN {$tabla1}.med_cov_dt IS 'fecha de actualizacion';
        COMMENT ON COLUMN {$tabla1}.med_cov_usr IS 'ID del usuario que actualiza';
        ";

        //////////////////////////FARMACIAS//////////////////////////////////

        $tabla1 = "a" . $variableId . "_farmacias_orden";
        $llave1 = "a" . $variableId . "far_ord_pkey";

        $sql = "CREATE TABLE IF NOT EXISTS {$tabla1}
        (
          far_ord_id serial,
          far_ord_cod integer NOT NULL, -- Id de orden de referencia
          far_ord_comcom character varying(100), -- Nombre comercial
          far_ord_far_id character varying(8) NOT NULL, -- Id de la sucursal
          far_ord_tipo character(1) NOT NULL, -- tipo de orden 1=medico 2=paciente 3=tienda
          far_ord_fec timestamp without time zone NOT NULL, -- fecha de orden
          far_ord_med_id character varying(8) NOT NULL, -- ID del medico
          far_ord_pac_id character varying(8) NOT NULL, -- ID del paciente
          far_ord_pac_nombre character varying(100) NOT NULL, -- Nombre del paciente
          far_ord_pac_mem_id character varying(20) NOT NULL, -- ID de la membresia
          far_ord_por_fac numeric(2,0), -- Porcentaje de descuento de la farmacia
          far_ord_por_laf numeric(2,0), -- Porcentaje de descuento del laboratorio farmaceutico
          far_ord_valor_desf numeric(12,2), -- Valor descuento farmacia
          far_ord_valor_desl numeric(12,2), -- valor descuento laboratorio
          far_ord_valor_iva numeric(12,2), -- valor iva
          far_ord_total numeric(12,2), -- valor total
          far_ord_est character(1), -- Estatus de la orden  1=emitida 2=entregada 3=anulada
          far_ord_sta character(1), -- estatus del registiro 1=creacion 2=edicion 3=borrado
          far_ord_dt timestamp without time zone, -- fecha de actualizacion
          far_ord_usr character varying(15), -- ID del usuario que actualiza
          far_ord_valor numeric(12,2), -- Valor total de la orden
          CONSTRAINT {$llave1} PRIMARY KEY (far_ord_cod, far_ord_tipo, far_ord_med_id, far_ord_pac_id)
        )
        WITH (
          OIDS=FALSE
        );
        ALTER TABLE public.a2021_farmacias_orden
          OWNER TO postgres;
        COMMENT ON COLUMN public.a2021_farmacias_orden.far_ord_id IS 'Id de orden secuencial';
        COMMENT ON COLUMN public.a2021_farmacias_orden.far_ord_cod IS 'Id de orden de referencia';
        COMMENT ON COLUMN public.a2021_farmacias_orden.far_ord_comcom IS 'Nombre comercial';
        COMMENT ON COLUMN public.a2021_farmacias_orden.far_ord_far_id IS 'Id de la sucursal';
        COMMENT ON COLUMN public.a2021_farmacias_orden.far_ord_tipo IS 'tipo de orden 1=medico 2=paciente 3=tienda';
        COMMENT ON COLUMN public.a2021_farmacias_orden.far_ord_fec IS 'fecha de orden';
        COMMENT ON COLUMN public.a2021_farmacias_orden.far_ord_med_id IS 'ID del medico';
        COMMENT ON COLUMN public.a2021_farmacias_orden.far_ord_pac_id IS 'ID del paciente';
        COMMENT ON COLUMN public.a2021_farmacias_orden.far_ord_pac_nombre IS 'Nombre del paciente';
        COMMENT ON COLUMN public.a2021_farmacias_orden.far_ord_pac_mem_id IS 'ID de la membresia';
        COMMENT ON COLUMN public.a2021_farmacias_orden.far_ord_por_fac IS 'Porcentaje de descuento de la farmacia';
        COMMENT ON COLUMN public.a2021_farmacias_orden.far_ord_por_laf IS 'Porcentaje de descuento del laboratorio farmaceutico';
        COMMENT ON COLUMN public.a2021_farmacias_orden.far_ord_valor_desf IS 'Valor descuento farmacia';
        COMMENT ON COLUMN public.a2021_farmacias_orden.far_ord_valor_desl IS 'valor descuento laboratorio';
        COMMENT ON COLUMN public.a2021_farmacias_orden.far_ord_valor_iva IS 'valor iva';
        COMMENT ON COLUMN public.a2021_farmacias_orden.far_ord_total IS 'valor total';
        COMMENT ON COLUMN public.a2021_farmacias_orden.far_ord_est IS 'Estatus de la orden  1=emitida 2=entregada 3=anulada';
        COMMENT ON COLUMN public.a2021_farmacias_orden.far_ord_sta IS 'estatus del registiro 1=creacion 2=edicion 3=borrado';
        COMMENT ON COLUMN public.a2021_farmacias_orden.far_ord_dt IS 'fecha de actualizacion';
        COMMENT ON COLUMN public.a2021_farmacias_orden.far_ord_usr IS 'ID del usuario que actualiza';
        COMMENT ON COLUMN public.a2021_farmacias_orden.far_ord_valor IS 'Valor total de la orden';";

        if (pg_query($tmfFar, $sql)) {
            $arrInfo['status'] = $val;
        } else {
            $arrInfo['status'] = 0;
            $arrInfo['error'] = $sql;
        }
        //print_r('<br>');
        //print_r($sql);
        print json_encode($arrInfo);


        $tabla1 = "a" . $variableId . "_farmacias_orden_prod";
        $llave1 = "a" . $variableId . "far_orp_pkey";
        $sql = "CREATE TABLE IF NOT EXISTS {$tabla1}
        (
          far_orp_id integer NOT NULL DEFAULT nextval('a2021_farmacias_orden_prod_far_orp_id_seq'::regclass),
          far_orp_cod integer NOT NULL, -- Id de orden de referencia
          far_orp_med_id character varying(8) NOT NULL, -- ID del medico
          far_orp_pac_id character varying(8) NOT NULL, -- ID del paciente
          far_orp_pro_id character varying(20) NOT NULL, -- ID del producto
          far_orp_pre numeric(15,2) NOT NULL, -- precio
          far_orp_can integer, -- cantidad
          far_orp_desf numeric(10,2), -- descuento farmacia
          far_orp_desl numeric(10,2), -- descuento laboratorio
          far_orp_valor numeric(10,2), -- subtotal
          far_orp_sta character(1), -- estatus del registro 1=creacion 2=edicion 3=borrado
          far_orp_dt timestamp without time zone, -- fecha de actualizacion
          far_orp_usr character varying(15), -- ID del usuario que actualiza
          CONSTRAINT {$llave1} PRIMARY KEY (far_orp_cod, far_orp_pro_id, far_orp_med_id, far_orp_pac_id)
        )
        WITH (
          OIDS=FALSE
        );
        ALTER TABLE public.a2021_farmacias_orden_prod
          OWNER TO postgres;
        COMMENT ON COLUMN public.a2021_farmacias_orden_prod.far_orp_cod IS 'Id de orden de referencia';
        COMMENT ON COLUMN public.a2021_farmacias_orden_prod.far_orp_med_id IS 'ID del medico';
        COMMENT ON COLUMN public.a2021_farmacias_orden_prod.far_orp_pac_id IS 'ID del paciente';
        COMMENT ON COLUMN public.a2021_farmacias_orden_prod.far_orp_pro_id IS 'ID del producto';
        COMMENT ON COLUMN public.a2021_farmacias_orden_prod.far_orp_pre IS 'precio';
        COMMENT ON COLUMN public.a2021_farmacias_orden_prod.far_orp_can IS 'cantidad';
        COMMENT ON COLUMN public.a2021_farmacias_orden_prod.far_orp_desf IS 'descuento farmacia';
        COMMENT ON COLUMN public.a2021_farmacias_orden_prod.far_orp_desl IS 'descuento laboratorio';
        COMMENT ON COLUMN public.a2021_farmacias_orden_prod.far_orp_valor IS 'subtotal';
        COMMENT ON COLUMN public.a2021_farmacias_orden_prod.far_orp_sta IS 'estatus del registro 1=creacion 2=edicion 3=borrado';
        COMMENT ON COLUMN public.a2021_farmacias_orden_prod.far_orp_dt IS 'fecha de actualizacion';
        COMMENT ON COLUMN public.a2021_farmacias_orden_prod.far_orp_usr IS 'ID del usuario que actualiza';
        ";

        if (pg_query($tmfFar, $sql)) {
            $arrInfo['status'] = $val;
        } else {
            $arrInfo['status'] = 0;
            $arrInfo['error'] = $sql;
        }
        //print_r('<br>');
        //print_r($sql);
        print json_encode($arrInfo);


        $tabla1 = "a" . $variableId . "_medicos_consultas";
        $llave1 = "a" . $variableId . "med_con_pkey";

        $sql = "CREATE TABLE IF NOT EXISTS {$tabla1}
         (
           id serial,
           med_con_id integer NOT NULL, -- ID de la consulta
           med_con_med_id character varying(8) NOT NULL, -- ID interno del medico
           med_con_pac_id character varying(8) NOT NULL, -- ID interno del paciente
           med_con_cita_dt timestamp without time zone NOT NULL, -- fecha de consulta
           med_con_motivo text, -- motivo de la consulta
           med_con_examen text, -- examen realizado
           med_con_receta text, -- descripcion de la receta
           med_con_dieta text, -- descripcion de la dieta
           med_con_observa text, -- observaciones
           med_con_uni_id integer, -- ID de la unidad sanitaria
           med_con_enf_id integer, -- ID interno de la enfermedad
           med_pac_zona character varying(2), -- zona del paciente
           med_pac_dep character varying(5), -- ID departamento del paciente
           med_pac_mun character varying(5), -- ID municipio del paciente
           med_con_citap_dt timestamp without time zone, -- fecha de proxima consulta
           med_con_sta char(1), -- estatus del registro 1=creacion 2=edicion 3=borrado
           med_con_dt timestamp without time zone, -- fecha de actualizacion
           med_con_usr character varying(15), -- ID del usuario que actualiza
           CONSTRAINT {$llave1} PRIMARY KEY (med_con_id, med_con_med_id, med_con_pac_id, med_con_cita_dt)
         );
         COMMENT ON COLUMN {$tabla1}.id IS 'ID secuencial';
         COMMENT ON COLUMN {$tabla1}.med_con_id IS 'ID de la consulta';
         COMMENT ON COLUMN {$tabla1}.med_con_med_id IS 'ID interno del medico';
         COMMENT ON COLUMN {$tabla1}.med_con_pac_id IS 'ID interno del paciente';
         COMMENT ON COLUMN {$tabla1}.med_con_cita_dt IS 'fecha de consulta';
         COMMENT ON COLUMN {$tabla1}.med_con_motivo IS 'motivo de la consulta';
         COMMENT ON COLUMN {$tabla1}.med_con_examen IS 'examen realizado';
         COMMENT ON COLUMN {$tabla1}.med_con_receta IS 'descripcion de la receta';
         COMMENT ON COLUMN {$tabla1}.med_con_dieta IS 'descripcion de la dieta';
         COMMENT ON COLUMN {$tabla1}.med_con_observa IS 'observaciones';
         COMMENT ON COLUMN {$tabla1}.med_con_uni_id IS 'ID de la unidad sanitaria';
         COMMENT ON COLUMN {$tabla1}.med_con_enf_id IS 'ID interno de la enfermedad';
         COMMENT ON COLUMN {$tabla1}.med_pac_zona IS 'zona del paciente';
         COMMENT ON COLUMN {$tabla1}.med_pac_dep IS 'ID departamento del paciente';
         COMMENT ON COLUMN {$tabla1}.med_pac_mun IS 'ID municipio del paciente';
         COMMENT ON COLUMN {$tabla1}.med_con_citap_dt IS 'fecha de proxima consulta';
         COMMENT ON COLUMN {$tabla1}.med_con_sta IS 'estatus del registro 1=creacion 2=edicion 3=borrado';
         COMMENT ON COLUMN {$tabla1}.med_con_dt IS 'fecha de actualizacion';
         COMMENT ON COLUMN {$tabla1}.med_con_usr IS 'ID del usuario que actualiza';
         ";

        if (pg_query($tmfFar, $sql)) {
            $arrInfo['status'] = $val;
        } else {
            $arrInfo['status'] = 0;
            $arrInfo['error'] = $sql;
        }
        //print_r('<br>');
        //print_r($sql);
        print json_encode($arrInfo);

        $tabla1 = "a" . $variableId . "_medicos_consultas_productos";
        $llave1 = "a" . $variableId . "med_cop_pkey";

        $sql = "CREATE TABLE IF NOT EXISTS {$tabla1}
         (
           med_id serial,
           med_cop_id integer NOT NULL, -- Id de la consulta de referencia
           med_cop_med_id character varying(8) NOT NULL, -- ID de la medico
           med_cop_pac_id character varying(8) NOT NULL, -- ID de la paciente
           med_cop_far_id character varying(8) NOT NULL, -- ID de la farmacia
           med_cop_pro_id character varying(20) NOT NULL, -- ID del producto
           med_cop_pre numeric(15,2) NOT NULL, -- precio
           med_cop_can integer, -- cantidad
           med_cop_desf numeric(10,2), -- descuento farmacia
           med_cop_desl numeric(10,2), -- descuento laboratorio
           med_cop_valor numeric(10,2), -- subtotal
           med_cop_sta char(1), -- estatus del registro 1=creacion 2=edicion 3=borrado
           med_cop_dt timestamp without time zone, -- fecha de actualizacion
           med_cop_usr character varying(15), -- ID del usuario que actualiza
           CONSTRAINT {$llave1} PRIMARY KEY (med_cop_med_id, med_cop_pac_id, med_cop_far_id, med_cop_pro_id)
         );
         COMMENT ON COLUMN {$tabla1}.med_id IS 'Id de la consulta secuencial';
         COMMENT ON COLUMN {$tabla1}.med_cop_id IS 'Id de la consulta de referencia';
         COMMENT ON COLUMN {$tabla1}.med_cop_med_id IS 'ID de la medico';
         COMMENT ON COLUMN {$tabla1}.med_cop_pac_id IS 'ID de la paciente';
         COMMENT ON COLUMN {$tabla1}.med_cop_far_id IS 'ID de la farmacia';
         COMMENT ON COLUMN {$tabla1}.med_cop_pro_id IS 'ID del producto';
         COMMENT ON COLUMN {$tabla1}.med_cop_pre IS 'precio';
         COMMENT ON COLUMN {$tabla1}.med_cop_can IS 'cantidad';
         COMMENT ON COLUMN {$tabla1}.med_cop_desf IS 'descuento farmacia';
         COMMENT ON COLUMN {$tabla1}.med_cop_desl IS 'descuento laboratorio';
         COMMENT ON COLUMN {$tabla1}.med_cop_valor IS 'subtotal';
         COMMENT ON COLUMN {$tabla1}.med_cop_sta IS 'estatus del registro 1=creacion 2=edicion 3=borrado';
         COMMENT ON COLUMN {$tabla1}.med_cop_dt IS 'fecha de actualizacion';
         COMMENT ON COLUMN {$tabla1}.med_cop_usr IS 'ID del usuario que actualiza';
         ";

        if (pg_query($tmfFar, $sql)) {
            $arrInfo['status'] = $val;
        } else {
            $arrInfo['status'] = 0;
            $arrInfo['error'] = $sql;
        }
        //print_r('<br>');
        //print_r($sql);
        print json_encode($arrInfo);

        //////////////////////////PACIENTES //////////////////////////////////

        $tabla1 = "a" . $variableId . "_citas";
        $llave1 = "a" . $variableId . "cit_pkey";

        $sql = "CREATE TABLE IF NOT EXISTS {$tabla1}
        (
        id serial,
        med_cit_id integer NOT NULL, -- ID de la cita
        med_cit_cita_dt timestamp without time zone NOT NULL, -- fecha de cita
        med_cit_med_id integer NOT NULL, -- ID interno del medico
        med_cit_pac_id integer NOT NULL, -- ID interno del paciente
        med_cit_motivo text, -- motivo de la cita
        med_cit_estatus char(1), -- 0=programada 1=realizada 2=anulada
        med_cit_sta char(1), -- estatus del registro 1=creacion 2=edicion 3=borrado
        med_cit_dt timestamp without time zone, -- fecha de actualizacion
        med_cit_usr character varying(15), -- ID del usuario que actualiza
        CONSTRAINT {$llave1} PRIMARY KEY (ctg_cit_id, ctg_cit_cita_dt, ctg_cit_pac_id)
        );
        COMMENT ON COLUMN {$tabla1}.id IS 'id';
        COMMENT ON COLUMN {$tabla1}.med_cit_id IS 'ID de la cita';
        COMMENT ON COLUMN {$tabla1}.med_cit_cita_dt IS 'fecha de cita';
        COMMENT ON COLUMN {$tabla1}.med_cit_med_id IS 'ID interno del medico';
        COMMENT ON COLUMN {$tabla1}.med_cit_pac_id IS 'ID interno del paciente';
        COMMENT ON COLUMN {$tabla1}.med_cit_motivo IS 'motivo de la cita';
        COMMENT ON COLUMN {$tabla1}.med_cit_estatus IS '0=programada 1=realizada 2=anulada';
        COMMENT ON COLUMN {$tabla1}.med_cit_sta IS 'estatus del registro 1=creacion 2=edicion 3=borrado';
        COMMENT ON COLUMN {$tabla1}.med_cit_dt IS 'fecha de actualizacion';
        COMMENT ON COLUMN {$tabla1}.med_cit_usr IS 'ID del usuario que actualiza';
        ";

        if (pg_query($tmfPac, $sql)) {
            $arrInfo['status'] = $val;
        } else {
            $arrInfo['status'] = 0;
            $arrInfo['error'] = $sql;
        }
        //print_r('<br>');
        //print_r($sql);
        print json_encode($arrInfo);

        $tabla1 = "a" . $variableId . "_farmacias_orden";
        $llave1 = "a" . $variableId . "pacfar_ord_pkey";

        $sql = "CREATE TABLE IF NOT EXISTS {$tabla1}
        (
        far_ord_id serial,
        far_ord_cod integer NOT NULL, -- Id de orden de referencia
        far_ord_comcom character varying(100), -- Nombre comercial
        far_ord_far_id character varying(8) NOT NULL, -- Id de la sucursal
        far_ord_tipo char(1) NOT NULL, -- tipo de orden 1=medico 2=paciente 3=tienda
        far_ord_fec timestamp without time zone NOT NULL, -- fecha de orden
        far_ord_med_id character varying(8) NOT NULL, -- ID del medico
        far_ord_pac_id character varying(8) NOT NULL, -- ID del paciente
        far_ord_pac_nombre character varying(100) NOT NULL, -- Nombre del paciente
        far_ord_pac_mem_id character varying(20) NOT NULL, -- ID de la membresia
        far_ord_por_fac numeric(2,0), -- Porcentaje de descuento de la farmacia
        far_ord_por_laf numeric(2,0), -- Porcentaje de descuento del laboratorio farmaceutico
        far_ord_valor numeric(15,2), -- Valor total de la orden
        far_ord_valor_desf numeric(15,2), -- Valor descuento farmacia
        far_ord_valor_desl numeric(15,2), -- valor descuento laboratorio
        far_ord_valor_iva numeric(15,2), -- valor iva
        far_ord_total numeric(15,2), -- valor total
        far_ord_est char(1), -- Estatus de la orden  1=emitida 2=entregada 3=anulada
        far_ord_sta char(1), -- estatus del registiro 1=creacion 2=edicion 3=borrado
        far_ord_dt timestamp without time zone, -- fecha de actualizacion
        far_ord_usr character varying(15), -- ID del usuario que actualiza
        CONSTRAINT {$llave1} PRIMARY KEY (far_ord_cod, far_ord_tipo, far_ord_med_id, far_ord_pac_id)
        );
        COMMENT ON COLUMN {$tabla1}.far_ord_id IS 'Id de orden secuencial';
        COMMENT ON COLUMN {$tabla1}.far_ord_cod IS 'Id de orden de referencia';
        COMMENT ON COLUMN {$tabla1}.far_ord_comcom IS 'Nombre comercial';
        COMMENT ON COLUMN {$tabla1}.far_ord_far_id IS 'Id de la sucursal';
        COMMENT ON COLUMN {$tabla1}.far_ord_tipo IS 'tipo de orden 1=medico 2=paciente 3=tienda';
        COMMENT ON COLUMN {$tabla1}.far_ord_fec IS 'fecha de orden';
        COMMENT ON COLUMN {$tabla1}.far_ord_med_id IS 'ID del medico';
        COMMENT ON COLUMN {$tabla1}.far_ord_pac_id IS 'ID del paciente';
        COMMENT ON COLUMN {$tabla1}.far_ord_pac_nombre IS 'Nombre del paciente';
        COMMENT ON COLUMN {$tabla1}.far_ord_pac_mem_id IS 'ID de la membresia';
        COMMENT ON COLUMN {$tabla1}.far_ord_por_fac IS 'Porcentaje de descuento de la farmacia';
        COMMENT ON COLUMN {$tabla1}.far_ord_por_laf IS 'Porcentaje de descuento del laboratorio farmaceutico';
        COMMENT ON COLUMN {$tabla1}.far_ord_valor IS 'Valor total de la orden';
        COMMENT ON COLUMN {$tabla1}.far_ord_valor_desf IS 'Valor descuento farmacia';
        COMMENT ON COLUMN {$tabla1}.far_ord_valor_desl IS 'valor descuento laboratorio';
        COMMENT ON COLUMN {$tabla1}.far_ord_valor_iva IS 'valor iva';
        COMMENT ON COLUMN {$tabla1}.far_ord_total IS 'valor total';
        COMMENT ON COLUMN {$tabla1}.far_ord_est IS 'Estatus de la orden  1=emitida 2=entregada 3=anulada';
        COMMENT ON COLUMN {$tabla1}.far_ord_sta IS 'estatus del registiro 1=creacion 2=edicion 3=borrado';
        COMMENT ON COLUMN {$tabla1}.far_ord_dt IS 'fecha de actualizacion';
        COMMENT ON COLUMN {$tabla1}.far_ord_usr IS 'ID del usuario que actualiza';
        ";

        if (pg_query($tmfPac, $sql)) {
            $arrInfo['status'] = $val;
        } else {
            $arrInfo['status'] = 0;
            $arrInfo['error'] = $sql;
        }
        //print_r('<br>');
        //print_r($sql);
        print json_encode($arrInfo);

        $tabla1 = "a" . $variableId . "_farmacias_orden_prod";
        $llave1 = "a" . $variableId . "far_orp_pkey";

        $sql = "CREATE TABLE IF NOT EXISTS {$tabla1}
        (
        far_orp_id serial,
        far_orp_cod integer NOT NULL, -- Id de orden de referencia
        far_orp_med_id character varying(8) NOT NULL, -- ID del medico
        far_orp_pac_id character varying(8) NOT NULL, -- ID del paciente
        far_orp_pro_id character varying(20) NOT NULL, -- ID del producto
        far_orp_pre numeric(15,2) NOT NULL, -- precio
        far_orp_can integer, -- cantidad
        far_orp_desf numeric(10,2), -- descuento farmacia
        far_orp_desl numeric(10,2), -- descuento laboratorio
        far_orp_valor numeric(10,2), -- subtotal
        far_orp_sta char(1), -- estatus del registro 1=creacion 2=edicion 3=borrado
        far_orp_dt timestamp without time zone, -- fecha de actualizacion
        far_orp_usr character varying(15), -- ID del usuario que actualiza
        CONSTRAINT {$llave1} PRIMARY KEY (far_orp_cod, far_orp_pro_id, far_orp_med_id, far_orp_pac_id)
        );
        COMMENT ON COLUMN {$tabla1}.far_orp_cod IS 'Id de orden de referencia';
        COMMENT ON COLUMN {$tabla1}.far_orp_med_id IS 'ID del medico';
        COMMENT ON COLUMN {$tabla1}.far_orp_pac_id IS 'ID del paciente';
        COMMENT ON COLUMN {$tabla1}.far_orp_pro_id IS 'ID del producto';
        COMMENT ON COLUMN {$tabla1}.far_orp_pre IS 'precio';
        COMMENT ON COLUMN {$tabla1}.far_orp_can IS 'cantidad';
        COMMENT ON COLUMN {$tabla1}.far_orp_desf IS 'descuento farmacia';
        COMMENT ON COLUMN {$tabla1}.far_orp_desl IS 'descuento laboratorio';
        COMMENT ON COLUMN {$tabla1}.far_orp_valor IS 'subtotal';
        COMMENT ON COLUMN {$tabla1}.far_orp_sta IS 'estatus del registro 1=creacion 2=edicion 3=borrado';
        COMMENT ON COLUMN {$tabla1}.far_orp_dt IS 'fecha de actualizacion';
        COMMENT ON COLUMN {$tabla1}.far_orp_usr IS 'ID del usuario que actualiza';
        ";

        if (pg_query($tmfPac, $sql)) {
            $arrInfo['status'] = $val;
        } else {
            $arrInfo['status'] = 0;
            $arrInfo['error'] = $sql;
        }
        //print_r('<br>');
        //print_r($sql);
        print json_encode($arrInfo);

        $tabla1 = "a" . $variableId . "_hospitales_orden";
        $llave1 = "a" . $variableId . "hos_ord_pkey";

        $sql = "CREATE TABLE IF NOT EXISTS {$tabla1}
        (
        hos_ord_id serial,
        hos_ord_cod integer NOT NULL, -- Id de orden de referencia
        hos_ord_nomcom character varying(100), -- Nombre comercial
        hos_ord_hos_id character varying(8) NOT NULL, -- Id del hospital
        hos_ord_pac_id character varying(8) NOT NULL, -- Id de paciente
        hos_ord_tipo char(1) NOT NULL, -- 1=orden del medico 2=orden de paciente 3=orden en tienda
        hos_ord_med_id character varying(8), -- ID del medico
        hos_ord_fec timestamp without time zone NOT NULL, -- fecha de orden
        hos_ord_pac_nombre character varying(100) NOT NULL, -- Nombre del paciente
        hos_ord_por_lab numeric(2,0), -- Porcentaje de descuento del laboratorio clinico
        hos_ord_valor numeric(15,2), -- Valor total de la orden
        hos_ord_valor_desh numeric(15,2), -- valor descuento hospital
        hos_ord_valor_iva numeric(15,2), -- valor iva
        hos_ord_total numeric(15,2), -- valor total
        hos_ord_est char(1), -- Estatus de la orden  1=emitida 2=entregada 3=anulada
        hos_ord_sta char(1), -- estatus del registiro 1=creacion 2=edicion 3=borrado
        hos_ord_dt timestamp without time zone, -- fecha de actualizacion
        hos_ord_usr character varying(15), -- ID del usuario que actualiza
        CONSTRAINT {$llave1} PRIMARY KEY (hos_ord_cod, hos_ord_hos_id, hos_ord_pac_id, hos_ord_tipo)
        );
        COMMENT ON COLUMN {$tabla1}.hos_ord_id IS 'Id de orden secuencial';
        COMMENT ON COLUMN {$tabla1}.hos_ord_cod IS 'Id de orden de referencia';
        COMMENT ON COLUMN {$tabla1}.hos_ord_nomcom IS 'Nombre comercial';
        COMMENT ON COLUMN {$tabla1}.hos_ord_hos_id IS 'Id del hospital';
        COMMENT ON COLUMN {$tabla1}.hos_ord_pac_id IS 'Id de paciente';
        COMMENT ON COLUMN {$tabla1}.hos_ord_tipo IS '1=orden del medico 2=orden de paciente 3=orden en tienda';
        COMMENT ON COLUMN {$tabla1}.hos_ord_med_id IS 'ID del medico';
        COMMENT ON COLUMN {$tabla1}.hos_ord_fec IS 'fecha de orden';
        COMMENT ON COLUMN {$tabla1}.hos_ord_pac_nombre IS 'Nombre del paciente';
        COMMENT ON COLUMN {$tabla1}.hos_ord_por_lab IS 'Porcentaje de descuento del laboratorio clinico';
        COMMENT ON COLUMN {$tabla1}.hos_ord_valor IS 'Valor total de la orden';
        COMMENT ON COLUMN {$tabla1}.hos_ord_valor_desh IS 'valor descuento hospital';
        COMMENT ON COLUMN {$tabla1}.hos_ord_valor_iva IS 'valor iva';
        COMMENT ON COLUMN {$tabla1}.hos_ord_total IS 'valor total';
        COMMENT ON COLUMN {$tabla1}.hos_ord_est IS 'Estatus de la orden  1=emitida 2=entregada 3=anulada';
        COMMENT ON COLUMN {$tabla1}.hos_ord_sta IS 'estatus del registiro 1=creacion 2=edicion 3=borrado';
        COMMENT ON COLUMN {$tabla1}.hos_ord_dt IS 'fecha de actualizacion';
        COMMENT ON COLUMN {$tabla1}.hos_ord_usr IS 'ID del usuario que actualiza';
        ";

        if (pg_query($tmfPac, $sql)) {
            $arrInfo['status'] = $val;
        } else {
            $arrInfo['status'] = 0;
            $arrInfo['error'] = $sql;
        }
        //print_r('<br>');
        //print_r($sql);
        print json_encode($arrInfo);

        $tabla1 = "a" . $variableId . "_hospitales_orden_items";
        $llave1 = "a" . $variableId . "hos_ori_pkey";

        $sql = "CREATE TABLE IF NOT EXISTS {$tabla1}
        (
        hos_ori_id serial,
        hos_ori_cod integer NOT NULL, -- Id de orden de referencia
        hos_ori_tipo char(1) NOT NULL,
        hos_ori_hos_id character varying(8) NOT NULL,
        hos_ori_pac_id character varying(8) NOT NULL,
        hos_ori_med_id character varying(8),
        hos_ori_gpo_id character varying(10) NOT NULL, -- ID del grupo de items
        hos_ori_ser_id character varying(10) NOT NULL, -- ID del item
        hos_ori_pre numeric(15,2) NOT NULL, -- precio
        hos_ori_can integer, -- cantidad
        hos_ori_desh numeric(10,2), -- descuento hospital
        hos_ori_valor numeric(10,2), -- subtotal
        hos_ori_sta char(1), -- estatus del registro 1=creacion 2=edicion 3=borrado
        hos_ori_dt timestamp without time zone, -- fecha de actualizacion
        hos_ori_usr character varying(15), -- ID del usuario que actualiza
        CONSTRAINT {$llave1} PRIMARY KEY (hos_ori_cod, hos_ori_tipo, hos_ori_hos_id, hos_ori_pac_id, hos_ori_gpo_id, hos_ori_ser_id)
        );
        COMMENT ON COLUMN {$tabla1}.hos_ori_id IS 'Id de orden secuencial';
        COMMENT ON COLUMN {$tabla1}.hos_ori_cod IS 'Id de orden de referencia';
        COMMENT ON COLUMN {$tabla1}.hos_ori_gpo_id IS 'ID del grupo de items';
        COMMENT ON COLUMN {$tabla1}.hos_ori_ser_id IS 'ID del item';
        COMMENT ON COLUMN {$tabla1}.hos_ori_pre IS 'precio';
        COMMENT ON COLUMN {$tabla1}.hos_ori_can IS 'cantidad';
        COMMENT ON COLUMN {$tabla1}.hos_ori_desh IS 'descuento hospital';
        COMMENT ON COLUMN {$tabla1}.hos_ori_valor IS 'subtotal';
        COMMENT ON COLUMN {$tabla1}.hos_ori_sta IS 'estatus del registro 1=creacion 2=edicion 3=borrado';
        COMMENT ON COLUMN {$tabla1}.hos_ori_dt IS 'fecha de actualizacion';
        COMMENT ON COLUMN {$tabla1}.hos_ori_usr IS 'ID del usuario que actualiza';
        ";

        if (pg_query($tmfPac, $sql)) {
            $arrInfo['status'] = $val;
        } else {
            $arrInfo['status'] = 0;
            $arrInfo['error'] = $sql;
        }
        //print_r('<br>');
        //print_r($sql);
        print json_encode($arrInfo);

        $tabla1 = "a" . $variableId . "_labclinicos_orden";
        $llave1 = "a" . $variableId . "lab_ord_pkey";

        $sql = "CREATE TABLE IF NOT EXISTS {$tabla1}
        (
        lab_ord_id serial,
        lab_ord_cod integer NOT NULL, -- Id de orden
        lab_ord_nomcom character varying(100), -- Nombre comercial
        lab_ord_lab_id character varying(8) NOT NULL, -- Id del laboratorio clinico
        lab_ord_tipo char(1) NOT NULL, -- 1=orden del medico 2=orden de paciente 3=orden en tienda
        lab_ord_pac_id character varying(20) NOT NULL, -- ID del paciente
        lab_ord_med_id character varying(8) NOT NULL, -- ID del medico
        lab_ord_fec timestamp without time zone NOT NULL, -- fecha de orden
        lab_ord_pac_nombre character varying(100) NOT NULL, -- Nombre del paciente
        lab_ord_pac_mem_id character varying(20), -- ID de la membresia
        lab_ord_por_lab numeric(2,0), -- Porcentaje de descuento del laboratorio clinico
        lab_ord_valor numeric(15,2), -- Valor total de la orden
        lab_ord_valor_desl numeric(15,2), -- valor descuento laboratorio
        lab_ord_valor_iva numeric(15,2), -- valor iva
        lab_ord_total numeric(15,2), -- valor total
        lab_ord_est char(1), -- Estatus de la orden  1=emitida 2=entregada 3=anulada
        lab_ord_sta char(1), -- estatus del registiro 1=creacion 2=edicion 3=borrado
        lab_ord_dt timestamp without time zone, -- fecha de actualizacion
        lab_ord_usr character varying(15), -- ID del usuario que actualiza
        CONSTRAINT {$llave1} PRIMARY KEY (lab_ord_cod, lab_ord_tipo, lab_ord_pac_id)
        );
        COMMENT ON COLUMN {$tabla1}.lab_ord_id IS 'Id de orden secuencial';
        COMMENT ON COLUMN {$tabla1}.lab_ord_cod IS 'Id de orden';
        COMMENT ON COLUMN {$tabla1}.lab_ord_nomcom IS 'Nombre comercial';
        COMMENT ON COLUMN {$tabla1}.lab_ord_lab_id IS 'Id del laboratorio clinico';
        COMMENT ON COLUMN {$tabla1}.lab_ord_tipo IS '1=orden del medico 2=orden de paciente 3=orden en tienda';
        COMMENT ON COLUMN {$tabla1}.lab_ord_pac_id IS 'ID del paciente';
        COMMENT ON COLUMN {$tabla1}.lab_ord_med_id IS 'ID del medico';
        COMMENT ON COLUMN {$tabla1}.lab_ord_fec IS 'fecha de orden';
        COMMENT ON COLUMN {$tabla1}.lab_ord_pac_nombre IS 'Nombre del paciente';
        COMMENT ON COLUMN {$tabla1}.lab_ord_pac_mem_id IS 'ID de la membresia';
        COMMENT ON COLUMN {$tabla1}.lab_ord_por_lab IS 'Porcentaje de descuento del laboratorio clinico';
        COMMENT ON COLUMN {$tabla1}.lab_ord_valor IS 'Valor total de la orden';
        COMMENT ON COLUMN {$tabla1}.lab_ord_valor_desl IS 'valor descuento laboratorio';
        COMMENT ON COLUMN {$tabla1}.lab_ord_valor_iva IS 'valor iva';
        COMMENT ON COLUMN {$tabla1}.lab_ord_total IS 'valor total';
        COMMENT ON COLUMN {$tabla1}.lab_ord_est IS 'Estatus de la orden  1=emitida 2=entregada 3=anulada';
        COMMENT ON COLUMN {$tabla1}.lab_ord_sta IS 'estatus del registiro 1=creacion 2=edicion 3=borrado';
        COMMENT ON COLUMN {$tabla1}.lab_ord_dt IS 'fecha de actualizacion';
        COMMENT ON COLUMN {$tabla1}.lab_ord_usr IS 'ID del usuario que actualiza';
        ";

        if (pg_query($tmfPac, $sql)) {
            $arrInfo['status'] = $val;
        } else {
            $arrInfo['status'] = 0;
            $arrInfo['error'] = $sql;
        }
        //print_r('<br>');
        //print_r($sql);
        print json_encode($arrInfo);

        $tabla1 = "a" . $variableId . "_labclinicos_orden_items";
        $llave1 = "a" . $variableId . "lab_ori_pkey";

        $sql = "CREATE TABLE IF NOT EXISTS {$tabla1}
        (
        lab_ori_id serial,
        lab_ori_cod integer NOT NULL, -- Id de orden de referencia
        lab_ori_tipo char(1) NOT NULL, -- 1=orden del medico 2=orden de internet 3=orden en tienda
        lab_ori_pac_id character varying(8) NOT NULL, -- ID del paciente
        lab_ori_med_id character varying(8) NOT NULL, -- ID del medico
        lab_ori_gpo_id character varying(10) NOT NULL, -- ID del laboratorio
        lab_ori_exa_id character varying(10) NOT NULL, -- ID del item
        lab_ori_pre numeric(15,2) NOT NULL, -- precio
        lab_ori_can integer, -- cantidad
        lab_ori_desl numeric(10,2), -- descuento laboratorio
        lab_ori_valor numeric(10,2), -- subtotal
        lab_ori_exa_dt timestamp without time zone, -- fecha de realizacion del examen
        lab_ori_exa_ranmin character varying(100), -- rango minimo
        lab_ori_exa_ranmax character varying(100), -- rango maximo
        lab_ori_exa_res character varying(100), -- resultado del examen
        lab_ori_sta char(1), -- estatus del registro 1=creacion 2=edicion 3=borrado
        lab_ori_dt timestamp without time zone, -- fecha de actualizacion
        lab_ori_usr character varying(15), -- ID del usuario que actualiza
        CONSTRAINT {$llave1} PRIMARY KEY (lab_ori_cod, lab_ori_gpo_id, lab_ori_exa_id)
        );
        COMMENT ON COLUMN {$tabla1}.lab_ori_id IS 'Id de orden secuencial';
        COMMENT ON COLUMN {$tabla1}.lab_ori_cod IS 'Id de orden de referencia';
        COMMENT ON COLUMN {$tabla1}.lab_ori_tipo IS '1=orden del medico 2=orden de internet 3=orden en tienda';
        COMMENT ON COLUMN {$tabla1}.lab_ori_pac_id IS 'ID del paciente';
        COMMENT ON COLUMN {$tabla1}.lab_ori_med_id IS 'ID del medico';
        COMMENT ON COLUMN {$tabla1}.lab_ori_gpo_id IS 'ID del laboratorio';
        COMMENT ON COLUMN {$tabla1}.lab_ori_exa_id IS 'ID del item';
        COMMENT ON COLUMN {$tabla1}.lab_ori_pre IS 'precio';
        COMMENT ON COLUMN {$tabla1}.lab_ori_can IS 'cantidad';
        COMMENT ON COLUMN {$tabla1}.lab_ori_desl IS 'descuento laboratorio';
        COMMENT ON COLUMN {$tabla1}.lab_ori_valor IS 'subtotal';
        COMMENT ON COLUMN {$tabla1}.lab_ori_exa_dt IS 'fecha de realizacion del examen';
        COMMENT ON COLUMN {$tabla1}.lab_ori_exa_ranmin IS 'rango minimo';
        COMMENT ON COLUMN {$tabla1}.lab_ori_exa_ranmax IS 'rango maximo';
        COMMENT ON COLUMN {$tabla1}.lab_ori_exa_res IS 'resultado del examen';
        COMMENT ON COLUMN {$tabla1}.lab_ori_sta IS 'estatus del registro 1=creacion 2=edicion 3=borrado';
        COMMENT ON COLUMN {$tabla1}.lab_ori_dt IS 'fecha de actualizacion';
        COMMENT ON COLUMN {$tabla1}.lab_ori_usr IS 'ID del usuario que actualiza';
        ";

        if (pg_query($tmfPac, $sql)) {
            $arrInfo['status'] = $val;
        } else {
            $arrInfo['status'] = 0;
            $arrInfo['error'] = $sql;
        }
        //print_r('<br>');
        //print_r($sql);
        print json_encode($arrInfo);

        $tabla1 = "a" . $variableId . "_medicos_consultas";
        $llave1 = "a" . $variableId . "med_con_pkey";

        $sql = "CREATE TABLE IF NOT EXISTS {$tabla1}
        (
        id serial,
        med_con_id integer NOT NULL, -- ID de la consulta
        med_con_med_id character varying(8) NOT NULL, -- ID interno del medico
        med_con_pac_id character varying(8) NOT NULL, -- ID interno del paciente
        med_con_cita_dt timestamp without time zone NOT NULL, -- fecha de consulta
        med_con_motivo text, -- motivo de la consulta
        med_con_examen text, -- examen realizado
        med_con_receta text, -- descripcion de la receta
        med_con_dieta text, -- descripcion de la dieta
        med_con_observa text, -- observaciones
        med_con_uni_id integer, -- ID de la unidad sanitaria
        med_con_enf_id integer, -- ID interno de la enfermedad
        med_pac_zona character varying(2), -- zona del paciente
        med_pac_dep character varying(5), -- ID departamento del paciente
        med_pac_mun character varying(5), -- ID municipio del paciente
        med_con_citap_dt timestamp without time zone, -- fecha de proxima consulta
        med_con_sta char(1), -- estatus del registro 1=creacion 2=edicion 3=borrado
        med_con_dt timestamp without time zone, -- fecha de actualizacion
        med_con_usr character varying(15), -- ID del usuario que actualiza
        CONSTRAINT {$llave1} PRIMARY KEY (med_con_id, med_con_med_id, med_con_pac_id, med_con_cita_dt)
        );
        COMMENT ON COLUMN {$tabla1}.id IS 'ID secuencial';
        COMMENT ON COLUMN {$tabla1}.med_con_id IS 'ID de la consulta';
        COMMENT ON COLUMN {$tabla1}.med_con_med_id IS 'ID interno del medico';
        COMMENT ON COLUMN {$tabla1}.med_con_pac_id IS 'ID interno del paciente';
        COMMENT ON COLUMN {$tabla1}.med_con_cita_dt IS 'fecha de consulta';
        COMMENT ON COLUMN {$tabla1}.med_con_motivo IS 'motivo de la consulta';
        COMMENT ON COLUMN {$tabla1}.med_con_examen IS 'examen realizado';
        COMMENT ON COLUMN {$tabla1}.med_con_receta IS 'descripcion de la receta';
        COMMENT ON COLUMN {$tabla1}.med_con_dieta IS 'descripcion de la dieta';
        COMMENT ON COLUMN {$tabla1}.med_con_observa IS 'observaciones';
        COMMENT ON COLUMN {$tabla1}.med_con_uni_id IS 'ID de la unidad sanitaria';
        COMMENT ON COLUMN {$tabla1}.med_con_enf_id IS 'ID interno de la enfermedad';
        COMMENT ON COLUMN {$tabla1}.med_pac_zona IS 'zona del paciente';
        COMMENT ON COLUMN {$tabla1}.med_pac_dep IS 'ID departamento del paciente';
        COMMENT ON COLUMN {$tabla1}.med_pac_mun IS 'ID municipio del paciente';
        COMMENT ON COLUMN {$tabla1}.med_con_citap_dt IS 'fecha de proxima consulta';
        COMMENT ON COLUMN {$tabla1}.med_con_sta IS 'estatus del registro 1=creacion 2=edicion 3=borrado';
        COMMENT ON COLUMN {$tabla1}.med_con_dt IS 'fecha de actualizacion';
        COMMENT ON COLUMN {$tabla1}.med_con_usr IS 'ID del usuario que actualiza';
        ";

        if (pg_query($tmfPac, $sql)) {
            $arrInfo['status'] = $val;
        } else {
            $arrInfo['status'] = 0;
            $arrInfo['error'] = $sql;
        }
        //print_r('<br>');
        //print_r($sql);
        print json_encode($arrInfo);

        $tabla1 = "a" . $variableId . "_medicos_consultas_productos";
        $llave1 = "a" . $variableId . "med_cop_pkey";

        $sql = "CREATE TABLE IF NOT EXISTS {$tabla1}
        (
        med_id serial,
        med_cop_id integer NOT NULL, -- Id de la consulta de referencia
        med_cop_med_id character varying(8) NOT NULL, -- ID de la medico
        med_cop_pac_id character varying(8) NOT NULL, -- ID de la paciente
        med_cop_far_id character varying(8) NOT NULL, -- ID de la farmacia
        med_cop_pro_id character varying(20) NOT NULL, -- ID del producto
        med_cop_pre numeric(15,2) NOT NULL, -- precio
        med_cop_can integer, -- cantidad
        med_cop_desf numeric(10,2), -- descuento farmacia
        med_cop_desl numeric(10,2), -- descuento laboratorio
        med_cop_valor numeric(10,2), -- subtotal
        med_cop_sta char(1), -- estatus del registro 1=creacion 2=edicion 3=borrado
        med_cop_dt timestamp without time zone, -- fecha de actualizacion
        med_cop_usr character varying(15), -- ID del usuario que actualiza
        CONSTRAINT {$llave1} PRIMARY KEY (med_cop_med_id, med_cop_pac_id, med_cop_far_id, med_cop_pro_id)
        );
        COMMENT ON COLUMN {$tabla1}.med_id IS 'Id de la consulta secuencial';
        COMMENT ON COLUMN {$tabla1}.med_cop_id IS 'Id de la consulta de referencia';
        COMMENT ON COLUMN {$tabla1}.med_cop_med_id IS 'ID de la medico';
        COMMENT ON COLUMN {$tabla1}.med_cop_pac_id IS 'ID de la paciente';
        COMMENT ON COLUMN {$tabla1}.med_cop_far_id IS 'ID de la farmacia';
        COMMENT ON COLUMN {$tabla1}.med_cop_pro_id IS 'ID del producto';
        COMMENT ON COLUMN {$tabla1}.med_cop_pre IS 'precio';
        COMMENT ON COLUMN {$tabla1}.med_cop_can IS 'cantidad';
        COMMENT ON COLUMN {$tabla1}.med_cop_desf IS 'descuento farmacia';
        COMMENT ON COLUMN {$tabla1}.med_cop_desl IS 'descuento laboratorio';
        COMMENT ON COLUMN {$tabla1}.med_cop_valor IS 'subtotal';
        COMMENT ON COLUMN {$tabla1}.med_cop_sta IS 'estatus del registro 1=creacion 2=edicion 3=borrado';
        COMMENT ON COLUMN {$tabla1}.med_cop_dt IS 'fecha de actualizacion';
        COMMENT ON COLUMN {$tabla1}.med_cop_usr IS 'ID del usuario que actualiza';
        ";

        if (pg_query($tmfPac, $sql)) {
            $arrInfo['status'] = $val;
        } else {
            $arrInfo['status'] = 0;
            $arrInfo['error'] = $sql;
        }
        //print_r('<br>');
        //print_r($sql);
        print json_encode($arrInfo);

        $tabla1 = "a" . $variableId . "_medicos_consultas_vacunas";
        $llave1 = "a" . $variableId . "med_cov_pkey";

        $sql = "CREATE TABLE IF NOT EXISTS {$tabla1}
        (
        med_id serial,
        med_cov_id integer NOT NULL, -- Id de la consulta
        med_cov_med_id character varying(8) NOT NULL, -- ID de la medico
        med_cov_pac_id character varying(8) NOT NULL, -- ID de la paciente
        med_cov_vac_id character varying(10) NOT NULL, -- ID de la vacuna
        med_cov_mat character varying(50), -- material
        med_cov_dosis character varying(50), -- dosis
        med_cov_obs text, -- observaciones
        med_cov_sta char(1), -- estatus del registro 1=creacion 2=edicion 3=borrado
        med_cov_dt timestamp without time zone, -- fecha de actualizacion
        med_cov_usr character varying(15), -- ID del usuario que actualiza
        CONSTRAINT {$llave1} PRIMARY KEY (med_cov_id, med_cov_med_id, med_cov_pac_id, med_cov_vac_id)
        );
        COMMENT ON COLUMN {$tabla1}.med_id IS 'Id de la consulta secuencial';
        COMMENT ON COLUMN {$tabla1}.med_cov_id IS 'Id de la consulta';
        COMMENT ON COLUMN {$tabla1}.med_cov_med_id IS 'ID de la medico';
        COMMENT ON COLUMN {$tabla1}.med_cov_pac_id IS 'ID de la paciente';
        COMMENT ON COLUMN {$tabla1}.med_cov_vac_id IS 'ID de la vacuna';
        COMMENT ON COLUMN {$tabla1}.med_cov_mat IS 'material';
        COMMENT ON COLUMN {$tabla1}.med_cov_dosis IS 'dosis';
        COMMENT ON COLUMN {$tabla1}.med_cov_obs IS 'observaciones';
        COMMENT ON COLUMN {$tabla1}.med_cov_sta IS 'estatus del registro 1=creacion 2=edicion 3=borrado';
        COMMENT ON COLUMN {$tabla1}.med_cov_dt IS 'fecha de actualizacion';
        COMMENT ON COLUMN {$tabla1}.med_cov_usr IS 'ID del usuario que actualiza';
        ";

        if (pg_query($tmfPac, $sql)) {
            $arrInfo['status'] = $val;
        } else {
            $arrInfo['status'] = 0;
            $arrInfo['error'] = $sql;
        }
        //print_r('<br>');
        //print_r($sql);
        print json_encode($arrInfo);


        //////////////////////////LABORATORIOS FARMACEUTICOS//////////////////////////////////

        $tabla1 = "a" . $variableId . "_farmacias_orden";
        $llave1 = "a" . $variableId . "far_ord_pkey";

        $sql = "CREATE TABLE IF NOT EXISTS {$tabla1}
        (
        far_ord_id serial,
        far_ord_cod integer NOT NULL, -- Id de orden de referencia
        far_ord_far_code integer, -- Code de la farmacia
        far_ord_comcom character varying(100), -- Nombre comercial
        far_ord_tipo char(1) NOT NULL, -- tipo de orden 1=medico 2=paciente 3=tienda
        far_ord_fec timestamp without time zone NOT NULL, -- fecha de orden
        far_ord_med_id character varying(8) NOT NULL, -- ID del medico
        far_ord_pac_id character varying(8) NOT NULL, -- ID del paciente
        far_ord_pac_nombre character varying(100) NOT NULL, -- Nombre del paciente
        far_ord_pac_mem_id character varying(20) NOT NULL, -- ID de la membresia
        far_ord_por_fac numeric(2,0), -- Porcentaje de descuento de la farmacia
        far_ord_por_laf numeric(2,0), -- Porcentaje de descuento del laboratorio farmaceutico
        far_ord_valor numeric(15,2), -- Valor total de la orden
        far_ord_valor_desf numeric(15,2), -- Valor descuento farmacia
        far_ord_valor_desl numeric(15,2), -- valor descuento laboratorio
        far_ord_valor_iva numeric(15,2), -- valor iva
        far_ord_total numeric(15,2), -- valor total
        far_ord_est char(1), -- Estatus de la orden  1=emitida 2=entregada 3=anulada
        far_ord_sta char(1), -- estatus del registiro 1=creacion 2=edicion 3=borrado
        far_ord_dt timestamp without time zone, -- fecha de actualizacion
        far_ord_usr character varying(15), -- ID del usuario que actualiza
        CONSTRAINT {$llave1} PRIMARY KEY (far_ord_cod, far_ord_tipo, far_ord_med_id, far_ord_pac_id)
        );
        COMMENT ON COLUMN {$tabla1}.far_ord_id IS 'Id de orden secuencial';
        COMMENT ON COLUMN {$tabla1}.far_ord_cod IS 'Id de orden de referencia';
        COMMENT ON COLUMN {$tabla1}.far_ord_far_code IS 'Code de la farmacia';
        COMMENT ON COLUMN {$tabla1}.far_ord_comcom IS 'Nombre comercial';
        COMMENT ON COLUMN {$tabla1}.far_ord_tipo IS 'tipo de orden 1=medico 2=paciente 3=tienda';
        COMMENT ON COLUMN {$tabla1}.far_ord_fec IS 'fecha de orden';
        COMMENT ON COLUMN {$tabla1}.far_ord_med_id IS 'ID del medico';
        COMMENT ON COLUMN {$tabla1}.far_ord_pac_id IS 'ID del paciente';
        COMMENT ON COLUMN {$tabla1}.far_ord_pac_nombre IS 'Nombre del paciente';
        COMMENT ON COLUMN {$tabla1}.far_ord_pac_mem_id IS 'ID de la membresia';
        COMMENT ON COLUMN {$tabla1}.far_ord_por_fac IS 'Porcentaje de descuento de la farmacia';
        COMMENT ON COLUMN {$tabla1}.far_ord_por_laf IS 'Porcentaje de descuento del laboratorio farmaceutico';
        COMMENT ON COLUMN {$tabla1}.far_ord_valor IS 'Valor total de la orden';
        COMMENT ON COLUMN {$tabla1}.far_ord_valor_desf IS 'Valor descuento farmacia';
        COMMENT ON COLUMN {$tabla1}.far_ord_valor_desl IS 'valor descuento laboratorio';
        COMMENT ON COLUMN {$tabla1}.far_ord_valor_iva IS 'valor iva';
        COMMENT ON COLUMN {$tabla1}.far_ord_total IS 'valor total';
        COMMENT ON COLUMN {$tabla1}.far_ord_est IS 'Estatus de la orden  1=emitida 2=entregada 3=anulada';
        COMMENT ON COLUMN {$tabla1}.far_ord_sta IS 'estatus del registiro 1=creacion 2=edicion 3=borrado';
        COMMENT ON COLUMN {$tabla1}.far_ord_dt IS 'fecha de actualizacion';
        COMMENT ON COLUMN {$tabla1}.far_ord_usr IS 'ID del usuario que actualiza';
        ";

        if (pg_query($tmfLaf, $sql)) {
            $arrInfo['status'] = $val;
        } else {
            $arrInfo['status'] = 0;
            $arrInfo['error'] = $sql;
        }
        //print_r('<br>');
        //print_r($sql);
        print json_encode($arrInfo);

        $tabla1 = "a" . $variableId . "_farmacias_orden_prod";
        $llave1 = "a" . $variableId . "far_orp_pkey";

        $sql = "CREATE TABLE IF NOT EXISTS {$tabla1}
        (
        far_orp_id serial,
        far_orp_cod integer NOT NULL, -- Id de orden de referencia
        far_orp_med_id character varying(8) NOT NULL, -- ID del medico
        far_orp_pac_id character varying(8) NOT NULL, -- ID del paciente
        far_orp_pro_id character varying(20) NOT NULL, -- ID del producto
        far_orp_pre numeric(15,2) NOT NULL, -- precio
        far_orp_can integer, -- cantidad
        far_orp_desf numeric(10,2), -- descuento farmacia
        far_orp_desl numeric(10,2), -- descuento laboratorio
        far_orp_valor numeric(10,2), -- subtotal
        far_orp_sta char(1), -- estatus del registro 1=creacion 2=edicion 3=borrado
        far_orp_dt timestamp without time zone, -- fecha de actualizacion
        far_orp_usr character varying(15), -- ID del usuario que actualiza
        CONSTRAINT {$llave1} PRIMARY KEY (far_orp_cod, far_orp_pro_id, far_orp_med_id, far_orp_pac_id)
        );
        COMMENT ON COLUMN {$tabla1}.far_orp_cod IS 'Id de orden de referencia';
        COMMENT ON COLUMN {$tabla1}.far_orp_med_id IS 'ID del medico';
        COMMENT ON COLUMN {$tabla1}.far_orp_pac_id IS 'ID del paciente';
        COMMENT ON COLUMN {$tabla1}.far_orp_pro_id IS 'ID del producto';
        COMMENT ON COLUMN {$tabla1}.far_orp_pre IS 'precio';
        COMMENT ON COLUMN {$tabla1}.far_orp_can IS 'cantidad';
        COMMENT ON COLUMN {$tabla1}.far_orp_desf IS 'descuento farmacia';
        COMMENT ON COLUMN {$tabla1}.far_orp_desl IS 'descuento laboratorio';
        COMMENT ON COLUMN {$tabla1}.far_orp_valor IS 'subtotal';
        COMMENT ON COLUMN {$tabla1}.far_orp_sta IS 'estatus del registro 1=creacion 2=edicion 3=borrado';
        COMMENT ON COLUMN {$tabla1}.far_orp_dt IS 'fecha de actualizacion';
        COMMENT ON COLUMN {$tabla1}.far_orp_usr IS 'ID del usuario que actualiza';
        ";

        if (pg_query($tmfLaf, $sql)) {
            $arrInfo['status'] = $val;
        } else {
            $arrInfo['status'] = 0;
            $arrInfo['error'] = $sql;
        }
        //print_r('<br>');
        //print_r($sql);
        print json_encode($arrInfo);


        $tabla1 = "a" . $variableId . "_medicos_consultas";
        $llave1 = "a" . $variableId . "med_con_pkey";

        $sql = "CREATE TABLE IF NOT EXISTS {$tabla1}
        (
        id serial,
        med_con_id integer NOT NULL, -- ID de la consulta
        med_con_med_id character varying(8) NOT NULL, -- ID interno del medico
        med_con_pac_id character varying(8) NOT NULL, -- ID interno del paciente
        med_con_cita_dt timestamp without time zone NOT NULL, -- fecha de consulta
        med_con_motivo text, -- motivo de la consulta
        med_con_examen text, -- examen realizado
        med_con_receta text, -- descripcion de la receta
        med_con_dieta text, -- descripcion de la dieta
        med_con_observa text, -- observaciones
        med_con_uni_id integer, -- ID de la unidad sanitaria
        med_con_enf_id integer, -- ID interno de la enfermedad
        med_pac_zona character varying(2), -- zona del paciente
        med_pac_dep character varying(5), -- ID departamento del paciente
        med_pac_mun character varying(5), -- ID municipio del paciente
        med_con_citap_dt timestamp without time zone, -- fecha de proxima consulta
        med_con_sta char(1), -- estatus del registro 1=creacion 2=edicion 3=borrado
        med_con_dt timestamp without time zone, -- fecha de actualizacion
        med_con_usr character varying(15), -- ID del usuario que actualiza
        CONSTRAINT {$llave1} PRIMARY KEY (med_con_id, med_con_med_id, med_con_pac_id, med_con_cita_dt)
        );
        COMMENT ON COLUMN {$tabla1}.id IS 'ID secuencial';
        COMMENT ON COLUMN {$tabla1}.med_con_id IS 'ID de la consulta';
        COMMENT ON COLUMN {$tabla1}.med_con_med_id IS 'ID interno del medico';
        COMMENT ON COLUMN {$tabla1}.med_con_pac_id IS 'ID interno del paciente';
        COMMENT ON COLUMN {$tabla1}.med_con_cita_dt IS 'fecha de consulta';
        COMMENT ON COLUMN {$tabla1}.med_con_motivo IS 'motivo de la consulta';
        COMMENT ON COLUMN {$tabla1}.med_con_examen IS 'examen realizado';
        COMMENT ON COLUMN {$tabla1}.med_con_receta IS 'descripcion de la receta';
        COMMENT ON COLUMN {$tabla1}.med_con_dieta IS 'descripcion de la dieta';
        COMMENT ON COLUMN {$tabla1}.med_con_observa IS 'observaciones';
        COMMENT ON COLUMN {$tabla1}.med_con_uni_id IS 'ID de la unidad sanitaria';
        COMMENT ON COLUMN {$tabla1}.med_con_enf_id IS 'ID interno de la enfermedad';
        COMMENT ON COLUMN {$tabla1}.med_pac_zona IS 'zona del paciente';
        COMMENT ON COLUMN {$tabla1}.med_pac_dep IS 'ID departamento del paciente';
        COMMENT ON COLUMN {$tabla1}.med_pac_mun IS 'ID municipio del paciente';
        COMMENT ON COLUMN {$tabla1}.med_con_citap_dt IS 'fecha de proxima consulta';
        COMMENT ON COLUMN {$tabla1}.med_con_sta IS 'estatus del registro 1=creacion 2=edicion 3=borrado';
        COMMENT ON COLUMN {$tabla1}.med_con_dt IS 'fecha de actualizacion';
        COMMENT ON COLUMN {$tabla1}.med_con_usr IS 'ID del usuario que actualiza';
        ";

        if (pg_query($tmfLaf, $sql)) {
            $arrInfo['status'] = $val;
        } else {
            $arrInfo['status'] = 0;
            $arrInfo['error'] = $sql;
        }
        //print_r('<br>');
        //print_r($sql);
        print json_encode($arrInfo);

        $tabla1 = "a" . $variableId . "_medicos_consultas_productos";
        $llave1 = "a" . $variableId . "med_cop_pkey";

        $sql = "CREATE TABLE IF NOT EXISTS {$tabla1}
        (
        med_id serial,
        med_cop_id integer NOT NULL, -- Id de la consulta de referencia
        med_cop_med_id character varying(8) NOT NULL, -- ID de la medico
        med_cop_pac_id character varying(8) NOT NULL, -- ID de la paciente
        med_cop_far_id character varying(8) NOT NULL, -- ID de la farmacia
        med_cop_pro_id character varying(20) NOT NULL, -- ID del producto
        med_cop_pre numeric(15,2) NOT NULL, -- precio
        med_cop_can integer, -- cantidad
        med_cop_desf numeric(10,2), -- descuento farmacia
        med_cop_desl numeric(10,2), -- descuento laboratorio
        med_cop_valor numeric(10,2), -- subtotal
        med_cop_sta char(1), -- estatus del registro 1=creacion 2=edicion 3=borrado
        med_cop_dt timestamp without time zone, -- fecha de actualizacion
        med_cop_usr character varying(15), -- ID del usuario que actualiza
        CONSTRAINT {$llave1} PRIMARY KEY (med_cop_med_id, med_cop_pac_id, med_cop_far_id, med_cop_pro_id)
        );
        COMMENT ON COLUMN {$tabla1}.med_id IS 'Id de la consulta secuencial';
        COMMENT ON COLUMN {$tabla1}.med_cop_id IS 'Id de la consulta de referencia';
        COMMENT ON COLUMN {$tabla1}.med_cop_med_id IS 'ID de la medico';
        COMMENT ON COLUMN {$tabla1}.med_cop_pac_id IS 'ID de la paciente';
        COMMENT ON COLUMN {$tabla1}.med_cop_far_id IS 'ID de la farmacia';
        COMMENT ON COLUMN {$tabla1}.med_cop_pro_id IS 'ID del producto';
        COMMENT ON COLUMN {$tabla1}.med_cop_pre IS 'precio';
        COMMENT ON COLUMN {$tabla1}.med_cop_can IS 'cantidad';
        COMMENT ON COLUMN {$tabla1}.med_cop_desf IS 'descuento farmacia';
        COMMENT ON COLUMN {$tabla1}.med_cop_desl IS 'descuento laboratorio';
        COMMENT ON COLUMN {$tabla1}.med_cop_valor IS 'subtotal';
        COMMENT ON COLUMN {$tabla1}.med_cop_sta IS 'estatus del registro 1=creacion 2=edicion 3=borrado';
        COMMENT ON COLUMN {$tabla1}.med_cop_dt IS 'fecha de actualizacion';
        COMMENT ON COLUMN {$tabla1}.med_cop_usr IS 'ID del usuario que actualiza';
        ";

        if (pg_query($tmfLaf, $sql)) {
            $arrInfo['status'] = $val;
        } else {
            $arrInfo['status'] = 0;
            $arrInfo['error'] = $sql;
        }
        //print_r('<br>');
        //print_r($sql);
        print json_encode($arrInfo);
    }

    /////////////////////////////////////////////////////////////////////////////////////////////////////////


    $rs = pg_query($rmfAdm, "SELECT username,adm_usr_tipo from web_users WHERE username='$username' and adm_usr_tipo='$usuario' ");
    if ($row = pg_fetch_array($rs)) {
        $idRow = trim($row[0]);
    }

    $variableCode = isset($idRow) ? $idRow  : 0;
    if ($variableCode) {
        if (isset($_POST['username'])) {

            $username = stripslashes($_REQUEST['username']);
            $username = pg_escape_string($rmfAdm, $username);
            $password = stripslashes($_REQUEST['password']);
            $password = pg_escape_string($rmfAdm, $password);

            $query = "SELECT * FROM web_users WHERE username='$username' and adm_usr_tipo='$usuario' and password ='" . md5($password) . "' AND status_actual = 1";
            $result = pg_query($rmfAdm, $query) or die(pg_last_error());
            $rows = pg_num_rows($result);
            if ($rows == 1) {
                while ($rTMP = pg_fetch_assoc($result)) {
                    $_SESSION['logged'] = true;
                    $_SESSION['username'] = $rTMP['username'];
                    $_SESSION['mail'] = $rTMP['mail'];
                    $_SESSION['nombre_completo'] = $rTMP['nombre_completo'];
                    $_SESSION['adm_usr_id'] = $rTMP['adm_usr_id'];
                    $_SESSION['adm_usr_tipo'] = $rTMP['adm_usr_tipo'];
                    $_SESSION['adm_usr_code'] = $rTMP['adm_usr_code'];
                    $_SESSION['remember_token'] = $rTMP['remember_token'];
                    $_SESSION['adm_date_ven'] = $rTMP['adm_date_ven'];
                    $_SESSION['status_actual'] = $rTMP['status_actual'];
                }
                $var_consulta = "INSERT INTO control_usuario (username, intentos, fecha,hora) VALUES ('$username',1,'$date','$hora')";
                $val = 1;
                if (pg_query($rmfAdm, $var_consulta)) {
                    $arrInfo['status'] = $val;
                } else {
                    $arrInfo['status'] = 0;
                    $arrInfo['error'] = $var_consulta;
                }

                $var_consulta = pg_query($rmfAdm, "DELETE FROM control_usuario WHERE username = '$username' AND intentos = 2 AND fecha = '$date'");
                $val = 1;
                if (pg_query($rmfAdm, $var_consulta)) {
                    $arrInfo['status'] = $val;
                } else {
                    $arrInfo['status'] = 0;
                    $arrInfo['error'] = $var_consulta;
                }

                //print_r($var_consulta);
                print json_encode($arrInfo);

                header('Location:../../admin/index.php');
            } else {
                $usuario = $_POST['username'];
                $date = date("Y-m-d");
                $hora = date("h:i:sa");

                $var_consulta = "INSERT INTO control_usuario (username, intentos, fecha,hora) VALUES ('$username',2,'$date','$hora')";
                $val = 1;
                if (pg_query($rmfAdm, $var_consulta)) {
                    $arrInfo['status'] = $val;
                } else {
                    $arrInfo['status'] = 0;
                    $arrInfo['error'] = $var_consulta;
                }
                //print_r($var_consulta);
                print json_encode($arrInfo);

                $rs = pg_query($rmfAdm, "SELECT COUNT(id) FROM control_usuario WHERE username = '$username' AND intentos = 2 AND fecha = '$date'");
                if ($row = pg_fetch_array($rs)) {
                    $idRow = trim($row[0]);
                }
                $contador = isset($idRow) ? $idRow  : 0;

                if ($contador >= 5) {
                    $usuario = $_POST['username'];

                    $var_consulta = "UPDATE web_users SET status_actual = 0 WHERE username  = '$username'";
                    $val = 1;
                    if (pg_query($rmfAdm, $var_consulta)) {
                        $arrInfo['status'] = $val;
                    } else {
                        $arrInfo['status'] = 0;
                        $arrInfo['error'] = $var_consulta;
                    }
                    //print_r($var_consulta);
                    print json_encode($arrInfo);

                    header('Location:login_adm.php?error=2');
                } else {
                    $rs = pg_query($rmfAdm, "SELECT COUNT(adm_usr_id) FROM web_users WHERE username  = '$username' AND status_actual = 0");
                    if ($row = pg_fetch_array($rs)) {
                        $idRow = trim($row[0]);
                    }
                    $validar = isset($idRow) ? $idRow  : 0;
                    if ($validar) {
                        header('Location:login_adm.php?error=2');
                    } else {
                        $rs = pg_query($rmfAdm, "SELECT COUNT(id) from control_usuario WHERE username = '$username' AND intentos ='2' ");
                        if ($row = pg_fetch_array($rs)) {
                            $idRow = $row[0];
                        }
                        $intentos = isset($idRow) ? $idRow  : 0;

                        $_SESSION['intentos'] = $intentos;

                        header('Location:login_adm.php?error=1');
                    }
                }
            }
        }
    } else {
        header('Location:login_adm.php?error=4');
    }
}

?>
<div style="text-align:center;">
    <h2>ADMINISTRADOR</h2>
</div>
<form action="" method="post" name="login">
    <?php
    $error = isset($_GET["error"]) ? $_GET["error"]  : '';
    $usr = isset($_GET["usr"]) ? $_GET["usr"]  : '';
    if ($usr == 1) {
    ?>
        <div class="modal fade show" id="exampleModal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Alerta!</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <span>Solicitud Enviada / pendiente de autorizacion!</span> <br>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        <?php
    }
    if ($error == 1) {
        require_once "../conexion/tmfAdm.php";
        ?>
            <div class="modal fade show" id="exampleModal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Alerta!</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <span>Datos de Ingreso no validos, intente de nuevo!</span> <br>
                            <span> Intentos realizados = <?php echo $_SESSION['intentos'] ?></span>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        <?php
    }
    if ($error == 2) {
        ?>
            <div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Alerta!</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <span>Su cuenta ha sido deshabilitada!
                            </span>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        <?php
    }
    if ($error == 3) {
        ?>
            <div class="modal fade" id="exampleModal3" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Alerta!</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <span>Comuniquese con el administrador del sistema!!</span><br><br>
                            <span>Su cuenta esta deshabilitada!</span><br>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        <?php
    }
    if ($error == 4) {
        ?>
            <div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Alerta!</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <span>Usuario no existe
                            </span>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        <?php
    }
    if (isset($_SESSION['usuario']) && $_SESSION['usuario'] != '') {
        header('Location:../../app/patient/index.php');
    }
        ?>
        <div style="text-align:right;">
            <a href="../../index.php" class="btn btn-raised btn-danger">Regresar</a>
        </div>
        <div class="group">
            <input type="text" name="username" required><span class="highlight"></span><span class="bar"></span>
            <label>Nombre De Usuario</label>
        </div>
        <div class="group">
            <input type="password" name="password" required><span class="highlight"></span><span class="bar"></span>
            <label>Contraseña</label>
        </div>
        <br>
        <button name="submit" type="submit" class="button buttonBlue">Ingresar
            <div class="ripples buttonRipples"><span class="ripplesCircle"></span></div>
        </button>
</form>
<?php


?>

<script>
    function fntError1() {
        $('#exampleModal1').modal('show')
    }

    function fntError2() {
        $('#exampleModal2').modal('show')
    }

    function fntError3() {
        $('#exampleModal3').modal('show')
    }
</script>

<style type="text/css">
    * {
        box-sizing: border-box;
    }

    body {
        margin: -100;
        font-family: Helvetica;
        background: #eee;
        -webkit-font-smoothing: antialiased;
    }

    hgroup {
        text-align: center;
        margin-top: 4em;
    }

    h1,
    h3 {
        font-weight: 300;
    }

    h1 {
        color: #636363;
    }

    h2 {
        color: #007bff;
    }

    h3 {
        color: #4a89dc;
    }

    form {
        width: 380px;
        margin: 1em auto;
        padding: 3em 2em 2em 2em;
        background: #fafafa;
        border: 1px solid #ebebeb;
        box-shadow: rgba(0, 0, 0, 0.14902) 0px 1px 1px 0px, rgba(0, 0, 0, 0.09804) 0px 1px 2px 0px;
    }

    .group {
        position: relative;
        margin-bottom: 45px;
    }

    input {
        font-size: 18px;
        padding: 10px 10px 10px 5px;
        -webkit-appearance: none;
        display: block;
        background: #fafafa;
        color: #636363;
        width: 100%;
        border: none;
        border-radius: 0;
        border-bottom: 1px solid #757575;
    }

    input:focus {
        outline: none;
    }


    /* Label */

    label {
        color: #999;
        font-size: 18px;
        font-weight: normal;
        position: absolute;
        pointer-events: none;
        left: 5px;
        top: 10px;
        transition: all 0.2s ease;
    }


    /* active */

    input:focus~label,
    input.used~label {
        top: -20px;
        transform: scale(.75);
        left: -2px;
        /* font-size: 14px; */
        color: #4a89dc;
    }


    /* Underline */

    .bar {
        position: relative;
        display: block;
        width: 100%;
    }

    .bar:before,
    .bar:after {
        content: '';
        height: 2px;
        width: 0;
        bottom: 1px;
        position: absolute;
        background: #4a89dc;
        transition: all 0.2s ease;
    }

    .bar:before {
        left: 50%;
    }

    .bar:after {
        right: 50%;
    }


    /* active */

    input:focus~.bar:before,
    input:focus~.bar:after {
        width: 50%;
    }


    /* Highlight */



    /* active */

    input:focus~.highlight {
        animation: inputHighlighter 0.3s ease;
    }


    /* Animations */

    @keyframes inputHighlighter {
        from {
            background: #4a89dc;
        }

        to {
            width: 0;
            background: transparent;
        }
    }


    /* Button */

    .button {
        position: relative;
        display: inline-block;
        padding: 12px 24px;
        margin: .3em 0 1em 0;
        width: 100%;
        vertical-align: middle;
        color: #fff;
        font-size: 16px;
        line-height: 20px;
        -webkit-font-smoothing: antialiased;
        text-align: center;
        letter-spacing: 1px;
        background: transparent;
        border: 0;
        border-bottom: 2px solid #3160B6;
        cursor: pointer;
        transition: all 0.15s ease;
    }

    .button:focus {
        outline: 0;
    }


    /* Button modifiers */

    .buttonBlue {
        background: #4a89dc;
        text-shadow: 1px 1px 0 rgba(39, 110, 204, .5);
    }

    .buttonBlue:hover {
        background: #357bd8;
    }


    /* Ripples container */

    .ripples {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        overflow: hidden;
        background: transparent;
    }


    /* Ripples circle */

    .ripplesCircle {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        opacity: 0;
        width: 0;
        height: 0;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.25);
    }

    .ripples.is-active .ripplesCircle {
        animation: ripples .4s ease-in;
    }


    /* Ripples animation */

    @keyframes ripples {
        0% {
            opacity: 0;
        }

        25% {
            opacity: 1;
        }

        100% {
            width: 200%;
            padding-bottom: 200%;
            opacity: 0;
        }
    }

    footer {
        text-align: center;
    }

    footer p {
        color: #888;
        font-size: 13px;
        letter-spacing: .4px;
    }

    footer a {
        color: #4a89dc;
        text-decoration: none;
        transition: all .2s ease;
    }

    footer a:hover {
        color: #666;
        text-decoration: underline;
    }

    footer img {
        width: 80px;
        transition: all .2s ease;
    }

    footer img:hover {
        opacity: .83;
    }

    footer img:focus,
    footer a:focus {
        outline: none;
    }
</style>

<script>
    $(window, document, undefined).ready(function() {

        $('input').blur(function() {
            var $this = $(this);
            if ($this.val())
                $this.addClass('used');
            else
                $this.removeClass('used');
        });

        var $ripples = $('.ripples');

        $ripples.on('click.Ripples', function(e) {

            var $this = $(this);
            var $offset = $this.parent().offset();
            var $circle = $this.find('.ripplesCircle');

            var x = e.pageX - $offset.left;
            var y = e.pageY - $offset.top;

            $circle.css({
                top: y + 'px',
                left: x + 'px'
            });

            $this.addClass('is-active');

        });

        $ripples.on('animationend webkitAnimationEnd mozAnimationEnd oanimationend MSAnimationEnd', function(e) {
            $(this).removeClass('is-active');
        });

    });

    window.addEventListener('load', fntError1, false)
    window.addEventListener('load', fntError2, false)
    window.addEventListener('load', fntError3, false)
</script>
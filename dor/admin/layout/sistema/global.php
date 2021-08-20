//////////////////////////////////////////////generar tablas
if ($val) {
            $val = 1;
            $tabla1 = "a" . $variableId . "_citas";
            $llave1 = "a" . $variableId . "cit_pkey";

            $sql = "CREATE TABLE IF NOT EXISTS {$tabla1}
                    (
                    id serial,
                    ctg_cit_id integer NOT NULL, -- ID de la cita
                    ctg_cit_cita_dt timestamp without time zone NOT NULL, -- fecha de cita
                    ctg_cit_med_id integer NOT NULL, -- ID interno del medico
                    ctg_cit_pac_id integer NOT NULL, -- ID interno del paciente
                    ctg_cit_motivo text, -- motivo de la cita
                    ctg_cit_estatus char(1), -- 0=programada 1=realizada 2=anulada
                    ctg_cit_sta char(1), -- estatus del registro 1=creacion 2=edicion 3=borrado
                    ctg_cit_dt timestamp without time zone, -- fecha de actualizacion
                    ctg_cit_usr character varying(15), -- ID del usuario que actualiza
                    CONSTRAINT {$llave1} PRIMARY KEY (ctg_cit_id, ctg_cit_cita_dt, ctg_cit_pac_id)
                    );
                    COMMENT ON COLUMN {$tabla1}.id IS 'id';
                    COMMENT ON COLUMN {$tabla1}.ctg_cit_id IS 'ID de la cita';
                    COMMENT ON COLUMN {$tabla1}.ctg_cit_cita_dt IS 'fecha de cita';
                    COMMENT ON COLUMN {$tabla1}.ctg_cit_med_id IS 'ID interno del medico';
                    COMMENT ON COLUMN {$tabla1}.ctg_cit_pac_id IS 'ID interno del paciente';
                    COMMENT ON COLUMN {$tabla1}.ctg_cit_motivo IS 'motivo de la cita';
                    COMMENT ON COLUMN {$tabla1}.ctg_cit_estatus IS '0=programada 1=realizada 2=anulada';
                    COMMENT ON COLUMN {$tabla1}.ctg_cit_sta IS 'estatus del registro 1=creacion 2=edicion 3=borrado';
                    COMMENT ON COLUMN {$tabla1}.ctg_cit_dt IS 'fecha de actualizacion';
                    COMMENT ON COLUMN {$tabla1}.ctg_cit_usr IS 'ID del usuario que actualiza';
                    ";
            if (pg_query($tmfLab, $sql)) {
                $arrInfo['status'] = $val;
            } else {
                $arrInfo['status'] = 0;
                $arrInfo['error'] = $sql;
            }
            //print_r('<br>');
            //print_r($sql);
            print json_encode($arrInfo);

            $val = 2;
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
            if (pg_query($tmfLab, $sql)) {
                $arrInfo['status'] = $val;
            } else {
                $arrInfo['status'] = 0;
                $arrInfo['error'] = $sql;
            }
            //print_r('<br>');
            //print_r($sql);
            print json_encode($arrInfo);

            $val = 3;
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
            if (pg_query($tmfLab, $sql)) {
                $arrInfo['status'] = $val;
            } else {
                $arrInfo['status'] = 0;
                $arrInfo['error'] = $sql;
            }
            //print_r('<br>');
            //print_r($sql);
            print json_encode($arrInfo);

            $val = 4;
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
            if (pg_query($tmfLab, $sql)) {
                $arrInfo['status'] = $val;
            } else {
                $arrInfo['status'] = 0;
                $arrInfo['error'] = $sql;
            }
            //print_r('<br>');
            //print_r($sql);
            print json_encode($arrInfo);

            $val = 5;
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
            if (pg_query($tmfLab, $sql)) {
                $arrInfo['status'] = $val;
            } else {
                $arrInfo['status'] = 0;
                $arrInfo['error'] = $sql;
            }
            //print_r('<br>');
            //print_r($sql);
            print json_encode($arrInfo);

            $val = 6;
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
            if (pg_query($tmfLab, $sql)) {
                $arrInfo['status'] = $val;
            } else {
                $arrInfo['status'] = 0;
                $arrInfo['error'] = $sql;
            }
            //print_r('<br>');
            //print_r($sql);
            print json_encode($arrInfo);

            $val = 7;
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
            if (pg_query($tmfLab, $sql)) {
                $arrInfo['status'] = $val;
            } else {
                $arrInfo['status'] = 0;
                $arrInfo['error'] = $sql;
            }
            //print_r('<br>');
            //print_r($sql);
            print json_encode($arrInfo);

            $val = 8;
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
            if (pg_query($tmfLab, $sql)) {
                $arrInfo['status'] = $val;
            } else {
                $arrInfo['status'] = 0;
                $arrInfo['error'] = $sql;
            }
            //print_r('<br>');
            //print_r($sql);
            print json_encode($arrInfo);

            $val = 9;
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
            if (pg_query($tmfLab, $sql)) {
                $arrInfo['status'] = $val;
            } else {
                $arrInfo['status'] = 0;
                $arrInfo['error'] = $sql;
            }
            //print_r('<br>');
            //print_r($sql);
            print json_encode($arrInfo);

            $val = 10;
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
            if (pg_query($tmfLab, $sql)) {
                $arrInfo['status'] = $val;
            } else {
                $arrInfo['status'] = 0;
                $arrInfo['error'] = $sql;
            }
            //print_r('<br>');
            //print_r($sql);
            print json_encode($arrInfo);
        }







        $rs = pg_query("SELECT COUNT(id) FROM web_users WHERE username  = '$username' AND password = '$password' AND status_actual = 0");
            if ($row = pg_fetch_array($rs)) {
                $idRow = trim($row[0]);
            }
            $validar = isset($idRow) ? $idRow  : 0;
            if ($validar) {
                header('Location:login_farmacias.php?error=3');
            } else {
                header('Location:login_farmacias.php?error=1');
            }




            $query = "SELECT * FROM web_users WHERE username='$username' and adm_usr_tipo='$usuario' and password ='" . md5($password) . "'";

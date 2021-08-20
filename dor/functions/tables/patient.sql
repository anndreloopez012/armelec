CREATE TABLE public.dependientes
(
  pac_pad_code character varying(8) NOT NULL, -- ID interno del paciente
  pac_pad_dep_id integer NOT NULL, -- ID del dependiente
  pac_pad_nom1 character varying(25), -- nombre 1
  pac_pad_nom2 character varying(25), -- nombre 2
  pac_pad_ape1 character varying(25), -- apellido 1
  pac_pad_ape2 character varying(25), -- apellido 2
  pac_pad_fec_nac date, -- fecha de nacimiento
  pac_pad_madre1 character varying(25), -- primer nombre de la madre
  pac_pad_madre2 character varying(25), -- segundo nombre de la madre
  pac_pad_madre3 character varying(25), -- primer apellido de la madre
  pac_pad_madre4 character varying(25), -- segundo apellido de la madre
  pac_pad_padre1 character varying(25), -- primer nombre del padre
  pac_pad_padre2 character varying(25), -- segundo nombre del padre
  pac_pad_padre3 character varying(25), -- primer apellido del padre
  pac_pad_padre4 character varying(25), -- segundo apellido del padre
  pac_pad_obs_id character varying(8), -- id del medico obstetra
  pac_pad_his_pat text, -- PATOLOGICO
  pac_pad_his_fam text, -- FAMILIARES
  pac_pad_his_obs text, -- OBSTETRICOS
  pac_pad_his_ant text, -- ANTECEDENTES
  pac_pad_sta "char", -- estatus del registro 1=creacion 2=edicion 3=borrado
  pac_pad_dt timestamp without time zone, -- fecha de actualizacion
  pac_pad_usr character varying(15), -- ID del usuario que actualiza
  CONSTRAINT pac_pad_pkey PRIMARY KEY (pac_pad_code, pac_pad_dep_id)
)
WITH (
  OIDS=FALSE
);
ALTER TABLE public.dependientes
  OWNER TO postgres;
COMMENT ON COLUMN public.dependientes.pac_pad_code IS 'ID interno del paciente';
COMMENT ON COLUMN public.dependientes.pac_pad_dep_id IS 'ID del dependiente';
COMMENT ON COLUMN public.dependientes.pac_pad_nom1 IS 'nombre 1';
COMMENT ON COLUMN public.dependientes.pac_pad_nom2 IS 'nombre 2';
COMMENT ON COLUMN public.dependientes.pac_pad_ape1 IS 'apellido 1';
COMMENT ON COLUMN public.dependientes.pac_pad_ape2 IS 'apellido 2';
COMMENT ON COLUMN public.dependientes.pac_pad_fec_nac IS 'fecha de nacimiento';
COMMENT ON COLUMN public.dependientes.pac_pad_madre1 IS 'primer nombre de la madre';
COMMENT ON COLUMN public.dependientes.pac_pad_madre2 IS 'segundo nombre de la madre';
COMMENT ON COLUMN public.dependientes.pac_pad_madre3 IS 'primer apellido de la madre';
COMMENT ON COLUMN public.dependientes.pac_pad_madre4 IS 'segundo apellido de la madre';
COMMENT ON COLUMN public.dependientes.pac_pad_padre1 IS 'primer nombre del padre';
COMMENT ON COLUMN public.dependientes.pac_pad_padre2 IS 'segundo nombre del padre';
COMMENT ON COLUMN public.dependientes.pac_pad_padre3 IS 'primer apellido del padre';
COMMENT ON COLUMN public.dependientes.pac_pad_padre4 IS 'segundo apellido del padre';
COMMENT ON COLUMN public.dependientes.pac_pad_obs_id IS 'id del medico obstetra';
COMMENT ON COLUMN public.dependientes.pac_pad_his_pat IS 'PATOLOGICO';
COMMENT ON COLUMN public.dependientes.pac_pad_his_fam IS 'FAMILIARES';
COMMENT ON COLUMN public.dependientes.pac_pad_his_obs IS 'OBSTETRICOS';
COMMENT ON COLUMN public.dependientes.pac_pad_his_ant IS 'ANTECEDENTES';
COMMENT ON COLUMN public.dependientes.pac_pad_sta IS 'estatus del registro 1=creacion 2=edicion 3=borrado';
COMMENT ON COLUMN public.dependientes.pac_pad_dt IS 'fecha de actualizacion';
COMMENT ON COLUMN public.dependientes.pac_pad_usr IS 'ID del usuario que actualiza';


CREATE TABLE public.farmacias_orden
(
  far_ord_cod integer NOT NULL, -- Id de orden
  far_ord_tipo "char" NOT NULL, -- tipo de orden 1=medico 2=internet 3=tienda
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
  far_ord_est "char", -- Estatus de la orden  1=emitida 2=entregada 3=anulada
  far_ord_sta "char", -- estatus del registiro 1=creacion 2=edicion 3=borrado
  far_ord_dt timestamp without time zone, -- fecha de actualizacion
  far_ord_usr character varying(15), -- ID del usuario que actualiza
  CONSTRAINT pacfar_ord_pkey PRIMARY KEY (far_ord_cod, far_ord_tipo, far_ord_med_id, far_ord_pac_id)
)
WITH (
  OIDS=FALSE
);
ALTER TABLE public.farmacias_orden
  OWNER TO postgres;
COMMENT ON COLUMN public.farmacias_orden.far_ord_cod IS 'Id de orden';
COMMENT ON COLUMN public.farmacias_orden.far_ord_tipo IS 'tipo de orden 1=medico 2=internet 3=tienda';
COMMENT ON COLUMN public.farmacias_orden.far_ord_fec IS 'fecha de orden';
COMMENT ON COLUMN public.farmacias_orden.far_ord_med_id IS 'ID del medico';
COMMENT ON COLUMN public.farmacias_orden.far_ord_pac_id IS 'ID del paciente';
COMMENT ON COLUMN public.farmacias_orden.far_ord_pac_nombre IS 'Nombre del paciente';
COMMENT ON COLUMN public.farmacias_orden.far_ord_pac_mem_id IS 'ID de la membresia';
COMMENT ON COLUMN public.farmacias_orden.far_ord_por_fac IS 'Porcentaje de descuento de la farmacia';
COMMENT ON COLUMN public.farmacias_orden.far_ord_por_laf IS 'Porcentaje de descuento del laboratorio farmaceutico';
COMMENT ON COLUMN public.farmacias_orden.far_ord_valor IS 'Valor total de la orden';
COMMENT ON COLUMN public.farmacias_orden.far_ord_valor_desf IS 'Valor descuento farmacia';
COMMENT ON COLUMN public.farmacias_orden.far_ord_valor_desl IS 'valor descuento laboratorio';
COMMENT ON COLUMN public.farmacias_orden.far_ord_valor_iva IS 'valor iva';
COMMENT ON COLUMN public.farmacias_orden.far_ord_total IS 'valor total';
COMMENT ON COLUMN public.farmacias_orden.far_ord_est IS 'Estatus de la orden  1=emitida 2=entregada 3=anulada';
COMMENT ON COLUMN public.farmacias_orden.far_ord_sta IS 'estatus del registiro 1=creacion 2=edicion 3=borrado';
COMMENT ON COLUMN public.farmacias_orden.far_ord_dt IS 'fecha de actualizacion';
COMMENT ON COLUMN public.farmacias_orden.far_ord_usr IS 'ID del usuario que actualiza';


CREATE TABLE public.farmacias_orden_prod
(
  far_orp_cod integer NOT NULL, -- Id de orden
  far_orp_med_id character varying(8) NOT NULL, -- ID del medico
  far_orp_pac_id character varying(8) NOT NULL, -- ID del paciente
  far_orp_pro_id character varying(20) NOT NULL, -- ID del producto
  far_orp_pre numeric(15,2) NOT NULL, -- precio
  far_orp_can integer, -- cantidad
  far_orp_desf numeric(10,2), -- descuento farmacia
  far_orp_desl numeric(10,2), -- descuento laboratorio
  far_orp_valor numeric(10,2), -- subtotal
  far_orp_sta "char", -- estatus del registro 1=creacion 2=edicion 3=borrado
  far_orp_dt timestamp without time zone, -- fecha de actualizacion
  far_orp_usr character varying(15), -- ID del usuario que actualiza
  CONSTRAINT far_orp_pkey PRIMARY KEY (far_orp_cod, far_orp_pro_id, far_orp_med_id, far_orp_pac_id)
)
WITH (
  OIDS=FALSE
);
ALTER TABLE public.farmacias_orden_prod
  OWNER TO postgres;
COMMENT ON COLUMN public.farmacias_orden_prod.far_orp_cod IS 'Id de orden';
COMMENT ON COLUMN public.farmacias_orden_prod.far_orp_med_id IS 'ID del medico';
COMMENT ON COLUMN public.farmacias_orden_prod.far_orp_pac_id IS 'ID del paciente';
COMMENT ON COLUMN public.farmacias_orden_prod.far_orp_pro_id IS 'ID del producto';
COMMENT ON COLUMN public.farmacias_orden_prod.far_orp_pre IS 'precio';
COMMENT ON COLUMN public.farmacias_orden_prod.far_orp_can IS 'cantidad';
COMMENT ON COLUMN public.farmacias_orden_prod.far_orp_desf IS 'descuento farmacia';
COMMENT ON COLUMN public.farmacias_orden_prod.far_orp_desl IS 'descuento laboratorio';
COMMENT ON COLUMN public.farmacias_orden_prod.far_orp_valor IS 'subtotal';
COMMENT ON COLUMN public.farmacias_orden_prod.far_orp_sta IS 'estatus del registro 1=creacion 2=edicion 3=borrado';
COMMENT ON COLUMN public.farmacias_orden_prod.far_orp_dt IS 'fecha de actualizacion';
COMMENT ON COLUMN public.farmacias_orden_prod.far_orp_usr IS 'ID del usuario que actualiza';



CREATE TABLE public.hospitales_orden
(
  hos_ord_cod integer NOT NULL, -- Id de orden
  hos_ord_hos_id character varying(8) NOT NULL, -- Id del hospital
  hos_ord_pac_id character varying(8) NOT NULL, -- Id de paciente
  hos_ord_tipo "char" NOT NULL, -- 1=orden del medico 2=orden de internet 3=orden en tienda
  hos_ord_med_id character varying(8), -- ID del medico
  hos_ord_fec timestamp without time zone NOT NULL, -- fecha de orden
  hos_ord_pac_nombre character varying(100) NOT NULL, -- Nombre del paciente
  hos_ord_por_lab numeric(2,0), -- Porcentaje de descuento del laboratorio clinico
  hos_ord_valor numeric(15,2), -- Valor total de la orden
  hos_ord_valor_desh numeric(15,2), -- valor descuento hospital
  hos_ord_valor_iva numeric(15,2), -- valor iva
  hos_ord_total numeric(15,2), -- valor total
  hos_ord_est "char", -- Estatus de la orden  1=emitida 2=entregada 3=anulada
  hos_ord_sta "char", -- estatus del registiro 1=creacion 2=edicion 3=borrado
  hos_ord_dt timestamp without time zone, -- fecha de actualizacion
  hos_ord_usr character varying(15), -- ID del usuario que actualiza
  CONSTRAINT hos_ord_pkey PRIMARY KEY (hos_ord_cod, hos_ord_hos_id, hos_ord_pac_id, hos_ord_tipo)
)
WITH (
  OIDS=FALSE
);
ALTER TABLE public.hospitales_orden
  OWNER TO postgres;
COMMENT ON COLUMN public.hospitales_orden.hos_ord_cod IS 'Id de orden';
COMMENT ON COLUMN public.hospitales_orden.hos_ord_hos_id IS 'Id del hospital';
COMMENT ON COLUMN public.hospitales_orden.hos_ord_pac_id IS 'Id de paciente';
COMMENT ON COLUMN public.hospitales_orden.hos_ord_tipo IS '1=orden del medico 2=orden de internet 3=orden en tienda';
COMMENT ON COLUMN public.hospitales_orden.hos_ord_med_id IS 'ID del medico';
COMMENT ON COLUMN public.hospitales_orden.hos_ord_fec IS 'fecha de orden';
COMMENT ON COLUMN public.hospitales_orden.hos_ord_pac_nombre IS 'Nombre del paciente';
COMMENT ON COLUMN public.hospitales_orden.hos_ord_por_lab IS 'Porcentaje de descuento del laboratorio clinico';
COMMENT ON COLUMN public.hospitales_orden.hos_ord_valor IS 'Valor total de la orden';
COMMENT ON COLUMN public.hospitales_orden.hos_ord_valor_desh IS 'valor descuento hospital';
COMMENT ON COLUMN public.hospitales_orden.hos_ord_valor_iva IS 'valor iva';
COMMENT ON COLUMN public.hospitales_orden.hos_ord_total IS 'valor total';
COMMENT ON COLUMN public.hospitales_orden.hos_ord_est IS 'Estatus de la orden  1=emitida 2=entregada 3=anulada';
COMMENT ON COLUMN public.hospitales_orden.hos_ord_sta IS 'estatus del registiro 1=creacion 2=edicion 3=borrado';
COMMENT ON COLUMN public.hospitales_orden.hos_ord_dt IS 'fecha de actualizacion';
COMMENT ON COLUMN public.hospitales_orden.hos_ord_usr IS 'ID del usuario que actualiza';



CREATE TABLE public.hospitales_orden_items
(
  hos_ori_cod integer NOT NULL, -- Id de orden
  hos_ori_tipo "char" NOT NULL,
  hos_ori_hos_id character varying(8) NOT NULL,
  hos_ori_pac_id character varying(8) NOT NULL,
  hos_ori_med_id character varying(8),
  hos_ori_gpo_id character varying(10) NOT NULL, -- ID del grupo de items
  hos_ori_ser_id character varying(10) NOT NULL, -- ID del item
  hos_ori_pre numeric(15,2) NOT NULL, -- precio
  hos_ori_can integer, -- cantidad
  hos_ori_desh numeric(10,2), -- descuento hospital
  hos_ori_valor numeric(10,2), -- subtotal
  hos_ori_sta "char", -- estatus del registro 1=creacion 2=edicion 3=borrado
  hos_ori_dt timestamp without time zone, -- fecha de actualizacion
  hos_ori_usr character varying(15), -- ID del usuario que actualiza
  CONSTRAINT hos_ori_pkey PRIMARY KEY (hos_ori_cod, hos_ori_tipo, hos_ori_hos_id, hos_ori_pac_id, hos_ori_gpo_id, hos_ori_ser_id)
)
WITH (
  OIDS=FALSE
);
ALTER TABLE public.hospitales_orden_items
  OWNER TO postgres;
COMMENT ON COLUMN public.hospitales_orden_items.hos_ori_cod IS 'Id de orden';
COMMENT ON COLUMN public.hospitales_orden_items.hos_ori_gpo_id IS 'ID del grupo de items';
COMMENT ON COLUMN public.hospitales_orden_items.hos_ori_ser_id IS 'ID del item';
COMMENT ON COLUMN public.hospitales_orden_items.hos_ori_pre IS 'precio';
COMMENT ON COLUMN public.hospitales_orden_items.hos_ori_can IS 'cantidad';
COMMENT ON COLUMN public.hospitales_orden_items.hos_ori_desh IS 'descuento hospital';
COMMENT ON COLUMN public.hospitales_orden_items.hos_ori_valor IS 'subtotal';
COMMENT ON COLUMN public.hospitales_orden_items.hos_ori_sta IS 'estatus del registro 1=creacion 2=edicion 3=borrado';
COMMENT ON COLUMN public.hospitales_orden_items.hos_ori_dt IS 'fecha de actualizacion';
COMMENT ON COLUMN public.hospitales_orden_items.hos_ori_usr IS 'ID del usuario que actualiza';


CREATE TABLE public.labclinicos_orden
(
  lab_ord_cod integer NOT NULL, -- Id de orden
  lab_ord_tipo "char" NOT NULL, -- 1=orden del medico 2=orden de internet 3=orden en tienda
  lab_ord_pac_id character varying(20) NOT NULL, -- ID del paciente
  lab_ord_med_id character varying(8) NOT NULL, -- ID del medico
  lab_ord_fec timestamp without time zone NOT NULL, -- fecha de orden
  lab_ord_pac_nombre character varying(100) NOT NULL, -- Nombre del paciente
  lab_ord_pac_mem_id character varying(20) NOT NULL, -- ID de la membresia
  lab_ord_por_lab numeric(2,0), -- Porcentaje de descuento del laboratorio clinico
  lab_ord_valor numeric(15,2), -- Valor total de la orden
  lab_ord_valor_desl numeric(15,2), -- valor descuento laboratorio
  lab_ord_valor_iva numeric(15,2), -- valor iva
  lab_ord_total numeric(15,2), -- valor total
  lab_ord_est "char", -- Estatus de la orden  1=emitida 2=entregada 3=anulada
  lab_ord_sta "char", -- estatus del registiro 1=creacion 2=edicion 3=borrado
  lab_ord_dt timestamp without time zone, -- fecha de actualizacion
  lab_ord_usr character varying(15), -- ID del usuario que actualiza
  CONSTRAINT lab_ord_pkey PRIMARY KEY (lab_ord_cod, lab_ord_tipo, lab_ord_pac_id)
)
WITH (
  OIDS=FALSE
);
ALTER TABLE public.labclinicos_orden
  OWNER TO postgres;
COMMENT ON COLUMN public.labclinicos_orden.lab_ord_cod IS 'Id de orden';
COMMENT ON COLUMN public.labclinicos_orden.lab_ord_tipo IS '1=orden del medico 2=orden de internet 3=orden en tienda';
COMMENT ON COLUMN public.labclinicos_orden.lab_ord_pac_id IS 'ID del paciente';
COMMENT ON COLUMN public.labclinicos_orden.lab_ord_med_id IS 'ID del medico';
COMMENT ON COLUMN public.labclinicos_orden.lab_ord_fec IS 'fecha de orden';
COMMENT ON COLUMN public.labclinicos_orden.lab_ord_pac_nombre IS 'Nombre del paciente';
COMMENT ON COLUMN public.labclinicos_orden.lab_ord_pac_mem_id IS 'ID de la membresia';
COMMENT ON COLUMN public.labclinicos_orden.lab_ord_por_lab IS 'Porcentaje de descuento del laboratorio clinico';
COMMENT ON COLUMN public.labclinicos_orden.lab_ord_valor IS 'Valor total de la orden';
COMMENT ON COLUMN public.labclinicos_orden.lab_ord_valor_desl IS 'valor descuento laboratorio';
COMMENT ON COLUMN public.labclinicos_orden.lab_ord_valor_iva IS 'valor iva';
COMMENT ON COLUMN public.labclinicos_orden.lab_ord_total IS 'valor total';
COMMENT ON COLUMN public.labclinicos_orden.lab_ord_est IS 'Estatus de la orden  1=emitida 2=entregada 3=anulada';
COMMENT ON COLUMN public.labclinicos_orden.lab_ord_sta IS 'estatus del registiro 1=creacion 2=edicion 3=borrado';
COMMENT ON COLUMN public.labclinicos_orden.lab_ord_dt IS 'fecha de actualizacion';
COMMENT ON COLUMN public.labclinicos_orden.lab_ord_usr IS 'ID del usuario que actualiza';


CREATE TABLE public.labclinicos_orden_items
(
  lab_ori_cod integer NOT NULL, -- Id de orden
  lab_ori_tipo "char" NOT NULL, -- 1=orden del medico 2=orden de internet 3=orden en tienda
  lab_ori_pac_id character varying(8) NOT NULL, -- ID del paciente
  lab_ori_med_id character varying(8) NOT NULL, -- ID del medico
  lab_ori_gpo_id character varying(10) NOT NULL, -- ID del grupo de items
  lab_ori_exa_id character varying(10) NOT NULL, -- ID del item
  lab_ori_pre numeric(15,2) NOT NULL, -- precio
  lab_ori_can integer, -- cantidad
  lab_ori_desl numeric(10,2), -- descuento laboratorio
  lab_ori_valor numeric(10,2), -- subtotal
  lab_ori_exa_dt timestamp without time zone, -- fecha de realizacion del examen
  lab_ori_exa_ranmin character varying(100), -- rango minimo
  lab_ori_exa_ranmax character varying(100), -- rango maximo
  lab_ori_exa_res character varying(100), -- resultado del examen
  lab_ori_sta "char", -- estatus del registro 1=creacion 2=edicion 3=borrado
  lab_ori_dt timestamp without time zone, -- fecha de actualizacion
  lab_ori_usr character varying(15), -- ID del usuario que actualiza
  CONSTRAINT lab_ori_pkey PRIMARY KEY (lab_ori_cod, lab_ori_gpo_id, lab_ori_exa_id)
)
WITH (
  OIDS=FALSE
);
ALTER TABLE public.labclinicos_orden_items
  OWNER TO postgres;
COMMENT ON COLUMN public.labclinicos_orden_items.lab_ori_cod IS 'Id de orden';
COMMENT ON COLUMN public.labclinicos_orden_items.lab_ori_tipo IS '1=orden del medico 2=orden de internet 3=orden en tienda';
COMMENT ON COLUMN public.labclinicos_orden_items.lab_ori_pac_id IS 'ID del paciente';
COMMENT ON COLUMN public.labclinicos_orden_items.lab_ori_med_id IS 'ID del medico';
COMMENT ON COLUMN public.labclinicos_orden_items.lab_ori_gpo_id IS 'ID del grupo de items';
COMMENT ON COLUMN public.labclinicos_orden_items.lab_ori_exa_id IS 'ID del item';
COMMENT ON COLUMN public.labclinicos_orden_items.lab_ori_pre IS 'precio';
COMMENT ON COLUMN public.labclinicos_orden_items.lab_ori_can IS 'cantidad';
COMMENT ON COLUMN public.labclinicos_orden_items.lab_ori_desl IS 'descuento laboratorio';
COMMENT ON COLUMN public.labclinicos_orden_items.lab_ori_valor IS 'subtotal';
COMMENT ON COLUMN public.labclinicos_orden_items.lab_ori_exa_dt IS 'fecha de realizacion del examen';
COMMENT ON COLUMN public.labclinicos_orden_items.lab_ori_exa_ranmin IS 'rango minimo';
COMMENT ON COLUMN public.labclinicos_orden_items.lab_ori_exa_ranmax IS 'rango maximo';
COMMENT ON COLUMN public.labclinicos_orden_items.lab_ori_exa_res IS 'resultado del examen';
COMMENT ON COLUMN public.labclinicos_orden_items.lab_ori_sta IS 'estatus del registro 1=creacion 2=edicion 3=borrado';
COMMENT ON COLUMN public.labclinicos_orden_items.lab_ori_dt IS 'fecha de actualizacion';
COMMENT ON COLUMN public.labclinicos_orden_items.lab_ori_usr IS 'ID del usuario que actualiza';



CREATE TABLE public.medical
(
  pac_pam_code integer NOT NULL, -- ID interno del paciente
  pac_pam_med_nom1 character varying(25), -- nombre 1 del medico de cabecera
  pac_pam_med_nom2 character varying(25), -- nombre 2 del medico de cabecera
  pac_pam_med_ape1 character varying(25), -- apellido 1 del medico de cabecera
  pac_pam_med_ape2 character varying(25), -- apellido 2 del medico de cabecera
  pac_pam_med_ape3 character varying(25), -- apellido de casada del medico de cabecera
  pac_pam_med_esp character varying(5), -- ID de la especializacion
  pac_pam_med_dti date, -- Fecha de inicio de relacion
  pac_pam_med_dtf date, -- Fecha de fin de relacion
  pac_pam_med_obs text, -- Observaciones
  pac_pam_seguro smallint, -- Cuenta con seguro 1=si 2=no
  pac_pam_ase_nit character varying(20), -- Numero de NIT de la aseguradora
  pac_pam_ase_nom character varying(50), -- Nombre de la aseguradora (en caso de no estar en la lista)
  pac_pam_sta "char", -- estatus del registro 1=creacion 2=edicion 3=borrado
  pac_pam_dt timestamp without time zone, -- fecha de actualizacion
  pac_pam_usr character varying(15), -- ID del usuario que actualiza
  CONSTRAINT pac_pam_pkey PRIMARY KEY (pac_pam_code)
)
WITH (
  OIDS=FALSE
);
ALTER TABLE public.medical
  OWNER TO postgres;
COMMENT ON COLUMN public.medical.pac_pam_code IS 'ID interno del paciente';
COMMENT ON COLUMN public.medical.pac_pam_med_nom1 IS 'nombre 1 del medico de cabecera';
COMMENT ON COLUMN public.medical.pac_pam_med_nom2 IS 'nombre 2 del medico de cabecera';
COMMENT ON COLUMN public.medical.pac_pam_med_ape1 IS 'apellido 1 del medico de cabecera';
COMMENT ON COLUMN public.medical.pac_pam_med_ape2 IS 'apellido 2 del medico de cabecera';
COMMENT ON COLUMN public.medical.pac_pam_med_ape3 IS 'apellido de casada del medico de cabecera';
COMMENT ON COLUMN public.medical.pac_pam_med_esp IS 'ID de la especializacion';
COMMENT ON COLUMN public.medical.pac_pam_med_dti IS 'Fecha de inicio de relacion';
COMMENT ON COLUMN public.medical.pac_pam_med_dtf IS 'Fecha de fin de relacion';
COMMENT ON COLUMN public.medical.pac_pam_med_obs IS 'Observaciones';
COMMENT ON COLUMN public.medical.pac_pam_seguro IS 'Cuenta con seguro 1=si 2=no';
COMMENT ON COLUMN public.medical.pac_pam_ase_nit IS 'Numero de NIT de la aseguradora';
COMMENT ON COLUMN public.medical.pac_pam_ase_nom IS 'Nombre de la aseguradora (en caso de no estar en la lista)';
COMMENT ON COLUMN public.medical.pac_pam_sta IS 'estatus del registro 1=creacion 2=edicion 3=borrado';
COMMENT ON COLUMN public.medical.pac_pam_dt IS 'fecha de actualizacion';
COMMENT ON COLUMN public.medical.pac_pam_usr IS 'ID del usuario que actualiza';


CREATE TABLE public.medical_hist
(
  pac_pamh_code character varying(8) NOT NULL, -- ID interno del paciente
  pac_pamh_med_nom1 character varying(25), -- nombre 1
  pac_pamh_med_nom2 character varying(25), -- nombre 2
  pac_pamh_med_ape1 character varying(25), -- apellido 1
  pac_pamh_med_ape2 character varying(25), -- apellido 2
  pac_pamh_med_ape3 character varying(25), -- apellido de casada
  pac_pamh_med_esp character varying(5), -- ID de la especializacion
  pac_pamh_med_dti date, -- Fecha de inicio de relacion
  pac_pamh_med_dtf date, -- Fecha de fin de relacion
  pac_pamh_med_obs text, -- Observaciones
  pac_pamh_sta "char", -- estatus del registro 1=creacion 2=edicion 3=borrado
  pac_pamh_dt timestamp without time zone, -- fecha de actualizacion
  pac_pamh_usr character varying(15), -- ID del usuario que actualiza
  CONSTRAINT pac_pamh_pkey PRIMARY KEY (pac_pamh_code)
)
WITH (
  OIDS=FALSE
);
ALTER TABLE public.medical_hist
  OWNER TO postgres;
COMMENT ON COLUMN public.medical_hist.pac_pamh_code IS 'ID interno del paciente';
COMMENT ON COLUMN public.medical_hist.pac_pamh_med_nom1 IS 'nombre 1';
COMMENT ON COLUMN public.medical_hist.pac_pamh_med_nom2 IS 'nombre 2';
COMMENT ON COLUMN public.medical_hist.pac_pamh_med_ape1 IS 'apellido 1';
COMMENT ON COLUMN public.medical_hist.pac_pamh_med_ape2 IS 'apellido 2';
COMMENT ON COLUMN public.medical_hist.pac_pamh_med_ape3 IS 'apellido de casada';
COMMENT ON COLUMN public.medical_hist.pac_pamh_med_esp IS 'ID de la especializacion';
COMMENT ON COLUMN public.medical_hist.pac_pamh_med_dti IS 'Fecha de inicio de relacion';
COMMENT ON COLUMN public.medical_hist.pac_pamh_med_dtf IS 'Fecha de fin de relacion';
COMMENT ON COLUMN public.medical_hist.pac_pamh_med_obs IS 'Observaciones';
COMMENT ON COLUMN public.medical_hist.pac_pamh_sta IS 'estatus del registro 1=creacion 2=edicion 3=borrado';
COMMENT ON COLUMN public.medical_hist.pac_pamh_dt IS 'fecha de actualizacion';
COMMENT ON COLUMN public.medical_hist.pac_pamh_usr IS 'ID del usuario que actualiza';



CREATE TABLE public.medicos_consultas
(
  med_con_id integer NOT NULL, -- ID de la consulta
  med_con_med_id character varying(8) NOT NULL, -- ID interno del medico
  med_con_pac_id character varying(8) NOT NULL, -- ID interno del paciente
  med_con_cita_dt timestamp without time zone NOT NULL, -- fecha de consulta
  med_con_motivo text, -- motivo de la consulta
  med_con_examen text, -- examen realizado
  med_con_receta text, -- descripcion de la receta
  med_con_dieta text, -- descripcion de la dieta
  med_con_observa text, -- observaciones
  med_con_sta "char", -- estatus del registro 1=creacion 2=edicion 3=borrado
  med_con_dt timestamp without time zone, -- fecha de actualizacion
  med_con_usr character varying(15), -- ID del usuario que actualiza
  CONSTRAINT med_con_pkey PRIMARY KEY (med_con_id, med_con_med_id, med_con_pac_id, med_con_cita_dt)
)
WITH (
  OIDS=FALSE
);
ALTER TABLE public.medicos_consultas
  OWNER TO postgres;
COMMENT ON COLUMN public.medicos_consultas.med_con_id IS 'ID de la consulta';
COMMENT ON COLUMN public.medicos_consultas.med_con_med_id IS 'ID interno del medico';
COMMENT ON COLUMN public.medicos_consultas.med_con_pac_id IS 'ID interno del paciente';
COMMENT ON COLUMN public.medicos_consultas.med_con_cita_dt IS 'fecha de consulta';
COMMENT ON COLUMN public.medicos_consultas.med_con_motivo IS 'motivo de la consulta';
COMMENT ON COLUMN public.medicos_consultas.med_con_examen IS 'examen realizado';
COMMENT ON COLUMN public.medicos_consultas.med_con_receta IS 'descripcion de la receta';
COMMENT ON COLUMN public.medicos_consultas.med_con_dieta IS 'descripcion de la dieta';
COMMENT ON COLUMN public.medicos_consultas.med_con_observa IS 'observaciones';
COMMENT ON COLUMN public.medicos_consultas.med_con_sta IS 'estatus del registro 1=creacion 2=edicion 3=borrado';
COMMENT ON COLUMN public.medicos_consultas.med_con_dt IS 'fecha de actualizacion';
COMMENT ON COLUMN public.medicos_consultas.med_con_usr IS 'ID del usuario que actualiza';


CREATE TABLE public.medicos_consultas_productos
(
  med_cop_id integer NOT NULL, -- Id de la consulta
  med_cop_med_id character varying(8) NOT NULL, -- ID de la medico
  med_cop_pac_id character varying(8) NOT NULL, -- ID de la paciente
  med_cop_far_id character varying(8) NOT NULL, -- ID de la farmacia
  med_cop_pro_id character varying(20) NOT NULL, -- ID del producto
  med_cop_pre numeric(15,2) NOT NULL, -- precio
  med_cop_can integer, -- cantidad
  med_cop_desf numeric(10,2), -- descuento farmacia
  med_cop_desl numeric(10,2), -- descuento laboratorio
  med_cop_valor numeric(10,2), -- subtotal
  med_cop_sta "char", -- estatus del registro 1=creacion 2=edicion 3=borrado
  med_cop_dt timestamp without time zone, -- fecha de actualizacion
  med_cop_usr character varying(15), -- ID del usuario que actualiza
  CONSTRAINT med_cop_pkey PRIMARY KEY (med_cop_id, med_cop_med_id, med_cop_pac_id, med_cop_far_id, med_cop_pro_id)
)
WITH (
  OIDS=FALSE
);
ALTER TABLE public.medicos_consultas_productos
  OWNER TO postgres;
COMMENT ON COLUMN public.medicos_consultas_productos.med_cop_id IS 'Id de la consulta';
COMMENT ON COLUMN public.medicos_consultas_productos.med_cop_med_id IS 'ID de la medico';
COMMENT ON COLUMN public.medicos_consultas_productos.med_cop_pac_id IS 'ID de la paciente';
COMMENT ON COLUMN public.medicos_consultas_productos.med_cop_far_id IS 'ID de la farmacia';
COMMENT ON COLUMN public.medicos_consultas_productos.med_cop_pro_id IS 'ID del producto';
COMMENT ON COLUMN public.medicos_consultas_productos.med_cop_pre IS 'precio';
COMMENT ON COLUMN public.medicos_consultas_productos.med_cop_can IS 'cantidad';
COMMENT ON COLUMN public.medicos_consultas_productos.med_cop_desf IS 'descuento farmacia';
COMMENT ON COLUMN public.medicos_consultas_productos.med_cop_desl IS 'descuento laboratorio';
COMMENT ON COLUMN public.medicos_consultas_productos.med_cop_valor IS 'subtotal';
COMMENT ON COLUMN public.medicos_consultas_productos.med_cop_sta IS 'estatus del registro 1=creacion 2=edicion 3=borrado';
COMMENT ON COLUMN public.medicos_consultas_productos.med_cop_dt IS 'fecha de actualizacion';
COMMENT ON COLUMN public.medicos_consultas_productos.med_cop_usr IS 'ID del usuario que actualiza';


CREATE TABLE public.medicos_consultas_vacunas
(
  med_cov_id integer NOT NULL, -- Id de la consulta
  med_cov_med_id character varying(8) NOT NULL, -- ID de la medico
  med_cov_pac_id character varying(8) NOT NULL, -- ID de la paciente
  med_cov_vac_id character varying(10) NOT NULL, -- ID de la vacuna
  med_cov_mat character varying(50) NOT NULL, -- material
  med_cov_dosis character varying(50) NOT NULL, -- dosis
  med_cov_obs text, -- observaciones
  med_cov_sta "char", -- estatus del registro 1=creacion 2=edicion 3=borrado
  med_cov_dt timestamp without time zone, -- fecha de actualizacion
  med_cov_usr character varying(15), -- ID del usuario que actualiza
  CONSTRAINT med_cov_pkey PRIMARY KEY (med_cov_id, med_cov_med_id, med_cov_pac_id, med_cov_vac_id)
)
WITH (
  OIDS=FALSE
);
ALTER TABLE public.medicos_consultas_vacunas
  OWNER TO postgres;
COMMENT ON COLUMN public.medicos_consultas_vacunas.med_cov_id IS 'Id de la consulta';
COMMENT ON COLUMN public.medicos_consultas_vacunas.med_cov_med_id IS 'ID de la medico';
COMMENT ON COLUMN public.medicos_consultas_vacunas.med_cov_pac_id IS 'ID de la paciente';
COMMENT ON COLUMN public.medicos_consultas_vacunas.med_cov_vac_id IS 'ID de la vacuna';
COMMENT ON COLUMN public.medicos_consultas_vacunas.med_cov_mat IS 'material';
COMMENT ON COLUMN public.medicos_consultas_vacunas.med_cov_dosis IS 'dosis';
COMMENT ON COLUMN public.medicos_consultas_vacunas.med_cov_obs IS 'observaciones';
COMMENT ON COLUMN public.medicos_consultas_vacunas.med_cov_sta IS 'estatus del registro 1=creacion 2=edicion 3=borrado';
COMMENT ON COLUMN public.medicos_consultas_vacunas.med_cov_dt IS 'fecha de actualizacion';
COMMENT ON COLUMN public.medicos_consultas_vacunas.med_cov_usr IS 'ID del usuario que actualiza';


CREATE TABLE public.pagos
(
  pac_pap_code character varying(8) NOT NULL, -- ID interno del paciente
  pac_pap_id integer NOT NULL, -- numero de pago (correlativo automatico)
  pac_pap_che "char", -- Cheque 1=si 0=no
  pac_pap_che_banco character varying(5), -- ID del banco
  pac_pap_che_dt date, -- Fecha de cobro
  pac_pap_che_num character varying(20), -- numero del cheque
  pac_pap_che_val numeric(15,2), -- valor del cheque
  pac_pap_dep "char", -- Deposito 1=si 0=no
  pac_pap_dep_dt date, -- Fecha del deposito
  pac_pap_dep_banco character varying(5),
  pac_pap_dep_num character varying(20), -- numero del deposito
  pac_pap_dep_val numeric(15,2), -- valor del deposito
  pac_pap_deb "char", -- Debito 1=si 0=no
  pac_pap_deb_banco character varying(5), -- ID del banco
  pac_pap_deb_cta character varying(25), -- Fecha de cobro
  pac_pap_deb_num integer, -- numero de debitos
  pac_pap_deb_val numeric(15,2), -- valor de cada debito
  pac_pap_sta "char", -- estatus del registro 1=creacion 2=edicion 3=borrado
  pac_pap_dt timestamp without time zone, -- fecha de actualizacion
  pac_pap_usr character varying(15), -- ID del usuario que actualiza
  CONSTRAINT pac_pap_pkey PRIMARY KEY (pac_pap_code, pac_pap_id)
)
WITH (
  OIDS=FALSE
);
ALTER TABLE public.pagos
  OWNER TO postgres;
COMMENT ON COLUMN public.pagos.pac_pap_code IS 'ID interno del paciente';
COMMENT ON COLUMN public.pagos.pac_pap_id IS 'numero de pago (correlativo automatico)';
COMMENT ON COLUMN public.pagos.pac_pap_che IS 'Cheque 1=si 0=no';
COMMENT ON COLUMN public.pagos.pac_pap_che_banco IS 'ID del banco';
COMMENT ON COLUMN public.pagos.pac_pap_che_dt IS 'Fecha de cobro';
COMMENT ON COLUMN public.pagos.pac_pap_che_num IS 'numero del cheque';
COMMENT ON COLUMN public.pagos.pac_pap_che_val IS 'valor del cheque';
COMMENT ON COLUMN public.pagos.pac_pap_dep IS 'Deposito 1=si 0=no';
COMMENT ON COLUMN public.pagos.pac_pap_dep_dt IS 'Fecha del deposito';
COMMENT ON COLUMN public.pagos.pac_pap_dep_num IS 'numero del deposito';
COMMENT ON COLUMN public.pagos.pac_pap_dep_val IS 'valor del deposito';
COMMENT ON COLUMN public.pagos.pac_pap_deb IS 'Debito 1=si 0=no';
COMMENT ON COLUMN public.pagos.pac_pap_deb_banco IS 'ID del banco';
COMMENT ON COLUMN public.pagos.pac_pap_deb_cta IS 'Fecha de cobro';
COMMENT ON COLUMN public.pagos.pac_pap_deb_num IS 'numero de debitos';
COMMENT ON COLUMN public.pagos.pac_pap_deb_val IS 'valor de cada debito';
COMMENT ON COLUMN public.pagos.pac_pap_sta IS 'estatus del registro 1=creacion 2=edicion 3=borrado';
COMMENT ON COLUMN public.pagos.pac_pap_dt IS 'fecha de actualizacion';
COMMENT ON COLUMN public.pagos.pac_pap_usr IS 'ID del usuario que actualiza';

CREATE TABLE public.seguro_hist
(
  pac_pash_code character varying(8) NOT NULL, -- ID interno del paciente
  pac_pash_id integer, -- ID interno (correlativo automatico)
  pac_pash_seguro smallint, -- Cuenta con seguro 1=si 2=no
  pac_pash_ase_nit character varying(20), -- Numero de NIT de la aseguradora
  pac_pash_ase_nom character varying(50), -- Nombre de la aseguradora (en caso de no estar en la lista)
  pac_pash_ase_dti date, -- Fecha de inicio de la relacion
  pac_pash_ase_dtf date, -- Fecha de fin de la relacion
  pac_pash_ase_obs text, -- Observaciones
  pac_pash_sta "char", -- estatus del registro 1=creacion 2=edicion 3=borrado
  pac_pash_dt timestamp without time zone, -- fecha de actualizacion
  pac_pash_usr character varying(15), -- ID del usuario que actualiza
  CONSTRAINT pac_pash_pkey PRIMARY KEY (pac_pash_code)
)
WITH (
  OIDS=FALSE
);
ALTER TABLE public.seguro_hist
  OWNER TO postgres;
COMMENT ON COLUMN public.seguro_hist.pac_pash_code IS 'ID interno del paciente';
COMMENT ON COLUMN public.seguro_hist.pac_pash_id IS 'ID interno (correlativo automatico)';
COMMENT ON COLUMN public.seguro_hist.pac_pash_seguro IS 'Cuenta con seguro 1=si 2=no';
COMMENT ON COLUMN public.seguro_hist.pac_pash_ase_nit IS 'Numero de NIT de la aseguradora';
COMMENT ON COLUMN public.seguro_hist.pac_pash_ase_nom IS 'Nombre de la aseguradora (en caso de no estar en la lista)';
COMMENT ON COLUMN public.seguro_hist.pac_pash_ase_dti IS 'Fecha de inicio de la relacion';
COMMENT ON COLUMN public.seguro_hist.pac_pash_ase_dtf IS 'Fecha de fin de la relacion';
COMMENT ON COLUMN public.seguro_hist.pac_pash_ase_obs IS 'Observaciones';
COMMENT ON COLUMN public.seguro_hist.pac_pash_sta IS 'estatus del registro 1=creacion 2=edicion 3=borrado';
COMMENT ON COLUMN public.seguro_hist.pac_pash_dt IS 'fecha de actualizacion';
COMMENT ON COLUMN public.seguro_hist.pac_pash_usr IS 'ID del usuario que actualiza';

























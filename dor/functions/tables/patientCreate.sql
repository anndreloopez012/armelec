CREATE OR REPLACE FUNCTION create_table_patient_date 
                                        ( v_date varchar ,) 
 RETURNS void AS $$
    BEGIN
    
        CREATE TABLE "2021_farmacias_orden" AS SELECT * FROM farmacias_orden WHERE far_ord_cod = 1;
        ALTER TABLE "2021_farmacias_orden" ADD CONSTRAINT "2021_pacfar_ord_pkey" PRIMARY KEY (far_ord_cod, far_ord_tipo, far_ord_med_id, far_ord_pac_id);

        CREATE TABLE "2021_farmacias_orden_prod" AS SELECT * FROM farmacias_orden_prod WHERE far_orp_cod = 1;
        ALTER TABLE "2021_farmacias_orden_prod" ADD CONSTRAINT "2021_far_orp_pkey" PRIMARY KEY (far_orp_cod, far_orp_pro_id, far_orp_med_id, far_orp_pac_id);

		
 END;
    $$ LANGUAGE plpgsql;




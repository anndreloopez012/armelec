CREATE OR REPLACE FUNCTION "public"."system_06011007"("v_cod" int4,
                                                    "v_ctg_tps_id" varchar,
                                                    "v_ctg_tps_desc" varchar,
                                                    "v_ctg_tps_obs" varchar, 
                                                    "v_ctg_tpr_id" varchar, 
                                                    "v_ctg_tps_sta" bpchar, 
                                                    "v_ctg_tps_usr" varchar, 
                                                    "v_ctg_tps_dt" date, 
                                                    "v_ctg_id" int4, 
                                                    "v_max_id" int4)
  RETURNS "pg_catalog"."void" AS $BODY$
    BEGIN

		IF v_cod = 1 THEN
			INSERT 
            INTO ctg_tipo_productos_estatus(ctg_tps_id,
                                              ctg_tps_desc,
                                              ctg_tps_obs,
                                              ctg_tpr_id,
                                              ctg_tps_sta,
                                              ctg_tps_usr,
                                              ctg_tps_dt,
                                              ctg_id
                                              )
			VALUES(v_ctg_tps_id,
                    v_ctg_tps_desc,
                    v_ctg_tps_obs,
                    v_ctg_tpr_id,
                    v_ctg_tps_sta,
                    v_ctg_tps_usr,
                    v_ctg_tps_dt,
                    v_max_id
                    );
		END IF;
		
		IF v_cod = 2 THEN
			UPDATE 
				ctg_tipo_productos_estatus 
			SET
                ctg_tps_desc = v_ctg_tps_desc,
                ctg_tps_obs = v_ctg_tps_obs,
                ctg_tpr_id = v_ctg_tpr_id,
                ctg_tps_sta = '2',
                ctg_tps_usr = v_ctg_tps_usr,
                ctg_tps_dt = v_ctg_tps_dt
			WHERE 
				ctg_id = v_ctg_id;
		END IF;
		
		IF v_cod = 3 THEN
			UPDATE 
				ctg_tipo_productos_estatus 
			SET
				ctg_tps_sta = '3'
			WHERE 
				ctg_id = v_ctg_id;
		END IF;
		
 END;
    $BODY$
  LANGUAGE plpgsql VOLATILE
  COST 1000
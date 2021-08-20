CREATE OR REPLACE FUNCTION "public"."system_06011002"("v_cod" int4, "v_ctg_tpc_id" varchar, "v_ctg_tpc_desc" varchar, "v_ctg_tpc_obs" varchar, "v_ctg_tpr_id" varchar, "v_ctg_tpc_jun" int4, "v_ctg_tpc_com" int4, "v_ctg_tpc_res" int4, "v_ctg_tpc_vus" int4, "v_ctg_tpc_sta" bpchar, "v_ctg_tpc_usr" varchar, "v_ctg_tpc_dt" date, "v_ctg_id" bpchar, "v_ctg_id_max" int4)
  RETURNS "pg_catalog"."void" AS $BODY$
    BEGIN

		IF v_cod = 1 THEN
			INSERT 
            INTO ctg_tipo_productos_categorias(ctg_tpc_id,
                                              ctg_tpc_desc,
                                              ctg_tpc_obs,
                                              ctg_tpr_id,
                                              ctg_tpc_jun,
                                              ctg_tpc_com,
                                              ctg_tpc_res,
                                              ctg_tpc_vus,
                                              ctg_tpc_sta,
                                              ctg_tpc_usr,
                                              ctg_tpc_dt,
                                              ctg_id
                                              )
			VALUES(v_ctg_tpc_id,
                    v_ctg_tpc_desc,
                    v_ctg_tpc_obs,
                    v_ctg_tpr_id,
                    v_ctg_tpc_jun,
                    v_ctg_tpc_com,
                    v_ctg_tpc_res,
                    v_ctg_tpc_vus,
                    v_ctg_tpc_sta,
                    v_ctg_tpc_usr,
                    v_ctg_tpc_dt,
                    v_ctg_id_max
                    );
		END IF;
		
		IF v_cod = 2 THEN
			UPDATE 
				ctg_tipo_productos_categorias 
			SET
                ctg_tpc_desc = v_ctg_tpc_desc,
                ctg_tpc_obs = v_ctg_tpc_obs,
                ctg_tpr_id = v_ctg_tpr_id,
                ctg_tpc_jun = v_ctg_tpc_jun,
                ctg_tpc_com = v_ctg_tpc_com,
                ctg_tpc_res = v_ctg_tpc_res,
                ctg_tpc_vus = v_ctg_tpc_vus,
                ctg_tpc_sta = '2',
                ctg_tpc_usr = v_ctg_tpc_usr,
                ctg_tpc_dt = v_ctg_tpc_dt
			WHERE 
				ctg_id = v_ctg_id;
		END IF;
		
		IF v_cod = 3 THEN
			UPDATE 
				ctg_tipo_productos_categorias 
			SET
				ctg_tpc_sta = '3'
			WHERE 
				ctg_id = v_ctg_id;
		END IF;
		
 END;
    $BODY$
  LANGUAGE plpgsql VOLATILE
  COST 1000
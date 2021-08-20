CREATE OR REPLACE FUNCTION "public"."system_06010101"("v_cod" int4,
                                                    "v_adm_name" varchar,
                                                    "v_adm_btn" varchar,
                                                    "v_adm_rtu" varchar,
                                                    "v_adm_status" int,
                                                    "v_adm_usr" varchar,
                                                    "v_adm_date" date,
                                                    "v_adm_order" int,
                                                    "v_adm_user" int,
                                                    "v_ctg_obs" text,
                                                    "v_id" int ,
                                                    "v_max_id" int 
                                                            )
  RETURNS "pg_catalog"."void" AS $BODY$
    BEGIN

		IF v_cod = 1 THEN
			INSERT 
            INTO ctg_modulos_l(adm_name,
                                adm_btn,
                                adm_rtu,
                                adm_status,
                                adm_usr,
                                adm_date,
                                adm_order,
                                adm_user,
                                ctg_obs,
                                id
                                    )
			VALUES(v_adm_name,
                    v_adm_btn,
                    v_adm_rtu,
                    v_adm_status,
                    v_adm_usr,
                    v_adm_date,
                    v_adm_order,
                    v_adm_user,
                    v_ctg_obs,
                    v_max_id
                            );
		END IF;
		
		IF v_cod = 2 THEN
			UPDATE 
				ctg_modulos_l
			SET
                adm_name = v_adm_name ,
                adm_btn = v_adm_btn ,
                adm_rtu = v_adm_rtu ,
                adm_status = v_adm_status ,
                adm_usr = v_adm_usr ,
                adm_date = v_adm_date ,
                adm_order = v_adm_order ,
                adm_user = v_adm_user ,
                ctg_obs = v_ctg_obs 
                
			WHERE 
				id = v_id;
		END IF;
		
		IF v_cod = 3 THEN
		  DELETE FROM ctg_modulos_l
			WHERE id = v_id ;
		END IF;
		
 END;
    $BODY$
  LANGUAGE plpgsql VOLATILE
  COST 1000
CREATE OR REPLACE FUNCTION "public"."system_06010102"("v_cod" int4,
                                                    "v_adm_order" varchar,
                                                    "v_adm_nombre_menu" varchar,
                                                    "v_adm_descrip" varchar,
                                                    "v_adm_link" varchar,
                                                    "v_adm_usr" varchar,
                                                    "v_adm_activo" int,
                                                    "v_adm_dt" date,
                                                    "v_adm_contenido" int,
                                                    "v_adm_obs" text,
                                                    "v_adm_status" varchar,
                                                    "v_id" int,
                                                    "v_max_id" int 
                                                            )
  RETURNS "pg_catalog"."void" AS $BODY$
    BEGIN

		IF v_cod = 1 THEN
			INSERT 
            INTO ctg_modulos_ll(adm_order,
                                adm_nombre_menu,
                                adm_descrip,
                                adm_link,
                                adm_usr,
                                adm_activo,
                                adm_dt,
                                adm_contenido,
                                adm_obs,
                                adm_status,
                                id
                                    )
			VALUES(v_adm_order,
                    v_adm_nombre_menu,
                    v_adm_descrip,
                    v_adm_link,
                    v_adm_usr,
                    v_adm_activo,
                    v_adm_dt,
                    v_adm_contenido,
                    v_adm_obs,
                    v_adm_status,
                    v_max_id
                            );
		END IF;
		
		IF v_cod = 2 THEN
			UPDATE 
				ctg_modulos_ll 
			SET
                adm_order = v_adm_order ,
                adm_nombre_menu = v_adm_nombre_menu ,
                adm_descrip = v_adm_descrip ,
                adm_link = v_adm_link ,
                adm_usr = v_adm_usr ,
                adm_activo = v_adm_activo ,
                adm_dt = v_adm_dt ,
                adm_contenido = v_adm_contenido ,
                adm_obs = v_adm_obs ,
                adm_status = v_adm_status 
                
			WHERE 
				id = v_id;
		END IF;
		
		IF v_cod = 3 THEN
		  DELETE FROM ctg_modulos_ll 
			WHERE id = v_id ;
		END IF;
		
 END;
    $BODY$
  LANGUAGE plpgsql VOLATILE
  COST 1000
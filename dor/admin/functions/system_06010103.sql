CREATE OR REPLACE FUNCTION "public"."system_06010103"("v_cod" int4,
                                                    "v_adm_order" varchar,
                                                    "v_adm_name" varchar,
                                                    "v_adm_descrip" varchar,
                                                    "v_adm_link" varchar,
                                                    "v_adm_usr" varchar,
                                                    "v_adm_sta" int,
                                                    "v_adm_dt" date,
                                                    "v_id" int,
                                                    "v_max_id" int ,
                                                    "v_id_modulo_ll" int,
                                                    "v_id_modulo" int
                                                            )
  RETURNS "pg_catalog"."void" AS $BODY$
    BEGIN

		IF v_cod = 1 THEN
			INSERT 
            INTO ctg_modulos_lll(adm_order,
                                adm_name,
                                adm_descrip,
                                adm_link,
                                adm_usr,
                                adm_sta,
                                adm_dt,
                                id_modulo_ll,
                                id_modulo,
                                id
                                    )
			VALUES(v_adm_order,
            v_adm_name,
            v_adm_descrip,
            v_adm_link,
            v_adm_usr,
            v_adm_sta,
            v_adm_dt,
            v_id_modulo_ll,
            v_id_modulo,
            v_max_id
                    );
		END IF;
		
		IF v_cod = 2 THEN
			UPDATE 
				ctg_modulos_lll 
			SET
                adm_order = v_adm_order ,
                adm_name = v_adm_name ,
                adm_descrip = v_adm_descrip ,
                adm_link = v_adm_link ,
                adm_usr = v_adm_usr ,
                adm_sta = v_adm_sta ,
                adm_dt = v_adm_dt ,
                id_modulo_ll = v_id_modulo_ll ,
                id_modulo = v_id_modulo 
                
			WHERE 
				id = v_id;
		END IF;
		
		IF v_cod = 3 THEN
		  DELETE FROM ctg_modulos_lll 
			WHERE id = v_id ;
		END IF;
		
 END;
    $BODY$
  LANGUAGE plpgsql VOLATILE
  COST 1000
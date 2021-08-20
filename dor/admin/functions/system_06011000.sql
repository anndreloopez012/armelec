CREATE OR REPLACE FUNCTION "public"."system_06011000"("v_cod" int4, "v_ctg_are_id" varchar, "v_ctg_are_desc" varchar, "v_ctg_are_obs" text, "v_ctg_are_siglas" varchar, "v_ctg_are_sta" varchar, "v_ctg_are_usr" varchar, "v_ctg_are_dt" date)
  RETURNS "pg_catalog"."void" AS $BODY$
    BEGIN

		IF v_cod = 1 THEN
			INSERT 
            INTO ctg_areas(ctg_are_id,
                                    ctg_are_desc,
                                    ctg_are_obs,
                                    ctg_are_siglas,
                                    ctg_are_sta,
                                    ctg_are_usr,
                                    ctg_are_dt
                                    )
			VALUES( v_ctg_are_id,
                    v_ctg_are_desc,
                    v_ctg_are_obs,
                    v_ctg_are_siglas,
                    v_ctg_are_sta,
                    v_ctg_are_usr,
                    v_ctg_are_dt
                    );
		END IF;
		
		IF v_cod = 2 THEN
			UPDATE 
				ctg_areas 
			SET
                ctg_are_desc = v_ctg_are_desc ,
                ctg_are_obs = v_ctg_are_obs ,
                ctg_are_siglas = v_ctg_are_siglas ,
                ctg_are_sta = '2',
                ctg_are_usr = v_ctg_are_usr ,
                ctg_are_dt = v_ctg_are_dt
                
			WHERE 
				ctg_are_id = v_ctg_are_id;
		END IF;
    
		IF v_cod = 3 THEN
			UPDATE 
				ctg_areas 
			SET
				ctg_are_sta = '3'
			WHERE 
				ctg_are_id = v_ctg_are_id;
		END IF;

    IF v_cod = 4 THEN
			UPDATE 
				ctg_areas 
			SET
				ctg_are_id = ctg_are_id;
		END IF;
		
 END;
    $BODY$
  LANGUAGE plpgsql VOLATILE
  COST 1000
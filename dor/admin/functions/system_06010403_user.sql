CREATE OR REPLACE FUNCTION "public"."system_06010403_user"("v_cod" int4,
                                                            "v_vus_cal_perini" date,
                                                            "v_vus_cal_perfin" date,
                                                            "v_vus_cal_id" char

)
  RETURNS "pg_catalog"."void" AS $BODY$
    BEGIN

		IF v_cod = 1 THEN
			INSERT 
            INTO vus_config_calendario( vus_cal_perini,
                                            vus_cal_perfin,
                                            vus_cal_id
                                              )
			VALUES( v_vus_cal_perini,
                    v_vus_cal_perfin,
                    v_vus_cal_id
                    );
		END IF;
		
		IF v_cod = 2 THEN
			UPDATE 
				vus_config_calendario 
			SET
				vus_cal_perini = v_vus_cal_perini,
                vus_cal_perfin = v_vus_cal_perfin
			WHERE 
				vus_cal_id = v_vus_cal_id;
		END IF;
		
		IF v_cod = 3 THEN
			DELETE 
            FROM
                vus_config_calendario
			WHERE 
				vus_cal_id = v_vus_cal_id;
		END IF;
		
 END;
    $BODY$
  LANGUAGE plpgsql VOLATILE
  COST 1000
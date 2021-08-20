CREATE OR REPLACE FUNCTION "public"."system_06011006"("v_cod" int4, "v_ctg_tpm_id" varchar, "v_ctg_tpm_desc" varchar, "v_ctg_tpm_campo1" varchar, "v_ctg_tpm_campo2" varchar, "v_ctg_tpm_obs" text, "v_ctg_tpr_id" varchar, "v_ctg_tpm_sta" bpchar, "v_ctg_tpm_usr" varchar, "v_ctg_tpm_dt" date, "v_ctg_id" int4, "v_id" int4)
  RETURNS "pg_catalog"."void" AS $BODY$
    BEGIN

		IF v_cod = 1 THEN
			INSERT 
            INTO ctg_tipo_productos_campos( ctg_tpm_id,
                                            ctg_tpm_desc,
                                            ctg_tpm_campo1,
                                            ctg_tpm_campo2,
                                            ctg_tpm_obs,
                                            ctg_tpr_id,
                                            ctg_tpm_sta,
                                            ctg_tpm_usr,
                                            ctg_tpm_dt,
                                            ctg_id
                                              )
			VALUES( v_ctg_tpm_id,
                    v_ctg_tpm_desc,
                    v_ctg_tpm_campo1,
                    v_ctg_tpm_campo2,
                    v_ctg_tpm_obs,
                    v_ctg_tpr_id,
                    v_ctg_tpm_sta,
                    v_ctg_tpm_usr,
                    v_ctg_tpm_dt,
                    v_ctg_id
                    );
		END IF;
		
		IF v_cod = 2 THEN
			UPDATE 
				ctg_tipo_productos_campos 
			SET
				ctg_tpm_id = v_ctg_tpm_id,
                ctg_tpm_desc = v_ctg_tpm_desc,
                ctg_tpm_campo1 = v_ctg_tpm_campo1,
                ctg_tpm_campo2 = v_ctg_tpm_campo2,
                ctg_tpm_obs = v_ctg_tpm_obs,
                ctg_tpr_id = v_ctg_tpr_id,
                ctg_tpm_sta = '2',
                ctg_tpm_usr = v_ctg_tpm_usr,
                ctg_tpm_dt = v_ctg_tpm_dt
			WHERE 
				ctg_id = v_id;
		END IF;
		
		IF v_cod = 3 THEN
			UPDATE 
				ctg_tipo_productos_campos 
			SET
				ctg_tpm_sta = '3'
			WHERE 
				ctg_id = v_id;
		END IF;
		
 END;
    $BODY$
  LANGUAGE plpgsql VOLATILE
  COST 1000
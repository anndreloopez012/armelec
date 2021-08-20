CREATE OR REPLACE FUNCTION "public"."system_06011004"("v_cod" int4, "v_ctg_frm_id" varchar, "v_ctg_frm_desc" varchar, "v_ctg_frm_obs" text, "v_ctg_tpr_id" varchar, "v_ctg_frm_sta" bpchar, "v_ctg_frm_usr" varchar, "v_ctg_frm_dt" date, "v_ctg_id" int4)
  RETURNS "pg_catalog"."void" AS $BODY$
    BEGIN

		IF v_cod = 1 THEN
			INSERT 
            INTO ctg_formularios( ctg_frm_id,
                                  ctg_frm_desc,
                                  ctg_frm_obs,
                                  ctg_tpr_id,
                                  ctg_frm_sta,
                                  ctg_frm_usr,
                                  ctg_frm_dt,
                                  ctg_id

                                    )
			VALUES( v_ctg_frm_id,
              v_ctg_frm_desc,
              v_ctg_frm_obs,
              v_ctg_tpr_id,
              v_ctg_frm_sta,
              v_ctg_frm_usr,
              v_ctg_frm_dt,
              v_ctg_id
                    );
		END IF;
		
		IF v_cod = 2 THEN
			UPDATE 
				ctg_formularios 
			SET
        ctg_frm_desc = v_ctg_frm_desc,
        ctg_frm_obs = v_ctg_frm_obs,
        ctg_tpr_id = v_ctg_tpr_id,
        ctg_frm_sta = '2',
        ctg_frm_usr = v_ctg_frm_usr,
        ctg_frm_dt = v_ctg_frm_dt
			WHERE 
				ctg_id = v_ctg_id;
		END IF;
		
		IF v_cod = 3 THEN
			UPDATE 
				ctg_formularios 
			SET
				ctg_frm_sta = '3'
			WHERE 
				ctg_id = v_ctg_id;
		END IF;
		
 END;
    $BODY$
  LANGUAGE plpgsql VOLATILE
  COST 1000
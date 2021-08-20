CREATE OR REPLACE FUNCTION "public"."system_06011008"("v_cod" int4,
                                                    "v_ctg_fmt_id" varchar,
                                                    "v_ctg_tpr_id" varchar, 
                                                    "v_ctg_fmt_desc" varchar,
                                                    "v_ctg_fmt_sig" varchar,
                                                    "v_ctg_fmt_cor" int,
                                                    "v_ctg_fmt_nom" varchar,
                                                    "v_ctg_fmt_fec" varchar,
                                                    "v_ctg_fmt_ver" varchar,
                                                    "v_ctg_fmt_arc" varchar,
                                                    "v_ctg_fmt_obs" text,
                                                    "v_ctg_fmt_cer" bpchar,
                                                    "v_ctg_fmt_sta" bpchar, 
                                                    "v_ctg_fmt_usr" varchar, 
                                                    "v_ctg_fmt_dt" date, 
                                                    "v_ctg_id" int4, 
                                                    "v_max_id" int4)
  RETURNS "pg_catalog"."void" AS $BODY$
    BEGIN

		IF v_cod = 1 THEN
			INSERT 
        INTO ctg_tipo_formatos(ctg_fmt_id,
                                ctg_tpr_id,
                                ctg_fmt_desc,
                                ctg_fmt_sig,
                                ctg_fmt_cor,
                                ctg_fmt_nom,
                                ctg_fmt_fec,
                                ctg_fmt_ver,
                                ctg_fmt_arc,
                                ctg_fmt_obs,
                                ctg_fmt_cer,
                                ctg_fmt_sta,
                                ctg_fmt_usr,
                                ctg_fmt_dt,
                                ctg_id
                                              )
			VALUES(v_ctg_fmt_id,
            v_ctg_tpr_id,
            v_ctg_fmt_desc,
            v_ctg_fmt_sig,
            v_ctg_fmt_cor,
            v_ctg_fmt_nom,
            v_ctg_fmt_fec,
            v_ctg_fmt_ver,
            v_ctg_fmt_arc,
            v_ctg_fmt_obs,
            v_ctg_fmt_cer,
            v_ctg_fmt_sta,
            v_ctg_fmt_usr,
            v_ctg_fmt_dt,
            v_max_id
                    );
		END IF;
		
		IF v_cod = 2 THEN
			UPDATE 
				ctg_tipo_formatos 
			SET
        ctg_fmt_id  = v_ctg_fmt_id,
        ctg_tpr_id  = v_ctg_tpr_id,
        ctg_fmt_desc  = v_ctg_fmt_desc,
        ctg_fmt_sig  = v_ctg_fmt_sig,
        ctg_fmt_cor  = v_ctg_fmt_cor,
        ctg_fmt_nom  = v_ctg_fmt_nom,
        ctg_fmt_fec  = v_ctg_fmt_fec,
        ctg_fmt_ver  = v_ctg_fmt_ver,
        ctg_fmt_arc  = v_ctg_fmt_arc,
        ctg_fmt_obs  = v_ctg_fmt_obs,
        ctg_fmt_cer  = v_ctg_fmt_cer,
        ctg_fmt_sta  = v_ctg_fmt_sta,
        ctg_fmt_usr  = v_ctg_fmt_usr,
        ctg_fmt_dt  = v_ctg_fmt_dt
			WHERE 
				ctg_id = v_ctg_id;
		END IF;
		
		IF v_cod = 3 THEN
			UPDATE 
				ctg_tipo_formatos 
			SET
				ctg_fmt_sta = '3'
			WHERE 
				ctg_id = v_ctg_id;
		END IF;
		
 END;
    $BODY$
  LANGUAGE plpgsql VOLATILE
  COST 1000
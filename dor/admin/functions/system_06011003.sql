CREATE OR REPLACE FUNCTION "public"."system_06011003"("v_cod" int,
                                                      "v_ctg_rol_id" varchar,
                                                      "v_ctg_rol_desc" varchar,
                                                      "v_ctg_rol_obs" text,
                                                      "v_ctg_rol_tit" int,
                                                      "v_ctg_rol_prop" int,
                                                      "v_ctg_rol_repr" int,
                                                      "v_ctg_rol_fabr" int,
                                                      "v_ctg_rol_enva" int,
                                                      "v_ctg_rol_dist" int,
                                                      "v_ctg_rol_alma" int,
                                                      "v_ctg_rol_impo" int,
                                                      "v_ctg_rol_labo" int,
                                                      "v_ctg_rol_otr" int,
                                                      "v_ctg_rol_acon" int,
                                                      "v_ctg_rol_pat" int,
                                                      "v_ctg_rol_patadj" int,
                                                      "v_ctg_rol_pesc" int,
                                                      "v_ctg_rol_penc" int,
                                                      "v_ctg_rol_remi" int,
                                                      "v_ctg_rol_sta" char,
                                                      "v_ctg_rol_usr" varchar,
                                                      "v_ctg_rol_dt" date,
                                                      "v_id_max" int,
                                                      "v_ctg_id" int
                                                      )
  RETURNS "pg_catalog"."void" AS $BODY$
    BEGIN

		IF v_cod = 1 THEN
			INSERT 
            INTO ctg_rol_empresas(  ctg_rol_id,
                                    ctg_rol_desc,
                                    ctg_rol_obs,
                                    ctg_rol_tit,
                                    ctg_rol_prop,
                                    ctg_rol_repr,
                                    ctg_rol_fabr,
                                    ctg_rol_enva,
                                    ctg_rol_dist,
                                    ctg_rol_alma,
                                    ctg_rol_impo,
                                    ctg_rol_labo,
                                    ctg_rol_otr,
                                    ctg_rol_acon,
                                    ctg_rol_pat,
                                    ctg_rol_patadj,
                                    ctg_rol_pesc,
                                    ctg_rol_penc,
                                    ctg_rol_remi,
                                    ctg_rol_sta,
                                    ctg_rol_usr,
                                    ctg_rol_dt,
                                    ctg_id
                                    )
			VALUES( v_ctg_rol_id,
                    v_ctg_rol_desc,
                    v_ctg_rol_obs,
                    v_ctg_rol_tit,
                    v_ctg_rol_prop,
                    v_ctg_rol_repr,
                    v_ctg_rol_fabr,
                    v_ctg_rol_enva,
                    v_ctg_rol_dist,
                    v_ctg_rol_alma,
                    v_ctg_rol_impo,
                    v_ctg_rol_labo,
                    v_ctg_rol_otr,
                    v_ctg_rol_acon,
                    v_ctg_rol_pat,
                    v_ctg_rol_patadj,
                    v_ctg_rol_pesc,
                    v_ctg_rol_penc,
                    v_ctg_rol_remi,
                    v_ctg_rol_sta,
                    v_ctg_rol_usr,
                    v_ctg_rol_dt,
                    v_id_max
                    );
		END IF;
		
		IF v_cod = 2 THEN
			UPDATE 
				ctg_rol_empresas 
			SET
				ctg_rol_id = v_ctg_rol_id,
        ctg_rol_desc = v_ctg_rol_desc,
        ctg_rol_obs = v_ctg_rol_obs,
        ctg_rol_tit = v_ctg_rol_tit,
        ctg_rol_prop = v_ctg_rol_prop,
        ctg_rol_repr = v_ctg_rol_repr,
        ctg_rol_fabr = v_ctg_rol_fabr,
        ctg_rol_enva = v_ctg_rol_enva,
        ctg_rol_dist = v_ctg_rol_dist,
        ctg_rol_alma = v_ctg_rol_alma,
        ctg_rol_impo = v_ctg_rol_impo,
        ctg_rol_labo = v_ctg_rol_labo,
        ctg_rol_otr = v_ctg_rol_otr,
        ctg_rol_acon = v_ctg_rol_acon,
        ctg_rol_pat = v_ctg_rol_pat,
        ctg_rol_patadj = v_ctg_rol_patadj,
        ctg_rol_pesc = v_ctg_rol_pesc,
        ctg_rol_penc = v_ctg_rol_penc,
        ctg_rol_remi = v_ctg_rol_remi,
        ctg_rol_sta = v_ctg_rol_sta,
        ctg_rol_usr = v_ctg_rol_usr,
        ctg_rol_dt = v_ctg_rol_dt
                
			WHERE 
				ctg_id = v_ctg_id;
		END IF;
		
		IF v_cod = 3 THEN
			UPDATE 
				ctg_rol_empresas 
			SET
				ctg_rol_sta = v_ctg_rol_sta
			WHERE 
				ctg_id = v_ctg_id;
		END IF;
		
 END;
    $BODY$
  LANGUAGE plpgsql VOLATILE
  COST 1000
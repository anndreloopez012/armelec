CREATE OR REPLACE FUNCTION "public"."system_06010404_insp"("v_cod" int4,
                                                            "v_vus_cnf_pais" varchar,
                                                            "v_vus_cnf_siglas" varchar,
                                                            "v_vus_cnf_licence" varchar,
                                                            "v_vus_cnf_licence2" varchar,
                                                            "v_vus_cnf_ver" varchar,
                                                            "v_vus_cnf_lang" int,
                                                            "v_vus_cnf_email1" varchar,
                                                            "v_vus_cnf_email2" varchar,
                                                            "v_vus_cnf_email3" varchar,
                                                            "v_vus_cnf_pagadere" int,
                                                            "v_vus_cnf_frame" int,
                                                            "v_vus_cnf_backup" int,
                                                            "v_vus_cnf_acceso" int,
                                                            "v_vus_cnf_diasven" int,
                                                            "v_vus_id" int
)
  RETURNS "pg_catalog"."void" AS $BODY$
    BEGIN
		
		IF v_cod = 2 THEN
			UPDATE 
				vus_config 
			SET
				vus_cnf_pais = v_vus_cnf_pais ,
                vus_cnf_siglas = v_vus_cnf_siglas ,
                vus_cnf_licence = v_vus_cnf_licence ,
                vus_cnf_licence2 = v_vus_cnf_licence2 ,
                vus_cnf_ver = v_vus_cnf_ver ,
                vus_cnf_lang = v_vus_cnf_lang ,
                vus_cnf_email1 = v_vus_cnf_email1 ,
                vus_cnf_email2 = v_vus_cnf_email2 ,
                vus_cnf_email3 = v_vus_cnf_email3 ,
                vus_cnf_pagadere = v_vus_cnf_pagadere ,
                vus_cnf_frame = v_vus_cnf_frame ,
                vus_cnf_backup = v_vus_cnf_backup ,
                vus_cnf_acceso = v_vus_cnf_acceso ,
                vus_cnf_diasven = v_vus_cnf_diasven 
			WHERE 
				vus_id = v_vus_id;
		END IF;
		
 END;
    $BODY$
  LANGUAGE plpgsql VOLATILE
  COST 1000
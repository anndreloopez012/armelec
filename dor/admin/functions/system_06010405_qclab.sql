
CREATE OR REPLACE FUNCTION "public"."system_06010405_qclab"("v_cod" int4,
                                                            "v_qcl_cnf_pais" varchar,
                                                            "v_qcl_cnf_siglas" varchar,
                                                            "v_qcl_cnf_licence" varchar,
                                                            "v_qcl_cnf_licence2" varchar,
                                                            "v_qcl_cnf_ver" varchar,
                                                            "v_qcl_cnf_lang" int,
                                                            "v_qcl_cnf_email1" varchar,
                                                            "v_qcl_cnf_email2" varchar,
                                                            "v_qcl_cnf_email3" varchar,
                                                            "v_qcl_cnf_pagadere" int,
                                                            "v_qcl_cnf_frame" int,
                                                            "v_qcl_cnf_backup" int,
                                                            "v_qcl_cnf_acceso" int,
                                                            "v_qcl_cnf_diasven" int,
                                                            "v_ctg_id" int


)
  RETURNS "pg_catalog"."void" AS $BODY$
    BEGIN
		
		IF v_cod = 2 THEN
			UPDATE 
				qcl_config 
			SET
				qcl_cnf_pais = v_qcl_cnf_pais ,
                qcl_cnf_siglas = v_qcl_cnf_siglas ,
                qcl_cnf_licence = v_qcl_cnf_licence ,
                qcl_cnf_licence2 = v_qcl_cnf_licence2 ,
                qcl_cnf_ver = v_qcl_cnf_ver ,
                qcl_cnf_lang = v_qcl_cnf_lang ,
                qcl_cnf_email1 = v_qcl_cnf_email1 ,
                qcl_cnf_email2 = v_qcl_cnf_email2 ,
                qcl_cnf_email3 = v_qcl_cnf_email3 ,
                qcl_cnf_pagadere = v_qcl_cnf_pagadere ,
                qcl_cnf_frame = v_qcl_cnf_frame ,
                qcl_cnf_backup = v_qcl_cnf_backup ,      
                qcl_cnf_acceso = v_qcl_cnf_acceso ,
                qcl_cnf_diasven = v_qcl_cnf_diasven 
            
                
			WHERE 
				ctg_id = v_ctg_id;
		END IF;
		
 END;
    $BODY$
  LANGUAGE plpgsql VOLATILE
  COST 1000




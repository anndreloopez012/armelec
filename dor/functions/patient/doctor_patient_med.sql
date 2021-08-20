CREATE OR REPLACE FUNCTION doctors_patient 
                                        (   "v_class " int,
                                            "v_tabla " varchar,
                                            "v_med_pac_cedord" varchar,
                                            "v_med_pac_cedreg" varchar,
                                            "v_med_pac_dpi" varchar,
                                            "v_med_pac_code" int,
                                            "v_med_pac_codigo" varchar,
                                            "v_med_pac_mem_id" varchar,
                                            "v_med_pac_nom" varchar,
                                            "v_med_pac_sexo" int,
                                            "v_med_pac_civil" int,
                                            "v_med_pac_nac_dia" int,
                                            "v_med_pac_nac_mes" int,
                                            "v_med_pac_nac_ano" int,
                                            "v_med_pac_dir" text,
                                            "v_med_pac_zona" varchar,
                                            "v_med_pac_dep" varchar,
                                            "v_med_pac_mun" varchar,
                                            "v_med_pac_telcel" varchar,
                                            "v_med_pac_telpar" varchar,
                                            "v_med_pac_teltra" varchar,
                                            "v_med_pac_email" varchar,
                                            "v_med_pac_pass" varchar,
                                            "v_med_pac_username" varchar,
                                            "v_med_pac_estatus" char,
                                            "v_med_pac_sta" char,
                                            "v_med_pac_dt" date,
                                            "v_med_pac_usr" varchar,
                                            "v_id" int,
                                            "v_id_med_pac" int

                                        ) 
 RETURNS void AS $$
    BEGIN
      IF v_class = 1 THEN   
         INSERT 
         INTO v_tabla
                    (med_pac_cedord,
                        med_pac_cedreg,
                        med_pac_dpi,
                        med_pac_code,
                        med_pac_codigo,
                        med_pac_mem_id,
                        med_pac_nom,
                        med_pac_sexo,
                        med_pac_civil,
                        med_pac_nac_dia,
                        med_pac_nac_mes,
                        med_pac_nac_ano,
                        med_pac_dir,
                        med_pac_zona,
                        med_pac_dep,
                        med_pac_mun,
                        med_pac_telcel,
                        med_pac_telpar,
                        med_pac_teltra,
                        med_pac_email,
                        med_pac_pass,
                        med_pac_username,
                        med_pac_estatus,
                        med_pac_sta,
                        med_pac_dt,
                        med_pac_usr,
                        id,
                        id_med_pac
)
         VALUES
               (v_med_pac_cedord,
                v_med_pac_cedreg,
                v_med_pac_dpi,
                v_med_pac_code,
                v_med_pac_codigo,
                v_med_pac_mem_id,
                v_med_pac_nom,
                v_med_pac_sexo,
                v_med_pac_civil,
                v_med_pac_nac_dia,
                v_med_pac_nac_mes,
                v_med_pac_nac_ano,
                v_med_pac_dir,
                v_med_pac_zona,
                v_med_pac_dep,
                v_med_pac_mun,
                v_med_pac_telcel,
                v_med_pac_telpar,
                v_med_pac_teltra,
                v_med_pac_email,
                v_med_pac_pass,
                v_med_pac_username,
                v_med_pac_estatus,
                v_med_pac_sta,
                v_med_pac_dt,
                v_med_pac_usr,
                v_id,
                v_id_med_pac
);
      END IF;
		
		IF v_class = 2 THEN
			UPDATE 
				v_tabla 
			SET
                med_pac_cedord = v_med_pac_cedord ,
                med_pac_cedreg = v_med_pac_cedreg ,
                med_pac_dpi = v_med_pac_dpi ,
                med_pac_code = v_med_pac_code ,
                med_pac_codigo = v_med_pac_codigo ,
                med_pac_mem_id = v_med_pac_mem_id ,
                med_pac_nom = v_med_pac_nom ,
                med_pac_sexo = v_med_pac_sexo ,
                med_pac_civil = v_med_pac_civil ,
                med_pac_nac_dia = v_med_pac_nac_dia ,
                med_pac_nac_mes = v_med_pac_nac_mes ,
                med_pac_nac_ano = v_med_pac_nac_ano ,
                med_pac_dir = v_med_pac_dir ,
                med_pac_zona = v_med_pac_zona ,
                med_pac_dep = v_med_pac_dep ,
                med_pac_mun = v_med_pac_mun ,
                med_pac_telcel = v_med_pac_telcel ,
                med_pac_telpar = v_med_pac_telpar ,
                med_pac_teltra = v_med_pac_teltra ,
                med_pac_email = v_med_pac_email ,
                med_pac_pass = v_med_pac_pass ,
                med_pac_username = v_med_pac_username ,
                med_pac_estatus = v_med_pac_estatus ,
                med_pac_sta = v_med_pac_sta ,
                med_pac_dt = v_med_pac_dt,
                med_pac_usr = v_med_pac_usr ,
                id_med_pac = v_id_med_pac 
			WHERE 
				id = v_id;
		END IF;
    
		IF v_class = 3 THEN
			DELETE 
            FROM v_tabla 
            WHERE 
				id = v_id;
		END IF;

		
 END;
    $$ LANGUAGE plpgsql;




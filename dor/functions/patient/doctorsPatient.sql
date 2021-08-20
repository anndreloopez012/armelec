CREATE OR REPLACE FUNCTION doctors_patient 
                                        ( v_class int,
                                          v_idMax int,
                                          v_id int,
                                          v_ctg_pac_dpi varchar,
                                          v_ctg_pac_code int,
                                          v_ctg_pac_codigo varchar,
                                          v_ctg_pac_mem_id varchar,
                                          v_ctg_pac_nombres varchar,
                                          v_ctg_pac_apellidos varchar,
                                          v_ctg_pac_sexo int,
                                          v_ctg_pac_nac_dia int,
                                          v_ctg_pac_nac_mes int,
                                          v_ctg_pac_nac_ano int,
                                          v_ctg_pac_dir varchar,
                                          v_ctg_pac_zona varchar,
                                          v_ctg_pac_dep varchar,
                                          v_ctg_pac_mun varchar,
                                          v_ctg_pac_telcel varchar,
                                          v_ctg_pac_email varchar,
                                          v_ctg_pac_sol_dt date,
                                          v_ctg_pac_estatus char,
                                          v_ctg_pac_eme_nombre varchar,
                                          v_ctg_pac_eme_tels varchar,
                                          v_ctg_pac_eme_email varchar,
                                          v_ctg_pac_dt date,
                                          v_ctg_pac_usr varchar
                                        ) 
 RETURNS void AS $$
    BEGIN
      IF v_class = 1 THEN   
         INSERT 
         INTO ctg_pacientes
                              (id,
                              ctg_pac_dpi,
                              ctg_pac_code,
                              ctg_pac_codigo,
                              ctg_pac_mem_id,
                              ctg_pac_nombres,
                              ctg_pac_apellidos,
                              ctg_pac_sexo,
                              ctg_pac_nac_dia,
                              ctg_pac_nac_mes,
                              ctg_pac_nac_ano,
                              ctg_pac_dir,
                              ctg_pac_zona,
                              ctg_pac_dep,
                              ctg_pac_mun,
                              ctg_pac_telcel,
                              ctg_pac_email,
                              ctg_pac_sol_dt,
                              ctg_pac_estatus,
                              ctg_pac_eme_nombre,
                              ctg_pac_eme_tels,
                              ctg_pac_eme_email,
                              ctg_pac_dt,
                              ctg_pac_usr)
         VALUES
               (v_idMax,
               v_ctg_pac_dpi,
               v_ctg_pac_code,
               v_ctg_pac_codigo,
               v_ctg_pac_mem_id,
               v_ctg_pac_nombres,
               v_ctg_pac_apellidos,
               v_ctg_pac_sexo,
               v_ctg_pac_nac_dia,
               v_ctg_pac_nac_mes,
               v_ctg_pac_nac_ano,
               v_ctg_pac_dir,
               v_ctg_pac_zona,
               v_ctg_pac_dep,
               v_ctg_pac_mun,
               v_ctg_pac_telcel,
               v_ctg_pac_email,
               v_ctg_pac_sol_dt,
               v_ctg_pac_estatus,
               v_ctg_pac_eme_nombre,
               v_ctg_pac_eme_tels,
               v_ctg_pac_eme_email,
               v_ctg_pac_dt,
               v_ctg_pac_usr);
      END IF;
		
		IF v_class = 2 THEN
			UPDATE 
				ctg_pacientes 
			SET
               ctg_pac_dpi = v_ctg_pac_dpi ,
               ctg_pac_code = v_ctg_pac_code ,
               ctg_pac_codigo = v_ctg_pac_codigo ,
               ctg_pac_mem_id = v_ctg_pac_mem_id ,
               ctg_pac_nombres = v_ctg_pac_nombres ,
               ctg_pac_apellidos = v_ctg_pac_apellidos ,
               ctg_pac_sexo = v_ctg_pac_sexo ,
               ctg_pac_nac_dia = v_ctg_pac_nac_dia ,
               ctg_pac_nac_mes = v_ctg_pac_nac_mes ,
               ctg_pac_nac_ano = v_ctg_pac_nac_ano ,
               ctg_pac_dir = v_ctg_pac_dir ,
               ctg_pac_zona = v_ctg_pac_zona ,
               ctg_pac_dep = v_ctg_pac_dep ,
               ctg_pac_mun = v_ctg_pac_mun ,
               ctg_pac_telcel = v_ctg_pac_telcel ,
               ctg_pac_email = v_ctg_pac_email ,
               ctg_pac_sol_dt = v_ctg_pac_sol_dt ,
               ctg_pac_estatus = '2' ,
               ctg_pac_eme_nombre = v_ctg_pac_eme_nombre ,
               ctg_pac_eme_tels = v_ctg_pac_eme_tels ,
               ctg_pac_eme_email = v_ctg_pac_eme_email ,
               ctg_pac_dt = v_ctg_pac_dt ,
               ctg_pac_usr = v_ctg_pac_usr 
                
			WHERE 
				id = v_id;
		END IF;
    
		IF v_class = 3 THEN
			UPDATE 
				ctg_pacientes 
			SET
				ctg_pac_estatus = '3'
			WHERE 
				id = v_id;
		END IF;

		
 END;
    $$ LANGUAGE plpgsql;




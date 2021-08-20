CREATE OR REPLACE FUNCTION doctors_perfil 
                                        (
                                        v_id int ,
                                        v_ctg_med_col int,
                                        v_ctg_med_nombres varchar,
                                        v_ctg_med_apellidos varchar,
                                        v_ctg_med_sexo int,
                                        v_ctg_med_dir varchar,
                                        v_ctg_med_dep varchar,
                                        v_ctg_med_mun varchar,
                                        v_ctg_med_infpro text,
                                        v_ctg_med_dt date,
                                        v_ctg_med_usr varchar)  
 RETURNS void AS $$
    BEGIN

			UPDATE 
				ctg_medicos 
			SET
            ctg_med_col = v_ctg_med_col ,
            ctg_med_nombres = v_ctg_med_nombres ,
            ctg_med_apellidos = v_ctg_med_apellidos ,
            ctg_med_sexo = v_ctg_med_sexo ,
            ctg_med_dir = v_ctg_med_dir ,
            ctg_med_dep = v_ctg_med_dep ,
            ctg_med_mun = v_ctg_med_mun ,
            ctg_med_infpro = v_ctg_med_infpro ,
            ctg_med_dt = v_ctg_med_dt ,
            ctg_med_usr = v_ctg_med_usr
                
			WHERE 
				id_med_web = v_id;
    
 END;
    $$ LANGUAGE plpgsql;

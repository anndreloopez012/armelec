CREATE OR REPLACE FUNCTION doctors_diet 
                                        (v_tabla varchar,
                                          v_class int ,
                                          v_med_die_id int,
                                          v_med_die_nom varchar,
                                          v_med_die_des text,
                                          v_med_die_sta char,
                                          v_med_die_dt date,
                                          v_med_die_usr varchar,
                                          v_id int,
                                          v_idMax int) 
 RETURNS void AS $$
    BEGIN
      IF v_class = 1 THEN   
         INSERT 
         INTO v_tabla
               (med_die_id,
               med_die_nom,
               med_die_des,
               med_die_sta,
               med_die_dt,
               med_die_usr,
               id
               )
         VALUES
               (v_med_die_id,
               v_med_die_nom,
               v_med_die_des,
               v_med_die_sta,
               v_med_die_dt,
               v_med_die_usr,
               v_idMax);
      END IF;
		
		IF v_class = 2 THEN
			UPDATE 
				v_tabla 
			SET
               med_die_id = v_med_die_id ,
               med_die_nom = v_med_die_nom ,
               med_die_des = v_med_die_des ,
               med_die_sta = v_med_die_sta ,
               med_die_dt = v_med_die_dt ,
               med_die_usr = v_med_die_usr 
			WHERE 
				id = v_id;
		END IF;
    
		IF v_class = 3 THEN
			DELETE FROM v_tabla WHERE id = v_id;
		END IF;

		
 END;
    $$ LANGUAGE plpgsql;




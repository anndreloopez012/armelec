CREATE OR REPLACE FUNCTION doctors_vaccine 
                                        ( v_name varchar ,
                                        v_class int ,
                                        v_med_vac_id int,
                                        v_med_vac_nom varchar,
                                        v_med_vac_des text,
                                        v_med_vac_costo numeric,
                                        v_med_vac_precio numeric,
                                        v_med_vac_sali int,
                                        v_med_vac_comp int,
                                        v_med_vac_vent int,
                                        v_med_vac_sta char,
                                        v_med_vac_dt date,
                                        v_med_vac_usr varchar,
                                        v_med_vac_sal_act int,
                                        v_med_vac_vent_precio int,
                                        v_id int,
                                        v_idMax int
                                        ) 
 RETURNS void AS $$
    BEGIN
      IF v_class = 1 THEN   
         INSERT 
         INTO v_name
                              (med_vac_id,
                                med_vac_nom,
                                med_vac_des,
                                med_vac_costo,
                                med_vac_precio,
                                med_vac_sali,
                                med_vac_comp,
                                med_vac_vent,
                                med_vac_sta,
                                med_vac_dt,
                                med_vac_usr,
                                med_vac_sal_act,
                                med_vac_vent_precio,
                                id
                                )
         VALUES
               (v_med_vac_id,
                v_med_vac_nom,
                v_med_vac_des,
                v_med_vac_costo,
                v_med_vac_precio,
                v_med_vac_sali,
                v_med_vac_comp,
                v_med_vac_vent,
                v_med_vac_sta,
                v_med_vac_dt,
                v_med_vac_usr,
                v_med_vac_sal_act,
                v_med_vac_vent_precio,
                v_idMax);
      END IF;
		
		IF v_class = 2 THEN
			UPDATE 
				v_name 
			SET
                med_vac_id = v_med_vac_id  ,
                med_vac_nom = v_med_vac_nom  ,
                med_vac_des = v_med_vac_des  ,
                med_vac_costo = v_med_vac_costo ,
                med_vac_precio = v_med_vac_precio  ,
                med_vac_sali = v_med_vac_sali  ,
                med_vac_comp = v_med_vac_comp  ,
                med_vac_vent = v_med_vac_vent  ,
                med_vac_sta = v_med_vac_sta  ,
                med_vac_dt = v_med_vac_dt  ,
                med_vac_usr = v_med_vac_usr  ,
                med_vac_sal_act = v_med_vac_sal_act  ,
                med_vac_vent_precio = v_med_vac_vent_precio  
                
			WHERE 
				id = v_id;
		END IF;
    
		IF v_class = 3 THEN
			DELETE FROM 
				        v_name 
                    WHERE 
                        id = v_id;
		END IF;

		
 END;
    $$ LANGUAGE plpgsql;





CREATE OR REPLACE FUNCTION "public"."system_06010401_adm"("v_cod" int4,
                                                            "v_adm_cnf_pais" varchar,
                                                            "v_adm_cnf_siglas" varchar,
                                                            "v_adm_cnf_licence" varchar,
                                                            "v_adm_cnf_licence2" varchar,
                                                            "v_adm_cnf_ver" varchar,
                                                            "v_adm_cnf_lang" int,
                                                            "v_adm_cnf_tit_cor" int,
                                                            "v_adm_cnf_user" varchar,
                                                            "v_adm_cnf_passw" varchar,
                                                            "v_adm_cnf_email1" varchar,
                                                            "v_adm_cnf_email2" varchar,
                                                            "v_adm_cnf_email3" varchar,
                                                            "v_adm_cnf_ipint" varchar,
                                                            "v_adm_cnf_ipext" varchar,
                                                            "v_adm_cnf_acceso" int,
                                                            "v_adm_cnf_color" varchar,
                                                            "v_adm_cnf_timref" int,
                                                            "v_adm_cnf_actividades" int,
                                                            "v_adm_cnf_mensajes" int,
                                                            "v_adm_cnf_notas" int,
                                                            "v_adm_cnf_frame" int,
                                                            "v_adm_cnf_uts_costo" int,
                                                            "v_adm_cnf_numfal" int,
                                                            "v_adm_cnf_numfaldias" int,
                                                            "v_adm_cnf_numbol" int,
                                                            "v_adm_cnf_numboldias" int,
                                                            "v_adm_cnf_filesizeupl" int,
                                                            "v_sistema_siglas" varchar,
                                                            "v_sistema_name" varchar,
                                                            "v_sistema_version" varchar,
                                                            "v_adm_cnf_firma" varchar,
                                                            "v_adm_cnf_firma2" varchar,
                                                            "v_adm_cnf_desig1" varchar,
                                                            "v_adm_cnf_desig2" varchar,
                                                            "v_adm_cnf_cdvcor" int,
                                                            "v_adm_cnf_backup" int,
                                                            "v_adm_cnf_revfalbol" int,
                                                            "v_adm_cnf_formnr" varchar,
                                                            "v_adm_cnf_versnr" varchar,
                                                            "v_adm_cnf_sopnr" varchar,
                                                            "v_adm_cnf_formnr2" varchar,
                                                            "v_adm_cnf_versnr2" varchar,
                                                            "v_adm_cnf_sopnr2" varchar,
                                                            "v_adm_cnf_superoff" varchar,
                                                            "v_sistema_logo" varchar,
                                                            "v_ctg_id" int
)
  RETURNS "pg_catalog"."void" AS $BODY$
    BEGIN
		
		IF v_cod = 2 THEN
			UPDATE 
				adm_config 
			SET
				adm_cnf_pais = v_adm_cnf_pais ,
        adm_cnf_siglas = v_adm_cnf_siglas ,
        adm_cnf_licence = v_adm_cnf_licence ,
        adm_cnf_licence2 = v_adm_cnf_licence2 ,
        adm_cnf_ver = v_adm_cnf_ver ,
        adm_cnf_lang = v_adm_cnf_lang ,
        adm_cnf_tit_cor = v_adm_cnf_tit_cor ,
        adm_cnf_user = v_adm_cnf_user ,
        adm_cnf_passw = v_adm_cnf_passw ,
        adm_cnf_email1 = v_adm_cnf_email1 ,
        adm_cnf_email2 = v_adm_cnf_email2 ,
        adm_cnf_email3 = v_adm_cnf_email3 ,
        adm_cnf_ipint = v_adm_cnf_ipint ,
        adm_cnf_ipext = v_adm_cnf_ipext ,
        adm_cnf_acceso = v_adm_cnf_acceso ,
        adm_cnf_color = v_adm_cnf_color ,
        adm_cnf_timref = v_adm_cnf_timref ,
        adm_cnf_masktels = v_adm_cnf_masktels ,
        adm_cnf_maskdates = v_adm_cnf_maskdates ,
        adm_cnf_maskvalues = v_adm_cnf_maskvalues ,
        adm_cnf_actividades = v_adm_cnf_actividades ,
        adm_cnf_mensajes = v_adm_cnf_mensajes ,
        adm_cnf_notas = v_adm_cnf_notas ,
        adm_cnf_frame = v_adm_cnf_frame ,
        adm_cnf_uts_costo = v_adm_cnf_uts_costo ,
        adm_cnf_numfal = v_adm_cnf_numfal ,
        adm_cnf_numfaldias = v_adm_cnf_numfaldias ,
        adm_cnf_numbol = v_adm_cnf_numbol ,
        adm_cnf_numboldias = v_adm_cnf_numboldias ,
        adm_cnf_filesizeupl = v_adm_cnf_filesizeupl ,
        sistema_siglas = v_sistema_siglas ,
        sistema_name = v_sistema_name ,
        sistema_version = v_sistema_version ,
        adm_cnf_firma = v_adm_cnf_firma ,
        adm_cnf_firma2 = v_adm_cnf_firma2 ,
        adm_cnf_desig1 = v_adm_cnf_desig1 ,
        adm_cnf_desig2 = v_adm_cnf_desig2 ,
        adm_cnf_cdvcor = v_adm_cnf_cdvcor ,
        adm_cnf_backup = v_adm_cnf_backup ,
        adm_cnf_revfalbol = v_adm_cnf_revfalbol ,
        adm_cnf_formnr = v_adm_cnf_formnr ,
        adm_cnf_versnr = v_adm_cnf_versnr ,
        adm_cnf_sopnr = v_adm_cnf_sopnr ,
        adm_cnf_formnr2 = v_adm_cnf_formnr2 ,
        adm_cnf_versnr2 = v_adm_cnf_versnr2 ,
        adm_cnf_sopnr2 = v_adm_cnf_sopnr2 ,
        adm_cnf_superoff = v_adm_cnf_superoff ,
        sistema_logo = v_sistema_logo 
			WHERE 
				ctg_id = v_ctg_id;
		END IF;
		
 END;
    $BODY$
  LANGUAGE plpgsql VOLATILE
  COST 1000







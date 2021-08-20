<section class="content col-lg-12 app" id="app" name="app"><br>
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-2"></div>
            <div class="cont col-lg-8">
                <form id="" method="POST">
                    <ul class="nav nav-pills nav-fill btn-dark">
                        <li style="cursor:pointer" class="nav-item">
                            <a onclick="fntSelectFormulario()" class="btn btn-danger btn-block ">Configuracion Global</a>
                        </li>
                        <li style="cursor:pointer" class="nav-item">
                            <a onclick="fntCLose()" class="btn btn-dark btn-block ">CERRAR</a>
                        </li>
                    </ul><br>
                </form>
            </div>
        </div>
    </div>
    <div class="container-fluid" id="formulario">
        <div class="container-fluid">

            <div class="row">
                <div class="col-lg-2"></div>
                <div class="cont col-lg-8">
                    <form id="formData" method="POST">
                        <div class="form-group row">
                            <label for="" class="col-form-label col-sm-2">Id del pais</label>
                            <div class=" col-md-3">
                                <input type="hidden" class="form-control" name="codeId" id="codeId" value="<?PHP echo $id; ?>">
                                <input type="text" class="form-control" name="adm_cfg_cou" id="adm_cfg_cou" value="<?PHP echo $adm_cfg_cou; ?>">
                            </div>
                            <div class="col-lg-1"></div>

                            <label for="" class="col-form-label col-sm-2">Nombre del pais</label>
                            <div class=" col-md-3">
                                <input type="text" class="form-control" name="adm_cfg_cou_name" id="adm_cfg_cou_name" value="<?PHP echo $adm_cfg_cou_name; ?>">
                            </div>
                            <div class="col-lg-1"></div>

                            <label for="" class="col-form-label col-sm-2">Idioma</label>
                            <div class=" col-md-3">
                                <input type="text" class="form-control" name="adm_cfg_lang" id="adm_cfg_lang" value="<?PHP echo $adm_cfg_lang; ?>">
                            </div>
                            <div class="col-lg-1"></div>

                            <label for="" class="col-form-label col-sm-2">Correlativo de contratos Medicos</label>
                            <div class=" col-md-3">
                                <input type="text" class="form-control" name="adm_cfg_cor_con_med" id="adm_cfg_cor_con_med" value="<?PHP echo $adm_cfg_cor_con_med; ?>">
                            </div>
                            <div class="col-lg-1"></div>

                            <label for="" class="col-form-label col-sm-2">Correlativo de contratos Farmcias</label>
                            <div class=" col-md-3">
                                <input type="text" class="form-control" name="adm_cfg_cor_con_far" id="adm_cfg_cor_con_far" value="<?PHP echo $adm_cfg_cor_con_far; ?>">
                            </div>
                            <div class="col-lg-1"></div>

                            <label for="" class="col-form-label col-sm-2">Correlativo de contratos Pacientes</label>
                            <div class=" col-md-3">
                                <input type="text" class="form-control" name="adm_cfg_cor_con_pac" id="adm_cfg_cor_con_pac" value="<?PHP echo $adm_cfg_cor_con_pac; ?>">
                            </div>
                            <div class="col-lg-1"></div>

                            <label for="" class="col-form-label col-sm-2">Correlativo de contratos Lab. Farmaceuticos</label>
                            <div class=" col-md-3">
                                <input type="text" class="form-control" name="adm_cfg_cor_con_laf" id="adm_cfg_cor_con_laf" value="<?PHP echo $adm_cfg_cor_con_laf; ?>">
                            </div>
                            <div class="col-lg-1"></div>

                            <label for="" class="col-form-label col-sm-2">Correlativo de contratos Lab. Clinicos</label>
                            <div class=" col-md-3">
                                <input type="text" class="form-control" name="adm_cfg_cor_con_cli" id="adm_cfg_cor_con_cli" value="<?PHP echo $adm_cfg_cor_con_cli; ?>">
                            </div>
                            <div class="col-lg-1"></div>

                            <label for="" class="col-form-label col-sm-2">Correlativo de contratos Aseguradoras</label>
                            <div class=" col-md-3">
                                <input type="text" class="form-control" name="adm_cfg_cor_con_ase" id="adm_cfg_cor_con_ase" value="<?PHP echo $adm_cfg_cor_con_ase; ?>">
                            </div>
                            <div class="col-lg-1"></div>

                            <label for="" class="col-form-label col-sm-2">Correlativo de contratos Hospitales</label>
                            <div class=" col-md-3">
                                <input type="text" class="form-control" name="adm_cfg_cor_con_hos" id="adm_cfg_cor_con_hos" value="<?PHP echo $adm_cfg_cor_con_hos; ?>">
                            </div>
                            <div class="col-lg-1"></div>

                            <label for="" class="col-form-label col-sm-2">Direccion IP publica</label>
                            <div class=" col-md-3">
                                <input type="text" class="form-control" name="amd_cfg_ip1" id="amd_cfg_ip1" value="<?PHP echo $amd_cfg_ip1; ?>">
                            </div>
                            <div class="col-lg-1"></div>

                            <label for="" class="col-form-label col-sm-2">clave de acceso para el usuario MASTER</label>
                            <div class=" col-md-3">
                                <input type="text" class="form-control" name="adm_cfg_passw" id="adm_cfg_passw" value="<?PHP echo $adm_cfg_passw; ?>">
                            </div>
                            <div class="col-lg-1"></div>

                            <label for="" class="col-form-label col-sm-2">Cuenta de buzon para soporte tecnico</label>
                            <div class=" col-md-3">
                                <input type="text" class="form-control" name="adm_cfg_email_gerencia" id="adm_cfg_email_gerencia" value="<?PHP echo $adm_cfg_email_gerencia; ?>">
                            </div>
                            <div class="col-lg-1"></div>

                            <label for="" class="col-form-label col-sm-2">Cuenta de buzon para bitacora de errores</label>
                            <div class=" col-md-3">
                                <input type="text" class="form-control" name="adm_cfg_email_ventas" id="adm_cfg_email_ventas" value="<?PHP echo $adm_cfg_email_ventas; ?>">
                            </div>
                            <div class="col-lg-1"></div>

                            <label for="" class="col-form-label col-sm-2">Cuenta de buzon para bitacora de errores</label>
                            <div class=" col-md-3">
                                <input type="text" class="form-control" name="adm_cfg_email_conta" id="adm_cfg_email_conta" value="<?PHP echo $adm_cfg_email_conta; ?>">
                            </div>
                            <div class="col-lg-1"></div>

                            <label for="" class="col-form-label col-sm-2">Cuenta de buzon para bitacora de errores</label>
                            <div class=" col-md-3">
                                <input type="text" class="form-control" name="adm_cfg_email_tecnicos" id="adm_cfg_email_tecnicos" value="<?PHP echo $adm_cfg_email_tecnicos; ?>">
                            </div>
                            <div class="col-lg-1"></div>

                            <label for="" class="col-form-label col-sm-2">Cuenta de buzon para bitacora de publicidad</label>
                            <div class=" col-md-3">
                                <input type="text" class="form-control" name="adm_cfg_email_publicidad" id="adm_cfg_email_publicidad" value="<?PHP echo $adm_cfg_email_publicidad; ?>">
                            </div>
                            <div class="col-lg-1"></div>

                            <label for="" class="col-form-label col-sm-2">Acceso al sistema Habilitado</label>
                            <div class=" col-md-3">
                                <input type="text" class="form-control" name="adm_cfg_acceso" id="adm_cfg_acceso" value="<?PHP echo $adm_cfg_acceso; ?>">
                            </div>
                            <div class="col-lg-1"></div>

                            <label for="" class="col-form-label col-sm-2">Nombre del sistema</label>
                            <div class=" col-md-3">
                                <input type="text" class="form-control" name="adm_cfg_sistema" id="adm_cfg_sistema" value="<?PHP echo $adm_cfg_sistema; ?>">
                            </div>
                            <div class="col-lg-1"></div>

                            <label for="" class="col-form-label col-sm-2">Link de servicio</label>
                            <div class=" col-md-3">
                                <input type="text" class="form-control" name="adm_cfg_weblink1" id="adm_cfg_weblink1" value="<?PHP echo $adm_cfg_weblink1; ?>">
                            </div>
                            <div class="col-lg-1"></div>

                            <label for="" class="col-form-label col-sm-2">Link de afiliados</label>
                            <div class=" col-md-3">
                                <input type="text" class="form-control" name="adm_cfg_weblink2" id="adm_cfg_weblink2" value="<?PHP echo $adm_cfg_weblink2; ?>">
                            </div>
                            <div class="col-lg-1"></div>

                            <label for="" class="col-form-label col-sm-2">Chat</label>
                            <div class=" col-md-3">
                                <input type="text" class="form-control" name="adm_cfg_chat" id="adm_cfg_chat" value="<?PHP echo $adm_cfg_chat; ?>">
                            </div>
                            <div class="col-lg-1"></div>

                            <label for="" class="col-form-label col-sm-2">Anuncios</label>
                            <div class=" col-md-3">
                                <input type="text" class="form-control" name="adm_cfg_anuncios" id="adm_cfg_anuncios" value="<?PHP echo $adm_cfg_anuncios; ?>">
                            </div>
                            <div class="col-lg-1"></div>

                            <label for="" class="col-form-label col-sm-2">Registro de pacientes</label>
                            <div class=" col-md-3">
                                <input type="text" class="form-control" name="adm_cfg_regpac" id="adm_cfg_regpac" value="<?PHP echo $adm_cfg_regpac; ?>">
                            </div>
                            <div class="col-lg-1"></div>

                            <label for="" class="col-form-label col-sm-2">Registro de medicos</label>
                            <div class=" col-md-3">
                                <input type="text" class="form-control" name="adm_cfg_regmed" id="adm_cfg_regmed" value="<?PHP echo $adm_cfg_regmed; ?>">
                            </div>
                            <div class="col-lg-1"></div>

                            <label for="" class="col-form-label col-sm-2">Registro de farmacias</label>
                            <div class=" col-md-3">
                                <input type="text" class="form-control" name="adm_cfg_regfar" id="adm_cfg_regfar" value="<?PHP echo $adm_cfg_regfar; ?>">
                            </div>
                            <div class="col-lg-1"></div>

                            <label for="" class="col-form-label col-sm-2">Registro de lab. clinicos</label>
                            <div class=" col-md-3">
                                <input type="text" class="form-control" name="adm_cfg_reglab" id="adm_cfg_reglab" value="<?PHP echo $adm_cfg_reglab; ?>">
                            </div>
                            <div class="col-lg-1"></div>

                            <label for="" class="col-form-label col-sm-2">Registro de hospitales</label>
                            <div class=" col-md-3">
                                <input type="text" class="form-control" name="adm_cfg_reghos" id="adm_cfg_reghos" value="<?PHP echo $adm_cfg_reghos; ?>">
                            </div>
                            <div class="col-lg-1"></div>

                            <label for="" class="col-form-label col-sm-2">Registro de lab. farmaceuticos</label>
                            <div class=" col-md-3">
                                <input type="text" class="form-control" name="adm_cfg_reglaf" id="adm_cfg_reglaf" value="<?PHP echo $adm_cfg_reglaf; ?>">
                            </div>
                            <div class="col-lg-1"></div>

                            <label for="" class="col-form-label col-sm-2">Registro de aseguradoras</label>
                            <div class=" col-md-3">
                                <input type="text" class="form-control" name="adm_cfg_regase" id="adm_cfg_regase" value="<?PHP echo $adm_cfg_regase; ?>">
                            </div>
                            <div class="col-lg-1"></div>

                            <label for="" class="col-form-label col-sm-2">Registro de publicidad</label>
                            <div class=" col-md-3">
                                <input type="text" class="form-control" name="adm_cfg_regpub" id="adm_cfg_regpub" value="<?PHP echo $adm_cfg_regpub; ?>">
                            </div>
                            <div class="col-lg-1"></div>

                            <label for="" class="col-form-label col-sm-2">Año del sistema</label>
                            <div class=" col-md-3">
                                <input type="date" class="form-control" name="adm_cfg_last_date" id="adm_cfg_last_date" value="<?PHP echo $adm_cfg_last_date; ?>">
                            </div>
                            <div class="col-lg-1"></div>
                

                            <div class=" col-md-12">
                                <hr>
                                </hr>
                            </div>
                            <div class="col-lg-2"></div>
                            <div class=" col-md-8">
                                <ul class="nav nav-pills nav-fill btn-dark">
                                    <li style="cursor:pointer" class="nav-item">
                                        <a onclick="fntInsert()" class="btn btn-success btn-block ">Guardar</a>
                                    </li>
                                </ul>
                            </div><br><br>
                        </div>
                </div>
            </div>
        </div>
    </div>
</section>


<style>
    .sub-menu {
        background-color: #343a40 !important;
    }

    .sub-menu-btn {
        background-color: #000000 !important;
    }

    .sub-menu-btn:not(:disabled):not(.disabled).active {
        background-color: #343a40 !important;
        border-color: #343a40 !important;
    }
</style>


<script>
    //FOCUS AL INICIAR PANTALLA
    document.getElementById("Search").focus();
    document.getElementById('formulario').style.display = 'block';

    //INICIO DE BOTONES DEL NAV
    document.getElementById('home').style.display = 'block';
    document.getElementById('window').style.display = 'block';
    document.getElementById('logout').style.display = 'block';


    function fntCLose() {

        document.getElementById('app').style.display = 'none';

    }

    function fntSelectFormulario() {

        document.getElementById('formulario').style.display = 'block';

    }

</script>
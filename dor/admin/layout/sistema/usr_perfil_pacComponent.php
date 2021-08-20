<section class="content col-lg-12 app" id="app" name="app"><br>
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-2"></div>
            <div class="cont col-lg-8">
                <form id="" method="POST">
                    <ul class="nav nav-pills nav-fill btn-dark">
                        <li style="cursor:pointer" class="nav-item">
                            <a onclick="fntSelectTabla()" class="btn btn-info btn-block ">Listado De Usuarios</a>
                        </li>
                        <li style="cursor:pointer" class="nav-item">
                            <a onclick="fntSelectFormulario()" class="btn btn-danger btn-block ">Crear Usuario</a>
                        </li>
                        <li style="cursor:pointer" class="nav-item">
                            <a onclick="fntCLose()" class="btn btn-dark btn-block ">CERRAR</a>
                        </li>
                    </ul><br>
                    <div class=" row" id="tablaUsuarios">
                        <div class="col-sm-3">
                            <input class="form-control form-control-sm " name="id" id="id" type="hidden">
                            <input class="form-control form-control-sm " name="Search" id="Search" type="text" placeholder="Ingrese el dato a buscar" required onkeyup="fntDibujoTabla() ">
                        </div><br>
                        <div class="div1">
                            <div id="Tabla" name="Tabla">
                                <!-- DIBUJO DE TABLA CATEGORIA PRODUCTO-->
                            </div>
                        </div>
                    </div>
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
                            <label for="" class="col-form-label col-sm-4 ">Numero de Dpi </label>
                            <div class=" col-md-4">
                                <input type="text" class="form-control" name="ctg_pac_dpi" id="ctg_pac_dpi">
                            </div>
                            <div class="col-lg-2"></div>
                            <label for="" class="col-form-label col-sm-4 ">Nombres</label>
                            <div class=" col-md-4">
                                <input type="text" class="form-control" name="ctg_pac_nombres" id="ctg_pac_nombres">
                            </div>
                            <div class="col-lg-2"></div>

                            <label for="" class="col-form-label col-sm-4 ">Apellidos</label>
                            <div class=" col-md-4">
                                <input type="text" class="form-control" name="ctg_pac_apellidos" id="ctg_pac_apellidos">
                            </div>
                            <div class="col-lg-2"></div>

                            <label for="" class="col-form-label col-sm-4 ">Dirección</label>
                            <div class=" col-md-4">
                                <textarea class="form-control" name="ctg_pac_dir" id="ctg_pac_dir" rows="3"></textarea>
                                <span class="bmd-help">Ingresa tu direccion exacta </span>
                            </div>
                            <div class="col-lg-2"></div>

                            <label for="" class="col-form-label col-sm-4 ">Zona</label>
                            <div class=" col-md-1">
                                <input type="text" class="form-control" name="ctg_pac_zona" id="ctg_pac_zona">
                            </div>
                            <div class="col-lg-6"></div>

                            <label for="" class="col-form-label col-sm-4 ">Región/Departamento</label>
                            <div class=" col-md-4">
                                <select class="form-control" name="region" id="region" onchange="fntDibujoDropMun() ">
                                    <!-- DIBUJO DE DROPDOW DEPARTAMENTO-->
                                </select>
                                <input type="hidden" id="hid_region" name="hid_region">
                            </div>
                            <div class="col-lg-2"></div>

                            <label for="" class="col-form-label col-sm-4 ">Distrito/Municipio </label>
                            <div class=" col-md-4">
                                <select class="form-control" name="distrito" id="distrito">
                                    <!-- DIBUJO DE DROPDOW MUNISIPIO-->
                                </select>
                                <input type="hidden" id="hid_distrito" name="hid_distrito">
                            </div>
                            <div class="col-lg-2"></div>

                            <label for="" class="col-form-label col-sm-4 ">Telefono</label>
                            <div class=" col-md-2">
                                <input type="text" class="form-control" name="ctg_pac_telcel" id="ctg_pac_telcel">
                            </div>
                            <div class="col-lg-6"></div>

                            <label for="" class="col-form-label col-sm-4 ">Correo</label>
                            <div class=" col-md-4">
                                <input type="text" class="form-control" name="ctg_pac_email" id="ctg_pac_email" onblur="fntValMail()">
                            </div>
                            <div class="col-lg-2"></div>

                            <label for="" class="col-form-label col-sm-4 ">Nombre De Usuario</label>
                            <div class=" col-md-4">
                                <input type="text" class="form-control" name="username" id="username" onblur="fntValUsuario()">
                            </div>
                            <div class="col-lg-2"></div>
                            
                            <label for="" class="col-form-label col-sm-4 ">Contraseña</label>
                            <div class=" col-md-4">
                                <input type="text" class="form-control" name="password" id="password">
                            </div>
                            <div class="col-lg-2"></div>

                            <label for="" class="col-form-label col-sm-4 ">Confirmar Contraseña</label>
                            <div class=" col-md-4">
                                <input type="text" class="form-control" name="password_conf" id="password_conf" onblur="fntPass()">
                            </div>
                            <div class="col-lg-2"></div>

                            <div class=" col-md-7">
                                <h2>EN CASO DE EMERGENCIA CONTACTA A:</h2>
                            </div>
                            <div class="col-lg-5"></div>

                            <label for="" class="col-form-label col-sm-4 ">Nombre Completo</label>
                            <div class=" col-md-4">
                                <input type="text" class="form-control" name="ctg_pac_eme_nombre" id="ctg_pac_eme_nombre">
                            </div>
                            <div class="col-lg-2"></div>

                            <label for="" class="col-form-label col-sm-4 ">Telefono</label>
                            <div class=" col-md-4">
                                <input type="text" class="form-control" name="ctg_pac_eme_tels" id="ctg_pac_eme_tels">
                            </div>
                            <div class="col-lg-2"></div>

                            <label for="" class="col-form-label col-sm-4 ">Correo</label>
                            <div class=" col-md-4">
                                <input type="text" class="form-control" name="ctg_pac_eme_email" id="ctg_pac_eme_email" >
                            </div>

                            <div class=" col-md-12">
                                <hr>
                                </hr>
                            </div>
                            <div class="col-lg-2"></div>
                            <div class=" col-md-8">
                                <ul class="nav nav-pills nav-fill btn-dark">
                                    <li style="cursor:pointer" class="nav-item">
                                        <a onclick="fntInsert()" class="btn btn-success btn-block ">Generar Usuario</a>
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
    document.getElementById('tablaUsuarios').style.display = 'block';
    document.getElementById('formulario').style.display = 'none';

    //INICIO DE BOTONES DEL NAV
    document.getElementById('home').style.display = 'block';
    document.getElementById('window').style.display = 'block';
    document.getElementById('logout').style.display = 'block';


    function fntCLose() {

        document.getElementById('app').style.display = 'none';

    }

    function fntSelectTabla() {

        document.getElementById('tablaUsuarios').style.display = 'block';
        document.getElementById('formulario').style.display = 'none';

    }

    function fntSelectFormulario() {

        document.getElementById('tablaUsuarios').style.display = 'none';
        document.getElementById('formulario').style.display = 'block';

    }

    function fntSelect(intParametro) {

        intParametro = !intParametro ? 0 : intParametro;

        if (intParametro > 0) {

            var strCodigo = $("#hid_id" + intParametro).val();

            //alert(strDescription + "                         strDescription");

            $("#codeId").val(strCodigo);

        }

        fntDelete()
    };

    function fntPass() {
        var x = $("#password").val();
        var y = $("#password_conf").val();

        if (x == y) {
            alertify.set('notifier','position', 'bottom-right');
            alertify.success('Contraseña : Efectiva');
        } else {
            alertify.alert('AVISO', 'Las contraseñas no coinciden!');
        }

    };
</script>
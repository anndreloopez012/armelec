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

                            <label for="" class="col-form-label col-sm-4 ">Numero De Colegiado</label>
                            <div class=" col-md-4">
                                <input type="hidden" class="form-control" name="codeId" id="codeId">
                                <input type="number" class="form-control" name="ctg_med_col" id="ctg_med_col" >
                            </div>
                            <div class="col-lg-2"></div>

                            <label for="" class="col-form-label col-sm-4 ">Nombres</label>
                            <div class=" col-md-4">
                                <input type="text" class="form-control" name="ctg_med_nombres" id="ctg_med_nombres" >
                            </div>
                            <div class="col-lg-2"></div>

                            <label for="" class="col-form-label col-sm-4 ">Apellidos</label>
                            <div class=" col-md-4">
                                <input type="text" class="form-control" name="ctg_med_apellidos" id="ctg_med_apellidos" >
                            </div>
                            <div class="col-lg-2"></div>

                            <label for="" class="col-form-label col-sm-4 ">Numero de Nit </label>
                            <div class=" col-md-4">
                                <input type="text" class="form-control" name="ctg_med_nit" id="ctg_med_nit">
                            </div>
                            <div class="col-lg-2"></div>

                            <label for="" class="col-form-label col-sm-4 ">Numero de DPI </label>
                            <div class=" col-md-4">
                                <input type="text" class="form-control" name="ctg_med_dpi" id="ctg_med_dpi">
                            </div>
                            <div class="col-lg-2"></div>

                            <label for="" class="col-form-label col-sm-4 ">Direcci??n</label>
                            <div class=" col-md-4">
                                <textarea class="form-control" name="ctg_med_dir" id="ctg_med_dir" rows="3"></textarea>
                                <span class="bmd-help">Ingresa tu direccion exacta </span>
                            </div>
                            <div class="col-lg-2"></div>

                            <label for="" class="col-form-label col-sm-4 ">Zona</label>
                            <div class=" col-md-1">
                                <input type="text" class="form-control" name="ctg_med_zona" id="ctg_med_zona">
                            </div>
                            <div class="col-lg-6"></div>

                            <label for="" class="col-form-label col-sm-4 ">Regi??n/Departamento</label>
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
                                <input type="text" class="form-control" name="ctg_med_tels" id="ctg_med_tels">
                            </div>
                            <div class="col-lg-4"></div>

                            <label for="" class="col-form-label col-sm-4 ">Correo</label>
                            <div class=" col-md-4">
                                <input type="text" class="form-control" name="ctg_med_email" id="ctg_med_email" onblur="fntValMail()">
                            </div>
                            <div class="col-lg-2"></div>

                            <div class=" col-md-12">
                                <hr>
                                </hr>
                            </div>

                            <label for="" class="col-form-label col-sm-4 ">Nombre De Usuario</label>
                            <div class=" col-md-4">
                                <input type="text" class="form-control" name="username" id="username" onchange="fntValUsuario() ">
                            </div>
                            <div class="col-lg-2"></div>

                            <label for="" class="col-form-label col-sm-4 ">Contrase??a</label>
                            <div class=" col-md-4">
                                <input type="text" class="form-control" name="password" id="password">
                            </div>
                            <div class="col-lg-2"></div>

                            <label for="" class="col-form-label col-sm-4 ">Confirmar Contrase??a</label>
                            <div class=" col-md-4">
                                <input type="text" class="form-control" name="password_conf" id="password_conf" onblur="fntPass()">
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

    function fntModalContrato() {

        $('#exampleModal').modal('show')
        fntTablaContrato()
    }

    function fntSelectContrato(intParametro) {

        intParametro = !intParametro ? 0 : intParametro;

        if (intParametro > 0) {

            var strhid_contrato = $("#hid_contrato" + intParametro).val();
            var strhid_nombre = $("#hid_nombre" + intParametro).val();
            var strhid_razon = $("#hid_razon" + intParametro).val();
            var strhid_nit = $("#hid_nit" + intParametro).val();
            var strhid_dir = $("#hid_dir" + intParametro).val();
            var strhid_zona = $("#hid_zona" + intParametro).val();
            var strhid_tels = $("#hid_tels" + intParametro).val();
            var strhid_email = $("#hid_" + intParametro).val();

            //alert(strDescription + "                         strDescription");

            $("#ctg_med_contrato").val(strhid_contrato);
            $("#ctg_med_nom").val(strhid_nombre);
            $("#ctg_med_razsoc").val(strhid_razon);
            $("#ctg_med_nit").val(strhid_nit);
            $("#ctg_med_dir").val(strhid_dir);
            $("#ctg_med_zona").val(strhid_zona);
            $("#ctg_med_tels").val(strhid_tels);
            //$("#").val(strhid_email);

        }
        $('#exampleModal').modal('hide')

    };


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
            alertify.success('Contrase??a : Efectiva');
        } else {
            alertify.alert('AVISO', 'Las contrase??as no coinciden!');
        }

    };
</script>
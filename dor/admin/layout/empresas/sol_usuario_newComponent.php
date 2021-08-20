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
                                <!-- DIBUJO DE TABLA  -->
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Informacion</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="formData" method="POST">
                    <input type="text" class="form-control" id="codeId" name="codeId">
                    <div class="form-group">
                        <label>Nombres</label>
                        <input type="text" class="form-control" id="nombres" name="nombres">
                    </div>
                    <div class="form-group">
                        <label>Apellidos</label>
                        <input type="text" class="form-control" id="apellidos" name="apellidos">
                    </div>
                    <div class="form-group">
                        <label>DPI</label>
                        <input type="text" class="form-control" id="dpi" name="dpi">
                    </div>
                    <div class="form-group">
                        <label>Correo Electronico</label>
                        <input type="text" class="form-control" id="email" name="email">
                    </div>
                    <div class="form-group">
                        <label>Nombre de Usuario</label>
                        <input type="text" class="form-control" id="nombre_usuario" name="nombre_usuario">
                    </div>
                    <div class="form-group">
                        <label>Colegiado</label>
                        <input type="text" class="form-control" id="colegiado" name="colegiado">
                    </div>
                    <div class="form-group">
                        <label>Contrato</label>
                        <input type="text" class="form-control" id="contrato" name="contrato">
                    </div>
                    <div class="form-group">
                        <label>Nombre Comercial</label>
                        <input type="text" class="form-control" id="nombre_comercial" name="nombre_comercial">
                    </div>
                    <div class="form-group">
                        <label>Sucursal</label>
                        <input type="text" class="form-control" id="sucursal" name="sucursal">
                    </div>
                    <div class="form-group">
                        <label>Clave</label>
                        <input type="text" class="form-control" id="clave1" name="clave1">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

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

    //INICIO DE BOTONES DEL NAV
    document.getElementById('home').style.display = 'block';
    document.getElementById('window').style.display = 'block';
    document.getElementById('logout').style.display = 'block';


    function fntCLose() {

        document.getElementById('app').style.display = 'none';

    }

    function fntSelectTabla() {

        document.getElementById('tablaUsuarios').style.display = 'block';
    }

    function fntSelectFormulario() {

        document.getElementById('tablaUsuarios').style.display = 'none';
    }

    function fntViewInfo() {
        $('#exampleModal').modal('show')
    }

    function fntView(intParametro) {

        intParametro = !intParametro ? 0 : intParametro;

        if (intParametro > 0) {

            var str_id = $("#hid_id" + intParametro).val();
            var str_nombres = $("#hid_nombres" + intParametro).val();
            var str_apellidos = $("#hid_apellidos" + intParametro).val();
            var str_dpi = $("#hid_dpi" + intParametro).val();
            var str_email = $("#hid_email" + intParametro).val();
            var str_nombre_usuario = $("#hid_nombre_usuario" + intParametro).val();
            var str_colegiado = $("#hid_colegiado" + intParametro).val();
            var str_contrato = $("#hid_contrato" + intParametro).val();
            var str_nombre_comercial = $("#hid_nombre_comercial" + intParametro).val();
            var str_sucursal = $("#hid_sucursal" + intParametro).val();
            var str_clave1 = $("#hid_clave1" + intParametro).val();

            //alert(strCodigo + "                         strCodigo");

            $("#codeId").val(str_id);
            $("#nombres").val(str_nombres);
            $("#apellidos").val(str_apellidos);
            $("#dpi").val(str_dpi);
            $("#email").val(str_email);
            $("#nombre_usuario").val(str_nombre_usuario);
            $("#colegiado").val(str_colegiado);
            $("#contrato").val(str_contrato);
            $("#nombre_comercial").val(str_nombre_comercial);
            $("#sucursal").val(str_sucursal);
            $("#clave1").val(str_clave1);
        }

        fntViewInfo()
    };

    function fntSelect(intParametro) {

        intParametro = !intParametro ? 0 : intParametro;

        if (intParametro > 0) {

            var str_id = $("#hid_id" + intParametro).val();
            var str_nombres = $("#hid_nombres" + intParametro).val();
            var str_apellidos = $("#hid_apellidos" + intParametro).val();
            var str_dpi = $("#hid_dpi" + intParametro).val();
            var str_email = $("#hid_email" + intParametro).val();
            var str_nombre_usuario = $("#hid_nombre_usuario" + intParametro).val();
            var str_colegiado = $("#hid_colegiado" + intParametro).val();
            var str_contrato = $("#hid_contrato" + intParametro).val();
            var str_nombre_comercial = $("#hid_nombre_comercial" + intParametro).val();
            var str_sucursal = $("#hid_sucursal" + intParametro).val();
            var str_clave1 = $("#hid_clave1" + intParametro).val();

            //alert(strCodigo + "                         strCodigo");

            $("#codeId").val(str_id);
            $("#nombres").val(str_nombres);
            $("#apellidos").val(str_apellidos);
            $("#dpi").val(str_dpi);
            $("#email").val(str_email);
            $("#nombre_usuario").val(str_nombre_usuario);
            $("#colegiado").val(str_colegiado);
            $("#contrato").val(str_contrato);
            $("#nombre_comercial").val(str_nombre_comercial);
            $("#sucursal").val(str_sucursal);
            $("#clave1").val(str_clave1);
        }

        fntInsert()
    };

    function fntSelectDelete(intParametro) {

        intParametro = !intParametro ? 0 : intParametro;

        if (intParametro > 0) {

            var str_id = $("#hid_id" + intParametro).val();

            //alert(strCodigo + "                         strCodigo");

            $("#codeId").val(str_id);
        }

        fntDelete()
    };
</script>
<section class="content col-lg-12 app" id="app" name="app"><br>
    <div class="container-fluid" id="formulario">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-1"></div>
                <div class="cont col-lg-10">
                    <form id="formData" method="POST"><br>
                        <div class="row">

                            <div class="col-1">
                                <input type="text" id="ctg_pro_cod" name="ctg_pro_cod" class="form-control" placeholder="Codigo" onblur="fntValCodigo()">
                            </div>
                            <div class="col-2">
                                <input type="text" id="ctg_pro_desc" name="ctg_pro_desc" class="form-control" placeholder="Descripcion">
                            </div>
                            <div class="col-2">
                                <input type="hidden" id="ctg_pro_labfar" name="ctg_pro_labfar" class="form-control">
                                <input type="text" id="ctg_pro_labfar_name" name="ctg_pro_labfar_name" class="form-control" onfocus="fntDibujoTablaLab()" placeholder="Laboratorio Farmaceutico">
                            </div>
                            <div class="col-2">
                                <input type="date" id="ctg_pro_fecaut" name="ctg_pro_fecaut" class="form-control" placeholder="Fecha de autorizacion">
                            </div>
                            <div class="col-2">
                                <input type="date" id="ctg_pro_fecven" name="ctg_pro_fecven" class="form-control" placeholder="Fecha de vencimiento">
                            </div>
                            <div class="col-1">
                                <select class="form-control form-control-sm" id="ctg_pro_psinar" name="ctg_pro_psinar">
                                    <option value="0" selected>psinar</option>
                                    <option value="1">Normal</option>
                                    <option value="2">Psicotropico</option>
                                    <option value="3">Narcotivo</option>
                                </select>
                            </div>
                            <div class="col-1">
                                <a class="btn btn-outline-info" data-toggle="modal" data-target="#princActivo">Principio Activo</a>
                            </div>
                            <div class="col-1">
                                <a class="btn btn-outline-info" data-toggle="modal" data-target="#indi">Indicaciones</a>
                            </div>
                            <div class="col-12">
                                <a onclick="fntInsert()" class="btn btn-success btn-block " id="save" names="save"><i class="fad fa-2x fa-save"></i> Guardar</a>
                                <a onclick="fntEdit()" class="btn btn-success btn-block " id="edit" names="edit"><i class="fad fa-2x fa-save"></i> Editar</a>
                            </div>
                        </div>

                        <div class="modal fade bd-example-modal-lg" id="princActivo" tabindex="-1" role="dialog" aria-labelledby="princActivoLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="princActivoLabel">Principio Activo</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <input type="text" class="form-control" id="ctg_pro_prinact" name="ctg_pro_prinact"><br>
                                            <div id="TablaPinAct" name="TablaPinAct">
                                                <!-- DIBUJO DE TABLA  -->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal fade bd-example-modal-lg" id="indi" tabindex="-1" role="dialog" aria-labelledby="indiLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="indiLabel">Indicaciones</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <textarea class="form-control" id="ctg_pro_indi" name="ctg_pro_indi" rows="25"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="modal fade bd-example-modal-lg" id="labFar" tabindex="-1" role="dialog" aria-labelledby="labFarLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="labFarLabel">Laboratorio Farmaceutico</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <div id="TablaLaboratory" name="TablaLaboratory">
                                                <!-- DIBUJO DE TABLA  -->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
    <hr>
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-1"></div>
            <div class="cont col-lg-10"><br>
                <div class="row" id="tablaUsuarios">
                    <div class="col-sm-3 row">
                        <br><input class="form-control form-control-sm " name="id" id="id" type="hidden">
                        <input class="form-control form-control " name="Search" id="Search" type="text" placeholder="Ingrese el dato a buscar">
                    </div>
                    <div class="col-sm-1 row">
                        <a class="btn btn-outline-info" onclick="fntDibujoTabla()"><i class="fad fa-2x fa-search"></i></a>
                    </div>
                    <div class="col-sm-12"><br>
                        <div id="Tabla" name="Tabla">
                            <!-- DIBUJO DE TABLA  -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</section>


<script>
    //FOCUS AL INICIAR PANTALLA
    document.getElementById("Search").focus();
    document.getElementById('edit').style.display = 'none';

    function fntSelectEdit(intParametro) {

        intParametro = !intParametro ? 0 : intParametro;

        if (intParametro > 0) {

            var strctg_pro_cod = $("#hid_ctg_pro_cod" + intParametro).val();
            var strctg_pro_desc = $("#hid_ctg_pro_desc" + intParametro).val();
            var strctg_pro_prinact = $("#hid_ctg_pro_prinact" + intParametro).val();
            var strctg_pro_indi = $("#hid_ctg_pro_indi" + intParametro).val();
            var strctg_pro_labfar = $("#hid_ctg_pro_labfar" + intParametro).val();
            var strctg_pro_psinar = $("#hid_ctg_pro_psinar" + intParametro).val();
            var strctg_pro_fecaut = $("#hid_ctg_pro_fecaut" + intParametro).val();
            var strctg_pro_fecven = $("#hid_ctg_pro_fecven" + intParametro).val();

            //alert(strCodigo + "                         strCodigo");

            $("#ctg_pro_cod").val(strctg_pro_cod);
            $("#ctg_pro_desc").val(strctg_pro_desc);
            $("#ctg_pro_prinact").val(strctg_pro_prinact);
            $("#ctg_pro_indi").val(strctg_pro_indi);
            $("#ctg_pro_labfar").val(strctg_pro_labfar);
            $("#ctg_pro_labfar_name").val(strctg_pro_labfar);
            $("#ctg_pro_psinar").val(strctg_pro_psinar);
            $("#ctg_pro_fecaut").val(strctg_pro_fecaut);
            $("#ctg_pro_fecven").val(strctg_pro_fecven);
        }
        document.getElementById('edit').style.display = 'block';
        document.getElementById('save').style.display = 'none';

    };


    function fntSelectDelete(intParametro) {

        intParametro = !intParametro ? 0 : intParametro;

        if (intParametro > 0) {

            var strctg_pro_cod = $("#hid_ctg_pro_cod" + intParametro).val();
            //alert(strCodigo + "                         strCodigo");
            $("#ctg_pro_cod").val(strctg_pro_cod);
        }

        fntDelete()
    };

    function fntSelectPrin(intParametro) {

        intParametro = !intParametro ? 0 : intParametro;

        if (intParametro > 0) {

            var strctg_pro_prinact = $("#hid_ctg_pri_desc__" + intParametro).val();

            //alert(strCodigo + "                         strCodigo");

            $("#ctg_pro_prinact").val(strctg_pro_prinact);

            $('#princActivo').modal('hide')

        }

    };

    function fntSelectLab(intParametro) {

intParametro = !intParametro ? 0 : intParametro;

if (intParametro > 0) {

    var strctg_laf_nomcom = $("#hid_ctg_laf_nomcom__" + intParametro).val();

    //alert(strCodigo + "                         strCodigo");

    $("#ctg_pro_labfar").val(strctg_laf_nomcom);
    $("#ctg_pro_labfar_name").val(strctg_laf_nomcom);

    $('#labFar').modal('hide')

}

};
</script>

<style>
    .tableFixHead {
        overflow-y: auto;
        height: 900px !important;
    }
</style>
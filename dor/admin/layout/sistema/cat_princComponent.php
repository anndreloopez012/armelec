<section class="content col-lg-12 app" id="app" name="app"><br>
    <div class="container-fluid" id="formulario">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-3"></div>
                <div class="cont col-lg-6">
                    <form id="formData" method="POST"><br>
                        <div class="row">
                            <div class="col-4">
                                <input type="text" id="ctg_pri_id" name="ctg_pri_id" class="form-control" placeholder="Codigo" onblur="fntValCodigo()">
                            </div>
                            <div class="col-8">
                                <input type="text" id="ctg_pri_desc" name="ctg_pri_desc" class="form-control" placeholder="Descripcion">
                            </div>
                            <div class="col-12"><br>
                                <a onclick="fntInsert()" class="btn btn-success btn-block " id="save" names="save"><i class="fad fa-2x fa-save"></i> Guardar</a>
                                <a onclick="fntEdit()" class="btn btn-success btn-block " id="edit" names="edit"><i class="fad fa-2x fa-save"></i> Editar</a>
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
            <div class="col-lg-3"></div>
            <div class="cont col-lg-6"><br>
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

            var strctg_pri_id = $("#hid_ctg_pri_id" + intParametro).val();
            var strctg_pri_desc = $("#hid_ctg_pri_desc" + intParametro).val();
         
            //alert(strCodigo + "                         strCodigo");

            $("#ctg_pri_id").val(strctg_pri_id);
            $("#ctg_pri_desc").val(strctg_pri_desc);
        }
        document.getElementById('edit').style.display = 'block';
        document.getElementById('save').style.display = 'none';

    };


    function fntSelectDelete(intParametro) {

        intParametro = !intParametro ? 0 : intParametro;

        if (intParametro > 0) {

            var strctg_pri_id = $("#hid_ctg_pri_id" + intParametro).val();
            //alert(strCodigo + "                         strCodigo");
            $("#ctg_pri_id").val(strctg_pri_id);
        }

        fntDelete()
    };

</script>

<style>
    .tableFixHead {
        overflow-y: auto;
        height: 900px !important;
    }
</style>
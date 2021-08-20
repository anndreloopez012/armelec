<section class="content col-lg-12 app" id="app" name="app"><br>
    <div class="container-fluid" id="formulario">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-1"></div>
                <div class="cont col-lg-10">
                    <form id="formData" method="POST"><br>
                        <div class="row">

                            <div class="col-2">
                                <input type="text" id="ctg_ser_code" name="ctg_ser_code" class="form-control" placeholder="Codigo" onblur="fntValCodigo()">
                            </div>
                            <div class="col-3">
                                <input type="text" id="ctg_ser_descrip" name="ctg_ser_descrip" class="form-control" placeholder="Descripcion">
                            </div>
                            <div class="col-7">
                                <textarea id="ctg_ser_obs" name="ctg_ser_obs" class="form-control" placeholder="Observaciones"  rows="3"></textarea>
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

            var strctg_ser_code = $("#hid_ctg_ser_code" + intParametro).val();
            var strctg_ser_descrip = $("#hid_ctg_ser_descrip" + intParametro).val();
            var strctg_ser_obs = $("#hid_ctg_ser_obs" + intParametro).val();

            //alert(strctg_ser_code + "                         strctg_ser_code");

            $("#ctg_ser_code").val(strctg_ser_code);
            $("#ctg_ser_descrip").val(strctg_ser_descrip);
            $("#ctg_ser_obs").val(strctg_ser_obs);
        }
        document.getElementById('edit').style.display = 'block';
        document.getElementById('save').style.display = 'none';

    };


    function fntSelectDelete(intParametro) {

        intParametro = !intParametro ? 0 : intParametro;

        if (intParametro > 0) {

            var strctg_ser_code = $("#hid_ctg_ser_code" + intParametro).val();
            //alert(strCodigo + "                         strCodigo");
            $("#ctg_ser_code").val(strctg_ser_code);
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
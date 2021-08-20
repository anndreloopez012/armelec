<body>
    <section class="content col-md-12">
        <div class="col-md-12">
            <div>
                <p><br>
                    <a class="btn btn-raised btn-info" href="index.php" role="button" aria-expanded="false" href="index.php">Menu</a>
                    <a class="btn btn-raised btn-info" href="doctorsPatient.php" role="button" href="index.php">Regresar</a>
                    <a class="btn btn-raised btn-info btn-center" type="button" data-toggle="collapse" data-target="#AddCita" aria-expanded="false" aria-controls="AddCita">ASEGURADORAS</a>
                </p>
                <div class="row">
                    <div class="col-md-3"></div>
                    <div class="col-md-6 collapse show" id="AddCita">
                        <div class="card card-body">
                            <div class="card card-primary collapsed-card">
                                <div class="card-body " style="display: block;">
                                    <form id="formData" method="POST">
                                        <div class="row">
                                            <div class="form-group col-md-1">
                                                <a href=" " data-toggle="modal" id="btn1" data-target="#basicExampleModal1"><i class="fad fa-2x fa-search"></i></a>
                                            </div>
                                            <div class="form-group col-md-11">
                                                <label for="Nombres" class="color-label">Nombre De La Aseguradora</label>
                                                <input class="form-control" type="hidden" id="code" name="code" value="<?php echo  $cod_id; ?>">
                                                <input type="hidden" class="form-control" id="nombre1" name="nombre1" value="<?php echo  $id_insur_one; ?>">
                                                <input type="text" class="form-control" id="ctg_ase_code1" name="ctg_ase_code1" value="<?php echo  $ctg_ase_code1; ?>">
                                            </div>

                                            <div class="form-group col-md-1">
                                                <a href=" " data-toggle="modal" id="btn2" data-target="#basicExampleModal2"><i class="fad fa-2x fa-search"></i></a>
                                            </div>
                                            <div class="form-group col-md-11">
                                                <label for="Nombres" class="color-label">Nombre De La Aseguradora</label>
                                                <input type="hidden" class="form-control" id="nombre2" name="nombre2" value="<?php echo  $id_insur_two; ?>">
                                                <input type="text" class="form-control" id="ctg_ase_code2" name="ctg_ase_code2" value="<?php echo  $ctg_ase_code2; ?>">
                                            </div>

                                            <div class="form-group col-md-1">
                                                <a href=" " data-toggle="modal" id="btn3" data-target="#basicExampleModal3"><i class="fad fa-2x fa-search"></i></a>
                                            </div>
                                            <div class="form-group col-md-11">
                                                <label for="Nombres" class="color-label">Nombre De La Aseguradora</label>
                                                <input type="hidden" class="form-control" id="nombre3" name="nombre3" value="<?php echo  $id_insur_thre; ?>">
                                                <input type="text" class="form-control" id="ctg_ase_code3" name="ctg_ase_code3" value="<?php echo  $ctg_ase_code3; ?>">
                                            </div>

                                            <div class="form-group col-md-1">
                                                <a href=" " data-toggle="modal" id="btn4" data-target="#basicExampleModal4"><i class="fad fa-2x fa-search"></i></a>
                                            </div>
                                            <div class="form-group col-md-11">
                                                <label for="Nombres" class="color-label">Nombre De La Aseguradora</label>
                                                <input type="hidden" class="form-control" id="nombre4" name="nombre4" value="<?php echo  $id_insur_four; ?>">
                                                <input type="text" class="form-control" id="ctg_ase_code4" name="ctg_ase_code4" value="<?php echo  $ctg_ase_code4; ?>">
                                            </div>

                                            <div class="form-group col-md-1">
                                                <a href=" " data-toggle="modal" id="btn5" data-target="#basicExampleModal5"><i class="fad fa-2x fa-search"></i></a>
                                            </div>
                                            <div class="form-group col-md-11">
                                                <label for="Nombres" class="color-label">Nombre De La Aseguradora</label>
                                                <input type="hidden" class="form-control" id="nombre5" name="nombre5" value="<?php echo  $id_insur_five; ?>">
                                                <input type="text" class="form-control" id="ctg_ase_code5" name="ctg_ase_code5" value="<?php echo  $ctg_ase_code5; ?>">
                                            </div>
                                        </div>
                                    </form>
                                    <div class="col-md-6 row">
                                        <div class="col-md-2">
                                            <a type="button" class="btn btn-raised btn-primary" id="return" href="doctorsPatient.php"><i class="fad fa-2x fa-arrow-square-left"></i></a>
                                        </div>
                                        <div class="col-md-2">
                                            <button type="button" class="btn btn-raised btn-primary" id="btnEdit" onclick="fntSelectEdit()"><i class="far fa-2x fa-pen-square"></i></button>
                                            <button type="button" class="btn btn-raised btn-primary" id="btnUpdate" onclick="fntUpdate()"><i class="fad fa-2x fa-save"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
    </section>
    <div class="modal fade bd-example-modal-lg" id="basicExampleModal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title w-100" id="myModalLabel">ASEGURADORA</h4>
                    <button type="button" class="CERRAR" data-dismiss="modal" aria-label="CERRAR">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="col-sm-12 row">
                        <div class="col-sm-6">
                            <input class="form-control" name="Search" id="Search" type="text" style="text-transform:uppercase;" placeholder="Buscar citas">
                        </div>
                        <div>
                            <a type="button" class="btn btn-info" onchange="fntDibujoTabla1() "><i class="fad fa-2x fa-search"></i></a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="div1">
                            <div id="Tabla1" name="Tabla1">
                                <!-- DIBUJO DE TABLA CATEGORIA PRODUCTO-->
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">CERRAR</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade bd-example-modal-lg" id="basicExampleModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title w-100" id="myModalLabel">ASEGURADORA</h4>
                    <button type="button" class="CERRAR" data-dismiss="modal" aria-label="CERRAR">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="col-sm-12 row">
                        <div class="col-sm-6">
                            <input class="form-control" name="Search" id="Search" type="text" style="text-transform:uppercase;" placeholder="Buscar citas">
                        </div>
                        <div>
                            <a type="button" class="btn btn-info" onchange="fntDibujoTabla2() "><i class="fad fa-2x fa-search"></i></a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="div1">
                            <div id="Tabla2" name="Tabla2">
                                <!-- DIBUJO DE TABLA CATEGORIA PRODUCTO-->
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">CERRAR</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade bd-example-modal-lg" id="basicExampleModal3" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title w-100" id="myModalLabel">ASEGURADORA</h4>
                    <button type="button" class="CERRAR" data-dismiss="modal" aria-label="CERRAR">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="col-sm-12 row">
                        <div class="col-sm-6">
                            <input class="form-control" name="Search" id="Search" type="text" style="text-transform:uppercase;" placeholder="Buscar citas">
                        </div>
                        <div>
                            <a type="button" class="btn btn-info" onchange="fntDibujoTabla3() "><i class="fad fa-2x fa-search"></i></a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="div1">
                            <div id="Tabla3" name="Tabla3">
                                <!-- DIBUJO DE TABLA CATEGORIA PRODUCTO-->
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">CERRAR</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade bd-example-modal-lg" id="basicExampleModal4" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title w-100" id="myModalLabel">ASEGURADORA</h4>
                    <button type="button" class="CERRAR" data-dismiss="modal" aria-label="CERRAR">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="col-sm-12 row">
                        <div class="col-sm-6">
                            <input class="form-control" name="Search" id="Search" type="text" style="text-transform:uppercase;" placeholder="Buscar citas">
                        </div>
                        <div>
                            <a type="button" class="btn btn-info" onchange="fntDibujoTabla4() "><i class="fad fa-2x fa-search"></i></a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="div1">
                            <div id="Tabla4" name="Tabla4">
                                <!-- DIBUJO DE TABLA CATEGORIA PRODUCTO-->
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">CERRAR</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade bd-example-modal-lg" id="basicExampleModal5" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title w-100" id="myModalLabel">ASEGURADORA</h4>
                    <button type="button" class="CERRAR" data-dismiss="modal" aria-label="CERRAR">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="col-sm-12 row">
                        <div class="col-sm-6">
                            <input class="form-control" name="Search" id="Search" type="text" style="text-transform:uppercase;" placeholder="Buscar citas">
                        </div>
                        <div>
                            <a type="button" class="btn btn-info" onchange="fntDibujoTabla5() "><i class="fad fa-2x fa-search"></i></a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="div1">
                            <div id="Tabla5" name="Tabla5">
                                <!-- DIBUJO DE TABLA CATEGORIA PRODUCTO-->
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">CERRAR</button>
                </div>
            </div>
        </div>
    </div>



    <script>
        document.getElementById('btnEdit').style.display = 'block';
        document.getElementById('btnUpdate').style.display = 'none';

        document.getElementById('btn1').style.display = 'none';
        document.getElementById('btn2').style.display = 'none';
        document.getElementById('btn3').style.display = 'none';
        document.getElementById('btn4').style.display = 'none';
        document.getElementById('btn5').style.display = 'none';

        $(document).ready(function() {
            $('input,textarea,select,checkbox').attr('readonly', true)
        });

        function fntSelectEdit() {

            document.getElementById('btnEdit').style.display = 'none';
            document.getElementById('btnUpdate').style.display = 'block';

            document.getElementById('btn1').style.display = 'block';
            document.getElementById('btn2').style.display = 'block';
            document.getElementById('btn3').style.display = 'block';
            document.getElementById('btn4').style.display = 'block';
            document.getElementById('btn5').style.display = 'block';

            $('input,textarea,select').attr('readonly', false)

        }

        function fntSelectView1(intParametro) {
            intParametro = !intParametro ? 0 : intParametro;

            if (intParametro > 0) {

                var strId = $("#hidId_" + intParametro).val();
                var strNombre = $("#hidNombre_" + intParametro).val();

                // alert(strDPI + "                         strDPI");

                $("#nombre1").val(strId);
                $("#ctg_ase_code1").val(strNombre);

            }

        }

        function fntSelectView2(intParametro) {
            intParametro = !intParametro ? 0 : intParametro;

            if (intParametro > 0) {

                var strId = $("#hidId_" + intParametro).val();
                var strNombre = $("#hidNombre_" + intParametro).val();

                // alert(strDPI + "                         strDPI");

                $("#nombre2").val(strId);
                $("#ctg_ase_code2").val(strNombre);

            }

        }

        function fntSelectView3(intParametro) {
            intParametro = !intParametro ? 0 : intParametro;

            if (intParametro > 0) {

                var strId = $("#hidId_" + intParametro).val();
                var strNombre = $("#hidNombre_" + intParametro).val();

                // alert(strDPI + "                         strDPI");

                $("#nombre3").val(strId);
                $("#ctg_ase_code3").val(strNombre);

            }

        }

        function fntSelectView4(intParametro) {
            intParametro = !intParametro ? 0 : intParametro;

            if (intParametro > 0) {

                var strId = $("#hidId_" + intParametro).val();
                var strNombre = $("#hidNombre_" + intParametro).val();

                // alert(strDPI + "                         strDPI");

                $("#nombre4").val(strId);
                $("#ctg_ase_code4").val(strNombre);

            }

        }

        function fntSelectView5(intParametro) {
            intParametro = !intParametro ? 0 : intParametro;

            if (intParametro > 0) {

                var strId = $("#hidId_" + intParametro).val();
                var strNombre = $("#hidNombre_" + intParametro).val();

                // alert(strDPI + "                         strDPI");

                $("#nombre5").val(strId);
                $("#ctg_ase_code5").val(strNombre);

            }

        }

        function fntSelectView6(intParametro) {
            intParametro = !intParametro ? 0 : intParametro;

            if (intParametro > 0) {

                var strId = $("#hidId_" + intParametro).val();
                var strNombre = $("#hidNombre_" + intParametro).val();

                // alert(strDPI + "                         strDPI");

                $("#nombre6").val(strId);
                $("#ctg_ase_code6").val(strNombre);

            }

        }

        function fntSelectView7(intParametro) {
            intParametro = !intParametro ? 0 : intParametro;

            if (intParametro > 0) {

                var strId = $("#hidId_" + intParametro).val();
                var strNombre = $("#hidNombre_" + intParametro).val();

                // alert(strDPI + "                         strDPI");

                $("#nombre7").val(strId);
                $("#ctg_ase_code7").val(strNombre);

            }

        }

        function fntSelectView8(intParametro) {
            intParametro = !intParametro ? 0 : intParametro;

            if (intParametro > 0) {

                var strId = $("#hidId_" + intParametro).val();
                var strNombre = $("#hidNombre_" + intParametro).val();

                // alert(strDPI + "                         strDPI");

                $("#nombre8").val(strId);
                $("#ctg_ase_code8").val(strNombre);

            }

        }

        function fntSelectView9(intParametro) {
            intParametro = !intParametro ? 0 : intParametro;

            if (intParametro > 0) {

                var strId = $("#hidId_" + intParametro).val();
                var strNombre = $("#hidNombre_" + intParametro).val();

                // alert(strDPI + "                         strDPI");

                $("#nombre9").val(strId);
                $("#ctg_ase_code9").val(strNombre);

            }

        }
    </script>

    <style>
        .color-label {
            color: #03a9f4 !important;
        }

        a.btn-center {
            text-align: center !important;
        }

        .custom-file-control,
        .form-control,
        .is-focused .custom-file-control,
        .is-focused .form-control {
            background-image: linear-gradient(0deg,
                    #03a9f4 2px, rgba(0, 150, 136, 0) 0), linear-gradient(0deg, rgba(0, 0, 0, .26) 1px,
                    transparent 0) !important;
        }
    </style>
</body>
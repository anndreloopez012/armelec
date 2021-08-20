<body>
    <section class="content col-md-12">
        <div class="col-md-12">
            <p>
                <p>
                    <a class="btn btn-raised btn-info" href="index.php" role="button" aria-expanded="false" href="index.php">Menu</a>
                    <a class="btn btn-raised btn-info btn-center" type="button" onclick="fnthistorialMedicMostrarOcultar()">CITAS ACTIVAS</a>
                  <!--  <a class="btn btn-raised btn-info btn-center" type="button" id="buy" onclick="fnthistorialMedicAddMostrarOcultar()"><i class="fad fa-1x fa-user-plus"></i>AGREGAR</a>-->
                    <a class="btn btn-raised btn-info btn-center" type="button" id="order" onclick="fntOrdenMostrarOcultar()">ORDENES</a>
                </p>
                <div class="collapse show" id="historialMedic">
                    <div class="card-body">
                        <div class="card-primary collapsed-card">

                            <div class="card-body">
                                <div class="col-sm-12 row">
                                <a type="button" class="btn btn-raised btn-primary" id="return" href="index.php"><i class="fad fa-2x fa-arrow-square-left" aria-hidden="true"></i></a>&nbsp;&nbsp;

                                    <div class="col-sm-6">
                                        <input class="form-control" name="Search" id="Search" type="text" style="text-transform:uppercase;" placeholder="Buscar citas">
                                    </div>
                                    <div>
                                        <a type="button" class="btn btn-info" onchange="fntDibujoTabla() "><i class="fad fa-2x fa-search"></i></a>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="div1">
                                        <div id="Tabla" name="Tabla">
                                            <!-- DIBUJO DE TABLA CATEGORIA -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class=" collapse show" id="historialMedicAdd">
                    <div class="card-body">
                        <div class="card-primary collapsed-card">
                            <div class="card-body " style="display: block;">
                                <form id="formData" method="POST">
                                    <div class="row">
                                        <div class="form-group col-md-2">
                                            <label for="Fecha" class=" color-label">Fecha De Consulta</label>
                                            <input type="date"  class="form-control" id="fecha_consulta" name="fecha_consulta">
                                        </div>
                                        <div class="form-group col-md-2">
                                            <label for="Fecha" class=" color-label">Fecha de Proxima Consulta</label>
                                            <input type="date"  class="form-control" id="fecha_consulta_prox" name="fecha_consulta_prox">
                                        </div>
                                        <div class="col-8"></div>
                                        <div class="form-group col-md-3">
                                            <label for="Nombres" class="color-label">Medico</label>
                                            <a href=" " data-toggle="modal" data-target="#basicExampleModal"><i class="fad fa-2x fa-search"></i></a>
                                            <input type="text" class="form-control" id="Medico" name="Medico">
                                            <input type="hidden" class="form-control" id="Medico_id" name="Medico_id">
                                        </div>
                                        <div class="form-group col-md-12">
                                            <label for="Motivo" class=" color-label">Motivo</label>
                                            <textarea class="form-control" id="Motivo" name="Motivo" rows="3" ></textarea>
                                            <span class="bmd-help">Ingresa el Motivo de la consulta</span>
                                        </div>
                                        <div class="form-group col-md-12">
                                            <label for="Motivo" class=" color-label">Receta</label>
                                            <textarea class="form-control" id="Receta" name="Receta" rows="3" ></textarea>
                                            <span class="bmd-help">Ingresa la Receta de la consulta</span>
                                        </div>
                                        <div class="form-group col-md-12">
                                            <label for="Motivo" class=" color-label">Examen</label>
                                            <textarea class="form-control" id="Dieta" name="Dieta" rows="3" ></textarea>
                                            <span class="bmd-help">Ingresa el Examen de la consulta</span>
                                        </div>
                                        <div class="form-group">
                                            <input type="file" class="form-control-file" id="file" name="file">
                                        </div>
                                    </div>
                                </form>
                                <div class="col-4 row">
                                    <div class="col-2 ">
                                        <button type="button" class="btn btn-raised btn-primary" id="btnreturn" onclick="fnthistorialMedicMostrarOcultar()"><i class="fad fa-2x fa-arrow-square-left"></i></button>
                                    </div>
                                    <div class="col-2">
                                        <button type="button" class="btn btn-raised btn-primary" id="btnInsert" onclick="fntInsert()"><i class="fad fa-2x fa-save"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class=" collapse show" id="historialOrder">
                    <div class="card-body">
                    <div class="col-1">
                    &nbsp;&nbsp;<a type="button" class="btn btn-raised btn-primary" id="return" onclick="fnthistorialMedicMostrarOcultar()"><i class="fad fa-2x fa-arrow-square-left" aria-hidden="true"></i></a>&nbsp;&nbsp;

                                </div>

                        <ul class="nav nav-tabs" id="myTab" role="tablist">

                            <li class="nav-item">
                                <a class="nav-link" id="Medicamentos-tab" data-toggle="tab" href="#Medicamentos" role="tab" aria-controls="Medicamentos" aria-selected="true">Farmacias</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="Farmaceuticas-tab" data-toggle="tab" href="#Farmaceuticas" role="tab" aria-controls="Farmaceuticas" aria-selected="false">Laboratorios</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="Hospitales-tab" data-toggle="tab" href="#Hospitales" role="tab" aria-controls="Hospitales" aria-selected="false">Hospitales</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="Vacunas-tab" data-toggle="tab" href="#Vacunas" role="tab" aria-controls="Vacunas" aria-selected="false">Vacunas</a>
                            </li>
                        </ul>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade" id="Medicamentos" role="tabpanel" aria-labelledby="Medicamentos-tab">

                                <div class="div1">
                                    <div id="TablaMedicamentosOrder" name="TablaMedicamentosOrder">
                                        <!-- DIBUJO DE TABLA -->
                                    </div>
                                </div>

                            </div>
                            <div class="tab-pane fade" id="Hospitales" role="tabpanel" aria-labelledby="Hospitales-tab">

                                <div class="div1">
                                    <div id="TablaHospitalesOrder" name="TablaHospitalesOrder">
                                        <!-- DIBUJO DE TABLA  -->
                                    </div>
                                </div>

                            </div>
                            <div class="tab-pane fade" id="Farmaceuticas" role="tabpanel" aria-labelledby="Farmaceuticas-tab">

                                <div class="div1">
                                    <div id="TablaFarmaceuticasOrder" name="TablaFarmaceuticasOrder">
                                        <!-- DIBUJO DE TABLA  -->
                                    </div>
                                </div>

                            </div>
                            <div class="tab-pane fade" id="Vacunas" role="tabpanel" aria-labelledby="Vacunas-tab">

                                <div class="div1">
                                    <div id="TablaVacunasOrder" name="TablaVacunasOrder">
                                        <!-- DIBUJO DE TABLA  -->
                                    </div>
                                </div>

                            </div>
                        </div>

                    </div>
                </div>
    </section>

    <div class="modal fade" id="basicExampleModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title w-100" id="myModalLabel">MEDICOS</h4>
                    <button type="button" class="CERRAR" data-dismiss="modal" aria-label="CERRAR">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="card-primary collapsed-card">
                        <div class="col-sm-12 row">
                            <div class="col-sm-6">
                                <input class="form-control" name="Search" id="Search" type="text" style="text-transform:uppercase;" placeholder="Escriba el dato a buscar">
                            </div>
                            <div>
                                <a type="button" class="btn btn-info" onclick="fntDibujoTablaDoctor() "><i class="fad fa-2x fa-search"></i></a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="div1">
                                <div id="TablaDoctor" name="TablaDoctor">
                                    <!-- DIBUJO DE TABLA -->
                                </div>
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
        // MOSTRAR Y OCULTAR MODULOS
        document.getElementById('historialOrder').style.display = 'none';
        document.getElementById('historialMedicAdd').style.display = 'none';
        document.getElementById('historialMedic').style.display = 'block';
        document.getElementById('btnInsert').style.display = 'block';


        function fnthistorialMedicMostrarOcultar() {
            // PACIENTES
            document.getElementById('historialOrder').style.display = 'none';
            document.getElementById('historialMedicAdd').style.display = 'none';

            document.getElementById('btnInsert').style.display = 'block';

            var elemento = document.getElementById('historialMedic');
            if (!elemento) {
                return true;
            }
            if (elemento.style.display == "none") {
                elemento.style.display = "block"
            } else {
                elemento.style.display = "none"
            };

            document.getElementById('buy').style.display = 'inline';

            $('input,textarea,select,checkbox').attr('readonly', false)

            return true;
        };

        function fnthistorialMedicAddMostrarOcultar() {
            // PACIENTES
            document.getElementById('historialOrder').style.display = 'none';
            document.getElementById('historialMedic').style.display = 'none';

            document.getElementById('btnInsert').style.display = 'block';

            var elemento = document.getElementById('historialMedicAdd');
            if (!elemento) {
                return true;
            }
            if (elemento.style.display == "none") {
                elemento.style.display = "block"
            } else {
                elemento.style.display = "none"
            };
            document.getElementById('buy').style.display = 'inline';

            $('input,textarea,select,checkbox').attr('readonly', false)

            return true;
        };

        function fntOrdenMostrarOcultar() {
            // PACIENTES
            document.getElementById('historialMedicAdd').style.display = 'none';
            document.getElementById('historialMedic').style.display = 'none';

            document.getElementById('btnInsert').style.display = 'none';

            var elemento = document.getElementById('historialOrder');
            if (!elemento) {
                return true;
            }
            if (elemento.style.display == "none") {
                elemento.style.display = "block"
            } else {
                elemento.style.display = "none"
            };
            document.getElementById('order').style.display = 'inline';

            $('input,textarea,select,checkbox').attr('readonly', false)

            return true;
        };

        function fntSelectPatient(intParametro) {
            intParametro = !intParametro ? 0 : intParametro;


            if (intParametro > 0) {

                var strId = $("#hid_doc_id_" + intParametro).val();
                var strName = $("#hid_doc_" + intParametro).val();

                // alert(strDPI + "                         strDPI");

                $("#Medico_id").val(strId);
                $("#Medico").val(strName);

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

        center {
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
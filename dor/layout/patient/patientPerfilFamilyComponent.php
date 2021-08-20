<body>
    <section class="content col-md-12">
        <div class="col-md-12">
            <p>
                <p>
                    <a class="btn btn-raised btn-info" href="index.php" role="button" aria-expanded="false" href="index.php">Menu</a>
                    <a class="btn btn-raised btn-info btn-center" type="button" onclick="fntCitaActiveMostrarOcultar()">FAMILIA</a>
                    <a class="btn btn-raised btn-info btn-center" type="button" id="buy" onclick="fntAddCitaMostrarOcultar()"><i class="fad fa-1x fa-user-plus"></i>AGREGAR</a>

                </p>
                <div class="collapse show" id="tablaFamilia_">
                    <div class="card-body">
                        <div class="card-primary collapsed-card">

                            <div class="card-body">
                                <div class="col-sm-12 row">
                                <a type="button" class="btn btn-raised btn-primary" id="return" href="index.php"><i class="fad fa-2x fa-arrow-square-left" aria-hidden="true"></i></a>&nbsp;&nbsp;
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
                <div class=" collapse show" id="AddFamilia">
                    <div class="card-body">
                        <div class="card-primary collapsed-card">
                            <div class="card-body " style="display: block;">
                                <form id="formData" method="POST">
                                    <div class="row">
                                    <input type="hidden" class="form-control" id="id" name="id">

                                        <div class="form-group col-md-2">
                                            <label for="Estado" class=" color-label">Relacion Familia</label>
                                            <select class="form-control" id="relacion" name="relacion">
                                                <option id="0">Select</option>
                                                <option value="1">Hijo/a</option>
                                                <option value="2">Esposa/o</option>
                                                <option value="3">Sobrino/a</option>
                                                <option value="4">Suegro/a</option>
                                                <option value="5">Primo/a</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="Nombres" class="color-label">DPI</label>
                                            <input type="text" class="form-control" id="DPI" name="DPI">
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="Nombres" class="color-label">Nombres</label>
                                            <input type="text" class="form-control" id="Nombres" name="Nombres">
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="Nombres" class="color-label">Apellidos </label>
                                            <input type="text" class="form-control" id="Apellidos" name="Apellidos">
                                        </div>
                                        <div class="form-group col-md-2">
                                            <label for="Estado" class=" color-label">Sexo</label>
                                            <select class="form-control" id="sexo" name="sexo">
                                                <option id="0">Select</option>
                                                <option value="1">Masculino</option>
                                                <option value="2">Femenino</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-2">
                                            <label for="Fecha" class=" color-label">Fecha De Nacimiento</label>
                                            <input type="hidden" class="form-control" id="Nacimiento" name="Nacimiento">
                                            <input type="date" value='' class="form-control" id="Fecha" name="Fecha">
                                        </div>
                                        <div class="form-group col-md-2">
                                            <label for="Nombres" class="color-label">Estatura(cms)</label>
                                            <input type="text" class="form-control" id="Estatura" name="Estatura">
                                        </div>
                                        <div class="form-group col-md-2">
                                            <label for="Nombres" class="color-label">Peso(libras)</label>
                                            <input type="text" class="form-control" id="Peso" name="Peso">
                                        </div>
                                        <br>
                                </form>
                                <div class="col-5 row">
                                    <div class="col-2 ">
                                        <button type="button" class="btn btn-raised btn-primary" id="btnreturn" onclick="fntCitaActiveMostrarOcultar()"><i class="fad fa-2x fa-arrow-square-left"></i></button>
                                    </div>
                                    <div class="col-2">
                                        <button type="button" class="btn btn-raised btn-primary" id="btnInsert" onclick="fntInsert()"><i class="fad fa-2x fa-save"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
    </section>

    <script>
        // MOSTRAR Y OCULTAR MODULOS
        document.getElementById('AddFamilia').style.display = 'none';
        document.getElementById('tablaFamilia_').style.display = 'block';
        document.getElementById('btnInsert').style.display = 'block';


        function fntCitaActiveMostrarOcultar() {
            // PACIENTES
            document.getElementById('AddFamilia').style.display = 'none';

            document.getElementById('btnInsert').style.display = 'block';

            var elemento = document.getElementById('tablaFamilia_');
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

        function fntAddCitaMostrarOcultar() {
            // PACIENTES
            document.getElementById('tablaFamilia_').style.display = 'none';

            document.getElementById('btnInsert').style.display = 'block';

            var elemento = document.getElementById('AddFamilia');
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
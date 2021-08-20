<body>
    <section class="content col-md-12">
        <div class="col-md-12">
            <p>
            <p>
                <a class="btn btn-raised btn-info" href="index.php" role="button" aria-expanded="false" href="index.php">Menu</a>
                <a class="btn btn-raised btn-info btn-center" type="button" id="list" onclick="fntNuevoMostrarVacineList()">LISTA</a>
                <a class="btn btn-raised btn-info btn-center" type="button" id="add" onclick="fntNuevoVacine()">AGREGAR</a>
                <a class="btn btn-raised btn-info btn-center" type="button" id="shop" onclick="fntCompraVacine()">COMPRAR</a>
                <a class="btn btn-raised btn-info btn-center" type="button" id="buy" onclick="fntNuevoMostrarVacineBuyList()">VENTAS</a>
            </p>
            <div class="collapse show" id="vaccine">
                <div class="card-body">
                    <div class="card-primary collapsed-card">
                        <div class="col-md-12">
                            <form id="formData" method="POST">
                                <div class="row">
                                    <div class="form-group col-md-1">
                                        <label for="exampleInputEmail1" class=" color-label">Codigo</label>
                                        <input type="number" class="form-control" id="codigo" name="codigo" onblur="fntValCod()">
                                        <input type="hidden" class="form-control" id="id" name="id">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="exampleInputEmail1" class=" color-label">Nombre</label>
                                        <input type="text" class="form-control" id="nombre" name="nombre">
                                    </div>
                                    <div class="form-group col-md-1">
                                        <label for="exampleInputEmail1" class=" color-label">Costo</label>
                                        <input type="number" class="form-control" id="costo" name="costo" value="0" onFocus="if (this.value=='0') this.value='';">
                                    </div>
                                    <div class="form-group col-md-1">
                                        <label for="exampleInputEmail1" class=" color-label">Precio de Venta </label>
                                        <input type="number" class="form-control" id="precio_venta" name="precio_venta" value="0" onFocus="if (this.value=='0') this.value='';">
                                    </div>
                                    <div class="form-group col-md-1">
                                        <label for="exampleInputEmail1" class=" color-label">Saldo Inicial </label>
                                        <input type="number" class="form-control" id="saldo_inicial" name="saldo_inicial" value="0" onFocus="if (this.value=='0') this.value='';">
                                    </div>
                                    <div class="form-group col-md-1">
                                        <input type="hidden" class="form-control" id="saldo_actual" name="saldo_actual" value="0">
                                        <input type="hidden" class="form-control" id="saldo_actual_" name="saldo_actual_" value="0">
                                    </div>

                                    <div class="form-group col-md-12">
                                        <label for="exampleTextarea" class=" color-label">Descripcion</label>
                                        <textarea class="form-control" id="descripcion" name="descripcion" rows="3" onfocus="fntSaldoAct()"></textarea>
                                        <span class="bmd-help">Ingresa descripcion exacta </span>
                                    </div>
                                    <div class="col-4 row">
                                        <div class="col-2 ">
                                            <button type="button" class="btn btn-raised btn-primary" id="btnreturn" onclick="fntNuevoMostrarVacineList()"><i class="fad fa-2x fa-arrow-square-left"></i></button>
                                        </div>
                                        <div class="col-2 ">
                                            <button type="button" class="btn btn-raised btn-primary" id="btnInsert" onclick="fntInsert()"><i class="fad fa-2x fa-save"></i></button>
                                            <button type="button" class="btn btn-raised btn-primary" id="btnUpdate" onclick="fntUpdate()"><i class="fad fa-2x fa-save"></i></button>
                                        </div>
                                    </div>
                                </div>


                        </div>
                    </div>
                </div>
            </div>

            <div class="collapse show" id="vaccineShop">
                <div class="card-body">
                    <div class="card-primary collapsed-card">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="form-group col-md-1">
                                    <label for="exampleInputEmail1" class=" color-label">Codigo</label>
                                    <input type="number" class="form-control" id="med_vam_id" name="med_vam_id" onfocus="fntHideVaccine()">
                                    <input type="hidden" id="med_vam_id_s" name="med_vam_id_s" >
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="exampleInputEmail1" class=" color-label">Nombre</label>
                                    <input type="text" class="form-control" id="med_vam_nom" name="med_vam_nom">
                                </div>
                                <div class="form-group col-md-1">
                                    <label for="exampleInputEmail1" class=" color-label">Numero De Factura</label>
                                    <input type="number" class="form-control" id="med_vam_fac" name="med_vam_fac" value="0" onFocus="if (this.value=='0') this.value='';">
                                </div>
                                <div class="form-group col-md-1">
                                    <label for="exampleInputEmail1" class=" color-label">Fecha de la Factura</label>
                                    <input type="date" class="form-control" id="med_vam_fac_dt" name="med_vam_fac_dt" value="0" onFocus="if (this.value=='0') this.value='';">
                                </div>
                                <div class="form-group col-md-1">
                                    <label for="exampleInputEmail1" class=" color-label">Costo</label>
                                    <input type="number" class="form-control" id="med_vam_costo" name="med_vam_costo" value="0" onFocus="if (this.value=='0') this.value='';">
                                </div>
                                <div class="form-group col-md-1">
                                    <label for="exampleInputEmail1" class=" color-label">Uninades </label>
                                    <input type="number" class="form-control" id="med_vam_uni" name="med_vam_uni" value="0" onFocus="if (this.value=='0') this.value='';">
                                </div>
                                <div class="form-group col-md-12">
                                </div>
                                <div class="col-4 row">
                                    <div class="col-2 ">
                                        <button type="button" class="btn btn-raised btn-primary" id="btnreturn" onclick="fntNuevoMostrarVacineList()"><i class="fad fa-2x fa-arrow-square-left"></i></button>
                                    </div>
                                    <div class="col-2 ">
                                        <button type="button" class="btn btn-raised btn-primary" id="btnInsertComp" onclick="fntUpdate_compra()"><i class="fad fa-2x fa-save"></i></button>
                                    </div>
                                </div>
                            </div>
                            </form>


                        </div>
                    </div>
                </div>
            </div>
            </p>

            <div class="collapse" id="vaccineList">
                <div class="card-body">
                    <div class="card-primary collapsed-card">
                        <div class="col-sm-12 row">
                            &nbsp;&nbsp;<a type="button" class="btn btn-raised btn-primary" id="return" href="index.php"><i class="fad fa-2x fa-arrow-square-left" aria-hidden="true"></i></a>&nbsp;&nbsp;
                            <div class="col-sm-6">
                                <input class="form-control" name="SearchVacine" id="SearchVacine" type="text" style="text-transform:uppercase;" placeholder="Escriba el dato a buscar">
                            </div>
                            <div>
                                <a type="button" class="btn btn-info" onclick="fntDibujoTablaVaccine() "><i class="fad fa-2x fa-search"></i></a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="div1">
                                <div id="Tabla" name="Tabla">
                                    <!-- DIBUJO DE TABLA CATEGORIA PRODUCTO-->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="collapse" id="vaccineBuyList">
                <div class="card-body">
                    <div class="card-primary collapsed-card">
                        <div class="col-sm-12 row">
                            <div class="col-sm-6">
                                <input class="form-control" name="Search" id="Search" type="text" style="text-transform:uppercase;" placeholder="Escriba el dato a buscar">
                            </div>
                            <div>
                                <a type="button" class="btn btn-info" onclick="fntDibujoTablavaccineBuyList() "><i class="fad fa-2x fa-search"></i></a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="div1">
                                <div id="TablaTwo" name="TablaTwo">
                                    <!-- DIBUJO DE TABLA CATEGORIA PRODUCTO-->
                                </div>
                            </div>

                            <div class="col-2 ">
                                <button type="button" class="btn btn-raised btn-primary" id="btnreturn" onclick="fntNuevoMostrarVacineList()"><i class="fad fa-2x fa-arrow-square-left"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="modalVaccine" tabindex="-1" role="dialog" aria-labelledby="modalLabelVaccine" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalLabelVaccine">Vacunas</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div id="TablaSelectVaccine" name="TablaSelectVaccine">
                            <!-- DIBUJO DE TABLA CATEGORIA PRODUCTO-->
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>


    </section>

    <script>
        function fntSelectView(intParametro) {
            document.getElementById('vaccine').style.display = 'block';
            document.getElementById('vaccineList').style.display = 'none';
            document.getElementById('btnInsert').style.display = 'none';
            document.getElementById('btnUpdate').style.display = 'none';
            document.getElementById('vaccineShop').style.display = 'none';

            document.getElementById('buy').style.display = 'none';
            document.getElementById('add').style.display = 'none';
            document.getElementById('shop').style.display = 'none';

            intParametro = !intParametro ? 0 : intParametro;
            if (intParametro > 0) {

                var strId = $("#id_" + intParametro).val();
                var strVacId = $("#med_vac_id_" + intParametro).val();
                var strVacNom = $("#med_vac_nom_" + intParametro).val();
                var strVacCosto = $("#med_vac_costo_" + intParametro).val();
                var strVacPrecio = $("#med_vac_precio_" + intParametro).val();
                var strVacSali = $("#med_vac_sali_" + intParametro).val();
                var strVacComp = $("#med_vac_comp_" + intParametro).val();
                var strVacSalAct = $("#med_vac_sal_act_" + intParametro).val();
                var strVacDes = $("#med_vac_des_" + intParametro).val();

                // alert(strDPI + "                         strDPI");

                $("#id").val(strId);
                $("#codigo").val(strVacId);
                $("#nombre").val(strVacNom);
                $("#costo").val(strVacCosto);
                $("#precio_venta").val(strVacPrecio);
                $("#saldo_inicial").val(strVacSali);
                $("#compra").val(strVacComp);
                $("#saldo_actual").val(strVacSalAct);
                $("#descripcion").val(strVacDes);
            }
            $('input,textarea,select,checkbox').attr('readonly', true)

        }

        

        function fntSelectVaccine_(intParametro) {

            intParametro = !intParametro ? 0 : intParametro;
            if (intParametro > 0) {

                var strId = $("#id_" + intParametro).val();
                var strVacId = $("#med_vac_id_" + intParametro).val();
                var strVacNom = $("#med_vac_nom_" + intParametro).val();
                var strVacCosto = $("#med_vac_costo_" + intParametro).val();
                var strVacPrecio = $("#med_vac_precio_" + intParametro).val();
                var strVacSali = $("#med_vac_sali_" + intParametro).val();
                var strVacComp = $("#med_vac_comp_" + intParametro).val();
                var strVacSalAct = $("#med_vac_sal_act_" + intParametro).val();
                var strVacDes = $("#med_vac_des_" + intParametro).val();

                // alert(strDPI + "                         strDPI");

                $("#med_vam_id_s").val(strId);
                $("#med_vam_id").val(strVacId);
                $("#med_vam_nom").val(strVacNom);
                $("#costo").val(strVacCosto);
                $("#precio_venta").val(strVacPrecio);
                $("#saldo_inicial").val(strVacSali);
                $("#compra").val(strVacComp);
                $("#saldo_actual").val(strVacSalAct);
            }

            $('#modalVaccine').modal('hide')

        }

        function fntSelectEdit(intParametro) {
            document.getElementById('vaccine').style.display = 'block';
            document.getElementById('vaccineList').style.display = 'none';
            document.getElementById('btnInsert').style.display = 'none';
            document.getElementById('btnUpdate').style.display = 'block';
            document.getElementById('vaccineShop').style.display = 'none';


            document.getElementById('buy').style.display = 'none';
            document.getElementById('add').style.display = 'none';
            document.getElementById('shop').style.display = 'none';

            intParametro = !intParametro ? 0 : intParametro;
            if (intParametro > 0) {
                var strId = $("#id_" + intParametro).val();
                var strVacId = $("#med_vac_id_" + intParametro).val();
                var strVacNom = $("#med_vac_nom_" + intParametro).val();
                var strVacCosto = $("#med_vac_costo_" + intParametro).val();
                var strVacPrecio = $("#med_vac_precio_" + intParametro).val();
                var strVacSali = $("#med_vac_sali_" + intParametro).val();
                var strVacComp = $("#med_vac_comp_" + intParametro).val();
                var strVacVent = $("#med_vac_vent_" + intParametro).val();
                var strVacSalAct = $("#med_vac_sal_act_" + intParametro).val();
                var strVacDes = $("#med_vac_des_" + intParametro).val();

                //alert(strVacDes + "                         strVacDes");
                $("#id").val(strId);
                $("#codigo").val(strVacId);
                $("#nombre").val(strVacNom);
                $("#costo").val(strVacCosto);
                $("#precio_venta").val(strVacPrecio);
                $("#saldo_inicial").val(strVacSali);
                $("#compra").val(strVacComp);
                $("#venta").val(strVacVent);
                $("#saldo_actual").val(strVacSalAct);
                $("#descripcion").val(strVacDes);
            }

            $("codigo").prop('disabled', true);
            $('input,textarea,select').attr('readonly', false)

        }

        function fntSaldoAct() {

            var strVacSali = $("#saldo_inicial").val();
            var totalProd = 0;
            var total = 0;

            total = (strVacSali);

            $("#saldo_actual").val(total);
            $("#saldo_actual_").val(total);

        }

        // MOSTRAR Y OCULTAR MODULOS
        document.getElementById('vaccine').style.display = 'none';
        document.getElementById('vaccineList').style.display = 'block';
        document.getElementById('vaccineBuyList').style.display = 'none';
        document.getElementById('btnInsert').style.display = 'block';
        document.getElementById('btnUpdate').style.display = 'none';
        document.getElementById('vaccineShop').style.display = 'none';

        function fntNuevoVacine() {
            document.getElementById('vaccineShop').style.display = 'none';
            document.getElementById('vaccineList').style.display = 'none';
            document.getElementById('vaccineBuyList').style.display = 'none';
            var elemento = document.getElementById('vaccine');
            if (!elemento) {
                return true;
            }
            if (elemento.style.display == "none") {
                elemento.style.display = "block"
            } else {
                elemento.style.display = "none"
            };
            return true;
            $('#formData')[0].reset();
            $("codigo").prop('disabled', false);
            $('input,textarea,select').attr('readonly', false)
        };

        function fntNuevoMostrarVacineList() {
            document.getElementById('vaccineShop').style.display = 'none';
            document.getElementById('vaccine').style.display = 'none';
            document.getElementById('vaccineBuyList').style.display = 'none';

            document.getElementById('buy').style.display = 'inline';
            document.getElementById('add').style.display = 'inline';
            document.getElementById('shop').style.display = 'inline';
            document.getElementById('list').style.display = 'inline';
            var elemento = document.getElementById('vaccineList');
            if (!elemento) {
                return true;
            }
            if (elemento.style.display == "none") {
                elemento.style.display = "block"
            } else {
                elemento.style.display = "none"
            };

            $('#formData')[0].reset();
            $("codigo").prop('disabled', false);
            $('input,textarea,select').attr('readonly', false)
            return true;
        };



        function fntNuevoMostrarVacineBuyList() {
            document.getElementById('vaccineShop').style.display = 'none';
            document.getElementById('vaccineList').style.display = 'none';
            document.getElementById('vaccine').style.display = 'none';
            document.getElementById('add').style.display = 'inline';
            document.getElementById('shop').style.display = 'inline';
            document.getElementById('list').style.display = 'inline';

            var elemento = document.getElementById('vaccineBuyList');
            if (!elemento) {
                return true;
            }
            if (elemento.style.display == "none") {
                elemento.style.display = "block"
            } else {
                elemento.style.display = "none"
            };
            return true;
        };

        function fntCompraVacine() {
            // PACIENTES
            document.getElementById('vaccineBuyList').style.display = 'none';
            document.getElementById('vaccineList').style.display = 'none';
            document.getElementById('vaccine').style.display = 'none';
            document.getElementById('add').style.display = 'inline';
            document.getElementById('shop').style.display = 'inline';
            document.getElementById('list').style.display = 'inline';

            var elemento = document.getElementById('vaccineShop');
            if (!elemento) {
                return true;
            }
            if (elemento.style.display == "none") {
                elemento.style.display = "block"
            } else {
                elemento.style.display = "none"
            };
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
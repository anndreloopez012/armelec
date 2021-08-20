<body>
    <section class="content col-md-12">
        <div class="col-md-12">
            <p>
            <p>
                <a class="btn btn-raised btn-info" href="index.php" role="button" aria-expanded="false" href="index.php">Menu</a>
                <a class="btn btn-raised btn-info btn-center" id="tab_prod_" name="tab_prod_" type="button" onclick="fntProdMostrarOcultar()">PRODUCTOS</a>
                <a class="btn btn-raised btn-info btn-center" id="form_product" name="form_product" type="button" onclick="fntProdFormMostrarOcultar()">NUEVO PRODUCTO</a>
                <a class="btn btn-raised btn-info btn-center" id="form_product_new" name="form_product_new" type="button" onclick="fntProdNewFormMostrarOcultar()"> AGREGAR</a>
            </p>
            <div class="collapse " id="producto">
                <div class=" card-body">
                    <div class="card card-primary ">
                        <div class="col-sm-12 row">
                            &nbsp;&nbsp; <a type="button" class="btn btn-raised btn-primary" id="return" href="index.php"><i class="fad fa-2x fa-arrow-square-left" aria-hidden="true"></i></a>&nbsp;&nbsp;

                            <div class="col-sm-6">
                                <input class="form-control" name="Search" id="Search" type="text" style="text-transform:uppercase;" placeholder="ESCRIBA EL DATO A BUSCAR">
                            </div>
                            <div>
                                <a type="button" class="btn btn-info" onclick="fntDibujoTabla() "><i class="fad fa-2x fa-search"></i></a>
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

            <div class="collapse " id="producto_nuevo">
                <div class=" card-primary ">
                    <div class="col-sm-12 row">
                        &nbsp;&nbsp;<button type="button" class="btn btn-raised btn-primary" id="btnreturn" onclick="fntProdMostrarOcultar()"><i class="fad fa-2x fa-arrow-square-left"></i></button>&nbsp;&nbsp;

                        <div class="col-sm-6">
                            <input class="form-control" name="SearchNew" id="SearchNew" type="text" style="text-transform:uppercase;" placeholder="ESCRIBA EL DATO A BUSCAR">
                        </div>
                        <div>
                            <a type="button" class="btn btn-info" onclick="fntDibujoTablaNew() "><i class="fad fa-2x fa-search"></i></a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="div1">
                            <div id="TablaNuevo" name="TablaNuevo">
                                <!-- DIBUJO DE TABLA CATEGORIA PRODUCTO-->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <form id="formDataNew" method="POST">
                <input type="hidden" id="ctg_pro_cod" name="ctg_pro_cod">
                <input type="hidden" id="ctg_pro_desc" name="ctg_pro_desc">
                <input type="hidden" id="ctg_pro_pre" name="ctg_pro_pre">
                <input type="hidden" id="ctg_pro_prinact" name="ctg_pro_prinact">
                <input type="hidden" id="ctg_pro_labfar" name="ctg_pro_labfar">
                <input type="hidden" id="ctg_pro_fecaut" name="ctg_pro_fecaut">
                <input type="hidden" id="ctg_pro_fecven" name="ctg_pro_fecven">
                <input type="hidden" id="ctg_pro_indi" name="ctg_pro_indi">
            </form>

            <div class="collapse " id="formProd">
                <div class="card-body">
                    <div class="card-primary ">
                        <div class="card-body ">
                            <form id="formData" method="POST">
                                <div class="row">
                                    <div class="form-group col-md-1">
                                        <label for="exampleInputEmail1" class=" color-label">Id Del Producto</label>
                                        <input type="hidden" class="form-control" id="id" name="id">
                                        <input type="text" class="form-control" id="ctg_fap_pro" name="ctg_fap_pro" onblur="fntValidacionCode()">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="exampleInputEmail1" class=" color-label">Nombre Del Producto</label>
                                        <input type="text" class="form-control" id="ctg_fap_nomcom" name="ctg_fap_nomcom">
                                    </div>
                                    <div class="form-group col-md-1">
                                        <label for="exampleInputEmail1" class=" color-label">Precio</label>
                                        <input type="text" class="form-control" id="ctg_fap_pre" name="ctg_fap_pre">
                                    </div>
                                    <div class="form-group col-md-1">
                                        <label for="exampleInputEmail1" class=" color-label">Fecha de Autorizacion</label>
                                        <input type="date" class="form-control" id="ctg_fap_fecaut" name="ctg_fap_fecaut">
                                    </div>
                                    <div class="form-group col-md-1">
                                        <label for="exampleInputEmail1" class=" color-label">Fecha de Vencimiento</label>
                                        <input type="date" class="form-control" id="ctg_fap_fecven" name="ctg_fap_fecven">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="exampleInputEmail1" class=" color-label">Principio Activo</label>
                                        <input type="text" class="form-control" id="ctg_fap_prinact" name="ctg_fap_prinact">
                                    </div>
                                    <div class="form-group col-md-6"></div>
                                    <div class="form-group col-md-6">
                                        <label for="exampleInputEmail1" class=" color-label">Laboratorio Fabricante</label>
                                        <input type="text" class="form-control" id="ctg_fap_labfar" name="ctg_fap_labfar">
                                    </div>
                                    <div class="form-group col-md-6"></div>
                                    <div class="form-group col-md-6">
                                        <label for="exampleInputEmail1" class=" color-label">Indicaciones</label>
                                        <textarea type="text" class="form-control" id="ctg_fap_indi" name="ctg_fap_indi" rows="4"></textarea>
                                    </div>
                                    
                                </div>
                            </form>
                            <div class="col-4 row">
                                <div class="col-2 ">
                                    <button type="button" class="btn btn-raised btn-primary" id="btnreturn" onclick="fntProdMostrarOcultar()"><i class="fad fa-2x fa-arrow-square-left"></i></button>
                                </div>
                                <div class="col-2 ">
                                    <button type="button" class="btn btn-raised btn-primary" id="btnInsert" onclick="fntInsert()"><i class="fad fa-2x fa-save"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>

    <div class="modal fade bd-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" id="mySmallModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Precios</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="formDataPrecio" method="POST">
                        <div class="row">
                            <div class="form-group col-md-12">
                                <input type="hidden" class="form-control" id="id_pre" name="id_pre">
                                <input type="text" class="form-control" id="precio" name="precio">
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" onclick="fntUpdatePrecio()">Actualizar</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        // MOSTRAR Y OCULTAR MODULOS
        document.getElementById('producto_nuevo').style.display = 'none';
        document.getElementById('formProd').style.display = 'none';
        document.getElementById('producto').style.display = 'block';
        document.getElementById('btnInsert').style.display = 'block';

        function fntSelectSave(intParametro) {
            document.getElementById('formProd').style.display = 'none';
            document.getElementById('producto').style.display = 'none';
            document.getElementById('btnInsert').style.display = 'none';
            document.getElementById('producto_nuevo').style.display = 'block';
            document.getElementById('producto').style.display = 'none';

            intParametro = !intParametro ? 0 : intParametro;

            if (intParametro > 0) {

                var strId = $("#hidId_" + intParametro).val();
                var strcod = $("#hid_ctg_pro_cod_" + intParametro).val();
                var strctg_pro_desc = $("#hid_ctg_pro_desc_" + intParametro).val();
                var strctg_pro_pre = $("#hid_ctg_pro_pre_" + intParametro).val();
                var strctg_pro_prinact = $("#hid_ctg_pro_prinact_" + intParametro).val();
                var strctg_pro_labfar = $("#hid_ctg_pro_labfar_" + intParametro).val();
                var strctg_pro_fecaut = $("#hid_ctg_pro_fecaut_" + intParametro).val();
                var strctg_pro_fecven = $("#hid_ctg_pro_fecven_" + intParametro).val();
                var strctg_pro_indi = $("#hid_ctg_pro_indi_" + intParametro).val();

                //alert(strctg_pro_labfar + "                         strctg_pro_labfar");
                //alert(strName + "                         strDPI");
                //alert(strctg_pro_indi + "                         strctg_pro_indi");

                $("#ctg_pro_cod").val(strcod);
                $("#ctg_pro_desc").val(strctg_pro_desc);
                $("#ctg_pro_pre").val(strctg_pro_pre);
                $("#ctg_pro_prinact").val(strctg_pro_prinact);
                $("#ctg_pro_labfar").val(strctg_pro_labfar);
                $("#ctg_pro_fecaut").val(strctg_pro_fecaut);
                $("#ctg_pro_fecven").val(strctg_pro_fecven);
                $("#ctg_pro_indi").val(strctg_pro_indi);
            }

            fntInsertNew()
        }

        function fntSelectDelete(intParametro) {

            intParametro = !intParametro ? 0 : intParametro;

            if (intParametro > 0) {

                var strId = $("#hid__Id_" + intParametro).val();
                $("#id").val(strId);

            }

            fntDelete()
        }

        function fntProdMostrarOcultar() {
            document.getElementById('formProd').style.display = 'none';
            document.getElementById('producto_nuevo').style.display = 'none';
            document.getElementById('form_product').style.display = 'inline';
            document.getElementById('tab_prod_').style.display = 'inline';

            var elemento = document.getElementById('producto');
            if (!elemento) {
                return true;
            }
            if (elemento.style.display == "none") {
                elemento.style.display = "block"
            } else {
                elemento.style.display = "none"
            };

            $('#formData')[0].reset();
            $('input,textarea,select,checkbox').attr('readonly', false)

            return true;
        };


        function fntProdFormMostrarOcultar() {

            document.getElementById('producto').style.display = 'none';
            document.getElementById('producto_nuevo').style.display = 'none';
            document.getElementById('form_product').style.display = 'inline';
            document.getElementById('tab_prod_').style.display = 'none';
            var elemento = document.getElementById('formProd');
            if (!elemento) {
                return true;
            }
            if (elemento.style.display == "none") {
                elemento.style.display = "block"
            } else {
                elemento.style.display = "none"
            };

            $('#formData')[0].reset();
            $('input,textarea,select,checkbox').attr('readonly', false)



            return true;
        }

        function fntProdNewFormMostrarOcultar() {

            document.getElementById('producto').style.display = 'none';
            document.getElementById('formProd').style.display = 'none';
            document.getElementById('form_product').style.display = 'inline';
            document.getElementById('tab_prod_').style.display = 'none';
            var elemento = document.getElementById('producto_nuevo');
            if (!elemento) {
                return true;
            }
            if (elemento.style.display == "none") {
                elemento.style.display = "block"
            } else {
                elemento.style.display = "none"
            };

            $('#formData')[0].reset();
            $('input,textarea,select,checkbox').attr('readonly', false)



            return true;
        }


        function fntSelectPrecio(intParametro) {

            intParametro = !intParametro ? 0 : intParametro;

            if (intParametro > 0) {

                var strId = $("#hid__Id_" + intParametro).val();
                var strhidPre_ = $("#hid_ctg_fap_pre" + intParametro).val();
                $("#id_pre").val(strId);
                $("#precio").val(strhidPre_);

            }
            $('#mySmallModalLabel').modal('show')

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
<script>
    //update delete e insert
    function fntInsertNew() {

        alertify.confirm('Tus Productos', 'Seguro que desea continuar?  ', function() {
            var datos = $('#formDataNew').serialize();
            //alert(datos);
            //return false;
            document.getElementById("loading-screen").style.display = "block";

            $.ajax({
                type: "POST",
                data: datos,
                dataType: 'json',
                url: "pharmacistsProducts.php?ajax=true&validaciones=insert_new",
                success: function(r) {
                    if (r.status) {
                        if (r.status == 1) {
                            $('#formData')[0].reset();
                            $('#Tabla').load('pharmacistsProducts.php?validaciones=busqueda_table');
                            $('#TablaNuevo').load('pharmacistsProducts.php?validaciones=busqueda_table_new');
                            alertify.alert('Tus Productos', 'Datos cargados correctamente');
                            //location.reload(); 
                            document.getElementById("loading-screen").style.display = "none";
                        }
                    } else {
                        alertify.alert('Tus Productos', 'no se pudo completar!');
                        //location.reload(); 
                    }
                }
            });
        }, function() {
            alertify.error('Cancel')
        })
        return false;
    };

    function fntInsert() {

        valor = document.getElementById("ctg_fap_pro").value;
        if (valor == null || valor.length == 0 || /^\s+$/.test(valor)) {
            alertify.alert('Aviso', 'Por favor complete el siguiente campo:id producto');
            return false;
        }

        valor = document.getElementById("ctg_fap_nomcom").value;
        if (valor == null || valor.length == 0 || /^\s+$/.test(valor)) {
            alertify.alert('Aviso', 'Por favor complete el siguiente campo:nombre producto');
            return false;
        }

        valor = document.getElementById("ctg_fap_pre").value;
        if (valor == null || valor.length == 0 || /^\s+$/.test(valor)) {
            alertify.alert('Aviso', 'Por favor complete el siguiente campo:precio');
            return false;
        }

        valor = document.getElementById("ctg_fap_fecaut").value;
        if (valor == null || valor.length == 0 || /^\s+$/.test(valor)) {
            alertify.alert('Aviso', 'Por favor complete el siguiente campo:fecha autorizacion');
            return false;
        }

        valor = document.getElementById("ctg_fap_fecven").value;
        if (valor == null || valor.length == 0 || /^\s+$/.test(valor)) {
            alertify.alert('Aviso', 'Por favor complete el siguiente campo:fecha vencimiento');
            return false;
        }

        alertify.confirm('Tus Productos', 'Seguro que desea continuar?  ', function() {
            var datos = $('#formData').serialize();
            //alert(datos);
            //return false;
            document.getElementById("loading-screen").style.display = "block";

            $.ajax({
                type: "POST",
                data: datos,
                dataType: 'json',
                url: "pharmacistsProducts.php?ajax=true&validaciones=insert",
                success: function(r) {
                    if (r.status) {
                        if (r.status == 1) {
                            $('#formData')[0].reset();
                            $('#Tabla').load('pharmacistsProducts.php?validaciones=busqueda_table');
                            $('#TablaNuevo').load('pharmacistsProducts.php?validaciones=busqueda_table_new');
                            alertify.alert('Tus Productos', 'Datos cargados correctamente');
                            //location.reload(); 
                            document.getElementById("loading-screen").style.display = "none";
                        }
                    } else {
                        alertify.alert('Tus Productos', 'no se pudo completar!');
                        //location.reload(); 
                    }
                }
            });
        }, function() {
            alertify.error('Cancel')
        })
        return false;
    };

    function fntValidacionCode() {

        var objCode = $("#ctg_fap_pro").val();

        $.ajax({

            url: "pharmacistsProducts.php?ajax=true&validaciones=validacion_code&code=" + objCode,
            async: true,
            global: false,

            success: function(r) {
                if (r.status) {
                    if (r.status == 1) {
                        alertify.alert('Tus Productos', 'Codigo no disponible!');
                    }
                } else {
                    alertify.alert('Tus Productos', 'Codigo disponible!');
                }
            }
        });

        return false;
    }

    function fntUpdatePrecio() {

        alertify.confirm('Tus Productos', 'Seguro que desea continuar?  ', function() {
            var datos = $('#formDataPrecio').serialize();
            //alert(datos);
            //return false;
            document.getElementById("loading-screen").style.display = "block";

            $.ajax({
                type: "POST",
                data: datos,
                dataType: 'json',
                url: "pharmacistsProducts.php?ajax=true&validaciones=update_precio",
                success: function(r) {
                    if (r.status) {
                        if (r.status == 1) {
                            $('#formData')[0].reset();
                            fntDibujoTabla()
                            fntDibujoTablaNew()
                            document.getElementById("loading-screen").style.display = "none";
                            alertify.alert('Tus Productos', 'Datos cargados correctamente');
                            $('#mySmallModalLabel').modal('hide')

                            //location.reload(); 
                        }
                    } else {
                        alertify.alert('Tus Productos', 'no se pudo completar!');
                        //location.reload(); 
                    }
                }
            });
        }, function() {
            alertify.error('Cancel')
        })
        return false;
    };

    function fntDelete() {

        alertify.confirm('Tus Productos', 'Seguro que desea continuar?  ', function() {
            var datos = $('#formData').serialize();
            //alert(datos);
            //return false;
            document.getElementById("loading-screen").style.display = "block";

            $.ajax({
                type: "POST",
                data: datos,
                dataType: 'json',
                url: "pharmacistsProducts.php?ajax=true&validaciones=delete",
                success: function(r) {
                    if (r.status) {
                        if (r.status == 1) {
                            $('#formData')[0].reset();
                            $('#Tabla').load('pharmacistsProducts.php?validaciones=busqueda_table');
                            alertify.alert('Tus Productos', 'Datos cargados correctamente');
                            document.getElementById("loading-screen").style.display = "none";
                            //location.reload(); 
                        }
                    } else {
                        alertify.alert('Tus Productos', 'no se pudo completar!');
                        //location.reload(); 
                    }
                }
            });
        }, function() {
            alertify.error('Cancel')
        })
        return false;
    };

    //validar codigo 
    function fntValidacioncodigo() {

        var objnombre = document.getElementById("nombre");
        var intnombre = objnombre.value * 1;

        if (!isNaN(intnombre) && (intcnombre > 0)) {

            $.ajax({

                url: "pharmacistsProducts.php?validaciones=validacion_nombre&nombre=" + intnombre,
                async: true,
                global: false,

                success: function(data) {

                    if (data == "Y") {
                        alertify.alert('Tus Productos', 'este nombre ya esta siendo usado');
                    }
                }
            });

        }
        return false;
    }

    function fntDibujoTabla() {

        var strSearch = $("#Search").val();
        var strCategori = $("#categori").val();

        //alert(strCategori + "                                  strCategori");
        document.getElementById("loading-screen").style.display = "block";

        $.ajax({

            url: "pharmacistsProducts.php?validaciones=busqueda_table",
            data: {
                categori: strCategori,
                Search: strSearch,
            },
            async: true,
            global: false,
            type: "post",
            dataType: "html",
            success: function(data) {

                $("#Tabla").html("");
                $("#Tabla").html(data);
                document.getElementById("loading-screen").style.display = "none";
                return false;
            }
        });

    };

    function fntDibujoTablaNew() {

        var strSearch = $("#SearchNew").val();

        //alert(strCategori + "                                  strCategori");
        document.getElementById("loading-screen").style.display = "block";

        $.ajax({

            url: "pharmacistsProducts.php?validaciones=busqueda_table_new",
            data: {
                Search: strSearch,
            },
            async: true,
            global: false,
            type: "post",
            dataType: "html",
            success: function(data) {

                $("#TablaNuevo").html("");
                $("#TablaNuevo").html(data);
                document.getElementById("loading-screen").style.display = "none";
                return false;
            }
        });

    };

    window.addEventListener('load', fntDibujoTablaNew, false)
    window.addEventListener('load', fntDibujoTabla, false)
</script>